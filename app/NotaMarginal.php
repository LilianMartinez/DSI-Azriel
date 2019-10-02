<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotaMarginal extends Model
{
    protected  $table = 'nota_marginal';
    protected $primarykey = 'id';
    protected $fillable = ['nota', 'id_sacramento'];

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
