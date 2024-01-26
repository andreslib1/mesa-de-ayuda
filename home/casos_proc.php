<?php
/*echo "<pre>";
var_dump($_SESSION);
echo "</pre>";*/
include ('../conexion.php');
include ('header.php');
?>
<style>

    #eye{

    }

    #eye:hover {
    color: green; 
    transform: scale(1.1); 
    transition: transform .2s;
    cursor: pointer;
    }


</style>



    <div class="col-9 col-sm-10" style="padding-top: 67px; background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%); border-radius: 0px 15px 0px 5px;">
    <h3 class="p-2 p-sm-4  display-5" style="font-size: 30px;"  >
        <a href="home.php" id="etiqueta">Inicio</a>   <!-- efecto aplicado en ../css/css-etiquetas.css -->
        <a style="text-decoration: none;" id="etiqueta_pri" href="">/Casos en proceso</a></h3> 
    <div class="justify-content-center row">
    
        <div class="col-9 mt-2 mb-sm-5 row justify-content-center" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; border-radius: 15px;" id="tables">

<?php 

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                    $cod_new_user = $_POST['users_tec'];
                    $codi_caso = $_POST['codi_caso'];
                    

                    $consult_ab = "SELECT * FROM baseuno.casos_tec
                    WHERE COD_CASO_ATEN = $codi_caso";
    
                    $user_ab = mysqli_query($db,$consult_ab);
                    $rol_ab = mysqli_fetch_assoc($user_ab);


                    $consult = "UPDATE baseuno.casos_tec SET COD_CASO_ATEN = $codi_caso, COD_USUARIO_TECNICO = $cod_new_user WHERE COD_CASO_ASIG = ".$rol_ab['COD_CASO_ASIG']."";

                    $consult_r =  mysqli_query($db, $consult);

                    if ($consult_r){

                        echo "<div class='alert alert-primary mt-2' role='alert'> Se ha asignado el caso correctamente.</div>"; 

                    }else{

                        echo "<div class='alert alert-warning mt-2' role='alert'> Se ha producido un error al altualizar los datos.</div>"; 
                    }
           }

?>

<?php  

                $user = $_SESSION['cod_usuario'];
                
                $consult = "SELECT * FROM baseuno.casos
                            INNER JOIN baseuno.casos_tec
                            ON casos.COD_CASO = casos_tec.COD_CASO_ATEN
                            WHERE casos_tec.COD_USUARIO_TECNICO = $user
                            AND ESTADO = 'En curso' OR ESTADO ='Pendiente'";

                $consult_r =  mysqli_query($db, $consult);

 ?>


                <table class="table-striped" style="">
                            <thead class="text-center" >
                                    <tr style="border-bottom: solid 1px rgba(149, 157, 165, 0.8);">                              
                                        <th class="col-1 p-2">ID</th>
                                        <th class="col-5">Titulo</th>
                                        <th class="col-1" >Estado</th>
                                        <th class="col-1"> <i class="bi bi-chat-right-text custom-icon"></i></th>
                                    </tr>
                                </thead>
                                <tbody>

<?php  


                            while ($row = mysqli_fetch_assoc($consult_r)){
                                                             
                                
                                 echo "<tr class='text-center align-middle' style='border-bottom: solid 1px rgba(149, 157, 165, 0.1);'>
                                          <th>".$row['COD_CASO']."</th>
                                          <td id='limitar_texto'>".$row['TITULO_CASO']."</td>
                                          <td>".$row['ESTADO']."</td> 
                                          <td>
                                            <form method='POST' class=''>
                                                <div id='eye'>
                                                <a  href='seguimiento_tec.php?cod_caso=".$row['COD_CASO']."&cod_user_tecnico=".$user."'><i class='bi bi-eye custom-icon' ></i></a></div>
                                               </td>
                                            </form>
                                           </tr>";
                                        }     
                                      
 ?>                    
                        </tbody>
                </table>
       </div>
    </div>

</seccion> <!--seccion, etiqueta de apertura en heade.php-->

<?php
include ('footer.php');
?>