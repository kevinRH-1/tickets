@extends('layouts.app')

@section('content')

    <input type="text" id="lugar" value="{{Auth::user()->lugar_id}}" hidden>

    <form  method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-xl mx-auto">
        @csrf
    
        <label for="titulo" class="text-red-600 w-full text-center text-2xl font-semibold">NUEVO TICKET</label>
        @isset($equipo)
        
        <div class="mb-4">
            <input type="hidden" id="usuario" name="usuario" value="{{ Auth::user()->id }}">
            <input type="hidden" id="equipo" name="equipo" value="{{ $equipo[0]->id }}">
            {{-- <input type="hidden" id="sucursal" name="sucursal" value="{{ Auth::user()->lugar_id }}"> --}}
            <input type="text" name="tipo_reporte" id="tipo_reporte" value="2" hidden>
        </div>
    
        <div class="mb-4">
            <label for="codigo" class="block text-gray-700 text-sm font-bold mb-2">Código del equipo</label>
            <input type="text" id="codigo" name="codigo" value="{{ $equipo[0]->codigo }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
        </div>

        <div class="mb-4">
            <label for="nombre" class="block text-gray-700 text-sm font-bold mb-2">Nombre del equipo</label>
            <input type="text" id="nombre" name="nombre" value="{{ $equipo[0]->descripcion }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"readonly>
        </div>
    
        <div class="mb-4">
            <label for="marca" class="block text-gray-700 text-sm font-bold mb-2">Modelo del equipo</label>
            <input type="text" id="marca" name="marca" value="{{ $equipo[0]->modelo }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"readonly>
        </div>
    
        <div class="mb-4">
            <input type="hidden" id="categoria" name="categoria" value="{{ $equipo[0]->categoria_id }}">
        </div>
        @else
        
        <input type="hidden" id="usuario" name="usuario" value="{{ Auth::user()->id }}">            
        <input type="text" name="tipo_reporte" id="tipo_reporte" value="2" hidden>

        <div class="mb-4">
            <label for="seletipo" class="block text-gray-700 text-sm font-bold mb-2">Tipos</label>
            <select name="seletipo" id="seletipo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="1">PC</option>
                <option value="2">Laptop</option>
                <option value="3">Impresora</option>
            </select>
        </div>
        
    
        <div class="mb-4">
            <label for="seleequipos" class="block text-gray-700 text-sm font-bold mb-2">Equipos</label>
            <select name="seleequipos" id="seleequipos" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="0" disabled selected>Seleccione un equipo</option>
                @foreach($pc as $item)
                <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                @endforeach
            </select>
            <p id="equipo-error" class="text-red-500 text-sm " hidden>debe elegir un equipo!</p>
        </div>
    
        <div class="mb-4">
            <label for="codigo" class="block text-gray-700 text-sm font-bold mb-2">Código</label>
            <input type="text" id="codigo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
        </div>
    
        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700 text-sm font-bold mb-2">Modelo</label>
            <input type="text" id="descripcion" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
        </div>
        @endisset
    
        {{-- <div class="mb-4">
            <label for="tipoproblema" class="block text-gray-700 text-sm font-bold mb-2">Tipo de problema</label>
            <select name="tipoproblema" id="tipoproblema" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach($fallas as $item)
                <option value="{{ $item->id }}">{{ $item->desc }}</option>
                @endforeach
                <option value="0">Otra</option>
            </select>
        </div> --}}


        <div class="mb-4"  id="falladiv">
            <label for="tipofalla" class="block text-gray-700 text-sm font-bold mb-2">Tipo de falla</label>
            <select name="falla" id="falla" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach($falla as $item)
                    <option value="{{$item->id}}">{{$item->desc}}</option>
                @endforeach
                <option value="0">otra</option>
            </select>
        </div>
    
        <div id="nuevadiv" hidden class="mb-4">
            <label for="nuevafalla" class="block text-gray-700 text-sm font-bold mb-2">Nueva falla</label>
            <input type="text" name="nuevafalla" id="nuevafalla" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Falla de ___ en ___ de la máquina">
            <p id="nuevafalla-error" class="text-red-500 text-sm " hidden>escriba el tipo de su falla!</p>
        </div>

        <div class="mb-4"  id="statusdiv">
            <label for="tipofalla" class="block text-gray-700 text-sm font-bold mb-2">Estado del equipo:</label>
            <select name="estados" id="estados" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @foreach($status as $item)
                    <option value="{{$item->id}}">{{$item->descripcion}}</option>
                @endforeach
            </select>
        </div>

    
        <div class="mb-4">
            <label for="desc" class="block text-gray-700 text-sm font-bold mb-2">Describa el problema completo</label>
            <textarea name="desc" id="desc" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Explique en detalle el problema"></textarea>
            <p id="desc-error" class="text-red-500 text-sm " hidden>Debe dar detalles de su problema!</p>
        </div>

        <div class=" flex w-11/12 mx-auto" id="divimg">
            <div id="imagePreview" style="margin-top: 20px;" class="col-span-5"></div>
            <div class="col-span-1 pt-6" id="quitarimagen" hidden>
                <button onclick="quitarimg(event)" class="ml-2"><i class="fa-regular fa-circle-xmark fa-2xl"></i></button>
            </div>
        </div>

        <div class="mb-4 text-center">
            <input type="file" id="fileInput" name="file" accept="*" style="display: none;" onchange="showPreview(event)">
            <button type="button" onclick="document.getElementById('fileInput').click()" class="btn btn-primary w-2/4">Subir Imagen</button>
        </div>
    
        <div class="flex items-center justify-between">
            <button type="submit" class="w-full bg-teal-500 text-white font-bold py-2 px-4 rounded hover:bg-teal-600" onclick="enviar(event)">
                GENERAR
            </button>
        </div>
    </form>
    <div class="modal fade mt-[20%]" id="confirmar" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
              <h2 class="text-lg font-semibold text-center">¿Estás seguro?</h2>
              <p class="text-sm text-gray-600 text-center mt-2" id="texto">Esta acción registrara un nuevo ticket.</p>
              <div class="mt-4 w-[99%] m-auto text-center">
                <div class="flex justify-center">
                  <label for="">Nombre del equipo: </label>
                  <label for="bnombre" id="nombret" class="text-center pl-2"></label>
                </div>
               
                <div class="flex justify-center mt-3">
                  <label for="" class="mt-2">falla: </label>
                  <label for="falla" id="fallat" class="text-center mt-2 pl-2"></label>
                </div>
                 
                  
                {{-- <div class="flex justify-center mt-3">
                  <label for="" class="mt-2">problema: </label>
                  <label for="bsucursal" id="problemat" class="text-center mt-2 pl-2"></label>
                </div> --}}
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
                    <h1 id="mensaje">Ticket generado con exito!</h1>
                </div>
            </div>
        </div>
    </div>



@endsection

<script src="../resources/jquery/jquery-3.6.0.min.js"></script>

<script>

    // document.addEventListener('DOMContentLoaded', function () {
    //     document.getElementById('tipoproblema').addEventListener('change', function () {
    //         const seleccion = this.value; // Obtiene el valor seleccionado
    //         console.log(seleccion);

    //         ruta = '/verfallas/' + seleccion;
    //         console.log(ruta);

    //         $.ajax({
    //             url:ruta,
    //             type:'GET',
    //             dataType:'json',
    //             headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
    //             },
    //             success: function(data){
                    
    //                 if(seleccion != 0){
    //                     const div = document.getElementById("nuevadiv");
    //                     div.hidden = true;
    //                     const selec = document.getElementById('falla');
    //                     const divfalla = document.getElementById('falladiv');
                        
    //                     selec.removeAttribute('hidden');
    //                     divfalla.removeAttribute('hidden');
    //                     selec.innerHTML = '';
    //                     data.forEach(function(item) {
    //                         const option = document.createElement('option');
    //                         option.value = item.id; // Asegúrate de que `id` sea el campo único o identificador del registro
    //                         option.textContent = item.desc; // `desc` debe existir en cada registro
    //                         selec.appendChild(option);
    //                     });
    //                 }else{
    //                     const falladiv = document.getElementById('falladiv');
    //                     const selec = document.getElementById('falla');
    //                     selec.innerHTML = null;
    //                     falladiv.hidden = true;
    //                     const div = document.getElementById("nuevadiv");
    //                     div.removeAttribute('hidden');
    //                 }
    //             },
    //             error: function(xhr){
    //                 alert("no funciona");
    //             }
    //         })
    
    //     });
    // });
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('seletipo').addEventListener('change', function () {
            const valorSeleccionado = this.value; // Captura el valor del select
            const userId = $('#lugar').val();
            ruta = '/reportes/equipos/'+ valorSeleccionado +'/' + userId,

            console.log(ruta)
        
            $.ajax({
                url:ruta,
                type:'GET',
                dataType:'json',
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                success: function(data){
                    var selectElement = document.getElementById('seleequipos');

                    while (selectElement.options.length > 0) {
                        selectElement.remove(0); // Elimina la primera opción en cada iteración
                    }

                    var option1 = document.createElement('option'); // Crear elemento <option>
                    option1.value = ""; // Asignar el id como valor de la opción
                    option1.textContent = "seleccione un equipo";
                    
                    option1.setAttribute('selected', 'selected');
                    option1.setAttribute('disabled', 'disabled');
                    selectElement.appendChild(option1)

                    
                    data.forEach(dato => {
                        var option = document.createElement('option'); // Crear elemento <option>
                        option.value = dato.id; // Asignar el id como valor de la opción
                        option.textContent = dato.descripcion; // Asignar el nombre como texto de la opción
                        selectElement.appendChild(option); // Añadir la opción al select
                    });
                },
                error: function(xhr){
                    alert('error al consultar datos');
                }
            })
        });
    });
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('seleequipos').addEventListener('change', function(){
            var id = $('#seleequipos').val();
            var cate = $('#seletipo').val();
            var sucursal = $('#lugar').val();
            console.log(id);
            console.log(cate);
            console.log(sucursal);

            const formData ={
                id: id,
                categoria: cate,
            };

            console.log(formData)

            $.ajax({
                url:'/reportes/getequipo',
                type:'GET',
                dataType:'json',
                data:formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                success: function(datos){
                    console.log(datos);
                    $('#codigo').val(datos[0].codigo);
                    $('#descripcion').val(datos[0].modelo);
                },
                error: function(xhr){
                alert('error al consultar datos del equipo');
                }
            })
        });
    });


    function validar(form){
        let valido = true;
        let equipo = form.get('equipo');
        let desc = form.get('desc');
        let problema = form.get('problema');
        let nuevafalla = form.get('nuevafalla');

        if(!$('#equipo').val()){
            if(equipo==null){
                $('#equipo-error').removeAttr('hidden');
                valido = false;
            }else{
                $('#equipo-error').attr('hidden', true);
            }
        }

        if(!desc || desc.trim()==="" ){
            $('#desc-error').removeAttr('hidden');
            valido = false;
        }else{
            $('#desc-error').attr('hidden', true);
        }

        if(problema==0 && nuevafalla.trim()===""){
            $('#nuevafalla-error').removeAttr('hidden');
            valido=false;
        }else{
            $('#nuevafalla-error').attr('hidden', true);
        }

        return valido;
    }



    function enviar(event){
        event.preventDefault();

        // const selec1 = document.getElementById('sistema');
        // const sistematext = selec1.options[selec1.selectedIndex].text;
        const selec2 = document.getElementById('falla');
        const problematext = selec2.options[selec2.selectedIndex].text;
        // let fallatxt
        // if($('#falla').val()){
        //     const selec3 = document.getElementById('falla');
        //      fallatxt = selec3.options[selec3.selectedIndex].text;
        //     console.log(fallatxt)
        // }else{
        //      fallatxt = $('#nuevafalla').val();
        // }

        let nombretxt
        if(!$('#equipo').val()){
            const selecnombre = document.getElementById('seleequipos');
            nombretxt = selecnombre.options[selecnombre.selectedIndex].text;
        }

        const formData = new FormData();

        formData.append('usuario', $('#usuario').val());
        formData.append('tipo_reporte', $('#tipo_reporte').val());
        formData.append('problema', $('#tipoproblema').val());
        formData.append('falla', $('#falla').val());
        formData.append('desc', $('#desc').val());
        formData.append('nuevafalla', $('#nuevafalla').val());
        formData.append('estado', $('#estados').val());

        let fileInput = $('#fileInput')[0].files[0]; // Obtener el primer archivo seleccionado
        if (fileInput) {
            formData.append('imagen', fileInput); 
        }




        if($('#equipo').val()){
            formData.append('equipo', $('#equipo').val());
            formData.append('categoria', $('#categoria').val());
        }else{
            formData.append('categoria', $('#seletipo').val());
            formData.append('equipo', $('#seleequipos').val());
        }

        if(validar(formData)){
            if(!$('#equipo').val()){
                $('#confirmar #nombret').text(nombretxt);
            }else{
                $('#confirmar #nombret').text($('#nombre').val());
            }
            

            if(formData.get('falla')==0){
                $('#confirmar #fallat').text(formData.get('desc'))
            }else{
                $('#confirmar #fallat').text(problematext);
            }
            
            // if(fallatxt){
            //     $('#confirmar #problemat').text(fallatxt);
            // }
            $('#confirmar').modal('show');

            $(document).off('click', '#confirmYes').on('click', '#confirmYes', function(){
                $.ajax({
                url:'/reporteh/store',
                data: formData,
                type:'POST',
                processData: false, 
                contentType: false, 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                success: function(response){
                    $('#confirmar').modal('hide');
                    $('#modalmensaje').modal('show');
                    setTimeout(() => {
                        window.location.href = '{{ route('misreportes', ['id' => Auth::user()->sucursal]) }}';
                    }, 2000);
                },
                error: function(xhr){
                    $('#modalmensaje #mensaje').text('ha ocurrido un error al generar el ticket!')
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
            console.log('no');
        }

    }


    function showPreview(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        
        reader.onload = function() {
            const img = document.createElement("img");
            img.src = reader.result;
            img.style.maxWidth = "450px";
            img.style.maxHeight = "300px";
            const imagePreview = document.getElementById("imagePreview");
            imagePreview.innerHTML = "";
            imagePreview.appendChild(img);
            console.log(img)
        }
        
        if (file) {
            reader.readAsDataURL(file);
            
        }

        $('#quitarimagen').removeAttr('hidden');
        $('#divimg').addClass('mb-4');

    }

    function quitarimg(event){
        event.preventDefault()
        let image = document.getElementById('imagePreview');
        image.innerHTML ='';
        $('#quitarimagen').attr('hidden', true);
        $('#fileInput').val('');
        $('#divimg').removeClass('mb-4');
    }


</script>
