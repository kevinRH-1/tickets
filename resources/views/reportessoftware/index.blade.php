@extends('layouts.app')

@section('content')

    <div class="w-11/12  bg-white shadow-lg rounded-lg flex items-center justify-between p-4 m-auto border-1 border-red-600">

        <h1></h1>

        <!-- Título en el centro -->
        <h1 class="text-lg font-semibold text-gray-800 text-center">
            Gestion de tickets || Sistemas
        </h1>

        <!-- Botón derecho -->
        <h1></h1>

        
    </div>

    <div name="divcantidades" class="flex justify-center items-center mt-7">
        <div class="md:flex md:space-x-4 md:justify-between md:w-11/12 m-auto grid grid-cols-2 text-white">
            <div class="md:w-56 md:h-32 bg-emerald-500 md:rounded-lg p-6 md:shadow-md shadow-gray-700">
              <h1>TICKETS GENERADOS: {{$generados}} </h1>
            </div>
            <div class="md:w-56 md:h-32 bg-sky-600 md:rounded-lg p-6 md:shadow-md shadow-gray-700">
              <h1>TICKETS EN REVISION: {{$revision}} </h1>
            </div>
            <div class="md:w-56 md:h-32 bg-amber-500 md:rounded-lg p-6 md:shadow-md shadow-gray-700">
              <h1>TICKETS SOLUCIONADOS ULTIMAS 24H: {{$solucionados24}}  </h1>
            </div>
            <div class="md:w-56 md:h-32 bg-purple-700 md:rounded-lg p-6 md:shadow-md shadow-gray-700">
              <h1>TICKETS TOTALES ULTIMAS 24H: {{$totales24}}</h1>
            </div>
        </div>
    </div>


    <div class="modal fade pt-[20%] md:!pt-0" id="modalfiltro" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center px-1 py-9 overflow-auto">
                    <div class="">
                        <label for="" class="block mb-6">FECHA: </label>
                        <div class="flex w-full justify-center">
                            <input type="date" id="filtrofecha1" name="filtrofecha1" class="ml-2 mb-2 pl-1 max-w-[130px] md:max-w-[200px] rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <h1 class="m-2 mt-2 text-1xl">hasta</h1>
                            <input type="date" name="filtrofecha2" id="filtrofecha2" class="ml-2 mb-2 pl-1 max-w-[130px] md:max-w-[200px]  rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>
                        <label for="" class="block mt-4 mb-2">SUCURSAL DEL USUARIO: </label>
                        <select name="filtrosucursal" id="filtrosucursal" class="ml-2 mb-2 pl-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <option value="0">todas las sucursales</option>
                            @forEach($sucursales as $item)
                                <option value="{{$item->id}}">{{$item->nombre}}</option>
                            @endforeach
                        </select>
                        <div class="flex w-11/12 mx-auto justify-around">
                            <div>
                                <label for="" class="block mt-4 mb-2">SISTEMA DEL TICKET: </label>
                                <select name="filtrosistema" id="filtrosistema" class="ml-2 mb-2 pl-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                    <option value="0">todos los sistemas</option>
                                    @forEach($sistemas as $item)
                                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="" class="block mt-4 mb-2">MIS TICKETS: </label>
                                <input type="checkbox" name="propios" id="propios" class="rounded-md mt-2">
                                <input type="text" hidden name="usuariotecnico" id="usuariotecnico" value="{{Auth::user()->id}}">
                            </div>
                        </div>
                        <label for="" class="block mt-4 mb-2">ESTADO DEL REPORTE: </label>
                        <select name="filtroestado" id="filtroestado" class="ml-2 mb-2 pl-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <option value="0">todos los estados</option>
                            @forEach($estatus as $item)
                                <option value="{{$item->id}}">{{$item->nombre}}</option>
                            @endforeach
                        </select>
                        <label for="" class="block mt-4 mb-2">NIVEL DE IMPORTANCIA: </label>
                        <select name="filtronivel" id="filtronivel" class="ml-2 mb-2 pl-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <option value="10">todos los estados</option>
                            <option value="0">sin informacion</option>
                            @forEach($nivel as $item)
                                <option value="{{$item->id}}">{{$item->descripcion}}</option>
                            @endforeach
                        </select>
                        
                        <p id="filtro-error" class="text-red-500 text-sm hidden">Debe llenar al menos una de las opciones!</p>
                        <div class="mb-10"></div>

                        <button class="block p-2 bg-emerald-500 rounded-md text-white w-40 m-auto" id="filtroboton" data-type="filtro">VER RESULTADOS</button>
                        <button class="block p-2 bg-emerald-500 rounded-md text-white w-50 m-auto mt-2" id="filtroboton" data-type='excel'>DESCARGAR EXCEL</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mb-10">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-0 md:!p-10">
                

                <div class="m-auto max-w-7xl bg-white shadow-md rounded-lg overflow-x-auto">
                    <button class="p-2 md:mb-4 mb-2 bg-emerald-500 rounded-md text-white md:w-40 mt-2 md:mt-0  ml-2 md:ml-0" onclick="mostrarfiltro()">FILTRAR</button>
                    <table class="table-auto w-full border-collapse border-none border-gray-200 rounded-t-lg" id="tabla">
                        <thead class="bg-gray-800 text-white rounded-t-lg">
                            <tr>
                                <th class="p-2 text-center md:rounded-tl-lg"></th>
                                <th class="p-2 text-center  md:hidden">DATOS</th>
                                <th class="py-4  text-center hidden md:table-cell">FECHA DE CREACIÓN</th>
                                <th class="p-4 text-center hidden md:table-cell">CÓDIGO</th>
                                <th class="p-4 text-center hidden md:table-cell">SUCURSAL</th>
                                <th class="p-4 text-center hidden md:table-cell">USUARIO</th>
                                <th class="p-4 text-center hidden md:table-cell">TECNICO</th>
                                <th class="p-4 text-center hidden md:table-cell">SISTEMA</th>
                                <th class="p-4 text-center hidden md:table-cell">MODULO</th>
                                <th class="p-4 text-center hidden md:table-cell">PROBLEMA</th>
                                <th class="p-2 text-center hidden md:table-cell">NIVEL DE IMPORTANCIA</th>
                                <th class="p-2 text-center hidden md:table-cell">ESTADO</th>
                                <th class="p-2 md:text-center text-left">VER</th>
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
                                        <td class="md:pl-4 p-1">
                                            @if($item->noti_t==1)
                                                <i class="fa-solid fa-circle-exclamation md:fa-xl" style="color: #ff0000;"></i>
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
                                        <td class="py-4 text-center hidden md:table-cell">{{$item->created_at}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->codigo}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->usuario->sucursal->nombre}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->usuario->descripcion}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->tecnico?->descripcion?? 'sin tecnico'}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->sistema->nombre}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->modulo?->nombre?? 'sin modulo'}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{ \Illuminate\Support\Str::limit($item->falla?->descripcion ?? $item->mensajes[0]->mensaje, 40, '...') }}</td>
                                        <td class="p-4 text-center {{$color}} hidden md:table-cell">{{$item->falla?->importancia?->descripcion?? 'sin informacion'}}</td>
                                        <td class="p-2 text-center {{$color_status}} hidden md:table-cell">{{$item->status->nombre}}</td>
                                        <td class="p-2 md:text-center text-left">
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

    



@endsection

<script src="../resources/jquery/jquery-3.6.0.min.js"></script>
<script>

    function validarfiltro(form){
        let valido = true;

        // if(form.fecha1.trim()=='' && form.fecha2.trim()==''&& form.sucursal==0 && form.sistema ==0 && form.){
        //     valido = false;
        //     $('#filtro-error').removeClass('hidden');
        // }else{
        //     $('#filtro-error').addClass('hidden', true)
        // }
        
        return valido;
    }


    function mostrarfiltro(){
        $('#modalfiltro').modal('show');

        

        $(document).off('click', '#filtroboton').on('click','#filtroboton', function(){
            var type = $(this).data('type');
            const formData ={
                fecha1: $('#filtrofecha1').val(),
                fecha2: $('#filtrofecha2').val(),
                sucursal: $('#filtrosucursal').val(),
                sistema: $('#filtrosistema').val(),
                estado: $('#filtroestado').val(),
                nivel: $('#filtronivel').val(),
                usuario:$('#usuariotecnico').val(),
                check:$('#propios').prop('checked'),
                tipo: type,
            };

            console.log(formData);

            if (validarfiltro(formData)) {
                // Construir la URL con los parámetros
                let query = $.param(formData);
                let url = `/filtrosreportesS?${query}`;

                // Redirigir a la página con los filtros
                window.location.href = url;
            } else {
                console.log('Formulario inválido');
            }

            
        } )
    }
    function truncateText(text, maxLength) {
        return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
    }
</script>