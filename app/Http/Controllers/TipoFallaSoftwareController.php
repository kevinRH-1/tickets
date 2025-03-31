<?php

namespace App\Http\Controllers;

use App\Models\TipoFallaSoftware;
use Illuminate\Http\Request;
use App\Models\ReportesSoftware;
use App\Models\Modulos;
use App\Models\solucionFalla;
use App\Models\TipoFalla;
use App\Models\Vistas;

class TipoFallaSoftwareController extends Controller
{
    public function store(request $request){
        $falla = new TipoFallaSoftware();
        $falla->sistema_id = $request->sistema;
        if($request->modulo==0){
            $falla->modulo_id=null;
        }else{
            $falla->modulo_id = $request->modulo;
        }
        if($request->vista==0){
            $falla->vista_id=null;
        }else{
            $falla->vista_id = $request->vista;
        }
        $falla->descripcion= $request->descripcion;
        $falla->nivel_riesgo = $request->riesgo;
        $falla->activo=1;
        $falla->save();

        return redirect()->back();

    }

    public function cargarfallas($modulo, $sistema, $vista){
        
        if($modulo == 0  && $vista==0){
            $fallas = TipoFallaSoftware::where('sistema_id', $sistema)->where('activo',1)->get();
        }else{

            if($vista==0){
                $fallas = TipoFallaSoftware::where('modulo_id', $modulo)->where('activo',1)->where('vista_id', null)->get();
            }else{
                $fallas = TipoFallaSoftware::where('vista_id', $vista)->where('activo',1)->get();
                $vista = Vistas::findOrFail($vista);
                $modulo = $vista->modulo->id;
                $sistema = $vista->modulo->sistema->id;

                return response()->json([
                    'fallas' => $fallas,
                    'modulo' => $modulo,
                    'sistema'=> $sistema,
                ]);
            }

        }

        return response()->json($fallas);
    }

    public function solucion($id){
        $falla = TipoFallaSoftware::where('id', $id)->with('solucion')->get();

        return response()->json($falla);
    }


    public function actsolucion(Request $request){
        if($request->existesolucion == 0){
            $solucionfalla = new solucionFalla();
            $solucionfalla->solucion = $request->solucion;
            $solucionfalla->tecnico_id = $request->tecnico;
            $solucionfalla->tipo = 1;
            if($request->checked =='true'){
                $solucionfalla->checked = 1;
            }else{
                $solucionfalla->checked = 0;
            }
            $solucionfalla->falla_id = $request->id;
            $solucionfalla->save();
        }else{
            $solucionfalla = solucionFalla::where('falla_id', $request->id)->where('tipo',1)->get();
            $solucionfalla[0]->solucion = $request->solucion;
            $solucionfalla[0]->tecnico_id = $request->tecnico;
            if($request->checked == 'true'){
                $solucionfalla[0]->checked = 1;
            }else{
                $solucionfalla[0]->checked = 0;
            }
            $solucionfalla[0]->save();
        }

       
    }

    public function delete($id){
        $tipofalla = TipoFallaSoftware::findOrFail($id);
        $tipofalla->activo=0;
        $tipofalla->save();
    }


    public function buscarsolucion($fallaid){
        $falla = TipoFallaSoftware::findOrFail($fallaid);
        $solucion  = solucionFalla::where('falla_id', $fallaid)->get();

        if($falla->vista_id != null){
            $vista = $falla->vista->id;
            $modulo = $falla->vista->modulo->id;
            return response()->json([
                'vista'=> $vista,
                'modulo'=>$modulo,
                'solucion'=>$solucion,
            ]);
        }else if($falla->modulo_id!=null){
            $modulo = $falla->modulo->id;
            return response()->json([
                'modulo'=>$modulo,
                'solucion'=>$solucion,
            ]);
        }

        return response()->json($solucion);
    }

    
}
