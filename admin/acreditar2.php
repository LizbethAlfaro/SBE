<?php
	session_start();
if (!isset($_SESSION['user_login_admin_status']) AND $_SESSION['user_login_admin_status'] != 1) {
    header("location: loginAdmin.php");
    exit;
}
	
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/TipoAsistente.php';
      
        
        
        if(isset($_GET['rut_estudiante'])){
         $_SESSION['estudiante_temporal'] = $_GET['rut_estudiante'];    
        } 
        $rut_estudiante =  $_SESSION['estudiante_temporal'];
        
       

	$title=" Datos personales";
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
		  <div class="modal-body">
                  <input type="hidden" id="rut_estudiante_acreditar" value="<?php echo $rut_estudiante;?>">    
	          <div id="acreditar_integrante"></div>

		  </div>


                    <!-- el select de la bd se carga en los div -->
                   
                    
                    
		<div id="resultados"></div><!-- Carga los datos ajax -->
		<div class='outer_div'></div><!-- Carga los datos ajax -->		
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("../footer.php");
	?>
         <!-- el select proviene de js -->
         <script type="text/javascript" src="../js/acreditar2_page.js"></script>
         <script type="text/javascript" src="../js/funciones/acreditar.js"></script> 
  </body>
</html>
