<?php

	require_once ("./config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("./config/conexion.php");//Contiene funcion que conecta a la base de datos
        include './Mail/email.php';
        include './Clases/Estudiante.php';

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
 if ($_POST['rut']!="") {
     

       

      $rut=$_POST['rut'];

      
      $tipo = 5;    


$condicion = ""; //where...

$estudianteQuery = Estudiante::recuperarEstudiante($rut, $con, $condicion, "", "");

if($estudianteQuery){
    $contador= sqlsrv_num_rows($estudianteQuery);
}else{
   $contador=0; 
}

if($contador>0){
$estudianteArreglo;
while ($estudianteCursor = sqlsrv_fetch_array($estudianteQuery)) {
    $estudianteArreglo = array(
        "rut"       => $estudianteCursor['rut_estudiante'],
        "nombre"    => $estudianteCursor['nombre_estudiante'],
        "apellido"  => $estudianteCursor['apellido_estudiante'],
        "fechaNac"  => $estudianteCursor['fechaNac_estudiante'],
        "genero"    => $estudianteCursor['genero_estudiante'],
        "fono"      => $estudianteCursor['fono_estudiante'],
        "movil"     => $estudianteCursor['movil_estudiante'],
        "mail"      => $estudianteCursor['mail_estudiante'],
        "fechaIng"  => $estudianteCursor['fechaIng_estudiante'],
        "carrera"   => $estudianteCursor['carrera_estudiante'],
        "jornada"   => $estudianteCursor['nombre_jornada'],
    );
}

$estudiante=$estudianteArreglo['nombre']." ".$estudianteArreglo['apellido'];
$destino=$estudianteArreglo['mail'];

$imagen="http://www.bettersoft.cl/images/resource/u-gabriela-mistral2.jpg";
      
      $messages[]=Mail::enviarMail($estudiante,$rut,$tipo,$destino,$imagen,"");
}else{
    $errors[]="No hay correo registrado";
}      

}else{
        $errors[] = "Rut vacío";
}

if (isset($messages)) {

?>
    				<div class="alert alert-success" role="alert">
    						<button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <strong>¡Mail Enviado a: <?php echo $destino; ?></strong>
    <?php
    foreach ($messages as $message) {
        echo $message;
    }
    ?>
				</div>
			
  
 <?php	
}

if (isset($errors)) {
 foreach ($errors as $error) {
?>
    				<div class="alert alert-danger" role="alert">
    						<button type="button" class="close" data-dismiss="alert">&times;</button>
                                                <strong>¡Error: <?php echo $error; ?></strong>
                                                	</div>
    <?php

    }
    ?>
			
			
  
 <?php	
}
?>

