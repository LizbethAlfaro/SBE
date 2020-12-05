<?php
require_once '../Clases/UMAS.php';
$fono = "+56 2 24144157";
$fono2 = "+56 2 24144534";
$imagen = "";
$estudiante;
$fecha=date("Y");
$pathInPieces = explode('/',$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);  
//$ruta='http://'.$pathInPieces[0]."/BecasBeneficios/";
$ruta='http://'.$pathInPieces[0]."/";

require   "../config/db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require "../config/conexion.php"; //Contiene funcion que conecta a la base de datos
require '../Clases/Proceso_realizar.php';

$instructivo= $ruta."descarga.php?ruta=1";
$descarga = $ruta."descarga.php";

$proceso    =$asistente['PROCESO'];
$fono       =$asistente['FONO'];




$RUT="";
$DV="";
$PATERNO="";
$MATERNO="";
$NOMBRE="";
$FECHA="";
$ID_CARRERA="";
$CARRERA="";
$JORNADA="";
$FECHA_MATRICULA="";
$ESTADO_ACADEMICO="";
$SITUACION_ACADEMICA="";
$MAIL_INSTITUCIONAL="";
$CELULAR="";


$rut=sinPuntosGuionRut( $estudiante );

$estudianteQuery = UMAS::TNE($rut,$con);

if($estudianteQuery){
 $contador_estudiante = sqlsrv_num_rows($estudianteQuery); 
 
       
 
 while ($estudianteCursor = sqlsrv_fetch_array($estudianteQuery)) {
  
        $RUT                   = $estudianteCursor['RUT'];
        $DV                    = $estudianteCursor['DV'];
        $PATERNO               = $estudianteCursor['PATERNO'];
        $MATERNO               = $estudianteCursor['MATERNO'];
        $NOMBRE                = $estudianteCursor['NOMBRE'];
        $FECHA                 = date('d-m-Y', strtotime($estudianteCursor['FECHA']));
        $ID_CARRERA            = $estudianteCursor['ID_CARRERA'];
        $CARRERA               = $estudianteCursor['CARRERA'];
        $JORNADA               = $estudianteCursor['JORNADA'];
        $FECHA_MATRICULA       = date('d-m-Y', strtotime($estudianteCursor['FECHA_MATRICULA']));
        $ESTADO_ACADEMICO      = $estudianteCursor['ESTADO_ACADEMICO'];
        $SITUACION_ACADEMICA   = $estudianteCursor['SITUACION_ACADEMICA'];
        $MAIL_INSTITUCIONAL    = $estudianteCursor['MAIL_INSTITUCIONAL'];
        $CELULAR               = $estudianteCursor['CELULAR'];
    
}
}

$procesoQuery = ProcesoRealizar::recuperarProcesoRealizar($con);

if($procesoQuery){

 while ($procesoCursor = sqlsrv_fetch_array($procesoQuery)) {
     if($procesoCursor['id_proceso']==$proceso){
        $NOMBRE_P               = $procesoCursor['nombre_proceso'];
       // print_r("proceso ".$proceso);
     }
}

}

 

?>



<?php



$mensaje="<!DOCTYPE html>
<html lang='es'>
<head>
	<meta charset='utf-8'>
	<title>Asignacion</title>
</head>
<body style='background-color: black '>

<table style='max-width: 800px; padding: 10px; margin:0 auto; border-collapse: collapse;'>


	<tr>
		<td style='padding: 0'>
			<img style='padding: 0; display: block' src='$imagen' width='100%'>
		</td>
	</tr>
	
	<tr>
		<td style='background-color: #ecf0f1'>
			<div style='color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif'>
				<h2 style='color: #e67e22; margin: 0 0 7px'>Nueva Solicitud</h2>
				<p style='margin: 2px; font-size: 15px'>
					El siguiente Alumno a realizado envio de sus datos referentes a la TNE</p>
                                <p style='margin: 2px; font-size: 15px'>
					</p>
                                <p style='margin: 2px; font-size: 15px'>

<table border='2' class='table'>
    <thead>
        <tr>
            <th>RUT</th>
            <th>DV</th>
            <th>NOMBRE</th>
            <th>PATERNO</th>
            <th>MATERNO</th>
           
            
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>$RUT</td>
            <td>$DV</td>
            <td>$NOMBRE</td>
            <td>$PATERNO</td>
            <td>$MATERNO</td>
           
    
        </tr>
        <tr>
            <th colspan='2'>FECHA INGRESO</th>
            <th>ID CARRERA</th>
            <th colspan='2'>CARRERA</th>
        </tr>
        <tr>
            <td colspan='2'>$FECHA</td>
            <td>$ID_CARRERA</td>
            <td colspan='2'>$CARRERA</td>
            
        </tr>
        <tr>
            <th>JORNADA</th>
            <th colspan='2'>SITUACION ACADEMICA</th>
            <th>ESTADO ACADEMICO</th>
            <th>FECHA MATRICULA</th>
        </tr>
         <tr>
            <td>$JORNADA</td>
            <td colspan='2'>$SITUACION_ACADEMICA</td>
            <td>$ESTADO_ACADEMICO</td>
            <td>$FECHA_MATRICULA</td>    
        </tr>
         <tr>
            <th colspan='2'>PROCESO</th>
         
            <th >FONO</th>
            <th colspan='2'>MAIL</th>
        </tr>
         <tr>
            <td colspan='2'>$NOMBRE_P</td>
            <td >$fono</td>
            <td colspan='2'>$MAIL_INSTITUCIONAL</td>    
        </tr>
    </tbody>
</table>

	
				</div>
				
				<p style='color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0'> UFE UGM $fecha </p>
			</div>
		</td>
	</tr>
</table>
</body>
</html>";





