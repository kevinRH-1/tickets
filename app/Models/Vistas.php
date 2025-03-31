<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vistas extends Model
{
    //
    public function modulo(){
       return  $this->belongsTo(Modulos::class, 'modulo_id','id');
    }
    
}
