@extends('layouts.app')

@section('content')
    <style>
      .oculto{
        display: none;
      }
    </style>

    <style>
      .modal-md {
        max-width: 700px; /* Cambia el tamaño de los modales grandes */
      }
    </style>

    <div class="w-full  bg-white shadow-lg rounded-lg flex items-center justify-between p-4 m-auto border-1 border-red-600">

      <h1></h1>

      <!-- Título en el centro -->
      <h1 class="text-lg font-semibold text-gray-800 text-center md:!ml-10">
          TODOS LOS EQUIPOS
      </h1>

      <!-- Botón derecho -->
      <h1></h1>

      
    </div>

    <div name="divcantidades" class="flex justify-center items-center mt-10">
        <div class="md:flex md:space-x-4 md:justify-between md:w-11/12 m-auto grid grid-cols-2">
            <div class="md:w-56 md:h-32 bg-emerald-500 md:rounded-lg p-6 md:shadow-md shadow-gray-700">
              <h1 class="text-white">Equipos Totales: {{$equipostotales}} </h1>
            </div>
            <div class="md:w-56 md:h-32 bg-sky-600 md:rounded-lg p-6 md:shadow-md shadow-gray-700">
              <h1 class="text-white">Equipos disponibles: {{$equiposbuenos}} </h1>
            </div>
            <div class="md:w-56 md:h-32 bg-amber-500 md:rounded-lg p-6 md:shadow-md shadow-gray-700">
              <h1 class="text-white">Equipos dañados: {{$equiposdanados}} </h1>
            </div>
            <div class="md:w-56 md:h-32 bg-purple-600 md:rounded-lg p-6 md:shadow-md shadow-gray-700">
              <h1 class="text-white">Equipos sin usar: {{$equiposnouso}} </h1>
            </div>
        </div>
    </div>

    <div class="modal fade pt-[20%] md:!pt-0" id="modalfiltro" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-body text-center px-1 py-9 overflow-auto">
                  <div class="">
                      {{-- <label for="" class="block mb-6">FECHA: </label>
                      <div class="flex w-full justify-center">
                          <input type="date" id="filtrofecha1" name="filtrofecha1" class="ml-2 mb-2 pl-1 max-w-[130px] md:max-w-[200px] rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                          <h1 class="m-2 mt-2 text-1xl">hasta</h1>
                          <input type="date" name="filtrofecha2" id="filtrofecha2" class="ml-2 mb-2 pl-1 max-w-[130px] md:max-w-[200px]  rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                      </div> --}}
                      <label for="" class="block mt-4 mb-2">SUCURSAL DEL USUARIO: </label>
                      <select name="filtrosucursal" id="filtrosucursal" class="ml-2 mb-2 pl-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                          <option value="0">todas las sucursales</option>
                          @forEach($sucursales as $item)
                              <option value="{{$item->id}}">{{$item->nombre}}</option>
                          @endforeach
                      </select>
                      {{-- <div class="flex w-11/12 mx-auto justify-around">
                          <div>
                              <label for="" class="block mt-4 mb-2">SISTEMA DEL TICKET: </label>
                              <select name="filtrosistema" id="filtrosistema" class="ml-2 mb-2 pl-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                                  <option value="0">todos los sistemas</option>
                                  @forEach($sistemas as $item)
                                      <option value="{{$item->id}}">{{$item->nombre}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div>
                              <label for="" class="block mt-4 mb-2">MIS TICKETS: </label>
                              <input type="checkbox" name="propios" id="propios" class="rounded-md mt-2">
                              <input type="text" hidden name="usuariotecnico" id="usuariotecnico" value="{{Auth::user()->id}}">
                          </div>
                      </div> --}}
                      <label for="" class="block mt-4 mb-2">ESTADO DEL EQUIPO: </label>
                      <select name="filtroestado" id="filtroestado" class="ml-2 mb-2 pl-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                          <option value="0">todos los estados</option>
                          @forEach($estados as $item)
                              <option value="{{$item->id}}">{{$item->descripcion}}</option>
                          @endforeach
                      </select>
                      <label for="" class="block mt-4 mb-2">TIPO DE EQUIPO: </label>
                      <select name="filtrotipo" id="filtrotipo" class="ml-2 mb-2 pl-1 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                          <option value="0">TODOS</option>
                          <option value="1">PC</option>
                          <option value="2">LAPTOP</option>
                          <option value="3">IMPRESORA</option>
                      </select>
                      
                      <p id="filtro-error" class="text-red-500 text-sm hidden">Debe llenar al menos una de las opciones!</p>
                      <div class="mb-10"></div>

                      <button class="block p-2 bg-emerald-500 rounded-md text-white w-40 m-auto" id="filtroboton" data-type="filtro">VER RESULTADOS</button>
                      <button class="block p-2 bg-emerald-500 rounded-md text-white w-50 m-auto mt-2" id="filtroboton" data-type='excel'>DESCARGAR EXCEL</button>
                  </div>
              </div>
          </div>
      </div>
    </div>
    
    <div class="container-fluid mt-14">
        <div class="w-1/4 flex items-end ">
          <div class="border-r-[1px] rounded-tl-md border-black bg-white md:px-8 md:py-2 px-4 md:max-h-[50px] max-h-[30px] min-h-[30px]" id="botontabla" data-type="pc" name="botonpc" >
            <h1 class="pt-1 md:pt-0">pc</h1>
          </div>
          <div class="border-b-[1px] border-r-[1px] border-black bg-gray-300 md:px-8 md:py-2 px-4 md:max-h-[50px] max-h-[30px] min-h-[30px] hover:cursor-pointer hover:bg-gray-200" id="botontabla" data-type="laptop" name="botonlaptop">
            <h1 class="pt-1 md:pt-0">laptops</h1>
          </div>
          <div class="border-b-[1px] rounded-tr-md border-black bg-gray-300 md:px-8 md:py-2 px-4 md:max-h-[50px] max-h-[30px] min-h-[30px] hover:cursor-pointer hover:bg-gray-200" id="botontabla" data-type="impresora" name="botonimpresora">
            <h1 class="pt-1 md:pt-0">impresoras</h1>
          </div>
        </div>
        <div class=" bg-white border-0 rounded-tr-lg shadow mb-5 pt-3 ">

          

          <div class="d-grid gap-2 hidden md:block d-md-flex justify-content-md-end  mr-10">
            <input type="text" id="search" placeholder="Buscar por nombre..." class=" form-control md:w-[300px]  h-[50px] rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm col-span-4">
            <button class="p-2 md:mb-4 mb-2 bg-emerald-500 rounded-md text-white md:w-40 mt-2 md:mt-0  ml-2 md:ml-0 hidden md:block" onclick="mostrarfiltro()">FILTRAR</button>
            <button type="button" class="btn btn-primary hidden md:block mt-2 mb-2" data-bs-toggle="modal" data-bs-target="#modalAgregarEquipo"><i class="bi bi-check2-square"></i>
                Agregar</button>

          </div>

          <div class="w-full md:!hidden flex flex-col items-end">
            <button class="px-2  h-[30px] md:mb-4  bg-emerald-500 rounded-md text-white md:w-40 w-[100px] text-sm md:mt-0  ml-2 md:ml-0 mr-2" onclick="mostrarfiltro()">FILTRAR</button>

            <button type="button" class="bg-blue-500 text-white rounded-md w-[100px] h-[30px] text-sm mt-2 mr-2 text-center" data-bs-toggle="modal" data-bs-target="#modalAgregarEquipo">
                Nuevo equipo</button>
          </div>
            
            <div class=" md:!p-10 p-2 pt-2 md:!pt-4" >
                <p class="lead">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    
                </div>
                <hr>
                <div id="tablaEquiposLoad" class="oculto">
                    <div class="overflow-x-auto">
                      <table class="table-auto w-full  border-gray-200  rounded-t-lg" name="" id="tablaEquiposDataTable">
                        <thead class="bg-gray-800 text-white rounded-t-lg">
                    
                          <th class="text-center p-4 hidden md:table-cell rounded-tl-lg">Codigo</th>
                          <th class="text-center p-4 hidden md:table-cell">Departamento/sucursal <br> o usuario</th>
                          <th class="text-center p-4 hidden md:table-cell">Nombre</th>
                          <th class="text-center p-4  md:hidden ">Datos</th>
                          <th class="text-center p-4" hidden>Categoria</th>
                          <th class="text-center p-4 hidden md:table-cell">Marca</th>
                          <th class="text-center p-4" hidden>Modelo</th>
                          <th class="text-center p-4" hidden>Procesador</th>
                          <th class="text-center p-4" hidden>Ram</th>
                          <th class="text-center p-4" hidden>almacenamiento</th>
                          <th class="text-center p-4 hidden md:table-cell">Estado</th>
                          <th class="text-center p-4" hidden>reportes</th>
                          <th class="text-center p-4 md:rounded-tr-lg">Acciones</th>
                      </thead>
                      <tbody>
                          @foreach($pcs as $item)
                          <tr class="odd:bg-white even:bg-gray-100 border-r-2 border-l-2 border-b-2 border-gray-200 tablapc"> 
                              <td class="text-center p-4" hidden id="id">{{$item->id}}</td>
                              <td class="text-center p-4 hidden md:table-cell">{{$item->codigo}}</td>
                              <td class="text-center p-4 hidden md:table-cell">{{$item->lugar?->nombre?? $item->usuario?->descripcion?? 'sin sucursal'}}</td>
                              <td class="text-center p-4 hidden md:table-cell" nombre="nombre">{{$item->descripcion}}</td>
                              <td class="text-left p-1 pt-1  md:hidden" datos="datos"><h1 class="text-lg font-semibold">{{ \Illuminate\Support\Str::limit($item->descripcion, 35, '...')}}</h1><p class="pt-2">{{$item->codigo}}</p><p class="pt-1">{{$item->estado->descripcion}}</p></td>
                              <td class="text-center p-4" hidden categoria='1'>{{$item->categoria_id?? 'sin categoria'}}</td>
                              <td class="text-center p-4 hidden md:table-cell">{{$item->marca}}</td>
                              <td class="text-center p-4"  hidden>{{$item->modelo}}</td>
                              <td class="text-center p-4" hidden>{{$item->procesador}}</td>
                              <td class="text-center p-4" hidden>{{$item->ram}}</td>
                              <td class="text-center p-4" hidden>{{$item->almacenamiento}}</td>
                              <td class="text-center p-4 hidden md:table-cell">{{$item->estado->descripcion}}</td>
                              <td class="text-center p-4 " hidden>a</td>
                              <td class="text-center md:!p-4 p-1 pt-4 flex justify-between">
                                <button id="btnConsulta" class="bi btn btn-warning btn-sm w-10 h-10" data-type="pc"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-danger btn-sm w-10 h-10" id="borrar"><i class="bi bi-trash"></i></button>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
                  <div class="mt-4 p-2">
                    {{ $pcs->links() }}
                  </div>
                  </div>
              </div>
                
              {{-- TABLA DE LAPTOPS --}}

              <div id="tablalaptopsLoad" class="oculto">
                <div class="overflow-x-auto">
                  <table class="table-auto w-full  border-gray-200  rounded-t-lg " id="tablaEquiposDataTable">
                    <thead class="bg-gray-800 text-white rounded-t-lg">
                
                        <th class="text-center p-4 hidden md:table-cell rounded-tl-lg">Codigo</th>
                        <th class="text-center p-4 hidden md:table-cell">Departamento/sucursal <br> o usuario</th>
                        <th class="text-center p-4 hidden md:table-cell">Nombre</th>
                        <th class="text-center p-4 md:hidden rounded-tl-lg">Datos</th>
                        <th class="text-center p-4" hidden>Categoria</th>
                        <th class="text-center p-4 hidden md:table-cell">Marca</th>
                        <th class="text-center p-4" hidden>Modelo</th>
                        <th class="text-center p-4" hidden>Procesador</th>
                        <th class="text-center p-4" hidden>Ram</th>
                        <th class="text-center p-4" hidden>almacenamiento</th>
                        <th class="text-center p-4 hidden md:table-cell">Estado</th>
                        <th class="text-center p-4" hidden>reportes</th>
                        <th class="text-center p-4 rounded-tr-lg">Acciones</th>
                    </thead>
                    <tbody>
                        @foreach($laptops as $item)
                        <tr class="odd:bg-white even:bg-gray-100 border-r-2 border-l-2 border-b-2 border-gray-200 tablalap"> 
                            <td class="text-center p-4" hidden id="id">{{$item->id}}</td>
                            <td class="text-center p-4 hidden md:table-cell">{{$item->codigo}}</td>
                            <td class="text-center p-4 hidden md:table-cell">{{$item->lugar?->nombre?? $item->usuario?->descripcion?? 'sin sucursal'}}</td>
                            <td class="text-center p-4 hidden md:table-cell" nombre="nombre">{{$item->descripcion}}</td>
                            <td class="text-left p-1 pt-1  md:hidden" datos="datos"><h1 class="text-lg font-semibold">{{ \Illuminate\Support\Str::limit($item->descripcion, 20, '...')}}</h1><p class="pt-2">{{$item->codigo}}</p><p class="pt-1">{{$item->estado->descripcion}}</p></td>
                            <td class="text-center p-4" hidden categoria='1' >{{$item->categoria_id}}</td>
                            <td class="text-center p-4 hidden md:table-cell">{{$item->marca}}</td>
                            <td class="text-center p-4" hidden>{{$item->modelo}}</td>
                            <td class="text-center p-4" hidden>{{$item->procesador}}</td>
                            <td class="text-center p-4" hidden>{{$item->ram}}</td>
                            <td class="text-center p-4" hidden>{{$item->almacenamiento}}</td>
                            <td class="text-center p-4 hidden md:table-cell">{{$item->estado->descripcion}}</td>
                            <td class="text-center p-4" hidden>a</td>
                            <td class="text-center md:!p-4 p-1 pt-4 flex justify-between">
                              <button id="btnConsulta" class="bi btn btn-warning btn-sm w-10 h-10" data-type="pc"><i class="bi bi-pencil-square"></i></button>
                              <button class="btn btn-danger btn-sm w-10 h-10" id="borrar"><i class="bi bi-trash"></i></button>
                            </td>                          
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4 p-2">
                  {{ $laptops->links() }}
                </div>
                </div>
              </div>

            <div id="tablaimpresorasLoad" class="oculto">
              <div class="overflow-x-auto">
                <table class="table-auto w-full  border-gray-200  rounded-t-lg " id="tablaEquiposDataTable">
                  <thead class="bg-gray-800 text-white rounded-t-lg">
              
                      <th class="text-center p-4 hidden md:table-cell rounded-tl-lg">Codigo</th>
                      <th class="text-center p-4 hidden md:table-cell">Departamento/sucursal <br> o usuario</th>
                      <th class="text-center p-4 hidden md:table-cell">Nombre</th>
                      <th class="text-center p-4 md:hidden rounded-tl-lg">Datos</th>
                      <th class="text-center p-4" hidden>Categoria</th>
                      <th class="text-center p-4 hidden md:table-cell">Marca</th>
                      <th class="text-center p-4" hidden>Modelo</th>
                      <th class="text-center p-4 hidden md:table-cell">Estado</th>
                      <th class="text-center p-4" hidden>reportes</th>
                      <th class="text-center p-4 rounded-tr-lg">Acciones</th>
                  </thead>
                  <tbody>
                      @foreach($impresoras as $item)
                      <tr class="odd:bg-white even:bg-gray-100 border-r-2 border-l-2 border-b-2 border-gray-200 tablaimp"> 
                          <td class="text-center p-4" hidden id="id">{{$item->id}}</td>
                          <td class="text-center p-4 hidden md:table-cell">{{$item->codigo}}</td>
                          <td class="text-center p-4 hidden md:table-cell">{{$item->lugar?->nombre?? $item->usuario?->descripcion?? 'sin sucursal'}}</td>
                          <td class="text-center p-4 hidden md:table-cell" nombre="nombre">{{$item->descripcion}}</td>
                          <td class="text-left p-1 pt-1  md:hidden" datos="datos"><h1 class="text-lg font-semibold">{{ \Illuminate\Support\Str::limit($item->descripcion, 20, '...')}}</h1><p class="pt-2">{{$item->codigo}}</p><p class="pt-1">{{$item->estado->descripcion}}</p></td>
                          <td class="text-center p-4" hidden categoria='1'>{{$item->categoria_id}}</td>
                          <td class="text-center p-4 hidden md:table-cell">{{$item->marca}}</td>
                          <td class="text-center p-4" hidden>{{$item->modelo}}</td>
                          <td class="text-center p-4 hidden md:table-cell">{{$item->estado->descripcion}}</td>
                          <td class="text-center p-4" hidden>a</td>
                          <td class="text-center md:!p-4 p-1 pt-4 flex justify-between">
                            <button id="btnConsulta" class="bi btn btn-warning btn-sm w-10 h-10" data-type="pc"><i class="bi bi-pencil-square"></i></button>
                            <button class="btn btn-danger btn-sm w-10 h-10" id="borrar"><i class="bi bi-trash"></i></button>
                          </td>                       
                      </tr>
                      @endforeach
                  </tbody>
              </table>
              <div class="mt-4 p-2">
                {{ $impresoras->links() }}
              </div>
            </div>
          </div>
                <div>
                  <div class="modal fade" id="modalModificarpc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">
                        <div class="modal-header bg-blue-600">
                          <h1 class="modal-title fs-5 text-center text-lg w-full bg-blue-600 text-white">Datos del equipo</h1>
                          {{-- <button class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        </div>
                          <form id="frmModificarEquipo" method="POST">
                            <div class="modal-body grid grid-cols-4 gap-4">

                              <div class="m-auto col-span-4 flex justify-center md:w-full border border-gray-400">
                                <div class="col-sm-4 flex w-full justify-end flex-col md:flex-row md:pl-5">
                                  <label for="codigo" class="block text-sm font-medium text-blue-500 pt-3 md:mr-3">CODIGO: </label>
                                  <div class="flex flex-col">
                                    <textarea type="text" class="  border-none w-fit h-auto resize-none bg-transparent  p-2 rounded focus:border-none" placeholder="Enter your first name" readonly id="codigo" name="codigo" required></textarea>
                                  
                                    <p id="codigo-error" class="text-red-500 text-sm" hidden>Este campo es obligatorio!</p>
                                  </div>
                                  <label for="codigo" id="codigolabel" name="codigolabel" class="mt-1 rounded border-none" hidden></label>
                                </div>
                                <div class="col-sm-4 flex flex-col md:flex-row w-full justify-start md:pl-5">
                                  <label for="descripcion" class="block text-sm font-medium text-blue-500 pt-3 mr-3">NOMBRE: </label>
                                  <div class="flex flex-col">
                                    <textarea class=" border-none w-fit h-auto resize-none bg-transparent  p-2 rounded focus:border-none" placeholder="Enter your text" readonly id="descripcion" name="descripcion" maxlength="40af"></textarea>
                                  
                                    <p id="nombre-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
                                  </div>                                 
                                  <label for="descripcion" id="descripcionlabel" name="descripcionlabel" class="mt-1 rounded border-none" hidden></label>
                                </div>
                              </div>
                    
                              <div class="md:col-span-2 col-span-4 flex flex-col justify-around border border-gray-400 py-3">
                                <div class="col-sm-4 flex pl-5 w-full h-5 pr-5" id="divmarca">
                                  <label for="marca" class="text-base font-medium text-gray-700">Marca: </label>
                                  <input hidden type="text" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Enter your first name"  id="marca" name="marca">
                                  <p id="marca-error" class="text-red-500 text-sm " hidden>Este campo es obligatorio!</p>
                                  <label for="marca" id="marcalabel" name="marcalabel" class="pl-[10px] text-base w-3/4 rounded border-none" ></label>
                                </div>
                    
                                <div class="col-sm-4 flex mt-[10px] pl-5 w-full h-5 pr-5" id="divmodelo">
                                  <label for="modelo" class="block text-base font-medium text-gray-700">Modelo: </label>
                                  <input hidden type="text" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Enter your first name"  id="modelo" name="modelo" required>
                                  <p id="modelo-error" class="text-red-500 text-sm" hidden>Este campo es obligatorio!</p>
                                  <label for="modelo" id="modelolabel" name="modelolabel" class="pl-[10px] text-base block w-full rounded border-none"></label>
                                </div>
                    
                                <div class="col-sm-4 flex pl-5 w-full h-5 mt-[10px] pr-5" id="divprocesador">
                                  <label for="procesador" id="procesadorlabel1" class="block text-base font-medium text-gray-700">Procesador: </label>
                                  <input hidden type="text" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Enter your first name"  id="procesador" name="procesador" required>
                                  <p id="procesador-error" class="text-red-500 text-sm" hidden>Este campo es obligatorio!</p>
                                  <label for="procesador" id="procesadorlabel" name="procesadorlabel" hidden class="pl-[10px] text-base block w-full rounded border-none"></label>
                                </div>
                    
                                <div class="col-sm-4 flex pl-5 w-full h-5 mt-[10px] pr-5" id="divram">
                                  <label for="ram" id="ramlabel1" class="block text-base font-medium text-gray-700">Ram: </label>
                                  <input hidden type="text" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Enter your first name"  id="ram" name="ram" required>
                                  <p id="ram-error" class="text-red-500 text-sm" hidden>Este campo es obligatorio!</p>
                                  <label for="ram" id="ramlabel" name="ramlabel" class="pl-[10px] text-base block w-full rounded border-none" ></label>
                                </div>
                    
                                <div class="col-sm-4 flex pl-5 w-full h-5 mt-[10px] pr-5" id="divhdd">
                                  <label for="HDD" id="HDDlabel1" class="block text-base font-medium text-gray-700">Almacenamiento: </label> 
                                  <label for="HDD" id="HDDlabel" name="HDDlabel" class="pl-[10px] text-base block w-full rounded border-none" ></label>
                                  
                                  <input hidden type="text" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Enter your first name"  id="HDD" name="HDD" required>
                                  <p id="HDD-error" class="text-red-500 text-sm" hidden>Este campo es obligatorio!</p>
                                </div>

                                <div class="col-sm-4 flex  pl-5 w-full" hidden>
                                  <label for="tipo">tipo</label>
                                  <input type="text" class=" block w-full rounded border-none" placeholder="Enter your first name"  id="tipo" name="tipo" value="pc" >
                                </div>
                    
                                

                                <div class="col-sm-4 flex  pl-5 w-full mt-1" hidden >
                                  <label for="marca">id</label>
                                  <input type="text" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Enter your first name"  id="idact" name="idact">
                                </div>
                    
                              </div>
                    
                              <div class="md:col-span-2 col-span-4 flex flex-col justify-around md:max-h-[250px] border-gray-400 border md:pb-10 pb-20 pt-2">
                    
                                <div class="col-sm-4 flex  md:!pl-24 pl-6  md:w-11/12 md:mx-auto  h-5 pr-5" id="divcate">
                                  <label for="categoria" id='catelabel' class="block text-base md:text-center text-left font-medium text-gray-700 ">Categoria: </label>
                                  <input type="text" id="categoria" name="categoria" class=" block w-full rounded border-none pt-[10px]" hidden>
                                  <label for="categoria" id="categorialabel" name="categorialabel" class=" block w-full rounded border-none pl-[10px]"></label>
                                  
                                  {{-- <select name="categoria" id="categoria" hidden>
                                  
                                    <option value="">sin categoria</option>
                                      @forEach($categorias as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                      @endforeach
                                  </select> --}}
                                </div>
                    
                                <div class="col-sm-4 flex flex-col  pl-5 w-full h-5 mt-[10px] pr-5 ">
                                  <label for="lugar" id="" class="block text-base md:text-center text-left font-medium text-gray-700 ">Sucursal o Departamento: </label>
                                  
                                  <input type="text" id="lugar" name="lugar" class="1  rounded border-none  pt-[10px]" hidden>
                                  <label for="categoria" id="lugarlabel" name="lugarlabel" class="md:text-center text-left block w-full rounded border-none pl-[10px] md:!pl-2 mt-1"></label>
                                  <select name="lugarsele" id="lugarsele" class="mt-1 block w-full h-12 px-2  rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" hidden>
                                    @forEach($sucursales as $item)
                                      <option value="{{$item->id}}">{{$item->nombre}}</option>
                                    @endforeach
                                  </select>
                                </div>
                    
                                <div class="col-sm-4 flex flex-col  pl-5 w-full h-5 md:mt-[30px] mt-[60px] pr-5">
                                  <label for="estado" id="" class="block text-base md:text-center text-left font-medium text-gray-700 ">estado del equipo: </label>
                                  
                                  <input type="text" id="estado" name="estado" class=" block  rounded border-none pt-[10px]" hidden>
                                  <label for="categoria" id="estadolabel" name="estadolabel" class="md:text-center text-left w-full rounded border-none mt-1 pl-[10px] md:!pl-2 "></label>
                                  <select name="estadosele" id="estadosele" class="mt-1 block w-full h-12 md:!px-2 px-4 rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" hidden>
                                    @forEach($estados as $item)
                                      <option value="{{$item->id}}">{{$item->descripcion}}</option>
                                    @endforeach
                                  </select>
                                </div>
                    
                                
                    
                              </div>

                              
                              <input type="hidden" id="idEquipo" name="idEquipo">
                             
                    
                            </div>
                          </form>
                          <div class="row flex justify-around mb-3">
                            <button class="btn btn-warning btn-sm oculto w-1/4" id="anadirpc" name="anadir" data-type="pc">Asignar a sucursal</button>
                            <button class="btn btn-warning btn-sm oculto w-1/4" id="quitarpc" name="quitar" data-type="pc">Quitar de sucursal</button>
                            <button class="btn btn-primary btn-sm w-1/4" id="historial" onclick="verhistorial(event)">historial</button>
                          </div>
                        <div class="modal-footer flex justify-between px-7">
                          
                          <span type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Cerrar</span>
                          <button class="btn btn-primary btn-sm" id="actualizar" data-type="pc" onclick="modificarEquipo()">Actualizar</button>
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

                {{-- MODAL PARA SELECCIONAR USUARIO --}}


                <div class="modal fade" id="verusuarios" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Elegir usuario</h1>
                              <button class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close" onclick="cerrarmodalusuario()"></button>
                          </div>
                          <div class="modal-body">
                              <div class="mb-4 w-11/12 mx-auto text-center flex justify-center">
                                  <input type="text" class="form-control mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" id="buscarusuarios" placeholder="Buscar usuario...">
                              </div>
              
                              <div id="usuarios" class="max-h-[570px] overflow-auto">
                                  <table class="w-11/12 mx-auto border-separate border-spacing-y-2">
                                      <tbody id="tablaUsuarios" class="space-y-2">
                                          @foreach ($usuarios as $item)
                                              <tr class="fila-usuario my-2" onclick="usuarioporsucursal()">
                                                  <td class=" p-3 rounded-md border border-gray-200 bg-gray-100 hover:cursor-pointer hover:bg-gray-200 shadow-md w-full" nombre="nombre">
                                                      {{ $item->descripcion }}
                                                  </td>
                                                  <td hidden id="id">{{$item->id}}</td>
                                              </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              




                <div class="modal fade mt-[20%]" id="confirmar" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content p-4">
                        <h2 class="text-lg font-semibold text-center">¿Estás seguro?</h2>
                        <p class="text-sm text-gray-600 text-center mt-2" id="texto">Esta acción quitara este equipo de esta sucursal.</p>
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
                <div class="modal fade mt-[20%]" id="confirmModal" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content p-4">
                        <h2 class="text-lg font-semibold text-center">¿Estás seguro?</h2>
                        <p class="text-sm text-gray-600 text-center mt-2" id="texto">Esta acción eliminara este equipo</p>
                        <div class="mt-4 w-[99%] m-auto text-center">
                            <label for="bnombre" id="bnombre" class="text-center "></label>
                            
                        </div>
                        <div class="flex justify-between mt-8">
                            <button id="confirmYes2" class="btn btn-danger text-white px-4 py-2 rounded">
                                Sí, eliminar
                            </button>
                            <button id="confirmNo2" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                                Cancelar
                            </button>
                        </div>
                      </div>
                  </div>
                </div>

                <div class="modal fade" id="historialmodal" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content p-4">
                      <div class="modal-header flex justify-center">
                        <h1 class="modal-title fs-5 text-semibold text-4xl text-red-600" id="exampleModalLabel">Historial del equipo</h1>
                      </div>
                      <div class="modal-body">
                        <div id="divfiltro" class="flex w-full justify-end mb-20">
                          <label for="filtro" class="pt-[10px] mr-2">Buscar por fecha: </label>
                          <input type="date" id="fecha1" class="border-red-600 rounded-md">
                          <span class="text-lg px-4">_</span>
                          <input type="date" id="fecha2" class="border-red-600 rounded-md">
                          <button class="btn btn-success ml-4" onclick="verhistorial(event)">buscar</button>
                      </div>

                      <div id="divhistorial">

                      </div>

                      </div>
                    </div>
                  </div>
                </div>
                
                <form id="frmEquipo" method="">
                  <div class="modal fade mt-[40%] md:!mt-0" id="modalAgregarEquipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Tipos de Equipos</h1>
                          <button class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close" onclick="event.preventDefault()"></button>
                        </div>
                        <div class="modal-body">
                
                          <div class="row">
                
                
                            <div class="col-sm-6">
                              <!--<label >Tipo de Equipo</label>-->
                              <label for="idCatEquipo"></label>
                            </div>
                
                          </div>
                
                          <div class="row flex flex-col justify-around">
                
                            <div class="col-sm-4 w-11/12 m-auto mb-4">
                              <a href="{{ route('guardar', ['valor' => 1]) }}" class="btn text-center rounded border border-gray-200 w-full text-lg">Pc</a>
                            </div>
                
                            <div class="col-sm-4  w-11/12 m-auto mb-4">
                              <a href="{{ route('guardar', ['valor' => 2]) }}" class="btn text-center rounded border border-gray-200 w-full text-lg">Laptop</a>
                            </div>
                
                            <div class="col-sm-4  w-11/12 m-auto">
                              <a href="{{ route('guardar', ['valor' => 3]) }}" class="btn text-center rounded border border-gray-200 w-full text-lg">Impresora</a>
                            </div>
                
                          </div>
                
                          <div class="row">
                            <div class="col-sm-12">
                            </div>
                          </div>
                
                          <div id="equipo-details" style="margin-top: 20px;">
                            <!-- Aquí se cargarán los campos adicionales -->
                          </div>
                
                        </div>
                      </div>
                    </div>
                  </div>
              </form>
              <form id="anadirmodal" method="">
                <div class="modal fade" id="modalasignar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header bg-teal-500">
                        <h1 class="modal-title fs-5 text-white text-center" id="exampleModalLabel">Asignar a sucursal</h1>
                        <button class="btn-close btn-sm " data-bs-dismiss="modal" aria-label="Close" onclick="event.preventDefault()"></button>
                      </div>
                      <div class="modal-body">
              
                        <div class="row">
                          {{-- datos del equipo --}}
                          <div class=" pb-2 text-center items-center border-b-2 border-gray-300">
                            <h1 class="text-lg">Datos del Equipo: </h1>
                          </div>
                          <div class="col-sm-12 w-[99%] m-auto flex justify-around mt-2 pb-3 pt-5">
                          
                            <label for="codigo" id="codigo" class="block text-lg font-medium text-gray-700  ">codigo</label>           
                            <label for="descripcion" id="descripcion" class="block text-lg font-medium text-gray-700 ">descripcion</label>
                            <label for="marca" id="marca" class="block text-lg font-medium text-gray-700 ">marca</label>
                            <label for="id" id="id" hidden></label>
                            <label for="tipo" id="tipo" hidden></label>
                          </div>
                        </div>
                        <div class="text-center mt-10 pt-3 border-t-2 border-gray-200">
                          <h1 class="text-lg">Elegir nueva sucursal</h1>
                        </div>
              
                        <div class="row mt-5 w-3/4 m-auto">
              
                          {{-- selec de sucursales --}}
                          <select name="asignarsele" id="asignarsele" class="rounded text-lg ">
                            @forEach($sucursales as $item)
                              <option value="{{$item->id}}">{{$item->nombre}}</option>
                            @endforeach
                          </select>
                          <label for="" id="usuariosele" hidden class="text-center"></label>
                        </div>
            
              
                        <div class="row">
                          <div class="col-sm-12">
                            {{-- botones --}}
                          </div>
                        </div>
              
                      </div>
                      <div class="modal-footer">
                        <span type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</span>
                        <button class="btn btn-primary btn-sm" id="agregarsucursal">Agregar</button>
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
  


  $(document).ready(function(){
    $(document).on('click', '#botontabla', function(){
      var type = $(this).data('type');
      const pc = $('[name="botonpc"]');
      const laptop = $('[name="botonlaptop"]');
      const impresora = $('[name="botonimpresora"]');

      var divs = [document.getElementById("tablaEquiposLoad"), document.getElementById("tablalaptopsLoad"),  document.getElementById("tablaimpresorasLoad")];
      // console.log(select.value)

      divs.forEach(function(div) {
        div.classList.add("oculto");
      });
      // console.log(type);

      if(type == 'pc'){

        divs[0].classList.remove("oculto");
        pc.removeClass('border-b-[1px]');
        pc.addClass('bg-white');
        pc.removeClass('hover:cursor-pointer');

        laptop.removeClass('bg-white');
        laptop.addClass('border-b-[1px]');
        laptop.addClass('bg-gray-300');
        laptop.addClass('hover:cursor-pointer');


        
        impresora.removeClass('bg-white')
        impresora.addClass('border-b-[1px]');
        impresora.addClass('bg-gray-300');
        impresora.addClass('hover:cursor-pointer');
      }else if(type == 'laptop'){
        divs[1].classList.remove("oculto");
        console.log('laptop')
        laptop.removeClass('border-b-[1px]');
        laptop.removeClass('bg-gray-300')
        laptop.addClass('bg-white');
        laptop.removeClass('hover:cursor-pointer');


        pc.addClass('border-b-[1px]');
        pc.removeClass('bg-white');
        pc.addClass('bg-gray-300');
        pc.addClass('hover:cursor-pointer');


        impresora.addClass('border-b-[1px]');
        impresora.removeClass('bg-white');
        impresora.addClass('bg-gray-300');
        impresora.addClass('hover:cursor-pointer');
      }else{
        divs[2].classList.remove("oculto");
        impresora.removeClass('border-b-[1px]');
        impresora.addClass('bg-white');
        impresora.removeClass('hover:cursor-pointer');
        
        laptop.removeClass('bg-white');
        laptop.addClass('border-b-[1px]');
        laptop.addClass('bg-gray-300');
        laptop.addClass('hover:cursor-pointer');
        
        pc.removeClass('bg-white');
        pc.addClass('border-b-[1px]');
        pc.addClass('bg-gray-300');
        pc.addClass('hover:cursor-pointer');
      }



    })
  })

  function validarFormulario(fomulario) {

        let esValido = true;
        // Validar Nombre
        if (!fomulario.descripcion || fomulario.descripcion.trim() === "") {
            $("#nombre-error").removeAttr('hidden');
            esValido = false;
        }else{
            $("#nombre-error").attr('hidden', true);
        }

        // Validar Apellido
        if (!fomulario.codigo || fomulario.codigo.trim() === "") {
            $("#codigo-error").removeAttr('hidden');
            esValido = false;
        }else{
            $("#codigo-error").attr('hidden', true);
        }

        // Validar Correo
        if (!fomulario.marca || fomulario.marca.trim() === "") {
            $("#marca-error").removeAttr('hidden');
            esValido = false;
        }else{
            $("#marca-error").attr('hidden', true);
        }

        //Validar Número
        if (!fomulario.modelo || fomulario.modelo.trim() === "") {
            $("#modelo-error").removeAttr('hidden');
            esValido = false;
        }else{
            $("#modelo-error").attr('hidden', true);
        }

        if(fomulario.categoria != 3){
          if (!fomulario.procesador || fomulario.procesador.trim() === "") {
            $("#procesador-error").removeAttr('hidden');
            esValido = false;
          }else{
              $("#procesador-error").attr('hidden', true);
          }

          if (!fomulario.ram || fomulario.ram.trim() === "") {
              $("#ram-error").removeAttr('hidden');
              esValido = false;
          }else{
              $("#ram-error").attr('hidden', true);
          }

          if (!fomulario.HDD || fomulario.HDD.trim() === "") {
              $("#HDD-error").removeAttr('hidden');
              esValido = false;
          }else{
              $("#HDD-error").attr('hidden', true);
          }
        }
        return esValido;
    }



  $(document).ready(function() {
    // Use event delegation for dynamic content
    $(document).on('click', '#btnConsulta', function() {
        // Find the closest <tr> to the clicked button and retrieve the id
        var id = $(this).closest('tr').find('td[id]').text();
        var type = $(this).closest('tr').find('td[categoria]').text();
        console.log(type);
        console.log(id);

        $('#agregarusuario').attr('id', 'agregarsucursal');
        $('#usuariosele').attr('hidden', true);
        $('#asignarsele').removeAttr('hidden');

        var ruta = '/consulta-datos/' +id;
        console.log(ruta);

        var divs = [document.getElementById("anadirpc"), document.getElementById("quitarpc")];
        
        
        $.ajax({
            url: ruta +'/' + type,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Process the returned data and display it
                // $("#modalModificar" +type).modal("show");
                var datos = data[0]; 
                console.log(datos);
               $("#modalModificarpc").modal("show");
                $("#frmModificarEquipo #marca").val(datos.marca);
                $(" #modalModificarpc #modelo").val(datos.modelo);
                $(" #modalModificarpc #codigo").val(datos.codigo);
                $(" #modalModificarpc #marcalabel").text(datos.marca);
                $(" #modalModificarpc #modelolabel").text(datos.modelo);
                $(" #frmModificarEquipo #codigolabel").text(datos.codigo);
                $(" #modalModificarpc #lugarsele").val(datos.lugar_id);
                $(" #modalModificarpc #estadosele").val(datos.estado_id);
                if(datos.categoria_id!=3){
                  $(" #modalModificarpc #procesador").val(datos.procesador);
                  $(" #modalModificarpc #ram").val(datos.ram);
                  $(" #modalModificarpc #HDD").val(datos.almacenamiento);
                  $(" #modalModificarpc #procesadorlabel").text(datos.procesador);
                  $(" #modalModificarpc #ramlabel").text(datos.ram);
                  $(" #modalModificarpc #HDDlabel").text(datos.almacenamiento);
                  $(" #modalModificarpc #procesadorlabel").removeAttr('hidden');
                  $(" #modalModificarpc #ramlabel").removeAttr('hidden');
                  $(" #modalModificarpc #HDDlabel").removeAttr('hidden');
                  $(" #modalModificarpc #procesadorlabel1").removeAttr('hidden');
                  $(" #modalModificarpc #ramlabel1").removeAttr('hidden');
                  $(" #modalModificarpc #HDDlabel1").removeAttr('hidden');

                  $(" #modalModificarpc #procesadorlabel").removeAttr('hidden', true);
                  $(" #modalModificarpc #ramlabel").removeAttr('hidden', true);
                  $(" #modalModificarpc #HDDlabel").removeAttr('hidden', true);
                }else{
                  $(" #modalModificarpc #procesador").attr('hidden', true);
                  $(" #modalModificarpc #ram").attr('hidden', true);
                  $(" #modalModificarpc #HDD").attr('hidden', true);

                  $(" #modalModificarpc #procesadorlabel1").attr('hidden', true);
                  $(" #modalModificarpc #ramlabel1").attr('hidden', true);
                  $(" #modalModificarpc #HDDlabel1").attr('hidden', true);
                  $(" #modalModificarpc #procesadorlabel").attr('hidden', true);
                  $(" #modalModificarpc #ramlabel").attr('hidden', true);
                  $(" #modalModificarpc #HDDlabel").attr('hidden', true);
                }
                // Revertimos los labels
                $('#modalModificarpc #marcalabel').removeAttr('hidden');
                $('#modalModificarpc #modelolabel').removeAttr('hidden');
                if(datos.categoria_id!=3){
                  $('#modalModificarpc #procesadorlabel').removeAttr('hidden');
                  $('#modalModificarpc #ramlabel').removeAttr('hidden');
                  $('#modalModificarpc #HDDlabel').removeAttr('hidden');
                }
                
                $('#modalModificarpc #categorialabel').removeAttr('hidden');
                $('#modalModificarpc #lugarlabel').removeAttr('hidden');
                $('#modalModificarpc #estadolabel').removeAttr('hidden');
                $('#modalModificarpc #divcate').removeAttr('hidden');

                // Mostramos los botones
                $('#modalModificarpc #anadirpc').removeAttr('hidden');
                $('#modalModificarpc #quitarpc').removeAttr('hidden');
                $('#modalModificarpc #historial').removeAttr('hidden');
                $('#modalModificarpc #btnborrar').removeAttr('hidden');

                // Ocultamos los inputs y restauramos el atributo readonly
                $('#modalModificarpc #codigo').attr('readonly', true);
                $('#modalModificarpc #descripcion').attr('readonly', true);
                $('#modalModificarpc #marca').attr('hidden', true);
                $('#modalModificarpc #modelo').attr('hidden', true);
                $('#modalModificarpc #procesador').attr('hidden', true);
                $('#modalModificarpc #ram').attr('hidden', true);
                $('#modalModificarpc #HDD').attr('hidden', true);
                $('#modalModificarpc #lugarsele').attr('hidden', true);
                $('#modalModificarpc #estadosele').attr('hidden', true);

                // Revertir las clases 'h-5' y 'flex-col' a sus valores originales
                $('#modalModificarpc #divhdd').removeClass('flex-col');
                $('#modalModificarpc #divhdd').addClass('h-5');
                $('#modalModificarpc #divram').removeClass('flex-col');
                $('#modalModificarpc #divram').addClass('h-5');
                $('#modalModificarpc #divmarca').removeClass('flex-col');
                $('#modalModificarpc #divmarca').addClass('h-5');
                $('#modalModificarpc #divmodelo').removeClass('flex-col');
                $('#modalModificarpc #divmodelo').addClass('h-5');
                $('#modalModificarpc #divprocesador').removeClass('flex-col');
                $('#modalModificarpc #divprocesador').addClass('h-5');

                // Revertir los estilos de los inputs
                $('#modalModificarpc #codigo').removeClass('block h-10 px-2 border-gray-300 focus:ring-blue-500 focus:border-blue-500');
                $('#modalModificarpc #descripcion').removeClass('block h-10 px-2 border-gray-300 focus:ring-blue-500 focus:border-blue-500');
                $('#modalModificarpc #codigo').addClass('border-none mt-1');
                $('#modalModificarpc #descripcion').addClass('border-none mt-1');

                $('#modalModificarpc #validar').attr('id','actualizar');
                $('#modalModificarpc #actualizar').attr('onclick','modificarEquipo()');
                $('#modalModificarpc #actualizar').removeClass('btn-success');
                $('#modalModificarpc #actualizar').addClass('btn-primary');

                $('#fecha1').val('');
                $('#fecha2').val('');

                var div = document.getElementById('modalModificarpc');
                var parrafos = div.getElementsByTagName('p');
                for (var i = 0; i < parrafos.length; i++) {
                    parrafos[i].setAttribute('hidden', true); // Agrega el atributo hidden
                }

                


                
                // $("form #modalModificarpc #tamano").val(datos.tamano);
                $(" #modalModificarpc #descripcion").val(datos.descripcion);
                if(datos.lugar_id != null){
                  $(" #modalModificarpc #lugar").val(datos.lugar_id);
                  $(" #modalModificarpc #lugarlabel").text(datos.lugar.nombre);
                }else{
                  $(" #modalModificarpc #lugarlabel").text('sin sucursal');
                }
                $(" #modalModificarpc #categoria").val(datos.categoria_id);
                $(" #modalModificarpc #estado").val(datos.estado.descripcion);
                $(" #modalModificarpc #descripcionlabel").text(datos.descripcion);
                $(" #modalModificarpc #categorialabel").text(datos.categoria.name);
                $(" #modalModificarpc #estadolabel").text(datos.estado.descripcion);
                $(" #modalModificarpc #idact").val(datos.id);
                console.log(datos.lugar_id);

                if(datos.lugar_id == null && datos.userid==null){
                  divs[0].classList.remove("oculto");
                  divs[1].classList.add("oculto");
                }else{
                  divs[1].classList.remove("oculto");
                  divs[0].classList.add("oculto");
                }
            },
            error: function(xhr, status, error) {
                // Error handling
                $('#resultado').html('<p>Error al consultar datos.</p>');
            }
        });
    });
    
  });

  

  $(document).ready(function(){
    $(document).on('click', '#btnborrar', function(){
      event.preventDefault();

      var type = $(this).data('type');
      var id = $("form #modalModificar" +type +" #idact").val();
      console.log(id);
      console.log(type);

      $.ajax({

        url:'/borrar/'+type+'/'+id,
        type:'DELETE',
        dataType:'json',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
        },
        success: function(){
          alert('registro borrado exitosamente');
          location.reload();
        },
        error: function(xhr){
          alert('error al borrar el registro');
        }
        
      })
    })
  })


  $(document).ready(function() {
      var idToDelete = null; // Variable para almacenar el ID del usuario a eliminar
      var categoriaval = 0;

      // Mostrar el modal de confirmación al hacer clic en "Borrar"
      $(document).on('click', '#borrar', function(event) {

          // Almacena el ID del usuario
          idToDelete = $(this).closest('tr').find('td[id]').text();
          const nombre = $(this).closest('tr').find('td[nombre]').text();
          categoriaval = $(this).closest('tr').find('td[categoria]').text();

          console.log(categoriaval);
          $('#confirmModal #bnombre').text(nombre);
          $('#confirmModal #bcategoria').text(categoriaval);
          // Muestra el modal
          $('#confirmModal').modal('show');
      });

      // Acción al confirmar "Sí, eliminar"
      $(document).on('click', '#confirmYes2', function() {
          console.log(idToDelete)
          console.log(categoriaval)
          if (idToDelete) {
              $.ajax({
                  url: '/equipo/eliminar/'+idToDelete +'/'+categoriaval,
                  type: 'DELETE',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                  },
                  success: function(response) {
                    $('#confirmModal').modal('hide')
                    $('#mensaje').text('Equipo borrado con exito!');
                    $('#modalmensaje').modal('show');
                    setTimeout(() => {
                      location.reload();
                    }, 2000);
                  },
                  error: function(xhr) {
                    $('#confirmModal').modal('hide')
                    $('#mensaje').text('Error al borrar el equipo. Intente nuevamente.');
                    $('#modalmensaje').modal('show');
                    setTimeout(() => {
                      location.reload();
                    }, 2000);
                  }
              });
          }

          // Cierra el modal
          $('#confirmModal').modal('hide');
      });

      // Acción al cancelar
      $(document).on('click', '#confirmNo2', function() {
          // Cierra el modal sin hacer nada
          $('#confirmModal').modal('hide');
      });
  });

  function toggleContent() {
    const content = document.getElementById('toggleContent');
    content.classList.toggle('oculto');
  }

  $(document).ready(function(){
    var div = document.getElementById("tablaEquiposLoad");
    div.classList.remove("oculto");
  })

  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[name="anadir"]').forEach(button => {
      button.addEventListener('click', function(event) {
        event.preventDefault(); 
        // var type = $(this).data('type');
        // console.log(type);
        var id = $(" #modalModificarpc #idact").val();
        var codigo = $(" #modalModificarpc #codigo").val();
        var marca = $(" #modalModificarpc #marca").val();
        var descripcion = $(" #modalModificarpc #descripcion").val();
        var cate = $(" #modalModificarpc #categoria").val();
        console.log(cate);
        $("#modalModificarpc").modal("hide");
        $("#modalasignar").modal("show");
        $("form #modalasignar #marca").text(marca);
        $("form #modalasignar #codigo").text(codigo);
        $("form #modalasignar #descripcion").text(descripcion);
        $("form #modalasignar #id").text(id);
        $("form #modalasignar #tipo").text(cate);

      });
    });
  });

  
  




  //FUNCION PARA AGREGAR SUCURSAL A UN EQUIPO

  $(document).ready(function(){
    $(document).on('click', '#agregarsucursal', function(){
      event.preventDefault(); 
      
      const formData = {
        sucursal: $("form #modalasignar #asignarsele").val(),
      };
      var type = $("form #modalasignar #tipo").text();
      var id =  $("form #modalasignar #id").text()
      console.log(formData.sucursal);

      function esperar(ms) {
          return new Promise(resolve => setTimeout(resolve, ms));
      }

      if(formData.sucursal==0){
        $('#modalasignar').modal('hide');
        $('#verusuarios').modal('show')


      }else{
        $.ajax({
          url:'asignar/' +id+'/'+type,
          type:'POST',
          data: formData,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
          },  
          success: function(response) {
            $('#modalasignar').modal('hide');
            $('#mensaje').text('Sucursal asignada con exito!');
            $('#modalmensaje').modal('show');
            setTimeout(() => {
                location.reload();
              }, 2000);
            
          },
          error: function(xhr) {
            // Manejar errores (opcional)
            alert('Error al asignar sucursal');
          }

        })
      }

      //console.log(type);

      
    })
  })

  

  document.addEventListener("DOMContentLoaded", function () {
      const inputBuscar = document.getElementById('buscarusuarios');
      const filas = document.querySelectorAll('.fila-usuario');

      inputBuscar.addEventListener('input', function () {
          const texto = this.value.toLowerCase();

          if (texto.length < 3) {
              filas.forEach(fila => fila.style.display = '');
              return;
          }

          filas.forEach(fila => {
              const textoFila = fila.textContent.toLowerCase();
              fila.style.display = textoFila.includes(texto) ? '' : 'none';
          });
      });
  });


  document.addEventListener("DOMContentLoaded", function(){
    const input = document.getElementById('search');
    const pc = document.querySelectorAll('.tablapc');
    const laptop = document.querySelectorAll('.tablalap');
    const impresora = document.querySelectorAll('.tablaimp');

    input.addEventListener('input', function(){
      const texto= this.value.toLowerCase();

      if (texto.length < 3){
        pc.forEach(fila => fila.style.display = '');
        laptop.forEach(fila => fila.style.display = '');
        impresora.forEach(fila => fila.style.display = '');
        return;
      }
      pc.forEach(fila=> {
        const textoe = fila.textContent.toLowerCase();
        fila.style.display = textoe.includes(texto)? '': 'none';
      })
      laptop.forEach(fila=> {
        const textoe = fila.textContent.toLowerCase();
        fila.style.display = textoe.includes(texto)? '': 'none';
      })
      impresora.forEach(fila=> {
        const textoe = fila.textContent.toLowerCase();
        fila.style.display = textoe.includes(texto)? '': 'none';
      })
      


    })


  })

  function usuarioporsucursal(){
    var id = $(event.currentTarget).find("td[id]").text().trim(); // Obtén el id correctamente
    var nombre = $(event.currentTarget).find("td[nombre]").text().trim(); // Obtén el nombre correctamente

    console.log(nombre);
    console.log(id);

    $("form #modalasignar #asignarsele").attr('hidden', true);
    $("form #modalasignar #usuariosele").text(nombre);
    $("form #modalasignar #usuariosele").removeAttr('hidden');
    $('#agregarsucursal').attr('id', 'agregarusuario');
    
    $('#verusuarios').modal('hide');
    $('#modalasignar').modal('show');

    $(document).off('click', '#agregarusuario').on('click', '#agregarusuario', function(){
      event.preventDefault();
      console.log('agregando usuario');
      const formData = {
        usuario: id,
        type : $("form #modalasignar #tipo").text(),
        id :  $("form #modalasignar #id").text(),
      };
      $.ajax({
        url:'asignarusuario',
        type:'POST',
        data: formData,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
        },
        success: function(response){
          $('#modalasignar').modal('hide');
          $('#mensaje').text('Usuario asignado con exito!');
          $('#modalmensaje').modal('show');
          setTimeout(() => {
              location.reload();
            }, 2000);
        },
        error: function(xhr){
          $('#modalasignar').modal('hide');
          $('#mensaje').text('Error al asignar el usuario!');
          $('#modalmensaje').modal('show');
          setTimeout(() => {
              location.reload();
            }, 2000);
        }
      })
    })

  }



  

  

  //FUNCION PARA QUITAR SUCURSAL/ BUSCA POR NAME YA QUE ID ES DIFERENTE PARA MOSTRAR BOTONES EN TIPOS DIFERENTES DE MODAL
  document.addEventListener('DOMContentLoaded', function() {
    var type;
    var id;
    var lugar;
    document.querySelectorAll('[name="quitar"]').forEach(button => {
      button.addEventListener('click', function(event) {
        event.preventDefault(); 
        type = $(" #modalModificarpc #categoria").val();
        id = $(" #modalModificarpc #idact").val();
        lugar = null
        console.log(id);
        console.log(type);

        $("#modalModificarpc").modal('hide');
        $("#confirmar #texto").text("Esta acción quitara este equipo de esta sucursal.");
        $('#confirmar #confirmar2').attr('id', 'confirmYes');
        $('#confirmar #confirmYes').text('si, quitar');
        $('#confirmar #confirmYes').addClass('btn-danger');
        $("#confirmar").modal("show");

      });
      
    });
    $(document).on('click', '#confirmYes', function(){
      $.ajax({
          url:'quitar/'+id+'/'+type,
          type:'POST',
          data:lugar,
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
          },
          success: function(response) {
            $('#confirmar').modal('hide');
            $('#mensaje').text('Sucursal quitada con exito!');
            $('#modalmensaje').modal('show');
            setTimeout(() => {
              location.reload();
            }, 2000);

          },
          error: function(xhr) {
            // Manejar errores (opcional)
            $('#confirmar').modal('hide');
            $('#mensaje').text('ha ocurrido un error! intentelo de nuevo');
            $('#modalmensaje').modal('show');
            setTimeout(() => {
                $('#modalmensaje').modal('hide');
              }, 2000);
          }

        })
    });
    $(document).on('click', '#confirmNo', function() {
        // Cierra el modal sin hacer nada
        $('#confirmar').modal('hide');
        $('#modalModificarpc').modal('show');
    });

    
  });
 

  function mostrarDiv() {

    var select = document.getElementById("opciones");
    var divs = [document.getElementById("tablaEquiposLoad"), document.getElementById("tablalaptopsLoad"),  document.getElementById("tablaimpresorasLoad")];
    console.log(select.value)

    divs.forEach(function(div) {
      div.classList.add("oculto");
    });

    if (select.value ==1){
      divs[0].classList.remove("oculto");
    }if (select.value ==2){
      divs[1].classList.remove("oculto");
    }if (select.value ==3){
      divs[2].classList.remove("oculto");
    }
  }



  function modificarEquipo() {
  // quitamos las labels y botones

    console.log('hola');
    $('#modalModificarpc #codigolabel').attr('hidden');
    $('#modalModificarpc #descripcionlabel').attr('hidden');
    $('#modalModificarpc #marcalabel').attr('hidden', true);
    $('#modalModificarpc #modelolabel').attr('hidden', true);
    $('#modalModificarpc #procesadorlabel').attr('hidden', true);
    $('#modalModificarpc #ramlabel').attr('hidden', true);
    $('#modalModificarpc #HDDlabel').attr('hidden', true);
    $('#modalModificarpc #categorialabel').attr('hidden', true);
    $('#modalModificarpc #lugarlabel').attr('hidden', true);
    $('#modalModificarpc #estadolabel').attr('hidden', true);
    $('#modalModificarpc #divcate').attr('hidden', true);

    $('#modalModificarpc #anadirpc').attr('hidden', true);
    $('#modalModificarpc #quitarpc').attr('hidden', true);
    $('#modalModificarpc #historial').attr('hidden', true);
    $('#modalModificarpc #btnborrar').attr('hidden', true);

    //mostramos los inputs

    $('#modalModificarpc #codigo').removeAttr('readonly');
    $('#modalModificarpc #descripcion').removeAttr('readonly');
    $('#modalModificarpc #marca').removeAttr('hidden');
    $('#modalModificarpc #modelo').removeAttr('hidden');
    if($('#modalModificarpc #categoria').val()!=3){
      $('#modalModificarpc #procesador').removeAttr('hidden');
      $('#modalModificarpc #ram').removeAttr('hidden');
      $('#modalModificarpc #HDD').removeAttr('hidden');
    }
    
    $('#modalModificarpc #lugarsele').removeAttr('hidden');
    $('#modalModificarpc #estadosele').removeAttr('hidden');
    $('#modalModificarpc #divhdd').removeClass('h-5');
    $('#modalModificarpc #divhdd').addClass('flex-col');
    $('#modalModificarpc #divram').removeClass('h-5');
    $('#modalModificarpc #divram').addClass('flex-col');
    $('#modalModificarpc #divmarca').removeClass('h-5');
    $('#modalModificarpc #divmarca').addClass('flex-col');
    $('#modalModificarpc #divmodelo').removeClass('h-5');
    $('#modalModificarpc #divmodelo').addClass('flex-col');
    $('#modalModificarpc #divprocesador').removeClass('h-5');
    $('#modalModificarpc #divprocesador').addClass('flex-col');
    $('#modalModificarpc #codigo').removeClass('border-none mt-1');
    $('#modalModificarpc #descripcion').removeClass('border-none mt-1');
    $('#modalModificarpc #codigo').addClass(' block h-10 px-2  border-gray-300 focus:ring-blue-500 focus:border-blue-500');
    $('#modalModificarpc #descripcion').addClass(' block h-10 px-2  border-gray-300 focus:ring-blue-500 focus:border-blue-500');

    $('#modalModificarpc #actualizar').attr('onclick','confirmaract()');
    $('#modalModificarpc #actualizar').addClass('btn-success');


  // Evita el envío del formulario por el método convencional
  return false;
  }

  function confirmaract(){
    
    $("#confirmar #texto").text("Esta acción actualizara los datos del equipo.");
    $("#confirmar #confirmYes").text('Si, actualizar');
    $("#confirmar #confirmYes").removeClass('btn-danger');
    $("#confirmar #confirmYes").addClass('btn-primary');
    $("#confirmar #confirmYes").attr('id', 'confirmar2');
    $("#modalModificarpc #actualizar").attr('onclick', '');
    $("#modalModificarpc #actualizar").attr('id', 'validar');
    console.log('aqui tambien')
    
    
    
    $(document).off('click', '#validar').on('click', '#validar', function(){
      const formData = {
        id: $(" #modalModificarpc  #idact").val(),
        marca: $(" #modalModificarpc #marca").val(),
        modelo: $(" #modalModificarpc #modelo").val(),
        codigo: $(" #modalModificarpc #codigo").val(),
        procesador: $(" #modalModificarpc #procesador").val(),
        ram: $(" #modalModificarpc #ram").val(),
        HDD: $(" #modalModificarpc #HDD").val(),
        lugar: $(" #modalModificarpc #lugarsele").val(),
        estado: $(" #modalModificarpc #estadosele").val(),
        categoria: $(" #modalModificarpc #categoria").val(),
        descripcion: $(" #modalModificarpc #descripcion").val(),
      };
      console.log('antes de validar')
      if(validarFormulario(formData)){
        $('#modalModificarpc').modal('hide');
        $('#confirmar').modal('show');
        console.log('hola')
        $(document).on('click', '#confirmar2', function(){
          $.ajax({
            url: 'actualizar/' +formData.id+'/'+formData.categoria, 
            type: 'POST',
            data: formData,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            success: function(response) {
            

              $('#confirmar').modal('hide'); 
              $('#mensaje').text('el equipo se ha actualizado correctamente');
              $('#modalmensaje').modal('show');
              setTimeout(() => {
                  location.reload();
              }, 2000);
              
            },
            error: function(xhr) {
              // Manejar errores (opcional)
              $('#mensaje').text('ha ocurrido un error al intentar actualizar el equipo!');
              $('#modalmensaje').modal('show');
              setTimeout(() => {
                $('#modalmensaje').modal('hide');
              }, 2000);
              
            }
          });
        })

        $(document).on('click', '#confirmNo', function() {
            // Cierra el modal sin hacer nada
            $('#confirmar').modal('hide');
            $('#modalModificarpc').modal('show');
        });
      }else{
        console.log('no');
      }
    })

    

    return false;
  }

  function verhistorial(event){
    
    event.preventDefault();
    $('#modalModificarpc').modal('hide');

    const fecha1 = $('#fecha1').val();
    const fecha2 = $('#fecha2').val();

    if(fecha1 == '' && fecha2 == '' ){
        const formData ={
          id: $('#idact').val(),
          categoria: $('#categoria').val(),
        };

        console.log(formData);

        $.ajax({
          url:'verhistorial',
          data: formData,
          type:'GET',
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(data){
            console.log(data)
            const roleId = @json(Auth::user()->roleid);
            const div = document.getElementById('divhistorial');
            div.innerHTML = "";
            data.forEach(element => {
              const url = `/reporte-detalles/${element.id}${roleId}`;
              if(element.status_id == 1){
                div.innerHTML += `<a href="${url}">     
                          <div class="space-y-2 mt-2 mb-2">
                            <div class="flex justify-between items-center p-4 rounded-lg shadow-md h-24 text-black border-2 border-gray-200 grid grid-cols-6 gap-1 hover:bg-gray-200 cursor:pointer">
                              <h3 class="text-center grid-span-1">${element.fecha}</h3>
                              <h3 class="text-center grid-span-1">${element.codigo}</h3>
                              <h3 class="text-center grid-span-1">${element.usuario.name}</h3>
                              <h3 class="text-center grid-span-1">${element.descripcion}</h3>
                              <h3 class="text-center grid-span-1">${element.status.nombre}</h3>
                              <h3 class="text-center grid-span-1">${element.tecnico && element.tecnico.name ? element.tecnico.name : 'Sin técnico'}</h3>
                            </div>
                          </div>
                        </a>`;
              }
              
            });


            $('#historialmodal').modal('show');
          },
          error: function(xhr){
            alert('no');
          }
        })
    }else if(fecha1 != ''||fecha2 != ''){
      const formData ={
          id: $('#idact').val(),
          categoria: $('#categoria').val(),
          fecha1: fecha1,
          fecha2: fecha2,
      };

      $.ajax({
          url:'mostrarhistorial',
          data: formData,
          type:'GET',
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(data){
            console.log(data)
            const roleId = @json(Auth::user()->roleid);
            const div = document.getElementById('divhistorial');
            div.innerHTML = "";
            data.forEach(element => {
              const url = `/reporte-detalles/${element.id}${roleId}`;
              if(element.status_id == 1){
                div.innerHTML += `<a href="${url}">     
                          <div class="space-y-2 mt-2 mb-2">
                            <div class="flex justify-between items-center p-4 rounded-lg shadow-md h-24 text-black border-2 border-gray-200 grid grid-cols-6 gap-1 hover:bg-gray-200 cursor:pointer">
                              <h3 class="text-center grid-span-1">${element.fecha}</h3>
                              <h3 class="text-center grid-span-1">${element.codigo}</h3>
                              <h3 class="text-center grid-span-1">${element.usuario.name}</h3>
                              <h3 class="text-center grid-span-1">${element.descripcion}</h3>
                              <h3 class="text-center grid-span-1">${element.status.nombre}</h3>
                              <h3 class="text-center grid-span-1">${element.tecnico && element.tecnico.name ? element.tecnico.name : 'Sin técnico'}</h3>
                            </div>
                          </div>
                        </a>`;
              }
              
            });


            $('#historialmodal').modal('show');
          },
          error: function(xhr){
            alert('no');
          }
      })





    }


    

  }


  function mostrarfiltro(){
    $('#modalfiltro').modal('show');

    $(document).off('click', '#filtroboton').on('click','#filtroboton', function(){
      var type = $(this).data('type');
      const formData = {
        sucursal: $('#filtrosucursal').val(),
        estado: $('#filtroestado').val(),
        tipoequipo: $('#filtrotipo').val(),
        tipo : type,
      }

      console.log(formData);


      
      // Construir la URL con los parámetros
      let query = $.param(formData);
      let url = `/filtrosequipos?${query}`;

      // Redirigir a la página con los filtros
      window.location.href = url;
      
      
    });
  }
  


  
</script>


