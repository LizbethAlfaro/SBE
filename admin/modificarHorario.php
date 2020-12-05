<?php ?>

<?php
session_start();
if (!isset($_SESSION['user_login_admin_status']) AND $_SESSION['user_login_admin_status'] != 1) {
    header("location: loginAdmin.php");
    exit;
}

if($_SESSION['tipo_asistente'] < 2){
header('location: horarioPersonal.php');    
}

/* Connect To Database */
require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

include '../Clases/ModuloHorario.php';
include '../Clases/Horario.php';
include '../Clases/Asistente.php';

if (isset($_POST['fecha'])) {
    $fecha_actual = date("Y-m-d", strtotime($_POST['fecha']));
} else {
    $fecha_actual = date("Y-m-d");
}
$fecha_titulo = substr($fecha_actual, 0, 10);

if (isset($_POST['asistente'])) {
    $asistente=$_POST['asistente'];
} else {
    $asistente="";
}

$arreglo = explode(" - ",$asistente);
$rut_asistente = $arreglo[0];


$dia_1 = Horario::fechaDiaCastellano($fecha_actual);
$dia_2 = Horario::fechaDiaCastellano(date("d-m-Y", strtotime($fecha_actual . "+ 1 days")));
$dia_3 = Horario::fechaDiaCastellano(date("d-m-Y", strtotime($fecha_actual . "+ 2 days")));
$dia_4 = Horario::fechaDiaCastellano(date("d-m-Y", strtotime($fecha_actual . "+ 3 days")));
$dia_5 = Horario::fechaDiaCastellano(date("d-m-Y", strtotime($fecha_actual . "+ 4 days")));
$dia_6 = Horario::fechaDiaCastellano(date("d-m-Y", strtotime($fecha_actual . "+ 5 days")));
$dia_7 = Horario::fechaDiaCastellano(date("d-m-Y", strtotime($fecha_actual . "+ 6 days")));

$dia_1_value = substr($fecha_actual, 0, 10);
$dia_2_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 1 days")), 0, 10);;
$dia_3_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 2 days")), 0, 10);;
$dia_4_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 3 days")), 0, 10);;
$dia_5_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 4 days")), 0, 10);;
$dia_6_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 5 days")), 0, 10);;
$dia_7_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 6 days")), 0, 10);;

$active_modificar_horario = "active";
$title = " Edicion Horario | UGM";
//
$horario_tomado="Tomado";


?>
<!DOCTYPE html>
<html lang="en">
    <head>
<?php include("headAdmin.php"); ?>
    </head>
    <body>
<?php
include("navbarAdmin.php");
?>

        <style>
    
 
        </style>
        
        <div class="container text-center" >
            <div class="panel panel-success">
                
                <div class="panel-body">
                    
                    <h1>Horarios</h1>  
                </div>

                <div class="panel-body">
                    <div id="resultados_ajax" ></div>
                    
                     <form id="semana_fecha" action="modificarHorario.php" method="POST">
                    
                    <div class="col-sm-3">
                        <label>Seleccione Fecha </label>        
                       
                        <input class="form-control" type="date" id="calendario" name="fecha" value="<?php echo $fecha_actual; ?>"> 
                      
                    </div>

                    <div class="col-sm-3">
                        <label>Seleccione Asistente Social</label>    
                        <select class='form-control' name='asistente' id='asistente' required onchange="submit()">
                            <option value="">Asistente Social</option>
                            <?php
                            // 1 para ver solo asistentes habilitados
                            $condicion = " AND rut_asistente != '00.000.000-0' ";
                                    $asistente_social = Asistente::recuperarAsistente("",$condicion,"1",$con);

                                    while ($rw = sqlsrv_fetch_array($asistente_social)) {
                                        ?>
                                        <option value="<?php echo $rw['rut_asistente']." - ".$rw['nombre_asistente']." - ".$rw['apellido_asistente']; ?>"><?php echo $rw['rut_asistente']." - ".$rw['nombre_asistente']." - ".$rw['apellido_asistente']; ?></option>			
                                        <?php
                                    }
                                    ?>
                        </select>  
                    </div>
                    
                         <div class="col-sm-6">
                            <label>Asistente</label>   
                            
                             <input class="form-control" type="text" value="<?php echo $asistente; ?>" readonly>
  
                        </div>

                           </form> 
                </div>  

            </div>

            <form id="modificar_horario">
                
            <input class="form-control" type="hidden" id="rut_asistente" name="rut_asistente" value="<?php echo $rut_asistente; ?>" readonly>
            <input class="hidden" type="checkbox" checked name="dia[]" value="<?php echo $dia_1_value; ?>">
            <input class="hidden" type="checkbox" checked name="dia[]" value="<?php echo $dia_2_value; ?>">
            <input class="hidden" type="checkbox" checked name="dia[]" value="<?php echo $dia_3_value; ?>">
            <input class="hidden" type="checkbox" checked name="dia[]" value="<?php echo $dia_4_value; ?>">
            <input class="hidden" type="checkbox" checked name="dia[]" value="<?php echo $dia_5_value; ?>">
            <input class="hidden" type="checkbox" checked name="dia[]" value="<?php echo $dia_6_value; ?>">
            <input class="hidden" type="checkbox" checked name="dia[]" value="<?php echo $dia_7_value; ?>">

                <div class="panel-body table-responsive">
                    
                    <table border="0" class="table">
                        <thead>
                            <tr>
                                <td colspan="8">
                                    <h2><?php  echo Horario::fechaAnhioMesCastellano(date("Y-m", strtotime($fecha_titulo)));?></h2>     
                                </td>
                            <tr>
                            <tr>
                                <td colspan="8">
                                    <input id="guardar_datos" type="submit" class="btn btn-primary btn-lg btn-block" value="Modificar Horario">   
                                </td>
                            <tr>
                        </thead>
                        <tbody>
                            <tr>
                               <td>

                                    <label class="form-control">Hora</label>
                                    <?php
                                    $modulo = ModuloHorario::recuperarModulo($con);
                                    while ($rw = sqlsrv_fetch_array($modulo)) {
                                        ?> 
                                        <label class="form-control no-border"><button type="button" class="btn btn-dark col-md-12"><?php echo $rw['horario']; ?></button></h3></label> 
    <?php
}
?>  

                                </td>
                                
                                <td>
                 
                                        <label class="form-control"><?php echo $dia_1; ?></label>
                                    <?php
                                    $estado = Horario::recuperarHorario($rut_asistente, $dia_1_value, $con);
                                   
                                    if($estado===false){
                                    $count = 0;
                                    }else{
                          
                                    $count = sqlsrv_num_rows($estado);    
                                    }
                                    
                                    if($count>0){
                                        
                                        
                                    while ($rw = sqlsrv_fetch_array($estado)) {
                                    $validar = Horario::validarHorarioAsistente($rut_asistente,$rw['modulo'],$dia_1_value,$con);
                                    if($validar==false){
                                        if($rw['estado']==1){
                                        ?> 
                                        <label class="form-control no-border"><input name="dia_1_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" checked data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>
                                        <?php
                                        }else{
                                        ?> 
                                        <label class="form-control no-border"><input  name="dia_1_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>
                                        <?php    
                                        }
                                    }else{
                                        ?>
                                         <label class="form-control no-border"><button type="button" class="btn btn-dark col-md-12"><?php echo $horario_tomado ?></button></h3></label> 
                                        <?php  
                                    }
                                    
                                    }
                                    
                                    }else{
                                     for($indice = 1 ; $indice<=25;$indice++){
                                        ?> 
                                        <label class="form-control no-border"><input name="dia_1_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>     
                                        <?php  
                                     }   
                                    }
                                    ?>  
                                   
                                </td>
                                
                                <td>
                        
                                        <label class="form-control"><?php echo $dia_2; ?></label>
                                    <?php
                                    $estado = Horario::recuperarHorario($rut_asistente, $dia_2_value, $con);
                                    
                                    if($estado===false){
                                    $count = 0;
                                    }else{
                          
                                    $count = sqlsrv_num_rows($estado);    
                                    }
                                    
                                    if($count>0){
                                    while ($rw = sqlsrv_fetch_array($estado)) {
                                    $validar = Horario::validarHorarioAsistente($rut_asistente,$rw['modulo'],$dia_2_value,$con);    
                                    if($validar==false){    
                                        if($rw['estado']==1){
                                        ?> 
                                        <label class="form-control no-border"><input name="dia_2_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" checked data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>
                                        <?php
                                    }else{
                                     ?> 
                                        <label class="form-control no-border"><input name="dia_2_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>
                                        <?php    
                                    }
                                      }else{
                                        ?>
                                    <label class="form-control no-border"><button type="button" class="btn btn-dark col-md-12"><?php echo $horario_tomado ?></button></h3></label> 
                                        <?php  
                                    }
                                        }
                                    
                                    }else{
                                     for($indice = 1 ; $indice<=25;$indice++){
                                        ?> 
                                        <label class="form-control no-border"><input name="dia_2_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>     
                                        <?php  
                                     }   
                                    }
                                    ?>
                                        
                                </td>
                                
                                <td>
                              
                                        <label class="form-control"><?php echo $dia_3; ?></label>
                                    <?php
                                    $estado = Horario::recuperarHorario($rut_asistente, $dia_3_value, $con);
                                    
                                    if($estado===false){
                                    $count = 0;
                                    }else{
                          
                                    $count = sqlsrv_num_rows($estado);    
                                    }
                                    
                                    if($count>0){
                                    while ($rw = sqlsrv_fetch_array($estado)) {
                                    $validar = Horario::validarHorarioAsistente($rut_asistente,$rw['modulo'],$dia_3_value,$con);
                                    if($validar==false){     
                                        if($rw['estado']==1){
                                        ?> 
                                        <label class="form-control no-border"><input name="dia_3_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" checked data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>
                                        <?php
                                    }else{
                                     ?> 
                                        <label class="form-control no-border"><input name="dia_3_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>
                                        <?php    
                                    }
                                     }else{
                                        ?>
                                         <label class="form-control no-border"><button type="button" class="btn btn-dark col-md-12"><?php echo $horario_tomado ?></button></h3></label>  
                                        <?php  
                                    }
                                        }
                                    
                                    }else{
                                     for($indice = 1 ; $indice<=25;$indice++){
                                        ?> 
                                        <label class="form-control no-border"><input name="dia_3_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>     
                                        <?php  
                                     }   
                                    }
                                    ?>
                                   
                                </td>
                                
                                <td>
                             
                                        <label class="form-control"><?php echo $dia_4; ?></label>
                                    <?php
                                    $estado = Horario::recuperarHorario($rut_asistente, $dia_4_value, $con);
                                    
                                    if($estado===false){
                                    $count = 0;
                                    }else{
                          
                                    $count = sqlsrv_num_rows($estado);    
                                    }
                                    
                                    if($count>0){
                                    while ($rw = sqlsrv_fetch_array($estado)) {
                                    $validar = Horario::validarHorarioAsistente($rut_asistente,$rw['modulo'],$dia_4_value,$con);    
                                    if($validar==false){     
                                        if($rw['estado']==1){
                                        ?> 
                                        <label class="form-control no-border"><input name="dia_4_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" checked data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>
                                        <?php
                                    }else{
                                     ?> 
                                        <label class="form-control no-border"><input name="dia_4_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>
                                        <?php    
                                    }
                                       }else{
                                        ?>
                                         <label class="form-control no-border"><button type="button" class="btn btn-dark col-md-12"><?php echo $horario_tomado ?></button></h3></label>  
                                        <?php  
                                    }

                                        }
                                    
                                    }else{
                                     for($indice = 1 ; $indice<=25;$indice++){
                                        ?> 
                                        <label class="form-control no-border"><input name="dia_4_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>     
                                        <?php  
                                     }   
                                    }
                                    ?>
                                   
                                </td>
                                
                                <td>
                                
                                        <label class="form-control"><?php echo $dia_5; ?></label>
                                    <?php
                                    $estado = Horario::recuperarHorario($rut_asistente, $dia_5_value, $con);
                                    
                                    if($estado===false){
                                    $count = 0;
                                    }else{
                          
                                    $count = sqlsrv_num_rows($estado);    
                                    }
                                    
                                    if($count>0){
                                    while ($rw = sqlsrv_fetch_array($estado)) {
                                    $validar = Horario::validarHorarioAsistente($rut_asistente,$rw['modulo'],$dia_5_value,$con);    
                                    if($validar==false){     
                                        if($rw['estado']==1){
                                        ?> 
                                        <label class="form-control no-border"><input name="dia_5_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" checked data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>
                                        <?php
                                    }else{
                                     ?> 
                                        <label class="form-control no-border"><input name="dia_5_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>
                                        <?php    
                                    }
                                      }else{
                                        ?>
                                         <label class="form-control no-border"><button type="button" class="btn btn-dark col-md-12"><?php echo $horario_tomado ?></button></h3></label>   
                                        <?php  
                                    }
                                        }
                                    
                                    }else{
                                     for($indice = 1 ; $indice<=25;$indice++){
                                        ?> 
                                        <label class="form-control no-border"><input name="dia_5_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>     
                                        <?php  
                                     }   
                                    }
                                    ?>
                                  
                                </td>
                                
                                <td>
                                 
                                        <label class="form-control"><?php echo $dia_6; ?></label>
                                    <?php
                                    $estado = Horario::recuperarHorario($rut_asistente, $dia_6_value, $con);
                                    
                                    if($estado===false){
                                    $count = 0;
                                    }else{
                          
                                    $count = sqlsrv_num_rows($estado);    
                                    }
                                    
                                    if($count>0){
                                    while ($rw = sqlsrv_fetch_array($estado)) {
                                    $validar = Horario::validarHorarioAsistente($rut_asistente,$rw['modulo'],$dia_6_value,$con);    
                                     if($validar==false){      
                                        if($rw['estado']==1){
                                        ?> 
                                        <label class="form-control no-border"><input name="dia_6_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" checked data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>
                                        <?php
                                    }else{
                                     ?> 
                                        <label class="form-control no-border"><input name="dia_6_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>
                                        <?php    
                                    }
                                     }else{
                                        ?>
                                         <label class="form-control no-border"><button type="button" class="btn btn-dark col-md-12"><?php echo $horario_tomado ?></button></h3></label>   
                                        <?php  
                                    }
                                        }
                                    
                                    }else{
                                     for($indice = 1 ; $indice<=25;$indice++){
                                        ?> 
                                        <label class="form-control no-border"><input name="dia_6_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>     
                                        <?php  
                                     }   
                                    }
                                    ?>
                                  
                                </td>
                                
                                <td>
                                
                                    <label class="form-control"><?php echo $dia_7; ?></label>
                                    <?php
                                    $estado = Horario::recuperarHorario($rut_asistente, $dia_7_value, $con);
                                   
                                    if($estado===false){
                                    $count = 0;
                                    }else{
                          
                                    $count = sqlsrv_num_rows($estado);    
                                    }
                                    
                                    if($count>0){
                                    while ($rw = sqlsrv_fetch_array($estado)) {
                                    $validar = Horario::validarHorarioAsistente($rut_asistente,$rw['modulo'],$dia_7_value,$con);    
                                     if($validar==false){      
                                        if($rw['estado']==1){
                                        ?> 
                                        <label class="form-control no-border"><input name="dia_7_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" checked data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success" value="1" ></label>
                                        <?php
                                    }else{
                                     ?> 
                                        <label class="form-control no-border"><input name="dia_7_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1" ></label>
                                        <?php    
                                    }
                                      }else{
                                        ?>
                                         <label class="form-control no-border"><button type="button" class="btn btn-dark col-md-12"><?php echo $horario_tomado ?></button></h3></label> 
                                        <?php  
                                    }
                                        }
                                    
                                    }else{
                                     for($indice = 1 ; $indice<=25;$indice++){
                                        ?> 
                                        <label class="form-control no-border"><input name="dia_7_modulo_<?php echo $rw['modulo']; ?>" type="checkbox" data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label>     
                                        <?php  
                                     }   
                                    }
                                    ?>
                                  
                                </td>
                                
                            </tr>
                        </tbody>
                    </table>

    </div>
            </form>
            </div>
</body>
<footer style="margin-top: 20%">
<?php
include("../footer.php");
?>    
</footer>
<script type="text/javascript" src="../js/funciones/horario.js"></script> 

</html>
