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

Route::get('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout');
//Route::get('/logout2', 'Auth\LoginController@logout');
Route::get('/logout2', 'Auth\LoginController@logout');
Route::post('logout2', 'Auth\AuthController@logout')->name('logout2');
Route::get('/try', 'Auth\LoginController@logout');
