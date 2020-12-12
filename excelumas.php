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

 
 
<td>CIUDADACT </td>
<td>CODSEDE </td>
<td>JORNADA </td>
<td>CODCLI </td>
<td>DIG </td>
<td>NOMBRE </td>
<td>PATERNO </td>
<td>MATERNO </td>
<td>FECNAC </td>
<td>NOMBRE_L </td>
<td>MAIL </td>

 
</tr>

 
<?php

 
while ($row=sqlsrv_fetch_array($result)){

 
$CIUDADACT = $row['CIUDADACT'];
$CODSEDE = $row['CODSEDE'];
$JORNADA = $row['JORNADA'];
$CODCLI = $row['CODCLI'];
$DIG = $row['DIG'];
$NOMBRE = $row['NOMBRE'];
$PATERNO = $row['PATERNO'];
$MATERNO = $row['MATERNO'];
$FECNAC = date('d-m-Y', strtotime($row['FECHA']));
$NOMBRE_L = $row['NOMBRE_L'];
$MAIL = $row['MAIL'];

 

 
// $FECHA = date('d-m-Y', strtotime($row['FECHA']));

 


 
?>

 
<tr>

 
 
<td><?php echo $CIUDADACT; ?></td>
<td><?php echo $CODSEDE; ?></td>
<td><?php echo $JORNADA; ?></td>
<td><?php echo $CODCLI; ?></td>
<td><?php echo $DIG; ?></td>
<td><?php echo $NOMBRE; ?></td>
<td><?php echo $PATERNO; ?></td>
<td><?php echo $MATERNO; ?></td>
<td><?php echo $FECNAC; ?></td>
<td><?php echo $NOMBRE_L; ?></td>
<td><?php echo $MAIL; ?></td>

 

 


 


 
 

 
</tr>

 
<?php

 
}

 
?>

 
 

 
 

 
 

 
 

 
</table>

 
<?php

 
}

 
 

 
?>