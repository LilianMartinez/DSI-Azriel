<template>
   <main class="main">
           
            <div class="container-fluid">
                <!-- caja chica -->
                <div class="card">
                    <div class="card-header">
                       <label class="titulo-encabezados">Caja chica</label>
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarEfectivo(1,buscar,criterio,1)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarEfectivo(1,buscar,criterio,1) " class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="totales">
                            <label>Total acumulado en el mes: $</label>                              
                            <label v-text="totalAcum" ></label> 
                        </div>
                        <div class="totales2">
                            <label>Total de ingresos del dia: $</label>                              
                            <label v-text="totalAcumIngre" ></label> 
                        </div>
                        <div class="totales2">
                            <label>Total de egresos del dia: $</label>                              
                            <label v-text="totalAcumEgre" ></label> 
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Factura</th>
                                    <th>Concepto</th>
                                    <th>Ingreso ($)</th>
                                    <th>Egreso ($)</th>
                                    <th style="text-align: center">Opciones</th>
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

                                        <button  type="button" @click="abrirModal('efectivos','actualizar',efectivo)" >
                                          <i class="icon-pencil  enter"></i>
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
                                    <label class="col-md-2 form-control-label" for="text-input">Factura</label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="num_recibo" class="form-control" placeholder="Numero de factura">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Precios fijos</label>
                                  <div class="col-md-5">
                                        <select class="form-control" v-model="montoFijo" @click="autollenado(montoFijo)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="montos in arraymontos" :key="montos.id"  v-bind:value="montos.id" v-text="montos.nombremf"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Concepto<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <textarea rows="8" tabindexgt="-1" cols="45" v-model="descripcion_efectivo">Descripción de movimiento</textarea>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Monto</label>
                                    <label>$</label>
                                    <div class="col-md-5">
                                      <input type="text" tabindexgt="-1" v-model="monto" class="form-control" placeholder="00.00">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label">Categoria</label>
                                  <div class="col-md-5">
                                        <select class="form-control" v-model="idcare"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="categorias in arraycategorias" :key="categorias.id"  v-bind:value="categorias.id" v-text="categorias.nombre_categoria"></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                     <label class="col-md-2 form-control-label" for="text-input">Tipo<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <table>
                                            <tr> <input tabindexgt="-1" type="radio" v-model="tipo" value="1" name="tipo" required> Ingreso</tr>
                                            <tr> <input tabindexgt="-1" type="radio" v-model="tipo" value="2" name="tipo"> Egreso</tr>
                                        </table>
                                    </div>
                                    <div class="col-md-4 modal-fo">
                                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                                        <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarEfectivos()">Guardar</button>
                                        <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizarEfectivos()">Actualizar</button>
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
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
     <!-- Inicio del modal Eliminar -->
            <div class="modal fade" tabindex="-1" :class="{'mostrar': modalE}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Eliminar movimiento</h4>
                            <button type="button" class="close" @click="cerrarModalE()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Factura</label>
                                                <div class="col-md-9">
                                                    <label class="col-md-3 form-control-label"  v-text="num_recibo" ></label> 
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">Concepto</label>
                                                    <div class="col-md-9">
                                                        <label class="col-md-3 form-control-label"  v-text="descripcion_efectivo" ></label>
                                                    </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Monto</label>
                                                    <div class="col-md-9">
                                                        <label class="col-md-3 form-control-label"  v-text="monto" ></label>
                                                    </div>
                                        </div>    
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Tipo</label>
                                                    <div class="col-md-9">
                                                        <label class="col-md-3 form-control-label"  v-if="tipo==1" >Ingreso</label> 
                                                        <label class="col-md-3 form-control-label"  v-if="tipo==2" >Egreso</label> 
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
                idcare:'', //<--------------------------- idcare:0,
                nombre_categoria:'',
                arrayEfectivo:[],
                modal : 0,
                tituloModal : '',
                tipoAccion:0,
                montoFijo:0,
                arrayMontoFijo:[],
                arraymontos:[],

                //categoriaResumen:0,
                arrayCategoriaResumen:[],
                arraycategorias:[], //<------------------------

                to:[],
                totalAcum:'',
                totalAcumIngre:'',
                totalAcumEgre:'',
                errorDatos:0,
                errorMostrarMsj:[],
                modalE:0,
                tipocomponente:1,

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
                buscar: '',
                
                   //
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
             sumat(){
                let me=this;
                var to=[];
                axios.get('/efectivo/suma') .then(function (response) {
                  to=response.data; 
                  me.llenarsuma(to);
                })
                .catch(function (error) {
                    console.log(error);
                });
            
            },
             llenadolista(buscar,criterio){
                let me=this;
                var url='/montofijo?buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url) .then(function (response) {
                    me.arraymontos=response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
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
               
            listarEfectivo(page,buscar,criterio,tipocomponente){
                let me=this;
                 var lengthbuscar = this.buscar.length;
                 if(lengthbuscar >0)
                 {
                     var buscar2= this.buscar.toUpperCase();
                 }else
                 buscar2=this.buscar;
                
                var url='/efectivo?page='+ page + '&buscar=' + buscar2 + '&criterio=' + criterio + '&componente=' + tipocomponente;
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
             cambiarPagina(page,buscar,criterio,tipocomponente){
            let me = this;
            //Actualiza la pagina actualizar
            me.pagination.current_page = page;
            //Envia la peticion para visualizar la data de esa pagina
            if(tipocomponente=1){
            me.listarEfectivo(page,buscar,criterio,tipocomponente);
            }
        },
        
         registrarEfectivos(){
             if(this.validarvalores()){
                  return;   
                 }
             let me=this;
             
              axios.put('/efectivo/registrar',{
                  'idcare':this.idcare,
                  'num_recibo': this.num_recibo,
                  'descripcion_efectivo': this.descripcion_efectivo.toUpperCase(),
                  'monto':this.monto,
                  'tipo':this.tipo
              }) .then(function (response) {
                    me.msjExito();
                    me.cerrarModal();
                    me.listarEfectivo(1,'','num_recibo',1);
                    me.sumat();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });

            },
            actualizarEfectivos(){
                if(this.validarvalores()){
                  return;   
                 }
               
               let me=this;
              axios.put('/efectivo/actualizar',{
                  'idcare':this.idcare,
                  'num_recibo': this.num_recibo,
                  'descripcion_efectivo':this.descripcion_efectivo.toUpperCase(),
                  'monto':this.monto,
                  'tipo':this.tipo,
                  'id':this.efectivo_id,
              }) .then(function (response) {
                    me.msjExito();
                    me.cerrarModal();
                    me.listarEfectivo(1,'','num_recibo',1);
                    me.sumat();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.tipoAccion=0;
                this.num_recibo='';
                this.descripcion_efectivo='';
                this.monto='';
                this.montoFijo=0;
                this.tipo='';
                this.idcare='';
                this.errorEfectivo=0;

            },
            cerrarModalE(){
                this.modalE=0;
                this.tituloModal='';
                this.tipoAccion=0;
                this.num_recibo='';
                this.descripcion_efectivo='';
                this.monto='';
                this.tipo='';
                this.idcare='';

            },
            autollenado(montoFijo){
               
                let me=this;
                var arrayMontoFijo= [];
             axios.post('/montofijo/buscarmf',{
               'id':this.montoFijo}) 
              .then(function (response) { 
                arrayMontoFijo = response.data;      
                me.llenar(arrayMontoFijo);  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            llenar(d=[]){
                this.descripcion_efectivo=d["nombremf"]; 
                this.monto= d["montof"];    

            },
             validarvalores(){
                this.errorDatos=0;
                this.errorMostrarMsj=[];
                var RE = /^\d*(\.\d{1})?\d{0,1}$/;
                var Max_Length = 50;
                var Min_Length = 5;
                if(!this.tipo) this.errorMostrarMsj.push("El tipo no puede estar vacío");
                var lengthmax = this.descripcion_efectivo.length;
                var lengthmin = this.descripcion_efectivo.length;
                if (lengthmax > Max_Length)this.errorMostrarMsj.push("El concepto debe tener menos de 50 letras");
                if (lengthmin < Min_Length)this.errorMostrarMsj.push("El concepto debe tener más de 5 letras");
                if(!this.monto) this.errorMostrarMsj.push("El monto no puede estar vacío");
                if(this.monto){
                    if(this.monto=='0'){
                        this.errorMostrarMsj.push("El monto debe ser mayor que 0");
                    }else{
                        if (!RE.test(this.monto))  this.errorMostrarMsj.push("El monto solo pueden ser decimales");
                    }
                }
                if(this.errorMostrarMsj.length) this.errorDatos=1;
            

                return this.errorDatos;
            },
             eliminarEfectivo(){
           
              let me=this;
              axios.put('/efectivo/eliminar',{
                  'id':this.efectivo_id,
              }) .then(function (response) {
                me.msjEliminado();
                me.cerrarModalE();
                me.listarEfectivo(1,'','num_recibo',1);
                me.sumat();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
             
             llenarsuma(d=[]){
                this.totalAcum= d['total']; 
                this.totalAcumIngre= d['ingreso']; 
                this.totalAcumEgre=d['egreso']; 
            },
            abrirModal(modelo, accion, data=[]){
                switch(modelo){
        
                    case "efectivos":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Nuevo movimiento'
                                this.tipoAccion=1;
                                this.num_recibo='';
                                this.descripcion_efectivo='';
                                this.monto='';
                                this.tipo='';
                                this.fecha='';
                                this.idcare='';
                                break;

                            }
                             case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Modificar movimiento',
                                this.tipoAccion=2;
                                this.efectivo_id=data['id'];
                                this.num_recibo=data['num_recibo'];
                                this.descripcion_efectivo=data['descripcion_efectivo'];
                                this.monto=data['monto'];
                                this.tipo=data['tipo'];
                                this.idcare=data['idcare'];
                               break;
                            }
                            case 'eliminar':
                            {
                                this.modalE=1;
                                this.tituloModal='Eliminar movimiento',
                               
                                this.efectivo_id=data['id'];
                                this.num_recibo=data['num_recibo'];
                                this.descripcion_efectivo=data['descripcion_efectivo'];
                                this.monto=data['monto'];
                                this.tipo=data['tipo']; 
                                this.idcare=data['idcare']; 
                                
                               break;
                            }
                        }
                    }
                }
                this.selectCategoria();
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
            this.listarEfectivo(1,this.buscar,this.criterio,this.tipocomponente);
            this.llenadolista('','');
            this.sumat();
           
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
    
</style>