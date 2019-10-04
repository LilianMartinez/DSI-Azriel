<template>
   <main class="main">
            <!-- Breadcrumb -->
            <div class="container-fluid">
            <!-- tiululo -->
                <div class="card">
                    <div class="card-header">
                        <label class="titulo-encabezados">Registro de acta de bautizo</label>
                    </div>
                    <!-- cuerpo -->
                    <div class="card-body">
                        <div v-show="cambiarm==0 || cambiarm==12">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos de partida de nacimiento</b></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Alcaldia</label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="alcaldia" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Libro<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="libro" class="form-control" placeholder="# de Libro">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Partida<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="partida" class="form-control" placeholder="# de Partida">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Folio<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="folio" class="form-control" placeholder="# de folio">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Año<b class="alerta">*</b></label>
                                <div class="col-md-4">
                                    <input type="text" tabindexgt="0" v-model="anio" class="form-control" placeholder="9999">
                                </div>
                            </div>
                            <div class="col-md-4 modal-fo">
                                <button type="button" class="btn btn-secondary" @click="siguiente('1')">Siguiente</button>
                            </div>  
                        </div>
                        <div v-show="cambiarm==1 || cambiarm==11">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos generales del realizante</b></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombres<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="nombrerealizante" class="form-control" placeholder="Nombres del que ha recibido el sacramento">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Apellidos<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="apellidorealizante" class="form-control" placeholder="Apellidos del que ha recibido el sacramento">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Sexo<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <table>
                                        <tr> <input tabindexgt="-1" type="radio" v-model="sexo" value="F" name="sexo">Femenino</tr>
                                        <tr> <input tabindexgt="-1" type="radio" v-model="sexo" value="M" name="sexo">Masculino</tr>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha de Nacimiento<b class="alerta">*</b></label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control datepicker" name="date" v-model="fechana"  @keydown.tab="cambiar()">
                                </div>
                            </div>
                            <div class="form-group row" v-show="Acciondui==1">
                                <label class="col-md-3 form-control-label" for="text-input">DUI</label>
                                <div class="col-md-5">
                                    <input tabindexgt="0" v-model="dui" class="form-control" placeholder="999999999">
                                </div>
                            </div>
                            <div class="col-md-4 modal-fo">
                                <button type="button" class="btn btn-secondary" @click="siguiente('12')">Regresar</button>
                                <button type="button" class="btn btn-secondary" @click="siguiente('2')">Siguiente</button>
                            </div>  
                        </div>
                        <div v-show="cambiarm==2 || cambiarm==10">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos de los padres</b></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos de la madre</b></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">DUI</label>
                                <div class="col-md-5">
                                    <input tabindexgt="0" v-model="duimadre" class="form-control" placeholder="999999999"  @keydown.tab="duim()" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombres<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="nombremadre" class="form-control" placeholder="Nombres de la madre">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Apellidos<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="apellidomadre" class="form-control" placeholder="Apellidos de la madre">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos del padre</b></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">DUI</label>
                                <div class="col-md-5">
                                    <input tabindexgt="0" v-model="duipadre" class="form-control" placeholder="999999999" @keydown.tab="duip()">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombres</label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="nombrepadre" class="form-control" placeholder="Nombres del padre">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Apellidos</label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="apellidopadre" class="form-control" placeholder="Apellidos del padre">
                                </div>
                            </div>
                            <div class="col-md-5 modal-fo">
                                <button type="button" class="btn btn-secondary" @click="siguiente('11')">Regresar</button>
                                <button type="button" class="btn btn-primary" @click="siguiente('3')">Siguiente</button>
                            </div> 
                        </div>
                        <div v-show="cambiarm==3 || cambiarm==9">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos de los padrinos</b></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos del padrino 1</b></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">DUI</label>
                                <div class="col-md-5">
                                    <input tabindexgt="0" v-model="duipd1" class="form-control" placeholder="999999999"  @keydown.tab="duip1()" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombres<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="nombrepd1" class="form-control" placeholder="Nombres del padrino 1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Apellidos<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="apellidopd1" class="form-control" placeholder="Apellidos del padrino 1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Sexo<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <table>
                                        <tr> <input tabindexgt="-1" type="radio" v-model="sexopd1" value="F" name="sexo">Femenino</tr>
                                        <tr> <input tabindexgt="-1" type="radio" v-model="sexopd1" value="M" name="sexo">Masculino</tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-5 modal-fo">
                                <button type="button" class="btn btn-secondary" @click="siguiente('10')">Regresar</button>
                                <button type="button" class="btn btn-primary" @click="siguiente('4')">Nuevo padrino</button>
                                <button type="button" class="btn btn-primary" @click="siguiente('7')">Continuar</button>
                            </div>
                        </div>
                        <div v-show="cambiarm==4 || cambiarm==9">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos del padrino 2</b></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">DUI</label>
                                <div class="col-md-5">
                                    <input tabindexgt="0" v-model="duipd2" class="form-control" placeholder="999999999" @keydown.tab="duip2()">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombres</label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="nombrepd2" class="form-control" placeholder="Nombres del padrino 2">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Apellidos</label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="apellidopd2" class="form-control" placeholder="Apellidos del padrino 2">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Sexo<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <table>
                                        <tr> <input tabindexgt="-1" type="radio" v-model="sexopd2" value="F" name="sexo">Femenino</tr>
                                        <tr> <input tabindexgt="-1" type="radio" v-model="sexopd2" value="M" name="sexo">Masculino</tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-5 modal-fo">
                                <button type="button" class="btn btn-secondary" @click="siguiente('10')">Regresar</button>
                                <button type="button" class="btn btn-primary" @click="siguiente('5')">Nuevo Padrino</button>
                                <button type="button" class="btn btn-primary" @click="siguiente('7')">Continuar</button>
                            </div> 
                        </div>
                        <div v-show="cambiarm==5 || cambiarm==9">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos de los padrinos</b></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos del padrino 3</b></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">DUI</label>
                                <div class="col-md-5">
                                    <input tabindexgt="0" v-model="duipd3" class="form-control" placeholder="999999999"  @keydown.tab="duip3()" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombres<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="nombrepd3" class="form-control" placeholder="Nombres del padrino 3">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Apellidos<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="apellidopd3" class="form-control" placeholder="Apellidos del padrino 3">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Sexo<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <table>
                                        <tr> <input tabindexgt="-1" type="radio" v-model="sexopd3" value="F" name="sexo">Femenino</tr>
                                        <tr> <input tabindexgt="-1" type="radio" v-model="sexopd3" value="M" name="sexo">Masculino</tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-5 modal-fo">
                                <button type="button" class="btn btn-secondary" @click="siguiente('10')">Regresar</button>
                                <button type="button" class="btn btn-primary" @click="siguiente('6')">Nuevo Padrino</button>
                                <button type="button" class="btn btn-primary" @click="siguiente('7')">Continuar</button>
                            </div> 
                        </div>
                        <div v-show="cambiarm==6 || cambiarm==9">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos del padrino 4</b></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">DUI</label>
                                <div class="col-md-5">
                                    <input tabindexgt="0" v-model="duipd4" class="form-control" placeholder="999999999" @keydown.tab="duip4()">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombres</label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="nombrepd4" class="form-control" placeholder="Nombres del padrino 4">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Apellidos</label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="apellidopd4" class="form-control" placeholder="Apellidos del padrino 4">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Sexo<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <table>
                                        <tr> <input tabindexgt="-1" type="radio" v-model="sexopd4" value="F" name="sexo">Femenino</tr>
                                        <tr> <input tabindexgt="-1" type="radio" v-model="sexopd4" value="M" name="sexo">Masculino</tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-5 modal-fo">
                                <button type="button" class="btn btn-secondary" @click="siguiente('10')">Regresar</button>
                                <button type="button" class="btn btn-primary" @click="siguiente('7')">Siguiente</button>
                            </div> 
                        </div>
                        <div v-show="cambiarm==7">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos de la celebración</b></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Libro</label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="librob" class="form-control" placeholder="# de libro">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Folio</label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="foliob" class="form-control" placeholder="# de folio">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Asiento</label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="asiento" class="form-control" placeholder="# de asiento">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Ofrenda</label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="monto" class="form-control" placeholder="Monto">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre del sacerdote<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha de realización<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <input type="date" class="form-control datepicker" name="date" v-model="fecharealizacion" >
                                </div>
                            </div>
                            <div v-show="cambiarmb==1">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-secondary" @click="siguiente('10')">Regresar</button>
                                    <button type="button" class="btn btn-secondary" @click="cerrarm()">Cancelar</button>
                                    <button type="submit"  class="btn btn-primary" @click="abrirmodal()">Guardar</button>
                                </div>
                            </div>
                            <div v-show="cambiarmb==0">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-secondary" @click="cerrarm()">Cancelar</button>
                                    <button type="submit"  class="btn btn-primary" @click="abrirmodal()">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--fin del formulario-->
            <!--Inicio del modal mostrar-->
            <div class="modal fade"  tabindex="-1" :class="{'mostrar': modal}" role="dialog" aria-labelledby="myModalLabel" style="overflow-y: scroll;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button"  class="close" @click="cerrarmodal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label class="col-md-6 form-control-label" ><b>{{nombrerealizante}}, {{apellidorealizante}}</b></label>
                                    </div>
                                    <div v-show="accionsexo==0">
                                        <div v-show="accion==0">
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input"> Hija de: </label>
                                                <label class="col-md-6 form-control-label" >{{nombrepadre}}, {{apellidopadre}}</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Y de:</label>
                                                <label class="col-md-6 form-control-label" >{{nombremadre}}, {{apellidomadre}}</label>
                                            </div>
                                        </div>
                                        <div v-show="accion==1">
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Hija de:</label>
                                                <label class="col-md-6 form-control-label" >{{nombremadre}}, {{apellidomadre}}</label>
                                            </div>
                                        </div>
                                        <div v-show="accion==2">
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Hija de:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepadre}}, {{apellidopadre}}</label>
                                            </div>
                                        </div>
                                         <div v-show="accionp==4">
                            
                                        </div>
                                        <div v-show="accionp==5">
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd1}}, {{apellidopd1}}</label>
                                            </div>
                                        </div>
                                        <div v-show="accionp==6">
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd1}}, {{apellidopd1}}</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd2}}, {{apellidopd2}}</label>
                                            </div>
                                        </div>
                                        <div v-show="accionp==7">
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd1}}, {{apellidopd1}}</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd2}}, {{apellidopd2}}</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd3}}, {{apellidopd3}}</label>
                                            </div>
                                        </div>
                                        <div v-show="accionp==8">
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd1}}, {{apellidopd1}}</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd2}}, {{apellidopd2}}</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd3}}, {{apellidopd3}}</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd4}}, {{apellidopd4}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-show="accionsexo==1">
                                        <div v-show="accion==0">
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input"> Hijo de: </label>
                                                <label class="col-md-6 form-control-label" >{{nombrepadre}}, {{apellidopadre}}</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Y de:</label>
                                                <label class="col-md-6 form-control-label" >{{nombremadre}}, {{apellidomadre}}</label>
                                            </div>
                                        </div>
                                        <div v-show="accion==1">
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Hijo de:</label>
                                                <label class="col-md-6 form-control-label" >{{nombremadre}}, {{apellidomadre}}</label>
                                            </div>
                                        </div>
                                        <div v-show="accion==2">
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Hijo de:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepadre}}, {{apellidopadre}}</label>
                                            </div>
                                        </div>
                                       <div v-show="accionp==4">
                            
                                        </div>
                                        <div v-show="accionp==5">
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd1}}, {{apellidopd1}}</label>
                                            </div>
                                        </div>
                                        <div v-show="accionp==6">
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd1}}, {{apellidopd1}}</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd2}}, {{apellidopd2}}</label>
                                            </div>
                                        </div>
                                        <div v-show="accionp==7">
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd1}}, {{apellidopd1}}</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd2}}, {{apellidopd2}}</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd3}}, {{apellidopd3}}</label>
                                            </div>
                                        </div>
                                        <div v-show="accionp==8">
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd1}}, {{apellidopd1}}</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd2}}, {{apellidopd2}}</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd3}}, {{apellidopd3}}</label>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Padrino:</label>
                                                <label class="col-md-6 form-control-label" >{{nombrepd4}}, {{apellidopd4}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label" for="text-input">Fecha de nacimiento:</label>
                                        <label class="col-md-6 form-control-label" >{{fechana}}</label>
                                    </div>
                                    <div v-show="accionbotones==2">
                                        <div class="form-group row">
                                            <label class="col-md-4 form-control-label" for="text-input">Realizó su bautizo:</label>
                                            <label class="col-md-6 form-control-label" >{{fecharealizacion}}</label>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 form-control-label" for="text-input">Celebrada por:</label>
                                            <label class="col-md-6 form-control-label" > {{nombresacerdote}}</label>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Ofrenda</label>
                                            <label class="col-md-3 form-control-label" >{{monto}}</label>
                                        </div>
                                        <div class="col-md-4 modal-fo">
                                            <button type="button" class="btn btn-secondary" @click="cerrarmodal()">Modificar</button>
                                            <button type="submit"  class="btn btn-primary" @click="registrar()">Guardar</button>
                                        </div>
                                    </div>
                                    <div v-show="accionbotones==1">
                                        <div class="col-md-4 modal-fo">
                                            <button type="button" class="btn btn-secondary" @click="cerrar()">Cancelar</button>
                                            <button type="submit"  class="btn btn-primary" @click="siguiente('13')">Continuar</button>
                                        </div>
                                    </div>                         
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fin del modal -->
   
           
           
        </main>
</template>

<script>
export default {
    data (){
        return{
            id:'',
            tipo:'',
            folio:'',
            librob:'',
            foliob:'',
            libro:'',
            asiento:'',
            fecharealizacion:'',
            nombrerealizante:'',
            apellidorealizante:'',
            idmadre:'',
            idpadre:'',
            nombrepadre:'',
            apellidopadre:'',
            apellidomadre:'',
            nombremadre:'',
            dui:'',
            duimadre:'',
            duipadre:'',
            nombresacerdote:'',
            arraysacerdote:[],
            sexo:'',
            fechana:'',
            idpd1:'',
            idpd2:'',
            idpd3:'',
            idpd4:'',
            duipd1:'',
            duipd2:'',
            duipd3:'',
            duipd4:'',
            nombrepd1:'',
            apellidopd1:'',
            Acciondui:0,
            accion:0,
            accionp:0,
            accionsexo:0,
            cambiarm:0,
            cambiarmb:0,
            monto:0,
            arraybautizo:[],
            nombrepd2:'',
            apellidopd2:'',
            nombrepd3:'',
            apellidopd3:'',
            nombrepd4:'',
            apellidopd4:'',
            precio:0,
            modal:0,
            tituloModal:'',
            partida:'',
            tipoAccion:0,
            errorDatos:0,
            errorMostrarMjs:[],
            anio:'',
            verificacion:0,
            accionbotones:0,
            fechana2:'',
            alcaldia:'',
            id_realizante:'',
            sexopd1:'',
            sexopd2:'',
            sexopd3:'',
            sexopd4:'',
        }
    },

    methods:{
            //Mt. para calcular edad y ver si se muestra o no el div que contiene el dui del realizante
        cambiar(){ 
            var values=this.fechana.split("-");
            var dia = values[2];
            var mes = values[1];
            var anio = values[0];
            if((dia=='') || (mes=='') || (anio==''))
            {
                this.Acciondui=0;
            }else
            {
 
            // cogemos los valores actuales
                var fecha_hoy = new Date();
                var ahora_anio = fecha_hoy.getYear();
                var ahora_mes = fecha_hoy.getMonth()+1;
                var ahora_dia = fecha_hoy.getDate();

                this.fechana2 = (ahora_anio + 1900) - anio;

                if ( ahora_mes < mes )
                {
                    this.fechana2--;
                }
                if ((mes == ahora_mes) && (ahora_dia < dia))
                {
                    this.fechana2--;
                }
                if (this.fechana2 > 1900)
                {
                     this.fechana2-= 1900;
                }
                if (this.fechana2 >= 18)  {
                    this.Acciondui=1;
                } else{
                    this.Acciondui=0;
                }
            }
        },

        //Para mostar las tres partes del formulario
        siguiente(d){
            switch(d){
                case '1':
                {
                    this.verificarpersona();  //datos del realizante
                    break;
                }
                case '2':
                {
                    this.cambiarm=2;   //datos de los padres
                    break;
                }
                case '3':
                {
                    this.cambiarm=3;  //padrino 1 
                    break;
                }
                case '4':
                {
                    this.cambiarm=4;   //padrino 2
                    break;
                }
                case '5':
                {
                    this.cambiarm=5;   //padrino 3
                    break;
                }
                case '6':
                {
                    this.cambiarm=6;   //padrino 4
                    break;
                }
                case '7':
                {
                    this.cambiarm=7;   //datos de la celebracion
                    break;
                } 
                case '8':
                {
                    this.cambiarm=8;  //regresar a 5
                    break;
                }
                case '9':
                {
                    this.cambiarm=9;  //regresar a 4
                    break;
                }
                case '10':
                {
                    this.cambiarm=10;  //regresar a 3
                    break;
                }
                case '11':
                {
                    this.cambiarm=11;  //regresar a 2
                    break;
                }
                case '12':
                {
                    this.cambiarm=12;  //regresar a 2
                    break;
                }
                case '13':
                {
                    this.cambiarm=3;
                    this.modal=0;
                    break;
                }  

            }

        },
            //Mt. cuando da eliminar en el formulario
        cerrar(){
            this.precio=0;
            this.nombrerealizante='';
            this.apellidorealizante='';
            this.nombremadre='';
            this.apellidomadre='';
            this.duimadre='';
            this.nombrepadre='';
            this.apellidopadre='';
            this.duipadre='';
            this.duipd1='';
            this.duipd2='';
            this.duipd3='';
            this.duipd4='';
            this.nombrepd1='';
            this.apellidopd1='';
            this.nombrepd2='';
            this.apellidopd2='';
            this.nombrepd3='';
            this.apellidopd3='';
            this.nombrepd4='';
            this.apellidopd4='';
            this.nombresacerdote='';
            this.fecharealizacion='';
            this.fechana='';
            this.dui='';
            this.Acciondui=0;
            this.accion=0;
            this.accionp=0;
            this.accionbotones=0;
            this.modal=0;
            this.sexo='';
            this.id='';
            this.verificacion=0;
            this.cambiarm=0;
            this.cambiarmb=0;
            this.alcaldia='';
            this.librob='';
            this.foliob='';
            this.sexopd1='';
            this.sexopd2='';
            this.sexopd3='';
            this.sexopd4='';    

        },
        cerrarm(){ //botones cancelat
            this.precio=0;
            this.nombrerealizante='';
            this.apellidorealizante='';
            this.nombremadre='';
            this.apellidomadre='';
            this.duimadre='';
            this.duipadre='';
            this.nombrepadre='';
            this.apellidopadre='';
            this.duipd1='';
            this.duipd2='';
            this.duipd3='';
            this.duipd4='';
            this.nombrepd1='';
            this.apellidopd1='';
            this.nombrepd2='';
            this.apellidopd2='';
            this.nombrepd3='';
            this.apellidopd3='';
            this.nombrepd4='';
            this.apellidopd4='';
            this.nombresacerdote='';
            this.fecharealizacion='';
            this.fechana='';
            this.dui='';
            this.accion=0;
            this.accionp=0;
            this.accionbotones=0;
            this.modal=0;
            this.sexo='';
            this.id='';
            this.alcaldia='';
            this.libro='';
            this.partida='';
            this.folio='';
            this.anio='';
            this.idpadre='';
            this.idmadre='';
            this.verificacion=0;
            this.cambiarm=0;
            this.cambiarmb=0;
            this.librob='';
            this.foliob='';
            this.sexopd1='';
            this.sexopd2='';
            this.sexopd3='';
            this.sexopd4='';       

        },
            //Mt. cuando le da modificar en el modal
        cerrarmodal(){
            this.modal=0;
        },

        abrirmodal(){
                this.modal=1;
                this.tituloModal='Confirmar ingreso'
                this.accionbotones=2;
                //Si es F o M
                if (this.sexo == 'M')   {
                    this.accionsexo=1;
                }
                if (this.sexo == 'F')   {
                    this.accionsexo=0;
                }
                //Si no tiene datos del padre
                if (this.nombrepadre == '')   {
                    this.accion=1;
                }
                //Si no tiene datos de la madre
                if (this.nombremadre == '')  {
                    this.accion=2;
                }
                if ((this.nombremadre == '') && (this.nombrepadre == ''))  {
                    this.accion=0;
                }
                if ((this.nombrepd1 == '') && (this.nombrepd2=='') && (this.nombrepd3=='') && (this.nombrepd4==''))    {
                    this.accionp=4;
                }
                if ((this.nombrepd1 != '') && (this.nombrepd2=='') && (this.nombrepd3=='') && (this.nombrepd4==''))    {
                    this.accionp=5;
                }if ((this.nombrepd1 != '') && (this.nombrepd2!='') && (this.nombrepd3=='') && (this.nombrepd4==''))    {
                    this.accionp=6;
                }
                if ((this.nombrepd1 != '') && (this.nombrepd2!='') && (this.nombrepd3!='') && (this.nombrepd4==''))    {
                    this.accionp=7;
                }
                if ((this.nombrepd1 != '') && (this.nombrepd2!='') && (this.nombrepd3!='') && (this.nombrepd4!=''))    {
                    this.accionp=8;
                }

            },

            abrirmodal2(){
                this.modal=1;
                this.tituloModal='Confirmar datos'
                this.accionbotones=1;
                //Si es F o M
                if (this.sexo == 'M')   {
                    this.accionsexo=1;
                    var_dump(sexo);
                }
                if (this.sexo == 'F')   {
                    this.accionsexo=0;
                }
                //Si no tiene datos del padre
                if (this.nombrepadre == '')   {
                    this.accion=1;
                }
                //Si no tiene datos de la madre
                if (this.nombremadre == '')  {
                    this.accion=2;
                }
                if ((this.nombremadre == '') && (this.nombrepadre == ''))  {
                    this.accion=0;
                }
                if ((this.nombrepd1 == '') && (this.nombrepd2=='') && (this.nombrepd3=='') && (this.nombrepd4==''))    {
                    this.accion=4;
                }               

            },

            

            llenarmodal(id){
                let me=this;
                var url='/persona/obtener?id=' + id;
                    axios.get(url) .then(function (response) {
                        var d = response.data.solo;            
                        if(d==1){
                            me.nombrerealizante= response.data.realizante.nombre_persona;
                            me.apellidorealizante=response.data.realizante.apellido_persona;
                            me.sexo=response.data.realizante.sexo;
                            me.fechana=response.data.realizante.fecha_nacimiento;
                        }
                        if(d==2){
                            me.nombrepadre= response.data.padre.nombre_persona;
                            me.apellidopadre=response.data.padre.apellido_persona;
                            me.nombrerealizante= response.data.realizante.nombre_persona;
                            me.apellidorealizante=response.data.realizante.apellido_persona;
                            me.sexo=response.data.realizante.sexo;
                            me.fechana=response.data.realizante.fecha_nacimiento;
                        }
                        if(d==3){
                            me.nombremadre= response.data.madre.nombre_persona;
                            me.apellidomadre=response.data.madre.apellido_persona;
                            me.nombrerealizante= response.data.realizante.nombre_persona;
                            me.apellidorealizante=response.data.realizante.apellido_persona;
                            me.sexo=response.data.realizante.sexo;
                            me.fechana=response.data.realizante.fecha_nacimiento;
                        }
                        if(d==4){
                            me.nombrepadre= response.data.padre.nombre_persona;
                            me.apellidopadre=response.data.padre.apellido_persona;
                            me.nombremadre= response.data.madre.nombre_persona;
                            me.apellidomadre=response.data.madre.apellido_persona;
                            me.nombrerealizante= response.data.realizante.nombre_persona;
                            me.apellidorealizante=response.data.realizante.apellido_persona;
                            me.sexo=response.data.realizante.sexo;
                            me.fechana=response.data.realizante.fecha_nacimiento;
                        }
                        me.verificacion=1;
                        me.abrirmodal2();
                    }).catch(function (error) {
                    console.log(error);
                    });

            },

            registrar(){
               
                let me=this;
              
                
                var m=this.idmadre;
                var p=this.idpadre;
                var duim=this.duimadre;
                var duip=this.duipadre;
                var pd1 = this.idpd1;
                var pd2 = this.idpd2;
                var pd3 = this.idpd3;
                var pd4 = this.idpd4;
                var dp1 = this.duipd1;
                var dp2 = this.duipd2;
                var dp3 = this.duipd3;
                var dp4 = this.duipd4;
                if(m!='' && p!='' && pd1!='' && pd2!='' && pd3!='' && pd4!=''){ //introduje los duis
                    this.tipo=1;
                }
                if(m!='' && p!='' && pd1!='' && pd2!='' && pd3=='' && pd4==''){ // introduje los duis pero padrino 3 y 4 no esta
                    this.tipo=2;
                }
                if(m!='' && p!='' && pd1!='' && pd2!='' && pd3!='' && pd4==''){ // introduje los duis pero padrino 4 no esta
                    this.tipo=3;
                }
                if(m!='' && p!='' && pd1!='' && pd2=='' && pd3=='' && pd4==''){  // introduje los duis pero padrino 2, 3 y 4 no esta
                    this.tipo=4;
                }
                if(m!='' && p=='' && pd1!='' && pd2!='' && pd3=='' && pd4==''){  // introduje los duis pero papa no esta y padrino 3 y 4 no estan
                    this.tipo=5;
                }
                if(m!='' && p=='' && pd1!='' && pd2!='' && pd3!='' && pd4==''){  // introduje los duis pero papa y padrino 4 no estan
                    this.tipo=6;
                }
                if(m!='' && p=='' && pd1!='' && pd2=='' && pd3=='' && pd4==''){  // introduje los duis pero papa y padrino 2, 3 y 4 no estan
                    this.tipo=7;
                }
                if(m!='' && p=='' && pd1!='' && pd2!='' && pd3!='' && pd4!=''){  // introduje los duis pero papa no esta
                    this.tipo=8;
                }
                if(m=='' && p!='' && pd1!='' && pd2!='' && pd3!='' && pd4!=''){  // introduje los duis pero mama no esta
                    this.tipo=9;
                }
                if(m=='' && p!='' && pd1!='' && pd2!='' && pd3!='' && pd4==''){ // introduje los duis pero mama y padrino 4 no esta
                    this.tipo=10;
                }
                if(m=='' && p!='' && pd1!='' && pd2!='' && pd3=='' && pd4==''){  // introduje los duis pero mama y padrino 3 y 4 no esta
                    this.tipo=11;
                }
                if(m=='' && p!='' && pd1!='' && pd2=='' && pd3=='' && pd4==''){  // introduje los duis pero mama y padrino 2, 3 y 4 no esta
                    this.tipo=12;
                }
                if(m=='' && p=='' && pd1=='' && pd2=='' && pd3=='' && pd4==''){  // introduje los duis pero ninguno esta
                    this.tipo=13;
                }
                if(m=='' && p=='' && pd1!='' && pd2!='' && pd3!='' && pd4!=''){  // introduje los duis pero mama y papa no estan
                    this.tipo=14;
                }
                if(m=='' && p=='' && pd1!='' && pd2!='' && pd3!='' && pd4==''){  // introduje los duis pero mama, papa y padrino 4 no esta
                    this.tipo=15;
                }
                if(m=='' && p=='' && pd1!='' && pd2!='' && pd3=='' && pd4==''){  // introduje los duis pero mama, papa, padrino 3 y 4 no esta
                    this.tipo=16;
                }
                if(m=='' && p=='' && pd1!='' && pd2=='' && pd3=='' && pd4==''){ // introduje los duis pero mama, papa, padrino 2, 3 y 4 no esta
                    this.tipo=17;
                }
                if(m!='' && p!='' && pd1!='' && pd2!='' && pd3!='' && dp4==''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=18;
                }
                if(m!='' && p!='' && pd1!='' && pd2!='' && dp3=='' && dp4==''){ // introduje los duis pero no hay datos de padrino 3 y 4
                    this.tipo=19;
                }
                if(m!='' && p!='' && pd1!='' && dp2=='' && dp3=='' && dp4==''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=20;
                }
                if(m!='' && p!='' && dp1=='' && dp2=='' && dp3=='' && dp4==''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=21;
                }
                if(m!='' && duip=='' && pd1!='' && pd2!='' && pd3!='' && pd4!=''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=22;
                }
                if(m!='' && duip=='' && pd1!='' && pd2!='' && pd3!='' && dp4==''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=23;
                }
                if(m!='' &&duip=='' && pd1!='' && pd2!='' && dp3=='' && dp4==''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=24;
                }
                if(m!='' && duip=='' && pd1!='' && dp2=='' && dp3=='' && dp4==''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=25;
                }
                if(m!='' && duip=='' && dp1=='' && dp2=='' && dp3=='' && dp4==''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=26;
                }
                if(duim=='' && p!='' && pd1!='' && pd2!='' && pd3!='' && pd4!=''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=27;
                }
                if(duim=='' && p!='' && pd1!='' && pd2!='' && pd3!='' && dp4==''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=28;
                }
                if(duim=='' && p!='' && pd1!='' && pd2!='' && dp3=='' && dp4==''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=29;
                }
                if(duim=='' && p!='' && pd1!='' && dp2=='' &&dp3=='' && dp4==''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=30;
                }
                if(duim=='' && duip=='' && dp1=='' && dp2=='' && dp3=='' && dp4==''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=31;
                }
                if(duim=='' && duip=='' && pd1!='' && pd2!='' && pd3!='' &&pd4!=''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=32;
                }
                if(duim=='' && duip=='' && pd1!='' &&pd2!='' && pd3!='' && dp4==''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=33;
                }
                if(duim=='' && duip=='' && pd1!='' && pd2!='' && dp3=='' && dp4==''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=34;
                }
                if(duim=='' && duip=='' &&pd1!='' && dp2=='' && dp3=='' && dp4==''){ // introduje los duis pero no hay datos de padrino 4
                    this.tipo=35;
                }
                    axios.put('/bautizo/registrar',{
                        'tipo':this.tipo,
                        'nombre_m': this.nombremadre.toUpperCase(),
                        'apellido_m': this.apellidomadre.toUpperCase(),
                        'dui_m':this.duimadre,
                        'id_m':this.idmadre,
                        'nombre_p': this.nombrepadre.toUpperCase(),
                        'apellido_p': this.apellidopadre.toUpperCase(),
                        'dui_p':this.duipadre,
                        'id_p':this.idpadre,
                        'nombre_reali': this.nombrerealizante.toUpperCase(),
                        'apellido_reali': this.apellidorealizante.toUpperCase(),
                        'dui_reali':this.dui,
                        'sexo':this.sexo,
                        'dui_pd3':this.duipd3,
                        'fecha' : this.fecharealizacion,
                        'sacerdote' :this.nombresacerdote,
                        'id_pd1' :this.idpd1,
                        'id_pd2' : this.idpd2,
                        'id_pd3' : this.idpd3,
                        'id_pd4' :this.idpd4,
                        'dui_pd4':this.duipd4,
                        'nombre_pd1':this.nombrepd1.toUpperCase(),
                        'apellido_pd1':this.apellidopd1.toUpperCase(),
                        'nombre_pd2':this.nombrepd2.toUpperCase(),
                        'apellido_pd2':this.apellidopd2.toUpperCase(),
                        'nombre_pd3':this.nombrepd3.toUpperCase(),
                        'apellido_pd3':this.apellidopd3.toUpperCase(),
                        'nombre_pd4':this.nombrepd4.toUpperCase(),
                        'apellido_pd4':this.apellidopd4.toUpperCase(),
                        'nacimiento':this.fechana,
                        'alcaldia': this.alcaldia.toUpperCase(),
                        'libro':this.libro,
                        'partida':this.partida,
                        'folio':this.folio,
                        'ano':this.anio,
                        'librob':this.librob,
                        'foliob':this.foliob,
                        'asiento':this.asiento,
                        'sexo_pd1':this.sexopd1,
                        'sexo_pd2':this.sexopd2,
                        'sexo_pd3':this.sexopd3,
                        'sexo_pd4':this.sexopd4,
                }) .then(function (response) {
                    me.modal=0;
                    me.cambiarm=0;
               //     me.guardarsacramento();
                    me.cerrarm();
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

             //Buscar si ya hay datos del realizante
   
        verificarpersona(){
            let me=this;
            var alcaldia= this.alcaldia.toUpperCase();
            var libro= this.libro;
            var partida= this.partida;
            var folio= this.folio;
            var anio= this.anio;

            var url='/partida/busqueda?alcaldia=' + alcaldia + '&libro=' + libro + '&partida=' + partida + '&folio=' + folio + '&anio=' + anio;
            axios.get(url) .then(function (response) {
                var respuesta=response.data.solo;
                if(respuesta==1){
                    me.id=response.data.realizante.idpersona;
                    me.llenarmodal(me.id);
                }else{
                    me.cambiarm=1;
                    me.cambiarmb=1;
                }
                     
            }).catch(function (error) {
                console.log(error);
            });
        },

        llenarcamposm(data=[]){
            this.nombremadre= data['nombre_persona'];
            this.apellidomadre= data['apellido_persona'];
            this.idmadre=data['id'];
        },
        llenarcamposp(data=[]){
            this.nombrepadre= data['nombre_persona'];
            this.apellidopadre= data['apellido_persona'];
            this.idpadre=data['id'];
        },
        llenarcamposp1(data=[]){
            this.nombrepd1= data['nombre_persona'];
            this.apellidopd1= data['apellido_persona'];
            this.idpd1=data['id'];
        },
        llenarcamposp2(data=[]){
            this.nombrepd2= data['nombre_persona'];
            this.apellidopd2= data['apellido_persona'];
            this.idpd2=data['id'];
        },
        llenarcamposp3(data=[]){
            this.nombrepd3= data['nombre_persona'];
            this.apellidopd3= data['apellido_persona'];
            this.idpd3=data['id'];
        },
        llenarcamposp4(data=[]){
            this.nombrepd4= data['nombre_persona'];
            this.apellidopd4= data['apellido_persona'];
            this.idpd4=data['id'];
        },

        duim(){
            let me=this;
            var d= this.duimadre;

            if(d != ''){
                var url='/persona/duis?dui=' + d;
                axios.get(url) .then(function (response) {
                    var respuesta=response.data.solo;
                    var datos= response.data.persona;
                    if(respuesta==2){
                        me.llenarcamposm(datos);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        duip(){
            let me=this;
            var d=this.duipadre;
            if(d != ''){
                var url='/persona/duis?dui=' + d;
                axios.get(url) .then(function (response) {
                    var respuesta=response.data.solo;
                    var datos= response.data.persona;
                    if(respuesta==2){
                        me.llenarcamposp(datos);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
                    
        },
        duip1(){
            let me=this;
            var d=this.duipd1;
            if(d != ''){
                var url='/persona/duis?dui=' + d;
                axios.get(url) .then(function (response) {
                    var respuesta=response.data.solo;
                    var datos= response.data.persona;
                    if(respuesta==2){
                        me.llenarcamposp1(datos);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
                    
        },
        duip2(){
            let me=this;
            var d=this.duipd2;
            if(d != ''){
                var url='/persona/duis?dui=' + d;
                axios.get(url) .then(function (response) {
                    var respuesta=response.data.solo;
                    var datos= response.data.persona;
                    if(respuesta==2){
                        me.llenarcamposp2(datos);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
                    
        },
        duip3(){
            let me=this;
            var d=this.duipd3;
            if(d != ''){
                var url='/persona/duis?dui=' + d;
                axios.get(url) .then(function (response) {
                    var respuesta=response.data.solo;
                    var datos= response.data.persona;
                    if(respuesta==2){
                        me.llenarcamposp3(datos);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
                    
        },
        duip4(){
            let me=this;
            var d=this.duipd4;
            if(d != ''){
                var url='/persona/duis?dui=' + d;
                axios.get(url) .then(function (response) {
                    var respuesta=response.data.solo;
                    var datos= response.data.persona;
                    if(respuesta==2){
                        me.llenarcamposp4(datos);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
                    
        },
      
    }
}

</script>