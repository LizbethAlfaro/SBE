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
        
	$active_acreditar="active";
	$title=" Acreditar | UGM ";
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
		</div>
		<div class="panel-body">
                    <div id="resultados_ajax_formulario"></div>    
			   <?php
                                include '../modal/acreditar_solicitud.php';
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
                                                    <div class="panel">
                                                        
                                                        <div class="col-sm-6">
                                                        <label for="q" class="col-md-2 control-label">Rut/Nombre/Apellido</label>    
                                                        <input type="text" class="form-control" id="q" placeholder="Rut o Nombre" onkeyup='load(1);'>   
                                                        </div>
                                                        
                                                       
                                                        <div class="col-sm-3">
                                                        <label for="q" class="col-md-2 control-label">Tipo</label>   
                                                        <select class='form-control' name='tipo_sol' id='tipo_sol' onchange="load(1);">
                                                        <option value="">Selecciona un tipo</option>
                                                        <?php
                                                        $tipo = TipoSolicitud::recuperarTipoSolicitud($con);
                                                        while ($rw = sqlsrv_fetch_array($tipo)) {
                                                        ?>
                                                        <option value="<?php echo $rw['id_tipo_solicitud']; ?>"><?php echo $rw['nombre_tipo_solicitud']; ?></option>			
                                                        <?php
                                                        }
                                                        ?>
                                                        </select>			  
                                                        </div>
                                                        
                                                     
                                                        <div class="col-sm-3">
                                                        <label for="q" class="col-md-2 control-label">Estado</label>    
                                                        <select class='form-control' name='estado_sol' id='estado_sol' onchange="load(1);">
                                                        <option value="">Selecciona un estado</option>
                                                        <?php
                                                        $estado = EstadoSolicitud::recuperarEstadoSolicitud($con);
                                                        while ($rw = sqlsrv_fetch_array($estado)) {
                                                        ?>
                                                        <option value="<?php echo $rw['id_estado_solicitud']; ?>"><?php echo $rw['nombre_estado_solicitud']; ?></option>			
                                                        <?php
                                                        }
                                                        ?>
                                                        </select>			  
                                                        </div>
                                                        
                                                        <div class="col-sm-2">
                                                            <label>&nbsp;</label>    
                                                            <a class="btn btn-info btn-block" href="./grafico.php">Estadistica</a>			  
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label>&nbsp;</label>    
                                                            <a id="notificar" class="btn btn-danger btn-block" onclick="notificarPendiente()">Notificar Sin Enviar</a>			  
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label>&nbsp;</label>    
                                                            <a  class="btn btn-info btn-block" href="historialObservacion.php">Observaciones</a>			  
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label>&nbsp;</label>    
                                                            <a  class="btn btn-warning btn-block" href="calculoFinal.php">Calculo Final</a>			  
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label>&nbsp;</label>    
                                                            <a  class="btn btn-warning btn-block" href="../ajax/excel_solicitud.php">Excel</a>			  
                                                        </div>
                                               
                                              
                                                    </div>

						</div>

				
			</form>

                    <!-- el select de la bd se carga en los div -->
                <div class="table-responsive" style="max-height: 600px;">
                <form id="solicitud">
                <table id="resultados"></table><!-- Carga los datos ajax -->
		<div class='outer_div'></div><!-- Carga los datos ajax -->
                </form>   
                </div>
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("../footer.php");
	?>
        
        
         <!-- el select proviene de js -->
         <script type="text/javascript" src="../js/funciones/formulario.js"></script>
         <script type="text/javascript" src="../js/acreditar_page.js"></script>
         <script type="text/javascript" src="../js/funciones/acreditar.js"></script>
         <script type="text/javascript" src="../js/extras/enviarMail.js"></script>
         
     
 
  </body>
</html>
