<?php
/*echo "<pre>";
var_dump($_SESSION);
echo "</pre>";*/


include ('header.php');

if ($_SESSION['rol_usuario'] == 3){

    echo "No se puede acceder a este sitio"; 
    
}else{

?>



    <div class="col-9 col-sm-10" style="padding-top: 67px; background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%); border-radius: 0px 15px 0px 5px;">
    <h3 class="p-2 p-sm-4 p-sm-4 display-5" style="font-size: 30px;" > <a id="inicion_text">Asignaciones</a></h3>
    <div class="justify-content-center row">
        <div class="col-9 mt-3 mb-5 row justify-content-center" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;" id="tables">

 <?php   if ($_SESSION['rol_usuario'] == 1 ){ ?>  
            <div class="col-11 col-sm-3 text-center m-3" id="casos_new" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-toggle="tooltip" data-placement="top" title="Presenta los casos solicitados aun sin asignar">
            <a href="asignaciones_asig.php" style="color: black;"><i class="bi bi-folder-symlink" style="font-size:80px; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px; border-radius: 15px;"></i>
                <h5>Casos nuevos</h5></a>   
            </div>
   <?php  }else{
    
   } ?>
            
                <style>

                      #casos_new{
                        opacity: 0.5; 
                    }

                        #casos_new:hover {
                        opacity: 1; 
                        transform: scale(1.05); 
                        transition: transform .2s;
                        cursor: pointer;
                        
                        }

                </style>


            <div class="col-11 col-sm-3  text-center m-3" id="casos_new" data-bs-toggle="modal" data-bs-target="#staticBackdrop_two" data-toggle="tooltip" data-placement="top" title="Casos actualmente en curso">
            <a href="asignaciones_curs.php" style="color: black;"><i class="bi bi-repeat" style="font-size:80px; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px; border-radius: 15px;"></i>
                <h5>Casos en curso</h5></a>  
            </div>
         </div>
       </div>
    </div>

</seccion> <!--seccion, etiqueta de apertura en heade.php-->

<?php
}
include ('footer.php');

?>