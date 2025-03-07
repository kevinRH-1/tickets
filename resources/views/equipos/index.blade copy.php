<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarEquipo"><i class="bi bi-check2-square"></i>
            Agregar</button>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl">
        <h1 class="text-2xl font-bold text-center mb-4">Cuadro Principal</h1>
        <div class="grid grid-cols-2 gap-4">
            @foreach ($sucursal as $item)
                <a href="{{route ('versucursal', $item->id)}}">
                    <div class="bg-blue-100 border border-blue-300 rounded-lg p-4 flex flex-col items-center justify-center">
                        <h2 class="text-lg font-semibold">{{$item->nombre}}</h2>
                        <p class="text-gray-600 text-sm">Texto secundario 1</p>
                        <p class="text-gray-600 text-sm">{{$item->id}}</p>
                    </div>
                </a>
            @endforeach
        </div>
        
    </div>
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl">
        <a href="{{route ('equiposgeneral', $item->id)}}">
            <div class="bg-blue-100 border border-blue-300 rounded-lg p-4 flex flex-col items-center justify-center">
                <h2 class="text-lg font-semibold">{{$item->nombre}}</h2>
                <p class="text-gray-600 text-sm">Texto secundario 1</p>
                <p class="text-gray-600 text-sm">{{$item->id}}</p>
            </div>
        </a>  
    </div>


    <form id="frmEquipo" method="POST" onsubmit="return agregarEquipo();">
        <div class="modal fade" id="modalAgregarEquipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Equipos</h1>
                <button class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
      
                <div class="row">
      
      
                  <div class="col-sm-6">
                    <!--<label >Tipo de Equipo</label>-->
                    <label for="idCatEquipo">Tipo de Equipo</label>
                    {{-- <?php
      
                          echo $html->select(
                              [
                                  'name' => 'idCatEquipo', 
                                  'id' => 'idCatEquipo', 
                                  'class' => 'form-select', 
                                  'attributes' => ["required" => "requierd"], 
                                  'elements' => $categoriasList
                              ]
                          );
      
                    ?> --}}
                  </div>
      
                </div>
      
                <div class="row">
      
                  <div class="col-sm-4">
                    <label for="marca">Marca</label>
                    <input type="text" class="form-control" id="marca" name="marca" required>
                  </div>
      
                  <div class="col-sm-4">
                    <label for="modelo">Modelo</label>
                    <input type="text" class="form-control" id="modelo" name="modelo" required>
                  </div>
      
                  <div class="col-sm-4">
                    <label for="codigo">Serial</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" required>
                  </div>
      
                </div>
      
                <div class="row">
      
                  <div class="col-sm-4">
                    <label for="procesador">Procesador</label>
                    <input type="text" class="form-control" id="procesador" name="procesador" required>
                  </div>
      
                  <div class="col-sm-4">
                    <label for="ram">Ram</label>
                    <input type="text" class="form-control" id="ram" name="ram" required>
                  </div>
      
                  <div class="col-sm-4">
                    <label for="HDD">Disco Duro</label>
                    <input type="text" class="form-control" id="HDD" name="HDD" required>
                  </div>
      
                </div>
      
                <div class="row">
                  <div class="col-sm-12">
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                  </div>
                </div>
      
                <div id="equipo-details" style="margin-top: 20px;">
                  <!-- Aquí se cargarán los campos adicionales -->
                </div>
      
              </div>
              <div class="modal-footer">
                <span type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</span>
                <button class="btn btn-primary btn-sm">Agregar</button>
              </div>
            </div>
          </div>
        </div>
    </form>
</x-app-layout>
