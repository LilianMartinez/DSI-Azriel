<template>
   <main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <label class="titulo-encabezados">Iglesias</label>
                    </div>
                    <div class="card-body">
                    <div class="input-group margen">
                            <button type="button" @click="abrirModal('iglesias','registrar')" class="btn btn-primary">
                                    <i class="icon-plus"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre_iglesia">Nombre iglesia</option>
                                    </select>
                                    <input type="text"  v-model="buscar" @keyup.enter="listariglesias(buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listariglesias(buscar,criterio) " class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre Iglesia</th>
                                    <th>Zona</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="iglesia in arrayiglesiasZ" :key="iglesia.id">                              
                                    <td v-text="iglesia.nombre_iglesia"></td>
                                    <td v-text="iglesia.nombre_zona"></td>
                                        <button type="button" @click="abrirModal('iglesias','actualizar',iglesia)" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                         <button  type="button" class="btn btn-danger btn-sm"  @click="abrirModal('iglesias','eliminar',iglesia)" >
                                          <i class="icon-trash  enter"></i>
                                        </button>
                                </tr>
                                 <tr v-for="iglesia in arrayiglesias" :key="iglesia.id">                              
                                    <td v-text="iglesia.nombre_iglesia"></td>
                                    <td v-text="iglesia.nombre_zona"></td>
                                        <button type="button" @click="abrirModal('iglesias','actualizar',iglesia)" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                         <button  type="button" class="btn btn-danger btn-sm"  @click="abrirModal('iglesias','eliminar',iglesia)" >
                                          <i class="icon-trash  enter"></i>
                                        </button>
                                </tr>
                            </tbody>
                        </table>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre de la iglesia<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="nombre_iglesia" class="form-control" placeholder="Nombre Iglesia">
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Zona</label> <!-- ZONAAAAAAAAAAA-->
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idzona"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id" v-text="zona.nombre_zona"></option>
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
                                            <label class="col-md-3 form-control-label" for="text-input">Nombre de la iglesia</label>
                                                <div class="col-md-9">
                                                        <label class="col-md-3 form-control-label" v-text="nombre_iglesia" ></label>
                                                </div>   
                                </div>
                                <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Zona</label>
                                                <div class="col-md-9">
                                                        <label class="col-md-3 form-control-label" v-text="nombre_zona"></label>
                                                </div> 
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-danger" @click="eliminar()">Eliminar</button>
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
                iglesias_id:0,
                idzona:'',
                zona:'',
                nombre_zona:'',
                nombre_iglesia:'',
                arrayiglesias:[],
                arrayiglesiasZ:[],
                arrayzona:[],
                modal : 0,
                modal2: 0,
                tituloModal : '',
                tipoAccion:0,
                criterio:'nombre_iglesia', 
                buscar: '',
                errorDatos:0,
                errorMostrarMsj:[],
                
            }
        },
        methods:{

            llenadolistazona(buscar,criterio){
            let me=this;
            var url='zona/buscarZona'; //////////////////////////
            axios.get(url) .then(function (response) {
                me.arrayzona=response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
            listariglesias(buscar,criterio,estado){
                let me=this;
                var lengthbuscar = this.buscar.length;
                 if(lengthbuscar >0)
                 {
                     var buscar2= this.buscar.toUpperCase();
                 }else
                 buscar2=this.buscar;
                var url='/iglesia?buscar=' + buscar2 + '&criterio=' + criterio;
                axios.get(url) .then(function (response) {
                    var respuesta= response.data;
                    me.arrayiglesiasZ=respuesta.iglesiasZ;
                    me.arrayiglesias=respuesta.iglesias;
                })
                .catch(function (error) {
                    console.log(error);
                });
        
            },
            
            validarvalores(){
                this.errorDatos=0;
                this.errorMostrarMsj=[];
                var RE = /^\d*(\.\d{1})?\d{0,1}$/;
               var Max_Length = 99;
               var Min_Length = 3;
               var lengthmax = this.nombre_iglesia.length;
               var lengthmin = this.nombre_iglesia.length;
               if (!lengthmax > Max_Length)this.errorMostrarMsj.push("El nombre de la iglesia debe tener menos de 99 caracteres");
                if (lengthmin < Min_Length)this.errorMostrarMsj.push("El nombre de la iglesia debe tener más 3 letras");
                if(this.errorMostrarMsj.length) this.errorDatos=1;
            

                return this.errorDatos;
            },
             
             registrariglesias(){
                 if(this.validarvalores()){
                  return;   
                 }
    
             let me=this;
              var buscar='';
                var criterio='nombre_iglesia';
              axios.put('/iglesia/registrar',{
                  'nombre_iglesia': this.nombre_iglesia.toUpperCase(),
                  'idz':this.idzona,
              }) .then(function (response) {
                    me.msjExito();
                    me.cerrarModal();
                    me.listariglesias(buscar,criterio);
                }) .catch(function (error) {
                 
                });

            },
         
            actualizariglesias(){
                if(this.validarvalores()){
                  return;   
                 }
               
                let me=this;
                var buscar='';
                var criterio='nombre_iglesia';
                axios.put('/iglesia/actualizar',{
                  'nombre_iglesia': this.nombre_iglesia.toUpperCase(),
                  'idz':this.idzona,
                  'id':this.iglesias_id,
                    }) .then(function (response) {
                    me.cerrarModal();
                    me.listariglesias(buscar,criterio);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
             eliminar(){
                let me=this;
                var buscar='';
                var criterio='nombre_iglesia';
                axios.put('/iglesia/eliminar',{
                  'idz':this.idzona,
                  'id':this.iglesias_id,
                    }) .then(function (response) {
                    me.msjEliminado();
                    me.cerrarModal();
                    me.listariglesias(buscar,criterio);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            cerrarModal(){
                this.modal=0;
                this.modal2=0;
                this.tituloModal='';
                this.tipoAccion=0;
                this.nombre_iglesia='';
                this.buscar='';
                this.criterio='nombre_iglesia';
                this.idzona='';
                this.errorDatos=0;
                this.errorMostrarMsj='';
            
            },
    
          abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "iglesias":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Nuevo Iglesia';
                                this.tipoAccion=1;
                                this.nombre_iglesia='';
                                this.idzona='';
                                break;

                            }
                             case 'actualizar':
                            {
                                 this.modal=1;
                                this.tituloModal='Modificar Iglesia';
                                this.tipoAccion=2;
                                this.iglesias_id=data['id'];
                                this.nombre_iglesia=data['nombre_iglesia'];
                                this.idzona=data['idz'];
                               break;
                            }
                             case 'eliminar':
                            {
                                this.modal2=1;
                                this.tituloModal='Eliminar Iglesia';
                                this.iglesias_id=data['id'];
                                this.nombre_iglesia=data['nombre_iglesia'];
                                this.nombre_zona=data['nombre_zona'];
                                this.idzona=data['idz'];
                               break;
                            }
                        }
                    }
                }

            },

            //MENSAJE DE ÉXITO
            msjExito(){
                swal({
                    type: 'success',
                    title: 'Datos guardados con éxito',
                    showConfirmButton: false,
                    timer: 1500
                })
            },
            //MENSAJE DE ELIMINACIÓN EXITOSA
            msjEliminado(){
                swal({
                    type: 'error',
                    title: 'Datos eliminados con éxito',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        },
        mounted() {
            this.listariglesias(this.buscar,this.criterio);
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