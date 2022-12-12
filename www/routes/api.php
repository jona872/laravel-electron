<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/listado-facturas', 'FacturaController@getFacturas');

// //UPDATE->PUT-> Form/url encoded postman (si uso api/v1/... no es necesario modificar estos metodos)
//Route::put('/factura-editar/{id}', 'FacturaController@update');
//Route::put('/cliente-editar/{id}', 'ClienteController@update');
Route::get('/v1/clientes/listado', 'ClienteController@apiClients');


// //RESOURCES API  
Route::apiResources([
    '/v1/facturas' => 'FacturaController',
    '/v1/clientes' => 'ClienteController',
    '/v1/ventas' => 'LibroVentaController',
]);
