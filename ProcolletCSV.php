<?php

require_once( $_SERVER['DOCUMENT_ROOT']."./config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once( $_SERVER['DOCUMENT_ROOT']."./config/conexion.php"); //Contiene funcion que conecta a la base de datos
include  $_SERVER['DOCUMENT_ROOT'].'./Clases/Umas.php';
include  $_SERVER['DOCUMENT_ROOT'].'./Clases/Extra.php';
include  $_SERVER['DOCUMENT_ROOT'].'./Clases/Scape.php';

//$periodo = $_POST['periodo'];
//$anhio = $_POST['anhio'];


$result =  Umas::Procollet($con);

if (!$result) die('Couldn\'t fetch records'); 
$num_fields = sqlsrv_num_fields($result); 
$headers = array();  


foreach(sqlsrv_field_metadata($result) as $field){
  $headers[] = $field['Name']; 
}


$fp = fopen('php://output', 'w'); 
if ($fp && $result) 
{     
          header('Content-Type: text/csv');
          header('Content-Disposition: attachment; filename="export.csv"');
          header('Pragma: no-cache');    
          header('Expires: 0');
          fputcsv($fp, $headers,';'); 

          while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) 
          {
             fputcsv($fp, array_values($row),';'); 
          }
die; 
} 

/*
$connection = ftp_connect($server);

$login = ftp_login($connection, $ftp_user_name, $ftp_user_pass);

if (!$connection || !$login) { die('Parece que no se puede conectar'); }

$upload = ftp_put($connection, $dest, $source, $mode);

if (!$upload) { echo 'Fallo la subida al FTP'; }

ftp_close($connection);

*/