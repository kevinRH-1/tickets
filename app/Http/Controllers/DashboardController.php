<?php

namespace App\Http\Controllers;

use App\Models\equipos\Impresoras;
use App\Models\equipos\Laptops;
use App\Models\equipos\Pc;
use App\Models\ReportesHardware;
use App\Models\ReportesSoftware;
use App\Models\Sucursal;
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

        $cantidaddia =  count($RS);

        $mes = Carbon::now()->subDay(7); // Hace 30 dias
        $RHm =  ReportesHardware::where('created_at', '>=', $mes)->get();
        $RSm =  ReportesSoftware::where('created_at', '>=', $mes)->get();
        
        $cantidadmes = count($RSm);

        $sinrevisarh = ReportesHardware::where('status_id', 1)->get();
        $sinrevisars = ReportesSoftware::where('status_id', 1)->get();

        $cantidadsinrevisar = count($sinrevisars);
        
        $ticketsrevision = ReportesSoftware::where('status_id','!=', 1)->where('status_id', '!=', 5)->get();
        // $ticketstecnicoH = ReportesHardware::where('idtecnico',$id)->get();

        $cantidadrevision = count($ticketsrevision);

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


        $sucursales = Sucursal::where('activo', 1)->get();

        return view('components.welcome', compact('sucursales','cantidaddia', 'cantidadmes', 'cantidadsinrevisar', 'cantidadrevision', 'ticketprogreso', 'usuariototal', 'equipostotales', 'cantidadFiltrados', 'videos'));
    }


    public function graficos($tiempo){

        if($tiempo ==0){
            $reportes = ReportesSoftware::with('usuario.sucursal')
                ->get()
                ->groupBy('usuario.sucursal.nombre') // Asumiendo que el campo en la tabla sucursales se llama "nombre"
                ->map(function ($items, $sucursal) {
                    return count($items);
                });

            return response()->json($reportes);
        }elseif($tiempo==1){
            $tiempo2 = Carbon::now()->subDay();
        }elseif($tiempo==2){
            $tiempo2 = Carbon::now()->subDay(7);
        }else{
            $tiempo2 = Carbon::now()->subDay(30);
        }
       
        $reportes = ReportesSoftware::with('usuario.sucursal')->where('created_at', '>=', $tiempo2)
                ->get()
                ->groupBy('usuario.sucursal.nombre') // Asumiendo que el campo en la tabla sucursales se llama "nombre"
                ->map(function ($items, $sucursal) {
                    return count($items);
                });

            return response()->json($reportes);
        
        
    }

    public function graficosestado($tiempo){

        if($tiempo==0){
            $reportes = ReportesSoftware::with('status')
                ->get()
                ->groupBy('status.nombre') // Asumiendo que el campo en la tabla sucursales se llama "nombre"
                ->map(function ($items, $status) {
                    return count($items);
                });

            return response()->json($reportes);
        }elseif($tiempo==1){
            $tiempo2 = Carbon::now()->subDay();
        }elseif($tiempo==2){
            $tiempo2 = Carbon::now()->subDay(7);
        }else{
            $tiempo2 = Carbon::now()->subDay(30);
        }


       $reportes = ReportesSoftware::with('status')->where('created_at', '>=', $tiempo2)
            ->get()
            ->groupBy('status.nombre') // Asumiendo que el campo en la tabla sucursales se llama "nombre"
            ->map(function ($items, $status) {
                return count($items);
            });

        return response()->json($reportes);
        
        
    }




}
