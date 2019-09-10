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
Route::group(['middleware'=>['guest']],function(){
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login','Auth\LoginController@Login')->name('login');
});

Route::group(['middleware'=>['auth']],function(){

            Route::post('/logout','Auth\LoginController@logout')->name('logout');
    
            Route::get('/main', function () {
                return view('contenido/contenido');
            })->name('main');
            
            Route::group(['middleware'=>['Parroco']],function(){

                            //TABLA ROLES
                            Route::get('/rol','RolController@index');
                            Route::get('/rol/selectRol','RolController@selectRol');
                            
                            
                            //TABLA USERS
                            Route::get('/user','UserController@index');
                            Route::put('/user/registrar','UserController@store');
                            Route::put('/user/actualizar','UserController@update');
                            Route::put('/user/desactivar','UserController@desactivar');
                            Route::put('/user/activar','UserController@activar');

            });

            Route::group(['middleware'=>['Secretaria']],function(){

                                //TABLA EFECTIVO
                            Route::get('/efectivo','EfectivoController@index');
                            Route::put('/efectivo/registrar','EfectivoController@store');
                            Route::put('/efectivo/actualizar','EfectivoController@update');
                            Route::put('/efectivo/eliminar','EfectivoController@destroy');
                            Route::get('/efectivo/suma','EfectivoController@buscar');
                            Route::get('/efectivo/listarPdfGeneral','EfectivoController@listarPdfGeneral')->name('efectivos_pdf');
                            
                            
                            //TABLA MONTO FIJO
                            Route::get('/montofijo','MontoFijoController@index');
                            Route::put('/montofijo/registrar','MontoFijoController@store');
                            Route::post('/montofijo/buscarmf','MontoFijoController@buscar');
                            Route::put('/montofijo/actualizar','MontoFijoController@update');
                            Route::put('/montofijo/eliminar','MontoFijoController@eliminar');
            });

});

//Route::get('/home', 'HomeController@index')->name('home');
