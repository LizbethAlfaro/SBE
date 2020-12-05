<?php

	include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/EstudianteBeca.php';
        include '../Clases/Scape.php';
        include '../Clases/Log.php';
        include '../Clases/Asistente.php';

header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=beca_interna.xls');

                $sWhere=""; 

	        $result= EstudianteBeca::recuperarEstudianteBeca("", $con,$sWhere,"","");
		$numrows = sqlsrv_num_rows($result);

	
		//main query to fetch the data

		$query = $result;
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
                              <tr  class="success">
                                    <th class="col-sm-2">Rut</th>
                                    <th class="col-sm-2">Acredita</th>
					<th>Nombre</th>
					<th>Apellido</th>
                                        <th>Beca</th>
                                        <th>Tipo</th>
                                        <th>Carrera</th>
                                        <th>Jornada</th>
                                        <th>Estado</th>
					<th>Fecha Registro</th>
					
					
				</tr>
				<?php
				while ($row=sqlsrv_fetch_array($query)){
						$rut_estudiante       = $row['rut_estudiante'];
                                                $rut_acredita         = $row['acredita'];
                                            //    $nombre_acredita      = $row['nombre'];
                                                $id_beca              = $row['beca'];
                                                $beca                 = $row['nombre_beca'];
                                                $id_tipo              = $row['reno_post'];
                                                $tipo                 = $row['descripcion_reno_post'];
						$nombre_estudiante    = $row['nombre_estudiante'];
						$apellido_estudiante  = $row['apellido_estudiante'];
                                                $carrera_estudiante   = $row['carrera_estudiante'];
                                                $jornada_estudiante   = $row['nombre_jornada'];
                                                $mail_estudiante      = $row['mail_estudiante'];
                                                $estado_estudiante    = $row['nombre_estado'];
                                                $fecha_agregado       = $row['fecha_agregado'];
                                              
						$fecha_agregado       = date('d/m/Y', strtotime($fecha_agregado));
                                                
                                                
                                                //datos asistente que acredita


if($rut_acredita!=""){
 $rut_asistente = $rut_acredita;   
}else{                                                
$rut_asistente = '000.000';
}
$habilitados = 1;

$asistenteQuery = Asistente::recuperarAsistente($rut_asistente,"",$habilitados,$con);

$asistenteArreglo;
if($asistenteQuery){
 $contador_asistente= sqlsrv_num_rows($asistenteQuery);   
}else{
 $contador_asistente=0; 
}
if($contador_asistente>0){
 while ($asistenteCursor = sqlsrv_fetch_array($asistenteQuery)) {
    $asistenteArreglo = array(
        "rut"         => $asistenteCursor['rut_asistente'],
        "nombre"      => $asistenteCursor['nombre_asistente'],
        "apellido"    => $asistenteCursor['apellido_asistente']    
    );
}   
}else{
 $asistenteArreglo = array(
        "rut"         => "",
        "nombre"      => "",
        "apellido"    => "",
    );   
}


$asistente_nombre_completo =  $asistenteArreglo['nombre']." ".$asistenteArreglo['apellido'];



					?>
					<tr>
						
						<td><?php echo $rut_estudiante;       ?></td>
                                                <td><?php echo $asistente_nombre_completo;       ?></td>
						<td><?php echo $nombre_estudiante;   ?></td>
                                                <td><?php echo $apellido_estudiante; ?></td>
                                                <td><?php echo $beca;     ?></td>
                                                <td><?php echo $tipo;     ?></td>
                                                <td><?php echo $carrera_estudiante;     ?></td>
                                                <td><?php echo $jornada_estudiante;     ?></td>
                                                <td><?php echo $estado_estudiante;     ?></td>
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