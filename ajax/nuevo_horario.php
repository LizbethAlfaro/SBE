<?php
include('./is_logged_admin.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Inicia validacion del lado del servidor */
if (empty($_POST['dia'])) {
    $errors[] = "No ha seleccionado un dia";
} else if (empty($_POST['rut_asistente'])) {
    $errors[] = "No ha seleccionado asistente";
} else if (!empty($_POST['dia'])) {
    /* Connect To Database */
    require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
    include '../Clases/Log.php';
    require '../Clases/Horario.php';

    $dia = $_POST["dia"];
    $rut_asistente = $_POST["rut_asistente"];
    $query;

    foreach ($_POST['dia'] as $fecha) {

        //modulos 1-25
        for ($indice = 1; $indice <= 25; $indice++) {
        $validar = Horario::validarHorarioAsistente($rut_asistente,$indice,$fecha,$con);
        if($validar==false){
            if (isset($_POST["modulo_estado_$indice"])) {
                $estado = $_POST["modulo_estado_$indice"];
            } else {
                $estado = 0;
            }
   
            $comprobar = Horario::comprobarHorario($rut_asistente,$indice,$fecha,$con);

            //si existen registros los actualizara y luego registrara
            if ($comprobar === false) {
                $errors[] = "Error Modulo $indice - $fecha";
            } else {

                $count = sqlsrv_num_rows($comprobar);

                if ($count > 0) {
                    $query = Horario::editarHorario($rut_asistente, $indice, $fecha, $estado, $con);

                } else {
                    $query = Horario::registrarHorario($rut_asistente, $indice, $fecha, $estado, $con);
                }
            }
        }else{
          $errors[]   = "Modulo $indice del dia $fecha ya esta tomado por estudiante ";  
        }
        }
    }
    
              if ($query) {
                        $messages[] = "Horario registrado Exitosamente";
                        $accion = "Registra horario semanal a $rut_asistente";
                        Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);
                    } else {
                        $errors[]   = "Error al registrar horario";
                        $accion = "Error al registrar horario de $rut_asistente";
                        Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);
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
    
    
             /*
              echo "<br> Asistente: " . $rut_asistente;
              echo "<br> Modulo: " . $indice;
              echo "<br> Fecha : " . $fecha;
              echo "<br> Estado : " . $estado;
              echo "<br>" . "--------------------------";
             */
    ?>



