{{-- @props(['style' => session('flash.bannerStyle', 'success'), 'message' => session('flash.banner')]) --}}

<nav class="navbar navbar-expand-sm bg-body-transparent bg-black" >
    <div class="container-fluid">
    <a style="color:red" class="navbar-brand" href="#">
        <img src="../resources/imagen/DobermaN.png" alt="Logo" width="40px" style="margin-right: 10px;">
        <b>STI-CVC</b>
    </a>
        <button style="color:rgb(255, 0, 0)" class="navbar-toggler boton-colapso-rojo" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon icono-rojo"></span>
        </button>
        <div class="navbar-nav mr-20" id="navbarTogglerDemo02">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0" >
                <li class="nav-item ml-80" >
                    <a style="color:white" class="nav-link" href="{{route ('inicio')}}"><i class="bi bi-house"></i> Inicio</a>

                    @if(Auth::user()->roleid === 1)
                        <!--administrador-->
                        <li class="nav-item">
                            <a style="color:white" class="nav-link active" aria-current="page" href="{{route ('usuario.index')}}"><i
                                    class="bi bi-person-fill"></i> Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a style="color:white" class="nav-link active" aria-current="page" href="{{route ('equipo.index')}}"><i
                                    class="bi bi-motherboard"></i> Asignación de equipos</a>
                        </li>
                        
                    
                        
                        {{-- @if(Auth::user()->roleid===2)
                            <button class="btn btn-transparent dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false" style="color:white"><i class="bi bi-tools"></i>
                                Mis Reportes
                            </button>
                            <ul class="dropdown-menu">
                                    <form id="frmBackup" action="" method="post" >
                                        <button type="submit" class="btn btn-light" name="backup">HARDWARE</button>
                                    </form>
                                    <form id="frmRestore" method="post">
                                        <button type="button" class="btn btn-light" data-bs-toggle="modal">
                                            SOFTWARE
                                        </button>
                                    </form>
                                    <a aria-current="page" href="equipos.php" class="btn btn-light">Inventario</a>
                                @endif
                            </ul>
                        @endif --}}
                        <li class="nav-item">
                            <a style="color:white" class="nav-link active" aria-current="page" href="bitacora.php"><i
                                    class="bi bi-collection"></i></i> Bitácora</a>
                        </li>
                        <div class="dropdown">
                        <button class="btn btn-transparent dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" style="color:white"><i class="bi bi-tools"></i>
                            Mantenimiento
                        </button>
                        <ul class="dropdown-menu">
                            @if(Auth::user()->roleid === 1)
                                <form id="frmBackup" action="" method="post" onSubmit="return backupDatabase();">
                                    <button type="submit" class="btn btn-light" name="backup">Realizar Respaldo</button>
                                </form>
                                <form id="frmRestore" method="post">
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modalRestaurar">
                                        Restaurar Respaldo
                                    </button>
                                </form>
                                <a aria-current="page" href="equipos.php" class="btn btn-light">Inventario</a>
                            @endif
                        {{-- <div class="relative">
                            <button id="dropdownButton" class="px-4 py-2 text-white bg-transparent roundedS">
                                Mantenimiento
                            </button>
                            <div id="dropdownMenu" class="absolute left-0 mt-2 w-48 bg-white border border-black z-10 rounded shadow-lg hidden">
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Realizar respaldo</a>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Restaurar respaldo</a>
                                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Inventario</a>
                            </div>
                        </div> --}}
                    @endif
                        
                </li>
                        
            </ul>
            @if(Auth::user()->roleid===2)

                <li>
                    <div>
                        <a href="{{route('misequipos', ['id' => Auth::user()->sucursal])}}">
                            <button class="btn btn-transparent" type="button" style="color:white"><i class="bi bi-tools"></i>
                                Mis Equipos
                            </button>
                        </a>
                    </div>
                </li>
            @endif
        <li>
            <div class="dropdown">
                <button class="btn btn-transparent dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" style="color:white"><i class="bi bi-tools"></i>
                        Reportes
                </button>
                <ul class="dropdown-menu">
                    @if(Auth::user()->roleid === 1)
                            <li><a aria-current="page" href="{{route('reportessoftware.general')}}" class="btn btn-light">SOFTWARE</a></li>
                            <li><a aria-current="page" href="{{route ('reportes.general')}}" class="btn btn-light">HARDWARE</a></li>
                    @endif
                    @if(Auth::user()->roleid === 2)
                            <li><a aria-current="page" href="{{route ('misreportessoftware', [Auth::user()->sucursal])}}" class="btn btn-light">SOFTWARE2</a></li>
                            <li><a aria-current="page" href="{{ route('misreportes', ['id' => Auth::user()->sucursal]) }}" class="btn btn-light">HARDWARE2</a></li>
                    @endif
                    @if(Auth::user()->roleid === 3)
                            <li><a aria-current="page" href="equipos.php" class="btn btn-light">SOFTWARE3</a></li>
                            <li><a aria-current="page" href="equipos.php" class="btn btn-light">HARDWARE3</a></li>
                    @endif
                </ul>
            </div>
        </li>
        </div>
            <div class="dropdown">
                <button class="btn btn-transparent dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false" style="color:white"><i class="bi bi-person-raised-hand"></i>
                    Ayuda
                </button>
                <ul class="dropdown-menu"> 
                    @if(Auth::user()->roleid===1)
                        <li><a class="dropdown-item" href="{{route ('manual.administrador')}}"><i class="bi bi-universal-access-circle"></i> Manual  de Administrador</a></li>
                    @endif
                    <li ><a class="dropdown-item" href="{{route ('manual.usuario')}}"><i class="bi bi-universal-access"></i>
                        Manual de Usuario
                    </a></li>
                </ul>
            </div>
            @if(Auth::user()->roleid===1)
                <div>
                    <button class="btn btn-transparent dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" style="color:white"><i class="bi bi-person-raised-hand"></i></button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route ('sucursal.index')}}"><i class="bi bi-universal-access-circle"></i> anadir sucursal</a></li>
                        <li><a class="dropdown-item" href="{{route ('categorias.index')}}"><i class="bi bi-universal-access-circle"></i> anadir categorias</a></li>
                        <li><a class="dropdown-item" href="{{route ('sistemas.index')}}"><i class="bi bi-universal-access-circle"></i>Sistemas</a></li>
                    </ul>
                </div>
            @endif
            <ul class="navbar-nav ms-auto mb-2 mb-sm-0">
                <li class="nav-item">
                <li class="nav-item dropdown">
                    <a style="color: yellow" class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"> Usuario: </i>
                        <p>{{Auth::user()->name}}</p>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a style="color:black" class="dropdown-item" href="{{route ('usuarios.datos', [Auth::user()->id])}}" 
                                >Actualizar Datos
                            </a>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    Cerrar sesión
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            @if(Auth::user()->roleid == 2)
                <ul>
                    <li>
                        <a href="{{route ('reportes.create', Auth::user()->sucursal)}}"><button>a</button></a>
                        
                    </li>
                </ul>
            @endif
            <ul>
                <li>
                    <a href="{{route ('vista.prueba')}}"><button>prueba</button></a>
                </li>
            </ul>
            
        </div>
    </div>
</nav>

{{-- <?php

// include "Home/modalActualizarDatosPersonales.php";
// include "../vistas/mantenimiento/modal-restaurar.php";
// include "../clases/Conexion.php";
// ?> --}}
{{-- // <script src="../public/Js/mantenimiento/backup-database.js"></script> --}}
{{-- // <script src="../public/Js/mantenimiento/restore-database.js"></script> --}}
 <script>
    document.querySelectorAll('.nav-item:not(:has(.dropdown-menu))').forEach(item => {
    item.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelectorAll('.nav-item').forEach(item => item.classList.remove('border-active'));
        this.classList.add('border-active');
        // Redirige a la página deseada después de agregar el borde
        window.location.href = this.querySelector('a').getAttribute('href');
        });
    });
</script>


