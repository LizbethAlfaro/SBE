<?php
	session_start();
if (!isset($_SESSION['user_login_admin_status']) AND $_SESSION['user_login_admin_status'] != 1) {
    header("location: loginAdmin.php");
    exit;
}
	
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/Proceso.php';
        include '../Clases/Solicitud.php';
            
	$active_acreditar="active";
	$title=" Historial Observacion | UGM ";
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
	
    <div class="container-fluid">
     
	<div class="panel panel-success">
		<div class="panel-heading">
			<h4></i> Observaciones </h4>
		</div>
		<div class="panel-body">
<div id="resultado_ajax_mensaje"></div>
                    <div class="panel-body">
                    
	
			
				
						<div class="form-group row">
                                                    <div class="panel">
                                                        
                                                        <div class="col-sm-2">
                                                        <label for="rut_estudiante" class="col-md-2 control-label">Rut/Nombre</label>    
                                                        <input type="text" class="form-control" id="rut_estudiante" placeholder="Rut o Nombre de Estudiante" onkeyup='load(1);'>   
                                                        </div>
  

                                                    </div>

						</div>

                        <div class="table-responsive" style="max-height: 500px;">
                        <div id="resultado_ajax" >
                            
                        </div> 
                        </div>	    

  </div>
                        

              
                </div>
                   
  
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
         <script type="text/javascript" src="../js/historialObservacion_page.js"></script>

 
  </body>
</html>
