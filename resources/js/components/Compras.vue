<template>
    <main class="main">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div>
                        <label class="titulo-encabezados">Compras</label> 
                    </div>
                    <div>
                        <button type="button" @click="mostrarDetalle()" class="btn btn-primary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                </div>
                 <!-- Listado-->
                <template v-if="listado==1">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="producto">Producto</option>
                                      <option value="fecha_hora">Fecha</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listaringreso(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listaringreso(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                    
                          <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Costo ($)</th>
                                        <th>Tipo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="ingreso in arrayIngreso" :key="ingreso.idc">
                                        <td v-text="ingreso.fecha"></td>
                                        <td>{{ingreso.nombre_producto}} ({{ingreso.unidad_medida}})</td>
                                        <td v-text="ingreso.cantidad"></td>
                                        <td v-text="ingreso.precio_compra"></td>
                                        <td v-if="ingreso.tipo == 1"> Canasta</td>
                                        <td v-if="ingreso.tipo == 2"> Suelto</td>
                                    </tr>                                
                                </tbody>
                            </table>
                        
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
                <!-- registrar compra-->
                <template v-else>
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="">Producto<b class="alerta">*</b></label>
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
                                <label for="">Costo($)<b class="alerta">*</b></label>
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
                                            <th>Costo($)</th>
                                            <th v-show="ti==2">Precio Venta($)</th>
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
                                                <input v-model="detalle.cantidad" type="number"  value="3" class="form-control">
                                            </td>
                                            <td>
                                            <input v-model="detalle.precio_compra" type="number"  step="0.01" value="2" class="form-control">
                                            </td>
                                            <td v-show="detalle.tipo==2">
                                            <input v-show="detalle.tipo==2" v-model="detalle.precio_venta"  step="0.01" type="number" value="2" class="form-control">
                                            </td>
                                        </tr>
                                        <tr v-show="ti==2" style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong>Total:</strong></td>
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
                                <div v-show="errorIngresoT" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjIngresoT" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div> 
                            </div>
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
                id_producto:0,
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
                errorIngresoT : 0,
                errorMostrarMsjIngresoT : [],
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
            listaringreso(page,buscar,criterio){
                let me=this;
                var lengthbuscar = this.buscar.length;
                me.listado=1;
                 if(lengthbuscar >0)
                 {
                     var buscar2= this.buscar.toUpperCase();
                 }else
                 buscar2=this.buscar;
                var url= '/compras?page=' + page + '&buscar='+ buscar2 + '&criterio='+ criterio;
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
                me.listaringreso(page,buscar,criterio);
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
                if(val1== null)
                {
                    me.loading = false;
                    me.id_producto = 0;
                    me.producto='';
                    return;
                }
                if(val1=='')
                {
                    me.loading = false;
                    me.id_producto = 0;
                    me.producto='';
                    return;
                }
                else{
                    me.loading = true;
                    me.id_producto = val1.id;
                    me.producto=val1.nombre_producto;
                }
                
            },
            encuentra(id,tipo){
                var sw=0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    if(this.arrayDetalle[i].id_producto==id){
                        if(this.arrayDetalle[i].tipo==tipo){
                            sw=true;
                        }
                        
                    }
                }
                return sw;
            },
            eliminarDetalle(index){
                let me = this;
                me.arrayDetalle.splice(index, 1);
                var i=this.arrayDetalle.length;
                if(i==0){
                        me.ti=0;
                        return;
                    }
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
                
                if(me.id_producto==0 || me.cantidad==0 || me.precio_compra<0){
                }
                else{
                    if(me.encuentra(me.id_producto, me.tipo)){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Ese artículo ya se encuentra agregado!',
                            })
                    }
                    else{
                        if(me.tipo==1)
                        {
                            me.precio_venta=0;
                        }
                       
                       me.arrayDetalle.push({
                            id_producto: me.id_producto,
                            producto: me.producto,
                            cantidad: me.cantidad,
                            precio_compra: parseFloat(me.precio_compra).toFixed(2),
                            precio_venta:parseFloat(me.precio_venta).toFixed(2),
                            tipo : me.tipo
                        });
                        me.cantidad='';
                        me.producto='';
                        me.precio_compra=''; 
                        me.precio_venta='';
                        me.tipo='';
                        me.id_productoR=[];
                    }
                    
                }

                

            },
            
            registrarIngreso(){
                if(this.validarvalores()){
                  return;   
                 }
                let me = this;

                axios.put('/compras/registrar',{
                    'data': this.arrayDetalle
                }).then(function (response) {
                    me.id_producto=0;
                    me.cantidad='';
                    me.precio_compra='';
                    me.tipo=0;
                    me.total=0.0;
                    me.arrayDetalle=[];
                    me.arrayProducto=[];
                    me.mensajeExito();
                }).catch(function (error) {
                   
                });
            },
            mensajeExito(){
                swal({
                title: '¡Compra realizada con exito!',
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
            validarvalores(){
                this.errorIngresoT=0;
                this.errorMostrarMsjIngresoT =[];
                let me = this;
                if(me.arrayDetalle.length==0)
                {
                    this.errorMostrarMsjIngresoT.push("No se ha agregado ningún producto a la compra");
                }
                else{
                    for(var i=0;i<me.arrayDetalle.length;i++){
                        if (me.arrayDetalle[i].cantidad<=0) this.errorMostrarMsjIngresoT.push("La cantidad no puede estar vacia");
                        if (me.arrayDetalle[i].precio_compra=='') this.errorMostrarMsjIngresoT.push("El precio del producto comprado no puede estar vacio");
                        if (me.arrayDetalle[i].tipo!=1){
                            if (me.arrayDetalle[i].precio_venta=='') this.errorMostrarMsjIngresoT.push("El precio de venta no puede estar vacio");
                        }
                    }
                }
                if (this.errorMostrarMsjIngresoT.length) this.errorIngresoT = 1;
                return this.errorIngresoT;
            },
            validarCompra(){
                this.errorIngreso=0;
                this.errorMostrarMsjIngreso =[];
                var RE = /^([0-9])*$/;
                var RE2 = /^\d*(\.\d{1})?\d{0,1}$/;
                if (this.id_producto==0) this.errorMostrarMsjIngreso.push("Debe seleccionar un producto");
                if (this.cantidad<1) this.errorMostrarMsjIngreso.push("La cantidad no puede ser menor que uno");
                if (!RE.test(this.cantidad)) this.errorMostrarMsjIngreso.push("La cantidad debe ser un numero");
                if (this.precio_compra=='') this.errorMostrarMsjIngreso.push("El precio del producto comprado no puede estar vacio");
                if (!RE2.test(this.precio_compra)) this.errorMostrarMsjIngreso.push("El precio del producto solo pueden ser decimales");
                if(!this.tipo) this.errorMostrarMsjIngreso.push("El tipo no puede estar vacío");
                if (this.errorMostrarMsjIngreso.length) this.errorIngreso = 1;
                return this.errorIngreso;
            },
            mostrarDetalle(){
                let me=this;
                me.buscar='';
                me.listaringreso(1,'','producto');
                me.listado=0;
                me.id_producto=0;
                me.cantidad='';
                me.precio_compra='';
                me.tipo=0;
                me.ti=0;
                me.total=0.0;
                me.arrayDetalle=[];
            },
            ocultarDetalle(){
                this.listado=1;
            },
           
           
        },
        mounted() {
            this.listaringreso(1,this.buscar,this.criterio);
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
