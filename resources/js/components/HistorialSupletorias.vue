<template>
   <main class="main">
            <!-- Breadcrumb -->
            <div class="container-fluid">
                <!-- Tabla Primera comunion -->
                <div class="card">
                    <div class="card-header"><label class="titulo-encabezados">Registros de primera Comunión</label>
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
                                    <th>Nombre Padre</th>
                                    <th>Nombre Madre</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="realizante in arrayrealizante" :key="realizante.id">
                                    <td>{{realizante.hnom}} {{realizante.hapellido}}</td>
                                    <td>{{realizante.pnom}} {{realizante.papellido}}</td>
                                    <td>{{realizante.mnom}} {{realizante.mapellido}}</td>
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
                fecharealizacion:'',
                fechana:'',
                fechana2:'',
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
                this.fecharealizacion='';
                this.fechana='';
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
                this.fecharealizacion='';
                this.fechana='';
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
                var url='/persona/listarsupletorias?page='+ page + '&nombre=' + nom +'&apellido='+ ape;
                    axios.get(url) .then(function (response) {         
                       var respuesta= response.data;
                        me.arrayrealizante=respuesta.realizante.data;
                        me.pagination= respuesta.pagination;
                    }).catch(function (error) {
                    console.log(error);
                    });

            },
           

    


            },
            
        mounted() {
             this.listarPersona(1,this.nombre,this.apellido);
            
        }
    }
</script>
<style>
    
</style>