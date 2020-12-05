<?php
//include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database */
require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

include '../Clases/Scape.php';
include '../Clases/Estudiante.php';
include '../Clases/Observacion.php';
include '../Clases/Integrante.php';
include '../Clases/Ingreso.php';
include '../Clases/Enfermedad.php';
include '../Clases/Pueblo.php';
include '../Clases/PrevisionSocial.php';
include '../Clases/TipoContrato.php';
include '../Clases/Sugerencia.php';
include '../Clases/Formula.php';
include '../Clases/Beneficio.php';
include '../Clases/Discapacidad.php';
include '../Clases/Nacionalidad.php';
include '../Clases/Extra.php';


$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if ($action == 'ajax') {

    $rut = $_REQUEST['rut'];




//UMAS
    include '../Clases/UMAS.php';
    include '../Autenticacion/FormatoRut.php';

    $rut_2 = sinPuntosGuionRut($rut);
    $rut_3 = sinPuntosRut( $rut );
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
        
        $nacionalidadQuery = UMAS::recuperarEstudiante($rut_3,$con);
        $nacionalidadArreglo = array();
        while ($nacionalidadCursor = sqlsrv_fetch_array($nacionalidadQuery)) {
            
//            $id=2;
//            $nacionalidad='EXTRANJERA';
            if($nacionalidadCursor['NACIONALIDAD']=='CHILENA'){
            $id=1;
            $nacionalidad='CHILENA';
            }else{
            $id=2;
            $nacionalidad='EXTRANJERA';  
            }
            
            $nacionalidadArreglo = array(
                "id"        => $id,
                "nombre"    => $nacionalidad
            );
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

//APROBADAS

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
        

//AVANCE

if($inscritasArreglo['inscritas']>0){
$avance = round(($aprobadaArreglo['aprobadas']/$inscritasArreglo['inscritas'])*100);       
}else{
 $avance = 0;   
}
        
        
        
        $puebloQuery = Pueblo::recuperarPueblo($con);
        $nacionalidadArreglo[] = array();
        while ($puebloCursor = sqlsrv_fetch_array($puebloQuery)) {
            $puebloArreglo[] = array(
                "id" => $puebloCursor['id_pueblo'],
                "nombre" => $puebloCursor['nombre_pueblo'],
            );
        }
        
        //cambiar a rut_2
        $promedioQuery = UMAS::PROMEDIO_ANUAL($rut_2, $con);

        
        if($promedioQuery){
            $contador_prom = sqlsrv_num_rows($promedioQuery);
        }else{
            $contador_prom=0;
        }
        
         $promedioArreglo = array(
                "promedio" => 0,
            );
        
        if($contador_prom>0){
           while ($promedioCursor = sqlsrv_fetch_array($promedioQuery)) {
            $promedioArreglo = array(
                "promedio" => $promedioCursor['PROMEDIO_AP'],
            );
        }
        }
        
        $tipocalificacion="NA";
        
        if($promedioArreglo['promedio']>0){
         $calificacion = round($promedioArreglo['promedio']*10); 
  
        }else{
         //NEM
         $nemQuery = UMAS::NEM($rut_2, $con);

        if ($nemQuery) {
            $contador_nem = sqlsrv_num_rows($nemQuery);
        } else {
            $contador_nem = 0;
        }
        
        $nemArreglo = array(
                    "nem" => 0,
                );
        
        if ($contador_nem > 0) {
            while ($nemCursor = sqlsrv_fetch_array($nemQuery)) {
                $nemArreglo = array(
                    "nem" => $nemCursor['NOTAEM'],
                );
            }
            $avance=100;
        }
        
        if($nemArreglo['nem']!=""){
        $NEM = $nemArreglo['nem'];
        }else{
        $NEM = "0";    
        }
        
         $calificacion = round($NEM*10);
         $tipocalificacion="NEM";
        }
   
      
        $result_integrante = Integrante::recuperarIntegrante($rut,"",$con,"","","");           
        $integrantesTotales= sqlsrv_num_rows($result_integrante);
        
        $result_enfermedad = Enfermedad::recuperarEnfermedad($con);
         while ($enfermedadCursor = sqlsrv_fetch_array($result_enfermedad)) {
            $enfermedadArreglo[] = array(
                "id" => $enfermedadCursor['id_enfermedad'],
                "nombre" => $enfermedadCursor['nombre_enfermedad'],              
            );
        
        }
        
        
         $result_jefe = Ingreso::recuperarIngresoJefe("",$rut,$con);
         while ($jefeCursor = sqlsrv_fetch_array($result_jefe)) {
            $jefeArreglo[] = array(
                "rut"       => $jefeCursor['rut_integrante'],
                "nombre"    => $jefeCursor['nombre_integrante'],
                "apellido"  => $jefeCursor['apellido_integrante'],
                "total"  => $jefeCursor['TOTAL'],         
            );
        
        }
        
        
        $result_prevision_social = PrevisionSocial::recuperarPrevisionSocial($con);
         while ($previsionSocialCursor = sqlsrv_fetch_array($result_prevision_social)) {
            $previsionSocialArreglo[] = array(
                "id"       => $previsionSocialCursor['id_prevision_social'],
                "nombre"    => $previsionSocialCursor['nombre_prevision_social'],     
            );
        
        }
        
        $result_contrato = TipoContrato::recuperarTipoContrato($con);
         while ($contratoCursor = sqlsrv_fetch_array($result_contrato)) {
            $contratoArreglo[] = array(
                "id"       => $contratoCursor['id_tipo_contrato'],
                "nombre"    => $contratoCursor['nombre_tipo_contrato'],     
            );
        
        }
        
        $result_sugerencia = Sugerencia::recuperarSugerencia($con);
         while ($sugerenciaCursor = sqlsrv_fetch_array($result_sugerencia)) {
            $sugerenciaArreglo[] = array(
                "id"       => $sugerenciaCursor['id_sugerencia'],
                "nombre"    => $sugerenciaCursor['nombre_sugerencia'],     
            );
        
        }
        
        $result_formula = Formula::recuperarFormula($con);
         while ($formulaCursor = sqlsrv_fetch_array($result_formula)) {
            $formulaArreglo[] = array(
                "id"        => $formulaCursor['id_formula'],
                "nombre"    => $formulaCursor['descripcion_formula'],     
            );
        
        }
     
        $result_beneficio = Beneficio::recuperarBeneficio($con);
         while ($beneficioCursor = sqlsrv_fetch_array($result_beneficio)) {
            $beneficioArreglo[] = array(
                "id"        => $beneficioCursor['id_beneficio'],
                "nombre"    => $beneficioCursor['descripcion_beneficio'],     
            );
        
        }
        
        $result_discapacidad = Discapacidad::recuperarDiscapacidad($con);
         while ($discapacidadCursor = sqlsrv_fetch_array($result_discapacidad)) {
            $discapacidadArreglo[] = array(
                "id"        => $discapacidadCursor['id_discapacidad'],
                "nombre"    => $discapacidadCursor['nombre_discapacidad'],     
            );
        
        }

        
    $result_extra = Extra::recuperarExtra($rut, $con);
    
    if($result_extra){
       $contador_extra = sqlsrv_num_rows($result_extra);
    }else{
       $contador_extra=0; 
    }
    
    $extraArreglo = array(
                "rut_estudiante"        => "",
                "nacionalidad"          => "",
                "pueblo"                => "",
                "formula_ministerial"   => "",
                "egresos_totales"       => "",
                "jefe_hogar"            => "",
                "contrato_jefe"         => "",
                "prev_social_jefe"      => "",
                "ingreso_jefe"          => "",
                "beneficio"             => "",
                "sugerencia_asist"      => "",
                "discapacidad"          => "",
                "calificacion"          => "",
                "avance"                => ""
            );
    
    if($contador_extra>0){
      while ($extraCursor = sqlsrv_fetch_array($result_extra)) {
            $extraArreglo = array(
                "rut_estudiante"        => $extraCursor['rut_estudiante'],
                "nacionalidad"          => $extraCursor['nacionalidad'],
                "pueblo"                => $extraCursor['pueblo'],
                "formula_ministerial"   => $extraCursor['formula_ministerial'],
                "egresos_totales"       => $extraCursor['egresos_totales'],
                "jefe_hogar"            => $extraCursor['jefe_hogar'],
                "contrato_jefe"         => $extraCursor['contrato_jefe'],
                "prev_social_jefe"      => $extraCursor['prev_social_jefe'],
                "ingreso_jefe"          => $extraCursor['ingreso_jefe'],
                "beneficio"             => $extraCursor['beneficio'],
                "sugerencia_asist"      => $extraCursor['sugerencia_asist'],
                "discapacidad"          => $extraCursor['discapacidad'],
                "calificacion"          => $extraCursor['calificacion'],
                "avance"                => $extraCursor['avance'],
            );
        }
        
 ?>       
<script>
$('#pueblo                  option[value=<?php echo $extraArreglo['pueblo']; ?>]').prop("selected", "selected")
$('#discapacidad            option[value=<?php echo $extraArreglo['discapacidad']; ?>]').prop("selected", "selected")
$('#beneficio               option[value=<?php echo $extraArreglo['beneficio']; ?>]').prop("selected", "selected")
$('#formula                 option[value=<?php echo $extraArreglo['formula_ministerial']; ?>]').prop("selected", "selected")
$('#egreso')                .val(<?php echo $extraArreglo['egresos_totales']; ?>)
$('#prevision_jefe          option[value=<?php echo $extraArreglo['prev_social_jefe']; ?>]').prop("selected", "selected")
$('#contrato_jefe           option[value=<?php echo $extraArreglo['contrato_jefe']; ?>]').prop("selected", "selected")
$('#sugerencia_asistente    option[value=<?php echo $extraArreglo['sugerencia_asist']; ?>]').prop("selected", "selected")

</script>
<?php        
        
    }
        ?>
        <div class="table-responsive">
            <div id="resultados_ajax_mensaje"></div>
<!--            <form id="guardar_extra">-->
            <table class="table" border='0'>
                 <tr>
                     <th colspan="6" class="text-center success"><legend>Estudiante</legend></th>  
                </tr>
                <tr>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th class="text-center">Nacionalidad</th>
                    <th class="text-center">AA</th>
                    <th class="text-center">Calificacion<?php echo  "(".$tipocalificacion.")"; ?></th>
                </tr>
                <tr>
                    <td><?php echo $estudianteArreglo['rut']; ?><input name="rut_estudiante" type="hidden" value="<?php echo $estudianteArreglo['rut']; ?>"></td>
                    <td><?php echo $estudianteArreglo['nombre']; ?></td>
                    <td><?php echo $estudianteArreglo['apellido']; ?></td>
                    <td class="text-center"><input type="hidden" name="nacionalidad" value="<?php echo $nacionalidadArreglo['id']; ?>"><?php echo $nacionalidadArreglo['nombre']; ?></td>
                    <td class="text-center"><input type="hidden" name="avance" value="<?php echo $avance; ?>"><?php echo $avance; ?></td>
                    <td class="text-center"><input type="hidden" name="calificacion" value="<?php echo $calificacion; ?>"><?php echo $calificacion; ?></td>
                </tr>
                 <tr>
                     <th colspan="6" class="text-center success"><legend>Datos Complementarios</legend></th>  
                </tr>
                <tr>
                    <th>Pueblo&nbsp;Originario</th>
                    <td>
                        <select class="form-control" id="pueblo" name="pueblo">
                            <option value="">Seleccione un pueblo</option>    
                    <?php
                    foreach($puebloArreglo as $pueblo){
                    ?>
                            <option value="<?php echo Scape::ms_escape_string($pueblo['id']) ?>"><?php echo Scape::ms_escape_string($pueblo['nombre']) ?></option>
                    <?php
                    }
                    ?>
                    </select>
                    </td>
 
                 <th>Estudiante&nbsp;con&nbsp;Discapacidad</th>
                 <td>
                 <select class="form-control" id="discapacidad" name="discapacidad">
                          <option value="">Seleccione discapacidad</option> 
                    <?php
                    foreach($discapacidadArreglo as $discapacidad){
                    ?>
                            <option value="<?php echo $discapacidad['id'] ?>"><?php echo Scape::ms_escape_string($discapacidad['nombre']) ?></option>
                    <?php
                    }
                    ?>
                </select>            
                </td>                            
                    </th>
                 <th>Beneficios&nbsp;del&nbsp;Estado</th>
                 <td>
                     <select class="form-control" id="beneficio" name="beneficio">
                          <option value="">Seleccione un beneficio</option> 
                    <?php
                    foreach($beneficioArreglo as $beneficio){
                    ?>
                            <option value="<?php echo $beneficio['id'] ?>"><?php echo Scape::ms_escape_string($beneficio['nombre']) ?></option>
                    <?php
                    }
                    ?>
                    </select>
                 </td>
                </tr>
                 <tr>
                     <th colspan="6" class="text-center success"><legend>Integrantes familiares</legend></th>  
                </tr>
                <tr>
                    <th>Rut</th>  
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Enfermedad</th>
                    <th colspan="2">Clasificacion</th>
                </tr>
                <?php
                while($integranteCursor = sqlsrv_fetch_array($result_integrante)){
                    
                    
                ?>
                 <tr>
                     <th><input type="hidden" name="rut_integrante[]" value="<?php echo $integranteCursor['rut_integrante'];?>"><?php echo $integranteCursor['rut_integrante'];?></th>
                    <th><?php echo $integranteCursor['nombre_integrante'];?></th>
                    <th><?php echo $integranteCursor['apellido_integrante'];?></th>
                    <th><?php echo $integranteCursor['enfermedad_integrante'];?></th>
                    <th colspan="2">
                        <select class="form-control" id="<?php echo $integranteCursor['rut_integrante'];?>" name="enfermedad[]">
                            
                    <?php
                    foreach($enfermedadArreglo as $enfermedad){
                    ?>
                            <option <?php  if($enfermedad['id']==$integranteCursor['clasificacion_enfermedad']){ echo 'selected';} ?> value="<?php echo $enfermedad['id'] ?>"><?php echo Scape::ms_escape_string($enfermedad['nombre']) ?></option>
                            
                             
                    <?php
                    }
                    ?>
                    </select></th>        
                </tr>
                
               <?php
                }
               ?>
                <tr>
                     <th colspan="6" class="text-center success"><legend>Grupo Familiar</legend></th>  
                </tr>
                <tr>
                    <th>Formula Ministerial</th>
                    <th>
                        <select class="form-control" id="formula" name="formula">
                             <option value="">Seleccione un formula</option> 
                   <?php
                    foreach($formulaArreglo as $formula){
                    ?>
                            <option value="<?php echo Scape::ms_escape_string($formula['id']) ?>"><?php echo Scape::ms_escape_string($formula['nombre']) ?></option>
                    <?php
                    }
                    ?>
                    </select>
                    </th>  
                    
                   <th>Egresos Totales</th>
                   <th colspan="4"><input type="number" onkeyup="soloNumeros(this.value);" class="form-control" id="egreso" name="egreso"></th>
                </tr>
  
                  <tr>
                     <th colspan="6" class="text-center success"><legend>Jefe de Hogar</legend></th>  
                </tr>
                 <tr>
                    <?php
                    foreach($jefeArreglo as $jefe){
                    if($jefe['total']>0){    
                    ?>   
                    <th>Jefe de Hogar</th>
                    <th><input type="hidden" name="rut_jefe" value="<?php echo $jefe['rut']; ?>"><?php echo Scape::ms_escape_string($jefe['nombre']); ?></th>
                    <th><?php echo Scape::ms_escape_string($jefe['apellido']); ?></th>
                    <th colspan="2" class="info">Ingresos totales</th>
                    <th colspan="2" class="info"><input type="hidden" name="ingreso_jefe" value="<?php echo $jefe['total']; ?>"><?php echo $jefe['total']; ?></th>
                    <?php
                    }else{
                     ?>   
                    <th>Jefe de Hogar</th>
                    <th><input type="hidden" name="rut_jefe" value="<?php echo $estudianteArreglo['rut']; ?>"><?php echo Scape::ms_escape_string($estudianteArreglo['nombre']); ?></th>
                    <th><?php echo Scape::ms_escape_string($estudianteArreglo['apellido']); ?></th>
                    <th colspan="2" class="info">Ingresos totales</th>
                    <th colspan="2" class="info"><input type="hidden" name="ingreso_jefe" value="<?php echo 0; ?>"><?php echo 0; ?></th>
                    <?php    
                    }
                    
                    }
                    ?>
                   
                </tr>
               
                <tr>
                    <th>Prevision Social Jefe</th>  
                    <th>
                        <select class="form-control" id="prevision_jefe" name="prevision_jefe">
                             <option value="">Seleccione prevision</option> 
                    <?php
                    foreach($previsionSocialArreglo as $prevision){
                    ?>
                            <option value="<?php echo Scape::ms_escape_string($prevision['id']) ?>"><?php echo Scape::ms_escape_string($prevision['nombre']) ?></option>
                    <?php
                    }
                    ?>
                    </select>
                    </th> 
                    <th>Tipo Contrato Jefe</th>
                    <th colspan="2">
                        <select class="form-control" id="contrato_jefe" name="contrato_jefe">
                             <option value="">Seleccione contrato</option> 
                    <?php
                    foreach($contratoArreglo as $contrato){
                    ?>
                            <option value="<?php echo Scape::ms_escape_string($contrato['id']) ?>"><?php echo Scape::ms_escape_string($contrato['nombre']) ?></option>
                    <?php
                    }
                    ?>
                    </select>
                   </th> 
                    <th></th>
                </tr>
                
                <tr>
                     <th colspan="6" class="text-center success"><legend>Asistente Social</legend></th>  
                </tr>
                
                <tr>
                    <th>
                    Sugerencia de Asistente    
                    </th>
                    <th colspan="2">
                        <select class="form-control" id="sugerencia_asistente" name="sugerencia_asistente">
                             <option value="">Seleccione sugerencia</option> 
                    <?php
                    foreach($sugerenciaArreglo as $sugerencia){
                    ?>
                            <option value="<?php echo Scape::ms_escape_string($sugerencia['id']) ?>"><?php echo Scape::ms_escape_string($sugerencia['nombre']) ?></option>
                    <?php
                    }
                    ?>
                    </select></th> 
                </tr>
                
                <tr>
                    <td colspan="2"><button type="button" class="btn btn-default btn-block" data-dismiss="modal">Cerrar</button></td>
                    <td colspan="4"><button type="button" class="btn btn-primary btn-block guardar_datos" onclick="registrarExtra()">Guardar datos</button></td> 
                </tr>

            </table>
<!--</form>-->
            

        </div>





        

        <?php
    }
}


?>