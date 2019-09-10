<template>
   <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header"><label class="titulo-encabezados">Resumen Economico</label>
                        
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                       <option value="fecha">Fecha</option>
                                      <option value="num_recibo">Factura</option>
                                      <option value="descripcion_efectivo">Concepto</option>
                                      <option value="monto">Cantidad de dinero</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarEfectivo(1,buscar,criterio,2)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarEfectivo(1,buscar,criterio,2) " class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Fecha</th>
                                    <th>Factura</th>
                                    <th>Concepto</th>
                                    <th>Ingreso</th>
                                    <th>Egreso </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="efectivo in arrayEfectivo" :key="efectivo.id">
                                    <!--{{efectivo.fecha | dateFormat('d-m-Y')}}--> 
                                   <!--<script language="JavaScript" type="text/javascript">
                                        
                                       
                                        @change="comprobar(checkedNa)"

                                    </script>-->
                                    <td><input type="checkbox" v-model="checked"  v-bind:value="efectivo.id" @change="comprobar(checked)">
                                    holi</td>
                                    <td v-text="efectivo.fecha"> {{moment(efectivo.fecha).format('DD/MM/YYYY')}} </td>
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
                                </tr>
                            </tbody>
                        </table>
                        <div class="input-group margen">
                            <button type="button" id="boton" @click="abrirModal('efectivos','agrupar')" class="btn btn-primary"> 
                                    <i></i>&nbsp;Agrupar
                            </button>
                            <!--
                                <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarEfectivos()">Guardar</button>
                                <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizarEfectivos()">Actualizar</button>-->
                        </div>
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
                                    <label class="col-md-2 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="num_recibo" class="form-control" placeholder="Nombre de la agrupacion">
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
                                     <label class="col-md-2 form-control-label" for="text-input">Tipo<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <table>
                                            <tr> <input tabindexgt="-1" type="radio" v-model="tipo" value="1" name="tipo" required> Ingreso</tr>
                                            <tr> <input tabindexgt="-1" type="radio" v-model="tipo" value="2" name="tipo"> Egreso</tr>
                                        </table>
                                    </div>
                                    <div class="col-md-4 modal-fo">
                                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                                        <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="agruparSeleccionados()">Guardar</button>
                                    </div>
                                </div>  
                                <!-- <div v-show="errorDatos" class="form-group row div-error">
                                <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsj" :key="error" v-text="error">
                                </div>
                                </div>
                                </div>     -->                                                
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
           
            
           
        </main>
</template>
<script>
 var moment = require('moment');
    export default {
      data(){

            return{
                moment: moment,
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
                montoFi:1,   //
                idEfectivo:'',
                modalE:0,
                tipocomponente:2,
                checkedNa:[],
                checked:0,
                arrayEfectivoSel:[],

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

            listarEfectivo(page,buscar,criterio,tipocomponente){
                let me=this;
                var lengthbuscar = this.buscar.length;
                 if(lengthbuscar >0)
                 {
                     var buscar2= this.buscar.toUpperCase();
                 }else
                 buscar2=this.buscar;
                var url='/efectivo?page='+ page + '&buscar=' + buscar2 + '&criterio=' + criterio +'&componente=' + tipocomponente;
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
            me.listarEfectivo(page,buscar,criterio,tipocomponente);
        },
        agruparSeleccionados(){

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
        abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "efectivos":
                    {
                        switch(accion){
                            case 'agrupar':
                            {
                                this.modal=1;
                                this.tituloModal='Agrupar Movimientos'
                                this.tipoAccion=1;
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

            },
    comprobar(checked)
       {   
        if (checked==0)
        document.getElementById("boton").disabled = true;
        else
        document.getElementById("boton").disabled = false;
       }

    
        },
        
        mounted() {
            this.listarEfectivo(1,this.buscar,this.criterio,this.tipocomponente);
           
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