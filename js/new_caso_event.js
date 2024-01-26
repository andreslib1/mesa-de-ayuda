// validacion input Asunto

const input_asunto = document.getElementById('asunto');
const errorMsg_asunto = document.getElementById('errorMsg');

input_asunto.addEventListener('input', function() {
  if (this.value.length >= parseInt(this.getAttribute('maxlength'))) {

    errorMsg_asunto.textContent = 'Has superado el límite de caracteres';

  } else {
    
    errorMsg_asunto.textContent = '';
  }
});



// validacion input Descripcion

const input_des = document.getElementById('descripcion');
const errorMsg_des = document.getElementById('errorMsg_des');

input_des.addEventListener('input', function() {
    if(this.value.length >= parseInt(this.getAttribute('maxlength'))){

        errorMsg_des.textContent = 'Has superado el límite de caracteres';

    }else{

        errorMsg_asunto.textContent = '';
    }
});


// validacion peso del archivo 


  const fileInput = document.getElementById('adjunto');

  fileInput.addEventListener('change', function() {
    const file = this.files[0]; // Obtener el primer archivo seleccionado
    const fileSizeInBytes = file.size;
    const fileSizeInKB = fileSizeInBytes / 1024; // Convertir a KB

    if (fileSizeInKB > 1024) { // Verificar si el tamaño es mayor a 1MB
      alert('El archivo seleccionado es demasiado grande. El tamaño máximo permitido es de 1MB.');
      this.value = null; // Limpiar el valor del input
      return false;
    }
    
    // Si el tamaño es menor o igual a 1MB, continuar con el proceso de carga
    // ...
  });












