<?php

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

Route::get('/', function () {
    return view('contenido/contenido');
})->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
//TABLA EFECTIVO
Route::get('/efectivo','EfectivoController@index');
Route::post('/efectivo/registrar','EfectivoController@store');
Route::put('/efectivo/actualizar','EfectivoController@update');
Route::get('/caja','EfectivoController@cajaChica')->name('caja');

//TABLA MONTO FIJO
Route::get('/montofijo','MontoFijoController@index');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
