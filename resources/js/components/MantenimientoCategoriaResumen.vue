<template>
   <main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <label class="titulo-encabezados">Categorias para Generar Resumenes Económicos</label>
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
                                      <option value="nombre_categoria">Nombre</option>
                                      <option value="descripcion_categoria">Descripción</option> 
                                    </select>
                                    <input type="text"  v-model="buscar" @keyup.enter="listarcategoriasresumenes(buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarcategoriasresumenes(buscar,criterio) " class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre de la categoria</th>
                                    <th>Descripción </th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="categoriasresumenes in arraycategoriasresumenes" :key="categoriasresumenes.id">                              
                                    <td v-text="categoriasresumenes.nombre_categoria"></td>
                                    <td v-text="categoriasresumenes.descripcion_categoria"></td>
                                        <button type="button" @click="abrirModal('categorias','actualizar',categoriasresumenes)" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                         <button  type="button" class="btn btn-danger btn-sm"  @click="abrirModal('categorias','eliminar',categoriasresumenes)" >
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
                                        <input type="text" tabindexgt="0" v-model="nombre_categoria" class="form-control" placeholder="Nombre de la categoria">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Descripción<b class="alerta">*</b></label>
                                    <div class="col-md-4">
                                        <textarea rows="8" tabindexgt="-1" cols="45" v-model="descripcion_categoria">Descripción de la categoria</textarea>
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
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarcategoriasR()">Guardar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizarcategoriasresumenes()">Actualizar</button>
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
                            <h4 class="modal-title">¿Esta seguro de eliminar esta categoria?</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                       <div class="form-group row">
                                   <b class="alerta"> <label class="col-md-1 form-control-label" for="text-input">Nombre</label></b>
                                        <b class="alerta"><label class="col-md-3 form-control-label" for="text-input">{{nombre_categoria}}</label></b>   
                                </div>
                                 <div class="form-group row">
                                    <b class="alerta"><label class="col-md-1 form-control-label" for="text-input">Descripción</label></b>
                                    <b class="alerta"> <label class="col-md-3 form-control-label" for="text-input"></label><label>{{descripcion_categoria}}</label></b>   
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
                categoriasResumenes_id:0,
                nombre_categoria:'',
                descripcion_categoria:'',
                arraycategoriasresumenes:[],
                modal : 0,
                modal2: 0,
                tituloModal : '',
                tipoAccion:0,
                criterio:'nombre_categoria', 
                buscar: '',
                errorDatos:0,
                errorMostrarMsj:[],
                
            }
        },
        methods:{
            listarcategoriasresumenes(buscar,criterio,estado){
                let me=this;
                var lengthbuscar = this.buscar.length;
                 if(lengthbuscar >0)
                 {
                     var buscar2= this.buscar.toUpperCase();
                 }else
                 buscar2=this.buscar;
                var url='/categoriaresumen?buscar=' + buscar2 + '&criterio=' + criterio;
                axios.get(url) .then(function (response) {
                    me.arraycategoriasresumenes=response.data;
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
               var lengthmax = this.nombre_categoria.length;
               var lengthmin = this.nombre_categoria.length;

               var Max_Length2 = 100;
               var Min_Length2 = 3;
               var lengthmax2 = this.descripcion_categoria.length;
               var lengthmin2 = this.descripcion_categoria.length;

               if (!lengthmax > Max_Length)this.errorMostrarMsj.push("El nombre de la categoria debe tener menos de 50 caracteres");
                if (lengthmin < Min_Length)this.errorMostrarMsj.push("El nombre de la categoria debe tener más 3 letras");
                if(!this.nombre_categoria) this.errorMostrarMsj.push("Debe escribir un nombre a la categoria");
                 if(!this.descripcion_categoria) this.errorMostrarMsj.push("Debe escribir una descripcion");
                if (!lengthmax2 > Max_Length2)this.errorMostrarMsj.push("La descripcion de la categoria debe tener menos de 100 caracteres");
                if (lengthmin2 < Min_Length2)this.errorMostrarMsj.push("La descripcion de la categoria debe tener más 3 letras");
                if(this.errorMostrarMsj.length) this.errorDatos=1;
            

                return this.errorDatos;
            },
             
             registrarcategoriasR(){
                 if(this.validarvalores()){
                  return;   
                 }
    
             let me=this;
              var buscar='';
                var criterio='nombre_categoria';
              axios.put('/categoriaresumen/registrar',{
                  'nombre_categoria': this.nombre_categoria.toUpperCase(),
                  'descripcion_categoria':this.descripcion_categoria.toUpperCase(),
              }) .then(function (response) {
                    me.msjExito();
                    me.cerrarModal();
                    me.listarcategoriasresumenes(buscar,criterio);
                }) .catch(function (error) {
                 
                });

            },
         

            actualizarcategoriasresumenes(){
                if(this.validarvalores()){
                  return;   
                 }
               
                let me=this;
                var buscar='';
                var criterio='nombre_categoria';
                axios.put('/categoriaresumen/actualizar',{
                  'nombre_categoria': this.nombre_categoria.toUpperCase(),
                  'descripcion_categoria':this.descripcion_categoria.toUpperCase(),
                  'id':this.categoriasResumenes_id,
                    }) .then(function (response) {
                    me.msjExito();
                    me.cerrarModal();
                    
                    me.listarcategoriasresumenes(buscar,criterio);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
             eliminar(){
                let me=this;
                var buscar='';
                var criterio='nombre_categoria';
                axios.put('/categoriaresumen/eliminarCR',{
                  'id':this.categoriasResumenes_id,
                    }) .then(function (response) {
                    me.msjEliminado();
                    me.cerrarModal();
                    me.listarcategoriasresumenes(buscar,criterio);
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
                this.nombre_categoria='';
                this.buscar='';
                this.criterio='nombre_categoria';
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
                                this.tituloModal='Nuevo Categoria';
                                this.tipoAccion=1;
                                this.nombre_categoria='';
                                this.descripcion_categoria='';
                                break;

                            }
                             case 'actualizar':
                            {
                                 this.modal=1;
                                this.tituloModal='Modificar Categoria';
                                this.tipoAccion=2;
                                this.categoriasResumenes_id=data['id'];
                                this.nombre_categoria=data['nombre_categoria'];
                                this.descripcion_categoria=data['descripcion_categoria'];
                               break;
                            }
                             case 'eliminar':
                            {
                                this.modal2=1;
                                this.tituloModal='Eliminar Categoria';
                                this.categoriasResumenes_id=data['id'];
                                this.nombre_categoria=data['nombre_categoria'];
                                this.descripcion_categoria=data['descripcion_categoria'];
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
            this.listarcategoriasresumenes(this.buscar,this.criterio);
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