<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaInventario extends Model
{
    protected $table = 'categorias_inventarios';
    protected $primaryKey = 'id';
    protected $fillable=['nombre_categoriainv','descripcion_categoriainv','estado'];

}
