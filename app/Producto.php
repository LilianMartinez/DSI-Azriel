<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'id';
    protected $fillable=['nombre_producto','unidad_medida','estado'];
    
}
