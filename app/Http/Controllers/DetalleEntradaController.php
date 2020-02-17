<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Producto;
use App\DetalleEntrada;
use App\Existencia;

class DetalleEntradaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $criterio = $request->criterio;
         
        if ($buscar==''){
            $fechaActual=new \DateTime();//FECHA ACTUAL 
            $anio=$fechaActual->format('Y');
            $mes=$fechaActual->format('m');
            $ingresos = Producto::join('detalle_entrada','producto.id','=','detalle_entrada.id_producto')
            ->whereYear('detalle_entrada.fecha', $anio)
            ->whereMonth('detalle_entrada.fecha', $mes)
            ->select('producto.id','producto.nombre_producto', 'producto.unidad_medida',
            'detalle_entrada.cantidad','detalle_entrada.fecha','detalle_entrada.precio_compra','detalle_entrada.tipo')
            ->orderBy('detalle_entrada.fecha', 'desc')->paginate(15);
        }
        else{
            if ($criterio=='producto'){
                $ingresos = Producto::join('detalle_entrada','producto.id','=','detalle_entrada.id_producto')
                ->where('producto.nombre_producto','like','%' . $buscar .'%')
                ->select('producto.id','producto.nombre_producto','producto.unidad_medida',
                'detalle_entrada.cantidad','detalle_entrada.fecha','detalle_entrada.precio_compra','detalle_entrada.tipo')
                ->orderBy('detalle_entrada.fecha', 'desc')->paginate(15);
            }
            else{
                $ingresos = Producto::join('detalle_entrada','producto.id','=','detalle_entrada.id_producto')
                ->where('detalle_entrada.fecha','like','%' . $buscar .'%')
                ->select('producto.id','producto.nombre_producto','producto.unidad_medida',
                'detalle_entrada.cantidad','detalle_entrada.fecha','detalle_entrada.precio_compra','detalle_entrada.tipo')
                ->orderBy('detalle_entrada.fecha', 'desc')->paginate(15);
           
        }
    }
    $numero = count($ingresos); 
    for ($i = 0; $i < $numero; $i++) {
        $ingresos[$i]['idc']=$i;
    }
         
        return [
            'pagination' => [
                'total'        => $ingresos->total(),
                'current_page' => $ingresos->currentPage(),
                'per_page'     => $ingresos->perPage(),
                'last_page'    => $ingresos->lastPage(),
                'from'         => $ingresos->firstItem(),
                'to'           => $ingresos->lastItem(),
            ],
            'ingresos' => $ingresos
        ];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $mytime= new \DateTime();
            
            $detalles = $request->data;
            foreach($detalles as $ep=>$det)
            {
                $id_entrada = DetalleEntrada::max('id');
                $id=$id_entrada+1;

                $id_ex = Existencia::max('id');
                $ide=$id_ex+1;

                $p=$det['precio_compra'];
                $c= $det['cantidad'];
                $uni=$p/$c;

                $detalle = new DetalleEntrada();
                $detalle->id = $id;
                $detalle->id_producto = $det['id_producto'];
                $detalle->cantidad = $det['cantidad'];
                $detalle->fecha= $mytime;
                $detalle->precio_compra=$det['precio_compra']; 
                $detalle->unitario=$uni;
                $detalle->tipo =$det['tipo']; 
                $detalle->save();

                $existencias = new Existencia();
                $existencias->id =$ide;
                $existencias->precio_venta=$det['precio_venta']; 
                $existencias->cantidad= $det['cantidad'];
                $existencias->id_entrada = $id;
                $existencias->save();
            }          
           

        
    }
}
