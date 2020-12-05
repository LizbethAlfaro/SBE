<?php

	include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/EstudianteBeca.php';
        include '../Clases/Scape.php';
        include '../Clases/Log.php';
        include '../Clases/Asistente.php';
        
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_asistente=strval($_GET['id']);
                $estado='0';//deshabilitar
                $habilitacion="1";
		$query= Asistente::recuperarAsistente($id_asistente,"",$habilitacion,$con);
		$count=sqlsrv_num_rows($query);
                
       //         print_r($count);
		if ($count>0){ //modificado ya que decia == 0
			if ($delete= Asistente::des_habilitarAsistente($id_asistente,$estado,$con)){
                        $accion = "Deshabilito a asistente $id_asistente";
                        Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Asistente deshabilitado exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo deshabilitar al asistente, vuelva a intentarlo.
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>Error!</strong>Algo sucedio!!! Intente nuevamente.
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
                $q = $_REQUEST['q'];
                $beca = $_REQUEST['beca'];
                $estado = $_REQUEST['estado'];
		$aColumns = array('rut_estudiante','nombre_estudiante');//Columnas de busqueda

                $sWhere=""; 
                 
		if ( $_GET['q'] != "" )
		{
			$sWhere .= " AND(";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
                if($beca!=""){
                 $sWhere .= " AND beca = '$beca' ";   
                }
                if($estado!=""){
                 $sWhere .= " AND estado = '$estado' ";   
                }
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
 

	        $result= EstudianteBeca::recuperarEstudianteBeca("", $con,$sWhere,"","");
		$numrows = sqlsrv_num_rows($result);

	
		//main query to fetch the data

		$query = $result;
		//loop through fetched data
		if ($numrows>0){
			
			?>
<!--			<div class="table-responsive">-->
<!--			  <table class="table">-->
<!--                              <tr  class="success">
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
					<th class='text-right'>Acciones</th>
					
				</tr>-->
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
						
					<td class='text-right'>
						
                                            <a href="../admin/acreditarBecaInterna.php?rut_estudiante=<?php echo $rut_estudiante;?>&beca=<?php echo $id_beca;?>&tipo=<?php echo $id_tipo;?>" class='btn btn-default' title='Verificar Becas'><i class="glyphicon glyphicon-calendar"></i></a>
                                            <a class='btn btn-default' title='Editar Datos de Estudiante' data-toggle="modal"  data-target="#editar_becas_internas" data-rut="<?php echo $rut_estudiante;?>"><i class="glyphicon glyphicon-edit"></i></a>
                                             
                                            <a href="../admin/historiaBecasInternas.php?rut_estudiante=<?php echo $rut_estudiante;?>&beca=<?php echo $id_beca;?>&nombre=<?php echo $nombre_estudiante." ".$apellido_estudiante;   ?>" class='btn btn-default' title='Historial de Informes'><i class="glyphicon glyphicon-bookmark"></i></a>
					</td>
						
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
                                
                                
                                
<!--			  </table>-->
<!--			</div>-->
			<?php
		}
	}
?>