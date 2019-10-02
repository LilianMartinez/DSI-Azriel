<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartidaNacimiento extends Model
{
    //
    protected $table = 'partidas_nacimientos';
    protected $primaryKey = 'id';
    protected $fillable = ['alcaldia','libro','partida','folio','ano','idpersona'];
}
