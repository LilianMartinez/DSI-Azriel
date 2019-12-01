<template>
   <main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <label class="titulo-encabezados">Registrar Feligres</label>
                    </div>
                    <div class="card-body">
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombres del feligres:<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="nombre_persona" class="form-control" placeholder="Nombre del feligres">
                                    </div>
                            </div>
                             <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Apellidos del feligres<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="apellido_persona" class="form-control" placeholder="Apellido del Feligres">
                                    </div>
                            </div>
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha de Nacimiento</label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control datepicker" name="date" v-model="fechana">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Zona:<b class="alerta">*</b></label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idzona" @click="iglesias(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Iglesia:<b class="alerta">*</b></label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idiglesia"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesia in arrayiglesia" :key="iglesia.id" v-bind:value="iglesia.id" >{{iglesia.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                            </div>
                                <div v-show="errorDatos" class="form-group row div-error">
                                <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsj" :key="error" v-text="error">
                                </div>
                                </div>
                                </div>              
                            </form>
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary" @click="registrarfeligres()">Guardar</button>
                        </div>
                       
                    </div>
                </div>
                <!-- tabla Listado -->
            </div>
   
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade"  tabindex="-1" :class="{'mostrar': modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombres del feligres<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="nombre_iglesia" class="form-control" placeholder="Nombre Iglesia">
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Zona</label> <!-- ZONAAAAAAAAAAA-->
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idzona"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                            </div>
                             <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Iglesia</label> <!-- No importa-->
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idzona"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id" >{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                            </div>
                                <div v-show="errorDatos" class="form-group row div-error">
                                <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsj" :key="error" v-text="error">
                                </div>
                                </div>
                                </div>              
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrariglesias()">Guardar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizariglesias()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
             <!-- Inicio del modal Eliminar -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" :class="{'mostrar': modal2}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">¿Esta seguro de eliminar esta Iglesia?</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="form-group row">
                                            <b class="alerta"> <label class="col-md-1 form-control-label" for="text-input">Nombre de la iglesia</label></b>
                                            <b class="alerta"><label class="col-md-3 form-control-label" for="text-input">{{nombre_iglesia}}</label></b>   
                                </div>
                                <div class="form-group row">
                                            <b class="alerta"> <label class="col-md-1 form-control-label" for="text-input">Zona</label></b>
                                            <b class="alerta"><label class="col-md-3 form-control-label" for="text-input">{{nombre_zona}}</label></b>   
                                </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-danger" @click="eliminar()">Eliminar</button>
                        </div>
                    </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Fin del modal Eliminar -->
        </main>
</template>

<script>
    export default {
      data(){
            return{
                idzona:'',
                idiglesia:'',
                zona:'',
                iglesia:'',
                nombre_zona:'',
                nombre_iglesia:'',
                nombre_persona:'',
                apellido_persona:'',
                arrayzona:[],
                arrayiglesia:[],
                fechana:'',
                modal : 0,
                modal2: 0,
                tituloModal : '',
                tipoAccion:0,
                criterio:'nombre_iglesia', 
                buscar: '',
                errorDatos:0,
                errorMostrarMsj:[],
                arrayiglesiaID:[],
                
            }
        },
        methods:{

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

            iglesias(idzona){

                let me=this;
                var arrayiglesiaID=[];
             axios.post('/feligreses/buscarIglesia',{
               'id':this.idzona}) 
              .then(function (response) { 
                arrayiglesiaID = response.data;     
                //this.arrayiglesia=arrayiglesiaID;
                me.llenar(arrayiglesiaID);  
                //console.log(arrayiglesiaID);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
           llenar(d=[]){
                this.arrayiglesia=d;
            },

            validarvalores(){
                this.errorDatos=0;
                this.errorMostrarMsj=[];
                var RE = /^\d*(\.\d{1})?\d{0,1}$/;
               var Max_Length = 99;
               var Min_Length = 3;
               //Nombre y apellido
               var lengthmaxN = this.nombre_persona.length;
               var lengthminN = this.nombre_persona.length;
               var lengthmaxA = this.apellido_persona.length;
               var lengthminA = this.nombre_persona.length;

               //fecha
                var fecha = new Date();
                var fecha2 = new Date();
                var actualYear = fecha.getFullYear();
                var actualMes = fecha.getMonth();
                
                console.log(anio);
               
                if (lengthmaxN > Max_Length)this.errorMostrarMsj.push("El nombre del feligres debe tener menos de 99 letras");
                if (lengthminN < Min_Length)this.errorMostrarMsj.push("El nombre del feligres debe tener más de 3 letras");
                if (lengthmaxA > Max_Length)this.errorMostrarMsj.push("El apellido del feligres debe tener menos de 99 letras");
                if (lengthminA < Min_Length)this.errorMostrarMsj.push("El apellido del feligres debe tener más de 3 letras");
                
                if(this.fechana != '')
                    {
                            var values = this.fechana.split("-");
                            var anio = values[0];
                            if(anio < 1989)this.errorMostrarMsj.push("El año debe de ser mayor a 1989");
                            if((actualYear)<anio)this.errorMostrarMsj.push("El año debe ser menor o igual al " + (actualYear));
                        
                    };
                
                if(this.idzona=='') this.errorMostrarMsj.push("Seleccione una zona");
                if(this.idiglesia=='') this.errorMostrarMsj.push("Seleccione una iglesia");
                if(this.errorMostrarMsj.length) this.errorDatos=1;
            

                return this.errorDatos;
            },
             
             registrarfeligres(){
               if(this.validarvalores()){
                  return;   
                 }
    
             let me=this;
              axios.put('/feligreses/registrar',{
                  'nombre_persona': this.nombre_persona.toUpperCase(),
                  'apellido_persona': this.apellido_persona.toUpperCase(),
                  'fecha_nacimiento':this.fechana,
                  'idiglesia':this.idiglesia,
              }) .then(function (response) {
                    me.mensajeExito();
                    me.cerrarModal();
                }) .catch(function (error) {
                 
                });
            },
            mensajeExito(){
                swal({
                title: 'El Feligres se guardo exitosamente',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                })
            },
            cerrarModal(){
                this.modal=0;
                this.modal2=0;
                this.tituloModal='';
                this.tipoAccion=0;
                this.nombre_persona='';
                this.apellido_persona='';
                this.fechana='';
                this.buscar='';
                this.idiglesia='';
                this.criterio='nombre_iglesia';
                this.idzona='';
            
            }
        },
        mounted() {
            this.llenadolistazona('','');
        }
    }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .margen{
        margin-bottom: 10px;
    }
    .div-error{
        clear:both;
        justify-content:center;
    }
    .text-error{
        color: red !important;
        font-weight:bold;
    }
    
</style>