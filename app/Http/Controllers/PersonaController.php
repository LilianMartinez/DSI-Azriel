<?php

namespace App\Http\Controllers;

use App\Persona;
use App\Sacramento;
//use App\Sacramentos3;
//use App\PartidaNacimiento;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PersonaController extends Controller
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

    public function buscarduihombre(Request $request)
    {
        $buscar = $request->dui;
        $envio=array();

        if(!$request->ajax()) return redirect('/');
        $persona = DB::table('personas')->where('sexo','M')->where('dui_pasaporte', $buscar )->first();

        if(empty($persona)){
                $envio['solo']=1;
            }
            else{
                $envio['solo']=2;
                $envio['persona']=$persona;
            }
        
        return $envio;
    }

    public function buscarduimujer(Request $request)
    {
        $buscar = $request->dui;
        $envio=array();

        if(!$request->ajax()) return redirect('/');
        $persona = DB::table('personas')->where('sexo','F')->where('dui_pasaporte', $buscar )->first();

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
        if(empty($buscarm)){//Si aquí no hay datos de la mamá, entonces...
            if(empty($buscarp)){//Si aquí no hay datos del papá tampoco, entonces manda todos los datos del realizante
                $envio['solo']=1;
                $envio['realizante']=$persona;
            }
            else{//Si hay algo en "papá", entonces manda datos del realizante y del papá
                $personap = DB::table('personas')->where('id', '=', $buscarp)->first();
                $envio['padre']=$personap;
                $envio['solo']=2;
                $envio['realizante']=$persona;
            }
        }else{//Si Existen los datos de la mamá, entonces...
            if(empty($buscarp)){//Si no hay datos del papá, entonces mandará datos de la mamá y el realizante
                $personam= DB::table('personas')->where('id', '=', $buscarm)->first();
                $envio['madre']=$personam;
                $envio['solo']=3;
                $envio['realizante']=$persona;
            }
            else{//Mandará los datos de los 3 (Mamá, papá y realizante)
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
        
                $sacramento = new Sacramento();
                $sacramento->id=$idsacramento;
                $sacramento->tipo_sacramento= $tipo;
                $sacramento->fecha_realizacion=$request->fecha;
                $sacramento->id_realizante1=$idreali;
                $sacramento->id_sacerdote=$request->sacerdote;
                $sacramento->save();
                break;
            }
            case '4.1': //El case "4" es para matrimonio... y el 4.x depende del tipo de guardado
            {
                //Este es para ingresar todos los datos por primera vez
                $persona_idMax = Persona::max('id');
                $idNovio=$persona_idMax+1;
                $idNovia=$idNovio+1;
                $sacramento_idMax= Sacramento::max('id');
                $idsacramento=$sacramento_idMax+1;
                $tiposacra=4;
        
                $novio = new Persona();
                $novio->id=$idNovio;
                $novio->nombre_persona= $request->novioNom;
                $novio->apellido_persona=$request->novioAp;
                $novio->dui_pasaporte=$request->novioD;
                $novio->sexo='M';
                $novio->save();

                $novia = new Persona();
                $novia->id=$idNovia;
                $novia->nombre_persona= $request->noviaNom;
                $novia->apellido_persona=$request->noviaAp;
                $novia->dui_pasaporte=$request->noviaD;
                $novia->sexo='F';
                $novia->save();
        
                //En esta etapa, solo se almacenan los datos para abrir un nuevo expediente (no hay datos de padrino y boda hasta la siguiente etapa en "actualizar")
                $sacramento = new Sacramento();
                $sacramento->id=$idsacramento;
                $sacramento->libro=$request->libro;
                $sacramento->num_expediente=$request->num_expediente;
                $sacramento->tipo_sacramento=$tiposacra;
                $sacramento->id_realizante1=$idNovio;
                $sacramento->id_realizante2=$idNovia;
                $sacramento->estado=1;
                $sacramento->save();
                break;
            }
            case '4.2': //Ingresar solo datos del novio
            {
                $persona_idMax = Persona::max('id');
                $idNovio=$persona_idMax+1;
                $idNovia=$request->id_realizante2;//ESTA MALDITA LINEA ES LA QUE NOS FALTABA T.T
                $sacramento_idMax= Sacramento::max('id');
                $idsacramento=$sacramento_idMax+1;
                $tiposacra=4;
        
                $novio = new Persona();
                $novio->id=$idNovio;
                $novio->nombre_persona= $request->novioNom;
                $novio->apellido_persona=$request->novioAp;
                $novio->dui_pasaporte=$request->novioD;
                $novio->sexo='M';
                $novio->save();
        
                //En esta etapa, solo se almacenan los datos para abrir un nuevo expediente (no hay datos de padrino y boda hasta la siguiente etapa en "actualizar")
                $sacramento = new Sacramento();
                $sacramento->id=$idsacramento;
                $sacramento->libro=$request->libro;
                $sacramento->num_expediente=$request->num_expediente;
                $sacramento->tipo_sacramento=$tiposacra;
                $sacramento->id_realizante1=$idNovio;
                $sacramento->id_realizante2=$idNovia;
                $sacramento->estado=1;
                $sacramento->save();
                break;
            }
            case '4.3': //Ingresar solo datos de la novia
            {
                $persona_idMax = Persona::max('id');
                $idNovia=$persona_idMax+1;
                /* $idNovio=Persona::findOrFail($request->id); */
                $idNovio=$request->id_realizante1;
                $sacramento_idMax= Sacramento::max('id');
                $idsacramento=$sacramento_idMax+1;
                $tiposacra=4;

                $novia = new Persona();
                $novia->id=$idNovia;
                $novia->nombre_persona= $request->noviaNom;
                $novia->apellido_persona=$request->noviaAp;
                $novia->dui_pasaporte=$request->noviaD;
                $novia->sexo='F';
                $novia->save();
        
                //En esta etapa, solo se almacenan los datos para abrir un nuevo expediente (no hay datos de padrino y boda hasta la siguiente etapa en "actualizar")
                $sacramento = new Sacramento();
                $sacramento->id=$idsacramento;
                $sacramento->libro=$request->libro;
                $sacramento->num_expediente=$request->num_expediente;
                $sacramento->tipo_sacramento=$tiposacra;
                $sacramento->id_realizante1=$idNovio;
                $sacramento->id_realizante2=$idNovia;
                $sacramento->estado=1;
                $sacramento->save();
                break;
            }
            case '4.4': //Solo ingresamos datos del sacramento
            {
                /* $idNovio=Persona::findOrFail($request->id);
                $idNovia=Persona::findOrFail($request->id); */
                $idNovio=$request->id_realizante1;
                $idNovia=$request->id_realizante2;
                $sacramento_idMax= Sacramento::max('id');
                $idsacramento=$sacramento_idMax+1;
                $tiposacra=4;
        
                //En esta etapa, solo se almacenan los datos para abrir un nuevo expediente (no hay datos de padrino y boda hasta la siguiente etapa en "actualizar")
                $sacramento = new Sacramento();
                $sacramento->id=$idsacramento;
                $sacramento->libro=$request->libro;
                $sacramento->num_expediente=$request->num_expediente;
                $sacramento->tipo_sacramento=$tiposacra;
                $sacramento->id_realizante1=$idNovio;
                $sacramento->id_realizante2=$idNovia;
                $sacramento->estado=1;
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

    //Editar un objeto sacramento
    public function update(Request $request)//ESTO YA FUNCIONA OFICIALMENTE, DESPUÉS DE 2,222 INTENTOS
    {
        if(!$request->ajax()) return redirect('/');
        $tipo=$request->tipo;
        $id_realizante1 =$request->id_realizante1;
        $id_realizante2 =$request->id_realizante2;
        switch($tipo){
            case '4':
            {
                
                    $sacramento = Sacramento::findOrFail($request->id);
                    $sacramento->libro=$request->libro;
                    $sacramento->num_expediente=$request->num_expediente;
                    $sacramento->save();

                    /* $novio = DB::table('personas')->where('id', 'like', '%'. $idNovio .'%')->first(); */
                    /* $novio = App\Persona::where('id', $idNovio)->first(); */
                    /* $persona = DB::table('personas')->where('id', 'like', '%'. $buscar .'%')->first(); */
                    $novio = DB::table('personas')->where("id",$request->id_realizante1)
                    ->update(["nombre_persona"=>$request->novioNom, "apellido_persona" => $request->novioAp, "dui_pasaporte" =>$request->novioD]);
                    /* $novio->novioNom= $request->novioNom;
                    $novio->novioAp=$request->novioAp;
                    $novio->novioD=$request->novioD;
                    $novio->save(); */

                    $novia = DB::table('personas')->where("id",$request->id_realizante2)
                    ->update(["nombre_persona"=>$request->noviaNom, "apellido_persona" => $request->noviaAp, "dui_pasaporte" =>$request->noviaD]);

                break;
            }
        }
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
