<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre_rol','descripcion','condicion_rol'];
    public $timestamps = false;


    public function user()
    {
        return $this->hasMany('App\User');
    }
}
