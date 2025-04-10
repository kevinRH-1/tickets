@extends('layouts.app')

@section('content')
    <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg p-6 mx-auto border border-red-600 mt-6">
        <h1 class="text-center font-semibold text-2xl">Subir nuevo video</h1>
    </div>

    <div class="container-fluid mt-6 w-3/4">
        <div class="card border-0 md:shadow-lg my-5 bg-transparent md:!bg-white">
            <div class="card-body md:!p-4 p-0">

                <form action="" method="POST" class="space-y-6">
                    @csrf {{-- Agrega CSRF si es necesario para seguridad --}}

                    <div>
                        <label for="nombre" class="block text-gray-700 font-medium">Nombre del video:</label>
                        <input 
                            type="text" 
                            name="nombre" 
                            id="nombre" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400"
                        >
                        <p id="nombrei-error" class="text-red-500 text-sm mt-2" hidden>Este campo es obligatorio!</p>
                    </div>

                    <div>
                        <label for="descripcion" class="block text-gray-700 font-medium">Descripción del video:</label>
                        <textarea 
                            name="descripcion" 
                            id="descripcion" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400"
                            maxlength="340"
                            rows="4"
                            placeholder=""
                        ></textarea>
                        <p id="descripcion-error" class="text-red-500 text-sm mt-2" hidden>Este campo es obligatorio!</p>
                    </div>

                    <div>
                        <label for="link" class="block text-gray-700 font-medium">Link del video:</label>
                        <input 
                            type="text" 
                            name="link" 
                            id="link" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400"
                        >
                        <p id="link-error" class="text-red-500 text-sm mt-2" hidden>Este campo es obligatorio!</p>
                        <p id="link-error2" class="text-red-500 text-sm mt-2" hidden>El link no es correcto!</p>
                    </div>

                    <div class="flex justify-center mt-6">
                        <button 
                            type="submit" 
                            class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none"
                            onclick="subirvideo(event)"
                        >
                            Subir video
                        </button>
                    </div>
                </form>

                {{-- Modal de mensaje --}}
                <div class="modal fade mt-[20%] h-[200px]" id="modalmensaje" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body text-center py-9">
                                <h1 id="mensaje" class="text-xl font-semibold"></h1>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal de confirmación --}}
                <div class="modal fade pt-40" id="confirmar" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content p-6">
                            <h2 class="text-lg font-semibold text-center">¿Estás seguro?</h2>
                            <p id="tituloconfirmar" class="text-center font-medium text-gray-700 mt-4">Esta acción registrará este video en el sistema.</p>
                            
                            <div class="mt-4 w-[99%] m-auto text-center">
                                <label for="nombre" id="nombre" class="text-gray-800 font-medium"></label>
                            </div>

                            <div class="flex justify-between mt-8">
                                <button 
                                    id="confirmsi" 
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                                >
                                    Sí, subir
                                </button>
                                <button 
                                    id="confirmno" 
                                    class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400"
                                    onclick="$('#confirmar').modal('hide')"
                                >
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


<script>


    function obtenerIdYoutube(url) {
        try {
            const urlObj = new URL(url);
            const urlParams = new URLSearchParams(urlObj.search);
            return urlParams.get("v") || null;
        } catch (error) {
            console.error("URL no válida:", error);
            return null;
        }
    }

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

        if(!form.codigo||form.codigo==null){
            valido=false;
            $('#link-error2').removeAttr('hidden');
        }else{
            $('#link-error2').attr('hidden', true);
        }

        return valido;


    }

    function subirvideo(event){
        event.preventDefault();

        let link= $('#link').val();
        let codigo = obtenerIdYoutube(link);

        const formData = {
            link: link,
            nombre: $('#nombre').val(),
            descripcion: $('#descripcion').val(),
            codigo: codigo,
        }

        console.log(formData);

        if(validar(formData)){


            $('#confirmar #nombre').text(formData.nombre);
            $('#confirmar').modal('show');
            $(document).off('clicl', '#confirmsi').on('click', '#confirmsi', function(){
                $.ajax({
                    url: '/create-video',
                    data:formData,
                    type:'POST',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                    },
                    success: function(response){
                        $('#mensaje').text('video registrado con exito!')
                        $('#confirmar').modal('hide');
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    },
                    error: function(xhr){
                        $('#mensaje').text('Ha ocurrido un error, intente de nuevo!')
                        $('#confirmar').modal('hide');
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    }
                })
            })

        }else{
            console.log('datos invalidos')
        }

    }
</script>