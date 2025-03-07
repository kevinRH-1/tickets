<?php

namespace App\Http\Controllers;

use App\Models\TipoSolucion;
use Illuminate\Http\Request;

class TipoSolucionController extends Controller
{
    //

    public function store(Request $request){
        $tiposolucion = new TipoSolucion();
        $tiposolucion->descripcion = $request->desc;
        $tiposolucion->categoria=$request->tipo;
        $tiposolucion->activo=1;
        $tiposolucion->save();

        return response()->json(['message', 'tipo de solucion registrada']);
    }


    public function delete($id){
        $tiposolucion = TipoSolucion::findOrFail($id);
        $tiposolucion->activo=0;
        $tiposolucion->save();

        return response()->json(['message', 'tipo de solucion borrada']);
    }

    public function update(Request $request){
        $tiposolucion = TipoSolucion::findOrFail($request->id);

        $tiposolucion->descripcion = $request->nombre;
        $tiposolucion->categoria = $request->categoria;

        $tiposolucion->save();

        return response()->json(['message', 'solucion actualizada con exito']);
    }
}
