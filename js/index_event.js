

//modal recuperar contraseña
// Espera a que el documento esté completamente cargado para comenzar a ejecutar el código

$(document).ready(function () {
    // Encuentra el botón con el ID "recuperar-btn" y añade un evento "click"

    $("#recuperar-btn").on("click", function () {

      // Obtiene el valor del input con el ID "correo_rec"

      var valorCaja1 = $("#correo_rec").val();

      // Crea un objeto de parámetros que contiene el valor del input como "rec_pass"

      var parametros = {
        "rec_pass": valorCaja1
      };
  
      // Muestra el spinner

      $("#spinner").show();
  
      // Realiza una solicitud AJAX con los siguientes parámetros:

      $.ajax({
        data: parametros,                     // Datos enviados al servidor (el objeto "parametros")
        url: 'rec_pass.php',                 // URL del archivo en el servidor que procesará la solicitud
        type: 'post',                        // Método de envío de datos (POST en este caso)
        success: function (response) {        // Función que se ejecuta si la solicitud tiene éxito

          // Oculta el spinner
          $("#spinner").hide();
  
          // Inserta la respuesta del servidor en el elemento con el ID "respuesta_pass"
          $("#respuesta_pass").html(response);
        },
        error: function () { // Función que se ejecuta si hay un error en la solicitud

          // Oculta el spinner en caso de error
          $("#spinner").hide();
        }
      });
    });

    // Event listener para el botón de cerrar, recargara la pagina el dar cerrar en el boton

    $("#close-btn").on("click", function () {
        location.reload();
    });

    $("#close-btn2").on("click", function () {
        location.reload();
    });

//--------------------------------------------------------------------------------------------------------------------------//


    // modal registrarce 
    // Obtiene una referencia al botón "Registrarce"
    var btnRegistro = $('#btn-registro');

    // Agrega un evento de escucha para el evento "click" del botón "Registrarce"
    btnRegistro.on('click', function(event) {

        // Previene la acción por defecto del botón "submit"
        event.preventDefault();

        // Obtiene los valores de los campos del formulario
        var nombre = $('#nombre').val();
        var apellido = $('#apellido').val();
        var correo = $('#correo').val();
        var dependencia = $('#dependencia').val();
        var ubicacion = $('#ubicacion').val();
        var cargo = $('#cargo').val();
        var contraseña = $('#contraseña').val();
        var confContraseña = $('#conf_contraseña').val();

        // Realiza la petición AJAX
        $.ajax({
            type: 'POST',
            url: 'regis_usuario.php',
            data: {
                'nombre': nombre,
                'apellido': apellido,
                'correo': correo,
                'dependencia': dependencia,
                'ubicacion': ubicacion,
                'cargo': cargo,
                'contraseña': contraseña,
                'conf_contraseña': confContraseña
            },
            success: function(response) {

                // Muestra la respuesta de la petición AJAX en un elemento HTML
                $('#res_registro').html(response);

                // Obtiene el valor del campo oculto
                var limpiarCampos = $('#limpiar_campos').val();

                // Verifica el valor del campo oculto (input)

                if (limpiarCampos === '1') {

                    // Limpia los campos del formulario

                    $('#nombre').val('');
                    $('#apellido').val('');
                    $('#correo').val('');
                    $('#dependencia').val('');
                    $('#ubicacion').val('');
                    $('#cargo').val('');
                    $('#contraseña').val('');
                    $('#conf_contraseña').val('');

                    // Deshabilita el botón del formulario
                    $('#btn-registro').prop('disabled', true);
                }    



            },
            error: function() {
                // Maneja el error de la petición AJAX
                console.log('Error en la petición AJAX');
            }
        });
    });




  });

