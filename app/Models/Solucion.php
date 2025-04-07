<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solucion extends Model
{
    protected $table ='solucion';


    public function tipo(){
        return $this->belongsTo(TipoSolucion::class, 'tipo_solucion', 'id');
    }
}


