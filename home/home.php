<?php
/*echo "<pre>";
var_dump($_SESSION);
echo "</pre>";*/
include ('../conexion.php');
include ('header.php');

$consult_a = "SELECT * FROM baseuno.usuarios_reg";

$query_a =  mysqli_query($db, $consult_a);
$row = mysqli_fetch_assoc($query_a)


?>
    <div class="col-9 col-sm-10" style="padding-top: 67px; background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%); border-radius: 0px 15px 0px 5px;">
    <h3 class="p-2 p-sm-4 display-5" style="font-size: 30px;" ><a id="inicion_text">Inicio</a> </h3>
    <div class="justify-content-center row">


        <div class="col-9 mt-3 mb-5 row justify-content-center" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
            <div class="col-sm-3 text-center m-3" id="caso" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <a href="new_caso.php" style="color: black;"><i class="bi bi-send-plus" style="font-size:80px; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px; border-radius: 15px;"></i>
                <h5> Crear caso </h5></a>  
            </div>

                <style>

                      #caso{
                        opacity: 0.5; 
                    }

                        #caso:hover {
                        opacity: 1; 
                        transform: scale(1.05); 
                        transition: transform .2s;
                        cursor: pointer;
                        
                        }

                </style>


            <div class="col-sm-3 text-center m-3" id="caso" data-bs-toggle="modal" data-bs-target="#staticBackdrop_two" data-toggle="tooltip" data-placement="top" title="Muestra el estado de los casos que has creado">
                <a href="casos_gene.php" style="color: black;"><i class="bi bi-card-checklist" style="font-size:80px; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px; border-radius: 15px;"> </i>
                </a><h5 >Mis casos generados</h5></a>
            </div>
<?php  

if (($_SESSION['rol_usuario'] == 1) || ($_SESSION['rol_usuario'] == 2)){

?>
            <div class="col-sm-3 text-center m-3" id="caso" data-bs-toggle="modal" data-bs-target="#staticBackdrop_two" data-toggle="tooltip" data-placement="top" title="Muestra los casos que estas atendiendo">
                <a href="casos_proc.php" style="color: black;"><i class="bi bi-card-list" style="font-size:80px; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px; border-radius: 15px;"> </i>
                </a><h5>Mis casos en proceso</h5></a>
            </div>

<?php } ?>
         </div>
       </div>
    </div>

</seccion> <!--seccion, etiqueta de apertura en heade.php-->

<?php
include ('footer.php');
?>