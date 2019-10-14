<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sacramentos3;
use App\Efectivo;
use Illuminate\Support\Facades\DB;

class Sacramentos3Controller extends Controller
{
    public function registro(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

            
        $idsacramento_p= Sacramentos3::max('id');
        $idsacramento=$idsacramento_p+1;
        $tipo=2;

        $monto_p= Efectivo::max('id');
        $montos=$monto_p+1;
           

        $sacramento = new Sacramentos3();
        $sacramento->id=$idsacramento;
        $sacramento->tipo_sacramento= $tipo;
        $sacramento->fecha_realizacion=$request->fecha;
        $sacramento->id_realizante1=$request->realizante;
        $sacramento->id_sacerdote=$request->sacerdote;
        $sacramento->titulo=$request->titulo;
        $sacramento->save();

        $efectivo = new Efectivo();
        $efectivo->id=$montos;
        $efectivo->descripcion_efectivo='PRIMERA COMUNION';
        $efectivo->idcare=$request->idcate;
        $efectivo->tipo= 1;
        $efectivo->monto=$request->monto;
        $efectivo->fecha= new \DateTime();
        $efectivo->save();
    }

}
