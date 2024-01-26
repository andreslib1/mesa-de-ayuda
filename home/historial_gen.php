<?php
/*echo "<pre>";
var_dump($_SESSION);
echo "</pre>";*/
include ('header.php');

if (($_SESSION['rol_usuario'] == 3) || $_SESSION['rol_usuario'] == 2){

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

    <div class="col-9 col-sm-10" style="padding-top: 67px; background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%); border-radius: 0px 15px 0px 5px;">
    <h3 class="p-2 p-sm-4  display-5" style="font-size: 30px;"  >
        <a href="historial.php" id="etiqueta">Historial</a>   <!-- efecto aplicado en ../css/css-etiquetas.css -->
        <a style="text-decoration: none;" id="etiqueta_pri" href="">/Historial general</a></h3>     
         <div class="justify-content-center row">
            <div class="col-11 mt-3 mb-5 row justify-content-center" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px; border-radius: 15px;" id="tables_h">

        <?php  

                        $user = $_SESSION['cod_usuario'];
                        
                        $consult_a = "SELECT * FROM baseuno.casos
                                        INNER JOIN baseuno.usuarios_reg
                                        ON casos.COD_USUARIO_SOLICITA = usuarios_reg.COD_USUARIO
                                        LEFT JOIN baseuno.encuesta
                                        ON casos.COD_CASO = encuesta.COD_CASO_ENCUESTA

                                        WHERE ESTADO = 'Cerrado'";

                        $query_a =  mysqli_query($db, $consult_a);

        ?>


                        <table class="table-striped" style="">
                                    <thead class="text-center" >
                                            <tr style="border-bottom: solid 1px rgba(149, 157, 165, 0.8);">                              
                                                <th class="col-1 p-2">ID</th>
                                                <th class="col-3 p-2">Persona que solicita</th>
                                                <th class="col-3">Titulo del caso</th>
                                                <th class="col-1">Calificacion</th>
                                                <th class="col-1" >Estado</th>
                                                <th class="col-2" >Fecha finalizacion</th>
                                                <th class="col-1"> <i class="bi bi-chat-right-text custom-icon-h" ></i></th>
                                            </tr>
                                        </thead>
                                        <tbody>

        <?php  


                                    while ($row = mysqli_fetch_assoc($query_a)){
                                                                    

                                        echo "<tr class='text-center align-middle' style='border-bottom: solid 1px rgba(149, 157, 165, 0.1);'>
                                                <th>".$row['COD_CASO']."</th>
                                                <td>".$row['NOMBRE_USUARIO']."".$row['APELLIDO']."</td>
                                                <td id='limitar_texto'>".$row['TITULO_CASO']."</td>
                                                <td>".$row['CALIFICACION']."</td>
                                                <td>".$row['ESTADO']."</td> 
                                                <td>".$row['FECHA_FINALI_CASO']."</td> 
                                                <td>
                                                    <form method='POST' class=''>
                                                        <div id='eye'>
                                                        <a  href='historial_gen_c.php?cod_caso=".$row['COD_CASO']."'><i class='bi bi-eye custom-icon-h'></i></a></div>
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