<?php
require ('conexion.php');

$nom_usuario = $_POST['nombre'];
$ape_usuario = $_POST['apellido']; 
$correo_ins = $_POST['correo'];
$dependencia = $_POST['dependencia'];
$ubicacion = $_POST['ubicacion'];
$cargo = $_POST['cargo'];
$contraseña = $_POST['contraseña'];
$confi_contraseña = $_POST['conf_contraseña'];

/*echo "<pre>";
var_dump($_POST);
echo "</pre>";*/

if (($nom_usuario == '') || ($ape_usuario  == '') || ($correo_ins == '') || ($dependencia == '') || ($ubicacion == '') || ($cargo == '') || ($contraseña == '') || ($confi_contraseña == '') ){

    echo "<div class='col-10 alert alert-warning' role='alert'>Faltan datos por ingresar en el formulario.</div>"; 
    exit;

}else{
   // if (substr($correo_ins, -10) != '@gmail.com'){
        if (substr($correo_ins, -12) != '@usta.edu.co'){

            echo "<div class='col-10 alert alert-warning' role='alert'>Debes ingresar el correo electronico institucional.</div>
                    <input id='limpiar_campos' name='prodId' type='hidden' value='0'>";

        }else{

                // validacion correo electronico no repetido en la base de datos

                $query_con = "SELECT * FROM u253606672_db1_proyectos.usuarios_reg WHERE CORREO ='".$correo_ins."'";
                                                        
                $consulta = mysqli_query($db,$query_con);

                $row = mysqli_fetch_assoc($consulta);

                if ($row){

                    echo "<div class='col-10 alert alert-warning' role='alert'>El correo ya se encuentra registrado, si es funcionario nuevo seleccione restablecer contraseña y actualice los datos.</div>
                    <input id='limpiar_campos' name='prodId' type='hidden' value='0'>";

                }else{
                    
                    //validacion de confirmacion de contraseña


                        if ($contraseña != $confi_contraseña) {
                            
                        
                            echo "<div class='col-10 alert alert-warning' role='alert'>La contraseña no coincide.</div>
                            <input id='limpiar_campos' name='prodId' type='hidden' value='0'>";
                        
                        }else{
                            
                            $pass_hash = password_hash($confi_contraseña, PASSWORD_BCRYPT);

                            $query_con = "INSERT INTO u253606672_db1_proyectos.usuarios_reg (COD_ROL_USUARIO, NOMBRE_USUARIO, APELLIDO, CORREO, DEPENDENCIA, UBICACION, CARGO, ESTADO_USUARIO, PASSWORD, FECHA_CREACION) VALUES (3, '".$nom_usuario."', '".$ape_usuario."', '".$correo_ins."', '".$dependencia."', '".$ubicacion."', '".$cargo."', 'Activo', '".$pass_hash."', NOW())";
                            
                            $consulta = mysqli_query($db,$query_con);

                            if ($consulta){

                                echo "<div class='col-10 alert alert-success' role='alert'>La cuenta fue creada correctamente</div>
                                <input id='limpiar_campos' name='prodId' type='hidden' value='1'>";
                                
                            }else{
                                
                                echo "<div class='col-10 alert alert-danger' role='alert'>No fue posible crear la cuenta. (error en la base de datos)</div>";

                            }

                        }
                    
                }
            }
     }

?>

