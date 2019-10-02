<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sacramentos3;
use App\Persona;
use App\NotaMarginal;
use App\PartidaNacimiento;
use Illuminate\Support\Facades\DB;

class BautizoController extends Controller
{
    
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $bautizo = DB::table('sacramentos as s')
                        ->leftjoin('personas as p','s.id_realizante1','=','p.id')
                        ->where('s.tipo_sacramento',1)
                        ->select('s.folio','s.libro','s.asiento','p.nombre_persona as nombreRea','p.apellido_persona as apellido_realizante')
                        ->orderBy('s.id_realizante1','desc')->paginate(15);
        } 
        else{
            $bautizo = DB::table('sacramentos as s')
            ->leftjoin('personas as p','s.id_realizante1','=','p.id')
            ->select('s.folio','s.libro','s.asiento','p.nombre_persona as nombreRea','p.apellido_persona as apellido_realizante')
            ->where('s.' .$criterio, 'like', '%'. $buscar . '%')->orderBy('s.id','desc')->paginate(15);
        }

        return [
               'pagination' =>[
                'total' =>  $bautizo->total(),
                'current_page' => $bautizo->currentPage(),
                'per_page' =>$bautizo->perPage(),
                'last_page' => $bautizo->lastPage(),
                'from' => $bautizo->firstItem(),
                'to' => $bautizo->lastItem(),
                ],
                'bautizos' => $bautizo
            ];
    }

    

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $tipo=$request->tipo;
        $tiposacra=1;
        if(!$request->ajax()) return redirect('/');
        switch($tipo){
            case '1':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $request->id_m;
                $persona_reali->id_padre = $request->id_p;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->id_padrino = $request->id_pd1;
                $bautizo->id_padrino2 = $request->id_pd2;
                $bautizo->id_padrino3 = $request->id_pd3;
                $bautizo->id_padrino4 = $request->id_pd4;
                $bautizo->save();
                break;
            }
            case '2':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $request->id_m;
                $persona_reali->id_padre = $request->id_p;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->id_padrino = $request->id_pd1;
                $bautizo->id_padrino2 = $request->id_pd2;
                $bautizo->save();
                break;
            }
            case '3':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $request->id_m;
                $persona_reali->id_padre = $request->id_p;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->id_padrino = $request->id_pd1;
                $bautizo->id_padrino2 = $request->id_pd2;
                $bautizo->id_padrino3 = $request->id_pd3;
                $bautizo->save();
                break;
            }
            case '4':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $request->id_m;
                $persona_reali->id_padre = $request->id_p;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->id_padrino = $request->id_pd1;
                $bautizo->save();
                break;
            }
            case '5':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $request->id_m;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->id_padrino = $request->id_pd1;
                $bautizo->id_padrino2 = $request->id_pd2;
                $bautizo->save();
                break;
            }
            case '6':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $request->id_m;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->id_padrino = $request->id_pd1;
                $bautizo->id_padrino2 = $request->id_pd2;
                $bautizo->id_padrino3 = $request->id_pd3;
                $bautizo->save();
                break;
            }
            case '7':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $request->id_m;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->id_padrino = $request->id_pd1;
                $bautizo->save();
                break;
            }
            case '8':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $request->id_m;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->id_padrino = $request->id_pd1;
                $bautizo->id_padrino2 = $request->id_pd2;
                $bautizo->id_padrino3 = $request->id_pd3;
                $bautizo->id_padrino4 = $request->id_pd4;
                $bautizo->save();
                break;
            }
            case '9':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_padre = $request->id_p;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->id_padrino = $request->id_pd1;
                $bautizo->id_padrino2 = $request->id_pd2;
                $bautizo->id_padrino3 = $request->id_pd3;
                $bautizo->id_padrino4 = $request->id_pd4;
                $bautizo->save();
                break;
            }
            case '10':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_padre = $request->id_p;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->id_padrino = $request->id_pd1;
                $bautizo->id_padrino2 = $request->id_pd2;
                $bautizo->id_padrino3 = $request->id_pd3;
                $bautizo->save();
                break;
            }
            case '11':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_padre = $request->id_p;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->id_padrino = $request->id_pd1;
                $bautizo->id_padrino2 = $request->id_pd2;
                $bautizo->save();
                break;
            }
            case '12':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_padre = $request->id_p;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->id_padrino = $request->id_pd1;
                $bautizo->save();
                break;
            }
            case '13':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->save();
                break;
            }
            case '14':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->id_padrino = $request->id_pd1;
                $bautizo->id_padrino2 = $request->id_pd2;
                $bautizo->id_padrino3 = $request->id_pd3;
                $bautizo->id_padrino4 = $request->id_pd4;
                $bautizo->save();
                break;
            }
            case '15':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->id_padrino = $request->id_pd1;
                $bautizo->id_padrino2 = $request->id_pd2;
                $bautizo->id_padrino3 = $request->id_pd3;
                $bautizo->save();
                break;
            }
            case '16':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->id_padrino = $request->id_pd1;
                $bautizo->id_padrino2 = $request->id_pd2;
                $bautizo->save();
                break;
            }
            case '17':{
                $id_realizante=Persona::max('id');
                $idreali = $id_realizante+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idp;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $bautizo = new Sacramentos3();
                $bautizo->id = $idsacramento;
                $bautizo->tipo_sacramento=$tiposacra;
                $bautizo->libro = $request->librob;
                $bautizo->folio = $request->foliob;
                $bautizo->asiento = $request->asiento;
                $bautizo->fecha_realizacion = $request->fecha;
                $bautizo->id_realizante1 = $idreali;
                $bautizo->id_sacerdote = $request->sacerdote;
                $bautizo->id_padrino = $request->id_pd1;
                $bautizo->save();
                break;
            }
        }
        
       
    }

    
    public function show($id)
    {
        //
    }

    public function marginacionacta(Request $request){
        if(!$request->ajax()) return redirect('/');

        $id_nota = NotaMarginal::max('id');
        $idnota = $id_nota+1;

        $notam = new NotaMarginal();
        $notam->id = $idnota;
        $notam->nota = $request->nota;
        $notam->save();
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

    public function buscar(Request $id)
    {
        if(!$id->ajax()) return redirect('/');
       $bauti = DB::table('sacramentos')->where("id",$id->id)->first();
       return response()->json($bauti);    
    }
}
