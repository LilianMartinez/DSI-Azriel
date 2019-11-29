<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zona;
use Illuminate\Support\Facades\DB;

class ZonaController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
  
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        
        if ($buscar == ''){
            $zonas = Zona::where('estado','1')->orderBy('id')->get();
        } else {
            $zonas = Zona::where($criterio, 'like','%' . $buscar .'%')
            ->where('estado','1')
            ->orderBy('id')->get();
        }
        return $zonas;
    }

    public function eliminar(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
        $cambiar=2;
     
        $zonas = DB::table('zonas')->where("id",$id->id)->update(["estado"=>$cambiar]);
    }


    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $this->validate($request, [
           'nombre_zona'=> 'required|min:3|max:100',
        ]);
  
        $id_zona = Zona::max('id');
        $id=$id_zona+1;
           

        $zonas = new Zona();
        $zonas->id=$id;
        $zonas->nombre_zona= $request->nombre_zona;
        $zonas->estado=1;
        $zonas->save();
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
            'nombre_zona'=> 'required|min:3|max:100',
         ]);
        $zonas = DB::table('zonas')->where("id",$id->id)->update(["nombre_zona"=>$id->nombre_zona]);
    }

    public function buscarZona(Request $request)
    {
        $envio=array();

        if(!$request->ajax()) return redirect('/');
        $zona = DB::table('zonas')->where("estado",'=',1)->get();

        return $zona;
    }
}
