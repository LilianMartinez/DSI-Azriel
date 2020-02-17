<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\DetalleEntrada;
use App\Existencia;
use App\Salida;
use App\Canasta;
use App\DescripcionCanasta;
use App\ExistenciaCanasta;
use App\SalidaCanasta;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
   
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
  
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        
        if ($buscar == ''){
            $productos = Producto::where('estado','1')->orderBy('id')->paginate(15);
        } else {
            $productos = Producto::where($criterio, 'like','%' . $buscar .'%')
            ->where('estado','1')
            ->orderBy('id')->paginate(15);
        }
        return[
            'pagination' =>[
                 'total' =>  $productos->total(),
                 'current_page' => $productos->currentPage(),
                 'per_page' =>$productos->perPage(),
                 'last_page' => $productos->lastPage(),
                 'from' => $productos->firstItem(),
                 'to' => $productos->lastItem(),
                 ],
                 'productos' => $productos
             ];
        
    }
    public function indexv(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
  
        $buscar = $request->buscar;
        
        
        
        if ($buscar == ''){
            $productos = Producto::join('detalle_entrada','producto.id','=','detalle_entrada.id_producto')
            ->join('existencias','detalle_entrada.id','=','existencias.id_entrada')
            ->select(DB::raw("CONCAT(producto.nombre_producto, '-', producto.unidad_medida) AS nombre_producto"),'detalle_entrada.fecha','producto.id','existencias.precio_venta','existencias.cantidad','existencias.id as exi')
            ->where('existencias.cantidad','>','0')
            ->where('detalle_entrada.tipo','2')
            ->orderby('producto.id', 'asc')->paginate(15);
        } else {
            $productos = Producto::join('detalle_entrada','producto.id','=','detalle_entrada.id_producto')
            ->join('existencias','detalle_entrada.id','=','existencias.id_entrada')
            ->select(DB::raw("CONCAT(producto.nombre_producto, '-', producto.unidad_medida) AS nombre_producto"),'detalle_entrada.fecha','producto.id','existencias.precio_venta','existencias.cantidad','existencias.id as exi')
            ->where('existencias.cantidad','>','0')
            ->where('detalle_entrada.tipo','2')
            ->where('producto.nombre_producto', 'like','%' . $buscar .'%')
            ->orderby('producto.id', 'asc')->paginate(15);
        }
        $numero = count($productos); 
    for ($i = 0; $i < $numero; $i++) {
        $productos[$i]['idc']=$i;
    }
        return [
            'pagination' => [
                'total'        => $productos->total(),
                'current_page' => $productos->currentPage(),
                'per_page'     => $productos->perPage(),
                'last_page'    => $productos->lastPage(),
                'from'         => $productos->firstItem(),
                'to'           => $productos->lastItem(),
            ],
            'productos' => $productos
        ];
    }
    public function seleccionarProducto(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $filtro1=$request->filtro;
        $filtro2=strtoupper($filtro1);
        $filtro = trim($filtro2);
        $i=strlen ($filtro);
        if($i>0){
        $productos = Producto::select(DB::raw("CONCAT(nombre_producto, '-', unidad_medida) AS nombre_producto"),'id')->where('estado','1')->where('nombre_producto', 'like', $filtro .'%')
        ->get();
        return ['producto'=> $productos];
        }else{
            return;
        }
    }
    public function buscarventa(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
  
        $buscar = $request->buscar;
    $productos = DetalleEntrada::join('existencias','detalle_entrada.id','=','existencias.id_entrada')
            ->select('existencias.cantidad','existencias.id','existencias.precio_venta')
            ->where('existencias.cantidad','>','0')
            ->where('detalle_entrada.tipo','2')
            ->where('detalle_entrada.id_producto','=',  $buscar )
            ->orderby('existencias.id', 'asc')->get();
        
        return [
            'productos' => $productos
        ];
    }
    public function venta(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $filtro1=$request->filtro;
        $filtro2=strtoupper($filtro1);
        $filtro = trim($filtro2);
        $i=strlen ($filtro);
        if($i>0){
        $productos = Producto::join('detalle_entrada','producto.id','=','detalle_entrada.id_producto')
        ->join('existencias','detalle_entrada.id','=','existencias.id_entrada')
        ->select(DB::raw("CONCAT(producto.nombre_producto, '-', producto.unidad_medida) AS nombre_producto"),'producto.id')
        ->where('detalle_entrada.tipo','2')->where('existencias.cantidad','>','0')->where('producto.nombre_producto', 'like', $filtro .'%')
        ->groupBy('producto.id')
        ->get();
        return  ['producto'=> $productos];}
        else{
            return;
        }
    }
    public function seleccionarProductoCanasta(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $filtro1=$request->filtro;
        $filtro2=strtoupper($filtro1);
        $filtro = trim($filtro2);
        $i=strlen ($filtro);
        if($i>0){
  
        $productos = Producto::join('detalle_entrada','producto.id','=','detalle_entrada.id_producto')
        ->join('existencias','detalle_entrada.id','=','existencias.id_entrada')
        ->select(DB::raw("CONCAT(producto.nombre_producto, '-', producto.unidad_medida) AS nombre_producto"),'producto.id')
        ->where('detalle_entrada.tipo','1')->where('existencias.cantidad','>','0')->where('producto.nombre_producto', 'like', $filtro .'%')
        ->groupBy('producto.id')
        ->get();
        return  ['producto'=> $productos];
    }else{
        return;
    }
    }
    public function guardarventa(Request $request)
    {
        $detalles = $request->existencias;//Array de detalles
            //Recorro todos los elementos
            $mytime= new \DateTime();
 
            foreach($detalles as $ep=>$det)
            {
                
                $id_salida = Salida::max('id');
                $id=$id_salida+1;

                $salida = new Salida();
                $salida->id = $id;
                $salida->id_existencia = $det['id_existencia'];
                $salida->cantidad = $det['descontar'];
                $salida->precio_ventaF=$det['preciov'];
                $salida->fecha= $mytime;
                $salida->save();

                $existencia = DB::table('existencias')->where("id",$det['id_existencia'])->update(["cantidad"=>$det['queda']]);
            }     
    }
    public function seleccionarProductoExistencia(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $filtro=$request->filtro;

        $productos3 = DetalleEntrada::join('existencias','detalle_entrada.id','=','existencias.id_entrada')
        ->select('existencias.cantidad','existencias.id','detalle_entrada.unitario')
        ->where('existencias.cantidad','>','0')->where('detalle_entrada.id_producto','=', $filtro)
        ->where('detalle_entrada.tipo','1')
        ->orderby('existencias.id', 'asc')->get();
        
        return [ 'lista'=>$productos3];
    }
 


    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $this->validate($request, [
           'nombre_producto'=> 'required|min:3|max:99',
          

        ]);

            
        $id_producto = Producto::max('id');
        $id=$id_producto+1;
           

        $producto = new Producto();
        $producto->id=$id;
        $producto->nombre_producto= $request->nombre_producto;
        $producto->unidad_medida= $request->unidad;
        $producto->estado=1;
        $producto->save();
    }

    public function update(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
        $this->validate($id, [
            'nombre_producto'=> 'required|min:3|max:99',
            
         ]);
        $producto = DB::table('producto')->where("id",$id->id)->update(["nombre_producto"=>$id->nombre_producto, "unidad_medida"=>$id->unidad]);
    }

    public function eliminar(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
        $cambiar=2;
     
        $producto = DB::table('producto')->where("id",$id->id)->update(["estado"=>$cambiar]);
    }

    
    public function buscar(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
       $producto = DB::table('producto')->where("id",$id->id)->first();
       return response()->json($producto);    
      // ->whereMonth('fecha', $mes)->orderBy('id','desc')->
    }
    public function ConsultaInforme(Request $request)
    {
        $fecha1=$request->fecha1;
        $fecha2=$request->fecha2;
        $trozos1 = explode("-", $fecha1);
        $trozos2 = explode("-", $fecha2);
        $aniop1=$trozos1[0];
        $mesp1=$trozos1[1];
        $aniop2=$trozos2[0];
        $mesp2=$trozos2[1];
        $mes1=$mesp1;
        $mes2=$mesp2;
        $anio1=$aniop1;
        $anio2=$aniop2;
        
        //compras de canasta
        $entradasCanasta= DetalleEntrada::whereYear('fecha','>=',$anio1)
        ->whereYear('fecha','<=',$anio2)
        ->whereMonth('fecha','>=', $mes1)
        ->whereMonth('fecha','<=', $mes2)
        ->where('tipo','1')->sum("precio_compra");
        $envio['ComprasCanasta']=$entradasCanasta;
        //compras de producto unidad
        $entradasSuelto= DetalleEntrada::whereYear('fecha','>=',$anio1)
        ->whereYear('fecha','<=',$anio2)
        ->whereMonth('fecha','>=', $mes1)
        ->whereMonth('fecha','<=', $mes2)
        ->where('tipo','2')->sum("precio_compra");
        $envio['ComprasSuelto']=$entradasSuelto;

        //compras totales
        $envio['ComprasTotales']=$entradasCanasta+$entradasSuelto;

        //ventas de producto unidad
        $ventasSuelto= Salida::whereYear('fecha','>=',$anio1)
        ->whereYear('fecha','<=',$anio2)
        ->whereMonth('fecha','>=', $mes1)
        ->whereMonth('fecha','<=', $mes2)->sum("precio_ventaF");
        $envio['ventasSuelto']=$ventasSuelto;

        //ventas canasta unidad
        $ventascanastas = Canasta::join('existencia_canasta','canasta.id','=','existencia_canasta.id_canasta')
            ->join('salida_canasta','existencia_canasta.id','=','salida_canasta.id_existenciaC')
            ->whereYear('salida_canasta.fecha','>=',$anio1)
            ->whereYear('salida_canasta.fecha','<=',$anio2)
            ->whereMonth('salida_canasta.fecha','>=', $mes1)
            ->whereMonth('salida_canasta.fecha','<=', $mes2)->sum("canasta.precio_venta");
        $envio['ventasCanasta']=$ventascanastas;  

        //compras totales
        $envio['VentassTotales']=$ventasSuelto+$ventascanastas;

        //gastos canasta
        $costocanastas = Canasta::join('existencia_canasta','canasta.id','=','existencia_canasta.id_canasta')
            ->join('salida_canasta','existencia_canasta.id','=','salida_canasta.id_existenciaC')
            ->whereYear('salida_canasta.fecha','>=',$anio1)
            ->whereYear('salida_canasta.fecha','<=',$anio2)
            ->whereMonth('salida_canasta.fecha','>=', $mes1)
            ->whereMonth('salida_canasta.fecha','<=', $mes2)->sum("canasta.costo_canasta");
        $envio['costoCanasta']=$costocanastas;  

        //ganacia canasta
        $envio['gananciaCanasta']=$ventascanastas-$costocanastas;


        //gastos productos
        $costoventas = DetalleEntrada::join('existencias','detalle_entrada.id','=','existencias.id_entrada')
            ->join('salidas','existencias.id','=','salidas.id_existencia')
            ->whereYear('salidas.fecha','>=',$anio1)
            ->whereYear('salidas.fecha','<=',$anio2)
            ->whereMonth('salidas.fecha','>=', $mes1)
            ->whereMonth('salidas.fecha','<=', $mes2)->sum(\DB::raw('detalle_entrada.unitario * salidas.cantidad'));
        $envio['costoventas']=$costoventas;  

        $envio['costos']=$costoventas+$costocanastas;
        //ganacia canasta
        $envio['gananciaproductos']=$ventasSuelto-$costoventas;

        $envio['ganacia']=$ventasSuelto-$costoventas+$ventascanastas-$costocanastas;

        //productos vendidos
        $productosvendidos= Salida::whereYear('fecha','>=',$anio1)
        ->whereYear('fecha','<=',$anio2)
        ->whereMonth('fecha','>=', $mes1)
        ->whereMonth('fecha','<=', $mes2)->sum("cantidad");
        $envio['productosvendidos']=$productosvendidos; 

        //canastas vendidas
        $canastasvendidas= SalidaCanasta::whereYear('fecha','>=',$anio1)
        ->whereYear('fecha','<=',$anio2)
        ->whereMonth('fecha','>=', $mes1)
        ->whereMonth('fecha','<=', $mes2)
        ->select(DB::raw('count(*) as filas'))
        ->first();
        $envio['canastas']=$canastasvendidas; 

        
        return $envio;
    }
}
