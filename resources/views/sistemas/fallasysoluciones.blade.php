@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card border-0 shadow my-5">
            <div class="card-body md:!p-4 p-1">
                <div class="flex p-2 md:!p-0">
                    <button class="mb-4 md:w-3/4 md:pl-10 pt-2 md:!pt-0 m-auto text-red-600 font-semibold md:text-lg text-sm flex items-center justify-center" id="vertablaf">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                        </svg>
                        -- FALLAS DEL EQUIPOS --   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                    </svg>
                    </button>
                    <div class="">
                        <button type="button" class="btn btn-primary" id="openmodal1">
                            +
                           <span class="hidden md:inline">Agregar</span>
                        </button>
                    </div>
                </div>

                <input type="text" hidden value="{{Auth::user()->id}}" id="tecnico">
                
                

                <div class="m-auto max-w-7xl bg-white shadow-md rounded-lg overflow-x-auto" id="tablaf">
                    <table class="table-auto w-full border-collapse border-none border-gray-200 rounded-t-lg">
                        <thead class="bg-gray-800 text-white rounded-t-lg">
                            <tr>
                                <th class="p-4 text-center rounded-tl-lg hidden md:table-cell">DESCRIPCION</th>
                                <th class="p-4 text-center md:hidden">DATOS</th>
                                <th class="p-4 text-center hidden md:table-cell">NIVEL DE RIESGO</th>
                                <th class="p-4 text-center">OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forEach($fallas as $item)
                                <!-- Fila 1 -->                   
                                    <tr class="border-1 border-gray-200 hover:bg-gray-50">
                                        <td hidden id="id">{{$item->id}}</td>
                                        <td class="p-4 text-center hidden md:table-cell" nombre="nombre">{{$item->desc}}</td>
                                        <td class="p-1 text-left md:hidden"><h1 class="text-bold text-black text-xl">{{$item->desc}}</h1><p class="mt-2">{{$item->nivel->descripcion}}</p></td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->nivel->descripcion}}</td>
                                        <td hidden nivel="nivel">{{$item->nivel_riesgo}}</td>
                                        <td hidden solucion="solucion">{{$item->solucion?->solucion?? 'sin solucion'}}</td>
                                        <td class="text-center md:!p-4 p-2 flex justify-around">
                                            <button id="btnConsulta" class="bi btn btn-warning btn-sm w-10 h-10" data-type="pc"><i class="bi bi-pencil-square"></i></button>
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


    <div class="container-fluid">
        <div class="card border-0 shadow my-5">
            <div class="card-body md:!p-4 p-0">
                <div class="flex">
                    <button class="mb-4 md:w-3/4 md:pl-10 pt-4 m-auto text-red-600 font-semibold md:text-lg text-sm flex items-center justify-center" id="vertablaf">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                        </svg>
                        -- SOLUCIONES DE REPORTES --  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                    </svg>
                    </button>
                    <div class="">
                        <button type="button" class="btn btn-primary mt-4 mr-2 md:!p-0" id="openmodal2">
                            + <span class="hidden md:inline">Agregar</span>
                        </button>
                    </div>
                </div>
                

                <div class="m-auto max-w-7xl bg-white shadow-md rounded-lg overflow-x-auto" id="tablaf">
                    <table class="table-auto w-full border-collapse border-none border-gray-200 rounded-t-lg">
                        <thead class="bg-gray-800 text-white rounded-t-lg">
                            <tr>
                                <th class="p-4 text-center rounded-tl-lg hidden md:table-cell">DESCRIPCION</th>
                                <th class="p-1 text-center rounded-tl-lg md:hidden">DATOS</th>
                                <th class="p-4 text-center hidden md:table-cell">TIPO</th>
                                <th class="md:!p-4 p-2 text-center">OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forEach($soluciones as $item)
                                <!-- Fila 1 -->                   
                                    <tr class="border-1 border-gray-200 hover:bg-gray-50">
                                        <td hidden id="id">{{$item->id}}</td>
                                        <td class="p-4 text-center hidden md:table-cell" nombre="nombre">{{$item->descripcion}}</td>
                                        <td hidden categoria="categoria">{{$item->categoria}}</td>

                                        <td class="p-1 text-left md:hidden">
                                            <h1 class="text-bold text-black text-xl">{{$item->descripcion}}</h1>
                                            @if($item->categoria==1)
                                                <p class="mt-2">reportes de sistemas</p>
                                            @elseif($item->categoria==2)
                                                <p class="mt-2">reportes de equipos</p>
                                            @else
                                                <p class="mt-2">ambos tipos de reportes</p>
                                            @endif 
                                        </td>

                                        @if($item->categoria==1)
                                            <td class="p-4 text-center hidden md:table-cell">reportes de sistemas</td>
                                        @elseif($item->categoria==2)
                                            <td class="p-4 text-center hidden md:table-cell">reportes de equipos</td>
                                        @else
                                            <td class="p-4 text-center hidden md:table-cell">ambos tipos de reportes</td>
                                        @endif
                                        <td class="text-center md:!p-4 pt-3 flex md:justify-around justify-between">
                                            <button id="btnConsulta2" class="bi btn btn-warning btn-sm w-10 h-10"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger btn-sm w-10 h-10" id="borrars"><i class="bi bi-trash"></i></button>
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

    <div class="modal fade mt-[20%] h-[200px]" id="modalmensaje" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center py-9">
                    <h1 id="mensaje"></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade mt-[20%]" id="confirmar" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
              <h2 class="text-lg font-semibold text-center">¿Estás seguro?</h2>
              <p class="text-sm text-gray-600 text-center mt-2" id="texto"></p>
              <div class="mt-4 w-[99%] m-auto text-center">
                  <label for="bnombre" id="bnombre" class="text-center "></label>
                  <br>
                  <label for="bnivel" id="bnivel" class="text-center mt-2"></label>
              </div>
              <div class="flex justify-between mt-8">
                  <button id="confirmYes" class="btn btn-primary text-white px-4 py-2 rounded">
                      Sí, registrar
                  </button>
                  <button id="confirmNo" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                      Cancelar
                  </button>
              </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalconsulta" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
                <h2 class="text-lg font-semibold text-center mb-10">Datos de la falla</h2>


                <label for="descripcion">descripcion: </label>
                <input type="text" id="descripcion" name="descripcion" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 mb-10">

                <input type="text" name="idi" id="idi" hidden>
            
                <label for="selecmod">importancia: </label>
                <select name="selecmod" id="selecmod" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 mb-5">
                    @forEach($riesgos as $item)
                        <option value="{{$item->id}}">{{$item->descripcion}}</option>
                    @endforeach
                </select>

                <div class="w-11/12 mx-auto" id="divsoluciongeneral">
                    <h1 class="text-center mb-3 text-md">solucion general al problema:</h1>
                    <textarea name="" id="soluciongeneral" cols="30" rows="6" class="rounded-lg w-full p-1"></textarea>
                </div>

                <p id="act1-error" class="text-red-500 text-sm mb-5 m-auto" hidden>todos los campos son obligatorios!</p>

                {{-- <div id="divcheck" class="flex justify-between ">
                    <label for="">Solucion para el usuario:</label>
                    <input type="check" class="rounded-md">

                </div> --}}

                <div class="flex justify-between mt-8">
                    <button id="act1" class="btn btn-primary text-white px-4 py-2 rounded">
                        actualizar
                    </button>
                    <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded" onclick="$('#modalconsulta').modal('hide')">
                        Cancelar
                    </button>
                </div>


            </div>
        </div>
    </div>

    <div class="modal fade p-4" id="modalconsulta2" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
                <h2 class="text-lg font-semibold text-center mb-10">Datos de la solucion</h2>


                <label for="descripcion">descripcion: </label>
                <input type="text" id="descripcion" name="descripcion" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 mb-10">

                <input type="text" hidden id="idi">

                <label for="selecmod">categoria: </label>
                <select name="selecmod2" id="selecmod2" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 mb-5">
                    <option value="0">ambos tipos de reportes</option>
                    <option value="1">reportes de sistemas</option>
                    <option value="2">reportes de equipos</option>
                </select>

                <p id="act2-error" class="text-red-500 text-sm mb-5 m-auto" hidden>todos los campos son obligatorios!</p>

                <div class="flex justify-between mt-8">
                    <button id="act2" class="btn btn-primary text-white px-4 py-2 rounded">
                        actualizar
                    </button>
                    <button  class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded" onclick="$('#modalconsulta2').modal('hide')">
                        Cancelar
                    </button>
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
                <form action="{{route('falla.store')}}" method="POST">
                    @csrf

                    {{-- @if($vacio ==0)
                        <input type="text" name="sistema" id="sistema" hidden value="{{$modulos[0]->sistema->id}}">
                        <input type="text" name="modulo" id="modulo" hidden value="{{$modulos[0]->id}}">
                    @else --}}

                    {{-- @endif --}}

                    <label for="textbox" class="block mb-2 text-sm font-medium text-gray-700">descripcion del problema:</label>
                    <textarea id="descripcion" name="descripcion" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    <p id="descripcion-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
                    
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


    <div id="modal2" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50">
        <div class="relative mx-auto mt-20 bg-white rounded shadow-lg w-96">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-2 border-b">
                <h2 class="text-lg font-semibold">Nuevo solucion</h2>
                <button id="closeModal2_2" class="text-gray-500 hover:text-gray-700">
                    &times;
                </button>
            </div>

            <!-- Body -->
            <div class="p-4">
                <!-- Textbox -->
                <form action="#" method="POST">
                    @csrf

                    {{-- @if($vacio ==0)
                        <input type="text" name="sistema" id="sistema" hidden value="{{$modulos[0]->sistema->id}}">
                        <input type="text" name="modulo" id="modulo" hidden value="{{$modulos[0]->id}}">
                    @else --}}

                    {{-- @endif --}}

                    <label for="textbox" class="block mb-2 text-sm font-medium text-gray-700">descripcion la solucion:</label>
                    <textarea id="desc_s" name="desc_s" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                    <p id="desc_s-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
                    
                    <!-- Select -->
                    <label for="select" class="block mt-4 mb-2 text-sm font-medium text-gray-700">Tipo de reporte:</label>
                    <select id="tipo" name="tipo" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="0">Ambos tipo de reportes</option>
                        <option value="1">Reportes de sistemas</option>
                        <option value="2">Reportes de equipos</option>
                    </select>

                    <div class="flex px-4 pt-8 border-t justify-between">
                        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700" onclick="nuevasolucion(event)">
                            Guardar
                        </button>
                        <button id="closeModal22" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                            Cerrar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            
        </div>
    </div>

    <script src="../resources/jquery/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function(){

            const openmodal1 = document.getElementById('openmodal1');  
            const closeModal = document.getElementById('closeModal');
            const closeModal2 = document.getElementById('closeModal2');
            const modal = document.getElementById('modal');
            
            const openmodal2 = document.getElementById('openmodal2');  
            const closeModal2_2 = document.getElementById('closeModal2_2');
            const closeModal22 = document.getElementById('closeModal22');
            const modal2 = document.getElementById('modal2');

            openmodal1.addEventListener('click',()=>{
                modal.classList.remove('hidden');
            })
            closeModal.addEventListener('click', ()=>{
                event.preventDefault();
                modal.classList.add('hidden');
            })
            closeModal2.addEventListener('click', ()=>{
                event.preventDefault();
                modal.classList.add('hidden');
            })


            openmodal2.addEventListener('click',()=>{
                modal2.classList.remove('hidden');
            })
            closeModal2_2.addEventListener('click', ()=>{
                event.preventDefault();
                modal2.classList.add('hidden');
            })
            closeModal22.addEventListener('click', ()=>{
                event.preventDefault();
                modal2.classList.add('hidden');
            })



            $(document).on('click', '#btnConsulta', function(){
                var id = $(this).closest('tr').find('td[id]').text();
                var nivel = $(this).closest('tr').find('td[nivel]').text();
                var nombre = $(this).closest('tr').find('td[nombre]').text();
                var solucion = $(this).closest('tr').find('td[solucion]').text();
                let existe;

                if(solucion=='sin solucion'){
                    existe=0;
                }else{
                    existe=1;
                }

                console.log(nombre)
                console.log(nivel)
                console.log(id)
                console.log(existe);

                $('#modalconsulta #descripcion').val(nombre);
                $('#modalconsulta #idi').val(id);
                $('#modalconsulta #soluciongeneral').val(solucion);
                let select = document.getElementById("selecmod");

                if (select) {
                    select.value = nivel;
                }

                $('#modalconsulta').modal('show')


                $(document).on('click', '#act1', function(){
                    const formData ={
                        id:$('#modalconsulta #idi').val(),
                        nombre:$('#modalconsulta #descripcion').val(),
                        nivel:$('#modalconsulta #selecmod').val(),
                        solucion: $('#modalconsulta #soluciongeneral').val(),
                        tecnico: $('#tecnico').val(),
                        existe:existe,
                    };

                    if(formData.nombre.trim()==='' || formData.nivel.trim()===''){
                        $('#act1-error').removeAttr('hidden');
                    }else{
                        $('#act1-error').attr('hidden', true);
                        $('#confirmar #bnombre').text(formData.nombre);
                        $('#modalconsulta').modal('hide');
                        $('#confirmar').modal('show');
                        $('#confirmar #texto').text('esta accion actualizara los datos de esta falla!')

                        $(document).off('click', '#confirmYes').on('click', '#confirmYes', function(){
                            $.ajax({
                                url: 'actfalla',
                                data: formData,
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                                },
                                success: function(response){
                                    $('#mensaje').text('falla actualizada con exito!');
                                    $('#confirmar').modal('hide');
                                    $('#modalmensaje').modal('show');
                                    setTimeout(() => {
                                        location.reload();
                                    }, 3000);
                                },
                                error: function(xhr){
                                    $('#mensaje').text('ha ocurrido un error. intente de nuevo mas tarde!');
                                    $('#confirmar').modal('hide');
                                    $('#modalmensaje').modal('show');
                                    setTimeout(() => {
                                        location.reload();
                                    }, 3000);
                                }
                            })
                        });
                        $(document).off('click', '#confirmNo').on('click', '#confirmNo', function(){
                            $('#confirmar').modal('hide');
                            $('#modalconsulta').modal('show');
                        })

                    }
                })
            })


            $(document).on('click', '#btnConsulta2', function(){
                var id = $(this).closest('tr').find('td[id]').text();
                var categoria = $(this).closest('tr').find('td[categoria]').text();
                var nombre = $(this).closest('tr').find('td[nombre]').text();
                console.log(categoria);
                $('#modalconsulta2 #descripcion').val(nombre);
                $('#modalconsulta2 #idi').val(id);
                let select = document.getElementById("selecmod2");
                if (select) {
                    select.value = categoria;
                }
                $('#modalconsulta2').modal('show')

                $(document).on('click', '#act2', function(){
                    const formData = {
                        nombre:$('#modalconsulta2 #descripcion').val(),
                        id:$('#modalconsulta2 #idi').val(),
                        categoria:$('#modalconsulta2 #selecmod2').val(),
                    }

                    if(formData.nombre.trim()==='' || formData.categoria.trim()===''){
                        $('#act2-error').removeAttr('hidden');
                    }else{
                        $('#act2-error').attr('hidden', true);
                        $('#confirmar #bnombre').text(formData.nombre);
                        $('#modalconsulta2').modal('hide');
                        $('#confirmar').modal('show');

                        $(document).off('click', '#confirmYes').on('click', '#confirmYes', function(){
                            $.ajax({
                                url: 'actsolucion',
                                data:formData,
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                                },
                                success: function(response){
                                    $('#mensaje').text('solucion actualizada con exito!');
                                    $('#confirmar').modal('hide');
                                    $('#modalmensaje').modal('show');
                                    setTimeout(() => {
                                        location.reload();
                                    }, 3000);
                                },
                                error: function(xhr){
                                    $('#mensaje').text('ha ocurrido un error. intente de nuevo mas tarde!');
                                    $('#confirmar').modal('hide');
                                    $('#modalmensaje').modal('show');
                                    setTimeout(() => {
                                        location.reload();
                                    }, 3000);
                                }
                            })
                        })

                        $(document).off('click','#confirmNo').on('click', '#confirmNo', function(){
                            $('#confirmar').modal('hide');
                            $('#modalconsulta2').modal('show');
                        })

                    }
                })


            })

            

        })

        // function consulta1(){
        //         var id = $(this).closest('tr').find('td[id]').text();
        //         var nivel = $(this).closest('tr').find('td[nivel]').text();
        //         var nombre = $(this).closest('tr').find('td[nombre]').text();

        //         console.log(nombre)
        //         console.log(nivel)
        //         console.log(id)

        //         $('#modalconsulta #descripcion').val(nombre);
        //         $('#modalconsulta #idi').val(id);

        //         $('#modalconsulta').modal('show')
        //     }

        // function consulta2(){

        //     var id = $(this).closest('tr').find('td[id]').text();
        //     var categoria = $(this).closest('tr').find('td[categoria]').text();
        //     var nombre = $(this).closest('tr').find('td[nombre]').text();
            
        //     $('#modalconsulta2 #descripcion').val(nombre);
        //     $('#modalconsulta2 #idi').val(id);
        //     $('#modalconsulta2').modal('show')


        // }

        

        function nuevoproblema(event){
            event.preventDefault();

            const selec2 = document.getElementById('riesgo');
            const problematext = selec2.options[selec2.selectedIndex].text;

            const formData ={
                descripcion: $('#modal #descripcion').val(),
                riesgo: $('#modal #riesgo').val(),
            }

            console.log(formData);

            if(formData.descripcion.trim()===''){
                $('#descripcion-error').removeAttr('hidden');
            }else{
                $('#descripcion-error').attr('hidden', true);
                $('#modal').addClass('hidden');
                $('#confirmar #texto').text('esta accion registrara un nuevo problema.')
                $('#bnombre').text(formData.descripcion);
                $('#bnivel').text(problematext);
                $('#confirmar').modal('show');

                $('#confirmar #confirmYes2').attr('id', 'confirmYes');
                $('#confirmar #confirmNo2').attr('id', 'confirmNo');
                
                $(document).off('click','#confirmYes').on('click', '#confirmYes', function(){
                    console.log('aqui');
                    $.ajax({
                        url:'fallastore',
                        data: formData,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                        },
                        success: function(response){
                            $('#mensaje').text('problema registrado con exito!');
                            $('#confirmar').modal('hide');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                location.reload();
                            }, 3000);

                        },
                        error: function(xhr){
                            $('#mensaje').text('ha ocurrido un problema al hacer el registro!');
                            $('#confirmar').modal('hide');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                location.reload();
                            }, 3000);

                        }
                    })
                })
                $(document).on('click', '#confirmNo', function(){
                    console.log('aqui2')
                    $('#confirmar').modal('hide');
                    $('#modal').removeClass('hidden');
                    
                })
            }
        }

        function nuevasolucion(event){
            event.preventDefault();

            const selec = document.getElementById('tipo');
            const tipotext = selec.options[selec.selectedIndex].text;

            const formData = {
                desc:$('#desc_s').val(),
                tipo: $('#tipo').val(),
            };

            if(formData.desc.trim()===''){
                $('#desc_s-error').removeAttr('hidden');
            }else{
                $('#desc_s-error').attr('hidden', true);


                $('#confirmar #texto').text('esta accion registrara una nueva solucion.');
                $('#confirmar #bnombre').text(formData.desc);
                $('#confirmar #bnivel').text(tipotext);
                $('#modal2').addClass('hidden');
                $('#confirmar').modal('show');
                $('#confirmar #confirmYes').attr('id', 'confirmYes2');
                $('#confirmar #confirmNo').attr('id', 'confirmNo2');

                $(document).off('click', '#confirmYes2').on('click', '#confirmYes2', function(){
                    $.ajax({
                        url:'solucionstore',
                        data:formData,
                        type:'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                        },
                        success: function(response){
                            $('#mensaje').text('solucion registrada con exito!');
                            $('#confirmar').modal('hide');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                        },
                        error: function(xhr){
                            $('#mensaje').text('ha ocurrido un error, intentelo de nuevo');
                            $('#confirmar').modal('hide');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                        }

                    })
                })

                $(document).on('click', '#confirmNo2', function(){
                    $('#confirmar').modal('hide');
                    $('#modal2').removeClass('hidden');
                })

            }
        }


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
                    url: 'borrarfalla/' +id,
                    type:'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(response){
                        $('#mensaje').text('el tipo de falla ha sido borrado con exito!')
                        $('#confirmarborrar').modal('hide')
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            location.reload();
                        }, 3000);

                    },
                    error: function(xhr){
                        $('#mensaje').text('ha ocurrido un error al borrar la falla')
                        $('#confirmarborrar').modal('hide')
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

        $(document).on('click', '#borrars', function(){
            var id = $(this).closest('tr').find('td[id]').text();
            var nombre = $(this).closest('tr').find('td[nombre]').text();
            
            $('#confirmarborrar #bnombre').text(nombre)
            $('#confirmarborrar').modal('show');

            $('#confirmarborrar #confirmYesb').attr('id', 'confirmYesb2');
            $('#confirmarborrar #confirmNob').attr('id', 'confirmNob2');

            $(document).off('click', '#confirmYesb2').on('click', '#confirmYesb2', function(){
                $.ajax({
                    url: 'borrarsolucion/'+id,
                    type:'DELETE',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(response){
                        $('#mensaje').text('el tipo de solucion ha sido borrado con exito!')
                        $('#confirmarborrar').modal('hide')
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    },
                    error: function(xhr){
                        $('#mensaje').text('ha ocurrido un error al intentar borrar!')
                        $('#confirmarborrar').modal('hide')
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    }
                })
            })

            $(document).on('click', '#confirmNob2', function(){

            })


        })

    </script>


@endsection








