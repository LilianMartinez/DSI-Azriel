<?php

namespace App\Http\Controllers;

use App\Persona;
use App\Sacramentos3;
use App\PartidaNacimiento;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PersonaController3 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }
    public function buscarduis(Request $request)
    {
        $buscar = $request->dui;
        $envio=array();

        if(!$request->ajax()) return redirect('/');
        $persona = DB::table('personas')->where('dui_pasaporte', $buscar )->first();

        if(empty($persona)){
                $envio['solo']=1;
            }
            else{
                $envio['solo']=2;
                $envio['persona']=$persona;
            }
        
        return $envio;
    }

    

    public function realizante(Request $request)
    {
        $buscar = $request->id;
        $envio=array();
        $nada=0;
        $algo=1;

        if(!$request->ajax()) return redirect('/');
        $persona = DB::table('personas')->where('id', 'like', '%'. $buscar .'%')->first();
        $buscarp = $persona->id_padre;
        $buscarm = $persona->id_madre;
      
        if(empty($buscarm)){
            if(empty($buscarp)){
               $envio['solo']=1;
               $envio['realizante']=$persona;
            }
            else{
                $personap = DB::table('personas')->where('id', '=', $buscarp)->first();
                $envio['padre']=$personap;
                $envio['solo']=2;
                $envio['realizante']=$persona;
            }
        }else{
            if(empty($buscarp)){
                $personam= DB::table('personas')->where('id', '=', $buscarm)->first();
                $envio['madre']=$personam;
                $envio['solo']=3;
                $envio['realizante']=$persona;
            }
            else{
                $personap = DB::table('personas')->where('id', '=', $buscarp)->first();
                $personam= DB::table('personas')->where('id', '=', $buscarm)->first();
                $envio['padre']=$personap;
                $envio['madre']=$personam;
                $envio['solo']=4;
                $envio['realizante']=$persona;
            }

        }
        
        return $envio;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lista(Request $request)
    {
        $nombre = $request->nombre;
        $apellido = $request->apellido;  
        
        if(!$request->ajax()) return redirect('/');
        if ($nombre == ''){
            if($apellido==''){
                $realizante = DB::table('personas as h')->join('sacramentos as s','s.id_realizante1','=','h.id')
                ->where('s.tipo_sacramento',2)
                ->leftjoin('personas as p','h.id_padre','=','p.id')
                ->leftjoin('personas as m','h.id_madre','=','m.id')
                ->select('s.id',
                'h.nombre_persona as hnom','h.apellido_persona as hapellido',
                'p.nombre_persona as pnom','p.apellido_persona as papellido',
                'm.nombre_persona as mnom','m.apellido_persona as mapellido')
                ->paginate(6);
            }else{
                $realizante = DB::table('personas as h')->join('sacramentos as s','s.id_realizante1','=','h.id')
                ->where('s.tipo_sacramento',2)
                ->where('h.apellido_persona', 'like','%' . $apellido .'%')
                ->leftjoin('personas as p','h.id_padre','=','p.id')
                ->leftjoin('personas as m','h.id_madre','=','m.id')
                ->select('s.id',
                'h.nombre_persona as hnom','h.apellido_persona as hapellido',
                'p.nombre_persona as pnom','p.apellido_persona as papellido',
                'm.nombre_persona as mnom','m.apellido_persona as mapellido')
                ->paginate(6);
            }
            
        }else{
            if($apellido==''){
                $realizante = DB::table('personas as h')->join('sacramentos as s','s.id_realizante1','=','h.id')
                ->where('s.tipo_sacramento',2)
                ->where('h.nombre_persona','like','%' . $nombre. '%')
                ->leftjoin('personas as p','h.id_padre','=','p.id')
                ->leftjoin('personas as m','h.id_madre','=','m.id')
                ->select('s.id',
                'h.nombre_persona as hnom','h.apellido_persona as hapellido',
                'p.nombre_persona as pnom','p.apellido_persona as papellido',
                'm.nombre_persona as mnom','m.apellido_persona as mapellido')
                ->paginate(6);
            }else{
                $realizante = DB::table('personas as h')->join('sacramentos as s','s.id_realizante1','=','h.id')
                ->where('s.tipo_sacramento',2)
                ->where('h.nombre_persona', $nombre)
                ->where('h.apellido_persona', $apellido)
                ->leftjoin('personas as p','h.id_padre','=','p.id')
                ->leftjoin('personas as m','h.id_madre','=','m.id')
                ->select('s.id',
                'h.nombre_persona as hnom','h.apellido_persona as hapellido',
                'p.nombre_persona as pnom','p.apellido_persona as papellido',
                'm.nombre_persona as mnom','m.apellido_persona as mapellido')
                ->paginate(6);
            }
        }

            return[
                'pagination' =>[
                     'total' =>  $realizante->total(),
                     'current_page' => $realizante->currentPage(),
                     'per_page' =>$realizante->perPage(),
                     'last_page' => $realizante->lastPage(),
                     'from' => $realizante->firstItem(),
                     'to' => $realizante->lastItem(),
                     ],
                     'realizante' => $realizante
                 ];
            
    }

    
      
    /**
     * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $tipo=$request->tipo;
        switch($tipo){
            case '1':
            {
                $id_persona = Persona::max('id');
                $idreali=$id_persona+1;
                $idsacramento_p= Sacramentos3::max('id');
                $idsacramento=$idsacramento_p+1;
                $tiposacra=2;
                $idpartida_p= PartidaNacimiento::max('id');
                $idpartida=$idpartida_p+1;
        
        
                $personareali = new Persona();
                $personareali->id=$idreali;
                $personareali->nombre_persona= $request->nombre_reali;
                $personareali->apellido_persona=$request->apellido_reali;
                $personareali->dui_pasaporte=$request->dui_reali;
                $personareali->sexo=$request->sexo;
                $personareali->fecha_nacimiento=$request->nacimiento;
                $personareali->id_madre=$request->id_m;
                $personareali->id_padre=$request->id_p;
                $personareali->save();
        
                $partida = new PartidaNacimiento();
                $partida->id=$idpartida;
                $partida->alcaldia= $request->alcaldia;
                $partida->libro=$request->libro;
                $partida->partida=$request->partida;
                $partida->folio=$request->folio;
                $partida->ano=$request->ano;
                $partida->idpersona=$idreali;
                $partida->save();
        
                $sacramento = new Sacramentos3();
                $sacramento->id=$idsacramento;
                $sacramento->tipo_sacramento= $tipo;
                $sacramento->fecha_realizacion=$request->fecha;
                $sacramento->id_realizante1=$idreali;
                $sacramento->id_sacerdote=$request->sacerdote;
                $sacramento->save();
                break;
            }
        }
        
        
   
        
        

        
        

    } //llave funcion


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id_persona = Persona::max('id');
        $idm=$id_persona+1;
        $idp=$idm+1;
        $idreali=$idp+1;

        $envio['idm']=$idm;
        $envio['idp']=$idp;
        $envio['idreali']=$idreali;

        return $envio;
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
    public function update(Request $request, $id)
    {
        //
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
