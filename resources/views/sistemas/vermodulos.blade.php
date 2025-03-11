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
                <form action="{{route('fallasoftware.store')}}" method="POST">
                    @csrf


                    <input type="text" name="sistema" id="sistema" hidden value="{{$modulo[0]->sistema->id}}">
                    <input type="text" name="modulo" id="modulo" hidden value="{{$modulo[0]->id}}">


                    <label for="textbox" class="block mb-2 text-sm font-medium text-gray-700">descripcion del problema:</label>
                    <textarea id="descripcion" name="descripcion" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>


                    <!-- Select -->
                    <label for="select" class="block mt-4 mb-2 text-sm font-medium text-gray-700">nivel de importancia:</label>
                    <select id="riesgo" name="riesgo" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                       @forEach($riesgos as $item)
                            <option value="{{$item->id}}">{{$item->descripcion}}</option>

                       @endforeach
                    </select>
                    <br>

                    <div class="flex px-4 pt-8 border-t justify-between">
                        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
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

                                        <td class="text-left p-1 pt-2 md:!pt-1  md:hidden" datos="datos"><h1 class="text-lg font-semibold">{{ \Illuminate\Support\Str::limit($item->codigo, 35, '...')}}</h1><p class="pt-2">{{$item->usuario->name}} || {{$item->usuario->sucursal->nombre}}</p>
                                            <p class="pt-1">{{$item->tecnico?->name?? 'sin tecnico'}}</p>
                                            <div class="flex pt-1">
                                                <p class="{{$color_status}}">{{$item->status->nombre}} </p><p class="mx-1"> | </p>
                                                <p class="{{$color}}"> {{$item->falla?->importancia?->descripcion?? 'sin informacion'}}</p>
                                            </div>
                                            
                                        </td>


                                        <td class="p-4 text-center hidden md:table-cell">{{$item->created_at}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->codigo}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->usuario->sucursal->nombre}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->usuario->name}}</td>
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
                        }else{
                            $('#modalfalla #solucionfalla').val('sin solucion');
                            $('#modalfalla #solucion').val(0);
                        }
                        $('#modalfalla #idfalla').val(data[0].id);
                        if(data[0].solucion){
                            $('#divcheck').removeClass('hidden');
                        }else{
                            $('#divcheck').addClass('hidden', true);
                        }


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


    </script>


@endsection