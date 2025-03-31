<?php

namespace App\Http\Controllers;

use App\Models\Importancias;
use App\Models\Modulos;
use App\Models\ReportesSoftware;
use App\Models\Sistemas;
use App\Models\TipoFallaSoftware;
use App\Models\Vistas;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SistemasController extends Controller
{
    public function index(){

        $sistemas = Sistemas::where('activo', 1)->orderBy('id')->get();
        $mes = Carbon::now()->subDay(30);

        foreach($sistemas as $s){
            $tickets30d = ReportesSoftware::where('sistema_id', $s->id)->where('created_at', '>=', $mes)->count();
            $s->reportes_mes = $tickets30d;

            $ticketstotal = ReportesSoftware::where('sistema_id', $s->id)->count();
            $s->reportes = $ticketstotal;
        }

        $tickets = ReportesSoftware::get();

        return view('sistemas.index', compact('sistemas'));
    }

    public function versistema($id){
        $modulos = Modulos::where('sistema_id', $id)->where('activo',1)->get();
        $sistema = Sistemas::where('id', $id)->where('activo',1)->get();
        $riesgos = Importancias::orderBy('id')->get();
        $reportes = ReportesSoftware::where('sistema_id', $id)->orderBy('noti_t', 'desc')->orderBy('status_id', 'desc')->orderBy('id')->paginate(10);
        $fallas = TipoFallaSoftware::where('sistema_id', $id)->where('activo', 1)->paginate(10);
        $nivel = Importancias::orderBy('id')->get();
        $sistemaid = $id;

        $mes = Carbon::now()->subDay(30);

        foreach($modulos as $m){
            $tickets30d = ReportesSoftware::where('modulo_id', $m->id)->where('created_at', '>=', $mes)->count();
            $m->reportes_mes = $tickets30d;

            $ticketstotal = ReportesSoftware::where('modulo_id', $m->id)->count();
            $m->reportes = $ticketstotal;
        }

        if($modulos->isEmpty()){
            $vacio = 1;
        }else{
            $vacio = 0;
        }

        return view('sistemas/versistema', compact('modulos', 'sistema', 'vacio', 'riesgos', 'reportes', 'fallas', 'nivel', 'sistemaid'));
    }

    public function vermodulo($id){
        $reportes = ReportesSoftware::where('modulo_id', $id)->orderBy('noti_t', 'desc')->orderBy('status_id', 'desc')->orderBy('id')->paginate(10);
        $modulo = Modulos::with('sistema')->where('id', $id)->where('activo',1)->get();
        $fallas = TipoFallaSoftware::where('modulo_id', $id)->where('activo', 1)->paginate(10);
        $riesgos = Importancias::orderBy('id')->get();
        $nivel = Importancias::orderBy('id')->get();
        $vistas = Vistas::where('modulo_id', $id)->where('activo',1)->orderBy('id')->paginate(10);


        foreach($vistas as $item){
            $reportes_vista = ReportesSoftware::where('vista_id', $item->id)->count();
            $fallas_vista = TipoFallaSoftware::where('vista_id', $item->id)->count();
            $reportes_vista_act = ReportesSoftware::where('vista_id', $item->id)->where('status_id', '!=', 3)->count();

            $item->cant_reportes = $reportes_vista;
            $item->cant_fallas = $fallas_vista;
            $item->cant_reportes_act = $reportes_vista_act;
        }
        


        return view('sistemas.vermodulos', compact('modulo', 'reportes', 'fallas', 'riesgos', 'nivel', 'vistas'));
    }

    public function store(Request $request){
        $sistema = new Sistemas();
        // $sistema->codigo = $request->codigo;
        $sistema->nombre = $request->nombre;
        $sistema->activo =1;
        $sistema->save();

        $sistemas = Sistemas::orderBy('id')->where('activo',1)->get();
        return view('sistemas/index', compact('sistemas'));
    }

    public function sistemadatos($id){
        $sistema= Sistemas::findOrFail($id);

        return response()->json($sistema);
    }

    public function delete($id){
        $sistema = Sistemas::findOrFail($id);
        $sistema->activo =0;
        $sistema->save();

        return response()->json(['message'=> 'el sistema ha sido borrado']);
    }

    public function update(Request $request, $id){
        $sistema = Sistemas::findOrFail($id);
        $sistema->nombre = $request->nombre;
        $sistema->codigo = $request->codigo;
        $sistema->save();

        return response()->json(['message'=>'sistema actualizado con exito']);
    }

    public function filtroreportes(Request $request){
        $modulos = Modulos::where('sistema_id', $request->sistema)->where('activo',1)->get();
        $sistema = Sistemas::where('id', $request->sistema)->where('activo',1)->get();
        $riesgos = Importancias::orderBy('id')->get();
        $query = ReportesSoftware::where('sistema_id', $request->sistema)->orderBy('noti_t', 'desc')->orderBy('status_id', 'desc')->orderBy('id');
        $fallas = TipoFallaSoftware::where('sistema_id', $request->sistema)->where('activo', 1)->paginate(10);
        $nivel = Importancias::orderBy('id')->get();

        $mes = Carbon::now()->subDay(30);

        foreach($modulos as $m){
            $tickets30d = ReportesSoftware::where('modulo_id', $m->id)->where('created_at', '>=', $mes)->count();
            $m->reportes_mes = $tickets30d;

            $ticketstotal = ReportesSoftware::where('modulo_id', $m->id)->count();
            $m->reportes = $ticketstotal;
        }

        if($modulos->isEmpty()){
            $vacio = 1;
        }else{
            $vacio = 0;
        }

        $niveli =$request->nivel;
        $falla = $request->falla;

        if($niveli != 10 && $niveli != 0){
            $query->whereHas('falla', function($q) use ($niveli){
                $q->where('nivel_riesgo', $niveli);
            });
        }
        if($niveli == 0){
            $query->where('falla_comun_id', 0);


        }
        if($falla != 0){
            $query->whereHas('falla', function($q) use ($falla){
                $q->where('id', $falla);
            });
        }

        $reportes = $query->where('sistema_id', $request->sistema)->orderBy('created_at', 'desc')->paginate(10)->appends([
            'niveli' => $request->nivel,
            'falla' => $request->falla,
        ]);


        return view('sistemas/versistema', compact('modulos', 'sistema', 'vacio', 'riesgos', 'reportes', 'fallas', 'nivel'));
    }
}
