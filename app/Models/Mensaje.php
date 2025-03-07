<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ReportesHardware;

class Mensaje extends Model
{
    protected $table = 'mensajes_reporte';

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function reporte(){
        return $this->belongsTo(ReportesHardware::class, 'reporte_id', 'id');
    }

    public function reporte_S(){
        return $this->belongsTo(ReportesSoftware::class, 'reporte_id'. 'id');
    }
}


