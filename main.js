const electron = require('electron');
const path = require('path');
const os = require('os');

const BrowserWindow = electron.BrowserWindow;
const app = electron.app;

app.on('ready', () => {
  createWindow();
});

var phpServer = require('node-php-server');
const port = 8000, host = '127.0.0.1';
const serverUrl = `http://${host}:${port}`;

let mainWindow;

function createWindow() {
  // Detectar el sistema operativo
  const platform = os.platform();
  let phpBinary = '';
  if (platform === 'win32') {
    phpBinary = `${__dirname}/php/php.exe`;
  } else if (platform === 'linux') {
    phpBinary = '/usr/bin/php'; // Asegúrate de que PHP esté instalado en esta ubicación en tu sistema Ubuntu
  } else {
    throw new Error('Unsupported platform: ' + platform);
  }

  try {
    // Crear el servidor PHP
    phpServer.createServer({
      port: port,
      hostname: host,
      base: `${__dirname}/www/public`,
      keepalive: false,
      open: false,
      bin: phpBinary,
      router: __dirname + '/www/server.php'
    });

    console.log(`PHP server running at ${serverUrl}`);

    // Crear la ventana del navegador
    const { width, height } = electron.screen.getPrimaryDisplay().workAreaSize;
    mainWindow = new BrowserWindow({
      width: width,
      height: height,
      show: false,
      autoHideMenuBar: true
    });

    mainWindow.loadURL(serverUrl);

    mainWindow.webContents.once('dom-ready', function () {
      mainWindow.show();
      mainWindow.maximize();
      // mainWindow.webContents.openDevTools()
    });

    // Emitido cuando la ventana está cerrada
    mainWindow.on('closed', function () {
      phpServer.close();
      mainWindow = null;
    });

  } catch (error) {
    console.error('Failed to start PHP server:', error);
  }
}

// Este método se llamará cuando Electron haya terminado la inicialización y esté listo para crear ventanas de navegador.
// Algunas API solo se pueden usar después de que ocurra este evento.
//app.on('ready', createWindow) // <== this is extra so commented, enabling this can show 2 windows..

// Salir cuando todas las ventanas estén cerradas.
app.on('window-all-closed', function () {
  // En OS X es común que las aplicaciones y su barra de menú
  // permanezcan activas hasta que el usuario salga explícitamente con Cmd + Q
  if (process.platform !== 'darwin') {
    // CERRAR EL SERVIDOR PHP
    phpServer.close();
    app.quit();
  }
});

app.on('activate', function () {
  // En OS X es común volver a crear una ventana en la aplicación cuando
  // se hace clic en el icono del dock y no hay otras ventanas abiertas.
  if (mainWindow === null) {
    createWindow();
  }
});
