<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    protected $primaryKey = 'id';
    protected $fillable=['nombre_persona','apellido_persona','fecha_nacimiento','dui_pasaporte','sexo','id_padre','id_madre','tipo_persona','estado','idzonaa','idiglesia'];


    public function user()
    {
        return $this->hasOne('App\User');
    }

}
