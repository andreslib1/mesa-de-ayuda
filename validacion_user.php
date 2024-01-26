<?php
require ('conexion.php');

echo "<pre>";
var_dump($_POST);
echo "</pre>";

//desencriptar contraseña 

session_start();

if (isset($_POST['ingresar'])){
    if (isset($_POST['usuario']) and isset($_POST['password'])){
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];

        $sql = $con->query("SELECT * FROM baseuno.usuarios_reg  
                            WHERE CORREO = $usuario 
                            AND PASSWORD = $password");
          
        if ($dato = $sql->fetch_object()){

            $_SESSION['COD_USUARIO']=$dato->COD_USUARIO; 
            $_SESSION['NOMBRE']=$dato->NOMBRE;
            $_SESSION['APELLIDO']=$dato->APELLIDO;

            header("location: administrador.php");
            }
            else{
            echo "<div class='alert alert-danger'>Datos incorrectos o usuario inactivo</div>";
            }
    }else{
    echo "<div class='alert alert-warning'>Faltan datos por ingresar</div>";
}
}

?>