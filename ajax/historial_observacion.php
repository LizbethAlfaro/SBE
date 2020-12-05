<?php
include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database */
require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

include '../Clases/Scape.php';
include '../Clases/Estudiante.php';
include '../Clases/Observacion.php';
include '../Clases/Log.php';




$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if (isset($_REQUEST['id'])){
		$id=strval($_REQUEST['id']);
                

			if ($delete= Observacion::eliminarObservacion($id,$con)){
                        $accion = "Elimino observacion id $id";
                        Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Observacion Eliminada exitosamente.
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
			
		} 
		
		
		
	


if ($action == 'ajax') {

     $rut = $_REQUEST['rut'];

    
     $aColumns = array('estud.rut_estudiante','estud.nombre_estudiante');//Columnas de busqueda
	
                 $sWhere = "";
                 /*
                 if (isset($_GET['rut_estudiante'])){
                 $rut_estudiante = $_REQUEST['rut_estudiante'];    
		 $sWhere = " AND .id_encuesta=$id_encuesta ";
                 }
                 */
		if ( $rut != "" )
		{
			$sWhere = "AND (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$rut."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}



 
        
  //observacion 

  
     $observacionQuery = Observacion::recuperarObservacion("",$sWhere,$con);

     if($observacionQuery){     
        $contador= sqlsrv_num_rows($observacionQuery); 
     }else{
        $contador= 0; 
     }
        
           
        

        ?>
        <div class="table-responsive">
            <table class="table" border='0'>
                <tr  class="success">
                    <th class="col-sm-1">Rut</th>
                    <th class="col-sm-1">Nombre</th>
                    <th class="col-sm-1">Apellido</th>

                    
                    <th class="col-sm-1">Funciones</th>
                    <th class="col-sm-1">Miembro estudiante</th>
                    <th class="col-sm-1">Factor</th>
                    <th class="col-sm-1">Tramo</th>
                    <th class="col-sm-1">Distancia</th>
                    <th class="col-sm-1">Asistente</th>
                    <th class="col-sm-1">Fecha</th>
                    <th>Observacion</th>
                     <?php
                     if($_SESSION['tipo_asistente']==2){
                     ?>
                    <th>Accion</th>
                     <?php
                     }
                     ?>
                </tr>
                <?php
                if($contador>0){
                while ($observacionCursor = sqlsrv_fetch_array($observacionQuery)) {
       
            
                ?>
                <tr>

                    <td><?php echo Scape::ms_escape_string($observacionCursor['rut_estudiante']) ?></td>
                    <td><?php echo Scape::ms_escape_string($observacionCursor['nombre_estudiante']) ?></td>
                    <td><?php echo Scape::ms_escape_string($observacionCursor['apellido_estudiante']) ?></td>
                    
                    <td><?php echo Scape::ms_escape_string($observacionCursor['descripcion_duplicidad']) ?></td>
                    <td><?php echo Scape::ms_escape_string($observacionCursor['descripcion_otro_miembro']) ?></td>
                    <td><?php echo Scape::ms_escape_string($observacionCursor['descripcion_factor']) ?></td>
                    <td><?php echo Scape::ms_escape_string($observacionCursor['descripcion_tramo']) ?></td>
                    <td><?php echo Scape::ms_escape_string($observacionCursor['descripcion_distancia']) ?></td>
                    <td><?php echo Scape::ms_escape_string($observacionCursor['nombre_asistente']." ".$observacionCursor['apellido_asistente']); ?></td>
                    <td><?php echo date('d-m-Y', strtotime($observacionCursor['fecha_agregado']));?></td>
                    <td><?php echo Scape::ms_escape_string($observacionCursor['observacion']) ?></td>
                     <?php
                     if($_SESSION['tipo_asistente']==2){
                     ?>
                    <td><a title="Eliminar Observacion" class="btn btn-default" onclick="eliminarObservacion(<?php echo $observacionCursor['id_observacion']; ?>)"><i class="glyphicon glyphicon-trash"></i></a></td>
                     <?php
                     }
                     ?>
                </tr>
<?php                               
                }}
?>
            </table>


        </div>
        <?php
    }

?>