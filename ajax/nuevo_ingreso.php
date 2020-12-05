<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
		
	/*Inicia validacion del lado del servidor*/
        if (empty($_POST['rut_integrantes'])) {
           $errors[] = "No ha seleccionado integrante";
        }elseif (empty($_POST['nombre_integrantes'])) {
           $errors[] = "Nombres de integrantes vacios";
        }elseif (empty($_POST['apellido_integrantes'])) {
           $errors[] = "Apellidos de integrantes vacios";   
        }elseif (empty($_POST['rut_estudiante'])) {
           $errors[] = "Estudiante no valido";
        }elseif (empty($_POST['sueldo_integrante'])) {
           $errors[] = "Sueldo no valido"; 
        }elseif (empty($_POST['pension_integrante'])) {
           $errors[] = "Pension no valido"; 
        }elseif (empty($_POST['honorario_integrante'])) {
           $errors[] = "Honorario no valido"; 
        }elseif (empty($_POST['retiro_integrante'])) {
           $errors[] = "Retiro no valido"; 
        }elseif (empty($_POST['dividendo_integrante'])) {
           $errors[] = "Dividendo no valido"; 
        }elseif (empty($_POST['interes_integrante'])) {
           $errors[] = "Interes no valido"; 
        }elseif (empty($_POST['ganancia_integrante'])) {
           $errors[] = "Ganancia no valida"; 
        }elseif (empty($_POST['pension_alim_integrante'])) {
           $errors[] = "Pension alimenticia no valida"; 
        }elseif (empty($_POST['actividad_integrante'])) {
           $errors[] = "Actividad no valida";         
        }else{
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
                include '../Clases/Ingreso.php';
		// escaping, additionally removing everything that could be (html/javascript-) code
                $rut_estudiante         = $_POST["rut_estudiante"];
                $rut_integrantes        = $_POST["rut_integrantes"];
                $nombre_integrantes     = $_POST["nombre_integrantes"];
                $apellido_integrantes   = $_POST["apellido_integrantes"];
                
		$sueldo_mensual         = $_POST['sueldo_integrante'];
                $pension_mensual        = $_POST['pension_integrante'];
                $honorario_mensual      = $_POST['honorario_integrante'];
                $retiro_mensual         = $_POST['retiro_integrante'];
                $dividendo_mensual      = $_POST['dividendo_integrante'];
                $interes_mensual        = $_POST['interes_integrante'];
                $ganancia_mensual       = $_POST['ganancia_integrante'];
                $pension_alim_mensual   = $_POST['pension_alim_integrante'];
                $actividad_mensual      = $_POST['actividad_integrante'];     

              
                for($indice = 0 ; $indice < count($rut_integrantes);$indice++){  
                 $rut_integrante        = $rut_integrantes      [$indice];
                 $nombre_integrante     = $nombre_integrantes   [$indice];
                 $apellido_integrante   = $apellido_integrantes [$indice];
                 $sueldo                = $sueldo_mensual       [$indice];
                 $pension               = $pension_mensual      [$indice];
                 $honorario             = $honorario_mensual    [$indice];
                 $retiro                = $retiro_mensual       [$indice];
                 $dividendo             = $dividendo_mensual    [$indice];
                 $interes               = $interes_mensual      [$indice];
                 $ganancia              = $ganancia_mensual     [$indice];
                 $pension_alim          = $pension_alim_mensual [$indice];
                 $actividad             = $actividad_mensual    [$indice];             
                 
                 $query_select= Ingreso::recuperarIngreso($rut_integrante,$rut_estudiante,$con,"","","");
                 
                 $validar = sqlsrv_num_rows($query_select);
                 
                 if($validar>0){
                 $query = Ingreso::editarIngreso($rut_estudiante,$rut_integrante,$sueldo,$pension,$honorario,$retiro,$dividendo,$interes,$ganancia,$pension_alim,$actividad,$con);  
                  $messages[0] = "Ingreso actualizado con éxito.";
                 }else{
                 $query = Ingreso::registrarIngreso($rut_estudiante,$rut_integrante,$nombre_integrante,$apellido_integrante,$sueldo,$pension,$honorario,$retiro,$dividendo,$interes,$ganancia,$pension_alim,$actividad,$con);
                  $messages[0] = "Ingreso agregado con éxito.";
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