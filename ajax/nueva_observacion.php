<?php
include('is_logged_admin.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
		
	/*Inicia validacion del lado del servidor*/
        if (empty($_POST['rut'])) {
           $errors[] = "No ha seleccionado estudiante"; 
        }elseif (empty($_POST['observacion'])) {
           $errors[] = "Observacion Vaciá";
        }elseif (empty($_POST['duplicidad'])) {
           $errors[] = "Duplicidad Vaciá";
        }elseif (empty($_POST['otro_miembro'])) {
           $errors[] = "Otro_miembro Vació";
        }elseif (empty($_POST['factor'])) {
           $errors[] = "Factor Vació";
        }elseif (empty($_POST['tramo'])) {
           $errors[] = "Tramo Vació";
        }elseif (empty($_POST['distancia'])) {
           $errors[] = "Distancia Vaciá";    
        }else{
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
                include '../Clases/Observacion.php';
                 
                $rut = $_REQUEST['rut'];
                $observacion = $_REQUEST['observacion'];
                $rut_asistente=$_SESSION['rut_asistente'];
                
                $duplicidad=$_REQUEST['duplicidad'];
                $otro_miembro=$_REQUEST['otro_miembro'];
                $factor=$_REQUEST['factor'];
                $tramo=$_REQUEST['tramo'];
                $distancia=$_REQUEST['distancia'];
                
               
                 
                $query= Observacion::registrarObservacion($rut,$rut_asistente,$observacion,$duplicidad,$otro_miembro,$factor,$tramo,$distancia,$con);
                 
                 if($query){
                  $messages[] = "Observaciones  Ingresadas con éxito.";
                 }else{
                  $errors[]= "Error al ingresar Observacion";
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