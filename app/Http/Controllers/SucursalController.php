<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\Equipos;
use App\Models\equipos\Pc;
use App\Models\equipos\Laptops;
use App\Models\equipos\Teclados;
use App\Models\equipos\Monitores;
use App\Models\equipos\Raton;
use App\Models\equipos\Impresoras;
use App\Models\CategoriasEquipos;
use App\Models\EstadosEquipos;
use App\Models\ReportesHardware;
use App\Models\ReportesSoftware;
use App\Models\User;
use Illuminate\Support\Collection;

class SucursalController extends Controller
{
    public function index()
    {
        $sucursal = Sucursal::orderBy('id')->where('activo', 1)->get();
        $impresoras = Impresoras::orderBy('id')->where('activo',1)->get();
        $pcs = Pc::orderBy('id')->where('activo',1)->get();
        $laptops = Laptops::orderBy('id')->where('activo',1)->get();
        

        foreach ($sucursal as $sucursales) {
            // Contar los registros en cada tabla donde lugar_id coincide con el id de la sucursal
            $contadorImpresoras = Impresoras::where('lugar_id', $sucursales->id)->where('activo',1)->count();
            $contadorPcs = Pc::where('lugar_id', $sucursales->id)->where('activo',1)->count();
            $contadorLaptops = Laptops::where('lugar_id', $sucursales->id)->where('activo',1)->count();

            $impresorasfalla = Impresoras::where('lugar_id', $sucursales->id)->where('estado_id', '!=', 1)->where('activo',1)->count();
            $pcfalla = Pc::where('lugar_id', $sucursales->id)->where('estado_id', '!=', 1)->where('activo',1)->count();
            $laptopfalla = Laptops::where('lugar_id', $sucursales->id)->where('estado_id', '!=', 1)->where('activo',1)->count();

           
        
            // Sumar los contadores
            $total = $contadorImpresoras + $contadorPcs + $contadorLaptops;

            $totaldanados = $impresorasfalla + $pcfalla + $laptopfalla;
        
            // Agregar el total a cada sucursal sin modificar el created_at original
            $sucursales->total_equipos = $total;
            $sucursales->total_falla = $totaldanados; // Nuevos campos temporales para mostrar en la vista
        }

        $totalfallai = Impresoras::where('estado_id', '!=', 1)->where('activo',1)->count();
        $totalfallap = Pc::where('estado_id', '!=', 1)->where('activo',1)->count();
        $totalfallal = Laptops::where('estado_id', '!=', 1)->where('activo',1)->count();

        $totalfalla = $totalfallai + $totalfallap + $totalfallal;

        $totalequipos = $impresoras->count() + $pcs->count() + $laptops->count();

        return view('equipos.index', compact('sucursal', 'totalequipos', 'totalfalla'));
    }

    public function versucursal($id){
    $sucursales = Sucursal::orderBy('id')->where('activo', 1)->get();
    $sucursal = Sucursal::where('id', $id)->where('activo', 1)->get();
    $impresoras = Impresoras::orderBy('id')->where('lugar_id', $id)->where('activo',1)->paginate(10);
    $pcs = Pc::orderBy('id')->where('lugar_id', $id)->where('activo',1)->paginate(10);
    $laptops = Laptops::orderBy('id')->where('lugar_id', $id)->where('activo',1)->paginate(10);
    // $teclados = Teclados::orderBy('id')->where('lugar', $id)->get();
    // $ratones = Raton::orderBy('id')->where('lugar', $id)->get();
    // $monitores = Monitores::orderBy('id')->where('lugar', $id)->get();
    $usuarios = User::orderBy('id')->where('activo',1)->get();
    $categorias = CategoriasEquipos::orderBy('id')->get();
    $estados = EstadosEquipos::orderBy('id')->get();

    return view('equipos.versucursal', compact('impresoras', 'pcs', 'laptops', 'usuarios', 'categorias', 'estados', 'sucursales', 'sucursal'));
    }

    public function index2()
    {
        $sucursales = Sucursal::orderBy('id')->where('id', '!=', 1)->where('activo', 1)->paginate(10);
        foreach($sucursales as $item){
            $pc= Pc::where('lugar_id', $item->id)->where('activo',1)->get();
            $laptop= Laptops::where('lugar_id', $item->id)->where('activo',1)->get();
            $impresora= Impresoras::where('lugar_id', $item->id)->where('activo',1)->get();
            $equipos = collect();
            $equipos = $equipos->merge($pc)
                                ->merge($laptop)
                                ->merge($impresora);
            $item->equipos = count($equipos);

            $usuarios = User::where('lugar_id', $item->id)->where('activo',1)->get();
            $item->usuarios = count($usuarios);

            $reportesS = ReportesSoftware::with('usuario')->whereHas('usuario', function ($query) use ($item){
                $query->where('lugar_id', $item->id)->where('status_id', '!=', 3);
            })->get();
            $reportesH = ReportesHardware::with('usuario')->wherehas('usuario', function ($query) use ($item){
                $query->where('lugar_id', $item->id)->where('status_id', '!=', 3);
            })->get();

            $reportes = collect();
            $reportes = $reportes->merge($reportesH)
                                 ->merge($reportesS);

            $item->reportes = count($reportes);
        }

        return view('sucursales.index', compact('sucursales'));
    }

    public function crear(){
        $sucursal = new Sucursal();

        return view('sucursales.create', compact('sucursal'));
    }

    public function store(Request $request){
        
        $sucursal = new Sucursal();
        $sucursal->nombre = $request->nombre;
        $sucursal->activo=1;

        $sucursal->save();

        return response()->json(['message', 'sucursal registrada con exito!']);
    }

    public function update(Request $request){
        $sucursal = Sucursal::findOrFail($request->id);
        $sucursal->nombre = $request->nombre;
        $sucursal->save();

        return response()->json(['message', 'sucursal modificada con exito']);
    }


    public function delete($id){
        $sucursal = Sucursal::findOrFail($id);
        $sucursal->activo=0;
        $sucursal->save();

        return response()->json(['message', 'sucursal borrada con exito']);
    }
}
