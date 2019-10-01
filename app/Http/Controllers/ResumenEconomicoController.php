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
      //  if(!$request->ajax()) return redirect('/');
       

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
                            

                         //   $envio['categoria'] = array_search($categorias->toArray(), $results->toArray());

                     /*  $pro=DB::table(DB::raw("({$categorias}) as x"))
                                ->select(DB::raw('ROW_NUMBER() OVER() as id_temp'),'x.tipo','x.descripcion_efectivo','x.monto');
                                $envio['categorias']=$pro;

                     //    $pro = DB::table('categorias_resumenes')->select(DB::raw('ROW_NUMBER() OVER() as id_temp'))->get();
                        //  select($nullos.'tipo',$nullos.'descripcion_efectivo',$nullos.'monto') ->get();

                       /* $pro= DB::select(DB::raw('Select ROW_NUMBER() over()AS id_temp, x.tipo, x.nombre_categoria, x.montos
                        from (Select T.tipo, C.nombre_categoria, sum(T.monto) as montos 
                        from categorias_resumenes C inner join efectivos T on T.idcare=C.id 
                        where extract(month from T.fecha)=09 and extract(year from T.fecha)=2019 group by(C.nombre_categoria, T.tipo)
                        union select tipo, descripcion_efectivo, monto from efectivos 
                        where idcare is null and extract(month from fecha)=09 and extract(year from fecha)=2019) as x;
                        '));*/

       return $envio;
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
