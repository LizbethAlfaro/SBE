<?php

include('is_logged_admin.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database */
require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
include '../Clases/Horario.php';
include '../Clases/InformeBecaInterna.php';
include '../Clases/Log.php';



use Dompdf\Dompdf;
use Dompdf\Options;



$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if ($action == 'ajax') {

$nombre_beca = $_REQUEST['beca'];
$rut  = $_REQUEST['rut'];
$nombre  = $_REQUEST['nombre'];
$beca = $_REQUEST['id_beca'];

$post_calificacion_beca = $_REQUEST['post_calificacion'];
$aprobacion = $_REQUEST['aprobacion'];


//datos asistente que acredita
    require_once '../Clases/Asistente.php';

$rut_asistente = $_SESSION['rut_asistente'];
$habilitados = 1;
$asistenteQuery = Asistente::recuperarAsistente($rut_asistente,"",$habilitados,$con);

$asistenteArreglo;
while ($asistenteCursor = sqlsrv_fetch_array($asistenteQuery)) {
    $asistenteArreglo = array(
        "rut"         => $asistenteCursor['rut_asistente'],
        "nombre"      => $asistenteCursor['nombre_asistente'],
        "apellido"    => $asistenteCursor['apellido_asistente']    
    );
}

$acredita = $asistenteArreglo['nombre']." ".$asistenteArreglo['apellido'];
//fin

$sf = "0";
$aa = "0";
$na = "0";
$ar = "0";
$he = "0";
$e4 = "0";
$cvd= "0";
$cvd= "0";
$sd = "0";
$cf = "0";
$ct = "0";
$cp = "0";
$cert = "0";
$ne= "0";
$bm= "0";
$cae= "0";
$psu= "0";
$calificacion=$_REQUEST['calificacion'];


switch($beca){

        case 1: //ugm
             switch($post_calificacion_beca){
                 case "Postulante" : 
                 if (empty($_REQUEST['psu'])) {
                    $errors[] = "Psu no puede estar vacio";
                 }else{
                  $psu = $_REQUEST['psu'];   
                 }
                 break;
                 case "Renovante":
                 if (empty($_REQUEST['na'])) {
                    $errors[] = "Na no puede estar vacio";
                 }else if (empty($_REQUEST['aa'])) {
                    $errors[] = "Aa no puede estar vacio";
                 }else if (empty($_REQUEST['sf'])) {
                    $errors[] = "Sf no puede estar vacio";
                 }else if (empty($_REQUEST['ar'])) {
                    $errors[] = "Ar no puede estar vacio";
                 }else{
                    $na = $_REQUEST['na'];
                    $aa = $_REQUEST['aa'];
                    $sf = $_REQUEST['sf'];
                    $ar = $_REQUEST['ar'];   
                 }      
                 break;
            }
             
            break;
        case 2://deportiva
            switch($post_calificacion_beca){
                 case "Postulante" :

                 if (empty($_REQUEST['cvd'])) {
                    $errors[] = "Cvd no puede estar vacio";
                 }else if (empty($_REQUEST['sd'])) {
                    $errors[] = "Sd no puede estar vacio";
                 }else if (empty($_REQUEST['cf'])) {
                    $errors[] = "Cf no puede estar vacio";
                 }else{
                    $cvd = $_REQUEST['cvd'];
                    $sd  = $_REQUEST['sd'];
                    $cf  = $_REQUEST['cf']; 
                 }      
                 break;

                 case "Renovante" :

                 if (empty($_REQUEST['cvd'])) {
                    $errors[] = "Cvd no puede estar vacio";
                 }else if (empty($_REQUEST['sd'])) {
                    $errors[] = "Sd no puede estar vacio";
                 }else if (empty($_REQUEST['aa'])) {
                    $errors[] = "Aa no puede estar vacio";
                 }else if (empty($_REQUEST['na'])) {
                    $errors[] = "Na no puede estar vacio";
                 }else{   
                    $cvd = $_REQUEST['cvd'];
                    $sd  = $_REQUEST['sd'];
                    $aa  = $_REQUEST['aa'];
                    $na  = $_REQUEST['na']; 
                 } 
                 break;
            }

            break;
        case 3:   //alumni  
             switch($post_calificacion_beca){
                  case "Postulante" :

                 if (empty($_REQUEST['e4'])) {
                    $errors[] = "E4 no puede estar vacio";
                 }else if (empty($_REQUEST['certificado'])) {
                    $errors[] = "Certificado no puede estar vacio";
                 }else if (empty($_REQUEST['sf'])) {
                    $errors[] = "Sf no puede estar vacio";
                 }else{   
                    $e4         = $_REQUEST['e4'];
                    $cert       = $_REQUEST['certificado'];
                    $sf         = $_REQUEST['sf'];
                 }
                 break;
                 
                  case "Renovante" :

                 if (empty($_REQUEST['na'])) {
                    $errors[] = "Na no puede estar vacio";
                 }else if (empty($_REQUEST['aa'])) {
                    $errors[] = "Aa no puede estar vacio";
                 }else{   
                    $na = $_REQUEST['na'];
                    $aa  = $_REQUEST['aa']; 
                 }
                 break;
            }
            break;
        case 4://funcionario
            switch($post_calificacion_beca){
            
                  case "Postulante" :

                 if (empty($_REQUEST['sf'])) {
                    $errors[] = "Sf no puede estar vacio";
                 }else if (empty($_REQUEST['ar'])) {
                    $errors[] = "Ar no puede estar vacio";
                 }else if (empty($_REQUEST['ct'])) {
                    $errors[] = "Ct no puede estar vacio";
                 }else if (empty($_REQUEST['cp'])) {
                    $errors[] = "Cp no puede estar vacio";   
                 }else{   
                    $sf         = $_REQUEST['sf'];
                    $ar         = $_REQUEST['ar'];
                    $ct         = $_REQUEST['ct'];
                    $cp         = $_REQUEST['cp'];
                 }
                 break;
                 
                  case "Renovante" :

                 if (empty($_REQUEST['ct'])) {
                    $errors[] = "Ct no puede estar vacio";
                 }else if (empty($_REQUEST['cp'])) {
                    $errors[] = "Cp no puede estar vacio";
                 }else if (empty($_REQUEST['na'])) {
                    $errors[] = "Na no puede estar vacio";
                 }else if (empty($_REQUEST['aa'])) {
                    $errors[] = "Aa no puede estar vacio";   
                 }else{   
                    $ct         = $_REQUEST['ct'];
                    $cp         = $_REQUEST['cp'];
                    $na         = $_REQUEST['na'];
                    $aa         = $_REQUEST['aa'];
                 }
                 break;
            }
            break;
        case 5:// familiar
            switch($post_calificacion_beca){
                 
                 case "Postulante" :

                 if (empty($_REQUEST['sf'])) {
                    $errors[] = "Sf no puede estar vacio";
                 }else if (empty($_REQUEST['ar'])) {
                    $errors[] = "Ar no puede estar vacio";
                 }else if (empty($_REQUEST['he'])) {
                    $errors[] = "He no puede estar vacio";   
                 }else{   
                    $sf         = $_REQUEST['sf'];
                    $ar         = $_REQUEST['ar'];
                    $he         = $_REQUEST['he'];
                 }
                 
                 break;

                  case "Renovante" :

                 if (empty($_REQUEST['he'])) {
                    $errors[] = "He no puede estar vacio";
                 }else if (empty($_REQUEST['na'])) {
                    $errors[] = "Na no puede estar vacio";
                 }else if (empty($_REQUEST['aa'])) {
                    $errors[] = "Aa no puede estar vacio";   
                 }else{   
                    $he         = $_REQUEST['he'];
                    $na         = $_REQUEST['na'];
                    $aa         = $_REQUEST['aa'];
                 }
                 break;
            }
            break;
        case 6: //extranjeros
            switch($post_calificacion_beca){
                 
                  case "Postulante" :

                 if (empty($_REQUEST['ne'])) {
                    $errors[] = "Ne no puede estar vacio";
                 }else if (empty($_REQUEST['ar'])) {
                    $errors[] = "Ar no puede estar vacio";
                 }else if (empty($_REQUEST['e4'])) {
                    $errors[] = "E4 no puede estar vacio";   
                 }else{   
                    $ne         = $_REQUEST['ne'];
                    $ar         = $_REQUEST['ar'];
                    $e4         = $_REQUEST['e4'];
                 }
                 
                 break;
                 
                  case "Renovante" :

                 if (empty($_REQUEST['sf'])) {
                    $errors[] = "Sf no puede estar vacio";
                 }else if (empty($_REQUEST['na'])) {
                    $errors[] = "Na no puede estar vacio";
                 }else if (empty($_REQUEST['aa'])) {
                    $errors[] = "Aa no puede estar vacio";   
                 }else{   
                    $sf         = $_REQUEST['sf'];
                    $na         = $_REQUEST['na'];
                    $aa         = $_REQUEST['aa'];
                 }
                 break;
            }
            break;
        case 7://copago
            switch($post_calificacion_beca){
                 
             case "Postulante" :
                 if (empty($_REQUEST['sf'])) {
                    $errors[] = "Sf no puede estar vacio";
                 }else if (empty($_REQUEST['ar'])) {
                    $errors[] = "Ar no puede estar vacio";
                 }else if (empty($_REQUEST['bm'])) {
                    $errors[] = "Bm no puede estar vacio";   
                 }else if (empty($_REQUEST['cae'])) {
                    $errors[] = "Cae no puede estar vacio";    
                 }else{   
                    $sf         = $_REQUEST['sf'];
                    $ar         = $_REQUEST['ar'];
                    $bm         = $_REQUEST['bm'];
                    $cae        = $_REQUEST['cae'];
                 }
                 
                 break;
                  case "Renovante" :
                 if (empty($_REQUEST['sf'])) {
                    $errors[] = "Sf no puede estar vacio";
                 }else if (empty($_REQUEST['ar'])) {
                    $errors[] = "Ar no puede estar vacio";
                 }else if (empty($_REQUEST['bm'])) {
                    $errors[] = "Bm no puede estar vacio";   
                 }else if (empty($_REQUEST['cae'])) {
                    $errors[] = "Cae no puede estar vacio";    
                 }else{   
                    $sf         = $_REQUEST['sf'];
                    $ar         = $_REQUEST['ar'];
                    $bm         = $_REQUEST['bm'];
                    $cae        = $_REQUEST['cae'];
                 }
                 break;
            }
            break;
        case 8:
              switch($post_calificacion_beca){
                  case "Postulante" :

                 if (empty($_REQUEST['ar'])) {
                    $errors[] = "Ar no puede estar vacio";
                 }else if (empty($_REQUEST['sf'])) {
                    $errors[] = "Af no puede estar vacio";
                 }else if (empty($_REQUEST['aa'])) {
                    $errors[] = "Aa no puede estar vacio";
                 }else if (empty($_REQUEST['na'])) {
                    $errors[] = "Na no puede estar vacio";   
                 }else{   
                    $ar         = $_REQUEST['ar'];
                    $sf         = $_REQUEST['sf'];
                    $aa         = $_REQUEST['aa'];
                    $na         = $_REQUEST['na'];
                 }
                 break;
                 
                  case "Renovante" :

                 if (empty($_REQUEST['ar'])) {
                    $errors[] = "Ar no puede estar vacio";
                 }else if (empty($_REQUEST['sf'])) {
                    $errors[] = "Af no puede estar vacio";
                 }else if (empty($_REQUEST['aa'])) {
                    $errors[] = "Aa no puede estar vacio";
                 }else if (empty($_REQUEST['na'])) {
                    $errors[] = "Na no puede estar vacio";   
                 }else{   
                    $ar         = $_REQUEST['ar'];
                    $sf         = $_REQUEST['sf'];
                    $aa         = $_REQUEST['aa'];
                    $na         = $_REQUEST['na'];
                 }
                 break;
            }
            break;
        case 10:
           switch($post_calificacion_beca){
                  case "Postulante" :

                 if (empty($_REQUEST['e4'])) {
                    $errors[] = "E4 no puede estar vacio";
                 }else if (empty($_REQUEST['certificado'])) {
                    $errors[] = "Certificado no puede estar vacio";
                 }else if (empty($_REQUEST['sf'])) {
                    $errors[] = "Sf no puede estar vacio";
                 }else{   
                    $e4         = $_REQUEST['e4'];
                    $cert       = $_REQUEST['certificado'];
                    $sf         = $_REQUEST['sf'];
                 }
                 break;
                 
                  case "Renovante" :

                 if (empty($_REQUEST['na'])) {
                    $errors[] = "Na no puede estar vacio";
                 }else if (empty($_REQUEST['aa'])) {
                    $errors[] = "Aa no puede estar vacio";
                 }else{   
                    $na = $_REQUEST['na'];
                    $aa  = $_REQUEST['aa']; 
                 }
                 break;
            }
            break;
        case 11:
            switch($post_calificacion_beca){
                  case "Postulante" :

                 if (empty($_REQUEST['e4'])) {
                    $errors[] = "E4 no puede estar vacio";
                 }else if (empty($_REQUEST['certificado'])) {
                    $errors[] = "Certificado no puede estar vacio";
                 }else if (empty($_REQUEST['sf'])) {
                    $errors[] = "Sf no puede estar vacio";
                 }else{   
                    $e4         = $_REQUEST['e4'];
                    $cert       = $_REQUEST['certificado'];
                    $sf         = $_REQUEST['sf'];
                 }
                 break;
                 
                  case "Renovante" :

                 if (empty($_REQUEST['na'])) {
                    $errors[] = "Na no puede estar vacio";
                 }else if (empty($_REQUEST['aa'])) {
                    $errors[] = "Aa no puede estar vacio";
                 }else{   
                    $na = $_REQUEST['na'];
                    $aa  = $_REQUEST['aa']; 
                 }
                 break;
            }
            break;    
    }






        

if (!isset($errors)){

//
ob_start();
//include $_SERVER['DOCUMENT_ROOT']."/BecasBeneficios/admin/informeBecaInterna.php";
include $_SERVER['DOCUMENT_ROOT']."/admin/informeBecaInterna.php";
$html = ob_get_clean();
////echo $html;
////echo $title;
//
//// librerias de dompdf
//require_once $_SERVER['DOCUMENT_ROOT']."/BecasBeneficios/dompdf/autoload.inc.php";
require_once $_SERVER['DOCUMENT_ROOT']."/dompdf/autoload.inc.php";

//$rutaGuardado = $_SERVER['DOCUMENT_ROOT']."/BecasBeneficios/Informes/$rut/";
$rutaGuardado = $_SERVER['DOCUMENT_ROOT']."/Informes/$rut/";
$nombreArchivo = $rut."_BECA_".$nombre_beca."_".date('d-m-Y').".pdf";
$tipo="$nombre_beca";
$options = new Options();
$options->setDpi(180);
$options->set('isRemoteEnabled', true);
//// Inicializamos dompdf
$dompdf = new Dompdf($options);
//
//// Le pasamos el html a dompdf
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

    InformeBecaInterna::registrarInformeBecaInterna($rut,$rutaGuardado.$nombreArchivo,$tipo,$con);
    

    $result_calificacion=InformeBecaInterna::registrarCalificacionBecaInterna($rut,$nombre,$nombre_beca,$post_calificacion_beca,$na,$aa,$sf,$e4,$ar,$cvd,$sd,$cf,$ct,$cp,$cert,$ne,$he,$bm,$cae,$psu,$acredita,$calificacion,$con);
    
    $estado=1;
    switch ($calificacion){
        case 'Califica':
               $estado=2;
            break;
        case 'NO califica':
               $estado=3;
            Break;
        default :
            break;
    }
    

    EstudianteBeca::estadoEstudianteBeca($rut,$_SESSION['rut_asistente'],$estado,$con);
    $accion="Evalua $nombre_beca de $rut con resultado $calificacion ";
    Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);
    $messages[]= "Informe generado con exito";
   
}else{
     $errors[]= "Informe ya fue generado";   
}

}

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
if (isset($messages)) {

            ?>
            			<div class="alert alert-success" role="alert">
            				<button type="button" class="close" data-dismiss="alert">&times;</button>
            					<strong>Bien Hecho!</strong> 
            <?php
            foreach ($messages as $message) {
                echo $message;
            }
            ?>
            			</div>
            <?php
        }
        exit;
}






        
?>