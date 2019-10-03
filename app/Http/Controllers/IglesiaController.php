<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Iglesia;
use Illuminate\Support\Facades\DB;

class IglesiaController extends Controller
{
   
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
  
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        
        if ($buscar == ''){
            $iglesias = Iglesia::where('estado','1')->orderBy('id')->get();
        } else {
            $iglesias = Iglesia::where($criterio, 'like','%' . $buscar .'%')
            ->where('estado','1')
            ->orderBy('id')->get();
        }
        return $iglesias;
    }
 


    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $this->validate($request, [
           'nombre_iglesia'=> 'required|min:3|max:99',
          

        ]);

            
        $id_iglesia = Iglesia::max('id');
        $id=$id_iglesia+1;
           

        $iglesia = new Iglesia();
        $iglesia->id=$id;
        $iglesia->nombre_iglesia= $request->nombre_iglesia;
        $iglesia->estado=1;
        $iglesia->save();
    }

    public function update(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
        $this->validate($id, [
            'nombre_iglesia'=> 'required|min:3|max:99',
            
         ]);
        $iglesia = DB::table('iglesias')->where("id",$id->id)->update(["nombre_iglesia"=>$id->nombre_iglesia]);
    }

    public function eliminar(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
        $cambiar=2;
     
        $iglesia = DB::table('iglesias')->where("id",$id->id)->update(["estado"=>$cambiar]);
    }

    
    public function buscar(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
       $iglesia = DB::table('iglesias')->where("id",$id->id)->first();
       return response()->json($iglesia);    
    }
}
