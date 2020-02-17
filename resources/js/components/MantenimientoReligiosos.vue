<template>
   <main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <label class="titulo-encabezados">Personal Religioso</label>
                    </div>
                    <div class="card-body">
                    <div class="input-group margen">
                            <button type="button" @click="abrirModal('religiosos','registrar')" class="btn btn-primary">
                                    <i class="icon-plus"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre_persona">Nombre</option>
                                      <option value="apellido_persona">Apellido</option>
                                      <option value="dui_pasaporte">Documento de Identidad</option>
                                    </select>
                                    <input type="text"  v-model="buscar" @keyup.enter="listarreligiosos(buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarreligiosos(buscar,criterio) " class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido </th>
                                    <th>Documento de Identidad</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="religiosos in arrayreligiosos" :key="religiosos.id">                              
                                    <td v-text="religiosos.nombre_persona"></td>
                                    <td v-text="religiosos.apellido_persona"></td>
                                    <td v-text="religiosos.dui_pasaporte"></td>
                                        <button type="button" @click="abrirModal('religiosos','actualizar',religiosos)" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                         <button  type="button" class="btn btn-danger btn-sm"  @click="abrirModal('religiosos','eliminar',religiosos)" >
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
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="nombre_persona" class="form-control" placeholder="Nombre del religioso">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Apellido<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="apellido_persona" class="form-control" placeholder="Apellido del religioso" >
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Documento de Identidad</label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="dui_pasaporte" class="form-control" placeholder="00000000-0">
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
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarreligiosos()">Guardar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizarreligiosos()">Actualizar</button>
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
                            <h4 class="modal-title">¿Esta seguro de eliminar a este religioso?</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                       <div class="form-group row">
                                   <b class="alerta"> <label class="col-md-1 form-control-label" for="text-input">Nombre</label></b>
                                        <b class="alerta"><label class="col-md-3 form-control-label" for="text-input">{{nombre_persona}}</label></b>   
                                </div>
                                 <div class="form-group row">
                                    <b class="alerta"><label class="col-md-1 form-control-label" for="text-input">Apellido</label></b>
                                    <b class="alerta"> <label class="col-md-3 form-control-label" for="text-input">{{apellido_persona}}</label></b>   
                                </div>
                                <div class="form-group row">
                                   <b class="alerta"> <label class="col-md-1 form-control-label" for="text-input">Documento de Identidad</label></b>
                                        <b class="alerta"><label class="col-md-3 form-control-label" for="text-input">{{dui_pasaporte}}</label></b>   
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
                religiosos_id:0,
                nombre_persona:'',
                apellido_persona:'',
                dui_pasaporte:'',
                arrayreligiosos:[],
                modal : 0,
                modal2: 0,
                tituloModal : '',
                tipoAccion:0,
                criterio:'nombre_persona', 
                buscar: '',
                errorDatos:0,
                errorMostrarMsj:[],
                
            }
        },
        methods:{
            listarreligiosos(buscar,criterio,estado){
                let me=this;
                var lengthbuscar = this.buscar.length;
                 if(lengthbuscar >0)
                 {
                     var buscar2= this.buscar.toUpperCase();
                 }else
                 buscar2=this.buscar;
                var url='/religioso/index?buscar=' + buscar2 + '&criterio=' + criterio;
                axios.get(url) .then(function (response) {
                    me.arrayreligiosos=response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        
            },
            
            validarvalores(){
                this.errorDatos=0;
                this.errorMostrarMsj=[];
                var RE = /^\d*(\.\d{1})?\d{0,1}$/;
               var Max_Length_DuiPasa = 9;
               var Max_Length = 70;
               var Min_Length = 3;
               var lengthmax = this.nombre_persona.length;
               var lengthmin = this.nombre_persona.length;
               var lengthmax2 = this.apellido_persona.length;
               var lengthmin2 = this.apellido_persona.length;
               var lengthmaxDUIPA = this.dui_pasaporte.length;
                if (!lengthmax > Max_Length)this.errorMostrarMsj.push("El nombre debe tener menos de 70 caracteres");
                if (lengthmin < Min_Length)this.errorMostrarMsj.push("El nombre debe tener más 3 letras");
                if (!lengthmax2 > Max_Length)this.errorMostrarMsj.push("El apellido debe tener menos de 70 caracteres");
                if (lengthmin2 < Min_Length)this.errorMostrarMsj.push("El apellido debe tener más 3 letras");
                if (lengthmaxDUIPA > Max_Length_DuiPasa)this.errorMostrarMsj.push("El Documento de Identidad debe tener menos de 9 caracteres");
                if(this.errorMostrarMsj.length) this.errorDatos=1;
            

                return this.errorDatos;
            },
             
             registrarreligiosos(){
                 if(this.validarvalores()){
                  return;   
                 }
    
             let me=this;
              var buscar='';
                var criterio='nombre_persona';
              axios.put('/religioso/registrar',{
                  'nombre_persona': this.nombre_persona.toUpperCase(),
                  'apellido_persona':this.apellido_persona.toUpperCase(),
                  'dui_pasaporte':this.dui_pasaporte.toUpperCase(),
              }) .then(function (response) {
                    me.msjExito();
                    me.cerrarModal();
                    me.listarreligiosos(buscar,criterio);
                }) .catch(function (error) {
                 
                });

            },
         

            actualizarreligiosos(){
                if(this.validarvalores()){
                  return;   
                 }
               
                let me=this;
                var buscar='';
                var criterio='nombre_persona';
                axios.put('/religioso/actualizar',{
                  'nombre_persona': this.nombre_persona.toUpperCase(),
                  'apellido_persona':this.apellido_persona.toUpperCase(),
                  'dui_pasaporte':this.dui_pasaporte.toUpperCase(),
                  'id':this.religiosos_id,
                    }) .then(function (response) {
                    me.msjExito();
                    me.cerrarModal();
                    
                    me.listarreligiosos(buscar,criterio);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
             eliminar(){
                let me=this;
                var buscar='';
                var criterio='nombre_persona';
                axios.put('/religioso/eliminar',{
                  'id':this.religiosos_id,
                    }) .then(function (response) {
                    me.msjEliminado();
                    me.cerrarModal();
                    me.listarreligiosos(buscar,criterio);
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
                this.nombre_persona='';
                this.apellido_persona='';
                this.dui_pasaporte='';
                this.buscar='';
                this.criterio='nombre_persona';
                this.errorDatos=0;
                this.errorMostrarMsj='';
            
            },
    
          abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "religiosos":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Nuevo Religioso';
                                this.tipoAccion=1;
                                this.nombre_persona='';
                                this.apellido_persona='';
                                this.dui_pasaporte='';
                                break;

                            }
                             case 'actualizar':
                            {
                                 this.modal=1;
                                this.tituloModal='Modificar Religioso';
                                this.tipoAccion=2;
                                this.religiosos_id=data['id'];
                                this.nombre_persona=data['nombre_persona'];
                                this.apellido_persona=data['apellido_persona'];
                                this.dui_pasaporte=data['dui_pasaporte'];
                               break;
                            }
                             case 'eliminar':
                            {
                                this.modal2=1;
                                this.tituloModal='Eliminar Religioso';
                                this.religiosos_id=data['id'];
                                this.nombre_persona=data['nombre_persona'];
                                this.apellido_persona=data['apellido_persona'];
                                this.dui_pasaporte=data['dui_pasaporte'];
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
            this.listarreligiosos(this.buscar,this.criterio);
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