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
        
        $rut_estudiante="";
        $condicion_sin_enviar=" AND sol.estado = 0 ";
        $result_sin_enviar= Solicitud::recuperarSolicitud($rut_estudiante,$condicion_sin_enviar,$con);
        
        $condicion_pendiente=" AND sol.estado = 1";
        $result_pendiente= Solicitud::recuperarSolicitud($rut_estudiante,$condicion_pendiente,$con);
        
        $condicion_en_revision=" AND sol.estado = 2";
        $result_en_revision= Solicitud::recuperarSolicitud($rut_estudiante,$condicion_en_revision,$con);
        
        $condicion_acreditado=" AND sol.estado = 3";
        $result_acreditado= Solicitud::recuperarSolicitud($rut_estudiante,$condicion_acreditado,$con);
        
        $condicion_terminado=" AND sol.estado = 4";
        $result_terminado= Solicitud::recuperarSolicitud($rut_estudiante,$condicion_terminado,$con);
        
        $sin_enviar = sqlsrv_num_rows($result_sin_enviar);
        $pendiente  = sqlsrv_num_rows($result_pendiente);
        $en_revision= sqlsrv_num_rows($result_en_revision);
        $acreditado = sqlsrv_num_rows($result_acreditado);
        $terminado = sqlsrv_num_rows($result_terminado);
        $total=$sin_enviar+$pendiente+$en_revision+$acreditado+$terminado;
	$active_acreditar="active";
	$title=" Estadisticas | UGM ";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("headAdmin.php");?>
   <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>   
  </head>
  <body>
	<?php
	include("navbarAdmin.php");
	?>
	
    <div class="container">
     
	<div class="panel panel-success">
		<div class="panel-heading">
			<h4></i> Cantidad de Solicitudes </h4>
		</div>
		<div class="panel-body">
                    <input type="hidden" id="fecha" value="<?php echo $fecha;?>">
                    <div id="resultados_ajax_proceso"></div>
                    <div class="form-group row text-center">
<!--                        <div><?php echo $sin_enviar;?></div>
                        <div><?php echo $pendiente;?></div>
                        <div><?php echo $en_revision;?></div>
                        <div><?php echo $acreditado;?></div>-->
                        

<canvas id="myChart" ></canvas>
     
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['SIN ENVIAR (<?php echo $sin_enviar;?>)', 'PENDIENTE DE REVISION (<?php echo $pendiente;?>)', 'EN REVISION (<?php echo $en_revision;?>)', 'ACREDITADO (<?php echo $acreditado;?>)', 'TERMINO DE PROCESO (<?php echo $terminado;?>)'],
        datasets: [{
            label: 'TOTAL <?php echo $total;?>',
            data: [<?php echo $sin_enviar;?>, <?php echo $pendiente;?>, <?php echo $en_revision;?>, <?php echo $acreditado;?>, <?php echo $terminado;?>,],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'

            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'

            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
               
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
         <script type="text/javascript" src="../js/funciones/proceso.js"></script>

 
  </body>
</html>
