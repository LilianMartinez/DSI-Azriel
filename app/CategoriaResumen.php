<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaResumen extends Model
{
    protected $table = 'categorias_resumenes';
    protected $primaryKey = 'id';

    protected $fillable = ['nombre_categoria','descripcion_categoria','estado'];
}
