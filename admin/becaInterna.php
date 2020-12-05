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
        
        //clases para select
include '../Clases/Carrera.php';
include '../Clases/Genero.php';
include '../Clases/Comuna.php';
include '../Clases/Region.php';
include '../Clases/Estudiante.php';
include '../Clases/Direccion.php';
include '../Clases/FechaIng.php';
include '../Clases/Jornada.php';
include '../Clases/Scape.php';  
include '../Clases/Solicitud.php';
        
        
	$active_beca="active";
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
	
    <div class="container">
     
	<div class="panel panel-success">
		<div class="panel-heading">
			<h4><i class='glyphicon glyphicon-search'></i> Buscar Solicitudes </h4>
		</div>
		<div class="panel-body">
			   <?php
                                include '../modal/acreditar_solicitud.php';
                                include '../modal/editar_becas_internas.php';
			?>
<!--EVITA TECLA ENTER SUBMIT-->
<!--<script>
function pulsar(e) {
  tecla = (document.all) ? e.keyCode :e.which;
  return (tecla!=13);
}
</script>-->
<!--                    <form  name="form_Xve" method="GET" action="acreditarBecaInterna.php" accept-charset="UTF-8" >-->
  
                            
				
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
                                                        

                                                        
                                                        <div class="col-sm-2">
                                                        <label for="q" class="col-md-2 control-label">Beca</label>   
                                                        <select class='form-control' name='beca' id='beca' onchange="load(1);">
                                                        <option value="">Selecciona una beca</option>
                                                        <?php
                                                        $beca = beca::recuperarBeca("",$con);
                                                        while ($rw = sqlsrv_fetch_array($beca)) {
                                                        ?>
                                                        <option value="<?php echo $rw['id_beca']; ?>"><?php echo $rw['nombre_beca']; ?></option>			
                                                        <?php
                                                        }
                                                        ?>
                                                        </select>			  
                                                        </div>
                                                        
                                                      
                                                    <div class="col-sm-2">
                                                        <label for="q" class="col-md-2 control-label">Estado</label>    
                                                        <select class='form-control' name='estado_beca' id='estado_beca' onchange="load(1);">
                                                        <option value="">Selecciona un estado</option><!--
                                                        <?php
                                                        $estado = EstadoSolicitud::recuperarEstadoBecaInterna($con);
                                                        while ($rw = sqlsrv_fetch_array($estado)) {
                                                        ?>
-->                                                        <option value="<?php echo $rw['id_estado']; ?>"><?php echo $rw['nombre_estado']; ?></option>			<!--
                                                        <?php
                                                        }
                                                        ?>
-->                                                     </select>			  
                                                        </div>
                                                        
                                                        <div class="col-sm-2">
                                                        <label>&nbsp</label>    
                                                        <a class="btn btn-block btn-success" href="historialCalificacion.php">Historial</a>			  
                                                        </div>
                                                        <div class="col-sm-2">
                                                        <label>&nbsp</label>    
                                                        <a class="btn btn-block btn-success" href="../ajax/excel_estudiante_beca_interna.php">Excel</a>			  
                                                        </div>
                                                         
                                                    </div>

						</div>

				
<!--			</form>-->



                    <!-- el select de la bd se carga en los div -->
                <div class="table-responsive" style="max-height: 600px;"> 
<!--                    <div id="resultados"></div>-->
<table id="resultados" class="table">
<thead>
    <tr class="success">
                                    <th class="col-sm-2">Rut</th>
                                    <th class="col-sm-2">Acredita</th>
					<th>Nombre</th>
					<th>Apellido</th>
                                        <th>Beca</th>
                                        <th>Tipo</th>
                                        <th>Carrera</th>
                                        <th>Jornada</th>
                                        <th>Estado</th>
					<th>Fecha Recepcion</th>
					<th class='text-right'>Acciones</th>
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
         <script type="text/javascript" src="../js/funciones/estudiante_becas.js "></script>
         <script type="text/javascript" src="../js/funciones/estudiante_becas.js"></script>
         <script type="text/javascript" src="../js/becaInterna_page.js"></script>
<script>
$('#editar_becas_internas').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
  
    var rut         =   button.data('rut')      

console.log(rut)
    
    var modal = $(this)
    
    modal.find('.modal-body #rut_estudiante_beca')          .val(rut)
    

});
</script>

 
  </body>
</html>
