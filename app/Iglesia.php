<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iglesia extends Model
{
    protected $table = 'iglesias';
    protected $primaryKey = 'id';
    protected $fillable=['nombre_iglesia','idzona'];

}
