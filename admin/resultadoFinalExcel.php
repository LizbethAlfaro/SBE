<?php
	include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
        
        include '../Clases/ResultadoFinal.php';

        include '../Clases/Observacion.php';
        include '../Clases/Integrante.php';
        include '../Clases/Extra.php';
        include '../Clases/GrupoFamiliar.php';
        include '../Clases/Ingreso.php';
        include '../Clases/IntegranteIngreso.php';
        include '../Clases/IntegrantePensionado.php';
        include '../Clases/Percap.php';
        include '../Clases/Formula.php';
        include '../Clases/Jefe.php';
        include '../Clases/Scape.php';

        $ponderado_acad = 0.25;
        $ponderado_econ = 0.40;
        $ponderado_salu = 0.20;
        $ponderado_terr = 0.15;


            
//Estudiantes
$condicion="";


            $result_resultado= ResultadoFinal::recuperarResultado($condicion,$con);
            $contador_resultado=0;
            
            if($result_resultado){
              $contador_resultado= sqlsrv_num_rows($result_resultado);  
            }
     
if ($contador_resultado>0){
			
         
			?>




<!--<div >-->

<table class="table table-striped" border="1">
    <tr>
    <th colspan="4" class="no-border text-center" >ESTUDIANTE</th>
    <th colspan="5" class="info no-border text-center" >TERRITORIAL Y HABITACIONAL</th>
    <th colspan="7" class="success no-border text-center">SALUD</th>
    <th colspan="10" class="warning no-border text-center">ECONOMICA</th>
    <th colspan="7" class="danger no-border text-center">ACADÉMICA</th>
    <th colspan="2" class="dark no-border text-center">RESULTADO</th>

    </tr>
    <thead>
    <th >N°</th>    
    <th >RUT</th>
    <th >NOMBRE</th>
    <th >APELLIDO</th>
    
    <!--TERRITORIAL Y HABITACIONAL-->
    <th class="info" >TENENCIA</th>
    <th class="info" >T.VIVIENDA</th>
    <th class="info" >DISTANCIA</th>
    <th class="info" >TOTAL</th>
    <th class="info" >PONDERACIÓN(<?php echo $ponderado_terr*100; ?>%)</th>
    
    <!--SALUD-->
    <th class="success">ENFERMEDADES</th>
    <th class="success">PREV.SALUD</th>
    <th class="success">FACTOR</th>
    <th class="success">DUPLICIDAD</th>
    <th class="success">SUGERENCIA</th>
    <th class="success">TOTAL</th>
    <th class="success">PONDERACIÓN(<?php echo $ponderado_salu*100; ?>%)</th>
    
    <!--ECONOMICA-->
    <th class="warning">INTEGRANTES</th>
    <th class="warning">I.INGRESOS</th>
    <th class="warning">I.PENSIÓN</th>
    <th class="warning">ESTUDIOS</th>
    <th class="warning">PERCAP</th>
    <th class="warning">TRAMO</th>
    <th class="warning">FORMULA</th>
    <th class="warning">JEFE</th>
    <th class="warning">TOTAL</th>
    <th class="warning">PONDERACIÓN(<?php echo $ponderado_econ*100; ?>%)</th>
    
    <!--ACADEMICA-->
    <th class="danger">AA</th>
    <th class="danger">CALIFICACIÓN</th>
    <th class="danger">BENEFICIOS</th>
    <th class="danger">PUEBLO</th>
    <th class="danger">NACIONALIDAD</th>
    <th class="danger">TOTAL</th>
    <th class="danger">PONDERACIÓN(<?php echo $ponderado_acad*100; ?>%)</th>

    <th class="dark">TOTAL</th>
    <th class="dark">TOTAL PONDERADO</th>
    </thead>
    
</table>
    
<div id="div1">
    <table class="table table-striped" border="1" >
    <tbody >
       
            <?php
            $cont=1;
            while ($row = sqlsrv_fetch_array($result_resultado)) {

            $rut_estudiante = $row['rut_estudiante'];
            $nombre_estudiante = $row['nombre_estudiante'];
            $apellido_estudiante = $row['apellido_estudiante'];
            
            $tenencia = $row['TENENCIA'];
            $tipo_vivienda = $row['TIPO VIVIENDA'];
            $genero = $row['GENERO'];
            $estado_civil = $row['EST.CIVIL'];
            $prevision_salud = $row['PREV.SALUD'];
            $nivel_educacional = $row['N.EDUC'];
            $actividad = $row['ACTIVIDAD'];
            
            $condicion_ob="";
            
            $result_observacion= Observacion::recuperarObservacion($rut_estudiante,$condicion_ob,$con);
            $contador_observacion=0;
            
            if($result_observacion){
              $contador_observacion= sqlsrv_num_rows($result_observacion);  
            }
            
    $observacionArreglo = array(
        "duplicidad"        => 0,
        "otro_miembro"      => 0,
        "factor"            => 0,
        "tramo"             => 0,
        "distancia"         => 0
    );
            
            if($contador_observacion>0){            
while ($observacionCursor = sqlsrv_fetch_array($result_observacion)) {
    $observacionArreglo = array(
        "duplicidad"        => $observacionCursor['duplicidad puntaje'],
        "otro_miembro"      => $observacionCursor['otro puntaje'],
        "factor"            => $observacionCursor['factor puntaje'],
        "tramo"             => $observacionCursor['tramo puntaje'],
        "distancia"         => $observacionCursor['distancia puntaje']
    );
}
            }

//jefe
                
    $result_extra = Extra::recuperarExtra($rut_estudiante, $con);
    
    if($result_extra){
       $contador_extra = sqlsrv_num_rows($result_extra);
    }else{
       $contador_extra=0; 
    }
    
    $extraArreglo = array(
                "rut_estudiante"        => "",
                "nacionalidad"          => "",
                "pueblo"                => "",
                "formula_ministerial"   => "0",
                "egresos_totales"       => "",
                "jefe_hogar"            => "",
                "contrato_jefe"         => "",
                "prev_social_jefe"      => "",
                "ingreso_jefe"          => "0",
                "beneficio"             => "",
                "sugerencia_asist"      => "",
                "discapacidad"          => "",
                "calificacion"          => "",
                "avance"                => "",
                "puntaje_sug"           => "0",
                "puntaje_av"            => "0",
                "puntaje_cal"           => "0",
                "puntaje_ben"           => "0",
                "puntaje_pue"           => "0",
                "puntaje_nac"           => "0"
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
                "puntaje_sug"           => $extraCursor['puntaje_sug'],
                "puntaje_av"            => $extraCursor['puntaje_av'],
                "puntaje_cal"           => $extraCursor['puntaje_cal'],
                "puntaje_ben"           => $extraCursor['puntaje_ben'],
                "puntaje_pue"           => $extraCursor['puntaje_pue'],
                "puntaje_nac"           => $extraCursor['puntaje_nac'],
            );
        }    
    }        
                
            $result_integrante_jefe = Integrante::recuperarIntegrante($rut_estudiante,$extraArreglo['jefe_hogar'],$con,"","","");           
            $integrante_jefe= sqlsrv_num_rows($result_integrante_jefe);

            $sumatoria_jefe=0;
            while($integrante_jefeCursor = sqlsrv_fetch_array($result_integrante_jefe)){
   
                $sumatoria_jefe+= $integrante_jefeCursor['puntaje_prev'];

                }                  

                    
            
//enfermedades
            $result_integrante = Integrante::recuperarIntegrante($rut_estudiante,"",$con,"","","");           
            $integrantesTotales= sqlsrv_num_rows($result_integrante);

            $sumatoria=0;
            $sumatoria_nivel=0;
            $total_anual=0;
            $relacion_jefe=0;

            while($integranteCursor = sqlsrv_fetch_array($result_integrante)){
                  $rut_integrante=$integranteCursor['rut_integrante'];
                  $sumatoria+= $integranteCursor['puntaje'];
                  $sumatoria_nivel+= $integranteCursor['puntaje_nivel'];
                  
                  
                  if($extraArreglo['jefe_hogar']==$integranteCursor['rut_integrante']){
                     $relacion_jefe = $integranteCursor['relacion_integrante'];
                  }
                //Ingreso de integrantes $$$
                    $result_ingreso2 = Ingreso::recuperarIngreso($rut_integrante, $rut_estudiante, $con, "", "", "");
                    $row2 = sqlsrv_fetch_array($result_ingreso2);

                    if ($row != null) {
                        $sueldo = $row2['sueldo_integrante'];
                        $pension = $row2['pension_integrante'];
                        $honorario = $row2['honorario_integrante'];
                        $retiro = $row2['retiro_integrante'];
                        $dividendo = $row2['dividendo_integrante'];
                        $interes = $row2['interes_integrante'];
                        $ganancia = $row2['ganancia_integrante'];
                        $pension_alim = $row2['pension_alim_integrante'];
                        $actividad = $row2['actividad_integrante'];
                    } else {
                        $sueldo = 0;
                        $pension = 0;
                        $honorario = 0;
                        $retiro = 0;
                        $dividendo = 0;
                        $interes = 0;
                        $ganancia = 0;
                        $pension_alim = 0;
                        $actividad = 0;
                    }
                    $total_anual = $total_anual + $total = $sueldo + $pension + $honorario + $retiro + $dividendo + $interes + $ganancia + $pension_alim + $actividad;
                    $percap = round(($total_anual/$integrantesTotales));
                    
//PERCAP
          
            $result_percap_var= Percap::recuperarPercap($con);
            $acum_percap=0;
             while($percap_varCursor = sqlsrv_fetch_array($result_percap_var)){
//               echo "inferior :".$percap_varCursor['inferior'].'<br>';
//               echo "superior :".$percap_varCursor['superior'].'<br>';
//               echo "puntaje :".$percap_varCursor['puntaje'].'<br>';
                 
                 $acum_percap+=$percap_varCursor['puntaje'];
                 
if($percap>=$percap_varCursor['inferior'] && $percap<=$percap_varCursor['superior']){
   $puntaje_percap= $percap_varCursor['puntaje'];
}

                }                    
                    
                    
                    
                    
}


        
$promedio = round($sumatoria/$integrantesTotales,2);
$promedio_nivel=round($sumatoria_nivel/$integrantesTotales,2);
                
//prevision promedio 
//integrante                
            $result_integrante_estudiante = Integrante::recuperarIntegrante($rut_estudiante,$rut_estudiante,$con,"","","");           
            $integrantes_estudiantesTotales= sqlsrv_num_rows($result_integrante_estudiante);

            $sumatoria_estudiante=0;
            while($integrante_estudianteCursor = sqlsrv_fetch_array($result_integrante)){
               
               
                $sumatoria_estudiante+= $integrante_estudianteCursor['puntaje_prev'];
                echo $sumatoria_estudiante;
                }
                $promedio_prev=($sumatoria_jefe+$sumatoria_estudiante)/2;   

          
            
            
//grupo familiar cantidad            
            $result_grupo= GrupoFamiliar::recuperarGrupo($con);
            
             while($grupoCursor = sqlsrv_fetch_array($result_grupo)){
               
               
                 if($integrantesTotales==$grupoCursor['id_grupo']){
                    $puntaje_grupo = $grupoCursor['puntaje'];

                 }

                }

//integrantes con ingreso            
            $result_con_ingresos= IntegranteIngreso::integrantesConIngresos($rut_estudiante,$con);
            $integrantes_con_ingresos= sqlsrv_num_rows($result_con_ingresos);

           
            $result_ingreso= IntegranteIngreso::recuperarIntegranteIngreso($con);
            
             while($ingresoCursor = sqlsrv_fetch_array($result_ingreso)){
               
               
                 if($integrantes_con_ingresos==$ingresoCursor['id_integrante_ingreso']){
                    $puntaje_ingreso = $ingresoCursor['puntaje'];
                 }else if($integrantes_con_ingresos>=5 && $ingresoCursor['id_integrante_ingreso']==5){
                   $puntaje_ingreso = $ingresoCursor['puntaje'];
                  
                 }
                 

                }

//integrantes con pension           
            $result_con_pension= IntegrantePensionado::integrantesConPension($rut_estudiante,$con);
            $integrantes_con_pension= sqlsrv_num_rows($result_con_pension);

           
            $result_pension= IntegrantePensionado::recuperarIntegrantePensionado($con);
            
             while($pensionCursor = sqlsrv_fetch_array($result_pension)){
               
               
                 if($integrantes_con_ingresos==$pensionCursor['id_integrante_pensionado']){
                    $puntaje_pension = $pensionCursor['puntaje'];
                 }else if($integrantes_con_ingresos>=5 && $pensionCursor['id_integrante_pensionado']==5){
                   $puntaje_pension = $pensionCursor['puntaje'];
                  
                 }
                 

                }                


//formula ministerial
                
            $result_formula= Formula::recuperarFormula($con);
        
             while($formulaCursor = sqlsrv_fetch_array($result_formula)){
                 
                 if($extraArreglo['formula_ministerial']==$formulaCursor['id_formula']){
                    $puntaje_formula =  $formulaCursor['puntaje'];
                 }else{
                 $puntaje_formula=0;    
                 }

                }

//jefe de hogar
                
            $result_jefe= Jefe::recuperarJefe($con);

//obtener actividad de jefe
    //        echo 'relacion: '.$relacion_jefe;            
      //      echo 'relacion: '.$relacion_jefe;
            
            switch ($relacion_jefe){
                case 1;//conyuge
                    $jefe = 5;
                    break;
                case 2;//padre
                    $jefe = 1;
                    break;
                case 3;//madre
                    $jefe = 2;
                    break;
                    $jefe = 0;
                case 4;//hermano
                    $jefe = 7;
                    break;
                case 5;
                    $jefe = 8;
                    break;
                case 6;//hijo
                    $jefe = 7;
                    break;
                case 7;
                    $jefe = 4;
                    break;
                case 8;//tio
                     $jefe = 6;
                    break;
                case 9;
                    $jefe = 8;
                    break;
                case 10;//primo
                     $jefe = 6;
                    break;
                case 11;//conyuge
                     $jefe = 5;
                    break;
                case 12;
                    $jefe = 8;
                    break;
                case 13;//cuñado
                     $jefe = 6;
                    break;
                default :
                    $jefe = 8;
                    break;
            }

            
            
             while($jefeCursor = sqlsrv_fetch_array($result_jefe)){
                 
                 
                if($jefe==1 && $jefeCursor['id_jefe']==1){
                $puntaje_jefe=$jefeCursor['puntaje']; 
                }elseif($jefe==2 && $jefeCursor['id_jefe']==2){
                $puntaje_jefe=$jefeCursor['puntaje'];  
                }elseif($jefe==3 && $jefeCursor['id_jefe']==3){
                $puntaje_jefe=$jefeCursor['puntaje'];   
                }elseif($jefe==4 && $jefeCursor['id_jefe']==4){
                $puntaje_jefe=$jefeCursor['puntaje'];  
                }elseif($jefe==5 && $jefeCursor['id_jefe']==5){
                $puntaje_jefe=$jefeCursor['puntaje'];   
                }elseif($jefe==6 && $jefeCursor['id_jefe']==6){
                $puntaje_jefe=$jefeCursor['puntaje'];   
                }elseif($jefe==7 && $jefeCursor['id_jefe']==7){
                $puntaje_jefe=$jefeCursor['puntaje'];   
                }elseif($jefe==8 && $jefeCursor['id_jefe']==8){
                $puntaje_jefe=$jefeCursor['puntaje']; 
                }

             }
                   
        ?>
        
        
         <tr>
            <td><?php echo $cont++?></td>
            <td><?php echo $rut_estudiante; ?></td>
            <td><?php echo $nombre_estudiante; ?></td>
            <td><?php echo $apellido_estudiante; ?></td>
            
            <!--TERRITORIAL Y HABITACIONAL-->
            <td><?php echo str_replace('.',',',$tenencia); ?></td>
            <td><?php echo str_replace('.',',',$tipo_vivienda); ?></td>
            <td><?php echo str_replace('.',',',$observacionArreglo['distancia']); ?></td>
            <td><?php $p_terr=($tenencia+$tipo_vivienda+$observacionArreglo['distancia']);echo str_replace('.',',',$p_terr) ?></td>
            <td><?php 
            $t_terr= round($p_terr*$ponderado_terr,2);
            echo str_replace('.',',',$t_terr);?>
            </td>
            
            <!--SALUD-->
           
            <td><?php echo str_replace('.',',',$promedio); ?></td>
            <td><?php echo str_replace('.',',',$promedio_prev); ?></td>
            <td><?php echo str_replace('.',',',$observacionArreglo['factor']); ?></td>
            <td><?php echo str_replace('.',',',$observacionArreglo['duplicidad']); ?></td>
            <td><?php echo str_replace('.',',',$extraArreglo['puntaje_sug']); ?></td>
            <td><?php $p_salu=($promedio+$promedio_prev+$observacionArreglo['factor']+$observacionArreglo['duplicidad']+$extraArreglo['puntaje_sug']);echo str_replace('.',',',$p_salu); ?></td>
            <td><?php $t_salu= round($p_salu*$ponderado_salu,2);echo str_replace('.',',',$t_salu);?></td>
            
         
            
            <!--ECONOMICA-->
            <td><?php echo str_replace('.',',',$puntaje_grupo); ?></td>
            <td><?php echo str_replace('.',',',$puntaje_ingreso); ?></td>
            <td><?php echo str_replace('.',',',$puntaje_pension); ?></td>
            <td><?php echo str_replace('.',',',$promedio_nivel); ?></td>
            <td><?php echo str_replace('.',',',$puntaje_percap); ?></td>
            <td><?php echo str_replace('.',',',$observacionArreglo['tramo']); ?></td>
            <td><?php echo str_replace('.',',',$puntaje_formula); ?></td>
            <td><?php echo str_replace('.',',',$puntaje_jefe); ?></td>
            <td><?php $p_econ=($puntaje_grupo+$puntaje_ingreso+$puntaje_pension+$promedio_nivel+$puntaje_percap+$observacionArreglo['tramo']+$puntaje_formula+$puntaje_jefe); echo str_replace('.',',',$p_econ);?></td>
            <td><?php $t_econ =round($p_econ*$ponderado_econ,2);  echo str_replace('.',',',$t_econ);?></td>
            
            <!--ACADEMICA-->
            <td><?php echo $extraArreglo['puntaje_av']; ?></td>
            <td><?php echo $extraArreglo['puntaje_cal']; ?></td>
            <td><?php echo $extraArreglo['puntaje_ben']; ?></td>
            <td><?php echo $extraArreglo['puntaje_pue']; ?></td>
            <td><?php echo $extraArreglo['puntaje_nac']; ?></td>
            <td><?php $p_acad=($extraArreglo['puntaje_av']+$extraArreglo['puntaje_cal']+$extraArreglo['puntaje_ben']+$extraArreglo['puntaje_pue']+$extraArreglo['puntaje_nac']);  echo str_replace('.',',',$p_acad); ?></td>
            <td><?php $t_acad=round($p_acad*$ponderado_acad,2);echo str_replace('.',',',$t_acad); ?></td>
            
            <!--RESULTADO-->
            <td><?php echo str_replace('.',',',($p_terr+$p_salu+$p_econ+$p_acad)); ?></td>
            <td><?php echo str_replace('.',',',($t_terr+$t_salu+$t_econ+$t_acad)); ?></td>
            
               
            
         </tr>        
            <?php
            }
            ?>
       
    </tbody>
</table>
</div>
<!--</div>-->


 <!--ENCABEZADOS FIJOS--> 

<style>
#div1 {
    overflow:scroll;
    height:600px;
    width: 7001px;
    overflow-x: hidden;
}


th, td {
min-width: 200px;
width: 200px;
max-width: 200px;
}


</style>
<!--ENCABEZADOS FIJOS-->
    <?php
        
        }
        
        
     
     
     
        
        

?>