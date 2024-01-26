
// Espera a que se cargue el contenido de la página
document.addEventListener("DOMContentLoaded", function() {
    // Busca el enlace con href="#enlace-protegido"
    var link = document.querySelector("a[href='#enlace-protegido']");
    // Busca el contenedor del formulario
    var linkBox = document.getElementById("linkBox");
    // Agrega un manejador de eventos al enlace
    link.addEventListener("click", function(event) {
      // Previene la acción por defecto del enlace
      event.preventDefault();
      // Si el formulario no está visible, lo muestra
      if (linkBox.style.display == "none") {
        linkBox.style.display = "block";
        // Agrega un manejador de eventos al formulario
        var form = document.querySelector("#linkBox form");
        form.addEventListener("submit", function(event) {
          // Previene la acción por defecto del formulario
          event.preventDefault();
          // Obtiene el valor del campo de contraseña
          var password = document.getElementById("password").value;
          // Si la contraseña es correcta, abre el enlace protegido en una nueva pestaña
          if (password == "desarrollo") {
            linkBox.style.display = "none";
            var enlaceProtegido = "https://andress-organization-3.gitbook.io/manual-tecnico-2/";
            window.open(enlaceProtegido, "_blank");
          } else {
            // Si la contraseña es incorrecta, muestra un mensaje de error
            alert("Contraseña incorrecta. Intenta de nuevo.");
          }
        });
      } else {
        // Si el formulario ya está visible, lo oculta
        linkBox.style.display = "none";
      }
    });
    // Agrega un manejador de eventos para cuando se retroceda en la historia del navegador
    window.addEventListener("popstate", function(event) {
      linkBox.style.display = "none";
    });
  });
  


