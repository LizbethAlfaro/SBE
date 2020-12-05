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
    /*                    }elseif(empty($_POST['nombre'])){
      $errors[] = "Nombres vacíos ";
      } elseif (empty($_POST['apellido'])){
      $errors[] = "Apellidos vacíos";
      }  elseif (empty(intval($_POST['genero']))) {
      $errors[] = "No ha seleccionado un genero";
      }  elseif (empty(intval($_POST['fechaNac']))) {
      $errors[] = "No ha seleccionado una fecha de nacimiento";
      }  elseif ($_POST['fechaNac']>date("Y-m-d H:i:s")) {
      $errors[] = "Estudiante debe haber nacido previamente";
      }  elseif (empty(intval($_POST['carrera']))) {
      $errors[] = "No ha seleccionado una carrera";
      }  elseif (empty(intval($_POST['fechaIng']))) {
      $errors[] = "No ha seleccionado su fecha de ingreso";
      } elseif (empty($_POST['email'])) {
      $errors[] = "El correo electrónico no puede estar vacío";
      } elseif (strlen($_POST['email']) > 64) {
      $errors[] = "El correo electrónico no puede ser superior a 64 caracteres";
      } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Su dirección de correo electrónico no está en un formato de correo electrónico válida";
     */
} elseif (empty($_POST['password_nueva']) || empty($_POST['password_repetir'])) {
    $errors[] = "Contraseña vacía";
} elseif ($_POST['password_nueva'] !== $_POST['password_repetir']) {
    $errors[] = "la contraseña y la repetición de la contraseña no son lo mismo";
} elseif (strlen($_POST['password_nueva']) < 6) {
    $errors[] = "La contraseña debe tener como mínimo 6 caracteres";
} elseif (strlen($_POST['rut']) > 13 || strlen($_POST['rut']) < 2) {
    $errors[] = "rut no puede ser inferior a 2 o más de 13 caracteres";
} elseif (
        !empty($_POST['rut'])
        /* 	    && !empty($_POST['nombre'])
          && !empty($_POST['apellido'])
          && strlen($_POST['rut']) <= 64
          && strlen($_POST['rut']) >= 2
          && !empty($_POST['email'])
          && strlen($_POST['email']) <= 64
          && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
         */ && !empty($_POST['password_nueva']) && !empty($_POST['password_repetir']) && ($_POST['password_nueva'] === $_POST['password_repetir'])
) {
    require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
    require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
    include '../Clases/Estudiante.php';
    include '../Clases/Integrante.php';
    include '../Clases/Direccion.php';
    include '../Clases/Solicitud.php';
    include '../Clases/Ingreso.php';
    include '../Clases/Scape.php';
    include '../Clases/Log.php';
    include '../Autenticacion/FormatoRut.php';

    //sinPuntosRut( $rut )
    //conPuntosRut( $rut )
    //
    //UMAS


include '../Clases/UMAS.php';

$rut = sinPuntosRut($_POST['rut']);
$rut_2 = sinPuntosGuionRut($_POST['rut']);

$result_verificar = UMAS::verificarBecas($rut_2,$con);

$verificarArreglo;


  $contador_verificar =1;  


if ($contador_verificar > 0) {
while ($verificarCursor = sqlsrv_fetch_array($result_verificar)) {
$verificarArreglo = array(
"beca" => $verificarCursor['CODBEN']
);
}
} else {
$verificarArreglo = array(
"beca" => ""
);
}


    



$result = UMAS::recuperarEstudiante($rut,$con);

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
    
    
    
    $rut            = $_POST['rut'];
    $nombre         = $resultArreglo['NOMBRE'];
    $apellido       = $resultArreglo['PATERNO']." ".$resultArreglo['MATERNO'];
    $fechaNac       = "";
    $genero         = "3";
    if($resultArreglo['SEXO'] == 'F'){
     $genero         = "1";   
    }else if($resultArreglo['SEXO'] == 'M'){
     $genero         = "2";   
    }
    
    $fono           = "";
    $movil          = "";
    $email          = "";

    $direccion      = "";
    $numero         = "";
    $departamento   = "";
    $villa          = "";
    $comuna         = "70";
    $region         = "13";
    $fechaIng       = $resultArreglo['INGRESO'];
    $carrera        = Scape::ms_escape_string($resultArreglo['CARRERA']);    
    $jornada        = "1";
    if($resultArreglo['JORNADA'] == 'D'){
     $jornada         = "1";   
    }else if($resultArreglo['JORNADA'] == 'V'){
     $jornada         = "2";   
    }

    $clave = $_POST['password_nueva'];

    $clave_hash = password_hash($clave, PASSWORD_DEFAULT);


   // $comprobar = UMAS::recuperarEstudiante($rut,$con);


  //  $contar = sqlsrv_num_rows($comprobar);


    if ($contador > 0) {
       

        if (isset($_POST['direccion2']) && isset($_POST['direccion2']) && isset($_POST['direccion2']) && isset($_POST['direccion2']) && isset($_POST['direccion2'])) {
            $direccion2 = $_POST['direccion2'];
            $numero2    = $_POST['numero2'];
            $departamento2 = $_POST['departamento2'];
            $villa2 = $_POST["villa2"];
            $comuna2 = $_POST['comuna2'];  
        }
        $direccion2 = "";
        $numero2    = "";
        $departamento2 = "";
        $villa2 = "";
        $comuna2 = "";
        $region2 = "";
        
        $query_new_user_insert = Estudiante::registrarEstudiante($rut,$nombre,$apellido,$fechaNac,$genero,$fono,$movil,$email,$fechaIng,$carrera,$jornada,$clave_hash,$con);

      
 
        $tipo = 1;
        $insert_direccion = Direccion::registrarDireccion($rut,$tipo,$direccion,$numero,$departamento,$villa,$comuna,$region,$con);

        
     //   $tipo = 2;
     //   $insert_direccion2 = Direccion::registrarDireccion($rut,$tipo,$direccion2,$numero2,$departamento2,$villa2,$comuna2,$region2,$con);
        
        //valores iniciales
        $relacion       = 0;
        $estadoCivil    = 8;
        $nivelEduc      = 3; //universitaria/cft/instituto
        $actividad      = 2; //trabajador dependiente
        $prevision      = 1; //fonasa
        $otraPrevision  = "";
        $condicion      = 3;//sin enfermedades
        $enfermedad     = "";        
        $insert_integrante = Integrante::registrarIntegrante($rut,$rut,$nombre,$apellido,$genero,$fechaNac,$relacion,$estadoCivil,$nivelEduc,$actividad,$prevision,$otraPrevision,$condicion,$enfermedad,$con);
        $sueldo_integrante = 0;
        $pension_integrante = 0;
        $honorario_integrante=0;
        $retiro_integrante=0;
        $dividendo_integrante=0;
        $interes_integrante=0;
        $ganancia_integrante=0;
        $pension_alim_integrante=0;
        $actividad_integrante=0;
        $insert_ingreso = Ingreso::registrarIngreso($rut,$rut,$nombre,$apellido,$sueldo_integrante,$pension_integrante,$honorario_integrante,$retiro_integrante,$dividendo_integrante,$interes_integrante,$ganancia_integrante,$pension_alim_integrante,$actividad_integrante,$con);
        
        $tipo = '2'; //postulante
        $estado= '0'; //sin enviar
        $insert_solicitud= Solicitud::registrarSolicitud($rut,$estado,$tipo,$con);
        
        if ($query_new_user_insert && $insert_integrante && $insert_direccion && $insert_solicitud && $insert_ingreso) {
            $messages[] = "La cuenta ha sido creada con éxito.";
            $accion="Ingreso de Forma (Socieconomica Especial) a $rut ";
            Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);
        } else {
            $errors[] = "Ya esta registrado en el sistema, debe iniciar sesion ";
        }
          
    } else {
        $errors[] = "Lo sentimos , Usted no se encuentra habilitado para realizar este proceso, contáctese a UFE@ugm.cl";
    }
    
  
} else {
    $errors[] = "Ha ocurrido un error, intente nuevamente mas tarde.";
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