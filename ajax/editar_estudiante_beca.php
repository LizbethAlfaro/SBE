<?php
include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
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
} elseif (empty($_POST['fechaNac'])) {
    $errors[] = "Fecha nacimiento vacía";
} elseif ($_POST['fechaNac'] > date("Y-m-d H:i:s",strtotime( date("Y-m-d H:i:s")." - 16 year"))) {
    $errors[] = "Estudiante debe ser mayor a 16 años ";
} elseif ($_POST['fechaNac'] < date("Y-m-d H:i:s",( strtotime(date("Y-m-d H:i:s")." - 75 year")))) {
    $errors[] = "Estudiante debe ser menor de 75 años ";    
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
    $errors[] = "Telefono/movil formato incompleto";
//} elseif (preg_match("\D*([56]\d [2-9])(\D)(\d{4})(\D)(\d{4})\D*",$_POST['fono'])) {
//    $errors[] = "El fono no tiene el formato correcto";
//} elseif (preg_match("\D*([56]\d [2-9])(\D)(\d{4})(\D)(\d{4})\D*",$_POST['movil'])) {
//    $errors[] = "El movil no tiene el formato correcto";  
//} elseif (empty(strval($_POST['fechaIng']))) {
//    $errors[] = "No ha seleccionado su fecha de ingreso";   
} elseif (strlen($_POST['rut']) > 13 || strlen($_POST['rut']) < 2) {
    $errors[] = "rut no puede ser inferior a 2 o más de 13 caracteres";
} elseif (
        !empty($_POST['rut'])  && strlen($_POST['rut']) <= 64 && strlen($_POST['rut']) >= 2 && !empty($_POST['email']) && strlen($_POST['email']) <= 64 && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
) {
    require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

    include '../Clases/EstudianteBeca.php';
    include '../Clases/Integrante.php';
    include '../Clases/Direccion.php';
    include '../Clases/Scape.php';

    $rut            = $_POST["rut"];
    $fechaNac       = $_POST['fechaNac']; 
    $fono           = $_POST['fono'];
    $movil          = $_POST['movil'];
    $email          = $_POST["email"];
   
    $direccion      = $_POST['direccion'];
    $numero         = $_POST['numero'];
    $departamento   = $_POST['departamento'];
    $villa          = $_POST["villa"];
    $comuna         = $_POST['comuna'];
    $region         = $_POST["region"];

    $update_estudiante = EstudianteBeca::editarEstudianteBeca($rut,$fechaNac,$fono,$movil,$email,$direccion,$numero,$departamento,$villa,$comuna,$region,$con);
    

    if ($update_estudiante) {
        $messages[] = "La cuenta ha sido modificada con éxito.";
    } else {
        $errors[] = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.";
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

?>