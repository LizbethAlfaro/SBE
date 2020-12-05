<?php
	include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
        if (empty($_POST['nombre']) || $_POST['nombre']==" ") {
           $errors[] = "Nombre vacío";
        }else if (empty($_POST['rut']) || $_POST['rut']==" ") {
           $errors[] = "Rut vacio";
        }else if (empty($_POST['carrera'])) {
           $errors[] = "Carrera vacía";
        }else if (empty($_POST['jornada'])) {
           $errors[] = "Jornada vacía";
        }else if (empty($_POST['fechaIng'])) {
           $errors[] = "Fecha ingreso vacia";   
         }else if (empty($_POST['fechaNac'])) {
           $errors[] = "Fecha nacimiento vacía";
         }else if (empty($_POST['tipo_sol'])) {
           $errors[] = "Tipo solicitud vacia";    
        }else if (empty($_POST['direccion'])) {
           $errors[] = "Direccion vacía";
        }else if (!is_numeric ($_POST['numero'])) {
            $errors[] = "Numero vacío";
//        }else if (empty($_POST['departamento'])) {
//           $errors[] = "Departamento vacío";
//        }else if (empty($_POST['villa'])) {
//           $errors[] = "Villa vacía";
        }else if (empty($_POST['comuna'])) {
           $errors[] = "Comuna vacío";
        }else if (empty($_POST['region'])) {
            $errors[] = "Region vacía";
        }else if (empty($_POST['fono']) && empty($_POST['movil'])) {
           $errors[] = "Telefonos vacíos"; 
        }else if (empty($_POST['mail'])) {
            $errors[] = "Mail vacío";
            
        }else if (empty($_POST['rut_integrante'])) {
            $errors[] = "Rut integrante vacío";
        }else if (empty($_POST['nombre_integrante'])) {
            $errors[] = "Region vacía";
        }else if (empty($_POST['apellido_integrante'])) {
            $errors[] = "Apellido integrante vacío";
        }else if (empty($_POST['genero_integrante'])) {
            $errors[] = "Genero integrante vacío ";
        }else if (empty($_POST['edad_integrante'])) {
            $errors[] = "Edad integrante vacía";
        }else if (empty($_POST['relacion_integrante'])) {
            $errors[] = "Relacion integrante vacía";
        }else if (empty($_POST['estadoCivil_integrante'])) {
            $errors[] = "estado civil integrante vacío";
        }else if (empty($_POST['nivelEduc_integrante'])) {
            $errors[] = "Nivel educacional integrante vacio";
        }else if (empty($_POST['actividad_integrante'])) {
            $errors[] = "Actividad integrante vacía";
            
        }else if (empty($_POST['tenencia_vivienda'])) {
            $errors[] = "Tenencia de vivienda vacía";
        }else if (empty($_POST['tipo_vivienda'])) {
            $errors[] = "Tipo de vivienda vacía";
            
        }else if (empty($_POST['rut_ingreso'])) {
            $errors[] = "Rut ingreso vacía";
        }else if (empty($_POST['nombre_ingreso'])) {
            $errors[] = "Nombre ingreso vacía";
        }else if (empty($_POST['apellido_ingreso'])) {
            $errors[] = "Apellido ingreso vacía";
        }else if (empty($_POST['pension_integrante'])) {
            $errors[] = "Pension ingreso vacía";
        }else if (empty($_POST['honorario_integrante'])) {
            $errors[] = "Hononario ingreso vacía";
        }else if (empty($_POST['retiro_integrante'])) {
            $errors[] = "Retiro ingreso vacía";
        }else if (empty($_POST['dividendo_integrante'])) {
            $errors[] = "Dividendo ingreso vacía";
        }else if (empty($_POST['interes_integrante'])) {
            $errors[] = "Interes ingreso vacía";
        }else if (empty($_POST['ganancia_integrante'])) {
            $errors[] = "Ganancia ingreso vacía";
        }else if (empty($_POST['pension_alim_integrante'])) {
            $errors[] = "Pension alimenticia ingreso vacía";
        }else if (empty($_POST['actividad_integrante'])) {
            $errors[] = "Actividad ingreso vacía";
         
        }else if (empty($_POST['rut_antecedentes'])) {
            $errors[] = "Rut antecedentes vacío";
        }else if (empty($_POST['nombre_antecedentes'])) {
            $errors[] = "Nombre antecedentes vacío";
        }else if (empty($_POST['apellido_antecedentes'])) {
            $errors[] = "Apellido antecedentes vacío";
        }else if (empty($_POST['condicion_antecedentes'])) {
            $errors[] = "Condicion antecedentes vacía";
        }else if (empty($_POST['enfermedad_antecedentes'])) {
            $errors[] = "Enfermedad antecedentes vacía";
        }else if (empty($_POST['prevision_antecedentes'])) {
            $errors[] = "Prevision antecedentes vacía";
        }else if (empty($_POST['otraprev_antecedentes'])) {
            $errors[] = "Otra prevision antecedentes vacía";
            
//        }else if (empty($_POST['declaracion']) || strlen($_POST['declaracion'])<=1) {
//            $errors[] = "Declaracion vacía ";
            
//        }else if (empty($_POST['fecha_cita'])) {
//            $errors[] = "Fecha citacion vacía";
//        }else if (empty($_POST['hora_cita'])) {
//            $errors[] = "Hora citacion vacía";
         }else if (empty($_POST['acredita'])) {
            $errors[] = "Asistente que acredita vacio ";    
        } else if (!empty($_POST['rut'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
                include '../Clases/Solicitud.php';
                include '../Clases/Log.php';
                include '../admin/acreditarConvertirPDF.php';
                
                $acredita=$_POST['acredita'];
                
                $rut_estudiante = $_POST['rut'];
                $tipo           = $_POST['tipo_sol'];
                $estado = 3; //acreditado
                $condicion = "";
                //registrar solicitud
                
                
                $query_select = Solicitud::recuperarSolicitud($rut_estudiante,$condicion,$con);
                
                if($query_select){
                 $contador_select = sqlsrv_num_rows($query_select);   
                }else{
                 $contador_select = 0;  
                }
                
                if($contador_select>0){
                  $query = Solicitud::editarSolicitud($rut_estudiante,$estado,$tipo,$con);   
                }else{
                  $query = Solicitud::registrarSolicitud($rut_estudiante,$estado,$tipo,$con);    
                }
                
               
                
                if ($query){
                    $messages[] = "Solicitud acreditada.";
                    Solicitud::acreditarSolicitud($rut_estudiante,$acredita,$con);
                    $accion = "Acredita solicitud de estudiante $rut_estudiante";
 
                    obtenerAcreditacion($rut_estudiante,$con);
		} else{
                    $errors []= "Error al acreditar solicitud";
                     $accion = "Error al acreditar solicitud de estudiante $rut_estudiante";
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

