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
        include '../Clases/Atencion.php';
        
        if(isset($_GET['fecha'])){
        $fecha = $_GET['fecha'];
        }else{
        $fecha = date("d-m-Y");
        }
        
	$active_resumen_atencion="active";
	$title=" Resumen Atencion | UGM ";
        
        $sWhere="";
        $result= Atencion::recuperarAtencion($sWhere,$con);
        $numrows = sqlsrv_num_rows($result);
        
        
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
			<h4><i class='glyphicon glyphicon-search'></i> Resumen de Atenciones  - Total (<?php echo $numrows;?>)</h4>
		</div>
            <div class="panel-body">
               <form id="semana_fecha" action="resumenAtencion.php" method="GET">
               <div class="col-sm-3">
                        <label>Rut o Nombre</label>        
                       
                        <input class="form-control" type="text" id="q" onkeyup="resumenCompleto()"> 
                      
               </div>
               <div class="col-sm-2">
                   <label>&nbsp;</label>        
                       
                   <a class="btn btn-success btn-block" href="resumenAtencion_excel.php">Exportar a Excel</a>
                      
               </div>    
               </form>      
            </div>
            
		<div class="panel-body">
                    <input type="hidden" id="fecha" value="<?php echo $fecha;?>">   
                    <div class="table-responsive" style="max-height: 500px;">
                     <div id="resultados_ajax_atencion"></div><!-- Carga los datos ajax -->   
                    </div>    
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("../footer.php");
	?>
         <!-- el select proviene de js -->
         <script type="text/javascript" src="../js/funciones/asistente.js"></script>
         <script type="text/javascript" src="../js/resumenAtencion2_page.js"></script>
         
 
 
  </body>
</html>
