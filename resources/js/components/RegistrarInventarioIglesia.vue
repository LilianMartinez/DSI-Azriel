<template>
   <main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <label class="titulo-encabezados">Registrar Inventario</label>
                    </div>
                    <div class="card-body">
                                 <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Categoria:<b class="alerta">*</b></label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idcategoriainv"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="categoria in arraycategoria" :key="categoria.id" v-bind:value="categoria.id">{{categoria.nombre_categoriainv}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Producto:<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="nombre_producto" class="form-control" placeholder="Nombre Producto">
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Marca:</label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="marca" class="form-control" placeholder="Marca del producto">
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Descripción:</label>
                                    <div class="col-md-5">
                                        <textarea rows="8" tabindexgt="-1" cols="45" v-model="descripcion" placeholder="color, forma, textura, etc."></textarea>
                                    </div>
                            </div>
                             <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Cantidad<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="cantidad" class="form-control" placeholder="Cantidad del producto adquirido">
                                    </div>
                            </div>
                              <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Fecha adquirido:</label>
                                <div class="col-md-4">
                                    <input type="date" class="form-control datepicker" name="date" v-model="fecha_adquirido">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Costo de la compra:</label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="costocompra" class="form-control" placeholder="Cantidad de la compra total">
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Zona:<b class="alerta">*</b></label> 
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idzona" @click="iglesias(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Iglesia:<b class="alerta">*</b></label> 
                                    <div class="col-md-5">
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
                        <div>
                            <button type="button" class="btn btn-primary" @click="registrarProductoInv()">Guardar</button>
                        </div>
                       
                    </div>
                </div>
                <!-- tabla Listado -->
            </div>
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
            
            
                nombre_producto:'',
                marca:'',
                descripcion:'',
                fecha_adquirido:'',
                cantidad:'',
                costocompra:'',
                
                
                arrayzona:[],
                arrayiglesia:[],
                arrayiglesiaID:[],
                arraycategoria:[],

                modal : 0,
                modal2: 0,
                tituloModal : '',
                tipoAccion:0,
                criterio:'nombre_iglesia', 
                buscar: '',
                errorDatos:0,
                errorMostrarMsj:[],
                
            }
        },
        methods:{

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

            validarvalores(){
                this.errorDatos=0;
                this.errorMostrarMsj=[];
               var Max_Length = 99;
               var Min_Length = 3;
               //Producto
               var lengthmaxN = this.nombre_producto.length;
               var lengthminN = this.nombre_producto.length;
                //Descripcion
               var lengthmaxD = this.descripcion.length;
               var lengthminD = this.descripcion.length;
               //Marca
               var Max_LengthM = 99;
               var Min_LengthM = 1;
               var lengthmaxM = this.descripcion.length;
               var lengthminM = this.descripcion.length;

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
                    if (lengthmaxD > Max_Length)this.errorMostrarMsj.push("La descripción debe tener menos de 99 letras");
                    if (lengthminD < Min_Length)this.errorMostrarMsj.push("La descripción debe tener más de 3 letras");
                }
                
                 if(this.marca !=''){
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
                  'costocompra': this.costocompra.toUpperCase(),                  
                  'fecha_adquirido':this.fecha_adquirido,
                  'idcategoriainv': this.idcategoriainv,
                  'idiglesia':this.idiglesia,
              }) .then(function (response) {
                    me.mensajeExito();    
                    me.cerrarModal();
                }) .catch(function (error) {
                 
                });

            },
            mensajeExito(){
                swal({
                title: 'El inventario se guardo exitosamente',
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
            cerrarModal(){
                this.modal=0;
                this.modal2=0;
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
            
            }
        },
        mounted() {
            this.llenadolistazona('','');
            this.categorias();
          //  this.llenadolistaiglesia('','');
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
    
</style>