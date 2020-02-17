<?php

namespace App\Http\Controllers;

use App\Persona;
use App\Sacramentos3;
use App\PartidaNacimiento;
use App\Efectivo;
use App\Iglesia;
use App\CategoriaResumen;
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

    public function buscarduisCS(Request $request) //ESTO ES PARA CONTROL SECTORIAL AUN ESTA A PRUEBA
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
    
    public function buscarsacerdote(Request $request)
    {
        $envio=array();

        if(!$request->ajax()) return redirect('/');{
        $persona = DB::table('personas')->where('tipo_persona',1)->get();
        $envio['sacerdote']=$persona;
        $categoriaResumen = CategoriaResumen::where('estado','=','1')
       ->select('id','nombre_categoria','descripcion_categoria')->get();
       $envio['categorias']=$categoriaResumen;
       $iglesia = Iglesia::where('estado','=','1')
       ->get();
       $envio['iglesia']=$iglesia;
        
        return $envio;
    }
    }
    public function buscarsacerdoteG(Request $request)
    {
        

        if(!$request->ajax()) return redirect('/');{
        $persona = DB::table('personas')->where('tipo_persona',1)->get();

        
        
        return $persona;
    }
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
    public function listaB(Request $request)
    {
        $nombre = $request->nombre;
        $apellido = $request->apellido;  
        
        if(!$request->ajax()) return redirect('/');
        if ($nombre == ''){
            if($apellido==''){
                $realizante = DB::table('personas as h')->join('sacramentos as s','s.id_realizante1','=','h.id')
                ->where('s.tipo_sacramento',1)
                ->leftjoin('personas as p','h.id_padre','=','p.id')
                ->leftjoin('personas as m','h.id_madre','=','m.id')
                ->select('s.id','h.id_padre','h.id_madre','s.id_realizante1',
                'h.nombre_persona as hnom','h.apellido_persona as hapellido',
                'p.nombre_persona as pnom','p.apellido_persona as papellido',
                'm.nombre_persona as mnom','m.apellido_persona as mapellido')
                ->paginate(6);
            }else{
                $realizante = DB::table('personas as h')->join('sacramentos as s','s.id_realizante1','=','h.id')
                ->where('s.tipo_sacramento',1)
                ->where('h.apellido_persona', 'like','%' . $apellido .'%')
                ->leftjoin('personas as p','h.id_padre','=','p.id')
                ->leftjoin('personas as m','h.id_madre','=','m.id')
                ->select('s.id','h.id_padre','h.id_madre','s.id_realizante1',
                'h.nombre_persona as hnom','h.apellido_persona as hapellido',
                'p.nombre_persona as pnom','p.apellido_persona as papellido',
                'm.nombre_persona as mnom','m.apellido_persona as mapellido')
                ->paginate(6);
            }
            
        }else{
            if($apellido==''){
                $realizante = DB::table('personas as h')->join('sacramentos as s','s.id_realizante1','=','h.id')
                ->where('s.tipo_sacramento',1)
                ->where('h.nombre_persona','like','%' . $nombre. '%')
                ->leftjoin('personas as p','h.id_padre','=','p.id')
                ->leftjoin('personas as m','h.id_madre','=','m.id')
                ->select('s.id','h.id_padre','h.id_madre','s.id_realizante1',
                'h.nombre_persona as hnom','h.apellido_persona as hapellido',
                'p.nombre_persona as pnom','p.apellido_persona as papellido',
                'm.nombre_persona as mnom','m.apellido_persona as mapellido')
                ->paginate(6);
            }else{
                $realizante = DB::table('personas as h')->join('sacramentos as s','s.id_realizante1','=','h.id')
                ->where('s.tipo_sacramento',1)
                ->where('h.nombre_persona', $nombre)
                ->where('h.apellido_persona', $apellido)
                ->leftjoin('personas as p','h.id_padre','=','p.id')
                ->leftjoin('personas as m','h.id_madre','=','m.id')
                ->select('s.id','h.id_padre','h.id_madre','s.id_realizante1',
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

     public function listaPC(Request $request)
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
                ->select('s.id', 'h.id_padre','h.id_madre',
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
                ->select('s.id', 'h.id_padre','h.id_madre',
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
                ->select('s.id', 'h.id_padre','h.id_madre',
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
                ->select('s.id','h.id_padre','h.id_madre',
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
    public function listaC(Request $request)
    {
        $nombre = $request->nombre;
        $apellido = $request->apellido;  
        
        if(!$request->ajax()) return redirect('/');
        if ($nombre == ''){
            if($apellido==''){
                $realizante = DB::table('personas as h')->join('sacramentos as s','s.id_realizante1','=','h.id')
                ->where('s.tipo_sacramento',3)
                ->leftjoin('personas as p','h.id_padre','=','p.id')
                ->leftjoin('personas as m','h.id_madre','=','m.id')
                ->select('s.id','h.id_padre','h.id_madre','s.id_realizante1',
                'h.nombre_persona as hnom','h.apellido_persona as hapellido',
                'p.nombre_persona as pnom','p.apellido_persona as papellido',
                'm.nombre_persona as mnom','m.apellido_persona as mapellido')
                ->paginate(6);
            }else{
                $realizante = DB::table('personas as h')->join('sacramentos as s','s.id_realizante1','=','h.id')
                ->where('s.tipo_sacramento',3)
                ->where('h.apellido_persona', 'like','%' . $apellido .'%')
                ->leftjoin('personas as p','h.id_padre','=','p.id')
                ->leftjoin('personas as m','h.id_madre','=','m.id')
                ->select('s.id','h.id_padre','h.id_madre','s.id_realizante1',
                'h.nombre_persona as hnom','h.apellido_persona as hapellido',
                'p.nombre_persona as pnom','p.apellido_persona as papellido',
                'm.nombre_persona as mnom','m.apellido_persona as mapellido')
                ->paginate(6);
            }
            
        }else{
            if($apellido==''){
                $realizante = DB::table('personas as h')->join('sacramentos as s','s.id_realizante1','=','h.id')
                ->where('s.tipo_sacramento',3)
                ->where('h.nombre_persona','like','%' . $nombre. '%')
                ->leftjoin('personas as p','h.id_padre','=','p.id')
                ->leftjoin('personas as m','h.id_madre','=','m.id')
                ->select('s.id','h.id_padre','h.id_madre','s.id_realizante1',
                'h.nombre_persona as hnom','h.apellido_persona as hapellido',
                'p.nombre_persona as pnom','p.apellido_persona as papellido',
                'm.nombre_persona as mnom','m.apellido_persona as mapellido')
                ->paginate(6);
            }else{
                $realizante = DB::table('personas as h')->join('sacramentos as s','s.id_realizante1','=','h.id')
                ->where('s.tipo_sacramento',3)
                ->where('h.nombre_persona', $nombre)
                ->where('h.apellido_persona', $apellido)
                ->leftjoin('personas as p','h.id_padre','=','p.id')
                ->leftjoin('personas as m','h.id_madre','=','m.id')
                ->select('s.id','h.id_padre','h.id_madre','s.id_realizante1',
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
    public function listaS(Request $request)
    {
        $nombre = $request->nombre;
        $apellido = $request->apellido;  
        
        if(!$request->ajax()) return redirect('/');
        if ($nombre == ''){
            if($apellido==''){
                $realizante = DB::table('personas as h')->join('sacramentos as s','s.id_realizante1','=','h.id')
                ->where('s.tipo_sacramento',5)
                ->select('s.id','h.id_padre','h.id_madre',
                'h.nombre_persona as hnom','h.apellido_persona as hapellido')
                ->paginate(6);
            }else{
                $realizante = DB::table('personas as h')->join('sacramentos as s','s.id_realizante1','=','h.id')
                ->where('s.tipo_sacramento',5)
                ->where('h.apellido_persona', 'like','%' . $apellido .'%')
                ->select('s.id','h.id_padre','h.id_madre',
                'h.nombre_persona as hnom','h.apellido_persona as hapellido')
                ->paginate(6);
            }
            
        }else{
            if($apellido==''){
                $realizante = DB::table('personas as h')->join('sacramentos as s','s.id_realizante1','=','h.id')
                ->where('s.tipo_sacramento',5)
                ->where('h.nombre_persona','like','%' . $nombre. '%')
                ->select('s.id','h.id_padre','h.id_madre',
                'h.nombre_persona as hnom','h.apellido_persona as hapellido')
                ->paginate(6);
            }else{
                $realizante = DB::table('personas as h')->join('sacramentos as s','s.id_realizante1','=','h.id')
                ->where('s.tipo_sacramento',5)
                ->where('h.nombre_persona', $nombre)
                ->where('h.apellido_persona', $apellido)
                ->select('s.id','h.id_padre','h.id_madre',
                'h.nombre_persona as hnom','h.apellido_persona as hapellido')
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
                $s=2;
                $idpartida_p= PartidaNacimiento::max('id');
                $idpartida=$idpartida_p+1;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='PRIMERA COMUNIÓN';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();
        
        
                $personareali = new Persona();
                $personareali->id=$idreali;
                $personareali->nombre_persona= $request->nombre_reali;
                $personareali->apellido_persona=$request->apellido_reali;
                $personareali->dui_pasaporte=$request->dui_reali;
                $personareali->sexo=$request->sexo;
                $personareali->fecha_nacimiento=$request->nacimiento;
                $personareali->idzonaa=$request->idzona; //zona realizante
                $personareali->idiglesia=$request->idiglesia; //iglesia realizante
                $personareali->estado=1; //estado
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
                $sacramento->tipo_sacramento= $s;
                $sacramento->fecha_realizacion=$request->fecha;
                $sacramento->id_realizante1=$idreali;
                $sacramento->id_sacerdote=$request->sacerdote;
                $sacramento->titulo=$request->titulo;
                $sacramento->save();
                break;
            }
            case '2':
            {
                $id_persona = Persona::max('id');
                        $idm=$id_persona+1;
                        $idreali=$idm+1;
                        $idsacramento_p= Sacramentos3::max('id');
                        $idsacramento=$idsacramento_p+1;
                        $s=2;
                        $idpartida_p= PartidaNacimiento::max('id');
                        $idpartida=$idpartida_p+1;
                        $monto_p= Efectivo::max('id');
                        $montos=$monto_p+1;

                        $efectivo = new Efectivo();
                        $efectivo->id=$montos;
                        $efectivo->descripcion_efectivo='PRIMERA COMUNION';
                        $efectivo->idcare=$request->idcate;
                        $efectivo->tipo= 1;
                        $efectivo->monto=$request->monto;
                        $efectivo->fecha= new \DateTime();
                        $efectivo->save();
        

                        $personap = new Persona();
                        $personap->id= $idm;
                        $personap->nombre_persona= $request->nombre_m;
                        $personap->apellido_persona=$request->apellido_m;
                        $personap->dui_pasaporte=$request->dui_m;
                        $personap->idzonaa=$request->idzonam;  //zona madre
                        $personap->idiglesia=$request->idiglesiam; //iglesia madre
                        $personap->fecha_nacimiento=$request->nacimientom; //fecha nacimiento madre
                        $personap->sexo='F';
                        $personap->estado=1; //estado
                        $personap->save();
        
                        $personareali = new Persona();
                        $personareali->id=$idreali;
                        $personareali->nombre_persona= $request->nombre_reali;
                        $personareali->apellido_persona=$request->apellido_reali;
                        $personareali->dui_pasaporte=$request->dui_reali;
                        $personareali->sexo=$request->sexo;
                        $personareali->fecha_nacimiento=$request->nacimiento;
                        $personareali->idzonaa=$request->idzona;  //zona realizante
                        $personareali->idiglesia=$request->idiglesia; //zona realizante
                        $personareali->estado=1; //estado
                        $personareali->id_madre=$idm;
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
                        $sacramento->tipo_sacramento= $s;
                        $sacramento->fecha_realizacion=$request->fecha;
                        $sacramento->id_realizante1=$idreali;
                        $sacramento->id_sacerdote=$request->sacerdote;
                        $sacramento->titulo=$request->titulo;
                        $sacramento->save();
                break;
            }
            case '3':
            {
                $id_persona = Persona::max('id');
                        $idp=$id_persona+1;
                        $idreali=$idp+1;
                        $idsacramento_p= Sacramentos3::max('id');
                        $idsacramento=$idsacramento_p+1;
                        $s=2;
                        $idpartida_p= PartidaNacimiento::max('id');
                        $idpartida=$idpartida_p+1;
                        $monto_p= Efectivo::max('id');
                        $montos=$monto_p+1;

                        $efectivo = new Efectivo();
                        $efectivo->id=$montos;
                        $efectivo->descripcion_efectivo='PRIMERA COMUNION';
                        $efectivo->idcare=$request->idcate;
                        $efectivo->tipo= 1;
                        $efectivo->monto=$request->monto;
                        $efectivo->fecha= new \DateTime();
                        $efectivo->save();
        

                        $personap = new Persona();
                        $personap->id= $idp;
                        $personap->nombre_persona= $request->nombre_p;
                        $personap->apellido_persona=$request->apellido_p;
                        $personap->dui_pasaporte=$request->dui_p;
                        $personap->idzonaa=$request->idzonap;  //zona padre
                        $personap->idiglesia=$request->idiglesiap; //iglesia padre
                        $personap->fecha_nacimiento=$request->nacimientop; //fecha nacimiento padre
                        $personap->sexo='M';
                        $personap->estado=1; //estado
                        $personap->save();
        
                        $personareali = new Persona();
                        $personareali->id=$idreali;
                        $personareali->nombre_persona= $request->nombre_reali;
                        $personareali->apellido_persona=$request->apellido_reali;
                        $personareali->dui_pasaporte=$request->dui_reali;
                        $personareali->sexo=$request->sexo;
                        $personareali->fecha_nacimiento=$request->nacimiento;
                        $personareali->idzonaa=$request->idzona;  //zona realizante
                        $personareali->idiglesia=$request->idiglesia; //zona realizante
                        $personareali->estado=1; //estado
                        $personareali->id_padre=$idp;
                        $personareali->id_madre=$request->id_m;
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
                        $sacramento->tipo_sacramento= $s;
                        $sacramento->fecha_realizacion=$request->fecha;
                        $sacramento->id_realizante1=$idreali;
                        $sacramento->id_sacerdote=$request->sacerdote;
                        $sacramento->titulo=$request->titulo;
                        $sacramento->save();
                break;
            }
            case '4':
            {
                $id_persona = Persona::max('id');
                        $idp=$id_persona+1;
                        $idm=$idp+1;
                        $idreali=$idm+1;
                        $idsacramento_p= Sacramentos3::max('id');
                        $idsacramento=$idsacramento_p+1;
                        $s=2;
                        $idpartida_p= PartidaNacimiento::max('id');
                        $idpartida=$idpartida_p+1;
                        $monto_p= Efectivo::max('id');
                        $montos=$monto_p+1;

                        $efectivo = new Efectivo();
                        $efectivo->id=$montos;
                        $efectivo->descripcion_efectivo='PRIMERA COMUNION';
                        $efectivo->idcare=$request->idcate;
                        $efectivo->tipo= 1;
                        $efectivo->monto=$request->monto;
                        $efectivo->fecha= new \DateTime();
                        $efectivo->save();
        

                        $personap = new Persona();
                        $personap->id= $idp;
                        $personap->nombre_persona= $request->nombre_p;
                        $personap->apellido_persona=$request->apellido_p;
                        $personap->dui_pasaporte=$request->dui_p;
                        $personap->idzonaa=$request->idzonap;  //zona padre
                        $personap->idiglesia=$request->idiglesiap; //iglesia padre
                        $personap->fecha_nacimiento=$request->nacimientop; //fecha nacimiento padre
                        $personap->sexo='M';
                        $personap->estado=1; //estado
                        $personap->save();

                        $personap = new Persona();
                        $personap->id= $idm;
                        $personap->nombre_persona= $request->nombre_m;
                        $personap->apellido_persona=$request->apellido_m;
                        $personap->dui_pasaporte=$request->dui_m;
                        $personap->idzonaa=$request->idzonam;  //zona madre
                        $personap->idiglesia=$request->idiglesiam; //iglesia madre
                        $personap->fecha_nacimiento=$request->nacimientom; //fecha nacimiento madre
                        $personap->sexo='F';
                        $personap->estado=1; //estado
                        $personap->save();
        
                        $personareali = new Persona();
                        $personareali->id=$idreali;
                        $personareali->nombre_persona= $request->nombre_reali;
                        $personareali->apellido_persona=$request->apellido_reali;
                        $personareali->dui_pasaporte=$request->dui_reali;
                        $personareali->sexo=$request->sexo;
                        $personareali->fecha_nacimiento=$request->nacimiento;
                        $personareali->idzonaa=$request->idzona;  //zona realizante
                        $personareali->idiglesia=$request->idiglesia; //zona realizante
                        $personareali->estado=1; //estado
                        $personareali->id_madre=$idm;
                        $personareali->id_padre=$idp;
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
                        $sacramento->tipo_sacramento= $s;
                        $sacramento->fecha_realizacion=$request->fecha;
                        $sacramento->id_realizante1=$idreali;
                        $sacramento->id_sacerdote=$request->sacerdote;
                        $sacramento->titulo=$request->titulo;
                        $sacramento->save();
                break;
            }
            case '5':
            {
                $id_persona = Persona::max('id');
                        $idreali=$id_persona+1;
                        $idsacramento_p= Sacramentos3::max('id');
                        $idsacramento=$idsacramento_p+1;
                        $s=2;
                        $idpartida_p= PartidaNacimiento::max('id');
                        $idpartida=$idpartida_p+1;
                        $monto_p= Efectivo::max('id');
                        $montos=$monto_p+1;

                        $efectivo = new Efectivo();
                        $efectivo->id=$montos;
                        $efectivo->descripcion_efectivo='PRIMERA COMUNION';
                        $efectivo->idcare=$request->idcate;
                        $efectivo->tipo= 1;
                        $efectivo->monto=$request->monto;
                        $efectivo->fecha= new \DateTime();
                        $efectivo->save();
        
        
                        $personareali = new Persona();
                        $personareali->id=$idreali;
                        $personareali->nombre_persona= $request->nombre_reali;
                        $personareali->apellido_persona=$request->apellido_reali;
                        $personareali->dui_pasaporte=$request->dui_reali;
                        $personareali->sexo=$request->sexo;
                        $personareali->fecha_nacimiento=$request->nacimiento;
                        $personareali->idzonaa=$request->idzona;  //zona realizante
                        $personareali->idiglesia=$request->idiglesia; //zona realizante
                        $personareali->estado=1; //estado
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
                        $sacramento->tipo_sacramento= $s;
                        $sacramento->fecha_realizacion=$request->fecha;
                        $sacramento->id_realizante1=$idreali;
                        $sacramento->id_sacerdote=$request->sacerdote;
                        $sacramento->titulo=$request->titulo;
                        $sacramento->save();
                break;
            }
            case '6':{
                $id_persona = Persona::max('id');
                        $idreali=$id_persona+1;
                        $idsacramento_p= Sacramentos3::max('id');
                        $idsacramento=$idsacramento_p+1;
                        $s=2;
                        $idpartida_p= PartidaNacimiento::max('id');
                        $idpartida=$idpartida_p+1;
                        $monto_p= Efectivo::max('id');
                        $montos=$monto_p+1;

                        $efectivo = new Efectivo();
                        $efectivo->id=$montos;
                        $efectivo->descripcion_efectivo='PRIMERA COMUNION';
                        $efectivo->idcare=$request->idcate;
                        $efectivo->tipo= 1;
                        $efectivo->monto=$request->monto;
                        $efectivo->fecha= new \DateTime();
                        $efectivo->save();

                        $personareali = new Persona();
                        $personareali->id=$idreali;
                        $personareali->nombre_persona= $request->nombre_reali;
                        $personareali->apellido_persona=$request->apellido_reali;
                        $personareali->dui_pasaporte=$request->dui_reali;
                        $personareali->sexo=$request->sexo;
                        $personareali->fecha_nacimiento=$request->nacimiento;
                        $personareali->idzonaa=$request->idzona;  //zona realizante
                        $personareali->idiglesia=$request->idiglesia; //zona realizante
                        $personareali->estado=1; //estado
                        $personareali->id_madre=$request->id_m;
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
                        $sacramento->tipo_sacramento= $s;
                        $sacramento->fecha_realizacion=$request->fecha;
                        $sacramento->id_realizante1=$idreali;
                        $sacramento->id_sacerdote=$request->sacerdote;
                        $sacramento->titulo=$request->titulo;
                        $sacramento->save();
                break;
            }
            case '7':{
                $id_persona = Persona::max('id');
                        $idreali=$id_persona+1;
                        $idsacramento_p= Sacramentos3::max('id');
                        $idsacramento=$idsacramento_p+1;
                        $s=2;
                        $idpartida_p= PartidaNacimiento::max('id');
                        $idpartida=$idpartida_p+1;
                        $monto_p= Efectivo::max('id');
                        $montos=$monto_p+1;

                        $efectivo = new Efectivo();
                        $efectivo->id=$montos;
                        $efectivo->descripcion_efectivo='PRIMERA COMUNION';
                        $efectivo->idcare=$request->idcate;
                        $efectivo->tipo= 1;
                        $efectivo->monto=$request->monto;
                        $efectivo->fecha= new \DateTime();
                        $efectivo->save();

        
                        $personareali = new Persona();
                        $personareali->id=$idreali;
                        $personareali->nombre_persona= $request->nombre_reali;
                        $personareali->apellido_persona=$request->apellido_reali;
                        $personareali->dui_pasaporte=$request->dui_reali;
                        $personareali->sexo=$request->sexo;
                        $personareali->fecha_nacimiento=$request->nacimiento;
                        $personareali->idzonaa=$request->idzona;  //zona realizante
                        $personareali->idiglesia=$request->idiglesia; //zona realizante
                        $personareali->estado=1; //estado
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
                        $sacramento->tipo_sacramento= $s;
                        $sacramento->fecha_realizacion=$request->fecha;
                        $sacramento->id_realizante1=$idreali;
                        $sacramento->id_sacerdote=$request->sacerdote;
                        $sacramento->titulo=$request->titulo;
                        $sacramento->save();
                break;
                
            }
            case '8':{
                $id_persona = Persona::max('id');
                $idm=$id_persona+1;
                $idreali=$idm+1;
                $idsacramento_p= Sacramentos3::max('id');
                $idsacramento=$idsacramento_p+1;
                $s=2;
                $idpartida_p= PartidaNacimiento::max('id');
                $idpartida=$idpartida_p+1;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='PRIMERA COMUNION';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $personap = new Persona();
                $personap->id= $idm;
                $personap->nombre_persona= $request->nombre_m;
                $personap->apellido_persona=$request->apellido_m;
                $personap->dui_pasaporte=$request->dui_m;
                $personap->idzonaa=$request->idzonam;  //zona madre
                $personap->idiglesia=$request->idiglesiam; //iglesia madre
                $personap->fecha_nacimiento=$request->nacimientom; //fecha nacimiento madre
                $personap->sexo='F';
                $personap->estado=1; //estado
                $personap->save();

                $personareali = new Persona();
                $personareali->id=$idreali;
                $personareali->nombre_persona= $request->nombre_reali;
                $personareali->apellido_persona=$request->apellido_reali;
                $personareali->dui_pasaporte=$request->dui_reali;
                $personareali->sexo=$request->sexo;
                $personareali->fecha_nacimiento=$request->nacimiento;
                $personareali->idzonaa=$request->idzona;  //zona realizante
                $personareali->idiglesia=$request->idiglesia; //zona realizante
                $personareali->estado=1; //estado
                $personareali->id_madre=$idm;
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
                $sacramento->tipo_sacramento= $s;
                $sacramento->fecha_realizacion=$request->fecha;
                $sacramento->id_realizante1=$idreali;
                $sacramento->id_sacerdote=$request->sacerdote;
                $sacramento->titulo=$request->titulo;
                $sacramento->save();

                
                  break;
            }
            case '9':{
                $id_persona = Persona::max('id');
                $idp=$id_persona+1;
                $idreali=$idp+1;
                $idsacramento_p= Sacramentos3::max('id');
                $idsacramento=$idsacramento_p+1;
                $s=2;
                $idpartida_p= PartidaNacimiento::max('id');
                $idpartida=$idpartida_p+1;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='PRIMERA COMUNION';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $personap = new Persona();
                $personap->id= $idp;
                $personap->nombre_persona= $request->nombre_p;
                $personap->apellido_persona=$request->apellido_p;
                $personap->dui_pasaporte=$request->dui_p;
                $personap->idzonaa=$request->idzonap;  //zona padre
                $personap->idiglesia=$request->idiglesiap; //iglesia padre
                $personap->fecha_nacimiento=$request->nacimientop; //fecha nacimiento padre
                $personap->sexo='M';
                $personap->estado=1; //estado
                $personap->save();

                $personareali = new Persona();
                $personareali->id=$idreali;
                $personareali->nombre_persona= $request->nombre_reali;
                $personareali->apellido_persona=$request->apellido_reali;
                $personareali->dui_pasaporte=$request->dui_reali;
                $personareali->sexo=$request->sexo;
                $personareali->fecha_nacimiento=$request->nacimiento;
                $personareali->idzonaa=$request->idzona;  //zona realizante
                $personareali->idiglesia=$request->idiglesia; //zona realizante
                $personareali->estado=1; //estado
                $personareali->id_padre=$idp;
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
                $sacramento->tipo_sacramento= $s;
                $sacramento->fecha_realizacion=$request->fecha;
                $sacramento->id_realizante1=$idreali;
                $sacramento->id_sacerdote=$request->sacerdote;
                $sacramento->titulo=$request->titulo;
                $sacramento->save();

                
                break;
                
            }
        }
        
    } //llave funcion

  /*  public function existenciamadre(Request $request){ //GLORIA
        
        $nombremadre=$request->nombre_persona;
        $apellidomadre3=$request->apellido_persona;
        $fechanam=$request->fecha_nacimiento;
        $envio=array();

         // if(!$request->ajax()) return redirect('/');
        $idm=DB::table('personas')
                    ->where('nombre_persona',$nombremadre)
                    ->where('apellido_persona',$apellidomadre3)
                    ->where('fecha_nacimiento',$fechanam)->first();

            if(empty($idm)){
                $envio['existenciamadre']=1; //esa persona no existe.
            }else{
                $datoshijos=DB::table('personas')->select('id','nombre_persona','apellido_persona')
                                ->where('id_madre','=',$idm->id)->first();
                                
                    if(empty($datoshijos)){
                        $envio['existenciamadre']=2; //la persona existe
                        $envio['hijos']=1; //la persona no tiene hijos
                        $envio['idmm']=$idm; //id de la madre
                    }else{
                        $envio['existenciamadre']=2; //la persona existe
                        $envio['hijos']=2; //la persona tiene hijos
                        $envio['idmm']=$idm; //id de la madre
                    }
            }

         return $envio;

    }

    public function obtenerDatosMadre(Request $request){

        $buscar = $request->idmadre;
        $envio=array();

        //if(!$request->ajax()) return redirect('/');
        $datoshijos=DB::table('personas')->select('id','nombre_persona','apellido_persona')
                         ->where('id_madre','=',$buscar)->get();
        
        $datomadre=DB::table('personas')->where('id','=',$buscar)->first();

         $envio['datoshijos']=$datoshijos; //datos de los hijos
         $envio['datosmadre']=$datomadre; //datos de la madre
        
        return $envio;
    } */

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

    ///////////////////////////////////////////////MANTENIMIENTO PERSONAS RELIGIOSAS///////////////////////////////////////////////////////////

    public function indexRel(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
  
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        
        if ($buscar == ''){
            $religiosos = Persona::where('estado','1')
                            ->where('tipo_persona','=',1)            
            ->orderBy('id')->get();
        } else {
            $religiosos = Persona::where($criterio, 'like','%' . $buscar .'%')
            ->where('estado','1')
            ->where('tipo_persona','=',1)
            ->orderBy('id')->get();
        }
        return $religiosos;
    }

    public function eliminarReli(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
        $cambiar=2;
     
        $religiosos = DB::table('personas')->where("id",$id->id)->update(["estado"=>$cambiar]);
    }


    public function storeReli(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $this->validate($request, [
           'nombre_persona'=> 'required|min:3|max:70',
           'apellido_persona'=> 'required|min:3|max:70',


        ]);
  
        $id_religioso = Persona::max('id');
        $id=$id_religioso+1;
           

        $religiosos = new Persona();
        $religiosos->id=$id;
        $religiosos->nombre_persona= $request->nombre_persona;
        $religiosos->apellido_persona=$request->apellido_persona;
        $religiosos->dui_pasaporte=$request->dui_pasaporte;
        $religiosos->estado=1;
        $religiosos->tipo_persona=1;
        $religiosos->save();
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateReli(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
        $this->validate($id, [
            'nombre_persona'=> 'required|min:3|max:70',
            'apellido_persona'=> 'required|min:3|max:70',
        
         ]);
        $religiosos = DB::table('personas')->where("id",$id->id)->update(["nombre_persona"=>$id->nombre_persona, "apellido_persona" => $id->apellido_persona, "dui_pasaporte" => $id->dui_pasaporte]);
    }

    public function buscarReli(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
       $religiosos = DB::table('personas')->where("id",$id->id)
       ->where('tipo_persona','=',1)
       ->first();
       return response()->json($religiosos);    
    }
}
