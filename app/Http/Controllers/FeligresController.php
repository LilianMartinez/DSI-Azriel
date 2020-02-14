<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\Iglesia;
use App\Zona;
use Illuminate\Support\Facades\DB;

class FeligresController extends Controller
{
    public function index(Request $request)
    {
       if(!$request->ajax()) return redirect('/');
  
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        
        if ($buscar == ''){
            $feligres = Iglesia::join('personas','personas.idiglesia','=','iglesias.id')
            ->join('zonas','zonas.id','=','iglesias.idzona')
            ->select('iglesias.id as idigle','iglesias.nombre_iglesia','iglesias.idzona','personas.id', 'personas.nombre_persona', 
                     'personas.apellido_persona', 'personas.idiglesia','personas.estado','personas.fecha_nacimiento','personas.dui_pasaporte','personas.sexo',
                     'zonas.id as idz','zonas.nombre_zona')
            ->where('personas.estado','=',1)
            ->whereNull('personas.tipo_persona') 
            ->paginate(30);
            
        } else {
            $feligres = Iglesia::join('personas','personas.idiglesia','=','iglesias.id')
            ->join('zonas','zonas.id','=','iglesias.idzona')
            ->select('iglesias.id as idigle','iglesias.nombre_iglesia','iglesias.idzona','personas.id', 'personas.nombre_persona', 
                     'personas.apellido_persona', 'personas.idiglesia','personas.estado','personas.fecha_nacimiento','personas.dui_pasaporte','personas.sexo',
                     'zonas.id as idz','zonas.nombre_zona')
            ->where('personas.estado','=',1)
            ->whereNull('personas.tipo_persona') 
            ->where($criterio, 'like','%' . $buscar .'%')
            ->paginate(30);
        }
        return [
            'pagination' =>[
                 'total' =>  $feligres->total(),
                 'current_page' => $feligres->currentPage(),
                 'per_page' =>$feligres->perPage(),
                 'last_page' => $feligres->lastPage(),
                 'from' => $feligres->firstItem(),
                 'to' => $feligres->lastItem(),
                 ],
                 'feligres' => $feligres
             ];
    }
    
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $this->validate($request, [
           'nombre_persona'=> 'required|min:3|max:99',
           'apellido_persona'=> 'required|min:3|max:99',
           'idiglesia'=>'required',      

        ]);

            
        $id_persona = Persona::max('id');
        $id=$id_persona+1;
           

        $feligres = new Persona();
        $feligres->id=$id;
        $feligres->nombre_persona= $request->nombre_persona;
        $feligres->apellido_persona= $request->apellido_persona;
        $feligres->fecha_nacimiento=$request->fecha_nacimiento;
        $feligres->idzonaa= $request->idzonaa;
        $feligres->idiglesia= $request->idiglesia;
        $feligres->dui_pasaporte= $request->dui;
        $feligres->sexo= $request->sexo;
        $feligres->estado=1;
        $feligres->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $this->validate($request, [
            'nombre_persona'=> 'required|min:3|max:99',
            'apellido_persona'=> 'required|min:3|max:99',
            'idiglesia'=>'required', 
            
         ]);
        
         $feligres = Persona::findOrFail($request->id);
         $feligres->nombre_persona= $request->nombre_persona;
         $feligres->apellido_persona= $request->apellido_persona;
         $feligres->fecha_nacimiento= $request->fecha_nacimiento;
         $feligres->idiglesia= $request->idiglesia;
         $feligres->idzonaa= $request->idzonaa;
         $feligres->dui_pasaporte= $request->dui;
         $feligres->sexo= $request->sexo;
         $feligres->save();
    }

    public function buscarIglesia(Request $id)
    {
        #$envio=array();
        #$idzona=$request->idzona;

       // if(!$request->ajax()) return redirect('/');
        $iglesias = Iglesia::join('zonas','zonas.id','=','iglesias.idzona')
                        ->select('iglesias.id','iglesias.nombre_iglesia','zonas.nombre_zona')
                        ->where('iglesias.idzona','=',$id->id)
                        ->get();

        return response()->json($iglesias);
    }

    public function eliminar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $cambiar=2;
     
        $iglesia = DB::table('personas')->where("id",$request->id)->update(["estado"=>$cambiar]);
    }

}
