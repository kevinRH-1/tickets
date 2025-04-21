<?php

namespace App\Http\Controllers\equipos;

use App\Http\Controllers\Controller;
use App\Models\equipos\Impresoras;
use Illuminate\Http\Request;
use App\Models\equipos\Laptops;

class LaptopController extends Controller
{
    public function store(){
        $request = request();

        $laptop = new Laptops();
        // $laptop->id = $request->id;
        $laptop->codigo = Laptops::generateUniqueCode();
        $laptop->lugar_id = $request->lugarpc;
        $laptop->categoria_id = $request->categoria;
        $laptop->marca = $request->marca;
        $laptop->modelo = $request->modelo;
        $laptop->procesador = $request->procesador;
        $laptop->ram = $request->ram;
        $laptop->almacenamiento = $request->almacenamiento;
        $laptop->descripcion = $request->descripcion;
        $laptop->estado_id = $request->estado;
        $laptop->activo=1;

        $laptop->save();

        return to_route('equipo.index');   
    }

    public function find($id){
        $datos = Laptops::where('id', $id)->get();

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
            $laptop = Laptops::findOrFail($id);
            $laptop->codigo = $request->codigo;
            $laptop->lugar_id = $request->lugar;
            $laptop->categoria_id = $request->categoria;
            $laptop->marca = $request->marca;
            $laptop->modelo = $request->modelo;
            $laptop->procesador = $request->procesador;
            $laptop->ram = $request->ram;
            $laptop->almacenamiento = $request->HDD;
            $laptop->descripcion = $request->descripcion;
            $laptop->estado_id = $request->estado;
            $laptop->save();
    
            return response()->json(['message' => 'Equipo actualizado exitosamente']);
        
    }

    public function delete($id){

        $laptop = Laptops::findOrFail($id);
        $laptop->activo=1;
        $laptop->save();
    
        return response()->json(['message' => 'registro borrado']);
    
    
    }

    public function asignar(Request $request, $id){
        $laptop = Laptops::findOrFail($id);
        $laptop->lugar_id = $request->sucursal;

        $laptop->save();
        return response()->json(['message'=>'sucursal asignada']);
    }

    public function quitar(Request $request, $id){
        $laptop = Laptops::findOrFail($id);
        $laptop->lugar_id = $request->lugar;

        $laptop->save();
        return response()->json(['message'=>'sucursal quitada']);
    }

    public function status(Request $request, $id){
        $laptop = Laptops::findOrFail($id);
        $laptop->estado_id = $request->status;
        $laptop->save();

        return response()->json(['message' => 'estado cambiado']);
    }
}
