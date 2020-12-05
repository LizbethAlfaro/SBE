<?php

use Dompdf\Dompdf;
use Dompdf\Options;
//include $_SERVER['DOCUMENT_ROOT']."/BecasBeneficios/Clases/Informe.php";
include $_SERVER['DOCUMENT_ROOT']."/Clases/Informe.php";

function obtenerSolicitud($rut,$con){
ob_start();
//require_once ($_SERVER['DOCUMENT_ROOT']."/BecasBeneficios/obtenerInforme.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/obtenerInforme.php");
$html = ob_get_clean();
//echo $html;
//echo $title;

// librerias de dompdf
//require_once $_SERVER['DOCUMENT_ROOT']."/BecasBeneficios/dompdf/autoload.inc.php";
require_once $_SERVER['DOCUMENT_ROOT']."/dompdf/autoload.inc.php";

//$rutaGuardado = $_SERVER['DOCUMENT_ROOT']."/BecasBeneficios/Informes/$rut/";
$rutaGuardado = $_SERVER['DOCUMENT_ROOT']."/Informes/$rut/";
$nombreArchivo = $rut."_"."S"."_".date('d-m-Y').".pdf";
$tipo="Formulario Único Postulación y Renovación - Enviado";
$options = new Options();
$options->setDpi(180);
$options->set('isRemoteEnabled', true);
// Inicializamos dompdf
$dompdf = new Dompdf($options);

// Le pasamos el html a dompdf
$dompdf->loadHtml($html);

$dompdf->setBasePath('./bootstrap-3.3.6/dist/css/bootstrap.min.css');

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
 
$canvas->set_opacity(.1); 
 
$x = (($w-$imgWidth)/1.6); 
$y = (($h-$imgHeight)/2); 


//image($img_url, $x, $y, $w, $h, $resolution = "normal");
$canvas->image($imageURL, $x, $y, $imgWidth, $imgHeight);
//fin sello de agua


$output = $dompdf->output();

if (!file_exists($rutaGuardado)) {
    mkdir($rutaGuardado, 0777, true);
}
if (!file_exists($rutaGuardado.$nombreArchivo)) {
    file_put_contents( $rutaGuardado.$nombreArchivo, $output);

    Informe::registrarInforme($rut,$rutaGuardado.$nombreArchivo,$tipo,$con);
   
}else{
    
    $errors[]= "Informe ya fue generado";
    if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
                        exit;
}


}
?>