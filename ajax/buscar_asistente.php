<?php

	include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/Asistente.php';
        include '../Clases/Scape.php';
        include '../Clases/Log.php';
        
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
		$aColumns = array('rut_asistente','nombre_asistente');//Columnas de busqueda

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
		
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
 
                $habilitacion="1";
	        $result= Asistente::recuperarAsistente("",$sWhere,$habilitacion,$con);
		$numrows = sqlsrv_num_rows($result);
		$total_pages = ceil($numrows/$per_page);
		$reload = './asistentes.php';
		//main query to fetch the data

		$query = $result;
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="success">
                                        <th>Rut</th>
					<th>Nombre</th>
					<th>Apellido</th>
                                        <th>Mail</th>
                                        <th>Tipo</th>
					<th>Fecha Registro</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=sqlsrv_fetch_array($query)){
						$id_asistente       = $row['rut_asistente'];
						$nombre_asistente   = $row['nombre_asistente'];
						$apellido_asistente = $row['apellido_asistente'];
                                                $mail_asistente     = $row['mail_asistente'];
                                                $id_tipo_asistente  = $row['tipo'];
                                                $tipo_asistente     = $row['nombre_tipo'];
						$fecha_agregado     = date('d/m/Y', strtotime($row['fecha_agregado']));
						
					?>
					<tr>
						
						<td><?php echo $id_asistente;       ?></td>
						<td><?php echo $nombre_asistente;   ?></td>
                                                <td><?php echo $apellido_asistente; ?></td>
                                                <td><?php echo $mail_asistente;     ?></td>
                                                <td><?php echo $tipo_asistente;     ?></td>
						<td><?php echo $fecha_agregado;     ?></td>
						
					<td class='text-right'>
						
                                                <a href="#" class='btn btn-default' title='Cambiar Clave' data-id='<?php echo $id_asistente;?>' data-toggle="modal" data-target="#editar_asistente_clave"><i class="glyphicon glyphicon-cog"></i></a>
                                                <?php 
                                                if($id_asistente!="00.000.000-0"){  
                                                ?>
                                                <a href="#" class='btn btn-default' title='Deshabilitar Asistente' onclick="deshabilitarAsistente('<?php echo $id_asistente; ?>')"><i class="glyphicon glyphicon-trash"></i></a>
                                                <a href="#" class='btn btn-default' title='Editar Asistente' data-id='<?php echo $id_asistente;?>'  data-nombre='<?php echo $nombre_asistente;?>'  data-apellido='<?php echo $apellido_asistente;?>'  data-mail='<?php echo $mail_asistente;?>' data-tipo='<?php echo $id_tipo_asistente;?>' data-toggle="modal" data-target="#editar_asistente"><i class="glyphicon glyphicon-edit"></i></a> 
                                                <?php 
                                                }    
                                                ?>
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
			  </table>
			</div>
			<?php
		}
	}
?>