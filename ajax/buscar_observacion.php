<?php
//include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database */
require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

include '../Clases/Scape.php';
include '../Clases/Estudiante.php';
include '../Clases/Observacion.php';

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if ($action == 'ajax') {

    $rut = $_REQUEST['rut'];




//UMAS
    include '../Clases/UMAS.php';
    include '../Autenticacion/FormatoRut.php';

    $rut_2 = sinPuntosGuionRut($rut);
    $condicion = ""; //where...

    $estudianteQuery = Estudiante::recuperarEstudiante($rut, $con, $condicion, "", "");

    if ($estudianteQuery) {
        $contador_estudiante = sqlsrv_num_rows($estudianteQuery);
    } else {
        $contador_estudiante = 0;
    }

    if ($contador_estudiante > 0) {



        $estudianteArreglo;
        while ($estudianteCursor = sqlsrv_fetch_array($estudianteQuery)) {
            $estudianteArreglo = array(
                "rut" => $estudianteCursor['rut_estudiante'],
                "nombre" => $estudianteCursor['nombre_estudiante'],
                "apellido" => $estudianteCursor['apellido_estudiante'],
            );
        }


        $notaQuery = UMAS::NOTAS_ANUALES($rut_2, $con);
        $notaArreglo;
        if ($notaQuery) {
            $contador_nota = sqlsrv_num_rows($notaQuery);
        } else {
            $contador_nota = 0;
        }
        if ($contador_nota > 0) {
            while ($notaCursor = sqlsrv_fetch_array($notaQuery)) {
                $notaArreglo = array(
                    "rut" => $notaCursor['CODCLI'],
                    "promedio" => $notaCursor['PROMEDIO_AP'],
                );
            }
        } else {
            $notaArreglo = array(
                "rut" => 0,
                "promedio" => 0,
            );
        }
        
        //NEM
         $nemQuery = UMAS::NEM($rut_2, $con);

        if ($nemQuery) {
            $contador_nem = sqlsrv_num_rows($nemQuery);
        } else {
            $contador_nem = 0;
        }
        
        $nemArreglo = array(
                    "nem" => "",
                );
        
        if ($contador_nem > 0) {
            while ($nemCursor = sqlsrv_fetch_array($nemQuery)) {
                $nemArreglo = array(
                    "nem" => $nemCursor['NOTAEM'],
                );
            }
        }
        
        if($nemArreglo['nem']!=""){
        $NEM = $nemArreglo['nem'];
        }else{
        $NEM = "0";    
        }
//INSCRITAS

        $inscritasQuery = UMAS::ASIGNATURAS_INSCRITAS($rut_2, $con);

        if ($inscritasQuery) {
            $contador_inscritas = sqlsrv_num_rows($inscritasQuery);
        } else {
            $contador_inscritas = 0;
        }

        $inscritasArreglo;
        if ($contador_inscritas > 0) {
            while ($inscritasCursor = sqlsrv_fetch_array($inscritasQuery)) {
                $inscritasArreglo = array(
                    "inscritas" => $inscritasCursor['ASIGNATURAS_INSCRITAS'],
                );
            }
        } else {
            $inscritasArreglo = array(
                "inscritas" => 0,
            );
        }



        $aprobadaQuery = UMAS::ASIGNATURAS_APROBADAS($rut_2, $con);

        if ($aprobadaQuery) {
            $contador_aprobadas = sqlsrv_num_rows($aprobadaQuery);
        } else {
            $contador_aprobadas = 0;
        }
        $aprobadaArreglo;
        if ($contador_aprobadas > 0) {
            while ($aprobadaCursor = sqlsrv_fetch_array($aprobadaQuery)) {
                $aprobadaArreglo = array(
                    "aprobadas" => $aprobadaCursor['ASIGNATURAS_APROBADAS'],
                );
            }
        } else {

            $aprobadaArreglo = array(
                "aprobadas" => 0,
            );
        }



//se incluye en AA ?
        $promedioQuery = UMAS::PROMEDIO_ANUAL($rut_2, $con);
        $promedioArreglo;
        while ($promedioCursor = sqlsrv_fetch_array($promedioQuery)) {
            $promedioArreglo = array(
                "promedio" => $promedioCursor['PROMEDIO_AP'],
            );
        }

        $estadoAcadQuery = UMAS::ESTADO_ACADEMICO($rut_2, $con);
           $estadoAcadArreglo = array(
                "estado_academico" => "",
                "estado_financiero" => ""
            );   
        
        if($estadoAcadQuery){
        while ($estadoAcadCursor = sqlsrv_fetch_array($estadoAcadQuery)) {
            $estadoAcadArreglo = array(
                "estado_academico" => $estadoAcadCursor['ESTACAD'],
                "estado_financiero" => $estadoAcadCursor['ESTFINAN'],
            );
        }
        }
        /* APROBADAS*100/INSCRITAS */
//items de informe
        $NA = $notaArreglo['promedio'];

        if ($inscritasArreglo['inscritas'] > 0) {
            $AA = round(($aprobadaArreglo['aprobadas'] * 100) / $inscritasArreglo['inscritas']);
        } else {
            $AA = "sin inscripcion";
        }

        $E4 = $estadoAcadArreglo['estado_academico'];

        $AR = $estadoAcadArreglo['estado_academico'];


//FINANCIERA
        $finanzaQuery = UMAS::SITUACION_FINANCIERA($rut_2, $con);

        if ($finanzaQuery) {
            $contador_finanza = sqlsrv_num_rows($finanzaQuery);
        } else {
            $contador_finanza = 0;
        }


        if ($contador_finanza > 0) {
            $SF = "DEUDA";
        } else {
            $SF = "AL DIA";
        }
        
  //observacion 
  include '../Clases/Formulario.php';
  
        $observacionQuery = Observacion::recuperarObservacion($rut,$condicion,$con);

     $observacionArreglo = array(
                "observacion" => ""
            );
        if ($observacionQuery) {
            while ($observacionCursor = sqlsrv_fetch_array($observacionQuery)) {
                $observacionArreglo = array(
                    "observacion"   => $observacionCursor['observacion'],
                    "duplicidad"    => $observacionCursor['duplicidad'],
                    "otro_miembro"  => $observacionCursor['otro_miembro'],
                    "factor"        => $observacionCursor['factor'],
                    "tramo"         => $observacionCursor['tramo'],
                    "distancia"     => $observacionCursor['distancia']        
                );
            }
        } 
           
        

        ?>
        <div class="table-responsive">
            <table class="table" border='0'>
                <tr  class="success">
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>NEM</th>
                    <th>NA</th>
                    <th>AR</th>
                    <th>A APROV</th>
                    <th>A INSCR</th>
                    <th>AA</th>
                    <th>SF</th>	
                </tr>
                <tr>

                    <td><?php echo $estudianteArreglo['rut']; ?><input id="rut_observacion" type="hidden" value="<?php echo $estudianteArreglo['rut']; ?>"></td>
                    <td><?php echo $estudianteArreglo['nombre']; ?></td>
                    <td><?php echo $estudianteArreglo['apellido']; ?></td>
                    <td><?php echo $NEM ?></td>
                    <td><?php echo $NA ?></td>
                    <td><?php echo $AR ?></td>
                    <td><?php echo intval($aprobadaArreglo['aprobadas']); ?></td>
                    <td><?php echo intval($inscritasArreglo['inscritas']); ?></td>
                    <td><?php echo $AA ?></td>
                    <td><?php echo $SF ?></td>
                </tr>
                <tr>
                    <td colspan="10">

<textarea type="text" class="form-control" id="observacion" name="observacion" placeholder="Observacion" required style="width: 100%; height: 200px;"><?php echo $observacionArreglo['observacion']; ?></textarea>
</td>    
                </tr>
                <tr>
                    <td colspan="2">
                        <select id="duplicidad" class="form-control">
                            <option value="">Duplicidad de Funciones</option>
                           <?php
                                    $duplicidad = Observacion::recuperarDuplicidad($con);

                                    while ($rw = sqlsrv_fetch_array($duplicidad)) {
                                        ?>
                            <option value="<?php echo $rw['id_duplicidad']; ?>"><?php echo Scape::ms_escape_string($rw['descripcion_duplicidad']); ?></option>			
                                        <?php
                                    }
                            ?>
                        </select>    
                    </td>
                    <td colspan="2">
                        <select id="otro_miembro" class="form-control">
                            <option value="">Integrantes estudiando</option>
                            <?php
                                    $otro = Observacion::recuperarOtro($con);

                                    while ($rw = sqlsrv_fetch_array($otro)) {
                                        ?>
                            <option value="<?php echo $rw['id_otro_miembro']; ?>"><?php echo Scape::ms_escape_string($rw['descripcion_otro_miembro']); ?></option>			
                                        <?php
                                    }
                            ?>
                        </select>    
                    </td>
                    <td colspan="2">
                        <select id="factor" class="form-control">
                            <option value="">Factores de Riesgo</option>
                             <?php
                                    $factor = Observacion::recuperarFactor($con);

                                    while ($rw = sqlsrv_fetch_array($factor)) {
                                        ?>
                            <option value="<?php echo $rw['id_factor']; ?>"><?php echo Scape::ms_escape_string($rw['descripcion_factor']); ?></option>			
                                        <?php
                                    }
                            ?>
                        </select>    
                    </td>
                    <td colspan="2">
                        <select id="tramo" class="form-control">
                            <option value="">Tramo Registro Social</option>
                            <?php
                                    $tramo = Observacion::recuperarTramo($con);

                                    while ($rw = sqlsrv_fetch_array($tramo)) {
                                        ?>
                                        <option value="<?php echo $rw['id_tramo']; ?>"><?php echo $rw['descripcion_tramo']; ?></option>			
                                        <?php
                                    }
                            ?>
                        </select>    
                    </td>
                    <td colspan="2">
                        <select id="distancia" class="form-control">
                            <option value="">Distancia</option>
                            <?php
                                    $distancia = Observacion::recuperarDistancia($con);

                                    while ($rw = sqlsrv_fetch_array($distancia)) {
                                        ?>
                                        <option value="<?php echo $rw['id_distancia']; ?>"><?php echo $rw['descripcion_distancia']; ?></option>			
                                        <?php
                                    }
                            ?>
                        </select>    
                    </td>
                </tr>
                
                <tr>
                    <td colspan="1"><button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cerrar</button></td>
                    <td colspan="1"><button type="button" class="btn btn-primary btn-block guardar_datos" onclick="registrarObservacion()">Guardar datos</button></td> 
                </tr>

            </table>


        </div>
<script>
$('#tramo           option[value=<?php echo $observacionArreglo['tramo']; ?>]').prop("selected", "selected");
$('#factor          option[value=<?php echo $observacionArreglo['factor']; ?>]').prop("selected", "selected");
$('#otro_miembro    option[value=<?php echo $observacionArreglo['otro_miembro'];?> ]').prop("selected", "selected");
$('#duplicidad      option[value=<?php echo $observacionArreglo['duplicidad'];?> ]').prop("selected", "selected");
$('#distancia       option[value=<?php echo $observacionArreglo['distancia'];?> ]').prop("selected", "selected"); 
</script>
        <?php
    }
}
?>