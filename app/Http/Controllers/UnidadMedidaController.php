<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unidadmedida;
use Illuminate\Support\Facades\DB;

class UnidadMedidaController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
  
        $buscar = $request->buscar;
        
        if ($buscar == ''){
            $unidad_medida = Unidadmedida::where('estado','1')->orderBy('id')->paginate(15);
        } else {
            $unidad_medida = Unidadmedida::where('unidad','like','%' . $buscar .'%')
            ->where('estado','1')
            ->orderBy('id')->paginate(15);
        }
        return[
            'pagination' =>[
                 'total' =>  $unidad_medida->total(),
                 'current_page' => $unidad_medida->currentPage(),
                 'per_page' =>$unidad_medida->perPage(),
                 'last_page' => $unidad_medida->lastPage(),
                 'from' => $unidad_medida->firstItem(),
                 'to' => $unidad_medida->lastItem(),
                 ],
                 'unidad_medida' => $unidad_medida
             ];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $this->validate($request, [
           'nombremf'=> 'required|min:1|max:50',

        ]);

            
        $id_unidadmedida = Unidadmedida::max('id');
        $id=$id_unidadmedida+1;

        $unidadmedida = new Unidadmedida();
        $unidadmedida->id=$id;
        $unidadmedida->unidad= $request->nombremf;
        $unidadmedida->estado=1;
        $unidadmedida->save();
    }
    public function update(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
        $this->validate($id, [
            'nombremf'=> 'required|min:1|max:50',
         ]);
        $unidadmedida = DB::table('unidad_medida')->where("id",$id->id)->update(["unidad"=>$id->nombremf]);
    }

    public function eliminar(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
        $cambiar=2;
     
        $unidadmedida = DB::table('unidad_medida')->where("id",$id->id)->update(["estado"=>$cambiar]);
    }
    public function buscar(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
       $unidadmedida = DB::table('unidad_medida')->where("id",$id->id)->first();
       return response()->json($unidadmedida);    
    }
}
