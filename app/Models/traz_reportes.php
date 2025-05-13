<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class traz_reportes extends Model
{
    public function estado(){
        return $this->belongsTo(statusReporte::class, 'status_id', 'id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }
}
