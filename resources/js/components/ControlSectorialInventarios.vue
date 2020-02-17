<template>
   <main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <label class="titulo-encabezados">Inventario Iglesias</label>
                    </div>
                    <br>
                    <div class="card-body">
                    <div id="input-groupG">
                          
                                    <label id="zonaiglesia" for="text-input">ZONA:</label> 
                                    <div class="col-md-3">
                                        <select class="form-control col-md-12" v-model="idzona" @click="iglesias(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                                    <label id="zonaiglesia" for="text-input">IGLESIA:</label> 
                                    <div class="col-md-3">
                                        <select class="form-control col-md-12" v-model="idiglesia" @click="inventarios(idiglesia)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesia in arrayiglesia" :key="iglesia.id" v-bind:value="iglesia.id" >{{iglesia.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                    </div>
                    <br>
                    <br>
                    <div class="input-group margen">
                            <button type="button" @click="abrirModal('categorias','registrar')" class="btn btn-primary">
                                    <i class="icon-plus"></i>&nbsp;Nuevo
                            </button>
                    </div>
                     <div class="input-group margen">
                    </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre_categoriainv">Categoria</option>
                                      <option value="nombre_producto">Producto</option>
                                      <option value="descripcion">Descripción</option> 
                                      <option value="marca">Marca</option>
                                      <option value="cantidad">Cantidad</option>
                                      <option value="fecha_adquirido">Fecha Adquirido</option>
                                      <option value="costocompra">Costo Compra</option>   
                                      <option value="enuso">En uso</option>  
                                      <option value="guardadas">Guardadas</option> 
                                      <option value="desuso">Arruinadas</option> 
                                    </select>
                                    <input type="text"  v-model="buscar" @keyup.enter="listarproductosinventarios(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarproductosinventarios(1,buscar,criterio) " class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Zona</th>
                                    <th>Iglesia</th>
                                    <th>Categoria</th>
                                    <th>Producto</th>
                                    <th>Descripción</th>
                                    <th>Marca</th>
                                    <th>Cantidad</th>
                                    <th>Fecha adquirido</th>
                                    <th>Costo de compra</th>
                                    <th>En Uso</th>
                                    <th>Guardadas</th>
                                    <th>Arruinadas</th>
                                    <th>Opcion</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="inventarios in arrayinventario" :key="inventarios.id">                              
                                    <td v-text="inventarios.nombre_zona"></td>
                                    <td v-text="inventarios.nombre_iglesia"></td>
                                    <td v-text="inventarios.nombre_categoriainv"></td>
                                    <td v-text="inventarios.nombre_producto"></td>
                                    <td v-text="inventarios.descripcion"></td>
                                    <td v-text="inventarios.marca"></td>
                                    <td v-text="inventarios.cantidad"></td>
                                    <td v-text="inventarios.fecha_adquirido"></td>
                                    <td v-text="inventarios.costocompra"></td>
                                    <td v-text="inventarios.enuso"></td>
                                    <td v-text="inventarios.guardadas"></td>
                                    <td v-text="inventarios.desuso"></td>
                                        <button type="button" @click="abrirModal('categorias','actualizar',inventarios)" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <!-- <button  type="button" class="btn btn-danger btn-sm"  @click="abrirModal('categorias','eliminar',inventarios)" >
                                          <i class="icon-trash  enter"></i>
                                        </button>-->
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
                <!-- tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade"  tabindex="-1" :class="{'mostrar': modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none; overflow-y:auto;" aria-hidden="true">
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
                                    <label class="col-md-2 form-control-label" for="text-input">Categoria:<b class="alerta">*</b></label> 
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="idcategoriainv"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="categoria in arraycategoria" :key="categoria.id" v-bind:value="categoria.id">{{categoria.nombre_categoriainv}}</option>
                                        </select >
                                    </div>
                            
                                    <label class="col-md-2 form-control-label" for="text-input">Producto:<b class="alerta">*</b></label>
                                    <div class="col-md-4">
                                        <input type="text" tabindexgt="0" v-model="nombre_producto" class="form-control" placeholder="Nombre Producto">
                                    </div>
                            </div>
                            <div class="form-group row">
                                     <label class="col-md-2 form-control-label" for="text-input">Descripción:</label>
                                    <div class="col-md-4">
                                        <textarea rows="4" tabindexgt="-1" cols="75" v-model="descripcion" placeholder="color, forma, textura, etc."></textarea>
                                    </div>
                                    
                            </div>
                             <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Marca:</label>
                                    <div class="col-md-4">
                                        <input type="text" tabindexgt="0" v-model="marca" class="form-control" placeholder="Marca del producto">
                                    </div>

                                    <label class="col-md-2 form-control-label" for="text-input">Cantidad<b class="alerta">*</b></label>
                                    <div class="col-md-4">
                                        <input type="text" tabindexgt="0" v-model="cantidad" class="form-control" placeholder="Cantidad del producto adquirido">
                                    </div>
                            
                            </div>
                            <div class="form-group row">
                                     <label class="col-md-2 form-control-label" for="text-input">Fecha adquirido:</label>
                                        <div class="col-md-4">
                                            <input type="date" class="form-control datepicker" name="date" v-model="fecha_adquirido">
                                        </div>
                                    
                                    <label class="col-md-2 form-control-label" for="text-input">Costo de la compra:</label>
                                    <div class="col-md-4">
                                        <input type="text" tabindexgt="0" v-model="costocompra" class="form-control" placeholder="Costo total de la compra total">
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Zona:<b class="alerta">*</b></label> 
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="idzona" @click="iglesias(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                            
                                    <label class="col-md-2 form-control-label" for="text-input">Iglesia:<b class="alerta">*</b></label> 
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="idiglesia"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesia in arrayiglesia" :key="iglesia.id" v-bind:value="iglesia.id" >{{iglesia.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                            </div>
                                <div v-show="errorDatos" class="form-group row div-error">
                                <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsj" :key="error" v-text="error">
                                </div>
                                </div>
                                </div>              
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarProductoInv()">Guardar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal agregar-->

            <!-- Inicio del modal actualizar -->
            <div class="modal fade" id="modalActuazliar" tabindex="-1" :class="{'mostrar': modal3}" role="dialog" aria-labelledby="myModalLabel" style="display: none; overflow-y:auto;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                       <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Categoria</label>
                                    <label class="col-md-3 form-control-label" for="text-input">{{nombre_categoriainv}}</label>
                        </div>
                        <div class="form-group row">
                                    <label class="col-md-3 form-control-label"  for="text-input">Producto</label>
                                   <label class="col-md-3 form-control-label" for="text-input">{{nombre_producto}}</label>
                        </div>
                        <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Marca</label>
                                    <label class="col-md-3 form-control-label" for="text-input">{{marca}}</label>
                        </div>
                        <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Descripción</label>
                                    <label class="col-md-3 form-control-label" for="text-input">{{descripcion}}</label>
                        </div>
                        <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Cantidad</label>
                                    <label class="col-md-3 form-control-label" for="text-input">{{cantidad}}</label>
                        </div>
                        <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha adquirido</label>
                                    <label class="col-md-3 form-control-label" for="text-input">{{fecha_adquirido}}</label>
                        </div>
                       <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Costo de la compra:</label>
                                    <label class="col-md-3 form-control-label" for="text-input">{{costocompra}}</label>
                            </div>
                       <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Zona:</label> 
                                    <label class="col-md-3 form-control-label" for="text-input">{{nombre_zona}}</label>
                            </div>
                        <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Iglesia</label>
                                    <label class="col-md-3 form-control-label" for="text-input">{{nombre_iglesia}}</label>
                        </div>
                         <div id="input-groupG">
                         <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Guardadas</label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="guardadas" class="form-control">
                                    </div>
                        </div>
                        <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">En uso</label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="enuso" class="form-control">
                                    </div>
                        </div>
                        <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Arruinadas</label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="desuso" class="form-control">
                                    </div>
                        </div>
                        
                        </div>

                         <div v-show="errorDatos" class="form-group row div-error">
                                <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsj" :key="error" v-text="error">
                                </div>
                                </div>
                                </div>  
                                
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizarProductoInv()">Actualizar</button>
                        </div>
                    </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- Fin del modal actualizar -->
               <!-- Inicio del modal Eliminar -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" :class="{'mostrar': modal2}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">¿Esta seguro de eliminar esta categoria?</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                       <div class="form-group row">
                                   <b class="alerta"> <label class="col-md-1 form-control-label" for="text-input">Nombre</label></b>
                                        <b class="alerta"><label class="col-md-3 form-control-label" for="text-input">{{nombre_categoria}}</label></b>   
                                </div>
                                 <div class="form-group row">
                                    <b class="alerta"><label class="col-md-1 form-control-label" for="text-input">Descripción</label></b>
                                    <b class="alerta"> <label class="col-md-3 form-control-label" for="text-input"></label><label>{{descripcion_categoria}}</label></b>   
                                </div>
                                
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-danger" @click="eliminar()">Eliminar</button>
                        </div>
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
                idzona:'',
                idiglesia:'',
                idcategoriainv:'',
                zona:'',
                iglesia:'',
                categoria:'',
                nombre_zona:'',
                nombre_iglesia:'',
                nombre_categoriainv:'',

                arrayzona:[],
                arrayiglesia:[],
                arrayiglesiaID:[],
                arraycategoria:[],
                arrayinventario:[],

                productoInventario_id:'',
                nombre_producto:'',
                marca:'',
                descripcion:'',
                fecha_adquirido:'',
                cantidad:'',
                costocompra:'',
                enuso:'',
                guardadas:'',
                desuso:'',

                // -----------------------------
                categoriasResumenes_id:0,
                nombre_categoria:'',
                descripcion_categoria:'',
                arraycategoriasresumenes:[],
                //------------------------------

                modal : 0,
                modal2: 0,
                modal3:0,
                tituloModal : '',
                tipoAccion:0,
                criterio:'nombre_producto', 
                buscar: '',
                errorDatos:0,
                errorMostrarMsj:[],

                pagination:{
                    'total' :0,
                    'current_page' :0,
                    'per_page' :0,
                    'last_page' :0,
                    'from' :0,
                    'to' :0,
                },
                offset: 3,
                
            }
        },computed:{
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
            cambiarPagina(page,buscar,criterio){
            let me = this;
            //Actualiza la pagina actualizar
            me.pagination.current_page = page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarproductosinventarios(page,buscar,criterio)
        },
             llenadolistazona(){
            let me=this;
            var url='/zona/buscarZona'; 
            axios.get(url) .then(function (response) {
                me.arrayzona=response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },  

            iglesias(idzona){

                let me=this;
                var arrayiglesiaID=[];
             axios.post('/feligreses/buscarIglesia',{
               'id':this.idzona}) 
              .then(function (response) { 
                arrayiglesiaID = response.data;     
                me.llenar(arrayiglesiaID);  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
           llenar(d=[]){
                this.arrayiglesia=d;
            },

            inventarios(idiglesia){

                let me=this;
                var arrayiglesiaInventario=[];
             axios.post('/sectorial/buscarIglesiaInventarios',{
               'id':this.idiglesia,
               }) 
              .then(function (response) { 
                arrayiglesiaInventario=response.data;
                     
                me.llenar2(arrayiglesiaInventario); 
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
           llenar2(d=[]){
                this.arrayinventario=d;
            },

            categorias(){
                 let me=this;
                var url='/categoriainventario/buscarCateInve';
                axios.get(url) .then(function (response) {
                    // handle success
                    me.arraycategoria = response.data;   
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

            listarproductosinventarios(page,buscar,criterio){
                let me=this;
                var lengthbuscar = this.buscar.length;
                 if(lengthbuscar >0)
                 {
                     var buscar2= this.buscar.toUpperCase();
                 }else
                 buscar2=this.buscar;
                var url='/productoinv?page='+ page + '&buscar=' + buscar2 + '&criterio=' + criterio;
                axios.get(url) .then(function (response) {
                     response.data.proinventarioIgle.data.forEach(function(element) {
                        if(element.fecha_adquirido != null){
                        var texto = element.fecha_adquirido;
                        element.fecha_adquirido= texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
                        }
                    });
                    var respuesta= response.data;
                    me.arrayinventario=respuesta.proinventarioIgle.data;
                    me.pagination= respuesta.pagination;
                    me.cerrarmodal2();
                })
                .catch(function (error) {
                    console.log(error);
                });
            
            },
            cerrarmodal2(){
                this.arrayzona=[];
                this.arrayiglesia=[];
                this.idzona=0;
                this.idiglesia=0;
                this.llenadolistazona();
                this.iglesias();
            },
            
            validarvalores(){
                this.errorDatos=0;
                this.errorMostrarMsj=[];
               var Max_Length = 99;
               var Min_Length = 3;
               //Producto
               var lengthmaxN = this.nombre_producto.length;
               var lengthminN = this.nombre_producto.length;

               //fecha
                var fecha = new Date();
                var fecha2 = new Date();
                var actualYear = fecha.getFullYear();
                var actualMes = fecha.getMonth();

                // Costo compra
                var RE = /^\d*(\.\d{1})?\d{0,1}$/;

                //cantidad
                var can = /^\d*(\d{1})?\d{0,1}$/;

                if(this.idcategoriainv=='') this.errorMostrarMsj.push("Seleccione una categoria");
               
                if(this.nombre_producto ==''){
                    this.errorMostrarMsj.push("El nombre del producto no puede estar vacío");
                } else {
                if (lengthmaxN > Max_Length)this.errorMostrarMsj.push("El nombre del producto debe tener menos de 99 letras");
                if (lengthminN < Min_Length)this.errorMostrarMsj.push("El nombre del producto debe tener más de 3 letras");
                }

                if(this.costocompra !=''){
                    if (!RE.test(this.costocompra))  this.errorMostrarMsj.push("El costo de la compra solo pueden ser decimales");
                }
                
                if(this.cantidad ==''){
                    this.errorMostrarMsj.push("La cantidad es obligatoria");
                }else{
                    if (!can.test(this.cantidad))  this.errorMostrarMsj.push("La cantidad solo puede ser un número entero");
                }
                
                if(this.descripcion !=''){
                        var lengthmaxD = this.descripcion.length;
                        var lengthminD = this.descripcion.length;
                        if (lengthmaxD > Max_Length)this.errorMostrarMsj.push("La descripción debe tener menos de 99 letras");
                        if (lengthminD < Min_Length)this.errorMostrarMsj.push("La descripción debe tener más de 3 letras");
                    
                }
                
                 if(this.marca !=''){
                    var Max_LengthM = 99;
                    var Min_LengthM = 1;
                    var lengthmaxM = this.marca.length;
                    var lengthminM = this.marca.length;
                    if (lengthmaxM > Max_LengthM)this.errorMostrarMsj.push("La marca del producto debe tener menos de 99 letras");
                    if (lengthminM < Min_LengthM)this.errorMostrarMsj.push("La marca del producto debe tener más de 1 letras");
                }
                if(this.fecha_adquirido != '')
                    {
                            var values = this.fecha_adquirido.split("-");
                            var anio = values[0];
                            if(anio < 1989)this.errorMostrarMsj.push("El año debe de ser mayor a 1989");
                            if((actualYear)<anio)this.errorMostrarMsj.push("El año debe ser menor o igual al " + (actualYear));
                        
                    };
                if(this.idzona=='') this.errorMostrarMsj.push("Seleccione una zona");
                if(this.idiglesia=='') this.errorMostrarMsj.push("Seleccione una iglesia");
                if(this.errorMostrarMsj.length) this.errorDatos=1;
            

                return this.errorDatos;
            },

             validarvalores2(){
                this.errorDatos=0;
                this.errorMostrarMsj=[];
               var Max_Length = 99;
               var Min_Length = 3;
               
                //cantidad
                var can = /^\d*(\d{1})?\d{0,1}$/;

                if(this.enuso == '' && this.guardadas=='' && this.desuso==''){
                    this.errorMostrarMsj.push("No puede dejar todos los campos vacios");
                }


                if (!can.test(this.guardadas))  this.errorMostrarMsj.push("Solo puede ser un número entero guardadas");
                
                if(this.enuso !=0 || this.desuso!=0){
                    
                    if (!can.test(this.enuso))  this.errorMostrarMsj.push("Solo puede ser un número entero enuso");
                    if (!can.test(this.desuso))  this.errorMostrarMsj.push("Solo puede ser un número entero desuso");
                    var u= parseInt(this.enuso,10);
                    var d=parseInt(this.desuso, 10);
                    var g=parseInt(this.guardadas, 10);
                    
                    var total  = (u+d+g); 
                    if( total != this.cantidad)
                    {
                        this.errorMostrarMsj.push("La sumatoria debe ser igual a la cantidad");
                    }
                }
                
                if(this.errorMostrarMsj.length) this.errorDatos=1;
            

                return this.errorDatos;
            },
             
             registrarProductoInv(){
               if(this.validarvalores()){
                  return;   
                 }
    
             let me=this;
              axios.put('/productoinv/registrar',{
                  'nombre_producto': this.nombre_producto.toUpperCase(),
                  'descripcion': this.descripcion.toUpperCase(),
                  'cantidad': this.cantidad,
                  'marca': this.marca.toUpperCase(),
                  'costocompra': this.costocompra,                  
                  'fecha_adquirido':this.fecha_adquirido,
                  'idcategoriainv': this.idcategoriainv,
                  'idiglesia':this.idiglesia,
                  'idzona':this.idzona,
                  'nombre_zona':this.nombre_zona,
              }) .then(function (response) {
                    me.mensajeExito();    
                    me.cerrarModal();
                    me.listarproductosinventarios(1,buscar,criterio)
                }) .catch(function (error) {
                 console.log(error);
                });

            },
            mensajeExito(){
                swal({
                type: 'success',
                title: 'Los datos se guardaron con éxito',
                showConfirmButton: false,
                timer: 1500
            })
            },
            cerrarModal(){
                this.modal=0;
                this.modal2=0;
                this.modal3=0;
                this.tituloModal='';
                this.tipoAccion=0;
                this.nombre_producto='';
                this.descripcion='';
                this.cantidad='';
                this.costocompra='';                  
                this.fecha_adquirido='';
                this.idcategoriainv='';
                this.marca='';
                this.buscar='';
                this.idiglesia='';
                this.criterio='nombre_producto';
                this.idzona='';
                this.errorDatos=0;
                this.errorMostrarMsj=[];
            
            },

            actualizarProductoInv(){
                if(this.validarvalores2()){
                  return;   
                 }
               
                let me=this;
                var buscar='';
                var criterio='nombre_producto';
                axios.put('/productoinv/actualizar',{
                  'guardadas':this.guardadas,
                  'enuso':this.enuso,
                  'desuso':this.desuso,
                  'id':this.productoInventario_id,
                    }) .then(function (response) {
                    me.cerrarModal();
                    me.mensajeExito(); 
                    me.listarproductosinventarios(1,buscar,criterio)
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
             eliminar(){
                let me=this;
                var buscar='';
                var criterio='nombre_categoria';
                axios.put('/categoriaresumen/eliminarCR',{
                  'id':this.productoInventario_id,
                    }) .then(function (response) {
                    me.cerrarModal();
                    me.listarproductosinventarios(1,buscar,criterio)
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },

    
          abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "categorias":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Nuevo Inventario';
                                this.tipoAccion=1;
                                this.nombre_producto='';
                                this.marca='';
                                this.descripcion='';
                                this.fecha_adquirido='';
                                this.cantidad='';
                                this.costocompra='';
                                this.idiglesia='';
                                this.idcategoriainv='';
                                this.idzona='';
                                this.nombre_zona='';
                                this.nombre_categoriainv='';
                                break;

                            }
                             case 'actualizar':
                            {
                                 this.modal3=1;
                                this.tituloModal='Modificar Existencias';
                                this.tipoAccion=2;
                                this.nombre_producto=data['nombre_producto'];
                                this.marca=data['marca'];
                                this.descripcion=data['descripcion'];
                                this.fecha_adquirido=data['fecha_adquirido'];
                                this.cantidad=data['cantidad'];
                                this.costocompra=data['costocompra'];
                                this.idiglesia=data['idiglesia'];
                                this.idcategoriainv=data['idcategoriainv'];
                                this.idzona=data['idzona'];
                                this.nombre_categoriainv=data['nombre_categoriainv'];
                                this.nombre_zona=data['nombre_zona'];
                                this.idzona=data['idzona'];
                                this.nombre_iglesia=data['nombre_iglesia'];
                                this.productoInventario_id=data['id'];
                                this.guardadas=data['guardadas'];
                                this.enuso=data['enuso'];
                                this.desuso=data['desuso'];
                               break;
                            }
                             case 'eliminar':
                            {
                                this.modal2=1;
                                this.tituloModal='Eliminar Categoria';
                                this.productoInventario_id=data['id'];
                                this.nombre_categoria=data['nombre_categoria'];
                                this.descripcion_categoria=data['descripcion_categoria'];
                               break;
                            }
                        }
                    }
                }

            }
        },
        mounted() {
            this.llenadolistazona('','');
            this.listarproductosinventarios(1,this.buscar,this.criterio)
            this.categorias();
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
        clear:both;
        justify-content:center;
    }
    .text-error{
        color: red !important;
        font-weight:bold;
    }
  #input-groupG {
  position: relative;
  display: flex;
  width: 100%; }

  #zonaiglesia {
      font-size:  x-large;
      font-weight: bold; }
    
</style>