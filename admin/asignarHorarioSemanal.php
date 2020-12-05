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
$dia_2_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 1 days")), 0, 10);
;
$dia_3_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 2 days")), 0, 10);
;
$dia_4_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 3 days")), 0, 10);
;
$dia_5_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 4 days")), 0, 10);
;
$dia_6_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 5 days")), 0, 10);
;
$dia_7_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 6 days")), 0, 10);
;


$active_asignar_horario = "active";
$title = " Horario Semanal  | UGM";
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
            <div class="panel panel-success">
                <div class="panel-body">
                    <h1 style="text-align: center">Asignar Horarios Semanales</h1>  
                </div>


                <div class="panel-heading">

                    <div class="btn-group pull-right">



                    </div>

                </div>

                <div class="panel-body">
                    <div id="resultados_ajax_guardar_horario" ></div>

                    <form id="semana_fecha" action="asignarHorarioSemanal.php" method="POST">

                        <div class="col-sm-3">
                            <label>Seleccione Fecha </label>        

                            <input class="form-control" type="date" id="calendario" name="fecha" value="<?php echo $fecha_actual; ?>"> 

                        </div>

                        <div class="col-sm-3">
                            <label>Seleccione Asistente Social</label>
                            <select class='form-control' name='asistente' id='asistente' required onchange="submit()" >
                                <option value="">Asistente Social</option>
                                <?php
                                // 1 para ver solo asistentes 
                                $condicion = "AND rut_asistente != '00.000.000-0'"; 
                                $asistente_social = Asistente::recuperarAsistente("", $condicion, "1", $con);

                                while ($rw = sqlsrv_fetch_array($asistente_social)) {
                                    ?>
                                    <option value="<?php echo $rw['rut_asistente'] . " - " . $rw['nombre_asistente'] . " - " . $rw['apellido_asistente']; ?>"><?php echo $rw['rut_asistente'] . " - " . $rw['nombre_asistente'] . " - " . $rw['apellido_asistente']; ?></option>			
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

            <form id="guardar_horario">
            <input class="form-control" type="hidden" id="rut_asistente" name="rut_asistente" value="<?php echo $rut_asistente; ?>" readonly>
                <div class="col-sm-12">
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="form-group row">

                                <div class="col-sm-12">
                                    <div class="form-group table-responsive">

                                        <table border="0" class="table">
                                            <thead>
                                                <tr>
                                                    <td colspan="8">
                                                        <h2><?php echo Horario::fechaAnhioMesCastellano(date("Y-m", strtotime($fecha_titulo))); ?></h2>     
                                                    </td>
                                                <tr>

                                                <tr>
                                                    <th colspan="7" class="text-center">
                                                        <input id="guardar_datos" type="submit" class="btn btn-primary btn-lg btn-block">
                                                    </th>
                                                </tr>
                                                <tr id="days-list">
                                                    <th>
                                                        <span class="button-checkbox input-group-btn">
                                                            <input class="hidden" type="checkbox" name="dia[]" value="<?php echo $dia_1_value; ?>">
                                                            <button type="button" class="btn" data-color="primary"><?php echo $dia_1; ?></button>
                                                        </span>              
                                                    </th>
                                                    <th>
                                                        <span class="button-checkbox input-group-btn">
                                                            <input class="hidden" type="checkbox" name="dia[]" value="<?php echo $dia_2_value; ?>">
                                                            <button type="button" class="btn" data-color="primary"><?php echo $dia_2; ?></button>
                                                        </span>              
                                                    </th>
                                                    <th>
                                                        <span class="button-checkbox input-group-btn">
                                                            <input class="hidden" type="checkbox" name="dia[]" value="<?php echo $dia_3_value; ?>">
                                                            <button type="button" class="btn" data-color="primary"><?php echo $dia_3; ?></button>
                                                        </span>              
                                                    </th>
                                                    <th>
                                                        <span class="button-checkbox input-group-btn">
                                                            <input class="hidden" type="checkbox" name="dia[]" value="<?php echo $dia_4_value; ?>">
                                                            <button type="button" class="btn" data-color="primary"><?php echo $dia_4; ?></button>
                                                        </span>              
                                                    </th>
                                                    <th>
                                                        <span class="button-checkbox input-group-btn">
                                                            <input class="hidden" type="checkbox" name="dia[]" value="<?php echo $dia_5_value; ?>">
                                                            <button type="button" class="btn" data-color="primary"><?php echo $dia_5; ?></button>
                                                        </span>              
                                                    </th>
                                                    <th>
                                                        <span class="button-checkbox input-group-btn">
                                                            <input class="hidden" type="checkbox" name="dia[]" value="<?php echo $dia_6_value; ?>">
                                                            <button type="button" class="btn" data-color="primary"><?php echo $dia_6; ?></button>
                                                        </span>              
                                                    </th>
                                                    <th>
                                                        <span class="button-checkbox input-group-btn">
                                                            <input class="hidden" type="checkbox" name="dia[]" value="<?php echo $dia_7_value; ?>">
                                                            <button type="button" class="btn" data-color="primary"><?php echo $dia_7; ?></button>
                                                        </span>              
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>



                                        <table border="0" class="table">

                                            <thead>
                                                <tr>
                                                    <th class="text-center" ><label>Horario</label></th>
                                                    <th class="text-center" ><input id="todo" class="form-control" type="checkbox" onchange="seleccionarTodo()"></th>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
$modulo = ModuloHorario::recuperarModulo($con);

while ($rw = sqlsrv_fetch_array($modulo)) {
    ?>

                                                    <tr>
                                                        <td class="text-center"><?php echo $rw['horario']; ?></td>
                                                        <td class="text-center"><label><input class="modulos" name="modulo_estado_<?php echo $rw['id_modulo']; ?>" type="checkbox" data-toggle="toggle" data-on="Asignado" data-off="Libre" data-onstyle="danger" data-offstyle="success"   value="1"></label></td>
                                                    </tr>
    <?php
}
?>   


                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
            </form>

        </div>

    </div>
<?php
include("../footer.php");
?>
</body>

<script type="text/javascript" src="../js/funciones/horario.js"></script> 
 <script type="text/javascript" src="../js/extras/checkbox.js"></script>
 <script type="text/javascript" src="../js/horarioSemanal_page.js"></script>
</html>
