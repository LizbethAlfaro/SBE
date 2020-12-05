<?php
include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../libraries/password_compatibility_library.php");
}		
		if (empty($_POST['mod_id'])){
			$errors[] = "ID vacío";
		}  elseif (empty($_POST['pass-nueva']) || empty($_POST['pass-repetir'])) {
            $errors[] = "Contraseña vacía";
        } elseif ($_POST['pass-nueva'] !== $_POST['pass-repetir']) {
            $errors[] = "la contraseña y la repetición de la contraseña no son lo mismo";
        } elseif (strlen($_POST['pass-nueva']) < 6) {
            $errors[] = "La contraseña debe tener como mínimo 6 caracteres";
        }  elseif (
			 !empty($_POST['mod_id'])
			&& !empty($_POST['pass-nueva'])
            && !empty($_POST['pass-repetir'])
            && ($_POST['pass-nueva'] === $_POST['pass-repetir'])
        ) {
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	    require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	    include '../Clases/Estudiante.php';	
            include '../Clases/Log.php';	
            $rut= $_POST['mod_id'];
	    $clave = $_POST['pass-nueva'];
            $clave_hash = password_hash($clave, PASSWORD_DEFAULT);
					
               
					// write new user's data into database
              
                    $query = Estudiante::editarClave($rut,$clave_hash,$con);

                    // if user has been added successfully
                    if ($query) {
                        $messages[] = "contraseña ha sido modificada con éxito.";
                             $accion = "Cambio de contraseña a $rut";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
                             $accion = "Error al cambiar contraseña a $rut";
                    }
                
               
                    Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);
            
        } else {
            $errors[] = "Un error desconocido ocurrió.";
        }
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>