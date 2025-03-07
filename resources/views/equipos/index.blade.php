@extends('layouts.app')



@section('content')
    <div class="grid grid-cols-4 gap-4 bg-gray-800 text-white rounded-lg w-[90%] md:w-[40%] mx-auto">
        <div class="col-span-1"></div>
        <div class="col-span-2">
          <h1 class="md:text-2xl font-bold text-center md:mb-4 md:mt-4 py-2">Sucursales y Departamentos</h1>
        </div>
        <div class="col-span-1 flex justify-end my-6 pr-4">
          {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarEquipo"><i class="bi bi-check2-square"></i>
            Agregar
        </button> --}}
        </div>
        
    </div>

    <div class="w-3/4 mx-auto md:hidden flex flex-col justify-around">
      <div class="flex md:mt-14 mt-4 w-full justify-between bg-black md:px-4 px-2 shadow-md">
        <h2 class="text-sm text-white text-left font-semibold mt-1">equipos en la sucursal: </h2>
      </div>
      <div class="flex mt-2 w-full justify-between bg-red-600 px-2 md:px-4 shadow-md">
        <h2 class="text-sm text-white text-left font-semibold mt-1">equipos con fallas: </h2>
      </div>
    </div>

    <div class="p-2 mt-8 md:p-6 rounded-lg  w-full">
        <div class="grid md:grid-cols-3 grid-cols-1 gap-4">
            @foreach ($sucursal as $item)
              @if($item->id != 1)
                @if($item->total_falla == 0)
                    <a href="{{route ('versucursal', $item->id)}}">
                        <div class="bg-white border-[1.5px] border-blue-300 rounded-lg  flex md:flex-col md:pb-4 md:pt-6 items-center md:justify-center justify-around md:max-h-[1000px] max-h-[120px]  shadow-md">
                            <h1 class="text-lg md:text-center font-semibold p-2 md:w-full w-[75%] md:min-h-[72px]">{{$item->nombre}}</h1>
                            <div class="flex flex-col items-end md:justify-around md:w-full pb-6 md:pb-0 md:block">
                              <div class="flex md:mt-14 mt-4 md:w-full rounded-md md:rounded-none justify-between bg-black px-2 md:px-0 shadow-md">
                                <h2 class="text-sm text-white text-left font-semibold mt-1 hidden md:block">equipos en la sucursal: </h2>
                                <h2 class="text-white text-lg font-semibold md:mt-0 ">{{$item->total_equipos}}</h2>
                              </div>
                              <div class="flex mt-4 md:mt-2 md:w-full rounded-md md:rounded-none justify-between bg-red-600 px-2 md:px-4 shadow-md">
                                <h2 class="text-sm text-white text-left font-semibold mt-1 hidden md:block">equipos con fallas en la sucursal: </h2>
                                <p class="text-white text-lg  font-semibold md:mt-0">{{$item->total_falla}}</p>
                              </div>
                            </div>
                        </div>
                    </a>
                @else
                  <a href="{{route ('versucursal', $item->id)}}">
                    <div class="bg-white border-[1.5px] border-red-500 rounded-lg  flex md:flex-col md:pb-4 md:pt-6  items-center md:justify-center justify-around md:max-h-[1000px] max-h-[120px] shadow-md">
                      <h1 class="text-lg font-semibold md:text-center p-2 md:w-full w-[75%] md:min-h-[72px]">{{$item->nombre}}</h1>
                      <div class="flex flex-col items-end md:justify-around md:w-full pb-6 md:pb-0 md:block">
                        <div class="flex md:mt-14 mt-4 md:w-full rounded-md md:rounded-none justify-between bg-black px-2 md:px-0 shadow-md">
                          <h2 class="text-sm text-white text-left font-semibold mt-1 hidden md:block">equipos en la sucursal: </h2>
                          <h2 class="text-white text-lg font-semibold md:mt-0">{{$item->total_equipos}}</h2>
                        </div>
                        <div class="flex mt-4 md:mt-2 md:w-full rounded-md md:rounded-none justify-between bg-red-600 px-2 md:px-4 shadow-md">
                          <h2 class="text-sm text-white text-left font-semibold mt-1 hidden md:block">equipos con fallas en la sucursal: </h2>
                          <p class="text-white text-lg  font-semibold md:mt-0">{{$item->total_falla}}</p>
                        </div>
                      </div>
                  </div>
                  </a>
                @endif
              @endif
            @endforeach
        </div>
        
    </div>
    <div class=" md:p-6 p-0 pt-4 md:pt-6 rounded-lg  w-full max-w-4xl m-auto">
        <a href="{{route ('equiposgeneral')}}">
            <div class="bg-white border border-black rounded-lg p-4 flex flex-col items-center justify-center">
                <h2 class="text-lg font-semibold">Ver todos los equipos</h2>
                <div class="flex mt-4 md:w-2/4 w-full m-auto justify-between bg-black px-4 shadow-md">
                  <p class="text-white text-left text-sm mt-1">Cantidad de equipos: </p>
                  <p class="text-white text-lg  font-semibold">{{$totalequipos}}</p>
                </div>
                <div class="flex mt-4 md:w-2/4 w-full m-auto justify-between bg-red-600 px-4 shadow-md">
                  <p class="text-white text-left text-sm mt-1">Equipos con fallas: </p>
                  <p class="text-white text-lg font-semibold">{{$totalfalla}}</p>
                </div>            
            </div>
        </a>  
    </div>


    <form id="frmEquipo" method="">
        <div class="modal fade" id="modalAgregarEquipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tipos de Equipos</h1>
                <button class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
      
                <div class="row">
      
      
                  <div class="col-sm-6">
                    <!--<label >Tipo de Equipo</label>-->
                    <label for="idCatEquipo"></label>
                  </div>
      
                </div>
      
                <div class="row">
      
                  <div class="col-sm-4">
                    <a href="{{ route('guardar', ['valor' => 1]) }}">Pc</a>
                  </div>
      
                  <div class="col-sm-4">
                    <a href="{{ route('guardar', ['valor' => 2]) }}">Laptops</a>
                  </div>
      
                  <div class="col-sm-4">
                    <a href="{{ route('guardar', ['valor' => 3]) }}">Impresoras</a>
                  </div>
      
                </div>
      
                <div class="row">
      
                  <div class="col-sm-4">
                    <a href="{{ route('guardar', ['valor' => 4]) }}">Monitores</a>
                  </div>
      
                  <div class="col-sm-4">
                    <a href="{{ route('guardar', ['valor' => 5]) }}">Mouses</a>
                  </div>
      
                  <div class="col-sm-4">
                    <a href="{{ route('guardar', ['valor' => 6]) }}">Teclados</a>
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
              <div class="modal-footer">
                <span type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</span>
                <button class="btn btn-primary btn-sm">Agregar</button>
              </div>
            </div>
          </div>
        </div>
    </form>
@endsection
