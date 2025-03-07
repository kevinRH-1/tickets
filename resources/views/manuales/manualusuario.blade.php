@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">

                
        <center> <h1>Bienvenido a Manual de Usuario </h1></center>
            <hr style="color: red"/>
            <br>
            <center><b>Pantalla de Inicio de sesion</b></center>
            <br>
            <br>
            <center><img src="../resources/imagen/Manual/pantallaInicio.jpg" alt="Inicio" class="img-fluid"></center>
            <br>
            <br>
            <center><b>Pantalla de Inicio</b></center>
            <br>
            <center><img src="../resources/imagen/Manual/Inicio.jpg" alt="Inicio" class="img-fluid"></center>
            <br>           
            
            <p>Como podemos observar en el esquema, se muestran los datos del usuario que ha iniciado sesión en nuestro sistema,
                así como las funcionalidades a las que tiene acceso. Algunas de las opciones disponibles son:
            <br>
            <b>* Inicio.</b>
            <br>
            <b>* Mis Dispositivos.</b>
            <br>
            <b>* Gestion de Fallas.</b>
            <br>
            <b>* Ayuda.</b>
            <br>
            <b> * Nombre de Usuario(Dropdown).</b>
            </p>
            <hr style="color: red"/>
            <br>
                <center><b>Pantalla de Mis Dispositivos</b></center>
                <br>
                <center><img src="../resources/imagen/Manual/dispositivos.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <p>En la parte inferior de la pantalla, se presentan las características y capacidades de los equipos asignados, organizadas en una serie de tarjetas o secciones. 
                    Estas tarjetas incluyen detalles como la cantidad de RAM, el tipo de disco duro, la velocidad del procesador, entre otros.</p>
                <br>
                <hr style="color: red"/>
                <br>
                <center><b>Pantalla de Gestion de Fallas</b></center>
                <br>
                <center><img src="../resources/imagen/Manual/Gestion.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <p>En nuestra pantalla de gestión de fallas, podemos identificar varios componentes clave:
                    <br>
                    <br>
                    <b>* Indicadores de tickets abiertos, cerrados y el total de tickets realizados:</b> Nos permiten visualizar el estado actual de la gestión de fallas en el sistema.
                    <br>
                    <center><img src="../resources/imagen/Manual/indicadores.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <hr style="color: red"/>
                    <br>
                    <b>* Botón de crear nuevo reporte:</b> Nos permite crear reportes para informar sobre las fallas detectadas, al dar clic en el botón nos abrirá una ventana modal que nos permitirá indicar el asunto, seleccionar el equipo asignado que presenta la falla y la descripción completa de la falla como se muestra a continuación:
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual/NuevoReporte.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <b>* Funciones de impresión:</b> Excel, PDF e imprimir directamente los reportes.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual/ImprimirNuevoReporte.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <hr style="color: red"/>
                    <br>
                    <br>
                    <b>* Indicador de registros y búsqueda rápida:</b> Permiten personalizar la visualización de reportes según las necesidades específicas del usuario.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual/busqueda.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <b>* Tabla de reportes realizados:</b> Nos muestra la información detallada de cada reporte, incluyendo:
                    <br>
                    <br>
                    <b>* N° de reporte.</b>
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual/N°.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <b>* Fecha.</b>
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual/fecha.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <b>* Nombre de Usuario.</b>
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual/Nombre.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <b>* Equipo que presenta la falla.</b>
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual/equipo.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <b>* Asunto (título corto con referencia a la falla).</b>
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual/tabla.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <b>* Detalles </b> (En este apartado, podemos ver un botón <i class="bi bi-eye"></i> en el que al hacer click nos abrira una ventana modal que nos mostrara más detalles sobre el reporte como:  fecha y hora de realizado el reporte, descripción completa de la falla, analista que atendio el reporte y solución de la falla ).
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual/detalles1.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <b>* Boton detalles: </b> ventana modal para visualizar los detalles de los reportes.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual/detalles.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <b>* Estatus: </b> nos muestra un badge que nos indicara cuando el reporte esta abierto o cerrado.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual/Estatus.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <b>* Eliminar: </b> en este apartado tenemos un boton de eliminar el cual esta activo permitiendo al usuario eliminarlo siempre y cuando aun no tenga respuesta o se haya atendido el reporte.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual/Eliminar.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <b>* Boton Eliminar: </b> función de eliminar reporte siempre y cuando no tenga respuesta este boton estara activo, si ya se dio respuetsa al reporte el usuario no podria eliminar el reporte por lo que el boton se desactivara automaticamente en cuanto tenga una respuesta por parte de soporte técnico de lo contrario estara desactivado.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual/botonEliminar.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <hr style="color: red"/>
                    <br>
                    <br>
                    <b>* Hacer clic en Dropdown o nombre de Usuario en solor amarillo: </b> al hacer clic se desplegara un submenu en el que se podran apreciar las opciones de Actualizar Datos y cerrar sesión.
                    <br>
                    <center><img src="../resources/imagen/Manual/usuarioExplicacion.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <b>* Clic en botón Actualizar Datos: </b> desplegara una ventana modal que nos permitira actualizar los datos del usuario que inicio sesion.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual//botonActualizarDatos.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <b>* Ventana Modal para Actualizar Datos: </b> en esta ventana el usuario podra actualizar los datos datos Personales.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual/actualizardatos.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <b>* Clic en botón cerrar sesion: </b> esta acción cerrara el sistema y nos enviara a pantalla de inicio de sesión.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual/usuarioExplicacion.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <b>* Pantalla de Inicio: </b> permitira nuevamente iniciar sesion de usuario o usuarios que necesiten ingresar al sistema.
                    <br>
                    <br>
                    <br>
                    <center><img src="../resources/imagen/Manual/pantallaInicio.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>                    <hr style="color: red"/>
                    </p>
               
        <center><img src="../resources/imagen/LOGO.png" alt="Logo" class="img-fluid"></center>
                    <br>
                    <p class="lead">

                    {{-- <div style="text-align:right;">
                        <b>
                            <?php echo date("d/m/Y"); ?>
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
            
                        window.onload = function () {
                            startTime();
                        };
                        </script>
                    </p>
                </div> --}}
        </div>
    </div>
@endsection


