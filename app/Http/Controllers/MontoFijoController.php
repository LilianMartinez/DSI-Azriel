<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MontoFijo;
use Illuminate\Support\Facades\DB;

class MontoFijoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
  
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        
        if ($buscar == ''){
            $montos_fijos = MontoFijo::where('estado','1')->orderBy('id')->get();
        } else {
            $montos_fijos = MontoFijo::where($criterio, 'like','%' . $buscar .'%')->orderBy('id')->get();
        }
        return $montos_fijos;
    }
 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
           'nombreMF'=> 'required|min:3|max:50',
           'montoF'=>'required|between:0,9999.99'

        ]);
        $montoFijo = new MontoFijo();
        $montoFijo->nombreMF= $request->nombreMF;
        $montoFijo->montoF=$request->montoF;
        $montoFijo->estado=1;
        $montoFijo->save();
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
        $this->validate($id, [
            'nombreMF'=> 'required|min:3|max:50',
            'montoF'=>'required|between:0,9999.99'
 
         ]);
        $montofi = DB::table('montos_fijos')->where("id",$id->id)->update(["nombreMF"=>$id->nombreMF, "montoF" => $id->montoF]);
    }

    public function eliminar(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
        $cambiar=2;
     
        $montofi = DB::table('montos_fijos')->where("id",$id->id)->update(["estado"=>$cambiar]);
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
    public function buscar(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
       $montofi = DB::table('montos_fijos')->where("id",$id->id)->first();
       return response()->json($montofi);    
    }
}
