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
                            Route::get('/efectivo/sumaM','EfectivoController@buscarM');
                            Route::get('/efectivo/listarPdfGeneral','EfectivoController@listarPdfGeneral')->name('efectivos_pdf');
                            Route::get('/efectivo/listarPdfResumido','ResumenEconomicoController@listarPdfResumido')->name('efectivos_pdfR');
                            Route::get('/efectivo/buscarResumen','EfectivoController@buscarResumen');
                            
                            
                            //TABLA MONTO FIJO
                            Route::get('/montofijo','MontoFijoController@index');
                            Route::put('/montofijo/registrar','MontoFijoController@store');
                            Route::post('/montofijo/buscarmf','MontoFijoController@buscar');
                            Route::put('/montofijo/actualizar','MontoFijoController@update');
                            Route::put('/montofijo/eliminar','MontoFijoController@eliminar');

                            //TABLA PERSONA
                            Route::get('/persona/obtener','PersonaController@realizante');
                            Route::get('/persona/buscarsacerdote','PersonaController@buscarsacerdote');
                            Route::get('/persona/duis','PersonaController@buscarduis');
                            Route::get('/persona/pan','PersonaController@show');
                            Route::put('/persona/registrar','PersonaController@store'); 
                            Route::get('/persona/listarcomuniones','PersonaController@listaPC');//para el realizante
                            Route::get('/persona/listarconfirmaciones','PersonaController@listaC');//para el realizante
                            Route::get('/persona/listarsupletorias','PersonaController@listaS');//para el realizante

                                           //MANTENIMIENTO PERSONAS RELIGIOSAS
                                           Route::get('/religioso/index','PersonaController@indexRel');
                                           Route::put('/religioso/registrar','PersonaController@storeReli');
                                           Route::post('/religioso/buscarReli','PersonaController@buscarReli');
                                           Route::put('/religioso/actualizar','PersonaController@updateReli');
                                           Route::put('/religioso/eliminar','PersonaController@eliminarReli');

                            //TABLA Partida
                            Route::get('/partida/busqueda','PartidaNacimientoController@realizante');


                            //TABLA sacramentos
                            Route::put('/sacramento/registrar','Sacramentos3Controller@registro');
                            

                            //TABLA DE CATEGORIA RESUMEN
                            Route::get('/categoriaresumen','CategoriaResumenController@index');
                            Route::put('/categoriaresumen/eliminarCR','CategoriaResumenController@eliminarCR');
                            Route::put('/categoriaresumen/registrar','CategoriaResumenController@store');
                            Route::put('/categoriaresumen/actualizar','CategoriaResumenController@update');
                            Route::get('/categoriaresumen/selectCategoriaRe','CategoriaResumenController@selectCategoriaRe');

                            //TABLA DE RESUMEN ECONOMICO
                            Route::get('/resumeneconomico','ResumenEconomicoController@index');

                            //TABLA IGLESIA
                            Route::get('/iglesia','IglesiaController@index');
                            Route::put('/iglesia/registrar','IglesiaController@store');
                            Route::post('/iglesia/buscarIgle','IglesiaController@buscar');
                            Route::put('/iglesia/actualizar','IglesiaController@update');
                            Route::put('/iglesia/eliminar','IglesiaController@eliminar');
                            
            });

});

//Route::get('/home', 'HomeController@index')->name('home');
