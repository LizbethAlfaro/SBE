<?php
	include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/Integrante.php';
        include '../Clases/Ingreso.php';
        
        include '../Clases/TipoVivienda.php';
        include '../Clases/Tenencia.php';
        include '../Clases/Genero.php';
        
        include '../Clases/Observacion.php';
        include '../Clases/EstadoCivil.php';
        include '../Clases/Prevision.php';
        include '../Clases/PrevisionSocial.php';
        include '../Clases/NivelEducacional.php';
        include '../Clases/ActividadIntegrante.php';
        include '../Clases/TipoContrato.php';
        include '../Clases/Enfermedad.php';
        include '../Clases/Nacionalidad.php';
        include '../Clases/Pueblo.php';
        include '../Clases/Discapacidad.php';
        
        include '../Clases/Vivienda.php';
        include '../Clases/Scape.php';
        include '../Clases/Solicitud.php';
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
	if($action == 'glosa'){
            
          //  $rut_estudiante="16.638.195-9";
            
//VIVIENDA            
            $result_vivienda= TipoVivienda::recuperarTipoVivienda($con);
            $contador_vivienda=0;
            
            if($result_vivienda){
              $contador_vivienda= sqlsrv_num_rows($result_vivienda);  
            }
     
		if ($contador_vivienda>0){
			
         
			?>
<div class="panel">
<table class="table">
<!--tabla mayor--> 

<!--FILA 1-->
<tr>
    <td colspan="3" class="text-center info">TERRITORIAL Y HABITACIONAL</td>    
 </tr>
<tr>
 
<td>    
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Tipo&nbspde&nbspVivienda</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_vivienda = sqlsrv_fetch_array($result_vivienda)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_tipoVivienda[]" value="<?php echo $cursor_vivienda['id_tipoVivienda']?>"> <?php echo $cursor_vivienda['nombre_tipoVivienda']?></td>  
                    <td><input name="puntaje_tipoVivienda[]" class="text-right" value="<?php echo $cursor_vivienda['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>    

			<?php
        }

//TENENCIA
        
            $result_tenencia= Tenencia::recuperarTenencia($con);
            $contador_tenencia=0;
            
            if($result_tenencia){
              $contador_tenencia= sqlsrv_num_rows($result_tenencia);  
            }
     
		if ($contador_tenencia>0){
			
         
			?>
<td>    
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Tenencia&nbspde&nbspVivienda</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_tenencia = sqlsrv_fetch_array($result_tenencia)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_tenencia[]" value="<?php echo $cursor_tenencia['id_tenencia']?>"><?php echo $cursor_tenencia['nombre_tenencia']?></td>  
                    <td><input name="puntaje_tenencia[]" class="text-right" value="<?php echo $cursor_tenencia['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>    

			<?php
        }
 
        
 

 //DISTANCIA
            $result_distancia= Observacion::recuperarDistancia($con);
            $contador_distancia=0;
            
            if($result_distancia){
              $contador_distancia= sqlsrv_num_rows($result_distancia);  
            }
     
            if ($contador_distancia>0){
                    
?>                

<td>
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Distancia</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_distancia = sqlsrv_fetch_array($result_distancia)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_distancia[]" value="<?php echo $cursor_distancia['id_distancia']?>"><?php echo $cursor_distancia['descripcion_distancia']?></td>  
                    <td><input name="puntaje_distancia[]" class="text-right" value="<?php echo $cursor_distancia['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>    
 <?php
            }
            ?>
</td>
</div>    
</tr>
 <!--FILA 1--> 
 
 
 <!--FILA 2-->
  <tr>
     <td colspan="3" class="text-center info">SALUD</td>    
 </tr>

<?php    
//ENFERMEDAD
        
            $result_enfermedad= Enfermedad::recuperarEnfermedad($con);
            $contador_enfermedad=0;
            
            if($result_enfermedad){
              $contador_enfermedad= sqlsrv_num_rows($result_enfermedad);  
            }
     
		if ($contador_enfermedad>0){
			
         
			?>
</td>
<td>
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Enfermedad</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_enfermedad = sqlsrv_fetch_array($result_enfermedad)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_enfermedad[]" value="<?php echo $cursor_enfermedad['id_enfermedad']?>"><?php echo Scape::ms_escape_string($cursor_enfermedad['nombre_enfermedad'])?></td>  
                    <td><input name="puntaje_enfermedad[]" class="text-right" value="<?php echo $cursor_enfermedad['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>    
    
</td>

 <?php
 //PREVISION DE SALUD
 
            $result_prevision= Prevision::recuperarPrevision($con);
            $contador_prevision=0;
            
            if($result_prevision){
              $contador_prevision= sqlsrv_num_rows($result_prevision);  
            }
     
            if ($contador_prevision>0){
                    
?>                

     
<td>
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Previsión de Salud</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_prevision = sqlsrv_fetch_array($result_prevision)){
                
                ?>
                <tr>
                    <td class="col-sm-4"><input type="hidden" name="id_prev_salud[]" value="<?php echo $cursor_prevision['id_prevision']?>"><?php echo $cursor_prevision['nombre_prevision']?></td>  
                    <td class="col-sm-4"><input name="puntaje_prev_salud[]" class="text-right" value="<?php echo $cursor_prevision['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>

			<?php
        }

//FACTOR
        
            $result_factor= Observacion::recuperarFactor($con);
            $contador_factor=0;
            
            if($result_factor){
              $contador_factor= sqlsrv_num_rows($result_factor);  
            }
     
		if ($contador_factor>0){
			
         
			?>
<td>    
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Factor&nbspde&nbspRiesgo</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_factor = sqlsrv_fetch_array($result_factor)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_factor[]" value="<?php echo $cursor_factor['id_factor']?>"><?php echo Scape::ms_escape_string($cursor_factor['descripcion_factor'])?></td>  
                    <td><input name="puntaje_factor[]" class="text-right" value="<?php echo $cursor_factor['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>    
 
			<?php
        }
 
   ?>     
 
</tr>
 
 <!--FILA 2-->
  
 
  <!--FILA 3-->
 
<?php
//DUPLICIDAD
        
            $result_duplicidad= Observacion::recuperarDuplicidad($con);
            $contador_duplicidad=0;
            
            if($result_duplicidad){
              $contador_duplicidad= sqlsrv_num_rows($result_duplicidad);  
            }
     
		if ($contador_duplicidad>0){
			
         
			?>
<td>    
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Duplicidad&nbspde&nbspFunciones</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_duplicidad = sqlsrv_fetch_array($result_duplicidad)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_duplicidad[]" value="<?php echo $cursor_duplicidad['id_duplicidad']?>"><?php echo Scape::ms_escape_string($cursor_duplicidad['descripcion_duplicidad'])?></td>  
                    <td><input name="puntaje_duplicidad[]" class="text-right" value="<?php echo $cursor_duplicidad['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>    

			<?php
        }
 
  //SUGERENCIA
  include '../Clases/Sugerencia.php';      
  
            $result_sugerencia= Sugerencia::recuperarSugerencia($con);
            $contador_sugerencia=0;
            
            if($result_sugerencia){
              $contador_sugerencia= sqlsrv_num_rows($result_sugerencia);  
            }
     
		if ($contador_sugerencia>0){
			
         
			?>
<td>    
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Sugerencia de asistente</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_sugerencia = sqlsrv_fetch_array($result_sugerencia)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_sugerencia[]" value="<?php echo $cursor_sugerencia['id_sugerencia']?>"><?php echo Scape::ms_escape_string($cursor_sugerencia['nombre_sugerencia'])?></td>  
                    <td><input name="puntaje_sugerencia[]" class="text-right" value="<?php echo $cursor_sugerencia['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>    
 <?php
                }
 ?>

</tr>
 
 <!--FILA 3--> 
 
 
<!--FILA 4-->


<tr>
    <td colspan="3" class="text-center info">ECONOMICA</td>    
</tr>

 <?php
                
 //GRUPO FAMILIAR
 include '../Clases/GrupoFamiliar.php';
            $result_grupo= GrupoFamiliar::recuperarGrupo($con);
            $contador_grupo=0;
            
            if($result_grupo){
              $contador_grupo= sqlsrv_num_rows($result_grupo);  
            }
     
		if ($contador_grupo>0){
 
 ?>
<tr>
<td>    
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Grupo Familiar</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_grupo = sqlsrv_fetch_array($result_grupo)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_grupo[]" value="<?php echo $cursor_grupo['id_grupo']?>"><?php echo Scape::ms_escape_string($cursor_grupo['descripcion_grupo'])?></td>  
                    <td><input name="puntaje_grupo[]" class="text-right" value="<?php echo $cursor_grupo['puntaje']?>"></td>
                </tr>
                <?php
                }
                
                }
                ?>
            </tbody>
</table>
</td> 
 <?php
 //INTEGRANTES CON INGRESOS
 include '../Clases/IntegranteIngreso.php';
            $result_integrante_ingreso= IntegranteIngreso::recuperarIntegranteIngreso($con);
            $contador_integrante_ingreso=0;
            
            if($result_integrante_ingreso){
              $contador_integrante_ingreso= sqlsrv_num_rows($result_integrante_ingreso);  
            }
     
		if ($contador_integrante_ingreso>0){
                    
                
?>
<td>
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Integrantes&nbspcon&nbspIngresos</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_integrante_ingreso = sqlsrv_fetch_array($result_integrante_ingreso)){
                
                ?>
                
                <tr>
                    <td class="col-sm-4"><input type="hidden" name="id_integrante_ingreso[]" value="<?php echo $cursor_integrante_ingreso['id_integrante_ingreso']?>"><?php echo Scape::ms_escape_string($cursor_integrante_ingreso['descripcion_integrante_ingreso'])?></td>  
                   <td class="col-sm-4"><input name="puntaje_integrante_ingreso[]" class="text-right" value="<?php echo $cursor_integrante_ingreso['puntaje']?>"></td>
                </tr>
                
                <?php
                }
                ?>
            </tbody>
</table>
</td>
 <?php
                }
 //INTEGRANTES PENSIONADOS
 include '../Clases/IntegrantePensionado.php';
            $result_integrante_pensionado= IntegrantePensionado::recuperarIntegrantePensionado($con);
            $contador_integrante_pensionado=0;
            
            if($result_integrante_pensionado){
              $contador_integrante_pensionado= sqlsrv_num_rows($result_integrante_pensionado);  
            }
     
		if ($contador_integrante_pensionado>0){
                    
                
?>
<td>
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Integrantes pensionados</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_integrante_pensionado = sqlsrv_fetch_array($result_integrante_pensionado)){
                
                ?>
                
                <tr>
                    <td class="col-sm-4"><input type="hidden" name="id_integrante_pensionado[]" value="<?php echo $cursor_integrante_pensionado['id_integrante_pensionado']?>"><?php echo Scape::ms_escape_string($cursor_integrante_pensionado['descripcion_integrante_pensionado'])?></td>  
                    <td class="col-sm-4"><input name="puntaje_integrante_pensionado[]" class="text-right" value="<?php echo $cursor_integrante_pensionado['puntaje']?>"></td>
                </tr>
            
                <?php
                }
                ?>
            </tbody>
</table>
</td> 
</tr>   

			<?php
        }

//NIVEL DE ESTUDIOS
        
            $result_estudios= NivelEducacional::recuperarNivelEducacional($con);
            $contador_estudios=0;
            
            if($result_estudios){
              $contador_estudios= sqlsrv_num_rows($result_estudios);  
            }
     
		if ($contador_estudios>0){
			
         
			?>
</tr>
<tr>
<td>    
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Nivel Educacional</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_estudios = sqlsrv_fetch_array($result_estudios)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_nivel[]" value="<?php echo $cursor_estudios['id_nivel']?>"><?php echo Scape::ms_escape_string($cursor_estudios['nombre_nivel'])?></td>  
                    <td><input name="puntaje_nivel[]" class="text-right" value="<?php echo $cursor_estudios['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
			<?php
        }

//PERCAP
            include '../Clases/Percap.php';
        
            $result_percap= Percap::recuperarPercap($con);
            $contador_percap=0;
            
            if($result_percap){
              $contador_percap= sqlsrv_num_rows($result_percap);  
            }
     
		if ($contador_percap>0){
			
         
			?>

<td>    
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Percap</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_percap = sqlsrv_fetch_array($result_percap)){
                
                ?>
                
                <tr>
                    <td><input type="hidden" name="id_percap[]" value="<?php echo $cursor_percap['id_percap']?>"><?php echo Scape::ms_escape_string($cursor_percap['inferior']." hasta ".$cursor_percap['superior'])?></td>  
                    <td><input name="puntaje_percap[]" class="text-right" value="<?php echo $cursor_percap['puntaje']?>"></td>
                </tr>
                
                <?php
                }
                ?>
            </tbody>
</table>
    



<?php
 //TRAMO
            $result_tramo= Observacion::recuperarTramo($con);
            $contador_tramo=0;
            
            if($result_tramo){
              $contador_tramo= sqlsrv_num_rows($result_tramo);  
            }
     
            if ($contador_tramo>0){
                    
?>

 

<td>
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Tramo</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_tramo = sqlsrv_fetch_array($result_tramo)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_tramo[]" value="<?php echo $cursor_tramo['id_tramo']?>"><?php echo $cursor_tramo['descripcion_tramo']?></td>  
                    <td><input name="puntaje tramo[]" class="text-right" value="<?php echo $cursor_tramo['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>
</tr>

<tr>
    			<?php
}
 
        
 
//FORMULA MINISTERIAL
include '../Clases/Formula.php';

            $result_formula= Formula::recuperarFormula($con);
            $contador_formula=0;
           
            
            if($result_formula){
              $contador_formula= sqlsrv_num_rows($result_formula);  
            }
               
                 
		if ($contador_formula>0){
			
         
			?>

<td>    
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Formula ministerial </th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_formula = sqlsrv_fetch_array($result_formula)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_formula[]" value="<?php echo $cursor_formula['id_formula']?>"><?php echo Scape::ms_escape_string($cursor_formula['descripcion_formula'])?></td>  
                    <td><input name="puntaje_formula[]" class="text-right" value="<?php echo $cursor_formula['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>





    			<?php
}
 
        
 
//JEFE DE HOGAR
include '../Clases/Jefe.php';     

            $result_jefe= Jefe::recuperarJefe($con);
            $contador_jefe=0;
           
            
            if($result_jefe){
              $contador_jefe= sqlsrv_num_rows($result_jefe);  
            }
               
                 
		if ($contador_jefe>0){
			
         
			?>

<td>    
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Jefe de Hogar </th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_jefe = sqlsrv_fetch_array($result_jefe)){
                
                ?>
               <tr>
                    <td><input type="hidden" name="id_jefe[]" value="<?php echo $cursor_jefe['id_jefe']?>"><?php echo Scape::ms_escape_string($cursor_jefe['descripcion_jefe'])?></td>  
                    <td><input name="puntaje_jefe[]" class="text-right" value="<?php echo $cursor_jefe['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>
			<?php
        }
 
        
 
//ACTIVIDAD
        
            $result_actividad= ActividadIntegrante::recuperarActividad($con);
            $contador_actividad=0;
           
            
            if($result_actividad){
              $contador_actividad= sqlsrv_num_rows($result_actividad);  
            }
               
                 
		if ($contador_actividad>0){
			
         
			?>
<td>    
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Actividad </th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_actividad = sqlsrv_fetch_array($result_actividad)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_actividad[]" value="<?php echo $cursor_actividad['id_actividad']?>"><?php echo Scape::ms_escape_string($cursor_actividad['nombre_actividad'])?></td>  
                    <td><input name="puntaje_actividad[]" class="text-right" value="<?php echo $cursor_actividad['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>
<tr>
			<?php
}

//Estado Civil     
            $result_estado= EstadoCivil::recuperarEstadoCivil($con);
            $contador_estado=0;
           
            
            if($result_estado){
              $contador_estado= sqlsrv_num_rows($result_estado);  
            }
               
                 
		if ($contador_estado>0){
			
         
			?>
<td>    
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Estado Civil</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_estado = sqlsrv_fetch_array($result_estado)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_estado[]" value="<?php echo $cursor_estado['id_estado']?>"><?php echo Scape::ms_escape_string($cursor_estado['nombre_estado'])?></td>  
                    <td><input name="puntaje_estado[]" class="text-right" value="<?php echo $cursor_estado['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td> 
<?php
 //PREVISION SOCIAL
 
            $result_prevision_social= PrevisionSocial::recuperarPrevisionSocial($con);
            $contador_prevision_social=0;
            
            if($result_prevision_social){
              $contador_prevision_social= sqlsrv_num_rows($result_prevision_social);  
            }
     
            if ($contador_prevision_social>0){
                    
?>
<td>
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Previsión Social</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_prevision_social = sqlsrv_fetch_array($result_prevision_social)){
                
                ?>
                <tr>
                    <td class="col-sm-4"><input type="hidden" name="id_prev_social[]" value="<?php echo $cursor_prevision_social['id_prevision_social']?>"><?php echo Scape::ms_escape_string($cursor_prevision_social['nombre_prevision_social'])?></td>  
                    <td class="col-sm-4"><input name="puntaje_prev_social[]" class="text-right" value="<?php echo $cursor_prevision_social['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>
<?php    
//TIPO CONTRATO
 
            $result_tipo_contrato= TipoContrato::recuperarTipoContrato($con);
            $contador_tipo_contrato=0;
            
            if($result_tipo_contrato){
              $contador_tipo_contrato= sqlsrv_num_rows($result_tipo_contrato);  
            }
     
            if ($contador_tipo_contrato>0){
                    
?> 
<td>
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Tipo de Contrato</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_tipo_contrato = sqlsrv_fetch_array($result_tipo_contrato)){
                
                ?>
                <tr>
                    <td class="col-sm-4"><input type="hidden" name="id_contrato[]" value="<?php echo $cursor_tipo_contrato['id_tipo_contrato']?>"><?php echo Scape::ms_escape_string($cursor_tipo_contrato['nombre_tipo_contrato'])?></td>  
                    <td class="col-sm-4"><input name="puntaje_contrato[]" class="text-right" value="<?php echo $cursor_tipo_contrato['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>        
</td>
</tr>
<tr>
    <td colspan="3" class="text-center info">ACADEMICO</td>
</tr>
<tr>
<td>      
  <?php       
 
//AVANCE
include '../Clases/Avance.php';
        
            $result_avance= Avance::recuperarAvance($con);
            $contador_avance=0;
           
            
            if($result_avance){
              $contador_avance= sqlsrv_num_rows($result_avance);  
            }
               
                 
		if ($contador_avance>0){
			
         
			?>

  
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Avance Academico</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_avance = sqlsrv_fetch_array($result_avance)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_avance[]" value="<?php echo $cursor_avance['id_avance']?>"><?php echo $cursor_avance['inferior']." hasta ".$cursor_avance['superior']?></td>  
                    <td><input name="puntaje_avance[]" class="text-right" value="<?php echo $cursor_avance['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>
<td>      
  <?php       
 
//CALIFICACION
include '../Clases/Calificacion.php';
        
            $result_calificacion= Calificacion::recuperarCalificacion($con);
            $contador_calificacion=0;
           
            
            if($result_calificacion){
              $contador_calificacion= sqlsrv_num_rows($result_calificacion);  
            }
               
                 
		if ($contador_calificacion>0){
			
         
			?>

  
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Calificacion</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_calificacion = sqlsrv_fetch_array($result_calificacion)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_calificacion[]" value="<?php echo $cursor_calificacion['id_calificacion']?>"><?php echo Scape::ms_escape_string($cursor_calificacion['descripcion_calificacion'])?></td>  
                    <td><input name="puntaje_calificacion[]" class="text-right" value="<?php echo $cursor_calificacion['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>
<td>      
  <?php       
 
//BENEFICIO DEL ESTADO
include '../Clases/Beneficio.php';  
        
            $result_beneficio= Beneficio::recuperarBeneficio($con);
            $contador_beneficio=0;
           
            
            if($result_beneficio){
              $contador_beneficio= sqlsrv_num_rows($result_beneficio);  
            }
               
                 
		if ($contador_beneficio>0){
			
         
			?>

  
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Beneficios del estado</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_beneficio = sqlsrv_fetch_array($result_beneficio)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_beneficio[]" value="<?php echo $cursor_beneficio['id_beneficio']?>"><?php echo Scape::ms_escape_string($cursor_beneficio['descripcion_beneficio'])?></td>  
                    <td><input name="puntaje_beneficio[]" class="text-right" value="<?php echo $cursor_beneficio['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>
</tr>
<td>      
  <?php       
 
//NACIONALIDAD
        
            $result_nacionalidad= Nacionalidad::recuperarNacionalidad($con);
            $contador_nacionalidad=0;
           
            
            if($result_nacionalidad){
              $contador_nacionalidad= sqlsrv_num_rows($result_nacionalidad);  
            }
               
                 
		if ($contador_nacionalidad>0){
			
         
			?>

  
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Nacionalidad </th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_nacionalidad = sqlsrv_fetch_array($result_nacionalidad)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_nacionalidad[]" value="<?php echo $cursor_nacionalidad['id_nacionalidad']?>"><?php echo Scape::ms_escape_string($cursor_nacionalidad['nombre_nacionalidad'])?></td>  
                    <td><input name="puntaje_nacionalidad[]" class="text-right" value="<?php echo $cursor_nacionalidad['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>
<?php
//PUEBLO
        
            $result_pueblo= Pueblo::recuperarPueblo($con);
            $contador_pueblo=0;
           
            
            if($result_pueblo){
              $contador_pueblo= sqlsrv_num_rows($result_pueblo);  
            }
               
                 
		if ($contador_pueblo>0){
			
         
			?>

<td>    
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Pueblo Originario</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_pueblo = sqlsrv_fetch_array($result_pueblo)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_pueblo[]" value="<?php echo $cursor_pueblo['id_pueblo']?>"><?php echo Scape::ms_escape_string($cursor_pueblo['nombre_pueblo'])?></td>  
                    <td><input name="puntaje_pueblo[]" class="text-right" value="<?php echo $cursor_pueblo['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>

<?php
//OTRO      
            $result_otro= Observacion::recuperarOtro($con);
            $contador_otro=0;
           
            
            if($result_otro){
              $contador_otro= sqlsrv_num_rows($result_otro);  
            }
               
                 
		if ($contador_otro>0){
			
         
			?>
<td>    
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Otro miembro Estudiando</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_otro = sqlsrv_fetch_array($result_otro)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_otro[]" value="<?php echo $cursor_otro['id_otro_miembro']?>"><?php echo Scape::ms_escape_string($cursor_otro['descripcion_otro_miembro'])?></td>  
                    <td><input name="puntaje_otro[]" class="text-right" value="<?php echo $cursor_otro['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>
<tr>
<?php
//DISCAPACIDAD
        
            $result_discapacidad= Discapacidad::recuperarDiscapacidad($con);
            $contador_discapacidad=0;
           
            
            if($result_discapacidad){
              $contador_discapacidad= sqlsrv_num_rows($result_discapacidad);  
            }
               
                 
		if ($contador_discapacidad>0){
			
         
			?>

<td>    
<table border="0" class="table">
            <thead>
                <tr>
                    <th class="col-sm-4">Discapacidad</th>
                    <th class="col-sm-4">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($cursor_discapacidad = sqlsrv_fetch_array($result_discapacidad)){
                
                ?>
                <tr>
                    <td><input type="hidden" name="id_discapacidad[]" value="<?php echo $cursor_discapacidad['id_discapacidad']?>"><?php echo Scape::ms_escape_string($cursor_discapacidad['nombre_discapacidad'])?></td>  
                    <td><input name="puntaje_discapacidad[]" class="text-right" value="<?php echo $cursor_discapacidad['puntaje']?>"></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
</table>
</td>
</tr>
 <!--FILA 4--> 
 
 
 
<!--tabla mayor--> 
</table>
</div>    
    <?php
        }  
        }        
        }        
        }        
        }        
        }        
        }        
        }        
        }
        }
        }
        }
        }
          
        
?>