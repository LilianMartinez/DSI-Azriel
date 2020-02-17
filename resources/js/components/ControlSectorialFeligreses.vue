<template>
   <main class="main">
            <!-- Breadcrumb -->
          
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <label class="titulo-encabezados">Comunidad Parroquial</label>
                    </div>
                    <br>
                    <div class="card-body">
                    <div id="input-groupG">
                          
                                    <label id="zonaiglesia" for="text-input">ZONA:</label> 
                                    <div class="col-md-3">
                                        <select class="form-control col-md-12" v-model="idzona" @click="iglesias(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select>

                                    </div>
                                    <label id="zonaiglesia" for="text-input">IGLESIA:</label> 
                                    <div class="col-md-3">
                                        <select class="form-control col-md-12" v-model="idiglesia" @click="feligreses(idiglesia)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesia in arrayiglesia" :key="iglesia.id" v-bind:value="iglesia.id" >{{iglesia.nombre_iglesia}}</option>
                                        </select >
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="input-group margen">
                            <button type="button" @click="abrirModal('feligres','registrar')" class="btn btn-primary">
                                    <i class="icon-plus"></i>&nbsp;Nuevo
                            </button>
                    </div>
                     <div class="input-group margen">
                    </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre_persona">Nombre</option>
                                      <option value="apellido_persona">Apellido</option> 
                                      <option value="fecha_nacimiento">Fecha de nacimiento</option> 
                                      <option value="dui_pasaporte">DUI</option>
                                    </select>
                                    <input type="text"  v-model="buscar" @keyup.enter="listarFeligresesBuscar(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarFeligresesBuscar(1,buscar,criterio) " class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Documento de identidad</th>
                                    <th>Nombre del feligres</th>
                                    <th>fecha de nacimiento</th>
                                    <th>Zona</th>
                                    <th>Iglesia</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="feligres in arrayfeligres" :key="feligres.id">                              
                                    <td>{{feligres.dui_pasaporte}}</td>
                                    <td>{{feligres.nombre_persona}}, {{feligres.apellido_persona}}</td>
                                    <td v-text="feligres.fecha_nacimiento"></td>
                                    <td v-text="feligres.nombre_zona"></td>
                                    <td v-text="feligres.nombre_iglesia"></td>
                                        <button type="button" @click="abrirModal('feligres','actualizar',feligres)" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                         <button  type="button" class="btn btn-danger btn-sm"  @click="abrirModal('feligres','eliminar',feligres)" >
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
                <!-- tabla Listado -->
            </div>
   
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade"  tabindex="-1" :class="{'mostrar': modal}" role="dialog" aria-labelledby="myModalLabel"  style="display: none; overflow-y:auto;" aria-hidden="true">
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
                            <div v-show="verim==1">
                                <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Documento de identidad</label>
                                        &nbsp;&nbsp;&nbsp;
                                        <label  for="text-input"></label><label>{{dui}}</label>
                                </div>
                            </div>
                            <div v-show="verim==0">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Documento de identidad</label>
                                    <div class="col-md-5">
                                        <input tabindexgt="0" v-model="dui" class="form-control" placeholder="999999999" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombres del feligres:<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="nombre_persona" class="form-control" placeholder="Nombre del feligres">
                                    </div>
                            </div>
                             <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Apellidos del feligres<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="apellido_persona" class="form-control" placeholder="Apellido del Feligres">
                                    </div>
                            </div>
                            <div v-show="verim==0">
                                <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Fecha de Nacimiento<b class="alerta">*</b></label>
                                    <div class="col-md-4">
                                            <input type="date" class="form-control datepicker" name="date" v-model="fechana">
                                    </div>
                                </div>
                            </div>
                            <div v-show="verim==1">
                                <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="text-input">Fecha de Nacimiento<b class="alerta">*</b></label>
                                    &nbsp;&nbsp;&nbsp;
                                        <label  for="text-input"></label><label>{{fechana}}</label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Sexo<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                    <table>
                                        <tr> <input tabindexgt="-1" type="radio" v-model="sexo" value="F" name="sexo">Femenino</tr>
                                        <tr> <input tabindexgt="-1" type="radio" v-model="sexo" value="M" name="sexo">Maculino</tr>
                                    </table>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <div v-show="veri==1">
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="verificarExistenciaDui()">Guardar</button>
                            </div>
                            <div v-show="veri==1">
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="verificarExistenciaDuiM()">Actualizar</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal registrar/actualizar-->
               <!-- Inicio del modal Eliminar -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" :class="{'mostrar': modal2}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">¿Esta seguro de eliminar a este feligres?</h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <!--<div v-show="dui==''">-->
                                    <div class="form-group row">
                                        <b class="alerta"><label class="col-md-12 form-control-label" for="text-input">Documento de identidad</label></b>
                                        &nbsp;&nbsp;&nbsp;
                                        <b class="alerta"> <label  for="text-input"></label><label>{{dui}}</label></b>   
                                    </div>
                                <!--</div>-->
                                <div class="form-group row">
                                        <b class="alerta"> <label class="col-md-12 form-control-label" for="text-input">Nombre del feligres</label></b>
                                        &nbsp;&nbsp;&nbsp;
                                        <b class="alerta"><label  for="text-input">{{nombre_persona}}</label></b>   
                                </div>
                                 <div class="form-group row">
                                    <b class="alerta"><label class="col-md-12 form-control-label" for="text-input">Apellidos del feligres</label></b>
                                    &nbsp;&nbsp;&nbsp;
                                    <b class="alerta"> <label  for="text-input"></label><label>{{apellido_persona}}</label></b>   
                                </div>
                                <div class="form-group row">
                                    <b class="alerta"><label class="col-md-12 form-control-label" for="text-input">Fecha de nacimiento</label></b>
                                    &nbsp;&nbsp;&nbsp;
                                    <b class="alerta"> <label  for="text-input"></label><label>{{fechana}}</label></b>   
                                </div>
                                <div class="form-group row">
                                    <b class="alerta"><label class="col-md-12 form-control-label" for="text-input">Sexo</label></b>
                                    &nbsp;&nbsp;&nbsp;
                                    <b class="alerta"> <label  for="text-input"></label><label>{{sexo}}</label></b>   
                                </div>
                                <div class="form-group row">
                                    <b class="alerta"><label class="col-md-12 form-control-label" for="text-input">Zona</label></b>
                                    &nbsp;&nbsp;&nbsp;
                                    <b class="alerta"> <label for="text-input"></label><label>{{nombre_zona}}</label></b>   
                                </div>
                                <div class="form-group row">
                                    <b class="alerta"><label class="col-md-12 form-control-label" for="text-input">Iglesia</label></b>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <b class="alerta"><label  for="text-input"></label><label>{{nombre_iglesia}}</label></b>   
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
                
                sexo:'',//sexo

                dui:'', //dui
                veri:1,
                verim:0,

                idzona:'',
                idiglesia:'',
                zona:'',
                iglesia:'',
                nombre_zona:'',
                nombre_iglesia:'',
                arrayzona:[],
                arrayiglesia:[],
                arrayiglesiaID:[],

                feligreses_id:'',
                arrayfeligres:[],
                nombre_persona:'',
                apellido_persona:'',
                fechana:'',

                // --------------------------------------------
                categoriasResumenes_id:0,
                nombre_categoria:'',
                descripcion_categoria:'',
                arraycategoriasresumenes:[],
                // ---------------------------------------------

                modal : 0,
                modal2: 0,
                tituloModal : '',
                tipoAccion:0,
                criterio:'nombre_persona', 
                buscar:'',
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
            cambiarPagina(page,buscar,criterio){
            let me = this;
            //Actualiza la pagina actualizar
            me.pagination.current_page = page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarFeligresesBuscar(page,buscar,criterio)
        },

         buscarDui(){
            let me=this;
            var d=this.dui;
            var idcs=this.id;
            if(d != ''){
                var url='/persona/duis?dui=' + d;
                axios.get(url) .then(function (response) {
                    var respuesta=response.data.solo;
                    var datos= response.data.persona;
                    if(respuesta==1){
                        me.veri=1;
                        me.registrarfeligres();
                    }
                    if(respuesta==2){
                        me.veri=2;
                        me.llenarcampos(datos);
                        me.validarvalores2();
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
                    
        },

        validarvalores2(){
            this.errorDatos=0;
                this.errorMostrarMsj=[];
               
                if(this.veri==2) this.errorMostrarMsj.push("Esta persona ya existe en el sistema");
                if(this.errorMostrarMsj.length) this.errorDatos=1;
                return this.errorDatos;
        },

        llenarcampos(data=[]){
            this.nombre_persona= data['nombre_persona'];
            this.apellido_persona= data['apellido_persona'];
            this.fechana=data['fecha_nacimiento'];
            this.id=data['id'];
            this.sexo=data['sexo']; //no tiene que estar ligado al DUI ya que no todos los feligreses tienen dui
            this.idzona=data['idzonaa']; 
            this.llenadolistazona();
            if(this.idzona)
                {
                    this.iglesias(this.idzona);
                    this.idiglesia=data['idiglesia'];
                    this.nombre_iglesia=data['nombre_iglesia'];
                }
            
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

            feligreses(idiglesia){

                let me=this;
                var arrayiglesiaFeligre=[];
             axios.post('/sectorial/buscarIglesiaFeligreses',{
               'id':this.idiglesia}) 
              .then(function (response) { 
                  /*response.data.forEach(function(element) {
                        if(element.fecha_nacimiento != ''){
                        var texto = element.fecha_nacimiento;
                        element.fecha_nacimiento= texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
                        }
                    });*/
                arrayiglesiaFeligre = response.data;     
                me.llenar2(arrayiglesiaFeligre);  
                
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
           llenar2(d=[]){
                this.arrayfeligres=d;
            },


            listarFeligresesBuscar(page,buscar,criterio){
                let me=this;
                var lengthbuscar = this.buscar.length;
                 if(lengthbuscar >0)
                 {
                     var buscar2= this.buscar.toUpperCase();
                 }else
                 buscar2=this.buscar;
                var url='/feligreses?page='+ page + '&buscar=' + buscar2 + '&criterio=' + criterio;
                axios.get(url) .then(function (response) {
                  /*  response.data.feligres.data.forEach(function(element) {
                        if(element.fecha_nacimiento != ''){
                        var texto = element.fecha_nacimiento;
                        element.fecha_nacimiento= texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
                        }
                    });*/
                    var respuesta= response.data;
                    me.arrayfeligres=respuesta.feligres.data;
                    me.pagination= respuesta.pagination;
                    me.cerrarmodal2();
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
            
            },
            
            validarvalores(){ 
                this.errorDatos=0;
                this.errorMostrarMsj=[];
                var RE = /^\d*(\.\d{1})?\d{0,1}$/;
                var patrondui= /^\d{9}$/;
               var Max_Length = 99;
               var Min_Length = 3;
               //Nombre y apellido
               var lengthmaxN = this.nombre_persona.length;
               var lengthminN = this.nombre_persona.length;
               var lengthmaxA = this.apellido_persona.length;
               var lengthminA = this.apellido_persona.length;

               //fecha
                var fecha = new Date();
                var fecha2 = new Date();
                var actualYear = fecha.getFullYear();
                var actualMes = fecha.getMonth();
                var actualDate = fecha.getDate();

                var values = this.fechana.split("-");
                var anio = values[0];

                if(this.dui!=''){
                    if (!patrondui.test(this.dui))this.errorMostrarMsj.push("El DUI debe ser de nueve digitos");
                }
               
                if (lengthmaxN > Max_Length)this.errorMostrarMsj.push("El nombre del feligres debe tener menos de 99 letras");
                if (lengthminN < Min_Length)this.errorMostrarMsj.push("El nombre del feligres debe tener más de 3 letras");
                if (lengthmaxA > Max_Length)this.errorMostrarMsj.push("El apellido del feligres debe tener menos de 99 letras");
                if (lengthminA < Min_Length)this.errorMostrarMsj.push("El apellido del feligres debe tener más de 3 letras");
                
                if(!this.fechana)
                    {
                            this.errorMostrarMsj.push("La fecha de nacimiento es obligatoria");
                        
                    }else{
                            var values = this.fechana.split("-");
                            var anio = values[0];
                            if(anio < 1800)this.errorMostrarMsj.push("El año debe de ser mayor a 1900");
                            if((actualYear)<anio)this.errorMostrarMsj.push("El año debe ser menor o igual al " + (actualYear));

                            var values=this.fechana.split("-");
                            var dia = values[2];
                            var mes = values[1];
                            var ano = values[0];

                                // cogemos los valores actuales
                            var fecha_hoy = new Date();
                            var ahora_ano = fecha_hoy.getYear();
                            var ahora_mes = fecha_hoy.getMonth()+1;
                            var ahora_dia = fecha_hoy.getDate();
            
                            var fechana2 = (ahora_ano + 1900) - ano;

                            if ( ahora_mes < mes )
                            {
                                fechana2--;
                            }
                            if ((mes == ahora_mes) && (ahora_dia < dia))
                            {
                                fechana2--;
                            }
                            if (fechana2 > 1900)
                            {
                                fechana2-= 1900;
                            }
                            if (fechana2 >= 18 && this.dui=='')  {
                                this.errorMostrarMsj.push("La persona es mayor de edad, ingrese el DUI");
                            }
                            if(fechana2 < 18 && this.dui==''){
                                    this.dui='';
                                }
                            if(fechana2 < 18 && this.dui!=''){
                                this.errorMostrarMsj.push("La persona es menor de edad, no debe ingresar DUI");
                                }

                    }
                
                if(!this.sexo) this.errorMostrarMsj.push("Debe seleccionar el sexo de la persona");
                if(this.idzona=='') this.errorMostrarMsj.push("Seleccione una zona");
                if(this.idiglesia=='') this.errorMostrarMsj.push("Seleccione una iglesia");
                if(this.errorMostrarMsj.length) this.errorDatos=1;    
                return this.errorDatos;
            },


            validarvaloresm(){
                this.errorDatos=0;
                this.errorMostrarMsj=[];
                var RE = /^\d*(\.\d{1})?\d{0,1}$/;
                var patrondui= /^\d{9}$/;
               var Max_Length = 99;
               var Min_Length = 3;
               //Nombre y apellido
               var lengthmaxN = this.nombre_persona.length;
               var lengthminN = this.nombre_persona.length;
               var lengthmaxA = this.apellido_persona.length;
               var lengthminA = this.apellido_persona.length;

               //fecha
                var fecha = new Date();
                var fecha2 = new Date();
                var actualYear = fecha.getFullYear();
                var actualMes = fecha.getMonth();
                var actualDate = fecha.getDate();
                var values = this.fechana.split("-");
                var anio = values[0];

                if(this.dui!=null && this.dui!=''){
                    if (!patrondui.test(this.dui))this.errorMostrarMsj.push("El DUI debe ser de nueve digitos");
                }
               
                if (lengthmaxN > Max_Length)this.errorMostrarMsj.push("El nombre del feligres debe tener menos de 99 letras");
                if (lengthminN < Min_Length)this.errorMostrarMsj.push("El nombre del feligres debe tener más de 3 letras");
                if (lengthmaxA > Max_Length)this.errorMostrarMsj.push("El apellido del feligres debe tener menos de 99 letras");
                if (lengthminA < Min_Length)this.errorMostrarMsj.push("El apellido del feligres debe tener más de 3 letras");
                
                if(!this.fechana)
                    {
                            this.errorMostrarMsj.push("La fecha de nacimiento es obligatoria");
                        
                    }else{
                            var values = this.fechana.split("-");
                            var anio = values[0];
                            if(anio < 1800)this.errorMostrarMsj.push("El año debe de ser mayor a 1900");
                            if((actualYear)<anio)this.errorMostrarMsj.push("El año debe ser menor o igual al " + (actualYear));

                            var values=this.fechana.split("-");
                            var dia = values[2];
                            var mes = values[1];
                            var ano = values[0];

                                // cogemos los valores actuales
                            var fecha_hoy = new Date();
                            var ahora_ano = fecha_hoy.getYear();
                            var ahora_mes = fecha_hoy.getMonth()+1;
                            var ahora_dia = fecha_hoy.getDate();
            
                            var fechana2 = (ahora_ano + 1900) - ano;

                            if ( ahora_mes < mes )
                            {
                                fechana2--;
                            }
                            if ((mes == ahora_mes) && (ahora_dia < dia))
                            {
                                fechana2--;
                            }
                            if (fechana2 > 1900)
                            {
                                fechana2-= 1900;
                            }
                            if (fechana2 >= 18 && this.dui==null)  {
                                this.errorMostrarMsj.push("La persona es mayor de edad, ingrese el DUI");
                            }
                            if(fechana2 < 18 && this.dui!='' && this.dui!=null){
                                this.errorMostrarMsj.push("La persona es menor de edad, no debe ingresar DUI");
                                }

                    }
                
                if(!this.sexo) this.errorMostrarMsj.push("Debe seleccionar el sexo de la persona");
                if(this.idzona=='') this.errorMostrarMsj.push("Seleccione una zona");
                if(this.idiglesia=='') this.errorMostrarMsj.push("Seleccione una iglesia");
                if(this.errorMostrarMsj.length) this.errorDatos=1;    
                return this.errorDatos;

            },

            verificarExistenciaDui(){
                let me=this;
                if(me.dui==''){
                    me.dui='';
                    me.registrarfeligres();
                }else{
                    me.buscarDui();
                }
            },
             
              registrarfeligres(){
               if(this.validarvalores()){
                  return;   
                 }

                let me=this;
                var buscar='';
                var criterio='nombre_persona';
              axios.put('/feligreses/registrar',{
                  'nombre_persona': this.nombre_persona.toUpperCase(),
                  'apellido_persona': this.apellido_persona.toUpperCase(),
                  'fecha_nacimiento':this.fechana,
                  'idzonaa':this.idzona,
                  'idiglesia':this.idiglesia,
                  'dui':this.dui,
                  'sexo':this.sexo,
              }) .then(function (response) {
                    me.msjExito();
                    me.cerrarModal();
                    me.listarFeligresesBuscar(1,buscar,criterio);
                    //console.log(response);
                }) .catch(function (error) {
                 
                });
            },
            msjExito(){
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
                this.tituloModal='';
                this.tipoAccion=0;
                this.nombre_persona='';
                this.apellido_persona='';
                this.sexo='';
                this.fechana='';
                this.buscar='';
                this.idiglesia='';
                this.criterio='nombre_iglesia';
                this.idzona='';
                this.errorDatos=0;
                this.errorMostrarMsj=[];
                this.dui='';
                this.veri=1;
                
            
            },
            cerrarmodal2(){
                this.arrayzona=[];
                this.arrayiglesia=[];
                this.idzona=0;
                this.idiglesia=0;
                this.llenadolistazona();
                this.iglesias();
            },

            verificarExistenciaDuiM(){
                let me=this;
                if(me.dui==''){
                    me.dui ='';
                    me.actualizarfeligreses();
                }else{
                    if(this.verim==0){
                        me.buscarDuiM();
                    }else{
                        me.actualizarfeligreses();
                    }
                    
                }
            },

            buscarDuiM(){
            let me=this;
            var d=this.dui;
            var idcs=this.id;
            if(d != ''){
                var url='/persona/duis?dui=' + d;
                axios.get(url) .then(function (response) {
                    var respuesta=response.data.solo;
                    var datos= response.data.persona;
                    if(respuesta==1){
                        me.veri=1;
                        me.actualizarfeligreses();
                    }
                    if(respuesta==2){
                        me.veri=2;
                        me.llenarcampos(datos);
                        me.validarvalores2();
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
                    
        },

            actualizarfeligreses(){
                if(this.validarvaloresm()){
                  return;   
                 }
               
                let me=this;
                var buscar='';
                var criterio='nombre_persona';
                axios.put('/feligreses/update',{
                  'nombre_persona': this.nombre_persona.toUpperCase(),
                  'apellido_persona':this.apellido_persona.toUpperCase(),
                  'fecha_nacimiento':this.fechana,
                  'idiglesia':this.idiglesia,
                  'idzonaa':this.idzona,
                  'id':this.feligreses_id,
                  'dui':this.dui,
                  'sexo':this.sexo,
                    }) .then(function (response) {
                    me.cerrarModal();
                    me.msjExito();
                    me.listarFeligresesBuscar(1,buscar,criterio);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
             eliminar(){
                let me=this;
                var buscar='';
                var criterio='nombre_persona';
                axios.put('/feligreses/eliminar',{
                  'id':this.feligreses_id,
                    }) .then(function (response) {
                     me.cerrarModal();
                     me.msjEliminar();
                     me.listarFeligresesBuscar(1,buscar,criterio);
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            msjEliminar(){
            swal({
                type: 'success',
                title: 'Se elimino con éxito',
                showConfirmButton: false,
                timer: 1500
            })
        },

    
          abrirModal(modelo, accion, data=[]){
                switch(modelo){
                    case "feligres":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal=1;
                                this.tituloModal='Nuevo Feligres';
                                this.tipoAccion=1;
                                this.nombre_persona='';
                                this.apellido_persona='';
                                this.fechana='';
                                this.idiglesia='';
                                this.idzona='';
                                this.dui='';
                                this.sexo='';
                                this.verim=0;
                                break;

                            }
                             case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal='Modificar Feligres';
                                this.tipoAccion=2;
                                this.feligreses_id=data['id'];
                                this.nombre_persona=data['nombre_persona'];
                                this.apellido_persona=data['apellido_persona'];
                                this.fechana=data['fecha_nacimiento'];
                                this.sexo=data['sexo'];
                                this.idzona=data['idzona'];
                                this.nombre_zona=data['nombre_zona'];
                                this.dui=data['dui_pasaporte'];
                                if(this.idzona){
                                this.iglesias(this.idzona);
                                this.idiglesia=data['idiglesia'];
                                this.nombre_iglesia=data['nombre_iglesia'];
                                }
                                if(!this.dui)
                                {
                                    this.verim=0;
                                }else{
                                    this.verim=1;
                                }
                               break;
                            }
                             case 'eliminar':
                            {
                                this.modal2=1;
                                this.tituloModal='Eliminar Feligres';
                                this.feligreses_id=data['id'];
                                this.nombre_persona=data['nombre_persona'];
                                this.sexo=data['sexo'];
                                this.apellido_persona=data['apellido_persona'];
                                this.fechana=data['fecha_nacimiento'];
                                this.idiglesia=data['idiglesia'];
                                this.nombre_iglesia=data['nombre_iglesia'];
                                this.nombre_zona=data['nombre_zona'];
                                this.idzona=data['idzona'];
                                this.dui=data['dui_pasaporte'];
                               break;
                            }
                        }
                    }
                }

            }
        },
        mounted() {
            this.listarFeligresesBuscar(1,this.buscar,this.criterio);
            this.llenadolistazona('','');
            
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