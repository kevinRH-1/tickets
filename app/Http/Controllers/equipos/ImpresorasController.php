<?php

namespace App\Http\Controllers\equipos;

use App\Http\Controllers\Controller;
use App\Models\equipos\Impresoras;
use Illuminate\Http\Request;

class ImpresorasController extends Controller
{
    public function store(){
        $request = request();

        $impresora = new Impresoras();
        $impresora->id = $request->id;
        $impresora->codigo = Impresoras::generateUniqueCode();
        $impresora->lugar_id = $request->lugarpc;
        $impresora->categoria_id = $request->categoria;
        $impresora->marca = $request->marca;
        $impresora->modelo = $request->modelo;
        $impresora->descripcion = $request->descripcion;
        $impresora->estado_id = $request->estado;
        $impresora->activo=1;

        $impresora->save();

        return to_route('equipo.index');   
    }

    public function find($id){
        $datos = Impresoras::where('id', $id)->get();

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
            $impresora = Impresoras::findOrFail($id);
            $impresora->codigo = $request->codigo;
            $impresora->lugar_id = $request->lugar;
            $impresora->categoria_id = $request->categoria;
            $impresora->marca = $request->marca;
            $impresora->modelo = $request->modelo;
            $impresora->descripcion = $request->descripcion;
            $impresora->estado_id = $request->estado;
            $impresora->save();
    
            return response()->json(['message' => 'Equipo actualizado exitosamente']);
        
    }

    public function delete($id){

        $impresora = Impresoras::findOrFail($id);
        $impresora->activo=1;
        $impresora->save();
    
        return response()->json(['message' => 'registro borrado']);
    
    
    }

    public function asignar(Request $request, $id){
        $impresora = Impresoras::findOrFail($id);
        $impresora->lugar_id = $request->sucursal;

        $impresora->save();
        return response()->json(['message'=>'sucursal asignada']);
    }

    public function quitar(Request $request, $id){
        $impresora = Impresoras::findOrFail($id);
        $impresora->lugar_id = $request->lugar;

        $impresora->save();
        return response()->json(['message'=>'sucursal quitada']);
    }

    public function status(Request $request, $id){
        $impresora = Impresoras::findOrFail($id);
        $impresora->estado_id = $request->status;
        $impresora->save();

        return response()->json(['message'=>'estado cambiado']);
    }
}
