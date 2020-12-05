<?php
	include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
        
        //TERRITORIAL Y HABITACIONAL
	if (empty($_POST['id_tipoVivienda'])) {
           $errors[] = "ID Vivienda  vacio ";
        }else if (empty($_POST['puntaje_tipoVivienda'])) {
           $errors[] = "Puntaje Vivienda vacío";
        }else if (empty($_POST['id_tenencia'])) {
           $errors[] = "ID Tenencia  vacio ";
        }else if (empty($_POST['puntaje_tenencia'])) {
           $errors[] = "Puntaje Tenencia vacío";
           
        
        //SALUD   
        }else if (empty($_POST['id_enfermedad'])) {
           $errors[] = "ID Enfermedad vacio ";
        }else if (empty($_POST['puntaje_enfermedad'])) {
           $errors[] = "Puntaje Enfermedad vacío"; 
         }else if (empty($_POST['id_prev_salud'])) {
           $errors[] = "ID Prevision Salud  vacio ";
        }else if (empty($_POST['puntaje_prev_salud'])) {
           $errors[] = "Puntaje Prevision Salud vacío";
        }else if (empty($_POST['id_factor'])) {
           $errors[] = "ID Factor  vacio ";
        }else if (empty($_POST['puntaje_factor'])) {
           $errors[] = "Puntaje Factor vacío";
        }else if (empty($_POST['id_duplicidad'])) {
           $errors[] = "ID Duplicidad  vacio ";
        }else if (empty($_POST['puntaje_duplicidad'])) {
           $errors[] = "Puntaje Duplicidad vacío";   
        }else if (empty($_POST['id_sugerencia'])) {
           $errors[] = "ID Sugerencia  vacio ";
        }else if (empty($_POST['puntaje_sugerencia'])) {
           $errors[] = "Puntaje Sugerencia vacío";   
        
        
        //Economico
        }else if (empty($_POST['id_grupo'])) {
           $errors[] = "ID Grupo  vacio ";
        }else if (empty($_POST['puntaje_grupo'])) {
           $errors[] = "Puntaje Grupo vacío";
        }else if (empty($_POST['id_integrante_ingreso'])) {
           $errors[] = "ID Integrante Ingreso vacio ";
        }else if (empty($_POST['puntaje_integrante_ingreso'])) {
           $errors[] = "Puntaje Integrante Ingreso vacío"; 
        }else if (empty($_POST['id_integrante_pensionado'])) {
           $errors[] = "ID Integrante pensionado Ingreso vacio ";
        }else if (empty($_POST['puntaje_integrante_pensionado'])) {
           $errors[] = "Puntaje Integrante pensionado Ingreso vacío";    
           
        }else if (empty($_POST['id_nivel'])) {
           $errors[] = "ID Nivel  vacio ";
        }else if (empty($_POST['puntaje_nivel'])) {
           $errors[] = "Puntaje Nivel vacío";   
        }else if (empty($_POST['id_percap'])) {
           $errors[] = "ID Percap  vacio ";
        }else if (empty($_POST['puntaje_percap'])) {
           $errors[] = "Puntaje Percap vacío";              
        }else if (empty($_POST['id_tramo'])) {
           $errors[] = "ID Tramo  vacio ";
        }else if (empty($_POST['puntaje_tramo'])) {
           $errors[] = "Puntaje Tramo vacío";
        }else if (empty($_POST['id_formula'])) {
           $errors[] = "ID Formula  vacio ";
        }else if (empty($_POST['puntaje_formula'])) {
           $errors[] = "Puntaje Formula vacío";
        }else if (empty($_POST['id_jefe'])) {
           $errors[] = "ID Jefe  vacio ";
        }else if (empty($_POST['puntaje_jefe'])) {
           $errors[] = "Puntaje Jefe vacío";
        }else if (empty($_POST['id_actividad'])) {
           $errors[] = "ID Actividad vacio ";
        }else if (empty($_POST['puntaje_actividad'])) {
           $errors[] = "Puntaje Actividad vacío";
        }else if (empty($_POST['id_estado'])) {
           $errors[] = "ID Estado  vacio ";
        }else if (empty($_POST['puntaje_estado'])) {
           $errors[] = "Puntaje Estado vacío";   
           
        }else if (empty($_POST['id_otro'])) {
           $errors[] = "ID Otro  vacio ";
        }else if (empty($_POST['puntaje_otro'])) {
           $errors[] = "Puntaje Otro vacío";
        }else if (empty($_POST['id_prev_social'])) {
           $errors[] = "ID Prevision Social  vacio ";
        }else if (empty($_POST['puntaje_prev_social'])) {
           $errors[] = "Puntaje Prevision Social vacío";   
        }else if (empty($_POST['id_contrato'])) {
           $errors[] = "ID Contrato vacio ";
        }else if (empty($_POST['puntaje_contrato'])) {
           $errors[] = "Puntaje Contrato vacío";
        
           
        //ACADEMICO
        }else if (empty($_POST['id_avance'])) {
           $errors[] = "ID Avance vacio ";
        }else if (empty($_POST['puntaje_avance'])) {
           $errors[] = "Puntaje Avance vacío";
        }else if (empty($_POST['id_calificacion'])) {
           $errors[] = "ID Calificacion vacio ";
        }else if (empty($_POST['puntaje_calificacion'])) {
           $errors[] = "Puntaje Calificacion vacío";
        }else if (empty($_POST['id_beneficio'])) {
           $errors[] = "ID Beneficios vacio ";
        }else if (empty($_POST['puntaje_beneficio'])) {
           $errors[] = "Puntaje Beneficios vacío";    
           
        }else if (empty($_POST['id_nacionalidad'])) {
           $errors[] = "ID Nacionalidad vacio ";
        }else if (empty($_POST['puntaje_nacionalidad'])) {
           $errors[] = "Puntaje Nacionalidad vacío";
        }else if (empty($_POST['id_pueblo'])) {
           $errors[] = "ID Pueblo vacio ";
        }else if (empty($_POST['puntaje_pueblo'])) {
           $errors[] = "Puntaje Pueblo vacío";
        }else if (empty($_POST['id_otro'])) {
           $errors[] = "ID Otro vacio ";
        }else if (empty($_POST['puntaje_otro'])) {
           $errors[] = "Puntaje Otro vacío";             
        }else if (empty($_POST['id_discapacidad'])) {
           $errors[] = "ID Discapacidad vacio ";
        }else if (empty($_POST['puntaje_discapacidad'])) {
           $errors[] = "Puntaje Discapacidad vacío";   
        }else {   
       
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
                include '../Clases/TipoVivienda.php';
                include '../Clases/Tenencia.php';
                include '../Clases/Genero.php';
                include '../Clases/Observacion.php';
                include '../Clases/EstadoCivil.php';
                include '../Clases/Prevision.php';
                include '../Clases/PrevisionSocial.php';
                include '../Clases/TipoContrato.php';
                include '../Clases/NivelEducacional.php';
                include '../Clases/Enfermedad.php';
                include '../Clases/ActividadIntegrante.php';
                include '../Clases/Nacionalidad.php';
                include '../Clases/Pueblo.php';
                include '../Clases/Discapacidad.php';
                include '../Clases/Sugerencia.php';
                include '../Clases/GrupoFamiliar.php';
                include '../Clases/IntegranteIngreso.php';
                include '../Clases/IntegrantePensionado.php';
                include '../Clases/Percap.php';
                include '../Clases/Formula.php';
                include '../Clases/Jefe.php';
                include '../Clases/Avance.php';
                include '../Clases/Calificacion.php';
                include '../Clases/Beneficio.php';
                
                include '../Clases/Scape.php';
	
                
                //TERRITORIAL Y HABITACIONAL
                
                $id_vivienda        =$_POST['id_tipoVivienda'];
                $puntaje_vivienda   =$_POST['puntaje_tipoVivienda'];
                
                $id_tenencia        =$_POST['id_tenencia'];
                $puntaje_tenencia   =$_POST['puntaje_tenencia'];
                
                $id_distancia        =$_POST['id_distancia'];
                $puntaje_distancia   =$_POST['puntaje_distancia'];
                
                
                //SALUD
                
                $id_enfermedad        =$_POST['id_enfermedad'];
                $puntaje_enfermedad   =$_POST['puntaje_enfermedad'];
                
                $id_prev_salud        =$_POST['id_prev_salud'];
                $puntaje_prev_salud   =$_POST['puntaje_prev_salud'];
                
                $id_factor           =$_POST['id_factor'];
                $puntaje_factor      =$_POST['puntaje_factor'];
                
                $id_duplicidad        =$_POST['id_duplicidad'];
                $puntaje_duplicidad   =$_POST['puntaje_duplicidad'];
                
                $id_sugerencia      =$_POST['id_sugerencia'];
                $puntaje_sugerencia =$_POST['puntaje_sugerencia'];
                
                
                //ECONOMICA
                
                $id_grupo           =$_POST['id_grupo'];
                $puntaje_grupo      =$_POST['puntaje_grupo'];
                
                $id_integrante_ingreso=$_POST['id_integrante_ingreso'];
                $puntaje_integrante_ingreso=$_POST['puntaje_integrante_ingreso'];
                
                $id_integrante_pensionado=$_POST['id_integrante_pensionado'];
                $puntaje_integrante_pensionado=$_POST['puntaje_integrante_pensionado'];
                
                $id_nivel             =$_POST['id_nivel'];
                $puntaje_nivel        =$_POST['puntaje_nivel'];
                
                $id_percap             =$_POST['id_percap'];
                $puntaje_percap        =$_POST['puntaje_percap'];
                
                $id_tramo           =$_POST['id_tramo'];
                $puntaje_tramo      =$_POST['puntaje_tramo'];
                
                $id_formula           =$_POST['id_formula'];
                $puntaje_formula      =$_POST['puntaje_formula'];
                
                $id_jefe           =$_POST['id_jefe'];
                $puntaje_jefe      =$_POST['puntaje_jefe'];
                
                $id_actividad         =$_POST['id_actividad'];
                $puntaje_actividad    =$_POST['puntaje_actividad'];
                
                $id_estado            =$_POST['id_estado'];
                $puntaje_estado       =$_POST['puntaje_estado'];
                
                $id_prev_social       =$_POST['id_prev_social'];
                $puntaje_prev_social  =$_POST['puntaje_prev_social'];
                
                $id_contrato          =$_POST['id_contrato'];
                $puntaje_contrato     =$_POST['puntaje_contrato'];
                
                
                //ACADEMICO
                
                $id_avance             =$_POST['id_avance'];
                $puntaje_avance        =$_POST['puntaje_avance'];
                
                $id_calificacion       =$_POST['id_calificacion'];
                $puntaje_calificacion  =$_POST['puntaje_calificacion'];
                
                $id_beneficio       =$_POST['id_beneficio'];
                $puntaje_beneficio  =$_POST['puntaje_beneficio'];
                
                $id_nacionalidad      =$_POST['id_nacionalidad'];
                $puntaje_nacionalidad =$_POST['puntaje_nacionalidad'];
                
                $id_pueblo            =$_POST['id_pueblo'];
                $puntaje_pueblo       =$_POST['puntaje_pueblo'];
                
                $id_otro             =$_POST['id_otro'];
                $puntaje_otro        =$_POST['puntaje_otro'];
                               
                $id_discapacidad      =$_POST['id_discapacidad'];
                $puntaje_discapacidad =$_POST['puntaje_discapacidad'];
                
                
                $query_update=false;
                
 //TERRITORIAL Y HABITACIONAL               
                //vivienda
                for($i = 0;$i < count($puntaje_vivienda);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update=TipoVivienda::editarPuntaje($id_vivienda[$i],$puntaje_vivienda[$i],$con);
                }
                
                
                //tenencia de vivienda
                for($i = 0;$i < count($puntaje_tenencia);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Tenencia::editarPuntaje($id_tenencia[$i],$puntaje_tenencia[$i],$con);
                }

               //distancia
                for($i = 0;$i < count($puntaje_distancia);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Observacion::editarPuntajeDistancia($id_distancia[$i],$puntaje_distancia[$i],$con);
                }
                
//SALUD        

                //Enfermedad
                for($i = 0;$i < count($puntaje_enfermedad);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Enfermedad::editarPuntaje($id_enfermedad[$i],$puntaje_enfermedad[$i],$con);
                }

                 //prevision de salud
                for($i = 0;$i < count($puntaje_prev_salud);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Prevision::editarPuntaje($id_prev_salud[$i],$puntaje_prev_salud[$i],$con);
                }
                
                //Factor
                for($i = 0;$i < count($puntaje_factor);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Observacion::editarPuntajeFactor($id_factor[$i],$puntaje_factor[$i],$con);
                }
                
                //duplicidad de funciones
                for($i = 0;$i < count($puntaje_duplicidad);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Observacion::editarPuntajeDuplicidad($id_duplicidad[$i],$puntaje_duplicidad[$i],$con);
                } 
                
                //sugerencia
                for($i = 0;$i < count($puntaje_sugerencia);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Sugerencia::editarPuntaje($id_sugerencia[$i],$puntaje_sugerencia[$i],$con);
                } 
                
                
                //ECONOMICA
                
                
                //Grupo Familiar
                for($i = 0;$i < count($puntaje_grupo);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= GrupoFamiliar::editarPuntaje($id_grupo[$i],$puntaje_grupo[$i],$con);
                }
                
                
                //Integrante Ingreso
                for($i = 0;$i < count($puntaje_integrante_ingreso);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= IntegranteIngreso::editarPuntaje($id_integrante_ingreso[$i],$puntaje_integrante_ingreso[$i],$con);
                }
                
                 //Integrante Pensionado
                for($i = 0;$i < count($puntaje_integrante_pensionado);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= IntegrantePensionado::editarPuntaje($id_integrante_pensionado[$i],$puntaje_integrante_pensionado[$i],$con);
                }
                
                //nivel educacional
                for($i = 0;$i < count($puntaje_nivel);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= NivelEducacional::editarPuntaje($id_nivel[$i],$puntaje_nivel[$i],$con);
                }
                
                 //percap
                for($i = 0;$i < count($puntaje_percap);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Percap::editarPuntaje($id_percap[$i],$puntaje_percap[$i],$con);
                }

               //Tramo
                for($i = 0;$i < count($puntaje_tramo);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Observacion::editarPuntajeTramo($id_tramo[$i],$puntaje_tramo[$i],$con);
                }
                
              //Formula
                for($i = 0;$i < count($puntaje_formula);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Formula::editarPuntaje($id_formula[$i],$puntaje_formula[$i],$con);
                }
                
                //Jefe
                for($i = 0;$i < count($puntaje_jefe);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Jefe::editarPuntaje($id_jefe[$i],$puntaje_jefe[$i],$con);
                }
                
                     //actividad
                for($i = 0;$i < count($puntaje_actividad);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= ActividadIntegrante::editarPuntaje($id_actividad[$i],$puntaje_actividad[$i],$con);
                }
                
                //estado civil
                for($i = 0;$i < count($puntaje_estado);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= EstadoCivil::editarPuntaje($id_estado[$i],$puntaje_estado[$i],$con);
                }
                
                //prevision social
                for($i = 0;$i < count($puntaje_prev_social);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= PrevisionSocial::editarPuntaje($id_prev_social[$i],$puntaje_prev_social[$i],$con);
                }
                
                  //tipo contrato
                for($i = 0;$i < count($puntaje_contrato);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= TipoContrato::editarPuntaje($id_contrato[$i],$puntaje_contrato[$i],$con);
                }
                
                
                
//ACADEMICO                
 
                
                    //Avance
                for($i = 0;$i < count($puntaje_avance);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Avance::editarPuntaje($id_avance[$i],$puntaje_avance[$i],$con);
                }
                
                
               //Calificacion
                for($i = 0;$i < count($puntaje_calificacion);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Calificacion::editarPuntaje($id_calificacion[$i],$puntaje_calificacion[$i],$con);
                  
                }
                
                //Beneficio
                for($i = 0;$i < count($puntaje_beneficio);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Beneficio::editarPuntaje($id_beneficio[$i],$puntaje_beneficio[$i],$con);
                }
                
               //nacionalidad
                for($i = 0;$i < count($puntaje_nacionalidad);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Nacionalidad::editarPuntaje($id_nacionalidad[$i],$puntaje_nacionalidad[$i],$con);
                } 
                
                //pueblo originario
                for($i = 0;$i < count($puntaje_pueblo);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Pueblo::editarPuntaje($id_pueblo[$i],$puntaje_pueblo[$i],$con);
                }
                
                   //Otro miembro estudiando
                for($i = 0;$i < count($puntaje_otro);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Observacion::editarPuntajeOtro($id_otro[$i],$puntaje_otro[$i],$con);
                }

                //discapacidad
                for($i = 0;$i < count($puntaje_discapacidad);$i++ ){
              //     echo "ID:".$id_vivienda[$i]."VALOR:".$puntaje_vivienda[$i]."<br>";
                   $query_update= Discapacidad::editarPuntaje($id_discapacidad[$i],$puntaje_discapacidad[$i],$con);
                }

                
                
			if ($query_update){
				$messages[] = "Puntuaciones han sido actualizadas satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.";
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