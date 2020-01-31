<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidadmedida extends Model
{
    protected $table = 'unidad_medida';
    protected $primaryKey = 'id';
    protected $fillable = ['unidad','estado'];

}
