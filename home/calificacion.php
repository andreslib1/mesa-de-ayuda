<?php
include ('../conexion.php');
include ('header.php');

/*echo "<pre>";
var_dump($_GET);
echo "</pre>";*/

?>

<div class="col-10 " style="padding-top: 67px; background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%); border-radius: 0px 15px 0px 5px;">
    <div class="justify-content-center row">
<?php

// Evaluacion por parte del solicitante envido por get

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $comentario = $_POST['evaluacion'];
    $estrellas = $_POST['estrellas'];
    $cod_caso = $_POST['cod_caso'];


    $consulta_k = "SELECT * FROM baseuno.encuesta
    where encuesta.COD_CASO_ENCUESTA = $cod_caso";
    
    $query_k =  mysqli_query($db, $consulta_k);
    
    $row_k = mysqli_fetch_assoc($query_k);

    if (!$row_k){

        $insert_a = "INSERT INTO baseuno.encuesta (COD_CASO_ENCUESTA, SUGERENCIA, CALIFICACION) VALUE ($cod_caso, '$comentario', '$estrellas')";

        $query_a =  mysqli_query($db, $insert_a);  
        
        if($query_a){
    
            echo "<div class='col-6'> 
                <div class='mt-5  alert alert-primary mt-2' role='alert'> El caso se ha evaluado correctamente. Recuerda que para ver nuevamente el caso debes ingresar al modulo <strong> 'Historial' </strong></div>
                <a href='casos_gene.php'><button mt-3 type='button' class='btn btn-primary'> Volver</button></a>
                </div>"; 
                
            }else{
            
                echo "error en la base de datos";
            }
    }

}else{

    echo "<div class='col-6'> 
    <div class='mt-5  alert alert-primary mt-2' role='alert'> No se han recibido datos o la encuesta ya fue realizada.</div>
    <a href='casos_gene.php'><button mt-3 type='button' class='btn btn-primary'> Volver</button></a>
    </div>";

}

?>
    </div>
    
  </div>
<?php
include ('footer.php');
?>