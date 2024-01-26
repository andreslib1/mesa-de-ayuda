<?php
/*echo "<pre>";
var_dump($_SESSION);
echo "</pre>";*/
include ('header.php');

$cod_user = $_SESSION['cod_usuario'];

$consul = "SELECT * FROM baseuno.usuarios_reg  
            WHERE COD_USUARIO = '$cod_user'";

$query =  mysqli_query($db, $consul);
$row = mysqli_fetch_assoc($query);


    $nombres     = $row['NOMBRE_USUARIO'];
    $apellidos   = $row['APELLIDO'];
    $correo      = $row['CORREO'];
    $dependencia = $row['DEPENDENCIA'];
    $ubicacion   = $row['UBICACION'];
    $cargo       = $row['CARGO'];
    $fecha_cre   = $row['FECHA_CREACION']

?>

    <div class="col-9 col-sm-10 " style="padding-top: 67px; background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%); border-radius: 0px 15px 0px 5px;">
    <div class="justify-content-center row">
        <form class="col-11 col-sm-5 mt-5" method="POST" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; border-radius: 10px;" >
            <h5 class="display-6">Mi cuenta</h5>
        <div class="">

        <?php
        
        $arreglo = []; // areglo donde se almacenan los errores
        $disable = '';  // valiable para deshabilitar input al actualizar dato.

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $cod_usuario = $_SESSION['cod_usuario'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $dependencia = $_POST['dependencia'];
            $ubicacion = $_POST['ubicacion'];
            $cargo = $_POST['cargo'];


            $update = "UPDATE baseuno.usuarios_reg 
                       SET NOMBRE_USUARIO = '$nombre',
                           APELLIDO = '$apellido',
                           DEPENDENCIA = '$dependencia',
                           UBICACION = '$ubicacion',
                           CARGO = '$cargo',
                           FECHA_ACTUALIZACION = NOW()
                        WHERE COD_USUARIO = '$cod_usuario'";

            $query =  mysqli_query($db, $update);
            
            if($query){

                echo "<div class='alert alert-success' role='alert'>Datos actualizados correctamente</div>";
                $disable = "disabled";
                

                

            }else{
                echo "<div class='alert alert-danger' role='alert'>Hubo un error al actualizar los datos</div>";
            }
        }
        
        ?>
				<div>
				   <h6>Nombres</h6>
				   <input type="text" class="form-control" id="nombre" name="nombre" <?php {echo $disable;} ?>  required value="<?php echo $nombres; ?>">
				</div>
				<div>
				   <h6>Apellidos</h6>
				   <input type="text" class="form-control" id="apellido" name="apellido" <?php {echo $disable;} ?> required value="<?php echo $apellidos ; ?>" >
				</div>
                <div class="mt-3">
                    <h6>Correo institucional</h6>
                    <input type="text" class="form-control" id="correo" name="correo" disabled required value="<?php echo $correo; ?>">
                </div>
                <div class="mt-3">
                    <h6>Dependencia</h6>
                    <input type="text" class="form-control" id="dependencia" name="dependencia" <?php {echo $disable;} ?> required value="<?php echo $dependencia; ?>">
				</div>
				<div class="mt-3">
					<h6>Ubicacion (Piso y Sede)</h6>
					<input type="text" class="form-control" id="ubicacion" name="ubicacion" <?php {echo $disable;} ?> required value="<?php echo $ubicacion; ?>">
				</div>
				<div class="mt-3">
					<h6>Cargo</h6>
					<input type="text" class="form-control" id="cargo" name="cargo" <?php {echo $disable;} ?> required value="<?php echo $cargo; ?>">
				</div>
				<div class="mt-3">
					<h6>Fecha de creacion</h5>
					<input type="text" class="form-control" id="fech_creacion" required disabled value="<?php echo $fecha_cre; ?>">
				</div>
                <div class="text-start my-4">
                    <input class="btn btn-success" type="submit" <?php {echo $disable;} ?> value="Actualizar datos"> 
                </div>
			</div>
        </form>
      </div>
    </div>

</seccion>

<?php
include ('footer.php');
?>