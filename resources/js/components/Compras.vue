<template>
    <main class="main">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div>
                    <label class="titulo-encabezados">Compras</label> 
                    </div>
                    <div>
                    <button type="button" @click="mostrarDetalle()" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                    </div>
                </div>
                 <!-- Listado-->
                <template v-if="listado">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="producto">Producto</option>
                                      <option value="fecha_hora">Fecha</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarIngreso(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarIngreso(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Costo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="ingreso in arrayIngreso" :key="ingreso.id">
                                        <td v-text="ingreso.fecha"></td>
                                        <td v-text="ingreso.nombre_producto"></td>
                                        <td v-text="ingreso.cantidad"></td>
                                        <td v-text="ingreso.precio_compra"></td>
                                    </tr>                                
                                </tbody>
                            </table>
                        </div>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </template>
                <!--Fin Listado-->
                <!-- Detalle-->
                <template v-else>
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="">Producto</label>
                                    <v-select
                                        @search="selectProducto"
                                        label="nombre_producto"
                                        :options="arrayProducto"
                                        v-model="id_productoR"
                                        placeholder="Buscar Producto"
                                        :change="getdatosproducto(id_productoR)"
                                    >
                                    </v-select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Cantidad<b class="alerta">*</b></label>
                                <input type="text" class="form-control" v-model="cantidad">
                            </div>
                            <div class="col-md-3">
                                <label for="">Costo<b class="alerta">*</b></label>
                                <input type="text" class="form-control" v-model="precio_compra">
                            </div>
                            <div class="col-md-7">
                            <label for="text-input">Tipo<b class="alerta">*</b></label>
                                
                                        <table class="col-md-6">
                                        <tr>
                                            <td> <input tabindexgt="-1" type="radio" v-model="tipo" value="1" name="tipo" required> Canasta</td>
                                            <td> <input tabindexgt="-1" type="radio" v-model="tipo" value="2" name="tipo"> Producto suelto</td>
                                        </tr>
                                        </table>
                                
                                    </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button @click="agregarDetalle()" class="btn btn-success form-control btnagregar"><i class="icon-plus"></i></button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div v-show="errorIngreso" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjIngreso" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Costo</th>
                                            <th v-show="ti==2">Precio Venta</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                            <td>
                                                <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                                    <i class="icon-close"></i>
                                                </button>
                                            </td>
                                            <td v-text="detalle.producto">
                                            </td>
                                            <td>
                                                <input v-model="detalle.cantidad" type="number" value="3" class="form-control">
                                            </td>
                                            <td>
                                            <input v-model="detalle.precio_compra" type="number" value="2" class="form-control">
                                            </td>
                                            <td v-show="detalle.tipo==2">
                                            <input v-show="detalle.tipo==2" v-model="detalle.precio_venta" type="number" value="2" class="form-control">
                                            </td>
                                        </tr>
                                        <tr v-show="ti==2" style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total:</strong></td>
                                            <td>$ {{total=calcularTotal}}</td>
                                        </tr>
                                        <tr v-show="ti!=2" style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong>Total:</strong></td>
                                            <td>$ {{total=calcularTotal}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr v-show="ti==2">
                                            <td colspan="5">
                                                No hay productos agregados
                                            </td>
                                        </tr>
                                        <tr v-show="ti!=2">
                                            <td colspan="4">
                                                No hay productos agregados
                                            </td>
                                        </tr>
                                    </tbody>                                       
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                <button type="button" class="btn btn-primary" @click="registrarIngreso()">Registrar Compra</button>
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
    import vSelect from 'vue-select';
    import 'vue-select/dist/vue-select.css';
    export default {
        data (){
            return {

                producto : '',
                id_productoR:'',
                id_producto:'',
                precio_compra:0.0,
                precio_venta:0.0,
                cantidad:0.0,
                fecha:'',
                tipo:'',
                ti:0,
                total:0.0,
                arrayIngreso : [],
                arrayDetalle : [],
                arrayProducto : [],

                modal : 0,
                listado:1,
                tituloModal : '',
                tipoAccion : 0,
                errorIngreso : 0,
                errorMostrarMsjIngreso : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'producto',
                buscar : '',
            }
        },
        components:{
            vSelect
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            calcularTotal: function(){
                var resultado =0.0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    resultado=resultado+parseFloat(this.arrayDetalle[i].precio_compra);
                }
                return resultado;

            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {
            listarIngreso (page,buscar,criterio){
                let me=this;
                var url= '/compras?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    response.data.ingresos.data.forEach(function(element) {
                        var texto = element.fecha;
                        element.fecha= texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
                    });
                    var respuesta= response.data;
                    me.arrayIngreso = respuesta.ingresos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarIngreso(page,buscar,criterio);
            },
            selectProducto(search,loading){
                let me=this;
                loading(true);

                var url='/producto/seleccionar?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta=response.data;
                    q: search
                    me.arrayProducto=respuesta.producto;
                    loading(false)
                })
                .catch(function (error) {
                    console.log(error);
                    
                });
            },
            getdatosproducto(val1){
                let me = this;
                me.loading = true;
                me.id_producto = val1.id;
                me.producto=val1.nombre_producto;
            },
            encuentra(id){
                var sw=0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    if(this.arrayDetalle[i].id_producto==id){
                        sw=true;
                    }
                }
                return sw;
            },
            eliminarDetalle(index){
                let me = this;
                me.arrayDetalle.splice(index, 1);
                for(var i=0;i<this.arrayDetalle.length;i++){
                    if(this.arrayDetalle[i].tipo==2){
                        me.ti=2;
                    }else{
                        me.ti=0;
                    }
                }
            },
            agregarDetalle(){
                let me=this;
                if(me.ti!=2 && me.tipo==2){
                    me.ti=2;
                }
                if (this.validarCompra()){
                        return;}
                
                if(me.id_producto==0 || me.cantidad==0 || me.precio_compra==0){
                }
                else{
                    if(me.encuentra(me.id_producto)){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Ese artículo ya se encuentra agregado!',
                            })
                    }
                    else{
                        
                       me.arrayDetalle.push({
                            id_producto: me.id_producto,
                            producto: me.producto,
                            cantidad: me.cantidad,
                            precio_compra: me.precio_compra,
                            precio_venta:me.precio_venta,
                            tipo : me.tipo
                        });
                        me.id_producto=0;
                        me.cantidad=0;
                        me.producto='';
                        me.precio_compra=0; 
                        me.precio_venta=0;
                        me.tipo='';
                    }
                    
                }

                

            },
            
            registrarIngreso(){
                
                let me = this;

                axios.put('/compras/registrar',{
                    'data': this.arrayDetalle
                }).then(function (response) {
                    me.listado=1;
                    me.listarIngreso(1,'','id_producto');
                    me.id_producto=0;
                    me.cantidad='';
                    me.precio_compra='';
                    me.tipo=0;
                    me.total=0.0;
                    me.arrayDetalle=[];
                }).catch(function (error) {
                    console.log(error);
                });
            },
            
            validarCompra(){
                this.errorIngreso=0;
                this.errorMostrarMsjIngreso =[];

                if (this.id_producto==0) this.errorMostrarMsjIngreso.push("Debe seleccionar un producto.");
                if (this.cantidad<=0) this.errorMostrarMsjIngreso.push("La cantidad no puede estar vacia.");
                if (this.precio_compra<=0) this.errorMostrarMsjIngreso.push("El precio del producto comprado no puede estar vacio.");
                //if (this.arrayDetalle.length<=0) this.errorMostrarMsjIngreso.push("Ingrese productos");
                if(!this.tipo) this.errorMostrarMsjIngreso.push("El tipo no puede estar vacío");
                if (this.errorMostrarMsjIngreso.length) this.errorIngreso = 1;
                return this.errorIngreso;
            },
            mostrarDetalle(){
                let me=this;
                me.listado=0;
                me.id_producto=0;
                me.cantidad='';
                me.precio_compra='';
                me.tipo=0;
                me.total=0.0;
                me.arrayDetalle=[];
            },
            ocultarDetalle(){
                this.listado=1;
            },
           
           
        },
        mounted() {
            this.listarIngreso(1,this.buscar,this.criterio);
        }
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
