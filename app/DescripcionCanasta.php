<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DescripcionCanasta extends Model
{
    protected $table = 'descripcion_canasta';
    protected $primaryKey = 'id';
    protected $fillable = ['cantidad','id_existencia','id_canasta'];
}
