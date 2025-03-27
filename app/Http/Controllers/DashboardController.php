<?php

namespace App\Http\Controllers;

use App\Models\equipos\Impresoras;
use App\Models\equipos\Laptops;
use App\Models\equipos\Pc;
use App\Models\ReportesHardware;
use App\Models\ReportesSoftware;
use App\Models\Videos;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Ticket;

class DashboardController extends Controller
{
    public function dashboard(){

       
        $id = Auth::user()->id;
        $dia = Carbon::now()->subDay(); // Hace 24 horas
        $RH =  ReportesHardware::where('created_at', '>=', $dia)->get();
        $RS =  ReportesSoftware::where('created_at', '>=', $dia)->get();

        $cantidaddia = count($RH) + count($RS);

        $mes = Carbon::now()->subDay(30); // Hace 30 dias
        $RHm =  ReportesHardware::where('created_at', '>=', $mes)->get();
        $RSm =  ReportesSoftware::where('created_at', '>=', $mes)->get();
        
        $cantidadmes = count($RHm) + count($RSm);

        $sinrevisarh = ReportesHardware::where('status_id', 1)->get();
        $sinrevisars = ReportesHardware::where('status_id', 1)->get();

        $cantidadsinrevisar = count($sinrevisarh) + count($sinrevisars);
        
        $ticketstecnicoS = ReportesSoftware::where('tecnico_id',$id)->get();
        $ticketstecnicoH = ReportesHardware::where('idtecnico',$id)->get();

        $cantidadtecnico = count($ticketstecnicoH) + count($ticketstecnicoS);

        $ticketsusuarioprogresoh = ReportesHardware::where('idusuario', Auth::user()->id)->where('status_id', '!=', 3)->get();
        $ticketsusuarioprogresos = ReportesSoftware::where('usuario_id', Auth::user()->id)->where('status_id', '!=', 3)->get();

        $ticketprogreso = count($ticketsusuarioprogresoh) + count($ticketsusuarioprogresos);

        $usuariototalh = ReportesHardware::where('idusuario', Auth::user()->id)->get();
        $usuariototals = ReportesSoftware::where('usuario_id', Auth::user()->id)->get();

        $usuariototal = count($usuariototalh) + count($usuariototals);

        $pc = Pc::where('lugar_id', Auth::user()->lugar_id)->where('activo',1)->get();
        $laptops = Laptops::where('lugar_id', Auth::user()->lugar_id)->where('activo',1)->get();
        $impresoras = Impresoras::where('lugar_id', Auth::user()->lugar_id)->where('activo',1)->get();

        $equipos = collect();
        $equipos = $equipos->merge($pc)
                           ->merge($laptops)
                           ->merge($impresoras);
        $equipostotales = count($equipos);

        $equiposFiltrados = $equipos->filter(function ($equipo) {
            return $equipo->estado_id != 1;
        });
        
        $cantidadFiltrados = $equiposFiltrados->count();

        $videos = Videos::where('anuncio', 1)->get();

        return view('components.welcome', compact('cantidaddia', 'cantidadmes', 'cantidadsinrevisar', 'cantidadtecnico', 'ticketprogreso', 'usuariototal', 'equipostotales', 'cantidadFiltrados', 'videos'));
    }
}
