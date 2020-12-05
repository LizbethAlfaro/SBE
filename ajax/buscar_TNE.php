<?php

/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
        include '../Clases/Integrante.php';
        
        
	$grupo_familiar="active";
	$title=" TNE | UGM";
        
        //clases para select
        include '../Clases/UMAS.php';
        include '../Clases/Proceso_realizar.php';
        include '../Autenticacion/FormatoRut.php';
        include '../Clases/Scape.php';

if (empty($_POST['rut'])) {

    $errors[] = "No ha ingresado un rut";     
} else if (!empty($_POST['rut'])) {        
        
        $rut=$_POST['rut'];
        $rut_spsgsd=sinPuntosGuionRut( $rut );
       
  //      $rut="186633180";
       
       

    
        
$estudianteQuery = UMAS::TNE($rut_spsgsd,$con);
$estudianteArreglo;

if($estudianteQuery){
 $contador_estudiante = sqlsrv_num_rows($estudianteQuery); 
 
 while ($estudianteCursor = sqlsrv_fetch_array($estudianteQuery)) {
    $estudianteArreglo = array(
        "RUT"                   => $estudianteCursor['RUT'],
        "DV"                    => $estudianteCursor['DV'],
        "PATERNO"               => Scape::ms_escape_string($estudianteCursor['PATERNO']),
        "MATERNO"               => Scape::ms_escape_string($estudianteCursor['MATERNO']),
        "NOMBRE"                => Scape::ms_escape_string($estudianteCursor['NOMBRE']),
        "FECHA"                 => $estudianteCursor['FECHA'],
        "ID_CARRERA"            => $estudianteCursor['ID_CARRERA'],
        "CARRERA"               => $estudianteCursor['CARRERA'],
        "JORNADA"               => $estudianteCursor['JORNADA'],
        "FECHA_MATRICULA"       => $estudianteCursor['FECHA_MATRICULA'],
        "ESTADO_ACADEMICO"      => $estudianteCursor['ESTADO_ACADEMICO'],
        "SITUACION_ACADEMICA"   => $estudianteCursor['SITUACION_ACADEMICA'],
        "MAIL_INSTITUCIONAL"    => $estudianteCursor['MAIL_INSTITUCIONAL'],
        "CELULAR"               => $estudianteCursor['CELULAR'],
    );
}
}
else{
  $contador_estudiante = -1 ;   
}




  if($contador_estudiante>0){      
        
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("../head.php"); ?>
    </head>
    
    <body>
     <?php 
     include("../modal/mensaje_tne_rut.php"); 
     ?>   
  
        
        <div class="container">
            
            
 
             <div class="panel panel-success">
  
                  
                        <div class="panel-heading">
   
                            <h4><i class='glyphicon glyphicon-home'></i> Datos de Estudiante </h4>
                        </div>   
                        
                 
                 <div class="panel-body table-responsive">
<div id="resultados_ajax"></div>
   
                                <table border="0" class="table">
                                    <tbody>
                                        <tr>
                                            <td><label>NOMBRE :              </label></td>
                                            <td colspan="3"><label><?php echo $estudianteArreglo['NOMBRE']." ".$estudianteArreglo['PATERNO']." ".$estudianteArreglo['MATERNO'];?></label></td>
                                            <td><label>RUT :              </label></td>
                                            <td colspan="3"><label><?php echo $estudianteArreglo['RUT']."-".$estudianteArreglo['DV']; ?></label></td>
                                            <input type="hidden" id="rut_estudiante" value="<?php echo $estudianteArreglo['RUT']."-".$estudianteArreglo['DV']; ?>">
                                        </tr>
                                        <tr>
                                            <td><label>CARRERA :</label></td>
                                            <td colspan="3"><label><?php echo $estudianteArreglo['ID_CARRERA']." - ".$estudianteArreglo['CARRERA']; ?></label></td>
                                            <td><label>JORNADA:</label></td>
                                            <td colspan="3"><label><?php echo $estudianteArreglo['JORNADA']; ?></label></td>
                                        </tr>
                                        <tr>
                                            <td><label>AÑO&nbspINGRESO:</label></td>
                                            <td colspan="1"><label><?php echo date('d-m-Y', strtotime($estudianteArreglo['FECHA'])); ?></label></td>
                                            <td><label>CELULAR:</label></td>
                                            <td colspan="1"><label><?php echo $estudianteArreglo['CELULAR'];?></label></td>
                                            <td><label>E-MAIL :</label></td>
                                            <td colspan="1"><label><?php echo $estudianteArreglo['MAIL_INSTITUCIONAL']; ?></label></td>
                                        </tr>
                                        <tr>
                                            <td><label>ESTADO&nbspACADEMICO:</label></td>
                                            <td colspan="3"><label><?php echo $estudianteArreglo['ESTADO_ACADEMICO']; ?></label></td>
                                            <td><label>SITUACION ACADEMICA:</label></td>
                                            <td colspan="3"><label><?php echo $estudianteArreglo['SITUACION_ACADEMICA'];?></label></td>
                                            
                                        </tr>
                                        
                                        
                                         <tr>
                                             <td><label>TNE <?php echo date('Y',strtotime('-0 year')); ?>:</label></td>
                                             <td colspan="6">
                                                  <?php
                                                                $proceso = ProcesoRealizar::recuperarProcesoRealizar($con);

                                                                $color = "";
                                                                
                                                                while ($rw = sqlsrv_fetch_array($proceso)) {
                                                                    
                                                                    switch ($rw['id_proceso']){
                                                                        case 1:$color = "";
                                                                            break;
                                                                        case 2:$color = "";
                                                                            break;
                                                                        case 3:$color = "";
                                                                            break;
                                                                    }    
                                                                ?>
                                            
                                                 <label class="form-control" style="background-color:<?php echo $color?>;">
                                                     <input class="form-group" id="proceso" type="radio" value="<?php echo $rw['id_proceso'];?>" name="proceso">
                                                     <?php echo Scape::ms_escape_string($rw['nombre_proceso']); ?>
                                                 </label>
                                                 <label class="form-control" style="background-color:<?php echo $color?>;">
                                                    <?php echo Scape::ms_escape_string($rw['descripcion_proceso']); ?>   
                                                 </label>
                                               
                                                  <?php
                                                  }
                                                  ?>
                                             </td>
                                         
<!--                                             <td colspan="3">
                                                 <div class="form-group text-center">
                                                     <label>PROCESO A REALIZAR:</label>
               
                                                 </div>
                                                 <div class="form-group">
                                                    <div class="">
                                                        <select class='form-control' name='proceso' id='proceso' >
                                                            <option value="">Seleccione Proceso</option>
                                                                <?php
                                                                $proceso = ProcesoRealizar::recuperarProcesoRealizar($con);

                                                                while ($rw = sqlsrv_fetch_array($proceso)) {
                                                                ?>
                                                            <option value="<?php echo $rw['id_proceso']; ?>"><?php echo Scape::ms_escape_string($rw['nombre_proceso']); ?></option>			
                                                                <?php
                                                                }
                                                                ?>
                                                        </select> 	  
                                                    </div>
                                                </div>  

                                             </td>-->

                                        </tr>
                                        <tr>
                                            <td colspan="8">
                                                 <div class="form-group text-center">
                                                     <label>INGRESE FONO</label>
               
                                                 </div>
                                                 <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input id="fono" class="form-control" minlength="14" required> 	  
                                                    </div>
                                                </div>  
                                                 
                                                 
                                                 
                                             </td>
                                             </tr>
                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="12"><button class="btn-block form-control btn-success" onclick="registrarTNE()">Enviar</button></td>
                                        </tr>
                                    </tbody>
                                </table>
      
                            </div>
                        </div> 
                 
                 
                </div>


     
         <?php
  }
     if ($contador_estudiante==0&& $rut!="") {
        ?>
    <script>    
$( document ).ready(function() {
    $('#mensaje_tne_rut').modal('toggle')
});
</script>    
        <?php
    }
  ?>
     
       
  
            </div>
                <div style="margin-bottom: 100px;"></div>
            <hr>
            <?php
            include("../footer.php");
            ?>
     
     

    </body>
</html>

    <?php
    }
  ?>