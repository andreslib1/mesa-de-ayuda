<?php
/*echo "<pre>";
var_dump($_SESSION);
echo "</pre>";*/
include ('header.php');

if (($_SESSION['rol_usuario'] == 3)){

    echo "No se puede acceder a este sitio"; 
    
}else{

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

    <div class="col-10" style="padding-top: 67px; background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%); border-radius: 0px 15px 0px 5px;">
      <h3 class="p-4 display-5" style="font-size: 30px;"  >
        <a href="asignaciones.php" id="etiqueta">Asignaciones</a>   <!-- efecto aplicado en ../css/css-etiquetas.css -->
        <a  id="etiqueta_pri" href="">/Casos en curso</a></h3>      
      <div class="justify-content-center row">
            <div class="col-7 mt-5 mb-5 row justify-content-center" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; border-radius: 15px;">

        <?php  

                        $user = $_SESSION['cod_usuario'];
                        
                        $consult = "SELECT * FROM u253606672_db1_proyectos.casos
                                    WHERE ESTADO = 'En Curso'";

                        $consult_r =  mysqli_query($db, $consult);

        ?>


                        <table class="table-striped" style="">
                                    <thead class="text-center" >
                                            <tr style="border-bottom: solid 1px rgba(149, 157, 165, 0.8);">                              
                                                <th class="col-1 p-2">ID</th>
                                                <th class="col-5">Titulo</th>
                                                <th class="col-1" >Estado</th>
                                                <th class="col-1"> <i class="bi bi-chat-right-text" style='font-size:20px;'></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>

        <?php  


                                    while ($row = mysqli_fetch_assoc($consult_r)){
                                                                    

                                        echo "<tr class='text-center align-middle' style='border-bottom: solid 1px rgba(149, 157, 165, 0.1);'>
                                                <th>".$row['COD_CASO']."</th>
                                                <td>".$row['TITULO_CASO']."</td>
                                                <td>".$row['ESTADO']."</td> 
                                                <td>
                                                    <form method='POST' class=''>
                                                        <div id='eye'>
                                                        <a  href='historial_gen_c.php?cod_caso=".$row['COD_CASO']."'><i class='bi bi-eye' style='font-size:25px; color:black;'></i></a></div>
                                                    </td>
                                                    </form>
                                                </tr>";
                                    }             
                                            
        ?>                    

                                    </tbody>
                        </table>
            </div>
        </div>
    </div>
</seccion> <!--seccion, etiqueta de apertura en heade.php-->
                        
<?php
}
include ('footer.php');
?>