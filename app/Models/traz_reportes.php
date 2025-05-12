<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class traz_reportes extends Model
{
    public function estado(){
        $this->belongsTo(statusReporte::class, 'status_id', 'id');
    }

    public function usuario(){
        $this->belongsTo(User::class, 'usuario_id', 'id');
    }
}
