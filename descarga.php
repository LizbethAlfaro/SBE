<?php

if (isset($_GET['ruta'])) {
    $ruta = $_GET['ruta'];
    switch ($ruta) {
        case 1:header("Content-disposition: attachment; filename=Guia_Paso_Paso.pdf");
            header("Content-type: application/pdf");
            readfile('./Descarga/Guia_Paso_Paso.pdf');
            break;
        case 2:header("Content-disposition: attachment; filename=Instructivo BI_Automat_UFE_2020.pdf");
            header("Content-type: application/pdf");
            readfile('./Descarga/Instructivo BI_Automat_UFE_2020.pdf');
            break;
        case 3:header("Content-disposition: attachment; filename=Apelacion.pdf");
            header("Content-type: application/pdf");
            readfile('./Descarga/Apelacion.pdf');
            break;
        default:
            header("Content-disposition: attachment;");
            header("Content-type: application/pdf");
            readfile("$ruta");
            break;
    }
} else {
    header("Content-disposition: attachment; filename=Documentos_necesarios.pdf");
//header("Content-type: MIME");
//https://mimentevuela.wordpress.com/2015/01/20/descarga-de-archivos-con-php/
    header("Content-type: application/pdf");
    readfile("./Descarga/Documentos_necesarios.pdf");
}

