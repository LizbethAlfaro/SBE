<?php
include('is_logged_admin.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Inicia validacion del lado del servidor */
 if (empty($_POST['rut'])) {
        $errors[] = "Rut vacío";
    } elseif (strlen($_POST['rut']) > 13 || strlen($_POST['rut']) < 2) {
        $errors[] = "rut no puede ser inferior a 2 o más de 13 caracteres";
    } elseif (empty($_POST['nombre'])) {
        $errors[] = "El nombre no puede estar vació";
    } elseif (empty($_POST['apellido'])) {
        $errors[] = "El apellido no puede estar vació";
    } elseif (empty($_POST['mail'])) {
        $errors[] = "El correo electrónico no puede estar vacío";
    } elseif (empty($_POST['mail'])) {
        $errors[] = "El correo electrónico no puede estar vacío";
    } elseif (strlen($_POST['mail']) > 64) {
        $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
    } elseif (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
    } elseif (empty($_POST['tipo_asistente'])) {
    $errors[] = "El tipo no puede estar vacío";
    } else if (
            !empty($_POST['rut']) &&
            !empty($_POST['nombre'])
    ) {
        /* Connect To Database */
        require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
        require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
        include '../Clases/Asistente.php';
        include '../Clases/Scape.php';
        include '../Clases/Log.php';
// escaping, additionally removing everything that could be (html/javascript-) code
        $rut        = $_POST["rut"];
        $nombre     = Scape::ms_escape_string($_POST["nombre"]);
        $apellido   = Scape::ms_escape_string($_POST["apellido"]);
        $mail       = $_POST["mail"];
        $tipo       = $_POST["tipo_asistente"];
      
        $query_update = Asistente::editarAsistente($rut,$nombre,$apellido,$mail,$tipo,$con);
        if ($query_update) {
            $messages[] = "Asistente ha sido actualizado satisfactoriamente.";
            $accion = "Actualizo datos de asistente $rut";
        } else {
            $errors [] = "Lo siento algo ha salido mal intenta nuevamente.";
            $accion = "Error al actualizar datos de asistente $rut";
        }
        
        Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);

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