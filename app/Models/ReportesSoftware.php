<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ReportesSoftware extends Model
{
    protected $table = 'reportes_softwares';

    

    public function usuario(){
        return $this->belongsTo(User::class, 'usuario_id', 'id' );
    }

    public function tecnico(){
        return $this->belongsTo(User::class, 'tecnico_id', 'id' );
    }

    public function sistema(){
        return $this->belongsTo(Sistemas::class, 'sistema_id', 'id');
    }

    public function modulo(){
        return $this->belongsTo(Modulos::class, 'modulo_id', 'id');

    }

    public function status(){
        return $this->belongsTo(statusReporte::class, 'status_id', 'id');
    }

    public function falla(){
        return $this->belongsTo(TipoFallaSoftware::class, 'falla_comun_id', 'id');
    }

    public function mensajes(){
        return $this->hasMany(Mensaje::class, 'reporte_id', 'id')
                            ->where('tipo_id', '=',1);
    }

    public function getSolucionAttribute(){
        return SolucionTemp::where('reporte_id', $this->id)
                        ->where('tipo_reporte', 1)
                       ->first();
    }

    public function getSoluciondefAttribute(){
        return Solucion::where('reporte_id', $this->id)
                        ->where('tipo_reporte', 1)
                       ->first();
    }

   

    public static function generateUniqueCode($sistema){
    do {
        $prefix = strtoupper(substr($sistema, 0,3)); // Prefijo para identificar el equipo
        $MonthDay = now()->format('md'); // Año (últimos dos dígitos) y mes
        $randomString = Str::upper(Str::random(5)); // Cadena aleatoria de 4 caracteres
        $code = "{$prefix}-{$MonthDay}-{$randomString}";
    } while (self::where('codigo', $code)->exists()); // Asegurar unicidad

    return $code;
}
}
