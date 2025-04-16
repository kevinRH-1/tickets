<?php

namespace App\Models\equipos;

use Illuminate\Database\Eloquent\Model;
use App\Models\CategoriasEquipos;
use App\Models\Sucursal;
use App\Models\EstadosEquipos;
use Illuminate\Support\Str;
use App\Models\User;

class Impresoras extends Model
{
    protected $table = 'impresoras';


    public function categoria()
    {
        return $this->belongsTo(CategoriasEquipos::class);
    }

    public function estado(){
        return $this->belongsTo(EstadosEquipos::class);
    }

    public function lugar(){
        return $this->belongsTo(Sucursal::class, 'lugar_id', 'id');
    }

    public function usuario(){
        return $this->belongsTo(User::class, 'userid', 'id');
    }

    public static function generateUniqueCode(){
        do {
            $prefix = 'IMP'; // Prefijo para identificar el equipo
            $yearMonth = now()->format('ym'); // Año (últimos dos dígitos) y mes
            $randomString = Str::upper(Str::random(4)); // Cadena aleatoria de 4 caracteres
            $code = "{$prefix}-{$yearMonth}-{$randomString}";
        } while (self::where('codigo', $code)->exists()); // Asegurar unicidad

        return $code;
    }
}