<template>
    <main class="main">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div>
                    <label class="titulo-encabezados">Canastas</label> 
                    </div>
                    <div>
                    <button type="button" @click="mostrarDetalle()" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nueva
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
                                      <option value="nombre_canasta">Nombre</option>
                                      <option value="precio_venta">Precio</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarCanasta(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarCanasta(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Nombre</th>
                                        <th>Existencias</th>
                                        <th>Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="canasta in arrayCanasta" :key="canasta.id">
                                        <td>
                                            <button type="button" @click="abrirModal('canasta','ver',canasta)" class="btn btn-success btn-sm">
                                            <i class="icon-eye"></i>
                                            </button> &nbsp;
                                        </td>
                                        <td v-text="canasta.nombre_canasta"></td>
                                        <td v-text="canasta.cantidad"></td>
                                        <td v-text="canasta.precio_venta"></td>
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
                                    <label for="">Nombre(*)</label>
                                    <input type="text" class="form-control" v-model="nombre_canasta">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="">Precio de venta(*)</label>
                                <input type="text" class="form-control" v-model="precio_venta">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Cantidad(*)</label>
                                    <input type="text" class="form-control" v-model="cantidad_canasta">
                                </div>
                            </div>
                        </div>
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
                                <input type="text" class="form-control" v-model="cantidad" >
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button @click="agregarDetalle()" class="btn btn-success form-control btnagregar"><i class="icon-plus"></i></button>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div v-show="errorCanasta" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjCanasta" :key="error" v-text="error">
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
                                            <!--<input v-model="detalle.cantidad" type="number" value="3" class="form-control">-->
                                            </td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="2" align="right"><strong>Total:</strong></td>
                                            <td>$ {{total}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="4">
                                                No hay productos agregados a la canasta
                                            </td>
                                        </tr>
                                    </tbody>                                       
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                <button type="button" class="btn btn-primary" @click="registrarCanasta()">Registrar Canasta</button>
                            </div>
                        </div>
                    </div>
                    </template>
                    <!-- Fin Detalle-->
                </div>
                <!-- Fin ejemplo de tabla Listado -->
                </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <label><strong>{{precioventa}}</strong></label>
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="canasta in arrayIntermedio" :key="canasta.id">
                                        <td v-text="canasta.nombre_producto"></td>
                                        <td v-text="canasta.cantidad"></td>
                                    </tr>                                
                                </tbody>                                           
                                </table>
                            </div>
                        </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click="venderCanasta()">Vender Canasta</button>
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
    import vSelect from 'vue-select';
    import 'vue-select/dist/vue-select.css';
    export default {
        data (){
            return {

                producto : '',
                id_productoR:'',
                id_producto:'',
                nombre_canasta:'',
                precio_venta:'',
                precioventa:'',
                cantidad_canasta:'',
                existenciasC:'',
                precio_compra:0.0,
                cantidad:0.0,
                cantidadT:'',
                fecha:'',
                tipo:'',
                total:0.0,
                totalP:0.0,
                arrayCanasta : [],
                arrayDetalle : [],
                arrayProducto : [],
                arrayIntermedio:[],
                cantidadQ:[],
                po:'',
                la:0,
                modal : 0,
                listado:1,
                tituloModal : '',
                tipoAccion : 0,
                errorCanasta : 0,
                errorMostrarMsjCanasta : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre_canasta',
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
            listarCanasta (page,buscar,criterio){
                let me=this;
                var url= '/canastas?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCanasta = respuesta.canastas.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarDetalles (){

                let me=this;
                var v=me.po;
                var url= '/canastas/detalle?buscar='+ v;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayIntermedio = respuesta.producto;
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
                me.listarCanasta(page,buscar,criterio);
            },
            selectProducto(search,loading){
                let me=this;
                loading(true);

                var url='/producto/canasta?filtro='+search;
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
            buscarF(){
                let me=this;
              
                var filtro=me.id_producto;
                var url='/producto/existencia?filtro='+filtro;
                axios.get(url).then(function (response) {
                    var respuesta= response.data; 
                    me.precio_compra=respuesta.compra;
                    me.existenciasC=respuesta.cantidad;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            validar(){
                let me=this;
                var resultado =0.0;
                var inter;
                var inter2;
                var va;
            
                for(var i=0;i<me.existenciasC.length;i++){
                    resultado=resultado+ parseInt(me.existenciasC[i].cantidad);
                }
                inter=parseInt(me.cantidad);
                inter2=parseInt(me.cantidad_canasta);
                me.cantidadT=inter*inter2;
               va=me.cantidadT;
                if(me.cantidadT<=resultado){
                    
                     
                        //Guarda sin penas
                        for(var i=0;i<this.existenciasC.length;i++){
                            
                            if(me.cantidadT!=0){
                                var c=parseInt(me.existenciasC[i].cantidad);
                                var p;
                                var t;
                                var x;
                                if(me.cantidadT>c){
                                    t=parseFloat(me.precio_compra[i].unitario);
                                    me.totalP=(me.totalP+ t*c);
                                    me.cantidadQ.push({
                                        preciov: t*c,
                                        id_producto: me.id_producto,
                                        descontar: c,
                                        id_existencia: me.existenciasC[i].id,
                                        queda: 0
                                    });
                                    p=me.cantidadT-c;
                                    me.cantidadT=p;
                                }else{
                                    t=parseFloat(me.precio_compra[i].unitario);
                                    x=parseInt(me.cantidadT);
                                    me.totalP=(me.totalP+ t*x);
                                    me.cantidadQ.push({
                                        preciov: t*x,
                                        id_producto: me.id_producto,
                                        descontar: me.cantidadT,
                                        id_existencia: me.existenciasC[i].id,
                                        queda: c-me.cantidadT
                                    });
                                    me.cantidadT=0;
                                    break;
                                }
                        }
                }
                me.la=1;
                
                me.total=me.total+(me.totalP/va);

                }else{
                    me.la=0;
                      me.id_producto=0;
                            swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'No posee suficientes productos!',
                            })
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
                        me.total=me.total-me.cantidadQ[i].preciov;
                        me.cantidadQ.splice(i, 1);
                    }
                }
                me.arrayDetalle.splice(index, 1);
            },
            agregarDetalle(){
                let me=this;
                me.buscarF();
                me.validar();
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
                    else{if(me.la==1){
                        me.arrayDetalle.push({
                            id_producto: me.id_producto,
                            producto: me.producto,
                            cantidad:me.cantidad,
                        });
                        }
                        
                        me.id_producto=0;
                        me.producto='';
                        
    
                    }
                    
                }

            },
            
            registrarCanasta(){
               /* if (this.validarCompra()){
                    return;
                }*/
                
                let me = this;

                axios.put('/canastas/registrar',{
                    'nombreC':this.nombre_canasta,
                    'cantidadC':this.cantidad_canasta,
                    'precioC':this.precio_venta,
                    'totalC':this.total,
                    'data': this.arrayDetalle,
                    'existencias': this.cantidadQ
                }).then(function (response) {
                    me.listado=1;
                    me.listarCanasta(1,'','nombre_canasta');
                    me.id_producto=0;
                    me.cantidad='';
                    me.precio_compra='';
                    me.nombre_canasta='';
                    me.cantidad_canasta='';
                    me.precio_venta='';
                    me.total=0.0;
                    me.arrayDetalle=[];
                }).catch(function (error) {
                    console.log(error);
                });
            },
            venderCanasta(){
               /* if (this.validarCompra()){
                    return;
                }*/
                
                let me = this;

                axios.put('/canastas/vender',{
                    'id':me.po
                }).then(function (response) {
                    me.listado=1;
                    me.modal=0;
                    me.tituloModal='';
                    me.listarCanasta(1,'','nombre_canasta');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarCompra(){
                this.errorCanasta=0;
                this.errorMostrarMsjCanasta =[];

                if (this.id_producto==0) this.errorMostrarMsjCanasta.push("Debe seleccionar un producto.");
                if (!this.cantidad) this.errorMostrarMsjCanasta.push("La cantidad no puede estar vacia.");
                if (!this.precio_compra) this.errorMostrarMsjCanasta.push("El precio del producto comprado no puede estar vacio.");
                if (this.arrayDetalle.length<=0) this.errorMostrarMsjCanasta.push("Ingrese productos");
                if(!this.tipo) this.errorMostrarMsjCanasta.push("El tipo no puede estar vacío");
                if (this.errorMostrarMsjCanasta.length) this.errorCanasta = 1;

                return this.errorCanasta;
            },
            mostrarDetalle(){
                let me=this;
                me.listado=0;
                me.id_producto=0;
                me.cantidad='';
                me.precio_compra='';
                me.nombre_canasta='';
                me.cantidad_canasta='';
                me.precio_venta='';
                me.total=0.0;
                me.arrayDetalle=[];
            },
            ocultarDetalle(){
                this.listado=1;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.errorPersona=0;
            },
            abrirModal(modelo, accion, data = []){
                
                switch(modelo){
                    case "canasta":
                    {
                        switch(accion){
                            
                            case 'ver':
                            {
                                //console.log(data);
                                this.po=data['id'];
                                this.listarDetalles();
                                this.modal=1;
                                this.precioventa=data['precio_venta'];
                                this.tituloModal='Descripcion Canasta';
                                this.tipoAccion=2;
                                break;
                            }
                        }
                    }
                }
            },
          
        },
        mounted() {
            this.listarCanasta(1,this.buscar,this.criterio);
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
