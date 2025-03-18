<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        if(Auth::user()->roleid==1){
            $usuarios = User::with('sucursal')->where('activo',1)->paginate(10);
        }else if(Auth::user()->roleid==2){
            $usuarios = User::with('sucursal')->where('roleid', 3)->where('activo',1)->paginate(8);
        }
        
        $sucursal = Sucursal::orderBy('id')->where('activo', 1)->get();
        $roles = Roles::orderBy('id')->get();
        $sucursal2 = Sucursal::where('id', '!=', 1)->where('activo', 1)->get();

        return view('usuario.index', compact('usuarios', 'sucursal', 'roles', 'sucursal2'));
    }

    public function store(){
        $request = Request();

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->lastname = $request->lastname;
        $usuario->number = $request->number;
        $usuario->lugar_id = $request->sucursal;
        $usuario->roleid = $request->roleid;
        $usuario->password = Hash::make($request->password);
        $usuario->email = $request->email;
        $usuario->status = 1;
        $usuario->activo=1;
        $usuario->save();
        return to_route('usuario.index');
    }

    public function find($id){
        $datos = User::with('sucursal', 'rol')->where('id', $id)->get();
        $datos->makeVisible(['password']);

        return response()->json($datos);
    }

    public function update(Request $request, $id){
        $usuario = User::findOrFail($id);
        $usuario->name = $request->name;
        $usuario->lastname = $request->lastname;
        $usuario->number = $request->number;
        $usuario->email = $request->email;
        $usuario->roleid = $request->roleid;
        $usuario->lugar_id = $request->sucursal;

        $usuario->save();
        return to_route('usuario.index');


    }

    public function delete($id){
        $usuario = User::findOrFail($id);
        
        $usuario->activo=0;
        $usuario->save();
        return response()->json(['message' => 'usuario borrado']);
    }

    public function status($id){
        $usuario = User::findOrFail($id);
        if($usuario->status ==1){
            $usuario->status= 0;
        }else{
            $usuario->status= 1;
        }
        $usuario->save();
        return response()->json(['message'=>'status cambiado']);
    }

    public function datos($id){
        $usuario = User::where('id', $id)->where('activo',1)->get();

        return view('usuario.datos', compact('usuario'));
    }

    public function filtro(Request $request){
        $sucursal = $request->filtroS;
        $rol = $request->filtroR;
        if($sucursal==0 && $rol ==0){
            $usuarios = User::orderBy('id')->with('rol', 'sucursal')->where('activo',1)->get();
        }else if($sucursal != 0 && $rol ==0){
            $usuarios = User::where('lugar_id', $sucursal)->with('rol', 'sucursal')->where('activo',1)->get();
        }else if($sucursal==0 && $rol !=0){
            $usuarios = User::where('roleid', $rol)->with('rol', 'sucursal')->where('activo',1)->get();
        }else{
            $usuarios = User::where('roleid', $rol)->where('lugar_id', $sucursal)->where('activo',1)->with('rol', 'sucursal')->get();
        }

        return response($usuarios);
    }


    public function buscar(Request $request){
        $query = $request->get('query');  // Obtener el término de búsqueda

        // Buscar usuarios donde el nombre tenga alguna coincidencia con el término
        $usuarios = User::whereRaw('LOWER(descripcion) LIKE ?', ['%' . strtolower($query) . '%'])
                ->where('activo', 1)
                ->get();

        // Generar el HTML de las filas de la tabla
        $html = '';
        foreach ($usuarios as $item) {
            $html .= "
                <tr class='border-r-2 border-l-2 border-b-2 border-gray-200 odd:bg-white even:bg-gray-100'>
                    <td hidden id='id'>{$item->id}</td>
                    <td class='p-4 hidden md:table-cell'>{$item->rol->nombre}</td>
                    <td class='p-4 hidden md:table-cell' nombre='tdnombre'>{$item->descripcion}</td>
                    <td class='p-4 md:hidden' nombre='tdnombre' >{$item->descripcion} <br>".  ($item->sucursal?->nombre?? 'Sin sucursal')."</td>
                    <td class='p-4 hidden md:table-cell' correo='tdcorreo'>{$item->email}</td>
                    <td class='p-4 hidden md:table-cell' sucursal='sucursal'>" . ($item->sucursal ? $item->sucursal->nombre : 'Sin sucursal') . "</td>
                    <td class='text-right flex justify-between px-2 pt-[20px] md:ml-20 md:max-w-[200px]'>
                        <button class='bi btn btn-warning btn-sm md:w-10 md:h-10 w-8 h-8' id='verdatos' data-type='usuario'>
                            <i class='bi bi-pencil-square'></i>
                        </button>
                       ";
        
            // Verificar el estado y agregar los botones correspondientes
            if ($item->status == 0) {
                $html .= "
                    <button type='button' class='status0 btn btn-outline-dark btn-sm w-8 h-8 md:w-16 md:h-10' id=''>
                        <i class='bi bi-power'></i>
                    </button>
                    <button type='button' class='status1 hidden btn btn-outline-info btn-sm w-8 h-8 md:w-16 md:h-10' id=''>
                        <i class='bi bi-power'></i>
                    </button>";
            }
        
            if ($item->status == 1) {
                $html .= "
                    <button type='button' class='status1 btn btn-outline-info btn-sm w-8 h-8 md:w-16 md:h-10' id=''>
                                    <i class='bi bi-power'></i>
                                </button>
                                <button type='button' class='status0 hidden btn btn-outline-dark btn-sm w-8 h-8 md:w-16 md:h-10' id=''>
                                    <i class='bi bi-power'></i>
                                </button>";
            }

            $html .=" <button class='btn btn-danger hidden btn-sm md:w-10 md:h-10 w-8 h-8' id='borrar'>
                                <i class='bi bi-trash'></i>
                            </button>";
        
            $html .= "</td></tr>";
        }

        return response()->json($html);
    }

    public function usuarios(){
        $usuarios = User::orderBy('id')->where('activo',1)->get();

        $html = '';
        foreach ($usuarios as $item) {
            $html .= "
                <tr class='border-r-2 border-l-2 border-b-2 border-gray-200 odd:bg-white even:bg-gray-100'>
                    <td hidden id='id'>{$item->id}</td>
                    <td class='p-4 hidden md:table-cell'>{$item->rol->nombre}</td>
                    <td class='p-4 hidden md:table-cell' nombre='tdnombre'>{$item->descripcion}</td>
                    <td class='p-4 md:hidden' nombre='tdnombre' >{$item->descripcion} <br>".  ($item->sucursal?->nombre?? 'Sin sucursal')."</td>
                    <td class='p-4 hidden md:table-cell' correo='tdcorreo'>{$item->email}</td>
                    <td class='p-4 hidden md:table-cell' sucursal='sucursal'>" . ($item->sucursal ? $item->sucursal->nombre : 'Sin sucursal') . "</td>
                    <td class='text-right flex justify-between px-2 pt-[20px] md:ml-20 md:max-w-[200px]'>
                        <button class='bi btn btn-warning btn-sm md:w-10 md:h-10 w-8 h-8' id='verdatos' data-type='usuario'>
                            <i class='bi bi-pencil-square'></i>
                        </button>
                       ";
        
            // Verificar el estado y agregar los botones correspondientes
            if ($item->status == 0) {
                $html .= "
                    <button type='button' class='status0 btn btn-outline-dark btn-sm w-8 h-8 md:w-16 md:h-10' id=''>
                        <i class='bi bi-power'></i>
                    </button>
                    <button type='button' class='status1 hidden btn btn-outline-info btn-sm w-8 h-8 md:w-16 md:h-10' id=''>
                        <i class='bi bi-power'></i>
                    </button>";
            }
        
            if ($item->status == 1) {
                $html .= "
                    <button type='button' class='status1 btn btn-outline-info btn-sm w-8 h-8 md:w-16 md:h-10' id=''>
                                    <i class='bi bi-power'></i>
                                </button>
                                <button type='button' class='status0 hidden btn btn-outline-dark btn-sm w-8 h-8 md:w-16 md:h-10' id=''>
                                    <i class='bi bi-power'></i>
                                </button>";
            }

            $html .=" <button class='btn btn-danger hidden btn-sm md:w-10 md:h-10 w-8 h-8' id='borrar'>
                                <i class='bi bi-trash'></i>
                            </button>";
        
            $html .= "</td></tr>";
        }

        return response()->json($html);
    }

    public function cambiarol(Request $request){
        $usuario = User::where('id', $request->id)->get();
        $usuario->roleid = $request->roleid;
        $usuario->save();

        return response()->json(['message', 'rol actualizado']);
    }



}
