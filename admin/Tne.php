<?php
	session_start();
if (!isset($_SESSION['user_login_admin_status']) AND $_SESSION['user_login_admin_status'] != 1) {
    header("location: loginAdmin.php");
    exit;
}
	
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/TipoSolicitud.php';
        include '../Clases/EstadoSolicitud.php';
        include '../Clases/Becas.php';
        include '../Clases/UMAS.php';
        
        //clases para select

include '../Clases/Scape.php';  

$tneQuery = UMAS::TNE2($con);

 if($tneQuery){
 $contador_tne = sqlsrv_num_rows($tneQuery); 

}
else{
  $contador_tne = -1 ;   
} 
        
	$active_caso_especial="active";
	$title=" TNE | UGM ";

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("headAdmin.php");?>
  </head>
  <body>
	<?php
	include("navbarAdmin.php");
	?>
	
    <div class="container">
     
	<div class="panel panel-success">
            
		<div class="panel-heading">
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Solicitudes </h4>
                           
                                                            <a  class="btn btn-warning btn-block" href="../ajax/excel_tne.php">Excel</a>			  
                                                       
		</div>
             
		<div class="panel-body">
	


                    <!-- el select de la bd se carga en los div -->
                <div class="table-responsive" style="max-height: 600px;"> 
<!--                    <div id="resultados"></div>-->
<table id="resultados" class="table">
<thead>
    <tr class="success">
        <th>N°</th>
                                    <th class="col-sm-2">RUT</th>
                                    <th class="col-sm-2">NOMRE</th>
				<th class="col-sm-2">PATERNO</th>
                                <th class="col-sm-2">MATERNO</th>
                                <th class="col-sm-2">FECHA</th>
                                <th class="col-sm-2">FONO</th>
                                <th class="col-sm-2">PROCESO</th>
    
                                
                                        </tr>					
</thead>
<tbody>
    <?php 
    $contador=1;
    while ($tneCursor = sqlsrv_fetch_array($tneQuery)) {
 
    ?>
    <tr class="success">
        <th><?php echo $contador; ?></th>
                                    <th class="col-sm-2"><?php echo $tneCursor['RUT']; ?></th>
                                    <th class="col-sm-2"><?php echo $tneCursor['NOMBRE']; ?></th>
			<th class="col-sm-2"><?php echo $tneCursor['MATERNO']; ?></th>
                        <th class="col-sm-2"><?php echo $tneCursor['PATERNO']; ?></th>
                        <th class="col-sm-2"><?php echo $tneCursor['FECHA']; ?></th>
                        <th class="col-sm-2"><?php echo $tneCursor['FONO']; ?></th>
                        <th class="col-sm-2"><?php echo Scape::ms_escape_string($tneCursor['PROCESO']); ?></th>
					
                                        </tr>					
</tbody>
<?php 
$contador=$contador+1;
}
?>
<tfoot class='outer_div'>
    
</tfoot>
</table>

                </div>   
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("../footer.php");
	?>


 
  </body>
</html>
