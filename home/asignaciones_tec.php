<?php
/*echo "<pre>";
var_dump($_SESSION);
echo "</pre>";*/
include ('../conexion.php');
include ('header.php');

if (($_SESSION['rol_usuario'] == 3) || $_SESSION['rol_usuario'] == 2){

    echo "No se puede acceder a este sitio"; 
    
}else{



$cod_caso = $_GET['cod_caso'];

$consulta_e = "SELECT * FROM baseuno.casos
                INNER JOIN baseuno.usuarios_reg
                ON casos.COD_USUARIO_SOLICITA = usuarios_reg.COD_USUARIO
                WHERE casos.COD_CASO = $cod_caso"; 


$query_e =  mysqli_query($db, $consulta_e);

$row_e = mysqli_fetch_assoc($query_e);


?>

<!-- Olculta la barra de desplazamiento en los coentarios --> 

<style> 

::-webkit-scrollbar {
display: none;
}

</style>


  <div class="col-9 col-sm-10" style="padding-top: 67px; background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%); border-radius: 0px 15px 0px 5px;">
  <h3 class="p-2 p-sm-4 display-5" style="font-size: 30px;"  >
        <a href="asignaciones.php" id="etiqueta">Asignaciones</a>   <!-- efecto aplicado en ../css/css-etiquetas.css -->
        <a  id="etiqueta" href="asignaciones_asig.php">/Casos Nuevos</a></h3>  
  <div class="justify-content-center row">
    <div class="col-md-7 my-3 p-3" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; border-radius: 15px;">


<?php


        if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $cod_user_tec = $_POST['rol_user_n'];
        $cod_caso = $_POST['cod_caso'];


            if ($cod_user_tec == 'seleccione'){

                echo "<div class='alert alert-warning' role='alert'>
                         Selecciona el usuario quien atendera el caso. 
                    </div>";
                
            }else{

                $insert_a = "INSERT INTO baseuno.casos_tec (COD_CASO_ATEN, COD_USUARIO_TECNICO) 
                VALUES ($cod_caso, $cod_user_tec)";

                $update = "UPDATE baseuno.casos SET ESTADO = 'En Curso'
                        WHERE COD_CASO = $cod_caso ";

                $query_a =  mysqli_query($db, $insert_a);
                $query_b =  mysqli_query($db, $update);

                    if ($query_a && $query_b){

                        echo "<div class='alert alert-primary mt-2' role='alert'> Se ha asignado el caso correctamente.</div>
                                <a href='asignaciones_asig.php'><button mt-3 type='button' class='btn btn-primary'> Volver</button></a>"; 
                        
                        exit;
                    }else{

                        echo "<div class='alert alert-danger' role='alert'> Error en la base de datos.</div>";
                    }
            }
}
?>



        <h5 class="display-6" style="font-size: 26px;">Persona que solicita</h5> 
        <p class="display-5" style="font-size:15px;"><strong>Nombre: </strong><?php echo $row_e['NOMBRE_USUARIO']." ".$row_e['APELLIDO'] ?> <br>
                    <strong>Cargo: </strong> <?php echo $row_e['CARGO'] ?><br>
                    <strong>Correo: </strong> <?php echo $row_e['CORREO'] ?><br>
                    <strong>Dependencia: </strong> <?php echo $row_e['DEPENDENCIA'] ?><br>
                    <strong>Ubicacion: </strong> <?php echo $row_e['UBICACION'] ?><br>
        </p>
        <h5 class="display-6 mt-2" style="font-size: 26px;">Descripcion del caso</h5> 
        <p><?php echo $row_e['DESCRIPCION_CASO'] ?>
        
        </p>


        <?php

        ?>
        
         <p class="mx-3 my-0">Asignar a: </p> 
        <form class="row m-2" method="POST">
            <select class="form-control me-2" id="rol_user_n" name="rol_user_n" value="" required onchange="select_button()" required style="width: 250px;">
                        <option value="seleccione">Seleccione</option>
                                <?php

                                        $consulta = "SELECT * FROM baseuno.usuarios_reg WHERE COD_ROL_USUARIO = 2 OR COD_ROL_USUARIO = 1";
                                        $user = mysqli_query($db,$consulta);

                                        while( $rol = mysqli_fetch_assoc($user)){

                                            echo "<option value='".$rol['COD_USUARIO']."'>".$rol['NOMBRE_USUARIO']." ".$rol['APELLIDO']."</option>";
                                        }

                                ?>
                    </select>
             <input type="hidden" id="cod_caso" name="cod_caso" value="<?php echo $cod_caso; ?>">       
            <input type="submit"  class="btn btn-success mt-1 m-sm-0 col-md-2" value="Confirmar">
         </form>

    </div>

    </div>

    <!-- funcion para mostrar el ultimo contenido del scroll -->
    <script> 
        function scrollToBottom (id) {
        var div = document.getElementById(id);
        div.scrollTop = div.scrollHeight - div.clientHeight;
        }
        scrollToBottom("div_scroll");
    </script>


</seccion> <!--seccion, etiqueta de apertura en heade.php-->

<?php
 }
include ('footer.php');
?>