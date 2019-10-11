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
                                <button type="button" class="btn btn-secondary" @click="siguiente('1')">Siguiente</button>
                            </div>  
                        </div>
                        <div v-show="cambiarm==1 || cambiarm==5">
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
                                    <input tabindexgt="0" v-model="dui" class="form-control" placeholder="999999999">
                                </div>
                            </div>
                            <div class="col-md-4 modal-fo">
                                <button type="button" class="btn btn-secondary" @click="siguiente('6')">Regresar</button>
                                <button type="button" class="btn btn-secondary" @click="siguiente('2')">Siguiente</button>
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
                                    <input type="text"  v-model="monto" class="form-control">
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
                                    <input type="date" class="form-control datepicker" name="date" v-model="fecharealizacion" >
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
                                            <label class="col-md-6 form-control-label" >{{fecharealizacion}}</label>
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
                                            <button type="submit"  class="btn btn-primary" @click="siguiente('7')">Continuar</button>
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
      data(){
            return{
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
                idpadre:'',
                idsacerdote:'',
                id:'',
                tipo:'',
                nombresacerdote:'',
                apellidosacerdote:'',
                cargosacerdote:'',
                fecharealizacion:'',
                fechana:'',
                fechana2:'',
                dui:'',
                sexo:'',
                Acciondui:0,
                modal : 0,
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
                accionbotones:0,

                errorDatos:0,
                errorMostrarMsj:[],
                
                
            }
        },
        methods:{
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
                            this.cambiarm=2;
                            break;
                        }
                    case '3':
                        {
                            this.cambiarm=3;
                            this.llenadolista('','');
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
                this.fechana='';
                this.dui='';
                this.Acciondui=0;
                this.accion=0;
                this.accionbotones=0;
                this.modal=0;
                this.sexo='';
                this.id='';
                this.verificacion=0;
                this.cambiarm=0;
                this.cambiarmb=0;
                

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
                this.fechana='';
                this.dui='';
                this.accion=0;
                this.accionbotones=0;
                this.modal=0;
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
                this.cambiarm=0;
                this.cambiarmb=0;
                

            },
            //Mt. cuando le da modificar en el modal
            cerrarmodal(){
                    this.modal=0;
                   
            },
            
            
            //Mostrar datos para confirmar el ingreso
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
                    this.accion=3;
                }

            },
            //autocompletar sacerdotes
            llenadolista(buscar,criterio){
                let me=this;
                var url='/persona/buscarsacerdote';
                axios.get(url) .then(function (response) {
                    me.arraysacerdote=response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            //autocompletar sacerdotes
            llenadoarray(){
                
                    this.arraycargo= new Array('DIACONO','PADRE','ARZOBISPO','CARDENAL','NUNCIO APOSTOLICO','MONSEÑOR');
            
                
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
            },
            llenarcamposp(data=[]){
                this.nombrepadre= data['nombre_persona'];
                this.apellidopadre= data['apellido_persona'];
                this.idpadre=data['id'];
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
            //Validar datos
            validarvalores(d){
                this.errorDatos=0;
                this.errorMostrarMsj=[];
                var RE = /^([0-9])*$/;
                switch(d){
                    case '1':
                        {
                            var Min_Length = 5;
                            var lengthmin = this.alcaldia.length;
                            if (lengthmin < Min_Length )this.errorMostrarMsj.push("La alcaldía debe tener más de 5 letras");
                            if (RE.test(this.alcaldia))this.errorMostrarMsj.push("La alcaldía solo debe tener letras");
                            if(this.errorMostrarMsj.length) this.errorDatos=1;
                            return this.errorDatos;
                            break;
                        }
                    case '2':
                        {
                            var Min_Length = 5;
                            var lengthmin = this.alcaldia.length;
                            if (lengthmin < Min_Length)this.errorMostrarMsj.push("La alcaldía debe tener más de 5 letras");
                            if(!this.libro) this.errorMostrarMsj.push("El numero de libro no puede estar vacío");
                            if (!RE.test(this.libro))  this.errorMostrarMsj.push("El numero de libro debe ser un numero entero");
                            if(this.errorMostrarMsj.length) this.errorDatos=1;
                            return this.errorDatos;
                            break;
                        }
                    case '3':
                        {
                            var Min_Length = 5;
                            var lengthmin = this.alcaldia.length;
                            if (lengthmin < Min_Length)this.errorMostrarMsj.push("La alcaldía debe tener más de 5 letras");
                            if(!this.libro) this.errorMostrarMsj.push("El numero de libro no puede estar vacío");
                            if (!RE.test(this.libro))  this.errorMostrarMsj.push("El numero de libro debe ser un numero entero");
                            if(!this.partida) this.errorMostrarMsj.push("En numero de partida no puede estar vacío");
                            if (!RE.test(this.partida))  this.errorMostrarMsj.push("El numero de partida debe ser un numero entero");
                            if(this.errorMostrarMsj.length) this.errorDatos=1;
                            return this.errorDatos;
                            break;
                        }
                    case '4':
                        {
                            var Min_Length = 5;
                            var lengthmin = this.alcaldia.length;
                            if (lengthmin < Min_Length)this.errorMostrarMsj.push("La alcaldía debe tener más de 5 letras");
                            if(!this.libro) this.errorMostrarMsj.push("El numero de libro no puede estar vacío");
                            if (!RE.test(this.libro))  this.errorMostrarMsj.push("El numero de libro debe ser un numero entero");
                            if(!this.partida) this.errorMostrarMsj.push("En numero de partida no puede estar vacío");
                            if (!RE.test(this.partida))  this.errorMostrarMsj.push("El numero de partida debe ser un numero entero");
                            if(!this.folio) this.errorMostrarMsj.push("El numero de folio no puede estar vacío");
                            if (!RE.test(this.folio))  this.errorMostrarMsj.push("El numero de folio debe ser un numero entero");
                            if(this.errorMostrarMsj.length) this.errorDatos=1;
                            return this.errorDatos;
                            break;
                        }
                    case '5':
                        {
                            var Min_Length = 5;
                            var lengthmin = this.alcaldia.length;
                            if (lengthmin < Min_Length)this.errorMostrarMsj.push("La alcaldía debe tener más de 5 letras");
                            if(!this.libro) this.errorMostrarMsj.push("El numero de libro no puede estar vacío");
                            if (!RE.test(this.libro))  this.errorMostrarMsj.push("El numero de libro debe ser un numero entero");
                            if(!this.partida) this.errorMostrarMsj.push("En numero de partida no puede estar vacío");
                            if (!RE.test(this.partida))  this.errorMostrarMsj.push("El numero de partida debe ser un numero entero");
                            if(!this.folio) this.errorMostrarMsj.push("El numero de folio no puede estar vacío");
                            if (!RE.test(this.folio))  this.errorMostrarMsj.push("El numero de folio debe ser un numero entero");
                            if(!this.ano) this.errorMostrarMsj.push("El año no puede estar vacío");
                            if (!RE.test(this.ano))  this.errorMostrarMsj.push("El año debe ser un numero entero");
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
                        console.log(respuesta);
                    if(respuesta==1){
                        me.id=response.data.realizante.idpersona;
                        me.llenarmodal(me.id);
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
                if(m!='' && p!=''){ //introduje ambos duis
                    this.tipo=1;
                }
                if(m=='' && p!=''){ //introduje ambos duis pero el de mama no esta
                    this.tipo=2;
                }
                if(p=='' && m!=''){ //introduje ambos duis pero el de papa no esta
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
                if(duim!='' &&  m==''){ // es nueva mama, no tiene papa
                    this.tipo=8;
                }
                if(duip!='' &&  p==''){ // es nuevo papa, no tiene mama
                    this.tipo=9;
                }
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
                }) .then(function (response) {
                    me.modal=0;
                    me.cambiarm=0;
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
                    me.cerrarm();
                   
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
            } 


            },
            
        mounted() {
            this.llenadoarray();
            this.selectCategoria();
            
        }
    }
</script>
<style>
    
</style>