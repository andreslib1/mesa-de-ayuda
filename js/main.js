
document.addEventListener("DOMContentLoaded", function () {
    
    // Verifica si el usuario ya visitó la página "check_pass.php"

    if (sessionStorage.getItem("visitedCheckPass") !== "true") {
        
      // Si es la primera vez que el usuario visita la página, bloquea el retroceso
      history.pushState(null, null, location.href);
      window.addEventListener("popstate", function (event) {
        history.pushState(null, null, location.href);
      });
  
      // Marca la página "check_pass.php" como visitada en la sessionStorage
      sessionStorage.setItem("visitedCheckPass", "true");
    }
  });
  