<template>
   <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        Caja Chica
                    </div>
                    <div class="card-body">
                         <div class="input-group margen">
                            <button type="button" @click="abrirModal('efectivos','registrar')" class="btn btn-primary">
                                    <i class="icon-plus"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="num_recibo">Factura</option>
                                      <option value="descripcion_efectivo">Concepto</option>
                                      <option value="monto">Cantidad de dinero</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarEfectivo(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarEfectivo(1,buscar,criterio) " class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Factura</th>
                                    <th>Concepto</th>
                                    <th>Ingreso</th>
                                    <th>Egreso </th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="efectivo in arrayEfectivo" :key="efectivo.id">
                                    
                                    
                                    <td v-text="efectivo.num_recibo"></td>
                                    <td v-text="efectivo.descripcion_efectivo"></td>

                                    <template v-if="efectivo.tipo == 1">
                                        <td v-text="efectivo.monto"></td>
                                        <td></td>
                                    </template>
                                    <template v-else-if="efectivo.tipo == 2">
                                        <td></td>
                                        <td v-text="efectivo.monto"></td>
                                    </template>

                                        <button type="button" @click="abrirModal('efectivos','actualizar',efectivo)" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm" @click="abrirModal('efectivos','eliminar',efectivo)">
                                          <i class="icon-trash"></i>
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
                <!-- Fin ejemplo de tabla Listado -->
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
                                    <label class="col-md-3 form-control-label" for="text-input">Factura</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="num_recibo" class="form-control" placeholder="Numero de factura">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Concepto*</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion_efectivo" class="form-control" placeholder="Descripción de movimiento">
                                    </div>
                                </div>
                                    <div>
                                        <div v-show="errorEfectivo" class="from-group row div-error">
                                            <div class="text-center text-error">
                                                <div v-for="error in errorMostrarMsjDescripcion" :key="error" v-text="error">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Monto*</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="monto" class="form-control" placeholder="$00.00">
                                    </div>
                                </div>
                                      <div>
                                        <div v-show="errorEfectivo" class="from-group row div-error">
                                            <div class="text-center text-error">
                                                <div v-for="error in errorMostrarMsjMonto" :key="error" v-text="error">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                     <label class="col-md-3 form-control-label" for="text-input">Tipo*</label>
                                    <div class="col-md-9">
                                        <table>
                                            <tr> <input type="radio" v-model="tipo" value="1" name="tipo" required> Ingreso</tr>
                                            <tr> <input type="radio" v-model="tipo" value="2" name="tipo"> Egreso</tr>
                                        </table>
                                    </div>
                                </div> 
                                    <div>
                                        <div v-show="errorEfectivo" class="from-group row div-error">
                                            <div class="text-center text-error">
                                                <div v-for="error in errorMostrarMsjTipo" :key="error" v-text="error">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <div class="form-group row">
                                     <label class="col-md-3 form-control-label" for="text-input">Precios fijos</label>
                                </div>
                                    <div class="col-md-12">
                                        <table class="table-precios">
                                        <colgroup>
				                            <col class="col1-precios"/>
				                            <col class="col2-precios"/>
                                            <col class="col3-precios"/>
			                            </colgroup>
                                            <tr> 
                                                <td><input type="radio" name="montoFijo" value="1" v-model="montoFijo" @click="autollenado(montoFi)"> Bautismo</td>
                                                <td><input type="radio" name="montoFijo" value="2" v-model="montoFijo">Certificaciones </td>
                                                <td><input type="radio" name="montoFijo" value="3" v-model="montoFijo"> Alquiler de salón</td>
                                            </tr>
                                            <tr> 
                                                <td><input type="radio" name="montoFijo" value="4" v-model="montoFijo"> Confirmación</td>
                                                <td><input type="radio" name="montoFijo" value="5" v-model="montoFijo"> Autentica </td>
                                                <td><input type="radio" name="montoFijo" value="6" v-model="montoFijo"> Alquiler de Santuario</td>
                                            </tr>
                                            <tr> 
                                                <td><input type="radio" name="montoFijo" value="7" v-model="montoFijo"> Matrimonio</td>
                                                <td><input type="radio" name="montoFijo" value="8" v-model="montoFijo">Permiso de matrimonio</td>
                                                <td><input type="radio" name="montoFijo" value="9" v-model="montoFijo"> Alquiler de chalet</td>
                                            </tr>
                                            <tr> 
                                                <td><input type="radio" name="montoFijo" value="19" v-model="montoFijo"> Expediente matrimonial</td>
                                                <td><input type="radio" name="montoFijo" value="11" v-model="montoFijo"> Misa de 15 años</td>
                                                <td></td>
                                            </tr>
                                        </table>
                                </div>                      
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarEfectivos()">Guardar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizarEfectivos()">Actualizar</button>
                        </div>
                    </div>
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <!-- Inicio del modal Eliminar -->
            <div class="modal fade" tabindex="-1" :class="{'mostrar': modalE}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Eliminar Movimiento</h4>
                            <button type="button" class="close" @click="cerrarModalE()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Factura</label>
                                                <div class="col-md-9">
                                                    <input type="text" readonly="readonly" v-model="num_recibo" class="form-control" placeholder="Numero de factura">
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">Concepto</label>
                                                    <div class="col-md-9">
                                                        <input type="text" readonly="readonly" v-model="descripcion_efectivo" class="form-control" placeholder="Descripción de movimiento">
                                                    </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Monto</label>
                                                    <div class="col-md-9">
                                                        <input type="text" readonly="readonly" v-model="monto" class="form-control" placeholder="$00.00">
                                                    </div>
                                        </div>    
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Tipo</label>
                                                    <div class="col-md-9">
                                                        <input type="text" readonly="readonly" class="form-control" v-model="tipo"> 
                                                    </div>
                                        </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModalE()">Cerrar</button>
                            <button type="button" @click="eliminarEfectivo()" class="btn btn-danger">Eliminar</button>
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
                efectivo_id:0,
                num_recibo:'',
                descripcion_efectivo:'',
                tipo:'',
                monto:'',
                fecha:'',
                arrayEfectivo:[],
                modal : 0,
                tituloModal : '',
                tipoAccion:0,
                montoFijo:1,
                arrayMontoFijo:[],
                montoFi:1,
                modalE:0,

                errorEfectivo:0,
                errorMostrarMsjDescripcion:[],
                errorMostrarMsjMonto:[],
                errorMostrarMsjTipo:[],

                pagination:{
                    'total' :0,
                    'current_page' :0,
                    'per_page' :0,
                    'last_page' :0,
                    'from' :0,
                    'to' :0,
                },
                offset: 3,
                criterio:'num_recibo', //
                buscar: ''                     
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

            listarEfectivo(page,buscar,criterio){
                let me=this;
                var url='/efectivo?page='+ page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url) .then(function (response) {
                    // handle success
                    var respuesta= response.data;
                    me.arrayEfectivo=respuesta.efectivos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            
            },
        cambiarPagina(page,buscar,criterio){
            let me = this;
            //Actualiza la pagina actualizar
            me.pagination.current_page = page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarEfectivo(page,buscar,criterio);
        },
        
         registrarEfectivos(){
             
             if(this.validarEfectivo()){
                 return;
             }
             let me=this;
              axios.put('/efectivo/registrar',{
                  'num_recibo': this.num_recibo,
                  'descripcion_efectivo':this.descripcion_efectivo,
                  'monto':this.monto,
                  'tipo':this.tipo
              }) .then(function (response) {
                    me.cerrarModal();
                    me.listarEfectivo(1,'','num_recibo');
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
             
            },
            actualizarEfectivos(){
                if(this.validarEfectivo()){
                 return;
             }
               
               let me=this;
              axios.put('/efectivo/actualizar',{
                  'num_recibo': this.num_recibo,
                  'descripcion_efectivo':this.descripcion_efectivo,
                  'monto':this.monto,
                  'tipo':this.tipo,
                  'id':this.efectivo_id,
              }) .then(function (response) {
                    me.cerrarModal();
                    me.listarEfectivo(1,'','num_recibo');
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            validarEfectivo(){
                this.errorEfectivo=0;
                this.errorMostrarMsjDescripcion=[];
                this.errorMostrarMsjMonto=[];
                this.errorMostrarMsjTipo=[];

                if(!this.descripcion_efectivo)this.errorMostrarMsjDescripcion.push("Debe llenar este campo.");
                if(!this.monto)this.errorMostrarMsjMonto.push("Debe llenar este campo y debe ser un valor numerico");
                if(!this.tipo)this.errorMostrarMsjTipo.push("Debe seleccionar uno");

                if(this.errorMostrarMsjDescripcion.length)this.errorEfectivo=1;
                if(this.errorMostrarMsjMonto.length)this.errorEfectivo=1;
                if(this.errorMostrarMsjTipo.length)this.errorEfectivo=1;

                return this.errorEfectivo;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.tipoAccion=0;
                this.num_recibo='';
                this.descripcion_efectivo='';
                this.monto='';
                this.tipo='';

            },

            cerrarModalE(){
                this.modalE=0;
                this.tituloModal='';
                this.tipoAccion=0;
                this.num_recibo='';
                this.descripcion_efectivo='';
                this.monto='';
                this.tipo='';

            },
            autollenado(montoFi){

                let me=this;
              axios.get('/efectivo/buscarmf',{
                  'id':this.montoFi,
              }) .then(function (response) {
                 /*  me.arrayMontoFijo=response.data;
                this.descripcion_efectivo=arrayMontoFijo['nombremf']; 
                this.monto=arrayMontoFijo['montof'];      */   
                console.log(response);       
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            eliminarEfectivo(){
           
              let me=this;
              axios.put('/efectivo/eliminar',{
                  'id':this.efectivo_id,
              }) .then(function (response) {
                me.cerrarModalE();
                me.listarEfectivo(1,'','num_recibo');
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "efectivos":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Nuevo Movimiento'
                                this.tipoAccion=1;
                                this.num_recibo='';
                                this.descripcion_efectivo='';
                                this.monto='';
                                this.tipo='';
                                this.fecha='';
                                break;

                            }
                             case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Modificar Movimiento',
                                this.tipoAccion=2;
                                this.efectivo_id=data['id'];
                                this.num_recibo=data['num_recibo'];
                                this.descripcion_efectivo=data['descripcion_efectivo'];
                                this.monto=data['monto'];
                                this.tipo=data['tipo'];
                               break;
                            }
                             case 'eliminar':
                            {
                                this.modalE=1;
                                this.tituloModal='Eliminar Movimiento',
                               
                                this.efectivo_id=data['id'];
                                this.num_recibo=data['num_recibo'];
                                this.descripcion_efectivo=data['descripcion_efectivo'];
                                this.monto=data['monto'];
                                this.tipo=data['tipo'];
                               break;
                            }
                        }
                    }
                }

            }
        },
        
        mounted() {
            this.listarEfectivo(1,this.buscar,this.criterio);
           
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
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>