@extends('layouts.app')

@section('content')
    <br>

    <div class="md:w-11/12  bg-white shadow-lg rounded-lg flex items-center justify-between md:!p-4 p-2 m-auto border-1 border-red-600">

        <h1></h1>

        <!-- Título en el centro -->
        <h1 class="text-lg font-semibold text-gray-800 text-center">
            Sistemas Actuales
        </h1>

        <!-- Botón derecho -->
        <button id="openmodal" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            +<span class="hidden md:inline">Agregar sistema</span>
        </button>

        
    </div>

    <div id="modal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-50">
        <div class="relative mx-auto mt-20 bg-white rounded shadow-lg w-96">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-2 border-b">
                <h2 class="text-lg font-semibold">Nuevo sistema</h2>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    &times;
                </button>
            </div>

            <!-- Body -->
            <div class="p-4">
                <!-- Textbox -->
                <form action="" method="POST">
                    @csrf


                    <label for="textbox" class="block mb-2 text-sm font-medium text-gray-700">codigo del sistema:</label>
                    <input type="text" name="codigo" id="codigo" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p id="codigo-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
                    <label for="textbox" class="block mb-2 text-sm font-medium text-gray-700">nombre del sistema:</label>
                    <input type="text" name="nombre" id="nombre" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p id="nombre-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
                    <br>

                    <div class="flex px-4 pt-8 border-t justify-between">
                        <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700" onclick="nuevosistema(event)">
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
                        <input type="text" name="id" id="id" hidden>
                        


                        <label for="textbox" class="block mb-2 text-sm font-medium text-gray-700">codigo:</label>
                        <input type="text" maxlength="20" name="codigo" id="codigo" class="w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p id="codigo-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>

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

    


    @forEach($sistemas as $item)
        @if(Auth::user()->roleid==1)
            <a href="{{route ('sistemas.ver', [$item->id])}}" class="w-4/5 m-auto h-full">
                <div class="md:space-y-20 space-y-10 mt-8 mb-4">
                    <div class="flex justify-between items-center bg-white px-4 rounded-lg shadow-md h-32">
                        <input type="text" id="id-{{$item->id}}" name="id" hidden value="{{$item->id}}">
                        <div class="mt-12">
                            <span class="text-xl " class="mt-14" id="nombrespan-{{$item->id}}">{{$item->nombre}}</span>
                        </div>
                        <div class="text-right flex ">
                            <div class="hidden md:flex">
                                <h2 class="text-sm text-center font-semibold mr-10">{{$item->reportes_mes}}<br> ultimos 30 dias</h2>
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
            <a href="{{route ('sistemas.ver', [$item->id])}}" class="w-4/5 m-auto h-full ">
                <div class="space-y-20 mt-8 mb-4">
                    <div class="flex justify-between items-center bg-white px-4 rounded-lg shadow-md  h-32">
                        <input type="text" id="id-{{$item->id}}" name="id" hidden value="{{$item->id}}">
                        <div class="">
                            <span class="text-xl " class="mt-2" id="nombrespan-{{$item->id}}">{{$item->nombre}}</span>
                        </div>
                        <div class="text-right flex">
                            <div class="flex">
                                <h2 class="text-sm text-center font-semibold mr-10">{{$item->reportes_mes}}<br> ultimos 30 dias</h2>
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
        const openModal = document.getElementById('openmodal');
        const closeModal = document.getElementById('closeModal');
        const closeModal2 = document.getElementById('closeModal2');
        const modal = document.getElementById('modal');

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

        function validar(form){
            let esValido = true;

            if (!form.nombre || form.nombre.trim() === "") {
                $("#modal #nombre-error").removeAttr('hidden');
                esValido = false;
            }else{
                $("#modal #nombre-error").attr('hidden', true);
            }

            if (!form.codigo || form.codigo.trim() === "") {
                $("#modal #codigo-error").removeAttr('hidden');
                esValido = false;
            }else{
                $("#modal #codigo-error").attr('hidden', true);
            }

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

            if (!form.codigo || form.codigo.trim() === "") {
                $("#modalact #codigo-error").removeAttr('hidden');
                esValido = false;
            }else{
                $("#modalact #codigo-error").attr('hidden', true);
            }

            return esValido
        }

        function nuevosistema(event){
            event.preventDefault();
            const formData = {
                codigo:$('#modal #codigo').val(),
                nombre:$('#modal #nombre').val(),

            };
            if(validar(formData)){
                $('#confirmar #texto').text('Esta accion registrara un nuevo sistema');
                $('#confirmar #confirmYes').text('Si, registrar');
                $('#confirmar #confirmYes').removeClass('btn-danger');
                $('#confirmar #confirmYes').addClass('btn-primary');
                $('#confirmar #confirmYes').attr('id', 'confirmYes2');
                $('#modal').removeAttr('hidden');

                $('#confirmar').modal('show');

                $(document).off('click', '#confirmYes2');

                $(document).on('click', '#confirmYes2', function(){
                    $.ajax({
                        url:'/sistemastore',
                        type:'POST',
                        data:formData,
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                        },
                        success: function(response){
                            $('#mensaje').text('Sistema registrado con exito!');
                            $('#confirmar').modal('hide');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                location.reload();
                            }, 2500);
                        },
                        error:function(xhr){
                            $('#confirmar').modal('hide')
                            $('#mensaje').text('ha ocurrido un error, intentelo de nuevo!');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                $('#modalmensaje').modal('hide');
                            }, 2500);
                        }
                    })

                })
                $(document).on('click', '#confirmNo', function() {
                // Cierra el modal sin hacer nada
                $('#confirmar').modal('hide');
            });

            }
        }

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

        function cerrarmodal(event){
            event.preventDefault();
            $('#modalact').modal('hide');
        }

        // Cierra el menú si se hace clic fuera de él
        document.addEventListener('click', (event) => {
            document.querySelectorAll('[id^="dropdown-menu-"]').forEach(menu => {
            if (!menu.contains(event.target) && !event.target.closest('button[id^="menu-button-"]')) {
                menu.classList.add('hidden');
            }
            });
        });

        function handleModify(id) {
            const inputId = document.getElementById(`id-${id}`).value;
            console.log('Modificar:', { id: inputId });

            $.ajax({
                url: '/sistemadatos/'+ inputId,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                },
                success: function(data){   
                    $('#modalact #nombre').val(data.nombre);
                    $('#modalact #codigo').val(data.codigo);
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

        function actualizar(event){
            event.preventDefault();
            const formData = {
                nombre: $('#modalact #nombre').val(),
                codigo: $('#modalact #codigo').val(),
                id:$('#modalact #id').val(),
            };
            if(validar2(formData)){
                $('#confirmar #confirmYes').attr('id', 'confirmYes3');
                $('#confirmar #confirmYes2').attr('id', 'confirmYes3');
                $('#texto').text('Esta accion actualizara los datos de este sistema!')
                $('#confirmYes3').text('Si, registrar');
                $('#confirmar #bnombre').text(formData.nombre);
                $('#confirmYes3').removeClass('btn-danger');
                $('#confirmYes3').addClass('btn-primary');
                $('#modalact').modal('hide');
                $('#confirmar').modal('show');

                $(document).off('click', '#confirmYes3');

                $(document).on('click', '#confirmYes3', function(){
                    $.ajax({
                        url: '/sistema/act/'+formData.id,
                        type: 'POST',
                        data: formData,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                        },
                        success: function(response){
                            $('#mensaje').text('Los datos del sistema se han actualizado con exito!');
                            $('#confirmar').modal('hide');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                location.reload();
                            }, 2500);
                        },
                        error: function(xhr){
                            $('#mensaje').text('ha ocurrido un error, intentelo de nuevo!');
                            $('#confirmar').modal('hide');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                $('#modalmensaje').modal('hide');
                            }, 2500);
                        }
                    });
                });

                $(document).on('click', '#confirmNo', function() {
                    // Cierra el modal sin hacer nada
                    $('#confirmar').modal('hide');
                });
            }
        }

        function handleDelete(id) {
            const inputId = document.getElementById(`id-${id}`).value;
            const nombre = $('#nombrespan-'+id).text();
            console.log('Eliminar:', { id: inputId, nombre });
            $('#confirmar #confirmYes2').attr('id', 'confirmYes');
            $('#tituloconfirmar').addClass('bg-red-600');
            $('#tituloconfirmar').addClass('text-white');
            $('#texto').text('Esta accion eliminara este sistema! esta accion no es reversible y hara cambios en los registros actuales!')
            $('#confirmar').modal('show');
            $('#confirmYes').text('Si, eliminar')
            $('#bnombre').text(nombre);

            $(document).off('click', '#confirmYes');

            $(document).on('click', '#confirmYes', function() {
                console.log(inputId);
                if (inputId) {
                    $.ajax({
                        url: '/sistema/delete/'+inputId,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                        },
                        success: function(response) {
                            $('#confirmar').modal('hide')
                            $('#mensaje').text('sistema borrado con exito!');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                location.reload();
                            }, 2500);
                            
                        },
                        error: function(xhr) {
                            $('#confirmar').modal('hide')
                            $('#mensaje').text('ha ocurrido un error, intentelo de nuevo!');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                $('#modalmensaje').modal('hide');
                            }, 2500);
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




    </script>
@endsection
