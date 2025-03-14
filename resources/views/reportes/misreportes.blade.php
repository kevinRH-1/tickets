@extends('layouts.app')

@section('content')

    <div class="w-11/12  bg-white shadow-lg rounded-lg flex items-center justify-between md:!p-4  p-2 py-4 m-auto border-1 border-red-600">

        <h1></h1>

        <!-- Título en el centro -->
        <h1 class="text-lg font-semibold text-gray-800 text-center md:ml-10">
            Gestion de tickets
        </h1>

        <!-- Botón derecho -->
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{route('crear.ticketequipo', [Auth::user()->lugar_id])}}">
                <button class="btn btn-primary btn-sm p-2" data-bs-toggle="modal" data-bs-target="#agregarNuevoReportes"><i class="bi bi-plus-circle"></i>
                    <span class="hidden md:inline ">Nuevo Reporte</span>
                </button>
            </a>
        </div>

        
    </div>

    <div name="divcantidades" class="flex justify-center items-center mt-7 mb-6">
        <div class="grid grid-cols-2 md:flex md:space-x-4 md:justify-between md:w-11/12 w-10/12 m-auto text-white">
            <div class="md:w-56 h-20 md:h-32 bg-emerald-500 md:rounded-lg p-2 md:shadow-md shadow-gray-700 col-span-1">
              <h1>TICKETS GENERADOS: {{$generados}} </h1>
            </div>
            <div class="md:w-56 h-20 md:h-32 bg-sky-600 md:rounded-lg p-2 md:shadow-md shadow-gray-700 col-span-1">
              <h1>TICKETS EN REVISION: {{$revision}} </h1>
            </div>
            <div class="md:w-56 h-20 md:h-32 bg-purple-500 md:rounded-lg p-2 px-4 md:!px-2 md:shadow-md shadow-gray-700 col-span-2">
              <h1>TICKETS SOLUCIONADOS ULTIMAS 24H: {{$solucionados}}  </h1>
            </div>
            
        </div>
    </div>


    <div class="container-fluid">
        <div class="card border-0 shadow my-5">
            <div class="card-body md:!p-10 p-1">
              
                <div class="m-auto max-w-7xl bg-white shadow-md rounded-lg overflow-x-auto ">
                    <table class="table-auto w-full border-collapse border-none border-gray-200 rounded-t-lg">
                        <thead class="bg-gray-800 text-white rounded-t-lg">
                            <tr>
                                <th class="md:!p-4 p-2 text-center rounded-tl-lg"></th>
                                <th class="py-2 text-center md:hidden">DATOS</th>
                                <th class="py-4 text-center hidden md:table-cell">FECHA DE CREACIÓN</th>
                                <th class="p-4 text-center hidden md:table-cell">CÓDIGO</th>
                                {{-- <th class="p-4 text-center">SUCURSAL</th> --}}
                                <th class="p-4 text-center hidden md:table-cell">USUARIO</th>
                                <th class="p-4 text-center hidden md:table-cell">TECNICO</th>
                                <th class="p-4 text-center hidden md:table-cell">EQUIPO</th>
                                <th class="p-4 text-center hidden md:table-cell">PROBLEMA</th>
                                <th class="p-4 text-center hidden md:table-cell">ESTATUS</th>
                                <th class="p-4 text-center rounded-tr-lg">VER</th>
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
                                        <td class="md:!pl-4 p-1">
                                            @if($item->noti_u==1)
                                                <i class="fa-solid fa-circle-exclamation md:fa-xl" style="color: #ff0000;"></i>
                                            @else

                                            @endif
                                        </td>
                                        <td class="text-left p-1 pt-2 md:!pt-1  md:hidden" datos="datos"><h1 class="text-lg font-semibold">{{ \Illuminate\Support\Str::limit($item->codigo, 35, '...')}}</h1>
                                          
                                          @if($item->pc->descripcion?? false)
                                            <p class="pt-2">{{$item->pc->descripcion}}</p>
                                          @endif
                                          @if($item->laptop->descripcion?? false)
                                            <p class="pt-2">{{$item->laptop->descripcion}}</p>
                                          @endif
                                          @if($item->impresora->descripcion?? false)
                                            <p class="pt-2">{{$item->impresora->descripcion}}</p>
                                          @endif
                                          
                                          <p class="pt-1">{{$item->tecnico?->descripcion?? 'sin tecnico'}}</p>
                                          <div class="flex pt-1">
                                              <p class="{{$color_status}}">{{$item->status->nombre}} </p><p class="mx-1"> | </p>
                                              <p class="{{$color}}"> {{$item->falla?->nivel?->descripcion?? 'sin informacion'}}</p>
                                          </div>
                                            
                                        </td>
                                        <td class="py-4 text-center hidden md:table-cell">{{$item->created_at}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->codigo}}</td>
                                        {{-- <td class="p-4 text-center">{{$item->usuario->sucursal->nombre}}</td> --}}
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->usuario->descripcion}}</td>
                                        <td class="p-4 text-center hidden md:table-cell">{{$item->tecnico?->descripcion?? 'sin tecnico'}}</td>
                                        @if($item->pc->descripcion?? false)
                                            <td class="p-4 text-center hidden md:table-cell">{{$item->pc->descripcion}}</td>
                                        @endif
                                        @if($item->laptop->descripcion?? false)
                                            <td class="p-4 text-center hidden md:table-cell">{{$item->laptop->descripcion}}</td>
                                        @endif
                                        @if($item->impresora->descripcion?? false)
                                            <td class="p-4 text-center hidden md:table-cell">{{$item->impresora->descripcion}}</td>
                                        @endif
                                        <td class="p-4 text-center hidden md:table-cell">{{ \Illuminate\Support\Str::limit($item->descripcion, 40, '...') }}</td>
                                        @if($item->status_id==1)
                                            <td class="p-2 text-center text-red-500 hidden md:table-cell">{{$item->status->nombre}}</td>
                                        @elseif($item->status_id==2)
                                            <td class="p-2 text-center text-amber-500 hidden md:table-cell">{{$item->status->nombre}}</td>
                                        @elseif($item->status_id==3)
                                            <td class="p-2 text-center text-sky-500 hidden md:table-cell">{{$item->status->nombre}}</td>
                                        @else
                                            <td class="p-2 text-center hidden md:table-cell">{{$item->status->nombre}}</td>
                                        @endif
                                        <td class="p-4 text-center">
                                            <a href="{{route ('reportes.detalles', [$item->id, Auth::user()->roleid])}}">
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
                {{-- modales --}}
                
                
                <form id="frmModificarEquipo" method="POST" onsubmit="return modificarEquipo('pc');">
                    <div class="modal fade" id="modalModificar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5">Detalles del reporte</h1>
                            {{-- <button class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                          </div>
                          <div class="modal-body">
                  
                            <div class="row">
                            </div>
                  
                            <div class="row">
                  
                              <div class="col-sm-4">
                                <label for="marca">nombre del equipo</label>
                                <input type="text" class="form-control" id="marca" name="marca">
                              </div>
                  
                              <div class="col-sm-4">
                                <label for="codigo">marca del equipo</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" required>
                              </div>
    
                              <div class="col-sm-4" hidden >
                                <label for="marca">id</label>
                                <input type="text" class="form-control" id="idact" name="idact">
                              </div>
                  
                            </div>
                  
                            <div class="row">
                  
                              <div class="col-sm-4">
                                <label for="modelo">codigo del equipo</label>
                                <input type="text" class="form-control" id="modelo" name="modelo" required>
                              </div>
                  
                              <div class="col-sm-4">
                                <label for="ram">estado</label>
                                <input type="text" class="form-control" id="ram" name="ram" required>
                              </div>
    
                              <div class="col-sm-4" hidden>
                                <label for="tipo">tipo</label>
                                <input type="text" class="form-control" id="tipo" name="tipo" value="pc" >
                              </div>
                  
                            </div>
    
                            <div class="row">

                                <div class="col-sm-4">
                                    <label for="HDD">Usuario del reporte</label>
                                    <input type="text" class="form-control" id="HDD" name="HDD" required>
                                </div>

                                <div class="col-sm-4" >
                                    <label for="tipo">sucursal</label>
                                    <input type="text" class="form-control" id="tipo" name="tipo" >
                                </div>
                  
                                <div class="col-sm-4">
                                    <label for="categoria">fecha del reporte</label>
                                    <input type="text" id="categoria" name="categoria">
                                </div>
                  
                                <div class="col-sm-4">
                                    <label for="HDD">Tecnico</label>
                                    <input type="text" class="form-control" id="HDD" name="HDD" required>
                                </div>
                  
                              {{-- <div class="col-sm-4">
                                <select name="estado" id="estado">
                                  @forEach($estados as $item)
                                    <option value="{{$item->id}}">{{$item->descripcion}}</option>
                                  @endforeach
                                </select>
                              </div> --}}
                            </div>
                  
                            <div class="row">
                              <div class="col-sm-12">
                                <label for="descripcion">Descripcion del problema</label>
                                <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                  <label for="descripcion">Solucion del problema</label>
                                  <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                                </div>
                              </div>
                            <input type="hidden" id="idEquipo" name="idEquipo">
                            <div id="equipo-details" style="margin-top: 20px;">
                              <!-- Aquí se cargarán los campos adicionales -->
                            </div>
    
                            <div class="row">
                              {{-- <button class="btn btn-primary btn-sm oculto" id="anadirpc" name="anadir" data-type="pc">designar a sucursal</button>
                              <button class="btn btn-primary btn-sm oculto" id="quitarpc" name="quitar" data-type="pc">quitar de sucursal</button> --}}
                              {{-- <button class="btn btn-primary btn-sm" id="historial">historial</button> --}}
                              {{-- <button class="btn btn-primary btn-sm" id="estado" name="anadir" data-type="pc">cambiar estado</button> --}}
                            </div>
                  
                          </div>
                          <div class="modal-footer">
                            {{-- <button class="btn btn-primary btn-sm" id="btnborrar" data-type="pc">Borrar</button> --}}
                            <span type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</span>
                            {{-- <button class="btn btn-primary btn-sm" id="modpc" data-type="pc">Actualizar</button> --}}
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>


            </div>
    
        </div>
    </div>
@endsection
<script src="../resources/jquery/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
    // Use event delegation for dynamic content
        $(document).on('click', '#btnConsulta', function() {
            // Find the closest <tr> to the clicked button and retrieve the id
            var codigo = $(this).closest('tr').find('td[id]').text();
            console.log(codigo);

            var ruta = '/reporte-detalles/';
            console.log(ruta);

            // var divs = [document.getElementById("anadir"+type), document.getElementById("quitar"+type)];
            
            $.ajax({
                url: ruta + codigo,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data[0]); 
                //     console.log(datos.id);

                    if(data[0].pc ?? false){
                        console.log('pc');
                    }else if(data[0].laptop ?? false){
                        console.log('laptop');
                    }else if(data[0].impresora ?? false){
                        console.log('impresora');
                    }else{
                        console.log('error');
                    }
                    // $("#modalModificar").modal("show");
                    // $("form #modalModificar #marca").val(datos.nombre);

                    // $("form #modalModificar #modelo").val(datos.modelo);
                    // $("form #modalModificar #codigo").val(datos.marca);
                    // $("form #modalModificar #procesador").val(datos.procesador);
                    // $("form #modalModificar #ram").val(datos.ram);
                    // $("form #modalModificar #HDD").val(datos.almacenamiento);
                    // $("form #modalModificar #tamano").val(datos.tamano);
                    // $("form #modalModificar #descripcion").val(datos.descripcion);
                    // $("form #modalModificar #lugar").val(datos.lugar);
                    // $("form #modalModificar #categoria").val(datos.categoria);
                    // $("form #modalModificar #estado").val(datos.estado);
                    // $("form #modalModificar #idact").val(datos.id);
                //     console.log(datos.lugar);

                //     if(datos.lugar == null){
                //     divs[0].classList.remove("oculto");
                //     divs[1].classList.add("oculto");
                //     }else{
                //     divs[1].classList.remove("oculto");
                //     divs[0].classList.add("oculto");
                //     }
                },
                error: function(xhr, status, error) {
                    // Error handling
                    $('#resultado').html('<p>Error al consultar datos.</p>');
                }
            });
        });
        
    });
</script>