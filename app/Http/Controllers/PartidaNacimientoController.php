<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PartidaNacimiento;
use Illuminate\Support\Facades\DB;

class PartidaNacimientoController extends Controller
{
    //
    public function realizante(Request $request)
    {
        $alcaldia = $request->alcaldia;
        $libro = $request->libro;
        $partida = $request->partida;
        $folio = $request->folio;
        $ano = $request->ano;
        $envio=array();
        $nada=0;
        $algo=1;

        if(!$request->ajax()) return redirect('/');
        $persona = DB::table('partidas_nacimientos')->where('alcaldia',  $alcaldia )
        ->where('libro',  $libro  )
        ->where('partida',  $partida )
        ->where('folio', $folio )
        ->where('ano', $ano )->first();
        if(empty($persona)){
            $envio['solo']=$nada;
        }else{
        $envio['solo']=$algo;
        $envio['realizante']=$persona;
        }
        return $envio;
    }
    public function registro(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

            
        $idpartida_p= PartidaNacimiento::max('id');
        $idpartida=$idpartida_p+1;

        $partida = new PartidaNacimiento();
        $partida->id=$idpartida;
        $partida->alcaldia= $request->alcaldia;
        $partida->libro=$request->libro;
        $partida->partida=$request->partida;
        $partida->folio=$request->folio;
        $partida->folio=$request->ano;
        $partida->idpersona=$request->idpersona;
        $partida->save();
    }

}
