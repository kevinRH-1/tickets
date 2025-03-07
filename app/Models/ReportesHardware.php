<?php

namespace App\Models;

use App\Models\equipos\Impresoras;
use App\Models\equipos\Laptops;
use App\Models\equipos\Pc;
use Illuminate\Database\Eloquent\Model;
use App\Models\statusReporte;
use Illuminate\Support\Str;

class ReportesHardware extends Model
{
    protected $fillable = [
        'idusuario',
        'idequipo',
        'codigoequipo',
        'categoria_id',
        'idtecnico',
        'descripcion',
        'solucion',
        'status_id',
        'tipo_solucion',
        'timepo_revision',
        'tiempo_solucion',
        'profile_photo_path'
    ];


    public function usuario(){
        return $this->belongsTo(User::class, 'idusuario');
    }

    public function getPcAttribute()
    {
        return Pc::where('id', $this->idequipo)
                ->where('categoria_id', $this->categoria_id)
                ->first();
    }

    public function getImpresoraAttribute(){
        return Impresoras::where('id', $this->idequipo)
                ->where('categoria_id', $this->categoria_id)
                ->first();
    }

    public function getLaptopAttribute(){
        return Laptops::where('id', $this->idequipo)
                ->where('categoria_id', $this->categoria_id)
                ->first();
    }

    public function status(){
        return $this->belongsTo(statusReporte::class, 'status_id', 'id' );
    }



    public static function generateUniqueCode($equipo){
        do {
            $prefix = strtoupper(substr($equipo, 0,3)); // Prefijo para identificar el equipo
            $MonthDay = now()->format('md'); // Año (últimos dos dígitos) y mes
            $randomString = Str::upper(Str::random(4)); // Cadena aleatoria de 4 caracteres
            $code = "{$prefix}-{$MonthDay}-{$randomString}";
        } while (self::where('codigo', $code)->exists()); // Asegurar unicidad
    
        return $code;
    }


    public function tecnico(){
        return $this->belongsTo(User::class, 'idtecnico', 'id');
    }


    public function getSolucionAttribute(){
        return SolucionTemp::where('reporte_id', $this->id)
                       ->where('tipo_reporte', 2)
                       ->first();
    }

    public function getSoluciondefAttribute(){
        return Solucion::where('reporte_id', $this->id)
                       ->where('tipo_reporte', 2)
                       ->first();
    }

    public function falla(){
        return $this->belongsTo(TipoFalla::class, 'falla_id', 'id');
    }
}
