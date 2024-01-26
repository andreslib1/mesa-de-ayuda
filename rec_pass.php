<?php
require ('conexion.php');
include ('envio_correo.php');


$rec_contra = $_POST['rec_pass'];

/*echo "<pre>";
var_dump($_POST);
echo "</pre>";*/
if (substr($rec_contra, -10) != '@gmail.com'){
//if (substr($rec_contra, -19) != '@usta.edu.co'){
    
    echo "<div class='col-10 alert alert-warning' role='alert'>El correo ingresado no es un correo institucional de la USTA.</div>";

}else{
    
    // validacion correo electronico en la base de datos

    $query_con = "SELECT * FROM baseuno.usuarios_reg WHERE CORREO ='".$rec_contra."'";
                                                
    $consulta = mysqli_query($db,$query_con);
    
    $row = mysqli_fetch_assoc($consulta);

        if(isset($row)){

            $token = uniqid(). "M41L"; //creacion de token 

            $query_two = "UPDATE baseuno.usuarios_reg
                          SET TOKEN ='".$token."'
                          WHERE CORREO ='".$rec_contra."'";
                                                        
            $consulta_two = mysqli_query($db,$query_two);
        
            

            if($consulta_two){ 

                $query_tr = "SELECT * FROM baseuno.usuarios_reg WHERE TOKEN ='".$token."'";

                $consulta_tr = mysqli_query($db,$query_tr);

                $row_tr = mysqli_fetch_assoc($consulta_tr); 

                if (isset($row_tr)){


                        $correo = $rec_contra;
                        $asunto = "Restablecimiento de credenciales mesa de ayuda USTA";
                        $contenido = "Acabas de realizar una peticion de reestaclecimiento de credenciales a la mesa de ayuda USTA. Ingresa al siguiente enlace para reestablecer tu contraseña: <br><br>
                                     <a href='https://blooming-garden-66388-f6bef38c55d9.herokuapp.com/restablecer_pass.php?token=".$row_tr['TOKEN']."&correo=".$row_tr['CORREO']."'><strong>Click en este enlace</strong></a><br><br>
                                     Si no has realizado ninguna peticion ignora este mensaje.";

                        enviar_correo($correo, $asunto, $contenido);  

                }else{

                    echo "<div class='col-10 alert alert-success' role='alert'>Error al confirmar la consulta en la base de datos.</div>";

                }

            }else{

                echo "<div class='col-10 alert alert-success' role='alert'>Error al enviar token.</div>";
            }
            
           
            


        }else{

            echo "<div class='col-10 alert alert-warning' role='alert'>El correo ingresado no existe.</div>";
        } 

}

?>
 <!--href='actualizar.php?cod_propiedad=".$row['COD_PROPIEDAD']."'

