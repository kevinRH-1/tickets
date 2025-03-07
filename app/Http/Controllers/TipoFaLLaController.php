<?php

namespace App\Http\Controllers;

use App\Models\Importancias;
use App\Models\TipoFalla;
use Illuminate\Http\Request;
use App\Models\TipoFallaSoftware;
use App\Models\TipoSolucion;
use App\Models\solucionFalla;


class TipoFaLLaController extends Controller
{
    public function index(){
        
    }

    public function verfallas($id){
        $fallas = TipoFalla::where('categoria_id', $id)->where('activo',1)->get();

        return response()->json($fallas);
    }

    public function fallasysolucion(){
        $fallas = TipoFalla::orderBy('id')->where('activo',1)->with('nivel')->paginate(10);
        $soluciones = TipoSolucion::orderBy('id')->where('activo',1)->paginate(10);
        $riesgos = Importancias::orderBy('id')->get();
        // foreach($fallas as $item){
        //     $item->solucion = solucionFalla::where('falla_id', $item->id)->where('tipo', 2)->get('solucion');
        // }



        return view('sistemas/fallasysoluciones', compact('fallas', 'soluciones', 'riesgos'));
        
    }

    public function store(Request $request){
        $falla = new TipoFalla();
        $falla->desc = $request->descripcion;
        $falla->nivel_riesgo = $request->riesgo;
        $falla->activo=1;

        $falla->save();

        return response()->json(['message', 'falla registrada']);
    }

    public function delete($id){
        $falla = TipoFalla::findOrFail($id);
        $falla->activo=0;
        $falla->save();

        return response()->json(['message', 'falla borrada con exito']);
    }

    public function update(Request $request){
        $falla = TipoFalla::findOrFail($request->id);

        $falla->desc = $request->nombre;
        $falla->nivel_riesgo = $request->nivel;

        $falla->save();

        if($request->existe == 0){
            $solucion = new solucionFalla();
            $solucion->solucion = $request->solucion;
            $solucion->tipo =2;
            $solucion->falla_id = $request->id;
            $solucion->tecnico_id = $request->tecnico;
            $solucion->save();
        }else{
            $solucion = solucionFalla::where('falla_id', $request->id)->where('tipo', 2)->get();
            $solucion[0]->solucion = $request->solucion;
            $solucion[0]->tecnico_id = $request->tecnico;
            $solucion[0]->save();
        }

        return response()->json(['message', 'actualizado con exito']);

    }

    public function actsolucion(Request $request){
        if($request->existesolucion == 0){
            $solucionfalla = new solucionFalla();
            $solucionfalla->solucion = $request->solucion;
            $solucionfalla->tecnico_id = $request->tecnico;
            $solucionfalla->tipo = 2;
            $solucionfalla->falla_id = $request->id;
            $solucionfalla->save();
        }else{
            $solucionfalla = solucionFalla::where('falla_id', $request->id)->where('tipo', 2)->get();
            $solucionfalla[0]->solucion = $request->solucion;
            $solucionfalla[0]->tecnico_id = $request->tecnico;
            $solucionfalla[0]->save();
        }

        return response()->json(['message', 'solucion actualizada con exito']);
    }

}
