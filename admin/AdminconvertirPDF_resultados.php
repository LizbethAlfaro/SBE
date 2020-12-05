<?php

use Dompdf\Dompdf;
use Dompdf\Options;


ob_start();
$rut=$_REQUEST['rut'];
include './AdminResultados_comprobante.php';
$html = ob_get_clean();
// librerias de dompdf

//require_once $_SERVER['DOCUMENT_ROOT']."/dompdf/autoload.inc.php";
require_once '../dompdf/autoload.inc.php';

$options = new Options();
$options->setDpi(180);
$options->set('isRemoteEnabled', true);
// Inicializamos dompdf
$dompdf = new Dompdf($options);

// Le pasamos el html a dompdf
$dompdf->loadHtml($html);

$dompdf->setBasePath('../bootstrap-3.3.6/dist/css/bootstrap.min.css');

// Colocamos als propiedades de la hoja
//$dompdf->setPaper("A4", "landscape");
$dompdf->setPaper("A4");
// Escribimos el html en el PDF
$dompdf->render();
// Ponemos el PDF en el browser
//$dompdf->stream('FormularioBecas');

//inicio sello de agua
$canvas = $dompdf->getCanvas(); 
$w = $canvas->get_width(); 
$h = $canvas->get_height(); 

$imageURL = '../img/Timbre_2.png'; 
$imgWidth = $w/1.3; 
$imgHeight = $h/2; 
 
$canvas->set_opacity(.03); 
 
$x = (($w-$imgWidth)/1.6); 
$y = (($h-$imgHeight)/2); 


//image($img_url, $x, $y, $w, $h, $resolution = "normal");
$canvas->image($imageURL, $x, $y, $imgWidth, $imgHeight);
//fin sello de agua


$output = $dompdf->output();

$dompdf->stream();
echo $output;


?>