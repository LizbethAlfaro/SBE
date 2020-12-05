<?php
	include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['rut'])) {
           $errors[] = "Rut vacio";
        }else if (empty($_POST['nombre'])) {
           $errors[] = "Nombre vacío";
        }else if (empty($_POST['apellido'])) {
           $errors[] = "Apellido vacío";
        }else if (empty($_POST['genero'])) {
           $errors[] = "Genero vacío";
        }else if (empty($_POST['fechaNac'])) {
           $errors[] = "Fecha nacimiento vacía";
        }else if ($_POST['fechaNac']>date("Y-m-d H:i:s")) {
           $errors[] = "Fecha no puede ser superior a hoy";
        } elseif ($_POST['fechaNac'] < date("Y-m-d H:i:s",( strtotime(date("Y-m-d H:i:s")." - 150 year")))) {
         $errors[] = "Estudiante debe ser menor de 150 años ";    
         }else if (empty($_POST['relacion'])) {
           $errors[] = "Relacion vacía";   
        }else if (empty($_POST['estadoCivil'])) {
           $errors[] = "Estado civil vacío";
        }else if (empty($_POST['nivelEduc'])) {
           $errors[] = "Nivel educacional vacío";
        }else if (empty($_POST['actividad'])) {
           $errors[] = "Actividad vacía";
        }else if (empty($_POST['prevision'])) {
           $errors[] = "Prevision vacía";
        }else if (($_POST['prevision']==5) && (empty($_POST['otraprevision']))) {
        $errors[] = "Especifique otra prevision";
        }else if (empty($_POST['condicion'])) {
           $errors[] = "Condicion vacía";
        }else if (empty($_POST['rut_estudiante'])) {
           $errors[] = "Rut estudiante vacio";   
        }else if (($_POST['condicion']==1 || $_POST['condicion']==2) && (empty($_POST['enfermedad']))) {
        $errors[] = "Especifique enfermedad";   
        } else if (!empty($_POST['rut'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
                include '../Clases/Integrante.php';
                include '../Clases/Scape.php';
                include '../Clases/Log.php';
		// escaping, additionally removing everything that could be (html/javascript-) code
                $rut_estudiante= $_POST["rut_estudiante"];
                $rut= $_POST["rut"];
		$nombre= Scape::ms_escape_string($_POST["nombre"]);
                $apellido= Scape::ms_escape_string($_POST["apellido"]);
                $genero= intval($_POST["genero"]);
                $fechaNac= $_POST["fechaNac"];
                $relacion= intval($_POST["relacion"]);
                $estadoCivil= intval($_POST["estadoCivil"]);
                $nivelEduc= intval($_POST["nivelEduc"]);
		$actividad= intval($_POST["actividad"]);
                $prevision= intval($_POST["prevision"]);
                $otraPrevision= Scape::ms_escape_string($_POST["otraprevision"]);
                $condicion= intval($_POST["condicion"]);
                $enfermedad= Scape::ms_escape_string($_POST["enfermedad"]);
		
		$query_update = Integrante::editarIntegrante($rut_estudiante,$rut,$nombre,$apellido,$genero,$fechaNac,$relacion,$estadoCivil,$nivelEduc,$actividad,$prevision,$otraPrevision,$condicion,$enfermedad,$con);
                
			if ($query_update){
				$messages[] = "Integrante ha sido actualizado satisfactoriamente.";
                                $accion = "Actualizo integrante $rut a estudiante $rut_estudiante";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.";
                                $accion = "Error al actualizar integrante $rut a estudiante $rut_estudiante";
			}
                           
                        Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);
                        
		} else {
			$errors []= "Error desconocido.";
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