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


    public function cargar($id, $sistema)
    {
        if ($id == 0) {
            $vistas = Vistas::whereHas('modulo', function ($query) use ($sistema) {
                $query->where('sistema_id', $sistema)->with('modulo');
            })->get();
        } else {
            $vistas = Vistas::with('modulo')->where('modulo_id', $id)->get();
        }

        return response()->json($vistas);
    }
}
