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
        $envio=array();
        
        
        if ($buscar == ''){
            $iglesiasZ = Iglesia::join('zonas','iglesias.idzona','=','zonas.id')
            ->select('zonas.id as idz','zonas.nombre_zona','iglesias.id','iglesias.nombre_iglesia')
            ->where('iglesias.estado','=',1)->orderBy('iglesias.id')->get();

            $iglesias = Iglesia::whereNull('idzona')
            ->where('estado','1')->orderBy('id')->get();

        } else {
            $iglesiasZ = Iglesia::join('zonas','iglesias.idzona','=','zonas.id')
            ->select('zonas.id as idz','zonas.nombre_zona','iglesias.id','iglesias.nombre_iglesia')
            ->where('iglesias.estado','1')
            ->where('iglesias.'.$criterio, 'like','%' . $buscar .'%')
            ->orderBy('iglesias.id')->get();

            $iglesias = Iglesia::whereNull('idzona')
            ->where($criterio, 'like','%' . $buscar .'%')
            ->where('estado','1')
            ->orderBy('id')->get();
        }

        $envio['iglesiasZ']=$iglesiasZ;
        $envio['iglesias']=$iglesias;
        return $envio;
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
        $iglesia->idzona= $request->idz;
        $iglesia->estado=1;
        $iglesia->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $this->validate($request, [
            'nombre_iglesia'=> 'required|min:3|max:99',
            
         ]);

         $iglesia = Iglesia::findOrFail($request->id);
         $iglesia->nombre_iglesia= $request->nombre_iglesia;
         $iglesia->idzona= $request->idz;
         $iglesia->save();
    }

    public function eliminar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $cambiar=2;
     
        $iglesia = DB::table('iglesias')->where("id",$request->id)->update(["estado"=>$cambiar]);
    }

    
    public function buscar(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
       $iglesia = DB::table('iglesias')->where("id",$id->id)->where("estado",'=',1)->first();
       return response()->json($iglesia);    
    }
}
