<?php

namespace App\Http\Controllers;
use App\User;
use App\Persona;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        //$efectivos = Efectivo::all();
        if(!$request->ajax()) return redirect('/');
        

          $buscar = $request->buscar;
          $criterio = $request->criterio;  

          if ($buscar==''){
            $personas = User::join('personas','users.id','=','personas.id')
            ->join('roles','users.idrol','=','roles.id')
            ->select('personas.id','personas.nombre_persona','personas.apellido_persona',
            'users.usuario','users.password','users.condicion','users.idrol',
            'roles.nombre_rol')
            ->orderBy('personas.id', 'desc')->paginate(6);
        }
        else{
            $personas = User::join('personas','users.id','=','personas.id')
            ->join('roles','users.idrol','=','roles.id')
            ->select('personas.id','personas.nombre_persona','personas.apellido_persona',
            'users.usuario','users.password','users.condicion','users.idrol',
            'roles.nombre_rol')         
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(6);
        }
         
 
        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
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
        if (!$request->ajax()) return redirect('/');
         
        try{
            DB::beginTransaction();
            $id_persona = Persona::max('id');
            $id=$id_persona+1;
            $persona = new Persona();
            $persona->id=$id;
            $persona->nombre_persona = $request->nombre_persona;
            $persona->apellido_persona = $request->apellido_persona;
            $persona->save();
 
            $user = new User();
            $user->usuario = $request->usuario;
            $user->password =bcrypt( $request->password);
            $user->condicion = '1';
            $user->idrol = $request->idrol;          
 
            $user->id = $persona->id;
 
            $user->save();
 
            DB::commit();
 
        } catch (Exception $e){
            DB::rollBack();
        }

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
        if (!$request->ajax()) return redirect('/');
         
        try{
            DB::beginTransaction();
 
            //Buscar primero el proveedor a modificar
            $user = User::findOrFail($request->id);
 
            $persona = Persona::findOrFail($user->id);
            $persona->nombre_persona = $request->nombre_persona;
            $persona->apellido_persona = $request->apellido_persona;
            $persona->save();
 
            $user->usuario = $request->usuario;
            $user->password = bcrypt( $request->password);
            $user->condicion = '1';
            $user->idrol = $request->idrol;
            $user->save();
 
 
            DB::commit();
 
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }
 
    public function activar(Request $request)
    {
       if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }

}
