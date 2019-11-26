<?php

namespace App\Http\Controllers;
use App\ProductoInventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoInventarioController extends Controller
{
    public function index(Request $request)
    {
       // if(!$request->ajax()) return redirect('/');
  
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        
        if ($buscar == ''){
            $proinventarioIgle = ProductoInventario::join('iglesias','productos_inventarios.idiglesia','=','iglesias.id')
            ->join('categorias_inventarios','productos_inventarios.idcategoriainv','=','categorias_inventarios.id')
            ->leftJoin('zonas','zonas.id','=','productos_inventarios.idzona')
                ->select('iglesias.id as idigle','iglesias.nombre_iglesia','iglesias.idzona',
                'productos_inventarios.idcategoriainv', 'productos_inventarios.id','productos_inventarios.nombre_producto', 'productos_inventarios.marca', 
                'productos_inventarios.descripcion', 'productos_inventarios.cantidad','productos_inventarios.idiglesia',
                'productos_inventarios.enuso', 'productos_inventarios.guardadas', 'productos_inventarios.desuso',
                'productos_inventarios.estado','productos_inventarios.fecha_adquirido','productos_inventarios.costocompra',
                'categorias_inventarios.id as cateinv','categorias_inventarios.nombre_categoriainv','zonas.nombre_zona')
                ->where('productos_inventarios.estado','=',1)
                ->paginate(15);

            
        } else {
            $proinventarioIgle = ProductoInventario::join('iglesias','productos_inventarios.idiglesia','=','iglesias.id')
            ->join('categorias_inventarios','productos_inventarios.idcategoriainv','=','categorias_inventarios.id')
            ->leftJoin('zonas','zonas.id','=','productos_inventarios.idzona')
            ->select('iglesias.id as idigle','iglesias.nombre_iglesia','iglesias.idzona',
            'productos_inventarios.idcategoriainv', 'productos_inventarios.id','productos_inventarios.nombre_producto', 'productos_inventarios.marca', 
            'productos_inventarios.descripcion', 'productos_inventarios.cantidad','productos_inventarios.idiglesia',
            'productos_inventarios.enuso', 'productos_inventarios.guardadas', 'productos_inventarios.desuso',
            'productos_inventarios.estado','productos_inventarios.fecha_adquirido','productos_inventarios.costocompra',
            'categorias_inventarios.id as cateinv','categorias_inventarios.nombre_categoriainv','zonas.nombre_zona')
            ->where('productos_inventarios.estado','=',1)
            ->where($criterio, 'like','%' . $buscar .'%')
            ->paginate(15);
        }
        return [
            'pagination' =>[
                 'total' =>  $proinventarioIgle->total(),
                 'current_page' => $proinventarioIgle->currentPage(),
                 'per_page' =>$proinventarioIgle->perPage(),
                 'last_page' => $proinventarioIgle->lastPage(),
                 'from' => $proinventarioIgle->firstItem(),
                 'to' => $proinventarioIgle->lastItem(),
                 ],
                 'proinventarioIgle' => $proinventarioIgle
             ];
    }
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $this->validate($request, [
           'nombre_producto'=> 'required|min:3|max:99',
           'idcategoriainv'=> 'required',
           'cantidad'=>'required',
           'idiglesia'=>'required',    
           'idzona'=>'required',  

        ]);

            
        $id_producto = ProductoInventario::max('id');
        $id=$id_producto+1;
           

        $productoInven = new ProductoInventario();
        $productoInven->id=$id;
        $productoInven->nombre_producto= $request->nombre_producto;
        $productoInven->idcategoriainv= $request->idcategoriainv;
        $productoInven->marca=$request->marca;
        $productoInven->descripcion= $request->descripcion;
        $productoInven->fecha_adquirido= $request->fecha_adquirido;
        $productoInven->cantidad= $request->cantidad;
        $productoInven->costocompra= $request->costocompra;
        $productoInven->idiglesia= $request->idiglesia;
        $productoInven->idzona= $request->idzona;
        $productoInven->enuso= 0;
        $productoInven->guardadas= $request->cantidad;
        $productoInven->desuso= 0;
        $productoInven->estado=1;
        $productoInven->save();
    }

    public function actualizar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        
        $productoInven = ProductoInventario::findOrFail($request->id);
         $productoInven->enuso=$request->enuso;
         $productoInven->guardadas=$request->guardadas;
         $productoInven->desuso=$request->desuso;
         $productoInven->save();
    }



}

