<?php
require ('autenticar.php');
require ('../conexion.php');
/*echo "<pre>";
var_dump($_SESSION);
echo "</pre>";*/


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script language="javascript" src="../js/jquery-3.6.1.min.js"></script>
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/css-etiquetas.css">
    <link rel="stylesheet" href="../css/media-q.css">
    <link rel="icon" href="../img/logo_titulo.png" type="image/x-icon">
    <title>Help Desk USTA</title>
</head>

<style>
    * {
        padding: 0;
        margin: 0;
      }
        div a{
        text-decoration: none; 
    }

        div .menu:hover {
        transform: scale(1.08); 
        transition: transform .2s;
        }

</style>

<!--Main Navigation-->
<header>

  <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-light bg-gradient fixed-top p-0 bg-danger">
    <!-- Container wrapper -->
    <div class="container-fluid">
       <!-- Brand -->
     <div class="col-3 col-sm-2 row align-items-center pt-2 ps-3 pb-1" style="background-color: #313A46; color:azure; border-bottom: 1px solid azure; border-radius: 0px 15px 0px 5px;">
            <a class="p-1 col-1 navbar-brand">
                <img src="../img/logo_usta.png" height="45" alt="logo_usta">
            </a>
            <h5 class="col-4 col-sm-4 col-md-7  ms-3 fw-normal" id="titulo_logo"> Help Desk USTA</h5>
      </div>  
      <ul class="navbar-nav ms-auto d-flex flex-row">
      <div class="dropdown">
             <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person"></i>
                    <a class="user" style="color:black"><?php echo $_SESSION['nom_usuario']." ".$_SESSION['ape_usuario'] ?></a><br>
                    <a class="display-5" style="font-size: 13px; color:black;"><?php if ($_SESSION['rol_usuario'] == 3 ){ echo "Funcionario";} else if ($_SESSION['rol_usuario'] == 2) { echo "Administrativo TIC";} else if ($_SESSION['rol_usuario'] == 1) { echo "Administrador";}?></a>
            </button>
            <ul class="dropdown-menu row" aria-labelledby="dropdownMenuButton1">
                    <li class="row"><a class="dropdown-item" href="mi_cuenta.php"><i class="bi bi-person-circle"></i> Mi cuenta</a></li>
                    <li class="row"><a class="dropdown-item" href="cerrar_sesion.php"><i class="bi bi-lock"></i> Cerra sesion</a></li>
            </ul>
      </div>
      </ul>
      </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->
</header>
<body class="">

<seccion id="sidebarMenu" class="collapse d-flex sidebar collapse bg-white col-12 row m-0" style="height:100vh;">

    <!-- contenido de sidebar -->

    <div class="position-sticky col-3 col-sm-2" style="list-style: none; background-color: #313A46; border-right: 4px solid #fdfbfb;" id="sidebar">
      <div class="list-group list-group-flush mt-4 p-4" style="color:azure;">
          <li class="pt-5 hide-text" style="color: #859DBE">Administracion</li>

          <?php
            $color = "style='color:gold; font-weight: 500;'";
            $color_pre = "style='color: #ebedee;'";
            $url = $_SERVER["REQUEST_URI"];
           
          ?>
          <!-- Las opciones se muestran dependiendo del rol del usuario -->
          
          <a href="home.php" class="menu" <?php if ((strpos($url, 'home.php') !== false) || (strpos($url, 'new_caso.php') !== false) || (strpos($url, 'casos_gene.php') !== false) || (strpos($url, 'casos_proc.php') !== false) || (strpos($url, 'seguimiento.php') !== false) || (strpos($url, 'seguimiento_tec.php') !== false)){ echo $color;}else{ echo $color_pre;} ?> ><li class="p-sm-2 my-2 my-sm-0 offset-2 hide-text"><i class="bi bi-house-door"></i> Inicio</li></a>

          <?php if ($_SESSION['rol_usuario'] == 1){ ?>

          <a href="usuarios.php" class="menu" <?php if (strpos($url, 'usuarios.php') !== false){ echo $color;}else{ echo $color_pre;}  ?>><li class="p-sm-2 offset-2 hide-text"><i class="bi bi-people"></i> Usuarios</li></a>

          <?php }?> 

          <?php if (($_SESSION['rol_usuario'] == 1) || ($_SESSION['rol_usuario'] == 2)){ ?>

          <a href="asignaciones.php" class="menu" <?php if ((strpos($url, 'asignaciones.php') !== false) || (strpos($url, 'asignaciones_asig.php') !== false) || (strpos($url, 'asignaciones_tec.php') !== false) || (strpos($url, 'asignaciones_curs.php') !== false)) { echo $color;}else{ echo $color_pre;}  ?>><li class="p-sm-2 my-2 my-sm-0 offset-2 hide-text" ><i class="bi bi-folder-symlink"></i> Asignaciones</li></a>
          
          <?php }?> 

          <a href="historial.php" class="menu" <?php if ((strpos($url, 'historial.php') !== false) || (strpos($url, 'historial_gen.php') !== false) || (strpos($url, 'historial_per_a.php') !== false) || (strpos($url, 'historial_per_s.php') !== false)) { echo $color;}else{ echo $color_pre;} ?>><li class="p-sm-2 my-2 my-sm-0 offset-2 hide-text"><i class="bi bi-journal-text"></i> Historial</li></a>

          <li class="mt-2 hide-text" style="color: #859DBE">Herramientas </li>
          <?php if ($_SESSION['rol_usuario'] == 1) {  ?>

              <a href="https://andress-organization-3.gitbook.io/untitled/" target="_blank" class="menu" <?php if (strpos($url, 'manual_user.php') !== false){ echo $color;}else{ echo $color_pre;} ?> ><li class="p-sm-2 my-2 my-sm-0 offset-2 hide-text"><i class="bi bi-book"></i> Manual de Usuario</li></a>
              
              <?php }else if ($_SESSION['rol_usuario'] == 2) {  ?>
                
                <a href="https://andress-organization-3.gitbook.io/manual-tecnico-1/" target="_blank" class="menu" <?php if (strpos($url, 'manual_user.php') !== false){ echo $color;}else{ echo $color_pre;} ?>><li class="p-sm-2 my-2 my-sm-0 offset-2 hide-text"><i class="bi bi-book"></i> Manual de Usuario</li></a>

                <?php } else if ($_SESSION['rol_usuario'] == 3) {?>

                       <a href="https://andress-organization-3.gitbook.io/manual-personal-administrativo/" target="_blank" class="menu" <?php if (strpos($url, 'manual_user.php') !== false){ echo $color;}else{ echo $color_pre;} ?>><li class="p-sm-2 my-2 my-sm-0 offset-2 hide-text"><i class="bi bi-book"></i> Manual de Usuario</li></a>
                  <?php } ?>  

      </div>
    </div>

<!-- Iconos de alertas-->
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>

<!--tamaño de los tooltip-->
<style>
.tooltip-inner {
  font-size: 11px;
}

</style>
