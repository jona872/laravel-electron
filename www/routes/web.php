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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::get('/home', 'ClienteController@index');

    Route::get('/ventas/export', 'LibroVentaController@exportVentas');

    //========= RESOURCES =========
    // Route::resource('facturas', 'FacturaController');
    Route::resource('compras', 'LibroCompraController');
    Route::resource('ventas', 'LibroVentaController');
    Route::resource('resumenes', 'ResumenesController');
    Route::resource('clientes', 'ClienteController');
});
