<?php

	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
        include '../Mail/email.php';
        include '../Clases/Usuario.php';

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
       

      $id_evaluado=$_POST['rut'];
      $evaluado=$_POST['nombre'];
      $encuesta=$_POST['nombre_encuesta'];
      $evaluador=$_SESSION['nombre_usuario'];
      
      $tipo = 2;    
      
      $imagen=$_POST['imagen'];
      $query= Usuario::recuperarUsuario($id_evaluado,$con,"","","");
      $rw_user=mysqli_fetch_array($query);
      $destino=$rw_user['mail_usuario'];
      
      // pasar chart js a imagen
      $imagen = $_POST['imagen'];
      $imagen = str_replace('data:image/png;base64,', '', $imagen);
 
  
      
      $messages[]=Mail::enviarMail($evaluado,$evaluador,$tipo,$destino,$imagen,$encuesta);


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
?>

