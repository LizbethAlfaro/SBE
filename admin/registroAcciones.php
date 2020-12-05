<?php
	session_start();
if (!isset($_SESSION['user_login_admin_status']) AND $_SESSION['user_login_admin_status'] != 1) {
    header("location: loginAdmin.php");
    exit;
}

if($_SESSION['tipo_asistente'] < 2){
header('location: horarioPersonal.php');    
}

	
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/TipoSolicitud.php';
        include '../Clases/EstadoSolicitud.php';
        
        $fecha = date("d-m-Y");
        
	$active_registro_acciones="active";
	$title=" LOG | UGM ";
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
			<h4><i class='glyphicon glyphicon-search'></i> Registro de Acciones </h4>
		</div>
		<div class="panel-body">
                    <input type="hidden" id="fecha" value="<?php echo $fecha;?>">
                    
                    <div class="form-group row text-center">
                        <div class="col-md-3">
                                    <label>Rut o Nombre</label>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                               
                                            <input id="q" class="form-control" onkeyup="load(1)">

                                        </div>
                                    </div>
                                </div>
                         <div class="col-md-3">
                                    <label>Accion</label>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                               
                                            <input id="accion" class="form-control" onkeyup="load(1)">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Fecha Inicio</label>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                               
                                  <input id="fecha_inicio" class="form-control" type="date" onchange="load(1)">

                                        </div>
                                    </div>
                                </div>
                                <label></label>
                                <div class="col-md-3">
                                    <label>Fecha termino</label>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input id="fecha_termino" class="form-control" type="date" onchange="load(1)"> 
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                    
                    <div class="table-responsive" style="overflow-y: auto; height: 500px;">
                     <div id="resultados_ajax_log"></div><!-- Carga los datos ajax -->   
                    </div>    
  </div>
</div>
		 
	</div>
	<hr>
	<?php
	include("../footer.php");
	?>
         <!-- el select proviene de js -->
         <script type="text/javascript" src="../js/funciones/registroAcciones.js"></script>
         <script type="text/javascript" src="../js/registroAcciones_page.js"></script>
         
 
 
  </body>
</html>
