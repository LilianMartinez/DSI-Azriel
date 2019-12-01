<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleEntrada extends Model
{
    protected $table = 'detalle_entrada';
    protected $primaryKey = 'id';
    protected $fillable = ['id_producto','cantidad','fecha','precio_compra','tipo','unitario'];
}
