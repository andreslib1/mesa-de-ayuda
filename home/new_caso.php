<?php
include ('header.php');
include ('../conexion.php');

?>
    <div class="col-9 col-sm-10 " style="padding-top: 67px; background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%); border-radius: 0px 15px 0px 5px;">
        <h3 class="p-2 p-sm-4 display-5" style="font-size: 30px;"  >
        <a href="home.php" id="etiqueta">Inicio</a>   <!-- efecto aplicado en ../css/css-etiquetas.css -->
        <a style="text-decoration: none;" id="etiqueta_pri" href="">/Nuevo caso</a></h3> 
    <div class="justify-content-center row">

<?php

$asunto = '';
$descripcion = '';  // verificar , no trae el dato



if($_SERVER['REQUEST_METHOD'] === 'POST'){

/*echo "<pre>";
var_dump($_POST);
echo "</pre>";*/

        $cod_solici = $_SESSION['cod_usuario'];
        $asignado = $_POST['rol_user_n'];
        $asunto = $_POST['asunto'];
        $descripcion = $_POST['descripcion'];
        $adjunto = $_FILES['adjunto'];


        if (($asunto == '' && $descripcion == '') ||  ($asignado == 'seleccione') ){

            echo "<div class='col-6 mt-3 alert alert-warning' role='alert'>Falta informacion por ingresar.</div>"; 

        }else{

            $consult = "SELECT MAX(COD_CASO) FROM u253606672_db1_proyectos.casos";

            $consult_r =  mysqli_query($db, $consult);

            $row = mysqli_fetch_assoc($consult_r);

            $cod_caso = $row['MAX(COD_CASO)'] + 1;
            
            if (!$adjunto['name']){ // proceso si el usuario NO adjunta un documento

                
                $insert_a = "INSERT INTO u253606672_db1_proyectos.casos (COD_CASO, COD_USUARIO_SOLICITA, TITULO_CASO, DESCRIPCION_CASO, ESTADO, FECHA_CREACION_CASO) 
                VALUES ($cod_caso, $cod_solici,'$asunto','$descripcion', 'Nuevo', NOW())";     
                

                $insert_b = "INSERT INTO u253606672_db1_proyectos.casos_tec (COD_CASO_ATEN, COD_USUARIO_TECNICO) 
                VALUES ($cod_caso, $asignado)";

                $consult_b = "SELECT * FROM u253606672_db1_proyectos.casos 
                WHERE COD_CASO =  $cod_caso";

                if ($asignado == 3){                // condicion si el usuario es funcionario
                        
                        $query_a =  mysqli_query($db, $insert_a);

                        if ($query_a){    
                        
     
                            $query =  mysqli_query($db, $consult_b);
        
                            $row = mysqli_fetch_assoc($query);
        
                            echo "<div class='alert alert-success col-11 col-md-7 mt-5 d-flex align-items-center' role='alert'>
                                        <div class='d-flex align-items-center flex-column flex-md-row'>
                                            <i class='bi bi-send-check mx-md-5' style='font-size:40px;'></i>
                                        <div>
                                    <div>
                                        Se ha recibido su petición, el numero de caso es el <strong> #".$row['COD_CASO']."</strong> para su atención. <br>
        
                                        Agradecemos estar pendiente de la plataforma para cualquier información que podamos requerir.<br>
        
                                        <br>
        
                                        Estado de la solicitud: <strong>".$row['ESTADO']."</strong> <br>
                                        Fecha de creación: <strong>".$row['FECHA_CREACION_CASO']."</strong> <br>
                                    </div>
                                      <a href='casos_gene.php' type='button' class='btn btn-success'>Ir a los casos solicitados</a>
                                </div>"; 
        
                            exit;
                        }else{
                        
                            echo "Error al isertar datos"; 
                        }
                    
                }else{   // si el usuario es administrador o tecnico 
          
                $insert_e = "INSERT INTO u253606672_db1_proyectos.casos (COD_CASO, COD_USUARIO_SOLICITA, TITULO_CASO, DESCRIPCION_CASO, ESTADO, FECHA_CREACION_CASO) 
                VALUES ($cod_caso, $cod_solici,'$asunto','$descripcion', 'En Curso', NOW())";    

                    $query_a =  mysqli_query($db, $insert_e);    
                    $query_b =  mysqli_query($db, $insert_b);

                    if ($query_a && $query_b){    
                
                            $query =  mysqli_query($db, $consult_b);
        
                            $row = mysqli_fetch_assoc($query);
        
                            echo "<div class='alert alert-success col-11 col-md-7  mt-5 d-flex align-items-center' role='alert'>
                                     <div class='d-flex align-items-center flex-column flex-md-row'>
                                         <i class='bi bi-send-check mx-md-5' style='font-size:40px;'></i>
                                     <div>
                                    <div>
                                        Se ha recibido su petición, el numero de caso es el <strong> #".$row['COD_CASO']."</strong> para su atención. <br>
        
                                        Agradecemos estar pendiente de la plataforma para cualquier información que podamos requerir.<br>
        
                                        <br>
        
                                        Estado de la solicitud: <strong>".$row['ESTADO']."</strong> <br>
                                        Fecha de creación: <strong>".$row['FECHA_CREACION_CASO']."</strong> <br>
                                        <div class='mt-3' >
                                            <a href='casos_gene.php'><input  type='button' class='btn btn-success' value='Ir a los casos solicitados'></a>
                                        </div>
                                    </div>
                                    
                                </div>"; 
        
                            exit;
                    }else{
                        
                        echo "Error al isertar datos"; 
                    }
                }


            }else{ // proceso si el usuario adjunta un documento

                /*echo "<pre>";
                var_dump($_FILES);
                echo "</pre>";*/

                $medida = 10000 * 100; // 1 mb

                if ($adjunto['size'] > $medida ){

                    echo "<div class='col-6 mt-3 alert alert-warning' role='alert'>El archivo adjunto es muy pesado.</div>"; 

                }else{

                        // subir archivo adjunto (se toma los ultimos caracteres para saber el tipo de archivo, despues se genera un nombre aleatorio y se sube al servidor)

                        $tipo_archivo = substr($adjunto['name'], -5);

                        $nom_archivo = md5(uniqid(rand(),true));

                        move_uploaded_file($adjunto['tmp_name'],'adjunto/'.$nom_archivo.$tipo_archivo);
                        

                        $insert_c = "INSERT INTO u253606672_db1_proyectos.imagen_adj (COD_CASO_IMA, DESCRIPCION, TIPO_ADJUNTO) 
                        VALUES ($cod_caso,'".$nom_archivo.$tipo_archivo."', 'caso')";

                        if ($asignado == 3){  // condicion si el usuario es funcionario

                            $insert_a = "INSERT INTO u253606672_db1_proyectos.casos (COD_CASO, COD_USUARIO_SOLICITA, TITULO_CASO, DESCRIPCION_CASO, ESTADO, FECHA_CREACION_CASO) 
                            VALUES ($cod_caso, $cod_solici,'$asunto','$descripcion', 'Nuevo', NOW())";    
                            
                            $query_a =  mysqli_query($db, $insert_a);    
                            $query_c =  mysqli_query($db, $insert_c);
    
                                if ($query_a && $query_c){
    
                                    $consult_d = "SELECT * FROM u253606672_db1_proyectos.casos 
                                    WHERE COD_CASO =  $cod_caso";
    
                                        $query =  mysqli_query($db, $consult_d);
    
                                        $row = mysqli_fetch_assoc($query);
    
                                        echo "<div class='alert alert-success col-11 col-md-7 mt-5 d-flex align-items-center' role='alert'>
                                                    <div class='d-flex align-items-center flex-column flex-md-row'>
                                                         <i class='bi bi-send-check mx-md-5' style='font-size:40px;'></i>
                                                    <div>
                                                <div>
                                                    Se ha recibido su petición, el numero de caso es el <strong> #".$row['COD_CASO']."</strong> para su atención. <br>
    
                                                    Agradecemos estar pendiente de la plataforma para cualquier información que podamos requerir.<br>
    
                                                    <br>
    
                                                    Estado de la solicitud: <strong>".$row['ESTADO']."</strong> <br>
                                                    Fecha de creación: <strong>".$row['FECHA_CREACION_CASO']."</strong> <br>
                                                    <div class='mt-3' >
                                                         <a href='casos_gene.php'><input  type='button' class='btn btn-success' value='Ir a los casos solicitados'></a>
                                                    </div>
                                                </div>
                                            </div>"; 
    
                                        exit;
                                    }else{
                                        
                                        echo "error al isertar datos"; 
                                    
                                    }

                        }else{   // si el usuario es administrador o tecnico
                            
                            $insert_a = "INSERT INTO u253606672_db1_proyectos.casos (COD_CASO, COD_USUARIO_SOLICITA, TITULO_CASO, DESCRIPCION_CASO, ESTADO, FECHA_CREACION_CASO) 
                            VALUES ($cod_caso, $cod_solici,'$asunto','$descripcion', 'En Curso', NOW())";    
    
                            $insert_b = "INSERT INTO u253606672_db1_proyectos.casos_tec (COD_CASO_ATEN, COD_USUARIO_TECNICO) 
                            VALUES ($cod_caso, $asignado)";
                            
    
                            $query_a =  mysqli_query($db, $insert_a);    
                            $query_b =  mysqli_query($db, $insert_b);
                            $query_c =  mysqli_query($db, $insert_c);
    
                                if ($query_a && $query_b && $query_c){
    
                                    $consult_d = "SELECT * FROM u253606672_db1_proyectos.casos 
                                    WHERE COD_CASO =  $cod_caso";
    
                                        $query =  mysqli_query($db, $consult_d);
    
                                        $row = mysqli_fetch_assoc($query);
    
                                        echo "<div class='alert alert-success col-11 col-md-7 mt-5 d-flex align-items-center' role='alert'>
                                            <div class='d-flex align-items-center flex-column flex-md-row'>
                                                <i class='bi bi-send-check mx-md-5' style='font-size:40px;'></i>
                                            <div>
                                                <div>
                                                    Se ha recibido su petición, el numero de caso es el <strong> #".$row['COD_CASO']."</strong> para su atención. <br>
    
                                                    Agradecemos estar pendiente de la plataforma para cualquier información que podamos requerir.<br>
    
                                                    <br>
    
                                                    Estado de la solicitud: <strong>".$row['ESTADO']."</strong> <br>
                                                    Fecha de creación: <strong>".$row['FECHA_CREACION_CASO']."</strong> <br>
                                                    <div class='mt-3' >
                                                         <a href='casos_gene.php'><input  type='button' class='btn btn-success' value='Ir a los casos solicitados'></a>
                                                    </div>
                                                </div>
                                            </div>"; 
    
                                        exit;
                                    }else{
                                        
                                        echo "error al isertar datos"; 
                                    
                                    }  
                                }
                        }
                 }
            }

        }

?>

        <form class="col-12 col-sm-7 mt-3 mb-5 row" method="POST"  action="new_caso.php" enctype="multipart/form-data" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; border-radius: 15px;">
            <div class="mt-2">

<?php   if(($_SESSION['rol_usuario'] == 1) || ($_SESSION['rol_usuario'] == 2)) {  ?>      

            <h6>Asignar a: </h6>
                    <select class="form-control" id="rol_user_n" name="rol_user_n" value="" required onchange="select_button()" required>
                        <option value="seleccione">Seleccione</option>
                                <?php

                                        $consulta = "SELECT * FROM u253606672_db1_proyectos.usuarios_reg WHERE COD_ROL_USUARIO = 2 OR COD_ROL_USUARIO = 1 ";
                                        $user = mysqli_query($db,$consulta);

                                        while( $rol = mysqli_fetch_assoc($user)){

                                            echo "<option value='".$rol['COD_USUARIO']."'>".$rol['NOMBRE_USUARIO']." ".$rol['APELLIDO']."</option>";
                                        }

                                ?>
                    </select>

<?php    } else{ ?>
            
            <input type="hidden" value="3" id="rol_user_n" name="rol_user_n">
    
<?php }   ?>    
            
            </div>
            <div class="mt-2">
            <h6>Asunto</h6>
                <input type="text" class="form-control" id="asunto" name="asunto" maxlength="60" value="<?php echo $asunto ?>" required>
                <div class="" style="font-size: 13px; color:red" id="errorMsg"></div>
            </div>
            <div>
            <h6>Descripcion</h6>
                <textarea class="form-control"  name="descripcion" id="descripcion" cols="30" rows="10" maxlength="3000" value="<?php echo $descripcion ?>" required></textarea>
                <div class="" style="font-size: 13px; color:red" id="errorMsg_des"></div>
            </div>
            <div class="my-3 col-sm-12 col-md-6 align-self-start row">
                <input type="file" class="form-control my-3 col-6" id="adjunto" name="adjunto" accept="image/*, .pdf, .xls, .xlsx, .docx"> 
            </div>
            <div class="my-3 py-2 col-6 align-self-start row" id="h7">
               <h7 class="">Maximo 1 MB - jpg /png /pdf /xls /csv /dock</h6>
            </div>
           <div class="mb-3  col-5  col-sm-9 col-md-5 align-self-start row">
                <input class='btn btn-success' type='submit' value="Enviar"> 
            </div>
        </form>
       </div>
    </div>
    <script src="../js/new_caso_event.js"></script> 
</seccion> <!--seccion, etiqueta de apertura en heade.php-->

<?php
include ('footer.php');
?>