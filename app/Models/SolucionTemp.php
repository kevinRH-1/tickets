<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolucionTemp extends Model
{
    protected $table = 'solucion_temp';

    public function tiposolucion(){
        return $this->belongsTo(TipoSolucion::class, 'tipo_solucion', 'id');
    }
}


