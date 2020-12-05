<?php
include('is_logged_admin.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version

//https://www.regextester.com/103327

if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../libraries/password_compatibility_library.php");
}
if (empty($_POST['rut'])) {
    $errors[] = "Rut vacío";
} elseif (empty($_POST['nombre'])) {
    $errors[] = "Nombres vacíos ";
} elseif (empty($_POST['apellido'])) {
    $errors[] = "Apellidos vacíos";
} elseif (empty($_POST['fechaNac'])) {
    $errors[] = "Fecha nacimiento vacía";
} elseif ($_POST['fechaNac'] > date("Y-m-d H:i:s",strtotime( date("Y-m-d H:i:s")." - 18 year"))) {
    $errors[] = "Estudiante debe ser mayor a 18 años ";
} elseif ($_POST['fechaNac'] < date("Y-m-d H:i:s",( strtotime(date("Y-m-d H:i:s")." - 75 year")))) {
    $errors[] = "Estudiante debe ser menor de 75 años ";    
} elseif (empty(intval($_POST['genero']))) {
    $errors[] = "No ha seleccionado un genero";  
} elseif (empty($_POST['email'])) {
    $errors[] = "El correo electrónico no puede estar vacío";
} elseif (strlen($_POST['email']) > 64) {
    $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Su dirección de correo no está en un formato de correo electrónico válida";
} elseif (empty(strval($_POST['direccion']))) {
    $errors[] = "Debe ingresar su direccion";
} elseif (!is_numeric ($_POST['numero'])) {
    $errors[] = "Debe ingresar su numero de direccion ";    
//} elseif (empty(strval($_POST['departamento']))) {
//    $errors[] = "Debe ingresar su departamento o casa";
//} elseif (empty(strval($_POST['villa']))) {
//    $errors[] = "Debe ingresar su villa";
} elseif (empty(strval($_POST['comuna']))) {
    $errors[] = "Debe ingresar su comuna"; 
} elseif (empty(strval($_POST['region']))) {
    $errors[] = "Debe ingresar su region";
//} elseif (empty(intval($_POST['fono'])) && empty(intval($_POST['movil']))) {
//    $errors[] = "Debe ingresar al menos un numero de Telefono";
} elseif (empty(intval($_POST['movil']))) {
    $errors[] = "Debe ingresar su numero de movil ";    
} elseif ((!empty(intval($_POST['fono']) && strlen($_POST['fono'])<10)) || (!empty(intval($_POST['movil']) && strlen($_POST['movil'])<14))) {
    $errors[] = "Telefono formato incompleto";
//} elseif (preg_match("\D*([56]\d [2-9])(\D)(\d{4})(\D)(\d{4})\D*",$_POST['fono'])) {
//    $errors[] = "El fono no tiene el formato correcto";
//} elseif (preg_match("\D*([56]\d [2-9])(\D)(\d{4})(\D)(\d{4})\D*",$_POST['movil'])) {
//    $errors[] = "El movil no tiene el formato correcto";  
} elseif (empty(strval($_POST['fechaIng']))) {
    $errors[] = "No ha seleccionado su fecha de ingreso";
} elseif (empty(strval($_POST['carrera']))) {
    $errors[] = "No ha seleccionado una carrera";
} elseif (empty(strval($_POST['jornada']))) {
    $errors[] = "No ha seleccionado una jornada";    
} elseif (strlen($_POST['rut']) > 13 || strlen($_POST['rut']) < 2) {
    $errors[] = "rut no puede ser inferior a 2 o más de 13 caracteres";
} elseif (
        !empty($_POST['rut']) && !empty($_POST['nombre']) && !empty($_POST['apellido']) && strlen($_POST['rut']) <= 64 && strlen($_POST['rut']) >= 2 && !empty($_POST['email']) && strlen($_POST['email']) <= 64 && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
) {
    require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

    include '../Clases/Estudiante.php';
    include '../Clases/Integrante.php';
    include '../Clases/Direccion.php';
    include '../Clases/Scape.php';
    include '../Clases/Log.php';

    $rut            = $_POST["rut"];
    $nombre         = $_POST["nombre"];
    $apellido       = $_POST["apellido"];
    $fechaNac       = $_POST['fechaNac'];
    $genero         = $_POST["genero"];    
    $fono           = $_POST['fono'];
    $movil          = $_POST['movil'];
    $email          = $_POST["email"];
   
    //4 ^(+?56)?(\s?)(0?9)(\s?)[987654]\d{7}$
    $direccion      = $_POST['direccion'];
    $numero         = $_POST['numero'];
    $departamento   = $_POST['departamento'];
    $villa          = $_POST["villa"];
    $comuna         = $_POST['comuna'];
    $region         = $_POST["region"];
    
    $fechaIng       = $_POST['fechaIng'];
    $carrera        = $_POST['carrera'];
    $jornada        = $_POST['jornada'];
   
    
    $update_estudiante = Estudiante::editarEstudiante($rut,$nombre,$apellido,$fechaNac,$genero,$fono,$movil,$email,$fechaIng,$carrera,$jornada,$con);
    
    $update_integrante = Integrante::editarEstudianteIntegrante($rut,$nombre,$apellido,$genero,$fechaNac,$con);
    
    if ($update_estudiante && $update_integrante) {
        $messages[] = "La cuenta ha sido modificada con éxito.";
        $accion = "Edita datos personales de $rut";
    } else {
        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
         $accion = "Error al editar datos personales de $rut";
    } 
    
      
    Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);
    
     $tipo=1;
 //   print_r($rut." ".$tipo." ".$direccion." ".$departamento." ".$villa." ".$comuna." ".$region);
    $update_direccion = Direccion::editarDireccion($rut,$tipo,$direccion,$numero,$departamento,$villa,$comuna,$region,$con);
    
     if ($update_direccion) {
        $messages[] = "<br>La direccion principal ha sido modificada con éxito.";
    } else {
        $errors[] = "<br>Lo sentimos , la actualizacion de direccion fallo vuelva a intentarlo.";
    }  
    
if(!empty($_POST['direccion2']) && is_numeric ($_POST['numero']) && !empty($_POST['departamento2']) && !empty($_POST['comuna2']) && !empty($_POST['region2'])){    
    $direccion2     = $_POST['direccion2'];
    $numero2        = $_POST['numero2'];
    $departamento2  = $_POST['departamento2'];
    $villa2         = $_POST["villa2"];
    $comuna2        = Scape::ms_escape_string($_POST['comuna2']);
    $region2        = Scape::ms_escape_string($_POST["region2"]);
    
    $tipo = 2;
    
        $comprobar_direccion2 = Direccion::recuperarDireccion($rut,$tipo,$con);
        
        if($comprobar_direccion2){
         $contador= sqlsrv_num_rows($comprobar_direccion2);    
        }else{
         $contador = 0;     
        }
    
        if($contador>0){
         $update_direccion2 = Direccion::editarDireccion($rut, $tipo, $direccion2,$numero2, $departamento2, $villa2, $comuna2, $region2, $con);
          $messages[] = "<br>La direccion periodo academico ha sido modificada con éxito.";
        }else{
         $insert_direccion2 = Direccion::registrarDireccion($rut, $tipo, $direccion2,$numero2, $departamento2, $villa2, $comuna2, $region2, $con);
          $messages[] = "<br>La direccion periodo academico ha sido registrada con éxito.";
        }

    }else{
    $warning[] = "<br> Sin direccion periodo academico o datos incompletos ";
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
            echo "<br>".$message;
        }
        ?>
    </div>
    <?php
}
if (isset($warning)) {
    ?>
    <div class="alert alert-warning" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Advertencia!</strong>
        <?php
        foreach ($warning as $warning) {
            echo "<br>".$warning;
        }
        ?>
    </div>
    <?php
}
?>