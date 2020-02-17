<template>
   <main class="main">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <label class="titulo-encabezados">Producto</label>
                    </div>
                    <div class="card-body">
                        <div class="input-group margen">
                            <button type="button" @click="abrirModal('productos','registrar')" class="btn btn-primary">
                                    <i class="icon-plus"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                        <option value="nombre_producto">Nombre producto</option>
                                        <option value="unidad_medida">Unidad de medida</option>
                                    </select>
                                    <input type="text"  v-model="buscar" @keyup.enter="listarproductos(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarproductos(1,buscar,criterio) " class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre Producto</th>
                                    <th>Unidad de Medida</th>
                                    <th>Opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="producto in arrayproductos" :key="producto.id">                              
                                    <td v-text="producto.nombre_producto"></td>
                                    <td v-text="producto.unidad_medida"></td>
                                        <button type="button" @click="abrirModal('productos','actualizar',producto)" >
                                            <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button  type="button" class="btn btn-danger btn-sm"  @click="abrirModal('productos','eliminar',producto)" >
                                            <i class="icon-trash  enter"></i>
                                        </button>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' :'']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
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
                            <form action="" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre producto<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="nombre_producto" class="form-control" placeholder="Nombre Producto">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Unidad de medida<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="unidad_medida"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="unidad in arrayunidad" :key="unidad.id"  v-bind:value="unidad.unidad" v-text="unidad.unidad"></option>
                                        </select>
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
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarproductos()">Guardar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizarproductos()">Actualizar</button>
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
                            <h4 class="modal-title">¿Esta seguro de eliminar este Producto?</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                       <div class="form-group row">
                                   <b class="alerta"> <label class="col-md-1 form-control-label" for="text-input">Nombre del producto</label></b>
                                        <b class="alerta"><label class="col-md-3 form-control-label" for="text-input">{{nombre_producto}}</label></b>   
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
                productos_id:0,
                nombre_producto:'',
                unidad_medida:'',
                arrayproductos:[],
                arrayunidad:[],
                modal : 0,
                modal2: 0,
                tituloModal : '',
                tipoAccion:0,
                criterio:'nombre_producto', 
                buscar: '',
                errorDatos:0,
                errorMostrarMsj:[],

                
                pagination:{
                    'total' :0,
                    'current_page' :0,
                    'per_page' :0,
                    'last_page' :0,
                    'from' :0,
                    'to' :0,
                },
                offset: 4,
                
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //calcula los elementos de la paginacion
            pagesNumber: function(){
                if(!this.pagination.to){
                    return[];
                }
                var from = this.pagination.current_page - this.offset;
                if(from <1){
                    from=1;
                }
                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to=this.pagination.last_page;
                }
                 var pagesArray=[];
                 while(from <= to){
                     pagesArray.push(from);
                     from++;
                 }
                    return pagesArray;
            }
        },
        methods:{
            llenadolista(buscar,criterio){
                let me=this;
                var url='/unidad?buscar=' + buscar;
                axios.get(url) .then(function (response) {
                    var respuesta= response.data;
                    me.arrayunidad=respuesta.unidad_medida.data;
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarproductos(page,buscar,criterio){
                let me=this;
                var lengthbuscar = this.buscar.length;
                 if(lengthbuscar >0)
                 {
                     var buscar2= this.buscar.toUpperCase();
                 }else
                 buscar2=this.buscar;
                var url='/producto?page='+ page + '&buscar=' + buscar2 + '&criterio=' + criterio;
                axios.get(url) .then(function (response) {
                    var respuesta= response.data;
                    me.arrayproductos=respuesta.productos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
        
            },
            cambiarPagina(page,buscar,criterio){
            let me = this;
            //Actualiza la pagina actualizar
            me.pagination.current_page = page;
            //Envia la peticion para visualizar la data de esa pagina
        
            me.listarproductos(page,buscar,criterio);
            
        },
            validarvalores(){
                this.errorDatos=0;
                this.errorMostrarMsj=[];
                var RE = /^\d*(\.\d{1})?\d{0,1}$/;
               var Max_Length = 99;
               var Min_Length = 2;
               var lengthmax = this.nombre_producto.length;
               var lengthmin = this.nombre_producto.length;
               if (!lengthmax > Max_Length)this.errorMostrarMsj.push("El nombre de la producto debe tener menos de 99 caracteres");
                if (lengthmin < Min_Length)this.errorMostrarMsj.push("El nombre de la producto debe tener más 3 letras");
                if(this.errorMostrarMsj.length) this.errorDatos=1;
            

                return this.errorDatos;
            },
             
             registrarproductos(){
                 if(this.validarvalores()){
                  return;   
                 }
    
             let me=this;
              var buscar='';
                var criterio='nombre_producto';
              axios.put('/producto/registrar',{
                  'nombre_producto': this.nombre_producto.toUpperCase(),
                  'unidad': this.unidad_medida.toUpperCase(),
              }) .then(function (response) {
                    me.cerrarModal();
                    me.mensajeExito();
                    me.listarproductos(1,buscar,criterio);
                }) .catch(function (error) {
                 
                });

            },
         
            mensajeExito(){
                swal({
                title: '¡Producto registrado con exito!',
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
            actualizarproductos(){
                if(this.validarvalores()){
                  return;   
                 }
               
                let me=this;
                var buscar='';
                var criterio='nombre_producto';
                axios.put('/producto/actualizar',{
                  'nombre_producto': this.nombre_producto.toUpperCase(),
                  'unidad': this.unidad_medida.toUpperCase(),
                  'id':this.productos_id,
                    }) .then(function (response) {
                    me.cerrarModal();
                    me.mensajeExitoactualizacion();
                    me.listarproductos(1,buscar,criterio);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            mensajeExitoactualizacion(){
                swal({
                title: '¡Actualizado con exito!',
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
             eliminar(){
                let me=this;
                var buscar='';
                var criterio='nombre_producto';
                axios.put('/producto/eliminar',{
                  'id':this.productos_id,
                    }) .then(function (response) {
                    me.msjEliminado();
                    me.cerrarModal();
                    me.listarproductos(1,buscar,criterio);
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
                this.nombre_producto='';
                this.buscar='';
                this.criterio='nombre_producto';
            
            },
    
          abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "productos":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Nuevo Producto';
                                this.tipoAccion=1;
                                this.nombre_producto='';
                                break;

                            }
                             case 'actualizar':
                            {
                                 this.modal=1;
                                this.tituloModal='Modificar Producto';
                                this.tipoAccion=2;
                                this.productos_id=data['id'];
                                this.nombre_producto=data['nombre_producto'];
                                this.unidad_medida=data['unidad_medida'];
                               break;
                            }
                             case 'eliminar':
                            {
                                this.modal2=1;
                                this.tituloModal='Eliminar Producto';
                                this.productos_id=data['id'];
                                this.nombre_producto=data['nombre_producto'];
                               break;
                            }
                        }
                    }
                }

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
            this.listarproductos(1,this.buscar,this.criterio);
            this.llenadolista('','');
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