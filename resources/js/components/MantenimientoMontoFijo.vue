<template>
   <main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <label class="titulo-encabezados">Precios Fijos</label>
                    </div>
                    <div class="card-body">
                    <div class="input-group margen">
                            <button type="button" @click="abrirModal('montos','registrar')" class="btn btn-primary">
                                    <i class="icon-plus"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombremf">Nombre</option>
                                      <option value="montof">Precio</option>
                                    </select>
                                    <input type="text"  v-model="buscar" @keyup.enter="listarmontosfijos(buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarmontosfijos(buscar,criterio) " class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre de monto fijo</th>
                                    <th>Precio ($)</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="montosfijos in arraymontosfijos" :key="montosfijos.id">                              
                                    <td v-text="montosfijos.nombremf"></td>
                                    <td v-text="montosfijos.montof"></td>
                                        <button type="button" @click="abrirModal('montos','actualizar',montosfijos)" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                         <button  type="button" class="btn btn-danger btn-sm"  @click="abrirModal('montos','eliminar',montosfijos)" >
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
                                        <input type="text" tabindexgt="0" v-model="nombremf" class="form-control" placeholder="Nombre de precio">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Monto<b class="alerta">*</b></label>
                                    <label>$</label>
                                    <div class="col-md-4">
                                        <input type="text" tabindexgt="-1" v-model="montof" class="form-control" placeholder="00.00" >
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
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarmontosF()">Guardar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizarmontosfijos()">Actualizar</button>
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
                            <h4 class="modal-title">¿Esta seguro de eliminar precio fijo?</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                       <div class="form-group row">
                                   <b class="alerta"> <label class="col-md-1 form-control-label" for="text-input">Nombre</label></b>
                                        <b class="alerta"><label class="col-md-3 form-control-label" for="text-input">{{nombremf}}</label></b>   
                                </div>
                                 <div class="form-group row">
                                    <b class="alerta"><label class="col-md-1 form-control-label" for="text-input">Monto</label></b>
                                    <b class="alerta"> <label class="col-md-3 form-control-label">$</label><label>{{montof}}</label></b>   
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
                montosfijos_id:0,
                nombremf:'',
                montof:'',
                arraymontosfijos:[],
                modal : 0,
                modal2: 0,
                tituloModal : '',
                tipoAccion:0,
                criterio:'nombremf', 
                buscar: '',
                errorDatos:0,
                errorMostrarMsj:[],
                
            }
        },
        methods:{
            listarmontosfijos(buscar,criterio,estado){
                let me=this;
                var lengthbuscar = this.buscar.length;
                 if(lengthbuscar >0)
                 {
                     var buscar2= this.buscar.toUpperCase();
                 }else
                 buscar2=this.buscar;
                var url='/montofijo?buscar=' + buscar2 + '&criterio=' + criterio;
                axios.get(url) .then(function (response) {
                    me.arraymontosfijos=response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        
            },
            
            validarvalores(){
                this.errorDatos=0;
                this.errorMostrarMsj=[];
                var RE = /^\d*(\.\d{1})?\d{0,1}$/;
               var Max_Length = 50;
               var Min_Length = 3;
               var lengthmax = this.nombremf.length;
               var lengthmin = this.nombremf.length;
               if (!lengthmax > Max_Length)this.errorMostrarMsj.push("El nombre del precio fijo debe tener menos de 50 caracteres");
                if (lengthmin < Min_Length)this.errorMostrarMsj.push("El nombre del precio fijo debe tener más 3 letras");
                 if(!this.montof) this.errorMostrarMsj.push("El monto no puede estar vacío");
                 if (!RE.test(this.montof))  this.errorMostrarMsj.push("El monto solo pueden ser decimales");
                if(this.errorMostrarMsj.length) this.errorDatos=1;
            

                return this.errorDatos;
            },
             
             registrarmontosF(){
                 if(this.validarvalores()){
                  return;   
                 }
    
             let me=this;
              var buscar='';
                var criterio='nombremf';
              axios.put('/montofijo/registrar',{
                  'nombremf': this.nombremf.toUpperCase(),
                  'montof':this.montof,
              }) .then(function (response) {
                    me.msjExito();
                    me.cerrarModal();
                    me.listarmontosfijos(buscar,criterio);
                }) .catch(function (error) {
                 
                });

            },
         

            actualizarmontosfijos(){
                if(this.validarvalores()){
                  return;   
                 }
               
                let me=this;
                var buscar='';
                var criterio='nombremf';
                axios.put('/montofijo/actualizar',{
                  'nombremf': this.nombremf.toUpperCase(),
                  'montof':this.montof,
                  'id':this.montosfijos_id,
                    }) .then(function (response) {
                        me.msjExito();
                        me.cerrarModal();
                        me.listarmontosfijos(buscar,criterio);
                    })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
             eliminar(){
                let me=this;
                var buscar='';
                var criterio='nombremf';
                axios.put('/montofijo/eliminar',{
                  'id':this.montosfijos_id,
                    }) .then(function (response) {
                    me.msjEliminado();
                    me.cerrarModal();
                    me.listarmontosfijos(buscar,criterio);
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
                this.nombremf='';
                this.buscar='';
                this.criterio='nombremf';
                this.errorDatos=0;
                this.errorMostrarMsj='';
            
            },
    
          abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "montos":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Nuevo Precio Fijo';
                                this.tipoAccion=1;
                                this.nombremf='';
                                this.montof='';
                                break;

                            }
                             case 'actualizar':
                            {
                                 this.modal=1;
                                this.tituloModal='Modificar Precio Fijo';
                                this.tipoAccion=2;
                                this.montosfijos_id=data['id'];
                                this.nombremf=data['nombremf'];
                                this.montof=data['montof'];
                               break;
                            }
                             case 'eliminar':
                            {
                                this.modal2=1;
                                this.tituloModal='Eliminar Precio Fijo';
                                this.montosfijos_id=data['id'];
                                this.nombremf=data['nombremf'];
                                this.montof=data['montof'];
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
            this.listarmontosfijos(this.buscar,this.criterio);
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