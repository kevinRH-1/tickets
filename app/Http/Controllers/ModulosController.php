<?php

namespace App\Http\Controllers;

use App\Models\Modulos;
use App\Models\Sistemas;
use Illuminate\Http\Request;

class ModulosController extends Controller
{
    public function store(Request $request){
        $modulo = new Modulos();
        // $modulo->codigo = $request->codigo;
        $modulo->nombre = $request->nombre;
        $modulo->sistema_id = $request->sistema_id;
        $modulo->activo=1;
        $modulo->save();

        $modulos = Modulos::where('sistema_id', $request->sistema)->get();
        $sistema = Sistemas::where('id', $request->sistema)->get();

        $vacio = 0;

        return response()->json(['message'=>'modulo registrado']);

    }

    public function delete($id){
        $modulo = Modulos::findOrFail($id);
        $modulo->activo=0;
        $modulo->save();

        return response()->json(['message' => 'modulo borrado']);
    }

    public function update(Request $request, $id){
        $modulo = Modulos::findOrFail($id);
        $modulo->codigo = $request->codigo;
        $modulo->nombre = $request->nombre;
        $modulo->save();

        return response()->json(['message' => 'modulo actualizado exitosamente']);
    }

    public function modulover($id){
        $modulo = Modulos::findOrFail($id);

        return response()->json($modulo);
    }
}
