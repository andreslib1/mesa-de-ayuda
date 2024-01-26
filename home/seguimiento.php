<?php
/*echo "<pre>";
var_dump($_SESSION);
echo "</pre>";*/
include ('../conexion.php');
include ('header.php');


/*_____________________________________________________ Vista de usuario quien solisita_____________________________________________________*/


$cod_user = $_GET['cod_user_solicita']; //se trae este dato para poder ubicar los comentarios del solicitante al lado  izquierdo
$cod_caso = $_GET['cod_caso'];

$consulta_e = "SELECT * FROM baseuno.casos
INNER JOIN baseuno.casos_tec
ON casos.COD_CASO = COD_CASO_ATEN
INNER JOIN baseuno.usuarios_reg
ON usuarios_reg.COD_USUARIO = COD_USUARIO_TECNICO
WHERE casos.COD_CASO = $cod_caso"; 


$query_e =  mysqli_query($db, $consulta_e);

$row_e = mysqli_fetch_assoc($query_e);



$consulta_f = "SELECT * FROM baseuno.casos
WHERE casos.COD_CASO = $cod_caso"; 

$query_f =  mysqli_query($db, $consulta_f);
$row_f = mysqli_fetch_assoc($query_f);

?>

<!-- Olculta la barra de desplazamiento en los coentarios --> 

<style> 

::-webkit-scrollbar {
display: none;
}

</style>


  <div class="col-9 col-sm-10" style="padding-top: 67px; background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%); border-radius: 0px 15px 0px 5px;">
  <h3 class="p-2 p-sm-4 display-5" style="font-size: 25px;"  >
        <a href="home.php" id="etiqueta">Inicio</a>   <!-- efecto aplicado en ../css/css-etiquetas.css -->
        <a style="text-decoration: none;" id="etiqueta" href="casos_gene.php">/Casos generados</a></h3> 
     <div class="justify-content-center row">
    
        <div class="col-12 col-sm-7 mt-3 mb-5 row justify-content-center" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; border-radius: 15px;">
            <div class="col-11 mt-3 mb-1" id="div_scroll" style="border: 1px solid black; height: 500px; border: 1px solid rgba(149, 157, 165, 0.2); overflow-y: scroll;">

            <?php


            //Añade el seguimiento realizado en el comentario enviado por post

                if($_SERVER['REQUEST_METHOD'] === 'POST'){

                    $seguimiento = $_POST['seguimiento'];
                    $user_segui = $_SESSION['cod_usuario'];
                    $adjunto = $_FILES['adjunto'];

                    if($adjunto ['name'] != ''){    //validacion si existe archivo adjunto, si es verdadero , toma los ultimos caracteres para saber su extencion , se cambia en nombre, se sube al servidor web y el nombre a la base de datos.
                        
                        $medida = 10000 * 100; // 1 mb

                        if ($adjunto['size'] > $medida ){
        
                            echo "<div class='col-3 mt-3 alert alert-warning' style='position: fixed;' role='alert'>El archivo adjunto es muy pesado, maximo 1MB.</div>"; 
        
                        }else{
                        
                            $consult = "SELECT MAX(COD_IMAGEN) FROM baseuno.imagen_adj";

                            $consult_r =  mysqli_query($db, $consult);
                
                            $row = mysqli_fetch_assoc($consult_r);
                
                            $cod_imagen = $row['MAX(COD_IMAGEN)'] + 1;


                            
                            $tipo_archivo = substr($adjunto['name'], -5);    

                            $nom_archivo = md5(uniqid(rand(),true));

                            move_uploaded_file($adjunto['tmp_name'],'adjunto/'.$nom_archivo.$tipo_archivo);

                            $insert_b = "INSERT INTO baseuno.imagen_adj (COD_IMAGEN, COD_CASO_IMA, DESCRIPCION, TIPO_ADJUNTO)   
                                        VALUES ($cod_imagen, $cod_caso, '".$nom_archivo.$tipo_archivo."', 'seguimiento')"; 
                            
                            $insert_a = "INSERT INTO baseuno.seguimiento (COD_CASO_SEGUI, COD_USUARIO_SEGUI, DESCRIPCION_SEGUI, FECHA_SEGUIMIENTO, COD_IMAGEN) 
                            VALUES ($cod_caso, $user_segui, '$seguimiento', NOW(), $cod_imagen)";
                            
                            $query_b =  mysqli_query($db, $insert_b);    
                            $query_a =  mysqli_query($db, $insert_a); 

                                if(!$query_b || !$query_a){

                                    echo "No se pudo insertar el seguimiento, error base de datos";
                                }
                            }

                    }else{


              
                    $insert_a = "INSERT INTO baseuno.seguimiento (COD_CASO_SEGUI, COD_USUARIO_SEGUI, DESCRIPCION_SEGUI, FECHA_SEGUIMIENTO) 
                    VALUES ($cod_caso, $user_segui, '$seguimiento', NOW())";

                    $query_a =  mysqli_query($db, $insert_a);  

                        if(!$query_a){

                            echo "No se pudo insertar el seguimiento, error base de datos";
                        }

                    }

                }

                //Me Trae todos los seguimientos realizados en el caso

               
                $consult_b = "SELECT * 
                                FROM baseuno.seguimiento
                                INNER JOIN baseuno.usuarios_reg
                                ON seguimiento.COD_USUARIO_SEGUI = usuarios_reg.COD_USUARIO
                                WHERE seguimiento.COD_CASO_SEGUI = $cod_caso
                                ORDER BY seguimiento.COD_SEGUIMIENTO ASC";
                


                $query_C =  mysqli_query($db, $consult_b);


                while( $row = mysqli_fetch_assoc($query_C)){

                        if($_SESSION['cod_usuario'] == $row['COD_USUARIO_SEGUI']){    //validacion para diferenciar los seguimientos, zona izquierda quien solicita y derecha quien atiende el caso. 



                    
                        echo "<div class='col-md-7 my-3 mx-1 w-100'> 
                            <i class='col-1 bi bi-person m-1' style='font-size: 28px;'></i><strong class='m-2'>".$row['NOMBRE_USUARIO']." ".$row['APELLIDO']."</strong>
                            <p class='col-3 align-self-center mx-2' style='font-size: 13px;'>".$row['FECHA_SEGUIMIENTO']."</p>
                            <div class='col-md-7 p-3' style='box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px; border-radius: 15px; background-image: linear-gradient(to top, #e6e9f0 0%, #eef1f5 100%);'>
                             
                                        
                            ".$row['DESCRIPCION_SEGUI']."

                            </div>
                        </div>";

                    }else{ 


                        
                        echo "<div class='col-md-7 row my-3 mx-1 w-100 justify-content-end'> 
                                    <div class='d-flex justify-content-end'>
                                        <strong class='m-2 align-self-end'>". $row['NOMBRE_USUARIO']." ". $row['APELLIDO']."</strong><i class='bi bi-person-circle' style='font-size:28px;'></i>
                                    </div>
                                    <p class='text-end ' style='font-size: 13px;'>".$row['FECHA_SEGUIMIENTO']."</p>
                                    <div class='col-md-7 p-3' style='box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px; border-radius: 15px; background-image: linear-gradient(to top, #e6e9f0 0%, #eef1f5 100%);'>
                                    
                                                
                                    ".$row['DESCRIPCION_SEGUI']."
                
                                    </div>
                             </div>";
                    
                        }
                    }
                
                // condicion para dehabilitar envio de datos cuando el caso esta cerrado
                    
                $disabled = '';
                $estado_caso = '';
                $evaluar = '';


                if ($row_e){

                        if ($row_e['ESTADO'] == 'Cerrado'){

                            $disabled = 'disabled';

                  // consulta para saber si el caso ha sido evaluado o no 
                            
                            $consulta_k = "SELECT * FROM baseuno.encuesta
                                            where encuesta.COD_CASO_ENCUESTA = $cod_caso";
                            
                            $query_k =  mysqli_query($db, $consulta_k);

                            $row_k = mysqli_fetch_assoc($query_k);

                            if ($row_k){

                                $evaluar = '<button type="button" class="btn btn-warning col-4" disabled >Evaluado <i class="bi bi-hand-index-thumb"></i></button>';
                               

                            }else{

                                $evaluar = '<button type="button" class="btn btn-warning col-4" data-bs-toggle="modal" data-bs-target="#evaluar">Evaluar <i class="bi bi-hand-index-thumb"></i></button>';
                            }

                            
                        }
                        // condicion para clasificar el color del estado del caso

                        switch ($row_e['ESTADO']) {
                            case 'Nuevo':
                                $estado_caso = "#94DA72";
                                break;
                            case 'En Curso':
                                $estado_caso = "#39C348";
                                break;
                            case 'Pendiente':
                                $estado_caso = "#DAB84D";
                                break;
                            case 'Cerrado':
                                $estado_caso = "#D6D6D6";
                                break;
                        }
                }

?>
 
            </div>
            <form class="row my-2" method="post" action=""  enctype="multipart/form-data" style="background-color: #E5E8E8; border-radius: 5px;">
                <div class="m-1 m-sm-4 row">
                    <div class="col-9 d-flex align-items-center">
                        <i class="bi bi-fonts m-2"></i><textarea  required class="form-control" type="text" id="seguimiento" name="seguimiento" placeholder="seguimiento..." <?php echo $disabled; ?>></textarea>
                    </div>
                    <div class="col-1 d-flex">
                        <button class="btn btn-light" type="submit" style="height: 50px;" <?php echo $disabled; ?> ><i class="bi bi-send"></i></button>
                    </div>
                    <div class="m-2 px-0 px-sm-3 col-12 col-sm-6 d-flex">
                        <input type="file" id="adjunto" name="adjunto" class="form-control mx-4" <?php echo $disabled; ?> accept="image/*, .pdf, .xls, .xlsx, .docx">
                        
                        <?php echo $evaluar ; ?> 

                    </div>
                </div>
            </form>

             <!-- Modal de evaluacion -->

              <div class="modal fade" id="evaluar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Evaluar</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <form class="modal-body" method="POST" action="calificacion.php">
                                        <div class="p-2">
                                            <textarea class="form-control" type="text" id="evaluacion" maxlength="250" name="evaluacion" placeholder="comentario..." ></textarea><br>
                                        </div>
                                        <div class="ps-2">
                                            <a class="ms-2" style="color: black;">Calificacion</a> 
                                            <p class="clasificacion">
                                                <input id="radio1" type="radio" name="estrellas" value="5"><!--
                                                --><label for="radio1">★</label><!--
                                                --><input id="radio2" type="radio" name="estrellas" value="4"><!--
                                                --><label for="radio2">★</label><!--
                                                --><input id="radio3" type="radio" name="estrellas" value="3"><!--
                                                --><label for="radio3">★</label><!--
                                                --><input id="radio4" type="radio" name="estrellas" value="2"><!--
                                                --><label for="radio4">★</label><!--
                                                --><input id="radio5" type="radio" name="estrellas" value="1"><!--
                                                --><label for="radio5">★</label>
                                            </p>
                                         </div>
                                            <style>
                                                
                                                label {
                                                    font-size: 25px;
                                                     
                                                }
                                                
                                                                                           
                                                #form {
                                                width: 250px;
                                                margin: 0 auto;
                                                height: 50px;
                                                }

                                                #form p {
                                                text-align: center;
                                                }

                                                #form label {
                                                font-size: 35px;
                                                }

                                                input[type="radio"] {
                                                display: none;
                                                }

                                                label {
                                                color: grey;
                                                }

                                                .clasificacion {
                                                width: 110px;
                                                direction: rtl;
                                                unicode-bidi: bidi-override;
                                                }

                                                label:hover,
                                                label:hover ~ label {
                                                color: orange;
                                                }

                                                input[type="radio"]:checked ~ label {
                                                color: orange;
                                                }
                                            </style>
                                        <div class="modal-footer">
                                            <input type="hidden" id="cod_caso" name="cod_caso" value="<?php echo $cod_caso ?>">
                                            <input class="btn btn-primary" type="submit" value="Evaluar">
                                        </div>
                                </form>

                            </div>
                        </div>
                </div>
        </div>


       <div class="col-12 col-md-3 mt-5 mb-5 row mx-5 h-50" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; border-radius: 15px; border: 1px solid rgba(149, 157, 165, 0.1); height: 180px;">
            <div class="mt-2">
                <p class="display-6" style="font-size: 26px;">Persona a cargo del caso</p>
            </div>
            <div class="col-3 col-sm-3 h-80 text-center">
                 <i class="bi bi-person-circle" style="font-size:50px;"></i>
            </div>
            <div class="col-9 row align-items-center">
                <p class="col-sm-5 display-5" style="font-size:15px;"><?php if ($row_e){ echo $row_e['NOMBRE_USUARIO']." ".$row_e['APELLIDO']; }else{ echo "El caso se encuentra en cola";}?> <br>
                    <?php if ($row_e) {echo $row_e['CARGO'];} else { echo "-";} ?><br>
                    <?php if ($row_e) {echo $row_e['CORREO'];} else{ echo "-";} ?>
                </p>
            </div>
            <div class="my-1" style="max-height: 370px; overflow-y: scroll;">
            <p class="display-6 overflow-y: scroll;" style="font-size: 26px;">Descripcion del caso #<?php if ($row_e) {echo $row_e['COD_CASO'];} else { echo "";} ?></p> <p class="text-center col-6 col-sm-4" style="border-radius:15px;  background-color:<?php echo $estado_caso; ?>;"> <?php if ($row_e){ echo "Caso ".$row_e['ESTADO']; }else{ echo "-"; } ?></p>
            <?php if($row_e){ echo $row_e['DESCRIPCION_CASO'];} else {echo $row_f['DESCRIPCION_CASO'];} ?> <br> 

<?php
// consulta para llamar el archivo adjunto de la descripcion

            $consulta_f = "SELECT DESCRIPCION FROM baseuno.casos
                                INNER JOIN baseuno.usuarios_reg
                                ON casos.COD_USUARIO_SOLICITA = usuarios_reg.COD_USUARIO
                                INNER JOIN baseuno.imagen_adj
                                ON casos.COD_CASO = imagen_adj.COD_CASO_IMA
                                WHERE COD_CASO = $cod_caso
                                AND TIPO_ADJUNTO = 'caso'"; 

            $query_f =  mysqli_query($db, $consulta_f);

            $row_f = mysqli_fetch_assoc($query_f);

            if ($row_f){

                echo "<a  id='adj' target='_blank' href='adjunto/".$row_f['DESCRIPCION']."'> <i class='bi bi-paperclip'></i> Ver archivo adjunto en el caso</a>";

            }
?>
            </div>
            <div class="my-2" style="max-height: 150px; overflow-y: scroll;">
                <p class="display-6" style="font-size: 26px;">Adjuntos en los seguimientos</p>
                <div class="" style="max-height: 100px; overflow-y: scroll;">
            <style>
                #adj{
                    color: black;
                    
                    
                }
                #adj:hover{
                    color: var(--bs-link-color);
                    font-weight: 500;

                }
            </style>
<?php

// consulta para llamar los documentos adjuntos en los seguimientos 

            $consulta_y = "SELECT * FROM baseuno.seguimiento
                            INNER JOIN baseuno.imagen_adj 
                            ON seguimiento.COD_IMAGEN = imagen_adj.COD_IMAGEN 
                            WHERE COD_CASO_SEGUI = $cod_caso
                            ORDER BY COD_SEGUIMIENTO ASC"; 

            $query_y =  mysqli_query($db, $consulta_y);

            $i = 1;

            while ($row_y = mysqli_fetch_assoc($query_y)){

                echo "<a  target='_blank' id='adj' href='adjunto/".$row_y['DESCRIPCION']."'><i class='bi bi-paperclip'></i> Adjunto ".$i." (".substr($row_y['DESCRIPCION'], -4).")</a> <br>";
                
                $i++;
            } ;
?>
                </div>
            </div> 
       </div>
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
include ('footer.php');
?>