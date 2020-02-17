<template>
   <main class="main">

          
            <div class="container-fluid">
       
                <div class="card">
                    <div class="card-header">
                        <label class="titulo-encabezados">Unidades de medida</label>
                    </div>
                    <div class="card-body">
                    <div class="input-group margen">
                            <button type="button" @click="abrirModal('unidad_medida','registrar')" class="btn btn-primary">
                                    <i class="icon-plus"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text"  v-model="buscar" @keyup.enter="listarunidad_medida(1,buscar)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarunidad_medida(1,buscar) " class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Unidad de medida</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="unidad_medida in arrayunidad_medida" :key="unidad_medida.id">                              
                                    <td v-text="unidad_medida.unidad"></td>
                                        <button type="button" @click="abrirModal('unidad_medida','actualizar',unidad_medida)" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                         <button  type="button" class="btn btn-danger btn-sm"  @click="abrirModal('unidad_medida','eliminar',unidad_medida)" >
                                          <i class="icon-trash  enter"></i>
                                        </button>
                                </tr>
                            </tbody>
                        </table>
                         <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' :'']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1, buscar)">Sig</a>
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
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Unidad medida<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="nombremf" class="form-control" placeholder="ej. 2 Libras">
                                    </div>
                                </div>
                                <div v-show="errorDatos" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsj" :key="error" v-text="error"></div>
                                    </div>
                                </div>              
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarunidad_medida()">Guardar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizarunidad_medida()">Actualizar</button>
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
                            <h4 class="modal-title">¿Esta seguro de eliminar unidad de medida?</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                       <div class="form-group row">
                                   <b class="alerta"> <label class="col-md-1 form-control-label" for="text-input">Unidad medida</label></b>
                                        <b class="alerta"><label class="col-md-3 form-control-label" for="text-input">{{nombremf}}</label></b>   
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
                unidad_medida_id:0,
                nombremf:'',
                arrayunidad_medida:[],
                modal : 0,
                modal2: 0,
                tituloModal : '',
                tipoAccion:0,
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
            listarunidad_medida(page,buscar){
                let me=this;
                var lengthbuscar = this.buscar.length;
                 if(lengthbuscar >0)
                 {
                     var buscar2= this.buscar.toUpperCase();
                 }else
                 buscar2=this.buscar;
                var url='/unidad?page='+ page + '&buscar=' + buscar2;
                axios.get(url) .then(function (response) {
                    var respuesta= response.data;
                    me.arrayunidad_medida=respuesta.unidad_medida.data;
                    me.pagination= respuesta.pagination;
        
                })
                .catch(function (error) {
                    console.log(error);
                });
        
            },
              cambiarPagina(page,buscar){
            let me = this;
            //Actualiza la pagina actualizar
            me.pagination.current_page = page;
            //Envia la peticion para visualizar la data de esa pagina
            
            me.listarunidad_medida(page,buscar);
            
        },
            validarvalores(){
                this.errorDatos=0;
                this.errorMostrarMsj=[];
                var RE = /^\d*(\.\d{1})?\d{0,1}$/;
                var Max_Length = 50;
                var Min_Length = 1;
                var lengthmax = this.nombremf.length;
                var lengthmin = this.nombremf.length;
                if (!lengthmax > Max_Length)this.errorMostrarMsj.push("La unidad de medida debe tener menos de 50 caracteres");
                if (lengthmin < Min_Length)this.errorMostrarMsj.push("La unidad debe de tener más de un caracter");
                if(this.errorMostrarMsj.length) this.errorDatos=1;
                return this.errorDatos;
            },
             
             registrarunidad_medida(){
                 if(this.validarvalores()){
                  return;   
                 }
                var buscar='';
             let me=this;
              axios.put('/unidad/registrar',{
                  'nombremf': this.nombremf.toUpperCase(),
              }) .then(function (response) {
                    me.msjExito();
                    me.cerrarModal();
                    me.listarunidad_medida(1,buscar);
                }) .catch(function (error) {
                 
                });

            },
         

            actualizarunidad_medida(){
                if(this.validarvalores()){
                  return;   
                 }
               
                let me=this;
               
                var buscar='';
                axios.put('/unidad/actualizar',{
                  'nombremf': this.nombremf.toUpperCase(),
                  'id':this.unidad_medida_id,
                    }) .then(function (response) {
                    me.msjExito();
                    me.cerrarModal();
                    
                    me.listarunidad_medida(1,buscar);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
             eliminar(){
                let me=this;
                var buscar='';
                
                axios.put('/unidad/eliminar',{
                  'id':this.unidad_medida_id,
                    }) .then(function (response) {
                    me.msjEliminado();
                    me.cerrarModal();
                    me.listarunidad_medida(1,buscar);
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
            
            },
    
          abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "unidad_medida":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Nueva Unidad de Medida';
                                this.tipoAccion=1;
                                this.nombremf='';
                                break;
                            }
                             case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Modificar Unidad de Medida';
                                this.tipoAccion=2;
                                this.unidad_medida_id=data['id'];
                                this.nombremf=data['unidad'];
                               break;
                            }
                             case 'eliminar':
                            {
                                this.modal2=1;
                                this.tituloModal='Eliminar Unidad de Medida';
                                this.unidad_medida_id=data['id'];
                                this.nombremf=data['unidad'];
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
            this.listarunidad_medida(1,this.buscar);
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