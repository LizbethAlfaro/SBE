<?php
session_start();
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}


$active_informacion = "active";
$title = " Informacion | UGM";
//include $_SERVER['DOCUMENT_ROOT']."/BecasBeneficios/config/db.php";
//include $_SERVER['DOCUMENT_ROOT']."/BecasBeneficios/config/conexion.php";
//include $_SERVER['DOCUMENT_ROOT']."/BecasBeneficios/Clases/Informe.php";
//include $_SERVER['DOCUMENT_ROOT']."/BecasBeneficios/Clases/Horario.php";

include $_SERVER['DOCUMENT_ROOT']."/config/db.php";
include $_SERVER['DOCUMENT_ROOT']."/config/conexion.php";
include $_SERVER['DOCUMENT_ROOT']."/Clases/ResultadoFinal.php";
include $_SERVER['DOCUMENT_ROOT']."/Clases/Estudiante.php";
include  $_SERVER['DOCUMENT_ROOT'].'/Autenticacion/FormatoRut.php';
include $_SERVER['DOCUMENT_ROOT'].'/Clases/Scape.php';
$rut = $_SESSION['rut_estudiante'];

//$rut="19.055.963-7";
//$rut="17.002.792-2";


$rut_2=sinPuntosGuionRut( $rut );
$result_beca= ResultadoFinal::resultadoBeca($rut_2,$con);

if($result_beca){
$contador_beca= sqlsrv_num_rows($result_beca);   
}else{
$contador_beca=0;        
}
//
//$becas = array('Beca 1','beca 2');
//$comentarios = array('blabla','bleble');
$tipo2="panel-danger";
$tipo1="panel-success";

$condicion = ""; //where...

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

//TIPO DE SOLICITUD
include './Clases/Solicitud.php';
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

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("head.php"); ?>
    </head>
    <body>
<?php
        include("navbar.php");
        
//        if ($validar>0 && $validar<4) {
//         header("location: informacion.php");
//        exit;
//        }
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
        
        <div class="container text-center" style="text-justify: auto;" >
            <div class="panel panel-success">
                <div class="panel-body">
                    <h1>BECAS INTERNAS UGM  <?php echo date('Y');?></h1>
                    <h3>Unidad Financiamiento Estudiantil. UFE</h3>
  
                </div>
 <h4>Datos del <?php echo $tipoArreglo['tipo']; ?>    </h4>
 <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>IDENTIFICACION DEL ESTUDIANTE</h5>  
                            </div> 
                            <div class="panel-body table-responsive">

                                <table border="0" class="table text-left">
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
                                            <td colspan="3"><input name="fechaIng" value="<?php echo $estudianteArreglo['fechaIng']; ?>"></td>
                                            <td><label>FECHA&nbspDE&nbspNACIMIENTO:</label></td>
                                            <td colspan="3"><input name="fechaNac" value="<?php echo date('d-m-Y', strtotime($estudianteArreglo['fechaNac'])); ?>"></td>
                                   
                                        </tr>    
                                        <tr>
                                            <td><label>FONO (CASA):</label></td>
                                            <td><input name="fono" value="<?php echo $estudianteArreglo['fono']; ?>"></td>
                                            <td><label>CELULAR:</label></td>
                                            <td><input name="movil" value="<?php echo $estudianteArreglo['movil']; ?>"></td>
                                            <td><label>E-MAIL :</label></td>
                                            <td colspan="3"><input name="mail" value="<?php echo $estudianteArreglo['mail']; ?>"></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div> 


<div class="panel-body">
    
<div id="loader"></div>
<div class="table">
    
                        <?php
                        if($contador_beca>0){
                        $indice=0;    
                        while($rw=sqlsrv_fetch_array($result_beca)){
                            
 if(strcmp($rw[4],"BENEFICIARIO")==0){
 $tipo=$tipo1;    
 }else{
 $tipo=$tipo2;     
 }                           
 ?>               
                        <div class="panel <?php echo $tipo; ?>">
                            <div class="panel-heading" 
                                         onclick=" 
        if ($('#soc<?php echo $indice ?>').is(':visible')) {
        $('#soc<?php echo $indice ?>').css('display','none');
        } else {
        $('#soc<?php echo $indice ?>').css('display','block');
        }">
                                        <h3 class="panel-title">Beca Socioeconómica UGM</h3>
                                    </div>
                                      <div id="soc<?php echo $indice ?>" class="panel-body" style="display: none">
                                         <div>Su estado es : <?php echo $rw[4]; ?> </div>
                                         <div>Porcentaje Recibido <?php echo $rw[5]; ?>% </div>
                                          <div> <?php echo Scape::ms_escape_string($rw[6]); ?> </div>
                                        <div>Apelación: <?php echo Scape::ms_escape_string($rw[7]); ?> </div>
                                        <!--Apelacion-->                            
<?php
 if(strcmp($rw[7],"No procede")==0 or strcmp($rw[7],"Para poder apelar debe estar matriculado")==0){



 }else{
?>
<!--                                        <br>                                        
<p>Este formulario puede ser impreso y completado por el alumno para posteriormente escanearlo para envió por email o en su defecto autocompletar desde herramientas de pdf incorporando su firma como foto y guardar en la misma extensión pdf para enviarlo por email a​ ufe@ugm.cl​. No se revisarán solicitudes fuera del plazo establecido.</p> <p>Recuerde que deacuerdo a su causal de apelación deberá adjuntar la documentación solicitada. </p>                                        
<a class="btn" href="descarga.php?ruta=3">Apelacion</a>   -->
<?php
 } 
?>
                                      
                                       
                                    </div>
   
                                </div>
<!--ALIMENTACION-->  
<?php
 if(strcmp($rw[8],"BENEFICIARIO")==0){
 $tipo=$tipo1;    
 }else{
 $tipo=$tipo2;     
 } 
?>     
                        <div class="panel <?php echo $tipo; ?>">
                                    <div class="panel-heading" 
                                         onclick=" 
        if ($('#alim<?php echo $indice ?>').is(':visible')) {
        $('#alim<?php echo $indice ?>').css('display','none');
        } else {
        $('#alim<?php echo $indice ?>').css('display','block');
        }">
 <h3 class="panel-title">Beca Alimentación</h3>
                                    </div>
                                     <div id="alim<?php echo $indice ?>" class="panel-body" style="display: none">
                                        <div>Su estado es : <?php echo $rw[8]; ?> </div>
                                        <div> <?php echo Scape::ms_escape_string($rw[9]); ?> </div>
                                    </div>
                                </div>
 
    
    
<!--MANTENCION-->    
                                        <?php
 if(strcmp($rw[10],"BENEFICIARIO")==0){
 $tipo=$tipo1;    
 }else{
 $tipo=$tipo2;     
 } 
?>     
    
                        <div class="panel <?php echo $tipo; ?>">
                                    <div class="panel-heading" 
                                         onclick=" 
        if ($('#man<?php echo $indice ?>').is(':visible')) {
        $('#man<?php echo $indice ?>').css('display','none');
        } else {
        $('#man<?php echo $indice ?>').css('display','block');
        }">

 
                                        <h3 class="panel-title">Beca Mantención</h3>
                                    </div>
                                      <div id="man<?php echo $indice ?>" class="panel-body" style="display: none">
                                        <div>Su estado es : <?php echo $rw[10]; ?></div>     
                                        <div> <?php echo Scape::ms_escape_string($rw[11]); ?> </div>
                                    </div>
                                </div>





<!--DEPORTIVA-->
                                        <?php
 if(strcmp($rw[12],"BENEFICIARIO")==0){
 $tipo=$tipo1;    
 }else{
 $tipo=$tipo2;     
 } 
?> 
                        <div class="panel <?php echo $tipo; ?>">
                                    <div class="panel-heading" 
                                         onclick=" 
        if ($('#dep<?php echo $indice ?>').is(':visible')) {
        $('#dep<?php echo $indice ?>').css('display','none');
        } else {
        $('#dep<?php echo $indice ?>').css('display','block');
        }">
                                        
                                        
 
                                        
                                        <h3 class="panel-title">Beca Deportiva</h3>
                                    </div>
                                      <div id="dep<?php echo $indice ?>" class="panel-body" style="display: none">
                                        <div>Su estado es : <?php echo $rw[12]; ?> </div>  
                                        <div>Porcentaje Recibido <?php echo $rw[13]; ?>% </div>
                                        <div> <?php echo Scape::ms_escape_string($rw[14]); ?> </div>
                                        <div>Apelacion: <?php echo Scape::ms_escape_string($rw[15]); ?> </div>
                                                                                <!--Apelacion-->                            
<?php
 if(strcmp($rw[15],"No procede")==0 or strcmp($rw[15],"Para poder apelar debe estar matriculado")==0){



 }else{
?>
<!--                                                                                    <br>      
<p>Este formulario puede ser impreso y completado por el alumno para posteriormente escanearlo para envió por email o en su defecto autocompletar desde herramientas de pdf incorporando su firma como foto y guardar en la misma extensión pdf para enviarlo por email a​ ufe@ugm.cl​  No se revisarán solicitudes fuera del plazo establecido.</p> <p>Recuerde que deacuerdo a su causal de apelación deberá adjuntar la documentación solicitada. </p>                                                                                
<a class="btn" href="../descarga.php?ruta=3">Apelacion</a>   -->
<?php
 } 
?>
    
                                      
                                    </div>
                                </div>
                        

                                        
<!--INTEGRACION-->                                        
                                        
                                        <?php
 if(strcmp($rw[16],"BENEFICIARIO")==0){
 $tipo=$tipo1;    
 }else{
 $tipo=$tipo2;     
 } 
?> 
                        <div class="panel <?php echo $tipo; ?>">
                                    <div class="panel-heading" 
                                         onclick=" 
        if ($('#int<?php echo $indice ?>').is(':visible')) {
        $('#int<?php echo $indice ?>').css('display','none');
        } else {
        $('#int<?php echo $indice ?>').css('display','block');
        }">
                                        
                                        <h3 class="panel-title">Beca Gabriela Mistral Integración Cultural</h3>
                                    </div>
                                      <div id="int<?php echo $indice ?>" class="panel-body" style="display: none">
                                        <div>Su estado es : <?php echo $rw[16]; ?> </div>
                                        <div> <?php echo Scape::ms_escape_string($rw[17]); ?> </div>
                                    </div>
                                </div>




<!--LIDER SOCIAL-->
                                        <?php
 if(strcmp($rw[18],"BENEFICIARIO")==0){
 $tipo=$tipo1;    
 }else{
 $tipo=$tipo2;     
 } 
?> 
                        <div class="panel <?php echo $tipo; ?>">
                                    <div class="panel-heading" 
                                         onclick=" 
        if ($('#lid<?php echo $indice ?>').is(':visible')) {
        $('#lid<?php echo $indice ?>').css('display','none');
        } else {
        $('#lid<?php echo $indice ?>').css('display','block');
        }">
                                        
                                        
 
                                        
                                        <h3 class="panel-title">Beca Gabriela Mistral Líder Social</h3>
                                    </div>
                                      <div id="lid<?php echo $indice ?>" class="panel-body" style="display: none">
                                        <div>Su estado es : <?php echo $rw[18]; ?> </div>
                                        <div> <?php echo Scape::ms_escape_string($rw[19]); ?> </div>
                                    </div>
                                </div>  
<!--ESPECIAL-->
                                        <?php
 if(strcmp($rw[20],"BENEFICIARIO")==0){
 $tipo=$tipo1;    
 }else{
 $tipo=$tipo2;     
 } 
?>  
                        <div class="panel <?php echo $tipo; ?>">
                                    <div class="panel-heading" 
                                         onclick=" 
        if ($('#esp<?php echo $indice ?>').is(':visible')) {
        $('#esp<?php echo $indice ?>').css('display','none');
        } else {
        $('#esp<?php echo $indice ?>').css('display','block');
        }">
                                        
                                        

                                        
                                        <h3 class="panel-title">Beca Gabriela Mistral Necesidades Educativas Especiales</h3>
                                    </div>
                                      <div id="esp<?php echo $indice ?>" class="panel-body" style="display: none">
                                        <div>Su estado es : <?php echo $rw[20]; ?> </div>
                                        <div> <?php echo Scape::ms_escape_string($rw[21]); ?> </div>
                                     
                                    </div>
                                </div>
<!--<div class="panel panel-default">
<div class="panel panel-default col-sm-6">
<div class="panel-body firmas"></div>     
<div class="panel-heading text-center">FIRMA&nbspY&nbspHUELLA&nbspDEL&nbspESTUDIANTE</div>
</div>         
                                         
                                          
<div class="panel panel-default col-sm-6">
<div class="panel-body firmas">
</div>    
<div class="panel-heading text-center">FIRMA&nbspY&nbspTIMBRE&nbspUFE</div>
</div>
</div>-->



<a href="convertirPDF_resultados.php" class="btn btn-info">Descargar Comprobante</a>
</div> 
                        
                        
 <?php
 $indice++;                        
 
                        }}else{
?>                            
    <div class="panel-default">
        <div class="panel-heading">
        </div>
  
            <div>No cuenta con resultados</div>                                                            
                                    </div>
                                </div>
                            

                </div>
       
            </div>

        </div>
        <footer style="margin-bottom: 100px;"></footer>
        <hr>
        <?php
        include("footer.php");
        ?>
        <script type="text/javascript">
        $('input').attr('readonly', true)   
        </script>
    </body>
</html>
<?php
                        }
?>