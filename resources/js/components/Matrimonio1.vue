<template>
   <main class="main">

            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <label class="titulo-encabezados">Matrimonios</label>
                    </div>
                    <div class="card-body">
                        <div class="input-group margen">
                            <button type="button" @click="abrirModal('sacramento','registrar')" class="btn btn-primary">
                                    <i class="icon-plus"></i>&nbsp;Nuevo
                            </button>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                     <option value="libro">Libro</option>
                                      <option value="num_expediente">Expediente</option>
                                      <option value="Apellidos">Apellidos</option>
                                      <option value="Nombres">Nombres</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarMatrimonio1(1,buscar,criterio)"  class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarMatrimonio1(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Libro</th>
                                    <th>Expediente</th>
                                    <th>Nombre del Novio</th>
                                    <th>Nombre de la Novia</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- en el v-for use "modelo", "array de la vista" y "ley del modelo"-->
                                <tr v-for="sacramento in arrayMatrimonio1" :key="sacramento.id">
                                    <!--Utilice el formato modelo.elemento -->
                                    <td v-text="sacramento.libro"></td>
                                    <td v-text="sacramento.num_expediente"></td>
                                    <td>{{sacramento.novioAp}}, {{sacramento.novioNom}}</td>
                                    <td>{{sacramento.noviaAp}}, {{sacramento.noviaNom}}</td>
                                    <td>
                                        <!--CAMBIAR CAMPO CONDICIÓN POR EL ESTADO -->
                                        <div v-if="sacramento.estado==1"><!--En la base de Datos, "Activo" equivale a 1 -->
                                            <span class="badge badge-primary">Activo</span>
                                        </div>
                                        <div v-else-if="sacramento.estado==0"><!--En la base de Datos, "Cancelado" equivale a 0 -->
                                            <span class="badge badge-danger">Cancelado</span>
                                        </div>
                                        <div v-else><!--En la base de Datos, "Realizado" equivale a 2 -->
                                            <span class="badge badge-success">Realizado</span>
                                        </div>                                       
                                    </td>
                                    <td> <!-- Aquí relizamos el if para saber que botones mostrar u ocultar -->
                                        <template v-if="sacramento.estado==1">
                                            <!-- <button type="button" @click="abrirModal('sacramento','actualizar',sacramento)">
                                              <i class="icon-pencil  enter"></i>
                                            </button> &nbsp; -->
                                            <button type="button" @click="abrirModal2('sacramento','paso2',sacramento)">
                                              <i class="icon-folder  enter"></i>
                                            </button> &nbsp;
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarExpediente(sacramento.id)">
                                              <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else-if="sacramento.estado==0"> <!-- Cuando el matrimonio esta cancelado -->
                                            <button type="button" class="btn btn-info btn-sm" @click="activarExpediente(sacramento.id)">
                                                <i class="icon-check"></i>&nbsp;Reactivar
                                            </button> &nbsp;
                                        </template>
                                        <template v-else> <!-- Cuando el matrimonio ya se realizo y se puede imprimir la constancia -->
                                            <button type="button" class="btn btn-success btn-sm" @click="abrirModal2('sacramento','paso4',sacramento)">
                                              <i class="icon-plus"></i>&nbsp;Imprimir
                                            </button>
                                        </template>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
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
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>

            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none; overflow-y:auto;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!--el v-text="tituloModal" muestra el titulo segun el metodo mostrarModal -->
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Libro</label>
                                    <div class="col-md-4">
                                        <input type="number" v-model="libro" class="form-control" placeholder="Numero de Libro">
                                    </div>
                                
                                    <label class="col-md-2 form-control-label" for="text-input">Expediente</label>
                                    <div class="col-md-4">
                                        <input type="number" v-model="num_expediente" class="form-control" placeholder="Numero de Expediente">
                                    </div>
                                </div>

                                <!-- Datos del Realizante1 -->
                                <div class="form-group row">
                                  <label class="col-md-5 form-control-label" for="text-input"><b>Datos del novio</b></label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Documento de Identidad</label>
                                    <div class="col-md-5">
                                        <input type="text" v-model="novioD" class="form-control" placeholder=" " @keydown.tab="novioDui()">
                                    </div>

                                    <label class="col-md-2 form-control-label" for="text-input">Fecha de Nacimiento<b class="alerta">*</b></label>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control datepicker" name="date" v-model="fechana1">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Nombre del Novio</label>
                                    <div class="col-md-5">
                                        <!-- El true-value="mostrar" y "ocultar" servirán para inhabilitar los inputText... falta arreglarlo en el método -->
                                        <input type="text" v-model="novioNom" class="form-control" placeholder="Nombres">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" v-model="novioAp" true-value="mostrar" false-value="ocultar" class="form-control" placeholder="Apellidos">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Zona:</label> 
                                    <div class="col-md-3">
                                        <select class="form-control" v-model="idzona1" @click="iglesias1(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>

                                    <label class="col-md-2 form-control-label" for="text-input">Iglesia:</label> 
                                    <div class="col-md-3">
                                        <select class="form-control" v-model="idiglesia1"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesia1 in arrayiglesia1" :key="iglesia1.id" v-bind:value="iglesia1.id" >{{iglesia1.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                                </div>

                                <!-- Datos del Realizante2 -->
                                <div class="form-group row">
                                  <label class="col-md-5 form-control-label" for="text-input"><b>Datos de la novia</b></label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Documento de Identidad</label>
                                    <div class="col-md-5">
                                        <input type="text" v-model="noviaD" class="form-control" placeholder=" " @keydown.tab="noviaDui()">
                                    </div>

                                    <label class="col-md-2 form-control-label" for="text-input">Fecha de Nacimiento<b class="alerta">*</b></label>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control datepicker" name="date" v-model="fechana2">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Nombre de la Novia</label>
                                    <div class="col-md-5">
                                        <input type="text" v-model="noviaNom" class="form-control" placeholder="Nombres">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" v-model="noviaAp" class="form-control" placeholder="Apellidos">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Zona:</label> 
                                    <div class="col-md-3">
                                        <select class="form-control" v-model="idzona2" @click="iglesias2(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>

                                    <label class="col-md-2 form-control-label" for="text-input">Iglesia:</label> 
                                    <div class="col-md-3">
                                        <select class="form-control" v-model="idiglesia2"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesia2 in arrayiglesia2" :key="iglesia2.id" v-bind:value="iglesia2.id" >{{iglesia2.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                                </div>

                                <!-- BOTON COBRAR-->
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input"><b>Ofrenda por Apertura del Expediente ($)</b></label>
                                    <div class="col-md-4">
                                        <input type="number" v-model="ofrendaExp" class="form-control" placeholder="Ofrenda">
                                    </div>
                                    <label class="col-md-1">Categoria</label>
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="idcare"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="categorias in arraycategorias" :key="categorias.id"  v-bind:value="categorias.id" v-text="categorias.nombre_categoria"></option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Este div se utiliza para la validación -->
                                <div v-show="errorMatrimonio1" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjMatrimonio1" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrar()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarMatrimonio1()"  >Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal Registrar/Actualizar-->

            <!--Inicio del modal 2 -->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal2}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!--el v-text="tituloModal" muestra el titulo segun el metodo mostrarModal -->
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal2()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Fecha<b class="alerta">*</b></label>
                                    <div class="col-md-4">
                                        <input type="date" v-model="fecha_realizacion" class="form-control" placeholder="Fecha de boda">
                                    </div>
                                    <label class="col-md-1 form-control-label" for="text-input">Lugar<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <!-- <input type="text" v-model="id_iglesia" class="form-control" placeholder="Nombre de la Iglesia"> -->
                                        <select class="form-control" v-model="id_iglesia"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesiaNom in arrayiglesia" :key="iglesiaNom.id" v-bind:value="iglesiaNom.id" >{{iglesiaNom.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                                </div><tr></tr>
                                
                                 <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre del sacerdote<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                        <select class="form-control" v-model="idsacerdote"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="sacerdote in arraysacerdote" :key="sacerdote.id" v-bind:value="sacerdote.id" >{{sacerdote.nombre_persona}}, {{sacerdote.apellido_persona}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Cargo<b class="alerta">*</b></label>
                                <div class="col-md-5">
                                        <select class="form-control" v-model="cargosacerdote"> 
                                        <option value="0" disabled>Cargo</option>
                                        <option v-for="sacerdote in arraycargo" :key="sacerdote.id" v-bind:value="sacerdote" v-text="sacerdote"></option>
                                        </select>
                                    </div>
                            </div>
                            <!-- Este div se utiliza para la validación -->
                            <div v-show="errorModal2" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjModal2" :key="error" v-text="error">
                                    </div>
                                </div>
                            </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal2()">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click="siguiente('1')">Siguiente</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal 2 -->
            <!--Inicio del modal 3 -->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal3}" role="dialog" aria-labelledby="myModalLabel" style="display: none; overflow-y:auto;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!--el v-text="tituloModal" muestra el titulo segun el metodo mostrarModal -->
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal3()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <!-- Datos de los Padrinos  -->
                                
                                <div class="form-group row">
                                  <label class="col-md-5 form-control-label" for="text-input"><b>Datos Persona 1</b></label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Documento de Identidad</label>
                                    <div class="col-md-5">
                                        <input type="text" v-model="pad1D" class="form-control" placeholder=" " @keydown.tab="pad1Dui()">
                                    </div>
                                     <label class="col-md-1 form-control-label">Sexo</label>
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="pad1Sexo"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Nombre Completo<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="text" v-model="pad1Nom" class="form-control" placeholder="Nombres del padrino">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" v-model="pad1Ap" class="form-control" placeholder="Apellidos del Padrino">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Zona:</label> 
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="idzonap1" @click="iglesiasp1(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                
                                    <label class="col-md-2 form-control-label" for="text-input">Iglesia:</label> 
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="idiglesiap1"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesiap1 in arrayiglesiap1" :key="iglesiap1.id" v-bind:value="iglesiap1.id" >{{iglesiap1.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Fecha de Nacimiento<b class="alerta">*</b></label>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control datepicker" name="date" v-model="fechanap1" >
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                  <label class="col-md-5 form-control-label" for="text-input"><b>Datos Persona 2</b></label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Documento de Identidad</label>
                                    <div class="col-md-5">
                                        <input type="text" v-model="mad1D" class="form-control" placeholder=" " @keydown.tab="mad1Dui()">
                                    </div>
                                     <label class="col-md-1 form-control-label">Sexo</label>
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="mad1Sexo"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Nombre Completo<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="text" v-model="mad1Nom" class="form-control" placeholder="Nombres del padrino">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" v-model="mad1Ap" class="form-control" placeholder="Apellidos del padrino">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Zona:</label> 
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="idzonap2" @click="iglesiasp2(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Iglesia:</label> 
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="idiglesiap2"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesiap2 in arrayiglesiap2" :key="iglesiap2.id" v-bind:value="iglesiap2.id" >{{iglesiap2.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Fecha de Nacimiento<b class="alerta">*</b></label>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control datepicker" name="date" v-model="fechanap2">
                                    </div>
                            </div>

                                <div class="form-group row">
                                  <label class="col-md-5 form-control-label" for="text-input"><b>Datos Persona 3</b></label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Documento de Identidad</label>
                                    <div class="col-md-5">
                                        <input type="text" v-model="pad2D" class="form-control" placeholder=" " @keydown.tab="pad2Dui()">
                                    </div>
                                     <label class="col-md-1 form-control-label">Sexo</label>
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="pad2Sexo"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Nombre Completo</label>
                                    <div class="col-md-5">
                                        <input type="text" v-model="pad2Nom" class="form-control" placeholder="Nombres del padrino">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" v-model="pad2Ap" class="form-control" placeholder="Apellidos del Padrino">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Zona:</label> 
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="idzonap3" @click="iglesiasp3(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                         
                                    <label class="col-md-2 form-control-label" for="text-input">Iglesia:</label> 
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="idiglesiap3"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesiap3 in arrayiglesiap3" :key="iglesiap3.id" v-bind:value="iglesiap3.id" >{{iglesiap3.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Fecha de Nacimiento<b class="alerta">*</b></label>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control datepicker" name="date" v-model="fechanap3">
                                    </div>
                            </div>

                                <div class="form-group row">
                                  <label class="col-md-5 form-control-label" for="text-input"><b>Datos Persona 4</b></label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Documento de Identidad</label>
                                    <div class="col-md-5">
                                        <input type="text" v-model="mad2D" class="form-control" placeholder=" " @keydown.tab="mad2Dui()">
                                    </div>
                                     <label class="col-md-1 form-control-label">Sexo</label>
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="mad2Sexo"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Nombre Completo</label>
                                    <div class="col-md-5">
                                        <input type="text" v-model="mad2Nom" class="form-control" placeholder="Nombres del padrino">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" v-model="mad2Ap" class="form-control" placeholder="Apellidos del padrino">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Zona:</label> 
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="idzonap4" @click="iglesiasp4(idzona)"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="zona in arrayzona" :key="zona.id" v-bind:value="zona.id">{{zona.nombre_zona}}</option>
                                        </select >
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Iglesia:</label> 
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="idiglesiap4"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="iglesiap4 in arrayiglesiap4" :key="iglesiap4.id" v-bind:value="iglesiap4.id" >{{iglesiap4.nombre_iglesia}}</option>
                                        </select >
                                    </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Fecha de Nacimiento<b class="alerta">*</b></label>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control datepicker" name="date" v-model="fechanap4">
                                    </div>
                            </div>

                                    <!-- BOTON COBRAR-->
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input"><b>Ofrenda por boda ($)</b></label>
                                    <div class="col-md-4">
                                        <input type="number" v-model="monto" class="form-control" placeholder="Ofrenda">
                                    </div>
                                    <label class="col-md-1">Categoria</label>
                                    <div class="col-md-4">
                                        <select class="form-control" v-model="idcare"> 
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="categorias in arraycategorias" :key="categorias.id"  v-bind:value="categorias.id" v-text="categorias.nombre_categoria"></option>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                <!-- Este div se utiliza para la validación -->
                                <div v-show="errorModal3" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjModal3" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal3()">Cerrar</button>
                            <button type="button" class="btn btn-secondary" @click="siguiente('2')">Anterior</button>
                            <button type="button" v-if="tipoAccion==3" class="btn btn-primary" @click="registrarBoda()" >Matrimonio Realizado</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal 3 -->

            <!-- Inicio del modal 4 Imprimir constancia -->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal4}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                      <!-- <div v-for="sacramento in arrayMatrimonio1" :key="sacramento.id">  GLORIA-->
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
                                    <label class="col-md-3 form-control-label" for="text-input">Ofrenda por constancia ($)<b class="alerta">*</b></label>
                                    <div class="col-md-5">
                                        <input type="number" v-model="montoConstancia" class="form-control" placeholder="Ofrenda">
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
                   <!-- </div> GLORIA-->
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal Imprimir Constancia -->

            <!-- Inicio del modal Eliminar -->
            <!-- <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-danger" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Desactivar Expediente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Estas seguro de desactivar el expediente</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger">Eliminar</button>
                        </div>
                    </div>
                    <!- /.modal-content ->
                </div>
                <!- /.modal-dialog ->
            </div> -->
            <!-- Fin del modal Eliminar -->
           
        </main>
</template>

<script>
    export default {
      data(){
          //Dave: En esta función declaramos las variables que utilizaremos
            return{
                fechana1:'', //fecha nacimiento novio
                fechana2:'', //fecha nacimiento novia
                fechanap1:'', //fecha nacimiento padrino 1
                fechanap2:'', //fecha nacimiento padrino 2
                fechanap3:'', //fecha nacimiento padrino 3
                fechanap4:'', //fecha nacimiento padrino 4


                //para zonas e iglesias de los novios y los padrinos
                idzona:'',
                idiglesia:'',
                zona:'', //
                iglesia:'',
                nombre_zona:'',//
                nombre_iglesia:'',
                arrayzona:[], //
                arrayiglesia:[],
                arrayiglesiaID:[],

                idzona1:'', //realizante 1: NOVIO
                idiglesia1:'',
                iglesia1:'',
                nombre_iglesia1:'',
                arrayiglesia1:[],
                arrayiglesiaID1:[],

                idzona2:'', //realizante 2: NOVIA
                idiglesia2:'',
                iglesia2:'',
                nombre_iglesia2:'',
                arrayiglesia2:[],
                arrayiglesiaID2:[],

                idzonap1:'', //padrino1
                idiglesiap1:'',
                iglesiap1:'',
                nombre_iglesiap1:'',
                arrayiglesiap1:[],
                arrayiglesiaIDp1:[],

                idzonap2:'', //padrino2
                idiglesiap2:'',
                iglesiap2:'',
                nombre_iglesiap2:'',
                arrayiglesiap2:[],
                arrayiglesiaIDp2:[],

                idzonap3:'', //padrino3
                idiglesiap3:'',
                iglesiap3:'',
                nombre_iglesiap3:'',
                arrayiglesiap3:[],
                arrayiglesiaIDp3:[],

                idzonap4:'', //padrino4
                idiglesiap4:'',
                iglesiap4:'',
                nombre_iglesiap4:'',
                arrayiglesiap4:[],
                arrayiglesiaIDp4:[],


           //     id:'', //id del id_sacramento capturado <---es para certificados
                sacramento_id:0,
                libro : '',
                num_expediente : '',
                fecha_realizacion : '',
                id_realizante1 : '',
                novioD :'',
                novioNom:'',
                novioAp:'',
                id_realizante2 : '',
                noviaD :'',
                noviaNom:'',
                noviaAp:'',
                //id_sacerdote : '',
                sacerdoteD : '',
                sacerdoteNom : '',
                sacerdoteAp : '',
                id_padrino1 : '',
                pad1D : '',
                pad1Nom : '',
                pad1Ap : '',
                pad1Sexo :'',
                id_padrino2 : '',
                pad2D : '',
                pad2Nom : '',
                pad2Ap : '',
                pad2Sexo :'',
                id_madrina1 : '',
                mad1D : '',
                mad1Nom : '',
                mad1Ap : '',
                mad1Sexo :'',
                id_madrina2 : '',
                mad2D : '',
                mad2Nom : '',
                mad2Ap : '',
                mad2Sexo :'',
                id_iglesia : '',
                arrayiglesia:[],
                iglesiaNom: '',
                tipo:0,
                estado :0,
                monto:'',//Este es el monto de la boda realizada
                ofrendaExp:'',//este es para el botón de crear expediente
                montoConstancia:'',//este es para el botón de solicitar constancia
                enConcepto:'',//el por qué se imprimirá la Constancia

                idcare:0,
                cargosacerdote:0,
                idsacerdote:0,
                arraysacerdote:[],
                arraycargo:[],
                arraycategorias:[],

                //Para impresion en PDF
                id_impresion:'', //creo que no lo ocuparé pero por si acaso v:
                idsacra:'', //creo que tampoco lo ocupo
                idperso:'',
                cargoim:'',
                conceptoim:'',

                arrayMatrimonio1 : [], //Nos sirve para almacenar objetos de tipo sacramento
                modal:0, //Nos sirve para poder activar o desactivar el modal
                modal2:0,
                modal3:0,
                modal4:0,//Modal imprimir
                tituloModal : '', //solo para registrar el título que queremos que aparezca en el modal
                tipoAccion :0,
                errorMatrimonio1 :0,//variable para validación
                errorMostrarMsjMatrimonio1 : [],//variable para validación
                errorModal2 : 0,
                errorMostrarMsjModal2 : [],
                errorModal3 : 0,
                errorMostrarMsjModal3 : [],
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
                criterio:'libro',
                buscar: ''
            }
        },//Fin de Data()
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
                if(from < 1){
                    from = 1;
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
        //Para lo de zonas e iglesias
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


             iglesias1(idzona1){  //realizante 1: NOVIO

                let me=this;
                var arrayiglesiaID1=[];
             axios.post('/feligreses/buscarIglesia',{
               'id':this.idzona1}) 
              .then(function (response) { 
                arrayiglesiaID1 = response.data;     
                me.llenar1(arrayiglesiaID1);  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            llenar1(d=[]){
                this.arrayiglesia1=d;
            },

             iglesias2(idzona2){ //realizante2:NOVIA

                let me=this;
                var arrayiglesiaID2=[];
             axios.post('/feligreses/buscarIglesia',{
               'id':this.idzona2}) 
              .then(function (response) { 
                arrayiglesiaID2= response.data;     
                me.llenar2(arrayiglesiaID2);  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            llenar2(d=[]){
                this.arrayiglesia2=d;
            },

            iglesiasp1(idzonap1){ //padrino1

                let me=this;
                var arrayiglesiaIDp1=[];
             axios.post('/feligreses/buscarIglesia',{
               'id':this.idzonap1}) 
              .then(function (response) { 
                arrayiglesiaIDp1= response.data;     
                me.llenarp1(arrayiglesiaIDp1);  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            llenarp1(d=[]){
                this.arrayiglesiap1=d;
            },

            iglesiasp2(idzonap2){ //padrino2

                let me=this;
                var arrayiglesiaIDp2=[];
             axios.post('/feligreses/buscarIglesia',{
               'id':this.idzonap2}) 
              .then(function (response) { 
                arrayiglesiaIDp2= response.data;     
                me.llenarp2(arrayiglesiaIDp2);  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            llenarp2(d=[]){
                this.arrayiglesiap2=d;
            },

            iglesiasp3(idzonap3){ //padrino3

                let me=this;
                var arrayiglesiaIDp3=[];
             axios.post('/feligreses/buscarIglesia',{
               'id':this.idzonap3}) 
              .then(function (response) { 
                arrayiglesiaIDp3= response.data;     
                me.llenarp3(arrayiglesiaIDp3);  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            llenarp3(d=[]){
                this.arrayiglesiap3=d;
            },

            iglesiasp4(idzonap4){ //padrino4

                let me=this;
                var arrayiglesiaIDp4=[];
             axios.post('/feligreses/buscarIglesia',{
               'id':this.idzonap4}) 
              .then(function (response) { 
                arrayiglesiaIDp4= response.data;     
                me.llenarp4(arrayiglesiaIDp4);  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },
            llenarp4(d=[]){
                this.arrayiglesiap4=d;
            },

            ///////////////////////////////////////////////////////////////////////////////////////


        cobrar: function (){
            this.cobrado=true;
            //AQUÍ AGREGAR EL DESABILITAR COBRAR1

        },

        imprimirConstancia(){
            if(this.validarModal4()){
                return;
            }
            this.eliminarImpresion();
            let me=this;
              axios.put('/persona/registrarImpresion',{
                    'idsacra':this.sacramento_id,
                    'idperso':this.idperso,
                    'cargoim':this.cargoim,
                    'conceptoim':this.conceptoim,
              }) .then(function (response) {
                    me.listarMatrimonio1();
                    me.cobrar();
                    me.mientras();
                }) .catch(function (error) {
                });
        },
        mientras(){  
            let me=this;
                this.pdfConstacia(me.sacramento_id);
                
        },

        cobrar(){
            let me =this;
            var variable='Constancia de matrimonio';
            var tip=1;
            axios.put('/efectivo/registrar',{
                  'idcare':this.idcare,
                  'descripcion_efectivo': variable.toUpperCase(),
                  'monto':this.montoConstancia,
                  'tipo':tip,
              }) .then(function (response) {
                    me.cerrarModal();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
        },

        pdfConstacia(sacramento_id){
            window.open('http://127.0.0.1:8000/persona/certificadoMatri/'+ sacramento_id);
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

        listarMatrimonio1(page, buscar, criterio){
            let me=this;
            var lengthbuscar = this.buscar.length;
                 if(lengthbuscar >0)
                 {
                     var buscar2= this.buscar.toUpperCase();
                 }else
                 buscar2=this.buscar;

            if (criterio=='nombre_persona' || 'apellido_persona'){
                var url='/sacramentoplus?page=' + page + '&buscar=' + buscar2 + '&criterio=' + criterio;
                axios.get(url).then(function (response){
                var respuesta=response.data;
                me.arrayMatrimonio1=respuesta.sacramentos.data;
                me.pagination=respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
            }else{
                var url='/sacramento?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response){
                var respuesta=response.data;
                me.arrayMatrimonio1=respuesta.sacramentos.data;
                me.pagination=respuesta.pagination;
                })
                .catch(function(error){
                    console.log(error);
                });
            }
            
        },

        cambiarPagina(page,buscar,criterio){
            let me = this;
            //Actualiza la pagina del listado de matrimonios
            me.pagination.current_page = page;
            //Envia la peticion para visualizar la data de esa pagina
            me.listarMatrimonio1(page,buscar,criterio);
        },

        //Esto se usa para el autollenado con el num de dui
        llenarCamposNovio(data=[]){
                this.novioNom= data['nombre_persona'];
                this.novioAp= data['apellido_persona'];
                this.id_realizante1=data['id'];
                this.fechana1=data['fecha_nacimiento'];
                this.idzona1=data['idzonaa'];
                this.llenadolistazona();
                if(this.idzona1)
                    {
                        this.iglesias1(this.idzona1);
                        this.idiglesia1=data['idiglesia'];
                    }
        },

        //Esto tambien es para el autollenado con el num de dui; invocamos al metodo "buscarduis" del controlador
        novioDui(){
                let me=this;
                var d= this.novioD;

                if(d != ''){
                    /* vm.novioNom === 'ocultar';
                    vm.novioAp === 'ocultar'; */
                var url='/persona/duihombre?dui=' + d;
                    axios.get(url) .then(function (response) {
                        var respuesta=response.data.solo;
                        var datos= response.data.persona;
                    if(respuesta==2){
                        me.llenarCamposNovio(datos);
                    }
                    }).catch(function (error) {
                    console.log(error);
                    });
                }
                /* vm.novioNom === 'mostrar';
                vm.novioAp === 'mostrar'; */
        },

        //Esto se usa para el autollenado con el num de dui
        llenarCamposNovia(data=[]){
                this.noviaNom= data['nombre_persona'];
                this.noviaAp= data['apellido_persona'];
                this.id_realizante2=data['id'];
                this.fechana2=data['fecha_nacimiento'];
                this.idzona2=data['idzonaa'];
                this.llenadolistazona();
                if(this.idzona2)
                    {
                        this.iglesias2(this.idzona2);
                        this.idiglesia2=data['idiglesia'];
                    }
        },

        //Esto tambien es para el autollenado con el num de dui; invocamos al metodo "buscarduis" del controlador
        noviaDui(){
                let me=this;
                var d= this.noviaD;

                if(d != ''){
                var url='/persona/duimujer?dui=' + d;
                    axios.get(url) .then(function (response) {
                        var respuesta=response.data.solo;
                        var datos= response.data.persona;
                    if(respuesta==2){
                        me.llenarCamposNovia(datos);
                    }
                    }).catch(function (error) {
                    console.log(error);
                    });
                }
        },

        //Esto se usa para el autollenado con el num de dui
        //Usaremos 1 para el sacerdote y 4 para los padrinos
        llenarCamposPadrino1(data=[]){
                this.pad1Nom= data['nombre_persona'];
                this.pad1Ap= data['apellido_persona'];
                this.id_padrino1=data['id'];
                this.pad1Sexo=data['sexo'];
                this.fechanap1=data['fecha_nacimiento'];
                this.idzonap1=data['idzonaa'];
                this.llenadolistazona();
                if(this.idzonap1)
                    {
                        this.iglesiasp1(this.idzonap1);
                        this.idiglesiap1=data['idiglesia'];
                    }
        },

        //Esto tambien es para el autollenado con el num de dui; invocamos al metodo "buscarduis" del controlador
        //usaremos 1 para el sacerdote y 4 para los padrinos
        pad1Dui(){
                let me=this;
                var d= this.pad1D;

                if(d != ''){
                var url='/persona/duis?dui=' + d;
                    axios.get(url) .then(function (response) {
                        var respuesta=response.data.solo;
                        var datos= response.data.persona;
                    if(respuesta==2){
                        me.llenarCamposPadrino1(datos);
                    }
                    }).catch(function (error) {
                    console.log(error);
                    });
                }
        },

        llenarCamposMadrina1(data=[]){
                this.mad1Nom= data['nombre_persona'];
                this.mad1Ap= data['apellido_persona'];
                this.id_madrina1=data['id'];
                this.mad1Sexo=data['sexo'];
                this.fechanap2=data['fecha_nacimiento'];
                this.idzonap2=data['idzonaa'];
                this.llenadolistazona();
                if(this.idzonap2)
                    {
                        this.iglesiasp2(this.idzonap2);
                        this.idiglesiap2=data['idiglesia'];
                    }
        },

        //Esto tambien es para el autollenado con el num de dui; invocamos al metodo "buscarduis" del controlador
        mad1Dui(){
                let me=this;
                var d= this.mad1D;

                if(d != ''){
                var url='/persona/duis?dui=' + d;
                    axios.get(url) .then(function (response) {
                        var respuesta=response.data.solo;
                        var datos= response.data.persona;
                    if(respuesta==2){
                        me.llenarCamposMadrina1(datos);
                    }
                    }).catch(function (error) {
                    console.log(error);
                    });
                }
        },

        //Esto se usa para el autollenado con el num de dui
        llenarCamposPadrino2(data=[]){
                this.pad2Nom= data['nombre_persona'];
                this.pad2Ap= data['apellido_persona'];
                this.id_padrino2=data['id'];
                this.pad2Sexo=data['sexo'];
                this.fechanap3=data['fecha_nacimiento'];
                this.idzonap3=data['idzonaa'];
                this.llenadolistazona();
                if(this.idzonap3)
                    {
                        this.iglesiasp3(this.idzonap3);
                        this.idiglesiap3=data['idiglesia'];
                    }
        },

        //Esto tambien es para el autollenado con el num de dui; invocamos al metodo "buscarduis" del controlador
        pad2Dui(){
                let me=this;
                var d= this.pad2D;

                if(d != ''){
                var url='/persona/duis?dui=' + d;
                    axios.get(url) .then(function (response) {
                        var respuesta=response.data.solo;
                        var datos= response.data.persona;
                    if(respuesta==2){
                        me.llenarCamposPadrino2(datos);
                    }
                    }).catch(function (error) {
                    console.log(error);
                    });
                }
        },

        llenarCamposMadrina2(data=[]){
                this.mad2Nom= data['nombre_persona'];
                this.mad2Ap= data['apellido_persona'];
                this.id_madrina2=data['id'];
                this.mad2Sexo=data['sexo'];
                this.fechanap4=data['fecha_nacimiento'];
                this.idzonap4=data['idzonaa'];
                this.llenadolistazona();
                if(this.idzonap4)
                    {
                        this.iglesiasp4(this.idzonap4);
                        this.idiglesiap4=data['idiglesia'];
                    }
        },

        //Esto tambien es para el autollenado con el num de dui; invocamos al metodo "buscarduis" del controlador
        mad2Dui(){
                let me=this;
                var d= this.mad2D;

                if(d != ''){
                var url='/persona/duis?dui=' + d;
                    axios.get(url) .then(function (response) {
                        var respuesta=response.data.solo;
                        var datos= response.data.persona;
                    if(respuesta==2){
                        me.llenarCamposMadrina2(datos);
                    }
                    }).catch(function (error) {
                    console.log(error);
                    });
                }
        },

        //Este es para la busqueda por dui del sacerdote
        llenarCamposSacerdote(data=[]){
                this.sacerdoteNom= data['nombre_persona'];
                this.sacerdoteAp= data['apellido_persona'];
                this.id_sacerdote=data['id'];
        },

        //Esto tambien es para el autollenado con el num de dui; invocamos al metodo "buscarduis" del controlador
        sacerdoteDui(){
                let me=this;
                var d= this.sacerdoteD;

                if(d != ''){
                var url='/persona/duihombre?dui=' + d;
                    axios.get(url) .then(function (response) {
                        var respuesta=response.data.solo;
                        var datos= response.data.persona;
                    if(respuesta==2){
                        me.llenarCamposSacerdote(datos);
                    }
                    }).catch(function (error) {
                    console.log(error);
                    });
                }
        },

        //Este método sirve para buscar si algun realizante quiere volverse a casar
        encuentraNovio(id){
            var sw=0;
            for(var i=0;i<this.arrayMatrimonio1.length;i++){
                if(this.arrayMatrimonio1[i].id_realizante1==id){
                    sw=true;
                }
            }
            /* for(var i=0;i<this.arrayMatrimonio1.length;i++){
                if(this.arrayMatrimonio1[i].id_realizante2==id){
                    sw=true;
                }
            } */
            return sw;
        },
        /* encuentraNovia(id){
            var sw=0;
            for(var i=0;i<this.arrayMatrimonio1.length;i++){
                if(this.arrayMatrimonio1[i].id_realizante2==id){
                    sw=true;
                }
            }
            return sw;
        }, */

        //No se borra este wey!!! Este si sirve :v
        registrar(){
            if(this.validarMatrimonio1()){
                return;
            }

            let me=this;
            var novioD=this.novioD;
            var noviaD=this.noviaD;
            var idNovio=this.id_realizante1;
            var idNovia=this.id_realizante2;

            if(me.encuentraNovio(me.id_realizante1)){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Uno de los dos novios ya tiene un expediente activo!',
                            })
                }else{
            if(idNovio==''){//Cuando No exista el id el novio
                if(idNovia==''){//Cuando no exista el id de la novia
                     axios.put('/persona/registrar2',{
                    'tipo':'4.1',
                    'libro':this.libro,
                    'num_expediente':this.num_expediente,
                    'novioNom': this.novioNom.toUpperCase(),
                    'novioAp': this.novioAp.toUpperCase(),
                    'novioD':this.novioD,
                    'fechana1':this.fechana1, //fecha nacimiento novio
                    'fechana2':this.fechana2, //fecha nacimiento novia
                    'idzona1':this.idzona1, //zona novio
                    'idzona2':this.idzona2, //zona novia
                    'idiglesia1':this.idiglesia1, //iglesia novio
                    'idiglesia2':this.idiglesia2, //iglesia novia
                    'noviaNom': this.noviaNom.toUpperCase(),
                    'noviaAp': this.noviaAp.toUpperCase(),
                    'noviaD':this.noviaD,
                    'monto': this.ofrendaExp,
                    'idcate':this.idcare
                    }).then(function (response) { //si todo funciona:
                        me.msjExito();
                        me.listarMatrimonio1();
                        me.cerrarModal();
                    }) .catch(function (error) {
                        console.log(error);
                    });
                }else{//Cuando si exista el id de la novia, pero No del novio
                     axios.put('/persona/registrar2',{
                    'tipo':'4.2',
                    'libro':this.libro,
                    'num_expediente':this.num_expediente,
                    'novioNom': this.novioNom.toUpperCase(),
                    'novioAp': this.novioAp.toUpperCase(),
                    'novioD':this.novioD,
                    'fechana1':this.fechana1, //fecha nacimiento novio
                    'idzona1':this.idzona1, //zona novio
                    'idiglesia1':this.idiglesia1, //iglesia novio
                    'id_realizante2':this.id_realizante2,
                    'monto': this.ofrendaExp,
                    'idcate':this.idcare
                    }).then(function (response) { //si todo funciona:
                        me.listarMatrimonio1();
                        me.cerrarModal();
                        me.msjExito();
                    }) .catch(function (error) {
                        console.log(error);
                    });
                }
            }else{//Sí existe el id del novio y...
                if(idNovia==''){//Cuando no exista el id de la novia
                     axios.put('/persona/registrar2',{
                    'tipo':'4.3',
                    'libro':this.libro,
                    'num_expediente':this.num_expediente,
                    'noviaNom': this.noviaNom.toUpperCase(),
                    'noviaAp': this.noviaAp.toUpperCase(),
                    'noviaD':this.noviaD,
                    'fechana2':this.fechana2, //fecha nacimiento novia
                    'idzona2':this.idzona2, //zona novia
                    'idiglesia2':this.idiglesia2, //iglesia novia
                    'id_realizante1':this.id_realizante1,
                    'monto': this.ofrendaExp,
                    'idcate':this.idcare
                    }).then(function (response) { //si todo funciona:
                        me.listarMatrimonio1();
                        me.cerrarModal();
                        me.msjExito();
                    }) .catch(function (error) {
                        console.log(error);
                    });
                }else{//Cuando existen ambos novios
                     axios.put('/persona/registrar2',{
                    'tipo':'4.4',
                    'libro':this.libro,
                    'num_expediente':this.num_expediente,
                    'id_realizante1':this.id_realizante1,
                    'id_realizante2':this.id_realizante2,
                    'monto': this.ofrendaExp,
                    'idcate':this.idcare
                    }).then(function (response) { //si todo funciona:
                        me.listarMatrimonio1();
                        me.cerrarModal();
                        me.msjExito();
                    }) .catch(function (error) {
                        console.log(error);
                    });
                }
            }
                }
            /* }else{ //ESTO NO SE AUN PARA QUE SIRVE, por eso lo quité
                me.guardarsacramento();
            } */
        },
        guardarsacramento(){//Aun no se para que sirve :v
            let me=this;
            var tamaño =0;
            //var length1 = this.id.length;
            axios.put('/sacramento/registrar',{
            'fecha': this.fecharealizacion,
            'realizante': this.id,
            'sacerdote':this.nombresacerdote,
            }) .then(function (response) { //si todo funciona:
                    me.cerrarModal();
                    me.listarMatrimonio1();
                }) .catch(function (error) {
                    console.log(error);
                });

        },
        
        //ESTE ES PARA ACTUALIZAR.... ESTA ES LA BASURA QUE NO SERVIA
        actualizarMatrimonio1(){//QUITAR ESTE BOTOOOOOOOOON
            if(this.validarMatrimonio1()){
                return;
            }
            
            let me = this;
            var idNovio=this.id_realizante1;
            var idNovia=this.id_realizante2;

            axios.put('/persona/actualizar2',{
                'tipo':'4',
                'libro':this.libro,
                'num_expediente':this.num_expediente,
                'novioNom': this.novioNom.toUpperCase(),
                'novioAp': this.novioAp.toUpperCase(),
                'novioD':this.novioD,
                'noviaNom': this.noviaNom.toUpperCase(),
                'noviaAp': this.noviaAp.toUpperCase(),
                'noviaD':this.noviaD,
                'id':this.sacramento_id,
                'id_realizante1':this.id_realizante1,
                'id_realizante2':this.id_realizante2,
                'fechana1':this.fechana1, //fecha nacimiento novio
                'fechana2':this.fechana2, //fecha nacimiento novia
                'idzona1':this.idzona1, //zona novio
                'idzona2':this.idzona2, //zona novia
                'idiglesia1':this.idiglesia1, //iglesia novio
                'idiglesia2':this.idiglesia2, //iglesia novia
            }) .then(function (response) { //si todo funciona:
                me.listarMatrimonio1();
                me.cerrarModal();
                me.msjExito();
            }) .catch(function (error) {
                console.log(error);
            });
        },

        registrarBoda(){
            if(this.validarModal3()){
                return;
            }

            let me=this;
            var sacerdoteD=this.sacerdoteD;
            var pad1D=this.pad1D;
            var mad1D=this.mad1D;
            var pad2D=this.pad2D;
            var mad2D=this.mad2D;
            var id_sacerdote=this.id_sacerdote;
            var cargosacerdote=this.cargosacerdote;
            var id_padrino1=this.id_padrino1;
            var id_madrina1=this.id_madrina1;
            var id_padrino2=this.id_padrino2;
            var id_madrina2=this.id_madrina2;
            var fecha_realizacion=this.fecha_realizacion;
            var id_iglesia=this.id_iglesia;

            if(mad2D==''){
                if(pad2D==''){
                    if(mad1D==''){//guardar 1 padrino

                        if(id_padrino1==''){
                            //creamos el pad1
                            this.tipo=1;
                        }else{
                            //recuperamos el pad1
                            this.tipo=2;
                        }
                        //GUARDAR EN BASE SOLO 1 PADRINO
                        axios.put('/sacramento/registrarboda',{
                            'tipo':this.tipo,
                            'id':this.sacramento_id,
                            'fecha_realizacion':this.fecha_realizacion,
                            'id_iglesia':this.id_iglesia,
                            'pad1Nom': this.pad1Nom.toUpperCase(),
                            'pad1Ap': this.pad1Ap.toUpperCase(),
                            'pad1D':this.pad1D,
                            'pad1Sexo':this.pad1Sexo,
                            'id_sacerdote':this.idsacerdote,
                            'titulo':this.cargosacerdote,
                            'id_padrino1':this.id_padrino1,
                            'monto': this.monto,
                            'idcate':this.idcare,
                            'idzonap1':this.idzonap1, //zona padrino 1
                            'idiglesiap1':this.idiglesiap1, //iglesia padrino 1
                            'fechanap1':this.fechanap1, //fecha nacimiento padrino 1
                        }).then(function (response) { //si todo funciona:
                            me.listarMatrimonio1();
                            me.cerrarModal3();
                            me.msjExito();
                        }) .catch(function (error) {
                            console.log(error);
                        });

                    }else{//guardar 2 padrinos

                        if(id_madrina1==''){
                            if(id_padrino1==''){
                                //creamos mad1 y pad1
                                this.tipo=3;
                            }else{
                                //creamos mad1 y recuperamos pad1
                                this.tipo=4;
                            }
                        }else{
                            if(id_padrino1==''){
                                //creamos pad1 y recuperamos mad1
                                this.tipo=5;
                            }else{
                                //recuperamos pad1 y mad1
                                this.tipo=6;
                            }
                        }
                        //GUARDAR EN BASE SOLO 2 PADRINOS
                        axios.put('/sacramento/registrarboda',{
                            'tipo':this.tipo,
                            'id':this.sacramento_id,
                            'fecha_realizacion':this.fecha_realizacion,
                            'id_iglesia':this.id_iglesia,
                            'pad1Nom': this.pad1Nom.toUpperCase(),
                            'pad1Ap': this.pad1Ap.toUpperCase(),
                            'pad1D':this.pad1D,
                            'pad1Sexo':this.pad1Sexo,
                            'mad1Nom': this.mad1Nom.toUpperCase(),
                            'mad1Ap': this.mad1Ap.toUpperCase(),
                            'mad1D':this.mad1D,
                            'mad1Sexo':this.mad1Sexo,
                            'id_sacerdote':this.idsacerdote,
                            'titulo':this.cargosacerdote,
                            'id_padrino1':this.id_padrino1,
                            'id_madrina1':this.id_madrina1,
                            'monto': this.monto,
                            'idcate':this.idcare,
                            'idzonap1':this.idzonap1, //zona padrino 1
                            'idzonap2':this.idzonap2, //zona padrino 2
                            'idiglesiap1':this.idiglesiap1, //iglesia padrino 1
                            'idiglesiap2':this.idiglesiap2, //iglesia padrino 2
                            'fechanap1':this.fechanap1, //fecha nacimiento padrino 1
                            'fechanap2':this.fechanap2, //fecha nacimiento padrino 2
                        }).then(function (response) { //si todo funciona:
                            me.listarMatrimonio1();
                            me.cerrarModal3();
                            me.msjExito();
                        }) .catch(function (error) {
                            console.log(error);
                        });

                    }
                }else{//guardar 3 padrinos

                    if(id_padrino2==''){
                        if(id_madrina1==''){
                            if(id_padrino1==''){
                                //creamos mad1, pad1 y pad2
                                this.tipo=7;
                            }else{
                                //creamos mad1 y pad2; recuperamos pad1
                                this.tipo=8;
                            }
                        }else{
                            if(id_padrino1==''){
                                //creamos pad1 y pad2; recuperamos mad1
                                this.tipo=9;
                            }else{
                                //creamos pad2; recuperamos pad1 y mad1
                                this.tipo=10;
                            }
                        }
                    }else{
                        if(id_madrina1==''){
                            if(id_padrino1==''){
                                //creamos mad1 y pad1; recuperamos pad2
                                this.tipo=11;
                            }else{
                                //creamos mad1; recuperamos pad1 y pad2
                                this.tipo=12;
                            }
                        }else{
                            if(id_padrino1==''){
                                //creamos pad1; recuperamos mad1 y pad2
                                this.tipo=13;
                            }else{
                                //recuperamos pad1, pad2 y mad1
                                this.tipo=14;
                            }
                        }
                    }
                    //GUARDAR EN BASE SOLO 3 PADRINOS
                    axios.put('/sacramento/registrarboda',{
                        'tipo':this.tipo,
                        'id':this.sacramento_id,
                        'fecha_realizacion':this.fecha_realizacion,
                        'id_iglesia':this.id_iglesia,
                        'pad1Nom': this.pad1Nom.toUpperCase(),
                        'pad1Ap': this.pad1Ap.toUpperCase(),
                        'pad1D':this.pad1D,
                        'pad1Sexo':this.pad1Sexo,
                        'mad1Nom': this.mad1Nom.toUpperCase(),
                        'mad1Ap': this.mad1Ap.toUpperCase(),
                        'mad1D':this.mad1D,
                        'mad1Sexo':this.mad1Sexo,
                        'pad2Nom': this.pad2Nom.toUpperCase(),
                        'pad2Ap': this.pad2Ap.toUpperCase(),
                        'pad2D':this.pad2D,
                        'pad2Sexo':this.pad2Sexo,
                        'id_sacerdote':this.idsacerdote,
                        'titulo':this.cargosacerdote,
                        'id_padrino1':this.id_padrino1,
                        'id_madrina1':this.id_madrina1,
                        'id_padrino2':this.id_padrino2,
                        'monto': this.monto,
                        'idcate':this.idcare,
                        'idzonap1':this.idzonap1, //zona padrino 1
                        'idzonap2':this.idzonap2, //zona padrino 2
                        'idzonap3':this.idzonap3, //zona padrino 3
                        'idiglesiap1':this.idiglesiap1, //iglesia padrino 1
                        'idiglesiap2':this.idiglesiap2, //iglesia padrino 2
                        'idiglesiap3':this.idiglesiap3, //iglesia padrino 3
                        'fechanap1':this.fechanap1, //fecha nacimiento padrino 1
                        'fechanap2':this.fechanap2, //fecha nacimiento padrino 2
                        'fechanap3':this.fechanap3, //fecha nacimiento padrino 3
                    }).then(function (response) { //si todo funciona:
                        me.listarMatrimonio1();
                        me.cerrarModal3();
                        me.msjExito();
                    }) .catch(function (error) {
                        console.log(error);
                    });

                }

            }else{//guardar 4 padrinos
                if(id_madrina2==''){
                    if(id_padrino2==''){
                        if(id_madrina1==''){
                            if(id_padrino1==''){
                                //creamos los 4
                                this.tipo=15;
                            }else{
                                // Recuperamos pad1, creamos los otros 3
                                this.tipo=16;
                            }
                        }else{
                            if(id_padrino1==''){
                                //Recuperaremos madrina1; crearemos los otros 3
                                this.tipo=17;
                            }else{
                                //recuperaremos madrina 1 y padrino 1; Y creamos los otros 2
                                this.tipo=18;
                            }
                        }
                    }else{
                        if(id_madrina1==''){
                            if(id_padrino1==''){
                                //Solo , padrino2 y creamos los otros 3
                                this.tipo=19;
                            }else{
                                //, padrino1 y padrino2; creamos los otros 2
                                this.tipo=20;
                            }
                        }else{
                            if(id_padrino1==''){
                                //, madrina1 y padrino2; creamos los otros 2
                                this.tipo=21;
                            }else{
                                //recuperaremos id del sacerdote, pad1, pad2 y mad1; creamos el otro
                                this.tipo=22;
                            }
                        }
                    }
                }else{
                    if(id_padrino2==''){
                        if(id_madrina1==''){
                            if(id_padrino1==''){
                                //Recuperamos id sacerdote y madrina2; Creamos los otros 3
                                this.tipo=23;
                            }else{
                                //, padrino1 y madrina2; Creamos los otros 2
                                this.tipo=24;
                            }
                        }else{
                            if(id_padrino1==''){
                                //Recuperamos id sacerdote, madrina1 y madrina2; creamos los otros 2
                                this.tipo=25;
                            }else{
                                //recuperaremos mad1, mad2 y pad1; creamos el otro
                                this.tipo=26;
                            }
                        }
                    }else{
                        if(id_madrina1==''){
                            if(id_padrino1==''){
                                //, madrina2 y padrino2; creamos los otros2
                                this.tipo=27;
                            }else{
                                //, madrina2, padrino1 y padrino2; creamos el otro
                                this.tipo=28;
                            }
                        }else{
                            if(id_padrino1==''){
                                //, madrina1, madrina2 y padrino2; creamos el otro
                                this.tipo=29;
                            }else{
                                //recuperaremos TODOS PORQUE YA EXISTEN
                                this.tipo=30;
                            }
                        }
                    }
                }
                //GUARDAR EN BASE LOS 4 PADRINOS
                axios.put('/sacramento/registrarboda',{
                    'tipo':this.tipo,
                    'id':this.sacramento_id,
                    'fecha_realizacion':this.fecha_realizacion,
                    'id_iglesia':this.id_iglesia,
                    'pad1Nom': this.pad1Nom.toUpperCase(),
                    'pad1Ap': this.pad1Ap.toUpperCase(),
                    'pad1D':this.pad1D,
                    'pad1Sexo':this.pad1Sexo,
                    'mad1Nom': this.mad1Nom.toUpperCase(),
                    'mad1Ap': this.mad1Ap.toUpperCase(),
                    'mad1D':this.mad1D,
                    'mad1Sexo':this.mad1Sexo,
                    'pad2Nom': this.pad2Nom.toUpperCase(),
                    'pad2Ap': this.pad2Ap.toUpperCase(),
                    'pad2D':this.pad2D,
                    'pad2Sexo':this.pad2Sexo,
                    'mad2Nom': this.mad2Nom.toUpperCase(),
                    'mad2Ap': this.mad2Ap.toUpperCase(),
                    'mad2D':this.mad2D,
                    'mad2Sexo':this.mad2Sexo,
                    'id_sacerdote':this.idsacerdote,
                    'titulo':this.cargosacerdote,
                    'id_padrino1':this.id_padrino1,
                    'id_madrina1':this.id_madrina1,
                    'id_padrino2':this.id_padrino2,
                    'id_madrina2':this.id_madrina2,
                    'idzonap1':this.idzonap1, //zona padrino 1
                    'idzonap2':this.idzonap2, //zona padrino 2
                    'idzonap3':this.idzonap3, //zona padrino 3
                    'idzonap4':this.idzonap4, //zona padrino 4
                    'idiglesiap1':this.idiglesiap1, //iglesia padrino 1
                    'idiglesiap2':this.idiglesiap2, //iglesia padrino 2
                    'idiglesiap3':this.idiglesiap3, //iglesia padrino 3
                    'idiglesiap4':this.idiglesiap4, //iglesia padrino 4
                    'fechanap1':this.fechanap1, //fecha nacimiento padrino 1
                    'fechanap2':this.fechanap2, //fecha nacimiento padrino 2
                    'fechanap3':this.fechanap3, //fecha nacimiento padrino 3
                    'fechanap4':this.fechanap4, //fecha nacimiento padrino 4
                    'monto': this.monto,
                    'idcate':this.idcare
                }).then(function (response) { //si todo funciona:
                    me.listarMatrimonio1();
                    me.cerrarModal3();
                    me.msjExito();
                }) .catch(function (error) {
                    console.log(error);
                });
            }//fin del else (caso que están todos los padrinos)
            me.cerrarModal3();
        },

        //este lo ocupa el método Registrar
        validarMatrimonio1(){
            this.errorMatrimonio1=0;
            this.errorMostrarMsjMatrimonio1=[];
            var patron =/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
            var patrondui= /^\d{9}$/;
            var soloIntPositivo= /^\d*$/;
            var decimales= /^\d+(\.\d{0,2})?$/;
            //Comprueba que las celdas no estén vacías

            if (this.libro =='' || this.num_expediente ==''){
                this.errorMostrarMsjMatrimonio1.push("Los campos del Libro y Expediente son obligatorios");
            } else{
                if(!soloIntPositivo.test(this.libro) || !soloIntPositivo.test(this.num_expediente))this.errorMostrarMsjMatrimonio1.push("En libro y número de expediente solo se permiten números enteros positivos");
            }           
            if(this.novioD =='' || this.noviaD=='' ){
                this.errorMostrarMsjMatrimonio1.push("Los Documentos de identidad de la novia y el novio son obligatorios");
            }
            if(this.novioAp=='' ||  this.novioNom=='' || this.noviaNom=='' || this.noviaAp==''){
                this.errorMostrarMsjMatrimonio1.push("Debe escribir los nombres completos del novio y la novia");
            }else{
                if(!patron.test(this.novioNom) || !patron.test(this.novioAp))this.errorMostrarMsjMatrimonio1.push("Los datos del novio deben contener letras solamente");
                if(!patron.test(this.noviaNom) || !patron.test(this.noviaAp))this.errorMostrarMsjMatrimonio1.push("Los datos de la novia debe contener letras solamente");
            }
            if(this.ofrendaExp==''){
                this.errorMostrarMsjMatrimonio1.push("La Ofrenda por Apertura de Expediente es obligatoria");
            }else{
                if(!decimales.test(this.ofrendaExp))this.errorMostrarMsjMatrimonio1.push("La ofrenda debe de ser un número positivo");
            }

            if(!this.fechana1 || !this.fechana2){
                this.errorMostrarMsjMatrimonio1.push("La fecha de nacimiento del novio y la novia es obligatoria");
            }else{

            var fecha = new Date();
            var actualYear = fecha.getFullYear();
            var actualMes = fecha.getMonth();
            var values1 = this.fechana1.split("-");
            var anio1 = values1[0];

            var values2 = this.fechana2.split("-");
            var anio2 = values2[0];

                                if(anio1 < 1900)this.errorMostrarMsjMatrimonio1.push("La fecha nacimiento del novio debe ser mayor a 1900");
                                if((actualYear)<anio1)this.errorMostrarMsjMatrimonio1.push("El año de nacimiento del novio debe ser menor a " + (actualYear));

                                if(anio2 < 1900)this.errorMostrarMsjMatrimonio1.push("La fecha nacimiento de la novia debe ser mayor a 1900");
                                if((actualYear)<anio2)this.errorMostrarMsjMatrimonio1.push("El año de nacimiento de la novia debe ser menor a " + (actualYear));
            }
             if(this.idcare==0)this.errorMostrarMsjMatrimonio1.push("Debe elegir una categoría");                           
                                    
            /*else{
                
                //if(!patrondui.test(this.novioD) || !patrondui.test(this.noviaD))this.errorMostrarMsjMatrimonio1.push("Error, El dui debe contener 9 números");
                
                
               
            }*/

            if (this.errorMostrarMsjMatrimonio1.length) this.errorMatrimonio1 = 1;

            return this.errorMatrimonio1;
        },

        //este es para el modal 2 (fecha de realización y lugar)
        validarModal2(){
            this.errorModal2=0;
            this.errorMostrarMsjModal2=[];

            var fecha = new Date();
            var actualYear = fecha.getFullYear();
            var actualMes = fecha.getMonth();
            var values = this.fecha_realizacion.split("-");
            var anio = values[0];

            if(!this.fecha_realizacion){
                this.errorMostrarMsjModal2.push("Seleccione la fecha de realización");
            }else{
                if(anio < 1989)this.errorMostrarMsjModal2.push("El año debe de ser mayor a 1989");
                if((actualYear+1)<anio)this.errorMostrarMsjModal2.push("El año debe ser menor o igual al " + (actualYear+1));
            }
            if(this.id_iglesia==0) this.errorMostrarMsjModal2.push("Seleccione una iglesia");
            if(this.idsacerdote==0) this.errorMostrarMsjModal2.push("Seleccione el encargado de la ceremonia");
            if(this.cargosacerdote==0) this.errorMostrarMsjModal2.push("Seleccione el cargo del encargado");

            if (this.errorMostrarMsjModal2.length) this.errorModal2 = 1;

            return this.errorModal2;
        },

        //este es para el modal 3 (datos de los padrinos y cobro)
        validarModal3(){
            this.errorModal3=0;
            this.errorMostrarMsjModal3=[];
            var patron =/^[a-zA-ZÑñÁáÉéÍíÓóÚúÜü\s]+$/;
            var patrondui= /^\d{9}$/;
            //var soloIntPositivo= /^\d*$/;
            var decimales= /^\d+(\.\d{0,2})?$/;

            var fecha = new Date();
            var actualYear = fecha.getFullYear();
            var actualMes = fecha.getMonth();

            var values1 = this.fechanap1.split("-");
            var aniop1 = values1[0];

            var values2 = this.fechanap2.split("-");
            var aniop2 = values2[0];

            var values3 = this.fechanap3.split("-");
            var aniop3 = values3[0];

            var values4 = this.fechanap4.split("-");
            var aniop4 = values4[0];

            //Esta súpervalidación ayuda a que sea imposible para el usuario dejar "padrinos en blanco"... así solo podrá ingresarlos en orden
            if(!this.pad1D || !this.pad1Nom || !this.pad1Ap || this.pad1Sexo==0 || !this.fechanap1){
                this.errorMostrarMsjModal3.push("Complete los campos de documento de identidad, nombre, apellido, fecha de nacimiento y sexo de la persona 1");
            }else{
                if(!patron.test(this.pad1Nom) || !patron.test(this.pad1Ap)) this.errorMostrarMsjModal3.push("Los datos de la persona 1 debe contener letras solamente");
                if(aniop1 < 1900)this.errorMostrarMsjModal3.push("La fecha nacimiento de la persona 1 debe ser mayor a 1900");
                if((actualYear)<aniop1)this.errorMostrarMsjModal3.push("El año de nacimiento de la persona 1 debe ser menor a " + (actualYear));
                //if(!patrondui.test(this.pad1D))this.errorMostrarMsjModal3.push("Error, El dui de la persona 1 debe contener 9 números");

                if(!(!this.mad1D && !this.mad1Nom && !this.mad1Ap && this.mad1Sexo==0 && !this.fechanap2 && 
                   !this.pad2D && !this.pad2Nom && !this.pad2Ap && this.pad2Sexo==0 && !this.fechanap3 &&
                   !this.mad2D && !this.mad2Nom && !this.mad2Ap && this.mad2Sexo==0 && !this.fechanap4)){

                    if(!this.mad1D || !this.mad1Nom || !this.mad1Ap || this.mad1Sexo==0 || !this.fechanap2){
                        this.errorMostrarMsjModal3.push("Complete los campos de documento de identidad, nombre, apellido, fecha de nacimiento y sexo de la persona 2");
                    }else{
                        if(!patron.test(this.mad1Nom) || !patron.test(this.mad1Ap)) this.errorMostrarMsjModal3.push("Los datos de la persona 2 debe contener letras solamente");
                        //if(!patrondui.test(this.mad1D))this.errorMostrarMsjModal3.push("Error, El dui de la persona 2 debe contener 9 números");
                        if(aniop2 < 1900)this.errorMostrarMsjModal3.push("La fecha nacimiento de la persona 2 debe ser mayor a 1900");
                        if((actualYear)<aniop2)this.errorMostrarMsjModal3.push("El año de nacimiento de la persona 2 debe ser menor a " + (actualYear));

                        if(!(!this.pad2D && !this.pad2Nom && !this.pad2Ap && this.pad2Sexo==0 && !this.fechanap3 &&
                        !this.mad2D && !this.mad2Nom && !this.mad2Ap && this.mad2Sexo==0 && !this.fechanap4)){

                            if(!this.pad2D || !this.pad2Nom || !this.pad2Ap || this.pad2Sexo==0 || !this.fechanap3 ){
                                this.errorMostrarMsjModal3.push("Complete los campos de documento de identidad, nombre, apellido, fecha de nacimiento y sexo de la persona 3");
                            }else{
                                if(!patron.test(this.pad2Nom) || !patron.test(this.pad2Ap)) this.errorMostrarMsjModal3.push("Los datos de la persona 3 debe contener letras solamente");
                                if(aniop3 < 1900)this.errorMostrarMsjModal3.push("La fecha nacimiento de la persona 3 debe ser mayor a 1900");
                                if((actualYear)<aniop3)this.errorMostrarMsjModal3.push("El año de nacimiento de la persona 3 debe ser menor a " + (actualYear));
                                //if(!patrondui.test(this.pad2D))this.errorMostrarMsjModal3.push("Error, El dui de la persona 3 debe contener 9 números");

                                if(!(!this.mad2D && !this.mad2Nom && !this.mad2Ap && this.mad2Sexo==0 && !this.fechanap4)){
                                    if(!this.mad2D || !this.mad2Nom || !this.mad2Ap || this.mad2Sexo==0 || !this.fechanap4){
                                        this.errorMostrarMsjModal3.push("Complete los campos de documento de identidad, nombre, apellido, fecha de nacimiento y sexo de la persona 4");
                                    }else{
                                        if(!patron.test(this.mad2Nom) || !patron.test(this.mad2Ap)) this.errorMostrarMsjModal3.push("Los datos de la persona 4 debe contener letras solamente");
                                        if(aniop4 < 1900)this.errorMostrarMsjModal3.push("La fecha nacimiento de la persona 4 debe ser mayor a 1900");
                                        if((actualYear)<aniop4)this.errorMostrarMsjModal3.push("El año de nacimiento de la persona 4 debe ser menor a " + (actualYear));
                                        //if(!patrondui.test(this.mad2D))this.errorMostrarMsjModal3.push("Error, El dui de la persona 4 debe contener 9 números");
                                    }
                                }
                            }
                        }
                    }
                }
            }
            
            if(this.monto==""){
                this.errorMostrarMsjModal3.push("Por favor ingrese la ofrenda por realización del matrimonio");
            }else{
                if(!decimales.test(this.monto)) this.errorMostrarMsjModal3.push("La ofrenda debe de ser un número positivo");
                
                if(this.idcare==0) this.errorMostrarMsjModal3.push("Seleccione una Categoría");
            }
            //falta validar para que solo sean números
            if (this.errorMostrarMsjModal3.length) this.errorModal3 = 1;

            return this.errorModal3;
        },

        validarModal4(){
            this.errorModal4=0;
            this.errorMostrarMsjModal4=[];
            var RE = /^\d*(\.\d{1})?\d{0,1}$/;
            this.conceptoim;
            this.montoConstancia;

            //if(this.cobrado!=true)this.errorMostrarMsjModal4.push("Debe cobrar la solicitud de la constancia de confirma");
            if(this.conceptoim=='')this.errorMostrarMsjModal4.push("El campo de motivo del certificado no puede estar vacio");
            if(this.idperso=='')this.errorMostrarMsjModal4.push("Debe elegir al Padre que firmará el certificado");
            if(this.cargoim=='')this.errorMostrarMsjModal4.push("Debe elegir el cargo del padre que firmará el certificado");
             if(this.montoConstancia ==''){
                    this.errorMostrarMsjModal4.push("Debe cobrar el certificado");
                }if(!RE.test(this.montoConstancia))this.errorMostrarMsjModal4.push("La ofrenda por certificados solo puede ser decimales");

            if (this.errorMostrarMsjModal4.length) this.errorModal4 = 1;

            return this.errorModal4;
        },

        //Este cambia de un modal a otro (adelante y atras)
        siguiente(d){
                switch(d){
                    case '1':
                        {
                            if(this.validarModal2()){
                                return;
                            }

                            this.modal3=1;
                            this.modal2=0;
                            break;
                        }
                    case '2':
                        {
                            this.modal2=1;
                            this.modal3=0;
                            break;
                        }
                }
        },
        //este cierra el modal del lapiz
        cerrarModal(){
            this.modal=0;
            this.tituloModal='';
            this.tipoAccion='';
            this.sacramento_id='';
            this.libro ='';
            this.num_expediente ='';
            this.id_realizante1 ='';
            this.id_realizante2 ='';
            this.novioD='';
            this.novioNom='';
            this.novioAp='';
            this.noviaD='';
            this.noviaNom='';
            this.noviaAp='';
            this.ofrendaExp='';
            this.idcare=0;
            this.errorMatrimonio1=0;
            this.errorMostrarMsjMatrimonio1=[];
            this.fechana1=''; //fecha nacimiento novio
            this.fechana2=''; //fecha nacimiento novia
            this.idzona1=''; //zona novio
            this.idzona2=''; //zona novia
            this.idiglesia1=''; //iglesia novio
            this.idiglesia2=''; //iglesia novia

        },
        //estos dos, cierran los modales de paso 2 y paso3
        cerrarModal2(){
            this.modal2=0;
            this.modal3=0;
            this.tituloModal='';
            this.sacramento_id='';
            this.fecha_realizacion ='';
            this.id_iglesia=0;
            this.idsacerdote=0;
            this.cargosacerdote=0;
            this.id_padrino1 ='';
            this.id_madrina1 ='';
            this.id_padrino2 ='';
            this.id_madrina2 ='';
            this.pad1D='';
            this.pad1Nom='';
            this.pad1Ap='';
            this.pad1Sexo=0;
            this.mad1D='';
            this.mad1Nom='';
            this.mad1Ap='';
            this.mad1Sexo=0;
            this.pad2D='';
            this.pad2Nom='';
            this.pad2Ap='';
            this.pad2Sexo=0;
            this.mad2D='';
            this.mad2Nom='';
            this.mad2Ap='';
            this.mad2Sexo=0;
            this.monto='';
            this.tipo=0;
            this.idcare=0;
            this.errorModal2=0;
            this.errorMostrarMsjModal2=[];
            this.idzonap1=''; //zona p1
            this.idzonap2=''; //zona p2
            this.idzonap3=''; //zona p3
            this.idzonap4=''; //zona p4
            this.idiglesiap1=''; //iglesia p1
            this.idiglesiap2=''; //iglesia p2
            this.idiglesiap3=''; //iglesia p3
            this.idiglesiap4=''; //iglesia p4
            this.fechanap1=''; //fecha nacimiento p1
            this.fechanap2=''; //fecha nacimiento p2
            this.fechanap3=''; //fecha nacimiento p3
            this.fechanap4=''; //fecha nacimiento p4

        },
        cerrarModal3(){
            this.modal2=0;
            this.modal3=0;
            this.tituloModal='';
            this.sacramento_id='';
            this.fecha_realizacion ='';
            this.id_iglesia=0;
            this.idsacerdote=0;
            this.cargosacerdote=0;
            this.id_padrino1 ='';
            this.id_madrina1 ='';
            this.id_padrino2 ='';
            this.id_madrina2 ='';
            this.pad1D='';
            this.pad1Nom='';
            this.pad1Ap='';
            this.pad1Sexo=0;
            this.mad1D='';
            this.mad1Nom='';
            this.mad1Ap='';
            this.mad1Sexo=0;
            this.pad2D='';
            this.pad2Nom='';
            this.pad2Ap='';
            this.pad2Sexo=0;
            this.mad2D='';
            this.mad2Nom='';
            this.mad2Ap='';
            this.mad2Sexo=0;
            this.monto='';
            this.tipo=0;
            this.idcare=0;
            this.errorModal3=0;
            this.errorMostrarMsjModal3=[];
            this.idzonap1=''; //zona p1
            this.idzonap2=''; //zona p2
            this.idzonap3=''; //zona p3
            this.idzonap4=''; //zona p4
            this.idiglesiap1=''; //iglesia p1
            this.idiglesiap2=''; //iglesia p2
            this.idiglesiap3=''; //iglesia p3
            this.idiglesiap4=''; //iglesia p4
            this.fechanap1=''; //fecha nacimiento p1
            this.fechanap2=''; //fecha nacimiento p2
            this.fechanap3=''; //fecha nacimiento p3
            this.fechanap4=''; //fecha nacimiento p4
        },

        cerrarModal4(){
            this.modal4=0;
            this.tituloModal='';
            this.sacramento_id='';
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

        //En "modelo" va el nombre de la tabla guardada aquí, que por convencion de laravel es plural: "modelos"
        abrirModal(modelo, accion, data = []){
            switch (modelo) {
                case "sacramento":
                    switch (accion) {
                        case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Expediente Matrimonial';
                                this.libro ='';
                                this.num_expediente ='';
                                this.novioD='';
                                this.novioNom='';
                                this.novioAp='';
                                this.noviaD='';
                                this.noviaNom='';
                                this.noviaAp='';
                                this.fechana1='', //fecha nacimiento novio
                                this.fechana2='', //fecha nacimiento novia
                                this.idzona1='', //zona novio
                                this.idzona2='', //zona novia
                                this.idiglesia1='', //iglesia novio
                                this.idiglesia2='', //iglesia novia
                                this.tipoAccion = 1;
                                break;
                            }
                        case 'actualizar':
                            {
                                this.modal=1;
                                this.tituloModal= 'Actualizar Expediente Matrimonial';
                                this.tipoAccion=2;
                                this.sacramento_id=data['id'];
                                this.libro = data['libro'];
                                this.num_expediente = data['num_expediente'];
                                this.id_realizante1 = data['idNovio'];
                                this.id_realizante2 = data['idNovia'];
                                this.novioD=data['novioD'];
                                this.novioNom=data['novioNom'];
                                this.novioAp=data['novioAp'];
                                this.noviaD=data['noviaD'];
                                this.noviaNom=data['noviaNom'];
                                this.noviaAp=data['noviaAp'];
                                this.fechana1=data['fechana1']; //fecha nacimiento novio  AQUI
                                this.fechana2=data['fechana2']; //fecha nacimiento novia
                                this.idzona1=data['idzona1']; //zona novio
                                this.idzona2=data['idzona2']; //zona novia
                                this.idiglesia1=data['idiglesia1']; //iglesia novio
                                this.idiglesia2=data['idiglesia2']; //iglesia novia

                                if(this.idzona1!=null){
                                this.iglesias1(this.idzona1);
                                this.idiglesia1=data['idiglesia'];
                                }

                                if(this.idzona2){
                                this.iglesias2(this.idzona2);
                                this.idiglesia2=data['idiglesia'];
                                }

                                break;
                            }
                    }
            }
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

        //autocompletar iglesias
        llenadolistaiglesia(buscar,criterio){
            let me=this;
            var url='/persona/buscariglesia';
            axios.get(url) .then(function (response) {
                me.arrayiglesia=response.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        },

        //autocompletar sacerdotes
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

        //Aquí comienza el modal del paso 2: Agregar lugar y fecha de boda, sacerdote encargado y...
        abrirModal2(modelo, accion, data = []){
            switch (modelo) {
                case "sacramento":
                    switch (accion) {
                        case 'paso2':
                            {
                                this.modal2 = 1;
                                var apellidoNovioArray=apellidoNovioArray=data['novioAp'].split(' ');//la función split crea un array donde separa la cadena por ' '
                                var apellidoNoviaArray=apellidoNoviaArray=data['noviaAp'].split(' ');//Luego tomamos del array el primer apellido que está en la posición 0
                                var apellidoNovioMostrar='';
                                var apellidoNoviaMostrar='';
                                //Este IF valida los casos de los apellidos con "de, la, del"
                                if (apellidoNovioArray[0]=='DE' || apellidoNovioArray[0]=='LA' || apellidoNovioArray[0]=='DEL'){
                                    if (apellidoNovioArray[1]=='LA' || apellidoNovioArray[1]=='LOS'){
                                        apellidoNovioMostrar=apellidoNovioArray[0] + ' ' + apellidoNovioArray[1] + ' ' + apellidoNovioArray[2];
                                    }
                                    else{
                                        apellidoNovioMostrar=apellidoNovioArray[0] + ' ' + apellidoNovioArray[1];
                                    }
                                }else{
                                    apellidoNovioMostrar=apellidoNovioArray[0];
                                }
                                //el mismo caso anterior, para la novia
                                if (apellidoNoviaArray[0]=='DE' || apellidoNoviaArray[0]=='LA' || apellidoNoviaArray[0]=='DEL'){
                                    if (apellidoNoviaArray[1]=='LA' || apellidoNoviaArray[1]=='LOS'){
                                        apellidoNoviaMostrar=apellidoNoviaArray[0] + ' ' + apellidoNoviaArray[1] + ' ' + apellidoNoviaArray[2];
                                    }
                                    else{
                                        apellidoNoviaMostrar=apellidoNoviaArray[0] + ' ' + apellidoNoviaArray[1];
                                    }
                                }else{
                                    apellidoNoviaMostrar=apellidoNoviaArray[0];
                                }
                                this.tituloModal ='Datos de boda: ' + apellidoNovioMostrar + ' - ' + apellidoNoviaMostrar;
                                this.sacramento_id=data['id'];
                                this.fecha_realizacion ='';
                                this.iglesiaNom =''; //Conviene más poner un combobox
                                this.idsacerdote =0;
                                this.cargosacerdote=0;
                                this.sacerdoteD='';
                                this.sacerdoteNom='';
                                this.sacerdoteAp='';
                                this.id_iglesia =0;
                                //botones matrimonio realizado / Cancelado
                                this.tipoAccion = 3;
                                break;
                            }
                        case 'paso3':
                            {
                                this.modal3 = 1;
                                this.tituloModal = 'Datos de los padrinos';
                                this.sacramento_id=data['id'];
                                this.id_padrino ='';
                                this.pad1D='';
                                this.pad1Nom='';
                                this.pad1Ap='';
                                this.id_madrina1 ='';
                                this.mad1D='';
                                this.mad1Nom='';
                                this.mad1Ap='';
                                this.id_padrino2 ='';
                                this.pad2D='';
                                this.pad2Nom='';
                                this.pad2Ap='';
                                this.id_madrina2 ='';
                                this.mad2D='';
                                this.mad2Nom='';
                                this.mad2Ap='';
                                this.idzonap1=''; //zona p1
                                this.idzonap2=''; //zona p2
                                this.idzonap3=''; //zona p3
                                this.idzonap4=''; //zona p4
                                this.idiglesiap1=''; //iglesia p1
                                this.idiglesiap2=''; //iglesia p2
                                this.idiglesiap3=''; //iglesia p3
                                this.idiglesiap4=''; //iglesia p4
                                this.fechanap1=''; //fecha nacimiento p1
                                this.fechanap2=''; //fecha nacimiento p2
                                this.fechanap3=''; //fecha nacimiento p3
                                this.fechanap4=''; //fecha nacimiento p4
                        //botones matrimonio realizado / Cancelado
                                this.tipoAccion = 3;
                                break;
                            }
                        case 'paso4':
                            {
                                this.modal4 = 1;
                                var apellidoNovioArray=apellidoNovioArray=data['novioAp'].split(' ');//la función split crea un array donde separa la cadena por ' '
                                var apellidoNoviaArray=apellidoNoviaArray=data['noviaAp'].split(' ');//Luego tomamos del array el primer apellido que está en la posición 0
                                var apellidoNovioMostrar='';
                                var apellidoNoviaMostrar='';
                                //Este IF valida los casos de los apellidos con "de, la, del"
                                if (apellidoNovioArray[0]=='DE' || apellidoNovioArray[0]=='LA' || apellidoNovioArray[0]=='DEL'){
                                    if (apellidoNovioArray[1]=='LA' || apellidoNovioArray[1]=='LOS'){
                                        apellidoNovioMostrar=apellidoNovioArray[0] + ' ' + apellidoNovioArray[1] + ' ' + apellidoNovioArray[2];
                                    }
                                    else{
                                        apellidoNovioMostrar=apellidoNovioArray[0] + ' ' + apellidoNovioArray[1];
                                    }
                                }else{
                                    apellidoNovioMostrar=apellidoNovioArray[0];
                                }
                                //el mismo caso anterior, para la novia
                                if (apellidoNoviaArray[0]=='DE' || apellidoNoviaArray[0]=='LA' || apellidoNoviaArray[0]=='DEL'){
                                    if (apellidoNoviaArray[1]=='LA' || apellidoNoviaArray[1]=='LOS'){
                                        apellidoNoviaMostrar=apellidoNoviaArray[0] + ' ' + apellidoNoviaArray[1] + ' ' + apellidoNoviaArray[2];
                                    }
                                    else{
                                        apellidoNoviaMostrar=apellidoNoviaArray[0] + ' ' + apellidoNoviaArray[1];
                                    }
                                }else{
                                    apellidoNoviaMostrar=apellidoNoviaArray[0];
                                }
                                this.tituloModal ='Imprimir constancia de boda: ' + apellidoNovioMostrar + ' - ' + apellidoNoviaMostrar;
                                this.sacramento_id=data['id'];
                                this.idperso='';
                                this.cargoim='';
                                this.conceptoim='';
                                this.idcare='';
                                this.montoConstancia='';
                                break;
                            }
                    }
            }
        },

        msjExito(){
            swal({
                type: 'success',
                title: 'Datos guardados con éxito',
                showConfirmButton: false,
                timer: 1500
            })
        },

        //el metodo del botón del basurero
        desactivarExpediente(id){
            swal({
            title: '¿Esta seguro de desactivar este expediente?',
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

                axios.put('/sacramento/desactivarexpediente',{
                    'id': id
                }).then(function (response) {
                    me.listarMatrimonio1(1,'','libro');
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
        //activa el expediente :v
        activarExpediente(id){
            swal({
            title: '¿Esta seguro de activar este expediente?',
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

                axios.put('/sacramento/activarexpediente',{
                    'id': id
                }).then(function (response) {
                    me.listarMatrimonio1(1,'','libro');
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
        },

        /* finalizarExpediente(id){
            swal({
            title: '¿Esta seguro de finalizar el expediente?',
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

                axios.put('/sacramento/finalizarexpediente',{
                    'id': id
                }).then(function (response) {
                    me.listarMatrimonio1(1,'','libro');
                    swal(
                    'Finalizado!',
                    'El expediente ya está completo.',
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
        } */
        },// Fin de methods
        
        mounted() {
            this.listarMatrimonio1(1,this.buscar,this.criterio);
            this.llenadoarray();
            this.selectCategoria();
            this.llenadolista('','');
            this.llenadolistaiglesia('','');
            this.llenadolistazona('','');
           
        }
    }
</script>

<style> /*Aquí ya comienza el CSS, ke kreisi */
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
    .div-error{ /* estos dos estilos son para validación */
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
    .margen{
        margin-bottom: 10px;
    }
    
</style>