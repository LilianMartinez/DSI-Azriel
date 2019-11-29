<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Impresion extends Model
{
    protected $table = 'impresiones';
    protected $primaryKey = 'id';
    protected $fillable=['idsacra','idperso','cargoim','conceptoim'];
    public $timestamps = false;
}
