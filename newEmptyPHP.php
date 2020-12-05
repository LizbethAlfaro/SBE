<?php
/* Connect To Database */
require_once ("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php"); //Contiene funcion que conecta a la base de datos

include './Clases/UMAS.php';

$rut = "24603021";
$condicion = ""; //where...

$estudianteQuery = UMAS::NOTAS_ANUALES($rut,$con);
$estudianteArreglo;
while ($estudianteCursor = sqlsrv_fetch_array($estudianteQuery)) {
    $estudianteArreglo = array(
        "rut"       => $estudianteCursor['CODCLI'],
        "promedio"    => $estudianteCursor['PROMEDIO_AP'],

    );
}

?>


