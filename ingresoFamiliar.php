<?php
session_start();

if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}
/* Connect To Database */
require_once ("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php"); //Contiene funcion que conecta a la base de datos
include './Clases/Integrante.php';
include './Clases/Solicitud.php';


$active_ingreso = "active";
$title = "Preguntas | Owl Evaluation";

//clases para select
include './Clases/Ingreso.php';

$rut = $_SESSION['rut_estudiante'];

$result_ingreso = Ingreso::recuperarIngreso("",$rut, $con, "", "", "");
if($result_ingreso){
$validar = sqlsrv_num_rows($result_ingreso);
}else{
$validar=0;    
}

$condicion = "";

$solicitud = Solicitud::recuperarSolicitud($rut,$condicion,$con);
$solicitudArreglo;
while ($solicitudCursor = sqlsrv_fetch_array($solicitud)) {
    $solicitudArreglo = array(
        "estado"           => $solicitudCursor['estado'],

    );
}

$validar=$solicitudArreglo['estado'];



?>
<!DOCTYPE html>
<html lang="en">
    <head>
<?php include("head.php"); ?>
    </head>
    <body>
        <?php
        include("navbar.php");
        if ($validar>0 && $validar!=4) {
    header("location: informacion.php");
    exit;
}
        ?>

        <div class="container">
            <form class="form-horizontal" id="guardar_ingresos">     
            <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="btn-group pull-right">
                             <button id="guardar_datos" type='submit' class="btn btn-success btn-block <?php if($validar>0){echo 'hidden';}?>" ><span class="glyphicon glyphicon-exclamation-sign"></span> Guardar Ingresos </button>      
                        </div>
                        <h4><i class='glyphicon glyphicon-search'></i> Ingreso por integrante </h4>
                    </div>
                    <div class="panel-body">
                        <div id="resultados_ajax"></div>
                        <input type="hidden" id="rut_estudiante" name="rut_estudiante" value="<?php echo $rut; ?>"> 

                        <!-- el select de la bd se carga en los div -->
                        <div id="resultados2"></div><!-- Carga los datos ajax -->
                        <div class='outer_div'></div><!-- Carga los datos ajax -->

                    </div>
            </div>
            </form>
        </div>
        
        <div class="container" >
            <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4><i class='glyphicon glyphicon-bitcoin'></i> Ingreso total mensual por año </h4>
                    </div>
                    <div class="panel-body">
                        <table border="0" class="table text-center">
                            <tbody>
                                <tr>
                                    <td>AÑO</td>
                                    <td>TOTAL MENSUAL</td>
                                </tr>
                                <tr>
                                    <td><?php echo date('Y'); ?></td>
                                    <td id="total"></td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>
            </div>
            </div>    
            <div class="col-sm-6">
            <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4><i class='glyphicon glyphicon-bitcoin'></i> Ingreso percap </h4>
                    </div>
                    <div class="panel-body">
                        <table border="0" class="table text-center">
                            <tbody>

                                <tr>
                                    <td>PERCAP</td>
                                    <td id="percap"></td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>
            </div>
            </div>
            </div> 
            <div style="height: 100px;"></div>
      </div>    
      
     
        
<?php
include("footer.php");
?>
        <!-- el select proviene de js -->
        <script type="text/javascript" src="js/funciones/integrante.js"></script>
        <script type="text/javascript" src="js/extras/Suma.js"></script>
        <script type="text/javascript" src="js/ingresoFamiliar_page.js"></script> 
        <script type="text/javascript" src="js/funciones/ingreso.js"></script> 
    </body>
</html>
