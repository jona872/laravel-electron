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

Route::get('/', 'FacturaController@index');
Route::get('/home', 'FacturaController@index');

//========= RESOURCES =========
Route::resource('factura', 'FacturaController');
Route::resource('compras', 'LibroCompraController');
Route::resource('ventas', 'LibroVentaController');
Route::resource('resumenes', 'ResumenesController');
Route::resource('clientes', 'UserController');