@extends("principal")
@section("contenido")

@if(count($errors)>0)
 <div class="alert alert-danger">
     <button  type="button" class="close" data-dismiss="alert">
         &times;
     </button>
       {{$errors->first()}}
 </div>
 @endif
 <div class="row ">
        <div class="card-header">
                Caja Chica
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
        <div class="col-sm-7">
          <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('caja') }}" enctype="multipart/form-data">
                
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                       
                                        <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
    </form>

    @if (isset($registros))
    @if (count($registros)>0)
    <div class="row">
            <div class="col-lg-12  w-100">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Equipo informático agregado al inventario por tipo</h6>
            </div>
            <div class="card-body">
                    <div class="table-responsive">
                          <table class="table table-bordered table-striped table-sm">
                                  <thead>
                                      <tr>
                                          <th>Factura</th>
                                          <th>Concepto</th>
                                          <th>Ingreso</th>
                                          <th>Egreso </th>
                                          <th>Opciones</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                          @foreach($registros as $registro)
                                      <tr>
                                             
                                      <td>{{$registro->num_recibo}}</td>
                                          
                                          <td>{{$registro->descripcion_efectivo}}</td>
                                          @if ($registro->tipo == 1)
                                          <td>{{$registro->monto}}</td>
                                          <td></td>
                                          @else
                                          <td></td>
                                          <td>{{$registro->monto}}</td>
      
                                          @endif
                                          
                                          
                                          <td>
                                              <button type="button" data-toggle="modal" data-target="#modalNuevo">
                                                <i class="icon-pencil"></i>
                                              </button> &nbsp;
                                              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">
                                                <i class="icon-trash"></i>
                                              </button>
                                          </td>
                                      </tr>
                                    
                                      @endforeach
                                  </tbody>
                              </table>
                      {{$registros->appends(Request::all())->render()}}
                    </div>
                  </div>
        </div>
    
         </div>
        </div>   
    @else
    <h3>No hay registros que cumplan con los parámetros ingresados</h3>   
    @endif    
    @endif
    

   
@endsection