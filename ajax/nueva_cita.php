<?php
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Inicia validacion del lado del servidor */
if (empty($_POST['fecha_sel'])) {
    $errors[] = "No ha seleccionado un dia";
}else if ($_POST['fecha_sel'] <= date("Y-m-d")) {
    $errors[] = "No puede agendar una cita hoy o dias anteriores";    
} else if (empty($_POST['modulo_sel'])) {
    $errors[] = "No ha seleccionado modulo";
} else if (!empty($_POST['rut_estudiante'])) {
    /* Connect To Database */
    require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

    require '../Clases/Horario.php';

    $fecha_sel      = $_POST["fecha_sel"];
    $modulo_sel     = $_POST["modulo_sel"];
    $rut_estudiante = $_POST["rut_estudiante"];
    
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

        if ($query) {
            $messages[0] = "Cita actualizada exitosamente ";
        } else {
            $errors[0] = "Cita ya esta Ocupada";
        }
    } else {
        $query = Horario::seleccionarCita($rut_asistente, $rut_estudiante, $modulo_sel, $fecha_sel, $con);
        if ($query) {
            $messages[0] = "Cita agendada Exitosamente";
        } else {
            $errors[0] = "Cita ya esta Ocupada";
        }
    }
    
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



