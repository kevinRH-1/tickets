<?php

namespace App\Http\Controllers;

use App\Exports\ticketshardwareExport;
use App\Models\ReportesHardware;
use Illuminate\Http\Request;
use App\Models\equipos\Pc;
use App\Models\equipos\Laptops;
use App\Models\equipos\Impresoras;
use App\Models\Mensaje;
use App\Http\Controllers\mensajeController;
use App\Models\CategoriaFalla;
use App\Models\EstadosEquipos;
use App\Models\ReportesSoftware;
use App\Models\Solucion;
use App\Models\SolucionTemp;
use App\Models\statusReporte;
use App\Models\Sucursal;
use App\Models\TipoFalla;
use App\Models\TipoSolucion;
use App\Models\traz_reportes;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ControllerHardwareReporte extends Controller
{
    public function indexgeneral()
    {
        $reportes = ReportesHardware::orderBy('noti_t', 'desc')->orderBy('status_id','asc')->orderBy('id', 'desc')->paginate(10);
        $dia = Carbon::now()->subDay();

        $sucursales = Sucursal::where('id', '!=', 1)->where('activo', 1)->orderBy('id')->get();
        $fallas = TipoFalla::orderBy('id')->get();
        $estatus = statusReporte::orderBy('id')->get();

        
        $querygenerados = collect();
        $queryrevision = collect();
        $querysolucionados = collect();
        $query24h = collect();
        $querygenerados = $querygenerados->merge($reportes->where('status_id', 1));
        $queryrevision = $queryrevision->merge($reportes->where('status_id', 2));
        $querysolucionados = $querysolucionados->merge($reportes->where('status_id', 3)->where('created_at', '>=', $dia));
        $query24h = $query24h->merge($reportes->where('created_at', '>=', $dia));
        $generados = count($querygenerados);
        $revision = count($queryrevision);
        $solucionados = count($querysolucionados);
        $r24h = count($query24h);

        return view('reportes.reportesgeneral', compact('reportes', 'solucionados', 'generados', 'revision', 'sucursales', 'fallas', 'estatus', 'r24h'));
    }

    public function misreportes($usuario){
        // $pc = Pc::where('lugar_id', $id)->where('activo',1)->get();
        // $laptops = Laptops::where('lugar_id', $id)->where('activo',1)->get();
        // $impresoras = Impresoras::where('lugar_id', $id)->where('activo',1)->get();

        // $equipossucursal = collect();
        // $equipossucursal = $equipossucursal->merge($pc)
        //                                     ->merge($laptops)
        //                                     ->merge($impresoras);


        // $reportes = ReportesHardware::whereHas('usuario', function ($query) use ($id, $usuario) {
        //     if ($id == 0) {
        //         $query->where('idusuario', $usuario);
        //     } else {
        //         $query->where('lugar_id', $id);
        //     }
        // })->orderBy('noti_u', 'desc')
        // ->orderBy('status_id', 'asc')
        // ->orderBy('id', 'desc')
        // ->paginate(10);

        $reportes = ReportesHardware::where('idusuario', $usuario)->orderBy('noti_u', 'desc')
        ->orderBy('status_id', 'asc')
        ->orderBy('id', 'desc')
        ->paginate(10);

        $borraract=0;
        foreach($reportes as $r){
            if($r->status_id==1){
                $borraract = 1;
                break;
            }
        }



        $querygenerados = collect();
        $queryrevision = collect();
        $querysolucionados = collect();
        $querygenerados = $querygenerados->merge($reportes->where('status_id', 1));
        $queryrevision = $queryrevision->merge($reportes->where('status_id', 2));
        $querysolucionados = $querysolucionados->merge($reportes->where('status_id', 3));

        $generados = count($querygenerados);
        $revision = count($queryrevision);
        $solucionados = count($querysolucionados);

        return view('reportes.misreportes', compact('reportes', 'solucionados', 'generados', 'revision', 'borraract'));

    }

    public function create($id, $sucursal){
        $pc = Pc::where('lugar_id', $sucursal)->orWhere('userid', $id)->where('activo',1)->get();
        $laptops = Laptops::where('lugar_id', $sucursal)->orWhere('userid', $id)->where('activo',1)->get();
        $impresoras = Impresoras::where('lugar_id', $sucursal)->orWhere('userid', $id)->where('activo',1)->get();
        
        $fallas = CategoriaFalla::orderBy('id')->get();
        $falla = TipoFalla::orderBy('id')->get();
        $status = EstadosEquipos::orderBy('id')->get();

        return view('reportes.create', compact('pc', 'laptops', 'impresoras', 'fallas', 'falla', 'status'));
    }

    //FUNCION PARA CREAR UN REPORTE CON UN EQUIPO YA SELECCIONADO

    public function createid($id, $tipo){

        $fallas = CategoriaFalla::orderBy('id')->get();
        $status = EstadosEquipos::orderBy('id')->get();
        $falla = TipoFalla::orderBy('id')->get();

        if($tipo == 3){
            $equipo = Impresoras::where('id', $id)->where('activo',1)->get();

            return view('reportes.create', compact('equipo', 'tipo', 'fallas', 'falla' , 'status'));

        }else if($tipo == 2){
            $equipo = Laptops::where('id', $id)->where('activo',1)->get();

            return view('reportes.create', compact('equipo', 'tipo', 'fallas', 'falla', 'status'));

        }else {
            $equipo = Pc::where('id', $id)->where('activo',1)->get();
            return view('reportes.create', compact('equipo', 'tipo', 'fallas', 'falla', 'status'));
        }

    }

    public function equipos($cate, $lugar, $usuario){

        if($cate == 1){
            $pc = Pc::where('lugar_id', $lugar)->orWhere('userid', $usuario)->where('activo',1)->get();
            return response()->json($pc);

        } else if($cate== 2){
            $laptop = Laptops::where('lugar_id', $lugar)->orWhere('userid', $usuario)->where('activo',1)->get();
            return response()->json($laptop);

        }else{
            $impresora = Impresoras::where('lugar_id', $lugar)->orWhere('userid', $usuario)->where('activo',1)->get();
            return response()->json($impresora);

        }
    }

    public function getequipo(Request $request){
        $categoria = $request->categoria;
        $id = $request->id;

        if($categoria == 1){
            $pc = Pc::where('id', $id)->get();
            return response()->json($pc);

        }else if($categoria == 2){
            $laptop = Laptops::where('id', $id)->get();
            return response()->json($laptop);
            
        }else{
            $impresora = Impresoras::where('id', $id)->get();
            return response()->json($impresora);
            
        }
    }

    public function store(Request $request){
        DB::transaction(function () use ($request) {
            $reporte = new ReportesHardware();
            
            
            $reporte->idusuario = $request->usuario;
            $reporte->idequipo = $request->equipo;
            if($request->categoria ==1){
                $equipo='computadora';
                $reporte->codigo = ReportesHardware::generateUniqueCode($equipo);
                $pc = Pc::findOrFail($request->equipo);
                $pc->estado_id = $request->estado;
                $pc->save();
            }else if($request->categoria==2){
                $equipo='laptop';
                $reporte->codigo = ReportesHardware::generateUniqueCode($equipo);
                $laptop = Laptops::findOrFail($request->equipo);
                $laptop->estado_id = $request->estado;
                $laptop->save();
            }else{
                $equipo='impresora';
                $reporte->codigo = ReportesHardware::generateUniqueCode($equipo);
                $impresora = Impresoras::findOrFail($request->equipo);
                $impresora->estado_id = $request->estado;
                $impresora->save();
            }
            $reporte->descripcion = $request->desc;
            // if($request->problema == 0){
            //     $reporte->falla = $request->nuevafalla;
            // }else{
            //     $reporte->categoria_falla_id = $request->problema;
            //     $reporte->falla = $request->falla;
            // }

            if($request->falla==0){
                $reporte->falla_id = null;
            }else{
                $reporte->falla_id = $request->falla;
            }
            $reporte->categoria_id = $request->categoria;
            $reporte->solucionado_usuario = 0;
            $reporte->solucionado_tecnico = 0;
            $reporte->status_id = 1; 
            $reporte->noti_t=1;
            $reporte->noti_u=0;

            $reporte->save();

            $mensaje = new Mensaje();
            $mensaje->reporte_id = $reporte->id;
            $mensaje->usuario_id = $reporte->idusuario;
            $mensaje->tipo_id = $request->tipo_reporte;
            $mensaje->mensaje = $request->desc;
            if ($request->hasFile('imagen')) {
                $rutaImagen = $request->file('imagen')->store('imagen', 'public');
                $mensaje->imagen = $rutaImagen;
            }
            $mensaje->save();

            $traz = new traz_reportes();
            $traz->reporte_id = $reporte->id;
            $traz->status_id = 1;
            $traz->tipo=2;
            $traz->usuario_id = $request->usuario;
            $traz->save();
            
        });

        return response()->json(['message' => 'ticket creado']);
    }

    public function detalles($id, $role){

        $reporterevision = ReportesHardware::findOrFail($id); 
        $soluciones = TipoSolucion::orderBy('id')->where('categoria', '!=', 1)->where('activo', 1)->get();

        $mensajes1 = Mensaje::where('reporte_id', $id)->where('tipo_id', 2)->with('usuario', 'reporte')->get();


        // ESTA PARTE BUSCA SI YA SE HA MANDADO UNA SOLUCION PARA EL REPORTE, EN CASO DE QUE SI
        // SE DA 0 PARA DENEGAR LA POSIBILIDAD DE SOLICITUD DE SOLUCION

        $tec = [1, 2];

        $solucion =Mensaje::with('usuario')->where('reporte_id', $id)->wherehas('usuario', function ($query) use ($tec){
            $query->whereIn('roleid',$tec);
        })->where('tipo_id', 2)->get();
        if ($solucion->isEmpty()){
            $confirmar =  0;
        }else{
            $confirmar = 1;
        }
        $rol = $role;

        if($rol == 1 && $reporterevision->tiempo_revision == null){
            $reporterevision->tiempo_revision = date("Y-m-d H:i:s");
            $reporterevision->save();
        }

        $reporte = ReportesHardware::where('id', $id)->get();

        if($reporte[0]->tiempo_solucion != null){
            $fecha1 = $reporte[0]->created_at;
            $fecha2 = $reporte[0]->tiempo_solucion;

            $diferenciaEnMinutos = $fecha1->diffInMinutes($fecha2);
            $diferenciaEnHoras = $diferenciaEnMinutos / 60; // Convierte a horas
            $tiempo = number_format($diferenciaEnHoras, 2);
        }else{
            $tiempo = 'sin solucionar';
        }

        if($rol ==3){
            $reporte[0]->noti_u=0;
        }else{
            $reporte[0]->noti_t=0;
        }

        $reporte[0]->save();

        $estados = statusReporte::where('id' ,'!=', 1)->orderBy('id')->get();
        $traz = traz_reportes::where('reporte_id', $id)->where('tipo', 2)->orderBy('id')->get();

        


        return view('reportes.verreporte', compact('reporte', 'rol', 'mensajes1', 'confirmar', 'soluciones', 'tiempo', 'estados', 'traz'));
    }

    //Funcion para mandar mensajes tanto del usuario como del tecnico

    public function problemaysolucion(Request $request){
        $reporte = ReportesHardware::findOrFail($request->reporte);
      
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
            
            $mensaje->save();
            $reporte->noti_t=1;
            $reporte->save();

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
            $mensaje->save();

            // $reporte->status_id= 2;
            $reporte->idtecnico = $request->tecnicomensaje;
            $reporte->noti_u=1;
            $reporte->save();
        }

        return redirect()->back();

    }

    

    public function cambiarestatus($id, $rol, $sucursal, Request $request){
        $reporte = ReportesHardware::findOrFail($id);
        


        if($rol ==1 || $rol ==2){
            $reporte->solucionado_tecnico = 1;
            $reporte->idtecnico = $request->tecnico;
            if($request->estado==5){
                $reporte->solucionado_usuario =1;
                $reporte->solucionado_tecnico=1;
                $reporte->tiempo_solucion = date("Y-m-d H:i:s");
            }
            
            $reporte->save();
            $this->cambiar_status($id, $request->estado, $request->usuario);
            $borraranterior = SolucionTemp::where('reporte_id', $id)->get();
            foreach($borraranterior as $borrar){
                $borrar->delete();
            }
            if($request->estado==4){
                $solucion = new SolucionTemp();
                $solucion->reporte_id = $reporte->id;
                $solucion->tecnico_id = $request->tecnico;
                $solucion->tipo_reporte = 2;
                
                $solucion->tipo_solucion = $request->options;
                
                $solucion->solucion_mensaje = $request->extraInput;
                
                $solucion->save();
            }elseif($request->estado==5){
                $solucion = new Solucion();
                $solucion->reporte_id = $reporte->id;
                $solucion->tecnico_id = $request->tecnico;
                $solucion->tipo_reporte = 2;
                
                $solucion->tipo_solucion = $request->options;
                
                $solucion->solucion_mensaje = $request->extraInput;
                
                $solucion->save();
            }
           
            return to_route('reportes.general');
        }else{
            // $soluciontemp = SolucionTemp::where('reporte_id', $id)->get();
            $solucion = new Solucion();
            $solucion->reporte_id = $reporte->id;
            $solucion->tipo_reporte=2;
            $solucion->tecnico_id = $reporte->idtecnico;
            // $solucion->tipo_solucion = $reporte->tipo_solucion;
            $solucion->solucion_mensaje = $request->extraInputusuario;
            $solucion->save();
            // $soluciontemp[0]->delete();
            $reporte->solucionado_usuario =1;
            $reporte->solucionado_tecnico=1;
            $this->cambiar_status($id, 5, $request->usuario);
            $reporte->tiempo_solucion = date("Y-m-d H:i:s");
            $reporte->save();

            return to_route('misreportes', $sucursal);
        }
        
    }

    public function confirmsolucion(Request $request){
        $reporte = ReportesHardware::findOrFail($request->reporte);
        $temp = SolucionTemp::where('reporte_id', $request->reporte)->where('tipo_reporte', 2)->get();
        $solucion = new Solucion();
        $solucion->reporte_id = $temp[0]->reporte_id;
        $solucion->tipo_reporte=2;
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
        $traz->usuario_id = $request->usuario;
        $traz->tipo=2;
        $traz->status_id=5;
        $traz->save();

        return response()->json(['message' => 'ticket solucionado']);

    }

    public function delete($id){
        $reporte = ReportesHardware::findOrFail($id);
        $reporte->delete();
        
        return response()->json(['message' => 'ticket cancelado']);

    }

    public function historial(Request $request){
        $reportes = ReportesHardware::where('idequipo', $request->id)->where('categoria_id', $request->categoria)->with('usuario', 'tecnico', 'status')->orderBy('id', 'desc')->get();

        foreach($reportes as $item){
            $item->fecha = Str::limit($item->created_at,10, '');
        }

        return response()->json($reportes);
    }

    public function historial2(Request $request){
        $reportes = ReportesHardware::where('idequipo', $request->id)->where('categoria_id', $request->categoria)->with('usuario', 'tecnico', 'status');
        
        if (!empty($request->fecha1) && empty($request->fecha2)) {
            // Si solo fecha1 tiene valor, buscar registros creados desde fecha1 en adelante
            $reportes->where('created_at', '>=', $request->fecha1);
        } elseif (empty($request->fecha1) && !empty($request->fecha2)) {
            // Si solo fecha2 tiene valor, buscar registros creados hasta fecha2
            $reportes->where('created_at', '<=', $request->fecha2);
        } elseif (!empty($request->fecha1) && !empty($request->fecha2)) {
            // Si ambas fechas tienen valor, buscar entre fecha1 y fecha2
            $reportes->whereBetween('created_at', [$request->fecha1, $request->fecha2]);
        }

        $reportes = $reportes->orderBy('id', 'desc')->get();

        foreach($reportes as $item){
            $item->fecha = Str::limit($item->created_at,10, '');
        }

        return response()->json($reportes);
    }

    public function filtros(Request $request){

        $fecha1 = $request->fecha1;
        $fecha2 = $request->fecha2;
        $sucursal = $request->sucursal;
        $maquina = $request->maquina;
        $problema = $request->problema;
        $estado = $request->estado;
        $usuario = $request->usuario;
        $check = $request->check;

        $reportest = ReportesHardware::orderBy('id')->get();

        $query = ReportesHardware::with('usuario.sucursal', 'status')->OrderBy('noti_t', 'desc');

        if ($fecha1 != '') {
            $query->where('created_at', '>=', $fecha1);
        }
        if ($fecha2 != '') {
            $query->where('created_at', '<=', $fecha2);
        }
        if ($sucursal != 0) {
            $query->whereHas('usuario.sucursal', function ($q) use ($sucursal) {
                $q->where('id', $sucursal);
            });
        }
        if( $maquina != 0){
            if($maquina ==1){
                $query->where('categoria_id', 1);
            }else if($maquina ==2){
                $query->where('categoria_id', 2);
            }else{
                $query->where('categoria_id',3);
            }
        }
        if ($problema != 0){
            $query->where('falla', $problema);
        }

        if($estado != 0){
            $query->where('status_id', $estado);
        }

        if($check=='true'){
            $query->where('idtecnico', $usuario);
        }

        if($request->tipo =='excel'){
            $reportes = $query->orderBy('created_at', 'desc')->get();
        }else{
            $reportes = $query->orderBy('created_at', 'desc')->paginate(10)->appends([
                'fecha1' => $request->fecha1,
                'fecha2' => $request->fecha2,
                'sucursal' => $request->sucursal,
                'maquina' => $request->maquina,
                'problema' => $request->problema,
                'estado' => $request->estado,
                'usuario' => $request->usuario,
                // 'check' => $request->check,
            ]);
        }

        

        $sucursales = Sucursal::where('id', '!=', 1)->where('activo', 1)->orderBy('id')->get();
        $fallas = TipoFalla::orderBy('id')->get();
        $estatus = statusReporte::orderBy('id')->get();

        
        $querygenerados = collect();
        $queryrevision = collect();
        $querysolucionados = collect();
        $querygenerados = $querygenerados->merge($reportest->where('status_id', 1));
        $queryrevision = $queryrevision->merge($reportest->where('status_id', 2));
        $querysolucionados = $querysolucionados->merge($reportest->where('status_id', 3));

        $generados = count($querygenerados);
        $revision = count($queryrevision);
        $solucionados = count($querysolucionados);

        if($request->tipo=='excel'){
            return Excel::download(new ticketshardwareExport($reportes), 'reportes_hardware.xlsx');
        }else{
            return view('reportes.reportesgeneral', compact('reportes', 'solucionados', 'generados', 'revision', 'sucursales', 'fallas', 'estatus'));

        }


    }

    public function cambiar_status($id, $estado, $usuario){
        $reporte = ReportesHardware::findOrFail($id);
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
        $traz->tipo=2;
        $traz->status_id=$estado;
        $traz->usuario_id = $usuario;
        $traz->save();


        return response()->json(['message', 'estatus cambiado']);
    }

    


}
