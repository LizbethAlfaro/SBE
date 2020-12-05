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
        
        
	$active_historial_beca="active";
	$title=" Becas Internas | UGM ";

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
	
      <style>
          td{
           min-width:80px;
          }    
      </style>  
    <div class="container">
     
	<div class="panel panel-success">
		<div class="panel-heading">
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Solicitudes </h4>
		</div>
		<div class="panel-body">
			
				
						<div class="form-group row">
                                                    <div class="panel">
                                                    <?php    
                                                    if (isset($_GET['error'])) {
                                                    ?>
                                                    <div class="alert alert-danger" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                    <strong>Error! <?php echo $_GET['error']; ?></strong> 
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>    
                                                        <div class="col-sm-3">
                                                        <label for="q" class="col-md-2 control-label">Rut/Nombre</label>    
                                                        <input type="text" class="form-control" id="q" placeholder="Rut o Nombre" name="rut_estudiante" onkeyup='load(1);'>   
                                                        </div>
                                                        

                                                        
                                                        <div class="col-sm-3">
                                                        <label for="q" class="col-md-2 control-label">Beca</label>   
                                                        <select class='form-control' name='beca' id='beca' onchange="load(1);">
                                                        <option value="">Selecciona una beca</option>
                                                        <?php
                                                        $beca = beca::recuperarBeca("",$con);
                                                        while ($rw = sqlsrv_fetch_array($beca)) {
                                                        ?>
                                                        <option value="<?php echo $rw['nombre_beca']; ?>"><?php echo $rw['nombre_beca']; ?></option>			
                                                        <?php
                                                        }
                                                        ?>
                                                        </select>			  
                                                        </div>
                                                        
                                                      
                                                    <div class="col-sm-3">
                                                        <label for="q" class="col-md-2 control-label">Estado</label>    
                                                        <select class='form-control' name='estado_beca' id='estado_beca' onchange="load(1);">
                                                        <option value="">Selecciona un estado</option><!--
                                                        <?php
                                                        $estado = EstadoSolicitud::recuperarEstadoBecaInterna($con);
                                                        while ($rw = sqlsrv_fetch_array($estado)) {
                                                        ?>
-->                                                        <option value="<?php echo $rw['nombre_estado']; ?>"><?php echo $rw['nombre_estado']; ?></option>			<!--
                                                        <?php
                                                        }
                                                        ?>
-->                                                     </select>			  
                                                        </div>
                                                         
                                                    </div>

						</div>

				

<div class="table-responsive" style="max-height: 600px;"> 

<table id="resultados" class="table" border="1">
<thead>
    <tr class="success">
                                    <th class="col-sm-2">Rut</th>
                                    <th>NOMBRE</th>
                                    <th>BECA</th>
					<th>Tipo</th>
                                        <th>NA</th>
                                        <th>AA</th>
                                        <th>SF</th>
                                        <th>E4</th>
                                        <th>AR</th>
                                        <th>CVD</th>
                                        <th>SD</th>
                                        <th>CF</th>
                                        <th>CT</th>
                                        <th>CP</th>
                                        <th>C.E/T</th>
                                        <th>NE</th>
                                        <th>HE</th>
                                        <th>BM</th>
                                        <th>CAE</th>
                                        <th>PSU</th>
                                        <th>ACRDT</th>
                                        <th>CALIF</th>
                                        <th>FECHA</th>
					
                                        </tr>
                                        

</thead>
<tbody class='outer_div'>
    
</tbody>
</table>

                </div>   
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("../footer.php");
	?>
         <!-- el select proviene de js --> 
         <script type="text/javascript" src="../js/funciones/estudiante_becas.js"></script>
         <script type="text/javascript" src="../js/historialBecaInterna_page.js"></script>
 
  </body>
</html>
