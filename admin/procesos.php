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
	include '../Clases/Proceso.php';

        
        $fecha = date("d-m-Y");
        
	$active_procesos="active";
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
	?>
	
    <div class="container">
     
	<div class="panel panel-success">
		<div class="panel-heading">
			<h4></i> Procesos </h4>
		</div>
		<div class="panel-body">
                    <input type="hidden" id="fecha" value="<?php echo $fecha;?>">
                    <div id="resultados_ajax_proceso"></div>
                    <div class="form-group row text-center">
                        <div class="col-md-3">
                                    <label>&nbsp</label>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                               
                                            <button onclick="registrarFechaProceso()" class=" btn btn-info btn-block">Registrar fecha</button>

                                        </div>
                                    </div>
                                </div>
                         <div class="col-md-3">
                                    <label>Tipo Proceso</label>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <select class='form-control' name='id_proceso' id='id_proceso' required>
						<option value="">Selecciona tipo</option>
							<?php 
                                                        $id="";
							$query_tipo= Proceso::recuperarProceso($id,$con);
							while($rw=sqlsrv_fetch_array($query_tipo))	{
								?>
							<option value="<?php echo $rw['id_tipo_proceso'];?>"><?php echo $rw['nombre_tipo_proceso'];?></option>			
								<?php
							}
							?>
					</select>			  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Fecha Inicio</label>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                               
                                  <input id="fecha_inicio" class="form-control" type="date">

                                        </div>
                                    </div>
                                </div>
                                <label></label>
                                <div class="col-md-3">
                                    <label>Fecha termino</label>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input id="fecha_termino" class="form-control" type="date"> 
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                   
  
  </div>
</div>
        
<div class="panel panel-success">

                    <div class="panel">
                        <div class="panel-primary">
                            <label class="alert alert-danger col-sm-12 text-center" >CUIDADO, ACCIONES IRREVERSIBLES!!!</label>
                        </div>    
                    <table border="0" class="table">
                        <thead>
                            <tr>
                                <th colspan="2"><label>Ingrese Contraseña</label><input class="form-control" id="pass" name="pass" type="password"></th>
                                
                            </tr>
                            <tr>
                                <th><button class=" btn btn-info btn-block" onclick="aperturaCierreProceso(1)">Abrir Proceso</button></th>
                                <th><button class=" btn btn-danger btn-block" onclick="aperturaCierreProceso(2)">Cerrar Proceso</button></th>
                            </tr>
                        </thead>
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
         <script type="text/javascript" src="../js/funciones/proceso.js"></script>

 
  </body>
</html>
