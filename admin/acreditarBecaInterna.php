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


$fecha = date('d-m-Y');
//BECAS
include '../Clases/Becas.php';
include '../Clases/Scape.php';

//DATOS IDENTIFICACION DEL ESTUDIANTE
include '../Clases/EstudianteBeca.php';
include '../Clases/Direccion.php';


/*
  if(!isset($_GET['rut_estudiante']) || empty($_GET['rut_estudiante']) || strlen($_GET['rut_estudiante'])==0){
  $rut="0000";
  }else{
  $rut= $_GET['rut_estudiante'];
  }
  */

  $rut= $_GET['rut'];

$condicion="";//where...


   $beca= 1;
   
   if(isset($_GET['tipo'])){
   $renoPost= $_GET['tipo'];
   }else{
   $renoPost=1;    
   }

   switch ($renoPost){
     case 1: $estado_re_po='Postulante';
         break;
     case 2: $estado_re_po='Renovante';
         break;
   }
   
  //print_r(strlen($_GET['rut_estudiante']));

                      
if(($renoPost==1 and $beca=2) or ($renoPost==1 and $beca=4)){
include '../modal/mensaje_beca_interna.php'; 

?> 
<head>
<!-- Jquery 2.2.4 -->
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
   
<?php                      
}

 

//UMAS
include '../Clases/UMAS.php';
include '../Autenticacion/FormatoRut.php';




$rut_2 = sinPuntosGuionRut($rut);
$rut_3 = sinPuntosRut($rut);
$condicion = ""; //where...




$estudianteQuery = UMAS::recuperarEstudiante($rut_3, $con);

$estudianteArreglo;
while ($estudianteCursor = sqlsrv_fetch_array($estudianteQuery)) {
    
//var_dump($estudianteQuery);
    $estudianteArreglo = array(
        "rut"       => $estudianteCursor['RUT'],
        "nombre"    => SCAPE::ms_escape_string($estudianteCursor['NOMBRE']),
        "apellido"  => SCAPE::ms_escape_string($estudianteCursor['PATERNO']).' '.SCAPE::ms_escape_string($estudianteCursor['MATERNO']),
        "fechaNac"  => $estudianteCursor['FECHA'],
        "genero"    => $estudianteCursor['SEXO'],
        "direccion"  => SCAPE::ms_escape_string($estudianteCursor['DIRACTUAL']),
        "mail"      => $estudianteCursor['MAIL_INST'],
        "fechaIng"  => $estudianteCursor['ANO'],
        "carrera"   => SCAPE::ms_escape_string($estudianteCursor['NOMBRE_C']),
        "jornada"   => $estudianteCursor['JORNADA'],
    );
}





$notaQuery = UMAS::NOTAS_ANUALES($rut_2,$con);
$notaArreglo;
if($notaQuery){
 $contador_nota= sqlsrv_num_rows($notaQuery);   
}else{
 $contador_nota=0;   
}
if($contador_nota>0){
 while ($notaCursor = sqlsrv_fetch_array($notaQuery)) {
    $notaArreglo = array(
        "rut"       => $notaCursor['CODCLI'],
        "promedio"    => $notaCursor['PROMEDIO_AP'],

    );
}   
}else{
 $notaArreglo = array(
        "rut"       => 0,
        "promedio"    => 0,

    );   
}


$inscritasQuery = UMAS::ASIGNATURAS_INSCRITAS($rut_2,$con);

if($inscritasQuery){
  $contador_inscritas= sqlsrv_num_rows($inscritasQuery);  
}else{
  $contador_inscritas= 0;     
}

$inscritasArreglo;
if($contador_inscritas>0){
while ($inscritasCursor = sqlsrv_fetch_array($inscritasQuery)) {
    $inscritasArreglo = array(
        "inscritas"       => $inscritasCursor['ASIGNATURAS_INSCRITAS'],
    );
}
}else{
 $inscritasArreglo = array(
        "inscritas"       => 0,
    );    
}



$aprobadaQuery = UMAS::ASIGNATURAS_APROBADAS($rut_2,$con);

if($aprobadaQuery){
  $contador_aprobadas= sqlsrv_num_rows($aprobadaQuery);  
}else{
  $contador_aprobadas= 0;     
}
$aprobadaArreglo;
if($contador_aprobadas>0){
 while ($aprobadaCursor = sqlsrv_fetch_array($aprobadaQuery)) {
    $aprobadaArreglo = array(
        "aprobadas"       => $aprobadaCursor['ASIGNATURAS_APROBADAS'],
    );
}   
}else{

    $aprobadaArreglo = array(
        "aprobadas"       => 0,
    );   
}



//se incluye en AA ?
$promedioQuery = UMAS::PROMEDIO_ANUAL($rut_2,$con);
$promedioArreglo;
while ($promedioCursor = sqlsrv_fetch_array($promedioQuery)) {
    $promedioArreglo = array(
        "promedio"       => $promedioCursor['PROMEDIO_AP'],
    );
}

$estadoAcadQuery = UMAS::ESTADO_ACADEMICO($rut_2,$con);
$estadoAcadArreglo;
while ($estadoAcadCursor = sqlsrv_fetch_array($estadoAcadQuery)) {
    $estadoAcadArreglo = array(
        "estado_academico"       => $estadoAcadCursor['ESTACAD'],
        "estado_financiero"       => $estadoAcadCursor['ESTFINAN'],
    );
}



//select para completar 
include '../Clases/Cvd.php';
include '../Clases/Sd.php';
include '../Clases/He.php'; // hermanos
include '../Clases/Ct.php'; //contrato trabajo
include '../Clases/Cf.php'; //certificado federacion
include '../Clases/Cp.php'; //certificado parentesco
include '../Clases/Ne.php'; //Nacionalidad Extranjera
include '../Clases/Bm.php'; //Beca Ministerial
include '../Clases/Cae.php'; //Credito aval del estado
include '../Clases/Certificado.php'; //certificado egresado titulado



/*APROBADAS*100/INSCRITAS*/
//items de informe
$NA=$notaArreglo['promedio'];

if($inscritasArreglo['inscritas']>0){
$AA= intval(($aprobadaArreglo['aprobadas']*100)/$inscritasArreglo['inscritas']);
}else{
 $AA= "sin inscripcion";   
}

$E4=$estadoAcadArreglo['estado_academico'];

$AR=$estadoAcadArreglo['estado_academico'];


//FINANCIERA
$finanzaQuery = UMAS::SITUACION_FINANCIERA($rut_2,$con);

if($finanzaQuery){
  $contador_finanza= sqlsrv_num_rows($finanzaQuery);  
}else{
  $contador_finanza= 0;     
}


if($contador_finanza>0){
 $SF= "DEUDA";   
}else{
 $SF="AL DIA";      
}

$aprobacionQuery=UMAS::PORCENTAJE_APROBACION($rut_2,$con);

if($aprobacionQuery){
  $contador_aprobacion= sqlsrv_num_rows($aprobacionQuery);  
}else{
$contador_aprobacion=0;   
}
$aprobacionArreglo;
if($contador_aprobacion>0){
while ($aprobacionCursor = sqlsrv_fetch_array($aprobacionQuery)) {
    $aprobacionArreglo = array(
        "porcentaje"       => $aprobacionCursor['PORC_APR'],
        "nombre"       => $aprobacionCursor['NOMBRE'],
    );
} 
}else{
  $aprobacionArreglo = array(
        "porcentaje"       => 0,
        "nombre"       => 'sin becas',
    ); 
}

$aprobacion= intval($aprobacionArreglo['porcentaje']);
$aprobacion_nombre= $aprobacionArreglo['nombre'];
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
            
            th{
            min-width: 100px;  
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
                            <h4>Datos Personales</h4>
                            <h4>Sistema de beneficios estudiantiles</h4>
                            <h4> SBE <?php echo date("Y"); ?></h4>
                        </div>

                    </div>
                  
                    <div id="resultados_ajax_beca_interna"></div>
                    <form id="formulario_beca_interna">
                        <input type="hidden" name="acredita" value="<?php echo $_SESSION['rut_asistente']; ?>">    
                        
                    <div class="panel-body">
                        <div class="panel panel-default">
            
                      
                        <div class="table-responsive">
                                                                 
                             
                     
                        </div>
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
                                            <td colspan="3"><input name="nombre" id="nombre" value="<?php echo $estudianteArreglo['nombre']." ".$estudianteArreglo['apellido']; ?>"></td>
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
                                          
                                        </tr>
                                        <tr>
                                            <td><label>DIRECCION :</label></td>
                                            <td colspan="5"><input name="direccion" value="<?php echo $estudianteArreglo['direccion']; ?>"></td>
                                         
                                        </tr>
                                        
                                        <tr>
                                        <td><label>MAIL :</label></td>
                                            <td colspan="3"><input name="mail" value="<?php echo $estudianteArreglo['mail']; ?>"></td>
                                        </tr>
<!--                                        <tr>
                                            <td colspan="8"><h4>DIRECCION PERIODO ACADEMICO</h4></td>
                                        </tr>
                                        <tr>
                                            <td><label>DIRECCION :</label></td>
                                            <td colspan="5"><input name="direccion_2" value="<?php echo $estudianteArreglo['direccion2']; ?>"></td>
                                            <td><label>N° :</label></td>
                                            <td><input name="numero_2" value="<?php echo $estudianteArreglo['numero2']; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td><label>DPTO :</label></td>
                                            <td><input name="departamento_2" value="<?php echo $estudianteArreglo['departamento2']; ?>"></td>
                                            <td><label>VILLA :</label></td>
                                            <td><input name="villa_2" value="<?php echo $estudianteArreglo['villa2']; ?>"></td>
                                            <td><label>COMUNA :</label></td>
                                            <td><input name="comuna_2" value="<?php echo $estudianteArreglo['comuna2']; ?>"></td>
                                            <td><label>REGION :</label></td>
                                            <td><input name="region_2" value="<?php echo $estudianteArreglo['region2']; ?>"></td>
                                        </tr>-->
                                    </tbody>
                                </table>
                            </div>
                        </div> 

                        
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>Becas</h5>  
                            </div>
                             
                            <div class="panel-body bloque table-responsive">
                                <table border="0" class="table"> 
                                    <thead>
                                        <tr>
                                            <th>%  OBTENIDO <?php echo date("Y",( strtotime(date("Y")))); ?></th>
                                            <th>NOMBRE BECA</th>
                                        </tr>
                                    </thead>
                                    <tbody>     
                                    <tr>
                                    <th><input id="aprobacion_calificacion" style="background-color: yellow;" value="<?php echo $aprobacion;?>"></th>
                                    <th><input id="aprobacion_nombre" style="background-color: yellow;" value="<?php echo $aprobacion_nombre;?>"></th>
                                        </tr>
                  
                                    </tbody>
                                </table>
    
                            </div>
                        </div>

                    </div>
                        
                        <input type="hidden" id="rut"  value="<?php echo $estudianteArreglo['rut']; ?>">
                        <input type="hidden" id="id_beca" value="<?php echo $beca; ?>">     
                        <input type="hidden" id="beca" value="<?php if($beca!=""){echo $nombre_beca2;}else{echo 'TODAS';} ?>">     
                        
                </form>
                    
                </div>

        </div>  

        





        <?php
        include("../footer.php");
        ?>
        <script type="text/javascript" src="../js/funciones/formulario.js"></script>
        <script type="text/javascript" src="../js/extras/CalificaBeca.js"></script>
        
      
    </body>
</html>
<?php

?>
