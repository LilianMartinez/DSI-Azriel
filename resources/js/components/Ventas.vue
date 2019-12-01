 <template>
    <main class="main">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div>
                        <label class="titulo-encabezados">Informe de compras y ventas</label> 
                    </div>
                </div>
                 <!-- Listado-->
                <template v-if="listado">
                    <div class="card-body">
                        <div class="form-group row border">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for=""><strong>Seleccione desde y hasta que fecha desea el informe</strong></label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Desde:</label>
                                        <input type="month" name="fecha" id="fecha" class="form-control"  v-model="fecha1">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="">Hasta:</label>
                                        <input type="month" name="fecha" id="fecha" class="form-control" v-model="fecha2">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" @click="mostrarInforme()">Generar</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </template>
                <!--Fin Listado-->
                <!-- Detalle-->
                <template v-else>
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-10">
                                    <label><strong>Total de inversión</strong></label>
                                    <label><strong>$ {{compras}}</strong></label>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                <label>Inversión en productos individuales:</label>
                                <label>$ {{comprasindividual}}</label>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Inversión en canastas</label>
                                    <label>$ {{comprascanasta}}</label>
                                </div>
                            </div>
                            <!-- Inicia tabla-->
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-2">
                                        <label><strong>Cantidad</strong></label>
                            </div>
                             <div class="col-md-2">
                                        <label><strong>Inversion</strong></label>
                            </div>
                             <div class="col-md-2">
                                        <label><strong>Ingreso</strong></label>
                            </div>
                             <div class="col-md-2">
                                     <label><strong>Ganancia</strong></label>  
                            </div>
                            <div class="col-md-3">
                                        <label><strong>individual</strong></label>
                            </div>
                            <div class="col-md-2">
                                        <label>{{individuales}}</label>
                            </div>
                             <div class="col-md-2">
                                        <label>$ {{costoindividual}}</label>
                            </div>
                             <div class="col-md-2">
                                        <label>$ {{ventasindividual}}</label>
                            </div>
                             <div class="col-md-2">
                                       <label><strong>$ {{gananciaindividual}}</strong></label>
                            </div>
                            <div class="col-md-3">
                                        <label><strong>canastas</strong></label>
                            </div>
                            <div class="col-md-2">
                                         <label>{{canastas}}</label>
                            </div>
                             <div class="col-md-2">
                                        <label>$ {{costocanasta}}</label>
                            </div>
                             <div class="col-md-2">
                                        <label>$ {{ventascanasta}}</label>
                            </div>
                             <div class="col-md-2">
                                       <label><strong>$ {{gananciacanasta}}</strong></label>
                            </div>
                            <div class="col-md-3">
                                        <label><strong>Totales</strong></label>
                            </div>
                            <div class="col-md-2">
                                         
                            </div>
                             <div class="col-md-2">
                                        <label><strong>$ {{costos}}</strong></label>
                            </div>
                             <div class="col-md-2">
                                        <label><strong>$ {{ventas}}</strong></label>
                            </div>
                             <div class="col-md-2">
                                       <label><strong>$ {{ganancia}}</strong></label>
                            </div>
                            
                            
                            
                            <div class="col-md-9">
                                    
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="button" @click="ocultarInforme()" class="btn btn-secondary">Volver</button>
                                </div>
                            </div>
                            
                        
                        </div>
                    </div>
                    </template>
                    <!-- Fin Detalle-->
                </div>
                <!-- Fin ejemplo de tabla Listado -->
                </div>
            
        </main>
</template>

<script>
    export default {
        data (){
            return {
                ventasindividual:'',
                ventascanasta:'',
                ventas:'',
                compras:'',
                comprasindividual:'',
                comprascanasta:'',
                ganancia:'',
                gananciaindividual:'',
                gananciacanasta:'',
                canastas:'',
                costoindividual:'',
                costocanasta:'',
                costos:'',
                individuales:'',
                respuesta : '',
                listado:1,
                fecha1 : '',
                fecha2:'',
            }
        },
        methods : {
            listarInforme(){
                let me=this;
                var url= '/producto/informe?fecha1='+ me.fecha1 + '&fecha2='+ me.fecha2;
                axios.get(url).then(function (response) {
                    me.respuesta = response.data;
                    me.llenar();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            mostrarInforme(){
                let me=this;
                me.listado=0;
                me.listarInforme();
            },
            llenar(){
                
               this.comprascanasta = parseFloat(this.respuesta['ComprasCanasta']).toFixed(2);
               this.comprasindividual = parseFloat(this.respuesta['ComprasSuelto']).toFixed(2);
               this.compras = parseFloat(this.respuesta['ComprasTotales']).toFixed(2);
               this.ventasindividual = parseFloat(this.respuesta['ventasSuelto']).toFixed(2);
               this.ventascanasta = parseFloat(this.respuesta['ventasCanasta']).toFixed(2);
               this.ventas = parseFloat(this.respuesta['VentassTotales']).toFixed(2);
               this.costocanasta = parseFloat(this.respuesta['costoCanasta']).toFixed(2);
               this.gananciacanasta = parseFloat(this.respuesta['gananciaCanasta']).toFixed(2);
               this.costoindividual = parseFloat(this.respuesta['costoventas']).toFixed(2);
               this.gananciaindividual = parseFloat(this.respuesta['gananciaproductos']).toFixed(2);
               this.individuales = this.respuesta['productosvendidos'];
               this.canastas = this.respuesta['canastas'].filas;
               this.costos= parseFloat(this.respuesta['costos']).toFixed(2);
               this.ganancia=parseFloat(this.respuesta['ganacia']).toFixed(2);
            },
            ocultarInforme(){
                this.listado=1;
                this.comprascanasta = '';
               this.comprasindividual = '';
               this.compras = '';
               this.ventasindividual = '';
               this.ventascanasta = '';
               this.ventas = '';
               this.costocanasta = '';
               this.gananciacanasta = '';
               this.costoindividual = '';
               this.gananciaindividual = '';
               this.individuales = '';
               this.canastas = '';
            }
        },
        
        }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
    @media (min-width: 600px) {
        .btnagregar {
            margin-top: 2rem;
        }
    }

</style>

