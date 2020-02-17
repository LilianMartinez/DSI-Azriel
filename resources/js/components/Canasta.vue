<template>
    <main class="main">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div>
                    <label class="titulo-encabezados">Canastas</label> 
                    </div>
                    <div>
                    <button type="button" @click="mostrarDetalle()" class="btn btn-primary">
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
                                            <td>$ {{total=Total}}</td>
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
                        <label><strong>Valor de canasta: ${{precioventa}}</strong></label>
                   
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
                id_producto:0,
                nombre_canasta:'',
                precio_venta:'',
                precioventa:'',
                cantidad_canasta:'',
                existenciasC:[],
                precio_compra:0.0,
                cantidad:0.0,
                cantidadT:'',
                canti:0,
                canti2:0,
                fecha:'',
                tipo:'',
                total:0.0,
                resultado:0.0,
                arrayCanasta : [],
                arrayDetalle : [],
                arrayProducto : [],
                arrayIntermedio:[],
                cantidadQ:[],
                po:'',
                la:0,
                modal : 0,
                listado:1,
                index:[],
                tituloModal : '',
                tipoAccion : 0,
                texto:0,
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
            Total: function(){
                var resultado =0.0;
                var resu;
                for(var i=0;i<this.cantidadQ.length;i++){
                    resultado=resultado+parseFloat(this.cantidadQ[i].preciov);
                }
                resu=(resultado/this.cantidad_canasta).toFixed(2);
                return resu;

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
                    me.listarDetalles2(v);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarDetalles2 (canasta){

                let me=this;
                var v=canasta;
                var url= '/canastas/canasta?buscar='+ v;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.canti= respuesta.canasta;
                    me.cambio();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambio(){
                this.canti2=0;
                for(var i=0;i<this.canti.length;i++){
                 this.canti2= parseInt(this.canti[i].cantidad);
                }
                for(var i=0;i<this.arrayIntermedio.length;i++){
                    this.texto = parseInt(this.arrayIntermedio[i].cantidad);
                    this.arrayIntermedio[i].cantidad= this.texto/this.canti2;
                }

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
            buscarF(){
                let me=this;
              
                var filtro=me.id_producto;
                var url='/producto/existencia?filtro='+filtro;
                axios.get(url).then(function (response) {
                    var respuesta= response.data; 
                    me.existenciasC=respuesta.lista;
                    me.validar();
                })
                .catch(function (error) {
                });
            },

            validar(){
                let me = this;
                var inter;
                var inter2;
                var va;
                me.resultado=0;
                for(var i=0;i<this.existenciasC.length;i++){
                    me.resultado= me.resultado+ parseInt(me.existenciasC[i].cantidad)
                }
               
                me.cantidadT=me.cantidad*me.cantidad_canasta;
                va=me.cantidadT;
                if(me.cantidadT<=me.resultado){
                    //Guarda
                    for(var i=0;i<this.existenciasC.length;i++){   
                        var c=parseInt(me.existenciasC[i].cantidad);
                        var p;
                        var t;
                        var x;
                        if(me.cantidadT>c){
                            t=parseFloat(me.existenciasC[i].unitario);
                            me.cantidadQ.push({
                                descontar: c,
                                id_existencia: me.existenciasC[i].id,
                                id_producto: me.id_producto,
                                preciov: t*c,
                                queda: 0
                                });
                            p=me.cantidadT-c;
                            me.cantidadT=p;
                        }
                        else{
                            t=parseFloat(me.existenciasC[i].unitario);
                            me.cantidadQ.push({
                                descontar: me.cantidadT,
                                id_existencia: me.existenciasC[i].id,
                                id_producto: me.id_producto,
                                preciov: t*me.cantidadT,
                                queda: c-me.cantidadT
                                });
                            me.cantidadT=0;
                            break;
                        }
                    }
                
                me.la=1;
                }
                else{
                    me.la=0;
                    me.id_producto=0;
                        swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'No posee suficientes productos!',
                        })
                }
                me.agregarDetalle2();

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
                me.index=[];
                 me.po=me.arrayDetalle[index].id_producto;
                for(var i=0;i<this.cantidadQ.length;i++){
                    if(this.cantidadQ[i].id_producto==me.po){
                       me.cantidadQ.splice(i, 1);
                       i--;
                    }
                }
                me.arrayDetalle.splice(index, 1);
            },
            agregarDetalle(){
                let me=this;
                if (this.validarCampos()){
                        return;}
                me.buscarF();

            },
            agregarDetalle2(){
                let me=this;
                if(me.encuentra(me.id_producto)){
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'Ese artículo ya se encuentra agregado!',
                        })
                }
                else{
                    if(me.la==1){
                        me.arrayDetalle.push({
                            id_producto: me.id_producto,
                            producto: me.producto,
                            cantidad:me.cantidad,
                        });
                    }
                }
                me.limpiar();

            },
            limpiar(){
                this.id_producto=0;
                this.producto='';
                this.cantidad='';
                this.existenciasC=[];
                this.resultado=0;
                this.id_productoR=[];
            },
            registrarCanasta(){
               
                
                let me = this;
                

                axios.put('/canastas/registrar',{
                    'nombreC':this.nombre_canasta,
                    'cantidadC':this.cantidad_canasta,
                    'precioC':this.precio_venta,
                    'totalC':this.total,
                    'data': this.arrayDetalle,
                    'existencias': this.cantidadQ
                }).then(function (response) {
                    me.mensajeExito();
                    me.id_producto=0;
                    me.cantidad='';
                    me.precio_compra='';
                    me.nombre_canasta='';
                    me.cantidad_canasta='';
                    me.precio_venta='';
                    me.total=0.0;
                    me.arrayDetalle=[];
                    me.po='';
                    me.la='';
                    me.cantidadQ=[];
                }).catch(function (error) {
                    console.log(error);
                });
            },
            mensajeExito(){
                swal({
                title: '¡Canasta registrada con exito!',
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
            venderCanasta(){
                
                let me = this;

                axios.put('/canastas/vender',{
                    'id':me.po
                }).then(function (response) {
                    me.listado=1;
                    me.modal=0;
                    me.tituloModal='';
                    me.mensajeExitoventa();
                    me.listarCanasta(1,'','nombre_canasta');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            mensajeExitoventa(){
                swal({
                title: '¡Venta realizada con exito!',
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
            validarCampos(){
                this.errorCanasta=0;
                this.errorMostrarMsjCanasta =[];
                var RE = /^([0-9])*$/;
                var RE2 = /^\d*(\.\d{1})?\d{0,1}$/;
                if (!this.nombre_canasta) this.errorMostrarMsjCanasta.push("La canasta debe de tener un nombre");
                if (!this.precio_venta) this.errorMostrarMsjCanasta.push("La canasta debe poseer un precio de venta");
                if (!RE2.test(this.precio_venta)) this.errorMostrarMsjCanasta.push("El precio de venta solo pueden ser decimales");
                if (this.cantidad_canasta<1) this.errorMostrarMsjCanasta.push("El total de canastas a crear no debe estar vacio");
                if (!RE.test(this.cantidad_canasta)) this.errorMostrarMsjCanasta.push("El total de canastas a crear debe ser un numero");
                if (this.id_producto==0) this.errorMostrarMsjCanasta.push("Debe seleccionar un producto");
                if (this.cantidad<1) this.errorMostrarMsjCanasta.push("La cantidad de productos no debe estar vacio");
                if (!RE.test(this.cantidad)) this.errorMostrarMsjCanasta.push("La cantidad de productos debe ser un numero");
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
                me.po='';
                me.la='';
                me.cantidadQ=[];
            },
            ocultarDetalle(){
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
                me.po='';
                me.la='';
                me.cantidadQ=[];
                this.listado=1;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.errorPersona=0;
                this.precioventa=0;
                this.arrayIntermedio=[];
                this.listarCanasta(1,this.buscar,this.criterio);
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
