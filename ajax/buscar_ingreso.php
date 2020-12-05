<?php
/* -------------------------
  carga en loader de stock.php
  --------------------------- */
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database */
require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
include '../Clases/Ingreso.php';
include '../Clases/Integrante.php';
include '../Clases/Solicitud.php';
//Archivo de funciones PHP



$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if (isset($_GET['id'])) {
    $rut_integrante = strval($_GET['id']);

    if ($delete = Ingreso::eliminarIngreso($rut_integrante,$con)) {
        ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Aviso!</strong> Ingreso eliminado exitosamente.
        </div>
        <?php
    } else {
        ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
        </div>
        <?php
    }
}
if ($action == 'ajax') {

    $rut_estudiante = strval($_GET['rut_estudiante']);

    $result_ingreso = Ingreso::recuperarIngreso("",$rut_estudiante, $con, "","","");

    $numrows = sqlsrv_num_rows($result_ingreso);
    
    $total = 0;
    while ($row = sqlsrv_fetch_array($result_ingreso)) {
    if ($numrows > 0) {
         if($row!=null){
            $sueldo         = $row['sueldo_integrante'];
            $pension        = $row['pension_integrante'];
            $honorario      = $row['honorario_integrante'];
            $retiro         = $row['retiro_integrante'];
            $dividendo      = $row['dividendo_integrante'];
            $interes        = $row['interes_integrante'];
            $ganancia       = $row['ganancia_integrante'];
            $pension_alim   = $row['pension_alim_integrante'];
            $actividad      = $row['actividad_integrante'];         
            }else{
            $sueldo         = 0;
            $pension        = 0;
            $honorario      = 0;
            $retiro         = 0;
            $dividendo      = 0;
            $interes        = 0;
            $ganancia       = 0;
            $pension_alim   = 0;
            $actividad      = 0;
            }
            $total      = $sueldo+$pension+$honorario+$retiro+$dividendo+$interes+$ganancia+$pension_alim+$actividad;
    }
}

    $percap = $total/($numrows-1);
    
    echo $total;
}
if ($action == 'ajax_2') {

    $rut_estudiante = strval($_SESSION['rut_estudiante']);
    
    
    
   $rut = $_SESSION['rut_estudiante'];
$condicion = "";

$solicitud = Solicitud::recuperarSolicitud($rut,$condicion,$con);
$solicitudArreglo;
while ($solicitudCursor = sqlsrv_fetch_array($solicitud)) {
    $solicitudArreglo = array(
        "estado"           => $solicitudCursor['estado'],

    );
}

$validar=$solicitudArreglo['estado'];

    $result = Integrante::recuperarIntegrante($rut_estudiante,"",$con,"","","");

    $numrows = sqlsrv_num_rows($result);


    
    
    if ($validar > 0) {
    ?>    
    <script type="text/javascript">
        $('input').attr('readonly', true)   
    </script> 
    <?php
}

    if ($numrows > 0) {
        ?>

        <div class="table-responsive">
            <table class="table">
                <tr  class="success">          
                    <th class="col-sm-2">Rut</th>
               <!--     <th>Nombre</th>
                    <th>Apellido</th>  -->
                    <th>Sueldos</th>
                    <th>Pensiones</th>
                    <th>Honorarios</th>
                    <th>Retiros</th>
                    <th>Dividendo por acciones</th>
                    <th>Intereses de capitales moviliarios</th>
                    <th>Ganancias de capitales moviliarios</th>
                    <th>Pension Alimenticia y otros aportes de parientes</th>
                    <th>Actividades independientes</th>
                    <th>Total</th>
                </tr>
        <?php
        $rut_estudiante = $_SESSION['rut_estudiante'];
        $id_dinamico=0;
        while ($row = sqlsrv_fetch_array($result)) {
            $rut_integrante = $row['rut_integrante'];
            $nombre_integrante = $row['nombre_integrante'];
            $apellido_integrante = $row['apellido_integrante']; 
            $result_ingreso = Ingreso::recuperarIngreso($rut_integrante,$rut_estudiante, $con, "", "","");
            $row = sqlsrv_fetch_array($result_ingreso);
            
            if($row!=null){
            $sueldo         = $row['sueldo_integrante'];
            $pension        = $row['pension_integrante'];
            $honorario      = $row['honorario_integrante'];
            $retiro         = $row['retiro_integrante'];
            $dividendo      = $row['dividendo_integrante'];
            $interes        = $row['interes_integrante'];
            $ganancia       = $row['ganancia_integrante'];
            $pension_alim   = $row['pension_alim_integrante'];
            $actividad      = $row['actividad_integrante'];         
            }else{
            $sueldo         = 0;
            $pension        = 0;
            $honorario      = 0;
            $retiro         = 0;
            $dividendo      = 0;
            $interes        = 0;
            $ganancia       = 0;
            $pension_alim   = 0;
            $actividad      = 0;
            }
            $total      = $sueldo+$pension+$honorario+$retiro+$dividendo+$interes+$ganancia+$pension_alim+$actividad;
            ?>

                    <tr>          
                        <td class="col-sm-2"><?php echo $rut_integrante; ?><input type="hidden" class="form-control" name="rut_integrantes[]" value="<?php echo $rut_integrante; ?>" readonly required></td>
                        <input type="hidden" class="form-control" name="nombre_integrantes[]" value="<?php echo $nombre_integrante; ?>" readonly required>
                        <input type="hidden" class="form-control" name="apellido_integrantes[]" value="<?php echo $apellido_integrante; ?>" readonly required>  
                        <td><input onkeyup="separadorMiles(this)" class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_sueldo"     name="sueldo_integrante[]"        type="text" required value="<?php echo $sueldo; ?>"       ></td>
                        <td><input onkeyup="separadorMiles(this)" class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_pensionl"   name="pension_integrante[]"       type="text" required value="<?php echo $pension; ?>"      ></td>
                        <td><input onkeyup="separadorMiles(this)" class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_honorario"  name="honorario_integrante[]"     type="text" required value="<?php echo $honorario; ?>"    ></td>
                        <td><input onkeyup="separadorMiles(this)" class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_retiro"     name="retiro_integrante[]"        type="text" required value="<?php echo $retiro; ?>"       ></td>
                        <td><input onkeyup="separadorMiles(this)" class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_dividendol" name="dividendo_integrante[]"     type="text" required value="<?php echo $dividendo; ?>"    ></td>
                        <td><input onkeyup="separadorMiles(this)" class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_interes"    name="interes_integrante[]"       type="text" required value="<?php echo $interes; ?>"      ></td>
                        <td><input onkeyup="separadorMiles(this)" class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_ganancia"   name="ganancia_integrante[]"      type="text" required value="<?php echo $ganancia; ?>"     ></td>
                        <td><input onkeyup="separadorMiles(this)" class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_pension"    name="pension_alim_integrante[]"  type="text" required value="<?php echo $pension_alim; ?>" ></td>
                        <td><input onkeyup="separadorMiles(this)" class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_actividad"  name="actividad_integrante[]"     type="text" required value="<?php echo $actividad; ?>"    ></td>
                        <td><input onkeyup="separadorMiles(this)" class="form-control total" id="ingreso_total<?php echo $id_dinamico; ?>" name="ingreso_total[]" required  readonly  value="<?php echo $total; ?>" type="text"></td>
                    </tr>       
            <script type="text/javascript" src="js/extras/Suma.js"></script>        
            <script type="text/javascript">  
    
            </script>
            <?php
            $id_dinamico++;
        }
        ?>
            </table>
        </div>
        
        <div class='row text-center'>
            <div ><?php
        //        echo paginate($reload, $page, $total_pages, $adjacents);
                ?></div>
            
        </div>
           
        <?php
    }
}
?>
