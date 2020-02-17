<template>
   <main class="main">
            <!-- Breadcrumb -->
            <div class="container-fluid">
            <!-- tiululo -->
                <div class="card">
                    <div class="card-header">
                        <label class="titulo-encabezados">Registro de acta de primera comunión</label>
                    </div>
                    <!-- cuerpo -->
                    <div class="card-body">
                        <div v-show="cambiarm==0 || cambiarm==6">
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
                                <div v-for="error in errorMostrarMsj" :key="error" v-text="error">
                                </div>
                                </div>
                                </div> 
                            <div class="col-md-4 modal-fo">
                                <button type="button" class="btn btn-primary" @click="siguiente('1')">Siguiente</button>
                            </div>  
                        </div>
                        <div v-show="cambiarm==1 || cambiarm==5">
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
                                        <select class="form-control" v-model="idzona" @click="iglesias(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Iglesia:</label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idiglesia"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesia in arrayiglesia" :key="iglesia.id" v-bind:value="iglesia.id" >{{iglesia.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div v-show="errorDatos" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsj" :key="error" v-text="error"></div>
                                </div>
                            </div> 
                            <div class="col-md-4 modal-fo">
                                <button type="button" class="btn btn-secondary" @click="siguiente('6')">Regresar</button>
                                <button type="button" class="btn btn-primary" @click="siguiente('2')">Siguiente</button>
                            </div>  
                        </div>
                        <div v-show="cambiarm==2 || cambiarm==4">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos de los padres</b></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos de la madre</b></label>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">DUI</label>
                                <div class="col-md-5">
                                    <input tabindexgt="0" v-model="duimadre" class="form-control" placeholder="999999999"  @keydown.tab="duim()">
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
                                    <input type="date" class="form-control datepicker" name="date" v-model="fechanam">
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
                                    <input tabindexgt="0" v-model="duipadre" class="form-control" placeholder="999999999" @keydown.tab="duip()" >
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
                                    <input type="date" class="form-control datepicker" name="date" v-model="fechanap" >
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
                                <button type="button" class="btn btn-secondary" @click="siguiente('5')">Regresar</button>
                                <button type="button" class="btn btn-primary" @click="siguiente('3')">Siguiente</button>
                            </div> 
                        </div>
                        <div v-show="cambiarm==3">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input"><b>Datos de la celebración</b></label>
                            </div>
                                <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Ofrenda</label>
                                <div class="col-md-5">
                                    <input type="text"  v-model="monto" class="form-control" @keydown.tab="validarvalores('15')">
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
                                        <select class="form-control" v-model="idsacerdote"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="sacerdote in arraysacerdote" :key="sacerdote.id" v-bind:value="sacerdote.id" >{{sacerdote.nombre_persona}}, {{sacerdote.apellido_persona}}</option>
                                        </select >
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
                                <div v-for="error in errorMostrarMsj" :key="error" v-text="error">
                                </div>
                                </div>
                                </div> 
                            <div v-show="cambiarmb==1">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-secondary" @click="siguiente('4')">Regresar</button>
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
            <div class="modal fade"  tabindex="-1" :class="{'mostrar': modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label" for="text-input">Fecha de nacimiento:</label>
                                        <label class="col-md-6 form-control-label" >{{fechana}}</label>
                                    </div>
                                    <div v-show="accionbotones==2">
                                        <div class="form-group row">
                                            <label class="col-md-4 form-control-label" for="text-input">Realizó su Primera Comunión:</label>
                                            <label class="col-md-6 form-control-label" >{{fecharealizaciones}}</label>
                                        </div>
                                        <div class="col-md-4 modal-fo">
                                            <button type="button" class="btn btn-secondary" @click="cerrarmodal()">Modificar</button>
                                            <button type="submit"  class="btn btn-primary" @click="registrar()">Guardar</button>
                                        </div>
                                    </div>
                                    <div v-show="accionbotones==1">
                                        <div class="col-md-4 modal-fo">
                                            <button type="button" class="btn btn-secondary" @click="cerrar()">Cancelar</button>
                                            <button type="submit"  class="btn btn-primary" @click="siguiente('7')">Continuar</button>
                                        </div>
                                    </div>                         
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- fin del modal -->

            <!--Inicio del modal verificar madre-->
          <!--  <div class="modal fade"  tabindex="-1" :class="{'mostrar': modal3}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                        <label class="col-md-4 form-control-label" for="text-input">Nombre madre:</label>
                                                <label class="col-md-6 form-control-label" >{{nombremadre}}, {{apellidomadre}}</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 form-control-label" for="text-input">Fecha de nacimiento:</label>
                                        <label class="col-md-6 form-control-label" >{{fechanam}}</label>
                                    </div>
                                    <div class="form-group row">
                                            <label class="col-md-4 form-control-label" for="text-input">Hijos:</label>
                                        <table>
                                                <tr v-for="hijos in arrayhijos" :key="hijos.id">
                                                    <td v-text="hijos.nombre_persona"></td>
                                                    <td v-text="hijos.apellido_persona"></td>    
                                                </tr>                         
                                        </table>
                                    </div>
                                            <div class="col-md-4 modal-fo">
                                                <button type="button" class="btn btn-secondary" @click="datosIncorrectosm()">Cancelar</button>
                                                <button type="submit"  class="btn btn-primary" @click="datosCorrectosm()">Aceptar</button>
                                            </div>                       
                                </div>
                        </div>
                    </div> 
                </div>
            </div>-->
            <!-- fin del modal -->
   
           
           
        </main>
</template>

 
<script>
    export default {
      data(){
            return{
               /* arrayhijos:[], //array para llenar los nombres de los hijos
                cambiarmodalpadre:0,*/

                idzona:'',
                idiglesia:'',
                zona:'',
                iglesia:'',
                nombre_zona:'',
                nombre_iglesia:'',
                arrayzona:[],
                arrayiglesia:[],
                arrayiglesiaID:[],

                idzonam:'',
                idiglesiam:'',
                iglesiam:'',
                nombre_iglesiam:'',
                arrayiglesiam:[],
                arrayiglesiaIDm:[],

                idzonap:'',
                idiglesiap:'',
                iglesiap:'',
                nombre_iglesiap:'',
                arrayiglesiap:[],
                arrayiglesiaIDp:[],


                tipo:'',
                monto:0,
                nombrerealizante:'',
                apellidorealizante:'',
                nombremadre:'',
                apellidomadre:'',
                duimadre:'',
                nombrepadre:'',
                apellidopadre:'',
                duipadre:'',
                idmadre:'',
                //idmadretemp:'', //id temporal de madre
                idpadre:'',
               // idpadretemp:'', //id temporal de padre
                idsacerdote:'',
                id:'',
                nombresacerdote:'',
                cargosacerdote:'',
                fecharealizacion:'',
                fecharealizaciones:'',
                fechana:'',
                fechanam:'', //fecha nacimiento madre
                fechanap:'', //fecha nacimiento padre
                fechanaes:'',
                fechana2:'',
                dui:'',
                sexo:'',
                Acciondui:0,
                modal : 0,
               // modal3:0, //modal para verificar madre
                idcare:'',
                arraysacerdote:[],
                arraycategorias:[],
                arraycargo:[],
                tituloModal : '',
                accion:0,
                accionsexo:0,
                cambiarm:0,
                cambiarmb:0,
                alcaldia:'',
                libro:'',
                partida:'',
                folio:'',
                ano:'',
                verificacion:0,
                //verificacion2:0, //no se para que sirve exactamente
                accionbotones:0,

                errorDatos:0,
                errorMostrarMsj:[],
                
                
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

            iglesias(idzona){  //realizante

                let me=this;
                var arrayiglesiaID=[];
             axios.post('/feligreses/buscarIglesia',{
               'id':this.idzona}) 
              .then(function (response) { 
                arrayiglesiaID = response.data;     
                me.llenar(arrayiglesiaID);  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
           llenar(d=[]){
                this.arrayiglesia=d;
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


            //Mt. para calcular edad y ver si se muestra o no el div que contiene el dui del realizante
            cambiar(){ 
                var values=this.fechana.split("-");
                var dia = values[2];
                var mes = values[1];
                var ano = values[0];
                

                if((dia=='') || (mes=='') || (ano==''))
                {
                    this.Acciondui=0;
                }else
                {
                    // cogemos los valores actuales
                var fecha_hoy = new Date();
                var ahora_ano = fecha_hoy.getYear();
                var ahora_mes = fecha_hoy.getMonth()+1;
                var ahora_dia = fecha_hoy.getDate();
 
                this.fechana2 = (ahora_ano + 1900) - ano;

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
            //Para mostar las tres partes del formulario
            siguiente(d){
                switch(d){
                    case '1':
                        {
                            this.validarvalores('5');
                            if(this.errorDatos==1){
                                this.cambiarm=0;
                            }
                            else{
                                this.verificarpersona();
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
                            this.cambiarm=2;
                            }
                            break;
                        }
                    case '3':
                        {
                            this.validarvalores('14');
                            if(this.errorDatos==1){
                                this.cambiarm=2;
                            }else{
                            this.cambiarm=3;
                            }
                            break;
                        }
                    case '4':
                        {   
                            
                            this.cambiarm=4;
                            break;
                        }
                    case '5':
                        {
                            this.cambiarm=5;
                            break;
                        } 
                    case '6':
                        {
                            this.cambiarm=6;
                            break;
                        }
                    case '7':
                    {
                            this.cambiarm=3;
                            this.modal=0;
                            break;
                    }  

                }

            },
    
           
            //Mt. cuando da eliminar en el formulario
            cerrar(){
                this.alcaldia='';
                this.libro='';
                this.partida='';
                this.folio='';
                this.ano='';
                this.monto=0;
                this.nombrerealizante='';
                this.apellidorealizante='';
                this.nombremadre='';
                this.apellidomadre='';
                this.duimadre='';
                this.nombrepadre='';
                this.apellidopadre='';
                this.duipadre='';
                this.nombresacerdote='';
                this.cargosacerdote='';
                this.fecharealizacion='';
                this.fecharealizaciones='';
                this.fechana='';
                this.fechanam=''; //fecha nacimiento madre
                this.fechanap=''; //fecha nacimiento padre
                this.fechanaes='';
                this.dui='';
                this.Acciondui=0;
                this.accion=0;
                this.accionbotones=0;
                this.modal=0;
                this.modal3=0;
                this.sexo='';
                this.id='';
                this.verificacion=0;
                //this.verificacion2=0; //no se para que sirve exactamente
                this.cambiarm=0;
                this.cambiarmb=0;
                this.idzona=0;    //zona realizante
                this.idiglesia=0;
                this.idzonam=0;   //zona madre
                this.idiglesiam=0;
                this.idzonap=0;   //zona padre
                this.idiglesiap=0;
                

            },
            cerrarm(){ //botones cancelat
                this.monto=0;
                this.nombrerealizante='';
                this.apellidorealizante='';
                this.nombremadre='';
                this.apellidomadre='';
                this.duimadre='';
                this.duipadre='';
                this.nombrepadre='';
                this.apellidopadre='';
                this.duipadre='';
                this.nombresacerdote='';
                this.cargosacerdote='';
                this.fecharealizacion='';
                this.fecharealizaciones='';
                this.fechana='';
                this.fechanam=''; //fecha nacimiento madre
                this.fechanap=''; //fecha nacimiento padre
                this.fechanaes='';
                this.dui='';
                this.accion=0;
                this.accionbotones=0;
                this.modal=0;
                this.modal3=0;
                this.sexo='';
                this.id='';
                this.alcaldia='';
                this.libro='';
                this.partida='';
                this.folio='';
                this.ano='';
                this.idpadre='';
                this.idmadre='';
                this.verificacion=0;
                //this.verificacion2=0; //no se para que sirve exactamente
                this.cambiarm=0;
                this.cambiarmb=0;
                this.idzona=0;    //zona realizante
                this.idiglesia=0;
                this.idzonam=0;   //zona madre
                this.idiglesiam=0;
                this.idzonap=0;   //zona padre
                this.idiglesiap=0;

            },
            //Mt. cuando le da modificar en el modal
            cerrarmodal(){
                    this.modal=0;
                   /* if(this.cambiarmodalpadre==1){
                       this.modal3=0;
                    }else{
                        this.modal3=0;
                    }*/
                    this.modal3=0;
                    
                   
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
            
            //Mostrar datos para confirmar el ingreso
            abrirmodal(){
                this.validarvalores('17');
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
               
                var t = this.fechana;
               this.fechanaes= t.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');

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
                            }

            },
            //autocompletar sacerdotes
            llenadolistas(){
                let me=this;
                this.arraycargo= new Array('DIACONO','PADRE','ARZOBISPO','CARDENAL','NUNCIO APOSTOLICO','MONSEÑOR');
                var url='/persona/buscarsacerdote3';
                axios.get(url) .then(function (response) {
                     me.arraysacerdote=response.data.sacerdote;
                    me.arraycategorias=response.data.categorias;
                
                })
                .catch(function (error) {
                    console.log(error);
                });
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
            
            llenarcamposm(data=[]){
                this.nombremadre= data['nombre_persona'];
                this.apellidomadre= data['apellido_persona'];
                this.idmadre=data['id']; 
                this.fechanam=data['fecha_nacimiento']; //fecha nacimiento de la madre
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
                this.fechanap=data['fecha_nacimiento']; //fecha nacimiento del padre
                this.idzonap=data['idzonaa'];
                this.llenadolistazona();
                if(this.idzonap)
                    {
                        this.iglesiasp(this.idzonap);
                        this.idiglesiap=data['idiglesia'];
                    }
            },
            llenarmodal(id){
                let me=this;
                var url='/persona/obtener?id=' + id;
                    axios.get(url) .then(function (response) {
                        var d = response.data.solo;            
                        if(d==1){
                           /* response.data.realizante.forEach(function(element) {
                            var texto = element.fecha_nacimiento;
                            element.fecha_nacimiento= texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
                            });*/
                            me.nombrerealizante= response.data.realizante.nombre_persona;
                            me.apellidorealizante=response.data.realizante.apellido_persona;
                            me.sexo=response.data.realizante.sexo;
                            me.fechana=response.data.realizante.fecha_nacimiento;
                            //me.fechanaes=response.data.realizante.fecha_nacimiento;
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
                            //me.fechanaes=response.data.realizante.fecha_nacimiento;
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
                            //me.fechanaes=response.data.realizante.fecha_nacimiento;
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
                            //me.fechanaes=response.data.realizante.fecha_nacimiento;
                        }
                        me.verificacion=1;
                        me.abrirmodal2();
                    }).catch(function (error) {
                    console.log(error);
                    });

            },

            // ---SIN DUI 
            //**********************************************************************************************************************************
           /* verificarpersonam(){ //solo cuando hay datos de mamá
                let me=this;
                var nombremadre=this.nombremadre.toUpperCase();
                var apellidomadre=this.apellidomadre.toUpperCase();
                var fechanam=this.fechanam;

               var url='/persona/existenciamadre?nombre_persona=' + nombremadre + '&apellido_persona=' + apellidomadre + '&fecha_nacimiento=' + fechanam;
                    axios.get(url) .then(function (response) {
                   var existencia=response.data.existenciamadre; //si encontro el id
                   var hijos=response.data.hijos; //si encontro datos de hijos
                   if(existencia==1){ //esos datos no se han ingresado antes, es decir no existe 
                        me.cambiarm=3; //cambiar a datos de celebración 
                        me.cambiarmb=1;
                   }

                   if(existencia==2 && hijos==1){ //la persona existe pero no tiene hijos
                       me.idmadre=response.data.idmm.id; //no estoy segura 
                       me.cambiarm=3;
                       me.cambiarmb=1;
                   }

                   if(existencia==2 && hijos==2){ //la persona existe y tiene hijos
                        me.idmadretemp=response.data.idmm.id; //no estoy segura de esto 
                        me.llenarmodalmadre(me.idmadretemp);
                   }

                    }).catch(function (error) {
                    console.log(error);
                    });

            },*/

            /*verificarpersonap(){ //solo cuando hay datos de papa
                
                me.llenarmodalpadre(idpadretemp);
            },*/

          /*  verificarpersonamp(){ //cuando hay datos de ambos
                let me=this;
                var nombremadre=this.nombremadre.toUpperCase();
                var apellidomadre=this.apellidomadre.toUpperCase();
                var fechanam=this.fechanam;

               var url='/persona/existenciamadre?nombre_persona=' + nombremadre + '&apellido_persona=' + apellidomadre + '&fecha_nacimiento=' + fechanam;
                    axios.get(url) .then(function (response) {
                   var existenciam=response.data.existenciamadre; //si encontro el id de madre
                   var existenciap=response.data.existenciapadre; //si encontro el id de padre
                   var hijosm=response.data.hijosm; //si encontro datos de hijos **madre
                   var hijosp=response.data.hijosp; //si encontro satos de hijos **padre
                   
                   if(existenciam==1&&existencip==2){ //madre no existe pero padre existe
                       me.verificarpersonam();
                   }
                   if(existenciam==2&&existenciap=1){
                       me.verificarpersonap();
                   }                   
                   if(existenciam==1&&existenciap==1){ //esos datos no se han ingresado antes, es decir no existe 
                        me.cambiarm=3; //cambiar a datos de celebración 
                        me.cambiarmb=1;
                   }

                   if(existenciam==2 && hijosm==1 && existenciap==2 && hijosp==1){ //la madre y el padre existen pero no tiene hijos
                            me.idmadre=response.data.idmm.id; //no estoy segura 
                            me.idpadre=response.data.idpp.id;
                            me.cambiarm=3;
                            me.cambiarmb=1;
                        else{
                            if(existenciam==2 && hijosm==1){
                                if(existencip==2 && hijosp==2){
                                    me.idpadretemp=response.data.idmm.id
                                    me.llenarmodalpadre(me.idpadretemp);
                                }
                            }

                            if(existenciap==2 && hijosp==1){
                                if(existenciam==2 && hijosm==2){
                                    me.idmadretemp=response.data.idmm.id
                                    me.llenarmodalpmadre(me.idmadretemp);
                                }
                            }
                        }
                       
                   }
                    me.idmadre=response.data.idmm.id; //no estoy segura 
                       me.cambiarm=3;
                       me.cambiarmb=1;


                   if(existencia==2 && hijos==2){ //la persona existe y tiene hijos
                        me.idmadretemp=response.data.idmm.id; //no estoy segura de esto 
                        me.llenarmodalmadre(me.idmadretemp);
                   }

            },*/

            /* llenarmodalmadre(idmadretemp){
                let me=this;
                var url='/persona/obtenerDatosMadre?idmadre=' + idmadretemp;
                    axios.get(url) .then(function (response) {
                    
                        me.idmadretemp=response.data.datosmadre.id;
                        me.nombremadre= response.data.datosmadre.nombre_persona;
                        me.apellidomadre=response.data.datosmadre.apellido_persona;
                        me.fechanam=response.data.datosmadre.fecha_nacimiento;
                        me.arrayhijos=response.data.datoshijos;

                        me.abrirmodalm();
                    }).catch(function (error) {
                    console.log(error);
                    });

            },*/

            /*abrirmodalm(){
                this.modal3=1;
                this.tituloModal='Confirmar datos de la madre';
            },*/
            /*llenarmodalpadre(idpadretemp){

            }*/

            /*datosCorrectosm(){ //botón aceptar
                let me=this;
                me.idmadre=me.idmadretemp;
                me.cambiarm=3; //esto quizas no iria aqui, sino que se llamaria a otra función la cual se verificaria si el 
                                //nombre padre, apellido padre y fecha nacimiento padre existe o algo asi aunque quizas no

                /*if(me.nombrepadre==''&& me.apellidopadre==''&& me.fechanap==''){
                    me.cambiarm=3;
                }else{
                    me.cambiarmodalpadre=1;
                    me.cerrarmodal();
                }
            },*/

           /* datosIncorrectosm(){ //botón cancelar
            
            },*/

            //**********************************************************************************************************************************

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
                            if(this.nombremadre!='' && this.apellidomadre!=''){
                                if(!this.fechanam){
                                this.errorMostrarMsj.push("La fecha de nacimiento no puede estar vacia");
                                    }else{

                                var fecha = new Date();
                                var actualYear = fecha.getFullYear();
                                var actualMes = fecha.getMonth();
                                var values = this.fechanam.split("-");
                                var anio = values[0];

                                if(anio < 1900)this.errorMostrarMsj.push("El año debe de ser mayor a 1900");
                                if((actualYear)<anio)this.errorMostrarMsj.push("El año debe ser menor a" + (actualYear));
                                        }
                            }
                            if (this.nombrepadre!='' && !patron.test(this.nombrepadre))this.errorMostrarMsj.push("El nombre del padre solo debe tener letras");
                            if (this.apellidopadre!='' && !patron.test(this.apellidopadre))this.errorMostrarMsj.push("El apellido del padre solo debe tener letras");
                            if(this.nombrepadre!='' && this.apellidopadre!=''){
                                if(!this.fechanap){
                                this.errorMostrarMsj.push("La fecha de nacimiento no puede estar vacia");
                                    }else{

                                var fecha = new Date();
                                var actualYear = fecha.getFullYear();
                                var actualMes = fecha.getMonth();
                                var values = this.fechanap.split("-");
                                var anio = values[0];

                                if(anio < 1900)this.errorMostrarMsj.push("El año debe de ser mayor a 1900");
                                if((actualYear)<anio)this.errorMostrarMsj.push("El año debe ser menor a " + (actualYear));
                                        }
                            }
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
                                var RE = /^\d*(\.\d{1})?\d{0,1}$/;
                                if (!RE.test(this.monto))  this.errorMostrarMsj.push("El monto solo pueden ser decimales");
                                var values=this.fecharealizacion.split("-");
                                var ano = values[0];
                                if(this.idsacerdote=='') this.errorMostrarMsj.push("Debe de seleccionar un sacerdote");
                                if(this.cargosacerdote=='') this.errorMostrarMsj.push("Debe de asignar un cargo al sacerdote");
                                if(this.idcare=='') this.errorMostrarMsj.push("Debe de seleccionar una categoria");
                                if (ano < 1989)this.errorMostrarMsj.push("El año debe ser mayor a 1989");
                                if(anioac<ano)this.errorMostrarMsj.push("El año debe ser menor o igual al actual");
                                if(this.errorMostrarMsj.length) this.errorDatos=1;
                                return this.errorDatos;
                                break;

                            }

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
                

                var url='/partida/busqueda?alcaldia=' + alcaldia + '&libro=' + libro + '&partida=' + partida + '&folio=' + folio + '&ano=' + ano;
                    axios.get(url) .then(function (response) {
                        var respuesta=response.data.solo;
                    if(respuesta==1){
                        me.id=response.data.realizante.idpersona;
                        me.llenarmodal(me.id);
                        //me.cambiarm=1;
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
                    }else{
                        me.idmadre='';
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
                    }else{
                        me.idpadre='';
                    }
                    }).catch(function (error) {
                    console.log(error);
                    });
                }
                    
                },
                selectCategoria(){
                 let me=this;
                var url='/categoriaresumen/selectCategoriaRe';
                axios.get(url) .then(function (response) {
                    // handle success
                    var respuesta= response.data;
                    me.arraycategorias=respuesta.categorias;
                })
                .catch(function (error) {
                    // handle error
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
                var nomm=this.nombremadre;
                var nomp=this.nombrepadre;
                if(length1 == tamaño){
                if(m!='' && p!=''){ //introduje ambos duis //existen datos de ambos
                    this.tipo=1;
                }
                if(m=='' && p!='' && duim!=''){ //introduje ambos duis pero el de mama no esta //datos nuevos de la mama, existe datos de papa
                    this.tipo=2;
                }
                if(p=='' && m!='' && duip!=''){ //introduje ambos duis pero el de papa no esta //datos nuevos del papa, existe datos de mama
                    this.tipo=3;
                }
                if(m=='' && p==''){ //introduje ambos duis y ninguno esta  //datos nuevos de ambos
                    this.tipo=4;
                }
                if(p!='' && duim==''){ // solo introduje el dui del papa y no hay datos de mama //existen datos de papa y solo de papa
                    this.tipo=5;
                }
                if(m!='' && duip==''){ // solo introduje el dui de la mama y no hay datos de papa //existen datos de mama y solo de mama
                    this.tipo=6;
                }
                if(duip=='' && duim==''){ //no hay datos de ambos //no hay ni habra datos de papa y mama
                    this.tipo=7;
                }
                if(duim!='' &&  m=='' && duip==''){ // es nueva mama, no tiene papa //datos nuevos de mama, no hay papa
                    this.tipo=8;
                }
                if(duip!='' &&  p=='' && duim==''){ // es nuevo papa, no tiene mama //datos nuevos de papa, no hay mama
                    this.tipo=9;
                }
                console.log(this.tipo, m, p);
                   axios.put('/persona/registrar',{
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
                        'nacimiento':this.fechana,
                        'nacimientom':this.fechanam, //fecha nacimiento madre
                        'nacimientop':this.fechanap, //fecha nacimiento padre
                        'alcaldia': this.alcaldia.toUpperCase(),
                        'libro':this.libro,
                        'partida':this.partida,
                        'folio':this.folio,
                        'ano':this.ano,
                        'monto': this.monto,
                        'idcate':this.idcare,
                        'sacerdote':this.idsacerdote,
                        'fecha': this.fecharealizacion,
                        'titulo': this.cargosacerdote,
                        'idzona':this.idzona,        //zona realizante
                        'idiglesia':this.idiglesia,   //iglesia realizante
                        'idzonam':this.idzonam,    //zona mamá
                        'idiglesiam':this.idiglesiam, //iglesia mamá
                        'idzonap':this.idzonap,  //zona papá
                        'idiglesiap':this.idiglesiap, //iglesia papá
                        

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
                    me.guardarsacramento();
                }
            },
            guardarsacramento(){
                let me=this;
                var tamaño =0;
                var length1 = this.id.length;
                axios.put('/sacramento/registrar',{
                'fecha': this.fecharealizacion,
                'realizante': this.id,
                'sacerdote':this.idsacerdote,
                'monto':this.monto,
                'idcate':this.idcare,
                'titulo': this.cargosacerdote,
                }) .then(function (response) {
                     me.modal=0;
                     me.cambiarm=0;
                     me.msjExito();
                     me.cerrarm();
                   
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            //MENSAJE DE ÉXITO
            msjExito(){
                swal({
                    type: 'success',
                    title: 'Datos guardados con éxito',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
             
            },
            
        mounted() {
            this.llenadolistas();
            this.llenadolistazona('','');
            
        }
    }
</script>
<style>
    
</style>