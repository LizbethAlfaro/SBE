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
if (empty($_POST['id_proceso'])) {
    $errors[] = "ID de Proceso vacío";
}  elseif (empty($_POST['fecha_inicio'])) {
    $errors[] = "fecha inicio vaciá";
} elseif (empty($_POST['fecha_termino'])) {
    $errors[] = "fecha termino vaciá";  
} else {
    
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	    require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	    include '../Clases/Proceso.php';
            include '../Clases/Log.php';	
            
            
            $id         = $_POST['id_proceso'];
            $inicio     = $_POST['fecha_inicio'];
            $termino    = $_POST['fecha_termino'];
            
              
                    $query = Proceso::editarProceso($id,$inicio,$termino,$con);

                    // if user has been added successfully
                    if ($query) {
                        $messages[] = "Fecha de proceso registrada exitosamente";
                        $accion = "Registro de fecha de proceso $id - $inicio - $termino";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo. $query";
                        $accion = "Error al cambiar fecha de proceso $id";
                    }
               
                   Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);
      
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