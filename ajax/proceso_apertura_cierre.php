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
    $errors[] = "ID Proceso vacío";
} elseif (empty($_POST['estado'])) {
    $errors[] = "Estado vacio";
} elseif (empty($_POST['pass'])) {
  $errors[] = "contraseña vaciá";      
} else {
    
            require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	    require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	    include '../Clases/Proceso.php';
            include '../Clases/Log.php';	
            
            
            $id         = $_POST['id_proceso'];
            $estado     = $_POST['estado'];
            
            $pass       = $_POST['pass'];
            $rut_asistente=$_SESSION['rut_asistente'];
            $sql = " SELECT * FROM tbl_asistente "
                 . " WHERE rut_asistente = '$rut_asistente'"
                 . " AND estado = 1 ";

            $result_pass = sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
            
            
            if (sqlsrv_num_rows($result_pass) == 1) {
              $result_row = sqlsrv_fetch_array($result_pass);   
            
               
	if (password_verify($_POST['pass'], $result_row['clave_asistente'])) {
         
             
            $query= Proceso::aperturaCierre($id,$estado,$con);

    // if user has been added successfully
                    if ($query) {
                        $messages[] = "Proceso ejecutado Exitosamente";
                        $accion = "Proceso ejecutado $id - $estado";
                    } else {
                        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo. $query";
                        $accion = "Error al ejecutar Proceso $id - $estado";
                    }
               
                   Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);
            
   }else{
           $errors[] = "Contraseña no coincide";
           $accion = "Error al ingresar contraseña en Procesos";
           Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);
        }
            }
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