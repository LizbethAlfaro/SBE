<?php

	include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/Atencion.php';
        include '../Clases/Scape.php';
        include '../Clases/Log.php';
        include '../Clases/Asistente.php';
        
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
                $q = $_REQUEST['q'];
          //      $estado = $_REQUEST['estado'];
		$aColumns = array('estud.rut_estudiante','estud.nombre_estudiante');//Columnas de busqueda

                $fecha_actual=date('Y-m-d');
                $sWhere=" AND asig.fecha BETWEEN '$fecha_actual' AND '2999-12-01' " ; 
           
                 
		if ( $_REQUEST['q'] != "" )
		{
			$sWhere .= " AND (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}

//                if($estado!=""){
//                 $sWhere .= " AND estado = '$estado' ";   
//                }
	
 

	        $result= Atencion::recuperarAtencion($sWhere,$con);
		$numrows = sqlsrv_num_rows($result);

	
		//main query to fetch the data


		//loop through fetched data
		if ($numrows>0){
			
			?>
<table class="table">
    <tr class="success">
						
						<td>RUT ESTUDIANTE</td>
                                                <td>NOMBRE</td>
						<td>APELLIDO</td>
                                                <td>MAIL</td>
                                                <td>NOMBRE ASISTENTE</td>
                                                <td>APELLIDO</td>
                                                <td>HORARIO</td>
                                                <td class="col-sm-1">FECHA</td>
                                                <td>ESTADO SOLICITUD</td>
						
					</tr>
				<?php
				while ($row=sqlsrv_fetch_array($result)){
						$rut_estudiante       = $row['rut_estudiante'];
                                                $nombre_estudiante    = $row['nombre_estudiante'];
                                                $apellido_estudiante  = $row['apellido_estudiante'];
                                                $mail_estudiante      = $row['mail_estudiante'];
                                                $nombre_asistente     = $row['nombre_asistente'];
                                                $apellido_asistente   = $row['apellido_asistente'];
						$horario              = $row['horario'];
						$fecha                = date('d-m-Y', strtotime($row['fecha']));
                                                $nombre_estado_solicitud   = $row['nombre_estado_solicitud'];


					?>
					<tr>
						
						<td><?php echo $rut_estudiante;       ?></td>
                                                <td><?php echo $nombre_estudiante;       ?></td>
						<td><?php echo $apellido_estudiante;   ?></td>
                                                <td><?php echo $mail_estudiante; ?></td>
                                                <td><?php echo $nombre_asistente;     ?></td>
                                                <td><?php echo $apellido_asistente;     ?></td>
                                                <td><?php echo $horario;     ?></td>
                                                <td><?php echo $fecha;     ?></td>
                                                <td><?php echo $nombre_estado_solicitud;     ?></td>
						
					</tr>
					<?php
				}
				?>
				
                                
                                
                                
</table>
			<?php
		}
	}
?>