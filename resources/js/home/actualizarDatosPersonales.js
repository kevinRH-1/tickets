function actualizarDatosPersonales(){
    $.ajax ({
        type:"POST",
        data:$('#frmActualizarDatosPersonales').serialize(),
        url: "../procesos/home/actualizarDatosPersonales.php",
        success:function(respuesta){
            respuesta = respuesta.trim();
            if (respuesta == 1) {              
              Swal.fire("Excelente", "Se actualizo Correctamente", "success");
              location.reload(true);
            } else {
              Swal.fire("ERROR", "No Se actualizo" + respuesta, "error");
            }
          }
        });

    return false;
        }


    function obtenerDatosPersonalesHome(idUsuario){
      $.ajax({
              type:"POST",
              data:"idUsuario=" + idUsuario,
              url:"../procesos/usuarios/CRUD/obtenerDatosUsuario.php",
              success: function (respuesta) {
                      respuesta = jQuery.parseJSON(respuesta);
                      $('#nombreHome').val(respuesta['Nombre']);
                      $('#apellidoHome').val(respuesta['Apellido']);
                      $('#telefonoHome').val(respuesta['Telefono']);
                      $('#correoHome').val(respuesta['Correo']);
                      $('#departamentoHome').val(respuesta['Departamento']);
                      $('#usuarioHome').val(respuesta['Rol']);    
              }
            });  
    }
  