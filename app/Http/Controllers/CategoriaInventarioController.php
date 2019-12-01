<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriaInventario;
use Illuminate\Support\Facades\DB;

class CategoriaInventarioController extends Controller
{
   
    public function index(Request $request)
    {
       // if(!$request->ajax()) return redirect('/');
  
        $buscar = $request->buscar;
        $criterio = $request->criterio;        
        
        if ($buscar == ''){

            $categoriainv = CategoriaInventario::select('id','nombre_categoriainv','descripcion_categoriainv','estado')
                        ->where('estado','1')->orderBy('id')->get();

        } else {
           $categoriainv = CategoriaInventario::select('id','nombre_categoriainv','descripcion_categoriainv','estado')
            ->where($criterio, 'like','%' . $buscar .'%')
            ->where('estado','1')
            ->orderBy('id')->get();
        }

        return $categoriainv;
    }
 
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $this->validate($request, [
           'nombre_categoriainv'=> 'required|min:3|max:99',          
           'descripcion_categoriainv'=> 'min:3|max:99',          

        ]);

            
        $id_cateinveid = CategoriaInventario::max('id');
        $id=$id_cateinveid+1;
           

        $cateinve = new CategoriaInventario();
        $cateinve->id=$id;
        $cateinve->nombre_categoriainv= $request->nombre_categoriainv;
        $cateinve->descripcion_categoriainv= $request->descripcion_categoriainv;
        $cateinve->estado=1;
        $cateinve->save();
    }

    public function update(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
        $this->validate($id, [
            'nombre_categoriainv'=> 'required|min:3|max:99',          
            'descripcion_categoriainv'=> 'min:3|max:99',  
            
         ]);
        $cateinve = DB::table('categorias_inventarios')->where("id",$id->id)->update(["nombre_categoriainv"=>$id->nombre_categoriainv,"descripcion_categoriainv"=>$id->descripcion_categoriainv]);
    }

    public function eliminar(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
        $cambiar=2;
     
        $cateinve = DB::table('categorias_inventarios')->where("id",$id->id)->update(["estado"=>$cambiar]);
    }

    
    public function buscar(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        $cateInv = DB::table('categorias_inventarios')->where("estado",'=',1)->get();
        return $cateInv;
    }   
}
