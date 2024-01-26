<?php

/*echo "<pre>";
var_dump($_POST);
echo "</pre>";*/

include ('../conexion.php');


/*echo "<pre>";
var_dump($_POST);
echo "</pre>";*/


$nombre = $_POST['nombre_b'];
$apellido = $_POST['apellido_b'];
$correo = $_POST['correo_b'];
$dependencia = $_POST['dependencia_b'];
$ubicacion = $_POST['ubicacion_b'];
$cargo = $_POST['cargo_b'];
$rol_user = $_POST['rol_user_b'];
$est_user = $_POST['est_user']; 


if(($nombre == '') || ($apellido == '') || ($correo == '') || ($dependencia == '') || ($ubicacion == '') || ($cargo == '') || ($rol_user == 'seleccione') || ($est_user == 'seleccione')){

    echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Warning:'><use xlink:href='#exclamation-triangle-fill'/></svg>
            <div> Faltan datos por ingresar</div>
         </div>"; 

}else{

    if (substr($correo, -12) != '@usta.edu.co'){

        echo "<div class='alert alert-warning d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Warning:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                    <div> Se debe ingresar un correo institucional </div>
             </div>";

    }else{

        $consulta = "SELECT * FROM u253606672_db1_proyectos.usuarios_reg where CORREO = '$correo'";
        
        $consult =  mysqli_query($db, $consulta);

        $row = mysqli_fetch_assoc($consult); 

        if ($row != ''){

            $update = "UPDATE u253606672_db1_proyectos.usuarios_reg SET COD_ROL_USUARIO = $rol_user, NOMBRE_USUARIO = '$nombre', APELLIDO = '$apellido', CORREO = '$correo' , DEPENDENCIA = '$dependencia', UBICACION = '$ubicacion', CARGO = '$cargo', ESTADO_USUARIO = '$est_user ', FECHA_ACTUALIZACION = NOW() 
            WHERE CORREO = '$correo'";

            $insert_q =  mysqli_query($db, $update);

                if ($insert_q){    

                echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
                            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                            <div> Los datos del usuario se han actualizado. </div>
                    </div>"; 

                }else{
                
                echo "Error al actualizar los datos";

                }

        }else{

            echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                        <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Warning:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                        <div> El usuario no se encuentra </div>
                </div>"; 
        }
    }
    
}


?>