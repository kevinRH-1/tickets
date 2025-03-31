<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
    protected $table ='modulos';

    public function sistema(){
        return $this->belongsTo(Sistemas::class, 'sistema_id', 'id');
    }

    public function vista(){
        return $this->hasMany(Vistas::class, 'modulo_id', 'id');
    }
}
