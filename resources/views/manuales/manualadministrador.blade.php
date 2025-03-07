@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="card border-0 shadow my-5">
            <div class="card-body p-5">
            <center>
                    <h1>Bienvenido a la ayuda Para Usuario Administrador </h1>
                </center>
                <hr style="color: red" />
                <br>
                <center><b>Pantalla de Inicio de sesión</b></center>
                <br>
                <br>
                <center><img src="../resources/imagen/Manual/pantallaInicio.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <hr style="color: red" />
                <br>
                <center><b>Pantalla de Inicio Administrador</b></center>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/Inicio.jpg" alt="Inicio" class="img-fluid"></center>
                <br>

                <p>Como podemos observar en el esquema, se muestran los datos del usuario que ha iniciado sesión en nuestro
                    sistema,
                    así como las funcionalidades a las que tiene acceso. Las opciones disponibles son:
                    <br>
                    <br>
                    <b>* Inicio.</b>
                    <br>
                    <b>* Usuarios.</b>
                    <br>
                    <b>* Asignacion de Equipos.</b>
                    <br>
                    <b>* Gestión de Fallas.</b>
                    <br>
                    <b>* Bitácora.</b>
                    <br>
                    <b>* Ayuda.</b>
                    <br>
                    <b> * Nombre de Usuario(Dropdown)</b>
                </p>
                <hr style="color: red" />
                <br>
                <center><b>Pantalla Gestión de Usuarios Administrador</b></center>
                <br>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/Crearusuario.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <br>
                <p>En la pantalla de gestión de usuarios podemos observar un botón de Crear nuevo usuario, así como también
                    los diferentes ítems que la componen.</p>
                <br>
                <br>
                <hr style="color: red" />
                <br>
                <br>
                <center><b>Pantalla Crear Usuario</b></center>
                <br>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/PantallaCrearUsuario.jpg" alt="Inicio" class="img-fluid">
                </center>
                <br>
                <br>
                <p>En esta pantalla podemos observar todos los campos necesarios para poder crear un nuevo usuarios así
                    como lo son algunos datos personales y algunos datos de empleado. </p>
                <br>
                <hr style="color: red" />
                <br>
                <br>
                <center><b>Reportes</b></center>
                <br>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/Reportes.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <p>Iconos para impresión y descarga de reportes en formato Excel, PDF e imprimir directamente los reportes
                </p>
                <br>
                <hr style="color: red" />
                <br>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/GestionUsuarios.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <p>En la pantalla de gestión de usuarios podemos observar una tabla que nos muestra datos básicos de los
                    usuarios que han sido registrados para iniciar sesión en el sistema,
                    así como también algunas funciones que permitirán a el administrador realizar algunas acciones que no
                    están permitidas para el usuario estándar.
                    <br>
                    <b>Nota: </b>los datos usados en los usuarios de este ejemplo no son reales son datos solo para
                    ejemplificar las funciones del sistema.
                </p>
                <br>
                <hr style="color: red" />
                <br>
                <center><b>Pantalla Funciones de administrador</b></center>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/Funciones.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <hr style="color: red" />
                <br>
                <br>
                <center><b>Pantalla de Crear Nuevo Usuario</b></center>
                <br>
                <center><img src="../resources/imagen/Manualadmin/NuevoUsuario.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <p>En esta pantalla podemos hacer clic en nuestro boton de crear nuevo usuario ver la ventana modal que nos
                    mostrará los campos necesarios para crear un nuevo usuario,
                    esta pantalla permitirá llenar los datos del usuario, así como nombre apellido departamento número de
                    ficha y hasta selecciones si es usuario administrador o estándar.</p>
                <br>
                <hr style="color: red" />
                <br>
                <center><b>Pantalla Boton Editar</b></center>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/BotonEditar.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <hr style="color: red" />
                <br>
                <center><b>Pantalla editar Usuario</b></center>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/PantallaEditar.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <br>
                <p>En esta pantalla podemos observar los datos en los que podemos realizar cambios y/o actualizaciones de
                    cada uno de los usuarios registrados en el sistema de soporte técnico informático.</p>
                <br>
                <hr style="color: red" />
                <br>
                <br>
                <center><b>Pantalla reset password o reseteo de contraseña</b></center>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/PantallaPasword.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <b>* Botón de resetear password o contraseña:</b> Nos permite cambiar la contraseña del usuario
                seleccionado en nuestro sistema.
                <br>
                <br>
                <hr style="color: red" />
                <br>
                <center><b>Pantalla Estatus</b></center>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/BotonEstatus.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <br>
                <p>En esta pantalla podemos observar el botón de <i class="bi bi-power"></i>Off, que nos indica que el
                    usuario seleccionado esta activo y si por el contrario observamos que nos muestra
                    <i class="bi bi-power"></i>On, esto significa que el usuario esta desactivado, para activar o desactivar
                    el usuario solo hace falta hacer un clic sobre este botón para cambiar su estado de activo a inactivo o
                    viceversa.
                </p>
                <br>
                <br>
                <br>
                <center><b>Pantalla Cuando realiza el cambio de Estatus</b></center>
                <br>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/CambioEstatus.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <br>
                <br>
                <p>En esta pantalla podemos observar cómo se nos muestra un Mensaje de cambio de Estatus correcto y de
                    inmediatamente el botón de <i class="bi bi-power"></i>Off cambia a <i class="bi bi-power"></i>On en
                    color turqués indicando
                    que el usuario esta inactivo todo esto con solamente dar un clic sobre el botón de on/off según este el
                    estatus del usuario en ese momento. </p>
                <br>
                <br>
                <hr style="color: red" />
                <br>
                <br>
                <center><b>Pantalla eliminar usuario</b></center>
                <br>
                <br>
                <center><img src="../resources/imagen/Manualadmin/BotonEliminar.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <br>
                <p>En esta pantalla podemos observar cómo se nos muestra un icono <i class="bi bi-trash3"></i> de color Rojo
                    que nos indica que está activo y al hacer clic sobre él nos mostrara una alerta preguntando si realmente
                    estamos
                    seguros de eliminar el usuario tal como indica la siguiente imagen.
                </p>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/PantallaEliminar.jpg" alt="Inicio" class="img-fluid">
                </center>
                <br>
                <br>
                <p>En esta pantalla podemos observar cómo se nos muestra un alerta de seguridad preguntando si se esta
                    seguro de eliminar el usuario y podemos elegir entre cancelas y eliminar según sea la necesidad.
                </p>
                <br>
                <hr style="color: red" />
                <br>
                <br>
                <center><b>Pantalla Asignación de Equipos</b></center>
                <br>
                <br>
                <center><img src="../resources/imagen/Manualadmin/AsignacionEquipos.jpg" alt="Inicio" class="img-fluid">
                </center>
                <br>
                <p>En esta pantalla podemos observar los equipos asignados a cada usuarios registrado, así como también las
                    características del mismo.</p>
                <br>
                <br>
                <center><b>Pantalla Asignación de Equipos</b></center>
                <center><b>Boton Asignar</b></center>
                <br>
                <br>
                <center><img src="../resources/imagen/Manualadmin/BotonAsignar.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/ModalAsignacion.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <br>
                <p>Este boton nos abrirá una ventana modal en la que podremos ver los campos requeridos para poder asignar un equipo a usuarios registrados,
                    está compuesto por dos menús desplegables uno para elegir el usuario registrado y el otro para elegir
                    desde
                    un catálogo de equipos el equipo para ser asignado, así como también campos que permitan guardar datos
                    y/o características específicas de cada equipo</p>
                <br>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/AsignacionRegistros.jpg" alt="Inicio" class="img-fluid">
                </center>
                <br>
                <p>Muestra la cantidad de registros que el Administrador quiere que se muestren en la tabla.</p>
                <br>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/AsignacionReportes.jpg" alt="Inicio" class="img-fluid">
                </center>
                <br>
                <p>Botones para imprimir reportes bien sea en PDF, EXCEL o imprimir directamente.</p>
                <br>
                <br>
                <hr style="color: red" />
                <br>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/AsignacionBuscar.jpg" alt="Inicio" class="img-fluid">
                </center>
                <br>
                <br>
                <p>El campo de búsqueda nos permite buscar dentro de la tabla con facilidad bien sea por fecha, nombre,
                    equipo, capacidades, entre otra forma de búsqueda.</p>
                <br>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/AsignacionTabla.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <br>
                <p>Como se puede observar en esta pantalla la tabla nos muestra las características del equipo asignado así
                    como también sus capacidades y también un boton que nos permitirá eliminar la asignación del equipo, es
                    necesario
                    mencionar que si el usuario realizo un reporte con respecto a este equipo ya no podrá ser eliminado.</p>
                <br>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/EliminarAsignacion.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <p>Permitirá eliminar la asignación del equipo, es necesario mencionar que si el usuario realizo un reporte
                    con respecto a este equipo ya no podrá ser eliminado.</p>
                    <br>
                    <br>
                <hr style="color: red" />
                <br>
                <br>
                <center><b>Pantalla Gestión de Fallas Administrador</b></center>
                <br>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/GestiondeFallasAdministrador.jpg" alt="Inicio"
                        class="img-fluid"></center>
                <br>
                <br>
                <p>En esta pantalla podemos ver los accesos y permisos del usuario administrador, usuario único permitido
                    para realizar registro modificaciones y eliminación de información según sea permitido por el sistema o
                    programador. </p>
                <br>
                <br>
                <hr style="color: red" />
                <br>
                <br>
                <center><b>Pantalla Gestión de Fallas indicador</b></center>
                <br>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/indicadoresAdmin.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <br>
                <p>En esta pantalla podemos observar los indicadores que muestran la cantidad de reportes abiertos, cerrados y el total
                    de reportes creados por los diferentes usuarios.</p>
                <br>
                <br>
                <hr style="color: red" />
                <br>
                <br>
                <center><b>Pantalla Gestión de Fallas registros botones de exportación y campo de búsqueda</b></center>
                <br>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/registrosAdmin.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <br>
                <p>En esta sección de la pantalla podemos observar la cantidad de registros que el usuarios quiere que se visualicen en su tabla
                los valores son: 10, 25, 50, 100 lo que permitirá que el usuario pueda ver la cantidad de registros que seleccione,  también
                podemos observar 3 botones que nos permitirán la exportación de datos en formato EXCEL, PDF e imprimir directamente por ultimo
                tenemos una barra de búsqueda en la que podemos realizar la búsqueda de la manera que mejor se prefiera, por nombre, fecha,
                usuario entre otros.</p>
                <br>
                <br>
                <hr style="color: red" />
                <br>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/reportesAdminF.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <br>
                <p>En esta sección de la pantalla podemos observar la información de cada uno de los reportes registrados así como también sus diferentes datos como:</p>
                    <br>
                    <b>* Numero de Reporte: </b> no es más que un numero correlativo incremental automático.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/ManualAdmin/NreporteAdmin.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <hr style="color: red" />
                    <br>
                    <br>
                    <b>* Fecha: </b> se genera y se guarda automáticamente en el momento que se creo el reporte.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/ManualAdmin/fechaAdmin.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <hr style="color: red" />
                    <br>
                    <br>
                    <b>* usuario: </b> el usuario que realizo el reporte.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/ManualAdmin/usuarioreporteAdmin.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <hr style="color: red" />
                    <br>
                    <br>
                    <b>* Equipo que reporta: </b> el equipo que este asignado a ese Usuario y qeu está siendo reportando por falla.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/ManualAdmin/equiporeporteAdmin.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <hr style="color: red" />
                    <br>
                    <br>
                    <b>* Asunto: </b> descripción corta de la falla.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/ManualAdmin/asuntoAdmin.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <hr style="color: red" />
                    <br>
                    <br>
                    <b>* Respuesta: </b> en el caso de Usuario Administrador mostrara un boton de responder para poder dar respuesta a el usuario que reporto la falla,
                    este boton dejara de visualizarse una vez que se responda y se cierre el reporte de lo contrario seguirá activo, una vez respondido solo mostrar esta información <i class="bi bi-clipboard2-check-fill"> Atendido</i>
                    <br>
                    <br>
                    <center><img src="../resources/imagen/ManualAdmin/respuestaAdmin.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <hr style="color: red" />
                    <br>
                    <br>
                    <b>* Detalles: </b> aquí podremos ver un icono <i class="bi bi-eye"></i> que nos permitirá ver los detalles tanto del reporte fecha el asunto la falla y también su solución este modal es solo informativo no puede ser modificado.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/ManualAdmin/detallesAdminF.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <hr style="color: red" />
                    <br>
                    <br>
                    <b>* Estatus: </b> nos indica si el reporte está abierto o cerrado se actualiza automáticamente.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/ManualAdmin/estatusAdmin.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <hr style="color: red" />
                    <br>
                    <br>
                    <b>* Boton Eliminar: </b> este boton nos permitirá eliminar el reporte si y solo si aun no se ha dado respuesta al reporte, esta función aplica para el usuario quien crea el
                    reporte también podrá eliminarlo siempre y cuando no se haya dado respuesta a el reporte por parte del analista de soporte técnico.
                    <br>
                    <br>
                    <center><img src="../resources/imagen/ManualAdmin/eliminarAdmin.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <b>NOTA: </b> una vez que se le dé respuesta al usuario con respecto a su reporte y el mismo sea cerrado el boton de eliminar quedara inactivo impidiendo realizar la función de eliminar.
                    <br>
                    <br>
                    <hr style="color: red" />
                    <br>
                    <br>
                    <center><b>Pantalla Actualizar datos Usuario</b></center>
                    <br>
                    <br>
                    <center><img src="../resources/imagen/ManualAdmin/actualizarAdmin.jpg" alt="Inicio" class="img-fluid"></center>
                    <br>
                    <br>
                    <p>En esta pantalla al hacer clic en dropdown del nombre de usuario podremos ver como se despliegan dos opciones, un a de actualizar datos y la otra de cerrar sesión, al hacer clic en
                        actualizar datos el usuario podrá actualizar sus datos personales.</p>
                    <br>
                    <br>
                    <center><img src="../resources/imagen/ManualAdmin/actualizar1Admin.jpg" alt="Inicio" class="img-fluid"></center> 
                    <br>
                    <br>
                    <p>Una vez que el usuario haga clic en actualizar sus datos actualizados serán guardados de manera automática</p> 
                <br>
                <br>
                <hr style="color: red" />
                <br>
                <br>
                <center><b>Pantalla Actualizar datos Usuario</b></center>
                <br>
                <br>
                <center><img src="../resources/imagen/ManualAdmin/cerrarsesionAdmin.jpg" alt="Inicio" class="img-fluid"></center> 
                <br>
                <br>
                <p>Al hacer clic en el boton de cerrar sesión nos enviara a la pantalla de inicio de sesión saliendo completamente del sistema.</p>
                <br>
                <br>
                <hr style="color: red" />
                <br>
                <br>
                <b>* Pantalla de Inicio: </b> permitirá nuevamente iniciar sesión de usuario o usuarios que necesiten
                ingresar al sistema.
                <br>
                <br>
                <br>
                <center><img src="../resources/imagen/Manual/pantallaInicio.jpg" alt="Inicio" class="img-fluid"></center>
                <br>
                <hr style="color: red" />
            


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