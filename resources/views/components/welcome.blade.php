@extends('layouts.app')




@section('content')

<head>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
  <div class="container-fluid">

    <div class="bg-white w-full grid grid-cols-3 gap-4 rounded-lg p-1 border-1 border-red-600">
      <div>
        <img src="../resources/imagen/Logo.png" alt="Logo" class=" hidden lg:block lg:w-[250px] lg:h-[80px] w-[50px] h-[40px] ">
      </div>
      <div class="lg:col-span-1 col-span-3">
        <h1 class="md:mt-5 text-center text-4xl font-semibold">DASHBOARD</h1>
      </div>
      <div class="">

      </div>
    </div>

    @if (Auth::user()->roleid === 1 || Auth::user()->roleid===3)
      

      @if ($videos->isEmpty())

      @else
        {{-- <div id="anuncio" class="bg-white rounded-md mt-8 justify-center align-middle text-center">
          <div class="">titulo</div>
          <div class="">
            <a href="https://www.youtube.com/watch?v=XPg5txu_DkA" target="_blank">
              <img src="https://img.youtube.com/vi/3_g2un5M350/hqdefault.jpg" alt="">
            </a>
          </div>
        </div> --}}

        <div class="relative w-full md:max-w-[70%] mx-auto overflow-hidden rounded-lg bg-gray-800 shadow-lg mt-4 border-gray-800 border-2">
          <h1 class="text-center p-2 text-2xl font-semibold text-white">VIDEOS IMPORTANTES</h1>
          <div id="carousel" class="w-full flex transition-transform duration-500">
            @foreach ($videos as $imagen)
              <div class="min-w-full flex flex-col md:flex-row bg-gray-100">
                <a href="{{$imagen->link}}" target="_blank" class="p-4 md:w-[55%] w-full">
                  <img src="https://img.youtube.com/vi/{{$imagen->codigo}}/hqdefault.jpg" class="rounded-lg mx-auto" alt="">
                </a>
                
                <div class="md:w-[40%] w-full md:!p-4 p-1 text-center">
                  <h1 class="md:!mt-4 text-xl font-semibold">{{$imagen->nombre}}</h1>
                  <p class="text-base">{{$imagen->descripcion}}</p>
                </div>
              </div>
            @endforeach
          </div>
          
          <button onclick="anterior()" class="absolute top-1/2 left-0 -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">
            &#10094;
          </button>
          <button onclick="siguiente()" class="absolute top-1/2 right-0 -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full">
            &#10095;
          </button>
        </div>

      @endif

      <div class="md:flex md:justify-between mt-5 text-white grid grid-cols-2">
        <a href="{{route('reportessoftware.general')}}">
          <div class="md:w-60 md:h-36 bg-emerald-500 md:rounded-lg p-4">
            <h1 class="text-lg font-semibold">Ticktes de sistemas en 24H: {{ $cantidaddia }}</h1>
            <div class="w-full relative hidden md:block">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-20 absolute top-[-20px] right-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>
            </div>
          
          </div>
        </a>
        <a href="{{route('reportessoftware.general')}}">
          <div class="md:w-60 md:h-36 bg-purple-700 md:rounded-lg p-4">
            
            <h1 class="text-lg font-semibold">Tickets de sistema en la semana: {{ $cantidadmes }}</h1>
            <div class="relative w-full hidden md:block">  
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-20 absolute top-[-20px] right-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
              </svg>
            </div>
            
          </div>
        </a>
        <a href="{{route('reportessoftware.general')}}">
          <div class="md:w-60 md:h-36 bg-amber-500 md:rounded-lg p-4">
            
            <h1 class="text-lg font-semibold">Tickets en estado generado: {{ $cantidadsinrevisar }}</h1>
            <div class="relative w-full hidden md:block">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-20 absolute top-[-14px] right-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
              </svg>
            </div>
          
          </div>
        </a>
        <a href="{{route('reportessoftware.general')}}">
          <div class="md:w-60 md:h-36 bg-sky-600 md:rounded-lg p-4 min-h-[132px] ">
            <h1 class="text-lg font-semibold">Tickets en proceso: {{ $cantidadrevision }}</h1>
            <div class="relative w-full hidden md:block">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-20 absolute top-2 right-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="yellow" class="size-12 absolute top-1 right-14">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              </svg>

            </div>
          </div>
        </a>
      </div>

      <div id="" class="hidden md:!grid rounded-md mt-8 justify-center align-middle text-center grid-cols-2">
        <div class="col-span-2 bg-white rounded-lg border-2 border-black">
          <h1 class="mt-8 font-semibold text-xl">TICKETS DE SISTEMAS:</h1>
          <div class="mt-4 mb-4 ml-4 w-1/4">
            <select name="tiempo" id="tiempo" class="w-full border-gray-300 rounded-lg shadow p-2 focus:ring focus:ring-teal-300" onchange="cargargraficas()">
              <option value="0">Todos</option>
              <option value="1">Dia</option>
              <option value="2">Semana</option>
              <option value="3">Mes</option>
            </select>
          </div>
          <div class="flex justify-around">
            <div class="w-[40%]">
              {{-- <h2>Gráfico de Pastel Dinámico</h2> --}}
              <canvas id="graficosucursal" width="50" height="50"></canvas>
            </div>
            <div class="w-[40%]">
              {{-- <h2>Gráfico de Pastel Dinámico</h2> --}}
              <canvas id="graficoestado" width="50" height="50"></canvas>
            </div>
          </div>
        </div>
          
          
        
      </div>

      

      <div class="grid grid-cols-7 mt-2">
        <div class="card border-0 shadow mt-5 mb-2 md:col-span-4 col-span-7">
          <div class="card-body px-5 py-4">
            <center>

              <p class="lead">
              <h1 class="font-semibold text-lg">Datos del usuario</h1>
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
            {{-- <a href=""><button class="my-2 w-3/4 btn btn-danger">mis tickets tickets de sistemas del dia</button></a> --}}
            
            {{-- <button class="my-2 w-3/4 btn btn-danger">mis tickets tickets de sistemas del mes</button>
            <button class="my-2 w-3/4 btn btn-danger">mis tickets tickets de hardware del mes</button>
            <button class="my-2 w-3/4 btn btn-danger">tickets tickets de sistemas del dia</button>
            <button class="my-2 w-3/4 btn btn-danger">tickets tickets de sistemas del mes</button> --}}
          </div>
        </div>
      </div>
    @endif
    @if (Auth::user()->roleid === 3)
      <div class="md:flex md:justify-between mt-5 text-white grid grid-cols-2">
        <a href="{{route ('misreportessoftware', [Auth::user()->id])}}">
          <div class="md:w-60 md:h-36 bg-emerald-500 md:rounded-lg p-4">
            <h1 class="text-lg font-semibold relative z-10">Mis Tickets en progreso: {{ $progresousuariototal }}</h1>
            <div class="relative w-full hidden md:block">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-20 absolute top-[-10px] right-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="yellow" class="size-12 absolute top-[-10px] right-14">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              </svg>
            </div>
          </div>
        </a>
        <a href="{{route ('misreportessoftware', [Auth::user()->id])}}">
          <div class="md:w-60 md:h-36 bg-purple-700 md:rounded-lg p-4">
            <h1 class="text-lg font-semibold relative z-10">Mis Tickets totales: {{ $usuariototal }}</h1>
            <div class="relative w-full hidden md:block">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-20 absolute top-4 right-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
              </svg>
            </div>
          </div>
        </a>
        <a href="{{route('misequipos', ['id' => Auth::user()->sucursal])}}">
          <div class="md:w-60 md:h-36 bg-amber-500 md:rounded-lg p-4">
            <h1 class="text-lg font-semibold relative z-10">Mis Equipos: {{ $equipostotales }}</h1>
            <div class="relative w-full hidden md:block">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-20 absolute top-4 right-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
              </svg>            
            </div>
          </div>
        </a>
        <a href="{{route('misequipos', ['id' => Auth::user()->sucursal])}}">
          <div class="md:w-60 md:h-36 bg-sky-600 md:rounded-lg p-4">
            <h1 class="text-lg font-semibold relative z-10">Mis equipos con Fallas: {{ $cantidadFiltrados }}</h1>
            <div class="relative w-full hidden md:block">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-20 absolute top-[-14px] right-0">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9 absolute top-0 right-[22px]">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
              </svg>
            </div>
          </div>
        </a>
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
  
  <script>
    let currentIndex = 0;

    function mostrarImagen(index) {
        const carousel = document.getElementById("carousel");
        const total = carousel.children.length;
        if (index < 0) currentIndex = total - 1;
        else if (index >= total) currentIndex = 0;
        else currentIndex = index;
        carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    function siguiente() {
        mostrarImagen(currentIndex + 1);
    }

    function anterior() {
        mostrarImagen(currentIndex - 1);
    }

    document.addEventListener('DOMContentLoaded', function () {
      cargargrafica1();
      cargargrafica2();
    });

    function cargargraficas(){
      
      Chart.getChart("graficoestado").destroy();
      Chart.getChart("graficosucursal").destroy();
      cargargrafica1();
      cargargrafica2();
    }

    function cargargrafica1(){

      const tiempo = $('#tiempo').val();

      if(tiempo==0){
        titulo = 'Cantidad de Sucursal por Estados'
      }else if(tiempo==1){
        titulo = 'Reportes por Sucursal del Dia'
      }else if(tiempo==2){
        titulo = 'Reportes por Sucursal de la Semana'
      }else{
        titulo = 'Reportes por Sucursal del Mes'
      }

      var pantalla =  window.innerWidth < 700;
        fetch('/reportes-por-sucursal/'+ tiempo)
            .then(response => response.json())
            .then(data => {
                const labels = Object.keys(data);
                const counts = Object.values(data);
                console.log(data);

                const ctx = document.getElementById('graficosucursal').getContext('2d');
                if(pantalla){
                  new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: counts,
                            backgroundColor: ['#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF7006', '#FF0606'],
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: '',
                                labels: {
                                  boxWidth: 20,
                                  padding: 10,
                                  // Puedes usar esta función para acortar nombres si son muy largos
                                  generateLabels: function(chart) {
                                    const original = Chart.overrides.doughnut.plugins.legend.labels.generateLabels(chart);
                                    return original.map(label => ({
                                      ...label,
                                      text: label.text.length > 20 ? label.text.slice(0, 20) + '...' : label.text
                                    }));
                                  }
                                },
                            },
                            title: {
                                display: true,
                                text: titulo,
                                font:{
                                  size:14,
                                  weight:'bold'
                                },
                                
                            }
                        }
                    }
                  });
                }else{
                  new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: counts,
                            backgroundColor: ['#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF7006', '#FF0606'],
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position:'right',
                                labels: {
                                  boxWidth: 20,
                                  padding: 10,
                                  // Puedes usar esta función para acortar nombres si son muy largos
                                  generateLabels: function(chart) {
                                    const original = Chart.overrides.doughnut.plugins.legend.labels.generateLabels(chart);
                                    return original.map(label => ({
                                      ...label,
                                      text: label.text.length > 20 ? label.text.slice(0, 20) + '...' : label.text
                                    }));
                                  }
                                },
                                
                            },
                            title: {
                                display: true,
                                text: titulo,
                                font:{
                                  size:14,
                                  weight:'bold'
                                },
                            }
                        }
                    }
                  });
                }
                
            });
    }

    function cargargrafica2(){
      var pantalla =  window.innerWidth < 700;
      let titulo;
      const tiempo = $('#tiempo').val();
      if(tiempo==0){
        titulo = 'Cantidad de Reportes por Estados'
      }else if(tiempo==1){
        titulo = 'Reportes por Estados del Dia'
      }else if(tiempo==2){
        titulo = 'Reportes por Estados de la Semana'
      }else{
        titulo = 'Reportes por Estados del Mes'
      }
        fetch('/reportes-por-estado/'+tiempo)
            .then(response => response.json())
            .then(data => {
                const labels = Object.keys(data);
                const counts = Object.values(data);
                console.log(data);

                const colors = {
                    "Generado": "red",
                    "Revision": "green",
                    "Solucionado": "blue",
                    "Espera de mas informacion": "gray",
                    "Por Confirmar Solucion": "purple",
                };

                // Mapear los colores según el nombre de la sucursal
                const backgroundColors = labels.map(label => colors[label] || '#CCCCCC');

                const ctx = document.getElementById('graficoestado').getContext('2d');
                if(pantalla){
                  new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: counts,
                            backgroundColor:backgroundColors,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: '',
                                labels: {
                                  boxWidth: 80,
                                  padding: 10,
                                  // Puedes usar esta función para acortar nombres si son muy largos
                                  generateLabels: function(chart) {
                                    const original = Chart.overrides.doughnut.plugins.legend.labels.generateLabels(chart);
                                    return original.map(label => ({
                                      ...label,
                                      text: label.text.length > 20 ? label.text.slice(0, 20) + '...' : label.text
                                    }));
                                  }
                                },
                            },
                            title: {
                                display: true,
                                text: titulo,
                                font:{
                                  size:14,
                                  weight:'bold'
                                },
                            }
                        }
                    }
                  });
                }else{
                  new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: counts,
                            backgroundColor:backgroundColors,
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: {
                                  boxWidth: 80,
                                  padding: 10,
                                  // Puedes usar esta función para acortar nombres si son muy largos
                                  generateLabels: function(chart) {
                                    const original = Chart.overrides.doughnut.plugins.legend.labels.generateLabels(chart);
                                    return original.map(label => ({
                                      ...label,
                                      text: label.text.length > 20 ? label.text.slice(0, 20) + '...' : label.text
                                    }));
                                  }
                                }
                            },
                            title: {
                                display: true,
                                text: titulo,
                                font:{
                                  size:14,
                                  weight:'bold'
                                },
                            }
                        }
                    }
                  });
                }
                
            });
    }
        

  </script>





@endsection
