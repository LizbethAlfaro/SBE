<?php
// Verifica version minima de PHP
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("No puede correr en versiones inferiores a 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // la libreria de contraseña no funciona en versiones inferiores
    require_once("libraries/password_compatibility_library.php");
}

// incluye  la coneccion a BD
require_once("config/db.php");
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
// Abre la  clase login en donde se crearan las variables de session
require_once("./Autenticacion/Login.php");
include './Clases/Proceso.php';

$id="";

 $procesoQuery = Proceso::recuperarProceso($id, $con);
 if($procesoQuery){
 while ($procesoCursor = sqlsrv_fetch_array($procesoQuery)) {
     switch ($procesoCursor['id_tipo_proceso']){
         case 1:$fecha_fin  = $procesoCursor['termino'];
             break;
         case 2:$fecha_fin2  = $procesoCursor['termino'];
             break;
         
     }
 
}
}



$fecha_actual = new DateTime(date('d-m-Y'));

if(isset($fecha_fin)){
$fecha_proceso = new DateTime($fecha_fin);   
$restante =$fecha_proceso->diff($fecha_actual);
}


if(isset($fecha_fin2)){
$fecha_proceso2 = new DateTime($fecha_fin2); 
$restante2 =$fecha_proceso2->diff($fecha_actual);    
}








//clases para select
include './Clases/Carrera.php';
include './Clases/Genero.php';
include './Clases/Comuna.php';
include './Clases/Region.php';
include './Clases/Estudiante.php';
include './Clases/Direccion.php';
include './Clases/FechaIng.php';
include './Clases/Jornada.php';
include './Clases/Becas.php'; 
include './Clases/Scape.php';  
include './Clases/Solicitud.php';

// se crea el objeto login para ingresar y salir de la session de manera simple
$login = new Login();




// evalua si se logea correctamente
if ($login->isUserLoggedIn() == true) {

$rut_estudiante = $_SESSION['rut_estudiante'];    
$condicion = "";
$solicitud = Solicitud::recuperarSolicitud($rut_estudiante,$condicion,$con);
$solicitudArreglo;
while ($solicitudCursor = sqlsrv_fetch_array($solicitud)) {
    $solicitudArreglo = array(
        "estado"           => $solicitudCursor['estado'],
    );
}

$estado=$solicitudArreglo['estado'];
if($estado==0){
   header("location: terminosCondiciones.php");     
}else{
     
    //si es que se logea en direcciona a la url
   header("location: datosPersonales.php");   
}

    

} else {
    // si no se logea direcciona envia mensaje de error
    ?>
	<!DOCTYPE html>
<html lang="es">

  
    
<head>
<!--    <link rel="shortcut icon" type="image/x-icon" href="/img/ugm.jpg" />-->
<link rel="icon" type="image/png" href="/img/ugm.png" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title> Login | UGM </title>
  
        <!-- Jquery 2.2.4 -->
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- CSS  -->
        <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
          <?php
             
				// muestra posibles errores
				if (isset($con)) {
    
						?>
                                                <div class="alert alert-dismissible alert-dismissible" role="alert">
                                                    <strong>Estado Conexion :</strong> <?php echo $mensaje ?>
						
						</div>
	
<body>
    <!--modal-->
    <?php
            include './modal/registro_estudiante.php';
            include './modal/registro_becas_internas.php';
            
            //becas
        include './modal/informacion_beca_ugm.php';
        include './modal/informacion_beca_ugm_deportiva.php';
        include './modal/informacion_beca_ugm_alumni_hijos.php';
        include './modal/informacion_beca_ugm_funcionario_hijos.php';
        include './modal/informacion_beca_ugm_familiar.php';
        include './modal/informacion_beca_ugm_extranjero.php';
        include './modal/informacion_beca_ugm_copago_cero.php';
        include './modal/informacion_beca_ugm_socieconomica.php';
        include './modal/informacion_beca_ugm_lider_social.php';
        include './modal/informacion_beca_ugm_integracion_cultural.php';
        include './modal/informacion_beca_ugm_educativas_especiales.php';
        include './modal/informacion_beca_ugm_mantencion.php';
        include './modal/informacion_beca_ugm_alimentacion.php';

        ?>
    <!--modal-->
 <div class="">
     <div class="container">
         
         <div>
             <div class="card card-container">

            <img id="profile-img" class="profile-img-card" src="img/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>

            <p style="color: black">TNE</p>
            <p style="color: black">Proceso finalizado</p>
            <p style="color: black">Unidad de Financiamiento Estudiantil</p>
            <!--
            <p style="color: black">Calculando</p>
            <p style="color: black">Resultados</p>
            <p style="color: black">Unidad de Financiamiento Estudiantil</p>

            -->

  
            </div>

        </div><!-- /card-container -->
        </div> 
       
        
</div>
    
    
    <div style="margin-bottom: 200px;">   
     </div>     
    </div><!-- /container -->
    
  </body>
<?php
	//include("footer.php");
?>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</html>

	<?php
}

}
