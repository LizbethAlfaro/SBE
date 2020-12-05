<?php
	session_start();
if (!isset($_SESSION['user_login_admin_status']) AND $_SESSION['user_login_admin_status'] != 1) {
    header("location: loginAdmin.php");
    exit;
}
//
//if($_SESSION['tipo_asistente'] < 2){
//header('location: horarioPersonal.php');    
//}

	
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/TipoSolicitud.php';
        include '../Clases/EstadoSolicitud.php';
        
        
	$active_acreditar="active";
	$title=" Calculo | UGM ";
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
			<h4><i class='glyphicon glyphicon-search'></i> Puntuación Por Item </h4>
		</div>
		<div class="panel-body">
                <div id="resultados_ajax_mensaje"></div>
                <div class="panel">
                        
                    <a href="resultadoFinal.php" class="btn btn-block btn-warning">Ver Resultados</a>
                        
                    </div>  
                    <div class="panel">
                        
                        <button class="btn btn-block btn-info" onclick="editarVariables()">REGISTRAR PUNTUACION</button>
                        
                    </div>    
 
                    <div class="table-responsive" style="overflow-y: auto; height: 500px;">
                    <form id="calculo_final">   
                     <div id="resultados_ajax_calculo"></div><!-- Carga los datos ajax -->  
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
         <script type="text/javascript" src="../js/extras/CalculoFinal.js"></script>

         
 
 
  </body>
</html>
