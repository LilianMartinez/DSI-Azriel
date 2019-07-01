<template>
   <main class="main">
           
            <div class="container-fluid">
                <!-- caja chica -->
                <div class="card">
                    <div class="card-header">
                       <label class="titulo-encabezados">Caja Chica</label>
                    </div>
                    <div class="card-body">
                         <div class="input-group margen">
                            <button type="button" @click="abrirModal('efectivos','registrar')" class="btn btn-primary">
                                    <i class="icon-plus"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="form-control col-md-6" id="opcion" name="opcion">
                                      <option value="nombre">Nombre</option>
                                      <option value="descripcion_efectivo">Descripción</option>
                                    </select>
                                    <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="totales">
                            <label>Total Acumulado:</label>                              
                            <label v-text="totalAcum" ></label> 
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Factura</th>
                                    <th>Concepto</th>
                                    <th>Ingreso</th>
                                    <th>Egreso </th>
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
                                        <button  type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">
                                          <i class="icon-trash  enter"></i>
                                        </button>
                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#">Ant</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">4</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Sig</a>
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
                                    </div></label>
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
                            
                                <div class="form-group row color-o">
                                <div class="div-texto1-pf">
                                     Precios fijos</div>
                                    <div class="col-md-3">
                                        <table>
                                                <tr v-for="montos in arraymontos" :key="montos.id" v-if="montos.id<5"><input type="radio" v-model="montoFijo" v-bind:value="montos.id" @change="autollenado(montoFijo)">{{montos.nombreMF}} </tr>                         
                                        </table>
                                    </div>
                                    <div class="col-md-3">
                                        <table>
                                                <tr v-for="montos in arraymontos" :key="montos.id" v-if="montos.id>=5 && montos.id<9"><input type="radio" v-model="montoFijo" v-bind:value="montos.id" @change="autollenado(montoFijo)">{{montos.nombreMF}} </tr>                         
                                        </table>
                                    </div>
                                    <div class="col-md-3">
                                        <table>
                                                <tr v-for="montos in arraymontos" :key="montos.id" v-if="montos.id>=9 && montos.id<14"><input type="radio"  v-model="montoFijo" v-bind:value="montos.id" @change="autollenado(montoFijo)">{{montos.nombreMF}} </tr>                         
                                        </table>
                                    </div>
                                    <div class="col-md-3 ">
                                        <table>
                                                <tr v-for="montos in arraymontos" :key="montos.id" v-if="montos.id>=14 && montos.id<19"><input type="radio"  v-model="montoFijo" v-bind:value="montos.id" @change="autollenado(montoFijo)">{{montos.nombreMF}} </tr>                         
                                        </table>
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
            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Eliminar Categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de eliminar la categoría?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
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
                montoFijo:0,
                arrayMontoFijo:[],
                arraymontos:[],
                to:[],
                totalAcum:'',
                errorDatos:0,
                errorMostrarMsj:[],
                
                   //
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
             llenadoradiobotones(buscar,criterio){
                let me=this;
                var url='/montofijo?buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url) .then(function (response) {
                    me.arraymontos=response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            
            },
               
            listarEfectivo(){
                let me=this;
                axios.get('/efectivo') .then(function (response) {
                    me.arrayEfectivo=response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            
            },
        
         registrarEfectivos(){
             if(this.validarvalores()){
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
                    me.listarEfectivo();
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
                  'num_recibo': this.num_recibo,
                  'descripcion_efectivo':this.descripcion_efectivo,
                  'monto':this.monto,
                  'tipo':this.tipo,
                  'id':this.efectivo_id,
              }) .then(function (response) {
                    me.cerrarModal();
                    me.listarEfectivo();
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

            },
            autollenado(montoFijo){
               // console.log(this.montoFijo); 
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
                this.descripcion_efectivo=d["nombreMF"]; 
                this.monto= d["montoF"];    

            },
             validarvalores(){
                this.errorDatos=0;
                this.errorMostrarMsj=[];
                var RE = /^\d*(\.\d{1})?\d{0,1}$/;
               var Max_Length = 50;
               var Min_Length = 3;
               if(!this.tipo) this.errorMostrarMsj.push("El tipo no puede estar vacío");
               var lengthmax = this.descripcion_efectivo.length;
               var lengthmin = this.descripcion_efectivo.length;
               if (lengthmax > Max_Length)this.errorMostrarMsj.push("El concepto debe tener menos de 50 letras");
                if (lengthmin < Min_Length)this.errorMostrarMsj.push("El concepto debe tener más 3 letras");
                if (!RE.test(this.monto))  this.errorMostrarMsj.push("El monto solo pueden ser decimales");
                if(this.errorMostrarMsj.length) this.errorDatos=1;
            

                return this.errorDatos;
            },
             
             llenarsuma(d=[]){
                this.totalAcum= d;    
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
                        }
                    }
                }

            }
        },
        
        mounted() {
            this.listarEfectivo();
            this.llenadoradiobotones('','');
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