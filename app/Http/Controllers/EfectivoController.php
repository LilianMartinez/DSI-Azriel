<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Efectivo;
use App\MontoFijo;
use APP\CategoriaResumen;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EfectivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
       

        $buscar = $request->buscar;
        $criterio = $request->criterio;  
        $componente=$request->componente;
        $hoy=new \DateTime();
        if($componente==1){
            if ($buscar == ''){
             
                $efectivos = DB::table('efectivos')->where('fecha',$hoy)->paginate(15);
            } 
            else {
                
                $efectivos= DB::table('efectivos')
                ->where('fecha', $hoy)
                ->where($criterio, 'like','%' . $buscar .'%')
                ->orderBy('id','desc')->paginate(15);
            }
        } else{
            if($componente!=1){
            if ($buscar == ''){
            $fechaActual=new \DateTime();
            $anio=$fechaActual->format('Y');
            $mes=$fechaActual->format('m');
             $efectivos= DB::table('efectivos')->whereYear('fecha', $anio)->whereMonth('fecha', $mes)->orderBy('id','desc')->paginate(30);
            } else {
            $efectivos= DB::table('efectivos')->where($criterio, 'like','%' . $buscar .'%')->orderBy('id','desc')->paginate(15);
            }
        }
    }

       return[
       'pagination' =>[
            'total' =>  $efectivos->total(),
            'current_page' => $efectivos->currentPage(),
            'per_page' =>$efectivos->perPage(),
            'last_page' => $efectivos->lastPage(),
            'from' => $efectivos->firstItem(),
            'to' => $efectivos->lastItem(),
            ],
            'efectivos' => $efectivos
        ];
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $this->validate($request, [
            'descripcion_efectivo'=> 'required|min:5|max:50',
            'monto'=>'required|between:0,9999.99'
 
         ]);
         $id_efectivo = Efectivo::max('id');
         $id=$id_efectivo+1;


        $efectivo = new Efectivo();
        $efectivo->id=$id;
        $efectivo->num_recibo= $request->num_recibo;
        $efectivo->descripcion_efectivo=$request->descripcion_efectivo;
        $efectivo->tipo=$request->tipo;
        $efectivo->monto=$request->monto;
        $efectivo->fecha= new \DateTime();
        $efectivo->idcare=$request->idcare;
       // $efectivo->fecha=Carbon::now()->toDateString();
        $efectivo->save();

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $this->validate($request, [
            'descripcion_efectivo'=> 'required|min:5|max:50',
            'monto'=>'required|between:0,9999.99'
 
         ]);
        $efectivo = Efectivo::findOrFail($request->id);
        $efectivo->num_recibo= $request->num_recibo;
        $efectivo->descripcion_efectivo=$request->descripcion_efectivo;
        $efectivo->tipo=$request->tipo;
        $efectivo->monto=$request->monto;
        $efectivo->idcare=$request->idcare;
        $efectivo->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $efectivo = DB::table('efectivos')->where("id",$request->id)->delete();
        return "evento eliminado";
    }

    public function buscar(Request $request)
    {
        if(!$request->ajax()) 
            return redirect('/');
        $envio=array();
        $h=1;
        $h2=2;
    

        /* ------------------------------------------- */
        $fechaActual=new \DateTime();
        $anio=$fechaActual->format('Y');
        $mes=$fechaActual->format('m');
        /*--------------------------------------------- */

        $efectivo = DB::table('efectivos')->whereYear('fecha', $anio)->whereMonth('fecha', $mes)->where("tipo",1)->sum("monto");
        $efectivo2=  DB::table('efectivos')->whereYear('fecha', $anio)->whereMonth('fecha', $mes)->where("tipo",2)->sum("monto");

       /*$efectivo = DB::table('efectivos')->where("tipo",$h)->sum("monto");
       $efectivo2=  DB::table('efectivos')->where("tipo",$h2)->sum("monto");*/
       $total= $efectivo-$efectivo2;
       $envio['total']= number_format($total, 2);

       //$fechaActual=new \DateTime('2019-01-01');//OBJETIVO TIPO FECHA APARTIR DE 01-01-2019 
       $fechaActual=new \DateTime();//FECHA ACTUAL 
       $efectivo = DB::table('efectivos') ->select('num_recibo','descripcion_efectivo','tipo', 'monto',DB::raw('DATE_FORMAT(fecha, "%d/%m/%Y") as fecha'),'idcare')
       ->where('fecha', $fechaActual)->where("tipo",2)->sum("monto");
       $envio['egreso']=$efectivo;
       $efectivo = DB::table('efectivos') ->where('fecha', $fechaActual)->where("tipo",1)->sum("monto");
       $envio['ingreso']=$efectivo;
       //$envio['fecha']=$fechaActual->format('d-m-Y');
       return $envio; 
      
    }
    public function buscarM(Request $request)
    {
      
        if(!$request->ajax()) 
            return redirect('/');
        $envio=array();
       
        $fechaActual=new \DateTime();
        $anio=$fechaActual->format('Y');
        $mes=$fechaActual->format('m');
        
        $efectivo = DB::table('efectivos')->whereYear('fecha', $anio)->whereMonth('fecha', $mes)->where("tipo",1)->sum("monto");
        $efectivo2=  DB::table('efectivos')->whereYear('fecha', $anio)->whereMonth('fecha', $mes)->where("tipo",2)->sum("monto");
        $total= $efectivo-$efectivo2;
        $envio['total']= number_format($total, 2);

       
       $efectivo = DB::table('efectivos')->whereYear('fecha', $anio)->whereMonth('fecha', $mes)->where("tipo",2)->sum("monto");
       $envio['egreso']=$efectivo;
       $efectivo = DB::table('efectivos')->whereYear('fecha', $anio)->whereMonth('fecha', $mes)->where("tipo",1)->sum("monto");
       $envio['ingreso']=$efectivo;
       return $envio;  
    }

   /* public function buscaringreso(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $h=1;
        $hoy=Carbon::now()->toDateString();
       $efectivo = DB::table('efectivos') ->where('fecha', $hoy)->where("tipo",$h)->sum("monto");
      return $efectivo;  
    }*/

    public function listarPdfGeneral(){

        $fechaActual=new \DateTime();
        $anio=$fechaActual->format('Y');
        $mes=$fechaActual->format('m');
        $efectivos= DB::table('efectivos')->whereYear('fecha', $anio)->whereMonth('fecha', $mes)->orderBy('id','desc')->get();
        

        $pdf= \PDF::loadView('pdf.efectivosCEMpdf',['efectivos'=>$efectivos]);
        return $pdf->download('ControlEconomicoMensual.pdf');
    }

}
