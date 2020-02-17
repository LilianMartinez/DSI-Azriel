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
                        <div v-show="cambiarm==0 || cambiarm==14">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos de partida de nacimiento</b></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Alcaldía<b class="alerta">*</b></label>
                                <div class="col-md-4">
                                    <input type="text" tabindexgt="0" v-model="alcaldia" class="form-control" placeholder="Nombre de alcaldía"  @keydown.tab="validarvalores('1')">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Libro<b class="alerta">*</b></label>
                                <div class="col-md-4">
                                    <input type="text" tabindexgt="0" v-model="libro" class="form-control" placeholder="Número de libro" @keydown.tab="validarvalores('2')">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Partida<b class="alerta">*</b></label>
                                <div class="col-md-4">
                                    <input type="text" tabindexgt="0" v-model="partida" class="form-control" placeholder="Número de partida" @keydown.tab="validarvalores('3')">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Folio<b class="alerta">*</b></label>
                                <div class="col-md-4">
                                    <input type="text" tabindexgt="0" v-model="folio" class="form-control" placeholder="Número de folio" @keydown.tab="validarvalores('4')">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Año<b class="alerta">*</b></label>
                                <div class="col-md-2">
                                    <input type="text" tabindexgt="0" v-model="ano" class="form-control" placeholder="9999" @keydown.tab="validarvalores('5')">
                                </div>
                            </div>
                            <div v-show="errorDatos" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsj" :key="error" v-text="error"></div>
                                </div>
                            </div> 
                            <div class="col-md-4 modal-fo">
                                <button type="button" class="btn btn-primary" @click="siguiente('1')">Siguiente</button>
                            </div>  
                        </div>
                        <div v-show="cambiarm==1 || cambiarm==13">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos generales del realizante</b></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombres<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="nombrerealizante" class="form-control" placeholder="Nombres"  @keydown.tab="validarvalores('7')">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Apellidos<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="apellidorealizante" class="form-control" placeholder="Apellidos"  @keydown.tab="validarvalores('8')">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Sexo<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <table>
                                        <tr> <input tabindexgt="-1" type="radio" v-model="sexo" value="F" name="sexo">Femenino</tr>
                                        <tr> <input tabindexgt="-1" type="radio" v-model="sexo" value="M" name="sexo">Maculino</tr>
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
                                <div class="col-md-4">
                                    <input tabindexgt="0" v-model="dui" class="form-control" placeholder="999999999" @keydown.tab="validarvalores('11')">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Zona:</label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idzonar" @click="iglesiasr(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Iglesia:</label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idiglesiar"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesiar in arrayiglesiar" :key="iglesiar.id" v-bind:value="iglesiar.id" >{{iglesiar.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div v-show="errorDatos" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsj" :key="error" v-text="error"></div>
                                </div>
                            </div> 
                            <div class="col-md-4 modal-fo">
                                <button type="button" class="btn btn-secondary" @click="siguiente('14')">Regresar</button>
                                <button type="button" class="btn btn-primary" @click="siguiente('2')">Siguiente</button>
                            </div>  
                        </div>
                        <div v-show="cambiarm==2 || cambiarm==12">
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
                                <label class="col-md-3 form-control-label" for="text-input">Nombres</label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="nombremadre" class="form-control" placeholder="Nombres de la madre">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Apellidos</label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="apellidomadre" class="form-control" placeholder="Apellidos de la madre">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha de Nacimiento<b class="alerta">*</b></label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control datepicker" name="date" v-model="fechamadre"  @keydown.tab="validarvalores('fecm')">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Zona:</label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idzonam" @click="iglesiasm(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Iglesia:</label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idiglesiam"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesiam in arrayiglesiam" :key="iglesiam.id" v-bind:value="iglesiam.id" >{{iglesiam.nombre_iglesia}}</option>
                                        </select >
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
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha de Nacimiento<b class="alerta">*</b></label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control datepicker" name="date" v-model="fechapadre"  @keydown.tab="validarvalores('fecp')">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Zona:</label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idzonap" @click="iglesiasp(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Iglesia:</label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idiglesiap"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesiap in arrayiglesiap" :key="iglesiap.id" v-bind:value="iglesiap.id" >{{iglesiap.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div v-show="errorDatos" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsj" :key="error" v-text="error"></div>
                                </div>
                            </div>
                            <div class="col-md-5 modal-fo">
                                <button type="button" class="btn btn-secondary" @click="siguiente('13')">Regresar</button>
                                <button type="button" class="btn btn-primary" @click="siguiente('3')">Siguiente</button>
                            </div> 
                        </div>
                        <div v-show="cambiarm==3 || cambiarm==11"> <!-- aqui-->
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
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha de Nacimiento<b class="alerta">*</b></label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control datepicker" name="date" v-model="fechapad1"  @keydown.tab="validarvalores('fecp1')">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Zona:</label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idzonap1" @click="iglesiasp1(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Iglesia:</label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idiglesiap1"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesiap1 in arrayiglesiap1" :key="iglesiap1.id" v-bind:value="iglesiap1.id" >{{iglesiap1.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div v-show="errorDatos" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsj" :key="error" v-text="error"></div>
                                </div>
                            </div>
                            <div v-show="cambiarmb==1">
                                <div class="col-md-5 modal-fo">
                                    <button type="button" class="btn btn-secondary" @click="siguiente('12')">Regresar</button> <!--aqui 3-->
                                    <button type="button" class="btn btn-primary" @click="siguiente('4')">Agregar otro padrino</button>
                                    <button type="button" class="btn btn-primary" @click="siguiente('7')">Continuar</button>
                                </div>
                            </div>
                            <div v-show="cambiarmb==0">
                                <div class="col-md-5 modal-fo">
                                    <button type="button" class="btn btn-primary" @click="siguiente('4')">Agregar otro padrino</button>
                                    <button type="button" class="btn btn-primary" @click="siguiente('7')">Continuar</button>
                                </div>
                            </div>
                        </div>
                        <div v-show="cambiarm==4 || cambiarm==10">
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
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha de Nacimiento<b class="alerta">*</b></label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control datepicker" name="date" v-model="fechapad2"  @keydown.tab="validarvalores('fecp2')">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Zona:</label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idzonap2" @click="iglesiasp2(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Iglesia:</label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idiglesiap2"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesiap2 in arrayiglesiap2" :key="iglesiap2.id" v-bind:value="iglesiap2.id" >{{iglesiap2.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div v-show="errorDatos" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsj" :key="error" v-text="error"></div>
                                </div>
                            </div>
                            <div class="col-md-5 modal-fo">
                                <button type="button" class="btn btn-secondary" @click="siguiente('11')">Regresar</button>
                                <button type="button" class="btn btn-primary" @click="siguiente('5')">Nuevo Padrino</button>
                                <button type="button" class="btn btn-primary" @click="siguiente('7')">Continuar</button>
                            </div> 
                        </div>
                        <div v-show="cambiarm==5 || cambiarm==9">
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
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha de Nacimiento<b class="alerta">*</b></label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control datepicker" name="date" v-model="fechapad3"  @keydown.tab="validarvalores('fecp3')">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Zona:</label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idzonap3" @click="iglesiasp3(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Iglesia:</label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idiglesiap3"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesiap3 in arrayiglesiap3" :key="iglesiap3.id" v-bind:value="iglesiap3.id" >{{iglesiap3.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div v-show="errorDatos" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsj" :key="error" v-text="error"></div>
                                </div>
                            </div>
                            <div class="col-md-5 modal-fo">
                                <button type="button" class="btn btn-secondary" @click="siguiente('10')">Regresar</button>
                                <button type="button" class="btn btn-primary" @click="siguiente('6')">Nuevo Padrino</button>
                                <button type="button" class="btn btn-primary" @click="siguiente('7')">Continuar</button>
                            </div> 
                        </div>
                        <div v-show="cambiarm==6 || cambiarm==8">
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
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha de Nacimiento<b class="alerta">*</b></label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control datepicker" name="date" v-model="fechapad4"  @keydown.tab="validarvalores('fecp4')">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Zona:</label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idzonap4" @click="iglesiasp4(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Iglesia:</label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idiglesiap4"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesiap4 in arrayiglesiap4" :key="iglesiap4.id" v-bind:value="iglesiap4.id" >{{iglesiap4.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div v-show="errorDatos" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsj" :key="error" v-text="error"></div>
                                </div>
                            </div>
                            <div class="col-md-5 modal-fo">
                                <button type="button" class="btn btn-secondary" @click="siguiente('9')">Regresar</button>
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
                                    <label class="col-md-3 form-control-label">Lugar de Bautizo</label>
                                  <div class="col-md-5">
                                        <select class="form-control" v-model="idiglesia"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesias in arrayiglesias" :key="iglesias.id"  v-bind:value="iglesias.id" v-text="iglesias.nombre_iglesia"></option>
                                        </select>
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Ofrenda</label>
                                <div class="col-md-5">
                                    <input type="text" tabindexgt="0" v-model="monto" class="form-control" placeholder="Monto" @keydown.tab="validarvalores('15')">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label">Categoria</label>
                                  <div class="col-md-5">
                                        <select class="form-control" v-model="idcare"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="categorias in arraycategorias" :key="categorias.id"  v-bind:value="categorias.id" v-text="categorias.nombre_categoria"></option>
                                        </select>
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre del sacerdote<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                        <select class="form-control" v-model="idsacerdote" > 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="sacerdote in arraysacerdote" :key="sacerdote.id" v-bind:value="sacerdote.id"  @click="autollenado(sacerdote)">{{sacerdote.nombre_persona}}, {{sacerdote.apellido_persona}}</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Cargo<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                        <select class="form-control" v-model="cargosacerdote"> 
                                        <option value="0" disabled>Cargo</option>
                                        <option v-for="sacerdote in arraycargo" :key="sacerdote.id" v-bind:value="sacerdote" v-text="sacerdote"></option>
                                        </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha de realización<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <input type="date" class="form-control datepicker" name="date" v-model="fecharealizacion" @keydown.tab="validarvalores('16')">
                                </div>
                            </div>
                            <div v-show="errorDatos" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsj" :key="error" v-text="error"></div>
                                </div>
                            </div>
                            <div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-secondary" @click="siguiente('8')">Regresar</button>
                                    <button type="button" class="btn btn-secondary" @click="cerrarm()">Cancelar</button>
                                    <button type="submit"  class="btn btn-primary" @click="abrirmodal()">Guardar</button>
                                </div>
                            </div>
                            <!--<div v-show="cambiarmb==0">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-secondary" @click="cerrarm()">Cancelar</button>
                                    <button type="submit"  class="btn btn-primary" @click="abrirmodal()">Guardar</button>
                                </div>
                            </div>-->
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
                                        <div class="form-group row">
                                            <label class="col-md-4 form-control-label" for="text-input">Nacida el:</label>
                                            <label class="col-md-6 form-control-label" >{{fechanaes}}</label>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 form-control-label" for="text-input">Fue bautizada:</label>
                                            <label class="col-md-6 form-control-label" >{{fecharealizaciones}}</label>
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
                                        <div class="form-group row">
                                            <label class="col-md-4 form-control-label" for="text-input">Nacido el:</label>
                                            <label class="col-md-6 form-control-label" >{{fechanaes}}</label>
                                        </div>
                                        <div v-show="accionbotones==2">
                                            <div class="form-group row">
                                                <label class="col-md-4 form-control-label" for="text-input">Fue bautizado:</label>
                                                <label class="col-md-6 form-control-label" >{{fecharealizaciones}}</label>
                                            </div> 
                                        </div>
                                    </div>
                                    <div v-show="accionbotones==2">
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
                                        <div class="col-md-4 modal-fo">
                                            <button type="button" class="btn btn-secondary" @click="cerrarmodal()">Modificar</button>
                                            <button type="submit"  class="btn btn-primary" @click="registrar()">Guardar</button>
                                        </div>
                                    </div>
                                    <div v-show="accionbotones==1">
                                        <div class="col-md-4 modal-fo">
                                            <button type="button" class="btn btn-secondary" @click="cerrar()">Cancelar</button>
                                            <button type="submit"  class="btn btn-primary" @click="siguiente('3')">Continuar</button> <!--aqui2-->
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
            idzona:'',
            idiglesia:'',
            zona:'', //
            iglesia:'',
            nombre_zona:'',//
            nombre_iglesia:'',
            arrayzona:[], //
            arrayiglesia:[],
            arrayiglesiaID:[],

            idzonar:'', //realizante
            idiglesiar:'',
            iglesiar:'',
            nombre_iglesiar:'',
            arrayiglesiar:[],
            arrayiglesiaIDr:[],

            idzonam:'', //mama
            idiglesiam:'',
            iglesiam:'',
            nombre_iglesiam:'',
            arrayiglesiam:[],
            arrayiglesiaIDm:[],
            fechamadre:'',

            idzonap:'', //papa
            idiglesiap:'',
            iglesiap:'',
            nombre_iglesiap:'',
            arrayiglesiap:[],
            arrayiglesiaIDp:[],
            fechapadre:'',

            idzonap1:'', //padrino1
            idiglesiap1:'',
            iglesiap1:'',
            nombre_iglesiap1:'',
            arrayiglesiap1:[],
            arrayiglesiaIDp1:[],
            fechapad1:'',

            idzonap2:'', //padrino2
            idiglesiap2:'',
            iglesiap2:'',
            nombre_iglesiap2:'',
            arrayiglesiap2:[],
            arrayiglesiaIDp2:[],
            fechapad2:'',

            idzonap3:'', //padrino3
            idiglesiap3:'',
            iglesiap3:'',
            nombre_iglesiap3:'',
            arrayiglesiap3:[],
            arrayiglesiaIDp3:[],
            fechapad3:'',

            idzonap4:'', //padrino4
            idiglesiap4:'',
            iglesiap4:'',
            nombre_iglesiap4:'',
            arrayiglesiap4:[],
            arrayiglesiaIDp4:[],
            fechapad4:'',

            id:'',
            tipo:'',
            tipop:0,
            monto:0,
            librob:'',
            foliob:'',
            asiento:'',
            idsacerdote:'',
           // idiglesia:'',
            arrayiglesias:[],
            nomiglesia:'',
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
            apellidosacerdote:'',
            cargosacerdote:'',
            fecharealizaciones:'',
            fechana:'',
            fechanaes:'',
            fechana2:'',
            sexo:'',
            Acciondui:0,
            modal : 0,
            idcare:'',
            arraysacerdote:[],
            arraycategorias:[],
            arraycargo:[],
            tituloModal:'',
            accion:0,
            accionp:0,
            accionsexo:0,
            cambiarm:0,
            cambiarmb:0,
            alcaldia:'',
            partida:'',
            libro:'',
            folio:'',
            ano:'',
            verificacion:0,
            accionbotones:0,
            errorDatos:0,
            errorMostrarMsj:[],
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
            nombrepd2:'',
            apellidopd2:'',
            nombrepd3:'',
            apellidopd3:'',
            nombrepd4:'',
            apellidopd4:'',
            sexopd1:'',
            sexopd2:'',
            sexopd3:'',
            sexopd4:'',
        }
    },

    methods:{
        //Para lo de zonas e iglesias
             llenadolistazona(){
            let me=this;
            var url='/zona/buscarZona'; 
            axios.get(url) .then(function (response) {
                me.arrayzona=response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },  

            iglesiasr(idzonar){  //realizante

                let me=this;
                var arrayiglesiaIDr=[];
             axios.post('/feligreses/buscarIglesia',{
               'id':this.idzonar}) 
              .then(function (response) { 
                arrayiglesiaIDr = response.data;     
                me.llenarr(arrayiglesiaIDr);  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
           llenarr(d=[]){
                this.arrayiglesiar=d;
            },

             iglesiasm(idzonam){  //mamá

                let me=this;
                var arrayiglesiaIDm=[];
             axios.post('/feligreses/buscarIglesia',{
               'id':this.idzonam}) 
              .then(function (response) { 
                arrayiglesiaIDm = response.data;     
                me.llenarm(arrayiglesiaIDm);  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            llenarm(d=[]){
                this.arrayiglesiam=d;
            },

             iglesiasp(idzonap){ //papa

                let me=this;
                var arrayiglesiaIDp=[];
             axios.post('/feligreses/buscarIglesia',{
               'id':this.idzonap}) 
              .then(function (response) { 
                arrayiglesiaIDp= response.data;     
                me.llenarp(arrayiglesiaIDp);  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            llenarp(d=[]){
                this.arrayiglesiap=d;
            },

            iglesiasp1(idzonap1){ //padrino1

                let me=this;
                var arrayiglesiaIDp1=[];
             axios.post('/feligreses/buscarIglesia',{
               'id':this.idzonap1}) 
              .then(function (response) { 
                arrayiglesiaIDp1= response.data;     
                me.llenarp1(arrayiglesiaIDp1);  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            llenarp1(d=[]){
                this.arrayiglesiap1=d;
            },

            iglesiasp2(idzonap2){ //padrino2

                let me=this;
                var arrayiglesiaIDp2=[];
             axios.post('/feligreses/buscarIglesia',{
               'id':this.idzonap2}) 
              .then(function (response) { 
                arrayiglesiaIDp2= response.data;     
                me.llenarp2(arrayiglesiaIDp2);  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            llenarp2(d=[]){
                this.arrayiglesiap2=d;
            },

            iglesiasp3(idzonap3){ //padrino3

                let me=this;
                var arrayiglesiaIDp3=[];
             axios.post('/feligreses/buscarIglesia',{
               'id':this.idzonap3}) 
              .then(function (response) { 
                arrayiglesiaIDp3= response.data;     
                me.llenarp3(arrayiglesiaIDp3);  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            llenarp3(d=[]){
                this.arrayiglesiap3=d;
            },

            iglesiasp4(idzonap4){ //padrino4

                let me=this;
                var arrayiglesiaIDp4=[];
             axios.post('/feligreses/buscarIglesia',{
               'id':this.idzonap4}) 
              .then(function (response) { 
                arrayiglesiaIDp4= response.data;     
                me.llenarp4(arrayiglesiaIDp4);  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            llenarp4(d=[]){
                this.arrayiglesiap4=d;
            },

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
                    this.validarvalores('13');
                    this.Acciondui=1;
                } else{
                    this.validarvalores('13');
                    this.Acciondui=0;
                }
            }
        },

        //Para mostar las partes del formulario
        siguiente(d){
            switch(d){
                case '1':
                {
                    this.validarvalores('5');
                        if(this.errorDatos==1){
                            this.cambiarm=0;
                        }
                        else{
                            this.verificarpersona();  //datos del realizante
                        }
                    break;
                }
                case '2':
                {
                    this.cambiar();
                    this.validarvalores('12');
                        if(this.errorDatos==1){
                            this.cambiarm=1;
                        }else{
                            this.cambiarm=2;   //datos de los padres
                        }
                    break;
                }
                case '3':
                {
                    this.validarvalores('12');
                        if(this.errorDatos==1){
                            this.cambiarm=2;   //datos de los padres 
                        }else{
                            this.cambiarm=3;   //padrino 1
                        }
                        this.modal=0;
                    break;
                }
                case '4':
                {
                    this.validarvalores('19');
                        if(this.errorDatos==1){
                            this.cambiarm=3;   //padrino 1 
                        }else{
                            this.cambiarm=4;   //padrino 2
                        }
                    break;
                }
                case '5':
                {
                    this.validarvalores('20');
                        if(this.errorDatos==1){
                            this.cambiarm=4;   //padrino 2 
                        }else{
                            this.cambiarm=5;   //padrino 3
                        }
                    break;
                }
                case '6':
                {
                    this.validarvalores('21');
                        if(this.errorDatos==1){
                            this.cambiarm=5;   //padrino 3 
                        }else{
                            this.cambiarm=6;   //padrino 4
                        }
                    break;
                }
                case '7':
                {
                    this.validarvalores('17');
                        if(this.errorDatos==1){
                            this.cambiarm=6;   //padrino 4 
                        }else{
                            this.cambiarm=7;   //datos de la celebracion
                        }
                    break;
                } 
                case '8':
                {
                    if(this.nombrepd4=='' && this.nombrepd3=='' && this.nombrepd2==''){
                        this.cambiarm=3;  //regresar a padrino 1
                    }
                    if(this.nombrepd4=='' && this.nombrepd3=='' && this.nombrepd2!='' && this.nombrepd1!=''){
                        this.cambiarm=4;  //regresar a padrino 2
                    }
                    if(this.nombrepd4=='' && this.nombrepd3!='' && this.nombrepd2!='' && this.nombrepd1!=''){
                        this.cambiarm=5;  //regresar a padrino 3
                    }
                    if(this.nombrepd4!='' && this.nombrepd3!='' && this.nombrepd2!='' && this.nombrepd1!=''){
                        this.cambiarm=6;  //regresar a padrino 4
                    }
                    break;
                }
                case '9':
                {
                    this.cambiarm=9;  //regresar a padrino 3
                    break;
                }
                case '10':
                {
                    this.cambiarm=10;  //regresar a padrino 2
                    break;
                }
                case '11':
                {
                    this.cambiarm=11;  //regresar a padrino 1
                    break;
                }
                case '12':
                {
                    this.cambiarm=12;  //regresar a padres
                    break;
                }
                case '13':
                {
                    this.cambiarm=13; //regresa a datos generales
                    break;
                }
                case '14':
                {
                    this.cambiarm=14; //regresa a datos partida
                    break;
                }   

            }

        },
            //Mt. cuando da eliminar en el formulario
        cerrar(){
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
            this.alcaldia='';
            this.libro='';
            this.partida='';
            this.folio='';
            this.ano='';
            this.librob='';
            this.foliob='';
            this.sexopd1='';
            this.sexopd2='';
            this.sexopd3='';
            this.sexopd4='';
            this.errorDatos=0;
            this.errorMostrarMsj=[]; 
            this.idzonar=0;    //zona realizante
            this.idiglesiar=0;
            this.idzonam=0;   //zona madre
            this.idiglesiam=0;
            this.idzonap=0;   //zona padre
            this.idiglesiap=0;
            this.idzonap1=0;   //zona padrino1
            this.idiglesiap1=0;
            this.idzonap2=0;   //zona padrino2
            this.idiglesiap2=0;
            this.idzonap3=0;   //zona padrino3
            this.idiglesiap3=0;
            this.idzonap4=0;   //zona padrino4
            this.idiglesiap4=0;
            this.fechamadre='';
            this.fechapadre='';
            this.fechapad1='';
            this.fechapad2='';
            this.fechapad3='';
            this.fechapad4='';

        },
        cerrarm(){ //botones cancelat
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
            this.ano='';
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
            this.errorDatos=0;
            this.errorMostrarMsj=[];
            this.idzonar=0;    //zona realizante
            this.idiglesiar=0;
            this.idzonam=0;   //zona madre
            this.idiglesiam=0;
            this.idzonap=0;   //zona padre
            this.idiglesiap=0;
            this.idzonap1=0;   //zona padrino1
            this.idiglesiap1=0;
            this.idzonap2=0;   //zona padrino2
            this.idiglesiap2=0;
            this.idzonap3=0;   //zona padrino3
            this.idiglesiap3=0;
            this.idzonap4=0;   //zona padrino4
            this.idiglesiap4=0;
            this.fechamadre='';
            this.fechapadre='';
            this.fechapad1='';
            this.fechapad2='';
            this.fechapad3='';
            this.fechapad4='';
        },
            //Mt. cuando le da modificar en el modal
        cerrarmodal(){
            this.modal=0;
        },

        abrirmodal(){
             this.validarvalores('18');
                            if(this.errorDatos==1){
                                this.modal=0;
                            }else{
                this.modal=1;
                this.tituloModal='Confirmar ingreso'
                this.accionbotones=2;

                this.nombrerealizante= this.nombrerealizante.toUpperCase();
                this.apellidorealizante= this.apellidorealizante.toUpperCase();
                this.nombremadre= this.nombremadre.toUpperCase();
                this.apellidomadre=this.apellidomadre.toUpperCase();
                this.nombrepadre= this.nombrepadre.toUpperCase();
                this.apellidopadre=this.apellidopadre.toUpperCase();
                this.nombrepd1= this.nombrepd1.toUpperCase();
                this.apellidopd1=this.apellidopd1.toUpperCase();
                this.nombrepd2= this.nombrepd2.toUpperCase();
                this.apellidopd2=this.apellidopd2.toUpperCase();
                this.nombrepd3= this.nombrepd3.toUpperCase();
                this.apellidopd3=this.apellidopd3.toUpperCase();
                this.nombrepd4= this.nombrepd4.toUpperCase();
                this.apellidopd4=this.apellidopd4.toUpperCase();


                var t1 = this.fechana;
               this.fechanaes= t1.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');

               var t2 = this.fecharealizacion;
               this.fecharealizaciones= t2.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
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
                    this.accion=3;
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
                }

            },

            abrirmodal2(){
                this.modal=1;
                this.tituloModal='Confirmar datos'
                this.accionbotones=1;
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
                    this.accion=3;
                }             

            },

            

            llenarmodal(id){
                let me=this;
                var url='/persona/obtenerConfirma?id=' + id; //No fue necesario hacer otra función...
                    axios.get(url) .then(function (response) {
                        var d = response.data.solo;            
                        if(d==1){
                           /*  response.data.realizante.forEach(function(element) {
                            var texto = element.fecha_nacimiento;
                            element.fecha_nacimiento= texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
                            });*/
                            me.nombrerealizante= response.data.realizante.nombre_persona;
                            me.apellidorealizante=response.data.realizante.apellido_persona;
                            me.sexo=response.data.realizante.sexo;
                            me.fechana=response.data.realizante.fecha_nacimiento;
                        }
                        if(d==2){
                            /* response.data.realizante.forEach(function(element) {
                            var texto = element.fecha_nacimiento;
                            element.fecha_nacimiento= texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
                            });*/
                            me.nombrepadre= response.data.padre.nombre_persona;
                            me.apellidopadre=response.data.padre.apellido_persona;
                            me.nombrerealizante= response.data.realizante.nombre_persona;
                            me.apellidorealizante=response.data.realizante.apellido_persona;
                            me.sexo=response.data.realizante.sexo;
                            me.fechana=response.data.realizante.fecha_nacimiento;
                        }
                        if(d==3){
                             /*response.data.realizante.forEach(function(element) {
                            var texto = element.fecha_nacimiento;
                            element.fecha_nacimiento= texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
                            });*/
                            me.nombremadre= response.data.madre.nombre_persona;
                            me.apellidomadre=response.data.madre.apellido_persona;
                            me.nombrerealizante= response.data.realizante.nombre_persona;
                            me.apellidorealizante=response.data.realizante.apellido_persona;
                            me.sexo=response.data.realizante.sexo;
                            me.fechana=response.data.realizante.fecha_nacimiento;
                        }
                        if(d==4){
                             /*response.data.realizante.forEach(function(element) {
                            var texto = element.fecha_nacimiento;
                            element.fecha_nacimiento= texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
                            });*/
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
                var tamaño =0;
                var length1 = this.id.length;
                var m=this.idmadre;
                var p=this.idpadre;
                var duim=this.duimadre;
                var duip=this.duipadre;
                var pd1 = this.idpd1;
                var pd2 = this.idpd2;
                var pd3 = this.idpd3;
                var pd4 = this.idpd4;
                var dp1 = this.nombrepd1;
                var dp2 = this.nombrepd2;
                var dp3 = this.nombrepd3;
                var dp4 = this.nombrepd4;
                if(length1 == tamaño){
                if(m!='' && p!=''){ //introduje ambos duis
                    this.tipo=1;
                }
                if(m=='' && p!='' && duim!=''){ //introduje ambos duis pero el de mama no esta
                    this.tipo=2;
                }
                if(p=='' && m!='' && duip!=''){ //introduje ambos duis pero el de papa no esta
                    this.tipo=3;
                }
                if(m=='' && p==''){ //introduje ambos duis y ninguno esta
                    this.tipo=4;
                }
                if(p!='' && duim==''){ // solo introduje el dui del papa y no hay datos de mama
                    this.tipo=5;
                }
                if(m!='' && duip==''){ // solo introduje el dui de la mama y no hay datos de papa
                    this.tipo=6;
                }
                if(duip=='' && duim==''){ //no hay datos de ambos
                    this.tipo=7;
                }
                if(duim!='' &&  m=='' && duip==''){ // es nueva mama, no tiene papa
                    this.tipo=8;
                }
                if(duip!='' &&  p=='' && duim==''){ // es nuevo papa, no tiene mama
                    this.tipo=9;
                }
                if(pd1!='' && pd2!='' && pd3!='' && pd4!=''){ // caso 1 estan los 4
                    this.tipop=1;
                }
                if(pd1!='' && pd2!='' && pd3!='' && pd4=='' && dp4==''){ // caso 1 estan los 3
                    this.tipop=1;
                }
                if(pd1!='' && pd2!='' && pd3=='' && dp3=='' && pd4=='' && dp4==''){ // caso 1 estan los 2
                    this.tipop=1;
                }
                if(pd1!='' && pd2=='' && dp2=='' && pd3=='' && dp3=='' && pd4=='' && dp4==''){ // caso 1 esta 1
                    this.tipop=1;
                }
                if(pd1=='' && dp1!='' && pd2=='' && dp2=='' && pd3=='' && dp3=='' && pd4=='' && dp4==''){ // padrino 1 nuevo
                    this.tipop=2;
                }
                if(pd1=='' && dp1!='' && pd2!='' && pd3=='' && dp3=='' && pd4=='' && dp4==''){ // padrino 1 nuevo y 2 viejo
                    this.tipop=2;
                }
                if(pd1=='' && dp1!='' && pd2=='' && dp2!='' && pd3=='' && dp3=='' && pd4=='' && dp4==''){ // padrino 1 y 2 nuevo
                    this.tipop=3;
                }
                if(pd1!=''  && pd2=='' && dp2!='' && pd3=='' && dp3=='' && pd4=='' && dp4==''){ // padrino 1 viejo y 2 nuevo
                    this.tipop=4;
                }
                if(pd1=='' && dp1!='' && pd2=='' && dp2!='' && pd3!='' && pd4=='' && dp4==''){ // padrino 1 y 2 nuevo y 3 viejo
                    this.tipop=3;
                }
                if(pd1!='' && pd2!=''  && pd3=='' && dp3!='' && pd4=='' && dp4==''){ // padrino 1 y 2 viejo y 3 nuevo
                    this.tipop=5;
                }
                if(pd1=='' && dp1!='' && pd2!='' && pd3=='' && dp3!='' && pd4=='' && dp4==''){ // padrino 1 y 3  nuevo y 2  viejo
                    this.tipop=6;
                }
                if(pd1!='' && pd2=='' && dp2!='' && pd3!='' && pd4=='' && dp4==''){ // padrino 1 y 3 viejos y 2 nuevo
                    this.tipop=4;
                }
                if(pd1=='' && dp1!='' && pd2!='' && pd3!='' && pd4=='' && dp4==''){ // padrino 1 nuevo y 2, 3 viejo
                    this.tipop=2;
                }
                if(pd1!=''  && pd2=='' && dp2!='' && pd3=='' && dp3!='' && pd4=='' && dp4==''){ // padrino 1 viejo y 2, 3 nuevo
                    this.tipop=7;
                }
                if(pd1=='' && dp1!='' && pd2=='' && dp2!='' && pd3=='' && dp3!=''&& pd4=='' && dp4==''){ // los 3 son nuevos
                    this.tipop=8;
                }
                if(pd1=='' && dp1!='' && pd2=='' && dp2!='' && pd3=='' && dp3!='' && pd4=='' && dp4!=''){ // los 4 son nuevos
                    this.tipop=9;
                }
                if(pd1!='' && pd2=='' && dp2!='' && pd3=='' && dp3!='' && pd4=='' && dp4!=''){ // p1 es viejo y los demas son nuevos
                    this.tipop=10;
                }
                if(pd1!='' && pd2!='' && pd3=='' && dp3!='' && pd4=='' && dp4!=''){ // p1 y p2 viejos y los demas son nuevos
                    this.tipop=11;
                }
                if(pd1!='' && pd2!='' && pd3!='' && dp3!='' && pd4=='' && dp4!=''){ // solo 4 es nuevo
                    this.tipop=12;
                }
                if(pd1=='' && dp1!='' && pd2=='' && dp2!='' && pd3=='' && dp3!='' && pd4!='' ){ // solo 4 es viejo
                    this.tipop=8;
                }
                if(pd1=='' && dp1!='' && pd2=='' && dp2!='' && pd3!='' && pd4!=''){ // 1 y2 nuevos 3 y 4 viejos
                    this.tipop=3;
                }
                if(pd1=='' && dp1!='' && pd2!=''  && pd3!='' && pd4!=''){ // 1 nuevo 2,3 y 4 viejos
                    this.tipop=2;
                }
                if(pd1=='' && dp1!='' && pd2!='' && pd3=='' && dp3!='' && pd4=='' && dp4!=''){ // solo 2 viejo
                    this.tipop=13;
                }
                if(pd1!='' && pd2=='' && dp2!='' && pd3!=''  && pd4!=''){ // solo 2  nuevos
                    this.tipop=4;
                }
                if(pd1!='' && pd2!='' && pd3=='' && dp3!='' && pd4!=''){ // solo 3 son nuevo
                    this.tipop=5;
                }
                if(pd1=='' && dp1!='' && pd2=='' && dp2!='' && pd3!='' && pd4=='' && dp4!=''){ // solo 3 es viejo
                    this.tipop=14;
                }
                if(pd1=='' && dp1!='' && pd2!='' && pd3=='' && dp3!='' && pd4!='' ){ // 1 y 3 nuevos 2 y 4 viejos
                    this.tipop=6;
                }
                if(pd1!='' && pd2=='' && dp2!='' && pd3!='' && pd4=='' && dp4!=''){ // 1 y3 viejos 2 y 4 nuevos
                    this.tipop=15;
                }
                if(pd1=='' && dp1!='' && pd2!='' && pd3!='' && pd4=='' && dp4!=''){ // 1 y 4 nuevos y 2 y 3 viejos
                    this.tipop=16;
                }
                if(pd1!='' && pd2=='' && dp2!='' && pd3=='' && dp3!='' && pd4!=''){ // 1 y 4 viejos y 2 y 3 nuevos
                    this.tipop=7;
                }
                 console.log(pd1,pd2,pd3,pd4,this.tipop);              
                    axios.put('/bautizo/registrar',{
                        'tipo':this.tipo,
                        'tipop':this.tipop,
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
                        'fecha' : this.fecharealizacion,
                        'titulo': this.cargosacerdote,
                        'sacerdote' :this.idsacerdote,
                        'id_pd1' :this.idpd1,
                        'id_pd2' : this.idpd2,
                        'id_pd3' : this.idpd3,
                        'id_pd4' :this.idpd4,
                        'dui_pd1':this.duipd1,
                        'dui_pd2':this.duipd2,
                        'dui_pd3':this.duipd3,
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
                        'ano':this.ano,
                        'librob':this.librob,
                        'foliob':this.foliob,
                        'asiento':this.asiento,
                        'sexo_pd1':this.sexopd1,
                        'sexo_pd2':this.sexopd2,
                        'sexo_pd3':this.sexopd3,
                        'sexo_pd4':this.sexopd4,
                        'monto': this.monto,
                        'idcate':this.idcare,
                        'idiglesia':this.idiglesia,
                        'idzonar':this.idzonar,        //zona realizante
                        'idiglesiar':this.idiglesiar,   //iglesia realizante
                        'idzonam':this.idzonam,    //zona mamá
                        'idiglesiam':this.idiglesiam, //iglesia mamá
                        'idzonap':this.idzonap,  //zona papá
                        'idiglesiap':this.idiglesiap, //iglesia papá
                        'idzonap1':this.idzonap1,  //zona padrino1
                        'idiglesiap1':this.idiglesiap1, //iglesia padrino1
                        'idzonap2':this.idzonap2,  //zona padrino2
                        'idiglesiap2':this.idiglesiap2, //iglesia padrino2
                        'idzonap3':this.idzonap3,  //zona padrino3
                        'idiglesiap3':this.idiglesiap3, //iglesia padrino3
                        'idzonap4':this.idzonap4,  //zona padrino4
                        'idiglesiap4':this.idiglesiap4, //iglesia padrino4
                        'nacimientom':this.fechamadre,
                        'nacimientop':this.fechapadre,
                        'nacimientopad1':this.fechapad1,
                        'nacimientopad2':this.fechapad2,
                        'nacimientopad3':this.fechapad3,
                        'nacimientopad4':this.fechapad4,
                }) .then(function (response) {
                    me.modal=0;
                    me.cambiarm=0;
             
                    me.msjExito();
                    me.cerrarm();
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
                }else{

                }
            },

             //Buscar si ya hay datos del realizante
   
        verificarpersona(){
            let me=this;
            var alcaldia= this.alcaldia.toUpperCase();
            var libro= this.libro;
            var partida= this.partida;
            var folio= this.folio;
            var ano= this.ano;

            var url='/partida/busquedaBautizo?alcaldia=' + alcaldia + '&libro=' + libro + '&partida=' + partida + '&folio=' + folio + '&ano=' + ano;
            axios.get(url) .then(function (response) {
                var respuesta=response.data.solo;
               /* if(respuesta==1){
                    me.id=response.data.realizante.idpersona;
                    me.llenarmodal(me.id);
                }else{
                    me.cambiarm=1;
                    me.cambiarmb=1;
                }*/
                if(respuesta==1){
                        me.id=response.data.realizante.idpersona;
                        me.llenarmodal(me.id);
                        me.cambiarmb=0;
                    }
                    if(respuesta==0){
                        me.cambiarm=1;
                        me.cambiarmb=1;
                    }
                     if(respuesta==2){
                         me.validarvalores('6');
                        

                     }                     
            }).catch(function (error) {
                console.log(error);
            });
        },
        llenadolistas(){
             this.arraycargo= new Array('DIACONO','PADRE','ARZOBISPO','CARDENAL','NUNCIO APOSTOLICO','MONSEÑOR');
                let me=this;
                var url='/persona/buscarsacerdote3';
                axios.get(url) .then(function (response) {
                    me.arraysacerdote=response.data.sacerdote;
                    me.arraycategorias=response.data.categorias;
                    me.arrayiglesias=response.data.iglesia;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
   

        llenarcamposm(data=[]){
            this.nombremadre= data['nombre_persona'];
            this.apellidomadre= data['apellido_persona'];
            this.idmadre=data['id'];
            this.fechamadre=data['fecha_nacimiento'];
            this.idzonam=data['idzonaa'];
            this.llenadolistazona();
            if(this.idzonam)
                {
                    this.iglesiasm(this.idzonam);
                    this.idiglesiam=data['idiglesia'];
                }
        },
        llenarcamposp(data=[]){
            this.nombrepadre= data['nombre_persona'];
            this.apellidopadre= data['apellido_persona'];
            this.idpadre=data['id'];
            this.fechapadre=data['fecha_nacimiento'];
            this.idzonap=data['idzonaa'];
            this.llenadolistazona();
            if(this.idzonap)
                {
                    this.iglesiasp(this.idzonap);
                    this.idiglesiap=data['idiglesia'];
                }
        },
        llenarcamposp1(data=[]){
            this.nombrepd1= data['nombre_persona'];
            this.apellidopd1= data['apellido_persona'];
            this.idpd1=data['id'];
            this.sexopd1=data['sexo'];
            this.fechapad1=data['fecha_nacimiento'];
            this.idzonap1=data['idzonaa'];
            this.llenadolistazona();
            if(this.idzonap1)
                {
                    this.iglesiasp1(this.idzonap1);
                    this.idiglesiap1=data['idiglesia'];
                }
        },
        llenarcamposp2(data=[]){
            this.nombrepd2= data['nombre_persona'];
            this.apellidopd2= data['apellido_persona'];
            this.idpd2=data['id'];
            this.sexopd2=data['sexo'];
            this.fechapad2=data['fecha_nacimiento'];
            this.idzonap2=data['idzonaa'];
            this.llenadolistazona();
            if(this.idzonap2)
                {
                    this.iglesiasp2(this.idzonap2);
                    this.idiglesiap2=data['idiglesia'];
                }
        },

        llenarcamposp3(data=[]){
            this.nombrepd3= data['nombre_persona'];
            this.apellidopd3= data['apellido_persona'];
            this.idpd3=data['id'];
            this.sexopd3=data['sexo'];
            this.fechapad3=data['fecha_nacimiento'];
            this.idzonap3=data['idzonaa'];
            this.llenadolistazona();
            if(this.idzonap3)
                {
                    this.iglesiasp3(this.idzonap3);
                    this.idiglesiap3=data['idiglesia'];
                }
        },

        llenarcamposp4(data=[]){
            this.nombrepd4= data['nombre_persona'];
            this.apellidopd4= data['apellido_persona'];
            this.idpd4=data['id'];
            this.sexopd4=data['sexo'];
            this.fechapad4=data['fecha_nacimiento'];
            this.idzonap4=data['idzonaa'];
            this.llenadolistazona();
            if(this.idzonap4)
                {
                    this.iglesiasp4(this.idzonap4);
                   this.idiglesiap4=data['idiglesia'];
                }
        },

        duim(){
            let me=this;
            var d= this.duimadre;

            if(d != ''){
                var url='/persona/duis?dui=' + d;
                axios.get(url) .then(function (response) {
                    var respuesta=response.data.solo;
                    var datos= response.data.persona;
                    if(respuesta==1){
                        me.vaciarm();
                    }
                    if(respuesta==2){
                        me.llenarcamposm(datos);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        vaciarm(){
            this.nombremadre='';
            this.apellidomadre= '';
            this.idmadre='';
            this.fechamadre='';
            this.idzonam=0;   //zona madre
            this.idiglesiam=0; 
        },
        duip(){
            let me=this;
            var d=this.duipadre;
            if(d != ''){
                var url='/persona/duis?dui=' + d;
                axios.get(url) .then(function (response) {
                    var respuesta=response.data.solo;
                    var datos= response.data.persona;
                    if(respuesta==1){
                        me.vaciarp();
                    }
                    if(respuesta==2){
                        me.llenarcamposp(datos);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
                    
        },
        vaciarp(){
            this.nombrepadre='';
            this.apellidopadre= '';
            this.idpadre='';
            this.fechapadre='';
            this.idzonap=0;   //zona padre
            this.idiglesiap=0; 
        },
        duip1(){
            let me=this;
            var d=this.duipd1;
            if(d != ''){
                var url='/persona/duis?dui=' + d;
                axios.get(url) .then(function (response) {
                    var respuesta=response.data.solo;
                    var datos= response.data.persona;
                    if(respuesta==1){
                        me.vaciarp1();
                    }
                    if(respuesta==2){
                        me.llenarcamposp1(datos);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
                    
        },
        vaciarp1(){
            this.nombrepd1='';
            this.apellidopd1= '';
            this.idpd1='';
            this.sexopd1='';
            this.fechapad1='';
            this.idzonap1=0;   //zona padrino1
            this.idiglesiap1=0; 
        },
        duip2(){
            let me=this;
            var d=this.duipd2;
            if(d != ''){
                var url='/persona/duis?dui=' + d;
                axios.get(url) .then(function (response) {
                    var respuesta=response.data.solo;
                    var datos= response.data.persona;
                    if(respuesta==1){
                        me.vaciarp2();
                    }
                    if(respuesta==2){
                        me.llenarcamposp2(datos);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
                    
        },
        vaciarp2(){
            this.nombrepd2='';
            this.apellidopd2= '';
            this.idpd2='';
            this.sexopd2='';
            this.fechapad2='';
            this.idzonap2=0;   //zona padrino2
            this.idiglesiap2=0;
        },
        duip3(){
            let me=this;
            var d=this.duipd3;
            if(d != ''){
                var url='/persona/duis?dui=' + d;
                axios.get(url) .then(function (response) {
                    var respuesta=response.data.solo;
                    var datos= response.data.persona;
                    if(respuesta==1){
                        me.vaciarp3();
                    }
                    if(respuesta==2){
                        me.llenarcamposp3(datos);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
                    
        },
        vaciarp3(){
            this.nombrepd3='';
            this.apellidopd3= '';
            this.idpd3='';
            this.sexopd3='';
            this.fechapad3='';
            this.idzonap3=0;   //zona padrino3
            this.idiglesiap3=0;
        },
        duip4(){
            let me=this;
            var d=this.duipd4;
            if(d != ''){
                var url='/persona/duis?dui=' + d;
                axios.get(url) .then(function (response) {
                    var respuesta=response.data.solo;
                    var datos= response.data.persona;
                    if(respuesta==1){
                        me.vaciarp4();
                    }
                    if(respuesta==2){
                        me.llenarcamposp4(datos);
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
                    
        },
        vaciarp4(){
            this.nombrepd4='';
            this.apellidopd4= '';
            this.idpd4='';
            this.sexopd4='';
            this.fechapad4='';
            this.idzonap4=0;   //zona padrino4
            this.idiglesiap4=0;
        },

         //Validar datos
            validarvalores(d){
                this.errorDatos=0;
                this.errorMostrarMsj=[];
                var RE = /^([0-9])*$/;
                var patron =/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/; /////ESTOOOOOOOO
                var anio= /^\d{4}$/;
                var patrondui= /^\d{9}$/;
                var fecha = new Date();
                var anioac= fecha.getFullYear();
                var mesac= fecha.getMonth();
                switch(d){
                    case '1':
                        {
                            var Min_Length = 5;
                            var lengthmin = this.alcaldia.length;
                            if (lengthmin < Min_Length )this.errorMostrarMsj.push("La alcaldía debe tener más de 5 letras");
                            if (!patron.test(this.alcaldia))this.errorMostrarMsj.push("La alcaldía solo debe tener letras");
                            if(this.errorMostrarMsj.length) this.errorDatos=1;
                            return this.errorDatos;
                            break;
                        }
                    case '2':
                        {
                            var Min_Length = 5;
                            var lengthmin = this.alcaldia.length;
                            if (lengthmin < Min_Length)this.errorMostrarMsj.push("La alcaldía debe tener más de 5 letras");
                            if (!patron.test(this.alcaldia))this.errorMostrarMsj.push("La alcaldía solo debe tener letras");
                            if(!this.libro) this.errorMostrarMsj.push("El número de libro no puede estar vacío");
                            if(this.libro=='0') this.errorMostrarMsj.push("El número de libro debe ser distinto a 0");
                            if (!RE.test(this.libro))  this.errorMostrarMsj.push("El número de libro debe ser un numero entero");
                            if(this.errorMostrarMsj.length) this.errorDatos=1;
                            return this.errorDatos;
                            break;
                        }
                    case '3':
                        {
                            var Min_Length = 5;
                            var lengthmin = this.alcaldia.length;
                            if (lengthmin < Min_Length)this.errorMostrarMsj.push("La alcaldía debe tener más de 5 letras");
                            if (!patron.test(this.alcaldia))this.errorMostrarMsj.push("La alcaldía solo debe tener letras");
                            if(!this.libro) this.errorMostrarMsj.push("El número de libro no puede estar vacío");
                            if (!RE.test(this.libro))  this.errorMostrarMsj.push("El número de libro debe ser un numero entero");
                            if(this.libro=='0') this.errorMostrarMsj.push("El número de libro debe ser distinto a 0");
                            if(!this.partida) this.errorMostrarMsj.push("En número de partida no puede estar vacío");
                            if (!RE.test(this.partida))  this.errorMostrarMsj.push("El número de partida debe ser un numero entero");
                            if(this.partida=='0') this.errorMostrarMsj.push("El número de partida debe ser distinto a 0");
                            if(this.errorMostrarMsj.length) this.errorDatos=1;
                            return this.errorDatos;
                            break;
                        }
                    case '4':
                        {
                            var Min_Length = 5;
                            var lengthmin = this.alcaldia.length;
                            if (lengthmin < Min_Length)this.errorMostrarMsj.push("La alcaldía debe tener más de 5 letras");
                            if (!patron.test(this.alcaldia))this.errorMostrarMsj.push("La alcaldía solo debe tener letras");
                            if(!this.libro) this.errorMostrarMsj.push("El número de libro no puede estar vacío");
                            if (!RE.test(this.libro))  this.errorMostrarMsj.push("El número de libro debe ser un numero entero");
                            if(this.libro=='0') this.errorMostrarMsj.push("El número de libro debe ser distinto a 0");
                            if(!this.partida) this.errorMostrarMsj.push("En número de partida no puede estar vacío");
                            if (!RE.test(this.partida))  this.errorMostrarMsj.push("El número de partida debe ser un numero entero");
                            if(this.partida=='0') this.errorMostrarMsj.push("El número de partida debe ser distinto a 0");
                            if(!this.folio) this.errorMostrarMsj.push("El número de folio no puede estar vacío");
                            if (!RE.test(this.folio))  this.errorMostrarMsj.push("El número de folio debe ser un numero entero");
                            if(this.folio=='0') this.errorMostrarMsj.push("El número de folio debe ser distinto a 0");
                            if(this.errorMostrarMsj.length) this.errorDatos=1;
                            return this.errorDatos;
                            break;
                        }
                    case '5':
                        {
                            var Min_Length = 5;
                            var lengthmin = this.alcaldia.length;
                            if (lengthmin < Min_Length)this.errorMostrarMsj.push("La alcaldía debe tener más de 5 letras");
                            if (!patron.test(this.alcaldia))this.errorMostrarMsj.push("La alcaldía solo debe tener letras");
                            if(!this.libro) this.errorMostrarMsj.push("El numero de libro no puede estar vacío");
                            if (!RE.test(this.libro))  this.errorMostrarMsj.push("El número de libro debe ser un numero entero");
                            if(this.libro=='0') this.errorMostrarMsj.push("El número de libro debe ser distinto a 0");
                            if(!this.partida) this.errorMostrarMsj.push("En número de partida no puede estar vacío");
                            if (!RE.test(this.partida))  this.errorMostrarMsj.push("El número de partida debe ser un numero entero");
                            if(this.partida=='0') this.errorMostrarMsj.push("El número de partida debe ser distinto a 0");
                            if(!this.folio) this.errorMostrarMsj.push("El número de folio no puede estar vacío");
                            if (!RE.test(this.folio))  this.errorMostrarMsj.push("El número de folio debe ser un numero entero");
                            if(this.folio=='0') this.errorMostrarMsj.push("El número de folio debe ser distinto a 0");
                            if(!this.ano) this.errorMostrarMsj.push("El año no puede estar vacío");
                            if (!RE.test(this.ano))  this.errorMostrarMsj.push("El año debe ser un numero entero");
                            if(this.ano<'1900') this.errorMostrarMsj.push("El año debe ser un año mayor a 1900");
                            if(this.ano>anioac) this.errorMostrarMsj.push("El año debe ser igual o menor al actual");
                            if (!anio.test(this.ano))  this.errorMostrarMsj.push("El año debe ser de cuatro digitos");
                            if(this.errorMostrarMsj.length) this.errorDatos=1;
                            return this.errorDatos;
                            break;
                        }
                        case '6':
                            {
                            this.errorMostrarMsj.push("Esta persona ya realizo este sacramento, favor verificar datos");
                            if(this.errorMostrarMsj.length) this.errorDatos=1;
                            break;
                            }
                        case '7':
                            {
                            var Min_Length = 3;
                            var lengthmin = this.nombrerealizante.length;
                            if (lengthmin < Min_Length)this.errorMostrarMsj.push("El nombre debe tener mas de tres letras");
                            if (!patron.test(this.nombrerealizante))this.errorMostrarMsj.push("El nombre solo debe tener letras");
                            if(this.errorMostrarMsj.length) this.errorDatos=1;
                            return this.errorDatos;
                            break;
                            }
                        case '8':
                            {
                            var Min_Length = 3;
                            var lengthmin = this.nombrerealizante.length;
                            if (lengthmin < Min_Length)this.errorMostrarMsj.push("El nombre debe tener mas de tres letras");
                            if (!patron.test(this.nombrerealizante))this.errorMostrarMsj.push("El nombre solo debe tener letras");
                            var lengthmin2 = this.apellidorealizante.length;
                            if (lengthmin2 < Min_Length)this.errorMostrarMsj.push("El apellido debe tener mas de tres letras");
                            if (!patron.test(this.apellidorealizante))this.errorMostrarMsj.push("El apellido solo debe tener letras");
                            if(this.errorMostrarMsj.length) this.errorDatos=1;
                            return this.errorDatos;
                            break;
                            }
                        case '11':
                            {
                            var Min_Length = 3;
                            var lengthmin = this.nombrerealizante.length;
                            if (lengthmin < Min_Length)this.errorMostrarMsj.push("El nombre debe tener mas de tres letras");
                            if (!patron.test(this.nombrerealizante))this.errorMostrarMsj.push("El nombre solo debe tener letras");
                            var lengthmin2 = this.apellidorealizante.length;
                            if (lengthmin2 < Min_Length)this.errorMostrarMsj.push("El apellido debe tener mas de tres letras");
                            if (!patron.test(this.apellidorealizante))this.errorMostrarMsj.push("El apellido solo debe tener letras");
                            if (!patrondui.test(this.dui))  this.errorMostrarMsj.push("El DUI debe ser de nueve digitos");
                            if(this.errorMostrarMsj.length) this.errorDatos=1;
                            return this.errorDatos;
                            break;
                            }
                        case '12':
                            {
                            var Min_Length = 3;
                            var lengthmin = this.nombrerealizante.length;
                            if (lengthmin < Min_Length)this.errorMostrarMsj.push("El nombre debe tener mas de tres letras");
                            if (!patron.test(this.nombrerealizante))this.errorMostrarMsj.push("El nombre solo debe tener letras");
                            var lengthmin2 = this.apellidorealizante.length;
                            if (lengthmin2 < Min_Length)this.errorMostrarMsj.push("El apellido debe tener mas de tres letras");
                            if (!patron.test(this.apellidorealizante))this.errorMostrarMsj.push("El apellido solo debe tener letras");
                            if (!patrondui.test(this.dui) && this.Acciondui==1)  this.errorMostrarMsj.push("El DUI debe ser de nueve digitos");
                            if(!this.fechana) this.errorMostrarMsj.push("La fecha de nacimiento no puede estar vacia");
                            if(!this.sexo)this.errorMostrarMsj.push("El sexo no puede estar vacio");
                            var values=this.fechana.split("-");
                            var dia = values[2];
                            var mes = values[1];
                            var ano = values[0];
                            if (ano < 1900)this.errorMostrarMsj.push("El año debe ser mayor a 1990");
                            if(anioac<ano) {
                                this.errorMostrarMsj.push("El año debe ser menor o igual al actual");
                                
                            }
                            if(mesac<mes && ano==anioac) {
                                    this.errorMostrarMsj.push("El mes debe ser menor al actual");
                                    }
                            if(this.errorMostrarMsj.length) this.errorDatos=1;
                            return this.errorDatos;
                            }
                        case '13':
                            {
                            var values=this.fechana.split("-");
                            var dia = values[2];
                            var mes = values[1];
                            var ano = values[0];
                            if (ano < 1900)this.errorMostrarMsj.push("El año debe ser mayor a 1990");
                            if(anioac<ano) {
                                this.errorMostrarMsj.push("El año debe ser menor o igual al actual");
                                
                            }
                            if(mesac<mes && ano==anioac) {
                                    this.errorMostrarMsj.push("El mes debe ser menor al actual");
                                    }
                            if(this.errorMostrarMsj.length) this.errorDatos=1;
                            return this.errorDatos;
                            break;
                            }
                        case '14':
                        {
                            if (this.nombremadre!='' && !patron.test(this.nombremadre))this.errorMostrarMsj.push("El nombre de la madre solo debe tener letras");
                            if (this.apellidomadre!='' && !patron.test(this.apellidomadre))this.errorMostrarMsj.push("El apellido de la madre solo debe tener letras");
                            if (this.nombrepadre!='' && !patron.test(this.nombrepadre))this.errorMostrarMsj.push("El nombre del padre solo debe tener letras");
                            if (this.apellidopadre!='' && !patron.test(this.apellidopadre))this.errorMostrarMsj.push("El apellido del padre solo debe tener letras");
                            if (this.duimadre!='' && !patrondui.test(this.duimadre))this.errorMostrarMsj.push("El DUI de la madre debe ser de nueve digitos");                     
                            if (this.duipadre!='' && !patrondui.test(this.duipadre))this.errorMostrarMsj.push("El DUI del padre debe ser de nueve digitos");
                            if(this.errorMostrarMsj.length) this.errorDatos=1;
                            return this.errorDatos;
                            break;
                        }
                        case '15':
                            {
                                var RE = /^\d*(\.\d{1})?\d{0,1}$/;
                                if (!RE.test(this.monto))  this.errorMostrarMsj.push("El monto solo pueden ser decimales");
                                if(this.errorMostrarMsj.length) this.errorDatos=1;
                                return this.errorDatos;
                                break;
                            }
                        case '16':
                            {
                                var RE = /^\d*(\.\d{1})?\d{0,1}$/;
                                if (!RE.test(this.monto))  this.errorMostrarMsj.push("El monto solo pueden ser decimales");
                                var values=this.fecharealizacion.split("-");
                                var ano = values[0];
                                if (ano < 1989)this.errorMostrarMsj.push("El año debe ser mayor a 1989");
                                if(anioac<ano)this.errorMostrarMsj.push("El año debe ser menor o igual al actual");
                                if(this.errorMostrarMsj.length) this.errorDatos=1;
                                return this.errorDatos;
                                break;

                            }
                        case '17':
                            {
                                if (this.nombrepd1!='' && !patron.test(this.nombrepd1))this.errorMostrarMsj.push("El nombre del padrino solo debe tener letras");
                                if (this.apellidopd1!='' && !patron.test(this.apellidopd1))this.errorMostrarMsj.push("El apellido del padrino solo debe tener letras");                     
                                if (this.duipd1!='' && !patrondui.test(this.duipd1))this.errorMostrarMsj.push("El DUI del padrino debe ser de nueve digitos");
                                if (this.nombrepd2!='' && !patron.test(this.nombrepd2))this.errorMostrarMsj.push("El nombre del segundo padrino solo debe tener letras");
                                if (this.apellidopd2!='' && !patron.test(this.apellidopd2))this.errorMostrarMsj.push("El apellido del segundo padrino solo debe tener letras");                     
                                if (this.duipd2!='' && !patrondui.test(this.duipd2))this.errorMostrarMsj.push("El DUI del segundo padrino debe ser de nueve digitos");
                                if (this.nombrepd3!='' && !patron.test(this.nombrepd3))this.errorMostrarMsj.push("El nombre del tercer padrino solo debe tener letras");
                                if (this.apellidopd3!='' && !patron.test(this.apellidopd3))this.errorMostrarMsj.push("El apellido del tercer padrino solo debe tener letras");                     
                                if (this.duipd3!='' && !patrondui.test(this.duipd3))this.errorMostrarMsj.push("El DUI del tercer padrino debe ser de nueve digitos");
                                if (this.nombrepd4!='' && !patron.test(this.nombrepd4))this.errorMostrarMsj.push("El nombre del cuarto padrino solo debe tener letras");
                                if (this.apellidopd4!='' && !patron.test(this.apellidopd4))this.errorMostrarMsj.push("El apellido del cuarto padrino solo debe tener letras");                     
                                if (this.duipd4!='' && !patrondui.test(this.duipd4))this.errorMostrarMsj.push("El DUI del cuarto padrino debe ser de nueve digitos");
                                if(this.errorMostrarMsj.length) this.errorDatos=1;
                                return this.errorDatos;
                                break;   
                            }
                             case '18':
                            {
                                var RE = /^\d*(\.\d{1})?\d{0,1}$/;
                                if (!RE.test(this.monto))  this.errorMostrarMsj.push("El monto solo pueden ser decimales");
                                var values=this.fecharealizacion.split("-");
                                var ano = values[0];
                                if(this.idsacerdote=='') this.errorMostrarMsj.push("Debe de seleccionar un sacerdote");
                                if(this.cargosacerdote=='') this.errorMostrarMsj.push("Debe de asignar un cargo al sacerdote");
                                if(this.idcare=='') this.errorMostrarMsj.push("Debe de seleccionar una categoria");
                                if(this.idiglesia=='')this.errorMostrarMsj.push("Debe de seleccionar una iglesia");
                                if (ano < 1989)this.errorMostrarMsj.push("El año debe ser mayor a 1989");
                                if(anioac<ano)this.errorMostrarMsj.push("El año debe ser menor o igual al actual");
                                if(this.errorMostrarMsj.length) this.errorDatos=1;
                                return this.errorDatos;
                                break;

                            }
                            case '19':
                            {
                                if (!patron.test(this.nombrepd1))this.errorMostrarMsj.push("El nombre del padrino solo debe tener letras");
                                if (!patron.test(this.apellidopd1))this.errorMostrarMsj.push("El apellido del padrino solo debe tener letras");                     
                                if (this.duipd1!='' && !patrondui.test(this.duipd1))this.errorMostrarMsj.push("El DUI del padrino debe ser de nueve digitos");
                                if(!this.sexopd1)this.errorMostrarMsj.push("El sexo no puede estar vacio");
                                if(this.errorMostrarMsj.length) this.errorDatos=1;
                                return this.errorDatos;
                                break;   
                            }
                            case '20':
                            {
                                if (!patron.test(this.nombrepd2))this.errorMostrarMsj.push("El nombre del segundo padrino solo debe tener letras");
                                if (!patron.test(this.apellidopd2))this.errorMostrarMsj.push("El apellido del segundo padrino solo debe tener letras");                     
                                if (this.duipd2!='' && !patrondui.test(this.duipd2))this.errorMostrarMsj.push("El DUI del segundo padrino debe ser de nueve digitos");
                                if(!this.sexopd2)this.errorMostrarMsj.push("El sexo no puede estar vacio");
                                if(this.errorMostrarMsj.length) this.errorDatos=1;
                                return this.errorDatos;
                                break;   
                            }
                            case '21':
                            {
                                if (!patron.test(this.nombrepd3))this.errorMostrarMsj.push("El nombre del tercer padrino solo debe tener letras");
                                if (!patron.test(this.apellidopd3))this.errorMostrarMsj.push("El apellido del tercer padrino solo debe tener letras");                     
                                if (this.duipd3!='' && !patrondui.test(this.duipd3))this.errorMostrarMsj.push("El DUI del tercer padrino debe ser de nueve digitos");
                                if(!this.sexopd3)this.errorMostrarMsj.push("El sexo no puede estar vacio");
                                if(this.errorMostrarMsj.length) this.errorDatos=1;
                                return this.errorDatos;
                                break;   
                            }
                            case '22':
                            {
                                if (!patron.test(this.nombrepd4))this.errorMostrarMsj.push("El nombre del cuarto padrino solo debe tener letras");
                                if (!patron.test(this.apellidopd4))this.errorMostrarMsj.push("El apellido del cuarto padrino solo debe tener letras");                     
                                if (this.duipd4!='' && !patrondui.test(this.duipd4))this.errorMostrarMsj.push("El DUI del cuarto padrino debe ser de nueve digitos");
                                if(!this.sexopd4)this.errorMostrarMsj.push("El sexo no puede estar vacio");
                                if(this.errorMostrarMsj.length) this.errorDatos=1;
                                return this.errorDatos;
                                break;   
                            }

                            //casos de validaciones de fecha de nacimiento: fecm / fecp / fecp1 / fecp2 / fecp3 / fecp4
                            case 'fecm':
                            {
                                var values=this.fechamadre.split("-");
                                var dia = values[2];
                                var mes = values[1];
                                var ano = values[0];
                                if (ano < 1900)this.errorMostrarMsj.push("El año debe ser mayor a 1990");
                                if(anioac<ano) {
                                    this.errorMostrarMsj.push("El año debe ser menor o igual al actual");
                                    
                                }
                                if(mesac<mes && ano==anioac) {
                                        this.errorMostrarMsj.push("El mes debe ser menor al actual");
                                        }
                                if(this.errorMostrarMsj.length) this.errorDatos=1;
                                return this.errorDatos;
                                break;
                            }
                            case 'fecp':
                            {
                                var values=this.fechapadre.split("-");
                                var dia = values[2];
                                var mes = values[1];
                                var ano = values[0];
                                if (ano < 1900)this.errorMostrarMsj.push("El año debe ser mayor a 1990");
                                if(anioac<ano) {
                                    this.errorMostrarMsj.push("El año debe ser menor o igual al actual");
                                    
                                }
                                if(mesac<mes && ano==anioac) {
                                        this.errorMostrarMsj.push("El mes debe ser menor al actual");
                                        }
                                if(this.errorMostrarMsj.length) this.errorDatos=1;
                                return this.errorDatos;
                                break;
                            }
                            case 'fecp1':
                            {
                                var values=this.fechapad1.split("-");
                                var dia = values[2];
                                var mes = values[1];
                                var ano = values[0];
                                if (ano < 1900)this.errorMostrarMsj.push("El año debe ser mayor a 1990");
                                if(anioac<ano) {
                                    this.errorMostrarMsj.push("El año debe ser menor o igual al actual");
                                    
                                }
                                if(mesac<mes && ano==anioac) {
                                        this.errorMostrarMsj.push("El mes debe ser menor al actual");
                                        }
                                if(this.errorMostrarMsj.length) this.errorDatos=1;
                                return this.errorDatos;
                                break;
                            }
                            case 'fecp2':
                            {
                                var values=this.fechapad2.split("-");
                                var dia = values[2];
                                var mes = values[1];
                                var ano = values[0];
                                if (ano < 1900)this.errorMostrarMsj.push("El año debe ser mayor a 1990");
                                if(anioac<ano) {
                                    this.errorMostrarMsj.push("El año debe ser menor o igual al actual");
                                    
                                }
                                if(mesac<mes && ano==anioac) {
                                        this.errorMostrarMsj.push("El mes debe ser menor al actual");
                                        }
                                if(this.errorMostrarMsj.length) this.errorDatos=1;
                                return this.errorDatos;
                                break;
                            }
                            case 'fecp3':
                            {
                                var values=this.fechapad3.split("-");
                                var dia = values[2];
                                var mes = values[1];
                                var ano = values[0];
                                if (ano < 1900)this.errorMostrarMsj.push("El año debe ser mayor a 1990");
                                if(anioac<ano) {
                                    this.errorMostrarMsj.push("El año debe ser menor o igual al actual");
                                    
                                }
                                if(mesac<mes && ano==anioac) {
                                        this.errorMostrarMsj.push("El mes debe ser menor al actual");
                                        }
                                if(this.errorMostrarMsj.length) this.errorDatos=1;
                                return this.errorDatos;
                                break;
                            }
                            case 'fecp4':
                            {
                                var values=this.fechapad4.split("-");
                                var dia = values[2];
                                var mes = values[1];
                                var ano = values[0];
                                if (ano < 1900)this.errorMostrarMsj.push("El año debe ser mayor a 1990");
                                if(anioac<ano) {
                                    this.errorMostrarMsj.push("El año debe ser menor o igual al actual");
                                    
                                }
                                if(mesac<mes && ano==anioac) {
                                        this.errorMostrarMsj.push("El mes debe ser menor al actual");
                                        }
                                if(this.errorMostrarMsj.length) this.errorDatos=1;
                                return this.errorDatos;
                                break;
                            }

                }
            }
                
            },
      
      mounted() {
            this.llenadolistas();
            this.llenadolistazona('','');
        }
}

</script>