<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\Modulos;
use App\Models\traz_reportes;
use Illuminate\Http\Request;
use App\Models\ReportesSoftware;
use App\Models\Sistemas;
use Illuminate\Support\Facades\DB;
use App\Models\TipoSolucion;
use App\Models\SolucionTemp;
use App\Models\Solucion;
use App\Models\statusReporte;
use App\Models\Sucursal;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\correoPrueba;
use App\Mail\notificacionCorreo;
use App\Models\Importancias;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ticketsSistemaExport;
use App\Models\Vistas;

class ControllerSoftwareReporte extends Controller
{
    public function index()
    {
        $dia = Carbon::now()->subDay();
        $mes = Carbon::now()->subDay(30);
        $reportes = ReportesSoftware::with('usuario', 'modulo', 'sistema', 'status')->orderBy('noti_t', 'desc')->orderBy('status_id')->orderBy('id', 'desc')->paginate(10);

        $generados = ReportesSoftware::where('status_id', 1)->count();
        $revision = ReportesSoftware::where('status_id', 2)->count();
        $solucionados24 = ReportesSoftware::where('status_id', 3)->where('tiempo_solucion','>=', $dia)->count();
        $totales24 = ReportesSoftware::where('created_at','>=', $dia)->count();
        $sucursales = Sucursal::where('id', '!=', 1)->where('activo', 1)->get();
        $sistemas = Sistemas::orderBy('id')->get();
        $estatus = statusReporte::orderBy('id')->get();
        $nivel = Importancias::orderBy('id')->get();
    

        return view('reportessoftware.index', compact('reportes', 'generados', 'revision', 'solucionados24', 'totales24', 'sucursales', 'sistemas', 'estatus', 'nivel'));
    }

    public function reportes($id){
        $reportes = ReportesSoftware::with('usuario', 'modulo', 'sistema', 'status')->where('usuario_id', $id)
            ->orderBy('noti_u', 'desc')->orderBy('status_id')->orderBy('id', 'desc')->paginate(10);
        $borraract=0;
        foreach($reportes as $r){
            if($r->status_id==1){
                $borraract = 1;
                break;
            }
        }


        return view('reportessoftware.reportes', compact('reportes', 'borraract'));
    }

    public function create(){

        $sistemas = Sistemas::orderBy('id')->where('activo',1)->get();
        $modulos = Modulos::orderBy('id')->where('activo',1)->get();
        $vista = Vistas::orderBy('id')->where('activo', 1)->get();


        return view('reportessoftware/create', compact('sistemas', 'modulos', 'vista'));
    }

    public function modulos($id){
        $modulos = Modulos::where('sistema_id', $id)->where('activo',1)->get();

        return response()->json($modulos);
    }

    public function store(Request $request){
        DB::transaction(function () use ($request) {
            
            $sistema = Sistemas::where('id', $request->sistema)->get();

            $reporte = new ReportesSoftware();
            $reporte->usuario_id = $request->userid;
            $reporte->codigo = ReportesSoftware::generateUniqueCode($sistema[0]->nombre);
            $reporte->sistema_id = $request->sistema;
            $reporte->modulo_id = $request->modulo;
            $reporte->falla_comun_id = $request->falla;
            $reporte->vista_id = $request->vista;
            $reporte->descripcion = null;
            $reporte->solucionado_tecnico = 0;
            $reporte->solucionado_usuario = 0;
            $reporte->status_id =1;
            $reporte->noti_t =1;
            $reporte->noti_u =0;
            $reporte->save();

            $mensaje = new Mensaje();
            $mensaje->reporte_id = $reporte->id;
            $mensaje->usuario_id = $reporte->usuario_id;
            $mensaje->tipo_id = $request->tipo_reporte;
            $mensaje->mensaje = $request->problema;
            if ($request->hasFile('imagen')) {
                $rutaImagen = $request->file('imagen')->store('imagen', 'public');
                $mensaje->imagen = $rutaImagen;
            }
            $mensaje->save();

            $traz = new traz_reportes();
            $traz->reporte_id = $reporte->id;
            $traz->tipo=1;
            $traz->status_id=1;
            $traz->usuario_id= $request->userid;
            $traz->save();


            

        });

        $usuario = User::findOrFail($request->userid);
        $lugar = $usuario->lugar_id;


        // Mail::to('kevin65kkg@gmail.com')->send(new correoPrueba('Email.prueba'));

        return response()->json(['message' => 'ticket generado']);


            
    }

    public function reporte($id, $roleid){
        $reporte = ReportesSoftware::with('tecnico')->where('id', $id)->get();
        $mensajes = Mensaje::where('reporte_id', $id)->where('tipo_id', 1)->orderBy('id')->get();

        $tec = [1,2];

        $solucion =Mensaje::with('usuario')->where('reporte_id', $id)->wherehas('usuario', function ($query) use ($tec){
            $query->whereIn('roleid',$tec);
        })->where('tipo_id', 1)->get();
        if ($solucion->isEmpty()){
            $confirmar =  0;
        }else{
            $confirmar = 1;
        }

        $soluciones = TipoSolucion::where('activo', 1)->where('categoria', '!=', 2)->get();
        if($reporte[0]->tiempo_solucion != null){
            $fecha1 = $reporte[0]->created_at;
            $fecha2 = $reporte[0]->tiempo_solucion;

            $diferenciaEnMinutos = $fecha1->diffInMinutes($fecha2);
            $diferenciaEnHoras = $diferenciaEnMinutos / 60; // Convierte a horas
            $tiempo = number_format($diferenciaEnHoras, 2);
        }else{
            $tiempo = 'sin solucionar';
        };


        if($roleid ==3){
            $reporte[0]->noti_u = 0;
        }else{
            $reporte[0]->noti_t = 0;
        }

        $traz = traz_reportes::where('reporte_id', $id)->where('tipo', 1)->orderBy('id')->get();

        $reporte[0]->save();

        $estados = statusReporte::where('id', '!=', 1)->where('id', '!=', 5)->orderBy('id')->get();
        

        return view('reportessoftware.verreportesoftware', compact('reporte', 'estados', 'mensajes', 'confirmar', 'soluciones', 'tiempo', 'traz'));
    }

    public function mensajes(Request $request){
       
        // busca el correo del usuario que creo el reporte

        // Validar el archivo
        
       
        $reporte = ReportesSoftware::findOrFail($request->reporte);

        $usuario = User::findOrFail($reporte->usuario_id);
        


        // si el mensaje es enviado por el usuario
        
        if($request->rol == 3){
        
            $mensaje = new Mensaje();
            $mensaje->reporte_id = $request->reporte;
            $mensaje->usuario_id = $request->usuario;
            $mensaje->tipo_id = $request->tipo_reporte;
            $mensaje->mensaje = $request->mensaje;

            if ($request->hasFile('imagen')) {
                $rutaImagen = $request->file('imagen')->store('imagen', 'public');
                $mensaje->imagen = $rutaImagen;
            }

            if($request->hasFile('audio')){
                $rutaAudio = $request->file('audio')->store('audio', 'public');
                $mensaje->audio = $rutaAudio;
            }
    
            $mensaje->save();
            $reporte->noti_t=1;
            $reporte->save();
            


        // si el mensaje es enviado por un tecnico o administrador

        }else{
            $mensaje = new Mensaje();
            $mensaje->reporte_id = $request->reporte;
            $mensaje->usuario_id = $request->usuario;
            $mensaje->tipo_id = $request->tipo_reporte;
            $mensaje->mensaje = $request->mensaje;

            if ($request->hasFile('imagen')) {
                $rutaImagen = $request->file('imagen')->store('imagen', 'public');
                $mensaje->imagen = $rutaImagen;
            }

            if($request->hasFile('audio')){
                $rutaAudio = $request->file('audio')->store('audio', 'public');
                $mensaje->audio = $rutaAudio;
            }
    
            $mensaje->save();
            

        // cambia status del reporte y asigna un tecnico al reporte (ultimo que ha respondido)

            if($reporte->status_id==1){
                $this->cambiar_status($reporte->id, 3, $request->usuario);

            }
            $reporte->tecnico_id = $request->tecnicomensaje;
            $reporte->noti_u=1;
            $reporte->save();

        // nombre del tecnico o administrador para el correo

            
            // if($usuario->email != null){
            //     $correo = $usuario->email;
            //     $nombreusuario = User::findOrFail($request->usuario);
            //     Mail::to($correo)->send(new notificacionCorreo('emails.notireporte', $reporte->codigo, $request->mensaje, $nombreusuario->name));
            // }
        }
        return response()->json(['message' => 'mensaje enviado']);

    }


    public function cambiar_status($id, $estado, $usuario){
        $reporte = ReportesSoftware::findOrFail($id);
        $reporte->status_id = $estado;
        if($estado==3){
            $reporte->tiempo_revision = date("Y-m-d H:i:s");
        }else{
            if($reporte->tiempo_revision!=null){
                $fecha = Carbon::now();
                $tiempo_revision = Carbon::parse($reporte->tiempo_revision);
                $diferenciaEnMinutos = $tiempo_revision->diffInMinutes($fecha);
                $diferenciaEnHoras = $diferenciaEnMinutos / 60; // Convierte a horas
                $reporte->tiempo = $reporte->tiempo+  number_format($diferenciaEnHoras, 2);
            } 
        }
        $reporte->save();

        $traz = new traz_reportes();
        $traz->reporte_id = $id;
        $traz->tipo=1;
        $traz->status_id=$estado;
        $traz->usuario_id = $usuario;
        $traz->save();


        return response()->json(['message', 'estatus cambiado']);
    }


    public function status($id, $rol, $lugar, Request $request){
        $reporte = ReportesSoftware::findOrFail($id);
        
        if($rol ==1 || $rol ==2){
            $reporte->solucionado_tecnico = 1;
            $reporte->tecnico_id = $request->tecnico;
            // $reporte->status_id = 4;
            $reporte->save();
            $this->cambiar_status($id, $request->estado, $request->usuario);
            $borraranterior = SolucionTemp::where('reporte_id', $id)->get();
            foreach($borraranterior as $borrar){
                $borrar->delete();
            }
            $solucion = new SolucionTemp();
            $solucion->reporte_id = $reporte->id;
            $solucion->tecnico_id = $request->tecnico;
            $solucion->tipo_reporte=1;
            $solucion->tipo_solucion = $request->options;
            $solucion->solucion_mensaje = $request->extraInput;
            $solucion->save();
            return to_route('reportessoftware.general');
        }else{
    
            $solucion = new Solucion();
            $solucion->reporte_id = $reporte->id;
            $solucion->tipo_reporte=1;
            $solucion->tecnico_id = $reporte->tecnico_id;
            $solucion->solucion_mensaje = $request->extraInputusuario;
            $solucion->save();

            $reporte->solucionado_usuario =1;
            $reporte->solucionado_tecnico =1;
            $this->cambiar_status($id, 5, $request->usuario);
            $reporte->tiempo_solucion = date("Y-m-d H:i:s");
            $reporte->save();

            return to_route('misreportessoftware', $request->usuario);
        }
    }

    public function confirmarstatusr(Request $request){
        $reporte = ReportesSoftware::findOrFail($request->reporte);
        $temp = SolucionTemp::where('reporte_id', $request->reporte)->where('tipo_reporte', 1)->get();
        $solucion = new Solucion();
        $solucion->reporte_id = $temp[0]->reporte_id;
        $solucion->tipo_reporte=1;
        $solucion->tipo_solucion = $temp[0]->tipo_solucion;
        $solucion->solucion_mensaje = $temp[0]->solucion_mensaje;
        $solucion->tecnico_id = $temp[0]->tecnico_id;
        $solucion->save();
        $temp[0]->delete();
        $reporte->solucionado_usuario =1;
        $reporte->status_id =5;
        $reporte->tiempo_solucion = date("Y-m-d H:i:s");
        $reporte->save();

        $traz = new traz_reportes();
        $traz->reporte_id = $request->reporte;
        $traz->tipo=1;
        $traz->status_id=5;
        $traz->usuario_id=$request->usuario;
        $traz->save();

        return response()->json(['message' => 'ticket solucionado']);

    }

    public function delete($id){
        $reporte = ReportesSoftware::findOrFail($id);
        $reporte->delete();

        return response()->json(['message' => 'ticket cancelado']);

    }

    public function filtros(Request $request) {


        $dia = Carbon::now()->subDay();
        $mes = Carbon::now()->subDay(30);
        $generados = ReportesSoftware::where('status_id', 1)->count();
        $revision = ReportesSoftware::where('status_id', 2)->count();
        $solucionados24 = ReportesSoftware::where('status_id', 3)->where('tiempo_solucion','>=', $dia)->count();
        $totales24 = ReportesSoftware::where('created_at','>=', $dia)->count();
        $sucursales = Sucursal::where('id', '!=', 1)->where('activo', 1)->get();
        $sistemas = Sistemas::orderBy('id')->get();
        $estatus = statusReporte::orderBy('id')->get();
        $nivel = Importancias::orderBy('id')->get();

        $fecha1 = $request->fecha1;
        $fecha2 = $request->fecha2;
        $sucursal = $request->sucursal;
        $sistema = $request->sistema;
        $estado = $request->estado;
        $niveli = $request->nivel;
        $usuario = $request->usuario;
        $check = $request->check;
    
        // Construir la consulta base con las relaciones necesarias
        $query = ReportesSoftware::with('usuario.sucursal', 'modulo', 'sistema', 'status', 'falla', 'mensajes')->orderBy('noti_t', 'desc')->orderBy('status_id')->orderBy('id', 'desc');
    
        // Aplicar filtros según las variables
        if ($fecha1 != '') {
            $query->where('created_at', '>=', $fecha1);
        }
        if ($fecha2 != '') {
            $query->where('created_at', '<=', $fecha2);
        }
        if ($sistema != 0) {
            $query->where('sistema_id', $sistema);
        }
        if ($sucursal != 0) {
            $query->whereHas('usuario.sucursal', function ($q) use ($sucursal) {
                $q->where('id', $sucursal);
            });
        }
        if($estado != 0){
            $query->where('status_id', $estado);
        }
        if($niveli != 10 && $niveli != 0){
            $query->whereHas('falla', function($q) use ($niveli){
                $q->where('nivel_riesgo', $niveli);
            });
        }
        if($niveli == 0){
            $query->where('falla_comun_id', 0);
        }
        if($check=='true'){
            $query->where('tecnico_id', $usuario);
        }

        
        if($request->tipo =='excel'){
            $reportes = $query->orderBy('created_at', 'desc')->get();
        }else{
            $reportes = $query->orderBy('created_at', 'desc')->paginate(10)->appends([
                'fecha1' => $request->fecha1,
                'fecha2' => $request->fecha2,
                'sucursal' => $request->sucursal,
                'sistema' => $request->sistema,
                'estado' => $request->estado,
                'niveli' => $request->nivel,
                'usuario' => $request->usuario,
                // 'check' => $request->check,
            ]);
        }

        if($request->tipo == 'excel'){
            return Excel::download(new ticketsSistemaExport($reportes), 'reportes_sistemas.xlsx');
        }else{
            return view('reportessoftware.index', compact('reportes', 'generados', 'revision', 'solucionados24', 'totales24', 'sucursales', 'sistemas', 'estatus', 'nivel'));
        }
        
    }
}
