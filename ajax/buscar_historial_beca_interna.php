<?php

	include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/InformeBecaInterna.php';
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
		$aColumns = array('rut_calificacion_beca','nombre_calificacion_beca');//Columnas de busqueda

                $sWhere=""; 
                 
		if ( $_GET['q'] != "" )
		{
			$sWhere .= " AND (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
                if($beca!=""){
                 $sWhere .= " AND tipo_calificacion_beca = '$beca' ";   
                }
                if($estado!=""){
                 $sWhere .= " AND calificacion = '$estado' ";   
                }
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
 
                $rut="";
	        $result= InformeBecaInterna::recuperarHistorialBecaInterna($rut,$sWhere,$con);
		$numrows = sqlsrv_num_rows($result);

	
		//main query to fetch the data

		$query = $result;
		//loop through fetched data
		if ($numrows>0){
			
			?>
				<?php
				while ($row=sqlsrv_fetch_array($query)){
						$rut_calificacion_beca  = $row['rut_calificacion_beca'];
                                                $nombre_calificacion_beca = $row['nombre_calificacion_beca'];
                                                $tipo_calificacion_beca = $row['tipo_calificacion_beca'];
                                                $post_calificacion_beca = $row['post_calificacion_beca'];
                                                $na                     = $row['na'];
                                                $aa                     = $row['aa'];
						$sf                     = $row['sf'];
						$e4                     = $row['e4'];
                                                $ar                     = $row['ar'];
                                                $cvd                    = $row['cvd'];
                                                $sd                     = $row['sd'];
                                                $cf                     = $row['cf'];
                                                $ct                     = $row['ct'];
                                                $cp                     = $row['cp'];
                                                $cert                   = $row['cert_e_t'];
                                                $ne                     = $row['ne'];
                                                $he                     = $row['he'];
                                                $bm                     = $row['bm'];
                                                $cae                    = $row['cae'];
                                                $psu                    = $row['psu'];
                                                $acredita               = $row['acredita'];
                                                $calificacion           = $row['calificacion'];
                                                $fecha_calificacion     = date('d/m/Y', strtotime($row['fecha_calificacion']));

						
					?>
					<tr>
						
						<td><a href="../admin/historiaBecasInternas.php?rut_estudiante=<?php echo $rut_calificacion_beca;?>&nombre=<?php echo $nombre_calificacion_beca;?>"><?php echo $rut_calificacion_beca;?></a></td>
                                                <td><?php echo $nombre_calificacion_beca;       ?></td>
                                                <td><?php echo $tipo_calificacion_beca;       ?></td>
                                                <td><?php echo $post_calificacion_beca;       ?></td>
                                                <td><?php echo $na;       ?></td>
                                                <td><?php echo $aa;       ?></td>
                                                <td><?php echo $sf;       ?></td>
                                                <td><?php echo $e4;       ?></td>
                                                <td><?php echo $ar;       ?></td>
                                                <td><?php echo $cvd;       ?></td>
                                                <td><?php echo $sd;       ?></td>
                                                <td><?php echo $cf;       ?></td>
                                                <td><?php echo $ct;       ?></td>
                                                <td><?php echo $cp;       ?></td>
                                                <td><?php echo $cert;       ?></td>
                                                <td><?php echo $ne;       ?></td>
                                                <td><?php echo $he;       ?></td>
                                                <td><?php echo $bm;       ?></td>
                                                <td><?php echo $cae;       ?></td>
                                                <td><?php echo $psu;       ?></td>
                                                <td><?php echo $acredita;       ?></td>
                                                <td><?php echo $calificacion;       ?></td>
                                                <td><?php echo $fecha_calificacion;       ?></td>
    
					</tr>
					<?php
				}
				?>

<!--			  </table>-->
<!--			</div>-->
			<?php
		}
	}
?>