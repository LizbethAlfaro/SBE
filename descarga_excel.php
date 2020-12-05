<?php

if (isset($_GET['ruta'])) {
 $ruta = $_GET['ruta'];

header("Content-disposition: attachment; filename=reporte_final.xls");
header("Content-Type: application/xls charset=iso-8859-1");
readfile("$ruta");

}

