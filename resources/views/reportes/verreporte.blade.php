@extends('layouts.app')

@section('content')
    <style>
        .hidden {
            display: none;
        }
    </style>

    <div class="space-y-6 pb-6 md:!pt-6 pt-0" >

        <div class="bg-white p-6 rounded-lg shadow-md w-11/12 m-auto space-y-10">
            <label for="" class="block text-gray-700 w-2/4 m-auto text-center md:text-4xl text-2xl" >DATOS DEL REPORTE</label>
        </div>
        <div class="md:!mt-10 mt-4"></div>

        <!-- Sección 1: Datos del Equipo -->
        <div class="grid grid-cols-4 gap-4">
            <div class="bg-white md:!p-10 p-2 !pt-6 rounded-lg shadow-md  w-11/12 m-auto md:mt-4 md:col-span-3 col-span-4">
                <div class=" text-left border-solid border-gray-300 border-b-2 pb-2 md:!pb-5 p-2 md:p-1">
                    <label for="" class="block md:w-2/4 m-auto text-center text-2xl md:!mb-2 mb-4 text-red-600">DATOS DEL EQUIPO</label>                   
                    @if($reporte[0]->pc ?? false)
                        <div class="mt-4 grid md:grid-cols-2 grid-cols-1 md:gap-2">                         
                            <div class="col-span-1 pl-10 md:!pl-0">
                                <label for="" class=" text-gray-700 w-2/4 m-auto text-lg font-semibold hidden md:!inline" >Codigo: </label>
                                <label type="text" name="codigo" id="codigo" class="text-2xl  p-0  md:!p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{ $reporte[0]->pc->codigo }}</label>
                            </div>
                            <div class="col-span-1">
                                <label for="" class=" text-gray-700 w-2/4 text-lg font-semibold hidden md:!inline" >Nombre: </label>
                                <label type="text" name="codigo" id="codigo" class="w-3/4 text-lg p-0 pt-2 md:!p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{ $reporte[0]->pc->descripcion }}</label>
                            </div>
                            <div class="col-span-1">
                                <label for="" class=" text-gray-700 mt-4 w-2/4 text-lg font-semibold hidden md:!inline">Modelo: </label>
                                <label type="text" name="codigo" id="codigo" class="w-2/4 text-lg m-auto p-0 md:!p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{ $reporte[0]->pc->modelo }}</label>
                            </div>
                            <div class="col-span-1">
                                <label for="" class="hidden md:!inline text-gray-700 mt-4 w-2/4 text-lg font-semibold">Estado: </label>
                                <label type="text" name="codigo" id="codigo" class="w-2/4 text-lg m-auto p-0 pt-2 md:!p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{ $reporte[0]->pc->estado->descripcion }}</label>
                            </div>                              
                        </div>
                    @endif

                    @if($reporte[0]->laptop ?? false)
                        <div class="mt-4 grid md:grid-cols-2 grid-cols-1 md:gap-2">                         
                            <div class="col-span-1 pl-10 md:!pl-0">
                                <label for="" class="hidden md:!inline text-gray-700 w-2/4 m-auto text-lg font-semibold" >Codigo: </label>
                                <label type="text" name="codigo" id="codigo" class="text-2xl  p-0 md:!p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{ $reporte[0]->laptop->codigo }}</label>
                            </div>
                            <div class="col-span-1">
                                <label for="" class="hidden md:!inline text-gray-700 w-2/4 text-lg font-semibold" >Nombre: </label>
                                <label type="text" name="codigo" id="codigo" class="w-3/4 text-lg p-0 pt-2 md:!p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{ $reporte[0]->laptop->descripcion }}</label>
                            </div>
                            <div class="col-span-1">
                                <label for="" class="hidden md:!inline text-gray-700 mt-4 w-2/4 text-lg font-semibold">Modelo: </label>
                                <label type="text" name="codigo" id="codigo" class="w-2/4 text-lg m-auto p-0 md:!p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{ $reporte[0]->laptop->modelo }}</label>
                            </div>
                            <div class="col-span-1">
                                <label for="" class="hidden md:!inline text-gray-700 mt-4 w-2/4 text-lg font-semibold">Estado: </label>
                                <label type="text" name="codigo" id="codigo" class="w-2/4 text-lg p-0 m-auto pt-2 md:!p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{ $reporte[0]->laptop->estado->descripcion }}</label>
                            </div>                              
                        </div>
                    @endif

                    @if($reporte[0]->impresora ?? false)
                        <div class="mt-4 grid md:grid-cols-2 grid-cols-1 md:gap-2">                         
                            <div class="col-span-1 pl-10 md:!pl-0">
                                <label for="" class="hidden md:!inline text-gray-700 w-2/4 m-auto text-lg font-semibold" >Codigo: </label>
                                <label type="text" name="codigo" id="codigo" class="text-2xl  md:!p-2 p-0 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{ $reporte[0]->impresora->codigo }}</label>
                            </div>
                            <div class="col-span-1">
                                <label for="" class="hidden md:!inline text-gray-700 w-2/4 text-lg font-semibold" >Nombre: </label>
                                <label type="text" name="codigo" id="codigo" class="w-3/4 text-lg p-0 md:!p-2 pt-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{ $reporte[0]->impresora->descripcion }}</label>
                            </div>
                            <div class="col-span-1">
                                <label for="" class="hidden md:!inline text-gray-700 mt-4 w-2/4 text-lg font-semibold">Modelo: </label>
                                <label type="text" name="codigo" id="codigo" class="w-2/4 text-lg m-auto p-0 md:!p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{ $reporte[0]->impresora->modelo }}</label>
                            </div>
                            <div class="col-span-1">
                                <label for="" class="hidden md:!inline text-gray-700 mt-4 w-2/4 text-lg font-semibold">Estado: </label>
                                <label type="text" name="codigo" id="codigo" class="w-2/4 text-lg p-0 m-auto pt-2 md:!p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{ $reporte[0]->impresora->estado->descripcion }}</label>
                            </div>                              
                        </div>
                    @endif
                </div>
                <div class="md:mt-4 mt-3 md:!p-1 p-2">

                    <label for="" class="block  w-2/4 m-auto text-center text-2xl md:!mb-5 mb-1  text-red-600" >DATOS DEL USUARIO</label>
                    <div class="md:!mt-4 mt-2 grid md:grid-cols-2 grid-cols-1 md:gap-2">
                        <div class="col-span-1">
                            <label for="sucursal" class="hidden md:!inline text-gray-700 w-2/4 m-auto  font-semibold text-2xl" >Sucursal: </label>
                            <label type="text" name="codigo" id="codigo" class=" text-xl md:text-2xl m-auto p-0 md:!p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{ $reporte[0]->usuario->sucursal->nombre }}</label>
                        </div>
                        <div class="col-span-1">
                            <label for="usuario" class="hidden md:!inline text-gray-700 mt-4 w-2/4 text-lg font-semibold m-auto">Usuario: </label>
                            <label type="text" name="codigo" id="codigo" class=" text-lg m-auto p-0 pt-2  md:!p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{ $reporte[0]->usuario->descripcion }}</label>
                        </div>
                        <div class="col-span-1">
                            <label for="correo" class="hidden md:!inline text-gray-700 mt-4 w-2/4 text-lg font-semibold m-auto">Correo: </label>
                            <label type="text" name="codigo" id="codigo"  class="w-2/4 text-lg m-auto p-0 pt-2 md:!p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{ $reporte[0]->usuario->email }}</label>
                        
                        </div>
                        <div class="col-span-1 md:pt-2">
                            <label for="telefono" class="hidden md:!inline text-gray-700 mt-4 w-2/4 text-lg font-semibold m-auto">Teléfono: </label>
                            <label type="text" name="codigo" id="codigo"  class="w-2/4 text-lg m-auto p-0 pt-2 md:!p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{ $reporte[0]->usuario->phone }}</label>
                        </div>
                
                    </div>
                </div>
            </div>

        
        <!-- Sección 3: Datos del Reporte -->
            <div class="bg-white p-6 rounded-lg shadow-md md:col-span-1 col-span-4 w-11/12 mx-auto">
                <label for="" class="block  w-full m-auto text-center text-2xl mb-3  text-red-600" >DATOS DEL REPORTE</label>
                <label for="codigo" class="block text-gray-700 mt-1 w-2/4 text-lg font-semibold ">codigo: </label>
                <label for="codigo" class="w-full text-lg m-auto py-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{$reporte[0]->codigo}}</label>
                <label for="falla" class="block text-gray-700 mt-1 w-2/4 text-lg font-semibold ">tipo de falla: </label>
                <label for="falla" class="w-full text-lg m-auto py-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none">{{$reporte[0]->falla->desc}}</label>
                <label for="hora_generacion" class="block text-gray-700 mt-3 text-xl font-semibold">Tiempo de generación</label>
                <label for="hora_generacion" class="inline  text-gray-700 mt-2">dia: </label>
                <input type="text" name="codigo" id="codigo" value="{{ substr($reporte[0]->created_at, 0, 10) }}" class="w-2/4 p-2 border-none bg-transparent mt-2 rounded-md pointer-events-none focus:outline-none"readonly>
                <br>
                <label for="hora_generacion" class="inline  text-gray-700">hora: </label>
                <input type="text" name="codigo" id="codigo" value="{{ substr($reporte[0]->created_at, 11, 20) }}" class="w-2/4 p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none"readonly>
                <div class="mt-3"></div>
                <label for="riesgo" class="inline text-gray-700  text-2xl">Riesgo: </label>
                <input type="text" name="codigo" id="codigo" value="bajo" class="w-2/4 p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none text-sky-400"readonly>
                <div class="mt-2"></div>
                <label for="estado" class="inline text-gray-700 text-2xl">Estado: </label>
                @if($reporte[0]->status_id == 3)
                    <input type="text" name="verestado" id="verestado" readonly value="{{$reporte[0]->status->nombre}}" class="w-2/4 text-lg p-2 border-none bg-transparent rounded-md text-blue-700">
                @endif
                @if($reporte[0]->status_id == 2)
                    <input type="text" name="verestado" id="verestado" readonly value="{{$reporte[0]->status->nombre}}" class="w-2/4 text-lg p-2 border-none bg-transparent rounded-md text-green-700">
                @endif
                @if($reporte[0]->status_id == 1)
                    <input type="text" name="verestado" id="verestado" readonly value="{{$reporte[0]->status->nombre}}" class="w-2/4 text-lg p-2 border-none bg-transparent rounded-md text-orange-700">
                @endif
                @if($reporte[0]->status_id ==3)
                    <label for="hora_generacion" class="block text-gray-700 text-xl mb-2 mt-4">tiempo de solucion:</label>
                    <label for="hora_generacion" class="inline  text-sky-600">dia: </label>
                    <input type="text" name="solucion" id="solucion" value="{{ substr($reporte[0]?->tiempo_solucion, 0, 10)}}" class="w-2/4 p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none"readonly>
                    <br>
                    <label for="hora_generacion" class="inline  text-sky-600">hora: </label>
                    <input type="text" name="solucion" id="solucion" value="{{ substr($reporte[0]?->tiempo_solucion , 11, 20)}}" class="w-2/4 p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none"readonly>
                    <br>
                    <label for="hora_generacion" class="inline  text-sky-600">tiempo transcurrido: </label>
                    <input type="text" name="solucion" id="solucion" value="{{$tiempo}} horas" class="w-3/4 p-2 border-none bg-transparent rounded-md pointer-events-none focus:outline-none"readonly>
                @endif
            </div>
        
        </div>


        @if($reporte[0]?->solucionado_tecnico && $reporte[0]->status_id !=3)

            <div class="modal fade pt-40" id="confirmarsolucion" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content p-4">
                    <h2 id="tituloconfirmar" class="text-lg font-semibold text-center w-full p-2 rounded-lg">¿Confirmar solucion?</h2>
                    {{-- <p class="text-sm text-gray-600 text-center mt-3" id="texto">Esta acción registrara un nuevo modulo para este sistema.</p> --}}
                    <div class="mt-4 w-[99%] m-auto text-center">
                        <label for="tecnico" >Tecnico: </label>
                        @if($reporte[0]->status_id != 1)
                            <label for="nombret" id="nombret" class="text-center">{{$reporte[0]->tecnico->descripcion}}</label>
                            <br>
                            <label for="solucion" >solucionado mediante: </label>
                            @if($reporte[0]?->solucion?->tiposolucion)
                                <label for="solucionado" id="solucionado" class="text-center ">{{$reporte[0]->solucion->tiposolucion->descripcion}}</label>
                            @else
                                <label for="solucionado" id="solucionado" class="text-center ">sin informacion sobre la solucion</label>
                            @endif
                        @endif
                        </div>
                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <button id="confirmYes2" class="btn btn-primary text-white py-2 rounded" onclick="enviarconfirm()">
                            confirmar solucion
                        </button>
                        <button id="confirmYes2" class="btn btn-danger text-white  px-4 py-2 rounded" onclick="negar(event)">
                            Negar solucion
                        </button>

                        <button id="confirmNo2" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded col-span-2 w-[80%] mx-auto" onclick="$('#confirmarsolucion').modal('hide')">
                            Cancelar
                        </button>
                    </div>
                    </div>
                </div>
            </div>
        @endif


        <div class="bg-white md:!p-6 py-6 rounded-lg shadow-md md:w-11/12 mx-auto">
            <div class="text-center">
                <button id="toggle-mensajes" class=" text-blue-600 p-2 border-none rounded text-2xl bg-transparent" onclick="vermensajes()"><--ver mensajes--></button>
            </div>
            <div id="contenedor-mensajes" class="hidden mt-5">
                <div class="bg-white w-4/4 mt-20 border rounded md:!m-4 m-1 space-y-4">
                    <div class="max-h-[800px] overflow-y-scroll border-y-1 border-red-500 md:!m-4 m-2" id="contenedorscroll">
                        @foreach($mensajes1 as $item)
                            @if($item->usuario->roleid == 1 || $item->usuario->roleid ==2)
                                <!-- Mensaje alineado a la derecha -->
                                <div class="flex justify-end">
                                    <div class="bg-blue-100 text-gray-800 md:!p-3 p-2 rounded-lg shadow-md md:max-w-[50%] max-w-[80%] break-words md:!text-[16px] text-[12px]">
                                        {{$item->mensaje}}
                                        @if($item->imagen)
                                            <img src="{{ asset('storage/'.$item->imagen) }}" alt="" class="mt-4">
                                        @endif
                                    </div>
                                </div>
                                <h3 class="flex justify-end mb-4 text-gray-400 pr-2 md:!pt-2 pt-1 md:!text-[14px] text-[10px]">{{$item->usuario->descripcion}}</h3>
                            @else
                                <!-- Mensaje alineado a la izquierda -->
                                <div class="flex justify-start">
                                    <div class="bg-gray-100 text-gray-800 md:!p-3 p-2 rounded-lg shadow-md md:max-w-[50%] max-w-[80%] break-words md:!text-[16px] text-[12px]">
                                        {{ $item->mensaje }}
                                        @if($item->imagen)
                                            <img src="{{ asset('storage/'.$item->imagen) }}" alt="" class="mt-4">
                                        @endif
                                    </div>
                                </div>
                                <h3 class="flex mb-4 text-gray-400 pl-2 md:!pt-2 pt-1 md:!text-[14px] text-[10px]">{{$item->usuario->descripcion}}</h3>
                            @endif
                        @endforeach
                    </div>
                    <form action="#" method="POST" class=" border-gray-200 pt-1" id="formmensaje">
                        {{-- {{route ('enviar.solucion', [$reporte[0]->id])}} --}}
                        @csrf
                        <br>
                        <label for="" class=" w-full border-t-2 border-gray-200"></label>
                        <div class="grid grid-cols-8 gap-2">
                            @if($reporte[0]->status_id != 3)
                                @if(Auth::user()->roleid==1 || Auth::user()->roleid==2)
                                    
                                    <div class="md:col-span-7 col-span-8">
                                        <input type="text" name="problema1" id="problema1" readonly value="{{$reporte[0]->descripcion}}" hidden>
                                        
                                        <input type="text" id="tecnicomensaje" name="tecnicomensaje" value="{{Auth::user()->id}}" hidden>
                                        <textarea type="text" name="mensaje" id="mensaje" class="block w-full mt-2 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 min-h-[100px]" oninput="toggleButton()" maxlength="300"></textarea>
                                    </div>
                                @else
                    
                                    <div class="md:col-span-7 col-span-8">
                                        <textarea type="text" name="mensaje" id="mensaje" class="block w-full mt-2 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 min-h-[100px]" oninput="toggleButton()" maxlength="300"></textarea>
                                    </div>
            
                                @endif
                            @else
                            
                            @endif
                        
                            <input type="text" name="userid" id="userid" hidden value="{{Auth::user()->roleid}}">
                    
                            <input type="text" name="reporte" id="reporte" hidden value="{{$reporte[0]->id}}">
                            <input type="text" name="usuario" id="usuario" hidden value="{{Auth::user()->id}}">
                            <input type="text" name="tipo_reporte" name="tipo_reporte" value="2" hidden>
                            <input type="text" name="rol" id="rol" hidden value="{{Auth::user()->roleid}}">
                            <div class="md:col-span-1 col-span-8 pt-[8px] flex md:flex-col md:!w-full w-[80%] mx-auto justify-between">
                                @if($reporte[0]->status_id!=3)
                                    @if(Auth::user()->roleid ==1 || Auth::user()->roleid==2)
                                        <button class="bg-blue-500 text-white  hover:bg-blue-700  cursor-pointer rounded w-[35%] md:w-full md:!py-2 md:!text-[16px] text-[12px]" type="submit" onclick="enviarmensaje(event)" >enviar mensaje</button>
                                        <input type="text" name="tecnico" id="tecnico" value="{{Auth::user()->id}}" hidden>
                                    @else
                                        <button class="bg-blue-500 text-white  hover:bg-blue-700  cursor-pointer rounded w-[35%] md:w-full md:!py-2 md:!text-[16px] text-[12px]" type="submit" onclick="enviarmensaje(event)" >enviar respuesta</button>
                                    @endif
                                    {{-- <button class="bg-green-500 text-white py-2 hover:bg-green-700 cursor-pointer" type="submit">enviar foto</button> --}}

                                    <form id="uploadForm" action="#" method="POST" enctype="multipart/form-data">
                                        <input type="file" id="fileInput" name="file" accept="*" style="display: none;" onchange="showPreview(event)">
                                        <button type="button" onclick="document.getElementById('fileInput').click()" class="btn btn-success md:mt-2 w-[35%] md:w-full">imagen</button>
                                        
                                        {{-- <button type="submit">Enviar</button> --}}
                                    </form>
                                    
                                @endif
                            </div>
                            <div class="flex justify-center col-span-8">
                                <div id="imagePreview" style="margin-top: 20px;" class=""></div>
                                <div class="pl-2 pt-6" id="quitarimagen" hidden>
                                    <button onclick="quitarimg(event)"><i class="fa-regular fa-circle-xmark fa-2xl"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md mb-6 flex flex-col justify-center md:grid md:grid-cols-3 md:gap-2">
        
        
            <input type="text" name="solucion" id="solucion" value="{{$confirmar}}" hidden>


            @if($reporte[0]->status_id==3)

            @else
                @if(Auth::user()->roleid==1 && $confirmar ==1 || Auth::user()->roleid==2 && $confirmar ==1 )
                    <div></div>
                    <button id="openModal" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 mx-auto">cambiar estatus a solucionado</button>
                    @if ($reporte[0]->solucion)
                        <label for="solicitud" class="text-gray-400 pt-2 text-sm text-center">--Ya existe una solicitud pendiente para solucionar!--</label>
                    @endif
                    {{-- <a href="#" id="link" name="link" ><button name="boton" id="boton" class="px-6 py-2 bg-gray-400 text-white font-semibold rounded-md cursor-not-allowed mt-4">enviar solicitud para confirmar solucion</button></a> --}}
                @endif
                @if(Auth::user()->roleid == 3 && $reporte[0]->solucionado_tecnico ==1)
                    {{-- <a href="{{route('software.status', [$reporte[0]->id, Auth::user()->roleid, Auth::user()->lugar_id])}}" class=""><button class="btn btn-primary ">confirmar solucion</button></a> --}}
                    <div></div>
                    <button class="btn btn-primary" onclick="$('#confirmarsolucion').modal('show')">confirmar solucion</button>
                    <div></div>
                @endif
                @if(Auth::user()->roleid ==3 && $confirmar == 1 && $reporte[0]->solucionado_tecnico !=1)
                    <div></div>
                    <button id="openModalusuario" class="btn btn-primary " data-type="usuario">cambiar a solucionado</button>
                    <div></div>
                @endif
            @endif

            {{-- <button id="openModal" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Abrir Modal</button> --}}

    <!-- Modal -->
            <div id="modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white rounded-lg shadow-lg md:w-[500px] p-6">
                    <h2 class="text-xl font-semibold mb-4">Selecciona una opción</h2>

                    <!-- Formulario dentro del modal -->
                    <form id="modalForm" method="GET" action="{{route('cambiar.status', [$reporte[0]->id, Auth::user()->roleid, 0])}}">
                        @csrf
                        <label for="options" class="block text-sm font-medium text-gray-700 mb-2">Opciones</label>
                        <select id="options" name="options" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 mb-12 p-2 text-lg">
                            @foreach ($soluciones as $item)
                                <option value="{{$item->id}}">{{$item->descripcion}}</option>
                            @endforeach
                            {{-- <option value="otra">Otra</option> --}}
                        </select>

                        <input type="text" id="tecnico" name="tecnico" hidden value="{{Auth::user()->id}}">

                        <!-- Campo de texto opcional -->
                        <div id="extraField" class="">
                            <label for="extraInput" class="block text-sm font-medium text-gray-700 mb-2">Detalla el metodo de la solucion del problema</label>
                            <textarea id="extraInput" name="extraInput" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 h-40"></textarea>
                        </div>

                        <!-- Botones -->
                        <div class="mt-6 flex justify-end gap-4">
                            <button type="button" id="closeModal" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancelar</button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Enviar</button>
                        </div>
                    </form>
                    
                </div>
            </div>

            <div class="modal fade mt-[20%] h-[200px]" id="modalmensaje" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body text-center py-9">
                            <h1 id="mensaje">Ticket solucionado con exito!</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div id="modalusuario" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white rounded-lg shadow-lg w-[400px] p-6">
                    {{-- F<h2 class="text-xl font-semibold mb-4">Selecciona una opción</h2> --}}


                    @if(Auth::user()->roleid== 3)
                        <!-- Formulario dentro del modal -->
                        <form id="modalFormusuario" method="GET" action="{{route('cambiar.status', [$reporte[0]->id, Auth::user()->roleid, Auth::user()->lugar_id])}}">
                            @csrf
                            {{-- <label for="options" class="block text-sm font-medium text-gray-700 mb-2">Opciones</label>
                            <select id="options2" name="options2"  class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 mb-4">
                                @foreach ($soluciones as $item)
                                    <option value="{{$item->id}}">{{$item->descripcion}}</option>
                                @endforeach
                                <option value="otra">Otra</option>
                            </select> --}}

                            <!-- Campo de texto opcional -->
                            <div id="extraField2" class="">
                                <label for="extraInput2" class="block  text-gray-700 mb-2 text-lg font-medium">Escriba como se soluciono el problema</label>
                                <textarea id="extraInputusuario" name="extraInputusuario" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 h-28" placeholder="Ej: mediante chat, llamada, etc."></textarea>
                            </div>

                            <!-- Botones -->
                            <div class="mt-6 flex justify-end gap-4">
                                <button type="button" id="closeModalusuario" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancelar</button>
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Enviar</button>
                            </div>
                        </form>
                    @endif
                    
                </div>
            </div>


        </div>
    </div>
        

    <input type="text" hidden value="{{$rol[0]}}">

    
@endsection

<script src="../resources/jquery/jquery-3.6.0.min.js"></script>

<script>


    // document.addEventListener('DOMContentLoaded', function(){
    //     document.getElementById('toggle-mensajes').addEventListener('click', function () {
    //         const contenedor = document.getElementById('contenedor-mensajes');
    //         const boton = document.getElementById('toggle-mensajes');

    //         // Alternar clase 'hidden' para mostrar/ocultar
    //         if (contenedor.classList.contains('hidden')) {  
    //             contenedor.classList.remove('hidden');
    //             boton.textContent = '<--cerrar mensajes-->'; // Cambiar texto del botón
    //         } else {
    //             contenedor.classList.add('hidden');
    //             boton.textContent = '<--ver mensajes-->'; // Cambiar texto del botón
    //         }
    //     });
    // })

    function vermensajes(){
        const contenedor = document.getElementById('contenedor-mensajes');
        const boton = document.getElementById('toggle-mensajes');
        const contenedorMensajes = document.getElementById('contenedorscroll');

        
        if (contenedor.classList.contains('hidden')) {
            contenedor.classList.remove('hidden');
            contenedorMensajes.scrollTop = contenedorMensajes.scrollHeight;
            boton.textContent = '<--cerrar mensajes-->'; 
        } else {
            contenedor.classList.add('hidden');
            boton.textContent = '<--ver mensajes-->'; 
        }
    }

    function enviarsolucion(event){
        event.preventDefault();
        console.log('hola')
    }

    function enviarconfirm(){
        // console.log('hola');
        const formData = {
            reporte:$('#reporte').val(),
        }    
        $.ajax({
            url:'/confirmarsolucion',
            data: formData ,
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            success: function(response){
                $('#confirmarsolucion').modal('hide');
                $('#modalmensaje').modal('show');
                setTimeout(() => {
                    window.location.href = '{{ route('misreportes', ['id' => Auth::user()->sucursal]) }}';
                }, 2000);
            },
            error: function(xhr){
                $('#confirmarsolucion').modal('hide');
                $('#modalmensaje #mensaje').text('Ha ocurrido un error al confirmar la solucion!');
                $('#modalmensaje').modal('show');
                setTimeout(() => {
                    $('#modalmensaje').modal('hide');
                }, 2000);
            }
        })
    }
    

    $(document).ready(function(){
        const rol = $("#rol").val();
        console.log(rol);

        if(rol == 1){
            const openModalButton = document.getElementById('openModal');
            const modal = document.getElementById('modal');
            const closeModalButton = document.getElementById('closeModal');
            const optionsSelect = document.getElementById('options');
            const extraField = document.getElementById('extraField');
            const modalForm = document.getElementById('modalForm');

            openModalButton.addEventListener('click', () => {
                modal.classList.remove('hidden');

                
            });

            closeModalButton.addEventListener('click', () => {
                modal.classList.add('hidden');
            });


            // optionsSelect.addEventListener('change', () => {
            //     if (optionsSelect.value === 'otra') {
            //         extraField.classList.remove('hidden');
            //     } else {
            //         extraField.classList.add('hidden');
            //     }
            // });

        }else{
            const openModal2Button = document.getElementById('openModalusuario');   
            const modal2 = document.getElementById('modalusuario');
            const closeModal2Button = document.getElementById('closeModalusuario');
            // const optionsSelect = document.getElementById('options2');
            const extraField = document.getElementById('extraField2');
            // const modalForm = document.getElementById('modalFormusuario');

            openModal2Button.addEventListener('click', () => {
                modal2.classList.remove('hidden');

                
            });

            closeModal2Button.addEventListener('click', () => {
                modal2.classList.add('hidden');
            });

        }
        
        
    })

    function showPreview(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        var pantalla = window.innerWidth < 700;
        
        reader.onload = function() {
            const img = document.createElement("img");
            img.src = reader.result;
            if(pantalla){
                img.style.maxWidth = "300px";
                img.style.maxHeight = "250px";
            }else{
                img.style.maxWidth = "450px";
                img.style.maxHeight = "300px";
            }
            const imagePreview = document.getElementById("imagePreview");
            imagePreview.innerHTML = "";
            imagePreview.appendChild(img);
            console.log(img)
        }
        
        if (file) {
            reader.readAsDataURL(file);
            
        }

        $('#quitarimagen').removeAttr('hidden');

    }

    function quitarimg(event){
        event.preventDefault()
        let image = document.getElementById('imagePreview');
        image.innerHTML ='';
        $('#quitarimagen').attr('hidden', true);
        $('#fileInput').val('');
    }


    function enviarmensaje(event) {
        event.preventDefault();

        let formData = new FormData();
        formData.append('mensaje', $('#formmensaje #mensaje').val());
        formData.append('reporte', $('#formmensaje #reporte').val());
        formData.append('usuario', $('#formmensaje #usuario').val());
        formData.append('tipo_reporte', 2);
        formData.append('rol', $('#formmensaje #rol').val());
        if($('#userid').val() != 3){
            formData.append('tecnicomensaje', $('#formmensaje #tecnicomensaje').val());
        } 

        // Agregar la imagen si se seleccionó
        let fileInput = $('#fileInput')[0].files[0];
        if (fileInput) {
            formData.append('imagen', fileInput);
        }

        console.log(formData.get('reporte'));

        if(formData.get('mensaje').trim()==='' && !formData.get('imagen')){
            console.log('mensaje vacio');
        }else{
            $.ajax({
                url: '/enviar/solucion',
                data: formData,
                type: 'POST',
                processData: false,  // Importante para enviar archivos
                contentType: false,  // Importante para enviar archivos
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    location.reload();
                },
                error: function (xhr) {
                    console.log('Error al enviar el mensaje');
                    console.log(xhr);
                    $('#formmensaje #botonmensaje').removeAttr('disabled');
                    $('#formmensaje #botonmensaje2').removeAttr('disabled');
                }
            });
        }
    }

    function negar(event){
        event.preventDefault();

        const formData ={
            id:  $('#reporte').val(),
            tipo:2,
        }
        console.log(formData);

        $.ajax({
            url: '/negarsolucion',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                $('#confirmarsolucion').modal('hide');
                $('#modalmensaje #mensaje').text('Se ha negado la solucion del ticket');
                $('#modalmensaje').modal('show');
                setTimeout(() => {
                    location.reload();
                }, 2000);
            },
            error: function (xhr){
                $('#confirmarsolucion').modal('hide');
                $('#modalmensaje #mensaje').text('Ha ocurrido un error!');
                $('#modalmensaje').modal('show');
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }
        })
    }



</script>

{{-- {{route('cambiar.status', [$reporte[0]->id, Auth::user()->roleid])}} --}}
{{-- cambiar.status/' + reporte +  usuario --}}