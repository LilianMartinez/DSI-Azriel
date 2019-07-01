<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Efectivo;
use App\efectivojo;
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
        if(!$request->ajax()) return redirect('/');
       
        $hoy=Carbon::now()->toDateString();
        $efectivos = DB::table('efectivos')->where("fecha",$hoy)->get();
        return response()->json($efectivos);
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $this->validate($request, [
            'descripcion_efectivo'=> 'required|min:5|max:50',
            'monto'=>'required|between:0,9999.99'
 
         ]);
        $efectivo = new Efectivo();
        $efectivo->num_recibo= $request->num_recibo;
        $efectivo->descripcion_efectivo=$request->descripcion_efectivo;
        $efectivo->tipo=$request->tipo;
        $efectivo->monto=$request->monto;
        $efectivo->fecha=Carbon::now()->format('Y-m-d');
        $efectivo->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        if(!$request->ajax()) return redirect('/');
        $this->validate($request, [
            'descripcion_efectivo'=> 'required|min:5|max:50',
            'monto'=>'required|between:0,9999.99'
 
         ]);
        $efectivo = Efectivo::findOrFail($request->id);
        $efectivo->num_recibo= $request->num_recibo;
        $efectivo->descripcion_efectivo=$request->descripcion_efectivo;
        $efectivo->tipo=$request->tipo;
        $efectivo->monto=$request->monto;
      //  $efectivo->fecha=$request->fecha;
        $efectivo->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function buscar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $h=1;
        $h2=2;
       $efectivo = DB::table('efectivos')->where("tipo",$h)->sum("monto");
       $efectivo2=  DB::table('efectivos')->where("tipo",$h2)->sum("monto");
       $total= $efectivo-$efectivo2;
       return $total; 
      // return $efectivo;  
    }

   
}
