<?php

require ('conexion.php');

$pass = $_POST['pass'];
$conf_pass = $_POST['conf_pass']; 

if(($pass =='') || ($conf_pass == '')){

    echo "<div class='col-10 alert alert-warning' role='alert'>Faltan datos por ingresar.</div>"; 
    exit;
  

}else{
    
    if ($pass == $conf_pass){

       echo "<div class='col-10 alert alert-success' role='alert'>Se ha restablecido la contraseña.</div>"; 

    }else{

       echo "<div class='col-10 alert alert-warning' role='alert'>La contraseña no coincide.</div>"; 
    }

}

?>