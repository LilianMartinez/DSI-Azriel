<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
    protected $table = 'salidas';
    protected $primaryKey = 'id';
    protected $fillable = ['id_existencia','cantidad','precio_ventaF','fecha'];
}
