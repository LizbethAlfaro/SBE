<?php

 
 

 
/* session_start();

 
if (!isset($_SESSION['user_login_admin_status']) AND $_SESSION['user_login_admin_status'] != 1) {

 
header("location: loginAdmin.php");

 
exit;

 
}

*/

require_once ("./config/db.php");//Contiene las variables de configuracion para conectar a la base de datos

 
require_once ("./config/conexion.php");//Contiene funcion que conecta a la base de datos

 
include './Clases/Atencion.php';

 
include './Clases/Scape.php';

 
include './Clases/Log.php';

 
include './Clases/UMAS.php';

 
 

 
header('Content-type:application/xls; charset=utf-8 ');
header("Content-Type: application/vnd.ms-excel charset=iso-8859-1");
header('Content-Disposition: attachment; filename=atenciones.xls');

 
 

 
 

 
// escaping, additionally removing everything that could be (html/javascript-) code

 


 
 

 
$result= UMAS::TNEPRUEBA($con);

// $sSelect = " SELECT tbl_tne.rut_estudiante AS RUT ,CL.NOMBRE,CL.PATERNO,CL.MATERNO,tbl_tne.fono AS FONO, convert(varchar,tbl_tne.fecha) AS FECHA,tbl_proceso_realizar.nombre_proceso AS PROCESO "; 
 
$numrows = sqlsrv_num_rows($result);

 
 

 
 

 
//main query to fetch the data

 
 

 
 

 
 

 
 

 
//loop through fetched data

 
if ($numrows>0){

 
 

 
?>

 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1 " />

 
<table class="table">

 
<tr class="success">

 
 
<td>REGION </td>

<td>SEDE </td>

<td>CARRERA </td>
<td>JORNADA </td>
<td>RBD </td>
<td>RUT </td>
<td>DIG </td>
<td>PATERNO </td>
<td>MATERNO </td>
<td>PRIMER NOMBRE </td>
<td>SEGUNDO NOMBRE </td>
<td>DIA </td>
<td>MES</td>
<td>ANO </td>
<td>MAIL </td>
<td>CODIGO </td>

<td>TELEFONO </td>

<td>FONOACT</td>

<td>ANO_MAT </td>

<td>PERIODO_MAT </td>

<td>MONTO</td>

<td>FECHADEPAGO </td>

<td>FECCANCEL </td>

<td>JORNADA REAL </td>




 
</tr>

 
<?php

 
while ($row=sqlsrv_fetch_array($result)){


    $REGION = $row['REGION']; 
    
$SEDE = $row['SEDE'];

$CARRERA = $row['CARRERA'];
$JORNADA = $row['JORNADA'];
$RBD = $row['RBD'];
$RUT = $row['RUT'];
$DIG = $row['DIG'];
$PATERNO = $row['PATERNO'];
$MATERNO = $row['MATERNO'];
$PRIMER_NOMBRE = $row['PRIMER_NOMBRE'];
$SEGUNDO_NOMBRE = $row['SEGUNDO_NOMBRE'];
$DIA = $row['DIA'];
$MES = $row['MES'];
$ANO = $row['ANO'];
$MAIL = $row['MAIL'];
$CODIGO = $row['CODIGO'];
$TELEFONO = $row['TELEFONO'];
$FONOACT = $row['FONOACT'];
$ANO_MAT = $row['ANO_MAT'];
$PERIODO_MAT = $row['PERIODO_MAT'];
$MONTO = $row['MONTO'];
$FECHADEPAGO = $row['FECHADEPAGO'];
$FECCANCEL = $row['FECCANCEL'];
$JORNADA_REAL = $row['JORNADA_REAL'];



/* $FECNAC = date('d-m-Y', strtotime($row['FECHA'])); */


 

 
// $FECHA = date('d-m-Y', strtotime($row['FECHA']));

 


 
?>

 
<tr>

 
 
<td><?php echo $REGION; ?></td>
<td><?php echo $SEDE;?></td>
<td><?php echo $CARRERA; ?></td>
<td><?php echo $JORNADA; ?></td>
<td><?php echo $RBD; ?></td>
<td><?php echo $RUT; ?></td>
<td><?php echo $DIG; ?></td>
<td><?php echo $PATERNO; ?></td>
<td><?php echo $MATERNO; ?></td>
<td><?php echo $PRIMER_NOMBRE; ?></td>
<td><?php echo $SEGUNDO_NOMBRE; ?></td>
<td><?php echo $DIA; ?></td>
<td><?php echo $MES; ?></td>
<td><?php echo $ANO; ?></td>

<td><?php echo $MAIL; ?></td>
<td><?php echo $CODIGO; ?></td>
<td><?php echo $TELEFONO; ?></td>
<td><?php echo $FONOACT; ?></td>

<td><?php echo $ANO_MAT; ?></td>
<td><?php echo $PERIODO_MAT; ?></td>
<td><?php echo $MONTO; ?></td>
<td><?php echo $FECHADEPAGO; ?></td>

<td><?php echo $FECCANCEL; ?></td>
<td><?php echo $JORNADA_REAL; ?></td>



 


 
</tr>

 
<?php

 
}

 
?>

 
</table>

 
<?php

 
}

 
 

 
?>