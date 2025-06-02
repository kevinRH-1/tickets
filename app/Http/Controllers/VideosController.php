<?php

namespace App\Http\Controllers;

use App\Models\Videos;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function subir(){
        return view ('Videos.subirvideo');
    }

    public function create(Request $request){
        $video =  new Videos();
        $video->nombre = $request->nombre;
        $video->descripcion = $request->descripcion;
        $video->link = $request->link;
        $video->codigo = $request->codigo;
        $video->rol = $request->visibilidad;
        $video->save();

        return response()->json(['message', 'video subido']);
    }

    public function videos(){

        $videos = Videos::where('activo', 1)->orderBy('id')->get();
        return view ('Videos.index', compact('videos'));
    }


    public function detalles($id){
        $video = Videos::findOrFail($id);

        return response()->json($video);
    }

    public function update(Request $request){
        $video = Videos::findOrFail($request->id);
        $video->nombre = $request->nombre;
        $video->link = $request->link;
        $video->descripcion = $request->descripcion;
        if($request->codigo){
            $video->codigo = $request->codigo;
        }
        
        $video->save();
        return response()->json(['message', 'video actualizado']);
    }

    public function delete($id){
        $video = Videos::findOrFail($id);
        $video->activo=0;
        $video->save();

        return response()->json(['message', 'video borrado']);
    }

    public function marcarAnuncio(Request $request){
        $item = Videos::findOrFail($request->id);
        if ($item) {
            $item->anuncio = $request->anuncio;
            $item->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

}
