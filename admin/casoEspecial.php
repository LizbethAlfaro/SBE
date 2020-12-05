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

        
        //clases para select
include '../Clases/Carrera.php';
include '../Clases/Genero.php';
include '../Clases/Comuna.php';
include '../Clases/Region.php';
include '../Clases/Estudiante.php';
include '../Clases/Direccion.php';
include '../Clases/FechaIng.php';
include '../Clases/Jornada.php';
include '../Clases/Becas.php'; 
include '../Clases/Scape.php';  
include '../Clases/Solicitud.php';
        
        $fecha = date("d-m-Y");
        
	$active_caso_especial="active";
	$title=" Procesos | UGM ";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("headAdmin.php");?>
  </head>
  <body>
	<?php
	include("navbarAdmin.php");
        include '../modal/registro_becas_internas_especial.php';
        include '../modal/registro_estudiante_especial.php';
	?>
	
    <div class="container">
     
	<div class="panel panel-success">
		<div class="panel-heading">
			<h4></i> Ingreso de Casos con Excepciones</h4>
		</div>
		<div class="panel-body">
                    <input type="hidden" id="fecha" value="<?php echo $fecha;?>">
                    <div id="resultados_ajax_proceso"></div>
                    <div class="form-group row text-center">
                        <div class="col-md-3">
                                    <label>&nbsp</label>
                                    <div class="form-group">

                                                
                                                     <a class="btn  btn-success btn-block " data-toggle="modal" href="#modalEstudiante" >Beca Socieconomica</a>

                                    </div>
                         </div>
                        
                        <div class="col-md-3">
                                    <label>&nbsp</label>
                                    <div class="form-group">

                                               
                                                   <a class="btn  btn-success btn-block" data-toggle="modal" href="#registro_becas_internas" >Becas Internas</a> 
                                                   

               
                                    </div>
                         </div>
                        
                        <div class="col-md-3">
                                    <label>&nbsp</label>
                                    <div class="form-group">

                                               
                                        <a class="btn  btn-warning btn-block" href="Tne.php" >TNE</a> 
                                                   

               
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
        <script type="text/javascript" src="../js/extras/validarRut.js"></script>
        <script type="text/javascript" src="../js/funciones/comuna_becas.js"></script>
        <script type="text/javascript" src="../js/casoEspecial_page.js"></script>

 
  </body>
</html>
