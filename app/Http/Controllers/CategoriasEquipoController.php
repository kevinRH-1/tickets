<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriasEquipos;

class CategoriasEquipoController extends Controller
{
    public function index(){
        $categorias = CategoriasEquipos::orderBy('id')->get();
        
        return view('categorias.index', compact('categorias'));
    }

    public function store(){
        $request = request();

        $categoria = new CategoriasEquipos();

        $categoria->id = $request->id;
        $categoria->name = $request->name;
        $categoria->descripcion = $request->descripcion;

        $categoria->save();

        return to_route('categorias.index');
    }
}
