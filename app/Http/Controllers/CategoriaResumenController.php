<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriaResumen;
use Illuminate\Support\Facades\DB;

class CategoriaResumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //  if(!$request->ajax()) return redirect('/');
  
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        
        if ($buscar == ''){
            $categoria_resumen = CategoriaResumen::where('estado','1')->orderBy('id')->get();
        } else {
            $categoria_resumen = CategoriaResumen::where($criterio, 'like','%' . $buscar .'%')
            ->where('estado','1')
            ->orderBy('id')->get();
        }
        return $categoria_resumen;
    }

    public function eliminarCR(Request $id)
    {
      //  if(!$id->ajax()) return redirect('/');
        $cambiar=2;
     
        $categoriaResumen = DB::table('categorias_resumenes')->where("id",$id->id)->update(["estado"=>$cambiar]);
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
           'nombre_categoria'=> 'required|min:3|max:50',
           'descripcion_categoria'=>'required|min:3|max:100'

        ]);

            
        $id_categoriaResumen = CategoriaResumen::max('id');
        $id=$id_categoriaResumen+1;
           

        $categoriaResumen = new CategoriaResumen();
        $categoriaResumen->id=$id;
        $categoriaResumen->nombre_categoria= $request->nombre_categoria;
        $categoriaResumen->descripcion_categoria=$request->descripcion_categoria;
        $categoriaResumen->estado=1;
        $categoriaResumen->save();
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
            'nombre_categoria'=> 'required|min:3|max:50',
            'descripcion_categoria'=>'required|min:3|max:100'
 
         ]);
        $categoriaResumen = DB::table('categorias_resumenes')->where("id",$id->id)->update(["nombre_categoria"=>$id->nombre_categoria, "descripcion_categoria" => $id->descripcion_categoria]);
    }

    public function selectCategoriaRe(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $categoriaResumen = CategoriaResumen::where('estado','=','1')
       ->select('id','nombre_categoria','descripcion_categoria')->get();
       return ['categorias' => $categoriaResumen];    
    }
    
}
