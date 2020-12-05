<?php
session_start();
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}

/* Connect To Database */
require_once ("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php"); //Contiene funcion que conecta a la base de datos

include './Clases/Horario.php';

$rut_estudiante = $_SESSION['rut_estudiante'];

if (isset($_POST['fecha'])) {
    $fecha_actual = date("Y-m-d", strtotime($_POST['fecha']));
} else {
//       $fecha_actual = date("2020-02-10");
    $fecha_actual = date("Y-m-d");
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
        <?php include("head.php"); ?>
    </head>
    <body>
        <?php
        include("navbar.php");
        if ($validar>0) {
    header("location: informacion.php");
    exit;
}
        ?>
        <div class="container text-center" >
            <input type="hidden" id="rut_estudiante" value="<?php echo $rut_estudiante; ?>">
            <input type="hidden" id="fecha_sel" value="<?php echo $fecha_sel; ?>">
            <input type="hidden" id="modulo_sel" value="<?php echo $modulo_sel; ?>">
            <input type="hidden" id="fecha_actual" value="<?php echo $fecha_actual; ?>">
            <input type="hidden" id="modulo_registrado" value="<?php echo $modulo_registrado; ?>">
            <input type="hidden" id="fecha_registrada" value="<?php echo $fecha_registrada; ?>">

            <div class="panel panel-success">
               
                    <div class="panel-body">

                        <h1>Fecha Entrevista</h1>  
                    </div>

                    <div class="panel-body">
                        <div id="resultados_ajax" ></div>
<form id="citacion" action="seleccionarHorario.php" method="POST">
 <div class="form-group">   
     
    
     <div class="col-sm-12">
                                <label>Seleccione Fecha </label>        
                                <input class="form-control text-center" type="date" id="calendario" name="fecha" value="<?php echo $fecha_actual; ?>" onblur="submit()"> 
     </div>    
 
     <h3 style="color: red;">LAS ENTREVISTAS SERAN A POR VIDEOLLAMADAS</h3>
     <h4 style="color: red;"> Recuerde que las entrevistas se realizarán por videollamadas y debe enviar la documentación de respaldo con 48 horas de anticipación a su entrevista, por favor leer las indicaciones en la parte inferior de su formulario.</h4>
                            
  </div>  
</form>
                             
                    </div>  
  
            </div>

            <div id="resultados_ajax_horario_disponible"></div>
        </div>   
    </body>
    <footer style="margin-bottom: 100px;">
        <?php
include("footer.php");
        ?>    
    </footer>
    <script type="text/javascript" src="js/funciones/horario.js"></script>
    <script type="text/javascript" src="js/seleccionarHorario_page.js"></script> 


</html>
