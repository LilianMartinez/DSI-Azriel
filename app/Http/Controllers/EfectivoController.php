<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Efectivo;

class EfectivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $efectivos = Efectivo::all();
        return $efectivos;
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
        $efectivo->fecha=$request->fecha;
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
        $efectivo = Efectivo::findOrFail($request->id);
        $efectivo->num_recibo= $request->num_recibo;
        $efectivo->descripcion_efectivo=$request->descripcion_efectivo;
        $efectivo->tipo=$request->tipo;
        $efectivo->monto=$request->monto;
        $efectivo->fecha=$request->fecha;
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
}
