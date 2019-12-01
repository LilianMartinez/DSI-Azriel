<?php

namespace App\Http\Controllers;
use App\Efectivo;
use App\CategoriaResumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResumenEconomicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if(!$request->ajax()) return redirect('/');
       
    
        $fechaActual=new \DateTime();
        $anio=$fechaActual->format('Y');
        $mes=$fechaActual->format('m');
        $envio=array();  
        $total1=0;
        $total1nulos=0;
        $total2=0;
        $total2nulos=0;

             
                $categorias = CategoriaResumen::join('efectivos','categorias_resumenes.id','=','efectivos.idcare')
                                ->select(DB::raw('ROW_NUMBER() OVER() as id_temp'),'efectivos.tipo','categorias_resumenes.nombre_categoria as nombres',
                                DB::raw('sum(monto) as montos'))
                                ->whereYear('efectivos.fecha', $anio)->whereMonth('efectivos.fecha', $mes)
                                ->groupby('efectivos.tipo','categorias_resumenes.nombre_categoria')->get();
                $nullos = DB::table('efectivos')->select(DB::raw('ROW_NUMBER() OVER() as id_tempnul'),'tipo', 'descripcion_efectivo', 'monto')
                            ->whereNull('idcare')->whereYear('fecha', $anio)->whereMonth('fecha', $mes)->get();
                           
                          
                            $envio['categoria']=$categorias;
                            $envio['nullo']=$nullos;

                            foreach($categorias as &$t){
            
                                if($t->tipo==1){
                                    $total1=$total1+$t->montos;
                                }else{
                                    $total2=$total2+$t->montos;
                                }                    
                            }
                            foreach($nullos as &$n){
            
                                if($n->tipo==1){
                                    $total1nulos=$total1nulos+$n->monto;
                                }else{
                                    $total2nulos=$total2nulos+$n->monto;
                                }                    
                            }
                           $ingresos=$total1+$total1nulos;
                           $egresos=$total2+$total2nulos;
                           $envio['ingresos']=$ingresos;
                            $envio['egresos']=$egresos;
                            $envio['total']=$ingresos-$egresos;
                            
       return $envio;
      
    }
    public function buscarAM(Request $request)
    {
      if(!$request->ajax()) return redirect('/');
       
        $anio=$request->anioBuscar;
        $mes=$request->mesBuscar;

        switch($mes){
            case 'ENERO': $mes=01;
            break;
            case 'FEBRERO': $mes=02;
            break;
            case 'MARZO': $mes=03;
            break;
            case 'ABRIL': $mes=04;
            break;
            case 'MAYO': $mes=05;
            break;
            case 'JUNIO': $mes=06;
            break;
            case 'JULIO': $mes=07;
            break;
            case 'AGOSTO': $mes=8;
            break;
            case 'SEPTIEMBRE': $mes=9;
            break;
            case 'OCTUBRE': $mes=10;
            break;
            case 'NOVIEMBRE': $mes=11;
            break;
            case 'DICIEMBRE': $mes=12;
            break;
            }
        

        $envio=array();  
        $total1=0;
        $total1nulos=0;
        $total2=0;
        $total2nulos=0;
    
             
                $categorias = CategoriaResumen::join('efectivos','categorias_resumenes.id','=','efectivos.idcare')
                                ->select(DB::raw('ROW_NUMBER() OVER() as id_temp'),'efectivos.tipo','categorias_resumenes.nombre_categoria as nombres',
                                DB::raw('sum(monto) as montos'))
                                ->whereYear('efectivos.fecha', $anio)->whereMonth('efectivos.fecha', $mes)
                                ->groupby('efectivos.tipo','categorias_resumenes.nombre_categoria')->get();
                $nullos = DB::table('efectivos')->select(DB::raw('ROW_NUMBER() OVER() as id_tempnul'),'tipo', 'descripcion_efectivo', 'monto')
                            ->whereNull('idcare')->whereYear('fecha', $anio)->whereMonth('fecha', $mes)->get();
                           
                          
                          
                            $envio['categoria']=$categorias;
                            $envio['nullo']=$nullos;

                            foreach($categorias as &$t){
            
                                if($t->tipo==1){
                                    $total1=$total1+$t->montos;
                                }else{
                                    $total2=$total2+$t->montos;
                                }                    
                            }
                            foreach($nullos as &$n){
            
                                if($n->tipo==1){
                                    $total1nulos=$total1nulos+$n->monto;
                                }else{
                                    $total2nulos=$total2nulos+$n->monto;
                                }                    
                            }
                           $ingresos=$total1+$total1nulos;
                           $egresos=$total2+$total2nulos;
                           $envio['ingresos']=$ingresos;
                            $envio['egresos']=$egresos;
                            $envio['total']=$ingresos-$egresos;
                            
       return $envio;
      
    }
   
    public function listarPdfResumido(){

        $fechaActual=new \DateTime();
        $anio=$fechaActual->format('Y');
        $mes=$fechaActual->format('m');
        $envio=array();  
        $total1=0;
        $total1nulos=0;
        $total2=0;
        $total2nulos=0;
    
                $categorias = CategoriaResumen::join('efectivos','categorias_resumenes.id','=','efectivos.idcare')
                                ->select(DB::raw('ROW_NUMBER() OVER() as id_temp'),'efectivos.tipo','categorias_resumenes.nombre_categoria as nombres',DB::raw('sum(monto) as montos'))
                                ->whereYear('efectivos.fecha', $anio)->whereMonth('efectivos.fecha', $mes)
                                ->groupby('efectivos.tipo','categorias_resumenes.nombre_categoria')->get();
                $nullos = DB::table('efectivos')->select(DB::raw('ROW_NUMBER() OVER() as id_tempnul'),'tipo', 'descripcion_efectivo', 'monto')
                            ->whereNull('idcare')->whereYear('fecha', $anio)->whereMonth('fecha', $mes)->get();
                           
                            $envio['categoria']=$categorias;
                            $envio['nullo']=$nullos; 
    $pdf= \PDF::loadView('pdf.efectivosCEMRpdf',['categorias'=>$envio['categoria'], 'efectivos'=>$envio['nullo']]);
    return $pdf->download('ControlEconomicoMensualResumido.pdf');
}


}
