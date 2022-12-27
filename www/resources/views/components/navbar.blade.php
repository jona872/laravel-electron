<!-- NAVBAR -->
<nav class="navbar">

    <div class="dropdown">
        <button class="nav--btn">Clientes</button>
        <div class="dropdown-content">
            <a href="/clientes/create">Agregar Cliente</a>
            <a href="/clientes">Listado de Clientes</a>
        </div>
    </div>

    <div class="dropdown">
        <button class="nav--btn">Compras</button>
        <div class="dropdown-content">
            <a href="/compras/create">Agregar Compras</a>
            <a href="/compras">Listado de Compras</a>
        </div>
    </div>

    <div class="dropdown">
        <button class="nav--btn">Ventas</button>
        <div class="dropdown-content">
            <a href="/ventas/create">Agregar Venta</a>
            <a href="/ventas">Listado de Ventas</a>
        </div>
    </div>

    <div class="dropdown">
        <button class="nav--btn">Resumenes</button>
        <div class="dropdown-content">
            <a href="/mensuales"> Resumen Mensual </a>
            <a href="/anuales"> Resumen Anual </a>
            <a href="/periodos"> Resumen Periodos </a>
        </div>
    </div>

    @auth
    <div class="dropdown">
        <button class="nav--btn"> {{Auth::user()->name}} </button>
        <div class="dropdown-content">
            <a href="{{ route('logout') }}"> Salir </a>
        </div>
    </div>
    @endauth

</nav>
<!-- NAVBAR -->