<?php
session_start();
if (!isset($_SESSION['user_login_admin_status']) AND $_SESSION['user_login_admin_status'] != 1) {
    header("location: loginAdmin.php");
    exit;
}

/* Connecta a BD */
require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

$active_resumen = "active";
$title = "Resumen Informe";

//ENCABEZADO
$id_formulario = 1;
$numeroFormulario = sprintf('%08d', $id_formulario);
$fecha = date("d/m/Y");

//DATOS IDENTIFICACION DEL ESTUDIANTE
include '../Clases/Estudiante.php';
include '../Clases/Direccion.php';


  if(isset($_GET['rut_estudiante'])){
         $_SESSION['estudiante_temporal'] = $_GET['rut_estudiante'];    
        } 
$rut= $_SESSION['estudiante_temporal'];
$condicion="";//where...


$estudianteQuery = Estudiante::recuperarEstudiante($rut, $con, $condicion, "", "");
$estudianteArreglo;
while ($estudianteCursor = sqlsrv_fetch_array($estudianteQuery)) {
    $estudianteArreglo = array(
        "rut"       => $estudianteCursor['rut_estudiante'],
        "nombre"    => $estudianteCursor['nombre_estudiante'],
        "apellido"  => $estudianteCursor['apellido_estudiante'],
        "fechaNac"  => $estudianteCursor['fechaNac_estudiante'],
        "genero"    => $estudianteCursor['genero_estudiante'],
        "fono"      => $estudianteCursor['fono_estudiante'],
        "movil"     => $estudianteCursor['movil_estudiante'],
        "mail"      => $estudianteCursor['mail_estudiante'],
        "fechaIng"  => $estudianteCursor['fechaIng_estudiante'],
        "carrera"   => $estudianteCursor['carrera_estudiante'],
        "jornada"   => $estudianteCursor['nombre_jornada'],
    );
}
$tipo = 1;
$direccion1 = Direccion::recuperarDireccion($rut,$tipo,$con);
$direccion_1_Arreglo;
while ($direccionCursor = sqlsrv_fetch_array($direccion1)) {
    $direccion_1_Arreglo = array(
        "rut"           => $direccionCursor['rut_estudiante'],
        "tipo"          => $direccionCursor['tipo'],
        "direccion"     => $direccionCursor['direccion'],
        "numero"        => $direccionCursor['numero'],
        "departamento"  => $direccionCursor['departamento'],
        "villa"         => $direccionCursor['villa'],
        "comuna"        => $direccionCursor['nombre_comuna'],
        "region"        => $direccionCursor['nombre_region'],
    );
}
$tipo2 = 2;
$direccion2 = Direccion::recuperarDireccion($rut,$tipo2,$con);

if($direccion2){
$contador = sqlsrv_num_rows($direccion2);
}else{
$contador=0;    
}
if($contador>0){
while ($direccionCursor = sqlsrv_fetch_array($direccion2)) {
    $direccion_2_Arreglo = array(
        "rut"           => $direccionCursor['rut_estudiante'],
        "tipo"          => $direccionCursor['tipo'],
        "direccion"     => $direccionCursor['direccion'],
        "numero"        => $direccionCursor['numero'],
        "departamento"  => $direccionCursor['departamento'],
        "villa"         => $direccionCursor['villa'],
        "comuna"        => $direccionCursor['nombre_comuna'],
        "region"        => $direccionCursor['nombre_region'],
    );
}
}else{
   $direccion_2_Arreglo = array(
        "rut"           => "",
        "tipo"          => "",
        "direccion"     => "",
        "numero"        => "",
        "departamento"  => "",
        "villa"         => "",
        "comuna"        => "",
        "region"        => ""
    );  
}

//TIPO DE SOLICITUD
include '../Clases/Solicitud.php';
$condicion = "";
$tipoQuery = Solicitud::recuperarSolicitud($rut,$condicion,$con);

$tipoArreglo;

if($tipoQuery){
  $contador_tipo = sqlsrv_num_rows($tipoQuery);
}else{
  $contador_tipo = 0;  
}
if($contador_tipo>0){
 while ($tipoCursor = sqlsrv_fetch_array($tipoQuery)) {
$tipoArreglo = array(
        "tipo"      => $tipoCursor['nombre_tipo_solicitud'],
        "id_tipo"   => $tipoCursor['tipo'],
    );
}   
}else{
$tipoArreglo = array(
        "tipo"      => "",
        "id_tipo"   => "",
    );    
}

//IDENTIFICACION DEL GRUPO FAMILIAR
include '../Clases/Integrante.php';
$result_integrante = Integrante::recuperarIntegrante($rut,"",$con,"","","");           
$integrantesTotales= sqlsrv_num_rows($result_integrante);

//TENENCIA Y TIPO DE VIVIENDA
include '../Clases/Vivienda.php';
$vivienda = Vivienda::recuperarVivienda($rut, $con);
if($vivienda){
  $contador_vivienda= sqlsrv_num_rows($vivienda);  
}else{
  $contador_vivienda = 0;   
}
$viviendaArreglo;
if($contador_vivienda>0){
 while ($viviendaCursor = sqlsrv_fetch_array($vivienda)) {
    $viviendaArreglo = array(
        "tenencia"      => $viviendaCursor['nombre_tenencia'],
        "tipo"          => $viviendaCursor['nombre_tipoVivienda']
    );
}   
}else{
  $viviendaArreglo = array(
        "tenencia"      => "",
        "tipo"          => ""
    );    
}






//DECLARACION SOLICITUD
include '../Clases/Declaracion.php';
$declaracionQuery = Declaracion::recuperarDeclaracion($rut,$con);

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
//Fecha Atencion
include '../Clases/Horario.php';
$horarioQuery = Horario::verificarEstudianteCita($rut,$con);

if($horarioQuery){
 $contador_horario = sqlsrv_num_rows($horarioQuery);   
}
else{
  $contador_horario = 0 ;   
}

if($contador_horario>0){
$horarioArreglo;
while ($horarioCursor = sqlsrv_fetch_array($horarioQuery)) {
    $horarioArreglo = array(
        "fecha"      => $horarioCursor['fecha'],
        "horario"    => $horarioCursor['horario'],
        "asistente"  => $horarioCursor['rut_asistente']    
    );
}    
}else{
 $horarioArreglo = array(
        "fecha"      => "",
        "horario"    => "",
        "asistente"  => "0"    
    );    
}

//datos asistente
include '../Clases/Asistente.php';

$rut_asistente = $horarioArreglo['asistente'];
$habilitados = 1;

$asistenteQuery = Asistente::recuperarAsistente($rut_asistente,"",$habilitados,$con);

$asistenteArreglo;

if($asistenteQuery){
 $contador_asistente = sqlsrv_num_rows($asistenteQuery);   
}
else{
  $contador_asistente = 0 ;   
}

if($contador_asistente>0){
 while ($asistenteCursor = sqlsrv_fetch_array($asistenteQuery)) {
    $asistenteArreglo = array(
        "rut"         => $asistenteCursor['rut_asistente'],
        "nombre"      => $asistenteCursor['nombre_asistente'],
        "apellido"    => $asistenteCursor['apellido_asistente']    
    );
}   
}else{
  $asistenteArreglo = array(
        "rut"         => "",
        "nombre"      => "",
        "apellido"    => ""    
    );   
}


$asistente_nombre_completo =  $asistenteArreglo['nombre']." ".$asistenteArreglo['apellido'];
if($horarioArreglo['fecha']!=""){
$fecha_esp = Horario::fechaCastellano($horarioArreglo['fecha']);
}else{
 $fecha_esp = "";   
}

//IDENTIFICACION INGRESOS FAMILIARES
include '../Clases/Ingreso.php';


$result_integrante2 = Integrante::recuperarIntegrante($rut,"",$con,"","","");



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include("./headAdmin.php");
        ?>
        <style type="text/css">
            input {
                border: 0;
                width: 100%;
                display: inline-block;
                min-width: 95px;
            }
            textArea{
               width: 100%; 
            }            
            .firmas{
             height: 10rem;   
            }
            .declaracion{
             height: 20rem;   
            }
            .bloque{
             height: 30rem;   
            }
            .separar{
             height: 7rem;   
            }
        </style>
    </head>
    <body>
     <?php
        include("./navbarAdmin.php");
  
     ?>  

        <div class="container-fluid">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-right">
                            <p>
                                <label>Fecha <?php echo $fecha; ?></label>
                            </p>    
                        </div>
                        <br>
                        <div class="text-center">
                            <h4>Acreditación Socioeconómica (ASE)</h4>
                            <h4>Formulario único postulación y renovación</h4>
                            <h4> UFE-UGM <?php echo date("Y"); ?></h4>
                        </div>

                    </div>
                    <div id="resultados_ajax_formulario"></div>
                    <form id="acreditar_enviar_formulario">
                        <input type="hidden" name="acredita" value="<?php echo $_SESSION['rut_asistente']; ?>">    
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <input id="guardar_datos" type="submit" class="btn btn-block btn-info" value="Enviar Formulario">
                         </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>IDENTIFICACION DEL ESTUDIANTE</h5>  
                            </div> 
                            <div class="panel-body table-responsive">

                                <table border="0" class="table">
                                    <tbody>
                                        <tr>
                                            <td><label>NOMBRE :              </label></td>
                                            <td colspan="3"><input name="nombre" value="<?php echo $estudianteArreglo['nombre']." ".$estudianteArreglo['apellido']; ?>"></td>
                                            <td><label>RUT :              </label></td>
                                            <td colspan="3"><input name="rut" value="<?php echo $estudianteArreglo['rut']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td><label>CARRERA :</label></td>
                                            <td colspan="3"><input name="carrera" value="<?php echo $estudianteArreglo['carrera']; ?>"></td>
                                            <td><label>JORNADA:</label></td>
                                            <td colspan="3"><input name="jornada" value="<?php echo $estudianteArreglo['jornada']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td><label>AÑO&nbspINGRESO:</label></td>
                                            <td colspan="2"><input name="fechaIng" value="<?php echo $estudianteArreglo['fechaIng']; ?>"></td>
                                            <td><label>FECHA&nbspDE&nbspNACIMIENTO:</label></td>
                                            <td colspan="2"><input name="fechaNac" value="<?php echo date('d-m-Y', strtotime($estudianteArreglo['fechaNac'])); ?>"></td>
                                            <td><label>TIPO&nbspDE&nbspSOLICITUD:</label></td>
                                            <td>
                                                <input value="<?php echo $tipoArreglo['tipo']; ?>">
                                                <input type="hidden" name="tipo_sol" value="<?php echo $tipoArreglo['id_tipo']; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label>DIRECCION :</label></td>
                                            <td colspan="5"><input name="direccion" value="<?php echo $direccion_1_Arreglo['direccion']; ?>"></td>
                                            <td><label>N° :</label></td>
                                            <td><input name="numero" value="<?php echo $direccion_1_Arreglo['numero']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td><label>DPTO/CASA :</label></td>
                                            <td><input name="departamento" value="<?php echo $direccion_1_Arreglo['departamento']; ?>"></td>
                                            <td><label>VILLA :</label></td>
                                            <td><input name="villa" value="<?php echo $direccion_1_Arreglo['villa']; ?>"></td>
                                            <td><label>COMUNA :</label></td>
                                            <td><input name="comuna" value="<?php echo $direccion_1_Arreglo['comuna']; ?>"></td>
                                            <td><label>REGION :</label></td>
                                            <td><input name="region" value="<?php echo $direccion_1_Arreglo['region']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td><label>FONO (CASA):</label></td>
                                            <td><input name="fono" value="<?php echo $estudianteArreglo['fono']; ?>"></td>
                                            <td><label>CELULAR:</label></td>
                                            <td><input name="movil" value="<?php echo $estudianteArreglo['movil']; ?>"></td>
                                            <td><label>E-MAIL :</label></td>
                                            <td colspan="3"><input name="mail" value="<?php echo $estudianteArreglo['mail']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8"><h4>DIRECCION PERIODO ACADEMICO</h4></td>
                                        </tr>
                                        <tr>
                                            <td><label>DIRECCION :</label></td>
                                            <td colspan="5"><input name="direccion_2" value="<?php echo $direccion_2_Arreglo['direccion']; ?>"></td>
                                            <td><label>N° :</label></td>
                                            <td><input name="numero_2" value="<?php echo $direccion_2_Arreglo['numero']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td><label>DPTO :</label></td>
                                            <td><input name="departamento_2" value="<?php echo $direccion_2_Arreglo['departamento']; ?>"></td>
                                            <td><label>VILLA :</label></td>
                                            <td><input name="villa_2" value="<?php echo $direccion_2_Arreglo['villa']; ?>"></td>
                                            <td><label>COMUNA :</label></td>
                                            <td><input name="comuna_2" value="<?php echo $direccion_2_Arreglo['comuna']; ?>"></td>
                                            <td><label>REGION :</label></td>
                                            <td><input name="region_2" value="<?php echo $direccion_2_Arreglo['region']; ?>"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> 

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>IDENTIFICACION DEL GRUPO FAMILIAR
                                    <span style='display:inline; white-space:pre;'>             </span> 
                                    N° Total de Integrantes <?php echo $integrantesTotales; ?></h5>  
                            </div>
                            <div class="panel-body bloque table-responsive">
                                <table border="0" class="table">
                                    <thead>
                                        <tr>
                                            <th>RUT</th>
                                            <th>NOMBRE</th>
                                            <th>APELLIDO</th>
                                            <th>GENERO</th>
                                            <th>EDAD</th>
                                            <th>RELACION</th>
                                            <th>ESTADO&nbspCIVIL</th>
                                            <th>NIVEL&nbspEDUCACIONAL</th>
                                            <th>ACTIVIDAD/PROFESION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php 
                                    while ($row = sqlsrv_fetch_array($result_integrante)){
                                    
                                    $cumpleanos = new DateTime($row['fechaNac_integrante']);
                                    $hoy = new DateTime();
                                    $annos = $hoy->diff($cumpleanos);    
                                        
                                    $rut_integrante=$row['rut_integrante'];
                                    $nombre_integrante=$row['nombre_integrante'];
                                    $apellido_integrante=$row['apellido_integrante'];
                                    $genero_integrante=$row['nombre_genero'];
                                    $fechaNac_integrante=$row['fechaNac_integrante'];
                                    $edad_integrante= $annos->y;
                                    $relacion_integrante=$row['nombre_relacion'];
                                    $estadoCivil_integrante=$row['nombre_estado'];
                                    $nivelEduc_integrante=$row['nombre_nivel'];
                                    $actividad_integrante=$row['nombre_actividad'];         
                                     ?>     
                                        <tr>
                                            <td><input name="rut_integrante[]"          value="<?php echo $rut_integrante ?>">          </td>
                                            <td><input name="nombre_integrante[]"       value="<?php echo $nombre_integrante ?>">       </td>
                                            <td><input name="apellido_integrante[]"     value="<?php echo $apellido_integrante ?>">     </td>
                                            <td><input name="genero_integrante[]"       value="<?php echo $genero_integrante ?>">       </td>
                                            <td><input name="edad_integrante[]"         value="<?php echo $edad_integrante ?>">         </td>
                                            <td><input name="relacion_integrante[]"     value="<?php echo $relacion_integrante ?>">     </td>
                                            <td><input name="estadoCivil_integrante[]"  value="<?php echo $estadoCivil_integrante ?>">  </td>
                                            <td><input name="nivelEduc_integrante[]"    value="<?php echo $nivelEduc_integrante ?>">    </td>
                                            <td><input name="actividad_integrante[]"    value="<?php echo $actividad_integrante ?>">    </td>
                                        </tr>
                                     <?php   
                                     }
                                     ?>     
                                    </tbody>
                                </table>
    
                            </div>
                        </div>

                        <div class="panel panel-default">
                        <div class="panel-body table-responsive">
                          <table border="0" class="table">
                                    <thead>
                                        <tr>
                                            <th><label>TENENCIA&nbspDE&nbspLA&nbspVIVIENDA</label></th>
                                            <th><label><input name="tenencia_vivienda" value="<?php echo $viviendaArreglo['tenencia']; ?>"></label></th>
                                            <th><label>TIPO&nbspDE&nbspVIVIENDA</label></th>
                                            <th><label><input name="tipo_vivienda" value="<?php echo $viviendaArreglo['tipo']; ?>"></label></th>
                                        </tr>
                                    </thead>
                                </table>   
                        </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>IDENTIFICACION&nbspINGRESOS&nbspFAMILIARES</h5>  
                            </div>
                            <div class="panel-body bloque table-responsive">
                                <table border="0" class="table">
                                    <thead>
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
                                    </thead>
                                    <?php
                                    $total_anual=0;
    while ($row = sqlsrv_fetch_array($result_integrante2)) {
        
        $rut_integrante = $row['rut_integrante'];
        $result_ingreso = Ingreso::recuperarIngreso($rut_integrante,$rut, $con, "","","");
    
                                    
                                    while ($row = sqlsrv_fetch_array($result_ingreso)) {
                                    $rut_integrante      = $row['rut_integrante'];
                                    $nombre_integrante   = $row['nombre_integrante'];
                                    $apellido_integrante = $row['apellido_integrante'];
                      
$result_ingreso2 = Ingreso::recuperarIngreso($rut_integrante,$rut, $con, "","","");
            $row2 = sqlsrv_fetch_array($result_ingreso2);
            
            if($row!=null){
            $sueldo         = $row2['sueldo_integrante'];
            $pension        = $row2['pension_integrante'];
            $honorario      = $row2['honorario_integrante'];
            $retiro         = $row2['retiro_integrante'];
            $dividendo      = $row2['dividendo_integrante'];
            $interes        = $row2['interes_integrante'];
            $ganancia       = $row2['ganancia_integrante'];
            $pension_alim   = $row2['pension_alim_integrante'];
            $actividad      = $row2['actividad_integrante'];         
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
            $total_anual=$total_anual+$total= $sueldo+$pension+$honorario+$retiro+$dividendo+$interes+$ganancia+$pension_alim+$actividad;
            ?>                                    
                                    <tbody>
                                        <tr>          
                        <td class="col-sm-2"><?php echo $rut_integrante; ?><input type="hidden" class="form-control" name="rut_ingreso[]" value="<?php echo $rut_integrante; ?>" readonly required></td>
                        <input type="hidden" class="form-control" name="nombre_ingreso[]" value="<?php echo $nombre_integrante; ?>" readonly required>
                        <input type="hidden" class="form-control" name="apellido_ingreso[]" value="<?php echo $apellido_integrante; ?>" readonly required>  
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_sueldo"     name="sueldo_integrante[]"        type="number" required value="<?php echo $sueldo; ?>"       ></td>
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_pensionl"   name="pension_integrante[]"       type="number" required value="<?php echo $pension; ?>"      ></td>
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_honorario"  name="honorario_integrante[]"     type="number" required value="<?php echo $honorario; ?>"    ></td>
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_retiro"     name="retiro_integrante[]"        type="number" required value="<?php echo $retiro; ?>"       ></td>
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_dividendol" name="dividendo_integrante[]"     type="number" required value="<?php echo $dividendo; ?>"    ></td>
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_interes"    name="interes_integrante[]"       type="number" required value="<?php echo $interes; ?>"      ></td>
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_ganancia"   name="ganancia_integrante[]"      type="number" required value="<?php echo $ganancia; ?>"     ></td>
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_pension"    name="pension_alim_integrante[]"  type="number" required value="<?php echo $pension_alim; ?>" ></td>
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_actividad"  name="actividad_integrante[]"     type="number" required value="<?php echo $actividad; ?>"    ></td>
                        <td><input class="form-control total" id="ingreso_total<?php echo $id_dinamico; ?>" name="ingreso_total[]" required  readonly  value="<?php echo $total; ?>"></td>
                    </tr> 
                                    </tbody>
                                    <?php
    }}
                                    ?>
                                </table>                            

                            </div> 


                     
                            
                        </div>

                 
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5> INGRESO MENSUAL POR AÑO </h5>
                    </div>
                    <div class="panel-body">
                        <table border="0" class="table text-center">
                            <tbody>
                                <tr>
                                    <th class="text-center">AÑO</th>
                                    <th class="text-center">TOTAL MENSUAL</th>
                                    <th class="text-center">PERCAP</th>
                                </tr>
                                <tr>
                                    <td><?php echo date('Y'); ?></td>
                                    <td><?php echo $total_anual; ?></td>
                                    <td><?php echo intval($total_anual/$integrantesTotales); ?></td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>
            </div>
        
<div class="separar"></div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>ANTECEDENTES&nbspDE&nbspSALUD&nbspGRUPO&nbspFAMILIAR</h5>  
                            </div>
                            <div class="panel-body bloque table-responsive">
                                <table border="0" class="table">
                                    <thead>
                                        <tr>
                                            <th>RUT</th>
                                            <th>NOMBRE</th>
                                            <th>APELLIDO</th>
                                            <th>CONDICION</th>
                                            <th>ENFERMEDAD</th>
                                            <th>PREVISION</th>
                                            <th>OTRA&nbspPREVISION</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    //resetea cursor de sqlsrv
                                    for ( $row = sqlsrv_fetch_array($result_integrante, SQLSRV_FETCH_BOTH, SQLSRV_SCROLL_FIRST);$row ;$row = sqlsrv_fetch_array($result_integrante, SQLSRV_FETCH_BOTH, SQLSRV_SCROLL_NEXT) ){
                                    $rut_integrante           = $row['rut_integrante'];
                                    $nombre_integrante        = $row['nombre_integrante'];
                                    $apellido_integrante      = $row['apellido_integrante'];
                                    $condicion_integrante     = $row['nombre_condicion'];
                                    $enfermedad_integrante    = $row['enfermedad_integrante'];
                                    $prevision_integrante     = $row['nombre_prevision'];
                                    $otraPrevision_integrante = $row['otraPrevision_integrante'];
                                     ?>     
                                    <tbody>
                                        <tr>
                                            <td><input name="rut_antecedentes[]"        value="<?php echo $rut_integrante ?>">             </td>
                                            <td><input name="nombre_antecedentes[]"     value="<?php echo $nombre_integrante ?>">          </td>
                                            <td><input name="apellido_antecedentes[]"   value="<?php echo $apellido_integrante ?>">        </td>
                                            <td><input name="condicion_antecedentes[]"  value="<?php echo $condicion_integrante ?>">       </td>
                                            <td><input name="enfermedad_antecedentes[]" value="<?php echo $enfermedad_integrante ?>">      </td>
                                            <td><input name="prevision_antecedentes[]"  value="<?php echo $prevision_integrante ?>">       </td>
                                            <td><input name="otraprev_antecedentes[]"   value="<?php echo $otraPrevision_integrante ?>">   </td>          
                                        </tr>                                  
                                    </tbody>
                                    <?php 
                                    }   
                                    ?>     
                                </table>

                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>DECLARACION&nbspDE&nbspSOLICITUD&nbspA&nbspBECA</h5>  
                            </div>
                            <div class="panel-body table-responsive">
                                <table border="0" class="table">
                                    <tbody>
                                        <tr>
                                            <td colspan="2"><textarea name="declaracion" class="declaracion text-center" readonly> <?php echo$declaracionArreglo['declaracion'];?></textarea></td>         
                                        </tr>
                                        <tr>
                                            <td>
                            <div class="panel panel-default">
                            <div class="panel-body firmas">
                            </div>     
                            <div class="panel-heading text-center">
                            FIRMA&nbspY&nbspHUELLA&nbspDEL&nbspESTUDIANTE     
                            </div>
                            </div>         
                                            </td>
                                            <td>
                            <div class="panel panel-default">
                            <div class="panel-body firmas">
                                    
                            </div>    
                            <div class="panel-heading text-center">
                            FIRMA&nbspY&nbspTIMBRE&nbspUFE 
                            </div>
                            </div>     
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <h5>DATOS&nbspDE&nbspENTREVISTA</h5>  
                            </div>
                            <div class="panel-body table-responsive">
                                <table border="0" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">FECHA</th>
                                            <td><input class="text-center" name="fecha_cita" value="<?php echo $fecha_esp ?>"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="text-center">HORA</th>                              
                                            <td><input class="text-center" name="hora_cita" value="<?php echo $horarioArreglo['horario'];?>"></td>    
                                        </tr>
                                         <tr>            
                                            <th class="text-center">ASISTENTE SOCIAL</th>
                                            <td><input class="text-center" name="asistente_cita" value="<?php echo $asistente_nombre_completo;?>"></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>


                    </div>
                </form>
                    
                </div>

        </div>  






        <?php
        include("../footer.php");
        ?>
        <script type="text/javascript" src="../js/funciones/formulario.js"></script>
        <script type="text/javascript">
        $('input').attr('readonly', true)   
        </script>
    </body>
</html>
