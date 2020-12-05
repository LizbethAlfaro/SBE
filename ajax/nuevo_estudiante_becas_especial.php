<?php
include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("../libraries/password_compatibility_library.php");
} if (empty($_POST['rut'])) {
    $errors[] = "Rut vacío";
//    }elseif(empty($_POST['nombre'])){
//      $errors[] = "Nombres vacíos ";
//      } elseif (empty($_POST['apellido'])){
//      $errors[] = "Apellidos vacíos";
     }  elseif (empty(intval($_POST['beca']))) {
      $errors[] = "Debe Seleccionar una beca";
      }  elseif (empty(intval($_POST['fechaNac']))) {
      $errors[] = "No ha seleccionado una fecha de nacimiento";
      }  elseif ($_POST['fechaNac']>date("Y-m-d H:i:s")) {
      $errors[] = "Estudiante debe haber nacido previamente";
      } elseif ($_POST['fechaNac'] > date("Y-m-d H:i:s",strtotime( date("Y-m-d H:i:s")." - 16 year"))) {
    $errors[] = "Estudiante debe ser mayor a 16 años ";
} elseif ($_POST['fechaNac'] < date("Y-m-d H:i:s",( strtotime(date("Y-m-d H:i:s")." - 75 year")))) {
    $errors[] = "Estudiante debe ser menor de 75 años ";
      } elseif (empty($_POST['email'])) {
      $errors[] = "El correo electrónico no puede estar vacío";
      } elseif (strlen($_POST['email']) > 64) {
      $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
      } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
      
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
      
//} elseif (empty($_POST['password_nueva']) || empty($_POST['password_repetir'])) {
//    $errors[] = "Contraseña vacía";
//} elseif ($_POST['password_nueva'] !== $_POST['password_repetir']) {
//    $errors[] = "la contraseña y la repetición de la contraseña no son lo mismo";
//} elseif (strlen($_POST['password_nueva']) < 6) {
//    $errors[] = "La contraseña debe tener como mínimo 6 caracteres";
} elseif (strlen($_POST['rut']) > 13 || strlen($_POST['rut']) < 2) {
    $errors[] = "rut no puede ser inferior a 2 o más de 13 caracteres";
} elseif (
        !empty($_POST['rut'])

) {
    require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
    include '../Clases/EstudianteBeca.php';
    include '../Clases/Integrante.php';
    include '../Clases/Direccion.php';
    include '../Clases/Solicitud.php';
    include '../Clases/Ingreso.php';
    include '../Clases/Scape.php';
    include '../Clases/Becas.php';
    include '../Clases/Log.php';
    include '../Autenticacion/FormatoRut.php';
    include '../Clases/Horario.php';
    include '../Mail/email.php';
    include '../Clases/Estudiante.php';

    //sinPuntosRut( $rut )
    //conPuntosRut( $rut )
    //
    //UMAS


include '../Clases/UMAS.php';

$rut = sinPuntosGuionRut($_POST['rut']);
$rut_2 = sinPuntosRut($_POST['rut']);
$rut_3 = $_POST['rut'];
$beca = $_POST['beca'];


//renovante o postulante
$renoPost=$_POST['renopost'];


switch ($renoPost){
  case 1:
      $informacion[] = " Usted Califica como Postulante a la Beca ";
      break;
  case 2:
      $informacion[] = " Usted Califica como Renovante a la Beca ";
      break;
  default :
      $informacion[]="";
      break;
  
}




//validar estudiante
 $result = UMAS::recuperarEstudiante($rut_2,$con);


if($result){
  $contador = sqlsrv_num_rows($result);
}else{
  $contador = 0;  
}


if($contador>0){


 while ($resultCursor = sqlsrv_fetch_array($result)) {
 $resultArreglo     = array(
     "RUT"          => $resultCursor['RUT'],
     "DIG"          => $resultCursor['DIG'],
     "CLIENTE"      => $resultCursor['CODCLI'],
     "USER"         => $resultCursor['us_consuser'],
     "PASS"         => $resultCursor['us_password'],
     "NOMBRE"       => $resultCursor['NOMBRE'],
     "MATERNO"      => $resultCursor['MATERNO'],
     "PATERNO"      => $resultCursor['PATERNO'],
     "JORNADA"      => $resultCursor['JORNADA'],
     "INGRESO"      => $resultCursor['ANO'],
     "ESTADO"       => $resultCursor['ESTACAD'],
     "SEXO"         => $resultCursor['SEXO'],
     "NACIMIENTO"   => $resultCursor['FECNAC'],
     "DIRECCION"    => $resultCursor['DIRACTUAL'],
     "CARRERA"      => $resultCursor['NOMBRE_C'],
    );
}   
}else{
    
    $errors[] = " No cumple requisitos,para mas informacion contactese a con UFE@UGM.CL, "; 

 $resultArreglo     = array(
     "RUT"          => "",
     "DIG"          => "",
     "CLIENTE"      => "",
     "USER"         => "",
     "PASS"         => "",
     "NOMBRE"       => "",
     "MATERNO"      => "",
     "PATERNO"      => "",
     "JORNADA"      => "",
     "INGRESO"      => "",
     "ESTADO"       => "",
     "SEXO"         => "",
     "NACIMIENTO"   => "",
     "DIRECCION"    => "",
     "CARRERA"      => "",
    );
}


//////
    
    


    $nombre         = Scape::ms_escape_string($resultArreglo['NOMBRE']);
    $apellido       = Scape::ms_escape_string($resultArreglo['PATERNO']." ".$resultArreglo['MATERNO']);
    $fechaNac       = $_POST['fechaNac'];
    $genero         = "3";
    if($resultArreglo['SEXO'] == 'F'){
     $genero         = "1";   
    }else if($resultArreglo['SEXO'] == 'M'){
     $genero         = "2";   
    }
    
    $fono           = $_POST['fono'];
    $movil          = $_POST['movil'];
    $email          = $_POST['email'];

    $direccion      = $_POST['direccion'];
    $numero         = $_POST['numero'];
    $departamento   = $_POST['departamento'];
    $villa          = $_POST['villa'];
    $comuna         = $_POST['comuna'];
    $region         = $_POST['region'];
    $fechaIng       = $resultArreglo['INGRESO'];
    $carrera        = Scape::ms_escape_string($resultArreglo['CARRERA']);    
    $jornada        = "1";
    if($resultArreglo['JORNADA'] == 'D'){
     $jornada         = "1";   
    }else if($resultArreglo['JORNADA'] == 'V'){
     $jornada         = "2";   
    }  
    
    
     if ($contador > 0) {
       

        if (isset($_POST['direccion2']) && isset($_POST['numero2']) && isset($_POST['departamento2']) && isset($_POST['comuna2']) && isset($_POST['region2'])) {
            $direccion2 = $_POST['direccion2'];
            $numero2    = $_POST['numero2'];
            $departamento2 = $_POST['departamento2'];
            $villa2 = $_POST["villa2"];
            $comuna2 = $_POST['comuna2'];  
        }else{
//          $warning[] = "<br> Sin direccion periodo academico o datos incompletos ";    
        }
        $direccion2 = "";
        $numero2    = "";
        $departamento2 = "";
        $villa2 = "";
        $comuna2 = "";
        $region2 = "";
        
        $estado = 1;
        
        
        $query_new_user_insert = EstudianteBeca::registrarEstudianteBeca($rut_3,$beca,$renoPost,$nombre,$apellido,$fechaNac,$genero,$fono,$movil,$email,$fechaIng,$carrera,$jornada,$direccion,$numero,$departamento,$villa,$comuna,$region,$direccion2,$numero2,$departamento2,$villa2,$comuna2,$region2,$estado,$con);

   
//        $tipo = '2'; //postulante
//        $estado= '0'; //sin enviar
//        $insert_solicitud= Solicitud::registrarSolicitud($rut,$estado,$tipo,$con);
        $n_b="";
        if ($query_new_user_insert) {
            $messages[] = "Su postulacion ha sido registrada, debe acercarse a la oficina de UFE";
            $tipo = 2;
            $fecha= Horario::fechaCastellano((date("Y-m-d H:i:s")));
            $imagen="http://www.bettersoft.cl/images/resource/u-gabriela-mistral2.jpg";
            
            $result_beca = Beca::recuperarBeca($beca,$con);

            
            while ($rw = sqlsrv_fetch_array($result_beca)) {
                             
            $nombre_beca=$rw['nombre_beca'];
         //   echo $nombre_beca;                   
            }
            Mail::enviarMail($nombre,$nombre_beca,$tipo,$email,$imagen,$fecha);
            $accion="Ingreso de Forma (Interna Especial) a $rut_3 ";
            Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);
           
        } else {
            $errors[] = "Su postulacion ya fue ingresada";
        }
  
        
    } else {
        $errors[] = "Lo sentimos , usted no esta habilitado para realizar este proceso ";
    }
    
    
    
    





   
} else {
    $errors[] = "Un error desconocido ocurrió.";
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