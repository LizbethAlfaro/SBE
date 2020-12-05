<?php
// Verifica version minima de PHP
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("No puede correr en versiones inferiores a 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // la libreria de contraseña no funciona en versiones inferiores
    require_once("libraries/password_compatibility_library.php");
}

// incluye  la coneccion a BD
require_once("config/db.php");
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
// Abre la  clase login en donde se crearan las variables de session
require_once("./Autenticacion/Login.php");
include './Clases/Proceso.php';

$id="";

 $procesoQuery = Proceso::recuperarProceso($id, $con);
 if($procesoQuery){
 while ($procesoCursor = sqlsrv_fetch_array($procesoQuery)) {
     switch ($procesoCursor['id_tipo_proceso']){
         case 1:$fecha_fin  = $procesoCursor['termino'];
             break;
         case 2:$fecha_fin2  = $procesoCursor['termino'];
             break;
         
     }
 
}
}

//FECHAS PROCESOS

$fecha_actual = new DateTime(date('d-m-Y'));
//$fecha_actual = new DateTime(date('d-m-Y', strtotime('31-01-2020')));
//$fecha_actual = new DateTime(date('d-m-Y', strtotime('01-02-2020')));







if(isset($fecha_fin)){
$fecha_proceso = new DateTime($fecha_fin);   
$restante =$fecha_proceso->diff($fecha_actual);
}


if(isset($fecha_fin2)){
$fecha_proceso2 = new DateTime($fecha_fin2); 
$restante2 =$fecha_proceso2->diff($fecha_actual);    
}





//echo 'proceso '.$fecha_proceso->format('d-m-Y');
//echo '<br>';
//echo 'actual '.$fecha_actual->format('d-m-Y');

//clases para select
include './Clases/Carrera.php';
include './Clases/Genero.php';
include './Clases/Comuna.php';
include './Clases/Region.php';
include './Clases/Estudiante.php';
include './Clases/Direccion.php';
include './Clases/FechaIng.php';
include './Clases/Jornada.php';
include './Clases/Becas.php'; 
include './Clases/Scape.php';  
include './Clases/Solicitud.php';

// se crea el objeto login para ingresar y salir de la session de manera simple
$login = new Login();




// evalua si se logea correctamente
if ($login->isUserLoggedIn() == true) {

$rut_estudiante = $_SESSION['rut_estudiante'];    
$condicion = "";
$solicitud = Solicitud::recuperarSolicitud($rut_estudiante,$condicion,$con);
$solicitudArreglo;
while ($solicitudCursor = sqlsrv_fetch_array($solicitud)) {
    $solicitudArreglo = array(
        "estado"           => $solicitudCursor['estado'],
    );
}

$estado=$solicitudArreglo['estado'];
if($estado==0){
   header("location: terminosCondiciones.php");     
}else{
     
    //si es que se logea en direcciona a la url
   header("location: datosPersonales.php");   
}

    

} else {
    // si no se logea direcciona envia mensaje de error
    ?>
	<!DOCTYPE html>
<html lang="es">

  
    
<head>
<!--    <link rel="shortcut icon" type="image/x-icon" href="/img/ugm.jpg" />-->
<link rel="icon" type="image/png" href="/img/ugm.png" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title> Login | UGM </title>
  
        <!-- Jquery 2.2.4 -->
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- CSS  -->
        <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
          <?php
             
				// muestra posibles errores
				if (isset($con)) {
    
						?>
                                                <div class="alert alert-dismissible alert-dismissible" role="alert">
                                                    <strong>Estado Conexion :</strong> <?php echo $mensaje ?>
						
						</div>
	
<body>
    <!--modal-->
    <?php
            include './modal/registro_estudiante.php';
            include './modal/registro_becas_internas.php';
            
            //becas
        include './modal/informacion_beca_ugm.php';
        include './modal/informacion_beca_ugm_deportiva.php';
        include './modal/informacion_beca_ugm_alumni_hijos.php';
        include './modal/informacion_beca_ugm_funcionario_hijos.php';
        include './modal/informacion_beca_ugm_familiar.php';
        include './modal/informacion_beca_ugm_extranjero.php';
        include './modal/informacion_beca_ugm_copago_cero.php';
        include './modal/informacion_beca_ugm_socieconomica.php';
        include './modal/informacion_beca_ugm_lider_social.php';
        include './modal/informacion_beca_ugm_integracion_cultural.php';
        include './modal/informacion_beca_ugm_educativas_especiales.php';
        include './modal/informacion_beca_ugm_mantencion.php';
        include './modal/informacion_beca_ugm_alimentacion.php';
        include './modal/mensaje_proceso.php';

        ?>
    <!--modal-->
    
<!--mensaje termino de Proceso -->   
<?php                      
if(strtotime($fecha_proceso->format('d-m-Y'))< strtotime($fecha_actual->format('d-m-Y'))){
    echo 'gg';
?> 

<script>    
$( document ).ready(function() {
    $('#mensaje_proceso').modal('toggle')
});
</script>    
<?php                      
}
?>
    
 <div class="">
     <div class="container-fluid">
         
         <div class="col-sm-6">
             <div class="card card-container">
          
            <img id="profile-img" class="profile-img-card" src="img/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <table border="0" class="table">
                        <thead>
                            <?php
                            if(isset($fecha_fin)){
                         
                            if(strtotime($fecha_proceso->format('d-m-Y'))>= strtotime($fecha_actual->format('d-m-Y'))){
           
                            ?>
                            <tr>
                                <th>Fin de proceso <p style="color: black"><?php echo date('d-m-Y', strtotime($fecha_fin));?></p></th>
                                <th>Quedan <p style="color: black"><?php echo $restante->days." dias";?></p></th>
                            </tr>
                            <?php
                            }else{
                            ?>    
                            <tr>
                                <th>Proceso&nbspTerminado</th>
                           
                            </tr>
                            <?php
                            }
                            
                            }
                            ?>
                            <tr>
                                <th>Beca</th>
                                <th>Proceso</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a data-toggle="modal" href="#informacion_beca_ugm_socioeconomica">Beca Socioeconómica:</a></td>
                                <td>Postulantes y Renovantes</td>
                            </tr>
                            <tr>
                                <td><a data-toggle="modal" href="#informacion_beca_ugm_lider_social">Beca Líder Social:</a></td>
                                <td>Postulantes</td>
                            </tr>
                            <tr>
                                <td><a data-toggle="modal" href="#informacion_beca_ugm_integracion_cultural">Beca Integración Cultural:</a></td>
                                <td>Postulantes</td>
                            </tr>
                            <tr>
                                <td><a data-toggle="modal" href="#informacion_beca_ugm_educativas_especiales">Beca N. Educativas Especiales:</a></td>
                                <td>Postulantes</td>
                            </tr>
                            <tr>
                                <td><a data-toggle="modal" href="#informacion_beca_ugm_mantencion">Beca Mantención </a></td>
                                <td>Postulantes y Renovantes</td>
                            </tr>
                            <tr>
                                <td><a data-toggle="modal" href="#informacion_beca_ugm_alimentacion">Beca Alimentación:</a></td>
                                <td>Postulantes y Renovantes</td>
                            </tr>

                        </tbody>
                    </table>

            <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin">
			<?php
				// muestra posibles errores
				if (isset($login)) {
					if ($login->errors) {
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						    <strong>Error!</strong> 
						
						<?php 
						foreach ($login->errors as $error) {
							echo $error;
						}
						?>
						</div>
						<?php
					}
					if ($login->messages) {
						?>
						<div class="alert alert-success alert-dismissible" role="alert">
						    <strong>Aviso!</strong>
						<?php
						foreach ($login->messages as $message) {
							echo $message;
						}
						?>
						</div> 
						<?php 
					}
				}
				?>
  
                <span class="error-rut"></span>  
                <input class="form-control" placeholder="Usuario" name="user_name" id="rut" type="text"  autofocus="" required maxlength="12" onkeyup="validar(this.id)">
                <input class="form-control" placeholder="Contraseña" name="user_password" id="contraseña" type="password"  autocomplete="off" required>
                <button type="submit" class="btn btn-lg btn-success btn-block btn-signin" name="login" id="submit">Iniciar Sesión</button>
            </form><!-- /form -->
            
            <?php
            if(strtotime($fecha_proceso->format('d-m-Y'))>= strtotime($fecha_actual->format('d-m-Y'))){
            ?>
            <div class="form-group">
            <a class="btn  btn-success btn-block" data-toggle="modal" href="#modalEstudiante" >Registrarse</a>
            </div>
            <?php
            }
            ?>
        </div><!-- /card-container -->
        </div> 
       
         
         
         
        <div class="col-sm-6">
        <div class="card card-container" style=" margin-bottom: 40%;" >
            <img id="profile-img" class="profile-img-card" src="img/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <table border="0" class="table">
                        <thead>
                            <?php
                            if(isset($fecha_fin2)){
                            if(strtotime($fecha_proceso2->format('d-m-Y'))>= strtotime($fecha_actual->format('d-m-Y'))){    
                            ?>
                            <tr>
                                <th>Fin de proceso <p style="color: black"><?php echo date('d-m-Y', strtotime($fecha_fin2));?></p></th>
                                <th>Quedan <p style="color: black"><?php echo $restante2->days." dias";?></p></th>
                            </tr>
                            <?php
                            }else{
                            ?>    
                            <tr>
                                <th>Proceso&nbspTerminado</th>
                           
                            </tr>
                            <?php
                            }
                            
                            }
                            ?>
                            <tr>
                                <th>Beca</th>
                                <th>Proceso</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a data-toggle="modal" href="#informacion_beca_ugm">Beca UGM:</a></td>
                                <td>Postulantes y Renovantes</td>
                            </tr>
                            <tr>
                                <td><a data-toggle="modal" href="#informacion_beca_ugm_deportiva">Beca Deportiva:</a></td>
                                <td>Postulantes y Renovantes</td>
                            </tr>
                            <tr>
                                <td><a data-toggle="modal" href="#informacion_beca_ugm_alumni_hijos">Beca Alumni e Hijos:</a></td>
                                <td>Postulantes y Renovantes</td>
                            </tr>
                            <tr>
                                <td><a data-toggle="modal" href="#informacion_beca_ugm_funcionario_hijos">Beca Funcionario e Hijos:</a></td>
                                <td>Postulantes y Renovantes</td>
                            </tr>
                            <tr>
                                <td><a data-toggle="modal" href="#informacion_beca_ugm_familiar">Beca Familiar:</a></td>
                                <td>Postulantes y Renovantes</td>
                            </tr>
                            <tr>
                                <td><a data-toggle="modal" href="#informacion_beca_ugm_extranjero">Beca Extranjero:</a></td>
                                <td>Renovantes</td>
                            </tr>
                            <tr>
                                <td><a data-toggle="modal" href="#informacion_beca_ugm_copago_cero">Beca Copago Cero:</a></td>
                                <td>Renovantes</td>
                            </tr>
                        </tbody>
                    </table>
             <a class="btn  btn-success btn-block" data-toggle="modal" href="descarga.php?ruta=2" >Descarga instructivo</a>
             
            <div style="height: 50px;"></div>
            
            <?php
            if(strtotime($fecha_proceso2->format('d-m-Y'))>= strtotime($fecha_actual->format('d-m-Y'))){
            ?>
            <div class="form-group">
                <a class="btn  btn-success btn-block" data-toggle="modal" href="#registro_becas_internas" >Postula aqui!!!</a>   
            </div>
            <?php
                                }
            ?>
        </div><!-- /card-container -->
        </div>
        
     </div>     
    </div><!-- /container -->
    
  </body>
<?php
	include("footer.php");
?>
  

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  
  <script type="text/javascript" src="js/extras/validarRut.js"></script>
  <script type="text/javascript" src="js/funciones/estudiante.js"></script>
  <script type="text/javascript" src="js/funciones/comuna_becas.js"></script>
  <script type="text/javascript" src="js/estudiante_page.js"></script>
  
  <script>
 $(document).ready(function () {
    recuperarComunaBeca()
});


$("#registro_becas_internas").on('hidden.bs.modal', function () {
    
$("#rut_estudiante_beca").val("");    
$("#beca").val("");    
$("#fechaNac").val("");    
$("#email").val("");    
$("#direccion").val("");    
$("#numero").val("");    
$("#departamento").val("");    
$("#villa").val(""); 
//$("#region_beca").val(13); 
//$("#comuna_beca").val(70); 
$("#fono").val(""); 
$("#movil").val(""); 
$(".error-rut").html("");

$(".alert alert-success").html("");
$(".alert alert-error").html(""); 
$(".alert alert-info").html(""); 
});

$("#modalEstudiante").on('hidden.bs.modal', function () {
$("#rut_estudiante").val("");    
$("#password_nueva").val("");    
$("#password_repetir").val("");    
$(".error-rut").html("");

$(".alert alert-success").html("");
$(".alert alert-error").html(""); 
$(".alert alert-info").html(""); 
});


  </script>
</html>

	<?php
}

}
