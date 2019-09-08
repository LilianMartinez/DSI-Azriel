<template>
   <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header"><label class="titulo-encabezados">Historial de Registros</label>
                        
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
                                    <th>fecha</th>
                                    <th>Factura</th>
                                    <th>Concepto</th>
                                    <th>Ingreso</th>
                                    <th>Egreso </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="efectivo in arrayEfectivo" :key="efectivo.id">
                                    
                                    <td v-text="efectivo.fecha">{{format('DD/MM/YYYY')}}</td>
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
                montoFi:1,   //
                idEfectivo:'',
                modalE:0,
                tipocomponente:2,

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