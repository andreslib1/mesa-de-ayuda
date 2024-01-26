<?php
require ('../conexion.php');
include ('header.php');

$pass = "123";

$pass_hash = password_hash($pass, PASSWORD_BCRYPT);

$query = "UPDATE bienesraices.vendedores SET PASS ='".$pass_hash."'WHERE EMAIL = 'felipe@gmail.com'";

$ejeucion = mysqli_query($db,$query); 

if ($ejeucion){
    echo "se creo correctamente la contraseña"; 
}