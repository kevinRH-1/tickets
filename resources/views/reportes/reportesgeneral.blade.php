@extends('layouts.app')
@section('content')

    <div class="w-11/12  bg-white shadow-lg rounded-lg flex items-center justify-between p-4 m-auto border-1 border-red-600">

        <h1></h1>

        <!-- Título en el centro -->
        <h1 class="text-lg font-semibold text-gray-800 text-center">
            Gestion de tickets || Hardware 
        </h1>

        <!-- Botón derecho -->
        <h1></h1>

        
    </div>

    <div name="divcantidades" class="flex justify-center items-center mt-7">
        <div class="md:flex md:space-x-4 md:justify-between md:w-11/12 m-auto text-white grid grid-cols-2">
            <div class="md:w-56 md:h-32 bg-emerald-500 md:rounded-lg p-6 md:shadow-md shadow-gray-700">
              <h1>TICKETS GENERADOS: {{$generados}} </h1>
            </div>
            <div class="md:w-56 md:h-32 bg-sky-600 md:rounded-lg p-6 md:shadow-md shadow-gray-700">
              <h1>TICKETS EN REVISION: {{$revision}} </h1>
            </div>
            <div class="md:w-56 md:h-32 bg-amber-500 md:rounded-lg p-6 md:shadow-md shadow-gray-700">
              <h1>TICKETS SOLUCIONADOS ULTIMAS 24H: {{$solucionados}}  </h1>
            </div>
            <div class="md:w-56 md:h-32 bg-purple-700 md:rounded-lg p-6 md:shadow-md shadow-gray-700">
              <h1>TICKETS TOTALES ULTIMAS 24H: {{$r24h}}</h1>
            </div>
        </div>
    </div>

    <div class="modal fade mt-[1%]" id="modalfiltro" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center py-9">
                    <div class="">
                        <label for="" class="block mb-6">FECHA: </label>
                        <div class="flex w-full justify-center">
                            <input type="date" id="filtrofecha1" name="filtrofecha1" class="ml-2 mb-2 pl-1 max-w-[130px] md:max-w-[200px] rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <h1 class="m-2 mt-2 text-1xl">hasta</h1>
                            <input type="date" name="filtrofecha2" id="filtrofecha2" class="ml-2 mb-2 pl-1 max-w-[130px] md:max-w-[200px] rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                        </div>
                        <label for="" class="block mt-10 mb-2">SUCURSAL DEL USUARIO: </label>
                        <select name="filtrosucursal" id="filtrosucursal" class="ml-2 mb-4 pl-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <option value="0">todas las sucursales</option>
                            @forEach($sucursales as $item)
                                <option value="{{$item->id}}">{{$item->nombre}}</option>
                            @endforeach
                        </select>
                        <div class="flex w-11/12 mx-auto justify-around">
                            <div>
                                <label for="" class="block mt-2 mb-2">TIPO DE MAQUINA: </label>
                                <select name="filtromaquina" id="filtromaquina" class="ml-2 mb-2 pl-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                    <option value="0">todos las maquinas</option>
                                    <option value="1">PC</option>
                                    <option value="2">Laptop</option>
                                    <option value="3">Impresora</option>
                                    
                                </select>
                            </div>
                            <div>
                                <label for="" class="block mt-4 mb-2">MIS TICKETS: </label>
                                <input type="checkbox" name="propios" id="propios" class="rounded-md mt-2">
                                <input type="text" hidden name="usuariotecnico" id="usuariotecnico" value="{{Auth::user()->id}}">
                            </div>
                        </div>
                        <label for="" class="block mt-4 mb-2">TIPO DE PROBLEMA: </label>
                        <select name="filtroproblema" id="filtroproblema" class="ml-2 mb-2 pl-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <option value="0">todos los problemas</option>
                            @forEach($fallas as $item)
                                <option value="{{$item->id}}">{{$item->desc}}</option>
                            @endforeach
                        </select>
                        <label for="" class="block mt-4 mb-2">ESTADO DEL REPORTE: </label>
                        <select name="filtroestado" id="filtroestado" class="ml-2 mb-2 pl-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <option value="0">todos los estados</option>
                            @forEach($estatus as $item)
                                <option value="{{$item->id}}">{{$item->nombre}}</option>
                            @endforeach
                        </select>
                        <p id="filtro-error" class="text-red-500 text-sm hidden">Debe llenar al menos una de las opciones!</p>
                        <div class="mb-10"></div>

                        <button class="block p-2 bg-emerald-500 rounded-md text-white w-40 m-auto" id="filtroboton">VER RESULTADOS</button>
                        <button class="block p-2 bg-emerald-500 rounded-md text-white w-50 m-auto mt-2" id="filtroboton" data-type='excel'>DESCARGAR EXCEL</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card border-0 shadow my-5">
            <div class="card-body md:!p-10 p-0">
                

                <div class="m-auto max-w-7xl bg-white shadow-md rounded-lg overflow-x-auto">
                    <button class="p-2 md:!mb-4 mb-2 bg-emerald-500 rounded-md text-white md:w-40 mt-2 md:!mt-0 ml-2 md:!ml-0" onclick="mostrarfiltro()">FILTRAR</button>
                    <table class="table-auto w-full border-collapse border-none border-gray-200 rounded-t-lg">
                        <thead class="bg-gray-800 text-white rounded-t-lg">
                            <tr>
                                <th class="p-2 text-center md:rounded-tl-lg"></th>
                                <th class="py-4 text-center hidden md:table-cell">FECHA DE CREACIÓN</th>
                                <th class="py-2 text-center md:hidden">DATOS</th>
                                <th class="p-4 text-center hidden md:table-cell">CÓDIGO</th>
                                <th class="p-4 text-center hidden md:table-cell">SUCURSAL</th>
                                <th class="p-4 text-center hidden md:table-cell">USUARIO</th>
                                <th class="p-4 text-center hidden md:table-cell">TECNICO</th>
                                <th class="p-4 text-center hidden md:table-cell">EQUIPO</th>
                                <th class="p-4 text-center hidden md:table-cell">PROBLEMA</th>
                                <th class="p-4 text-center hidden md:table-cell">NIVEL</th>
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
                                    <tr class="border-1 border-red-500 hover:bg-red-50 hover:cursor-pointer" id='fila'>
                                @elseif($item->status_id==3)
                                    <tr class="border-1 border-amber-500 hover:bg-amber-50 hover:cursor-pointer" id='fila'>
                                @elseif($item->status_id==2)
                                    <tr class="border-1 border-orange-700 hover:bg-orange-50 hover:cursor-pointer" id='fila'>
                                @elseif($item->status_id==4)
                                    <tr class="border-1 border-green-700 hover:bg-green-100 hover:cursor-pointer" id='fila'>
                                @elseif($item->status_id==5)
                                    <tr class="border-1 border-sky-500 hover:bg-sky-50 hover:cursor-pointer" id='fila'>
                                @else
                                    <tr class="border-1 border-gray-200 hover:bg-gray-50 hover:cursor-pointer" id='fila'>
                                @endif
                                        <td class="md:pl-4 p-1">
                                            @if($item->noti_t==1)
                                                <i class="fa-solid fa-circle-exclamation md:fa-xl" style="color: #ff0000;"></i>
                                            @else

                                            @endif
                                        </td>
                                        <td class="py-4 text-center hidden md:table-cell">{{$item->created_at}}</td>
                                        <td class="text-left p-1 pt-2 md:!pt-1  md:hidden" datos="datos"><h1 class="text-lg font-semibold">{{ \Illuminate\Support\Str::limit($item->codigo, 35, '...')}}</h1><p class="pt-2">{{$item->usuario->descripcion}} || {{$item->usuario->sucursal->nombre}}</p>
                                            <p class="pt-1">{{$item->tecnico?->descripcion?? 'sin tecnico'}}</p>
                                            <div class="flex pt-1">
                                                <p class="{{$color_status}}">{{$item->status->nombre}} </p><p class="mx-1"> | </p>
                                                <p class="{{$color}}"> {{$item->falla?->nivel?->descripcion?? 'sin informacion'}}</p>
                                            </div>
                                            
                                        </td>
                                        <td hidden id='id'>{{$item->id}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->codigo}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->usuario->sucursal->nombre}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->usuario->descripcion}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->tecnico?->descripcion?? 'sin tecnico'}}</td>
                                        @if($item->pc->descripcion?? false)
                                            <td class="p-4 text-center hidden md:table-cell">{{$item->pc->descripcion}}</td>
                                        @endif
                                        @if($item->laptop->descripcion?? false)
                                            <td class="p-4 text-center hidden md:table-cell">{{$item->laptop->descripcion}}</td>
                                        @endif
                                        @if($item->impresora->descripcion?? false)
                                            <td class="p-4 text-center hidden md:table-cell">{{$item->impresora->descripcion}}</td>
                                        @endif
                                        <td class="p-4 text-center hidden md:table-cell">{{ \Illuminate\Support\Str::limit($item->descripcion, 40, '...') }}</td>
                                        <td class="p-4 text-center hidden {{$color}} md:table-cell">{{$item->falla?->nivel?->descripcion?? 'sin informacion'}}</td>
                                        <td class="p-4 text-center {{$color_status}} hidden md:table-cell">{{$item->status->nombre}}</td>
                                        <td class="p-4 text-center">
                                            <a href="{{route ('reportes.detalles', [$item->id, Auth::user()->roleid])}}">
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
        let valido =true;

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
                maquina: $('#filtromaquina').val(),
                problema: $('#filtroproblema').val(),
                estado: $('#filtroestado').val(),
                usuario:$('#usuariotecnico').val(),
                check:$('#propios').prop('checked'),
                tipo: type,
            };

            console.log(formData);

            if (validarfiltro(formData)) {
                // Construir la URL con los parámetros
                let query = $.param(formData);
                let url = `/filtrosreportesH?${query}`;

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

    $(document).ready(function(){
        $(document).on('click', '#fila', function(){
           const id = $(this).closest('tr').find('td[id]').text()
           const usuario = {{Auth::user()->roleid}}
           console.log(id)
           console.log(usuario)
           url = '/reporte-detalles/'+ id + usuario;
           console.log(url)
           window.location.href = url
        })
    })
</script>