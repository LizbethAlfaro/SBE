<?php
session_start();
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}


/* Connect To Database */
require_once ("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php"); //Contiene funcion que conecta a la base de datos

include './Clases/Declaracion.php';
include './Clases/Solicitud.php';

$rut_estudiante=$_SESSION['rut_estudiante'];

//declaracion
$declaracionQuery = Declaracion::recuperarDeclaracion($rut_estudiante,$con);

$declaracionArreglo;

if($declaracionQuery){
  $contador_declaracion = sqlsrv_num_rows($declaracionQuery);
}else{
  $contador_declaracion = 0;  
}
if($contador_declaracion>0){
 while ($declaracionCursor = sqlsrv_fetch_array($declaracionQuery)) {
    $declaracionArreglo = array(
        "declaracion"      => $declaracionCursor['declaracion'],
    );
}   
}else{
$declaracionArreglo = array(
        "declaracion"      => "",
    );    
}

//tipo
$condicion = "";
$tipoQuery = Solicitud::recuperarSolicitud($rut_estudiante,$condicion,$con);

$tipoArreglo;

if($tipoQuery){
  $contador_tipo = sqlsrv_num_rows($tipoQuery);
}else{
  $contador_tipo = 0;  
}
if($contador_tipo>0){
 while ($tipoCursor = sqlsrv_fetch_array($tipoQuery)) {
$tipoArreglo = array(
        "tipo"      => $tipoCursor['tipo'],
    );
}   
}else{
$tipoArreglo = array(
        "tipo"      => "",
    );    
}

$validar = sqlsrv_num_rows($declaracionQuery);

$validar = 0;

$active_declaracion = "active";
$title = " Historial | Owl Evaluation";
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
        <style type="text/css">
            textArea{
                width: 100%; 
            }            
            .declaracion{
                height: 20rem;   
            }
        </style>  

        <div class="container text-center" >
            <div class="panel panel-success">
                <div class="panel-body">
                    <h1>Declaración Solicitud</h1>  
                </div>
               <div id="resultados_ajax_declaracion"></div>

                
                
                <form id="guardar_declaracion">
                <div class="panel-body">
             
                    <div>
                        <label class="form-control">Tipo de solicitud</label>   
                    </div>
                    
                    <label>Renovante <input class="form-control" id="r1" type="radio" value="1" name="tipo_sol"></label>
                    <label></label>
                    <label>Postulante<input class="form-control" id="r2" type="radio" value="2" name="tipo_sol"></label>
               
                </div>
                  
                <div class="panel-body">
                
                <div class="panel-default">
                    <div style="height: 100px;">Declare y fundamente su solicitud al beneficio, en menos de 500 palabras</div>          
                </div>  
                    <div class="panel panel-default">
                       
                        <input type="hidden" id="rut_estudiante" name="rut_estudiante" value="<?php echo $rut_estudiante;?>">
                        <textarea id="declaracion" name="declaracion" class="declaracion" required <?php if($validar>0){echo 'disabled';}?>><?php echo $declaracionArreglo['declaracion']; ?></textarea>
                      
                    </div>

                </div>

                <div class="panel-body">                
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="form-group">          
<!--                                    <input class="btn btn-block btn-success <?php if($validar>0){echo 'hidden';}?>" type="submit" value="Registrar Datos">-->
                                    <button class="btn btn-block btn-success <?php if($validar>0){echo 'hidden';}?>" type="submit"><span class="glyphicon glyphicon-exclamation-sign"></span> Registrar Datos</button>
                                </div>
                            </div>
                        </div>
                </div>

                </form>
                    
            </div>

        </div>
                <div style="margin-bottom: 100px;"></div>
        <hr>
        <?php
        include("footer.php");
        ?>
        
        <!--PLUGIN LIMITADOR-->
        <script type="text/javascript" src="js/extras/jquery-inputlimiter/jquery.inputlimiter.1.3.1.js"></script>
        <link rel="stylesheet" type="text/css" href="js/extras/jquery-inputlimiter/jquery.inputlimiter.1.0.css" />

        
        <script type="text/javascript" src="js/extras/Limitador.js"></script>
        <script type="text/javascript" src="js/funciones/declaracion.js"></script>
 
        <script>

             switch('<?php echo $tipoArreglo['tipo']; ?>'){
                 case '1': $("#r1").prop("checked", true);   
                 break;
                 case '2': $("#r2").prop("checked", true);   
                 break;
                 default :
             }
   
        </script>
    </body>
</html>
