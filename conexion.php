<?php

$db = mysqli_connect('127.0.0.1', 'root', '', 'baseuno');

if (!$db){
    echo "Error al conectar a la base de datos";
    exit;
}

