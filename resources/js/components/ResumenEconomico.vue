<template>
   <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">

                    <div class="card-header"><label class="titulo-encabezados">Resumen económico del mes</label>                        
                    </div>
                    <div class="card-body">
                              <div>
                                    <div id="input-groupG">                                  
                                                <label id="zonaiglesia" for="text-input">MES</label>
                                                <div class="col-md-3">
                                                        <select class="form-control" v-model="mesBuscar"> 
                                                        <option value="0" disabled>Mes</option>
                                                        <option v-for="mes in arraymes" :key="mes.id" v-bind:value="mes" v-text="mes"></option>
                                                        </select>
                                                </div>
                                                 <label id="zonaiglesia" for="text-input">AÑO</label>
                                                <div class="col-md-3">
                                                    <input type="number" v-model="anioBuscar" @keyup.enter="listaResumenEconomico(anioBuscar,mesBuscar)" class="form-control" placeholder="Ejem:2019">
                                                </div>
                                                <button type="button" @click="filtrarResumenEconomico(anioBuscar,mesBuscar) " class="btn btn-primary"><i class="fa fa-search"></i>Filtrar</button>
                                                
                                    </div>
                                </div>

                        <div class="form-group row">
                        </div> 
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Concepto</th>
                                    <th>Ingreso</th>
                                    <th>Egreso </th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                
                                   <tr v-for="resumEco in arrayResumenEco" :key="resumEco.id_temp"> 
                                    <td v-text="resumEco.nombres"></td>

                                    <template v-if="resumEco.tipo == 1">
                                        <td v-text="resumEco.montos"></td>
                                        <td></td>
                                    </template>
                                    <template v-else-if="resumEco.tipo == 2">
                                        <td></td>
                                        <td v-text="resumEco.montos"></td>
                                    </template>
                                </tr>
                                <tr v-for="resumEco in arrayResumenEconull" :key="resumEco.id_tempnul"> 
                                    <td v-text="resumEco.descripcion_efectivo"></td>

                                    <template v-if="resumEco.tipo == 1">
                                        <td v-text="resumEco.monto"></td>
                                        <td></td>
                                    </template>
                                    <template v-else-if="resumEco.tipo == 2">
                                        <td></td>
                                        <td v-text="resumEco.monto"></td>
                                    </template>
                                </tr>
                                <tr>
                                <td>SUBTOTALES</td>
                                <td>{{ingresos}}</td>
                                <td>{{egresos}}</td>
                                </tr>
                                <tr>
                                <td>TOTAL</td>
                                <td colspan="2">{{total}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="input-group margen">
                            <button type="button" @click="cargarPDF()" class="btn btn-info">
                                    <i class="icon-doc"></i>&nbsp;Generar Reporte Resumido Actual
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            
           
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
                nombre_categoria:'',
                arrayResumenEconull:[],
                arrayResumenEco:[],
                ingresos:'',
                egresos:'',
                total:'',
                modal : 0,
                tituloModal : '',
                tipoAccion:0,
                montoFijo:1,
                arrayMontoFijo:[],
                montoFi:1,   //
                idEfectivo:'',
                modalE:0,
                checkedNa:[],
                checked:0,
                arrayResumenEcoSel:[],

                /////////////////////////////
                arraymes:[],
                mesBuscar:'',
                anioBuscar:'',

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

            llenadoarray(){            
                this.arraymes= new Array('ENERO','FEBRERO', 'MARZO','ABRIL','MAYO','JUNIO','JULIO','AGOSTO','SEPTIEMBRE','OCTUBRE','NOVIEMBRE','DICIEMBRE');                
            },
            listaResumenEconomico(mesBuscar,anioBuscar){
                let me=this;
                var url='/resumeneconomico?&anioBuscar=' + anioBuscar + '&mesBuscar=' + mesBuscar;
                axios.get(url) .then(function (response) {
                    // handle success
                    var respuesta= response.data;
                    me.arrayResumenEco=respuesta.categoria;
                    me.arrayResumenEconull=respuesta.nullo;
                    me.egresos=respuesta.egresos;
                    me.ingresos=respuesta.ingresos;
                    me.total=respuesta.total;
                 //   me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                  //  console.log(error);
                });
            
            },
            filtrarResumenEconomico(anioBuscar,mesBuscar){
                let me=this;
                var url='/resumeneconomico/buscarAM?anioBuscar=' + anioBuscar + '&mesBuscar=' + mesBuscar;
                axios.get(url) .then(function (response) {
                    // handle success
                    var respuesta= response.data;
                    me.arrayResumenEco=respuesta.categoria;
                    me.arrayResumenEconull=respuesta.nullo;
                    me.egresos=respuesta.egresos;
                    me.ingresos=respuesta.ingresos;
                    me.total=respuesta.total;
                })
                .catch(function (error) {
                    // handle error
                  //  console.log(error);
                });
            },


              cargarPDF(){
            window.open('http://127.0.0.1:8000/efectivo/listarPdfResumido','_blank');
        },


    
        },
        
        mounted() {
            this.listaResumenEconomico(1,this.anioBuscar,this.mesBuscar);
            this.llenadoarray();
           
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
    #input-groupG {
  position: relative;
  display: flex;
  width: 100%; }

  #zonaiglesia {
      font-size:  x-large;
      font-weight: bold; }
</style>