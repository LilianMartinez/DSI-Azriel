<template>
   <main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <label class="titulo-encabezados">Categorias de los inventarios</label>
                    </div>
                    <div class="card-body">
                    <div class="input-group margen">
                            <button type="button" @click="abrirModal('categorias','registrar')" class="btn btn-primary">
                                    <i class="icon-plus"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre_categoriainv"> Nombre categoría</option>
                                      <option value="descripcion_categoriainv"> Descripción de la categoría</option>
                                    </select>
                                    <input type="text"  v-model="buscar" @keyup.enter="listarcategoriasinventario(buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarcategoriasinventario(buscar,criterio) " class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre de la categoría</th>
                                    <th>Descripción de la categoría</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="categoriai in arraycateinve" :key="categoriai.id">                              
                                    <td v-text="categoriai.nombre_categoriainv"></td>
                                    <td v-text="categoriai.descripcion_categoriainv"></td>
                                        <button type="button" @click="abrirModal('categorias','actualizar',categoriai)" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                         <button  type="button" class="btn btn-danger btn-sm"  @click="abrirModal('categorias','eliminar',categoriai)" >
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
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre de la categoría<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="nombre_categoriainv" class="form-control" placeholder="Ejem. Vestimenta del padre">
                                    </div>
                            </div>
                              <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Descripción de la categoría</label>
                                    <div class="col-md-5">
                                        <textarea rows="8" tabindexgt="-1" cols="45" v-model="descripcion_categoriainv" placeholder="Ejem. Vestimenta que usa el padre en las misas"></textarea>
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
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarcategoriainventario()">Guardar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizarcategoriainventario()">Actualizar</button>
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
                                            <b class="alerta"> <label class="col-md-1 form-control-label" for="text-input">Nombre de la categoría</label></b>
                                            <b class="alerta"><label class="col-md-3 form-control-label" for="text-input">{{nombre_categoriainv}}</label></b>   
                                </div>
                                <div class="form-group row">
                                            <b class="alerta"> <label class="col-md-1 form-control-label" for="text-input">Descripción de la categoría</label></b>
                                            <b class="alerta"><label class="col-md-3 form-control-label" for="text-input">{{descripcion_categoriainv}}</label></b>   
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
                cateinve_id:0,
                nombre_categoriainv:'',
                descripcion_categoriainv:'',
                arraycateinve:[],
                modal : 0,
                modal2: 0,
                tituloModal : '',
                tipoAccion:0,
                criterio:'nombre_categoriainv', 
                buscar: '',
                errorDatos:0,
                errorMostrarMsj:[],
                
            }
        },
        methods:{

            listarcategoriasinventario(buscar,criterio,estado){
                let me=this;
                var lengthbuscar = this.buscar.length;
                 if(lengthbuscar >0)
                 {
                     var buscar2= this.buscar.toUpperCase();
                 }else
                 buscar2=this.buscar;
                var url='/categoriainventario?buscar=' + buscar2 + '&criterio=' + criterio;
                axios.get(url) .then(function (response) {
                    me.arraycateinve = response.data;
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
               var lengthmax = this.nombre_categoriainv.length;
               var lengthmin = this.nombre_categoriainv.length;

               var lengthmaxD = this.descripcion_categoriainv.length;
               var lengthminD = this.descripcion_categoriainv.length;

               
                if (!lengthmax > Max_Length)this.errorMostrarMsj.push("El nombre de la categoria debe tener menos de 99 letras");
                if (lengthmin < Min_Length)this.errorMostrarMsj.push("El nombre de la categoria debe tener más 3 letras");

                if(this.descripcion_categoriainv != ''){
                    if (!lengthmaxD > Max_Length)this.errorMostrarMsj.push("La descripción de la categoría debe tener menos de 99 letras");
                    if (lengthminD < Min_Length)this.errorMostrarMsj.push("La descripción de la categoría debe tener más 3 letras");
                }
                if(this.errorMostrarMsj.length) this.errorDatos=1;
            

                return this.errorDatos;
            },
             
             registrarcategoriainventario(){
                 if(this.validarvalores()){
                  return;   
                 }
    
             let me=this;
              var buscar='';
                var criterio='nombre_categoriainv';
              axios.put('/categoriainventario/registrar',{
                  'nombre_categoriainv': this.nombre_categoriainv.toUpperCase(),
                  'descripcion_categoriainv': this.descripcion_categoriainv.toUpperCase(),
              }) .then(function (response) {
                    me.msjExito();
                    me.cerrarModal();
                    me.listarcategoriasinventario(buscar,criterio);
                }) .catch(function (error) {
                 
                });

            },
            actualizarcategoriainventario(){
                if(this.validarvalores()){
                  return;   
                 }
               
                let me=this;
                var buscar='';
                var criterio='nombre_categoriainv';
                axios.put('/categoriainventario/actualizar',{
                 'nombre_categoriainv': this.nombre_categoriainv.toUpperCase(),
                  'descripcion_categoriainv': this.descripcion_categoriainv.toUpperCase(),
                  'id':this.cateinve_id,
                    }) .then(function (response) {
                    me.msjExito();
                    me.cerrarModal();
                   me.listarcategoriasinventario(buscar,criterio);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
             eliminar(){
                let me=this;
                var buscar='';
                var criterio='nombre_categoriainv';
                axios.put('/categoriainventario/eliminar',{
                  'id':this.cateinve_id,
                    }) .then(function (response) {
                    me.msjEliminado();
                    me.cerrarModal();
                    me.listarcategoriasinventario(buscar,criterio);
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
                this.nombre_categoriainv='';
                this.descripcion_categoriainv='';
                this.buscar='';
                this.criterio='nombre_categoriainv';
                this.errorDatos=0;
                this.errorMostrarMsj='';
            
            },
    
          abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "categorias":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Nueva Categoría';
                                this.tipoAccion=1;
                                this.nombre_categoriainv='';
                                this.descripcion_categoriainv='';
                                break;

                            }
                             case 'actualizar':
                            {
                                 this.modal=1;
                                this.tituloModal='Modificar Categoría';
                                this.tipoAccion=2;
                                this.cateinve_id=data['id'];
                                this.nombre_categoriainv=data['nombre_categoriainv'];
                                this.descripcion_categoriainv=data['descripcion_categoriainv'];
                               break;
                            }
                             case 'eliminar':
                            {
                                this.modal2=1;
                                this.tituloModal='Eliminar Categoría';
                                this.cateinve_id=data['id'];
                                this.nombre_categoriainv=data['nombre_categoriainv'];
                                this.descripcion_categoriainv=data['descripcion_categoriainv'];
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
            this.listarcategoriasinventario(this.buscar,this.criterio);
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