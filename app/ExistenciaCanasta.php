<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExistenciaCanasta extends Model
{
    protected $table = 'existencia_canasta';
    protected $primaryKey = 'id';
    protected $fillable = ['id_canasta','cantidad'];
}
