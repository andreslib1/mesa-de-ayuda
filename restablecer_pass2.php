<?php
require ('conexion.php');

$correo = $_POST['correo']; 
$pass = $_POST['pass'];
$conf_pass = $_POST['conf_pass']; 


if(($pass =='') || ($conf_pass == '')){
          
            header('Location: validacion_pass.php');
        

        }else{
            
            if ($pass == $conf_pass){
                
                    $pass_hash = password_hash($conf_pass, PASSWORD_BCRYPT);


                     $query_two = "UPDATE baseuno.usuarios_reg
                     SET TOKEN ='restaurado', PASSWORD = '".$pass_hash."' 
                     WHERE CORREO ='".$correo."'";
                                                   
                     $consulta_two = mysqli_query($db,$query_two);
                     
                     header('Location: check_pass.php');
            }else{

                header('Location: validacion_pass_2.php');
            }

        }
?>