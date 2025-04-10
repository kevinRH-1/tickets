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
        $video->link = $request->link;
        $video->codigo = $request->codigo;
        $video->save();

        return response()->json(['message', 'video subido']);
    }

    public function videos(){

        $videos = Videos::orderBy('id')->get();
        return view ('Videos.index', compact('videos'));
    }
}
