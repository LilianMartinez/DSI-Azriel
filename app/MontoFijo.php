<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MontoFijo extends Model
{
    protected $table = 'montos_fijos';
    protected $primaryKey = 'id';

    protected $fillable = ['nombreMF','montoF'];
}
