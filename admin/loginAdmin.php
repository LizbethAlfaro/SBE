<?php
// Verifica version minima de PHP
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("No puede correr en versiones inferiores a 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // la libreria de contraseña no funciona en versiones inferiores
    require_once("libraries/password_compatibility_library.php");
}

// incluye  la coneccion a BD
require_once("../config/db.php");
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
// Abre la  clase login en donde se crearan las variables de session
require_once("../Autenticacion/LoginAdmin.php");


// se crea el objeto login para ingresar y salir de la session de manera simple
$login = new LoginAdmin();

// evalua si se logea correctamente
if ($login->isUserLoggedInAdmin() == true) {
    //si es que se logea en direcciona a la url
   header("location: asignarHorarioSemanal.php");

} else {
    // si no se logea direcciona envia mensaje de error
    ?>
	<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title> Administracion SBE | Login </title>
  
        <!-- Jquery 2.2.4 -->
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- CSS  -->
        <link href="../css/loginAdmin.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
          <?php
             
				// muestra posibles errores
				if (isset($con)) {
    
						?>
                                                <div class="alert alert-dismissible alert-dismissible" role="alert">
                                                    <strong>Estado Conexion :</strong> <?php echo $mensaje ?>
						
						</div>
	
<body>

 <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="../img/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form method="post" accept-charset="utf-8" action="loginAdmin.php" name="loginform" autocomplete="off" role="form" class="form-signin">
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
 
        </div><!-- /card-container -->
    </div><!-- /container -->
  </body>
<?php
	include("../footer.php");
?>
  
  <script type="text/javascript" src="../js/extras/validarRut.js"></script>
  <script type="text/javascript" src="../js/funciones/estudiante.js"></script>
  <script type="text/javascript" src="../js/estudiante_page.js"></script>
</html>

	<?php
}

}
