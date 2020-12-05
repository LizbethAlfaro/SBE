<?php
include('is_logged_admin.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado

/* Connect To Database */
require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

include '../Clases/ModuloHorario.php';
include '../Clases/Horario.php';
include '../Clases/Asistente.php';




$ruta_raiz = "/BecasBeneficios/";
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if ($action == 'ajax') {

    $disponiblidad = "No Disponible";
    $fecha_actual = $_POST['fecha_actual'];
    $fecha_titulo = substr($fecha_actual, 0, 10);

    $rut_estudiante     = $_POST['rut_estudiante'];
    $modulo_sel         = $_POST['modulo_sel'];
    $fecha_sel          = $_POST['fecha_sel'];
    
    $nombre_estudiante  = $_POST['nombre_estudiante'];
    $mail_estudiante    = $_POST['mail_estudiante'];
    $nombre_asistente   = $_POST['nombre_asistente'];
    
//Fecha Atencion
    $horarioQuery = Horario::verificarEstudianteCita($rut_estudiante, $con);
   

    if($horarioQuery){
        
    $horarioArreglo;
    while ($horarioCursor = sqlsrv_fetch_array($horarioQuery)) {
        $horarioArreglo = array(
            "fecha"     => $horarioCursor['fecha'],
            "horario"   => $horarioCursor['horario'],
            "modulo"    => $horarioCursor['id_modulo']
        );
    }
    
    $contador= sqlsrv_num_rows($horarioQuery);
    if($contador>0){
    $modulo_registrado = $horarioArreglo['modulo'];
    $fecha_registrada  = $horarioArreglo['fecha'];  
    $hora_registrada   = $horarioArreglo['horario'];
    }else{
    $modulo_registrado = "";
    $fecha_registrada  = $fecha_actual;  
    $hora_registrada   = "hh:mm"; 
    }
    
    }else{
    $modulo_registrado = "";
    $fecha_registrada  = $fecha_actual;  
    $hora_registrada   = "hh:mm";    
    }
    
    

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


    $verificar = Horario::verificarEstudianteCita($rut_estudiante, $con);
    $count_verificar = sqlsrv_num_rows($verificar);
    $count_verificar == 0;
    ?>
 <div class="form-group">   

                            <div class="">
                                <label>Cita</label>   
                                <input id="cita" class="form-control text-center" type="text" value="<?php echo Horario::fechaCastellano($fecha_registrada) . " - Hora " . $hora_registrada; ?>" readonly>
                            </div>                          
  </div>  
    


    <form id="seleccionar_horario" action="ajax/nueva_cita.php">

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
                            <h2><?php echo Horario::fechaAnhioMesCastellano(date("Y-m", strtotime($fecha_titulo))); ?></h2>     
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
                            for ($modulo = 1; $modulo <= 25; $modulo++) {

                                $estado = Horario::recuperarModuloDisponible($modulo, $dia_1_value, $con);

                                if ($estado === false) {

                                    for ($indice = 1; $indice <= 25; $indice++) {
                                        ?> 
                                        <label class="form-control no-border"><button type="button" class="btn btn-default"><?php echo $disponiblidad; ?></button></label>
                                        <?php
                                    }
                                    break;
                                }

                                $count = sqlsrv_num_rows($estado);

                                if ($count > 0) {
                                    if($modulo == $modulo_registrado && $dia_1_value == $fecha_registrada){
                                    ?> 
                                        <label class="form-control no-border"><a class="btn btn-danger">Reservado</a></label>
                                        <?php    
                                    }else{
                                        ?> 
                                        <label class="form-control no-border"><a id="a_<?php echo $dia_1_value; ?>_<?php echo $modulo; ?>" onclick="reagendarEstadoSeleccionar(this.id,'<?php echo $rut_estudiante; ?>','<?php echo $modulo; ?>','<?php echo $dia_1_value; ?>','<?php echo $nombre_estudiante; ?>','<?php echo $mail_estudiante; ?>','<?php echo $nombre_asistente; ?>')" class="btn btn-success seleccion">Disponible</a></label>
                                        <?php
                                    }
                                } else {
                                    if($modulo == $modulo_registrado && $dia_1_value == $fecha_registrada){
                                    ?> 
                                       <label class="form-control no-border"><a class="btn btn-danger">Reservado</a></label>
                                        <?php    
                                    } 
                                    else {
                                    
                                    ?> 
                                        <label class="form-control no-border"><button type="button" class="btn btn-default"><?php echo $disponiblidad; ?></button></label>
                                    <?php
                                }
                                
                                    }
                            }
                            ?>  

                        </td>
              
                        <td>

                            <label class="form-control"><?php echo $dia_2; ?></label>
                            <?php
                            for ($modulo = 1; $modulo <= 25; $modulo++) {

                                $estado = Horario::recuperarModuloDisponible($modulo, $dia_2_value, $con);

                                if ($estado === false) {

                                    for ($indice = 1; $indice <= 25; $indice++) {
                                        ?> 
                                        <label class="form-control no-border"><button type="button" class="btn btn-default"><?php echo $disponiblidad; ?></button></label>
                                        <?php
                                    }
                                    break;
                                }

                                $count = sqlsrv_num_rows($estado);

                                 if ($count > 0) {
                                    if($modulo == $modulo_registrado && $dia_2_value == $fecha_registrada){
                                    ?> 
                                        <label class="form-control no-border"><a class="btn btn-danger">Reservado</a></label>
                                        <?php    
                                    }else{
                                        ?> 
                                        <label class="form-control no-border"><a id="a_<?php echo $dia_2_value; ?>_<?php echo $modulo; ?>" onclick="reagendarEstadoSeleccionar(this.id,'<?php echo $rut_estudiante; ?>','<?php echo $modulo; ?>','<?php echo $dia_2_value; ?>','<?php echo $nombre_estudiante; ?>','<?php echo $mail_estudiante; ?>','<?php echo $nombre_asistente; ?>')" class="btn btn-success seleccion">Disponible</a></label>
                                        <?php
                                    }
                                } else {
                                    if($modulo == $modulo_registrado && $dia_2_value == $fecha_registrada){
                                    ?> 
                                        <label class="form-control no-border"><a class="btn btn-danger">Reservado</a></label>
                                        <?php    
                                    } 
                                    else {
                                    
                                    ?> 
                                        <label class="form-control no-border"><button type="button" class="btn btn-default"><?php echo $disponiblidad; ?></button></label>
                                    <?php
                                }
                                
                                    }
                                
                                    
                            }
                            ?>  
                        </td>

                        <td>

                            <label class="form-control"><?php echo $dia_3; ?></label>
                            <?php
                            for ($modulo = 1; $modulo <= 25; $modulo++) {

                                $estado = Horario::recuperarModuloDisponible($modulo, $dia_3_value, $con);

                                if ($estado === false) {

                                    for ($indice = 1; $indice <= 25; $indice++) {
                                        ?> 
                                        <label class="form-control no-border"><button type="button" class="btn btn-default"><?php echo $disponiblidad; ?></button></label>
                                        <?php
                                    }
                                    break;
                                }

                                $count = sqlsrv_num_rows($estado);

                                 if ($count > 0) {
                                    if($modulo == $modulo_registrado && $dia_3_value == $fecha_registrada){
                                    ?> 
                                        <label class="form-control no-border"><a class="btn btn-danger">Reservado</a></label>
                                        <?php    
                                    }else{
                                        ?> 
                                        <label class="form-control no-border"><a id="a_<?php echo $dia_3_value; ?>_<?php echo $modulo; ?>" onclick="reagendarEstadoSeleccionar(this.id,'<?php echo $rut_estudiante; ?>','<?php echo $modulo; ?>','<?php echo $dia_3_value; ?>','<?php echo $nombre_estudiante; ?>','<?php echo $mail_estudiante; ?>','<?php echo $nombre_asistente; ?>')" class="btn btn-success seleccion">Disponible</a></label>
                                        <?php
                                    }
                                } else {
                                    if($modulo == $modulo_registrado && $dia_3_value == $fecha_registrada){
                                    ?> 
                                        <label class="form-control no-border"><a class="btn btn-danger">Reservado</a></label>
                                        <?php    
                                    } 
                                    else {
                                    
                                    ?> 
                                        <label class="form-control no-border"><button type="button" class="btn btn-default"><?php echo $disponiblidad; ?></button></label>
                                    <?php
                                }
                                
                                    }
                                
                                    
                            }
                            ?>  
                        </td>

                        <td>

                            <label class="form-control"><?php echo $dia_4; ?></label>
    <?php
    for ($modulo = 1; $modulo <= 25; $modulo++) {

        $estado = Horario::recuperarModuloDisponible($modulo, $dia_4_value, $con);

        if ($estado === false) {

            for ($indice = 1; $indice <= 25; $indice++) {
                ?> 
                                        <label class="form-control no-border"><button type="button" class="btn btn-default"><?php echo $disponiblidad; ?></button></label>
                                        <?php
                                    }
                                    break;
                                }

                                $count = sqlsrv_num_rows($estado);

                               if ($count > 0) {
                                    if($modulo == $modulo_registrado && $dia_4_value == $fecha_registrada){
                                    ?> 
                                        <label class="form-control no-border"><a class="btn btn-danger">Reservado</a></label>
                                        <?php    
                                    }else{
                                        ?> 
                                        <label class="form-control no-border"><a id="a_<?php echo $dia_4_value; ?>_<?php echo $modulo; ?>" onclick="reagendarEstadoSeleccionar(this.id,'<?php echo $rut_estudiante; ?>','<?php echo $modulo; ?>','<?php echo $dia_4_value; ?>','<?php echo $nombre_estudiante; ?>','<?php echo $mail_estudiante; ?>','<?php echo $nombre_asistente; ?>')" class="btn btn-success seleccion">Disponible</a></label>
                                        <?php
                                    }
                                } else {
                                    if($modulo == $modulo_registrado && $dia_4_value == $fecha_registrada){
                                    ?> 
                                       <label class="form-control no-border"><a class="btn btn-danger">Reservado</a></label>
                                        <?php    
                                    } 
                                    else {
                                    
                                    ?> 
                                        <label class="form-control no-border"><button type="button" class="btn btn-default"><?php echo $disponiblidad; ?></button></label>
                                    <?php
                                }
                                
                                    
                                
                                    }
                            }
                            ?>  
                        </td>

                        <td>

                            <label class="form-control"><?php echo $dia_5; ?></label>
    <?php
    for ($modulo = 1; $modulo <= 25; $modulo++) {

        $estado = Horario::recuperarModuloDisponible($modulo, $dia_5_value, $con);

        if ($estado === false) {

            for ($indice = 1; $indice <= 25; $indice++) {
                ?> 
                                        <label class="form-control no-border"><button type="button" class="btn btn-default"><?php echo $disponiblidad; ?></button></label>
                                        <?php
                                    }
                                    break;
                                }

                                $count = sqlsrv_num_rows($estado);

                                 if ($count > 0) {
                                    if($modulo == $modulo_registrado && $dia_5_value == $fecha_registrada){
                                    ?> 
                                        <label class="form-control no-border"><a class="btn btn-danger">Reservado</a></label>
                                        <?php    
                                    }else{
                                        ?> 
                                        <label class="form-control no-border"><a id="a_<?php echo $dia_5_value; ?>_<?php echo $modulo; ?>" onclick="reagendarEstadoSeleccionar(this.id,'<?php echo $rut_estudiante; ?>','<?php echo $modulo; ?>','<?php echo $dia_5_value; ?>','<?php echo $nombre_estudiante; ?>','<?php echo $mail_estudiante; ?>','<?php echo $nombre_asistente; ?>')" class="btn btn-success seleccion">Disponible</a></label>
                                        <?php
                                    }
                                } else {
                                    if($modulo == $modulo_registrado && $dia_5_value == $fecha_registrada){
                                    ?> 
                                        <label class="form-control no-border"><a class="btn btn-danger">Reservado</a></label>
                                        <?php    
                                    } 
                                    else {
                                    
                                    ?> 
                                        <label class="form-control no-border"><button type="button" class="btn btn-default"><?php echo $disponiblidad; ?></button></label>
                                    <?php
                                }
                                
                                    }
                                
                                    
                            }
                            ?>  
                        </td>

                        <td>

                            <label class="form-control"><?php echo $dia_6; ?></label>
    <?php
    for ($modulo = 1; $modulo <= 25; $modulo++) {

        $estado = Horario::recuperarModuloDisponible($modulo, $dia_6_value, $con);

        if ($estado === false) {

            for ($indice = 1; $indice <= 25; $indice++) {
                ?> 
                                        <label class="form-control no-border"><button type="button" class="btn btn-default"><?php echo $disponiblidad; ?></button></label>
                                        <?php
                                    }
                                    break;
                                }

                                $count = sqlsrv_num_rows($estado);

                                if ($count > 0) {
                                    if($modulo == $modulo_registrado && $dia_6_value == $fecha_registrada){
                                    ?> 
                                        <label class="form-control no-border"><a class="btn btn-danger">Reservado</a></label>
                                        <?php    
                                    }else{
                                        ?> 
                                        <label class="form-control no-border"><a id="a_<?php echo $dia_6_value; ?>_<?php echo $modulo; ?>" onclick="reagendarEstadoSeleccionar(this.id,'<?php echo $rut_estudiante; ?>','<?php echo $modulo; ?>','<?php echo $dia_6_value; ?>','<?php echo $nombre_estudiante; ?>','<?php echo $mail_estudiante; ?>','<?php echo $nombre_asistente; ?>')" class="btn btn-success seleccion">Disponible</a></label>
                                        <?php
                                    }
                                } else {
                                    if($modulo == $modulo_registrado && $dia_6_value == $fecha_registrada){
                                    ?> 
                                       <label class="form-control no-border"><a class="btn btn-danger">Reservado</a></label>
                                        <?php    
                                    } 
                                    else {
                                    
                                    ?> 
                                        <label class="form-control no-border"><button type="button" class="btn btn-default"><?php echo $disponiblidad; ?></button></label>
                                    <?php
                                }
                                
                                    
                                
                                    }
                            }
                            ?>  
                        </td>

                        <td>

                            <label class="form-control"><?php echo $dia_7; ?></label>
    <?php
    for ($modulo = 1; $modulo <= 25; $modulo++) {

        $estado = Horario::recuperarModuloDisponible($modulo, $dia_7_value, $con);

        if ($estado === false) {

            for ($indice = 1; $indice <= 25; $indice++) {
                ?> 
                                        <label class="form-control no-border"><button type="button" class="btn btn-default"><?php echo $disponiblidad; ?></button></label>
                                        <?php
                                    }
                                    break;
                                }

                                $count = sqlsrv_num_rows($estado);

                                  if ($count > 0) {
                                    if($modulo == $modulo_registrado && $dia_7_value == $fecha_registrada){
                                    ?> 
                                        <label class="form-control no-border"><a class="btn btn-danger">Reservado</a></label>
                                        <?php    
                                    }else{
                                        ?> 
                                        <label class="form-control no-border"><a id="a_<?php echo $dia_7_value; ?>_<?php echo $modulo; ?>" onclick="reagendarEstadoSeleccionar(this.id,'<?php echo $rut_estudiante; ?>','<?php echo $modulo; ?>','<?php echo $dia_7_value; ?>','<?php echo $nombre_estudiante; ?>','<?php echo $mail_estudiante; ?>','<?php echo $nombre_asistente; ?>')" class="btn btn-success seleccion">Disponible</a></label>
                                        <?php
                                    }
                                } else {
                                    if($modulo == $modulo_registrado && $dia_7_value == $fecha_registrada){
                                    ?> 
                                        <label class="form-control no-border"><a class="btn btn-danger">Reservado</a></label>
                                        <?php    
                                    } 
                                    else {
                                    
                                    ?> 
                                        <label class="form-control no-border"><button type="button" class="btn btn-default"><?php echo $disponiblidad; ?></button></label>
                                    <?php
                                }
                                
                                    }
                            }
                            ?>  
                        </td>

                    </tr>
                </tbody>
            </table>

        </div>
    </form>
    <?php
}
?>        
