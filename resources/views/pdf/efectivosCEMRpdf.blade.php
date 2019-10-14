<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Control Economico Mensual Resumido</title>
    <style>
            body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.875rem;
            font-weight: normal;
            line-height: 1.5;
            color: #151b1e;           
        }
        .table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #c2cfd6;
        }
        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table th, .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #c2cfd6;
        }
        .table-bordered thead th, .table-bordered thead td {
            border-bottom-width: 2px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #c2cfd6;
        }
        th, td {
            display: table-cell;
            vertical-align: inherit;
        }
        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: left;
        }
        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }
        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
        .izquierda{
            float:left;
        }
        .derecha{
            float:right;
        }
        .centro{
            float:center;
        }
        .totales2 {
        font-size:  large;
        text-align: right;
        }
        .negrita{
        font-weight: bold;
        }
    </style>
</head>
<body>
    <div>
<body>
            <?php
            $anio=date("Y");
            $fechaT=date("F");

            switch($fechaT){
                case 'January': $fechaT="ENERO";
                break;
                case 'February': $fechaT="FEBRERO";
                break;
                case 'March': $fechaT="MARZO";
                break;
                case 'April': $fechaT="ABRIL";
                break;
                case 'May': $fechaT="MAYO";
                break;
                case 'June': $fechaT="JUNIO";
                break;
                case 'July': $fechaT="JULIO";
                break;
                case 'August': $fechaT="AGOSTO";
                break;
                case 'September': $fechaT="SEPTIEMBRE";
                break;
                case 'October': $fechaT="OCTUBRE";
                break;
                case 'November': $fechaT="NOVIEMBRE";
                break;
                case 'December': $fechaT="DICIEMBRE";
                break;
            }

            $total1=0;
            $total2=0;
            $total1nulos=0;
            $total2nulos=0;
            $ingresos=0;
            $egresos=0;
            $total=0;

            foreach($categorias as &$a){
            
                if($a->tipo==1){
                    $total1=$total1+$a->montos;
                }else{
                    $total2=$total2+$a->montos;
                }                    
            }
            foreach($efectivos as $b){

                if($b->tipo==1){
                    $total1nulos=$total1nulos+$b->monto;
                }else{
                    $total2nulos=$total2nulos+$b->monto;
                }                    
            }
           $ingresos=$total1+$total1nulos;
           $egresos=$total2+$total2nulos;
           $total=$ingresos-$egresos;

            ?>

      <h3>RESUMEN ECONOMICO DEL MES DE {{$fechaT}} {{$anio}}<span class="derecha">{{now()}}</span></h3>
    </div>
    <div>
        <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Ingreso</th>
                        <th>Egreso </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $a)
                    <tr>
                        <td>{{$a->nombres}}</td>

                        @if($a->tipo==1){
                            <td>{{$a->montos}}</td>
                            <td></td>
                             } 
                        @endif 
                        
                        @if($a->tipo==2){
                            <td></td>
                            <td>{{$a->montos}}</td>
                            }
                        @endif
                    </tr>
                    @endforeach
        <!--///////////////////////////////////////////////////////////////////////////////////// -->
                    @foreach ($efectivos as $b)
                    <tr>
                        <td>{{$b->descripcion_efectivo}}</td>

                        @if($b->tipo==1){
                            <td>{{$b->monto}}</td>
                            <td></td>
                             } 
                        @endif 
                        
                        @if($b->tipo==2){
                            <td></td>
                            <td>{{$b->monto}}</td>
                            }
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table> 
            <div>
                
                     <div class="totales2">
                            <label class="negrita">SUBTOTAL: </label>
                            <label>Ingresos: {{$ingresos}} </label>                              
                            <label>Egresos: {{$egresos}}</label> 
                    </div>
                    <div class="totales2">
                            <label class="negrita">TOTAL:  </label>
                            <label> {{$total}}</label>
                    </div>

            </div>             

    </div>


</body>
</html>