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
                                    <th>Nota Marginal</th>
                                    
                                    <th style="text-align: center">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="bautizo in arraybautizo" :key="bautizo.id"> 
                                    
                    
                                    <td v-text="bautizo.libro"></td>
                                    <td v-text="bautizo.folio"></td>
                                    <td v-text="bautizo.asiento"></td>
                                    <td>{{bautizo.apellido_realizante}},  {{bautizo.nombreRea}}</td>
                                    <td v-text="bautizo.nota"></td>
                                   
                                        <button type="button" @click="abrirModal('bautizo','marginaracta',bautizo)" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                         <button  type="button"   @click="abrirModal('bautizo','imprimir',bautizo)" >
                                          <i class="icon-trash  enter"></i>
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
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nota Marginal</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nota" class="form-control" placeholder="Ingrese la nota marginal">
                                        
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
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="marginar()">Guardar</button>
                           
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

        </main>
</template>

<script>
export default {
    data (){
        return{
            
            id_sacramento:'',
            
            folio:0,
            libro:0,
            asiento:0,
            id_nota:0,
           
            nota:'',
           
            nombreRea:'',
            apellido_realizante:'',
            
            arraybautizo:[],
           
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
                this.errorDatos=0;
                this.nota='';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "bautizo":
                    {
                        switch(accion){
                            case 'marginaracta':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Marginar Acta';
                                this.nota ='';
                                this.id_sacramento=data['id'];
                                this.tipoAccion = 1;
                                
                                break;
                            }
                           
                        }
                    }
                }
            },
    
            validarmarginacion(){
                this.errorDatos=0;
                this.errorMostrarMsj=[];
                var patron =/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;

                if(!patron.test(this.nota)) this.errorMostrarMsj.push("La nota solo debe tener letras");
                if(this.errorMostrarMsj.length) this.errorDatos=1;
                return this.errorDatos;
            },

            marginar(){
                if(this.validarmarginacion()){
                    return;
                }

                let me =this;
                axios.put('/nota/marginaracta',{
                    'notam':this.nota,
                    'idsacra':this.id_sacramento,
                }) .then(function (response) {
                    me.listarActasBautizo();
                    me.cerrarModal();
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
    },
    mounted(){
        this.listarActasBautizo(1,this.buscar,this.criterio,this.tipocomponente);
        
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