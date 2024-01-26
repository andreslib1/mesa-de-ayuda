<?php
require ('conexion.php');

$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $usuario = $_POST['usuario'];
    $contraseña = $_POST['login_contraseña'];

// var_dump($_POST);

// verifica usuario, contraseña y si se encuenta activo 

$query = "SELECT * FROM u253606672_db1_proyectos.usuarios_reg  
WHERE CORREO = '$usuario'";

$consult =  mysqli_query($db, $query);
$row = mysqli_fetch_assoc($consult);

if($row != '' ) {

    if(!$usuario){
                                
        $errores[] = "Debes ingresar el correo";
    }

    if(!$contraseña){
        
        $errores[] = "Ingresa la contraseña";
    }

	
	if ($row['ESTADO_USUARIO'] == 'Inactivo'){

			$errores[] = "La cuenta se encuentra deshabilitada";
			
		}
		

    if (empty($errores)){


                
                    $autenticacion  = password_verify($contraseña,$row['PASSWORD']); //verifica que el password ingresado sea correcto o no
                    



                    if ($autenticacion){

                             session_start();

							 $_SESSION['cod_usuario'] = $row['COD_USUARIO'];
                             $_SESSION['nom_usuario'] = $row['NOMBRE_USUARIO'];
                             $_SESSION['ape_usuario'] = $row['APELLIDO'];
							 $_SESSION['rol_usuario'] = $row['COD_ROL_USUARIO'];
                             $_SESSION['login'] = true ; 

                             header('Location: home/home.php');
                             
                            }else{

                                $errores[] = "La contraseña es incorrecta"; 
                            }
            
     }
	  }else{
         
		$errores[] = "El usuario no existe";
            
	  }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<!-- CSS only -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script language="javascript" src="js/jquery-3.6.1.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> 
	<link href="style_index.css" rel="stylesheet" type="text/css">
	<link href="input_index.css" rel="stylesheet" type="text/css">
	<link rel="icon" href="img/logo_titulo.png" type="image/x-icon">
    <title>Inicio help desk</title>
</head>
<body >
<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="imagenes/logo.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container mt-4">
					<form style="" method="post">
						<div class="mb-3">
							<i class="p-1 bi bi-person-fill"></i>
							<input type="text" id="usuario" name="usuario" class="input_login" value="" placeholder="Usario" required>
						</div>
						<div class="mb-4">
							<i class="p-1 bi bi-key-fill"></i>
							<input type="password" id="login_contraseña" name="login_contraseña" class="input_login" value="" placeholder="Contraseña" required>
						</div>
							<div class="d-flex justify-content-center mt-3 login_container">
								<input type="submit" name="" class="btn btn-light" style="border: 1px solid rgb(0, 0, 0,0.5);" value="Ingresar">
				   			</div>

					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
					¿No tienes cuenta?&nbsp; <a type="text" class="registrarse"  data-bs-toggle="modal" data-bs-target="#registro_usuario">Registrarse</a>  <!-- Ejecucion de modal -->
					</div>

							<!-- Modal registro-->
				 			<form action="" method="post">
							<div class="modal fade" id="registro_usuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Registro de usuario</h5>
									<button id="close-btn2" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
									<div class="modal-body">
										<div>
											<h6>Nombres</h6>
											<input type="text" class="form-control" id="nombre" required>
										</div>
										<div>
											<h6>Apellidos</h6>
											<input type="text" class="form-control" id="apellido" required>
										</div>
										<div class="mt-3">
											<h6>Correo institucional</h6>
											<input type="text" class="form-control" id="correo" required value="@usta.edu.co">
										</div>
										<div class="mt-3">
											<h6>Dependencia</h6>
											<input type="text" class="form-control" id="dependencia" required>
										</div>
										<div class="mt-3">
											<h6>Ubicacion (Piso y Sede)</h6>
											<input type="text" class="form-control" id="ubicacion" required>
										</div>
										<div class="mt-3">
											<h6>Cargo</h6>
											<input type="text" class="form-control" id="cargo" required>
										</div>
										<div class="mt-3">
											<h6>Contraseña</h5>
											<input type="password" class="form-control" id="contraseña" required>
										</div>
										<div class="mt-3">
											<h6>Confirmar contraseña</h5>
											<input type="password" class="form-control" id="conf_contraseña" required>
										</div>
									</div>
									<div class="modal-footer">
										<!--la ejecucion del boton "Registrarce" se encuentra en js/index_event.js -->
										<input id="btn-registro" type="submit" class="btn btn-primary" value="Registrarce"> 
									</div>
									<div class="row justify-content-center" id="res_registro"> <!-- respuesta de errores en el formulario -->
									</div>
								</div>
							</div>
							</div>
							</form>
		
					<div class="d-flex justify-content-center ">
						<a type="text" class="registrarse"  data-bs-toggle="modal" data-bs-target="#recu_contraseña">Restablecer contraseña</a>  <!-- Ejecucion de modal -->
					</div>

							<!-- Modal recuperar contraseña-->

							<div class="modal fade" id="recu_contraseña" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Recuperar contraseña</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-btn"></button>
								</div>
								<div class="modal-body">
									<div>
										<h6>Ingresa tu correo electronico institucional</h6>
										<input type="text" id="correo_rec"class="form-control" placeholder="" required>
									</div>
								</div>
								<div class="modal-footer">
									
								<!--la ejecucion del boton "Recuperar contraseña" se encuentra en js/index_event.js -->
									<button type="button" class="btn btn-primary" id="recuperar-btn">Recuperar contraseña</button>
									</div>
										<div class="row justify-content-center" id="respuesta_pass"> <!-- respuesta al dar click en recuperar contraseña -->
									</div>
									<div class="d-flex justify-content-center">
										<div id="spinner"  class="p-3" style="display:none" >
											<div class="sk-chase" >
												<div class="sk-chase-dot"></div>
												<div class="sk-chase-dot"></div>
												<div class="sk-chase-dot"></div>
												<div class="sk-chase-dot"></div>
												<div class="sk-chase-dot"></div>
												<div class="sk-chase-dot"></div>
											</div>
										</div>
										<style>
											.sk-chase {
											width: 40px;
											height: 40px;
											position: relative;
											animation: sk-chase 2.5s infinite linear both;
											}

											.sk-chase-dot {
											width: 100%;
											height: 100%;
											position: absolute;
											left: 0;
											top: 0; 
											animation: sk-chase-dot 2.0s infinite ease-in-out both; 
											}

											.sk-chase-dot:before {
											content: '';
											display: block;
											width: 25%;
											height: 25%;
											background-color: #0094EE;
											border-radius: 100%;
											animation: sk-chase-dot-before 2.0s infinite ease-in-out both; 
											}

											.sk-chase-dot:nth-child(1) { animation-delay: -1.1s; }
											.sk-chase-dot:nth-child(2) { animation-delay: -1.0s; }
											.sk-chase-dot:nth-child(3) { animation-delay: -0.9s; }
											.sk-chase-dot:nth-child(4) { animation-delay: -0.8s; }
											.sk-chase-dot:nth-child(5) { animation-delay: -0.7s; }
											.sk-chase-dot:nth-child(6) { animation-delay: -0.6s; }
											.sk-chase-dot:nth-child(1):before { animation-delay: -1.1s; }
											.sk-chase-dot:nth-child(2):before { animation-delay: -1.0s; }
											.sk-chase-dot:nth-child(3):before { animation-delay: -0.9s; }
											.sk-chase-dot:nth-child(4):before { animation-delay: -0.8s; }
											.sk-chase-dot:nth-child(5):before { animation-delay: -0.7s; }
											.sk-chase-dot:nth-child(6):before { animation-delay: -0.6s; }

											@keyframes sk-chase {
											100% { transform: rotate(360deg); } 
											}

											@keyframes sk-chase-dot {
											80%, 100% { transform: rotate(360deg); } 
											}

											@keyframes sk-chase-dot-before {
											50% {
												transform: scale(0.4); 
											} 100%, 0% {
												transform: scale(1.0); 
											} 
											}
										</style>
									</div>
								</div>
								</div>
							</div>
							</div>
							
							<script type="application/javascript">


							</script>
					<?php  foreach($errores as $error){

						echo "<div style='color: red; text-align:center; margin:8px;'>".$error."</div>";

					} ?>
				</div>


			</div>
		</div>
	</div>
	<script src="js/index_event.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>