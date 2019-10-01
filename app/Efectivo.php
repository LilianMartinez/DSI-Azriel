<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Efectivo extends Model
{
    

    protected $table = 'efectivos';
    protected $primaryKey = 'id';

    protected $fillable = ['num_recibo','descripcion_efectivo','tipo', 'monto','fecha','idcare'];

}
