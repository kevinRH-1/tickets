@extends('layouts.app')

@section('content')

    <br>

    <style>
        /* Ocultar con animación */
        #tabla {
            
            transition: max-height 0.5s ease, opacity 0.5s ease;
            opacity: 1;
        }

        #tablaf{
            
            transition: max-height 0.5s ease, opacity 0.5s ease;
            opacity: 1;
        }

        .visible {
             /* Altura suficiente para el contenido */
            opacity: 1;
        }
    </style>


    <div class="w-full  bg-white shadow-lg rounded-lg flex items-center justify-between md:!p-4 p-1 m-auto border-1 border-red-600">
        <!-- Botón izquierdo -->
        <button class="bg-blue-500 text-white md:!px-4 md:!py-2 px-2 py-1 rounded hover:bg-blue-600" onclick="volverPaginaAnterior()">
           <span class="hidden md:inline">Volver</span>
           <span class="md:hidden"><-</span>
        </button>

        <!-- Título en el centro -->
        <h1 class="md:!text-lg text-md font-semibold text-gray-800 text-center">
            Modulos de {{$sistema[0]->nombre}}
        </h1>

        <!-- Botón derecho -->
        <div class="flex flex-col">  
            @if($vacio == 0)
                <button id="openModal" class="bg-blue-500 text-white md:!px-4 py-1 rounded hover:bg-blue-600">
                    <span class="hidden md:inline">Agregar problema</span>
                    <span class="md:hidden">+ problema</span>
                </button>
            @else
            <button hidden id="openModal" class="bg-blue-500 text-white md:!px-4 py-1 rounded hover:bg-blue-600">
                <span class="hidden md:inline">Agregar Falla comun</span>   
                <span class="md:hidden">+ falla</span>            
            </button>
            @endif
            @if(Auth::user()->roleid===1)
                <button id="openmodalmodulo" class="bg-blue-500 text-white md:!px-4 py-1 mt-1 rounded hover:bg-blue-600">
                    <span class="hidden md:inline">Agregar modulo</span>
                    <span class="md:hidden">+ modulo</span>
                </button>
            @endif
            
        </div> 
    </div>

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
                <form action="{{route('fallasoftware.store')}}" method="POST">
                    @csrf

                    @if($vacio ==0)
                        <input type="text" name="sistema" id="sistema" hidden value="{{$modulos[0]->sistema->id}}">
                        <input type="text" name="modulo" id="modulo" hidden value="{{$modulos[0]->id}}">
                    @else

                    @endif

                    <label for="textbox" class="block mb-2 text-sm font-medium text-gray-700">descripcion del problema:</label>
                    <textarea id="descripcion" name="descripcion" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    <p id="descripcion-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
                    <label for="modulo" class="block mb-2 text-sm font-medium text-gray-700">modulo del problema:</label>
                    <select id="modulosele" name="modulosele" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="0">Sin modulo</option>
                        @forEach($modulos as $item)
                            <option value="{{$item->id}}">{{$item->nombre}}</option>
                        @endforeach
                    </select>


                    <!-- Select -->
                    <label for="select" class="block mt-4 mb-2 text-sm font-medium text-gray-700">nivel de importancia:</label>
                    <select id="riesgo" name="riesgo" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($riesgos as $r)
                            <option value="{{$r->id}}">{{$r->descripcion}}</option>
                        @endforeach
                    </select>
                    <br>

                    <div class="flex px-4 pt-8 border-t justify-between">
                        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700" onclick="nuevoproblema(event)">
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

    

    <div id="modalmodulo" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50">
        <div class="relative mx-auto mt-20 bg-white rounded shadow-lg w-96">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-2 border-b">
                <h2 class="text-lg font-semibold">Nuevo Modulo</h2>
                <button id="closeModalmodulo" class="text-gray-500 hover:text-gray-700">
                    &times;
                </button>
            </div>

            <!-- Body -->
            <div class="p-4">
                <!-- Textbox -->
                <form action="{{route ('modulo.store')}}" method="POST">
                    @csrf

                    
                    <input type="text" name="sistema" id="sistema" hidden value="{{$sistema[0]->id}}">
                    


                    {{-- <label for="textbox" class="block mb-2 text-sm font-medium text-gray-700">codigo:</label>
                    <input type="text" maxlength="20" name="codigo" id="codigo" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p id="codigo-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p> --}}

                    <label for="textbox" class="block mb-2 text-sm font-medium text-gray-700">nombre:</label>
                    <input type="text" maxlength="30" name="nombre" id="nombre" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p id="nombre-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
                    
                    <br>

                    <div class="flex px-4 pt-8 border-t justify-between">
                        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700" onclick="nuevomodulo(event)">
                            Guardar
                        </button>
                        <button id="closeModal2modulo" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                            Cerrar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            
        </div>
    </div>


    <div id="modalact" class="modal fade ">
        <div class="modal-dialog relative mx-auto mt-20 bg-white rounded shadow-lg w-96">
            <div class="modal-content">
            <!-- Header -->
                <div class="flex items-center justify-between px-4 py-2 border-b">
                    <h2 class="text-lg font-semibold">Actualizar Datos</h2>
                    <button id="" class="text-gray-500 hover:text-gray-700" onclick="$('#modalact').modal('hide')">
                        &times;
                    </button>
                </div>

                <!-- Body -->
                <div class="p-4">
                    <!-- Textbox -->
                    <form action="" method="POST">
                        @csrf

                        
                        <input type="text" name="sistema" id="sistema" hidden value="{{$sistema[0]->id}}">
                        <input type="text" name="id" id="id" hidden>
                        


                        {{-- <label for="textbox" class="block mb-2 text-sm font-medium text-gray-700">codigo:</label>
                        <input type="text" maxlength="20" name="codigo" id="codigo" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p id="codigo-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p> --}}

                        <label for="textbox" class="block mb-2 text-sm font-medium text-gray-700">nombre:</label>
                        <input type="text" maxlength="30" name="nombre" id="nombre" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p id="nombre-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
                        
                        <br>

                        <div class="flex px-4 pt-8 border-t justify-between">
                            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700" onclick="actualizar(event)">
                                actualizar
                            </button>
                            <button id="" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700" onclick="cerrarmodal(event)">
                                Cerrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer -->
            
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
    <div class="modal fade mt-[20%]" id="confirmar" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
              <h2 id="tituloconfirmar" class="text-lg font-semibold text-center w-full p-2 rounded-lg">¿Estás seguro?</h2>
              <p class="text-sm text-gray-600 text-center mt-3" id="texto">Esta acción quitara este equipo de esta sucursal.</p>
              <div class="mt-4 w-[99%] m-auto text-center">
                  <label for="bnombre" id="bnombre" class="text-center "></label>
                  <br>
                  <label for="bcorreo" id="bcorreo" class="text-center mt-2"></label>
                  <br>
                  <label for="bsucursal" id="bsucursal" class="text-center mt-2"></label>
              </div>
              <div class="flex justify-between mt-8">
                  <button id="confirmYes" class="btn btn-danger text-white px-4 py-2 rounded">
                      Sí, quitar
                  </button>
                  <button id="confirmNo" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                      Cancelar
                  </button>
              </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalfiltro" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center py-9 overflow-auto">
                    <div class="">
                        
                        <label for="" class="block mt-4 mb-2">NIVEL DE IMPORTANCIA: </label>
                        <select name="filtronivel" id="filtronivel" class="ml-2 mb-2 pl-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <option value="10">todos los estados</option>
                            <option value="0">sin informacion</option>
                            @forEach($nivel as $item)
                                <option value="{{$item->id}}">{{$item->descripcion}}</option>
                            @endforeach
                        </select>


                        <label for="" class="block mt-4 mb-2">TIPO DE FALLA: </label>
                        <select name="filtrofalla" id="filtrofalla" class="ml-2 mb-2 pl-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <option value="0">todas las fallas</option>
                            @forEach($fallas as $item)
                                <option value="{{$item->id}}">{{$item->descripcion}}</option>
                            @endforeach
                        </select>
                        
                        <p id="filtro-error" class="text-red-500 text-sm hidden">Debe llenar al menos una de las opciones!</p>
                        <div class="mb-10"></div>

                        <button class="block p-2 bg-emerald-500 rounded-md text-white w-40 m-auto" id="filtroboton">VER RESULTADOS</button>
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

    <input type="text" id="sistema" name="sistema" value{{$sistemaid}} hidden>

    
    <div class="container-fluid">
        <div class="card border-0 shadow my-5">
            <div class="card-body md:!p-4 p-0">
                <button class="mb-4 w-full  text-red-600 font-semibold text-lg flex items-center mt-4 md:!mt-0 justify-center" id="vertabla">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                      </svg>
                      -- TICKETS DEL SISTEMA --  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                  </svg>
                  </button>
                

                <div class="m-auto max-w-7xl bg-white shadow-md rounded-lg overflow-x-auto" id="tabla">
                    <button class="p-2 mb-4 bg-emerald-500 rounded-md text-white md:w-40 w-20 ml-4 md:!ml-0" onclick="mostrarfiltro()">FILTRAR</button>
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
                                <th class="p-4 text-center hidden md:table-cell">MODULO</th>
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
                                    2 => 'text-amber-500',
                                    3 => 'text-sky-500',
                                ];
                                $nivel_status = $item->status_id;
                                $color_status = $colores_status[$nivel_status] ?? ''; // Si no hay coincidencia, no se asigna color
                            @endphp



                                <!-- Fila 1 -->
                                @if($item->status_id==1)
                                    <tr class="border-1 border-red-500 hover:bg-red-50">
                                @elseif($item->status_id==2)
                                    <tr class="border-1 border-amber-500 hover:bg-amber-50">
                                @elseif($item->status_id==3)
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
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->modulo?->nombre?? 'sin modulo'}}</td>
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

    <div class="container-fluid">
        <div class="card border-0 shadow my-5">
            <div class="card-body md:!p-4 p-0">
                <button class="mb-4 w-full m-auto text-red-600 font-semibold text-lg mt-4 md!:mt-0 flex items-center justify-center" id="vertablaf">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                      </svg>
                      -- FALLAS DEL SISTEMA --  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                  </svg>
                  </button>
                

                <div class="m-auto max-w-7xl bg-white shadow-md rounded-lg overflow-x-auto" id="tablaf">
                    <table class="table-auto w-full border-collapse border-none border-gray-200 rounded-t-lg">
                        <thead class="bg-gray-800 text-white rounded-t-lg">
                            <tr>
                                <th class="p-4 text-center hidden md:table-cell md:rounded-tl-lg">MODULO</th>
                                <th class="p-4 text-center md:hidden">DATOS</th>
                                <th class="p-4 text-center hidden md:table-cell">DESCRIPCION</th>
                                <th class="p-4 text-center hidden md:table-cell">NIVEL DE RIESGO</th>
                                <th class="p-4 text-center">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forEach($fallas as $item)
                                <!-- Fila 1 -->                   
                                    <tr class="border-1 border-gray-600 hover:bg-gray-50">

                                        <td class="p-1 text-left font-semibold md:hidden">
                                            <h1 class="mt-2 ml-4 font-bold text-lg">{{$item->modulo?->nombre?? 'sin modulo'}}</h1>
                                            <p class="mt-4">{{$item->descripcion}}</p>
                                            <p class="mt-2">{{$item->importancia?->descripcion?? 'sin nivel de riesgo'}}</p>
                                        </td>

                                        <td class="p-4 text-center hidden md:table-cell">{{$item->modulo?->nombre?? 'sin modulo'}}</td>
                                        <td hidden id="id">{{$item->id}}</td>
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

    


    @foreach($modulos as $item)
        @if(Auth::user()->roleid==1)
            <a href="{{route ('modulo.ver', [$item->id])}}" class=" w-4/5 m-auto h-full">
                <div class="space-y-20 mt-8 mb-4">
                    <div class="flex justify-between items-center bg-white px-4 rounded-lg shadow-md h-32">
                        <div class="mt-12">
                            <span class="text-xl " class="mt-14" id="nombrespan-{{$item->id}}">{{$item->nombre}}</span>
                        </div>
                        <input type="text" id="id-{{$item->id}}" name="id" hidden value="{{$item->id}}">
                        <input type="text" id="sistema-{{$item->id}}" name="sistema" hidden value="{{$item->sistema_id}}">
                        <input type="text" id="nombre" name="nombre" hidden value="{{$item->nombre}}">
                        <div class="text-right flex">
                            <div class="md:flex hidden">
                                <h2 class="text-sm text-center font-semibold mr-10">{{$item->reportes_mes}}<br> últimos 30 días</h2>
                                <h2 class="text-sm text-center font-semibold mr-10">{{$item->reportes}}<br> Totales</h2>
                            </div>
                            <div class="relative inline-block text-left">
                                <!-- Botón para abrir el menú -->
                                <button 
                                    id="menu-button-{{$item->id}}" 
                                    class="inline-flex justify-center w-full rounded-md border-none text-xl p-1 bg-white font-medium text-gray-700"
                                    aria-expanded="true"
                                    aria-haspopup="true"
                                    onclick="toggleMenu(event, {{$item->id}})"
                                >
                                    ...
                                </button>

                                <!-- Menú desplegable -->
                                <div 
                                    id="dropdown-menu-{{$item->id}}"
                                    class="hidden absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    role="menu"
                                    aria-orientation="vertical"
                                    aria-labelledby="menu-button-{{$item->id}}"
                                >
                                    <div class="py-1" role="none">
                                        <a href="#" 
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                            role="menuitem" 
                                            onclick="handleModify({{$item->id}})">Modificar</a>
                                        <a href="#" 
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                            role="menuitem" 
                                            onclick="handleDelete({{$item->id}})">Borrar</a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </a>
        @endif
        @if(Auth::user()->roleid==2)
            <a href="{{route ('modulo.ver', [$item->id])}}" class="block w-[99%] m-auto">
                <div class="space-y-20 mt-8">
                    <div class="flex justify-between items-center bg-white p-4 rounded-lg shadow-md h-32">
                        <span class="text-xl" id="nombrespan-{{$item->id}}">{{$item->nombre}}</span>
                        <input type="text" id="id-{{$item->id}}" name="id" hidden value="{{$item->id}}">
                        <input type="text" id="sistema-{{$item->id}}" name="sistema" hidden value="{{$item->sistema_id}}">
                        <input type="text" id="nombre" name="nombre" hidden value="{{$item->nombre}}">
                        <div class="text-right flex">
                            <div class="flex">
                                <h2 class="text-sm text-center font-semibold mr-10">{{$item->reportes_mes}}<br> últimos 30 días</h2>
                                <h2 class="text-sm text-center font-semibold mr-10">{{$item->reportes}}<br> Totales</h2>
                            </div>   
                        </div>
                    </div>
                </div>
            </a>
        @endif
    @endforeach

    <script src="../resources/jquery/jquery-3.6.0.min.js"></script>


    <script>

        const openModal = document.getElementById('openModal');
        const closeModal = document.getElementById('closeModal');
        const closeModal2 = document.getElementById('closeModal2');
        const modal = document.getElementById('modal');

        const openm = document.getElementById('openmodalmodulo');
        const closeModalmodulo = document.getElementById('closeModalmodulo');
        const closeModal2modulo = document.getElementById('closeModal2modulo');
        const modalm = document.getElementById('modalmodulo');

        document.addEventListener('DOMContentLoaded', () => {
            const toggleButton = document.getElementById('vertabla');
            const tablaDiv = document.getElementById('tabla');

            // Asegurarte de que el div comience visible
            tablaDiv.classList.add('visible');

            toggleButton.addEventListener('click', () => {
                if (tablaDiv.classList.contains('visible')) {
                    tablaDiv.classList.remove('visible');
                    tablaDiv.classList.add('hidden');
                } else {
                    tablaDiv.classList.remove('hidden');
                    tablaDiv.classList.add('visible');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const button = document.getElementById('vertabla');

            button.addEventListener('click', () => {
            if (button.textContent.includes('-- TICKETS DEL SISTEMA --')) {
                button.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25L12 15.75 4.5 8.25" />
                </svg>-- MOSTRAR TICKETS --  
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25L12 15.75 4.5 8.25" />
                </svg>`;
            } else {
                button.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                </svg>-- TICKETS DEL SISTEMA --  
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                </svg>`;
            }
            });
        });

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
                </svg>-- FALLAS DEL SISTEMA --  
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

        function volverPaginaAnterior() {
            window.history.back();
        }   

        openm.addEventListener('click', () => {
            modalm.classList.remove('hidden');
        });

        // Cerrar el modal
        closeModalmodulo.addEventListener('click', () => {
            modalm.classList.add('hidden');
        });

        closeModal2modulo.addEventListener('click', () => {
            event.preventDefault();
            modalm.classList.add('hidden');
        });

        function toggleMenu(event, id) {
            event.preventDefault();
            event.stopPropagation();
            const menu = document.getElementById(`dropdown-menu-${id}`);
            if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            } else {
            menu.classList.add('hidden');
            }
        }

        // Cierra el menú si se hace clic fuera de él
        document.addEventListener('click', (event) => {
            document.querySelectorAll('[id^="dropdown-menu-"]').forEach(menu => {
            if (!menu.contains(event.target) && !event.target.closest('button[id^="menu-button-"]')) {
                menu.classList.add('hidden');
            }
            });
        });

        function cerrarmodal(event){
            event.preventDefault();
            $('#modalact').modal('hide');
        }

        function handleModify(id) {
            const inputId = document.getElementById(`id-${id}`).value;
            const sistema = document.getElementById(`sistema-${id}`).value;
            console.log('Modificar:', { id: inputId, sistema });

            $.ajax({
                url: '/modulover/'+ inputId,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                },
                success: function(data){   
                    $('#modalact #nombre').val(data.nombre);
                    // $('#modalact #codigo').val(data.codigo);
                    $('#modalact #id').val(data.id);
                    $('#modalact').modal('show');
                                            
                },
                error: function(xhr) {
                    setTimeout(() => {
                        $('#modalmensaje').modal('hide');
                    }, 3000);
                }

            })
            
        }

        function actualizar(){
            event.preventDefault();
            $('#confirmar2 #confirmYes4').attr('id', 'confirmYes2');
            formData = { 
                nombre: $('#modalact #nombre').val(),
                // codigo: $('#modalact #codigo').val(),
                id: $('#modalact #id').val(),
            }

            if(validar2(formData)){
                console.log('si')
                $('#confirmar2 #texto').text('Esta acción actualizara este modulo.');
                $('#confirmar2 #bnombre').text(formData.nombre);
                $('#confirmar2 #confirmYes2').text('Si, actualizar');
                $('#confirmar2 #confirmYes2').attr('id', 'confirmYes4');
                $('#modalact').modal('hide');
                $('#confirmar2').modal('show');

                $(document).off('click', '#confirmYes4');

                $(document).off('click', '#confirmYes4').on('click', '#confirmYes4', function(){
                    $.ajax({
                        url: '/modulo/act/'+ formData.id,
                        type: 'POST',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                        },
                        success: function(response){
                            $('#modalmensaje #mensaje').text('el modulo ha sido actualizado correctamente!')
                            $('#confirmar2').modal('hide');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                        },
                        error: function(xhr){
                            $('#modalmensaje #mensaje').text('ha ocurrido un problema! intentelo de nuevo.')
                            $('#confirmar2').modal('hide');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                $('#modalmensaje').modal('hide');
                            }, 3000);
                        }
                    })
                })

                $(document).on('click', '#confirmNo', function() {
                    // Cierra el modal sin hacer nada
                    $('#confirmar2').modal('hide');
                });

            }else{
                console.log('invalido')
            }
        }

        function handleDelete(id) {
            const inputId = document.getElementById(`id-${id}`).value;
            const sistema = document.getElementById(`sistema-${id}`).value;
            const nombre = $('#nombrespan-'+id).text();
            console.log('Eliminar:', { id: inputId, sistema, nombre });
            $('#tituloconfirmar').addClass('bg-red-600 ');
            $('#tituloconfirmar').addClass('text-white ');
            $('#texto').text('Esta accion eliminara este modulo! esta accion no es reversible y hara cambios en los registros actuales!')
            $('#confirmar').modal('show');
            $('#confirmYes').text('Si, eliminar')
            $('#bnombre').text(nombre);

            $(document).off('click', '#confirmYes');

            $(document).off('click', '#confirmYes').on('click', '#confirmYes', function() {
                console.log(inputId);
                if (inputId) {
                    $.ajax({
                        url: '/modulo/delete/'+inputId,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                        },
                        success: function(response) {
                            $('#confirmar').modal('hide')
                            $('#mensaje').text('modulo borrado con exito!');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                            
                        },
                        error: function(xhr) {
                            $('#confirmar').modal('hide')
                            $('#mensaje').text('ha ocurrido un error, intentelo de nuevo!');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                $('#modalmensaje').modal('hide');
                            }, 3000);
                        }
                    });
                }
            });

            // Acción al cancelar
            $(document).on('click', '#confirmNo', function() {
                // Cierra el modal sin hacer nada
                $('#confirmar').modal('hide');
            });
        }

        function validar(form){

            let esValido = true;

            if (!form.nombre || form.nombre.trim() === "") {
                $("#nombre-error").removeAttr('hidden');
                esValido = false;
            }else{
                $("#nombre-error").attr('hidden', true);
            }

            // if (!form.codigo || form.codigo.trim() === "") {
            //     $("#codigo-error").removeAttr('hidden');
            //     esValido = false;
            // }else{
            //     $("#codigo-error").attr('hidden', true);
            // }

            return esValido

        }

        function validar2(form){

            let esValido = true;

            if (!form.nombre || form.nombre.trim() === "") {
                $("#modalact #nombre-error").removeAttr('hidden');
                esValido = false;
            }else{
                $("#modalact #nombre-error").attr('hidden', true);
            }

            // if (!form.codigo || form.codigo.trim() === "") {
            //     $("#modalact #codigo-error").removeAttr('hidden');
            //     esValido = false;
            // }else{
            //     $("#modalact #codigo-error").attr('hidden', true);
            // }

            return esValido

        }

        function nuevomodulo(event){
            event.preventDefault();
            const formData= {
                // codigo: $('#codigo').val(),
                nombre:$('#nombre').val(),
                sistema_id:$('#sistema').val(),
            };

            if(validar(formData)){
                const modal = document.getElementById('modalmodulo');
                modal.classList.add('hidden');
                $('#confirmar2').modal('show');
                
                $('#confirmar2 #bnombre').text(formData.nombre);
                $('#confirmar2 #texto').text('Esta acción registrara un nuevo modulo para este sistema.');
                $('#confirmar2 #confirmYes3').attr('id', 'confirmYes2');
                $('#confirmar2 #confirmYes4').attr('id', 'confirmYes2');
                $('#confirmar2 #confirmYes2').text('Si, registrar');

                $(document).off('click', '#confirmYes2');

                $(document).off('click', '#confirmYes2').on('click', '#confirmYes2', function(){
                    $('#confirmYes2').attr('disabled', true);
                    $.ajax({
                        url: '/modulostore',
                        type: 'POST',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                        },
                        success: function(response){
                            $('#confirmar2').modal('hide')
                            $('#mensaje').text('modulo registrado con exito!');
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
                            $('#confirmYes2').removeAttr('disabled');
                        }
                        

                    })
                })  

                $(document).on('click', '#confirmNo2', function() {
                    $('#confirmar2').modal('hide');
                });
            }else{
                console.log('invalido')
            }
        }

        function nuevoproblema(event){
            event.preventDefault();
            const formData= {
                modulo: $('#modulosele').val(),
                descripcion:$('#descripcion').val(),
                riesgo:$('#riesgo').val(),
                sistema:$('#sistema').val(),
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
                            $('#divcheck').removeClass('hidden');
                            if(data[0].solucion.checked==1){
                                const checkbox = document.getElementById("checkusuario");
                                checkbox.checked = true;
                            }
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

        function mostrarfiltro(){
            $('#modalfiltro').modal('show');

            

            $(document).off('click', '#filtroboton').on('click','#filtroboton', function(){
                const formData ={
                    
                    // estado: $('#filtroestado').val(),
                    nivel: $('#filtronivel').val(),
                    falla: $('#filtrofalla').val(),
                    sistema: $('#sistema').val(),
                };

                console.log(formData);

                // if (validarfiltro(formData)) {
                    // Construir la URL con los parámetros
                    let query = $.param(formData);
                    let url = `/filtrossistema?${query}`;

                    // Redirigir a la página con los filtros
                    window.location.href = url;
                

                
            } )
        }
        function truncateText(text, maxLength) {
            return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
        }



    </script>
@endsection