<?php
include('is_logged_admin.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Inicia validacion del lado del servidor */
if (empty($_POST['fecha_sel'])) {
    $errors[] = "No ha seleccionado un dia";
}else if ($_POST['fecha_sel'] < date("Y-m-d")) {
    $errors[] = "No puede agendar una fecha anterior a hoy";    
} else if (empty($_POST['modulo_sel'])) {
    $errors[] = "No ha seleccionado modulo";
} else if (empty($_POST['nombre_estudiante'])) {
    $errors[] = "No ha seleccionado estudiante";
} else if (empty($_POST['mail_estudiante'])) {
    $errors[] = "No contiene mail";
} else if (empty($_POST['nombre_asistente'])) {
    $errors[] = "No ha seleccionado asistente";    
} else if (!empty($_POST['rut_estudiante'])) {
    /* Connect To Database */
    require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

    require '../Clases/Horario.php';
    require '../Clases/Estudiante.php';
    require '../Mail/email.php';
    require '../Clases/Log.php';

    $fecha_sel      = $_POST["fecha_sel"];
    $modulo_sel     = $_POST["modulo_sel"];
    $rut_estudiante = $_POST["rut_estudiante"];
    
    $result_modulo=Horario::obtenerHoraModulo($modulo_sel,$con);
    
    $horaArreglo;
    while ($horaCursor = sqlsrv_fetch_array($result_modulo)) {
        $horaArreglo = array(
            "horario" => $horaCursor['horario'],
        );
    }
    
    
    $nombre_estudiante = $_POST["nombre_estudiante"];
    $mail_estudiante   = $_POST["mail_estudiante"];
    $nombre_asistente  = $_POST["nombre_asistente"];
    $imagen="http://www.bettersoft.cl/images/resource/u-gabriela-mistral2.jpg";
    $fecha = Horario::fechaCastellano(date("Y-m-d", strtotime($fecha_sel)))." a las ".$horaArreglo['horario'];
 
    $asistente_query = Horario::recuperarAsistenteCitaMin($rut_estudiante,$fecha_sel,$modulo_sel,$con);

    $asistenteArreglo;
    while ($asistenteCursor = sqlsrv_fetch_array($asistente_query)) {
        $estudianteArreglo = array(
            "rut" => $asistenteCursor['rut_asistente'],
        );
    }
    if(isset($estudianteArreglo['rut'])){
    $rut_asistente = $estudianteArreglo['rut'];
    $query = Horario::validarExistenciaCita($rut_estudiante,$con);

    if($query){
    $verificar = sqlsrv_num_rows($query);
    }else{
     $verificar=0;   
    }
 
    if ($verificar > 0) {
        $query = Horario::editarCita($rut_asistente, $rut_estudiante, $modulo_sel, $fecha_sel, $con);
        $tipo = 1;
        Mail::enviarMail($nombre_estudiante,$nombre_asistente,$tipo,$mail_estudiante,$imagen,$fecha);
      
        if ($query) {
            $messages[0] = "Se notificara al mail del estudiante '$mail_estudiante'";
            $accion = "Se re-agendo la cita del estudiante $rut_estudiante a $fecha_sel";
        } else {
            $errors[0] = "Error al notificar";
            $accion = "Error al re-agendar la cita del estudiante $rut_estudiante a $fecha_sel";
        }
        
    } else {
        $query = Horario::seleccionarCita($rut_asistente, $rut_estudiante, $modulo_sel, $fecha_sel, $con);
        $tipo = 1;
        
        Mail::enviarMail($nombre_estudiante,$nombre_asistente,$tipo,$mail_estudiante,$imagen,$fecha);
       
        if ($query) {
            $messages[0] = "Se notificara al mail del estudiante '$mail_estudiante'";
               $accion = "Se re-agendo la cita del estudiante $rut_estudiante a $fecha_sel";
        } else {
            $errors[0] = "Error al notificar";
            $accion = "Error al re-agendar la cita del estudiante $rut_estudiante a $fecha_sel";
        }
    }
    

   Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);
    
    }else{
      $errors [] = "Horario no disponible.";   
    }
} else {
    $errors [] = "Error desconocido.";
}

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



