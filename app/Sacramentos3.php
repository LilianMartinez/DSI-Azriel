<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sacramentos3 extends Model
{
    protected $table = 'sacramentos';
    protected $primarykey = 'id';
    protected $fillable = ['tipo_sacramento','libro','folio','asiento','fecha_realizacion',
    'id_realizante1','id_sacerdote','id_padrino','id_padrino2','id_padrino3','id_padrino4'];

    public function user()
    {
        return $this->hasOne('App\User');
    }
}
