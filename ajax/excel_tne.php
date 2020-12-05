<?php

	include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/UMAS.php';
        include '../Clases/Scape.php';

	


        
        header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=tne.xls');

	        $tneQuery= UMAS::TNE2($con);
		$numrows = sqlsrv_num_rows($tneQuery);
		//loop through fetched data
		if ($numrows>0){

			?>
			<div class="table-responsive">
			  <table class="table">
				<thead>
    <tr class="success">
        <th>N</th>
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
                        <th class="col-sm-2"><?php echo $tneCursor['PROCESO']; ?></th>
					
                                        </tr>					
</tbody>
<?php 
$contador=$contador+1;
}
?>
				
		
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
	
