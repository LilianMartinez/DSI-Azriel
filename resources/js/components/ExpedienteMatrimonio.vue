<template>
    <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Expedientes
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" id="opcion" name="opcion">
                                     <option value="libro">Libro</option>
                                      <option value="num_expediente">Expediente</option>
                                      <option value="id_realizante1">Novio</option>
                                      <option value="id_realizante1">Dui Novio</option>
                                      <option value="id_realizante2">Novia</option>
                                      <option value="id_realizante2">Dui Novia</option>
                                    </select>
                                    <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Libro</th>
                                    <th>Expediente</th>
                                    <th>Novio</th>
                                    <th>Dui Novio</th>
                                    <th>Novia</th>
                                    <th>Dui Novia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="expedientematrimonio in arrayExpedienteMatrimonio" :key="expedientematrimonio.id">
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalNuevo">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">
                                          <i class="icon-trash"></i>
                                        </button>
                                    </td>
                                    <td v-text="expedientematrimonio.libro"></td>
                                    <td v-text="expedientematrimonio.num_expediente"></td>
                                    <td v-text="expedientematrimonio.id_realizante1"></td>
                                    <td v-text="expedientematrimonio.id_realizante1"></td>
                                    <td v-text="expedientematrimonio.id_realizante2"></td>
                                    <td v-text="expedientematrimonio.id_realizante2"></td>
                                    <td>
                                        <div v-if="expedientematrimonio.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>                                       
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#">Ant</a>
                                </li>
                                <li class="page-item active">
                                    <a class="page-link" href="#">1</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">4</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Expediente</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Libro</label>
                                    <div class="col-md-5">
                                        <input type="integer" tabindexgt="0" v-model="libro" class="form-control" placeholder="Numero de Libro">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Expediente</label>
                                    <div class="col-md-5">
                                        <input type="text" tabindexgt="0" v-model="num_expediente" class="form-control" placeholder="Numero de Expediente">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Novio</label>
                                    <div class="col-md-5">
                                        <input type="text" id="id_realizante1" name="id_realizante1" class="form-control" placeholder="Nombre del Novio">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">DUI</label>
                                    <div class="col-md-5">
                                        <input type="integer" id="id_realizante1" name="id_realizante1" class="form-control" placeholder="Numero de Dui del Novio">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Novia</label>
                                    <div class="col-md-5">
                                        <input type="text" id="id_realizante2" name="id_realizante2" class="form-control" placeholder="Nombre del Novia">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">DUI</label>
                                    <div class="col-md-5">
                                        <input type="integer" id="id_realizante2" name="id_realizante2" class="form-control" placeholder="Numero de Dui de la Novia">
                                    </div>
                                </div>


                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <!-- Inicio del modal Eliminar -->
            <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
            return {
                libro : '',
                num_expediente : '',
                id_realizante1 : '',
                id_realizante1 : '',
                id_realizante2 : '',
                id_realizante2 : '',
                arrayExpedienteMatrimonio : []
            }    
        },
        methods : {
            listarExpediente (){
                let me=this;
                axios.get('/expediente').then(function (response) {
                    me.arrayExpedienteMatrimonio = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {
            this.listarExpediente();
        }
    }
</script>
