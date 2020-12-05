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
	include '../Clases/Informe.php';
        include '../Clases/Horario.php';

        
        
	$active_acreditar="active";
	$title=" Historial | UGM ";
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
			<h4><i class='glyphicon glyphicon-search'></i> Historial de Reportes </h4>
		</div>
		<div class="panel-body">
                    <div class="table-responsive" style="overflow-y: auto; max-height: 500px;">
                        <table class="table" border="0">
                            <thead>
                            
                            <td>NOMBRE</td>
                            <td>FECHA</td>
                            <td>ACCION</td>
                           
                            </thead>
                            <tbody>
                    <?php
            $result_informe= Informe::recuperarInformeFinal($con);
            $contador_informe=0;
            
            if($result_informe){
              $contador_informe= sqlsrv_num_rows($result_informe);  
            }
     
		if ($contador_informe>0){
                    while($cursor_informe= sqlsrv_fetch_array($result_informe)){;
                    
                ?>
                                <tr>
                                   
                                    <td><?php echo $cursor_informe['nombre'];?></td>  
                                    <td><?php echo Horario::fechaCastellano(date('d-m-Y', strtotime($cursor_informe['fecha'])));?></td> 
                                    <td><a href="../descarga_excel.php?ruta=<?php echo $cursor_informe['ruta'];?>">Descargar</a></td>  
                                </tr>               
                                
                <?php
                }}
                ?>                
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


         
 
 
  </body>
</html>
