<template>
   <main class="main">
           
            <div class="container-fluid">
                <!-- actas de bautizo -->
                <div class="card">
                    <div class="card-header">
                       <label class="titulo-encabezados">Actas de Bautizo</label>
                    </div>

                    <div class="card-body">
                         
                         <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                        
                                        <option value="folio">Folio</option>
                                        <option value="libro">Libro</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarActasBautizo(1,buscar,criterio,1)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarActasBautizo(1,buscar,criterio,1) " class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div> 
                        </div> 
                     
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Libro</th>
                                    <th>Folio</th>
                                    <th>Asiento</th>
                                    <th>Nombre del realizante</th>
                                    
                                    <th style="text-align: center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="bautizo in arraybautizo" :key="bautizo.id"> 
                                    
                    
                                    <td v-text="bautizo.libro"></td>
                                    <td v-text="bautizo.folio"></td>
                                    <td v-text="bautizo.asiento"></td>
                                    <td>{{bautizo.apellido_realizante}},  {{bautizo.nombreRea}}</td>
                                   
                                        <button type="button" @click="abrirModal('bautizo','marginarActa',bautizo)" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                         <!--<button  type="button"   @click="abrirModal('bautizo','imprimir',bautizo)" >
                                          <i class="icon-trash  enter"></i>-->
                                        <button type="button" class="btn btn-success btn-sm" @click="abrirModal('bautizo','imprimir',bautizo)">
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
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal marginar -->
             <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="overflow-y: scroll;" aria-hidden="true">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Folio</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="folio" class="form-control" placeholder="Ingrese el numero del folio">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Libro</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="libro" class="form-control" placeholder="Ingrese el numero del libro">
                                        
                                    </div>
                                </div>
                                    <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Asiento</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="asiento" class="form-control" placeholder="Ingrese el numero del asiento">
                                        
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Dui del Hijo</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="duiRea" class="form-control" placeholder="Ingrese el dui">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre del Hijo</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombreRea" class="form-control" placeholder="Nombre del hijo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Apellido del Hijo</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="apellido_realizante" class="form-control" placeholder="Apellido del hijo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Dui de la Madre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="duiMadre" class="form-control" placeholder="Ingrese el dui">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre de la Madre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombreMadre" class="form-control" placeholder="Nombre de la madre">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Apellido de la Madre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="apellidoMadre" class="form-control" placeholder="Apellido de la madre">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Dui del Padre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="duiPadre" class="form-control" placeholder="Ingrese el dui">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre del Padre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombrePadre" class="form-control" placeholder="Nombre del padre">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Apellido del Padre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="apellidoPadre" class="form-control" placeholder="Apellido del padre">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Dui del Padrino</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="duiPadrino1" class="form-control" placeholder="Ingrese el dui">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre del Padrino</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombrePadrino1" class="form-control" placeholder="Nombre del padrino">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Apellido del Padrino</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="apellidoPadrino1" class="form-control" placeholder="Apellido del padrino">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Dui del Padrino</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="duiPadrino2" class="form-control" placeholder="Ingrese el dui">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre del Padrino</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombrePadrino2" class="form-control" placeholder="Nombre del padrino">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Apellido del Padrino</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="apellidoPadrino2" class="form-control" placeholder="Apellido del padrino">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre del Sacerdote</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombreSacer" class="form-control" placeholder="Nombre del sacerdote">
                                    </div>
                                </div>
                                <div v-show="errorDatos" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMjs" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarBautizo()">Guardar</button>
                           
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
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

                                <div class="form-group row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-secondary btn-block" v-on:click="cobrar">Cobrar</button>&nbsp;
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
    data (){
        return{
            
            id_sacramento:0,
            id_persona:0,
            folio:0,
            libro:0,
            asiento:0,
            id_nota:0,
            id_realizante:0,
            nota:'',
            fecha_realizacion:'',
            nombreRea:'', //P
            apellido_realizante:'', //A
            id_madre:0,
            id_padre:0,
            nombrePadre:'',
            apellidoPadre:'',
            apellidoMadre:'',
            nombreMadre:'',
            duiRea:'',
            duiMadre:'',
            duiPadre:'',
            nombreSacer:'',
            id_padrino1:0,
            id_padrino2:0,
            duiPadrino1:'',
            duiPadrino2:'',
            nombrePadrino1:'',
            apellidoPadrino1:'',
            arraybautizo:[],
            nombrePadrino2:'',
            apellidoPadrino2:'',
            precio:0,
            modal:0,
            modal1:0,
            criterio:'folio',
            buscar:'',
            tituloModal:'',
            tipoAccion:0,
            errorDatos:0,
            errorMostrarMjs:[],
            tipocomponente:1,

            //PARA IMPIRMIR CONSTANCIAS PDF
            modal4:0,
            tituloModal:'',
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
            offset:3,
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
            listarActasBautizo(page,buscar,criterio,tipocomponente){
                let me=this;
                 var lengthbuscar = this.buscar.length;
                 if(lengthbuscar >0)
                 {
                     var buscar2= this.buscar.toUpperCase();
                 }else
                 buscar2=this.buscar;
                
                var url='/bautizo?page='+ page + '&buscar=' + buscar2 + '&criterio=' + criterio;
                axios.get(url) .then(function (response) {
                    // handle success
                    var respuesta= response.data;
                    me.arraybautizo=respuesta.bautizos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            
            },
         cambiarPagina(page,buscar,criterio){
            let me = this;
            //Actualiza la pagina actualizar
            me.pagination.current_page = page;
            //Envia la peticion para visualizar la data de esa pagina
            if(tipocomponente=1){
            me.listarActasBautizo(page,buscar,criterio);
            }
        },
       
           cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.folio= '';
                this.libro = '';
                this.asiento = '';
                this.duiRea = '';
                this.nombreRea = '';
                this.apellido_realizante = '',
                this.duiMadre = '';
                this.nombreMadre = '';
                this.apellidoMadre = '';
                this.duiPadre = '';
                this.nombrePadre = '';
                this.apellidoPadre = '';
                this.duiPadrino1 = '';
                this.nombrePadrino1 = '';
                this.apellidoPadrino1 = '';
                this.duiPadrino2 = '';
                this.nombrePadrino2 = '';
                this.apellidoPadrino2 = '';                                
                this.nombreSacer = '';
                
            },
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
            cobrar: function (){
                        this.cobrado=true;
                        //AQUÍ AGREGAR EL DESABILITAR COBRAR1

                    },
            
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
            registrarImpresion(){  /////////AQUI
            let me=this;
              axios.put('/persona/registrarImpresion',{
                    'idsacra':this.id_sacramento,
                    'idperso':this.idperso,
                    'cargoim':this.cargoim,
                    'conceptoim':this.conceptoim,
              }) .then(function (response) {
                    me.listarActasBautizo();
                    me.cerrarModal4();
                    console.log(response);
                }) .catch(function (error) {
                 
                });
        },

        imprimirConstancia(){
            if(this.validarModal4()){
                return;
            }
            axios.put('/persona/certificadoBautizo',{
                'id': this. id_sacramento,
                'id_madre':this.id_madre,
                'id_padre':this.id_padre,
            }).then(function (response) { 
                    me.listarActasBautizo();
                    me.cerrarModal4();
                }) .catch(function (error) {
                    console.log(error);
                });
                 let me=this;
                 this.registrarImpresion();
                 this.pdfConstacia(me.id_sacramento, me.id_padre,me.id_madre);
                 this.eliminarImpresion();
        },

         validarModal4(){
            this.errorModal4=0;
            this.errorMostrarMsjModal4=[];
            var RE = /^\d*(\.\d{1})?\d{0,1}$/;
            this.conceptoim;
            this.montoConstancia;

            if(this.cobrado!=true)this.errorMostrarMsjModal4.push("Debe cobrar la solicitud de la constancia de confirma");
            if(this.conceptoim=='')this.errorMostrarMsjModal4.push("El campo de motivo de la constancia no puede estar vacio");
            if(this.idperso=='')this.errorMostrarMsjModal4.push("Debe elegir al Padre que firmará la constancia");
            if(this.cargoim=='')this.errorMostrarMsjModal4.push("Debe elegir el cargo del padre que firmará la constancia");
             if(this.montoConstancia ==''){
                    this.errorMostrarMsjModal4.push("Debe cobrar la constancia");
                }if(!RE.test(this.montoConstancia))this.errorMostrarMsjModal4.push("La ofrenda por constancias solo pueden ser decimales");

            if (this.errorMostrarMsjModal4.length) this.errorModal4 = 1;

            return this.errorModal4;
        },

        pdfConstacia(id_sacramento,id_padre,id_madre){
            if(id_padre == null){
                    id_padre=0;
            }
            if(id_madre == null){
                    id_madre=0;
              }
            window.open('http://127.0.0.1:8000/persona/certificadoBautizo/'+ id_sacramento+'/'+id_padre+ '/'+id_madre);
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

            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "bautizo":
                    {
                        switch(accion){
                            case 'marginar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Marginar Acta';
                                this.nota = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                break;
                            }
                            case 'imprimir':{
                                this.modal4=1;
                                this.tituloModal = 'Imprimir acta de bautizo';
                                this.id_sacramento=data['id'];
                                this.id_padre=data['id_padre'];
                                this.id_madre=data['id_madre'];
                                this.idperso='';
                                this.cargoim='';
                                this.conceptoim='';
                                break;
                            }
                        }
                    }
                }
            }
    },
    mounted(){
        this.listarActasBautizo(1,this.buscar,this.criterio,this.tipocomponente);
        this.llenadoarray();
        this.selectCategoria();
        this.llenadolista('','');

        
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