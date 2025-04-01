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

    @if (Auth::user()->roleid === 1 || Auth::user()->roleid===2)
      

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
                <a href="https://www.youtube.com/watch?v=XPg5txu_DkA" target="_blank" class="p-4 md:w-[55%] w-full">
                  <img src="https://img.youtube.com/vi/3_g2un5M350/hqdefault.jpg" class="rounded-lg mx-auto" alt="">
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

      <div id="" class=" rounded-md mt-8 justify-center align-middle text-center grid grid-cols-2">
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
          <div class="flex justify-between">
            <div class="w-[40%] ml-4">
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
                            backgroundColor: ['#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: '',
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
                            backgroundColor: ['#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position:'right',
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
                    "generado": "red",
                    "en revision": "green",
                    "solucionado": "blue",
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
                            },
                            title: {
                                display: true,
                                text: titulo,
                                font:{
                                  size:14,
                                  weight:'bold'
                                },
                                position: 'top',
                                padding:{
                                  right:100,
                                },
                                align:'center'
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
                            },
                            title: {
                                display: true,
                                text: titulo,
                                font:{
                                  size:14,
                                  weight:'bold'
                                },
                                position: 'top',
                                padding:{
                                  right:100,
                                },
                                align:'center'
                            }
                        }
                    }
                  });
                }
                
            });
    }
        

  </script>





@endsection
