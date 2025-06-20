<?php

use App\Http\Controllers\CategoriasEquipoController;
use App\Http\Controllers\VistasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ControllerHardwareReporte;
use App\Http\Controllers\ControllerSoftwareReporte;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\equipos\PcController;
use App\Http\Controllers\equipos\RatonController;
use App\Http\Controllers\equipos\TecladosController;
use App\Http\Controllers\equipos\MonitorController;
use App\Http\Controllers\equipos\LaptopController;
use App\Http\Controllers\equipos\ImpresorasController;
use App\Http\Controllers\mensajeController;
use App\Http\Controllers\ModulosController;
use App\Http\Controllers\SistemasController;
use App\Http\Controllers\TipoFaLLaController;
use App\Http\Controllers\TipoFallaSoftwareController;
use App\Http\Controllers\TipoSolucionController;
use App\Models\CategoriasEquipos;
use App\Models\equipos\Impresoras;
use App\Models\ReportesHardware;
use App\Models\Sistemas;
use App\Models\solucionFalla;
use App\Models\TipoFallaSoftware;
use App\Models\TipoSolucion;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteUsuariosExport;
use App\Exports\ticketsSistemaExport;
use App\Http\Controllers\SolucionTempController;
use App\Http\Controllers\VideosController;
use App\Models\ReportesSoftware;
use App\Models\Videos;

Route::get('/', function () {
    return view('auth.login');
})->name('verlogin');

 Route::get('/registrarusuario', [UserController::class, 'registrar'])->name('registrar.usuario');
 Route::post('/nuevousuario', [UserController::class, 'store2']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',[DashboardController::class, 'dashboard'] )->name('dashboard');
    Route::get('banner', function () {
        return view('dashboard');
    })->name('inicio');
    
    Route::get('/reportes-por-sucursal/{tiempo}', [DashboardController::class, 'graficos']);
    Route::get('/reportes-por-estado/{tiempo}', [DashboardController::class, 'graficosestado']);
    Route::get('/reportes-por-sistema/{tiempo}', [DashboardController::class, 'graficossistema']);
   
    
    
    // Route::get('/auth', function () {
    //     return view('auth.register');
    // });
    
    Route::get('usuarios', [UserController::class,'index'])->name('usuario.index');
    Route::post('users',[UserController::class, 'store'])->name('usuario.agregar');
    Route::get('usuarios/{id}', [UserController::class, 'find'])->name('usuario.find');
    Route::post('usuarios/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/usuarios/borrar/{id}' ,[UserController::class, 'delete'])->name('usuario.delete');
    Route::get('usuarios/status/{id}', [UserController::class, 'status'])->name('usuario.status/{id}');
    Route::get('usuariosdatos{id}', [UserController::class, 'datos'])->name('usuarios.datos');
    Route::get('filtrousuarios', [UserController::class, 'filtro'])->name('filtro.usuarios');
    Route::get('/buscarusuario', [UserController::class, 'buscar'])->name('buscar.usuario');
    Route::get('/usuariost', [UserController::class, 'usuarios'])->name('usuarios');
    Route::post('/cambiarol-usuario', [UserController::class, 'cambiarol'])->name('cambiarol.usuario');
    Route::get('historial-usuario/{id}', [UserController::class, 'historial'])->name('historial.usuario');
    Route::get('historial-usuario2/{id}', [UserController::class, 'historial2'])->name('historial.usuario');
    
    Route::get('misequipos/{id}', [EquipoController::class, 'misequipos'])->name('misequipos');
    
    // Route::get('reportes', function(){
    //     return view('reportes.reportesgeneral');
    // })->name('reportes.general');
    
    Route::get('manuale_u', function(){
        return view('manuales.manualusuario');
    })->name('manual.usuario');
    
    
    Route::get('sucursales', [SucursalController::class,'index'])->name('equipo.index');
    
    Route::get('sucursale/{id}',[SucursalController::class, 'versucursal'])->name('versucursal');
    
    Route::get('equiposgeneral',[EquipoController::class, 'index'])->name('equiposgeneral');
    
    
    //SUCURSALES
    
    Route::get('sucursales2', [SucursalController::class,'index2'])->name('sucursal.index2');
    Route::get('sucursal/crear', [SucursalController::class, 'crear'])->name('sucursal.crear');
    Route::post('sucursal/regis', [SucursalController::class, 'store'])->name('sucursal.store');
    Route::post('modsucursal', [SucursalController::class, 'update'])->name('sucursal.modificar');
    Route::delete('sucursalborrar/{id}', [SucursalController::class, 'delete'])->name('sucursa.borrar');
    
    
    
    //CATEGORIAS
    
    Route::get('categorias', [CategoriasEquipoController::class, 'index'])->name('categorias.index');
    Route::post('categorias/store', [CategoriasEquipoController::class, 'store'])->name('categorias.store');
    
    
    
    Route::get('/crear/{valor}', [EquipoController::class, 'crear'])->name('guardar');
    
    Route::get('/mostrar', function () {
        $valor = session('mi_variable');
        return view('equipos.create', compact('valor'));
    });
    
    // Route::get('guardar', [EquipoController::class, 'crear']);
    
    //          EQUIPOS 
    
    
    Route::get('/consulta-datos/{id}/{tipo}', [EquipoController::class,'datos'])->name('equipo.datos');
    Route::post('quitar/{id}/{cate}',[EquipoController::class, 'quitar'])->name('equipo.quitar');
    Route::post('asignar/{id}/{cate}',[EquipoController::class, 'asignar'])->name('equipo.asignar');
    Route::post('asignarusuario', [EquipoController::class, 'asignarusuario'])->name('asignar.usuario');
    Route::post('actualizar/{id}/{cate}',[EquipoController::class, 'update'])->name('equipo.update');
    Route::post('equipos/store', [EquipoController::class, 'store'])->name('equipo.store');
    Route::delete('equipo/eliminar/{id}/{cate}', [EquipoController::class, 'eliminar'])->name('equipo.eliminar');
    Route::get('filtrosequipos', [EquipoController::class, 'filtros'])->name('filtros.equipos');
    //  Pc
    Route::post('pc/create', [PcController::class, 'store'])->name('pc.store');
    Route::get('/consulta-datos/pc/{id}', [PcController::class, 'find'])->name('consulta.pc');
    Route::post('/actualizar/pc/{id}', [PcController::class, 'update'])->name('actualizar.equipo');
    Route::delete('/borrar/pc/{id}', [PcController::class, 'delete'])->name('borrar.pc');
    Route::post('/asignar/pc/{id}',[PcController::class, 'asignar'])->name('asignar.pc');
    Route::post('/quitar/pc/{id}',[PcController::class, 'quitar'])->name('asignar.pc');
    Route::post('/status/pc/{id}', [PcController::class, 'status'])->name('status.pc');
    
    //laptop
    Route::post('laptop/create', [LaptopController::class, 'store'])->name('laptop.store');
    Route::get('/consulta-datos/laptop/{id}', [LaptopController::class, 'find'])->name('consulta.laptop');
    Route::post('/actualizar/laptop/{id}', [LaptopController::class, 'update'])->name('actualizar.laptop');
    Route::delete('/borrar/laptop/{id}', [LaptopController::class, 'delete'])->name('borrar.laptop');
    Route::post('/asignar/laptop/{id}',[LaptopController::class, 'asignar'])->name('asignar.laptop');
    Route::post('/quitar/laptop/{id}',[LaptopController::class, 'quitar'])->name('asignar.laptop');
    Route::post('/status/laptop/{id}', [LaptopController::class, 'status'])->name('status.laptop');
    //impresora
    Route::post('impresora/create', [ImpresorasController::class, 'store'])->name('impresora.store');
    Route::get('/consulta-datos/impresoras/{id}', [ImpresorasController::class, 'find'])->name('consulta.impresora');
    Route::post('/actualizar/impresoras/{id}', [ImpresorasController::class, 'update'])->name('actualizar.impresora');
    Route::delete('/borrar/impresoras/{id}', [ImpresorasController::class, 'delete'])->name('borrar.impresora');
    Route::post('/asignar/impresoras/{id}',[ImpresorasController::class, 'asignar'])->name('asignar.impresora');
    Route::post('/quitar/impresoras/{id}',[ImpresorasController::class, 'quitar'])->name('asignar.impresora');
    Route::post('/status/impresoras/{id}', [ImpresorasController::class, 'status'])->name('status.impresoras');
    
    
    
    //           REPORTES SOFTWARE
    
    Route::get('reportessoftware', [ControllerSoftwareReporte::class, 'index'])->name('reportessoftware.general');
    Route::get('misreportessoftware{id}', [ControllerSoftwareReporte::class, 'reportes'])->name('misreportessoftware');
    Route::get('reportessoftwarecreate', [ControllerSoftwareReporte::class, 'create'])->name('reportessoftware.create');
    Route::get('cargarmodulos/{id}', [ControllerSoftwareReporte::class, 'modulos'])->name('cargar.modulos');
    Route::post('reportessoftwarestore', [ControllerSoftwareReporte::class, 'store'])->name('reportessoftware.store');
    Route::get('verreporte/{id}{roleid}', [ControllerSoftwareReporte::class, 'reporte'])->name('reporte.ver');
    Route::post('enviar/mensaje', [ControllerSoftwareReporte::class, 'mensajes'])->name('enviar.mensaje');
    Route::get('/software-cambiar/estatus/{id}/{rol}/{sucursal}', [ControllerSoftwareReporte::class , 'status'])->name('software1.status');
    Route::post('/confirmarstatus', [ControllerSoftwareReporte::class, 'confirmarstatusr'])->name('confirmar.status');
    Route::delete('reportes/borrar/{id}', [ControllerSoftwareReporte::class, 'delete'])->name('reporte.borrar');
    Route::get('filtrosreportesS', [ControllerSoftwareReporte::class, 'filtros'])->name('filtros.software');
    Route::get('cargarvista/{id}/{sistema}', [VistasController::class, 'cargar'])->name('cargar.vista');
    Route::post('cambiar-status-reporte/{id}/{estado}/{usuario}', [ControllerSoftwareReporte::class, 'cambiar_status'])->name('cambiar.status');
    
    
    //          REPORTES HARDWARE
    Route::delete('reporteshardware/borrar/{id}', [ControllerHardwareReporte::class, 'delete'])->name('reporteh.borrar');
    Route::post('reporteh/store', [ControllerHardwareReporte::class, 'store'])->name('reporteh.store');
    Route::get('/reporte-detalles/{id}{role}', [ControllerHardwareReporte::class, 'detalles'])->name('reportes.detalles');
    Route::post('/enviar/solucion', [ControllerHardwareReporte::class, 'problemaysolucion'])->name('enviar.solucion');
    Route::get('hardware-cambiar/estatus/{id}/{rol}/{sucursal}', [ControllerHardwareReporte::class , 'cambiarestatus'])->name('cambiar.status');
    Route::get('/verfallas/{id}', [TipoFaLLaController::class, 'verfallas'])->name('verfallas');
    // Route::get('reporte/eliminar{id}{sucursal}', [ControllerHardwareReporte::class, 'delete'])->name('reporte.eliminar');
    Route::get('reportes', [ControllerHardwareReporte::class,'indexgeneral'])->name('reportes.general');
    Route::get('/reportes/create{id}{categoria}', [ControllerHardwareReporte::class, 'createid'])->name('reportes.createid');
    // Route::get('reportes/create{id}', [ControllerHardwareReporte::class , 'create'])->name('reportes.create');
    Route::get('/reportes/equipos/{id}/{lugar}/{usuario}', [ControllerHardwareReporte::class, 'equipos'])->name('reportes.equipos');
    Route::get('reportes/getequipo', [ControllerHardwareReporte::class, 'getequipo'])->name('reportes.getequipo');
    Route::get('/misreportes/{usuario}', [ControllerHardwareReporte::class, 'misreportes'])->name('misreportes');
    Route::get('cambiar/estatus/{id}{rol}{sucursal}', [ControllerSoftwareReporte::class , 'status'])->name('software.status');
    Route::post('/confirmarsolucion', [ControllerHardwareReporte::class, 'confirmsolucion'])->name('confirmar.solucion');
    Route::get('crearticketh/{id}{sucursal}', [ControllerHardwareReporte::class, 'create'])->name('crear.ticketequipo');
    // Route::get('crearticketh', [ControllerHardwareReporte::class, 'create'])->name('crear.ticketequipo');
    Route::get('/verhistorial', [ControllerHardwareReporte::class, 'historial'])->name('historial.ver');
    Route::get('filtrosreportesH', [ControllerHardwareReporte::class, 'filtros'])->name('filtros.hardware');
    Route::get('mostrarhistorial', [ControllerHardwareReporte::class, 'historial2'])->name('historial.ver2');
    Route::post('cambiar-status-reporteH/{id}/{estado}/{usuario}', [ControllerHardwareReporte::class, 'cambiar_status'])->name('cambiar.status');
    
    
    Route::post('/negarsolucion', [SolucionTempController::class, 'negar'])->name('negar.solucion');
    Route::post('negarsolucionsoftware', [SolucionTempController::class, 'negarS'])->name('negar.solucionS');
    
    
    //          MENSAJES 
    
    Route::get('historial/mensajes{id}', [mensajeController::class, 'vermensajes'])->name('historial.mensajes');
    
    
    //          SISTEMAS
    
    Route::get('sistemas/index', [SistemasController::class, 'index'])->name('sistemas.index');
    Route::get('sistemas/ver{id}', [SistemasController::class, 'versistema'])->name('sistemas.ver');
    Route::get('vermodulo/{id}', [SistemasController::class, 'vermodulo'])->name('modulo.ver');
    Route::post('modulostore', [ModulosController::class, 'store'])->name('modulo.store');
    Route::post('sistemastore', [SistemasController::class, 'store'])->name('sistema.store');
    Route::delete('modulo/delete/{id}', [ModulosController::class, 'delete'])->name('modulo.delete');
    Route::get('modulover/{id}', [ModulosController::class, 'modulover'])->name('modulo.verdatos');
    Route::post('modulo/act/{id}', [ModulosController::class, 'update'])->name('modulo.update');
    Route::get('sistemadatos/{id}', [SistemasController::class, 'sistemadatos'])->name('sistema.datos');
    Route::delete('sistema/delete/{id}', [SistemasController::class, 'delete'])->name('sistema.delete');
    Route::post('sistema/act/{id}', [SistemasController::class, 'update'])->name('sistema.actualizar');
    Route::get('filtrossistema', [SistemasController::class, 'filtroreportes'])->name('filtrosistema.reportes');
    Route::post('create-vista', [VistasController::class, 'create'])->name('create.vista');
    Route::delete('/borrarvista/{id}', [VistasController::class, 'delete'])->name('delete.vista');
    
    
    
    Route::post('fallasoftwarestore', [TipoFallaSoftwareController::class, 'store'])->name('fallasoftware.store');
    Route::post('fallastore', [TipoFaLLaController::class, 'store'])->name('falla.store');
    Route::get('cargarfallas/{id}/{sistema}/{vista}', [TipoFallaSoftwareController::class, 'cargarfallas'])->name('fallas.cargar');
    Route::post('actfalla', [TipoFaLLaController::class, 'update'])->name('falla.act');
    Route::get('versolucion/{id}', [TipoFallaSoftwareController::class, 'solucion'])->name('solucion.fallaS');
    Route::post('actsolucionfalla', [TipoFallaSoftwareController::class, 'actsolucion'])->name('act.solucionfalla');
    Route::delete('borrarfallasistema/{id}', [TipoFallaSoftwareController::class, 'delete'])->name('fallasistema.delete');
    
    Route::get('fys', [TipoFaLLaController::class, 'fallasysolucion'])->name('fallas.soluciones');
    Route::delete('borrarfalla/{id}', [TipoFaLLaController::class, 'delete'])->name('borrar.falla');
    Route::post('solucionstore', [TipoSolucionController::class, 'store'])->name('solucion.store');
    Route::delete('borrarsolucion/{id}', [TipoSolucionController::class, 'delete'])->name('borrar.solucion');
    Route::post('actsolucion', [TipoSolucionController::class, 'update'])->name('solucion.act');
    Route::get('buscarsolucion/{falla}', [TipoFallaSoftwareController::class, 'buscarsolucion'])->name('buscar.solucion');
    
    
    
    
    
    // VIDEOS
    Route::get('videos', [VideosController::class, 'videos'])->name('videos');
    Route::get('subir-videos', [VideosController::class, 'subir'])->name('subir.videos');
    Route::post('create-video', [VideosController::class, 'create'])->name('crear.video');
    Route::get('detalles_video/{id}', [VideosController::class, 'detalles'])->name('datelles.video');
    Route::post('actualizar_video', [VideosController::class, 'update'])->name('update.video');
    Route::delete('delete_video/{id}', [VideosController::class, 'delete'])->name('delete.video');
    Route::post('/marcar-anuncio', [VideosController::class, 'marcarAnuncio'])->name('marcar');
    Route::get('agregar_video', [VideosController::class, 'subir'])->name('agregar.video');

    
    
    
    
    //EXCEL
    
    Route::get('/usuarios-excel', function(){
        return Excel::download(new ReporteUsuariosExport, 'users.xlsx');
    })->name('excel.prueba');
    
    // Route::get('/ticketsS-excel', function(){
    //     return Excel::download(new ticketsSistemaExport, 'ticketsSistemas.xlsx');
    // })->name('tickets.sistemas');
    
    
    
    // Route::get('equipos', function(){
    //      return view('equipos.index');
    // })->name('equipo.index');
    
    Route::get('manuales', function(){
        return view('manuales.manualadministrador');
    })->name('manual.administrador');
});


Route::get('vista/prueba', function(){
    return view('prueba');
})->name('vista.prueba');
