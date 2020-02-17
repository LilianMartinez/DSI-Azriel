<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//importamos el modelo Sacramento
use App\Sacramento;
use App\Persona;
use App\Efectivo;
//usamos esto para poder usar las funciones DB::table
use Illuminate\Support\Facades\DB;
//El carbón es para darle fuego a las fechas :v
use Carbon\Carbon;

class SacramentoController extends Controller
{
    
    //Aquí listamos todos los registros de la tabla Sacramento
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;  

          if ($buscar==''){
            $sacramentos = DB::table('sacramentos as s')
            ->leftjoin('personas as p1', 's.id_realizante1','=','p1.id')
            ->leftjoin('personas as p2', 's.id_realizante2','=','p2.id')
            ->leftjoin('personas as pad1', 's.id_padrino','=','pad1.id')
            ->leftjoin('personas as mad1', 's.id_padrino2','=','mad1.id')
            ->leftjoin('personas as pad2', 's.id_padrino3','=','pad2.id')
            ->leftjoin('personas as mad2', 's.id_padrino4','=','mad2.id')
            ->leftjoin('personas as sacerdote', 's.id_sacerdote','=','sacerdote.id')

            ->select('s.id', 's.libro', 's.num_expediente', 's.estado',
            'p1.dui_pasaporte as novioD','p1.nombre_persona as novioNom', 'p1.apellido_persona as novioAp', 'p1.id as idNovio',
            'p2.dui_pasaporte as noviaD', 'p2.nombre_persona as noviaNom', 'p2.apellido_persona as noviaAp', 'p2.id as idNovia',
            'pad1.dui_pasaporte as pad1D', 'pad1.nombre_persona as pad1Nom', 'pad1.apellido_persona as pad1Ap', 'pad1.id as id_padrino',
            'mad1.dui_pasaporte as mad1D', 'mad1.nombre_persona as mad1Nom', 'mad1.apellido_persona as mad1Ap', 'mad1.id as id_madrina1',
            'pad2.dui_pasaporte as pad2D', 'pad2.nombre_persona as pad2Nom', 'pad2.apellido_persona as pad2Ap', 'pad2.id as id_padrino2',
            'mad2.dui_pasaporte as mad2D', 'mad2.nombre_persona as mad2Nom', 'mad2.apellido_persona as mad2Ap', 'mad2.id as id_madrina2',
            'sacerdote.dui_pasaporte as sacerdoteD', 'sacerdote.nombre_persona as sacerdoteNom', 'sacerdote.apellido_persona as sacerdoteAp', 'sacerdote.id as id_sacerdote')
            ->where('s.tipo_sacramento','=',4)
            ->orderBy('s.id', 'desc')
            ->paginate(10);
            
        }
        else{
            if($criterio=='libro' || $criterio=='num_expediente'){//Cuando buscamos algo de la tabla sacramentos
                $sacramentos = DB::table('sacramentos as s')
                ->leftjoin('personas as p1', 's.id_realizante1','=','p1.id')
                ->leftjoin('personas as p2', 's.id_realizante2','=','p2.id')
                ->leftjoin('personas as pad1', 's.id_padrino','=','pad1.id')
                ->leftjoin('personas as mad1', 's.id_padrino2','=','mad1.id')
                ->leftjoin('personas as pad2', 's.id_padrino3','=','pad2.id')
                ->leftjoin('personas as mad2', 's.id_padrino4','=','mad2.id')
                ->leftjoin('personas as sacerdote', 's.id_sacerdote','=','sacerdote.id')
                
                ->select('s.id', 's.libro', 's.num_expediente', 's.estado',
                'p1.dui_pasaporte as novioD','p1.nombre_persona as novioNom', 'p1.apellido_persona as novioAp', 'p1.id as idNovio',
                'p2.dui_pasaporte as noviaD', 'p2.nombre_persona as noviaNom', 'p2.apellido_persona as noviaAp', 'p2.id as idNovia',
                'pad1.dui_pasaporte as pad1D', 'pad1.nombre_persona as pad1Nom', 'pad1.apellido_persona as pad1Ap', 'pad1.id as id_padrino',
                'mad1.dui_pasaporte as mad1D', 'mad1.nombre_persona as mad1Nom', 'mad1.apellido_persona as mad1Ap', 'mad1.id as id_madrina1',
                'pad2.dui_pasaporte as pad2D', 'pad2.nombre_persona as pad2Nom', 'pad2.apellido_persona as pad2Ap', 'pad2.id as id_padrino2',
                'mad2.dui_pasaporte as mad2D', 'mad2.nombre_persona as mad2Nom', 'mad2.apellido_persona as mad2Ap', 'mad2.id as id_madrina2',
                'sacerdote.dui_pasaporte as sacerdoteD', 'sacerdote.nombre_persona as sacerdoteNom', 'sacerdote.apellido_persona as sacerdoteAp', 'sacerdote.id as id_sacerdote')                     
                ->where('s.tipo_sacramento','=',4)
                ->where('s.'.$criterio, 'like', '%'. $buscar . '%')
                ->orderBy('s.id', 'desc')->paginate(10);
            }else{
                if($criterio=='Apellidos'){//cuando buscamos algo de la tabla persona 1
                    $sacramentos = DB::table('sacramentos as s')
                    ->leftjoin('personas as p1', 's.id_realizante1','=','p1.id')
                    ->leftjoin('personas as p2', 's.id_realizante2','=','p2.id')
                    ->leftjoin('personas as pad1', 's.id_padrino','=','pad1.id')
                    ->leftjoin('personas as mad1', 's.id_padrino2','=','mad1.id')
                    ->leftjoin('personas as pad2', 's.id_padrino3','=','pad2.id')
                    ->leftjoin('personas as mad2', 's.id_padrino4','=','mad2.id')
                    ->leftjoin('personas as sacerdote', 's.id_sacerdote','=','sacerdote.id')
                
                    ->select('s.id', 's.libro', 's.num_expediente', 's.estado',
                    'p1.dui_pasaporte as novioD','p1.nombre_persona as novioNom', 'p1.apellido_persona as novioAp', 'p1.id as idNovio',
                    'p2.dui_pasaporte as noviaD', 'p2.nombre_persona as noviaNom', 'p2.apellido_persona as noviaAp', 'p2.id as idNovia',
                    'pad1.dui_pasaporte as pad1D', 'pad1.nombre_persona as pad1Nom', 'pad1.apellido_persona as pad1Ap', 'pad1.id as id_padrino',
                    'mad1.dui_pasaporte as mad1D', 'mad1.nombre_persona as mad1Nom', 'mad1.apellido_persona as mad1Ap', 'mad1.id as id_madrina1',
                    'pad2.dui_pasaporte as pad2D', 'pad2.nombre_persona as pad2Nom', 'pad2.apellido_persona as pad2Ap', 'pad2.id as id_padrino2',
                    'mad2.dui_pasaporte as mad2D', 'mad2.nombre_persona as mad2Nom', 'mad2.apellido_persona as mad2Ap', 'mad2.id as id_madrina2',
                    'sacerdote.dui_pasaporte as sacerdoteD', 'sacerdote.nombre_persona as sacerdoteNom', 'sacerdote.apellido_persona as sacerdoteAp', 'sacerdote.id as id_sacerdote')                     
                    ->where('s.tipo_sacramento','=',4)
                    ->where('p1.apellido_persona', 'like', '%'. $buscar . '%')
                    ->orWhere('p2.apellido_persona', 'like', '%'. $buscar . '%')
                    ->orderBy('s.id', 'desc')->paginate(10);
                }else{//cuando buscamos algo de la tabla persona 2
                    $sacramentos = DB::table('sacramentos as s')
                    ->leftjoin('personas as p1', 's.id_realizante1','=','p1.id')
                    ->leftjoin('personas as p2', 's.id_realizante2','=','p2.id')
                    ->leftjoin('personas as pad1', 's.id_padrino','=','pad1.id')
                    ->leftjoin('personas as mad1', 's.id_padrino2','=','mad1.id')
                    ->leftjoin('personas as pad2', 's.id_padrino3','=','pad2.id')
                    ->leftjoin('personas as mad2', 's.id_padrino4','=','mad2.id')
                    ->leftjoin('personas as sacerdote', 's.id_sacerdote','=','sacerdote.id')
                
                    ->select('s.id', 's.libro', 's.num_expediente', 's.estado',
                    'p1.dui_pasaporte as novioD','p1.nombre_persona as novioNom', 'p1.apellido_persona as novioAp', 'p1.id as idNovio',
                    'p2.dui_pasaporte as noviaD', 'p2.nombre_persona as noviaNom', 'p2.apellido_persona as noviaAp', 'p2.id as idNovia',
                    'pad1.dui_pasaporte as pad1D', 'pad1.nombre_persona as pad1Nom', 'pad1.apellido_persona as pad1Ap', 'pad1.id as id_padrino',
                    'mad1.dui_pasaporte as mad1D', 'mad1.nombre_persona as mad1Nom', 'mad1.apellido_persona as mad1Ap', 'mad1.id as id_madrina1',
                    'pad2.dui_pasaporte as pad2D', 'pad2.nombre_persona as pad2Nom', 'pad2.apellido_persona as pad2Ap', 'pad2.id as id_padrino2',
                    'mad2.dui_pasaporte as mad2D', 'mad2.nombre_persona as mad2Nom', 'mad2.apellido_persona as mad2Ap', 'mad2.id as id_madrina2',
                    'sacerdote.dui_pasaporte as sacerdoteD', 'sacerdote.nombre_persona as sacerdoteNom', 'sacerdote.apellido_persona as sacerdoteAp', 'sacerdote.id as id_sacerdote')                     
                    ->where('s.tipo_sacramento','=',4)
                    ->where('p1.nombre_persona', 'like', '%'. $buscar . '%')
                    ->orWhere('p2.nombre_persona', 'like', '%'. $buscar . '%')
                    ->orderBy('s.id', 'desc')->paginate(10);
                }
            }
        }
         
 
        return [
            'pagination' => [
                'total'        => $sacramentos->total(),
                'current_page' => $sacramentos->currentPage(),
                'per_page'     => $sacramentos->perPage(),
                'last_page'    => $sacramentos->lastPage(),
                'from'         => $sacramentos->firstItem(),
                'to'           => $sacramentos->lastItem(),
            ],
            'sacramentos' => $sacramentos
        ];
        
        /*$sacramentos = Sacramento::all();
        return $sacramentos;*/
    }
    
    //Aquí declaramos objeto sacramento que instancie a la clase categoría (el modelo)
    //este store no lo ocupamos para el expediente de matrimonio, ya que lo hacemos en el controlador de persona
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sacramento = new Sacramento();
        $sacramento->id_realizante1 = $request->id_realizante1;
        $sacramento->libro = $request->libro;
        $sacramento->folio = $request->folio;
        $sacramento->asiento = $request->asiento;
        $sacramento->num_expediente = $request->num_expediente;
        $sacramento->fecha_realizacion = $request->fecha_realizacion;
        //$sacramento->id_realizante1 = $request->id_realizante1;
        $sacramento->id_realizante2 = $request->id_realizante2;
        $sacramento->id_sacerdote = $request->id_sacerdote;
        $sacramento->id_padrino = $request->id_padrino;
        $sacramento->id_padrino2 = $request->id_padrino2;
        $sacramento->id_padrino3 = $request->id_padrino3;
        $sacramento->id_padrino4 = $request->id_padrino4;
        $sacramento->id_iglesia = $request->id_iglesia;
        //guardamos objeto creado en la DB
        $sacramento->save();
    }

    public function registrarboda(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $tipo=$request->tipo;

        switch($tipo){
            /* Guardar 1 padrino (1-2)    *
             * Guardar 2 padrinos (3-6)   *
             * Guardar 3 padrinos (7-14)  *
             * Guardar 4 padrinos (15-30) */
            case '1':
            {
                //Creamos el pad1
                $persona_idMax = Persona::max('id');
                $id_pad1=$persona_idMax+1; //utilizo las variables $id_pad1 y etc, solo dentro de este método
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();
        
                $pad1 = new Persona();
                $pad1->id=$id_pad1;
                $pad1->nombre_persona= $request->pad1Nom;
                $pad1->apellido_persona=$request->pad1Ap;
                $pad1->dui_pasaporte=$request->pad1D;
                $pad1->sexo=$request->pad1Sexo;
                $pad1->idzonaa=$request->idzonap1; //zona p1
                $pad1->idiglesia=$request->idiglesiap1; //zona p1
                $pad1->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $pad1->estado=1;
                $pad1->save();
        
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2; //QUITAR DE AQUÍ ESTO, Y PONERLO EN BOTÓN "MATRIMONIO REALIZADO"
                $sacramento->save();
                break;
            }

            case '2':
            {
                //Recuperamos pad1
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $id_pad1=$request->id_padrino1;

                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->titulo=$request->titulo;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->fecha_realizacion=$request->fecha_realizacion;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '3':
            {
                //Creamos pad1 y mad1
                $persona_idMax = Persona::max('id');
                $id_pad1=$persona_idMax+1; //utilizo las variables $id_pad1 y etc, solo dentro de este método
                $id_mad1=$id_pad1+1;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();
        
                $pad1 = new Persona();
                $pad1->id=$id_pad1;
                $pad1->nombre_persona= $request->pad1Nom;
                $pad1->apellido_persona=$request->pad1Ap;
                $pad1->dui_pasaporte=$request->pad1D;
                $pad1->sexo=$request->pad1Sexo;
                $pad1->estado=1;
                $pad1->idzonaa=$request->idzonap1; //zona p1
                $pad1->idiglesia=$request->idiglesiap1; //zona p1
                $pad1->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $pad1->save();

                $pad2 = new Persona();
                $pad2->id=$id_mad1;
                $pad2->nombre_persona= $request->mad1Nom;
                $pad2->apellido_persona=$request->mad1Ap;
                $pad2->dui_pasaporte=$request->mad1D;
                $pad2->sexo=$request->mad1Sexo;
                $pad2->estado=1;
                $pad2->idzonaa=$request->idzonap2; //zona p2
                $pad2->idiglesia=$request->idiglesiap2; //zona p2
                $pad2->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $pad2->save();
        
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '4':
            {
                //Creamos mad1; recuperamos pad1
                $persona_idMax = Persona::max('id');
                $id_mad1=$persona_idMax+1;
                $id_pad1=$request->id_padrino1;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad2 = new Persona();
                $pad2->id=$id_mad1;
                $pad2->nombre_persona= $request->mad1Nom;
                $pad2->apellido_persona=$request->mad1Ap;
                $pad2->dui_pasaporte=$request->mad1D;
                $pad2->sexo=$request->mad1Sexo;
                $pad2->estado=1;
                $pad2->idzonaa=$request->idzonap2; //zona p2
                $pad2->idiglesia=$request->idiglesiap2; //zona p2
                $pad2->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $pad2->save();
        
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '5':
            {
                //Creamos pad1; recuperamos mad1
                $persona_idMax = Persona::max('id');
                $id_pad1=$persona_idMax+1;
                $id_mad1=$request->id_madrina1;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad1 = new Persona();
                $pad1->id=$id_pad1;
                $pad1->nombre_persona= $request->pad1Nom;
                $pad1->apellido_persona=$request->pad1Ap;
                $pad1->dui_pasaporte=$request->pad1D;
                $pad1->sexo=$request->pad1Sexo;
                $pad1->estado=1;
                $pad1->idzonaa=$request->idzonap1; //zona p1
                $pad1->idiglesia=$request->idiglesiap1; //zona p1
                $pad1->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $pad1->save();

                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '6':
            {
                //Recuperamos pad1 y mad1
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $id_pad1=$request->id_padrino1;
                $id_mad1=$request->id_madrina1;

                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->fecha_realizacion=$request->fecha_realizacion;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '7':
            {
                //Creamos pad1, pad2 y mad1
                $persona_idMax = Persona::max('id');
                $id_pad1=$persona_idMax+1; //utilizo las variables $id_pad1 y etc, solo dentro de este método
                $id_mad1=$id_pad1+1;
                $id_pad2=$id_mad1+1;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();
        
                $pad1 = new Persona();
                $pad1->id=$id_pad1;
                $pad1->nombre_persona= $request->pad1Nom;
                $pad1->apellido_persona=$request->pad1Ap;
                $pad1->dui_pasaporte=$request->pad1D;
                $pad1->sexo=$request->pad1Sexo;
                $pad1->estado=1;
                $pad1->idzonaa=$request->idzonap1; //zona p1
                $pad1->idiglesia=$request->idiglesiap1; //zona p1
                $pad1->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $pad1->save();

                $pad2 = new Persona();
                $pad2->id=$id_mad1;
                $pad2->nombre_persona= $request->mad1Nom;
                $pad2->apellido_persona=$request->mad1Ap;
                $pad2->dui_pasaporte=$request->mad1D;
                $pad2->sexo=$request->mad1Sexo;
                $pad2->estado=1;
                $pad2->idzonaa=$request->idzonap2; //zona p2
                $pad2->idiglesia=$request->idiglesiap2; //zona p2
                $pad2->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $pad2->save();

                $pad3 = new Persona();
                $pad3->id=$id_pad2;
                $pad3->nombre_persona= $request->pad2Nom;
                $pad3->apellido_persona=$request->pad2Ap;
                $pad3->dui_pasaporte=$request->pad2D;
                $pad3->sexo=$request->pad2Sexo;
                $pad3->estado=1;                
                $pad3->idzonaa=$request->idzonap3; //zona p3
                $pad3->idiglesia=$request->idiglesiap3; //zona p3
                $pad3->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $pad3->save();
        
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '8':
            {
                //Creamos mad1 y pad2; recuperamos pad1
                $persona_idMax = Persona::max('id');
                $id_mad1=$persona_idMax+1;
                $id_pad2=$id_mad1+1;
                $id_pad1=$request->id_padrino1;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad2 = new Persona();
                $pad2->id=$id_mad1;
                $pad2->nombre_persona= $request->mad1Nom;
                $pad2->apellido_persona=$request->mad1Ap;
                $pad2->dui_pasaporte=$request->mad1D;
                $pad2->sexo=$request->mad1Sexo;
                $pad2->estado=1;
                $pad2->idzonaa=$request->idzonap2; //zona p2
                $pad2->idiglesia=$request->idiglesiap2; //zona p2
                $pad2->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $pad2->save();

                $pad3 = new Persona();
                $pad3->id=$id_pad2;
                $pad3->nombre_persona= $request->pad2Nom;
                $pad3->apellido_persona=$request->pad2Ap;
                $pad3->dui_pasaporte=$request->pad2D;
                $pad3->sexo=$request->pad2Sexo;
                $pad3->estado=1;
                $pad3->idzonaa=$request->idzonap3; //zona p3
                $pad3->idiglesia=$request->idiglesiap3; //zona p3
                $pad3->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $pad3->save();

                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '9':
            {
                //Creamos pad1 y pad2; recuperamos mad1
                $persona_idMax = Persona::max('id');
                $id_pad1=$persona_idMax+1;
                $id_pad2=$id_pad1+1;
                $id_mad1=$request->id_padrino1;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad1 = new Persona();
                $pad1->id=$id_pad1;
                $pad1->nombre_persona= $request->pad1Nom;
                $pad1->apellido_persona=$request->pad1Ap;
                $pad1->dui_pasaporte=$request->pad1D;
                $pad1->sexo=$request->pad1Sexo;
                $pad1->estado=1;
                $pad1->idzonaa=$request->idzonap1; //zona p1
                $pad1->idiglesia=$request->idiglesiap1; //zona p1
                $pad1->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $pad1->save();

                $pad3 = new Persona();
                $pad3->id=$id_pad2;
                $pad3->nombre_persona= $request->pad2Nom;
                $pad3->apellido_persona=$request->pad2Ap;
                $pad3->dui_pasaporte=$request->pad2D;
                $pad3->sexo=$request->pad2Sexo;
                $pad3->estado=1;
                $pad3->idzonaa=$request->idzonap3; //zona p3
                $pad3->idiglesia=$request->idiglesiap3; //zona p3
                $pad3->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $pad3->save();

                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '10':
            {
                //Creamos pad2; Recuperamos pad1 y mad1
                $persona_idMax = Persona::max('id');
                $id_pad2=$persona_idMax+1;
                $id_pad1=$request->id_padrino1;
                $id_mad1=$request->id_madrina1;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad3 = new Persona();
                $pad3->id=$id_pad2;
                $pad3->nombre_persona= $request->pad2Nom;
                $pad3->apellido_persona=$request->pad2Ap;
                $pad3->dui_pasaporte=$request->pad2D;
                $pad3->sexo=$request->pad2Sexo;
                $pad3->estado=1;
                $pad3->idzonaa=$request->idzonap3; //zona p3
                $pad3->idiglesia=$request->idiglesiap3; //zona p3
                $pad3->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $pad3->save();

                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '11':
            {
                //Creamos pad1 y mad1; Recuperamos pad2
                $persona_idMax = Persona::max('id');
                $id_pad1=$persona_idMax+1;
                $id_mad1=$id_pad1+1;
                $id_pad2=$request->id_padrino2;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad1 = new Persona();
                $pad1->id=$id_pad1;
                $pad1->nombre_persona= $request->pad1Nom;
                $pad1->apellido_persona=$request->pad1Ap;
                $pad1->dui_pasaporte=$request->pad1D;
                $pad1->sexo=$request->pad1Sexo;
                $pad1->estado=1;
                $pad1->idzonaa=$request->idzonap1; //zona p1
                $pad1->idiglesia=$request->idiglesiap1; //zona p1
                $pad1->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $pad1->save();

                $pad2 = new Persona();
                $pad2->id=$id_mad1;
                $pad2->nombre_persona= $request->mad1Nom;
                $pad2->apellido_persona=$request->mad1Ap;
                $pad2->dui_pasaporte=$request->mad1D;
                $pad2->sexo=$request->mad1Sexo;
                $pad2->estado=1;
                $pad2->idzonaa=$request->idzonap2; //zona p2
                $pad2->idiglesia=$request->idiglesiap2; //zona p2
                $pad2->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $pad2->save();

                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '12':
            {
                //Creamos mad1; recuperamos pad1 y pad2
                $persona_idMax = Persona::max('id');
                $id_mad1=$persona_idMax+1;
                $id_pad1=$request->id_padrino1;
                $id_pad2=$request->id_padrino2;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad2 = new Persona();
                $pad2->id=$id_mad1;
                $pad2->nombre_persona= $request->mad1Nom;
                $pad2->apellido_persona=$request->mad1Ap;
                $pad2->dui_pasaporte=$request->mad1D;
                $pad2->sexo=$request->mad1Sexo;
                $pad2->estado=1;
                $pad2->idzonaa=$request->idzonap2; //zona p2
                $pad2->idiglesia=$request->idiglesiap2; //zona p2
                $pad2->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $pad2->save();

                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '13':
            {
                //Creamos pad1; recuperamos mad1 y pad2
                $persona_idMax = Persona::max('id');
                $id_pad1=$persona_idMax+1;
                $id_mad1=$request->id_padrino1;
                $id_pad2=$request->id_padrino2;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad1 = new Persona();
                $pad1->id=$id_pad1;
                $pad1->nombre_persona= $request->pad1Nom;
                $pad1->apellido_persona=$request->pad1Ap;
                $pad1->dui_pasaporte=$request->pad1D;
                $pad1->sexo=$request->pad1Sexo;
                $pad1->estado=1;
                $pad1->idzonaa=$request->idzonap1; //zona p1
                $pad1->idiglesia=$request->idiglesiap1; //zona p1
                $pad1->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $pad1->save();

                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '14':
            {
                //Recuperamos pad1, pad2 y mad1
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $id_pad1=$request->id_padrino1;
                $id_mad1=$request->id_madrina1;
                $id_pad2=$request->id_padrino2;

                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->fecha_realizacion=$request->fecha_realizacion;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '15': //Ingresamos todos los datos por primera vez
            {
                //Este es para ingresar todos los datos por primera vez
                $persona_idMax = Persona::max('id');
                $id_pad1=$persona_idMax+1; //utilizo las variables $id_pad1 y etc, solo dentro de este método
                $id_mad1=$id_pad1+1;
                $id_pad2=$id_mad1+1;
                $id_mad2=$id_pad2+1;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();
        
                $pad1 = new Persona();
                $pad1->id=$id_pad1;
                $pad1->nombre_persona= $request->pad1Nom;
                $pad1->apellido_persona=$request->pad1Ap;
                $pad1->dui_pasaporte=$request->pad1D;
                $pad1->sexo=$request->pad1Sexo;
                $pad1->estado=1;
                $pad1->idzonaa=$request->idzonap1; //zona p1
                $pad1->idiglesia=$request->idiglesiap1; //zona p1
                $pad1->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $pad1->save();

                $pad2 = new Persona();
                $pad2->id=$id_mad1;
                $pad2->nombre_persona= $request->mad1Nom;
                $pad2->apellido_persona=$request->mad1Ap;
                $pad2->dui_pasaporte=$request->mad1D;
                $pad2->sexo=$request->mad1Sexo;
                $pad2->estado=1;
                $pad2->idzonaa=$request->idzonap2; //zona p2
                $pad2->idiglesia=$request->idiglesiap2; //zona p2
                $pad2->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $pad2->save();

                $pad3 = new Persona();
                $pad3->id=$id_pad2;
                $pad3->nombre_persona= $request->pad2Nom;
                $pad3->apellido_persona=$request->pad2Ap;
                $pad3->dui_pasaporte=$request->pad2D;
                $pad3->sexo=$request->pad2Sexo;
                $pad3->estado=1;
                $pad3->idzonaa=$request->idzonap3; //zona p3
                $pad3->idiglesia=$request->idiglesiap3; //zona p3
                $pad3->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $pad3->save();

                $pad4 = new Persona();
                $pad4->id=$id_mad2;
                $pad4->nombre_persona= $request->mad2Nom;
                $pad4->apellido_persona=$request->mad2Ap;
                $pad4->dui_pasaporte=$request->mad2D;
                $pad4->sexo=$request->mad2Sexo;
                $pad4->estado=1;
                $pad4->idzonaa=$request->idzonap4; //zona p4
                $pad4->idiglesia=$request->idiglesiap4; //zona p4
                $pad4->fecha_nacimiento=$request->fechanap4; //fecha nacimiento p4
                $pad4->save();
        
                //En esta etapa, solo se almacenan los datos para abrir un nuevo expediente (no hay datos de padrino y boda hasta la siguiente etapa en "actualizar")
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '16':
            {
                // Recuperamos pad1, creamos los otros 3
                $persona_idMax = Persona::max('id');
                $id_mad1=$persona_idMax+1;
                $id_pad2=$id_mad1+1;
                $id_mad2=$id_pad2+1;
                $id_pad1=$request->id_padrino1;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad2 = new Persona();
                $pad2->id=$id_mad1;
                $pad2->nombre_persona= $request->mad1Nom;
                $pad2->apellido_persona=$request->mad1Ap;
                $pad2->dui_pasaporte=$request->mad1D;
                $pad2->sexo=$request->mad1Sexo;
                $pad2->estado=1;
                $pad2->idzonaa=$request->idzonap2; //zona p2
                $pad2->idiglesia=$request->idiglesiap2; //zona p2
                $pad2->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $pad2->save();

                $pad3 = new Persona();
                $pad3->id=$id_pad2;
                $pad3->nombre_persona= $request->pad2Nom;
                $pad3->apellido_persona=$request->pad2Ap;
                $pad3->dui_pasaporte=$request->pad2D;
                $pad3->sexo=$request->pad2Sexo;
                $pad3->estado=1;
                $pad3->idzonaa=$request->idzonap3; //zona p3
                $pad3->idiglesia=$request->idiglesiap3; //zona p3
                $pad3->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $pad3->save();

                $pad4 = new Persona();
                $pad4->id=$id_mad2;
                $pad4->nombre_persona= $request->mad2Nom;
                $pad4->apellido_persona=$request->mad2Ap;
                $pad4->dui_pasaporte=$request->mad2D;
                $pad4->sexo=$request->mad2Sexo;
                $pad4->estado=1;
                $pad4->idzonaa=$request->idzonap4; //zona p4
                $pad4->idiglesia=$request->idiglesiap4; //zona p4
                $pad4->fecha_nacimiento=$request->fechanap4; //fecha nacimiento p4
                $pad4->save();
        
                //En esta etapa, solo se almacenan los datos para abrir un nuevo expediente (no hay datos de padrino y boda hasta la siguiente etapa en "actualizar")
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;

            }

            case '17':
            {
                //Recuperaremos madrina1; crearemos los otros 3
                $persona_idMax = Persona::max('id');
                $id_pad1=$persona_idMax+1;
                $id_pad2=$id_pad1+1;
                $id_mad2=$id_pad2+1;
                $id_mad1=$request->id_madrina1;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad1 = new Persona();
                $pad1->id=$id_pad1;
                $pad1->nombre_persona= $request->pad1Nom;
                $pad1->apellido_persona=$request->pad1Ap;
                $pad1->dui_pasaporte=$request->pad1D;
                $pad1->sexo=$request->pad1Sexo;
                $pad1->estado=1;
                $pad1->idzonaa=$request->idzonap1; //zona p1
                $pad1->idiglesia=$request->idiglesiap1; //zona p1
                $pad1->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $pad1->save();

                $pad3 = new Persona();
                $pad3->id=$id_pad2;
                $pad3->nombre_persona= $request->pad2Nom;
                $pad3->apellido_persona=$request->pad2Ap;
                $pad3->dui_pasaporte=$request->pad2D;
                $pad3->sexo=$request->pad2Sexo;
                $pad3->estado=1;
                $pad3->idzonaa=$request->idzonap3; //zona p3
                $pad3->idiglesia=$request->idiglesiap3; //zona p3
                $pad3->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $pad3->save();

                $pad4 = new Persona();
                $pad4->id=$id_mad2;
                $pad4->nombre_persona= $request->mad2Nom;
                $pad4->apellido_persona=$request->mad2Ap;
                $pad4->dui_pasaporte=$request->mad2D;
                $pad4->sexo=$request->mad2Sexo;
                $pad4->estado=1;
                $pad4->idzonaa=$request->idzonap4; //zona p4
                $pad4->idiglesia=$request->idiglesiap4; //zona p4
                $pad4->fecha_nacimiento=$request->fechanap4; //fecha nacimiento p4
                $pad4->save();
        
                //Esta parte de Sacramento No cambiará en ningun de los otros casos
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '18':
            {
                //recuperaremos madrina 1 y padrino 1; Y creamos los otros 2
                $persona_idMax = Persona::max('id');
                $id_pad2=$persona_idMax+1;
                $id_mad2=$id_pad2+1;
                $id_pad1=$request->id_padrino1;
                $id_mad1=$request->id_madrina1;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad3 = new Persona();
                $pad3->id=$id_pad2;
                $pad3->nombre_persona= $request->pad2Nom;
                $pad3->apellido_persona=$request->pad2Ap;
                $pad3->dui_pasaporte=$request->pad2D;
                $pad3->sexo=$request->pad2Sexo;
                $pad3->estado=1;
                $pad3->idzonaa=$request->idzonap3; //zona p3
                $pad3->idiglesia=$request->idiglesiap3; //zona p3
                $pad3->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $pad3->save();

                $pad4 = new Persona();
                $pad4->id=$id_mad2;
                $pad4->nombre_persona= $request->mad2Nom;
                $pad4->apellido_persona=$request->mad2Ap;
                $pad4->dui_pasaporte=$request->mad2D;
                $pad4->sexo=$request->mad2Sexo;
                $pad4->estado=1;
                $pad4->idzonaa=$request->idzonap4; //zona p4
                $pad4->idiglesia=$request->idiglesiap4; //zona p4
                $pad4->fecha_nacimiento=$request->fechanap4; //fecha nacimiento p4
                $pad4->save();
        
                //Esta parte de Sacramento No cambiará en ningun de los otros casos
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '19':
            {
                //traemos padrino2 y creamos los otros 3
                $persona_idMax = Persona::max('id');
                $id_pad1=$persona_idMax+1;
                $id_mad1=$id_pad1+1;
                $id_mad2=$id_mad1+1;
                $id_pad2=$request->id_padrino2;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad1 = new Persona();
                $pad1->id=$id_pad1;
                $pad1->nombre_persona= $request->pad1Nom;
                $pad1->apellido_persona=$request->pad1Ap;
                $pad1->dui_pasaporte=$request->pad1D;
                $pad1->sexo=$request->pad1Sexo;
                $pad1->estado=1;
                $pad1->idzonaa=$request->idzonap1; //zona p1
                $pad1->idiglesia=$request->idiglesiap1; //zona p1
                $pad1->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $pad1->save();

                $pad2 = new Persona();
                $pad2->id=$id_mad1;
                $pad2->nombre_persona= $request->mad1Nom;
                $pad2->apellido_persona=$request->mad1Ap;
                $pad2->dui_pasaporte=$request->mad1D;
                $pad2->sexo=$request->mad1Sexo;
                $pad2->estado=1;
                $pad2->idzonaa=$request->idzonap2; //zona p2
                $pad2->idiglesia=$request->idiglesiap2; //zona p2
                $pad2->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $pad2->save();

                $pad4 = new Persona();
                $pad4->id=$id_mad2;
                $pad4->nombre_persona= $request->mad2Nom;
                $pad4->apellido_persona=$request->mad2Ap;
                $pad4->dui_pasaporte=$request->mad2D;
                $pad4->sexo=$request->mad2Sexo;
                $pad4->estado=1;
                $pad4->idzonaa=$request->idzonap4; //zona p4
                $pad4->idiglesia=$request->idiglesiap4; //zona p4
                $pad4->fecha_nacimiento=$request->fechanap4; //fecha nacimiento p4
                $pad4->save();
        
                //Esto no se cambia:
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '20':
            {
                //recuperamos padrino1 y padrino2; creamos los otros 2
                $persona_idMax = Persona::max('id');
                $id_mad1=$persona_idMax+1;
                $id_mad2=$id_mad1+1;
                $id_pad1=$request->id_padrino1;
                $id_pad2=$request->id_padrino2;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad2 = new Persona();
                $pad2->id=$id_mad1;
                $pad2->nombre_persona= $request->mad1Nom;
                $pad2->apellido_persona=$request->mad1Ap;
                $pad2->dui_pasaporte=$request->mad1D;
                $pad2->sexo=$request->mad1Sexo;
                $pad2->estado=1;
                $pad2->idzonaa=$request->idzonap2; //zona p2
                $pad2->idiglesia=$request->idiglesiap2; //zona p2
                $pad2->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $pad2->save();

                $pad4 = new Persona();
                $pad4->id=$id_mad2;
                $pad4->nombre_persona= $request->mad2Nom;
                $pad4->apellido_persona=$request->mad2Ap;
                $pad4->dui_pasaporte=$request->mad2D;
                $pad4->sexo=$request->mad2Sexo;
                $pad4->estado=1;
                $pad4->idzonaa=$request->idzonap4; //zona p4
                $pad4->idiglesia=$request->idiglesiap4; //zona p4
                $pad4->fecha_nacimiento=$request->fechanap4; //fecha nacimiento p4
                $pad4->save();
        
                //Esta parte de Sacramento No cambiará en ningun de los otros casos
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '21':
            {
                //Recuperamos madrina1 y padrino2; creamos los otros 2
                $persona_idMax = Persona::max('id');
                $id_pad1=$persona_idMax+1;
                $id_mad2=$id_pad1+1;
                $id_mad1=$request->id_madrina1;
                $id_pad2=$request->id_padrino2;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad1 = new Persona();
                $pad1->id=$id_pad1;
                $pad1->nombre_persona= $request->pad1Nom;
                $pad1->apellido_persona=$request->pad1Ap;
                $pad1->dui_pasaporte=$request->pad1D;
                $pad1->sexo=$request->pad1Sexo;
                $pad1->estado=1;
                $pad1->idzonaa=$request->idzonap1; //zona p1
                $pad1->idiglesia=$request->idiglesiap1; //zona p1
                $pad1->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $pad1->save();

                $pad4 = new Persona();
                $pad4->id=$id_mad2;
                $pad4->nombre_persona= $request->mad2Nom;
                $pad4->apellido_persona=$request->mad2Ap;
                $pad4->dui_pasaporte=$request->mad2D;
                $pad4->sexo=$request->mad2Sexo;
                $pad4->estado=1;
                $pad4->idzonaa=$request->idzonap4; //zona p4
                $pad4->idiglesia=$request->idiglesiap4; //zona p4
                $pad4->fecha_nacimiento=$request->fechanap4; //fecha nacimiento p4
                $pad4->save();
        
                //Esta parte de Sacramento No cambiará en ningun de los otros casos
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '22':
            {
                //recuperaremos pad1, pad2 y mad1; creamos el otro
                $persona_idMax = Persona::max('id');
                $id_mad2=$persona_idMax+1;
                $id_pad1=$request->id_padrino1;
                $id_mad1=$request->id_madrina1;
                $id_pad2=$request->id_padrino2;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad4 = new Persona();
                $pad4->id=$id_mad2;
                $pad4->nombre_persona= $request->mad2Nom;
                $pad4->apellido_persona=$request->mad2Ap;
                $pad4->dui_pasaporte=$request->mad2D;
                $pad4->sexo=$request->mad2Sexo;
                $pad4->estado=1;
                $pad4->idzonaa=$request->idzonap4; //zona p4
                $pad4->idiglesia=$request->idiglesiap4; //zona p4
                $pad4->fecha_nacimiento=$request->fechanap4; //fecha nacimiento p4
                $pad4->save();
        
                //Esta parte de Sacramento No cambiará en ningun de los otros casos
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '23':
            {
                //Recuperamos madrina2; Creamos los otros 3
                $persona_idMax = Persona::max('id');
                $id_pad1=$persona_idMax+1;
                $id_mad1=$id_pad1+1;
                $id_pad2=$id_mad1+1;
                $id_mad2=$request->id_madrina2;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad1 = new Persona();
                $pad1->id=$id_pad1;
                $pad1->nombre_persona= $request->pad1Nom;
                $pad1->apellido_persona=$request->pad1Ap;
                $pad1->dui_pasaporte=$request->pad1D;
                $pad1->sexo=$request->pad1Sexo;
                $pad1->estado=1;
                $pad1->idzonaa=$request->idzonap1; //zona p1
                $pad1->idiglesia=$request->idiglesiap1; //zona p1
                $pad1->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $pad1->save();

                $pad2 = new Persona();
                $pad2->id=$id_mad1;
                $pad2->nombre_persona= $request->mad1Nom;
                $pad2->apellido_persona=$request->mad1Ap;
                $pad2->dui_pasaporte=$request->mad1D;
                $pad2->sexo=$request->mad1Sexo;
                $pad2->estado=1;
                $pad2->idzonaa=$request->idzonap2; //zona p2
                $pad2->idiglesia=$request->idiglesiap2; //zona p2
                $pad2->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $pad2->save();

                $pad3 = new Persona();
                $pad3->id=$id_pad2;
                $pad3->nombre_persona= $request->pad2Nom;
                $pad3->apellido_persona=$request->pad2Ap;
                $pad3->dui_pasaporte=$request->pad2D;
                $pad3->sexo=$request->pad2Sexo;
                $pad3->estado=1;
                $pad3->idzonaa=$request->idzonap3; //zona p3
                $pad3->idiglesia=$request->idiglesiap3; //zona p3
                $pad3->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $pad3->save();
        
                //Esto no se cambia:
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;                
            }

            case '24':
            {
                //Recuperamos padrino1 y madrina2; Creamos los otros 2
                $persona_idMax = Persona::max('id');
                $id_mad1=$persona_idMax+1;
                $id_pad2=$id_mad1+1;
                $id_mad2=$request->id_madrina2;
                $id_pad1=$request->id_padrino1;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad2 = new Persona();
                $pad2->id=$id_mad1;
                $pad2->nombre_persona= $request->mad1Nom;
                $pad2->apellido_persona=$request->mad1Ap;
                $pad2->dui_pasaporte=$request->mad1D;
                $pad2->sexo=$request->mad1Sexo;
                $pad2->estado=1;
                $pad2->idzonaa=$request->idzonap2; //zona p2
                $pad2->idiglesia=$request->idiglesiap2; //zona p2
                $pad2->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $pad2->save();

                $pad3 = new Persona();
                $pad3->id=$id_pad2;
                $pad3->nombre_persona= $request->pad2Nom;
                $pad3->apellido_persona=$request->pad2Ap;
                $pad3->dui_pasaporte=$request->pad2D;
                $pad3->sexo=$request->pad2Sexo;
                $pad3->estado=1;
                $pad3->idzonaa=$request->idzonap3; //zona p3
                $pad3->idiglesia=$request->idiglesiap3; //zona p3
                $pad3->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $pad3->save();
        
                //Esta parte de Sacramento No cambiará en ningun de los otros casos
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '25':
            {
                //Recuperamos madrina1 y madrina2; creamos los otros 2
                $persona_idMax = Persona::max('id');
                $id_pad1=$persona_idMax+1;
                $id_pad2=$id_pad1+1;
                $id_mad2=$request->id_madrina2;
                $id_mad1=$request->id_madrina1;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad1 = new Persona();
                $pad1->id=$id_pad1;
                $pad1->nombre_persona= $request->pad1Nom;
                $pad1->apellido_persona=$request->pad1Ap;
                $pad1->dui_pasaporte=$request->pad1D;
                $pad1->sexo=$request->pad1Sexo;
                $pad1->estado=1;
                $pad1->idzonaa=$request->idzonap1; //zona p1
                $pad1->idiglesia=$request->idiglesiap1; //zona p1
                $pad1->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $pad1->save();

                $pad3 = new Persona();
                $pad3->id=$id_pad2;
                $pad3->nombre_persona= $request->pad2Nom;
                $pad3->apellido_persona=$request->pad2Ap;
                $pad3->dui_pasaporte=$request->pad2D;
                $pad3->sexo=$request->pad2Sexo;
                $pad3->estado=1;
                $pad3->idzonaa=$request->idzonap3; //zona p3
                $pad3->idiglesia=$request->idiglesiap3; //zona p3
                $pad3->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $pad3->save();
        
                //Esta parte de Sacramento No cambiará en ningun de los otros casos
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '26':
            {
                //recuperaremos mad1, mad2 y pad1; creamos el otro
                $persona_idMax = Persona::max('id');
                $id_pad2=$persona_idMax+1;
                $id_pad1=$request->id_padrino1;
                $id_mad1=$request->id_madrina1;
                $id_mad2=$request->id_madrina2;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad3 = new Persona();
                $pad3->id=$id_pad2;
                $pad3->nombre_persona= $request->pad2Nom;
                $pad3->apellido_persona=$request->pad2Ap;
                $pad3->dui_pasaporte=$request->pad2D;
                $pad3->sexo=$request->pad2Sexo;
                $pad3->estado=1;
                $pad3->idzonaa=$request->idzonap3; //zona p3
                $pad3->idiglesia=$request->idiglesiap3; //zona p3
                $pad3->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $pad3->save();
        
                //Esta parte de Sacramento No cambiará en ningun de los otros casos
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '27':
            {
                //Recuperar madrina2 y padrino2; creamos los otros2
                $persona_idMax = Persona::max('id');
                $id_mad1=$persona_idMax+1;
                $id_pad1=$id_mad1+1;
                $id_mad2=$request->id_madrina2;
                $id_pad2=$request->id_padrino2;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad2 = new Persona();
                $pad2->id=$id_mad1;
                $pad2->nombre_persona= $request->mad1Nom;
                $pad2->apellido_persona=$request->mad1Ap;
                $pad2->dui_pasaporte=$request->mad1D;
                $pad2->sexo=$request->mad1Sexo;
                $pad2->estado=1;
                $pad2->idzonaa=$request->idzonap2; //zona p2
                $pad2->idiglesia=$request->idiglesiap2; //zona p2
                $pad2->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $pad2->save();

                $pad1 = new Persona();
                $pad1->id=$id_pad1;
                $pad1->nombre_persona= $request->pad1Nom;
                $pad1->apellido_persona=$request->pad1Ap;
                $pad1->dui_pasaporte=$request->pad1D;
                $pad1->sexo=$request->pad1Sexo;
                $pad1->estado=1;
                $pad1->idzonaa=$request->idzonap1; //zona p1
                $pad1->idiglesia=$request->idiglesiap1; //zona p1
                $pad1->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $pad1->save();
        
                //Esta parte de Sacramento No cambiará en ningun de los otros casos
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '28':
            {
                //Recuperamos madrina2, padrino1 y padrino2; creamos el otro
                $persona_idMax = Persona::max('id');
                $id_mad1=$persona_idMax+1;
                $id_pad1=$request->id_padrino1;
                $id_mad2=$request->id_madrina2;
                $id_pad2=$request->id_padrino2;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad2 = new Persona();
                $pad2->id=$id_mad1;
                $pad2->nombre_persona= $request->mad1Nom;
                $pad2->apellido_persona=$request->mad1Ap;
                $pad2->dui_pasaporte=$request->mad1D;
                $pad2->sexo=$request->mad1Sexo;
                $pad2->estado=1;
                $pad2->idzonaa=$request->idzonap2; //zona p2
                $pad2->idiglesia=$request->idiglesiap2; //zona p2
                $pad2->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $pad2->save();
        
                //Esta parte de Sacramento No cambiará en ningun de los otros casos
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }

            case '29':
            {
                //Recuperamos madrina1, madrina2 y padrino2; creamos el otro
                $persona_idMax = Persona::max('id');
                $id_pad1=$persona_idMax+1;
                $id_mad2=$request->id_madrina2;
                $id_mad1=$request->id_madrina1;
                $id_pad2=$request->id_padrino2;
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $pad1 = new Persona();
                $pad1->id=$id_pad1;
                $pad1->nombre_persona= $request->pad1Nom;
                $pad1->apellido_persona=$request->pad1Ap;
                $pad1->dui_pasaporte=$request->pad1D;
                $pad1->sexo=$request->pad1Sexo;
                $pad1->estado=1;
                $pad1->idzonaa=$request->idzonap1; //zona p1
                $pad1->idiglesia=$request->idiglesiap1; //zona p1
                $pad1->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $pad1->save();
        
                //Esta parte de Sacramento No cambiará en ningun de los otros casos
                $sacramento = Sacramento::findOrFail($request->id);
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->fecha_realizacion=$fecha_realizacion;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }
            
            case '30': //Todos Existen en la base de datos con anterioridad
            {
                $id_sacerdote=$request->id_sacerdote;
                $id_iglesia=$request->id_iglesia;
                $fecha_realizacion=$request->fecha_realizacion;
                $id_pad1=$request->id_padrino1;
                $id_mad1=$request->id_madrina1;//SI NO FUNCIONA CAMBIAR id_padrino2 POR id_madrina1
                $id_pad2=$request->id_padrino2;
                $id_mad2=$request->id_madrina2;

                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $sacramento = Sacramento::findOrFail($request->id);
                //$sacramento->sacramento_id=$sacramento_id;
                $sacramento->id_sacerdote=$id_sacerdote;
                $sacramento->id_padrino=$id_pad1;
                $sacramento->id_padrino2=$id_mad1;//SI NO FUNCIONA, CAMBIAR id_padrino2 por id_madrina1
                $sacramento->id_padrino3=$id_pad2;
                $sacramento->id_padrino4=$id_mad2;
                $sacramento->fecha_realizacion=$request->fecha_realizacion;
                $sacramento->id_iglesia=$id_iglesia;
                $sacramento->titulo=$request->titulo;
                $sacramento->estado=2;
                $sacramento->save();
                break;
            }
        }
    }

    //NO TOCAR QUE SÍ SIRVE!!!
    public function desactivarexpediente(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sacramento = Sacramento::findOrFail($request->id);
        $sacramento->estado = '0';
        $sacramento->save();
    }
 
    //NO TOCAR QUE SÍ SIRVE!!!
    public function activarexpediente(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sacramento = Sacramento::findOrFail($request->id);
        $sacramento->estado = '1';
        $sacramento->save();
    }

    /* public function finalizarexpediente(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $sacramento = Sacramento::findOrFail($request->id);
        $sacramento->estado = '2';
        $sacramento->save();
    } */
}
