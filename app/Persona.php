<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $primaryKey = 'id';
    protected $fillable=['nombre_persona','apellido_persona','dui_pasaporte'];


   /*  public function user()
    {
        return $this->hasOne('App\User');
    } */

}
