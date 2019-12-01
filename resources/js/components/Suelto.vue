<template>
    <main class="main">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div>
                    <label class="titulo-encabezados">Producto Suelto</label> 
                    </div>
                    <div>
                    <button type="button" @click="mostrarDetalle()" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Venta
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
                                      <option value="nombre_producto">Nombre</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarproduc(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarproduc(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Nombre</th>
                                        <th>Existencias</th>
                                        <th>Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="producto in arraysProducto" :key="producto.id">
                                        <td v-text="producto.fecha"></td>
                                        <td v-text="producto.nombre_producto"></td>
                                        <td v-text="producto.cantidad"></td>
                                        <td v-text="producto.precio_venta"></td>
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
                                        @search="listarproduc2"
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button @click="agregarDetalle()" class="btn btn-success form-control btnagregar"><i class="icon-plus"></i></button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div v-show="errorProducto" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjProducto" :key="error" v-text="error">
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
                                            <td v-text="detalle.cantidad">
                                            </td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="2" align="right"><strong>Total:</strong></td>
                                            <td>$ {{totalP}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
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
                                <button type="button" class="btn btn-primary" @click="registrarVentaP()">Registrar Venta</button>
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
                nombre_producto:'',
                precio_venta:'',
                cantidad:0.0,
                cantidadT:'',
                fecha:'',
                tipo:'',
                totalP:0.0,
                arraysProducto : [],
                arraysProducto2 : [],
                arrayDetalle : [],
                arrayProducto : [],
                cantidadQ:[],
                po:'',
                listado:1,
                errorProducto : 0,
                errorMostrarMsjProducto : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre_producto',
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
            listarproduc (page,buscar,criterio){
                let me=this;
                var url= '/productos/v?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    response.data.productos.data.forEach(function(element) {
                        var texto = element.fecha;
                        element.fecha= texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
                    });
                    var respuesta= response.data;
                    me.arraysProducto = respuesta.productos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarproducto2(page,buscar,criterio){
                let me=this;
                var url= '/productos/v?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arraysProducto2 = respuesta.productos.data;
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
                me.listarproduc(page,buscar,criterio);
            },
            listarproduc2(search,loading){
                let me=this;
                loading(true);

                var url='/productos/venta?filtro='+search;
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
                me.precio_venta=val1.precio_venta;
                
            },
            
            validar(){
                let me=this;
                var resultado =0.0;
                var inter;
                
            
                for(var i=0;i<me.arraysProducto2.length;i++){
                     if(me.arraysProducto2[i].id==me.id_producto){
                    
                    resultado=resultado+ parseInt(me.arraysProducto2[i].cantidad);
                }
                }
                
                inter=parseInt(me.cantidad);
                me.cantidadT=inter;
                if(me.cantidadT<=resultado){
                        for(var i=0;i<this.arraysProducto2.length;i++){   
                            if(me.cantidadT!=0 && me.arraysProducto2[i].id==me.id_producto){
                                var c=parseInt(me.arraysProducto2[i].cantidad);
                                var p;
                                var t;
                                var x;
                                if(me.cantidadT>c){
                                    t=parseFloat(me.arraysProducto2[i].precio_venta);
                                    me.totalP=(me.totalP+ t*c);
                                    me.cantidadQ.push({
                                        id_producto: me.id_producto,
                                        descontar: c,
                                        id_existencia: me.arraysProducto2[i].exi,
                                        queda: 0,
                                        preciov: t*c
                                    });
                                    p=me.cantidadT-c;
                                    me.cantidadT=p;
                                }else{
                                    t=parseFloat(me.arraysProducto2[i].precio_venta);
                                    x=parseInt(me.cantidadT);
                                 
                                    me.totalP=(me.totalP+ t*x);
                                    me.cantidadQ.push({
                                        id_producto: me.id_producto,
                                        descontar: me.cantidadT,
                                        id_existencia: me.arraysProducto2[i].exi,
                                        queda: c-me.cantidadT,
                                        preciov: t*x
                                    });
                                    me.cantidadT=0;
                                    break;
                                }
                        }
                }

                
               


                }else{

                }

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
                me.po=me.arrayDetalle[index].id_producto;
                for(var i=0;i<this.cantidadQ.length;i++){
                    if(this.cantidadQ[i].id_producto==me.po){
                        me.totalP=me.totalP-me.cantidadQ[i].preciov;
                        me.cantidadQ.splice(i, 1);
                    }
                }
                me.arrayDetalle.splice(index, 1);
                
            },
            agregarDetalle(){
                let me=this;
                if(me.id_producto==0 || me.cantidad==0){
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
                        me.validar();
                        me.arrayDetalle.push({
                            id_producto: me.id_producto,
                            producto: me.producto,
                            cantidad:me.cantidad,
                        });
                        
                        me.id_producto=0;
                        me.producto='';
                        
    
                    }
                    
                }

            },
            
            registrarVentaP(){
                let me = this;

                axios.put('/venta/registrar',{
                    'data': this.arrayDetalle,
                    'existencias': this.cantidadQ
                }).then(function (response) {
                    me.listado=1;
                    me.listarproduc(1,'','nombre_producto');
                    me.id_producto=0;
                    me.cantidad='';
                    me.nombre_producto='';
                    me.precio_venta='';
                    me.arrayDetalle=[];
                    me.cantidadQ=[];
                    me.totalP=0;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarCompra(){
                this.errorProducto=0;
                this.errorMostrarMsjProducto =[];

                if (this.id_producto==0) this.errorMostrarMsjProducto.push("Debe seleccionar un producto.");
                if (!this.cantidad) this.errorMostrarMsjProducto.push("La cantidad no puede estar vacia.");
                if (this.arrayDetalle.length<=0) this.errorMostrarMsjProducto.push("Ingrese productos");
                if(!this.tipo) this.errorMostrarMsjProducto.push("El tipo no puede estar vacío");
                if (this.errorMostrarMsjProducto.length) this.errorProducto = 1;

                return this.errorProducto;
            },
            mostrarDetalle(){
                let me=this;
                me.listado=0;
                me.id_producto=0;
                me.cantidad='';
                me.nombre_producto='';
           
                me.precio_venta='';
                me.total=0.0;
                me.arrayDetalle=[];
            },
            ocultarDetalle(){
                this.listado=1;
            },
           
            
          
        },
        mounted() {
            this.listarproduc(1,this.buscar,this.criterio);
            this.listarproducto2(1,this.buscar,this.criterio);
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
