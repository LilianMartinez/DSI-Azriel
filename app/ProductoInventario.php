<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoInventario extends Model
{
    protected $table = 'productos_inventarios';
    protected $primaryKey = 'id';
    protected $fillable = ['idcategoriainv','nombre_producto','marca','descripcion','fecha_adquirido','cantidad','costocompra','enuso','guardadas','desuso','estado','idiglesia'];

    public function articulo(){
        return $this->belongsTo('App\CategoriaInventario');
    }

    public function iglesia(){
        return $this->belongsTo('App\Iglesia');
    }

}
