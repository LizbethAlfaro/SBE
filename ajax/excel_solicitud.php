<?php

	include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/Solicitud.php';
        include '../Clases/Estudiante.php';
        include '../Clases/Extra.php';
        include '../Clases/Scape.php';

	


        
        header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=socieconomica.xls');

        $rut_estudiante="";
        $sWhere="";
	        $result= Solicitud::recuperarSolicitud($rut_estudiante,$sWhere,$con);
		$numrows = sqlsrv_num_rows($result);

		$query = $result;
		//loop through fetched data
		if ($numrows>0){

			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="success">
                                    <th class="col-sm-2">Rut</th>
					<th>Nombre</th>
					<th>Apellido</th>
                                        <th>Correo</th>
                                        <th>Carrera</th>
                                        <th>Tipo</th>
                                        <th>Estado</th>
                                        <th class="col-sm-2">Acredita</th>
                                        <th>Extra</th>
					<th>Actualizacion Reciente</th>
                                      
					
				</tr>
				<?php
                               

                                        while ($row=sqlsrv_fetch_array($query)){
						$rut_estudiante     = $row['rut_estudiante'];
                                                $tipo_solicitud     = $row['nombre_tipo_solicitud'];
                                                $mail               = $row['mail_estudiante'];
                                                $carrera_estudiante = $row['carrera_estudiante'];
                                                $id_estado_solicitud  = $row['estado'];
                                                $acredita = $row['nombre_asistente']." ".$row['apellido_asistente'];
                                                $estado_solicitud   = $row['nombre_estado_solicitud'];
						$fecha_agregado     = date('d/m/Y', strtotime($row['fecha']));
                                                
                                        //        $result_estudiante= Estudiante::recuperarEstudiante($rut_estudiante, $con,"","","");
                                        //        $row_estudiante=sqlsrv_fetch_array($result_estudiante);
                                                
                                        $result_extra = Extra::recuperarExtra($rut_estudiante, $con);

                                        if ($result_extra) {
                                            $contador_extra = sqlsrv_num_rows($result_extra);
                                        } else {
                                            $contador_extra = 0;
                                        }
                                        
                                        if($contador_extra>0){
                                        $extra="OK";    
                                        }else{
                                        $extra="";       
                                        }
						
					?>
					<tr>
						
                                            <td><?php echo $rut_estudiante;       ?><input name="rut[]" type="hidden" value="<?php echo $rut_estudiante;?>"></td>
						<td><?php echo Scape::ms_escape_string($row['nombre_estudiante']);   ?></td>
                                                <td><?php echo Scape::ms_escape_string($row['apellido_estudiante']); ?></td>
                                                <td><?php echo $mail;     ?></td>
                                                <td><?php echo $carrera_estudiante;     ?></td>
                                                <td><?php echo $tipo_solicitud;     ?></td>
                                                <td><?php echo $estado_solicitud;     ?></td>
                                                <td><?php echo $acredita;     ?></td>
                                                <td><?php echo $extra;     ?></td>
						<td><?php echo $fecha_agregado;     ?></td>
	
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=4><span class="pull-right">
					<?php
				//	 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
                                                       
			</div>
			<?php
		}
	
?>