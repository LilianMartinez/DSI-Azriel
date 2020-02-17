<template>
   <main class="main">
            <!-- Breadcrumb -->
            <div class="container-fluid">
                <!-- Tabla Primera comunion -->
                <div class="card">
                    <div class="card-header"><label class="titulo-encabezados">Historial de confirmaciones</label>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" v-model="nombre"  class="form-control" placeholder="Nombre">
                                    <input type="text" v-model="apellido" @keyup.enter="listarPersona(1,nombre,apellido)" class="form-control" placeholder="Apellido">
                                    <button type="submit" @click="listarPersona(1,buscar,apellido) " class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombres</th>
                                    <th>Nombre padre</th>
                                    <th>Nombre madre</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="realizante in arrayrealizante" :key="realizante.id">
                                    <td>{{realizante.hnom}} {{realizante.hapellido}}</td>
                                    <td>{{realizante.pnom}} {{realizante.papellido}}</td>
                                    <td>{{realizante.mnom}} {{realizante.mapellido}}</td>
                                    &nbsp;&nbsp;&nbsp;
                                    <button type="button" class="btn btn-success btn-sm" @click="abrirModal2('confirma','imprimir',realizante)">
                                              <i class="icon-plus"></i>&nbsp;Imprimir
                                    </button>
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
            </div> 

    <!-- Inicio del modal 4 Imprimir constancia -->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal4}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!--el v-text="tituloModal" muestra el titulo segun el metodo mostrarModal -->
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal4()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Motivo de la constancia:<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="text" v-model="conceptoim" class="form-control" placeholder="ej: Padrinos de bautismo">
                                    </div>
                                </div>    
                                <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre del sacerdote<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idperso"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="sacerdote in arraysacerdote" :key="sacerdote.id" v-bind:value="sacerdote.id" >{{sacerdote.nombre_persona}}, {{sacerdote.apellido_persona}}</option>
                                        </select >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Cargo<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                            <select class="form-control" v-model="cargoim"> 
                                            <option value="0" disabled>Cargo</option>
                                            <option v-for="sacerdote in arraycargo" :key="sacerdote.id" v-bind:value="sacerdote" v-text="sacerdote"></option>
                                            </select>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Ofrenda por constancia<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="number" v-model="montoConstancia" class="form-control" placeholder="20.00">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3">Categoría</label>
                                    <div class="col-md-5">
                                        <select class="form-control" v-model="idcare">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="categorias in arraycategorias" :key="categorias.id"  v-bind:value="categorias.id" v-text="categorias.nombre_categoria"></option>
                                        </select>
                                    </div>
                                </div>

                            <!-- Este div se utiliza para la validación -->
                            <div v-show="errorModal4" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjModal4" :key="error" v-text="error">
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal4()">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click="imprimirConstancia()">Imprimir Constancia</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal Imprimir Constancia -->       
        </main>
</template>
<script>
    export default {
      data(){
            return{
                nombre:'',
                apellido:'',
                arrayrealizante:[],
                nombrerealizante:'',
                apellidorealizante:'',
                nombremadre:'',
                apellidomadre:'',
                duimadre:'',
                nombrepadre:'',
                apellidopadre:'',
                duipadre:'',
                idmadre:'',
                idpadre:'',
                id:'',
                nombresacerdote:'',
                dui:'',
                sexo:'',
                Acciondui:0,
                modal : 0,
                tituloModal : '',
                accion:0,
                accionsexo:0,
                cambiarm:0,
                cambiarmb:0,
                alcaldia:'',
                libro:'',
                partida:'',
                folio:'',
                ano:'',
                verificacion:0,
                accionbotones:0,

                /////////Impresion///////
                //tituloModal:'',
                modal4:0,
                conceptoim:'',
                idperso:'',
                cargoim:'',
                arraysacerdote:[],
                arraycargo:[],
                sacerdote:'',
                montoConstancia:'',
                idcare:0,
                arraycategorias:[],
                nombre_categoria:'',
                id_madre:0,
                id_realizante1:0,
                id_padre:0,
                id_sacramento:0,
                errorModal4 : 0,
                errorMostrarMsjModal4 : [],
                
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
            cambiarPagina(page,nombre,apellido){
            let me = this;
            //Actualiza la pagina actualizar
            me.pagination.current_page = page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarPersona(page,nombre,apellido);
        },
           
            //Mt. cuando da eliminar en el formulario
            cerrar(){
                this.monto=0;
                this.nombrerealizante='';
                this.apellidorealizante='';
                this.nombremadre='';
                this.apellidomadre='';
                this.duimadre='';
                this.nombrepadre='';
                this.apellidopadre='';
                this.duipadre='';
                this.nombresacerdote='';
                this.dui='';
                this.Acciondui=0;
                this.accion=0;
                this.accionbotones=0;
                this.modal=0;
                this.sexo='';
                this.id='';
                this.verificacion=0;
                this.cambiarm=0;
                this.cambiarmb=0;

            },
            cerrarm(){ //botones cancelat
                this.monto=0;
                this.nombrerealizante='';
                this.apellidorealizante='';
                this.nombremadre='';
                this.apellidomadre='';
                this.duimadre='';
                this.nombrepadre='';
                this.apellidopadre='';
                this.duipadre='';
                this.nombresacerdote='';
                this.dui='';
                this.accion=0;
                this.accionbotones=0;
                this.modal=0;
                this.sexo='';
                this.id='';
                this.alcaldia='';
                this.libro='';
                this.partida='';
                this.folio='';
                this.ano='';
                this.verificacion=0;
                this.cambiarm=0;
                this.cambiarmb=0;

            },
            //Mt. cuando le da modificar en el modal
            cerrarmodal(){
                    this.modal=0;
                   
            },
            //Mostrar datos para confirmar el ingreso
            abrirmodal(){
                this.modal=1;
                this.tituloModal='Confirmar ingreso'
                this.accionbotones=2;
                //Si es F o M
                if (this.sexo == 'M')   {
                    this.accionsexo=1;
                }
                if (this.sexo == 'F')   {
                    this.accionsexo=0;
                }
                //Si no tiene datos del padre
                if (this.nombrepadre == '')   {
                    this.accion=1;
                }
                //Si no tiene datos de la madre
                if (this.nombremadre == '')  {
                    this.accion=2;
                }
                if ((this.nombremadre == '') && (this.nombrepadre == ''))  {
                    this.accion=3;
                }

            },
            listarPersona(page,nombre,apellido){
                let me=this;
                var nom= this.nombre.toUpperCase();
                var ape= this.apellido.toUpperCase();
                var url='/persona/listarconfirmaciones?page='+ page + '&nombre=' + nom +'&apellido='+ ape;
                    axios.get(url) .then(function (response) {         
                       var respuesta= response.data;
                        me.arrayrealizante=respuesta.realizante.data;
                        me.pagination= respuesta.pagination;
                    }).catch(function (error) {
                    console.log(error);
                    });

            },
           
              /////////////////////////// TODO LO RELACIONADO A IMPRESION DE CERTIFICADOS /////////////////////////////
        cerrarModal4(){
                this.modal4=0;
                this.tituloModal='';
                this.id_sacramento='';
                this.enConcepto='';
                this.idcare='',
                this.cargosacerdote=0,
                this.idsacerdote=0,
                this.montoConstancia='';
                this.idcare=0;
                this.errorModal4=0;
                this.errorMostrarMsjModal4=[];
                this.idperso='';
                this.cargoim='';
                this.conceptoim='';
                this.cobrado=false;
            },
           /* cobrar: function (){
                        this.cobrado=true;
                        //AQUÍ AGREGAR EL DESABILITAR COBRAR1

                    },*/
            
             llenadolista(buscar,criterio){
                let me=this;
                var url='/persona/buscarsacerdote';
                axios.get(url) .then(function (response) {
                    me.arraysacerdote=response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            //autocompletar sacerdotes
            llenadoarray(){            
                    this.arraycargo= new Array('DIACONO','PARROCO', 'PADRE','ARZOBISPO','CARDENAL','NUNCIO APOSTOLICO','MONSEÑOR');                
            },
            selectCategoria(){
                 let me=this;
                var url='/categoriaresumen/selectCategoriaRe';
                axios.get(url) .then(function (response) {
                    // handle success
                    var respuesta= response.data;
                    me.arraycategorias=respuesta.categorias;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            //////////Impresion
            imprimirConstancia(){  
                if(this.validarModal4()){
                return;
            }
            this.eliminarImpresion();
            let me=this;
              axios.put('/persona/registrarImpresion',{
                    'idsacra':this.id_sacramento,
                    'idperso':this.idperso,
                    'cargoim':this.cargoim,
                    'conceptoim':this.conceptoim,
              }) .then(function (response) {
                    me.listarPersona();
                    me.cobrar();
                    me.mientras();
                }) .catch(function (error) {
                });
        },
        mientras(){  
            let me=this;
                this.pdfConstacia(me.id_sacramento, me.id_padre,me.id_madre,me.id_realizante1);
                
        },
         cobrar(){
            let me =this;
            var variable='Constancia de confirma';
            var tip=1;
            axios.put('/efectivo/registrar',{
                  'idcare':this.idcare,
                  'descripcion_efectivo': variable.toUpperCase(),
                  'monto':this.montoConstancia,
                  'tipo':tip,
              }) .then(function (response) {
                    me.cerrarmodal();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
        },
         validarModal4(){
            this.errorModal4=0;
            this.errorMostrarMsjModal4=[];
            var RE = /^\d*(\.\d{1})?\d{0,1}$/;
            this.conceptoim;
            this.montoConstancia;

            if(this.conceptoim=='')this.errorMostrarMsjModal4.push("El campo de motivo del certificado no puede estar vacio");
            if(this.idperso=='')this.errorMostrarMsjModal4.push("Debe elegir al Padre que firmará el certificado");
            if(this.cargoim=='')this.errorMostrarMsjModal4.push("Debe elegir el cargo del padre que firmará el certificado");
             if(this.montoConstancia ==''){
                    this.errorMostrarMsjModal4.push("Debe cobrar el certificado");
                }if(!RE.test(this.montoConstancia))this.errorMostrarMsjModal4.push("La ofrenda por certificado solo puede ser decimales");

            if (this.errorMostrarMsjModal4.length) this.errorModal4 = 1;

            return this.errorModal4;
        },

        pdfConstacia(id_sacramento,id_padre,id_madre,id_realizante1){
            if(id_padre == null){
                    id_padre=0;
            }
            if(id_madre == null){
                    id_madre=0;
              }
            window.open('http://127.0.0.1:8000/persona/certificadoConfirma/'+ id_sacramento+'/'+id_padre+ '/'+id_madre+ '/'+id_realizante1);
            this.cerrarModal4();
        },

        eliminarImpresion(){
              let me=this;
              axios.put('/persona/eliminarDatosImpresion',{
            
              }) .then(function (response) {
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
           
             abrirModal2(modelo, accion, data = []){
                switch(modelo){
                    case "confirma":
                    {
                        switch(accion){
                            case 'imprimir':{
                                this.modal4=1;
                                this.tituloModal = 'Imprimir acta de Confirma';
                                this.id_sacramento=data['id'];
                                this.id_padre=data['id_padre'];
                                this.id_madre=data['id_madre'];
                                this.id_realizante1=data['id_realizante1'];
                                this.idperso='';
                                this.cargoim='';
                                this.conceptoim='';
                                 this.idcare='';
                                this.montoConstancia='';
                                break;
                            }
                        }
                    }
                }
            }    
    


            },
            
        mounted() {
             this.listarPersona(1,this.nombre,this.apellido);
             this.llenadoarray();
             this.selectCategoria();
             this.llenadolista('','');
            
        }
    }
</script>
<style>
    
</style>