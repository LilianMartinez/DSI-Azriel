<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canasta extends Model
{
    protected $table = 'canasta';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre_canasta','fecha','costo_canasta','precio_venta','cantidad'];
}
