<?php ?>

<?php
session_start();
if (!isset($_SESSION['user_login_admin_status']) AND $_SESSION['user_login_admin_status'] != 1) {
    header("location: loginAdmin.php");
    exit;
}

/* Connect To Database */
require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

include '../Clases/Horario.php';

$rut_estudiante    = $_GET['rut_estudiante'];
$nombre_estudiante = $_GET['estudiante'];
$mail_estudiante   = $_GET['mail'];
$nombre_asistente  = $_GET['asistente'];

if (isset($_POST['fecha'])) {
    $fecha_actual = date("Y-m-d", strtotime($_POST['fecha']));
} else {
    $fecha_actual = date("2020-01-27");
 //   $fecha_actual = date("Y-m-d");
}


if (isset($_GET['modulo_sel']) && $_GET['fecha_sel']) {
    $modulo_sel = $_GET['modulo_sel'];
    $fecha_sel = $_GET['fecha_sel'];
} else {
    $modulo_sel = "";
    $fecha_sel = $fecha_actual;
}



$active_horario = "active";
$title = " Seleccion de Atencion | UGM";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("./headAdmin.php"); ?>
    </head>
    <body>
        <?php
        include("./navbarAdmin.php");

        ?>
        <div class="container text-center" >
            <input type="hidden" id="rut_estudiante" value="<?php echo $rut_estudiante; ?>">
            <input type="hidden" id="fecha_sel" value="<?php echo $fecha_sel; ?>">
            <input type="hidden" id="modulo_sel" value="<?php echo $modulo_sel; ?>">
            <input type="hidden" id="fecha_actual" value="<?php echo $fecha_actual; ?>">
            <input type="hidden" id="modulo_registrado" value="<?php echo $modulo_registrado; ?>">
            <input type="hidden" id="fecha_registrada" value="<?php echo $fecha_registrada; ?>">
            
            <input type="hidden" id="nombre_estudiante" value="<?php echo $nombre_estudiante; ?>">
            <input type="hidden" id="mail_estudiante" value="<?php echo $mail_estudiante; ?>">
            <input type="hidden" id="nombre_asistente" value="<?php echo $nombre_asistente; ?>">

            <div class="panel panel-success">
               
                    <div class="panel-body">

                        <h1>Entrevistas</h1>  
                    </div>

                    <div class="panel-body">
                        <div id="resultados_ajax" ></div>
<form id="reagendar_cita" action="" method="POST">
 <div class="form-group">   
     
    
     <div class="col-sm-12">
                                <label>Seleccione Fecha </label>        
                                <input class="form-control text-center" type="date" id="calendario" name="fecha" value="<?php echo $fecha_actual; ?>" onblur="submit()"> 
     </div>    
 
                            
                            
  </div>  
</form>
                             
                    </div>  
  
            </div>

            <div id="resultados_ajax_reagendar_cita"></div>
        </div>   
    </body>
    <footer style="margin-top: 10%">
        <?php
include("../footer.php");
        ?>    
    </footer>
    <script type="text/javascript" src="../js/funciones/horario.js"></script>
    <script type="text/javascript" src="../js/reagendarCita_page.js"></script> 


</html>
