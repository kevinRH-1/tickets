<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoFallaSoftware extends Model
{
    protected $table = 'tipo_falla_software';

    public function importancia(){
        return $this->belongsTo(Importancias::class, 'nivel_riesgo', 'id');
    }

    public function modulo(){
        return $this->belongsTo(Modulos::class, 'modulo_id', 'id');
    }

    public function sistema(){
        return $this->belongsTo(Sistemas::class, 'sistema_id', 'id');
    }

    public function solucion(){
        return $this->hasOne(solucionFalla::class, 'falla_id', 'id');
    }
}