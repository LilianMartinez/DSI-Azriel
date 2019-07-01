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
});

//TABLA EFECTIVO
Route::get('/efectivo','EfectivoController@index');
Route::put('/efectivo/registrar','EfectivoController@store');
Route::put('/efectivo/actualizar','EfectivoController@update');
Route::get('/efectivo/suma','EfectivoController@buscar');


//TABLA MONTO FIJO
Route::get('/montofijo','MontoFijoController@index');
Route::put('/montofijo/registrar','MontoFijoController@store');
Route::post('/montofijo/buscarmf','MontoFijoController@buscar');
Route::put('/montofijo/actualizar','MontoFijoController@update');
Route::put('/montofijo/eliminar','MontoFijoController@eliminar');

