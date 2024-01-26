<?php
/*echo "<pre>";
var_dump($_POST);
echo "</pre>";*/
include ('../conexion.php');

$busqueda = $_POST['buscar'];

$consulta = "SELECT * FROM u253606672_db1_proyectos.usuarios_reg where CORREO LIKE ('%$busqueda%')";
        
$consult =  mysqli_query($db, $consulta);

$row = mysqli_fetch_assoc($consult);

if ($row){


    echo "<div class='col-6'>
                    <h6>Nombres</h6>
                    <input type='text' class='form-control' id='nombre_b' value='".$row['NOMBRE_USUARIO']."' required>
                </div>
                <div class='col-6'>
                    <h6>Apellidos</h6>
                    <input type='text' class='form-control' id='apellido_b' value='".$row['APELLIDO']."' required>
                </div>
                <div class='mt-3 col-6'>
                    <h6>Correo institucional</h6>
                    <input type='text' class='form-control' id='correo_b' required value='".$row['CORREO']."' disabled>
                </div>
                <div class='mt-3 col-6'>
                    <h6>Dependencia</h6>
                    <input type='text' class='form-control' id='dependencia_b' value='".$row['DEPENDENCIA']."' required>
                </div>
                <div class='mt-3 col-6'>
                    <h6>Ubicacion (Piso y Sede)</h6>
                    <input type='text' class='form-control' id='ubicacion_b' value='".$row['UBICACION']."' required>
                </div>
                <div class='mt-3 col-6'>
                    <h6>Cargo</h6>
                    <input type='text' class='form-control' id='cargo_b' value='".$row['CARGO']."' required>
                </div>
                <div class='mt-3 col-6'>
                Estado del usuario : <strong>".$row['ESTADO_USUARIO']."</strong> <br>
                    <select id='est_user' name='est_user' class='form-select form-select-md mb-3' aria-label='.form-select-lg example'>
                        <option selected>Seleccione</option>
                        <option value='Activo'>Activo</option>
                        <option value='Inactivo'>Inactivo</option>        
                    </select>
                </div>
                <div class='mt-2 row col-12'>
                        <h6>Rol de usuario</h6>
                        <select class='form-select form-select-md  mx-2' id='rol_user_b' name='rol_user' required onchange='select_button()'>
                        <option value='seleccione'>Seleccione</option>".
                                

                                        $query_two = "SELECT * FROM u253606672_db1_proyectos.rol";
                                        $select_rol = mysqli_query($db,$query_two);

                                        while( $rol = mysqli_fetch_assoc($select_rol)){

                                            echo "<option value='".$rol['COD_ROL']."'>".$rol['NOMBRE_ROL']."</option>";
                                        }"
                         </select> 
                </div>";
                
                         
 }
 
 ?>

 