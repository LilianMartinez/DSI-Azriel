<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Producto;
use App\Canasta;
use App\DescripcionCanasta;
use App\ExistenciaCanasta;
use App\SalidaCanasta;

class CanastasController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
 
        $buscar = $request->buscar;
        $c="canasta.";
        $p=$request->criterio;
        $criterio = $c.$p;
        if ($buscar == ''){
            $canastas = Canasta::join('existencia_canasta','canasta.id','=','existencia_canasta.id_canasta')
            ->select('canasta.id','canasta.nombre_canasta','canasta.precio_venta','canasta.costo_canasta','existencia_canasta.cantidad')
            ->where('existencia_canasta.cantidad','>','0')
            ->orderBy('canasta.id')
            ->paginate(15);
        } else {
            $canastas = Canasta::join('existencia_canasta','canasta.id','=','existencia_canasta.id_canasta')
            ->select('canasta.id','canasta.nombre_canasta','canasta.precio_venta','canasta.costo_canasta','existencia_canasta.cantidad')
            ->where('existencia_canasta.cantidad','>','0')
            ->where($criterio, 'like','%' . $buscar .'%')
            ->orderBy('canasta.id')->paginate(15);
        }         
         
        return [
            'pagination' => [
                'total'        => $canastas->total(),
                'current_page' => $canastas->currentPage(),
                'per_page'     => $canastas->perPage(),
                'last_page'    => $canastas->lastPage(),
                'from'         => $canastas->firstItem(),
                'to'           => $canastas->lastItem(),
            ],
            'canastas' => $canastas
        ];
    }

    public function Buscar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $filtro=$request->buscar;
  
        $productos = Producto::join('detalle_entrada','producto.id','=','detalle_entrada.id_producto')
        ->join('existencias','detalle_entrada.id','=','existencias.id_entrada')
        ->join('descripcion_canasta','existencias.id','=','descripcion_canasta.id_existencia')
        ->join('canasta','descripcion_canasta.id_canasta','=','canasta.id')
        ->select('producto.nombre_producto', DB::raw('sum(descripcion_canasta.cantidad) as cantidad'))
        ->where('descripcion_canasta.id_canasta',  $filtro )
        ->groupBy('producto.id')
        ->get();
        return  ['producto'=> $productos];
    }

    public function Buscar2(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $filtro=$request->buscar;
  
        $productos = Canasta::select('cantidad')
        ->where('id',  $filtro )
        ->get();
        return  ['canasta'=> $productos];
    }


    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            $id_entrada = Canasta::max('id');
                $ide=$id_entrada+1;
            $mytime= new \DateTime();
            $canasta = new Canasta();
            $canasta->id = $ide;
            $canasta->nombre_canasta=  $request->nombreC;
            $canasta->fecha = $mytime;
            $canasta->costo_canasta = $request->totalC;
            $canasta->precio_venta= $request->precioC;
            $canasta->cantidad  = $request->cantidadC;
            $canasta->save();

            $id_entradaE = ExistenciaCanasta::max('id');
            $idex=$id_entradaE+1;
        
            $excanasta = new ExistenciaCanasta();
            $excanasta->id = $idex;
            $excanasta->id_canasta= $ide;
            $excanasta->cantidad  = $request->cantidadC;
            $excanasta->save();

 
          
 
            $detalles = $request->existencias;//Array de detalles
            //Recorro todos los elementos
 
            foreach($detalles as $ep=>$det)
            {
                
                $id_entrada = DescripcionCanasta::max('id');
                $id=$id_entrada+1;

                $detalle = new DescripcionCanasta();
                $detalle->id = $id;
                $detalle->id_existencia = $det['id_existencia'];
                $detalle->cantidad = $det['descontar'];
                $detalle->id_canasta= $ide;
                $detalle->save();

                $existencia = DB::table('existencias')->where("id",$det['id_existencia'])->update(["cantidad"=>$det['queda']]);
            }     
            
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
           

        
    }
    public function vender(Request $id)
    {
        $canastas = ExistenciaCanasta::where('id_canasta', $id->id)->get();
        foreach ($canastas as $o) {
            $idC=$o->id;
            $Can=$o->cantidad;
        }
        
        $cant=$Can-1;
        $id_salidaE = SalidaCanasta::max('id');
        $idex=$id_salidaE+1;
        $mytime= new \DateTime();
        
            $excanasta = new SalidaCanasta();
            $excanasta->id = $idex;
            $excanasta->fecha= $mytime;
            $excanasta->id_existenciaC  = $idC;
            $excanasta->save();

        $venta = DB::table('existencia_canasta')->where("id",$idC)->update(["cantidad"=>$cant]);
    }
}

