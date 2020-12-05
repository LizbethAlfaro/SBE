<?php

	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/Departamento.php';
        
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_departamento=intval($_GET['id']);
		$query= Departamento::recuperarDepartamento($id_departamento,$con,"","","");
		$count=mysqli_num_rows($query);
		if ($count>0){ //modificado ya que decia == 0
			if ($delete= Departamento::eliminarDepartamento($id_departamento,$con)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Departamento eliminado exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo eliminar este departamento, ya que contiene trabajadores.
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
                $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		$aColumns = array('nombre_departamento');//Columnas de busqueda

                $sWhere=""; 
                 
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
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
		
	        $result=Departamento::recuperarDepartamento("",$con,$sWhere,$offset,$per_page);
		$numrows = mysqli_num_rows ($result);
		$total_pages = ceil($numrows/$per_page);
		$reload = './clientes.php';
		//main query to fetch the data

		$query = $result;
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="success">
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Agregado</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_departamento=$row['id_departamento'];
						$nombre_departamento=$row['nombre_departamento'];
						$descripcion_departamento=$row['descripcion_departamento'];
						$fecha_agregado= date('d/m/Y', strtotime($row['fecha_agregado']));
						
					?>
					<tr>
						
						<td><?php echo $nombre_departamento; ?></td>
						<td ><?php echo $descripcion_departamento; ?></td>
						<td><?php echo $fecha_agregado;?></td>
						
					<td class='text-right'>
						<a href="#" class='btn btn-default' title='Editar departamento' data-nombre='<?php echo $nombre_departamento;?>' data-descripcion='<?php echo $descripcion_departamento?>' data-id='<?php echo $id_departamento;?>' data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
						<a href="#" class='btn btn-default' title='Borrar departamento' onclick="eliminarDepartamento('<?php echo $id_departamento; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
					</td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=4><span class="pull-right">
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>