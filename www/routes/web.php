<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::view('/tmp/show', 'LibroCompraController@showSearch');
Route::get("/tmp/show", function(){
    return view("compras.tmp");
 });

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::get('/home', 'ClienteController@index');

    Route::get('/mensuales', 'ResumenesController@indexMensual');
    Route::post('/mensuales/preview', 'ResumenesController@mensualesPreview');
    Route::post('/mensuales/export', 'ResumenesController@mensualesExport');
    
    Route::get('/anuales', 'ResumenesController@indexAnual');
    Route::post('/anuales/preview', 'ResumenesController@anualesPreview');
    Route::post('/anuales/export', 'ResumenesController@anualesExport');
    
    Route::get('/anuales', 'ResumenesController@indexAnual');
    Route::get('/periodos', 'ResumenesController@indexPeriodo');

    Route::get('/ventas/export', 'LibroVentaController@exportVentas');

    //========= RESOURCES =========
    // Route::resource('facturas', 'FacturaController');
    Route::resource('compras', 'LibroCompraController');
    Route::resource('ventas', 'LibroVentaController');
    Route::resource('resumenes', 'ResumenesController');
    Route::resource('clientes', 'ClienteController');
});
