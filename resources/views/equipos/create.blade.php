@extends('layouts.app')

@section('content')

    <div class="w-full bg-white rounded-lg flex justify-center p-8 mb-16 border-1 border-red-600" >
        <h1 class="text-xl font-semibold">Registrar un nuevo equipo</h1>
    </div>


    
    <form  method="POST" id="formpc" class="p-6 bg-white rounded-lg shadow-lg max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 mb-2">
        @csrf
        <!-- Código -->
        
        <input type="text" id="tipo" name="tipo" hidden value="{{$tipo}}">

        <div class="col-span-2 md:col-span-1">
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Nombre del equipo</label>
            <input 
                type="text" 
                name="descripcion" 
                id="descripcion" 
                class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Nombre del equipo">
            <p id="nombre-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
        </div>

        <!-- Sucursal -->
        <div class="col-span-2 md:col-span-1">
            <label for="lugarpc" class="block text-sm font-medium text-gray-700">Sucursal</label>
            <select 
                name="lugarpc" 
                id="lugarpc" 
                class="w-full max-w-[300px] appearance-none mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                {{-- <option value="">Sin sucursal</option> --}}
                @foreach ($sucursales as $item)
                    <option class="max-w-[300px] appearance-none" value="{{ $item->id }}">{{ $item->nombre }}</option>
                @endforeach
            </select>
        </div>
    
        <input type="text" name="categoria" id="categoria" value="{{$tipo}}" hidden>
    
        <!-- Marca -->
        <div class="col-span-2 md:col-span-1">
            <label for="marca" class="block text-sm font-medium text-gray-700">Marca</label>
            <input 
                type="text" 
                name="marca" 
                id="marca" 
                class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Marca del equipo">
            <p id="marca-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
        </div>
    
        <!-- Modelo -->
        <div class="col-span-2 md:col-span-1">
            <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo</label>
            <input 
                type="text" 
                name="modelo" 
                id="modelo" 
                class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Modelo del equipo">
            <p id="modelo-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
        </div>
    
        <!-- Procesador -->
        @if($tipo !=3)
            <div class="col-span-2 md:col-span-1">
                <label for="procesador" class="block text-sm font-medium text-gray-700">Procesador</label>
                <input 
                    type="text" 
                    name="procesador" 
                    id="procesador" 
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Procesador del equipo">
                <p id="procesador-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
            </div>
        
            <!-- RAM -->
            <div class="col-span-2 md:col-span-1">
                <label for="ram" class="block text-sm font-medium text-gray-700">RAM</label>
                <input 
                    type="text" 
                    name="ram" 
                    id="ram" 
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Cantidad de RAM">
                <p id="ram-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
            </div>
        
            <!-- Almacenamiento -->
            <div class="col-span-2 md:col-span-1">
                <label for="almacenamiento" class="block text-sm font-medium text-gray-700">Almacenamiento</label>
                <input 
                    type="text" 
                    name="almacenamiento" 
                    id="almacenamiento" 
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Capacidad de almacenamiento">
                <p id="almacenamiento-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
            </div>
        @endif
    
        <!-- Descripción -->
        
    
        <!-- Estado -->
        <div class="col-span-2 md:col-span-1">
            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
            <select 
                name="estado" 
                id="estado" 
                class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach ($estados as $item)
                    <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                @endforeach
            </select>
        </div>
    
        <!-- Botón -->
        <div class="col-span-2 md:mt-6 md:mx-auto md:w-2/4">
            <button class="w-full bg-indigo-600  text-white px-4 py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" onclick="registrar(event)">
                Agregar
            </button>
        </div>
    </form>
    <div class="modal fade mt-[20%] h-[200px]" id="modalmensaje" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center py-9">
                    <h1 id="mensaje">Equipo registrado con exito!</h1>
                    <br>
                    <p class="parrafo">Volviendo a la pagina anterior...</p>
                </div>
            </div>
        </div>
      </div>
      <div class="modal fade mt-[20%]" id="confirmar" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
              <h2 class="text-lg font-semibold text-center">¿Estás seguro?</h2>
              <p class="text-sm text-gray-600 text-center mt-2" id="texto">Esta accion registrara este nuevo equipo!</p>
              <div class="mt-4 w-[99%] m-auto text-center">
                  <label for="bnombre" id="bnombre" class="text-center "></label>
                  <br>
                  <label for="bcorreo" id="bmarca" class="text-center mt-2"></label>
                  <br>
                  <label for="bsucursal" id="bsucursal" class="text-center mt-2"></label>
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

@endsection


<script>
    function validar(form){
        let valido = true;

        if(!form.descripcion||form.descripcion.trim()===''){
            $('#nombre-error').removeAttr('hidden');
            valido = false;
        }else{
            $('#nombre-error').attr('hidden', true);
        }

        if(!form.marca||form.marca.trim()===''){
            $('#marca-error').removeAttr('hidden');
            valido = false;
        }else{
            $('#marca-error').attr('hidden', true);
        }

        if(!form.modelo||form.modelo.trim()===''){
            $('#modelo-error').removeAttr('hidden');
            valido = false;
        }else{
            $('#modelo-error').attr('hidden', true);
        }

        if(!form.procesador||form.procesador.trim()===''){
            $('#procesador-error').removeAttr('hidden');
            valido = false;
        }else{
            $('#procesador-error').attr('hidden', true);
        }

        if(!form.ram||form.ram.trim()===''){
            $('#ram-error').removeAttr('hidden');
            valido = false;
        }else{
            $('#ram-error').attr('hidden', true);
        }

        if(!form.almacenamiento||form.almacenamiento.trim()===''){
            $('#almacenamiento-error').removeAttr('hidden');
            valido = false;
        }else{
            $('#almacenamiento-error').attr('hidden', true);
        }

        return valido;
    }

    function registrar(event){
        event.preventDefault();

        const formData = {
            descripcion: $('#descripcion').val(),
            marca: $('#marca').val(),
            modelo:$('#modelo').val(),
            procesador:$('#procesador').val(),
            ram:$('#ram').val(),
            almacenamiento:$('#almacenamiento').val(),
            estado:$('#estado').val(),
            lugarpc: $('#lugarpc').val(),
            categoria:$('#categoria').val(),
            tipo: $('#tipo').val(),
        }

        const selec1 = document.getElementById('lugarpc');
        const lugartext = selec1.options[selec1.selectedIndex].text;

        if(validar(formData)){
           $('#confirmar #bnombre').text(formData.descripcion);
           $('#confirmar #bmarca').text(formData.marca);
           $('#confirmar #bsucursal').text(lugartext);
           $('#confirmar').modal('show');

            $(document).on('click', '#confirmYes', function(){
                $.ajax({
                    url:'/equipos/store',
                    data:formData,
                    type:'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(response){
                        $('#confirmar').modal('hide');
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            window.location.href = '{{route ('equiposgeneral')}}';
                        }, 2000);
                    },
                    error: function(xhr){
                        $('#modalmensaje #mensaje').text('Ha ocurrido un error al intentar registrar el equipo!');
                        $('#modalmensaje #parrafo').text('')
                        $('#confirmar').modal('hide');
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            $('#modalmensaje').modal('hide');
                        }, 2000);
                    }
                })
            })

            $(document).on('click', '#confirmNo', function(){
                $('#confirmar').modal('hide');
            })

        }else{
            console.log('datos invalidos, no pasaron la validacion');
        }
    }
</script>