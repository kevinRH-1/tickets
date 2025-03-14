@extends('layouts.app')


@section('content')
  <div class="container-fluid">

    <div class="bg-white w-full grid grid-cols-3 gap-4 rounded-lg p-1 border-1 border-red-600">
      <div>
        <img src="../resources/imagen/LOGO.png" alt="Logo" class=" hidden lg:block lg:w-[250px] lg:h-[80px] w-[50px] h-[40px] ">
      </div>
      <div class="lg:col-span-1 col-span-3">
        <h1 class="md:mt-5 text-center text-4xl font-semibold">Dashboard</h1>
      </div>
      <div class="">

      </div>
    </div>

    @if (Auth::user()->roleid === 1 || Auth::user()->roleid===2)
      <div class="md:flex md:justify-between mt-5 text-white grid grid-cols-2">
        <div class="md:w-60 md:h-36 bg-emerald-500 md:rounded-lg p-4">
          <h1>Ticktes ultimas 24h: {{ $cantidaddia }}</h1>
        </div>
        <div class="md:w-60 md:h-36 bg-purple-700 md:rounded-lg p-4">
          <h1>Tickets ultimo mes: {{ $cantidadmes }}</h1>
        </div>
        <div class="md:w-60 md:h-36 bg-amber-500 md:rounded-lg p-4">
          <h1>Tickets sin revisar: {{ $cantidadsinrevisar }}</h1>
        </div>
        <div class="md:w-60 md:h-36 bg-sky-600 md:rounded-lg p-4">
          <h1>Mis Tickets: {{ $cantidadtecnico }}</h1>
        </div>
      </div>
      <div class="grid grid-cols-7 mt-2">
        <div class="card border-0 shadow mt-5 mb-2 md:col-span-4 col-span-7">
          <div class="card-body px-5 py-4">
            <center>

              <p class="lead">
              <h1 class="font-semibold text-lg">Datos del Usuario</h1>
              <hr class="mt-3 mb-4" style="color: red" />
              <div class="row flex justify-around">
                <div class="col-sm-4">Correo: {{ Auth::user()->email }}</div>
                <div class="col-sm-4">Departamento o sucursal: {{ Auth::user()->sucursal?->nombre ?? 'sin sucursal' }}</b> </div>

              </div>
              <br>

              <div class="row flex justify-around">

                <div class="col-sm-4">Nombre: {{ Auth::user()->descripcion }}</div>
                {{-- <div class="col-sm-4">Teléfono:{{Auth::user()->number}}</div> --}}

                <div class="col-sm-4">Rol de Usuario: {{ Auth::user()->rol->nombre }}</div>
              </div>
              <br>

              <div class="row flex justify-around">
                <div class="col-sm-4">
                  {{-- Apellido: {{ Auth::user()->lastname }} --}}
                </div>
                <div class="col-sm-4">

                </div>
              </div>
              <br>
              <br>
              <hr style="color: red" />

            </center>
            <br>


            <div style="text-align:right;">
              <b>
                <?php echo date('d/m/Y'); ?>
              </b>
              <p><span id="reloj"></span></p>
            </div>

            <script>
              function startTime() {
                var today = new Date();
                var h = today.getHours();
                var m = today.getMinutes();
                var s = today.getSeconds();
                m = checkTime(m);
                s = checkTime(s);
                document.getElementById('reloj').innerHTML = h + ":" + m + ":" + s;
                var t = setTimeout(startTime, 500);
              }

              function checkTime(i) {
                if (i < 10) {
                  i = "0" + i;
                }
                return i;
              }

              window.onload = function() {
                startTime();
              };
            </script>
            </p>
          </div>
        </div>
        <div></div>
        <div class="md:col-span-2 col-span-7 col-end-8 mt-5 mb-2 rounded-lg p-4 bg-white">
          <h1 class="text-center ">Ver Reportes</h1>
          <hr class="mt-3" style="color: red">
          <div class="text-center mt-4 ">
            <a href=""><button class="my-2 w-3/4 btn btn-danger">mis tickets tickets de sistemas del dia</button></a>
            
            <button class="my-2 w-3/4 btn btn-danger">mis tickets tickets de sistemas del mes</button>
            <button class="my-2 w-3/4 btn btn-danger">mis tickets tickets de hardware del mes</button>
            <button class="my-2 w-3/4 btn btn-danger">tickets tickets de sistemas del dia</button>
            <button class="my-2 w-3/4 btn btn-danger">tickets tickets de sistemas del mes</button>
          </div>
        </div>
      </div>
    @endif
    @if (Auth::user()->roleid === 3)
      <div class="md:flex md:justify-between mt-5 text-white grid grid-cols-2">
        <div class="md:w-60 md:h-36 bg-emerald-500 md:rounded-lg p-4">
          <h1>Mis Tickets en progreso: {{ $ticketprogreso }}</h1>
        </div>
        <div class="md:w-60 md:h-36 bg-purple-700 md:rounded-lg p-4">
          <h1>Mis Tickets totales: {{ $usuariototal }}</h1>
        </div>
        <div class="md:w-60 md:h-36 bg-amber-500 md:rounded-lg p-4">
          <h1>Mis Equipos: {{ $equipostotales }}</h1>
        </div>
        <div class="md:w-60 md:h-36 bg-sky-600 md:rounded-lg p-4">
          <h1>Mis equipos con Fallas: {{ $cantidadFiltrados }}</h1>
        </div>
      </div>


      <div class="card border-0 shadow mt-5 mb-2 col-span-4">
        <div class="card-body px-5 py-4">
          <center>

            <p class="lead">
            <h1 class="">Datos del Usuario</h1>
            <hr class="mt-3 mb-4" style="color: red" />
            <div class="row flex justify-around">
              <div class="col-sm-4">Correo: {{ Auth::user()->email }}</div>
              <div class="col-sm-4">Departamento: {{ Auth::user()->sucursal?->nombre ?? 'sin sucursal' }}</b> </div>

            </div>
            <br>

            <div class="row flex justify-around">

              <div class="col-sm-4">Nombre: {{ Auth::user()->descripcion }}</div>
              {{-- <div class="col-sm-4">Teléfono:{{Auth::user()->number}}</div> --}}

              <div class="col-sm-4">Rol de Usuario: {{ Auth::user()->rol->nombre }}</div>
            </div>
            <br>

            <div class="row flex justify-around">
              <div class="col-sm-4">
                {{-- Apellido: {{ Auth::user()->lastname }} --}}
              </div>
              <div class="col-sm-4">

              </div>
            </div>
            <br>
            <br>
            <hr style="color: red" />

          </center>
          <br>


          <div style="text-align:right;">
            <b>
              <?php echo date('d/m/Y'); ?>
            </b>
            <p><span id="reloj"></span></p>
          </div>

          <script>
            function startTime() {
              var today = new Date();
              var h = today.getHours();
              var m = today.getMinutes();
              var s = today.getSeconds();
              m = checkTime(m);
              s = checkTime(s);
              document.getElementById('reloj').innerHTML = h + ":" + m + ":" + s;
              var t = setTimeout(startTime, 500);
            }

            function checkTime(i) {
              if (i < 10) {
                i = "0" + i;
              }
              return i;
            }

            window.onload = function() {
              startTime();
            };
          </script>
          </p>
        </div>
      </div>
    @endif
  </div>
@endsection
