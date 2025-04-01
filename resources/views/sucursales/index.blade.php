@extends('layouts.app')

@section('content')



    <div class="w-full bg-white shadow-lg rounded-lg items-center  p-4 m-auto border-1 border-red-600">

        <h1 class="text-center font-semibold text-lg">VER SUCURSALES</h1>
    </div>




    <div class="container-fluid">
        <div class="card border-0 md:shadow my-5 bg-transparent md:!bg-white">
            <div class="card-body md:!p-4 p-0 ">
                <div class="flex ">
                    <div class="md:!mb-4 mb-2 w-full flex justify-end ">
                        <button type="button" class="btn hidden btn-primary mt-2" id="openmodal1" onclick="$('#registrar').modal('show')"><i class="bi bi-check2-square"></i>
                            Agregar
                        </button>
                    </div>
                </div>
                
                

                <div class="m-auto max-w-7xl bg-white shadow-md rounded-lg overflow-x-auto" id="tablaf">
                    <table class="table-auto w-full border-collapse border-none border-gray-200 rounded-t-lg">
                        <thead class="bg-gray-800 text-white rounded-t-lg">
                            <tr>
                                <th class="p-4 text-center md:rounded-tl-lg hidden md:table-cell">Nombre de la sucursal</th>
                                <th class="p-4 text-center hidden md:table-cell">Cantidad de equipos</th>
                                <th class="p-4 text-center md:hidden">Datos</th>
                                <th class="p-4 text-center hidden md:table-cell">Cantidad de reportes activos</th>
                                <th class="p-4 text-center hidden md:table-cell">Cantidad de usuarios</th>
                                <th class="p-4 text-center">OPCIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forEach($sucursales as $item)
                                <!-- Fila 1 -->                   
                                    <tr class="border-1 border-gray-200 hover:bg-gray-50">
                                        <td hidden id="id">{{$item->id}}</td>
                                        <td class="p-4 text-center hidden md:table-cell" nombre="nombre">{{$item->nombre}}</td>
                                        <td class="p-4 text-center md:hidden" datos="datos">
                                            <h1>{{$item->nombre}}</h1>
                                            <p></p>
                                        </td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->equipos}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->reportes}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->usuarios}}</td>
                                        <td class="text-center md:p-4 pt-4 flex justify-around">
                                            {{-- <button id="btnConsulta" class="bi btn btn-warning btn-sm w-10 h-10" data-type="pc"><i class="bi bi-pencil-square"></i></button>
                                            <button class="btn btn-danger hidden btn-sm w-10 h-10" id="borrarf"><i class="bi bi-trash"></i></button> --}}
                                        </td>
                                    </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 p-2 ">
                        {{ $sucursales->links() }}
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

                <div class="modal fade pt-40" id="modalc" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content p-4">
                            
                        <h2 id="tituloconfirmar" class="text-lg font-semibold text-center w-full p-2 rounded-lg">MODIFICAR SUCURSAL/DEPARTAMENTO</h2>
                        
                        <div class="mt-4 w-[99%] m-auto text-center">
                            <label for="nombre" class="mb-4" >NOMBRE:</label>
                            <br>
                            <input type="text" id="nombre" name="nombre" class="w-full p-2  bg-transparent rounded-md">
                            <p id="descripcion-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
                            <input type="text" id="ids" name="ids" hidden>
                        </div>
                        <div class="flex justify-between mt-8">
                            <button id="confirmYes2" class="btn btn-primary text-white px-4 py-2 rounded" onclick="enviarmod()">
                                Sí, confirmar
                            </button>
                            <button id="confirmNo2" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded" onclick="$('#modalc').modal('hide')">
                                Cancelar
                            </button>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade pt-40" id="registrar" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content p-4">
                            <h2 class="text-lg font-semibold text-center">Nueva sucursal o departamento</h2>
                        
                            <div class="mt-4 w-[99%] m-auto text-center">
                                <label for="nombre" id="nombre"  class="mb-4" >Nombre: </label>
                                <input type="text" id="nombrei" name="nombrei" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                <p id="nombrei-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
                            </div>
                            <div class="flex justify-between mt-8">
                                <button id="registrarboton" class="btn btn-primary text-white px-4 py-2 rounded" onclick="registrarsucursal()">
                                    registrar
                                </button>
                                <button id="cancelarboton" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded" onclick="$('#registrar').modal('hide')">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade pt-40" id="confirmarb" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content p-4">
                            <h2 class="text-lg font-semibold text-center">¿Estás seguro?</h2>
                            <h2 id="tituloconfirmar" class="text-lg font-semibold text-center w-full p-2 rounded-lg">esta accion borrara esta sucursal!</h2>
                        
                        <div class="mt-4 w-[99%] m-auto text-center">
                            <label for="nombre" id="nombre"  class="mb-4" ></label>
                            <input type="text" id="ids" name="ids" hidden>
                        </div>
                        <div class="flex justify-between mt-8">
                            <button id="confirmYes2" class="btn btn-danger text-white px-4 py-2 rounded" onclick="borrarsuc()">
                                Sí, borrar
                            </button>
                            <button id="confirmNo2" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded" onclick="$('#confirmarb').modal('hide')">
                                Cancelar
                            </button>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade pt-40" id="confirmar" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content p-4">
                            <h2 class="text-lg font-semibold text-center">¿Estás seguro?</h2>
                            <h2 id="tituloconfirmar" class="text-lg font-semibold text-center w-full p-2 rounded-lg">esta accion registrara esta sucursal en el sistema</h2>
                        
                        <div class="mt-4 w-[99%] m-auto text-center">
                            <label for="nombre" id="nombre"  class="mb-4"></label>
                        </div>
                        <div class="flex justify-between mt-8">
                            <button id="confirmsi" class="btn btn-primary text-white px-4 py-2 rounded">
                                Sí, registrar
                            </button>
                            <button id="confirmno" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded" onclick="$('#confirmarb').modal('hide')">
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

<script src="../resources/jquery/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '#btnConsulta', function(){
        var id = $(this).closest('tr').find('td[id]').text();
        var nombre = $(this).closest('tr').find('td[nombre]').text();
        console.log(id);

        $('#modalc').modal('show');
        $('#modalc #nombre').val(nombre);
        $('#modalc #ids').val(id)

    })

    function enviarmod(){
        const formData ={
            nombre: $('#modalc #nombre').val(),
            id: $('#modalc #ids').val(),
        };

        console.log(formData)

        if(formData.nombre.trim()===''){
            $('#modalc #descripcion-error').removeAttr('hidden');
            console.log('no')
        }else{
            $('#modalc #descripcion-error').attr('hidden', true);
            console.log('si')
            $.ajax({
                url: 'modsucursal',
                data:formData,
                type:'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                },
                success: function(response){
                    $('#modalc').modal('hide');
                    $('#mensaje').text('suscursal/departamento modificado con exito!');
                    $('#modalmensaje').modal('show');
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                },
                error: function(xhr){
                    $('#modalc').modal('hide');
                    $('#mensaje').text('ha ocurrido un error. intentelo de nuevo!');
                    $('#modalmensaje').modal('show');
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                },
            })
        }   
    }

    $(document).on('click', '#borrarf', function(){
        var id = $(this).closest('tr').find('td[id]').text();
        var nombre = $(this).closest('tr').find('td[nombre]').text();

        $('#confirmarb').modal('show');
        $('#confirmarb #nombre').text(nombre);
        $('#confirmarb #ids').val(id)
    })

    function borrarsuc(){
        var id = $('#confirmarb #ids').val();

        $.ajax({
            url: 'sucursalborrar/'+id,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
            },
            success: function (response){
                $('#confirmarb').modal('hide');
                $('#mensaje').text('suscursal/departamento borrado con exito!');
                $('#modalmensaje').modal('show');
                setTimeout(() => {
                    location.reload();
                }, 3000);
            },
            error: function(xhr){
                $('#confirmarb').modal('hide');
                $('#mensaje').text('ha ocurrido un error. intentelo de nuevo!');
                $('#modalmensaje').modal('show');
                setTimeout(() => {
                    location.reload();
                }, 3000);
            }
        })
        
    }

    function registrarsucursal(){


        const formData ={
            nombre: $('#nombrei').val(),
        };

        if(formData.nombre.trim()===''){
            $('#registrar #nombrei-error').removeAttr('hidden');
        }else{
            $('#registrar #nombrei-error').attr('hidden', true);

            $('#confirmar #nombre').text(formData.nombre);
            $('#registrar').modal('hide');
            $('#confirmar').modal('show');

            $(document).off('click', '#confirmsi').on('click', '#confirmsi', function(){
                

                $.ajax({
                    url:'sucursal/regis',
                    data:formData,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function(response){
                        $('#confirmar').modal('hide');
                        $('#mensaje').text('suscursal/departamento registrado con exito!');
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    },
                    error: function(xhr){
                        $('#confirmar').modal('hide');
                        $('#mensaje').text('ha ocurrido un error. intentelo de nuevo!');
                        $('#modalmensaje').modal('show');
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    }
                })

            })


            $(document).on('click', '#confirmno', function(){
                $('#confirmar').modal('hide');
                $('#registrar').modal('show');
            })
        }


    }



</script>