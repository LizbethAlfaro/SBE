<?php
session_start();
if (!isset($_SESSION['user_login_admin_status']) AND $_SESSION['user_login_admin_status'] != 1) {
    header("location: loginAdmin.php");
    exit;
}

// incluye  la coneccion a BD
require_once("../config/db.php");
require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
// Abre la  clase login en donde se crearan las variables de session
require_once("../Autenticacion/LoginAdmin.php");

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
		include("./navbarAdmin.php");
		include("./headAdmin.php");
  
     ?>

	
<body>

 <div class="container">
        <div class="card card-container">

            <form method="get" accept-charset="utf-8" action="acreditarBecaInterna.php" name="loginform" autocomplete="off" role="form" class="form-signin">
  
                <span class="error-rut"></span>  
                <input class="form-control" placeholder="Usuario" name="rut" id="rut" type="text"  autofocus="" required maxlength="12" onkeyup="validar(this.id)">
                <button type="submit" class="btn btn-lg btn-success btn-block btn-signin" name="login" id="submit">Buscar Alumno</button>
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



