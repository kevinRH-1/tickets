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
    <div>

      <div class="bg-white rounded-lg md:w-full w-[80%] mx-auto">
        <h1 class="text-xl font-semibold w-full text-center md:p-8 p-4 border-2 border-red-500 rounded-lg">{{$sucursal[0]->nombre}}</h1>
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
        <div class=" bg-white border-0 rounded-tr-lg shadow mb-5 pt-4">

          {{-- <div class="d-grid gap-2 d-md-flex justify-content-md-end  mr-10">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarEquipo"><i class="bi bi-check2-square"></i>
                Agregar</button>
          </div> --}}
            
            <div class="pt-4 md:!p-10 p-2" >
                <p class="lead">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    
                </div>
                <hr>
                <div id="tablaEquiposLoad" class="oculto">
                    <div class="overflow-x-auto">
                      <table class="table-auto w-full  border-gray-200  rounded-t-lg " id="tablaEquiposDataTable">
                        <thead class="bg-gray-800 text-white rounded-t-lg">
                    
                            <th class="text-center p-4 hidden md:table-cell rounded-tl-lg">Codigo</th>
                            <th class="text-center p-4 hidden md:table-cell">Departamento o sucursal</th>
                            <th class="text-center p-4 hidden md:table-cell">Nombre</th>
                            <th class="text-center p-4  md:hidden rounded-tl-lg">Datos</th>
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
                            @foreach($pcs as $item)
                            <tr class="odd:bg-white even:bg-gray-100 border-r-2 border-l-2 border-b-2 border-gray-200"> 
                                <td class="text-center p-4" hidden id="id">{{$item->id}}</td>
                                <td class="text-center p-4 hidden md:table-cell">{{$item->codigo}}</td>
                                <td class="text-center p-4 hidden md:table-cell">{{$item->lugar?->nombre?? 'sin sucursal'}}</td>
                                <td class="text-center p-4 hidden md:table-cell" nombre="nombre">{{$item->descripcion}}</td>
                                <td class="text-left p-1 pt-1  md:hidden" datos="datos"><h1 class="text-lg font-semibold">{{$item->descripcion}}</h1><p class="pt-2">{{$item->codigo}}</p><p class="pt-1">{{$item->estado->descripcion}}</p></td>
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
                          <th class="text-center p-4 hidden md:table-cell">Departamento o sucursal</th>
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
                          <tr class="odd:bg-white even:bg-gray-100 border-r-2 border-l-2 border-b-2 border-gray-200"> 
                              <td class="text-center p-4" hidden id="id">{{$item->id}}</td>
                              <td class="text-center p-4 hidden md:table-cell">{{$item->codigo}}</td>
                              <td class="text-center p-4 hidden md:table-cell">{{$item->lugar?->nombre?? 'sin sucursal'}}</td>
                              <td class="text-center p-4 hidden md:table-cell" nombre="nombre">{{$item->descripcion}}</td>
                              <td class="text-left p-1 pt-1  md:hidden" datos="datos"><h1 class="text-lg font-semibold">{{$item->descripcion}}</h1><p class="pt-2">{{$item->codigo}}</p><p class="pt-1">{{$item->estado->descripcion}}</p></td>
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


                {{-- TABLA DE MOUSE --}}

              


              {{-- TABLA DE MONITORES --}}

              


              {{-- TABLA DE IMPRESORAS --}}

              <div id="tablaimpresorasLoad" class="oculto">
                <div class="overflow-x-auto">
                  <table class="table-auto w-full  border-gray-200  rounded-t-lg " id="tablaEquiposDataTable">
                    <thead class="bg-gray-800 text-white rounded-t-lg">
                
                        <th class="text-center p-4 hidden md:table-cell rounded-tl-lg">Codigo</th>
                        <th class="text-center p-4 hidden md:table-cell">Departamento o sucursal</th>
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
                        <tr class="odd:bg-white even:bg-gray-100 border-r-2 border-l-2 border-b-2 border-gray-200"> 
                            <td class="text-center p-4" hidden id="id">{{$item->id}}</td>
                            <td class="text-center p-4 hidden md:table-cell">{{$item->codigo}}</td>
                            <td class="text-center p-4 hidden md:table-cell">{{$item->lugar?->nombre?? 'sin sucursal'}}</td>
                            <td class="text-center p-4 hidden md:table-cell" nombre="nombre">{{$item->descripcion}}</td>
                            <td class="text-left p-1 pt-1  md:hidden" datos="datos"><h1 class="text-lg font-semibold">{{$item->descripcion}}</h1><p class="pt-2">{{$item->codigo}}</p><p class="pt-1">{{$item->estado->descripcion}}</p></td>
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

                              
                    
                              {{-- <div class="row">
                                <div class="col-sm-12">
                                  <label for="descripcion">Descripcion</label>
                                  <textarea name="descripcion" id="descripcion" class="mt-1 block w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm" placeholder="Enter your first name" readonly></textarea>
                                </div>
                              </div> --}}
                              <input type="hidden" id="idEquipo" name="idEquipo">
                             
                    
                            </div>
                          </form>
                          <div class="row flex justify-around mb-3">
                            <button class="btn btn-warning btn-sm oculto w-1/4" id="anadirpc" name="anadir" data-type="pc">Asignar a sucursal</button>
                            <button class="btn btn-warning btn-sm oculto w-1/4" id="quitarpc" name="quitar" data-type="pc">Quitar de sucursal</button>
                            <button class="btn btn-primary btn-sm w-1/4" id="historial">historial</button>
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

  $(document).ready(function() {
    // Use event delegation for dynamic content
    $(document).on('click', '#btnConsulta', function() {
        // Find the closest <tr> to the clicked button and retrieve the id
        var id = $(this).closest('tr').find('td[id]').text();
        var type = $(this).closest('tr').find('td[categoria]').text();
        console.log(type);
        console.log(id);

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

                if(datos.lugar_id == null){
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

  $(document).ready(function() {
      var idToDelete = null; // Variable para almacenar el ID del usuario a eliminar

      // Mostrar el modal de confirmación al hacer clic en "Borrar"
      $(document).on('click', '#borrar', function(event) {

          // Almacena el ID del usuario
          idToDelete = $(this).closest('tr').find('td[id]').text();
          const nombre = $(this).closest('tr').find('td[nombre]').text();
          const categoria = $(this).closest('tr').find('td[categoria]').text();


          $('#confirmModal #bnombre').text(nombre);
          $('#confirmModal #bcategoria').text(categoria);
          // Muestra el modal
          $('#confirmModal').modal('show');
      });

      // Acción al confirmar "Sí, eliminar"
      $(document).on('click', '#confirmYes2', function() {
          console.log(idToDelete)
          if (idToDelete) {
              $.ajax({
                  url: 'equipo/eliminar/'+idToDelete +'/'+categoria,
                  type: 'DELETE',
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                  },
                  success: function(response) {
                    $('#confirmModal').modal('hide')
                    $('#mensaje').text('Equipo borrado con exito!');
                    $('#modalmensaje').modal('show');
                    setTimeout(() => {}, 3000);
                    location.reload();
                  },
                  error: function(xhr) {
                      alert('Error al borrar el usuario. Intente nuevamente.');
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
      //console.log(type);

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
          setTimeout(() => {}, 2000);
          location.reload();
          
        },
        error: function(xhr) {
          // Manejar errores (opcional)
          alert('Error al asignar sucursal');
        }

      })
    })
  })

  

  

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
          url:'/quitar/'+id+'/'+type,
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
            url: '/actualizar/' +formData.id+'/'+formData.categoria, // Ruta en Laravel que procesa la actualización
            type: 'POST',
            data: formData,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
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
              $('#confirmar').modal('hide');
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
</script>
