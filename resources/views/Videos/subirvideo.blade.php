@extends('layouts.app')

@section('content')

    <div class="w-full bg-white shadow-lg rounded-lg items-center  p-4 m-auto border-1 border-red-600">

        <h1 class="text-center font-semibold text-lg">Subir nuevo video</h1>
    </div>


    <div class="container-fluid">
        <div class="card border-0 md:shadow my-5 bg-transparent md:!bg-white">
            <div class="card-body md:!p-4 p-0 ">
                <form action="">
                    <label for="link">Nombre del video:</label>
                    <input type="text" name="nombre" id="nombre">
                    <p id="nombrei-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
                    <br>
                    <label for="link">Link del video:</label>
                    <input type="text" name="link" id="link">
                    <p id="link-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
                    <p id="link-error2" class="text-red-500 text-sm " hidden>El link no es correcto!</p>

                    <button class="btn btn-primary" onclick="subirvideo(event)">subir</button>

                </form>


                <div class="modal fade mt-[20%] h-[200px]" id="modalmensaje" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body text-center py-9">
                                <h1 id="mensaje"></h1>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade pt-40" id="confirmar" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content p-4">
                            <h2 class="text-lg font-semibold text-center">¿Estás seguro?</h2>
                            <h2 id="tituloconfirmar" class="text-lg font-semibold text-center w-full p-2 rounded-lg">esta accion registrara este video en el sistema</h2>
                        
                        <div class="mt-4 w-[99%] m-auto text-center">
                            <label for="nombre" id="nombre"  class="mb-4"></label>
                        </div>
                        <div class="flex justify-between mt-8">
                            <button id="confirmsi" class="btn btn-primary text-white px-4 py-2 rounded">
                                Sí, subir
                            </button>
                            <button id="confirmno" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded" onclick="$('#confirmar').modal('hide')">
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