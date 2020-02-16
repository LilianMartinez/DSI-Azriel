<template>
   <main class="main">
            <!-- Breadcrumb -->
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <label class="titulo-encabezados">Usuarios de la aplicación</label>
                       
                    </div>
                    <div class="card-body">
                         <div class="input-group margen">
                            <button type="button" @click="abrirModal('personas','registrar')" class="btn btn-primary">
                                    <i class="icon-plus"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="0">Seleccione un elemento</option>     
                                      <option value="nombre_persona">Nombre</option>
                                      <option value="apellido_persona">Apellido</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPersona(1,buscar,criterio) " class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Rol</th>
                                    <th>Usuario</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="persona in arrayPersona" :key="persona.id">
                                    
                                    
                                    <td v-text="persona.nombre_persona"></td>
                                    <td v-text="persona.apellido_persona"></td>
                                    <td v-text="persona.nombre_rol"></td>
                                    <td v-text="persona.usuario"></td>

                                        <button type="button" @click="abrirModal('personas','actualizar',persona)" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="persona.condicion">
                                            &nbsp;
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarUsuario(persona.id)">
                                                <i class="icon-trash"></i> Desactivar Usuario
                                            </button>
                                        </template>
                                       <template v-else>
                                            &nbsp;
                                            <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(persona.id)">
                                                <i class="icon-check"></i>&nbsp;Activar Usuario 
                                            </button>
                                        </template>
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
   
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade"  tabindex="-1" :class="{'mostrar': modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre<b class="alerta">*</b></label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre_persona" class="form-control" placeholder="Nombre de la persona">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Apellido<b class="alerta">*</b></label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="apellido_persona" class="form-control" placeholder="Apellido de la persona">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Rol<b class="alerta">*</b></label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idrol">
                                            <option value="0">Seleccione un rol</option>
                                            <option v-for="rol in arrayRol" :key="rol.id" :value="rol.id" v-text="rol.nombre_rol">

                                            </option>
                                        </select>
                                    </div>
                                </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Usuario<b class="alerta">*</b></label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="usuario" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Password<b class="alerta">*</b></label>
                                    <div class="col-md-9">
                                        <input type="password" v-model="password" class="form-control" placeholder="Ej.AA######*">
                                    </div>
                                </div>
                                    <div>
                                        <div v-show="errorPersona" class="from-group row div-error">
                                            <div class="text-center text-error">
                                                <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>                  
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="registrarPersona()">Guardar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizarEfectivos()">Actualizar</button>
                        </div>
                    </div>
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
           
        </main>
</template>

<script>
    export default {
      data(){

            return{
                persona_id:0,
                nombre_persona:'',
                apellido_persona:'',
                usuario:'',
                nombre_rol : '',
                password : '',
                idrol : 0,
                arrayPersona : [],
                arrayRol : [],
                modal : 0,
                tituloModal : '',
                tipoAccion:0,
                errorPersona:0,
                errorMostrarMsjPersona:[],
                pagination:{
                    'total' :0,
                    'current_page' :0,
                    'per_page' :0,
                    'last_page' :0,
                    'from' :0,
                    'to' :0,
                },
                offset: 3,
                criterio:'nombre_persona', 
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

            listarPersona(page,buscar,criterio){
                let me=this;
                var lengthbuscar = this.buscar.length;
                 if(lengthbuscar >0)
                 {
                     var buscar2= this.buscar.toUpperCase();
                 }else
                 buscar2=this.buscar;
                var url='/user?page='+ page + '&buscar=' + buscar2 + '&criterio=' + criterio;
                axios.get(url) .then(function (response) {
                    // handle success
                    var respuesta= response.data;
                    me.arrayPersona=respuesta.personas.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            
            },
        selectRol(){
                let me=this;
                var url= '/rol/selectRol'; 
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayRol = respuesta.roles;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
        cambiarPagina(page,buscar,criterio){
            let me = this;
            //Actualiza la pagina actualizar
            me.pagination.current_page = page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarPersona(page,buscar,criterio);
        },
        
         registrarPersona(){
             
             if(this.validarPersona()){
                 return;
             }
             let me=this;
              axios.put('/user/registrar',{
                  'nombre_persona': this.nombre_persona.toUpperCase(),
                  'apellido_persona':this.apellido_persona.toUpperCase(),
                  'usuario':this.usuario.toUpperCase(),
                  'password':this.password.toUpperCase(),
                  'idrol':this.idrol
              }) .then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre_persona');
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
             
            },


            actualizarEfectivos(){
                if(this.validarPersona()){
                 return;
             }
               
               let me=this;
              axios.put('/user/actualizar',{
                  'nombre_persona': this.nombre_persona.toUpperCase(),
                  'apellido_persona':this.apellido_persona.toUpperCase(),
                  'usuario':this.usuario.toUpperCase(),
                  'password':this.password.toUpperCase(),
                  'idrol':this.idrol,
                  'id':this.persona_id,
              }) .then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre_persona');
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            validarPersona(){ 
                this.errorPersona=0;
                this.errorMostrarMsjPersona=[];
                //var RE =/^[a-zA-Z]+( [a-zA-z]+)*$/;  ///^[A-Z]+$/i
                var RE = /^\d*(\.\d{1})?\d{0,1}$/;
                var max_length=20;
                var min_length=3;
                var min_length_contra=9;
                var lengthMax = this.usuario.length;
                var lengthMin = this.usuario.length;
                var lengthMin_contra = this.password.length
                                
                if(!this.nombre_persona)this.errorMostrarMsjPersona.push("El campo nombre no puede estar vacio");
                if(!this.apellido_persona)this.errorMostrarMsjPersona.push("El campo apellido no debe estar vacio");
                if(!this.usuario)this.errorMostrarMsjPersona.push("El campo usuario no debe estar vacio");
                if(lengthMax > max_length)this.errorMostrarMsjPersona.push("El nombre de usuario no debe ser mayor a 20 letras");
                if(lengthMin < min_length)this.errorMostrarMsjPersona.push("El nombre de usuario no debe ser menor a 3 letras");
                if(!this.password)this.errorMostrarMsjPersona.push("El campo password no puede estar vacío");
                if(lengthMin_contra < min_length_contra)this.errorMostrarMsjPersona.push("El password no debe ser menor a 9 digitos");
                if(this.idrol==0)this.errorMostrarMsjPersona.push("Debe seleccionar un rol para el usuario");
                if(RE.test(this.nombre_persona))this.errorMostrarMsjPersona.push("No pueden ir números en el nombre");
                if(RE.test(this.apellido_persona))this.errorMostrarMsjPersona.push("No pueden ir números en el apellido");

                if(this.errorMostrarMsjPersona.length)this.errorPersona=1;


                return this.errorPersona;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.tipoAccion=0; 
                this.nombre_persona='';
                this.apellido_persona='';
                this.usuario='';
                this.password='';
                this.idrol=0;
                this.errorPersona=0;

            },

         
            abrirModal(modelo, accion, data=[]){
                this.selectRol();
                switch(modelo){
                    case "personas":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Registrar Usuario'
                                this.tipoAccion=1;
                                this.nombre_persona='';
                                this.apellido_persona='';
                                this.usuario='';
                                this.password='';
                                this.idrol=0;
                                break;

                            }
                             case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Modificar Usuario',
                                this.tipoAccion=2;
                                this.persona_id=data['id'];
                                this.nombre_persona=data['nombre_persona'];
                                this.apellido_persona=data['apellido_persona'];
                                this.usuario=data['usuario'];
                                this.password=data['password'];
                                this.idrol=data['idrol'];
                               break;
                            }
                        
                        }
                    }
                }

            },
        desactivarUsuario(id){
               swal({
                title: '¿Esta seguro de desactivar este usuario?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/user/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre_persona');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            activarUsuario(id){
               swal({
                title: '¿Esta seguro de activar este usuario?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/user/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre_persona');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            }
        },
        
        mounted() {
           
            this.listarPersona(1,this.buscar,this.criterio);
           
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
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>