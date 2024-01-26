<?php
/*echo "<pre>";
var_dump($_SESSION);
echo "</pre>";*/
include ('header.php');

if (($_SESSION['rol_usuario'] == 3) || $_SESSION['rol_usuario'] == 2){

  echo "No se puede acceder a este sitio"; 
  
}else{


?>
    <div class="col-9 col-sm-10" style="padding-top: 67px; background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%); border-radius: 0px 15px 0px 5px;">
    <h3 class="p-2 p-sm-4 display-5" style="font-size: 30px;" ><a id="inicion_text">Usuarios</a></h3>
    <div class="justify-content-center row">
        <div class="col-9 mt-3 mb-5 row justify-content-center" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
            <div class="col-sm-3 text-center m-3" id="user" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="bi bi-person-add" style="font-size:80px; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px; border-radius: 15px;"></i>
                <h5>Agregar nuevo usuario</h5>  
            </div>

                <style>

                      #user{
                        opacity: 0.5; 
                    }

                        #user:hover {
                        opacity: 1; 
                        transform: scale(1.05); 
                        transition: transform .2s;
                        cursor: pointer;
                        
                        }

                </style>

              <!-- modal agregar usuario -->

              <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Registro de nuevo usuario</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="location.reload()"></button>
                    </div>
                      <div class="modal-body row">
                        <div class="col-6">
                          <h6>Nombres</h6>
                          <input type="text" class="form-control" id="nombre" required>
                        </div>
                        <div class="col-6">
                          <h6>Apellidos</h6>
                          <input type="text" class="form-control" id="apellido" required>
                        </div>
                        <div class="mt-3 col-6">
                          <h6>Correo institucional</h6>
                          <input type="text" class="form-control" id="correo" required value="@usta.edu.co">
                        </div>
                        <div class="mt-3 col-6">
                          <h6>Dependencia</h6>
                          <input type="text" class="form-control" id="dependencia" required>
                        </div>
                        <div class="mt-3 col-6">
                          <h6>Ubicacion (Piso y Sede)</h6>
                          <input type="text" class="form-control" id="ubicacion" required>
                        </div>
                        <div class="mt-3 col-6">
                          <h6>Cargo</h6>
                          <input type="text" class="form-control" id="cargo" required>
                        </div>
                        <div class="mt-3 col-6">
                          <h6>Contraseña</h5>
                          <input type="password" class="form-control" id="contraseña" required>
                        </div>
                        <div class="mt-3 row">
                          <h6>Rol de usuario</h5>
                        <select class="form-control mx-2" id="rol_user" name="rol_user" value="" required onchange="select_button()">
                        <option value="seleccione">Seleccione</option>
                                <?php

                                        $query_two = "SELECT * FROM baseuno.rol";
                                        $select_rol = mysqli_query($db,$query_two);

                                        while( $rol = mysqli_fetch_assoc($select_rol)){

                                            echo "<option value='".$rol['COD_ROL']."'>".$rol['NOMBRE_ROL']."</option>";
                                        }

                                ?>

                         </select>
                         <div class="col-3 text-start my-4">
                           <input class="btn btn-success" type="submit" id="registro_usuario" value="Registrar usuario" disabled onclick="proceso_reg($('#nombre').val(), $('#apellido').val(), $('#correo').val(), $('#dependencia').val(), $('#ubicacion').val(), $('#cargo').val(), $('#contraseña').val(), $('#rol_user').val());return false;"> 
                        </div>

                         <script>
                         // Esta funcion permite deshabilitar el boton de registro_usuario hasta seleccionar el tipo de rol, tener en cuenta "onchange" para poder ejecutar la accion en la etiqueta html

                              function select_button(){
                              const buscar = document.getElementById('rol_user').value;
                              
                              if (buscar == 'seleccione'){
                                  document.getElementById('registro_usuario').disabled = true;
                              }else{
                                  document.getElementById('registro_usuario').disabled = false;
                              }    
                          }
                          
                         </script>

                            <div class="col-6 offset-3 mt-4 p-1" id="resultado_envi" style=""> 

                            <!-- envio de datos POST, ejecucion en new.user.php-->

                                  <script type="application/javascript">

                                        function proceso_reg(valorCaja1, valorCaja2,valorCaja3, valorCaja4,valorCaja5, valorCaja6,valorCaja7, valorCaja8){
                                        var parametros = {
                                                "nombre" : valorCaja1,
                                                "apellido" : valorCaja2,
                                                "correo" : valorCaja3,
                                                "dependencia" : valorCaja4,
                                                "ubicacion" : valorCaja5,
                                                "cargo" : valorCaja6,
                                                "contraseña" : valorCaja7,
                                                "rol_user" : valorCaja8
                                        };

                                        $.ajax({
                                                    data:  parametros,
                                                    url:   'new_user.php',
                                                    type:  'post',
                                                    success:  function (response) {
                                                    $("#resultado_envi").html(response);
                                                    }
                                        });

                                        }

                               </script>
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>

            <div class="col-sm-3 text-center m-3" id="user" data-bs-toggle="modal" data-bs-target="#staticBackdrop_two">
                <i class="bi bi-person-exclamation" style="font-size:80px; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px; border-radius: 15px;"> </i>
                <h5>Editar Usuario</h5>
            </div>

            <!-- modal editar usuario -->

            <div class="modal fade" id="staticBackdrop_two" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Editar usuario</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="location.reload()"></button>
                    </div>
                    <div class="modal-body ">
                        
                        <h6>Correo del usuario</h5>

                        <input type="text" class="form-control col-4" id="buscar" name="buscar" onkeyup="proceso_bus($('#buscar').val());return false;">
                                            
                        <!-- envio de datos POST, ejecucion en busqueda.php-->

                        <script type="application/javascript">

                        function proceso_bus(valorCaja1){
                        var parametro = {
                                "buscar" : valorCaja1,

                        };

                        $.ajax({
                                    data:  parametro,
                                    url:   'busqueda.php',
                                    type:  'post',
                                    success:  function (response) {
                                    $("#busqueda_result").html(response);
                                    }
                        });

                        }

                        </script>

                        <div class="row mt-2" id="busqueda_result"> <!-- muestra los datos del correo ingresado -->
                           
                        </div> 

                        <div class='col-3 text-start my-4'>
                         <input class='btn btn-success' type='submit' id='registro_usuario' value='Actualizar datos' onclick="proceso_edit($('#nombre_b').val(), $('#apellido_b').val(), $('#correo_b').val(), $('#dependencia_b').val(), $('#ubicacion_b').val(), $('#cargo_b').val(), $('#rol_user_b').val(), $('#est_user').val());return false;"> 
                        </div>

                        <div class="col-6 offset-3 mt-4 p-1" id="resultado_envi_edit" style=""> 

                        <!-- envio de datos POST, ejecucion en edit_user.php-->

                            <script type="application/javascript">

                                    function proceso_edit(valor1, valor2,valor3, valor4,valor5, valor6, valor7, valor8){
                                    var parametros = {
                                            "nombre_b" : valor1,
                                            "apellido_b" : valor2,
                                            "correo_b" : valor3,
                                            "dependencia_b" : valor4,
                                            "ubicacion_b" : valor5,
                                            "cargo_b" : valor6,
                                            "rol_user_b" : valor7,
                                            "est_user" : valor8
                                    };

                                    $.ajax({
                                                data:  parametros,
                                                url:   'edit_user.php',
                                                type:  'post',
                                                success:  function (response) {
                                                $("#resultado_envi_edit").html(response);
                                                }
                                    });

                                    }

                          </script>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
         </div>
       </div>
    </div>

</seccion> <!--seccion, etiqueta de apertura en heade.php-->

<?php
 }
include ('footer.php');
?>