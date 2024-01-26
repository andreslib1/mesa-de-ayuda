<?php
/*echo "<pre>";
var_dump($_POST);
echo "</pre>";*/
include ('../conexion.php');

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$dependencia = $_POST['dependencia'];
$ubicacion = $_POST['ubicacion'];
$cargo = $_POST['cargo'];
$contraseña = $_POST['contraseña'];
$rol_user = $_POST['rol_user'];


if(($nombre == '') || ($apellido == '') || ($correo == '') || ($dependencia == '') || ($ubicacion == '') || ($cargo == '') || ($contraseña == '') || ($rol_user == '')){

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

        $consulta = "SELECT * FROM baseuno.usuarios_reg where CORREO = '$correo'";
        
        $consult =  mysqli_query($db, $consulta);

        $row = mysqli_fetch_assoc($consult); 

        if ($row == ''){

            $insert = "INSERT INTO baseuno.usuarios_reg (COD_ROL_USUARIO, NOMBRE_USUARIO, APELLIDO, CORREO, DEPENDENCIA, UBICACION, CARGO, PASSWORD, ESTADO_USUARIO, FECHA_CREACION) 
            VALUES ($rol_user,'$nombre','$apellido','$correo','$dependencia','$ubicacion', '$cargo', '$contraseña', 'Activo', NOW())";

            $insert_q =  mysqli_query($db, $insert);

                if ($insert_q){    

                echo "<div class='alert alert-success d-flex align-items-center' role='alert'>
                            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                            <div> El usuario se ha creado correctamente. </div>
                    </div>"; 

                }else{
                
                echo "Erro al insertar a la base de datos";

                }

        }else{

            echo "<div class='alert alert-danger d-flex align-items-center' role='alert'>
                        <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Warning:'><use xlink:href='#exclamation-triangle-fill'/></svg>
                        <div> Este usuario ya se encuentra registrado. </div>
                </div>"; 
        }
    }
}









?>