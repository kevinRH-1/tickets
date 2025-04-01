@extends('layouts.app')

@section('content')

    <style>
        /* Animation for modal */
        .modal-enter {
        transform: translateY(20px);
        opacity: 0;
        transition: transform 0.3s ease, opacity 0.3s ease;
        }
        .modal-enter-active {
        transform: translateY(0);
        opacity: 1;
        }
    </style>


    <div class="w-11/12  bg-white shadow-lg rounded-lg flex items-center justify-between p-4 m-auto border-1 border-red-600">

        <h1></h1>

        <!-- Título en el centro -->
        <h1 class="text-lg font-semibold text-gray-800 text-center">
            Gestion de usuarios
        </h1>

        <!-- Botón derecho -->
        <button class="btn btn-primary hidden btn-sm mt-1 md:hidden" data-bs-toggle="modal" data-bs-target="#registration-modal">+</button>
        <div class=" md:block"></div>

        
    </div>

    <div class="container-fluid">
        <div class="card border-dark shadow my-5">
            <div class="card-body p-2">
                <div class="flex justify-between mb-4">
                    <div class="md:flex grid grid-cols-4 gap-4 p-4 w-full">
                        <h1 class="mt-[11px] text-xl hidden md:block">filtrar: </h1>
                        <select name="filtrosucursal" id="filtrosucursal" class="w-[100px] md:w-[200px] h-[50px] rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm col-span-2" onchange="filtro()">
                            <option value="0">Todas las sucursales</option>
                            @foreach($sucursal2 as $item)
                                <option value="{{$item->id}}">{{$item->nombre}}</option>
                            @endforeach
                        </select>
                        
                        <select name="filtrorol" id="filtrorol" class="w-[100px] md:w-[200px] h-[50px] rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm col-span-2" onchange="filtro()">
                            <option value="0">Todos los roles</option>
                            @foreach($roles as $item)
                                <option value="{{$item->id}}">{{$item->nombre}}</option>
                            @endforeach
                        </select>
                        <input type="text" id="search" placeholder="Buscar por nombre..." class="form-control md:w-[300px]  h-[50px] rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm col-span-4">
                        

                    </div>
                    

                    <button class="btn hidden btn-primary btn-sm mb-4  md:h-[50px] mt-4 mr-8" data-bs-toggle="modal" data-bs-target="#registration-modal"><i
                            class="bi bi-person-plus-fill"></i>
                        Crear Usuario
                    </button>


                </div>
                <div class="overflow-x-auto md:p-8">
                    <table class="table-auto w-full  border-gray-200  rounded-t-lg " id="tablaUsuariosDataTable">
                        <thead class="bg-gray-800 text-white rounded-t-lg">
                            <tr>
                                <th class="p-4 text-left rounded-tl-lg hidden md:table-cell">Rol</th>
                                <th class="text-left p-4 rounded-tl-lg md:rounded-none">Nombre</th>
                                <th class="text-left p-4 hidden md:table-cell">Correo</th>
                                <th class="text-left p-4 hidden md:table-cell">Sucursal</th>
                                <th class="text-center p-4 rounded-tr-lg ">acciones</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($usuarios as $item)
                                <tr class="border-r-2 border-l-2 border-b-2 border-gray-200 odd:bg-white even:bg-gray-100">
                                    <td hidden id="id">{{ $item->id }}</td>
                                    <td class="p-4 hidden md:table-cell" >{{ $item->rol->nombre }}</td>
                                    <td class="p-4 hidden md:table-cell" nombre="tdnombre" >{{ $item->descripcion }}</td>
                                    <td class="p-4 md:hidden" nombre="tdnombre" >{{ $item->descripcion }} <br> {{$item->sucursal?->nombre?? 'Sin sucursal'}}</td>
                                    <td class="p-4 hidden md:table-cell" correo="tdcorreo">{{ $item->email }}</td>
                                    <td class="p-4 hidden md:table-cell" sucursal="sucursal">{{ $item->sucursal?->nombre ?? 'Sin sucursal' }}</td>
                                    <td class="text-right flex justify-between md:pt-[13px] pt-[20px]">
                                        <button class="bi btn btn-warning btn-sm md:w-10 md:h-10 w-8 h-8" id="verdatos"
                                            data-type="usuario"><i class="bi bi-pencil-square"></i>
                                        </button>
                                        {{-- <button class="btn btn-success btn-sm w-10 h-10" data-bs-toggle="modal"
                                            data-bs-target="#modalResetPassword" onclick="agregaridUsuarioReset()"><i
                                                class="bi bi-arrow-clockwise"></i>
                                        </button> --}}
                                        {{--  --}}
                                        @if ($item->status == 0)
                                            <button type="button" class="status0 btn btn-outline-dark btn-sm w-8 h-8 md:w-16 md:h-10"
                                                id=""><i class="bi bi-power"></i>
                                            </button>
                                            <button type="button" class="status1 hidden btn btn-outline-info btn-sm w-8 h-8 md:w-16 md:h-10"
                                                id=""><i class="bi bi-power"></i>
                                            </button>
                                        @endif

                                        @if ($item->status == 1)
                                            <button type="button" class="status1 btn btn-outline-info btn-sm w-8 h-8 md:w-16 md:h-10"
                                                id=""><i class="bi bi-power"></i>
                                            </button>
                                            <button type="button" class="status0 hidden btn btn-outline-dark btn-sm w-8 h-8 md:w-16 md:h-10"
                                                id=""><i class="bi bi-power"></i>
                                            </button>
                                        @endif
                                        <button class="btn hidden btn-danger btn-sm md:w-10 md:h-10 w-8 h-8" id="borrar"><i
                                                class="bi bi-trash"></i>
                                        </button>

                                        <form id="" method="POST" onsubmit="return ">
                                            <input type="text" name="idUsuarioEliminar" hidden value="">
                                            <input type="text" name="idPersonaEliminar" hidden value="">
                                        </form>
                                    </td>




                                    <form id="frmActualizarUsuario" method="POST">
                                        @csrf
                                        <!-- Modal -->
                                        <div class="modal fade pt-[10%] md:pt-[1%] md:!mt-[2%]" id="ActualisarUsuarios" 
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5 text-center w-[98%] m-auto" id="exampleModalLabel">Datos del
                                                                Usuario</h1>
                                                        <button type="button" class="btn-close btn-sm"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="border-2 border-b-gray-300 justify-around py-2">

                                                        <h1 class="text-center">tickets del usuario</h1>

                                                        <div class="flex justify-around mt-2">
                                                            <label for="cantidad_30d" id="cantidad_30d"></label>
                                                            <label for="cantidad_24h" id="cantidad_24h"></label>
                                                        </div>

                                                        
                                                    </div>
                                                    <div class="modal-body justify-center">
                                                        
                                            
                                                        
                                                        {{-- <div class="flex justify-around row"> --}}

                                                            <div class="col-sm-6 justify-center w-3/4 mx-auto">
                                                                <label for="first-name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                                                <input type="text" id="nombre" class="nombre mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Enter your first name" readonly>
                                                                <p id="nombre-error" class="text-red-500 text-sm hidden">El nombre es obligatorio</p>
                                                            </div>

                                                            <div class="col-sm-6 justify-center mt-4 w-3/4 mx-auto">
                                                                <label for="email" class="block text-sm font-medium text-gray-700">Correo</label>
                                                                <input type="email" id="correo" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm"  readonly>
                                                                <p id="correo-error" class="text-red-500 text-sm hidden">El formato del correo es invalido</p>
                                                            </div>

                                                            

                                                        {{-- </div> --}}
                                        
                                            

                                                        {{-- <div class="flex justify-around row mt-8"> --}}
                                                    
                                                            

                                                            <input type="text" id="idusuario" name="idusuario" hidden>
                                                        
                                                            <div class="col-sm-6 justify-center mt-4 w-3/4 mx-auto">
                                                                <label for="password" class="block text-sm font-medium text-gray-700">numero celular</label>
                                                                <input type="text" id="numero" maxlength="11" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm"  readonly>
                                                                <p id="numero-error" class="text-red-500 text-sm hidden">formato de numero invalido</p>
                                                            </div>

                                                            <div class="col-sm-6 justify-center mt-4 w-3/4 mx-auto">
                                                                <label for="branch" class="block text-sm font-medium text-gray-700">Sucursal/Departamento</label>
                                                                <select name="lugar" id="lugar"  class="mt-1 block w-full h-12 px-2  rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" readonly>
                                                                    @foreach ($sucursal as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="text" id="lugarinput" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" readonly>
                                                                <p id="sucursal-error" class="text-red-500 text-sm hidden">Seleccione una sucursal o departamento</p>
                                                            </div>
                                                        {{-- </div> --}}
                                        
                                                        <div class="row flex justify-around mt-8">
                                                            <div class="col-sm-4  md!:w-1/4 w-3/4 mx-auto flex justify-between">
                                                                <div id="div-rol">
                                                                    <label for="role" class="block text-sm font-medium text-gray-700 text-center">Rol</label>
                                                                    <select name="rol" id="rol"  class="mt-1 hidden w-full h-12   rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" readonly>
                                                                        required>
                                                                        @foreach ($roles as $item)
                                                                            <option value="{{ $item->id }}">
                                                                                {{ $item->nombre }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                    <input type="text" id="rolinput" class="mt-1 block md:!w-full w-3/4 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" readonly>
                                                                    <p id="rol-error" class="text-red-500 text-sm hidden">Seleccione un rol</p>
                                                                </div>
                                                                <div>
                                                                    <button id="cambiarolb" class="h-[40px] w-[100px] bg-green-700 text-white rounded-md mt-4" onclick="cambiarol(event)">Cambiar rol</button>
                                                                    <button id="cambiarolbc" class="h-[40px] w-[100px] hidden bg-blue-700 text-white rounded-md mt-4" onclick="confirmrol(event)">Confirmar</button>
                                                                </div>


                                                            </div>
                                                            <button class="btn btn-primary mt-6 w-2/4 mx-auto" onclick="verhistorial(event)">ver historial</button>

                                                        </div>

                                                        <div>
                                                            
                                                        </div>
                                                                </div>
                                                                <div class="modal-footer hidden flex justify-around">
                                                                    <button class="btn btn-success btn-sm"
                                                                        id="reset">cambiar contraseña</button>
                                                                    <button class="btn hidden btn-primary btn-sm"
                                                                        id="actualizar">Actualizar</button>
                                                                    {{-- <button class="btn btn-danger btn-sm"
                                                                        id="borrar">Borrar</button> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                                    </form>

                                    <div id="confirmModal" tabindex="1" class="fixed inset-0 z-10 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
                                        <div class="bg-white rounded-lg shadow-lg p-6 w-80">
                                            <h2 class="text-lg font-semibold text-center">¿Estás seguro?</h2>
                                            <p class="text-sm text-gray-600 text-center mt-2">Esta acción eliminará este usuario.</p>
                                            <div class="mt-4 w-[99%] m-auto text-center">
                                                <label for="bnombre" id="bnombre" class="text-center "></label>
                                                <br>
                                                <label for="bcorreo" id="bcorreo" class="text-center mt-2"></label>
                                                <br>
                                                <label for="bsucursal" id="bsucursal" class="text-center mt-2"></label>
                                            </div>
                                            <div class="flex justify-between mt-8">
                                                <button id="confirmYes" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                                    Sí, eliminar
                                                </button>
                                                <button id="confirmNo" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="historialmodal" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                                        <div class="modal-dialog modal-lg max-h-[600px] overflow-y-auto">
                                          <div class="modal-content p-4">
                                            <div class="modal-header flex justify-center">
                                              <h1 class="modal-title fs-5 text-semibold text-4xl text-red-600" id="exampleModalLabel">Historial del usuario</h1>
                                            </div>
                                            <div class="modal-body">
                                              <div id="divfiltro" class="flex w-full justify-end mb-20">
                                                <label for="filtro" class="pt-[10px] mr-2">Buscar por fecha: </label>
                                                <input type="date" id="fecha1" class="border-red-600 rounded-md">
                                                <span class="text-lg px-4">_</span>
                                                <input type="date" id="fecha2" class="border-red-600 rounded-md">
                                                <button class="btn btn-success ml-4" onclick="verhistorial(event)">buscar</button>
                                            </div>
                      
                                            <div id="divhistorial">
                      
                                            </div>
                      
                                            </div>
                                          </div>
                                        </div>
                                    </div>

                                    

                                    <div class="modal fade mt-[20%]" id="confirmregis" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content p-4">
                                              <h2 class="text-lg font-semibold text-center">¿Estás seguro?</h2>
                                              <p class="text-sm text-gray-600 text-center mt-2" id="texto">Esta acción registrara este usuario.</p>
                                              <div class="mt-4 w-[99%] m-auto text-center">
                                                    <label for="rnombre" id="rnombre" class="text-center "></label>
                                                    <br>
                                                    <label for="rcorreo" id="rcorreo" class="text-center mt-2"></label>
                                                    <br>
                                                    <label for="rsucursal" id="rsucursal" class="text-center mt-2"></label>
                                              </div>
                                              <div class="flex justify-between mt-8">
                                                  <button id="confirmYesr" class="btn btn-primary text-white px-4 py-2 rounded">
                                                      Sí, registrar
                                                  </button>
                                                  <button id="confirmNor" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                                                      Cancelar
                                                  </button>
                                              </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade mt-[20%] h-[200px]" id="modalmensaje" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body text-center py-9">
                                                    <h1 id="mensaje"></h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </tr>
                            @endforeach


                            <div class="modal fade justify-center py-4 md:pl-[12%] max-h-[900px]" id="registration-modal" tabindex="-1" aria-labelledby="nuevoModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="flex justify-between items-center border-b p-4">
                                            <h2 class="text-xl font-semibold">Registrar usuario nuevo</h2>
                                            <button class="text-gray-500 hover:text-gray-700"
                                            data-bs-toggle="modal" data-bs-target="#registration-modal">
                                                &times;
                                            </button>
                                        </div>
    
                                        <!-- Modal body -->
                                        <div class="p-6">
                                            <form id="registration-form" class="">
                                                <div class="w-[98%] m-auto">
                                                    <label for="first-name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                                    <input type="text" id="nombre" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Ingrese su nombre">
                                                    <p id="nombre-error" class="text-red-500 text-sm hidden">El nombre es obligatorio!</p>
                                                </div>
                                            
                                                <div class="w-[98%] m-auto my-4">
                                                    <label for="last-name" class="block text-sm font-medium text-gray-700">Apellido</label>
                                                    <input type="text" id="apellido" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Ingrese su apellido">
                                                    <p id="apellido-error" class="text-red-500 text-sm hidden">El apellido es requerido</p>
                                                </div>
    
                                                <div class="w-[98%] m-auto my-4">
                                                    <label for="numero" class="block text-sm font-medium text-gray-700">numero celular</label>
                                                    <input type="text" id="numero" maxlength="15" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Ingrese su numero de telefono" >
                                                    <p id="numero-error" class="text-red-500 text-sm hidden">formato de numero invalido</p>
                                                </div>
                                            
                                                <div class="w-[98%] m-auto my-4">
                                                    <label for="email" class="block text-sm font-medium text-gray-700">Correo</label>
                                                    <input type="email" id="correo" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Ingrese su correo">
                                                    <p id="correo-error" class="text-red-500 text-sm hidden">formato de correo invalido</p>
                                                </div>
                                            
                                                <div class="w-[98%] m-auto my-4">
                                                    <label for="password" class="block text-sm font-medium text-gray-700">contraseña</label>
                                                    <input type="password" id="contrasena" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Ingrese su contraseña">
                                                    <p id="contrasena-error" class="text-red-500 text-sm hidden">La contraseña debe tener al menos 8 caracteres</p>
                                                </div>
                                            
                                                <div class="w-[98%] m-auto my-4">
                                                    <label for="password" class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
                                                    <input type="password" id="confirmar" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Ingrese su contraseña nuevamente">
                                                    <p id="confirmar-error" class="text-red-500 text-sm hidden">Las contraseñas no coinciden</p>
                                                </div>
    
                                                <div class="w-[98%] m-auto my-4">
                                                    <label for="role" class="block text-sm font-medium text-gray-700 text-center">Rol</label>
                                                    
                                                    <select name="rol" id="rol" class="mt-1 block w-full h-12 px-2  rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" required onchange="sucursales()">
                                                        <option value="0" disabled selected>seleccionar rol</option>
                                                        @foreach ($roles as $item)
                                                            <option value="{{ $item->id }}">
                                                                {{ $item->nombre }}</option>
                                                        @endforeach
    
                                                    </select>
                                                    <p id="rol-error" class="text-red-500 text-sm hidden">Selecciona un rol.</p>
                                                </div>
    
                                                <div class="w-[98%] m-auto my-4" id="divsucursal" hidden>
                                                    <label for="branch" class="block text-sm font-medium text-gray-700 text-center">Sucursal/departamento</label>
                                                    <select id="sucursal" class="mt-1 block w-full h-12 px-2 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                                        @foreach($sucursal as $item)
                                                            <option value="{{$item->id}}">{{$item->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                    <p id="sucursal-error" class="text-red-500 text-sm hidden">seleccione una sucursal o departamento</p>
                                                </div>
                                            
                                                
                                                <div class="flex justify-end border-t p-4">
                                                    <button class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 mr-2" 
                                                        onclick="document.getElementById('registration-modal').classList.add('hidden')
                                                        event.preventDefault()" data-bs-toggle="modal" data-bs-target="#registration-modal">
                                                        Cancelar
                                                    </button>
                                                    <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                                                        type="submit" id="registrar" form="registration-form" >
                                                        Registrar
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </tbody>
                    </table>
                    <div class="mt-4 p-2">
                        {{ $usuarios->links() }}
                    </div>
                </div>
                </p>
            </div>
        </div>
    </div>
@endsection

<script src="../resources/jquery/jquery-3.6.0.min.js"></script>

<script>

    let historial_ejec =0;

    document.addEventListener('DOMContentLoaded', function () {
        // Seleccionar la tabla
        const tabla = document.getElementById('tablaUsuariosDataTable');

        // Delegar eventos a los botones dentro de la tabla
        tabla.addEventListener('click', function (event) {
            const target = event.target;

            // Si se hace clic en un botón con clase 'status0'
            if (target.classList.contains('status0')) {
                const parent = target.closest('td');
                const botonDesactivar = parent.querySelector('.status1');
                target.classList.add('hidden'); // Ocultar botón 'Activar'
                botonDesactivar.classList.remove('hidden'); // Mostrar botón 'Desactivar'
                console.log('Activado');
                // Obtener el ID de la fila
                const fila = target.closest('tr'); // Encuentra la fila padre
                const id = fila.querySelector('td[id]').textContent.trim(); // Encuentra el <td> con el id y obtiene su texto
                console.log('ID:', id);

                // Realizar la solicitud fetch
                const url = "usuarios/status/" + id;
                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Respuesta del servidor:', data);
                    })
                    .catch(error => console.error('Error al realizar la solicitud:', error));
                }

            // Si se hace clic en un botón con clase 'status1'
            if (target.classList.contains('status1')) {
                const parent = target.closest('td');
                const botonActivar = parent.querySelector('.status0');
                target.classList.add('hidden'); // Ocultar botón 'Desactivar'
                botonActivar.classList.remove('hidden'); // Mostrar botón 'Activar'
                console.log('Desactivado');
                // Obtener el ID de la fila
                const fila = target.closest('tr'); // Encuentra la fila padre
                const id = fila.querySelector('td[id]').textContent.trim(); // Encuentra el <td> con el id y obtiene su texto
                console.log('ID:', id);

                // Realizar la solicitud fetch
                const url = "usuarios/status/" + id;
                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Respuesta del servidor:', data);
                    })
                    .catch(error => console.error('Error al realizar la solicitud:', error));
                }
        });
    });

    function sucursales(){
        const rol = $("#registration-modal #rol").val();
        if(rol === '3'){
            $("#registration-modal #divsucursal").removeAttr('hidden');
        }else{
            $("#registration-modal #divsucursal").attr('hidden', true);
        }
    }

    function validarFormulario(formulario) {
        let esValido = true;
        // console.log("#"+formulario +" #nombre")

        // Obtener los campos del formulario
        const nombre = $("#"+ formulario +" #nombre").val();
        const apellido = $("#"+ formulario +" #apellido").val();
        const correo = $("#"+ formulario +" #correo").val();
        const numero = $("#"+ formulario +" #numero").val();
        const contrasena = $("#"+ formulario +" #contrasena").val();
        const contrasena2 = $("#"+ formulario +" #confirmar").val();
        const rol = $("#"+ formulario +" #rol").val();
        // const lugar = $("#"+ formulario +" #contrasena").val();


        // Validar Nombre
        if (!nombre || nombre.trim() === "") {
            $("#"+ formulario +" #nombre-error").removeClass('hidden');
            esValido = false;
        }else{
            $("#"+ formulario +" #nombre-error").addClass('hidden');
        }

        // Validar Apellido
        if (!apellido || apellido.trim() === "") {
            $("#"+ formulario +" #apellido-error").removeClass('hidden');
            esValido = false;
        }else{
            $("#"+ formulario +" #apellido-error").addClass('hidden');
        }

        // Validar Correo
        const regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!correo || !regexCorreo.test(correo)) {
            $("#"+ formulario +" #correo-error").removeClass('hidden');
            esValido = false;
        }else{
            $("#"+ formulario +" #correo-error").addClass('hidden');
        }

        //Validar Número
        if (!numero || numero.length > 15 || isNaN(numero)) {
            $("#"+ formulario +" #numero-error").removeClass('hidden');
            esValido = false;
        }else{
            $("#"+ formulario +" #numero-error").addClass('hidden');
        }


        if (!rol || rol === '0') {
            $("#"+ formulario +" #rol-error").removeClass('hidden');
            esValido = false;
        }else{
            $("#"+ formulario +" #rol-error").addClass('hidden');
        }
        // console.log(contrasena)
        // Validar Contraseña (si aplica)
        if (formulario === 'registration-modal' ) {
            const regexContrasena = /^[A-Za-z\d]{8,}$/;
            if (!regexContrasena.test(contrasena) ||!contrasena || contrasena.trim() === "") {
                $("#"+ formulario +" #contrasena-error").removeClass('hidden');
                esValido = false;
            }else{
                $("#"+ formulario +" #contrasena-error").addClass('hidden');
            }

            if(!contrasena2 || contrasena2 === ''|| contrasena2 !== contrasena){
                $("#"+ formulario +" #confirmar-error").removeClass('hidden');
                esValido = false;
            }else{
                $("#"+ formulario +" #confirmar-error").addClass('hidden');
            }
        }

        return esValido;
    }

    function showModal() {
      const modal = document.getElementById('registration-modal');
      const modalContent = document.getElementById('modal-content');
      modal.classList.remove('hidden');
      setTimeout(() => modalContent.classList.add('modal-enter-active'), 10);
    }

    function hideModal() {
      const modal = document.getElementById('registration-modal');
      const modalContent = document.getElementById('modal-content');
      modalContent.classList.remove('modal-enter-active');
      setTimeout(() => modal.classList.add('hidden'), 300);
    }
    $(document).ready(function() {
        // Use event delegation for dynamic content
        $(document).on('click', '#verdatos', function() {
            var id = $(this).closest('tr').find('td[id]').text();
            var type = $(this).data('type');
            console.log(type);
            console.log(id);



            $.ajax({
                url: 'usuarios/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Process the returned data and display it
                    $("#ActualisarUsuarios").modal("show");
                    var datos = data[0];
                    console.log(datos);
                    // $("#modalModificarpc").modal("show");
                    $("#ActualisarUsuarios #nombre").val(datos.descripcion);
                    // $("#ActualisarUsuarios #apellido").val(datos.lastname);
                    $("#ActualisarUsuarios #correo").val(datos.email);
                    $("#ActualisarUsuarios #numero").val(datos.number);
                    $("#ActualisarUsuarios #idusuario").val(datos.id);
                    if (datos.lugar_id == null) {
                        $('#ActualisarUsuarios #lugar').val(0);
                        $("#ActualisarUsuarios #lugarinput").val('sin sucursal');
                    } else {
                        $("#ActualisarUsuarios #lugar").val(datos.lugar_id);
                        $("#ActualisarUsuarios #lugarinput").val(datos.sucursal.nombre);
                    }
                    $("#ActualisarUsuarios #rol").val(datos.roleid);
                    $("#ActualisarUsuarios #rolinput").val(datos.rol.nombre);
                    $("#ActualisarUsuarios #idUsuario").val(datos.id);
                    $("#ActualisarUsuarios #cantidad_30d").text('ultimos 30 dias: ' + datos.cantidad30d);
                    $("#ActualisarUsuarios #cantidad_24h").text('ultimas 24 horas: '+ datos.cantidad24h);

                    $("#ActualisarUsuarios #nombre").attr('readonly', true);
                    // $("#ActualisarUsuarios #apellido").attr('readonly', true);
                    $("#ActualisarUsuarios #correo").attr('readonly', true);
                    $("#ActualisarUsuarios #numero").attr('readonly', true);
                    $("#ActualisarUsuarios #rol").attr('readonly', true);
                    $("#ActualisarUsuarios #lugar").attr('readonly', true);


                    document.getElementById('lugarinput').removeAttribute('hidden');
                    document.getElementById('rolinput').removeAttribute('hidden');
                    document.getElementById('lugar').setAttribute('hidden', true);
                    $('#div-rol #rol').addClass('hidden', true);
                    $('#rolinput').removeClass('hidden');

                    $('#cambiarolb').removeClass('hidden');
                    $('#cambiarolbc').addClass('hidden', true);
                    


                    $("#ActualisarUsuarios #nombre-error").addClass('hidden');
                    $("#ActualisarUsuarios #apellido-error").addClass('hidden');
                    $("#ActualisarUsuarios #correo-error").addClass('hidden');
                    $("#ActualisarUsuarios #numero-error").addClass('hidden');
                    $("#ActualisarUsuarios #rol-error").addClass('hidden');
                    $("#ActualisarUsuarios #lugar-error").addClass('hidden');

                    historial_ejec =0;
                    $('#fecha1').val('');
                    $('#fecha2').val('');


                        const btnActualizar = document.getElementById('confirmar');
                        if(btnActualizar){
                            btnActualizar.textContent = 'actualizar';
                            btnActualizar.classList.remove('btn-success');
                            btnActualizar.classList.add('btn-primary');
                            btnActualizar.id = 'actualizar';
                            document.getElementById('reset').removeAttribute('hidden')
                            document.getElementById('borrar').removeAttribute('hidden')
                        }
                },
                error: function(xhr, status, error) {
                    // Error handling
                    $('#resultado').html('<p>Error al consultar datos.</p>');
                }
            });
        });

    });

    $(document).ready(function() {
        // Use event delegation for dynamic content
        $(document).on('click', '#confirmar', function() {
            event.preventDefault();
            const formData = {
                id: $("#ActualisarUsuarios #idusuario").val(),
                name: $("#ActualisarUsuarios #nombre").val(),
                lastname: $("#ActualisarUsuarios #apellido").val(),
                number: $("#ActualisarUsuarios #numero").val(),
                email: $("#ActualisarUsuarios #correo").val(),
                sucursal: $("#ActualisarUsuarios #lugar").val(),
                roleid: $("#ActualisarUsuarios #rol").val(),
            }

            console.log(formData);

            const formulario = "ActualisarUsuarios";
            if (validarFormulario(formulario)) {
                console.log(formData.id)
                $.ajax({
                    url: 'usuarios/update/' + formData.id,
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(response) {
                        $('#mensaje').text('el usuario ha sido modificado exitosamente!');
                        $("#ActualisarUsuarios").modal("hide");
                        $('#modalmensaje').modal('show')
                        setTimeout(() => {
                            location.reload();
                        }, 2000);

                    },
                    error: function(xhr) {
                        $("#ActualisarUsuarios").modal("hide");
                        $('#mensaje').text('ha ocurrido un error al modificar el usuario');
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            $('#modalmensaje').modal('hide');
                            $("#ActualisarUsuarios").modal("show");
                        }, 2000);
                        
                    }
                });
            }

            
        });

    });

    $(document).ready(function() {
        // Use event delegation for dynamic content

        $(document).on('keydown', '#registration-modal input', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevenir el envío del formulario por defecto
                $('#registrar').trigger('click'); // Ejecutar la función al simular el click
            }
        });

        $(document).on('click', '#registrar', function(event) {
            event.preventDefault();
            const formData = {
                name: $("#registration-modal #nombre").val(),
                lastname: $("#registration-modal #apellido").val(),
                number: $("#registration-modal #numero").val(),
                email: $("#registration-modal #correo").val(),
                password: $("#registration-modal #contrasena").val(),
                password2: $("#registration-modal #confirmar").val(),
                sucursal: $("#registration-modal #sucursal").val(),
                roleid: $("#registration-modal #rol").val(),
            }

            console.log(formData);

            const formulario = "registration-modal";
            if (validarFormulario(formulario)) {

                $('#registration-modal').modal('hide');
                $('#confirmregis').modal('show');


                $('#rnombre').text(formData.name);
                $('#rcorreo').text(formData.email);

                $(document).off('click', '#confirmYesr').on('click', '#confirmYesr', function(){
                    console.log('si');
                    $.ajax({
                        url: 'users',
                        type: 'POST',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#confirmregis').modal('hide');
                            $('#mensaje').text('cuenta registrada con exito!')
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                location.reload();
                            }, 2000);

                        },
                        error: function(xhr) {
                            $('#confirmregis').modal('hide');
                            $('#mensaje').text('ha ocurrido un problema al registrar la cuenta! es posible que el correo ya este en uso!')
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                $('#modalmensaje').modal('hide');
                                $('#registration-modal').modal('show');
                            }, 4000);
                            
                        }
                    });
                })

                $(document).on('click', '#confirmNor', function(){
                    $('#confirmregis').modal('hide');
                    $('#registration-modal').modal('show');

                })



                
            }else{
                console.log('error');
            }
        });

    });

    $(document).ready(function() {
        // Use event delegation for dynamic content
        $(document).on('click', '#actualizar', function() {
            event.preventDefault();
            console.log('hola');
            $("#ActualisarUsuarios #nombre").removeAttr('readonly');
            $("#ActualisarUsuarios #apellido").removeAttr('readonly');
            $("#ActualisarUsuarios #correo").removeAttr('readonly');
            $("#ActualisarUsuarios #numero").removeAttr('readonly');
            $("#ActualisarUsuarios #rol").removeAttr('readonly');
            $("#ActualisarUsuarios #lugar").removeAttr('readonly');

            document.getElementById('reset').setAttribute('hidden', true)
            // document.getElementById('borrar').setAttribute('hidden', true)

            document.getElementById('lugar').removeAttribute('hidden')
            document.getElementById('rol').removeAttribute('hidden')
            document.getElementById('lugarinput').setAttribute('hidden', true)
            document.getElementById('rolinput').setAttribute('hidden', true)

            const btnActualizar = document.getElementById('actualizar');

            btnActualizar.textContent = 'Confirmar Actualización';
            btnActualizar.classList.remove('btn-primary');
            btnActualizar.classList.add('btn-success');
            btnActualizar.id = 'confirmar';
        });
    });

    $(document).ready(function() {
        var idToDelete = null; // Variable para almacenar el ID del usuario a eliminar

        // Mostrar el modal de confirmación al hacer clic en "Borrar"
        $(document).on('click', '#borrar', function(event) {

            // Almacena el ID del usuario
            idToDelete = $(this).closest('tr').find('td[id]').text();
            const nombre = $(this).closest('tr').find('td[nombre]').text();
            const correo = $(this).closest('tr').find('td[correo]').text();
            const sucursal = $(this).closest('tr').find('td[sucursal]').text();

            $('#bnombre').text(nombre);
            $('#bcorreo').text(correo);
            $('#bsucursal').text(sucursal);

            // Muestra el modal
            $('#confirmModal').removeClass('hidden');
        });

        // Acción al confirmar "Sí, eliminar"
        $(document).on('click', '#confirmYes', function() {
            console.log(idToDelete)
            if (idToDelete) {
                $.ajax({
                    url: 'usuarios/borrar/' + idToDelete,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(response) {
                        $('#mensaje').text('usuario borrado con exito!');
                        $('#confirmModal').addClass('hidden',true);
                        $('#modalmensaje').modal('show')
                        setTimeout(() => {
                            location.reload();
                        }, 4000);
                    },
                    error: function(xhr) {
                        $('#mensaje').text('Error al borrar el usuario. Intente nuevamente.');
                        $('#confirmModal').addClass('hidden',true);
                        $('#modalmensaje').modal('show')
                        setTimeout(() => {
                            location.reload();
                        }, 4000);
                    }
                });
            }

            // Cierra el modal
            $('#confirmModal').addClass('hidden');
        });

        // Acción al cancelar
        $(document).on('click', '#confirmNo', function() {
            // Cierra el modal sin hacer nada
            $('#confirmModal').addClass('hidden');
        });
    });

    $(document).ready(function() {
        $(document).on('click', '#status0', function() {
            var id = $(this).closest('tr').find('td[id]').text();
            console.log(id);
            var url = "usuarios/status/" + id;
            fetch(url)
                .then(response => response.json())
                .catch(error => console.error('Error:', error));
            
        })
    })

    $(document).ready(function() {
        $(document).on('click', '#status1', function() {
            var id = $(this).closest('tr').find('td[id]').text();
            console.log(id);
            var url = "usuarios/status/" + id;
            fetch(url)
                .then(response => response.json())
                .catch(error => console.error('Error:', error));
        })
    })


    function filtro(){
        const formData ={
            filtroS:$('#filtrosucursal').val(),
            filtroR:$('#filtrorol').val(),
        }

        $.ajax({
            url: 'filtrousuarios',
            data:formData,
            type:'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data){
                console.log(data);
                let tbody = document.querySelector('#tablaUsuariosDataTable tbody');
                tbody.innerHTML = ''; // Limpiar el tbody antes de agregar nuevos datos

                data.forEach(item => {
                    let row = document.createElement('tr');
                    row.classList.add('border-r-2', 'border-l-2', 'border-b-2', 'border-gray-200', 'odd:bg-white', 'even:bg-gray-100');

                    row.innerHTML = `
                        <td hidden id="id">${item.id}</td>
                        <td class="p-4 hidden md:table-cell">${item.rol.nombre}</td>
                        <td class="p-4 hidden md:table-cell" nombre="tdnombre">${item.descripcion}</td>
                        <td class="p-4 md:hidden" nombre="tdnombre" >${item.name} <br> ${item.sucursal?.nombre?? 'Sin sucursal'}</td>
                        <td class="p-4 hidden md:table-cell" correo="tdcorreo">${item.email}</td>
                        <td class="p-4 hidden md:table-cell" sucursal="sucursal">${item.sucursal?.nombre ?? 'Sin sucursal'}</td>
                        <td class="text-right flex justify-between px-2 pt-[20px] md:ml-20 md:max-w-[200px]">
                            <button class="bi btn btn-warning btn-sm md:w-10 md:h-10 w-8 h-8" id="verdatos" data-type="usuario">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            ${item.status == 0 ? `
                                <button type="button" class="status0 btn btn-outline-dark btn-sm w-8 h-8 md:w-16 md:h-10" id="">
                                    <i class="bi bi-power"></i>
                                </button>
                                <button type="button" class="status1 hidden btn btn-outline-info btn-sm w-8 h-8 md:w-16 md:h-10" id="">
                                    <i class="bi bi-power"></i>
                                </button>
                            ` : `
                                <button type="button" class="status1 btn btn-outline-info btn-sm w-8 h-8 md:w-16 md:h-10" id="">
                                    <i class="bi bi-power"></i>
                                </button>
                                <button type="button" class="status0 hidden btn btn-outline-dark btn-sm w-8 h-8 md:w-16 md:h-10" id="">
                                    <i class="bi bi-power"></i>
                                </button>
                            `}
                            <button class="btn hidden btn-danger btn-sm md:w-10 md:h-10 w-8 h-8" id="borrar">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(row);
                });
                


            },
            error: function(xhr){
                console.log('error');
            }
        })


    }

    $(document).ready(function(){
        $('#search').on('input', function() {
            var query = $(this).val();

            if(query.length > 2) {  // Solo hace la búsqueda si tiene más de 2 caracteres
                $.ajax({
                    url: '/buscarusuario',  // Ruta a tu controlador
                    method: 'GET',
                    data: {
                        query: query  // Lo que escribió el usuario
                    },
                    success: function(response) {
                        // Limpiar la tabla y agregar los resultados
                        $('#tablaUsuariosDataTable tbody').html(response);
                    }
                });
            } else if(query.length ==0) {
                $.ajax({
                    url: '/usuariost',  // Ruta a tu controlador
                    method: 'GET',
                    success: function(response) {
                        // Limpiar la tabla y agregar los resultados
                        $('#tablaUsuariosDataTable tbody').html(response);
                    }
                });
            }
        });
    });


    function cambiarol(event){
        event.preventDefault();
        console.log('hola');

        $('#rolinput').addClass('hidden', true);
        $('#div-rol #rol').removeClass('hidden');

        $('#cambiarolb').addClass('hidden', true);
        $('#cambiarolbc').removeClass('hidden');

    }

    function confirmrol(event){
        event.preventDefault();

        const formData = {
            rol: $('#div-rol #rol').val(),
            usuario: $('#idusuario').val(),
        }
        console.log(formData);

        $.ajax({
            url:'/cambiarol-usuario',
            data: formData,
            type: 'POST',
            headers:  {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
            },
            success: function(response){
                $('#mensaje').text('el rol fue cambiado con exito!');
                $("#ActualisarUsuarios").modal("hide");
                $('#modalmensaje').modal('show')
                setTimeout(() => {
                    location.reload();
                }, 3000);
            },
            error: function(xhr){
                $('#mensaje').text('ha ocurrido un error! intente de nuevo.');
                $("#ActualisarUsuarios").modal("hide");
                $('#modalmensaje').modal('show')
                setTimeout(() => {
                    location.reload();
                }, 3000);
            }
        })
    }

    function verhistorial(event){
        event.preventDefault();

        const id = $("#ActualisarUsuarios #idusuario").val();
        const fecha1 = $('#fecha1').val();
        const fecha2 = $('#fecha2').val();
        console.log(id);
        console.log($('#fecha1').val())

        if(fecha1 == '' && fecha2 == '' ){
            $.ajax({
                url: 'historial-usuario/' + id,
                data: id,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }, 
                success: function (data){
                    console.log(data);
                    const roleId = @json(Auth::user()->roleid);
                    const div = document.getElementById('divhistorial');
                    div.innerHTML = "";
                    data.forEach(element => {
                        const url = `/verreporte/${element.id}${roleId}`;
                        
                            div.innerHTML += `<a href="${url}">
                                    
                                    <div class="space-y-2 mt-2 mb-2">
                                        <div class="flex justify-between items-center p-4 rounded-lg shadow-md h-24 text-black border-2 border-black grid grid-cols-6 gap-1 hover:bg-gray-200 cursor:pointer">
                                        <h3 class="text-center grid-span-1">${element.fecha}</h3>
                                        <h3 class="text-center grid-span-1">${element.codigo}</h3>
                                        <h3 class="text-center grid-span-1">${element.sistema.nombre}</h3>
                                        <h3 class="text-center grid-span-1">${element.modulo && element.modulo.nombre ? element.modulo.nombre: 'Sin modulo'}</h3>
                                        <h3 class="text-center grid-span-1">${element.tecnico && element.tecnico.name ? element.tecnico.name : 'Sin técnico'}</h3>
                                        <h3 class="text-center grid-span-1">${element.status.nombre}</h3>
                                        </div>
                                    </div>
                                    </a>`;
                        
                    
                    });
                },
                error: function(xhr){
                    console.log('no')
                }
            })

            $('#historialmodal').modal('show')
            historial_ejec ++;
        }else if(fecha1 != '' || fecha2 != ''){
            
            const formData = {
                fecha1: fecha1,
                fecha2: fecha2,
            }

            $.ajax({
                url: 'historial-usuario2/' + id,
                data: formData,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }, 
                success: function (data){
                    console.log(data);
                    const roleId = @json(Auth::user()->roleid);
                    const div = document.getElementById('divhistorial');
                    div.innerHTML = "";
                    data.forEach(element => {
                        const url = `/verreporte/${element.id}${roleId}`;
                        
                            div.innerHTML += `<a href="${url}">
                                    
                                    <div class="space-y-2 mt-2 mb-2">
                                        <div class="flex justify-between items-center p-4 rounded-lg shadow-md h-24 text-black border-2 border-black grid grid-cols-6 gap-1 hover:bg-gray-200 cursor:pointer">
                                        <h3 class="text-center grid-span-1">${element.fecha}</h3>
                                        <h3 class="text-center grid-span-1">${element.codigo}</h3>
                                        <h3 class="text-center grid-span-1">${element.sistema.nombre}</h3>
                                        <h3 class="text-center grid-span-1">${element.modulo && element.modulo.nombre ? element.modulo.nombre: 'Sin modulo'}</h3>
                                        <h3 class="text-center grid-span-1">${element.tecnico && element.tecnico.name ? element.tecnico.name : 'Sin técnico'}</h3>
                                        <h3 class="text-center grid-span-1">${element.status.nombre}</h3>
                                        </div>
                                    </div>
                                    </a>`;
                                         
                    });
                },
                error: function(xhr){
                    console.log('no')
                }
            })

            $('#historialmodal').modal('show')



        }

        
    }


</script>
