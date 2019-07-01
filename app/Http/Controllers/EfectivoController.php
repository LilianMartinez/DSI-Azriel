<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Efectivo;
use App\MontoFijo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EfectivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$efectivos = Efectivo::all();
      //  if(!$request->ajax()) return redirect('/');
        

          $buscar = $request->buscar;
          $criterio = $request->criterio;  

        if ($buscar == ''){
            $efectivos= Efectivo::orderBy('id','desc')->paginate(6);
        } else {
            $efectivos= Efectivo::where($criterio, 'like','%' . $buscar .'%')->orderBy('id','desc')->paginate(6);
        }

       return[
       'pagination' =>[
            'total' =>  $efectivos->total(),
            'current_page' => $efectivos->currentPage(),
            'per_page' =>$efectivos->perPage(),
            'last_page' => $efectivos->lastPage(),
            'from' => $efectivos->firstItem(),
            'to' => $efectivos->lastItem(),
            ],
            'efectivos' => $efectivos
        ];
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $efectivo = new Efectivo();
        $efectivo->num_recibo= $request->num_recibo;
        $efectivo->descripcion_efectivo=$request->descripcion_efectivo;
        $efectivo->tipo=$request->tipo;
        $efectivo->monto=$request->monto;
        $efectivo->fecha=Carbon::now()->toDateString();
        $efectivo->save();

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $efectivo = Efectivo::findOrFail($request->id);
        $efectivo->num_recibo= $request->num_recibo;
        $efectivo->descripcion_efectivo=$request->descripcion_efectivo;
        $efectivo->tipo=$request->tipo;
        $efectivo->monto=$request->monto;
        //$efectivo->fecha=$request->fecha;
        $efectivo->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $efectivo = DB::table('efectivos')->where("id",$request->id)->delete();
        return "evento eliminado";
    }

    public function buscar(Request $request)
    {
        /*$montofi = MontoFijo::findOrFail($request->id);
        $montofi ->nombremf=$request->nombremf;
        $montofi ->montof=$request->montof;
        return $montofi;*/

        $montofi = MontoFijo::find($request->id);
        return $montofi;
        

        
    }
}
