<?php
include('is_logged_admin.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Inicia validacion del lado del servidor */

    /* Connect To Database */
    require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

    require '../Clases/Horario.php';
    require '../Clases/Estudiante.php';
    require '../Clases/Solicitud.php';
    require '../Mail/email.php';
    require '../Clases/Log.php';

    $condicion=" AND sol.estado = 0 ";
    $result_solicitud =Solicitud::recuperarSolicitud("",$condicion,$con);
    
   
    while ($solicitudCursor = sqlsrv_fetch_array($result_solicitud)) {
   // echo $solicitudCursor["rut_estudiante"];     
    $rut_estudiante[] = $solicitudCursor["rut_estudiante"];    
    }
    
    $imagen="http://www.bettersoft.cl/images/resource/u-gabriela-mistral2.jpg";

    $offset="";
    $per_page="";
    $condicion_2="";
    $tipo=4;
    for($indice = 0 ; $indice < count($rut_estudiante);$indice++){  

    $result_estudiante = Estudiante::recuperarEstudiante($rut_estudiante[$indice], $con,$condicion_2,$offset,$per_page);
    $arreglo= sqlsrv_fetch_array($result_estudiante);
    
   // echo "<br>".$arreglo['nombre_estudiante'];
   // echo "<br>".$arreglo['mail_estudiante'];
    

    $mail_estudiante=$arreglo['mail_estudiante'];
    if($mail_estudiante!=""){
   //  $mail_estudiante=$arreglo['mail_estudiante'];+
    // $mail_estudiante="sony.oyarzun@gmail.com";   
     Mail::enviarMail($arreglo['nombre_estudiante'],"",$tipo,$mail_estudiante,$imagen,"");
    $messages[0]=" Notificacion Exitosa";
    }
    
    
    }
    

  // Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);



if (isset($errors)) {
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
    if (isset($messages)) {
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

    ?>



