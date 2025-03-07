<?php

namespace App\Http\Controllers\equipos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\equipos\Pc;

class PcController extends Controller
{
    public function store(){
        $request = request();

        $pc = new Pc();
        // $pc->id = $request->id;
        $pc->codigo = Pc::generateUniqueCode();
        $pc->lugar_id = $request->lugarpc;
        $pc->categoria_id = $request->categoria;
        $pc->marca = $request->marca;
        $pc->modelo = $request->modelo;
        $pc->procesador = $request->procesador;
        $pc->ram = $request->ram;
        $pc->almacenamiento = $request->almacenamiento;
        $pc->descripcion = $request->descripcion;
        $pc->estado_id = $request->estado;
        $pc->activo=1;

        $pc->save();

        return to_route('equipo.index');   
    }

    public function find($id){
        $datos = Pc::where('id', $id)->get();

        return response()->json($datos);
    }

    public function update(Request $request, $id){
    // Validación de los datos del formulario
    // $request->validate([
    //     'id' => 'required|exists:equipos,id',
    //     'marca' => 'required|string|max:255',
    //     'modelo' => 'required|string|max:255',
    //     'codigo' => 'required|string|max:255',
    //     'procesador' => 'required|string|max:255',
    //     'ram' => 'required|string|max:255',
    //     'HDD' => 'required|string|max:255',
    //     'descripcion' => 'nullable|string'
    // ]);

    // Encontrar el equipo por su ID y actualizar los campos
        $pc = Pc::findOrFail($id);
        $pc->codigo = $request->codigo;
        $pc->lugar_id = $request->lugar;
        $pc->categoria_id = $request->categoria;
        $pc->marca = $request->marca;
        $pc->modelo = $request->modelo;
        $pc->procesador = $request->procesador;
        $pc->ram = $request->ram;
        $pc->almacenamiento = $request->HDD;
        $pc->descripcion = $request->descripcion;
        $pc->estado_id = $request->estado;
        $pc->save();

        return response()->json(['message' => 'Equipo actualizado exitosamente']);
    
    }

    public function delete($id){

        $pc = pc::findOrFail($id);
        $pc->activo=0;
        $pc->save();

        return response()->json(['message' => 'registro borrado']);


    }

    public function asignar(Request $request, $id){
        $pc = Pc::findOrFail($id);
        $pc->lugar_id = $request->sucursal;

        $pc->save();
        return response()->json(['message'=>'sucursal asignada']);
    }

    public function quitar(Request $request, $id){
        $pc = Pc::findOrFail($id);
        $pc->lugar_id = $request->lugar;
        $pc->save();

        return response()->json(['message'=>'sucursal quitada']);
    }

    public function status(Request $request, $id){
        $pc = Pc::findOrFail($id);
        $pc->estado_id = $request->status;
        $pc->save();

        return response()->json(['message'=>'estatus cambiado']);
    }
}
