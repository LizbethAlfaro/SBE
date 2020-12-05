<?php
 
/* Connect using SQL Server Authentication. */  
$con = sqlsrv_connect( $serverName, $connectionInfo);  

$mensaje;

if($con){
 $mensaje="Conectado";   
   
}else{
 $mensaje="Error Conexion";   
}

?>
