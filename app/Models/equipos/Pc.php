<?php

namespace App\Models\equipos;

use App\Models\CategoriasEquipos;
use App\Models\EstadosEquipos;
use App\Models\Sucursal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pc extends Model
{
    protected $table = 'pcs';


    public function categoria()
    {
        return $this->belongsTo(CategoriasEquipos::class);
    }

    public function estado(){
        return $this->belongsTo(EstadosEquipos::class);
    }

    public function lugar(){
        return $this->belongsTo(Sucursal::class);
    }

    public static function generateUniqueCode()
{
    do {
        $prefix = 'PC'; // Prefijo para identificar el equipo
        $yearMonth = now()->format('ym'); // Año (últimos dos dígitos) y mes
        $randomString = Str::upper(Str::random(4)); // Cadena aleatoria de 4 caracteres
        $code = "{$prefix}-{$yearMonth}-{$randomString}";
    } while (self::where('codigo', $code)->exists()); // Asegurar unicidad

    return $code;
}

}


