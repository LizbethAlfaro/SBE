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

    require '../Clases/Horario.php';
    require '../Clases/Log.php';

    $dia = $_POST["dia"];
    $rut_asistente = $_POST["rut_asistente"];
    $query = false;
    $arreglo= $_POST['dia'];
    

        //modulos 1-25
        for ($dia = 1; $dia <= 7; $dia++) {

            $fecha=$arreglo[$dia-1];
            
            for ($modulo = 1; $modulo <= 25; $modulo++) {
                if (isset($_POST["dia_".$dia."_modulo_".$modulo])) {
                    $estado = $_POST["dia_".$dia."_modulo_".$modulo];
                } else {
                    $estado = 0;
                }
            
                $comprobar = Horario::comprobarHorario($rut_asistente, $modulo, $fecha, $con);

                
                //si existen registros los actualizara y luego registrara
                if ($comprobar === false) {
                    $errors[] = "Error Modulo $dia - $modulo";
                } else {

                    $count = sqlsrv_num_rows($comprobar);

                    if ($count > 0) {
                        $query = Horario::editarHorario($rut_asistente, $modulo, $fecha, $estado, $con);
                    } else {
                        $query = Horario::registrarHorario($rut_asistente, $modulo, $fecha, $estado, $con);
                    }
                }
                
                
            }
        }


    if ($query) {
                        $messages[] = "Horario registrado Exitosamente";
                                 $accion = "Registra horario modular a $rut_asistente";
                                 Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);
                    } else {
                        $errors[]   = "Error al registrar horario";
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
              echo "<br> dia: " . $dia;
              echo "<br> Modulo: " . $modulo;
              echo "<br> Fecha : " . $fecha;
              echo "<br> Estado : " . $estado;
              echo "<br>" . "--------------------------";
              */  
    ?>



