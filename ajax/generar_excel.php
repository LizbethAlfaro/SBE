<?php

require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

require_once '../Clases/Informe.php';

$rutaGuardado = $_SERVER['DOCUMENT_ROOT'] . "/Informes/informe_final/";
if (!file_exists($rutaGuardado)) {
    mkdir($rutaGuardado, 0777, true);
}


$nombreArchivo = "reporte_" . date('d-m-Y') . ".xls";

if (!file_exists($rutaGuardado . $nombreArchivo)) {

//file_get_contents($_SERVER['DOCUMENT_ROOT'].'/admin/resultadoFinalExcel.php')
    ob_start ();
    require  $_SERVER['DOCUMENT_ROOT']."/admin/resultadoFinalExcel.php";
    $shtml = ob_get_clean ();
    
    $ruta = $rutaGuardado . $nombreArchivo;
    $fp = fopen($ruta, "w"); //abre el archivo en memoria
    fwrite($fp, $shtml); //escribe el contenido
    fclose($fp); //cierra el archivo

    if(Informe::registrarInformeFinal($rutaGuardado . $nombreArchivo, $nombreArchivo, $con)){
     $messages[] = "Reporte generado con éxito.";   
    }else{
     $errors[]= 'Error al generar reporte';    
    }
    
    
    
} else {
     $errors[]= 'Ya existe un reporte diario';
}
      

if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
    
