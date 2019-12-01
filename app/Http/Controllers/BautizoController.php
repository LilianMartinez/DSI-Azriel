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
                $id_persona=Persona::max('id');
                $idpa3=$id_persona+1;
                $idpa4=$idpa3+1;
                $idreali = $idpa4+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $personapd3=new Persona();
                $personapd3->id=$idpa3;
                $personapd3->nombre_persona=$request->nombre_pd3;
                $personapd3->apellido_persona=$request->apellido_pd3;
                $personapd3->dui_pasaporte=$request->dui_pd3;
                $personapd3->sexo=$request->sexo_pd3;
                $personapd3->save();

                $personapd4=new Persona();
                $personapd4->id=$idpa4;
                $personapd4->nombre_persona=$request->nombre_pd4;
                $personapd4->apellido_persona=$request->apellido_pd4;
                $personapd4->dui_pasaporte=$request->dui_pd4;
                $personapd4->sexo=$request->sexo_pd4;
                $personapd4->save();

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
                $bautizo->id_padrino3=$idpa3;
                $bautizo->id_padrino4=$idpa4;
                $bautizo->save();
                break;
            }
            case '3':{
                $id_persona=Persona::max('id');
                $idpa4=$id_persona+1;
                $idreali=$idpa4+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $personapd4=new Persona();
                $personapd4->id=$idpa4;
                $personapd4->nombre_persona=$request->nombre_pd4;
                $personapd4->apellido_persona=$request->apellido_pd4;
                $personapd4->dui_pasaporte=$request->dui_pd4;
                $personapd4->sexo=$request->sexo_pd4;
                $personapd4->save();

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
                $bautizo->id_padrino4 = $idpa4;
                $bautizo->save();
                break;
            }
            case '4':{
                $id_persona=Persona::max('id');
                $idpa2=$id_persona+1;
                $idpa3=$idpa2+1;
                $idpa4=$idpa3+1;
                $idreali = $idpa4+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $personapd2=new Persona();
                $personapd2->id=$idpa2;
                $personapd2->nombre_persona=$request->nombre_pd2;
                $personapd2->apellido_persona=$request->apellido_pd2;
                $personapd2->dui_pasaporte=$request->dui_pd2;
                $personapd2->sexo=$request->sexo_pd2;
                $personapd2->save();

                $personapd3=new Persona();
                $personapd3->id=$idpa3;
                $personapd3->nombre_persona=$request->nombre_pd3;
                $personapd3->apellido_persona=$request->apellido_pd3;
                $personapd3->dui_pasaporte=$request->dui_pd3;
                $personapd3->sexo=$request->sexo_pd3;
                $personapd3->save();

                $personapd4=new Persona();
                $personapd4->id=$idpa4;
                $personapd4->nombre_persona=$request->nombre_pd4;
                $personapd4->apellido_persona=$request->apellido_pd4;
                $personapd4->dui_pasaporte=$request->dui_pd4;
                $personapd4->sexo=$request->sexo_pd4;
                $personapd4->save();

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
                $bautizo->id_padrino2 = $idpa2;
                $bautizo->id_padrino3 = $idpa3;
                $bautizo->id_padrino4 = $idpa4;
                $bautizo->save();
                break;
            }
            case '5':{
                $id_persona=Persona::max('id');
                $idpa=$id_persona+1;
                $idpa3=$idpa+1;
                $idpa4=$idpa3+1;
                $idreali = $idpa4+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $personap=new Persona();
                $personap->id=$idpa;
                $personap->nombre_persona=$request->nombre_p;
                $personap->apellido_persona=$request->apellido_p;
                $personap->dui_pasaporte=$request->dui_p;
                $personap->save();

                $personapd3=new Persona();
                $personapd3->id=$idpa3;
                $personapd3->nombre_persona=$request->nombre_pd3;
                $personapd3->apellido_persona=$request->apellido_pd3;
                $personapd3->dui_pasaporte=$request->dui_pd3;
                $personapd3->sexo=$request->sexo_pd3;
                $personapd3->save();

                $personapd4=new Persona();
                $personapd4->id=$idpa4;
                $personapd4->nombre_persona=$request->nombre_pd4;
                $personapd4->apellido_persona=$request->apellido_pd4;
                $personapd4->dui_pasaporte=$request->dui_pd4;
                $personapd4->sexo=$request->sexo_pd4;
                $personapd4->save();

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $request->id_m;
                $persona_reali->id_padre = $idpa;
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
                $bautizo->id_padrino3 = $idpa3;
                $bautizo->id_padrino4 = $idpa4;
                $bautizo->save();
                break;
            }
            case '6':{
                $id_persona=Persona::max('id');
                $idpa=$id_persona+1;
                $idpa4=$idpa+1;
                $idreali = $idpa4+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $personap=new Persona();
                $personap->id=$idpa;
                $personap->nombre_persona=$request->nombre_p;
                $personap->apellido_persona=$request->apellido_p;
                $personap->dui_pasaporte=$request->dui_p;
                $personap->save();

                $personapd4=new Persona();
                $personapd4->id=$idpa4;
                $personapd4->nombre_persona=$request->nombre_pd4;
                $personapd4->apellido_persona=$request->apellido_pd4;
                $personapd4->dui_pasaporte=$request->dui_pd4;
                $personapd4->sexo=$request->sexo_pd4;
                $personapd4->save();

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $request->id_m;
                $persona_reali->id_padre = $idpa;
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
                $bautizo->id_padrino4 = $idpa4;
                $bautizo->save();
                break;
            }
            case '7':{
                $id_persona=Persona::max('id');
                $idpa=$id_persona+1;
                $idpa2=$idpa+1;
                $idpa3=$idpa2+1;
                $idpa4=$idpa3+1;
                $idreali = $idpa4+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $personap=new Persona();
                $personap->id=$idpa;
                $personap->nombre_persona=$request->nombre_p;
                $personap->apellido_persona=$request->apellido_p;
                $personap->dui_pasaporte=$request->dui_p;
                $personap->save();

                $personapd2=new Persona();
                $personapd2->id=$idpa2;
                $personapd2->nombre_persona=$request->nombre_pd2;
                $personapd2->apellido_persona=$request->apellido_pd2;
                $personapd2->dui_pasaporte=$request->dui_pd2;
                $personapd2->sexo=$request->sexo_pd2;
                $personapd2->save();

                $personapd3=new Persona();
                $personapd3->id=$idpa3;
                $personapd3->nombre_persona=$request->nombre_pd3;
                $personapd3->apellido_persona=$request->apellido_pd3;
                $personapd3->dui_pasaporte=$request->dui_pd3;
                $personapd3->sexo=$request->sexo_pd3;
                $personapd3->save();

                $personapd4=new Persona();
                $personapd4->id=$idpa4;
                $personapd4->nombre_persona=$request->nombre_pd4;
                $personapd4->apellido_persona=$request->apellido_pd4;
                $personapd4->dui_pasaporte=$request->dui_pd4;
                $personapd4->sexo=$request->sexo_pd4;
                $personapd4->save();

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $request->id_m;
                $persona_reali->id_padre = $idpa;
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
                $bautizo->id_padrino2 = $idpa2;
                $bautizo->id_padrino3 = $idpa3;
                $bautizo->id_padrino4 = $idpa4;
                $bautizo->save();
                break;
            }
            case '8':{
                $id_persona=Persona::max('id');
                $idpa=$id_persona+1;
                $idreali = $idpa+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $personap=new Persona();
                $personap->id=$idpa;
                $personap->nombre_persona=$request->nombre_p;
                $personap->apellido_persona=$request->apellido_p;
                $personap->dui_pasaporte=$request->dui_p;
                $personap->save();

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $request->id_m;
                $persona_reali->id_padre = $idpa;
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
                $id_persona=Persona::max('id');
                $idma=$id_persona+1;
                $idreali = $idma+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $personam=new Persona();
                $personam->id=$idma;
                $personam->nombre_persona=$request->nombre_m;
                $personam->apellido_persona=$request->apellido_m;
                $personam->dui_pasaporte=$request->dui_m;
                $personam->save();

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $idma;
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
                $id_persona=Persona::max('id');
                $idma=$id_persona+1;
                $idpa4=$idma+1;
                $idreali = $idpa4+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $personam=new Persona();
                $personam->id=$idma;
                $personam->nombre_persona=$request->nombre_m;
                $personam->apellido_persona=$request->apellido_m;
                $personam->dui_pasaporte=$request->dui_m;
                $personam->save();

                $personapd4=new Persona();
                $personapd4->id=$idpa4;
                $personapd4->nombre_persona=$request->nombre_pd4;
                $personapd4->apellido_persona=$request->apellido_pd4;
                $personapd4->dui_pasaporte=$request->dui_pd4;
                $personapd4->sexo=$request->sexo_pd4;
                $personapd4->save();

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $idma;
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
                $bautizo->id_padrino4 = $idpa4;
                $bautizo->save();
                break;
            }
            case '11':{
                $id_persona=Persona::max('id');
                $idma=$id_persona+1;
                $idpa3=$idma+1;
                $idpa4=$idpa3+1;
                $idreali = $idpa4+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $personam=new Persona();
                $personam->id=$idma;
                $personam->nombre_persona=$request->nombre_m;
                $personam->apellido_persona=$request->apellido_m;
                $personam->dui_pasaporte=$request->dui_m;
                $personam->save();

                $personapd3=new Persona();
                $personapd3->id=$idpa3;
                $personapd3->nombre_persona=$request->nombre_pd3;
                $personapd3->apellido_persona=$request->apellido_pd3;
                $personapd3->dui_pasaporte=$request->dui_pd3;
                $personapd3->sexo=$request->sexo_pd3;
                $personapd3->save();

                $personapd4=new Persona();
                $personapd4->id=$idpa4;
                $personapd4->nombre_persona=$request->nombre_pd4;
                $personapd4->apellido_persona=$request->apellido_pd4;
                $personapd4->dui_pasaporte=$request->dui_pd4;
                $personapd4->sexo=$request->sexo_pd4;
                $personapd4->save();

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $idma;
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
                $bautizo->id_padrino3 = $idpa3;
                $bautizo->id_padrino4 = $idpa4;
                $bautizo->save();
                break;
            }
            case '12':{
                $id_persona=Persona::max('id');
                $idma=$id_persona+1;
                $idpa2=$idma+1;
                $idpa3=$idpa2+1;
                $idpa4=$idpa3+1;
                $idreali = $idpa4+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $personam=new Persona();
                $personam->id=$idma;
                $personam->nombre_persona=$request->nombre_m;
                $personam->apellido_persona=$request->apellido_m;
                $personam->dui_pasaporte=$request->dui_m;
                $personam->save();

                $personapd2=new Persona();
                $personapd2->id=$idpa2;
                $personapd2->nombre_persona=$request->nombre_pd2;
                $personapd2->apellido_persona=$request->apellido_pd2;
                $personapd2->dui_pasaporte=$request->dui_pd2;
                $personapd2->sexo=$request->sexo_pd2;
                $personapd2->save();

                $personapd3=new Persona();
                $personapd3->id=$idpa3;
                $personapd3->nombre_persona=$request->nombre_pd3;
                $personapd3->apellido_persona=$request->apellido_pd3;
                $personapd3->dui_pasaporte=$request->dui_pd3;
                $personapd3->sexo=$request->sexo_pd3;
                $personapd3->save();

                $personapd4=new Persona();
                $personapd4->id=$idpa4;
                $personapd4->nombre_persona=$request->nombre_pd4;
                $personapd4->apellido_persona=$request->apellido_pd4;
                $personapd4->dui_pasaporte=$request->dui_pd4;
                $personapd4->sexo=$request->sexo_pd4;
                $personapd4->save();

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $idma;
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
                $bautizo->id_padrino2 = $idpa2;
                $bautizo->id_padrino3 = $idpa3;
                $bautizo->id_padrino4 = $idpa4;
                $bautizo->save();
                break;
            }
            case '13':{
                $id_persona=Persona::max('id');
                $idma=$id_persona+1;
                $idpa=$idma+1;
                $idpa1=$idpa+1;
                $idpa2=$idpa1+1;
                $idpa3=$idpa2+1;
                $idpa4=$idpa3+1;
                $idreali = $idpa4+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $personam=new Persona();
                $personam->id=$idma;
                $personam->nombre_persona=$request->nombre_m;
                $personam->apellido_persona=$request->apellido_m;
                $personam->dui_pasaporte=$request->dui_m;
                $personam->save();

                $personap=new Persona();
                $personap->id=$idpa;
                $personap->nombre_persona=$request->nombre_p;
                $personap->apellido_persona=$request->apellido_p;
                $personap->dui_pasaporte=$request->dui_p;
                $personap->save();

                $personapd1=new Persona();
                $personapd1->id=$idpa1;
                $personapd1->nombre_persona=$request->nombre_pd1;
                $personapd1->apellido_persona=$request->apellido_pd1;
                $personapd1->dui_pasaporte=$request->dui_pd1;
                $personapd1->sexo=$request->sexo_pd1;
                $personapd1->save();

                $personapd2=new Persona();
                $personapd2->id=$idpa2;
                $personapd2->nombre_persona=$request->nombre_pd2;
                $personapd2->apellido_persona=$request->apellido_pd2;
                $personapd2->dui_pasaporte=$request->dui_pd2;
                $personapd2->sexo=$request->sexo_pd2;
                $personapd2->save();

                $personapd3=new Persona();
                $personapd3->id=$idpa3;
                $personapd3->nombre_persona=$request->nombre_pd3;
                $personapd3->apellido_persona=$request->apellido_pd3;
                $personapd3->dui_pasaporte=$request->dui_pd3;
                $personapd3->sexo=$request->sexo_pd3;
                $personapd3->save();

                $personapd4=new Persona();
                $personapd4->id=$idpa4;
                $personapd4->nombre_persona=$request->nombre_pd4;
                $personapd4->apellido_persona=$request->apellido_pd4;
                $personapd4->dui_pasaporte=$request->dui_pd4;
                $personapd4->sexo=$request->sexo_pd4;
                $personapd4->save();

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $idma;
                $persona_reali->id_padre = $idpa;
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
                $bautizo->id_padrino = $idpa1;
                $bautizo->id_padrino2 = $idpa2;
                $bautizo->id_padrino3 = $idpa3;
                $bautizo->id_padrino4 = $idpa4;
                $bautizo->save();
                break;
            }
            case '14':{
                $id_persona=Persona::max('id');
                $idma=$id_persona+1;
                $idpa=$idma+1;
                $idreali = $idpa+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $personam=new Persona();
                $personam->id=$idma;
                $personam->nombre_persona=$request->nombre_m;
                $personam->apellido_persona=$request->apellido_m;
                $personam->dui_pasaporte=$request->dui_m;
                $personam->save();

                $personap=new Persona();
                $personap->id=$idpa;
                $personap->nombre_persona=$request->nombre_p;
                $personap->apellido_persona=$request->apellido_p;
                $personap->dui_pasaporte=$request->dui_p;
                $personap->save();

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $idma;
                $persona_reali->id_padre = $idpa;
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
                $id_persona=Persona::max('id');
                $idma=$id_persona+1;
                $idpa=$idma+1;
                $idpa4=$idpa+1;
                $idreali = $idpa4+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $personam=new Persona();
                $personam->id=$idma;
                $personam->nombre_persona=$request->nombre_m;
                $personam->apellido_persona=$request->apellido_m;
                $personam->dui_pasaporte=$request->dui_m;
                $personam->save();

                $personap=new Persona();
                $personap->id=$idpa;
                $personap->nombre_persona=$request->nombre_p;
                $personap->apellido_persona=$request->apellido_p;
                $personap->dui_pasaporte=$request->dui_p;
                $personap->save();

                $personapd4=new Persona();
                $personapd4->id=$idpa4;
                $personapd4->nombre_persona=$request->nombre_pd4;
                $personapd4->apellido_persona=$request->apellido_pd4;
                $personapd4->dui_pasaporte=$request->dui_pd4;
                $personapd4->sexo=$request->sexo_pd4;
                $personapd4->save();

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $idma;
                $persona_reali->id_padre = $idpa;
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
                $bautizo->id_padrino4 = $idpa4;
                $bautizo->save();
                break;
            }
            case '16':{
                $id_persona=Persona::max('id');
                $idma=$id_persona+1;
                $idpa=$idma+1;
                $idpa3=$idpa+1;
                $idpa4=$idpa3+1;
                $idreali = $idpa4+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $personam=new Persona();
                $personam->id=$idma;
                $personam->nombre_persona=$request->nombre_m;
                $personam->apellido_persona=$request->apellido_m;
                $personam->dui_pasaporte=$request->dui_m;
                $personam->save();

                $personap=new Persona();
                $personap->id=$idpa;
                $personap->nombre_persona=$request->nombre_p;
                $personap->apellido_persona=$request->apellido_p;
                $personap->dui_pasaporte=$request->dui_p;
                $personap->save();

                $personapd3=new Persona();
                $personapd3->id=$idpa3;
                $personapd3->nombre_persona=$request->nombre_pd3;
                $personapd3->apellido_persona=$request->apellido_pd3;
                $personapd3->dui_pasaporte=$request->dui_pd3;
                $personapd3->sexo=$request->sexo_pd3;
                $personapd3->save();

                $personapd4=new Persona();
                $personapd4->id=$idpa4;
                $personapd4->nombre_persona=$request->nombre_pd4;
                $personapd4->apellido_persona=$request->apellido_pd4;
                $personapd4->dui_pasaporte=$request->dui_pd4;
                $personapd4->sexo=$request->sexo_pd4;
                $personapd4->save();

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $idma;
                $persona_reali->id_padre = $idpa;
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
                $bautizo->id_padrino3 = $idpa3;
                $bautizo->id_padrino4 = $idpa4;
                $bautizo->save();
                break;
            }
            case '17':{
                $id_persona=Persona::max('id');
                $idma=$id_persona+1;
                $idpa=$idma+1;
                $idpa2=$idpa+1;
                $idpa3=$idpa2+1;
                $idpa4=$idpa3+1;
                $idreali = $idpa4+1;
                $idsacra = Sacramentos3::max('id');
                $idsacramento = $idsacra+1;
                $idpartida = PartidaNacimiento::max('id');
                $idp = $idpartida+1;

                $personam=new Persona();
                $personam->id=$idma;
                $personam->nombre_persona=$request->nombre_m;
                $personam->apellido_persona=$request->apellido_m;
                $personam->dui_pasaporte=$request->dui_m;
                $personam->save();

                $personap=new Persona();
                $personap->id=$idpa;
                $personap->nombre_persona=$request->nombre_p;
                $personap->apellido_persona=$request->apellido_p;
                $personap->dui_pasaporte=$request->dui_p;
                $personap->save();

                $personapd2=new Persona();
                $personapd2->id=$idpa2;
                $personapd2->nombre_persona=$request->nombre_pd2;
                $personapd2->apellido_persona=$request->apellido_pd2;
                $personapd2->dui_pasaporte=$request->dui_pd2;
                $personapd2->sexo=$request->sexo_pd2;
                $personapd2->save();

                $personapd3=new Persona();
                $personapd3->id=$idpa3;
                $personapd3->nombre_persona=$request->nombre_pd3;
                $personapd3->apellido_persona=$request->apellido_pd3;
                $personapd3->dui_pasaporte=$request->dui_pd3;
                $personapd3->sexo=$request->sexo_pd3;
                $personapd3->save();

                $personapd4=new Persona();
                $personapd4->id=$idpa4;
                $personapd4->nombre_persona=$request->nombre_pd4;
                $personapd4->apellido_persona=$request->apellido_pd4;
                $personapd4->dui_pasaporte=$request->dui_pd4;
                $personapd4->sexo=$request->sexo_pd4;
                $personapd4->save();

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->id_madre = $idma;
                $persona_reali->id_padre = $idpa;
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
                $bautizo->id_padrino2 = $idpa2;
                $bautizo->id_padrino3 = $idpa3;
                $bautizo->id_padrino4 = $idpa4;
                $bautizo->save();
                break;
            }
            case '18':{
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
            case '19':{
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
            case '20':{
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
            case '21':{
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
                $bautizo->save();
                break;
            }
            case '22':{
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
            case '23':{
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
            case '24':{
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
            case '25':{
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
            case '26':{
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
                $bautizo->save();
                break;
            }
            case '27':{
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
            case '28':{
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
            case '29':{
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
            case '30':{
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
            case '31':{
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
            case '32':{
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
            case '33':{
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
            case '34':{
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
            case '35':{
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
