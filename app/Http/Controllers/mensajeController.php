<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use Illuminate\Http\Request;

class mensajeController extends Controller
{
    public function store(Request $request){

        $mensaje = new Mensaje();
        $mensaje->reporte_id = $request->reporte;
        $mensaje->usuario_id = $request->usuario;
        $mensaje->mensaje = $request->mensaje;

        $mensaje->save();


    }

    public function vermensajes($id){
        $mensajes = Mensaje::where('reporte_id', $id)->with('usuario', 'reporte')->get();

        return view('historialmensajes', compact('mensajes'));
    }
}
