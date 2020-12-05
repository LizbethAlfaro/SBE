<?php

	session_start();
if (!isset($_SESSION['user_login_admin_status']) AND $_SESSION['user_login_admin_status'] != 1) {
    header("location: loginAdmin.php");
    exit;
}
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/Atencion.php';
        include '../Clases/Scape.php';
        include '../Clases/Log.php';
        include '../Clases/Asistente.php';
        
   //     header('Content-type:application/xls; charset=utf-8 ');
        header("Content-Type: application/vnd.ms-excel charset=iso-8859-1");

	header('Content-Disposition: attachment; filename=atenciones.xls');


		// escaping, additionally removing everything that could be (html/javascript-) code
                $q = "";
          //      $estado = $_REQUEST['estado'];
		$aColumns = array('estud.rut_estudiante','estud.nombre_estudiante');//Columnas de busqueda

                $sWhere=""; 
                 
		if ( $q != "" )
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1 " />
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
                                                <td><?php echo Scape::ms_escape_string($nombre_estudiante);       ?></td>
						<td><?php echo Scape::ms_escape_string($apellido_estudiante);   ?></td>
                                                <td><?php echo $mail_estudiante; ?></td>
                                                <td><?php echo Scape::ms_escape_string($nombre_asistente);     ?></td>
                                                <td><?php echo Scape::ms_escape_string($apellido_asistente);     ?></td>
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
	
?>