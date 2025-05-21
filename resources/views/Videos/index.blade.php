@extends('layouts.app') {{-- O el layout que estés usando --}}

@section('content')
    <div class="w-full max-w-4xl bg-white shadow-lg rounded-lg p-6 mx-auto border border-red-600 mt-6">
        <div class="flex justify-between">
            <div></div>
            <h1 class="text-center font-semibold text-2xl mb-6">Listado de videos</h1>
            <a href="{{route('agregar.video')}}"><button class="btn btn-primary h-10">Agregar</button></a>
        </div>
        

        <input 
            type="text" 
            id="buscadorVideos" 
            placeholder="Buscar por nombre..." 
            class="w-full mb-6 px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-red-400"
        >

        <div id="listaVideos">
            @forelse ($videos as $item)
                <div class="relative flex flex-col md:flex-row mb-6 border-b pb-4 video-item" data-nombre="{{ Str::lower($item->nombre) }}">
                    <input type="text" id="id-{{$item->id}}" name="id" hidden value="{{$item->id}}">
                    <a href="{{$item->link}}">
                        <img 
                            src="https://img.youtube.com/vi/{{$item->codigo}}/hqdefault.jpg" 
                            alt="Miniatura de {{ $item->nombre }}" 
                            class="w-full md:w-48 rounded-lg shadow-md mb-4 md:mb-0 md:mr-6"
                        >
                    </a>
                    <div class="relative text-center md:text-left md:!w-3/4 w-full">
                        <div class="absolute top-0 left-0">
                            <h1></h1>
                            @if($item->anuncio == 0)
                                <button class="btn btn-light btn-sm" data-id="{{ $item->id }}" data-anuncio="0" onclick="marcar(this)">
                                    <i class="fa-regular fa-bookmark" style="color: #000000;"></i>
                                </button>
                            @else
                                <button class="btn btn-light btn-sm" data-id="{{ $item->id }}" data-anuncio="1" onclick="marcar(this)">
                                    <i class="fa-solid fa-bookmark" style="color: #FFD43B;"></i>
                                </button>
                            @endif

                        </div>
                        <h2 class="text-xl font-bold mb-2 nombre-video w-3/4 mx-auto">{{ $item->nombre }}</h2>
                        <p class="text-gray-700">{{ $item->descripcion }}</p>
                    </div>
                    <span id="nombrespan-{{$item->id}}" hidden>{{$item->nombre}}</span>
                    <div class="absolute right-0 top-0 w-16 h-4 rounded-md shadow-md">
                        <button 
                            id="menu-button-{{$item->id}}" 
                            class="inline-flex justify-center w-full rounded-md border-none shadow-md text-xl px-1 bg-gray-100 font-medium text-gray-700"
                            aria-expanded="true"
                            aria-haspopup="true"
                            onclick="toggleMenu(event, {{$item->id}})"
                        >
                            ...
                        </button>
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
            @empty
                <p class="text-center text-gray-500">No hay videos disponibles.</p>
            @endforelse
        </div>

        <div class="modal fade mt-[20%] h-[200px]" id="modalmensaje" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body text-center py-9">
                        <h1 id="mensaje" class=""></h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade mt-[20%]" id="confirmar" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-header bg-red-600 border-none">
                    <h2 id="tituloconfirmar" class="text-lg font-semibold text-center w-full p-1 rounded-lg">¿Estás seguro?</h2>
                </div>
                <div class="modal-content p-4 rounded-none border-none">
                    <p class="text-sm text-gray-600 text-center mt-3" id="texto">Esta acción quitara este equipo de esta sucursal.</p>
                    <div class="mt-2 w-[99%] m-auto text-center">
                        <label for="bnombre" id="bnombre" class="text-center "></label>
                    </div>
                    <div class="flex justify-between mt-4">
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

        
        <div id="modalact" class="modal fade">
            <div class="modal-dialog w-3/4 md:!w-full modal-lg  relative mx-auto mt-20 bg-white rounded shadow-lg">
                <div class="modal-content">
                <!-- Header -->
                    <div class="flex items-center justify-between px-1 py-2 border-b">
                        <h2 class=" pl-3 text-lg font-semibold">Actualizar Datos</h2>
                        <button id="" class="btn btn-danger text-white" onclick="$('#modalact').modal('hide')">
                            X
                        </button>
                    </div>

                    <!-- Body -->
                    <div class="p-4 grid grid-cols-3 gap-3">
                        <div class="md:!col-span-1 col-span-3 md:!p-1 p-2 md:!mt-4">
                            <img id="imagen" src="" alt="" class="w-full rounded-md">
                        </div>
                        <input type="text" id="idvid" name="idvid" hidden>
                        <input type="text" id="oldlink" name="oldlink" hidden value="">
                        <div class="md:!col-span-2 col-span-3">
                            <h1 class="mt-1 mb-2 font-semibold text-gray-700 text-lg text-center">NOMBRE DEL VIDEO:</h1>
                            <div class="md:!w-[80%] w-full mx-auto">
                                <textarea name="nombreact" id="nombreact"  rows="2" class="w-full block border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-1"></textarea>
                                <p id="nombrei-error" class="text-red-500 text-sm mt-2" hidden>Este campo es obligatorio!</p>
                            </div>
                            <h1 class="mt-2 mb-2 font-semibold text-gray-700 text-lg text-center">LINK DEL VIDEO:</h1>
                            <div class="md:!w-[80%] w-full mx-auto">
                                <textarea name="linkact" id="linkact"  rows="2" class="w-full block border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-1"></textarea>
                                <p id="link-error" class="text-red-500 text-sm mt-2" hidden>Este campo es obligatorio!</p>
                        <p id="link-error2" class="text-red-500 text-sm mt-2" hidden>El link no es correcto!</p>
                            </div>
                        </div>
                        <div class="col-span-3">
                            <div class="text-center">
                                <h1 class="mb-2 font-semibold">DESCRIPCION DEL VIDEO:</h1>
                                <textarea name="descripcionact" id="descripcionact" rows="6" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-1"></textarea>
                                <p id="descripcion-error" class="text-red-500 text-sm mt-2" hidden>Este campo es obligatorio!</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="w-[94%] mx-auto mb-2 flex justify-end">
                            <button class="btn btn-primary" onclick="actualizarvid()">actualizar</button>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                
            </div>
        </div>
        



    </div>


    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const input = document.getElementById('buscadorVideos');
                const videos = document.querySelectorAll('.video-item');

                input.addEventListener('input', function () {
                    const filtro = this.value.toLowerCase();

                    videos.forEach(video => {
                        const nombre = video.getAttribute('data-nombre');

                        if (filtro.length < 3) {
                            video.style.display = '';
                        } else {
                            if (nombre.includes(filtro)) {
                                video.style.display = '';
                            } else {
                                video.style.display = 'none';
                            }
                        }
                    });
                });
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

            document.addEventListener('click', (event) => {
                document.querySelectorAll('[id^="dropdown-menu-"]').forEach(menu => {
                if (!menu.contains(event.target) && !event.target.closest('button[id^="menu-button-"]')) {
                    menu.classList.add('hidden');
                }
                });
            });

            function handleModify(id) {
                const inputId = document.getElementById(`id-${id}`).value;
                // console.log('Modificar:', { id: inputId });
                 $('#link-error2').attr('hidden',true);
                 $('#nombrei-error').attr('hidden', true);
                 $('#descripcion-error').attr('hidden', true);
                 $('#link-error').attr('hidden', true);


                $.ajax({
                    url:'detalles_video/'+inputId,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(data){
                        console.log(data)
                        $('#modalact #imagen').attr('src', `https://img.youtube.com/vi/${data.codigo}/hqdefault.jpg`)
                        $('#modalact #linkact').val(data.link);
                        $('#modalact #oldlink').val(data.link);
                        $('#modalact #descripcionact').val(data.descripcion);
                        $('#modalact #idvid').val(data.id);
                        $('#modalact #nombreact').val(data.nombre);
                        $('#modalact').modal('show');                      
                    },
                    error: function(xhr) {
                        setTimeout(() => {
                            $('#modalmensaje').modal('hide');
                        }, 3000);
                    }
                }) 
            }

            // function obtenerIdYoutube(url) {
            //     try {
            //         const urlObj = new URL(url);
            //         const urlParams = new URLSearchParams(urlObj.search);
            //         return urlParams.get("v") || null;
            //     } catch (error) {
            //         console.error("URL no válida:", error);
            //         return null;
            //     }
            // }

            function obtenerIdYoutube(url) {
                try {
                    const urlObj = new URL(url);

                    // Si la URL es del formato largo: youtube.com/watch?v=VIDEO_ID
                    if (urlObj.hostname.includes("youtube.com")) {
                        const urlParams = new URLSearchParams(urlObj.search);
                        return urlParams.get("v") || null;
                    }

                    // Si la URL es del formato corto: youtu.be/VIDEO_ID
                    if (urlObj.hostname.includes("youtu.be")) {
                        const pathSegments = urlObj.pathname.split("/");
                        return pathSegments.length > 1 ? pathSegments[1] : null;
                    }

                    return null; // No es un enlace válido de YouTube
                } catch (error) {
                    console.error("URL no válida:", error);
                    return null;
                }
            }

            // https://youtu.be/-4YwX0kFaBs?si=mPmB02cyaoqnJfpK

            function validar(form){
                let valido = true;

                if(!form.nombre||form.nombre.trim()===''){
                    valido =false;
                    $('#nombrei-error').removeAttr('hidden');
                }else{
                    $('#nombrei-error').attr('hidden', true);
                }

                if(!form.descripcion||form.descripcion.trim()===''){
                    valido =false;
                    $('#descripcion-error').removeAttr('hidden');
                }else{
                    $('#descripcion-error').attr('hidden', true);
                }

                if(!form.link||form.link.trim()===''){
                    valido =false;
                    $('#link-error').removeAttr('hidden');
                }else{
                    $('#link-error').attr('hidden', true);
                }
                if('codigo' in form){
                    
                    if(!form.codigo||form.codigo==null){
                        valido=false;
                        $('#link-error2').removeAttr('hidden');
                    }else{
                        $('#link-error2').attr('hidden', true);
                    }
                }else{
                    $('#link-error2').attr('hidden', true);
                }

                return valido;
            }

            function actualizarvid(){
                const formData = {
                    id:$('#modalact #idvid').val(),
                    link:$('#modalact #linkact').val(),
                    descripcion:$('#modalact #descripcionact').val(),
                    nombre:$('#modalact #nombreact').val(),
                }

                if(formData.link != $('#modalact #oldlink').val()){
                    let codigo = obtenerIdYoutube(formData.link)
                    formData.codigo = codigo;
                }

                if(validar(formData)){
                    $.ajax({
                        url:'actualizar_video',
                        data:formData,
                        type:'POST',
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                        },
                        success: function(response){
                            $('#mensaje').text('Los datos del video se han actualizado con exito!');
                            $('#modalact').modal('hide');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                location.reload();
                            }, 2500);
                        },
                        error: function(xhr){
                            $('#mensaje').text('ha ocurrido un error al actualizar los datos!');
                            $('#modalact').modal('hide');
                            $('#modalmensaje').modal('show');
                            setTimeout(() => {
                                location.reload();
                            }, 2500);
                        }
                    })
                }else{
                    console.log('error');
                }

                console.log(formData);
            }

            function handleDelete(id) {
                const inputId = document.getElementById(`id-${id}`).value;
                const nombre = $('#nombrespan-'+id).text();
                console.log('Eliminar:', { id: inputId, nombre });
                $('#confirmar #confirmYes2').attr('id', 'confirmYes');
                $('#tituloconfirmar').addClass('bg-red-600');
                $('#tituloconfirmar').addClass('text-white');
                $('#texto').text('Esta accion eliminara este video!')
                $('#confirmar').modal('show');
                $('#confirmYes').text('Si, eliminar');
                $('#bnombre').text(nombre);

                $(document).off('click', '#confirmYes');

                $(document).on('click', '#confirmYes', function() {
                    console.log(inputId);
                    if (inputId) {
                        $.ajax({
                            url: 'delete_video/'+inputId,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                            },
                            success: function(response) {
                                $('#confirmar').modal('hide')
                                $('#mensaje').text('video borrado con exito!');
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


            function marcar(el) {
                const button = $(el);
                const id = button.data('id');
                const estadoActual = button.data('anuncio');
                const nuevoEstado = estadoActual === 0 ? 1 : 0;

                $.ajax({
                    url: '/marcar-anuncio', // Ruta a tu controlador
                    method: 'POST',
                    data: {
                        id: id,
                        anuncio: nuevoEstado,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Cambiar ícono visualmente
                        const icono = button.find('i');

                        if (nuevoEstado === 1) {
                            icono.removeClass('fa-regular').addClass('fa-solid');
                            icono.css('color', '#FFD43B');
                        } else {
                            icono.removeClass('fa-solid').addClass('fa-regular');
                            icono.css('color', '#000000');
                        }

                        // Actualizar atributo
                        button.data('anuncio', nuevoEstado);
                    },
                    error: function() {
                        alert('Error al actualizar el estado.');
                    }
                });
            }

        </script>
    @endpush


@endsection
