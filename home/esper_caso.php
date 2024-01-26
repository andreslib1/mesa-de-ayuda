<?php
include ('../conexion.php');

$cod_user = $_GET['cod_user_tecnico']; 
$cod_caso = $_GET['cod_caso'];

$consulta_a = "SELECT * FROM baseuno.casos
                INNER JOIN baseuno.usuarios_reg
                ON casos.COD_USUARIO_SOLICITA = usuarios_reg.COD_USUARIO
                WHERE casos.COD_CASO = $cod_caso"; 


$query_a =  mysqli_query($db, $consulta_a);

$row_a = mysqli_fetch_assoc($query_a);

if($row_a['ESTADO'] != 'Pendiente'){

    $insert_a = "UPDATE baseuno.casos SET ESTADO = 'Pendiente' WHERE COD_CASO = $cod_caso";

    $query_a =  mysqli_query($db, $insert_a);  

        if($query_a){

        header ('Location: seguimiento_tec.php?cod_caso='.$cod_caso.'&cod_user_tecnico='.$cod_user);

        }else{

            echo "hubo un error en la base de datos";
        }
    }else{

            $insert_a = "UPDATE baseuno.casos SET ESTADO = 'En Curso' WHERE COD_CASO = $cod_caso";

            $query_a =  mysqli_query($db, $insert_a);  

            if($query_a){

            header ('Location: seguimiento_tec.php?cod_caso='.$cod_caso.'&cod_user_tecnico='.$cod_user);

            }else{

                echo "hubo un error en la base de datos";
           }
    }
?>