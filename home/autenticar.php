<?php

session_start();

$autenticacion = $_SESSION['login']; 

if ($autenticacion == false){

    header ('Location: ../index.php'); 
}
?>