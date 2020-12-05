<?php
include('is_logged_admin.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../libraries/password_compatibility_library.php");
}
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
    $errors[] = "El tipo no puede estar vació";    
} elseif (empty($_POST['clave_nueva'])) {
    $errors[] = "Contraseña vacía";
} elseif (strlen($_POST['clave_nueva']) < 6) {
    $errors[] = "La contraseña debe tener como mínimo 6 caracteres";
} elseif ($_POST['clave_nueva'] !== $_POST['clave_repetir']) {
    $errors[] = "la contraseña y la repetición de la contraseña no son iguales";
} else if (!empty($_POST['rut'])) {
    /* Connect To Database */
    require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
    include '../Clases/Asistente.php';
    include '../Clases/Scape.php';
    include '../Clases/Log.php';
    // escaping, additionally removing everything that could be (html/javascript-) code
    $rut = $_POST["rut"];
    $nombre = Scape::ms_escape_string($_POST["nombre"]);
    $apellido = Scape::ms_escape_string($_POST["apellido"]);
    $mail = $_POST["mail"];
    $tipo_asistente = $_POST["tipo_asistente"];
    $clave = $_POST["clave_nueva"];
    $clave_hash = password_hash($clave, PASSWORD_DEFAULT);

    $habilitacion="";
    $comprovar = Asistente::recuperarAsistente($rut, "",$habilitacion,$con);

    $count = sqlsrv_num_rows($comprovar);

    if ($count > 0) {
        $estado = '1'; //habilitar
        $habilitacion = Asistente::des_habilitarAsistente($rut, $estado, $con);
        $errors[] = "<br> Asistente ya registrado.";
        if ($habilitacion) {
            $messages[] = "Asistente ha sido habilitado nuevamente.";
            $accion = "Se ha habilitado nuevavamente a asistente $rut tipo $tipo_asistente";
        } else {
            
        }
           
        
    } else {

        $query_new_insert = Asistente::registrarAsistente($rut, $nombre, $apellido, $mail,$tipo_asistente, $clave_hash, $con);
        if ($query_new_insert) {
            $messages[] = "Asistente ha sido ingresada satisfactoriamente.";
             $accion = "Registra nuevo asistente $rut tipo $tipo_asistente";
        } else {
            $errors [] = "Error al ingresar asistente";
            $accion = "Error al ingresar nuevo asistente $rut tipo $tipo_asistente";
        }  
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