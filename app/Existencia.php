<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Existencia extends Model
{
    protected $table = 'existencias';
    protected $primaryKey = 'id';
    protected $fillable = ['id_entrada','cantidad','precio_venta','fecha'];
}
