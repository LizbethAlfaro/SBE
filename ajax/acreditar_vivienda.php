<?php
include('is_logged_admin.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado

/* Inicia validacion del lado del servidor */
if (empty($_POST['tipo_vivienda'])) {
    $errors[] = "Tipo vivienda vacio";
} else if (empty($_POST['tenencia_vivienda'])){
    $errors[] = "Tenencia de vivienda vacio";   
} else if (!empty($_POST['rut_estudiante'])) {
    /* Connect To Database */
    require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
    include '../Clases/Vivienda.php';
    include '../Clases/Log.php';
    // escaping, additionally removing everything that could be (html/javascript-) code
    $rut_estudiante     = $_POST["rut_estudiante"];
    $tipo               = $_POST["tipo_vivienda"];
    $tenencia           = $_POST["tenencia_vivienda"];

    $comprovar = Vivienda::recuperarVivienda($rut_estudiante, $con);

    $count = sqlsrv_num_rows($comprovar);

    if ($count > 0) {        
        $query = Vivienda::editarVivienda($rut_estudiante,$tenencia,$tipo,$con);  
        
        if ($query) {
            $messages[] = "Vivienda ha sido actualizada satisfactoriamente.";
             $accion = "Actualizo vivienda a $rut_estudiante";
        } else {
            $errors [] = "Error al actualizar vivienda";
               $accion = "Error al Actualizar vivienda a $rut_estudiante";
        }
        
    } else {

        $query_insert = Vivienda::registrarVivienda($tenencia,$tipo,$rut_estudiante,$con);
        
        if ($query_insert) {
            $messages[] = "Vivienda ha sido ingresada satisfactoriamente.";
              $accion = "Registro vivienda a $rut_estudiante";
        } else {
            $errors [] = "Error al ingresar vivienda";
              $accion = "Error al registrar vivienda a $rut_estudiante";
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