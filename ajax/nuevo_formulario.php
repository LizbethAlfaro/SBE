<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
        if (empty($_POST['nombre'])) {
           $errors[] = "Nombre vacío";
        }else if (empty($_POST['rut'])) {
           $errors[] = "Rut vacio";
        }else if (empty($_POST['carrera'])) {
           $errors[] = "Carrera vacía";
        }else if (empty($_POST['jornada'])) {
           $errors[] = "Jornada vacía";
        }else if (empty($_POST['fechaIng'])) {
           $errors[] = "Fecha ingreso vacia";   
         }else if (empty($_POST['fechaNac'])) {
           $errors[] = "Fecha nacimiento vacía";   
        }else if (empty($_POST['direccion'])) {
           $errors[] = "Direccion vacía";
        }else if (empty($_POST['numero'])) {
            $errors[] = "Numero vacío";
        }else if (empty($_POST['departamento'])) {
           $errors[] = "Departamento vacío";
        }else if (empty($_POST['villa'])) {
           $errors[] = "Villa vacía";
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
        }else if (empty($_POST['declaracion'])) {
            $errors[] = "Declaracion vacía";
        }else if (empty($_POST['fecha_cita'])) {
            $errors[] = "Fecha citacion vacía";
        }else if (empty($_POST['hora_cita'])) {
            $errors[] = "Hora citacion vacía";
        } else if (!empty($_POST['rut'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
                include '../Clases/Formulario.php';
                include '../Clases/Scape.php';
                
                //
                $id_formulario;
           
		// datos estudiante
                $nombre     = Scape::ms_escape_string($_POST["nombre"]);
                $rut        = Scape::ms_escape_string($_POST["rut"]);
                $carrera    = Scape::ms_escape_string($_POST["carrera"]);
                $jornada    = Scape::ms_escape_string($_POST["jornada"]);
                $fecha_ing  = Scape::ms_escape_string($_POST["fechaIng"]);
                $fecha_nac  = Scape::ms_escape_string($_POST["fechaNac"]);
                $fono       = Scape::ms_escape_string($_POST["fono"]);
                $movil      = Scape::ms_escape_string($_POST["movil"]);
                $mail       = Scape::ms_escape_string($_POST["mail"]);
                //direccion principal
                $direccion      = Scape::ms_escape_string($_POST["direccion"]);
                $numero         = Scape::ms_escape_string($_POST["numero"]);
                $departamento   = Scape::ms_escape_string($_POST["departamento"]);
                $villa          = Scape::ms_escape_string($_POST["villa"]);
                $comuna         = Scape::ms_escape_string($_POST["comuna"]);
                $region         = Scape::ms_escape_string($_POST["region"]);
                
                 //direccion secundaria
                $direccion_2    = Scape::ms_escape_string($_POST["direccion_2"]);
                $numero_2       = Scape::ms_escape_string($_POST["numero_2"]);
                $departamento_2 = Scape::ms_escape_string($_POST["departamento_2"]);
                $villa_2        = Scape::ms_escape_string($_POST["villa_2"]);
                $comuna_2       = Scape::ms_escape_string($_POST["comuna_2"]);
                $region_2       = Scape::ms_escape_string($_POST["region_2"]);
                
                //arrays de integrantes familiares
                $enfermedad= Scape::ms_escape_string($_POST["rut_integrante"]);
                $enfermedad= Scape::ms_escape_string($_POST["nombre_integrante"]);
                $enfermedad= Scape::ms_escape_string($_POST["apellido_integrante"]);
                $enfermedad= Scape::ms_escape_string($_POST["genero_integrante"]);
                $enfermedad= Scape::ms_escape_string($_POST["edad_integrante"]);
                $enfermedad= Scape::ms_escape_string($_POST["relacion_integrante"]);
                $enfermedad= Scape::ms_escape_string($_POST["estadoCivil_integrante"]);
                $enfermedad= Scape::ms_escape_string($_POST["nivelEduc_integrante"]);
                $enfermedad= Scape::ms_escape_string($_POST["actividad_integrante"]);
                
                //tenencia vivienda
                $tenencia_vivienda  = Scape::ms_escape_string($_POST["tenencia_vivienda"]);
                $tipo_vivienda      = Scape::ms_escape_string($_POST["tipo_vivienda"]);
                
                //arrays de ingresos familiares
                $enfermedad= Scape::ms_escape_string($_POST["rut_ingreso"]);
                $enfermedad= Scape::ms_escape_string($_POST["nombre_ingreso"]);
                $enfermedad= Scape::ms_escape_string($_POST["apellido_ingreso"]);
                $enfermedad= Scape::ms_escape_string($_POST["cantidad_ingreso"]);
                $enfermedad= Scape::ms_escape_string($_POST["tipo_ingreso"]);
                
                //arrays de antecedentes familiares
                $enfermedad= Scape::ms_escape_string($_POST["rut_antecedentes"]);
                $enfermedad= Scape::ms_escape_string($_POST["nombre_antecedentes"]);
                $enfermedad= Scape::ms_escape_string($_POST["apellido_antecedentes"]);
                $enfermedad= Scape::ms_escape_string($_POST["condicion_antecedentes"]);
                $enfermedad= Scape::ms_escape_string($_POST["enfermedad_antecedentes"]);
                $enfermedad= Scape::ms_escape_string($_POST["prevision_antecedentes"]);
                $enfermedad= Scape::ms_escape_string($_POST["otraprev_antecedentes"]);
                
                //declaracion de solicitud
                $declaracion = Scape::ms_escape_string($_POST["declaracion"]);
                
                //datos entevista
                $fecha_cita = Scape::ms_escape_string($_POST["fecha_cita"]);
                $hora_cita  = Scape::ms_escape_string($_POST["hora_cita"]);
                
     
                 $query_insert = Formulario::registrarFormulario($id_formulario,$nombre,$rut,$carrera,$jornada,$fecha_ing,$fecha_nac,$direccion,$numero,$departamento,$villa,$comuna,$region,$fono,$movil,$mail,$direccion_2,$numero_2,$departamento_2,$villa_2,$comuna_2,$region_2,$tenencia_vivienda,$tipo_vivienda,$declaracion,$fecha_cita,$hora_cita,$con);      
                
                if ($query_insert){
                    $messages[] = "Formulario ha sido ingresado satisfactoriamente.";
		} else{
                    $errors []= "Error al ingresar formulario";
		}
                        
                
		
			
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