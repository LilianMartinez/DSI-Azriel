<?php

namespace App\Http\Controllers;

use App\Persona;
use App\Sacramento;
use App\Efectivo;
//use App\Sacramentos3;
//use App\PartidaNacimiento;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PersonaController2 extends Controller
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

    public function buscarduihombre(Request $request)
    {
        $buscar = $request->dui;
        $envio=array();

        if(!$request->ajax()) return redirect('/');
        $persona = DB::table('personas')->where('sexo','M')->where('dui_pasaporte', $buscar )->first();

        if(empty($persona)){
                $envio['solo']=1;
            }
            else{
                $envio['solo']=2;
                $envio['persona']=$persona;
            }
        
        return $envio;
    }

    public function buscarduimujer(Request $request)
    {
        $buscar = $request->dui;
        $envio=array();

        if(!$request->ajax()) return redirect('/');
        $persona = DB::table('personas')->where('sexo','F')->where('dui_pasaporte', $buscar )->first();

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

        if(!$request->ajax()) return redirect('/');
        $persona = DB::table('personas')->where('tipo_persona',1)->get();

        return $persona;
    }

    public function buscariglesia(Request $request)
    {
        $envio=array();

        if(!$request->ajax()) return redirect('/');
        $iglesia = DB::table('iglesias')->get();

        return $iglesia;
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $tipo=$request->tipo;
        switch($tipo){
            case '4.1': //El case "4" es para matrimonio... y el 4.x depende del tipo de guardado
            {
                //Este es para ingresar todos los datos por primera vez
                $persona_idMax = Persona::max('id');
                $idNovio=$persona_idMax+1;
                $idNovia=$idNovio+1;
                $sacramento_idMax= Sacramento::max('id');
                $idsacramento=$sacramento_idMax+1;
                $tiposacra=4;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='APERTURA EXPEDIENTE MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();
        
                $novio = new Persona();
                $novio->id=$idNovio;
                $novio->nombre_persona= $request->novioNom;
                $novio->apellido_persona=$request->novioAp;
                $novio->dui_pasaporte=$request->novioD;
                $novio->sexo='M';
                $novio->save();

                $novia = new Persona();
                $novia->id=$idNovia;
                $novia->nombre_persona= $request->noviaNom;
                $novia->apellido_persona=$request->noviaAp;
                $novia->dui_pasaporte=$request->noviaD;
                $novia->sexo='F';
                $novia->save();
        
                //En esta etapa, solo se almacenan los datos para abrir un nuevo expediente (no hay datos de padrino y boda hasta la siguiente etapa en "actualizar")
                $sacramento = new Sacramento();
                $sacramento->id=$idsacramento;
                $sacramento->libro=$request->libro;
                $sacramento->num_expediente=$request->num_expediente;
                $sacramento->tipo_sacramento=$tiposacra;
                $sacramento->id_realizante1=$idNovio;
                $sacramento->id_realizante2=$idNovia;
                $sacramento->estado=1;
                $sacramento->save();
                break;
            }
            case '4.2': //Ingresar solo datos del novio
            {
                $persona_idMax = Persona::max('id');
                $idNovio=$persona_idMax+1;
                $idNovia=$request->id_realizante2;//ESTA MALDITA LINEA ES LA QUE NOS FALTABA T.T
                $sacramento_idMax= Sacramento::max('id');
                $idsacramento=$sacramento_idMax+1;
                $tiposacra=4;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='APERTURA EXPEDIENTE MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();
        
                $novio = new Persona();
                $novio->id=$idNovio;
                $novio->nombre_persona= $request->novioNom;
                $novio->apellido_persona=$request->novioAp;
                $novio->dui_pasaporte=$request->novioD;
                $novio->sexo='M';
                $novio->save();
        
                //En esta etapa, solo se almacenan los datos para abrir un nuevo expediente (no hay datos de padrino y boda hasta la siguiente etapa en "actualizar")
                $sacramento = new Sacramento();
                $sacramento->id=$idsacramento;
                $sacramento->libro=$request->libro;
                $sacramento->num_expediente=$request->num_expediente;
                $sacramento->tipo_sacramento=$tiposacra;
                $sacramento->id_realizante1=$idNovio;
                $sacramento->id_realizante2=$idNovia;
                $sacramento->estado=1;
                $sacramento->save();
                break;
            }
            case '4.3': //Ingresar solo datos de la novia
            {
                $persona_idMax = Persona::max('id');
                $idNovia=$persona_idMax+1;
                /* $idNovio=Persona::findOrFail($request->id); */
                $idNovio=$request->id_realizante1;
                $sacramento_idMax= Sacramento::max('id');
                $idsacramento=$sacramento_idMax+1;
                $tiposacra=4;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='APERTURA EXPEDIENTE MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();

                $novia = new Persona();
                $novia->id=$idNovia;
                $novia->nombre_persona= $request->noviaNom;
                $novia->apellido_persona=$request->noviaAp;
                $novia->dui_pasaporte=$request->noviaD;
                $novia->sexo='F';
                $novia->save();
        
                //En esta etapa, solo se almacenan los datos para abrir un nuevo expediente (no hay datos de padrino y boda hasta la siguiente etapa en "actualizar")
                $sacramento = new Sacramento();
                $sacramento->id=$idsacramento;
                $sacramento->libro=$request->libro;
                $sacramento->num_expediente=$request->num_expediente;
                $sacramento->tipo_sacramento=$tiposacra;
                $sacramento->id_realizante1=$idNovio;
                $sacramento->id_realizante2=$idNovia;
                $sacramento->estado=1;
                $sacramento->save();
                break;
            }
            case '4.4': //Solo ingresamos datos del sacramento
            {
                /* $idNovio=Persona::findOrFail($request->id);
                $idNovia=Persona::findOrFail($request->id); */
                $idNovio=$request->id_realizante1;
                $idNovia=$request->id_realizante2;
                $sacramento_idMax= Sacramento::max('id');
                $idsacramento=$sacramento_idMax+1;
                $tiposacra=4;
                $monto_p= Efectivo::max('id');
                $montos=$monto_p+1;

                $efectivo = new Efectivo();
                $efectivo->id=$montos;
                $efectivo->descripcion_efectivo='APERTURA EXPEDIENTE MATRIMONIO';
                $efectivo->idcare=$request->idcate;
                $efectivo->tipo= 1;
                $efectivo->monto=$request->monto;
                $efectivo->fecha= new \DateTime();
                $efectivo->save();
        
                //En esta etapa, solo se almacenan los datos para abrir un nuevo expediente (no hay datos de padrino y boda hasta la siguiente etapa en "actualizar")
                $sacramento = new Sacramento();
                $sacramento->id=$idsacramento;
                $sacramento->libro=$request->libro;
                $sacramento->num_expediente=$request->num_expediente;
                $sacramento->tipo_sacramento=$tiposacra;
                $sacramento->id_realizante1=$idNovio;
                $sacramento->id_realizante2=$idNovia;
                $sacramento->estado=1;
                $sacramento->save();
                break;
            }
        }
    } //llave funcion


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

    //Editar un objeto sacramento
    public function update(Request $request)//ESTO YA FUNCIONA OFICIALMENTE, DESPUÉS DE 2,222 INTENTOS
    {
        if(!$request->ajax()) return redirect('/');
        $tipo=$request->tipo;
        $id_realizante1 =$request->id_realizante1;
        $id_realizante2 =$request->id_realizante2;
        switch($tipo){
            case '4':
            {
                
                    $sacramento = Sacramento::findOrFail($request->id);
                    $sacramento->libro=$request->libro;
                    $sacramento->num_expediente=$request->num_expediente;
                    $sacramento->save();

                    /* $novio = DB::table('personas')->where('id', 'like', '%'. $idNovio .'%')->first(); */
                    /* $novio = App\Persona::where('id', $idNovio)->first(); */
                    /* $persona = DB::table('personas')->where('id', 'like', '%'. $buscar .'%')->first(); */
                    $novio = DB::table('personas')->where("id",$request->id_realizante1)
                    ->update(["nombre_persona"=>$request->novioNom, "apellido_persona" => $request->novioAp, "dui_pasaporte" =>$request->novioD]);
                    /* $novio->novioNom= $request->novioNom;
                    $novio->novioAp=$request->novioAp;
                    $novio->novioD=$request->novioD;
                    $novio->save(); */

                    $novia = DB::table('personas')->where("id",$request->id_realizante2)
                    ->update(["nombre_persona"=>$request->noviaNom, "apellido_persona" => $request->noviaAp, "dui_pasaporte" =>$request->noviaD]);

                break;
            }
        }
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


    public function certificadoMatri(Request $request){
        $idsacramento=$request->id;
        $idSacer=$request->idsacerdote;
        $cargoSa =$request->cargosacerdote;
        $concepto=$request->enConcepto;
        $holi=1;

           /* $matrimonio=Sacramento:://join('personas','personas.id','=','sacramentos.id_realizante1') //novio
                                 // ->join('personas as 1','1.id','=','sacramentos.id_realizante2') //novia
                                //  ->join('iglesias','iglesias.id','=','sacramentos.id_iglesia')     //iglesis
                                //  ->join('personas as 2','2.id','=','sacramentos.id_sacerdote')   //sacerdote
                                  ->join('personas as 3','3.id','=','sacramentos.id_padrino')  //padrino1
                                  ->join('personas as 4','4.id','=','sacramentos.id_padrino2')  //padrino2
                                  ->join('personas as 5','5.id','=','sacramentos.id_padrino3')  //padrino3
                                  ->join('personas as 6','6.id','=','sacramentos.id_padrino4')  //padrino4
                ->select('sacramentos.id','sacramentos.tipo_sacramento','sacramentos.libro','sacramentos.num_expediente',
                         'personas.nombre_persona as nomnovio', 'personas.apellido_persona as apelnovio','1.nombre_persona as nomnovia',
                         '1.nombre_persona as apelnovia','sacramentos.fecha_realizacion','iglesias.nombre_iglesia',
                         'sacramentos.titulo','2.nombre_persona as nompadre','2.apellido_persona as apelpadre',
                         '3.nombre_persona as nompad1', '3.apellido_persona as apelpad1',
                         '4.nombre_persona as nompad2', '4.apellido_persona as apelpad2',
                         '5.nombre_persona as nompad3', '5.apellido_persona as apelpad3',
                         '6.nombre_persona as nompad4', '6.apellido_persona as apelpad4')
                ->where('sacramentos.id','=',$id)
                ->orderby('sacramentos.id','desc')->get();*/

                $sacraIgle=Sacramento::join('iglesias','iglesias.id','=','sacramentos.id_iglesia')
                                      ->select('sacramentos.id','sacramentos.tipo_sacramento','sacramentos.libro','sacramentos.num_expediente',
                                      'sacramentos.fecha_realizacion','iglesias.nombre_iglesia','sacramentos.titulo')
                                      ->where('sacramentos.id','=',$idsacramento)
                                      ->orderby('sacramentos.id','desc')->get();

                $novio=Sacramento::join('personas','personas.id','=','sacramentos.id_realizante1')
                                ->select('personas.nombre_persona as nomnovio', 'personas.apellido_persona as apelnovio')
                                 ->where('sacramentos.id','=',$idsacramento)->get(); //novio

                $novia=Sacramento::join('personas','personas.id','=','sacramentos.id_realizante2')
                                 ->select('personas.nombre_persona as nomnovia', 'personas.apellido_persona as apelnovia')
                                  ->where('sacramentos.id','=',$idsacramento)->get(); //novia

                $padre=Sacramento::join('personas','personas.id','=','sacramentos.id_sacerdote')
                                  ->select('personas.nombre_persona as nompadre', 'personas.apellido_persona as apelpadre')
                                   ->where('sacramentos.id','=',$idsacramento)->get(); //padre

                $p1=Sacramento::join('personas','personas.id','=','sacramentos.id_padrino')
                                   ->select('personas.nombre_persona as nompad1', 'personas.apellido_persona as apelpad1')
                                    ->where('sacramentos.id','=',$idsacramento)->get(); //padrino1

                $p2=Sacramento::join('personas','personas.id','=','sacramentos.id_padrino2')
                                    ->select('personas.nombre_persona as nompad2', 'personas.apellido_persona as apelpad2')
                                     ->where('sacramentos.id','=',$idsacramento)->get(); //padrino2

                $p3=Sacramento::join('personas','personas.id','=','sacramentos.id_padrino3')
                                ->select('personas.nombre_persona as nompad3', 'personas.apellido_persona as apelpad3')
                                 ->where('sacramentos.id','=',$idsacramento)->get(); //padrino3

                $p4=Sacramento::join('personas','personas.id','=','sacramentos.id_padrino4')
                                ->select('personas.nombre_persona as nompad4', 'personas.apellido_persona as apelpad4')
                                 ->where('sacramentos.id','=',$idsacramento)->get(); //padrino4
                            
              /*  $ns=Persona::select('nombre_persona,apellido_persona')
                            ->where('id','=',$idSacer)->get(); //nombre y apellido de padre a firmar la acta*/

 

                $pdf= \PDF::loadView('pdf.certiMatrimonio',['sacraIgle'=>$sacraIgle,'novio'=>$novio,'novia'=>$novia,
                'padre'=>$padre,'p1'=>$p1,'p2'=>$p2,'p3'=>$p3,'p4'=>$p4,'holi'=>$holi,'idsacramento'=>$idsacramento, 'cargoSa'=>$cargoSa,
                'idSacer'=>$idSacer,'concepto'=>$concepto]);
                return $pdf->download('CertificadoDeMatrimonio.pdf');

                /*
                llenadoarray(){            
                this.arraycargo= new Array('DIACONO','PADRE','ARZOBISPO','CARDENAL','NUNCIO APOSTOLICO','MONSEÑOR');                
                 },
                */ 

    }
}