<?php
include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
		
	/*Inicia validacion del lado del servidor*/
        if (empty($_POST['declaracion'])) {
           $errors[] = "Declaracion vacia";
        }else if (empty($_POST['tipo_sol'])) {
           $errors[] = "Debe seleccionar un tipo de solicitud";   
        }else if (empty($_POST['rut_estudiante'])) {
           $errors[] = "Rut estudiante vacio";
        }else{
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
                include '../Clases/Declaracion.php';
                include '../Clases/Solicitud.php';
		// escaping, additionally removing everything that could be (html/javascript-) code
                $rut_estudiante         = $_POST["rut_estudiante"];
                $declaracion            = $_POST["declaracion"];
                $tipo                   = $_POST["tipo_sol"];
                $estado=0;
                $condicion = "";
                
                 $query= Solicitud::recuperarSolicitud($rut_estudiante,$condicion,$con);
                
                 
                 if($query){
                 $comprobar = sqlsrv_num_rows($query);    
                 }else{
                 $comprobar=0;    
                 }
                 
                 if($comprobar>0){                
                 $query= Solicitud::editarSolicitud($rut_estudiante,$estado,$tipo,$con);
                 if ($query) {
                        $messages[] = "<br> Tipo de solicitud actualizado con éxito.";
                    } else {
                        $errors[] = "<br> Error al actualizar declaracion";
                    }
                 }else{            
                 $query= Solicitud::registrarSolicitud($rut_estudiante,$estado,$tipo,$con);
                  if ($query) {
                        $messages[] = "<br> Tipo de solicitud registrado con éxito.";
                    } else {
                        $errors[] = "<br> Error al registrar tipo";
                    }
                 }
                
                
                //declaracion
                 $query2= Declaracion::recuperarDeclaracion($rut_estudiante,$con);
                
                 
                 if($query2){
                 $comprobar2 = sqlsrv_num_rows($query2);    
                 }else{
                 $comprobar2=0;    
                 }
                 
                 if($comprobar2>0){
                 $query2= Declaracion::editarDeclaracion($rut_estudiante,$declaracion,$con);
                 
                 if ($query2) {
                        $messages[] = "<br> Declaracion actualizada con éxito.";
                    } else {
                        $errors[] = "<br> Error al actualizar declaracion";
                    }
                 }else{
                 $query2= Declaracion::registrarDeclaracion($rut_estudiante,$declaracion,$con);
                  if ($query2) {
                        $messages[] = "<br> Declaracion registrada con éxito.";
                    } else {
                        $errors[] = "<br> Error al registrar declaracion";
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