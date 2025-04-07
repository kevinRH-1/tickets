@extends('layouts.app')

@section('content')
    <br>

    <div class="md:w-11/12 bg-white shadow-lg rounded-lg flex items-center justify-between p-4 m-auto border-1 border-red-600">
        <!-- Botón izquierdo -->
        <button class="bg-blue-500 text-white md:!px-4 px-2 md:!py-2 py-1 rounded hover:bg-blue-600" onclick="volverPaginaAnterior()">
            <span class="md:hidden"><-</span>
            <span class="hidden md:inline">Volver</span>
        </button>

        <!-- Título en el centro -->
        <h1 class="text-lg  font-semibold text-gray-800 text-center">
            Reportes de {{$modulo[0]->nombre}}
        </h1>

        <!-- Botón derecho -->
        <h1></h1>
        
    </div>

    

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50">
        <div class="relative mx-auto mt-20 bg-white rounded shadow-lg w-96">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-2 border-b">
                <h2 class="text-lg font-semibold">Nuevo problema comun</h2>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    &times;
                </button>
            </div>

            <!-- Body -->
            <div class="p-4">
                <!-- Textbox -->
                <form action="#" method="POST">
                    @csrf


                    <input type="text" name="sistema" id="sistema" hidden value="{{$modulo[0]->sistema->id}}">
                    <input type="text" name="modulo" id="modulo" hidden value="{{$modulo[0]->id}}">


                    <label for="textbox" class="block mb-2 text-sm font-medium text-gray-700">descripcion del problema:</label>
                    <textarea id="descripcion" name="descripcion" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" maxlength="191"></textarea>
                    <p id="descripcion-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>

                    <label for="select" class="block mt-4 mb-2 text-sm font-medium text-gray-700">seccion del problema:</label>
                    <select id="vista" name="vista" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="0">Sin seccion</option>
                       @forEach($vistas as $item)
                            
                            <option value="{{$item->id}}">{{$item->nombre}}</option>

                       @endforeach
                    </select>

                    <!-- Select -->
                    <label for="select" class="block mt-4 mb-2 text-sm font-medium text-gray-700">nivel de importancia:</label>
                    <select id="riesgo" name="riesgo" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                       @forEach($riesgos as $item)
                            <option value="{{$item->id}}">{{$item->descripcion}}</option>

                       @endforeach
                    </select>
                    <br>

                    <div class="flex px-4 pt-8 border-t justify-between">
                        <button type="submit" id="btnguardar" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700" onclick="nuevoproblema(event)">
                            Guardar
                        </button>
                        <button id="closeModal2" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                            Cerrar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            
        </div>
    </div>

    <div class="container-fluid">
        <div class="card border-0 shadow my-5">
            <div class="card-body md:!p-4 p-0">
                {{-- <h1 class="fw-light"><b>Gestión de fallas</b></h1> --}}
                

                <div class="m-auto max-w-7xl bg-white shadow-md rounded-lg overflow-x-auto">
                    <table class="table-auto w-full border-collapse border-none border-gray-200 rounded-t-lg">
                        <thead class="bg-gray-800 text-white rounded-t-lg">
                            <tr>
                                <th class="md:p-4 p-1 text-center md:rounded-tl-lg"></th>
                                <th class="p-4 text-center hidden md:table-cell">FECHA DE CREACIÓN</th>
                                <th class="p-4 text-center hidden md:table-cell">CÓDIGO</th>
                                <th class="p-4 text-center md:hidden">DATOS</th>
                                <th class="p-4 text-center hidden md:table-cell">SUCURSAL</th>
                                <th class="p-4 text-center hidden md:table-cell">USUARIO</th>
                                {{-- <th class="p-4 text-center">SISTEMA</th> --}}
                                <th class="p-4 text-center hidden md:table-cell">seccion</th>
                                <th class="p-4 text-center hidden md:table-cell">PROBLEMA</th>
                                <th class="p-4 text-center hidden md:table-cell">IMPORTANCIA</th>
                                <th class="p-2 text-center hidden md:table-cell">ESTATUS</th>
                                <th class="p-2 text-center md:rounded-tr-lg">VER</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forEach($reportes as $item)

                            @php
                                $colores = [
                                    1 => 'text-emerald-500',
                                    2 => 'text-amber-500',
                                    3 => 'text-red-500',
                                    4 => 'text-red-800',
                                ];
                                $nivel = $item->falla?->nivel_riesgo;
                                $color = $colores[$nivel] ?? ''; // Si no hay coincidencia, no se asigna color
                            @endphp


                            @php
                                $colores_status = [
                                    1 => 'text-red-500',
                                    3 => 'text-amber-500',
                                    5 => 'text-sky-500',
                                    2 => 'text-orange-700',
                                    4 => 'text-green-700',
                                ];
                                $nivel_status = $item->status_id;
                                $color_status = $colores_status[$nivel_status] ?? ''; // Si no hay coincidencia, no se asigna color
                            @endphp



                                <!-- Fila 1 -->
                                @if($item->status_id==1)
                                    <tr class="border-1 border-red-500 hover:bg-red-50">
                                @elseif($item->status_id==3)
                                    <tr class="border-1 border-amber-500 hover:bg-amber-50">
                                @elseif($item->status_id==2)
                                    <tr class="border-1 border-orange-700 hover:bg-orange-50">
                                @elseif($item->status_id==4)
                                    <tr class="border-1 border-green-700 hover:bg-green-100">
                                @elseif($item->status_id==5)
                                    <tr class="border-1 border-sky-500 hover:bg-sky-50">
                                @else
                                    <tr class="border-1 border-gray-200 hover:bg-gray-50">
                                @endif
                                        <td class="md:pl-4">
                                            @if($item->noti_t==1)
                                                <i class="fa-solid fa-circle-exclamation fa-xl" style="color: #ff0000;"></i>
                                            @else

                                            @endif
                                        </td>

                                        <td class="text-left p-1 pt-2 md:!pt-1  md:hidden" datos="datos"><h1 class="text-lg font-semibold">{{ \Illuminate\Support\Str::limit($item->codigo, 35, '...')}}</h1><p class="pt-2">{{$item->usuario->descripcion}} || {{$item->usuario->sucursal->nombre}}</p>
                                            <p class="pt-1">{{$item->tecnico?->descripcion?? 'sin tecnico'}}</p>
                                            <div class="flex pt-1">
                                                <p class="{{$color_status}}">{{$item->status->nombre}} </p><p class="mx-1"> | </p>
                                                <p class="{{$color}}"> {{$item->falla?->importancia?->descripcion?? 'sin informacion'}}</p>
                                            </div>
                                            
                                        </td>


                                        <td class="p-4 text-center hidden md:table-cell">{{$item->created_at}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->codigo}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->usuario->sucursal->nombre}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->usuario->descripcion}}</td>
                                        {{-- <td class="p-4 text-center">{{$item->sistema->nombre}}</td> --}}
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->vista?->nombre?? 'sin seccion'}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{ \Illuminate\Support\Str::limit($item->falla?->descripcion ?? $item->mensajes[0]->mensaje, 40, '...') }}</td>
                                        <td class="p-4 text-center {{$color}} hidden md:table-cell">{{$item->falla?->importancia?->descripcion?? 'sin informacion'}}</td>
                                        <td class="p-2 text-center {{$color_status}} hidden md:table-cell">{{$item->status->nombre}}</td>
                                        <td class="p-2 text-center">
                                            <a href="{{route('reporte.ver', [$item->id, Auth::user()->roleid])}}">
                                                <button class="bg-teal-500 text-white p-2 rounded hover:bg-teal-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M10 3a7 7 0 100 14 7 7 0 000-14zm3.707 7.707a1 1 0 01-1.414 0L10 8.414l-2.293 2.293a1 1 0 11-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                                    </svg>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 p-2">
                        {{ $reportes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade mt-[20%]" id="confirmar2" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
              <h2 id="tituloconfirmar" class="text-lg font-semibold text-center w-full p-2 rounded-lg">¿Estás seguro?</h2>
              <p class="text-sm text-gray-600 text-center mt-3" id="texto">Esta acción registrara un nuevo modulo para este sistema.</p>
              <div class="mt-4 w-[99%] m-auto text-center">
                  <label for="bnombre" id="bnombre" class="text-center "></label>
                  <br>
              </div>
              <div class="flex justify-between mt-8">
                  <button id="confirmYes2" class="btn btn-primary text-white px-4 py-2 rounded">
                      Sí, registrar
                  </button>
                  <button id="confirmNo2" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
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
                    <h1 id="mensaje" class="mb-2"></h1>
                    <div class="mt-2"></div>
                    <i hidden id="check" class="fa-regular fa-circle-check fa-2xl" style="color: #63E6BE;"></i>
                    <i hidden id="x" class="fa-regular fa-circle-xmark fa-2xl" style="color: #fe0606;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-4">
                <button class="mb-4 w-full m-auto text-red-600 font-semibold text-lg flex items-center justify-center" id="vertablav">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                      </svg>
                      -- PANTALLAS DEL MODULO --  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                  </svg>
                  </button>
                

                <div class="m-auto max-w-7xl bg-white shadow-md rounded-lg overflow-x-auto" id="tablav">
                    <button id="openModalv" class="px-4 py-2 mb-4 text-white bg-blue-600 rounded hover:bg-blue-700">
            
                        <span class="md:hidden">+</span>
                        <span class="hidden md:inline"> Agregar seccion</span>
                    </button>
                    <table class="table-auto w-full border-collapse border-none border-gray-200 rounded-t-lg">
                        <thead class="bg-gray-800 text-white rounded-t-lg">
                            <tr>
                                <th class="p-4 text-center md:rounded-tl-lg hidden md:table-cell">NOMBRE</th>
                                <th class="p-2 text-center md:hidden">DATOS</th>
                                <th class="p-4 text-center hidden md:table-cell">FALLAS</th>
                                <th class="p-4 text-center hidden md:table-cell">TICKETS</th>
                                <th class="p-4 text-center hidden md:table-cell">TICKETS ACTIVOS</th>
                                <th class="md:!p-4 p-2 text-center">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forEach($vistas as $item)
                                <!-- Fila 1 -->                   
                                    <tr class="border-1 border-gray-200 hover:bg-gray-50">
                                        <td class="p-4 text-center hidden  md:table-cell" nombre="nombre">{{$item->nombre}}</td>
                                        <td hidden id="id">{{$item->id}}</td>

                                        {{-- <td class="p-1 text-left font-semibold md:hidden">
                                            <h1 class="mt-2 ml-4 font-bold text-lg">{{$item->descripcion}}</h1>
                                            <p class="mt-4 ml-4">{{$item->importancia?->descripcion?? 'sin nivel de riesgo'}}</p>
                                        </td> --}}

                                        <td class="p-4 text-center hidden md:table-cell">{{$item->cant_fallas}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->cant_reportes}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->cant_reportes_act}}</td>
                                        <td class="md:!p-4 p-2 pt-4 text-center flex md:justify-around justify-between">
                                            {{-- <button class="btn btn-success w-10 h-10" id="btnconsulta"><i class="fa-solid fa-eye"></i></button> --}}
                                            <button class="btn btn-danger btn-sm w-10 h-10" id="borrarv"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 p-2 ">
                        {{ $vistas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modalvista" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50">
        <div class="relative mx-auto mt-20 bg-white rounded shadow-lg w-96">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-2 border-b">
                <h2 class="text-lg font-semibold">Nueva seccion</h2>
                <button id="closeModalv" class="text-gray-500 hover:text-gray-700">
                    &times;
                </button>
            </div>

            <!-- Body -->
            <div class="p-4">
                <!-- Textbox -->
                <form action="" method="POST">
                    @csrf


                    {{-- <input type="text" name="sistema" id="sistema" hidden value="{{$modulo[0]->sistema->id}}"> --}}
                    {{-- <input type="text" name="modulo" id="modulo" hidden value="{{$modulo[0]->id}}"> --}}


                    <label for="textbox" class="block mb-2 text-sm font-medium text-gray-700">nombre de la seccion:</label>
                    <input id="nombre-vista" name="nombre-vista" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" maxlength="191">
                    <p id="error-nombre-vista" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>

                    <!-- Select -->
                    {{-- <label for="select" class="block mt-4 mb-2 text-sm font-medium text-gray-700">nivel de importancia:</label>
                    <select id="riesgo" name="riesgo" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                       @forEach($riesgos as $item)
                            <option value="{{$item->id}}">{{$item->descripcion}}</option>

                       @endforeach
                    </select> --}}
                    <br>

                    <div class="flex px-4 pt-8 border-t justify-between">
                        <button type="submit" id="btnguardarv" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700" onclick="guardarvista(event)">
                            Guardar
                        </button>
                        <button id="closeModal2v" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                            Cerrar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            
        </div>
    </div>






    <div class="container-fluid">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-4">
                <button class="mb-4 w-full m-auto text-red-600 font-semibold text-lg flex items-center justify-center" id="vertablaf">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                      </svg>
                      -- FALLAS DEL MODULO --  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                  </svg>
                  </button>
                

                <div class="m-auto max-w-7xl bg-white shadow-md rounded-lg overflow-x-auto" id="tablaf">
                    <button id="openModal" class="px-4 py-2 mb-4 text-white bg-blue-600 rounded hover:bg-blue-700">
            
                        <span class="md:hidden">+</span>
                        <span class="hidden md:inline"> Agregar Falla</span>
                    </button>
                    <table class="table-auto w-full border-collapse border-none border-gray-200 rounded-t-lg">
                        <thead class="bg-gray-800 text-white rounded-t-lg">
                            <tr>
                                <th class="p-4 text-center md:rounded-tl-lg hidden md:table-cell">MODULO</th>
                                <th class="p-4 text-center hidden md:table-cell">SECCION</th>
                                <th class="p-2 text-center md:hidden">DATOS</th>
                                <th class="p-4 text-center hidden md:table-cell">DESCRIPCION</th>
                                <th class="p-4 text-center hidden md:table-cell">NIVEL DE RIESGO</th>
                                <th class="md:!p-4 p-2 text-center">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forEach($fallas as $item)
                                <!-- Fila 1 -->                   
                                    <tr class="border-1 border-gray-200 hover:bg-gray-50">
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->modulo?->nombre?? 'sin modulo'}}</td>
                                        <td hidden id="id">{{$item->id}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->vista?->nombre?? 'sin seccion'}}</td>
                                        <td class="p-1 text-left font-semibold md:hidden">
                                            <h1 class="mt-2 ml-4 font-bold text-lg">{{$item->descripcion}}</h1>
                                            <p class="mt-4 ml-4">{{$item->importancia?->descripcion?? 'sin nivel de riesgo'}}</p>
                                        </td>

                                        <td class="p-4 text-center hidden md:table-cell" nombre='nombre'>{{$item->descripcion}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->importancia?->descripcion?? 'sin nivel de riesgo'}}</td>
                                        <td class="md:!p-4 p-2 pt-4 text-center flex md:justify-around justify-between">
                                            <button class="btn btn-success w-10 h-10" id="btnconsulta"><i class="fa-solid fa-eye"></i></button>
                                            <button class="btn btn-danger btn-sm w-10 h-10" id="borrarf"><i class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 p-2 ">
                        {{ $fallas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade mt-[10%]" id="modalfalla" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body text-center p-9">
                    <h1 class="font-semibold text-xl">Falla: </h1>
                    <h1 id="nombrefalla" class="text-lg  mt-4 mb-6"></h1>
                    <input type="text" id="idfalla" hidden>
                    <input type="text" id="solucion" hidden>
                    <input type="text" id="tecnico" hidden value="{{Auth::user()->id}}">
                    <br>
                    <h1 class="font-semibold text-xl">Solucion general:</h1>
                    <div class="w-11/12 mx-auto mt-4">
                        <textarea type="text" id="solucionfalla" class="w-full border-1 border-gray-300 rounded-lg" readonly></textarea>
                    </div>
                    <div id="divcheck" class="flex justify-between w-2/4 mt-4 mx-auto hidden">
                        <label for="">Solucion para el usuario:</label>
                        <input type="checkbox" name="checkusuario" id="checkusuario" class="rounded-md">
    
                    </div>
                    <div class="mt-6">
                        <button id="cambiarsolucion" class="btn btn-success">cambiar solucion</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    

    <div class="modal fade mt-[20%]" id="confirmarborrar" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
              <h2 class="text-lg font-semibold text-center">¿Estás seguro?</h2>
              <p class="text-sm text-gray-600 text-center mt-2" id="texto">esta accion borrara esta falla</p>
              <div class="mt-4 w-[99%] m-auto text-center">
                  <label for="bnombre" id="bnombre" class="text-center "></label>
                  <br>
                  <label for="bnivel" id="bnivel" class="text-center mt-2"></label>
              </div>
              <div class="flex justify-between mt-8">
                  <button id="confirmYesb" class="btn btn-danger text-white px-4 py-2 rounded">
                      Sí, borrar
                  </button>
                  <button id="confirmNob" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                      Cancelar
                  </button>
              </div>
            </div>
        </div>
    </div>

    <script src="../resources/jquery/jquery-3.6.0.min.js"></script>

    <script>
        // Selección de elementos
        const openModal = document.getElementById('openModal');
        const closeModal = document.getElementById('closeModal');
        const closeModal2 = document.getElementById('closeModal2');
        const modal = document.getElementById('modal');

        const openModalv = document.getElementById('openModalv');
        const closeModalv = document.getElementById('closeModalv');
        const closeModalv2 = document.getElementById('closeModal2v');
        const modalv = document.getElementById('modalvista');


        document.addEventListener('DOMContentLoaded', () => {
            const togglefButton = document.getElementById('vertablaf');
            const tablafDiv = document.getElementById('tablaf');

            // Asegurarte de que el div comience visible
            tablafDiv.classList.add('visible');

            togglefButton.addEventListener('click', () => {
                if (tablafDiv.classList.contains('visible')) {
                    tablafDiv.classList.remove('visible');
                    tablafDiv.classList.add('hidden');
                } else {
                    tablafDiv.classList.remove('hidden');
                    tablafDiv.classList.add('visible');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const buttonf = document.getElementById('vertablaf');

            buttonf.addEventListener('click', () => {
            if (buttonf.textContent.includes('-- FALLAS DEL SISTEMA --')) {
                buttonf.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25L12 15.75 4.5 8.25" />
                </svg>-- MOSTRAR FALLAS --  
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25L12 15.75 4.5 8.25" />
                </svg>`;
            } else {
                buttonf.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                </svg>-- FALLAS DEL MODULO --  
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                </svg>`;
            }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const togglevButton = document.getElementById('vertablav');
            const tablavDiv = document.getElementById('tablav');

            // Asegurarte de que el div comience visible
            tablavDiv.classList.add('visible');

            togglevButton.addEventListener('click', () => {
                if (tablavDiv.classList.contains('visible')) {
                    tablavDiv.classList.remove('visible');
                    tablavDiv.classList.add('hidden');
                } else {
                    tablavDiv.classList.remove('hidden');
                    tablavDiv.classList.add('visible');
                }
            });
        });


        document.addEventListener('DOMContentLoaded', () => {
            const buttonv = document.getElementById('vertablav');

            buttonv.addEventListener('click', () => {
            if (buttonv.textContent.includes('-- PANTALLAS DEL MODULO --')) {
                buttonv.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                </svg>-- PANTALLAS DEL MODULO --  
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                </svg>`;
            } else {
                buttonv.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                </svg>-- PANTALLAS DEL MODULO --  
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                </svg>`;
            }
            });
        });



        // Mostrar el modal
        openModal.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        // Cerrar el modal
        closeModal.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        closeModal2.addEventListener('click', () => {
            event.preventDefault();
            modal.classList.add('hidden');
        });






        openModalv.addEventListener('click', () => {
            modalv.classList.remove('hidden');
        });

        // Cerrar el modal
        closeModalv.addEventListener('click', () => {
            modalv.classList.add('hidden');
        });

        closeModalv2.addEventListener('click', () => {
            event.preventDefault();
            modalv.classList.add('hidden');
        });



        function volverPaginaAnterior() {
            window.history.back();
        }   

        $(document).ready(function(){
            $(document).on('click', '#btnconsulta', function(){
                var id = $(this).closest('tr').find('td[id]').text();
                console.log(id);
                $('#solucionfalla').attr('readonly', true);
                $('#confirmarsolucion').attr('id', 'cambiarsolucion');
                $('#cambiarsolucion').removeClass('btn-primary');
                $('#cambiarsolucion').addClass('btn-success');
                $('#cambiarsolucion').text('cambiar solucion');


                $.ajax({
                    url: '/versolucion/' + id,
                    type:'GET',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        console.log(data);
                        $('#modalfalla #nombrefalla').text(data[0].descripcion)
                        if(data[0].solucion){
                            $('#modalfalla #solucionfalla').val(data[0].solucion.solucion);
                            $('#modalfalla #solucion').val(1);
                            if(data[0].solucion.checked==1){
                                const checkbox = document.getElementById("checkusuario");
                                checkbox.checked = true;
                            }
                            $('#divcheck').removeClass('hidden');
                        }else{
                            $('#modalfalla #solucionfalla').val('sin solucion');
                            $('#modalfalla #solucion').val(0);
                            $('#divcheck').addClass('hidden', true);
                            
                        }
                        $('#modalfalla #idfalla').val(data[0].id);
                        $('#modalfalla').modal('show');
                        
                    },
                    error: function(xhr){
                        console.log(xhr);
                    }
                })
            })
        })

        $(document).ready(function(){
            $(document).off('click', '#cambiarsolucion').on('click', '#cambiarsolucion', function(){
                $('#solucionfalla').removeAttr('readonly');
                $('#cambiarsolucion').attr('id', 'confirmarsolucion');
                $('#confirmarsolucion').removeClass('btn-success');
                $('#confirmarsolucion').addClass('btn-primary');
                $('#confirmarsolucion').text('confirmar solucion');


                $(document).off('click', '#confirmarsolucion').on('click', '#confirmarsolucion', function(){
                    const formData ={
                        id:$('#idfalla').val(),
                        solucion:$('#solucionfalla').val(),
                        existesolucion: $('#solucion').val(),
                        tecnico: $('#tecnico').val(),
                        checked: $('#checkusuario').prop('checked'),
                    };

                    console.log(formData);

                    $.ajax({
                        url: '/actsolucionfalla',
                        data: formData,
                        type: 'POST',
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response){
                            $('#modalfalla').modal('hide')
                            $('#mensaje').text('solucion general actualizada con exito!');
                            $('#modalmensaje #check').removeAttr('hidden')
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                        },
                        error: function(xhr){
                            $('#modalfalla').modal('hide')
                            $('#mensaje').text('Ha ocurrido un error, intentelo mas tarde!');
                            $('#modalmensaje #x').removeAttr('hidden')
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                        }
                    })
                })


            })
        })

        $(document).on('click', '#borrarf', function(){
            var id = $(this).closest('tr').find('td[id]').text();
            var nombre = $(this).closest('tr').find('td[nombre]').text();
            console.log(id);

            $('#confirmarborrar #bnombre').text(nombre)
            $('#confirmarborrar').modal('show');

            $('#confirmarborrar #confirmYesb2').attr('id', 'confirmYesb');
            $('#confirmarborrar #confirmNob2').attr('id', 'confirmNob');
            
            $(document).off('click', '#confirmYesb').on('click', '#confirmYesb', function(){
                $.ajax({
                    url: '/borrarfallasistema/' +id,
                    type:'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(response){
                        $('#mensaje').text('el tipo de falla ha sido borrado con exito!')
                        $('#confirmarborrar').modal('hide')
                        $('#modalmensaje').modal('show');
                        $('#modalmensaje #check').removeAttr('hidden');
                        setTimeout(() => {
                            location.reload();
                        }, 3000);

                    },
                    error: function(xhr){
                        $('#mensaje').text('ha ocurrido un error al borrar la falla')
                        $('#confirmarborrar').modal('hide')
                        $('#modalmensaje #x').removeAttr('hidden');
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    }
                })
            })

            $(document).on('click', '#confirmNob', function(){
                $('#confirmarborrar').modal('hide');
            })

        })






        function guardarvista(event){
            event.preventDefault();
            $('#btnguardarv').attr('disabled', true);

            const formData ={
                nombre:$('#nombre-vista').val(),
                modulo:$('#modulo').val(),

            };

            console.log(formData);

            if(!formData||formData.nombre.trim()===''){
                $('#error-nombre-vista').removeAttr('hidden');
            }else{
                $('#error-nombre-vista').attr('hidden', true);

                $.ajax({
                    url: '/create-vista',
                    data: formData,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        $('#mensaje').text('seccion registrada con exito!')
                        $('#modalvista').addClass('hidden')
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            location.reload();
                        }, 2500);
                    },
                    error: function(xhr){
                        $('#mensaje').text('Ha ocurrido un error!')
                        $('#modalvista').addClass('hidden')
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            location.reload();
                        }, 2500);
                    }
                })




            }
        }


        $(document).on('click', '#borrarv', function(){
            var id = $(this).closest('tr').find('td[id]').text();
            var nombre = $(this).closest('tr').find('td[nombre]').text();
            console.log(id);

            $('#confirmarborrar #bnombre').text(nombre)
            $('#confirmarborrar').modal('show');

            $('#confirmarborrar #confirmYesb').attr('id', 'confirmYesb2');
            $('#confirmarborrar #confirmNob').attr('id', 'confirmNob2');
            
            $(document).off('click', '#confirmYesb2').on('click', '#confirmYesb2', function(){
                $.ajax({
                    url: '/borrarvista/' +id,
                    type:'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(response){
                        $('#mensaje').text('la seccion ha sido borrada con exito!')
                        $('#confirmarborrar').modal('hide')
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            location.reload();
                        }, 2500);

                    },
                    error: function(xhr){
                        $('#mensaje').text('ha ocurrido un error al borrar la seccion')
                        $('#confirmarborrar').modal('hide')
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            location.reload();
                        }, 2500);
                    }
                })
            })

            $(document).on('click', '#confirmNob2', function(){
                $('#confirmarborrar').modal('hide');
            })

        })

        function nuevoproblema(event){
            event.preventDefault();
            const formData= {
                vista: $('#vista').val(),
                descripcion:$('#descripcion').val(),
                riesgo:$('#riesgo').val(),
                sistema:$('#sistema').val(),
                modulo:$('#modulo').val(),
            };

            console.log(formData);

            if (!formData.descripcion || formData.descripcion.trim() === "") {
                $("#descripcion-error").removeAttr('hidden');
                console.log('no');
            }else{
                $("#descripcion-error").attr('hidden', true);
                console.log('si');
                $('#confirmar2 #bnombre').text(formData.descripcion);
                $('#confirmar2 #confirmYes2').attr('id', 'confirmYes3');
                $('#confirmar2 #texto').text('Esta accion registrara un nuevo problema');
                const modal = document.getElementById('modal');
                modal.classList.add('hidden');
                $('#confirmar2').modal('show');

                $(document).off('click', '#confirmYes3');

                $(document).off('click', '#confirmYes3').on('click', '#confirmYes3', function(){
                    const button = $(this);
                    button.prop('disabled', true);
                    $.ajax({
                        url: '/fallasoftwarestore',
                        type: 'POST',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                        },
                        success: function(response){
                            $('#confirmar2').modal('hide')
                            $('#mensaje').text('problema registrado con exito!');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                            
                        },
                        error: function(xhr) {
                            $('#confirmar2').modal('hide')
                            $('#mensaje').text('ha ocurrido un error, intentelo de nuevo!');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                $('#modalmensaje').modal('hide');
                            }, 3000);
                        }
                        

                    })
                })

                $(document).on('click', '#confirmNo2', function() {
                    $('#confirmar2').modal('hide');
                });
                
            }
        }


    </script>


@endsection