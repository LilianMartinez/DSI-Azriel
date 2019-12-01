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
                            Route::get('/efectivo/listarPdfGeneral','EfectivoController@listarPdfGeneral')->name('efectivos_pdf'); //general actual
                            Route::get('/efectivo/listarPdfResumido','ResumenEconomicoController@listarPdfResumido')->name('efectivos_pdfR'); //resumido actual
                            Route::get('/efectivo/buscarResumen','EfectivoController@buscarResumen');
                            
                            
                            //TABLA MONTO FIJO
                            Route::get('/montofijo','MontoFijoController@index');
                            Route::put('/montofijo/registrar','MontoFijoController@store');
                            Route::post('/montofijo/buscarmf','MontoFijoController@buscar');
                            Route::put('/montofijo/actualizar','MontoFijoController@update');
                            Route::put('/montofijo/eliminar','MontoFijoController@eliminar');

                            //TABLA BAUTIZO
                            Route::get('/bautizo','BautizoController@index');
                            Route::put('/bautizo/registrar','BautizoController@store');
                            Route::put('/nota/marginaracta','BautizoController@marginar');
                           
                            //TABLA NOTA MARGINAL
                            

                            //TABLA confirma
                            Route::put('/confirma/registrar','ConfirmaController@store');
                            Route::put('/confirma/marginaracta','BautizoController@marginacionacta');


                            //TABLA PERSONA
                            Route::get('/persona/obtener','PersonaController3@realizante');
                            Route::get('/persona/duis','PersonaController3@buscarduis');
                            Route::get('/persona/pan','PersonaController3@show');
                            Route::put('/persona/registrar','PersonaController3@store');
                            Route::get('/persona/listar','PersonaController3@lista');
                            

                            //TABLA PARTIDA NACIMIENTO
                            Route::get('/partida/busqueda','PartidaNacimientoController2@realizante');

                            //TABLA PERSONA
                            Route::get('/persona/obtener','PersonaController@realizante');
                            Route::get('/persona/buscarsacerdote3','PersonaController@buscarsacerdote');
                            Route::get('/persona/duis','PersonaController@buscarduis');
                            Route::get('/persona/pan','PersonaController@show');
                            Route::put('/persona/registrar','PersonaController@store'); 
                            Route::get('/persona/listarcomuniones','PersonaController@listaPC');//para el realizante
                            Route::get('/persona/listarconfirmaciones','PersonaController@listaC');//para el realizante
                            Route::get('/persona/listarsupletorias','PersonaController@listaS');//para el realizante

                            Route::get('/persona/duihombre','PersonaController2@buscarduihombre');//este se utiliza para novio, padrinos y sacerdote
                            Route::get('/persona/duimujer','PersonaController2@buscarduimujer');//este se utiliza para novia y madrinas
                            Route::put('/persona/registrar2','PersonaController2@store');//Modificado para poder registrar nuevo expediente matrimonial
                            Route::put('/persona/actualizar2','PersonaController2@update');
                            Route::get('persona/buscariglesia','PersonaController2@buscariglesia');

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
                            Route::get('/resumeneconomico/buscarAM','ResumenEconomicoController@buscarAM');

                            

                            //TABLA IGLESIA
                            Route::get('/iglesia','IglesiaController@index');
                            Route::put('/iglesia/registrar','IglesiaController@store');
                            Route::post('/iglesia/buscarIgle','IglesiaController@buscar');
                            Route::put('/iglesia/actualizar','IglesiaController@update');
                            Route::put('/iglesia/eliminar','IglesiaController@eliminar');

                            //TABLA Producto
                            Route::get('/producto','ProductoController@index');
                            Route::get('/productos/v','ProductoController@indexv');
                            Route::get('/productos/venta','ProductoController@venta');
                            Route::get('/producto/seleccionar','ProductoController@seleccionarProducto');
                            Route::get('/producto/canasta','ProductoController@seleccionarProductoCanasta');
                            Route::put('/producto/registrar','ProductoController@store');
                            Route::put('/venta/registrar','ProductoController@guardarventa');
                            Route::put('/producto/actualizar','ProductoController@update');
                            Route::put('/producto/eliminar','ProductoController@eliminar');
                            Route::get('/producto/existencia','ProductoController@seleccionarProductoExistencia');
                            Route::get('/producto/informe','ProductoController@ConsultaInforme');
                          

                             //TABLA Compras
                             Route::get('/compras','DetalleEntradaController@index');
                             Route::put('/compras/registrar','DetalleEntradaController@store');

                             //TABLA Canastas
                             Route::get('/canastas','CanastasController@index');
                             Route::put('/canastas/registrar','CanastasController@store');
                             Route::get('/canastas/detalle','CanastasController@Buscar');
                             Route::put('/canastas/vender','CanastasController@vender');
                             
                            
                            //Tabla Sacramento
                            Route::get('/sacramento','SacramentoController@index');
                            Route::get('/sacramentoplus','SacramentoController@index'); //POR SI ACASO... LUEGO DEBEMOS CAMBIAR LA "BUSQUEDA" AL INDEX DE PERSONA
                            Route::get('/sacramento/storematrimonio1','SacramentoController@storeMatrimonio1');// Metodo para guardar matrimonio paso1
                            Route::post('/sacramento/registrar','SacramentoController@store');
                            Route::put('/sacramento/registrarboda','SacramentoController@registrarboda');
                            Route::put('/sacramento/actualizar','SacramentoController@update');
                            Route::put('/sacramento/activarexpediente','SacramentoController@activarexpediente');
                            Route::put('/sacramento/desactivarexpediente','SacramentoController@desactivarexpediente');
                            //Route::put('/sacramento/finalizarexpediente','SacramentoController@finalizarexpediente');

                            //Certificados
                            Route::put('/persona/registrarImpresion','PersonaController2@registrarImpresion');
                            Route::put('/persona/eliminarDatosImpresion','PersonaController2@eliminarDatosImpresion');
                                    //Matrimonio
                            Route::get('/persona/certificadoMatri/{id}','PersonaController2@certificadoMatri')->name('matrimonio_pdf');
                            Route::put('/persona/certificadoMatri','PersonaController2@certificadoMatri');

                                    //Bautizo
                            Route::get('/persona/certificadoBautizo/{id}/{id_padre}/{id_madre}','PersonaController2@certificadoBautizo')->name('bautizo_pdf');
                            Route::put('/persona/certificadoBautizo','PersonaController2@certificadoBautizo');

                                    //Primera Comunion
                            Route::get('/persona/certificadoPrimeraComunion/{id}/{id_padre}/{id_madre}','PersonaController2@certificadoPrimeraComunion')->name('primeracomunion_pdf');
                            Route::put('/persona/certificadoPrimeraComunion','PersonaController2@certificadoPrimeraComunion');

                                    //Confirma
                            Route::get('/persona/certificadoConfirma/{id}/{id_padre}/{id_madre}/{id_realizante1}','PersonaController2@certificadoConfirma')->name('confirma_pdf');
                            Route::put('/persona/certificadoConfirma','PersonaController2@certificadoConfirma');

                            //TABLA ZONAS
                            Route::get('/zona','ZonaController@index');
                            Route::put('/zona/registrar','ZonaController@store');
                            Route::put('/zona/actualizar','ZonaController@update');
                            Route::put('/zona/eliminar','ZonaController@eliminar');
                            Route::get('/zona/buscarZona','ZonaController@buscarZona');

                            //TABLA DE MANTENIMIENTO DE CATEGORIA DE INVENTARIOS PARA IGLESIAS
                            Route::get('/categoriainventario','CategoriaInventarioController@index');
                            Route::put('/categoriainventario/registrar','CategoriaInventarioController@store');
                            Route::put('/categoriainventario/actualizar','CategoriaInventarioController@update');
                            Route::put('/categoriainventario/eliminar','CategoriaInventarioController@eliminar');
                            
                            //FELIGRESES--De la tabla PERSONA
                            Route::get('/feligreses','FeligresController@index');
                            Route::put('/feligreses/registrar','FeligresController@store');
                            Route::put('/feligreses/update','FeligresController@update');
                            Route::post('/feligreses/buscarIglesia','FeligresController@buscarIglesia');
                            Route::put('/feligreses/eliminar','FeligresController@eliminar');

                            //TABLA DE INVENTARIO DE IGLESIAS
                            Route::get('/productoinv','ProductoInventarioController@index');
                            Route::put('/productoinv/registrar','ProductoInventarioController@store');
                            Route::put('/productoinv/actualizar','ProductoInventarioController@actualizar');
                            Route::post('/productoinv/buscarIglesia','FeligresController@buscarIglesia');
                            Route::get('/categoriainventario/buscarCateInve','CategoriaInventarioController@buscar');

                            //TABLA PARA CONTROL SECTORIAL
                            Route::post('/sectorial/buscarIglesiaFeligreses','ControlSectorialController@buscarIglesiaFeligreses');
                            Route::post('/sectorial/buscarIglesiaInventarios','ControlSectorialController@buscarIglesiaInventarios');


                            
            });

});

//Route::get('/home', 'HomeController@index')->name('home');
