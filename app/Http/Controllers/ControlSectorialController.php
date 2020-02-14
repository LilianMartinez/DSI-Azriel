<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Persona;
use App\ProductoInventario;
use App\Iglesia;
use App\Zona;
use App\CategoriaInventario;

class ControlSectorialController extends Controller
{
    public function buscarIglesiaFeligreses(Request $request)
    {
        #$envio=array();
        #$idzona=$request->idzona;

        if(!$request->ajax()) return redirect('/');
        $iglesias = Iglesia::join('personas','personas.idiglesia','=','iglesias.id')
                        ->join('zonas','zonas.id','=','iglesias.idzona')
                        ->select('iglesias.id as idigle','iglesias.nombre_iglesia','iglesias.idzona','personas.id', 'personas.nombre_persona', 'personas.dui_pasaporte',
                                 'personas.apellido_persona', 'personas.idiglesia','personas.estado','personas.fecha_nacimiento', 'personas.sexo',
                                 'zonas.id as idz','zonas.nombre_zona')
                        ->where('iglesias.id','=',$request->id)
                        ->where('personas.estado','=',1)
                        ->get();

        return response()->json($iglesias);
    }

    public function buscarIglesiaInventarios(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
       
        $inventario = ProductoInventario::join('iglesias','productos_inventarios.idiglesia','=','iglesias.id')
                                        ->join('categorias_inventarios','productos_inventarios.idcategoriainv','=','categorias_inventarios.id')
                                        ->leftJoin('zonas','zonas.id','=','productos_inventarios.idzona')
                        ->select('iglesias.id as idigle','iglesias.nombre_iglesia','iglesias.idzona',
                        'productos_inventarios.idcategoriainv', 'productos_inventarios.id','productos_inventarios.nombre_producto', 'productos_inventarios.marca', 
                        'productos_inventarios.descripcion', 'productos_inventarios.cantidad','productos_inventarios.idiglesia',
                        'productos_inventarios.enuso', 'productos_inventarios.guardadas', 'productos_inventarios.desuso',
                        'productos_inventarios.estado','productos_inventarios.fecha_adquirido','productos_inventarios.costocompra',
                        'categorias_inventarios.id as cateinv','categorias_inventarios.nombre_categoriainv','zonas.nombre_zona')
                        ->where('iglesias.id','=',$request->id)
                        ->where('productos_inventarios.estado','=',1)
                        ->get();
        
    
        return $inventario;
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        
        
         $inv = ProductoInventario::findOrFail($request->id);
         $inv->nombre_producto= $request->nombre_producto;
         $inv->save();
    }
}
