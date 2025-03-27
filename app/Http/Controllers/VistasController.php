<?php

namespace App\Http\Controllers;

use App\Models\Vistas;
use Illuminate\Http\Request;

class VistasController extends Controller
{
    //

    public function create(Request $request){
        $vista = new Vistas();
        $vista->nombre = $request->nombre;
        $vista->modulo_id = $request->modulo;
        $vista->save();

        return response()->json(['message', 'vista creada correctamente']);
    }

    public function delete($id){
        $vista = Vistas::findOrFail($id);
        $vista->activo=0;
        $vista->save();

        return response()->json(['message', 'vista borrada']);
    }


    public function cargar($id){
        $vistas = Vistas::where('modulo_id', $id)->get();

        return response()->json($vistas);
    }
}
