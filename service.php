<?php
require_once ("./config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("./config/conexion.php"); //Contiene funcion que conecta a la base de datos
require_once ('./Clases/UMAS.php');
require_once ('./Clases/Scape.php');
require_once ('./Autenticacion/FormatoRut.php');

/*
  listar todos los posts o solo uno
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['acceso_alumno']))
    {
      $rut   = $_GET['acceso_alumno'] ;
      $rut_sv=sinPuntosRut($rut); 
      //Mostrar un post

$result=UMAS::acceso($rut_sv,$con);
      

if($result){
$contador = sqlsrv_num_rows($result);
}else{
  $contador = 0;  
}

if($contador>0){
 

    
 while ($resultCursor = sqlsrv_fetch_array($result)) {
     
   //  $cadena_fecha = strval($resultCursor['FECNAC']->format('d-m-Y'));

     $resultArreglo[]    = array(
     "NOMBRE"             => utf8_encode($resultCursor['PE_NOMBRES']),
     "PATERNO"            => utf8_encode($resultCursor['PE_APPATERNO']),
     "MATERNO"            => utf8_encode($resultCursor['PE_APMATERNO']),
     "ID"                 => $resultCursor['ID_USUARIO'],
     "CLAVE"              => $resultCursor['CLAVE']
    );
 
}   
}else{
 $resultArreglo[]="El ID no coincide con alumno registrado";
}

    header("HTTP/1.1 200 OK");
   //   echo 'uno solo';
      echo json_encode($resultArreglo);  
   //   print_r($resultArreglo) ;


      exit();
}
elseif (isset($_GET['informacion_basica']))
{
 $rut   = $_GET['informacion_basica'] ;
      $rut_sv=sinPuntosGuionRut($rut); 
      //Mostrar un post

$result=UMAS::info($rut_sv,$con);
      

if($result){
$contador = sqlsrv_num_rows($result);
}else{
  $contador = 0;  
}

if($contador>0){
 
    
    
 while ($resultCursor = sqlsrv_fetch_array($result)) {
     
   //  $cadena_fecha = strval($resultCursor['FECNAC']->format('d-m-Y'));

     $resultArreglo[]     = array(
     "RUT"                => $resultCursor['RUT'],
     "NOMBRE"             => utf8_encode($resultCursor['NOMBRE']),
     "PATERNO"            => utf8_encode($resultCursor['APELLIDO_PATERNO']),
     "MATERNO"            => utf8_encode($resultCursor['APELLIDO_MATERNO']),   
     "CORREO"             => $resultCursor['CORREO'],
     "GENERO"             => $resultCursor['GENERO'],
     "BLOQUEO_FINANCIERO" => $resultCursor['BLOQUEO_FINANCIERO'],
     "BLOQUEO_ACADEMICO"  => $resultCursor['BLOQUEO_ACADEMICO'],    
    );
 
}

}else{
 $resultArreglo[]="El ID no coincide con alumno registrado";
}

    header("HTTP/1.1 200 OK");
   //   echo 'uno solo';
      echo json_encode($resultArreglo);  
   //   print_r($resultArreglo) ;


      exit();

}
elseif (isset($_GET['carreras_programas']))
{
 $rut   = $_GET['carreras_programas'] ;
      $rut_sv=sinPuntosGuionRut($rut); 
      //Mostrar un post

$result=UMAS::carrera($rut_sv,$con);
      

if($result){
$contador = sqlsrv_num_rows($result);
}else{
  $contador = 0;  
}

if($contador>0){
 

    
 while ($resultCursor = sqlsrv_fetch_array($result)) {
     
   //  $cadena_fecha = strval($resultCursor['FECNAC']->format('d-m-Y'));

     $resultArreglo[]    = array(
     "CODIGO"             => utf8_encode($resultCursor['CODIGO_CARRERA']),
     "PROGRAMA"           => Scape::ms_escape_string(utf8_encode($resultCursor['NOMBRE_PROGRAMA'])),
     "COD_SEDE"           => utf8_encode($resultCursor['CODIGO_SEDE']),
     "SEDE"               => utf8_encode($resultCursor['NOMBRE_SEDE']),
     "TIPO_CARRERA"       => utf8_encode($resultCursor['TIPO_CARRERA']),
     "COD_TIPO_CARRERA"   => utf8_encode($resultCursor['CODIGO_TIPO_CARRERA']),
     "EST_ACAD_ALUMN"     => utf8_encode($resultCursor['ESTADO_ACADEMICO_ALUMNO']),
     "ST_ACAD"            => utf8_encode($resultCursor['SITUACION_ACADEMICA']),
     "ANO_MAT"            => $resultCursor['ANO_MATRICULA']
    );
 
}

}else{
 $resultArreglo[]="El ID no coincide con alumno registrado";
}

    header("HTTP/1.1 200 OK");
   //   echo 'uno solo';
      echo json_encode($resultArreglo);  
   //   print_r($resultArreglo) ;


      exit();


}

}
//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>