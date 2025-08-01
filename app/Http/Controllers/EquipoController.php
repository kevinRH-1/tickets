<?php

namespace App\Http\Controllers;

use App\Exports\EquiposExport;
use App\Http\Controllers\equipos\ImpresorasController;
use App\Http\Controllers\equipos\LaptopController;
use App\Http\Controllers\equipos\PcController;
use App\Models\Equipos;
use App\Models\equipos\Impresoras;
use App\Models\equipos\Monitores;
use App\Models\equipos\Teclados;
use App\Models\equipos\Laptops;
use App\Models\equipos\Pc;
use App\Models\equipos\Raton;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\CategoriasEquipos;
use App\Models\Sucursal;
use App\Models\User;
use App\Models\EstadosEquipos;
use Maatwebsite\Excel\Facades\Excel;

class EquipoController extends Controller
{
    public function index()
    {
        $impresoras = Impresoras::with('categoria', 'lugar', 'estado')->where('activo',1)->orderBy('id')->paginate(10);
        $pcs = Pc::with('categoria', 'lugar', 'estado')->where('activo',1)->orderBy('id')->paginate(10);
        $laptops = Laptops::with('categoria', 'lugar', 'estado')->where('activo',1)->orderBy('id')->paginate(10);
        $impresorasc = Impresoras::with('categoria', 'lugar', 'estado')->where('activo',1)->orderBy('id')->get();
        $pcsc = Pc::with('categoria', 'lugar', 'estado')->where('activo',1)->orderBy('id')->get();
        $laptopsc = Laptops::with('categoria', 'lugar', 'estado')->where('activo',1)->orderBy('id')->get();
        $usuarios= User::orderby('name')->where('activo',1)->where('lugar_id', 0)->get();
        $categorias= CategoriasEquipos::orderby('id')->get();
        $sucursales= Sucursal::orderby('id')->where('activo', 1)->get();
        $estados = EstadosEquipos::orderby('id')->get();

        $query_totales = collect();
        $query_buenos = collect();
        $query_danados = collect();
        $query_nouso = collect();

        $query_totales = $query_totales->merge($impresorasc)
                                        ->merge($pcsc)
                                       ->merge($laptopsc)
                                       ;

        $equipostotales = count($query_totales);


        $query_buenos = $query_buenos->merge($impresorasc->where('estado_id', 1))
                                     ->merge($pcsc->where('estado_id',1))
                                     ->merge($laptopsc->where('estado_id',1))
                                     ;

        $equiposbuenos = count($query_buenos);

        $query_danados = $query_danados->merge($impresorasc->where('estado_id', 2))
                                     ->merge($pcsc->where('estado_id',2))
                                     ->merge($laptopsc->where('estado_id',2))
                                     ;

        $equiposdanados = count($query_danados);

        $query_nouso = $query_nouso->merge($impresorasc->where('estado_id', 4))
                                     ->merge($pcsc->where('estado_id',4))
                                     ->merge($laptopsc->where('estado_id',4))
                                     ;

        $equiposnouso = count($query_nouso);
        
        

        return view('equipos.equiposgeneral', compact('impresoras', 'pcs', 'laptops', 'equipostotales', 'equiposbuenos', 'equiposdanados', 
                                                     'equiposnouso', 'query_totales', 'sucursales', 'estados', 'categorias',
                                                    'usuarios'));
    }


    public function crear($valor){
        

        $tipo = $valor;
        $usuarios= User::orderby('name')->where('activo',1)->get();
        $categorias= CategoriasEquipos::orderby('id')->get();
        $sucursales= Sucursal::orderby('id')->where('activo', 1)->get();
        $estados = EstadosEquipos::orderby('id')->get();

        
        
        return view('equipos.create', compact('tipo', 'usuarios', 'sucursales', 'categorias', 'estados'));
    }

    public function misequipos($id){
        $usuario = User::findOrFail($id);
        if($usuario->lugar_id!=0){
            $suc= $usuario->lugar_id;
            $pcs = Pc::where('lugar_id', $suc)->orWhere('userid', $id)->where('activo',1)->with('lugar', 'categoria', 'estado')->paginate(10);
            $laptops = Laptops::where('lugar_id', $suc)->orWhere('userid', $id)->where('activo',1)->paginate(10);
            $impresoras = Impresoras::where('lugar_id', $suc)->orWhere('userid', $id)->where('activo',1)->paginate(10);
            $estados = EstadosEquipos::orderBy('id')->get();
            $sucursales = Sucursal::orderBy('id')->where('activo', 1)->get();

            return view('equipos.misequipos', compact('pcs', 'laptops', 'impresoras', 'estados', 'sucursales'));
        }else{
            $pcs = Pc::where('userid', $id)->where('activo',1)->with('lugar', 'categoria', 'estado')->paginate(10);
            $laptops = Laptops::where('userid', $id)->where('activo',1)->paginate(10);
            $impresoras = Impresoras::where('userid', $id)->where('activo',1)->paginate(10);
            $estados = EstadosEquipos::orderBy('id')->get();
            $sucursales = Sucursal::orderBy('id')->where('activo', 1)->get();

            return view('equipos.misequipos', compact('pcs', 'laptops', 'impresoras', 'estados', 'sucursales'));
        }
    }
    

    public function datos($id, $tipo){
        if($tipo ==1 ){
            $equipo = Pc::where('id', $id)->with('lugar', 'categoria', 'estado')->get();
        }else if($tipo ==2 ){
            $equipo = Laptops::where('id', $id)->with('lugar', 'categoria', 'estado')->get();
        }else if($tipo ==3 ){
            $equipo = Impresoras::where('id', $id)->with('lugar', 'categoria', 'estado')->get();
        }

        return response()->json($equipo);
    }


    public function quitar(Request $request, $id, $cate){
        if($cate==1){
            $pc = Pc::findOrFail($id);
            $pc->lugar_id = $request->lugar;
            $pc->userid = null;
            $pc->save();

            return response()->json(['message'=>'sucursal quitada']);
        }else if($cate==2){
            $laptop = Laptops::findOrFail($id);
            $laptop->lugar_id = $request->lugar;
            $laptop->userid = null;
            $laptop->save();

            return response()->json(['message'=>'sucursal quitada']);

        }else if($cate==3){
            $impresora = Impresoras::findOrFail($id);
            $impresora->lugar_id = $request->lugar;
            $impresora->userid = null;
            $impresora->save();

            return response()->json(['message'=>'sucursal quitada']);
        }

    }

    

    public function asignar(Request $request, $id, $cate){
        if($cate==1){
            $pc = Pc::findOrFail($id);
            $pc->lugar_id = $request->sucursal;

            $pc->save();
            return response()->json(['message'=>'sucursal asignada']);
        }else if($cate==2){
            $laptop = Laptops::findOrFail($id);
            $laptop->lugar_id = $request->sucursal;

            $laptop->save();
            return response()->json(['message'=>'sucursal asignada']);

        }else if($cate==3){
            $impresora = Impresoras::findOrFail($id);
            $impresora->lugar_id = $request->sucursal;

            $impresora->save();
            return response()->json(['message'=>'sucursal asignada']);
        }
    }


    public function asignarusuario(Request $request){
        if($request->type==1){
            $pc = pc::findOrFail($request->id);
            $pc->userid = $request->usuario;
            $pc->save();
            return response()->json(['message'=>'usuario asignado']);
        }else if($request->type==2){
            $laptop = Laptops::findOrFail($request->id);
            $laptop->userid = $request->usuario;
            $laptop->save();
            return response()->json(['message'=>'usuario asignado']);
        }else if($request->type==3){
            $impresora = Impresoras::findOrFail($request->id);
            $impresora->userid = $request->usuario;
            $impresora->save();
            return response()->json(['message'=>'usuario asignado']);
        }
    }

    public function update(Request $request, $id, $cate){
        if($cate==1){
            $pc = Pc::findOrFail($id);
            $pc->codigo = $request->codigo;
            $pc->lugar_id = $request->lugar;
            $pc->categoria_id = $request->categoria;
            $pc->marca = $request->marca;
            $pc->modelo = $request->modelo;
            $pc->procesador = $request->procesador;
            $pc->ram = $request->ram;
            $pc->almacenamiento = $request->HDD;
            $pc->descripcion = $request->descripcion;
            $pc->estado_id = $request->estado;
            $pc->save();

            return response()->json(['message' => 'Equipo actualizado exitosamente']);
        }else if($cate==2){
            $laptop = Laptops::findOrFail($id);
            $laptop->codigo = $request->codigo;
            $laptop->lugar_id = $request->lugar;
            $laptop->categoria_id = $request->categoria;
            $laptop->marca = $request->marca;
            $laptop->modelo = $request->modelo;
            $laptop->procesador = $request->procesador;
            $laptop->ram = $request->ram;
            $laptop->almacenamiento = $request->HDD;
            $laptop->descripcion = $request->descripcion;
            $laptop->estado_id = $request->estado;
            $laptop->save();
    
            return response()->json(['message' => 'Equipo actualizado exitosamente']);
        }else{
            $impresora = Impresoras::findOrFail($id);
            $impresora->codigo = $request->codigo;
            $impresora->lugar_id = $request->lugar;
            $impresora->categoria_id = $request->categoria;
            $impresora->marca = $request->marca;
            $impresora->modelo = $request->modelo;
            $impresora->descripcion = $request->descripcion;
            $impresora->estado_id = $request->estado;
            $impresora->save();
    
            return response()->json(['message' => 'Equipo actualizado exitosamente']);
        }
    }

    public function store(Request $request){
        if($request->tipo ==1){
            $pc = new PcController;
            $pc->store();
            return response()->json(['message' => 'equipo registrado!']);   
        }else if($request->tipo ==2){
            $laptop = new LaptopController;
            $laptop->store();
            return response()->json(['message' => 'equipo registrado!']);   
        }else{
            $impresora = new ImpresorasController;
            $impresora->store();
            return response()->json(['message' => 'equipo registrado!']);   
        }
    }

    public function eliminar($id, $cate){
        if($cate==1){
            $pc = Pc::findOrFail($id);
            $pc->activo=0;
            $pc->save();

            return response()->json(['message' => 'registro borrado']);
        }else if($cate==2){
            $laptop = Laptops::findOrFail($id);
            $laptop->activo=0;
            $laptop->save();

            return response()->json(['message' => 'registro borrado']);
        }else{
            $impresora = Impresoras::findOrFail($id);
            $impresora->activo=0;
            $impresora->save();

            return response()->json(['message' => 'registro borrado']);
        }
    }


    public function filtros(Request $request){

        $sucursal = $request->sucursal;
        $estado = $request->estado;
        $tipo =  $request->tipo;
        $tipoequipo= $request->tipoequipo;

        $querypc =  Pc::with('categoria', 'lugar', 'estado')->where('activo',1)->OrderBy('id');
        $querylaptop =  Laptops::with('categoria', 'lugar', 'estado')->where('activo',1)->OrderBy('id');
        $queryimpresora =  Impresoras::with('categoria', 'lugar', 'estado')->where('activo',1)->OrderBy('id');

        if($sucursal != 0){
            $querypc->where('lugar_id', $sucursal);
            $querylaptop->where('lugar_id', $sucursal);
            $queryimpresora->where('lugar_id', $sucursal);
        }
        if($estado != 0){
            $querypc->where('estado_id', $estado);
            $querylaptop->where('estado_id', $estado);
            $queryimpresora->where('estado_id', $estado);
            
        }

        if($tipo == 'excel'){

            $equipos = collect();

            if($tipoequipo==0){
                $equipos = $equipos->merge($querypc->get())
                               ->merge($querylaptop->get())
                               ->merge($queryimpresora->get());
            }if($tipoequipo==1){
                $equipos = $equipos->merge($querypc->get());
            }if($tipoequipo==2){
                $equipos = $equipos->merge($querylaptop->get());
            }if($tipoequipo==3){
                $equipos = $equipos->merge($queryimpresora->get());
            }
            
            
            return Excel::download(new EquiposExport($equipos, $tipoequipo), 'reportes_equipos.xlsx');

        }else{
            $pcs = $querypc->orderBy('created_at', 'desc')->paginate(10)->appends([
                'sucursal' => $request->sucursal,
                'estado'=> $request->estado,
            ]);
            $laptops = $querylaptop->orderBy('created_at', 'desc')->paginate(10)->appends([
                'sucursal' => $request->sucursal,
                'estado'=> $request->estado,
            ]);
            $impresoras = $queryimpresora->orderBy('created_at', 'desc')->paginate(10)->appends([
                'sucursal' => $request->sucursal,
                'estado'=> $request->estado,
            ]);
        }


        $impresorasc = Impresoras::with('categoria', 'lugar', 'estado')->where('activo',1)->orderBy('id')->get();
        $pcsc = Pc::with('categoria', 'lugar', 'estado')->where('activo',1)->orderBy('id')->get();
        $laptopsc = Laptops::with('categoria', 'lugar', 'estado')->where('activo',1)->orderBy('id')->get();
        $usuarios= User::orderby('name')->where('activo',1)->get();
        $categorias= CategoriasEquipos::orderby('id')->get();
        $sucursales= Sucursal::orderby('id')->where('activo', 1)->get();
        $estados = EstadosEquipos::orderby('id')->get();

        $query_totales = collect();
        $query_buenos = collect();
        $query_danados = collect();
        $query_nouso = collect();

        $query_totales = $query_totales->merge($impresorasc)
                                        ->merge($pcsc)
                                       ->merge($laptopsc)
                                       ;

        $equipostotales = count($query_totales);


        $query_buenos = $query_buenos->merge($impresorasc->where('estado_id', 1))
                                     ->merge($pcsc->where('estado_id',1))
                                     ->merge($laptopsc->where('estado_id',1))
                                     ;

        $equiposbuenos = count($query_buenos);

        $query_danados = $query_danados->merge($impresorasc->where('estado_id', 2))
                                     ->merge($pcsc->where('estado_id',2))
                                     ->merge($laptopsc->where('estado_id',2))
                                     ;

        $equiposdanados = count($query_danados);

        $query_nouso = $query_nouso->merge($impresorasc->where('estado_id', 4))
                                     ->merge($pcsc->where('estado_id',4))
                                     ->merge($laptopsc->where('estado_id',4))
                                     ;

        $equiposnouso = count($query_nouso);

        if($request->tipo == 'excel'){
            
        }else{
            return view('equipos.equiposgeneral', compact('impresoras', 'pcs', 'laptops', 'equipostotales', 'equiposbuenos', 'equiposdanados', 
                'equiposnouso', 'query_totales', 'sucursales', 'estados', 'categorias',
                'usuarios'));
        }
    }

}
