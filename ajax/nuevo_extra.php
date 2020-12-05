<?php
if (empty($_POST['rut_estudiante'])) {
 $errors[] = "Rut estudiante vacío";
} elseif (empty($_POST['nacionalidad'])) {
 $errors[] = "Nacionalidad vacío";
} elseif (empty($_POST['pueblo'])) {
 $errors[] = "Pueblo vacío"; 
} elseif (empty($_POST['beneficio'])) {
 $errors[] = "Beneficio vacío";
} elseif (empty($_POST['discapacidad'])) {
 $errors[] = "Discapacidad vacío";   
} elseif (empty($_POST['rut_integrante'])) {
 $errors[] = "Rut integrante vacío";
} elseif (empty($_POST['enfermedad'])){
 $errors[] = "Enfermedad vacía";
} elseif (empty($_POST['formula'])){
 $errors[] = "Formula vacía";
} elseif ($_POST['egreso']==""){
 $errors[] = "Egreso vacío";
} elseif (empty($_POST['rut_jefe'])){
 $errors[] = "Rut jefe vacío";
} elseif ($_POST['ingreso_jefe']==""){
 $errors[] = "Ingreso jefe vacío"; 
} elseif (empty($_POST['prevision_jefe'])){
 $errors[] = "Prevision jefe vacía";
} elseif (empty($_POST['contrato_jefe'])){
 $errors[] = "Contrato jefe vacía";
} elseif (empty($_POST['sugerencia_asistente'])){
 $errors[] = "Sugerencia vacía";
} elseif (empty($_POST['calificacion'])){
 $errors[] = "Calificacion vacía"; 
} elseif ($_POST['avance']==""){
 $errors[] = "Avance vacío";  
}else{
    require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
    include '../Clases/Extra.php';
    include '../Clases/Integrante.php';
    include '../Clases/Scape.php';
    
    $rut_estudiante = $_POST['rut_estudiante'];
    $nacionalidad   = $_POST['nacionalidad'];
    $pueblo         = $_POST['pueblo'];
    $beneficio      = $_POST['beneficio'];
    $discapacidad   = $_POST['discapacidad'];
    $calificacion   = $_POST['calificacion'];
    $avance         = $_POST['avance'];
    
    $rut_integrante = $_POST['rut_integrante'];
    $enfermedad     = $_POST['enfermedad'];
    
    $formula        = $_POST['formula'];
    $egreso         = str_replace('.', '',$_POST['egreso']);  
    
    $rut_jefe       = $_POST['rut_jefe'];
    $ingreso_jefe   = $_POST['ingreso_jefe'];
    $prevision_jefe = $_POST['prevision_jefe'];
    $contrato_jefe  = $_POST['contrato_jefe'];
    
    $sugerencia_asistente = $_POST['sugerencia_asistente'];
    
    $result_extra = Extra::recuperarExtra($rut_estudiante, $con);
    
    if($result_extra){
       $contador_extra = sqlsrv_num_rows($result_extra);
    }else{
       $contador_extra=0; 
    }
  
    $tipo_enfermedad=true;
    
    if($contador_extra>0){
      while ($extraCursor = sqlsrv_fetch_array($result_extra)) {
            $extraArreglo = array(
                "rut_estudiante"        => $extraCursor['rut_estudiante'],
                "nacionalidad"          => $extraCursor['nacionalidad'],
                "pueblo"                => $extraCursor['pueblo'],
                "formula_ministerial"   => $extraCursor['formula_ministerial'],
                "egresos_totales"       => $extraCursor['egresos_totales'],
                "jefe_hogar"            => $extraCursor['jefe_hogar'],
                "contrato_jefe"         => $extraCursor['contrato_jefe'],
                "prev_social_jefe"      => $extraCursor['prev_social_jefe'],
                "ingreso_jefe"          => $extraCursor['ingreso_jefe'],
                "beneficio"             => $extraCursor['beneficio'],
                "sugerencia_asist"      => $extraCursor['sugerencia_asist'],
                "discapacidad"          => $extraCursor['discapacidad'],
                "calificacion"          => $extraCursor['calificacion'],
                "avance"                => $extraCursor['avance'],
            );
        }
    
   // $errors[]="Ya fue Ingresado"; 
    
     $update_extra = Extra::editarExtra($rut_estudiante,$nacionalidad,$pueblo,$formula,$egreso,$rut_jefe,$contrato_jefe,$prevision_jefe,$ingreso_jefe,$beneficio,$sugerencia_asistente,$discapacidad,$calificacion,$avance,$con);
    
    if($update_extra && $tipo_enfermedad){
     $messages[]="Datos Extras Actualizados";   
    }else{
     $errors[]="Error al Actualizar Datos";   
    }
    
//    echo 'Estudiante :'.$extraArreglo['rut_estudiante'].'<br>';
//    echo 'Nacionalidad :'.$extraArreglo['nacionalidad'].'<br>';
//    echo 'Pueblo :'.$extraArreglo['pueblo'].'<br>';
//    echo 'Beneficio :'.$extraArreglo['beneficio'].'<br>';
//    echo 'Discapacidad :'.$extraArreglo['discapacidad'].'<br>';
//    echo 'Calificacion :'.$extraArreglo['calificacion'].'<br>';
//    echo 'Avance :'.$extraArreglo['avance'].'<br>';
    
    $contador = 0;

    //print_r($rut_integrante);
    
    foreach ($rut_integrante as $rut){
//        echo 'Integrante :'.$rut.'<br>';
//        echo 'Enfermedad :'.$enfermedad[$contador].'<br>';
//        echo '____________________<br>';
    $tipo_enfermedad= Integrante::editarEnfermedadIntegrante($rut_estudiante,$rut,$enfermedad[$contador],$con);   
    $contador++;
    }
//    echo 'Formula :'.$extraArreglo['formula_ministerial'].'<br>';
//    echo 'Egreso  :'.$extraArreglo['egresos_totales'].'<br>';
//    
//    echo 'Jefe    :'.$extraArreglo['jefe_hogar'].'<br>';
//    echo 'Ingreso Jefe    :'.$extraArreglo['ingreso_jefe'].'<br>';
//    echo 'Prevision Jefe    :'.$extraArreglo['prev_social_jefe'].'<br>';
//    echo 'Contrato Jefe    :'.$extraArreglo['contrato_jefe'].'<br>';
//    echo 'Sugerencia    :'.$extraArreglo['sugerencia_asist'].'<br>';
    
    }else{
    $contador = 0;
    foreach ($rut_integrante as $rut){
//        echo 'Integrante :'.$rut.'<br>';
//        echo 'Enfermedad :'.$enfermedad[$contador].'<br>';
//        echo '____________________<br>';
    $tipo_enfermedad= Integrante::editarEnfermedadIntegrante($rut_estudiante,$rut,$enfermedad[$contador],$con);   
    $contador++;
    }
        
        
    $insert_extra = Extra::registrarExtra($rut_estudiante,$nacionalidad,$pueblo,$formula,$egreso,$rut_jefe,$contrato_jefe,$prevision_jefe,$ingreso_jefe,$beneficio,$sugerencia_asistente,$discapacidad,$calificacion,$avance,$con);
    

    
    if($insert_extra && $tipo_enfermedad){
     $messages[]="Datos Extras Ingresados";   
    }else{
     $errors[]="Error al Ingresar Datos";   
    }
        
    }
    

    
   
    
    
   
    
  
    
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
    if (isset($messages)) {
    if (isset($informacion)) {
        ?>
    <div class="alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Atencion!</strong>
    <?php
    foreach ($informacion as $info) {
        echo $info;
    }
    ?>
    </div>
        <?php
    }
}

    
    ?>