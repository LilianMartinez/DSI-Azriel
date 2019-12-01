<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalidaCanasta extends Model
{
    protected $table = 'salida_canasta';
    protected $primaryKey = 'id';
    protected $fillable = ['id_existenciaC','fecha'];
}
