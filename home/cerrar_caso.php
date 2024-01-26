<?php
include ('../conexion.php');

$cod_user = $_GET['cod_user_tecnico']; 
$cod_caso = $_GET['cod_caso'];

$insert_a = "UPDATE baseuno.casos SET ESTADO = 'Cerrado', FECHA_FINALI_CASO = NOW() WHERE COD_CASO = $cod_caso";

$query_a =  mysqli_query($db, $insert_a);  

if($query_a){

header ('Location: seguimiento_tec.php?cod_caso='.$cod_caso.'&cod_user_tecnico='.$cod_user);

}else{

    echo "error al cerrar el caso, no se pudo insertar a la base de datos";
}
?>