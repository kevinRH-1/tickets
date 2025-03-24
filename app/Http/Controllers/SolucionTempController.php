<?php

namespace App\Http\Controllers;

use App\Models\ReportesHardware;
use App\Models\ReportesSoftware;
use Illuminate\Http\Request;
use App\Models\SolucionTemp;

class SolucionTempController extends Controller
{
    
    public function negar(Request $request){
        $solucion = SolucionTemp::where('reporte_id', $request->id)->where('tipo_reporte', $request->tipo)->get();
        $solucion[0]->delete();

        $reporte = ReportesHardware::findOrFail($request->id);
        $reporte->solucionado_tecnico=0;
        $reporte->save();

        return response()->json(['message', 'solucion temporal borrada']);
    }

    public function negarS(Request $request){
        $solucion = SolucionTemp::where('reporte_id', $request->id)->where('tipo_reporte', $request->tipo)->get();
        $solucion[0]->delete();

        $reporte = ReportesSoftware::findOrFail($request->id);
        $reporte->solucionado_tecnico=0;
        $reporte->save();

        return response()->json(['message', 'solucion temporal borrada']);
    }
}
