<?php
require ('conexion.php');

/*echo "<pre>";
var_dump($_GET);
echo "</pre>";*/

if($_SERVER['REQUEST_METHOD'] === 'GET'){

   $correo = $_GET['correo']; 
   $token = $_GET['token'];

            $query_tr = "SELECT * FROM u253606672_db1_proyectos.usuarios_reg WHERE TOKEN ='".$token."' AND CORREO ='".$correo."'";

            $consulta_tr = mysqli_query($db,$query_tr);

            $row_tr = mysqli_fetch_assoc($consulta_tr); 

    if (isset($row_tr)){

   
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <script language="javascript" src="js/jquery-3.6.1.min.js"></script>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> 
                <title>Restablecer contraseña</title>
            </head>
            <body class="" style="background-image: linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%); min-height: 100vh;">
                <section class="container d-flex justify-content-center">
                    <div class="col-5 mt-4 p-3" style="border-radius: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                    <form method="POST" action="restablecer_pass2.php" enctype="multipart/form-data">
                        <p class="display-6 fs-2">Restablecimiento de contraseña</p>
                        <h5 class="display-6 fs-5">Nueva contraseña</h5>
                        <input type="password" id="pass" name="pass"  class="form-control">
                        <h5 class="mt-3 display-6 fs-5">Confirmar contraseña</h5>
                        <input type="password"  id="conf_pass" name="conf_pass" class="form-control">  
                        <!--input ocultos para envio por medio de post-->  
                        <?php
                        echo "<input type='hidden' class='' name='correo' value='".$correo."'>";
                        echo "<input type='hidden' class='' name='token' value='".$token."'>";
                        ?>
                        <input type="submit" class="btn btn-primary mt-3" value="Confirmar">
                        

                    </form>
                </section>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            </body>
            </html>
<?php
        }else{

            echo "Esta sitio no es valido"; 
            
    }
}
/*
echo "<pre>";
var_dump($_GET);
echo "</pre>";*/