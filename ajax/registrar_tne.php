<?php

if (empty($_POST['proceso'])) {
    $errors[] = "No ha seleccionado un proceso";
} else if (empty($_POST['fono'])) {
    $errors[] = "No ha ingresado un fono";
} else if (empty($_POST['rut_estudiante'])) {
    $errors[] = "No ha ingresado un rut";     
} else if (!empty($_POST['rut_estudiante'])) {
    /* Connect To Database */
    require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
    require '../Clases/TNE.php';
    require '../Mail/email.php';
    require '../Autenticacion/FormatoRut.php';



    $proceso = $_POST["proceso"];
    $fono = $_POST["fono"];
    $rut = $_POST["rut_estudiante"];
    $destino= "solicitudestne@ugm.cl";
   // $destino= "sony.oyarzun@ugm.cl";
    $imagen="http://www.bettersoft.cl/images/resource/u-gabriela-mistral2.jpg";
    
    
    
    $arreglo = array(
        "PROCESO"  => $proceso,
        "FONO"     => $fono,
    );
    
    $recuperar = TNE::recuperarTNE($rut,$con);
    
    if($recuperar){
    $contador = sqlsrv_num_rows($recuperar);
    }else{
    $contador=0;    
    }
    
    if($contador>0){
      
      $errors[]   = "Ya ha realizado una solicitud";      
        
    } else {
     $query=TNE::registrarTNE($rut,$proceso,$fono,$con);
              if ($query) {
                        $messages[] = "Se validará el proceso TNE y se enviará  en un plazo de 24 horas hábiles respuesta su email con los pasos a seguir"; 
                        Mail::enviarMail($rut,$arreglo,6,$destino,$imagen,"");
                     
                    } else {
                        $errors[]   = "Error al registrar Datos";                     
                    }   
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



