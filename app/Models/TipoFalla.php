<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoFalla extends Model
{
    public function nivel(){
        return $this->belongsTo(Importancias::class, 'nivel_riesgo', 'id');
    }

    public function solucion(){
        return $this->hasOne(solucionFalla::class, 'falla_id', 'id')
                    ->where('tipo', '=', 2);
    }
}
