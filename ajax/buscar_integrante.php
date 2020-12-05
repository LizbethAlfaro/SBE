<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/Integrante.php';
        include '../Clases/Ingreso.php';
        include '../Clases/Vivienda.php';
        include '../Clases/Scape.php';
        include '../Clases/Solicitud.php';
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['rut_est']) && isset($_GET['rut_int'])){
		$rut_estudiante=strval($_GET['rut_est']);
                $rut_integrante=strval($_GET['rut_int']);
		$query= Integrante::recuperarIntegrante($rut_estudiante,$rut_integrante,$con,"","","");
		$count=sqlsrv_num_rows($query);
		if ($count>0){
                    
                        $delete= Integrante::eliminarIntegrante($rut_estudiante,$rut_integrante,$con);
                        $delete2= Ingreso::eliminarIngreso($rut_estudiante,$rut_integrante,$con);
                        
                        
			if ($delete && $delete2){
                           
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Integrante Eliminado exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Error por integridad referencial
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Error!</strong>Algo sucedio!!! Intente nuevamente. <?php echo $rut_estudiante; ?>
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
                 $q = $_REQUEST['q'];
                 $rut_estudiante=$_REQUEST['rut_estudiante'];
                
                $condicion = "";

                $solicitud = Solicitud::recuperarSolicitud($rut_estudiante, $condicion, $con);
                $solicitudArreglo;
                while ($solicitudCursor = sqlsrv_fetch_array($solicitud)) {
                $solicitudArreglo = array(
                "estado" => $solicitudCursor['estado'],
                );
                }

    $validar = $solicitudArreglo['estado'];


    //             print_r($rut_estudiante);
		 $aColumns = array('nombre_integrante','rut_integrante');//Columnas de busqueda
	
                 $sWhere = "";
                 /*
                 if (isset($_GET['rut_estudiante'])){
                 $rut_estudiante = $_REQUEST['rut_estudiante'];    
		 $sWhere = " AND .id_encuesta=$id_encuesta ";
                 }
                 */
		if ( $_GET['q'] != "" )
		{
			$sWhere = "AND (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
                $result = Integrante::recuperarIntegrante($rut_estudiante,"",$con,$sWhere,$offset,$per_page);
           
		$numrows= sqlsrv_num_rows($result);
       
        //        print_r($numrows);
                
		$total_pages = ceil($numrows/$per_page);
		$reload = './grupoFamiliar.php';
		//main query to fetch the data
		//loop through fetched data
		if ($numrows>0){
			
         
			?>
			<div class="table-responsive">
                            
			  <table class="table">
				<tr  class="success">          
                                    <th class="col-sm-2">Rut</th>
					<th class="col-sm-2">Nombre</th>
					<th class="col-sm-2">Apellido</th>
                                        <th>Genero</th>
                                        <th>Edad</th>
                                        <th>Parentesco</th>
                                        <th>Estado civil</th>
                                        <th>Educacion</th>
                                        <th>Actividad</th>
                                        <th>Prevision</th>
                                        <th>Condicion</th>
                                        <?php
                                        if($validar==0){
                                        ?>
                                        <th class='text-right'>Acciones</th>
                                        <?php
                                        }
                                        ?>
					
				</tr>
				<?php
				 while ($row = sqlsrv_fetch_array($result)){
                                     
                                     $cumpleanos = new DateTime($row['fechaNac_integrante']);
                                     $hoy = new DateTime();
                                     $annos = $hoy->diff($cumpleanos);
                                     
                                     
                                    $rut_integrante=$row['rut_integrante'];
                                    $nombre_integrante=$row['nombre_integrante'];
                                    $apellido_integrante=$row['apellido_integrante'];
                                    $id_genero_integrante=$row['genero_integrante'];
                                    $genero_integrante=$row['nombre_genero'];
                                    $fechaNac_integrante=$row['fechaNac_integrante'];
                                    $edad_integrante= $annos->y; 
                                    $id_relacion_integrante=$row['relacion_integrante'];
                                    $relacion_integrante=$row['nombre_relacion'];
                                    $id_estadoCivil_integrante=$row['estadoCivil_integrante'];
                                    $estadoCivil_integrante=$row['nombre_estado'];
                                    $id_nivelEduc_integrante=$row['nivelEduc_integrante'];
                                    $nivelEduc_integrante=$row['nombre_nivel'];
                                    $id_actividad_integrante=$row['actividad_integrante'];
                                    $actividad_integrante=$row['nombre_actividad'];
                                    $id_prevision_integrante=$row['prevision_integrante'];
                                    $prevision_integrante=$row['nombre_prevision'];
                                    $otraprevision_integrante=$row['otraPrevision_integrante'];
                                    $id_condicion_integrante=$row['condicion_integrante'];
                                    $condicion_integrante=$row['nombre_condicion'];
                                    $enfermedad_integrante=$row['enfermedad_integrante'];
                   
					?>
					<tr>	
                                                        <td><?php echo $rut_integrante; ?></td>
                                                        <td><?php echo $nombre_integrante; ?></td>
                                                        <td><?php echo $apellido_integrante; ?></td>
                                                        <td><?php echo $genero_integrante; ?></td>
                                                        <td><?php echo $edad_integrante; ?></td>
                                                        <td><?php echo $relacion_integrante; ?></td>
                                                        <td><?php echo $estadoCivil_integrante; ?></td>
                                                        <td><?php echo $nivelEduc_integrante; ?></td>
                                                        <td><?php echo $actividad_integrante; ?></td>
                                                        <td><?php echo $prevision_integrante; ?></td>
                                                        <td><?php echo $condicion_integrante; ?></td>
                                       
                                                    

					<?php
                                        if($validar==0){
                                        ?>	
					<td class='text-right'>
						
                                                <?php
                                                if($rut_integrante!=$rut_estudiante){
                                                ?>
                                            <a href="#" class='btn btn-default' title='Editar Integrante' 
                                                   data-rut=            '<?php echo $rut_integrante;?>' 
                                                   data-nombre=         '<?php echo $nombre_integrante;?>' 
                                                   data-apellido=       '<?php echo $apellido_integrante;?>' 
                                                   data-genero=         '<?php echo $id_genero_integrante;?>'
                                                   data-fecha=          '<?php echo $fechaNac_integrante;?>'
                                                   data-relacion=       '<?php echo $id_relacion_integrante;?>'
                                                   data-estado=         '<?php echo $id_estadoCivil_integrante;?>'
                                                   data-nivel=          '<?php echo $id_nivelEduc_integrante;?>'
                                                   data-actividad=      '<?php echo $id_actividad_integrante;?>'
                                                   data-prevision=      '<?php echo $id_prevision_integrante;?>'
                                                   data-otraprevision=  '<?php echo $otraprevision_integrante;?>'
                                                   data-condicion=      '<?php echo $id_condicion_integrante;?>'
                                                   data-enfermedad=     '<?php echo $enfermedad_integrante;?>'
                                                   data-toggle="modal" data-target="#editarIntegrante"><i class="glyphicon glyphicon-edit"></i></a>
                                                   
						<a href="#" class='btn btn-default' title='Borrar Integrante' onclick="eliminarIntegrante('<?php echo $rut_estudiante; ?>','<?php echo $rut_integrante; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
                                                <?php
                                                }else{
                                                ?>
                                                <a href="#" class='btn btn-default' title='Editar Integrante' 
                                                   data-rut=            '<?php echo $rut_integrante;?>' 
                                                   data-estado=         '<?php echo $id_estadoCivil_integrante;?>'
                                                   data-nivel=          '<?php echo $id_nivelEduc_integrante;?>'
                                                   data-actividad=      '<?php echo $id_actividad_integrante;?>'
                                                   data-prevision=      '<?php echo $id_prevision_integrante;?>'
                                                   data-otraprevision=  '<?php echo $otraprevision_integrante;?>'
                                                   data-condicion=      '<?php echo $id_condicion_integrante;?>'
                                                   data-enfermedad=     '<?php echo $enfermedad_integrante;?>'
                                                   data-toggle="modal" data-target="#editarIntegranteEstudiante"><i class="glyphicon glyphicon-edit"></i></a>
                                                <?php
                                                }
                                                ?>
                                                
					</td>
					<?php
                                                }
                                        ?>	
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=4><span class="pull-right">
					<?php
			//		 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>