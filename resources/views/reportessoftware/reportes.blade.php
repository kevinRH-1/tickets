@extends('layouts.app')

@section('content')

<div class="w-11/12  bg-white shadow-lg rounded-lg flex items-center justify-between p-3 py-2 m-auto border-1 border-red-600">
    <h1></h1>
    <div class="flex items-center justify-between w-11/12 m-auto p-4 py-2">
        <h1 class="md:text-xl font-bold mx-auto">Mis Tickets | {{Auth::user()->sucursal->nombre}}</h1>     
    </div>
    <a href="{{route ('reportessoftware.create')}}" class="text-blue-500 hover:underline"><button class="btn btn-primary btn-sm">crear nuevo</button></a>
</div>

    <div class="container-fluid">
        <div class="card border-0 shadow my-5">
            <div class="card-body md:!p-10 p-0">
                
                

                <div class="m-auto max-w-7xl bg-white shadow-md rounded-lg overflow-x-auto ">
                    <table class="table-auto w-full border-collapse border-none border-gray-200 rounded-t-lg">
                        <thead class="bg-gray-800 text-white rounded-t-lg">
                            <tr>
                                <th class="p-2 text-center rounded-tl-lg"></th>
                                <th class="py-4 text-center md:hidden">DATOS</th>
                                <th class="py-4 text-center  hidden md:table-cell">FECHA DE CREACIÓN</th>
                                {{-- <th class="p-4 text-left">CÓDIGO</th> --}}
                                <th class="p-4 text-center hidden md:table-cell">USUARIO</th>
                                <th class="p-4 text-center hidden md:table-cell">TECNICO</th>
                                <th class="p-4 text-center hidden md:table-cell">SISTEMA</th>
                                <th class="p-4 text-center hidden md:table-cell">MODULO</th>
                                <th class="p-4 text-center hidden md:table-cell">PROBLEMA</th>
                                <th class="p-4 text-center hidden md:table-cell">ESTATUS</th>
                                <th class="p-4 text-center rounded-tr-lg">VER</th>
                                
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
                                    <tr class="border-1 border-gray-200 hover:bg-amber-50">
                                @endif
                                    <td class="md:!pl-4 p-1">
                                        @if($item->noti_u==1)
                                            <i class="fa-solid fa-circle-exclamation md:fa-xl" style="color: #ff0000;"></i>
                                        @else

                                        @endif
                                    </td>
                                    <td class="text-left p-1 pt-2 md:!pt-1  md:hidden" datos="datos"><h1 class="text-lg font-semibold">{{ \Illuminate\Support\Str::limit($item->codigo, 35, '...')}}</h1><p class="pt-2">{{$item->usuario->descripcion}} || {{$item->usuario->sucursal->nombre}}</p>
                                        <p class="pt-1">{{$item->tecnico?->descripcion?? 'sin tecnico'}}</p>
                                        <div class="flex pt-1">
                                            <p class=" {{$color_status}}">{{$item->status->nombre}}</p>
                                            <p class="mx-1">|</p>
                                            <p class=" {{$color}}">{{$item->falla?->importancia?->descripcion?? 'sin informacion'}}</p>
                                        </div>
                                    </td>
                                    <td class="p-4 text-center hidden md:table-cell">{{ substr($item->created_at, 0, 10) }} <br> {{ substr($item->created_at, 11, 20) }}</td>
                                    {{-- <td class="p-4">{{$item->codigo}}</td> --}}
                                    <td class="p-4 text-center hidden md:table-cell" nombre='nombre'>{{$item->usuario->descripcion}}</td>
                                    <td class="p-4 text-center hidden md:table-cell" nombre='nombre'>{{$item->tecnico?->descripcion?? 'sin tecnico'}}</td>
                                    <td class="p-4 text-center hidden md:table-cell" sistema='sistema'>{{$item->sistema->nombre}}</td>
                                    <td class="p-4 text-center hidden md:table-cell">{{$item->modulo?->nombre?? 'sin modulo'}}</td>
                                    <td class="p-4 text-center hidden md:table-cell" problema='problema'>{{ \Illuminate\Support\Str::limit($item->falla?->descripcion ?? $item->mensajes[0]->mensaje, 50, '...') }}</td>
                                    <td class="p-2 text-center {{$color_status}} hidden md:table-cell">{{$item->status->nombre}}</td>  
                                    <td hidden id='id'>{{$item->id}}</td>
                                    @if($item->status_id==1)
                                        <td class="p-4 text-left flex md:justify-between md:flex-row flex-col">
                                    @else
                                        <td class="p-4 text-center items-center justify-center">
                                    @endif
                                        <a href="{{route('reporte.ver', [$item->id, Auth::user()->roleid])}}">
                                            <button class="bg-teal-500 text-white p-2 rounded hover:bg-teal-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 3a7 7 0 100 14 7 7 0 000-14zm3.707 7.707a1 1 0 01-1.414 0L10 8.414l-2.293 2.293a1 1 0 11-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 010 1.414z" />
                                                </svg>
                                            </button>
                                        </a>
                                        @if ($item->status_id==1)
                                            <button class="btn btn-danger btn-sm w-9 h-9 md:ml-2 md:!mt-0 mt-3" id="borrar"><i
                                                class="bi bi-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                    
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4 p-2">
                        {{ $reportes->links() }}
                    </div>
                    <div id="confirmModal" tabindex="1" class="fixed inset-0 z-10 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
                        <div class="bg-white rounded-lg shadow-lg p-6 w-80">
                            <h2 class="text-lg font-semibold text-center">¿Estás seguro?</h2>
                            <p class="text-sm text-gray-600 text-center mt-2">Esta acción eliminará este ticket.</p>
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
                    <div class="modal fade mt-[20%] h-[200px]" id="modalmensaje" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body text-center py-9">
                                    <h1 id="mensaje">el ticket ha sido borrado con exito!</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<script src="../resources/jquery/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        var idToDelete = null; // Variable para almacenar el ID del usuario a eliminar

        // Mostrar el modal de confirmación al hacer clic en "Borrar"
        $(document).on('click', '#borrar', function(event) {

            // Almacena el ID del usuario
            idToDelete = $(this).closest('tr').find('td[id]').text();
            const nombre = $(this).closest('tr').find('td[nombre]').text();
            const sistema = $(this).closest('tr').find('td[sistema]').text();
            const problema = $(this).closest('tr').find('td[problema]').text();

            $('#bnombre').text(nombre);
            $('#bcorreo').text(sistema);
            $('#bsucursal').text(problema);

            // Muestra el modal
            $('#confirmModal').removeClass('hidden');
        });

        // Acción al confirmar "Sí, eliminar"
        $(document).on('click', '#confirmYes', function() {
            console.log(idToDelete)
            if (idToDelete) {
                $.ajax({
                    url: 'reportes/borrar/' + idToDelete,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(response) {
                        $('#confirmModal').addClass('hidden');
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    },
                    error: function(xhr) {
                        $('#confirmModal').addClass('hidden');
                        $('#modalmensaje #mensaje').text('ha ocurrido un error al intentar borrar el ticket');
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            $('#modalmensaje').modal('hide');
                        }, 2000);
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
</script>