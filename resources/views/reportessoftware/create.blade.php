@extends('layouts.app')
@section('content')

    <div class="bg-white p-6 rounded-lg shadow-md  w-full m-auto max-w-xl">
        <h2 class="text-2xl font-semibold mb-4 text-center text-red-600">NUEVO TICKET</h2>
        <form method="POST">
          @csrf
          <!-- Primer Select -->
          <div class="mb-4">
            <label for="select-principal" class="block text-sm font-bold text-gray-700 mb-1">Seleccione el sistema en el cual desea hacer el reporte</label>
            <select id="sistema" name="sistema" class="w-full border-gray-300 rounded-lg shadow p-2 focus:ring focus:ring-teal-300" onchange="actualizarOpciones()">
              <option id="primeraopc" value="0" selected>Sistema</option>
              @foreach($sistemas as $item)
                <option value="{{$item->id}}">{{$item->nombre}}</option>
              @endforeach
            </select>
            <p id="sistema-error" class="text-red-500 text-sm " hidden>Debe elegir un sistema!</p>
          </div>

          <input type="text" id="sucursal" name="sucursal" hidden  value="{{Auth::user()->sucursal->id}}">
          <input type="text" id="tipo_reporte" name="tipo_reporte" hidden value="1">
    
          <!-- Segundo Select -->
          <div class="mb-4">
            <label for="select-secundario" class="block text-sm font-bold text-gray-700 mb-1">Seleccione el modulo en el cual desea hacer el reporte</label>
            <select id="modulo" name="modulo" class="w-full border-gray-300 rounded-lg shadow p-2 focus:ring focus:ring-teal-300" onchange="actualizarOpciones2($('#modulo').val())">
              <option value="0" selected>Sin modulo</option>
            </select>
          </div>


          {{-- <div class="mb-4 hidden" id="selectvista">
            <label for="select-secundario" class="block text-sm font-bold text-gray-700 mb-1">Seleccione la ventana en la cual desea hacer el reporte</label>
            <select id="vista" name="vista" class="w-full border-gray-300 rounded-lg shadow p-2 focus:ring focus:ring-teal-300" onchange="actualizarOpciones3($('#sistema').val())">
              <option value="0" selected>Sin ventana</option>
            </select>
          </div> --}}

          <div class="mb-4" id="selectvista">
            <label for="select-secundario" class="block text-sm font-bold text-gray-700 mb-1">Seleccione el lugar en el cual desea hacer el reporte</label>
            <select id="vista" name="vista" class="w-full border-gray-300 rounded-lg shadow p-2 focus:ring focus:ring-teal-300" onchange="actualizarOpciones3($('#sistema').val())">
              <option value="0" selected>Sin lugar</option>
              {{-- @foreach ($vista as $item )
                <option value="{{$item->id}}">{{$item->nombre}}</option>
              @endforeach --}}
             
            </select>
          </div>

          <div class="mb-4">
            <label for="fallaselec" class="block text-sm font-bold text-gray-700 mb-1">Tipos de problemas frecuentes, seleccione una opcion en caso de que su problema aparezca aqui: </label>
            <select id="falla" name="falla" class="w-full border-gray-300 rounded-lg shadow focus:ring p-2 focus:ring-teal-300" onchange="buscarsolucion()">
              <option value="0" selected>no es problema frecuente</option>
            </select>
          </div>

          <span id="tip_solucion" class="hidden text-md text-yellow-500 mb-4"></span>
    
          <!-- Campo de Texto -->
          <div class="mb-4 mt-4">
            <label for="campo-texto" class="block text-sm font-bold text-gray-700 mb-1">Explique su problema o detalles del mismo</label>
            <textarea type="text" id="desc" name="desc" rows="7" class="w-full border-gray-300 rounded-lg shadow focus:ring focus:ring-teal-300" placeholder="Escribe aquí"></textarea>
            <p id="problema-error" class="text-red-500 text-sm " hidden>Debe dejar detalles sobre su problema!</p>
          </div>

          <div class=" flex mx-auto md:justify-center" id="divimg">
            <div id="imagePreview" style="margin-top: 20px;" class="col-span-5"></div>
            <div class="col-span-1 pt-6" id="quitarimagen" hidden>
                <button onclick="quitarimg(event)" class="ml-2"><i class="fa-regular fa-circle-xmark fa-2xl"></i></button>
            </div>
          </div>

          <div class="mb-4 text-center">
            <input type="file" id="fileInput" name="file" accept="*" style="display: none;" onchange="showPreview(event)">
            <button type="button" onclick="document.getElementById('fileInput').click()" class="btn btn-primary w-2/4">Subir Imagen</button>
          </div>

          {{-- campos escondidos para llenar el ticket --}}

          <input type="text" name="userid" id="userid" hidden value="{{Auth::user()->id}}">
    
          <!-- Botón de Envío -->
          <button  class="w-full bg-teal-500 text-white font-bold py-2 px-4 rounded hover:bg-teal-600" onclick="enviar(event)">
            GENERAR
          </button>
        </form>
      </div>
      <div class="modal fade mt-[20%] md:!mt-[1%]" id="confirmar" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
              <h2 class="text-lg font-semibold text-center">¿Estás seguro?</h2>
              <p class="text-sm text-gray-600 text-center mt-2" id="texto">Esta acción registrara un nuevo ticket.</p>
              <div class="mt-4 w-[99%] m-auto text-center">
                <div class="flex justify-center">
                  <label for="">sistema: </label>
                  <label for="bnombre" id="sistemat" class="text-center pl-2"></label>
                </div>
               
                <div class="flex justify-center mt-3">
                  <label for="" class="mt-2">modulo: </label>
                  <label for="bcorreo" id="modulot" class="text-center mt-2 pl-2"></label>
                </div>
                 
                  
                <div class="flex justify-center mt-3">
                  <label for="" class="mt-2">problema: </label>
                  <label for="bsucursal" id="problemat" class="text-center mt-2 pl-2"></label>
                </div>
              </div>
              <div class="flex justify-between mt-8">
                  <button id="confirmYes" class="btn btn-primary text-white px-4 py-2 rounded">
                      Sí, seguro
                  </button>
                  <button id="confirmNo" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                      Cancelar
                  </button>
              </div>
            </div>
        </div>
      </div>
      <div class="modal fade mt-[20%] h-[200px]" id="modalmensaje" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center py-9">
                    <h1 id="mensaje" class="mb-4">Ticket generado con exito!</h1>
                    <div class="mt-2"></div>
                    <i hidden id="check" class="fa-regular fa-circle-check fa-2xl" style="color: #63E6BE;"></i>
                    <i hidden id="x" class="fa-regular fa-circle-xmark fa-2xl" style="color: #fe0606;"></i>
                </div>
            </div>
        </div>
      </div>

      <script src="../resources/jquery/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">


      <script>

        function actualizarOpciones2(modulo1) {
          

          const sistema = $('#sistema').val();
          const modulo = modulo1;
          const selectSecundario = document.getElementById('vista');

          var ruta = 'cargarvista/'+modulo +'/'+sistema;
          // console.log(modulo);

          $.ajax({
            url: ruta,
            type:'GET',
            dataType: 'json',
            success: function(data) {

                console.log(data);
                // if(data.length>0){
                //   $('#selectvista').removeClass('hidden');
                // }else{
                //   $('#selectvista').addClass('hidden');
                // }

                while (selectSecundario.options.length > 1) {
                    selectSecundario.remove(1);
                }
                if (data) {
                    data.forEach(opcion => {
                    const nuevaOpcion = document.createElement('option');
                    nuevaOpcion.value = opcion.id;
                    nuevaOpcion.textContent = opcion.nombre;
                    selectSecundario.appendChild(nuevaOpcion);
                    });
                }

                actualizarOpciones3(sistema)
            },
            error: function(xhr, status, error) {
                // Error handling
                $('#resultado').html('<p>Error al consultar datos.</p>');
            }
          })
        }


        function actualizarOpciones3(sistema_id) {

          
          
          const sistema = sistema_id;
          const selectPrincipal = document.getElementById('modulo');
          const selectSecundario = document.getElementById('falla');
          const selecvista = document.getElementById('vista');
          const seleccion = selectPrincipal.value;
          const vista = selecvista.value;
          var ruta = 'cargarfallas/'+seleccion+'/'+sistema + '/'+ vista;

          $.ajax({
            url: ruta,
            type:'GET',
            dataType: 'json',
            success: function(data) {

                console.log('fallas',data);

                while (selectSecundario.options.length > 1) {
                    selectSecundario.remove(1);
                }
                if (data?.fallas) {
                    data.fallas.forEach(opcion => {
                    const nuevaOpcion = document.createElement('option');
                    nuevaOpcion.value = opcion.id;
                    nuevaOpcion.textContent = opcion.descripcion;
                    selectSecundario.appendChild(nuevaOpcion);
                    });

                    if($('#vista').val()!=0){
                      $('#sistema').val(data.sistema);
                      $('#modulo').val(data.modulo);
                    }
                }else{
                    data.forEach(opcion => {
                    const nuevaOpcion = document.createElement('option');
                    nuevaOpcion.value = opcion.id;
                    nuevaOpcion.textContent = opcion.descripcion;
                    selectSecundario.appendChild(nuevaOpcion);
                    });
                }
            },
            error: function(xhr, status, error) {
                // Error handling
                $('#resultado').html('<p>Error al consultar datos.</p>');
            }
          })
        }



        // Script para cambiar las opciones del segundo select dinámicamente
        function actualizarOpciones() {
          
    
          const selectPrincipal = document.getElementById('sistema');
          const selectSecundario = document.getElementById('modulo');
          const seleccion = selectPrincipal.value;
          const modulo = selectSecundario.value;
          $('#primeraopc').attr('disabled', true);

          var ruta = 'cargarmodulos/'+seleccion;

          $.ajax({
            url: ruta,
            type:'GET',
            dataType: 'json',
            success: function(data) {

                // console.log(data);

                while (selectSecundario.options.length > 1) {
                    selectSecundario.remove(1);
                }
                if (data) {
                    data.forEach(opcion => {
                    const nuevaOpcion = document.createElement('option');
                    nuevaOpcion.value = opcion.id;
                    nuevaOpcion.textContent = opcion.nombre;
                    selectSecundario.appendChild(nuevaOpcion);
                    });
                }
                actualizarOpciones2(0);
                actualizarOpciones3(seleccion);
            },
            error: function(xhr, status, error) {
                // Error handling
                $('#resultado').html('<p>Error al consultar datos.</p>');
            }
          })
        }

        function validar(form){
          let valido = true;
          let sistema = form.get('sistema');
          let problema= form.get('problema');
          if(sistema == 0){
            $('#sistema-error').removeAttr('hidden');
            valido = false;
          }else{
            $('#sistema-error').attr('hidden', true);
          }

          if(!problema || problema.trim()==="" ){
            $('#problema-error').removeAttr('hidden');
            valido = false;
          }else{
            $('#problema-error').attr('hidden', true);
          }

          return valido;
        }



        function enviar(event) {
          event.preventDefault();

          const selec1 = document.getElementById('sistema');
          const sistematext = selec1.options[selec1.selectedIndex].text;
          const selec2 = document.getElementById('modulo');
          const modulotext = selec2.options[selec2.selectedIndex].text;
          const selec3 = document.getElementById('falla');
          const problematext = selec3.options[selec3.selectedIndex].text;

          // Crear un nuevo objeto FormData
          const formData = new FormData();

          // Agregar los valores de los otros campos al FormData
          formData.append('userid', $('#userid').val());
          formData.append('sistema', $('#sistema').val());
          formData.append('modulo', $('#modulo').val());
          formData.append('falla', $('#falla').val());
          formData.append('problema', $('#desc').val());
          formData.append('tipo_reporte', $('#tipo_reporte').val());
          formData.append('vista', $('#vista').val())

          // Agregar la imagen si se seleccionó
          let fileInput = $('#fileInput')[0].files[0]; // Obtener el primer archivo seleccionado
          if (fileInput) {
            formData.append('imagen', fileInput); // Agregar la imagen al FormData
          }

          if (validar(formData)) {
            $('#confirmar #sistemat').text(sistematext);
            $('#confirmar #modulot').text(modulotext);
            $('#confirmar #problemat').text(problematext);
            $('#confirmar').modal('show');

            $(document).on('click', '#confirmYes', function () {
              const button = $(this);
              button.prop('disabled', true);
              
              // Enviar el formulario con AJAX
              $.ajax({
                url: '/reportessoftwarestore',
                data: formData,
                type: 'POST',
                processData: false, // Importante: evitar que jQuery procese los datos
                contentType: false, // Importante: no especificar el contentType, ya que FormData se encarga
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                  $('#confirmar').modal('hide');
                  $('#modalmensaje').modal('show');
                  $('#modalmensaje #check').removeAttr('hidden');
                  setTimeout(() => {
                    window.location.href = '{{ route('misreportessoftware', ['id' => Auth::user()->sucursal]) }}';
                  }, 2000);
                },
                error: function (xhr) {
                  $('#modalmensaje #mensaje').text('Ha ocurrido un error al generar el ticket!');
                  $('#confirmar').modal('hide');
                  $('#modalmensaje #x').removeAttr('hidden');
                  $('#modalmensaje').modal('show');
                  setTimeout(() => {
                    location.reload();
                  }, 3000);
                }
              });
            });

            $(document).on('click', '#confirmNo', function () {
              $('#confirmar').modal('hide');
            });
          } else {
            // console.log('Formulario no válido');
          }
        }

        

        function showPreview(event) {
          const file = event.target.files[0];
          const reader = new FileReader();
          var pantalla =  window.innerWidth < 700;
          
          reader.onload = function() {
              const img = document.createElement("img");
              img.src = reader.result;
              if(pantalla){
                  img.style.maxWidth = "300px";
                  img.style.maxHeight = "250px";
              }else{
                  img.style.maxWidth = "450px";
                  img.style.maxHeight = "300px";
              }
              const imagePreview = document.getElementById("imagePreview");
              imagePreview.innerHTML = "";
              imagePreview.appendChild(img);
              console.log(img)
          }
          
          if (file) {
              reader.readAsDataURL(file);
              
          }

          $('#quitarimagen').removeAttr('hidden');
          // $('#divimg').addClass('mb-4');

        }

        function quitarimg(event){
          event.preventDefault()
          let image = document.getElementById('imagePreview');
          image.innerHTML ='';
          $('#quitarimagen').attr('hidden', true);
          $('#fileInput').val('');
          $('#divimg').removeClass('mb-4');
        }



        function buscarsolucion(){
          const falla = $('#falla').val();
          console.log(falla);


          if(falla!=0){
            $.ajax({
              url: '/buscarsolucion/'+falla,
              type:'GET',
              headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(data){
                // console.log(data);
                if(data?.solucion && data?.solucion[0]){
                  if(data.solucion[0].checked == 1){
                    $('#tip_solucion').text( 'posible solucion a dicho problema: '+  data.solucion[0].solucion);
                    $('#tip_solucion').removeClass('hidden');
                  }else{
                    $('#tip_solucion').addClass('hidden');
                  }
                }else if(data[0]){
                  if(data[0].checked == 1){
                    $('#tip_solucion').text( 'posible solucion a dicho problema: '+  data[0].solucion);
                    $('#tip_solucion').removeClass('hidden');
                  }else{
                    $('#tip_solucion').addClass('hidden');
                  }
                
                }else{
                  $('#tip_solucion').addClass('hidden');
                }

                if(data?.vista){
                  $('#vista').val(data.vista)
                  $('#modulo').val(data.modulo)
                }else if(data?.modulo){
                  $('#modulo').val(data.modulo);
                }else{
                  $('#vista').val(0)
                  $('#modulo').val(0)
                }




              },
              error: function(xhr){
                console.log('error');
              }
            })
          }else{
            $('#tip_solucion').addClass('hidden');
          }

            
        }

        // $(document).ready(function() {
        //     $('#seccion').select2({
        //         placeholder: "Selecciona una opción",
        //         allowClear: true
        //     });
        // });
        
      </script>

@endsection
