<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sacramentos3;
use App\Persona;
use App\Efectivo;
use App\PartidaNacimiento;
use Illuminate\Support\Facades\DB;


class ConfirmaController extends Controller
{

    public function store(Request $request)
    {
        $tipo=$request->tipo;
        $tipop=$request->tipop;
        $tiposacra=3;
        $idsacra = Sacramentos3::max('id');
        $idsacramento = $idsacra+1;
        if(!$request->ajax()) return redirect('/');
        switch($tipo){
            case '1':{
                $id_persona = Persona::max('id');
                $idreali=$id_persona+1;
                $idpartida_p= PartidaNacimiento::max('id');
                $idpartida=$idpartida_p+1;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='CONFIRMACION';
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
                $personareali->idzonaa=$request->idzonar; //zona realizante
                $personareali->idiglesia=$request->idiglesiar; //iglesia realizante
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

                $confirma = new Sacramentos3();
                $confirma->id = $idsacramento;
                $confirma->tipo_sacramento=$tiposacra;
                $confirma->libro = $request->libroc;
                $confirma->folio = $request->folioc;
                $confirma->asiento = $request->asiento;
                $confirma->fecha_realizacion = $request->fecha;
                $confirma->id_realizante1 = $idreali;
                $confirma->id_sacerdote = $request->sacerdote;
                $confirma->titulo=$request->titulo;
                $confirma->id_iglesia=$request->idiglesia;
                $confirma->save();
                break;
            }
            case '2':{
                $id_persona = Persona::max('id');
                $idm=$id_persona+1;
                $idreali=$idm+1;
                $idpartida_p= PartidaNacimiento::max('id');
                $idpartida=$idpartida_p+1;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='CONFIRMACION';
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
                $personap->sexo='F';
                $personap->idzonaa=$request->idzonam;  //zona madre
                $personap->idiglesia=$request->idiglesiam; //iglesia madre
                $personap->fecha_nacimiento=$request->fechanam; //fecha nacimiento madre
                $personap->estado=1; //estado
                $personap->save();

                $personareali = new Persona();
                $personareali->id=$idreali;
                $personareali->nombre_persona= $request->nombre_reali;
                $personareali->apellido_persona=$request->apellido_reali;
                $personareali->dui_pasaporte=$request->dui_reali;
                $personareali->sexo=$request->sexo;
                $personareali->fecha_nacimiento=$request->nacimiento;
                $personareali->idzonaa=$request->idzonar;  //zona realizante
                $personareali->idiglesia=$request->idiglesiar; //zona realizante
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

                $confirma = new Sacramentos3();
                $confirma->id = $idsacramento;
                $confirma->tipo_sacramento=$tiposacra;
                $confirma->libro = $request->libroc;
                $confirma->folio = $request->folioc;
                $confirma->asiento = $request->asiento;
                $confirma->fecha_realizacion = $request->fecha;
                $confirma->id_realizante1 = $idreali;
                $confirma->id_sacerdote = $request->sacerdote;
                $confirma->titulo=$request->titulo;
                $confirma->id_iglesia=$request->idiglesia;
                $confirma->save();
                break;
            }
            case '3':{
                $id_persona = Persona::max('id');
                $idp=$id_persona+1;
                $idreali=$idp+1;
                $idpartida_p= PartidaNacimiento::max('id');
                $idpartida=$idpartida_p+1;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='CONFIRMACION';
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
                $personap->sexo='M';
                $personap->idzonaa=$request->idzonap;  //zona padre
                $personap->idiglesia=$request->idiglesiap; //iglesia padre
                $personap->fecha_nacimiento=$request->fechanap; //fecha nacimiento padre
                $personap->estado=1; //estado
                $personap->save();

                $personareali = new Persona();
                $personareali->id=$idreali;
                $personareali->nombre_persona= $request->nombre_reali;
                $personareali->apellido_persona=$request->apellido_reali;
                $personareali->dui_pasaporte=$request->dui_reali;
                $personareali->sexo=$request->sexo;
                $personareali->fecha_nacimiento=$request->nacimiento;
                $personareali->idzonaa=$request->idzonar;  //zona realizante
                $personareali->idiglesia=$request->idiglesiar; //zona realizante
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

                $confirma = new Sacramentos3();
                $confirma->id = $idsacramento;
                $confirma->tipo_sacramento=$tiposacra;
                $confirma->libro = $request->libroc;
                $confirma->folio = $request->folioc;
                $confirma->asiento = $request->asiento;
                $confirma->fecha_realizacion = $request->fecha;
                $confirma->id_realizante1 = $idreali;
                $confirma->id_sacerdote = $request->sacerdote;
                $confirma->titulo=$request->titulo;
                $confirma->id_iglesia=$request->idiglesia;
                $confirma->save();
                break;
            }
            case '4':{
                $id_persona = Persona::max('id');
                $idp=$id_persona+1;
                $idm=$idp+1;
                $idreali=$idm+1;
                $idpartida_p= PartidaNacimiento::max('id');
                $idpartida=$idpartida_p+1;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='CONFIRMACION';
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
                $personap->sexo='M';
                $personap->idzonaa=$request->idzonap;  //zona padre
                $personap->idiglesia=$request->idiglesiap; //iglesia padre
                $personap->fecha_nacimiento=$request->fechanap; //fecha nacimiento padre
                $personap->estado=1; //estado
                $personap->save();

                $personap = new Persona();
                $personap->id= $idm;
                $personap->nombre_persona= $request->nombre_m;
                $personap->apellido_persona=$request->apellido_m;
                $personap->dui_pasaporte=$request->dui_m;
                $personap->sexo='F';
                $personap->idzonaa=$request->idzonam;  //zona madre
                $personap->idiglesia=$request->idiglesiam; //iglesia madre
                $personap->fecha_nacimiento=$request->fechanam; //fecha nacimiento madre
                $personap->estado=1; //estado
                $personap->save();

                $personareali = new Persona();
                $personareali->id=$idreali;
                $personareali->nombre_persona= $request->nombre_reali;
                $personareali->apellido_persona=$request->apellido_reali;
                $personareali->dui_pasaporte=$request->dui_reali;
                $personareali->sexo=$request->sexo;
                $personareali->fecha_nacimiento=$request->nacimiento;
                $personareali->idzonaa=$request->idzonar;  //zona realizante
                $personareali->idiglesia=$request->idiglesiar; //zona realizante
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

                $confirma = new Sacramentos3();
                $confirma->id = $idsacramento;
                $confirma->tipo_sacramento=$tiposacra;
                $confirma->libro = $request->libroc;
                $confirma->folio = $request->folioc;
                $confirma->asiento = $request->asiento;
                $confirma->fecha_realizacion = $request->fecha;
                $confirma->id_realizante1 = $idreali;
                $confirma->id_sacerdote = $request->sacerdote;
                $confirma->titulo=$request->titulo;
                $confirma->id_iglesia=$request->idiglesia;
                $confirma->save();
                break;
            }
            case '5':{
                $id_persona = Persona::max('id');
                $idreali=$id_persona+1;
                $idpartida_p= PartidaNacimiento::max('id');
                $idpartida=$idpartida_p+1;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='CONFIRMACION';
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
                $personareali->idzonaa=$request->idzonar;  //zona realizante
                $personareali->idiglesia=$request->idiglesiar; //zona realizante
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

                $confirma = new Sacramentos3();
                $confirma->id = $idsacramento;
                $confirma->tipo_sacramento=$tiposacra;
                $confirma->libro = $request->libroc;
                $confirma->folio = $request->folioc;
                $confirma->asiento = $request->asiento;
                $confirma->fecha_realizacion = $request->fecha;
                $confirma->id_realizante1 = $idreali;
                $confirma->id_sacerdote = $request->sacerdote;
                $confirma->titulo=$request->titulo;
                $confirma->id_iglesia=$request->idiglesia;
                $confirma->save();
                break;
            }
            case '6':{
                $id_persona = Persona::max('id');
                $idreali=$id_persona+1;
                $idpartida_p= PartidaNacimiento::max('id');
                $idpartida=$idpartida_p+1;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='CONFIRMACION';
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
                $personareali->idzonaa=$request->idzonar;  //zona realizante
                $personareali->idiglesia=$request->idiglesiar; //zona realizante
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

                $confirma = new Sacramentos3();
                $confirma->id = $idsacramento;
                $confirma->tipo_sacramento=$tiposacra;
                $confirma->libro = $request->libroc;
                $confirma->folio = $request->folioc;
                $confirma->asiento = $request->asiento;
                $confirma->fecha_realizacion = $request->fecha;
                $confirma->id_realizante1 = $idreali;
                $confirma->id_sacerdote = $request->sacerdote;
                $confirma->titulo=$request->titulo;
                $confirma->id_iglesia=$request->idiglesia;
                $confirma->save();
                break;
            }
            case '7':{
                $id_persona=Persona::max('id');
                $idreali = $id_persona+1;
                $idpartida_p = PartidaNacimiento::max('id');
                $idpartida = $idpartida_p+1;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='CONFIRMACION';
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
                $personareali->idzonaa=$request->idzonar;  //zona realizante
                $personareali->idiglesia=$request->idiglesiar; //zona realizante
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
        
                $confirma = new Sacramentos3();
                $confirma->id = $idsacramento;
                $confirma->tipo_sacramento=$tiposacra;
                $confirma->libro = $request->libroc;
                $confirma->folio = $request->folioc;
                $confirma->asiento = $request->asiento;
                $confirma->fecha_realizacion = $request->fecha;
                $confirma->id_realizante1 = $idreali;
                $confirma->id_sacerdote = $request->sacerdote;
                $confirma->titulo=$request->titulo;
                $confirma->id_iglesia=$request->idiglesia;
                $confirma->save();
                break;
            }
            case '8':{ 
                $id_persona = Persona::max('id');
                $idm=$id_persona+1;
                $idreali=$idm+1;
                $idpartida_p= PartidaNacimiento::max('id');
                $idpartida=$idpartida_p+1;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='CONFIRMACION';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $personap=new Persona();
                $personap->id=$idm;
                $personap->nombre_persona=$request->nombre_m; 
                $personap->apellido_persona=$request->apellido_m;
                $personap->dui_pasaporte=$request->dui_m;
                $personap->sexo='F';
                $personap->idzonaa=$request->idzonam;  //zona madre
                $personap->idiglesia=$request->idiglesiam; //iglesia madre
                $personap->fecha_nacimiento=$request->fechanam; //fecha nacimiento madre
                $personap->estado=1; //estado
                $personap->save();

                $persona_reali = new Persona();
                $persona_reali->id = $idreali;
                $persona_reali->nombre_persona = $request->nombre_reali;
                $persona_reali->apellido_persona = $request->apellido_reali;
                $persona_reali->fecha_nacimiento = $request->nacimiento;
                $persona_reali->dui_pasaporte = $request->dui_reali;
                $persona_reali->sexo = $request->sexo;
                $persona_reali->idzonaa=$request->idzonar;  //zona realizante
                $persona_reali->idiglesia=$request->idiglesiar; //zona realizante
                $persona_reali->estado=1; //estado
                $persona_reali->id_madre = $idm;
                $persona_reali->save();

                $partida = new PartidaNacimiento();
                $partida->id = $idpartida;
                $partida->alcaldia = $request->alcaldia;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->folio = $request->folio;
                $partida->ano = $request->ano;
                $partida->libro = $request->libro;
                $partida->partida = $request->partida;
                $partida->idpersona = $idreali;
                $partida->save();

                $confirma = new Sacramentos3();
                $confirma->id = $idsacramento;
                $confirma->tipo_sacramento=$tiposacra;
                $confirma->libro = $request->libroc;
                $confirma->folio = $request->folioc;
                $confirma->asiento = $request->asiento;
                $confirma->fecha_realizacion = $request->fecha;
                $confirma->id_realizante1 = $idreali;
                $confirma->id_sacerdote = $request->sacerdote;
                $confirma->titulo=$request->titulo;
                $confirma->id_iglesia=$request->idiglesia;
                $confirma->save();
                break;
            }
            case '9':{
                $id_persona = Persona::max('id');
                $idp=$id_persona+1;
                $idreali=$idp+1;
                $idpartida_p= PartidaNacimiento::max('id');
                $idpartida=$idpartida_p+1;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='CONFIRMACION';
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
                $personap->sexo='M';
                $personap->idzonaa=$request->idzonap;  //zona padre
                $personap->idiglesia=$request->idiglesiap; //iglesia padre
                $personap->fecha_nacimiento=$request->fechanap; //fecha nacimiento padre
                $personap->estado=1; //estado
                $personap->save();

                $personareali = new Persona();
                $personareali->id=$idreali;
                $personareali->nombre_persona= $request->nombre_reali;
                $personareali->apellido_persona=$request->apellido_reali;
                $personareali->dui_pasaporte=$request->dui_reali;
                $personareali->sexo=$request->sexo;
                $personareali->fecha_nacimiento=$request->nacimiento;
                $personareali->idzonaa=$request->idzonar;  //zona realizante
                $personareali->idiglesia=$request->idiglesiar; //zona realizante
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

                $confirma = new Sacramentos3();
                $confirma->id = $idsacramento;
                $confirma->tipo_sacramento=$tiposacra;
                $confirma->libro = $request->libroc;
                $confirma->folio = $request->folioc;
                $confirma->asiento = $request->asiento;
                $confirma->fecha_realizacion = $request->fecha;
                $confirma->id_realizante1 = $idreali;
                $confirma->id_sacerdote = $request->sacerdote;
                $confirma->titulo=$request->titulo;
                $confirma->id_iglesia=$request->idiglesia;
                $confirma->save();
                break;
            }  
           
        }
        switch($tipop){
            case '1':{
                $confirma = Sacramentos3::findOrFail($idsacramento);
                $confirma->id_padrino = $request->id_pd1;
                $confirma->id_padrino2 = $request->id_pd2;
                $confirma->id_padrino3 = $request->id_pd3;
                $confirma->id_padrino4 = $request->id_pd4;
                $confirma->save();
            break;
            }
            case '2':{
                $id_persona = Persona::max('id');
                $idp=$id_persona+1;

                $personapa = new Persona();
                $personapa->id= $idp;
                $personapa->nombre_persona= $request->nombre_pd1;
                $personapa->apellido_persona=$request->apellido_pd1;
                $personapa->dui_pasaporte=$request->dui_pd1;
                $personapa->sexo=$request->sexo_pd1;
                $personapa->idzonaa=$request->idzonap1;//zona padrino 1
                $personapa->idiglesia=$request->idiglesiap1;//iglesia padrino 1
                $personapa->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $personapa->estado=1; //estado 
                $personapa->save();

                $confirma = Sacramentos3::findOrFail($idsacramento);
                $confirma->id_padrino = $idp;
                $confirma->id_padrino2 = $request->id_pd2;
                $confirma->id_padrino3 = $request->id_pd3;
                $confirma->id_padrino4 = $request->id_pd4;
                $confirma->save();
            break;
            }
            case '3':{
                $id_persona= Persona::max('id');
                $idp1=$id_persona+1;
                $idp2=$idp1+1;

                $personapa = new Persona();
                $personapa->id= $idp1;
                $personapa->nombre_persona= $request->nombre_pd1;
                $personapa->apellido_persona=$request->apellido_pd1;
                $personapa->dui_pasaporte=$request->dui_pd1;
                $personapa->sexo=$request->sexo_pd1;
                $personapa->idzonaa=$request->idzonap1;//zona padrino 1
                $personapa->idiglesia=$request->idiglesiap1;//iglesia padrino 1
                $personapa->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp2;
                $personapa->nombre_persona= $request->nombre_pd2;
                $personapa->apellido_persona=$request->apellido_pd2;
                $personapa->dui_pasaporte=$request->dui_pd2;
                $personapa->sexo=$request->sexo_pd2;
                $personapa->idzonaa=$request->idzonap2;//zona padrino 2
                $personapa->idiglesia=$request->idiglesiap2;//iglesia padrino 2
                $personapa->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $personapa->estado=1; //estado 
                $personapa->save();

                $confirma = Sacramentos3::findOrFail($idsacramento);
                $confirma->id_padrino = $idp1;
                $confirma->id_padrino2 = $idp2;
                $confirma->id_padrino3 = $request->id_pd3;
                $confirma->id_padrino4 = $request->id_pd4;
                $confirma->save();
            break;
            }
            case '4':{
                $id_persona = Persona::max('id');
                $idp=$id_persona+1;

                $personapa = new Persona();
                $personapa->id= $idp;
                $personapa->nombre_persona= $request->nombre_pd2;
                $personapa->apellido_persona=$request->apellido_pd2;
                $personapa->dui_pasaporte=$request->dui_pd2;
                $personapa->sexo=$request->sexo_pd2;
                $personapa->idzonaa=$request->idzonap2;//zona padrino 2
                $personapa->idiglesia=$request->idiglesiap2;//iglesia padrino 2
                $personapa->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $personapa->estado=1; //estado 
                $personapa->save();

                $confirma = Sacramentos3::findOrFail($idsacramento);
                $confirma->id_padrino = $request->id_pd1;
                $confirma->id_padrino2 = $idp;
                $confirma->id_padrino3 = $request->id_pd3;
                $confirma->id_padrino4 = $request->id_pd4;
                $confirma->save();
            break;
            }
            case '5':{
                $id_persona = Persona::max('id');
                $idp=$id_persona+1;

                $personapa = new Persona();
                $personapa->id= $idp;
                $personapa->nombre_persona= $request->nombre_pd3;
                $personapa->apellido_persona=$request->apellido_pd3;
                $personapa->dui_pasaporte=$request->dui_pd3;
                $personapa->sexo=$request->sexo_pd3;
                $personapa->idzonaa=$request->idzonap3;//zona padrino 3
                $personapa->idiglesia=$request->idiglesiap3;//iglesia padrino 3
                $personapa->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $personapa->estado=1; //estado 
                $personapa->save();

                $confirma = Sacramentos3::findOrFail($idsacramento);
                $confirma->id_padrino = $request->id_pd1;
                $confirma->id_padrino2 = $request->id_pd2;
                $confirma->id_padrino3 = $idp;
                $confirma->id_padrino4 = $request->id_pd4;
                $confirma->save();
            break;
            }
            case '6':{
                $id_persona= Persona::max('id');
                $idp1=$id_persona+1;
                $idp3=$idp1+1;

                $personapa = new Persona();
                $personapa->id= $idp1;
                $personapa->nombre_persona= $request->nombre_pd1;
                $personapa->apellido_persona=$request->apellido_pd1;
                $personapa->dui_pasaporte=$request->dui_pd1;
                $personapa->sexo=$request->sexo_pd1;
                $personapa->idzonaa=$request->idzonap1;//zona padrino 1
                $personapa->idiglesia=$request->idiglesiap1;//iglesia padrino 1
                $personapa->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp3;
                $personapa->nombre_persona= $request->nombre_pd3;
                $personapa->apellido_persona=$request->apellido_pd3;
                $personapa->dui_pasaporte=$request->dui_pd3;
                $personapa->sexo=$request->sexo_pd3;
                $personapa->idzonaa=$request->idzonap3;//zona padrino 3
                $personapa->idiglesia=$request->idiglesiap3;//iglesia padrino 3
                $personapa->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $personapa->estado=1; //estado 
                $personapa->save();

                $confirma = Sacramentos3::findOrFail($idsacramento);
                $confirma->id_padrino = $idp1;
                $confirma->id_padrino2 = $request->id_pd2;
                $confirma->id_padrino3 = $idp3;
                $confirma->id_padrino4 = $request->id_pd4;
                $confirma->save();
            break;
            }
            case '7':{
                $id_persona= Persona::max('id');
                $idp1=$id_persona+1;
                $idp2=$idp1+1;

                $personapa = new Persona();
                $personapa->id= $idp1;
                $personapa->nombre_persona= $request->nombre_pd2;
                $personapa->apellido_persona=$request->apellido_pd2;
                $personapa->dui_pasaporte=$request->dui_pd2;
                $personapa->sexo=$request->sexo_pd2;
                $personapa->idzonaa=$request->idzonap2;//zona padrino 2
                $personapa->idiglesia=$request->idiglesiap2;//iglesia padrino 2
                $personapa->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp2;
                $personapa->nombre_persona= $request->nombre_pd3;
                $personapa->apellido_persona=$request->apellido_pd3;
                $personapa->dui_pasaporte=$request->dui_pd3;
                $personapa->sexo=$request->sexo_pd3;
                $personapa->idzonaa=$request->idzonap3;//zona padrino 3
                $personapa->idiglesia=$request->idiglesiap3;//iglesia padrino 3
                $personapa->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $personapa->estado=1; //estado 
                $personapa->save();

                $confirma = Sacramentos3::findOrFail($idsacramento);
                $confirma->id_padrino = $request->id_pd1;
                $confirma->id_padrino2 = $idp1;
                $confirma->id_padrino3 = $idp2;
                $confirma->id_padrino4 = $request->id_pd4;
                $confirma->save();
            break;
            }
            case '8':{
                $id_persona= Persona::max('id');
                $idp2=$idp1+1;
                $idp3=$idp2+1;
                $idp4=$idp3+1;

                $personapa = new Persona();
                $personapa->id= $idp1;
                $personapa->nombre_persona= $request->nombre_pd1;
                $personapa->apellido_persona=$request->apellido_pd1;
                $personapa->dui_pasaporte=$request->dui_pd1;
                $personapa->sexo=$request->sexo_pd1;
                $personapa->idzonaa=$request->idzonap1;//zona padrino 1
                $personapa->idiglesia=$request->idiglesiap1;//iglesia padrino 1
                $personapa->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp2;
                $personapa->nombre_persona= $request->nombre_pd2;
                $personapa->apellido_persona=$request->apellido_pd2;
                $personapa->dui_pasaporte=$request->dui_pd2;
                $personapa->sexo=$request->sexo_pd2;
                $personapa->idzonaa=$request->idzonap2;//zona padrino 2
                $personapa->idiglesia=$request->idiglesiap2;//iglesia padrino 2
                $personapa->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp3;
                $personapa->nombre_persona= $request->nombre_pd3;
                $personapa->apellido_persona=$request->apellido_pd3;
                $personapa->dui_pasaporte=$request->dui_pd3;
                $personapa->sexo=$request->sexo_pd3;
                $personapa->idzonaa=$request->idzonap3;//zona padrino 3
                $personapa->idiglesia=$request->idiglesiap3;//iglesia padrino 3
                $personapa->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $personapa->estado=1; //estado 
                $personapa->save();

                $confirma = Sacramentos3::findOrFail($idsacramento);
                $confirma->id_padrino = $idp1;
                $confirma->id_padrino2 = $idp2;
                $confirma->id_padrino3 = $idp3;
                $confirma->id_padrino4 = $request->id_pd4;
                $confirma->save();
            break;
            }
            case '9':{
                $id_persona= Persona::max('id');
                $idp1=$id_persona+1;
                $idp2=$idp1+1;
                $idp3=$idp2+1;
                $idp4=$idp3+1;

                $personapa = new Persona();
                $personapa->id= $idp1;
                $personapa->nombre_persona= $request->nombre_pd1;
                $personapa->apellido_persona=$request->apellido_pd1;
                $personapa->dui_pasaporte=$request->dui_pd1;
                $personapa->sexo=$request->sexo_pd1;
                $personapa->idzonaa=$request->idzonap1;//zona padrino 1
                $personapa->idiglesia=$request->idiglesiap1;//iglesia padrino 1
                $personapa->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp2;
                $personapa->nombre_persona= $request->nombre_pd2;
                $personapa->apellido_persona=$request->apellido_pd2;
                $personapa->dui_pasaporte=$request->dui_pd2;
                $personapa->sexo=$request->sexo_pd2;
                $personapa->idzonaa=$request->idzonap2;//zona padrino 2
                $personapa->idiglesia=$request->idiglesiap2;//iglesia padrino 2
                $personapa->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp3;
                $personapa->nombre_persona= $request->nombre_pd3;
                $personapa->apellido_persona=$request->apellido_pd3;
                $personapa->dui_pasaporte=$request->dui_pd3;
                $personapa->sexo=$request->sexo_pd3;
                $personapa->idzonaa=$request->idzonap3;//zona padrino 3
                $personapa->idiglesia=$request->idiglesiap3;//iglesia padrino 3
                $personapa->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp4;
                $personapa->nombre_persona= $request->nombre_pd4;
                $personapa->apellido_persona=$request->apellido_pd4;
                $personapa->dui_pasaporte=$request->dui_pd4;
                $personapa->sexo=$request->sexo_pd4;
                $personapa->idzonaa=$request->idzonap4;//zona padrino 4
                $personapa->idiglesia=$request->idiglesiap4;//iglesia padrino 4
                $personapa->fecha_nacimiento=$request->fechanap4; //fecha nacimiento p4
                $personapa->estado=1; //estado 
                $personapa->save();

                $confirma = Sacramentos3::findOrFail($idsacramento);
                $confirma->id_padrino = $idp1;
                $confirma->id_padrino2 = $idp2;
                $confirma->id_padrino3 = $idp3;
                $confirma->id_padrino4 = $idp4;
                $confirma->save();
            break;
            }
            case '10':{
                $id_persona= Persona::max('id');
                $idp2=$id_persona+1;
                $idp3=$idp2+1;
                $idp4=$idp3+1;

                $personapa = new Persona();
                $personapa->id= $idp2;
                $personapa->nombre_persona= $request->nombre_pd2;
                $personapa->apellido_persona=$request->apellido_pd2;
                $personapa->dui_pasaporte=$request->dui_pd2;
                $personapa->sexo=$request->sexo_pd2;
                $personapa->idzonaa=$request->idzonap2;//zona padrino 2
                $personapa->idiglesia=$request->idiglesiap2;//iglesia padrino 2
                $personapa->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp3;
                $personapa->nombre_persona= $request->nombre_pd3;
                $personapa->apellido_persona=$request->apellido_pd3;
                $personapa->dui_pasaporte=$request->dui_pd3;
                $personapa->sexo=$request->sexo_pd3;
                $personapa->idzonaa=$request->idzonap3;//zona padrino 3
                $personapa->idiglesia=$request->idiglesiap3;//iglesia padrino 3
                $personapa->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp4;
                $personapa->nombre_persona= $request->nombre_pd4;
                $personapa->apellido_persona=$request->apellido_pd4;
                $personapa->dui_pasaporte=$request->dui_pd4;
                $personapa->sexo=$request->sexo_pd4;
                $personapa->idzonaa=$request->idzonap4;//zona padrino 4
                $personapa->idiglesia=$request->idiglesiap4;//iglesia padrino 4
                $personapa->fecha_nacimiento=$request->fechanap4; //fecha nacimiento p4
                $personapa->estado=1; //estado 
                $personapa->save();

                $confirma = Sacramentos3::findOrFail($idsacramento);
                $confirma->id_padrino = $request->id_pd1;
                $confirma->id_padrino2 = $idp2;
                $confirma->id_padrino3 = $idp3;
                $confirma->id_padrino4 = $idp4;
                $confirma->save();
            break;
            }
            case '11':{
                $id_persona= Persona::max('id');
                $idp3=$id_persona+1;
                $idp4=$idp3+1;

                $personapa = new Persona();
                $personapa->id= $idp3;
                $personapa->nombre_persona= $request->nombre_pd3;
                $personapa->apellido_persona=$request->apellido_pd3;
                $personapa->dui_pasaporte=$request->dui_pd3;
                $personapa->sexo=$request->sexo_pd3;
                $personapa->idzonaa=$request->idzonap3;//zona padrino 3
                $personapa->idiglesia=$request->idiglesiap3;//iglesia padrino 3
                $personapa->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp4;
                $personapa->nombre_persona= $request->nombre_pd4;
                $personapa->apellido_persona=$request->apellido_pd4;
                $personapa->dui_pasaporte=$request->dui_pd4;
                $personapa->sexo=$request->sexo_pd4;
                $personapa->idzonaa=$request->idzonap4;//zona padrino 4
                $personapa->idiglesia=$request->idiglesiap4;//iglesia padrino 4
                $personapa->fecha_nacimiento=$request->fechanap4; //fecha nacimiento p4
                $personapa->estado=1; //estado 
                $personapa->save();

                $confirma = Sacramentos3::findOrFail($idsacramento);
                $confirma->id_padrino = $request->id_pd1;
                $confirma->id_padrino2 = $request->id_pd2;
                $confirma->id_padrino3 = $idp3;
                $confirma->id_padrino4 = $idp4;
                $confirma->save();
            break;
            }
            case '12':{
                $id_persona= Persona::max('id');
                $idp4=$id_persona+1;

                $personapa = new Persona();
                $personapa->id= $idp4;
                $personapa->nombre_persona= $request->nombre_pd4;
                $personapa->apellido_persona=$request->apellido_pd4;
                $personapa->dui_pasaporte=$request->dui_pd4;
                $personapa->sexo=$request->sexo_pd4;
                $personapa->idzonaa=$request->idzonap4;//zona padrino 4
                $personapa->idiglesia=$request->idiglesiap4;//iglesia padrino 4
                $personapa->fecha_nacimiento=$request->fechanap4; //fecha nacimiento p4
                $personapa->estado=1; //estado 
                $personapa->save();

                $confirma = Sacramentos3::findOrFail($idsacramento);
                $confirma->id_padrino = $request->id_pd1;
                $confirma->id_padrino2 = $request->id_pd2;
                $confirma->id_padrino3 = $request->id_pd3;
                $confirma->id_padrino4 = $idp4;
                $confirma->save();
            break;
            }
            case '13':{
                $id_persona= Persona::max('id');
                $idp1=$id_persona+1;
                $idp3=$idp1+1;
                $idp4=$idp3+1;

                $personapa = new Persona();
                $personapa->id= $idp1;
                $personapa->nombre_persona= $request->nombre_pd1;
                $personapa->apellido_persona=$request->apellido_pd1;
                $personapa->dui_pasaporte=$request->dui_pd1;
                $personapa->sexo=$request->sexo_pd1;
                $personapa->idzonaa=$request->idzonap1;//zona padrino 1
                $personapa->idiglesia=$request->idiglesiap1;//iglesia padrino 1
                $personapa->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp3;
                $personapa->nombre_persona= $request->nombre_pd3;
                $personapa->apellido_persona=$request->apellido_pd3;
                $personapa->dui_pasaporte=$request->dui_pd3;
                $personapa->sexo=$request->sexo_pd3;
                $personapa->idzonaa=$request->idzonap3;//zona padrino 3
                $personapa->idiglesia=$request->idiglesiap3;//iglesia padrino 3
                $personapa->fecha_nacimiento=$request->fechanap3; //fecha nacimiento p3
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp4;
                $personapa->nombre_persona= $request->nombre_pd4;
                $personapa->apellido_persona=$request->apellido_pd4;
                $personapa->dui_pasaporte=$request->dui_pd4;
                $personapa->sexo=$request->sexo_pd4;
                $personapa->idzonaa=$request->idzonap4;//zona padrino 4
                $personapa->idiglesia=$request->idiglesiap4;//iglesia padrino 4
                $personapa->fecha_nacimiento=$request->fechanap4; //fecha nacimiento p4
                $personapa->estado=1; //estado 
                $personapa->save();

                $confirma = Sacramentos3::findOrFail($idsacramento);
                $confirma->id_padrino = $idp1;
                $confirma->id_padrino2 = $request->id_pd2;
                $confirma->id_padrino3 = $idp3;
                $confirma->id_padrino4 = $idp4;
                $confirma->save();
            break;
            }
            case '14':{
                $id_persona= Persona::max('id');
                $idp1=$id_persona+1;
                $idp2=$idp1+1;
                $idp4=$idp2+1;

                $personapa = new Persona();
                $personapa->id= $idp1;
                $personapa->nombre_persona= $request->nombre_pd1;
                $personapa->apellido_persona=$request->apellido_pd1;
                $personapa->dui_pasaporte=$request->dui_pd1;
                $personapa->sexo=$request->sexo_pd1;
                $personapa->idzonaa=$request->idzonap1;//zona padrino 1
                $personapa->idiglesia=$request->idiglesiap1;//iglesia padrino 1
                $personapa->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp2;
                $personapa->nombre_persona= $request->nombre_pd2;
                $personapa->apellido_persona=$request->apellido_pd2;
                $personapa->dui_pasaporte=$request->dui_pd2;
                $personapa->sexo=$request->sexo_pd2;
                $personapa->idzonaa=$request->idzonap2;//zona padrino 2
                $personapa->idiglesia=$request->idiglesiap2;//iglesia padrino 2
                $personapa->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp4;
                $personapa->nombre_persona= $request->nombre_pd4;
                $personapa->apellido_persona=$request->apellido_pd4;
                $personapa->dui_pasaporte=$request->dui_pd4;
                $personapa->sexo=$request->sexo_pd4;
                $personapa->idzonaa=$request->idzonap4;//zona padrino 4
                $personapa->idiglesia=$request->idiglesiap4;//iglesia padrino 4
                $personapa->fecha_nacimiento=$request->fechanap4; //fecha nacimiento p4
                $personapa->estado=1; //estado 
                $personapa->save();

                $confirma = Sacramentos3::findOrFail($idsacramento);
                $confirma->id_padrino = $idp1;
                $confirma->id_padrino2 = $idp2;
                $confirma->id_padrino3 = $request->id_pd3;
                $confirma->id_padrino4 = $idp4;
                $confirma->save();
            break;
            }
            case '15':{
                $id_persona= Persona::max('id');
                $idp2=$id_persona+1;
                $idp4=$idp2+1;

                $personapa = new Persona();
                $personapa->id= $idp2;
                $personapa->nombre_persona= $request->nombre_pd2;
                $personapa->apellido_persona=$request->apellido_pd2;
                $personapa->dui_pasaporte=$request->dui_pd2;
                $personapa->sexo=$request->sexo_pd2;
                $personapa->idzonaa=$request->idzonap2;//zona padrino 2
                $personapa->idiglesia=$request->idiglesiap2;//iglesia padrino 2
                $personapa->fecha_nacimiento=$request->fechanap2; //fecha nacimiento p2
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp4;
                $personapa->nombre_persona= $request->nombre_pd4;
                $personapa->apellido_persona=$request->apellido_pd4;
                $personapa->dui_pasaporte=$request->dui_pd4;
                $personapa->sexo=$request->sexo_pd4;
                $personapa->idzonaa=$request->idzonap4;//zona padrino 4
                $personapa->idiglesia=$request->idiglesiap4;//iglesia padrino 4
                $personapa->fecha_nacimiento=$request->fechanap4; //fecha nacimiento p4
                $personapa->estado=1; //estado 
                $personapa->save();

                $confirma = Sacramentos3::findOrFail($idsacramento);
                $confirma->id_padrino = $request->id_pd1;
                $confirma->id_padrino2 = $idp2;
                $confirma->id_padrino3 = $request->id_pd3;
                $confirma->id_padrino4 = $idp4;
                $confirma->save();
            break;
            }
            case '16':{
                $id_persona= Persona::max('id');
                $idp1=$id_persona+1;
                $idp4=$idp1+1;

                $personapa = new Persona();
                $personapa->id= $idp1;
                $personapa->nombre_persona= $request->nombre_pd1;
                $personapa->apellido_persona=$request->apellido_pd1;
                $personapa->dui_pasaporte=$request->dui_pd1;
                $personapa->sexo=$request->sexo_pd1;
                $personapa->idzonaa=$request->idzonap1;//zona padrino 1
                $personapa->idiglesia=$request->idiglesiap1;//iglesia padrino 1
                $personapa->fecha_nacimiento=$request->fechanap1; //fecha nacimiento p1
                $personapa->estado=1; //estado 
                $personapa->save();

                $personapa = new Persona();
                $personapa->id= $idp4;
                $personapa->nombre_persona= $request->nombre_pd4;
                $personapa->apellido_persona=$request->apellido_pd4;
                $personapa->dui_pasaporte=$request->dui_pd4;
                $personapa->sexo=$request->sexo_pd4;
                $personapa->idzonaa=$request->idzonap4;//zona padrino 4
                $personapa->idiglesia=$request->idiglesiap4;//iglesia padrino 4
                $personapa->fecha_nacimiento=$request->fechanap4; //fecha nacimiento p4
                $personapa->estado=1; //estado 
                $personapa->save();

                $confirma = Sacramentos3::findOrFail($idsacramento);
                $confirma->id_padrino = $idp1;
                $confirma->id_padrino2 = $request->id_pd2;
                $confirma->id_padrino3 = $request->id_pd3;
                $confirma->id_padrino4 = $idp4;
                $confirma->save();
            break;
            }
        }
        
       
    }

}
