<?php

	include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/Solicitud.php';
        include '../Clases/Estudiante.php';
        include '../Clases/Extra.php';
        include '../Clases/Scape.php';
        
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
	if($action == 'ajax'){
        include '../modal/historial_informes.php';
        include '../modal/registro_observacion.php';
        include '../modal/modulo_extra.php';
        
		// escaping, additionally removing everything that could be (html/javascript-) code
                $q              = $_REQUEST['q'];
                $rut_estudiante = Scape::ms_escape_string("");
                $estado_sol     = Scape::ms_escape_string($_REQUEST['estado_sol']);
                $tipo_sol       = Scape::ms_escape_string($_REQUEST['tipo_sol']);
                
//                $fecha_ini = Scape::ms_escape_string($_REQUEST['fecha_ini']);
//                $fecha_fin = Scape::ms_escape_string($_REQUEST['fecha_fin']);
		$aColumns = array('estud.rut_estudiante','estud.nombre_estudiante','estud.apellido_estudiante');//Columnas de busqueda
                $sWhere="";
                
                if($estado_sol!=""){
                $sWhere .=" AND sol.estado = '$estado_sol' "; 
                }
                if($tipo_sol!=""){
                $sWhere .=" AND sol.tipo = '$tipo_sol' ";     
                }
                
		if ( $q != "" )
		{
			$sWhere .= " AND(";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}

	        $result= Solicitud::recuperarSolicitud($rut_estudiante,$sWhere,$con);
		$numrows = sqlsrv_num_rows($result);

		$query = $result;
		//loop through fetched data
		if ($numrows>0){

			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="success">
                                    <th class="col-sm-2">Rut</th>
					<th>Nombre</th>
					<th>Apellido</th>
                                        <th>Carrera</th>
                                        <th>Tipo</th>
                                        <th>Estado</th>
                                        <th class="col-sm-2">Acredita</th>
                                        <th>Extra</th>
					<th>Actualizacion Reciente</th>
                                        <th class="col-sm-2">Accion</th> 
					
				</tr>
				<?php
                               

                                        while ($row=sqlsrv_fetch_array($query)){
						$rut_estudiante     = $row['rut_estudiante'];
                                                $tipo_solicitud     = $row['nombre_tipo_solicitud'];
                                                $carrera_estudiante = $row['carrera_estudiante'];
                                                $id_estado_solicitud  = $row['estado'];
                                                $acredita = $row['nombre_asistente']." ".$row['apellido_asistente'];
                                                $estado_solicitud   = $row['nombre_estado_solicitud'];
						$fecha_agregado     = date('d/m/Y', strtotime($row['fecha']));
                                                
                                        //        $result_estudiante= Estudiante::recuperarEstudiante($rut_estudiante, $con,"","","");
                                        //        $row_estudiante=sqlsrv_fetch_array($result_estudiante);
                                                
                                        $result_extra = Extra::recuperarExtra($rut_estudiante, $con);

                                        if ($result_extra) {
                                            $contador_extra = sqlsrv_num_rows($result_extra);
                                        } else {
                                            $contador_extra = 0;
                                        }
                                        
                                        if($contador_extra>0){
                                        $extra="OK";    
                                        }else{
                                        $extra="";       
                                        }
						
					?>
					<tr>
						
                                            <td><?php echo $rut_estudiante;       ?><input name="rut[]" type="hidden" value="<?php echo $rut_estudiante;?>"></td>
						<td><?php echo Scape::ms_escape_string($row['nombre_estudiante']);   ?></td>
                                                <td><?php echo Scape::ms_escape_string($row['apellido_estudiante']); ?></td>
                                                <td><?php echo $carrera_estudiante;     ?></td>
                                                <td><?php echo $tipo_solicitud;     ?></td>
                                                <td><?php echo $estado_solicitud;     ?></td>
                                                <td><?php echo $acredita;     ?></td>
                                                <td><?php echo $extra;     ?></td>
						<td><?php echo $fecha_agregado;     ?></td>
                                                <td>
                                                    <a class="btn btn-default" href="../admin/acreditarDatosPersonales.php?rut_estudiante=<?php echo $rut_estudiante;?>" title="Datos Personales"><i class="glyphicon glyphicon-user"></i></a> 
                                                     <?php
                                                     if($id_estado_solicitud!=3){
                                                     ?>  
                                                    <a class="btn btn-default" href="../admin/acreditar2.php?rut_estudiante=<?php echo $rut_estudiante;?>" title="Rectificar" ><i class="glyphicon glyphicon-eye-open"></i></a>
                                                      <?php
                                                    }
                                                     ?>  
                                                <?php
                                                if($id_estado_solicitud==2){
                                                ?>  
                                                    <a class="btn btn-default" href="../admin/acreditarResumenSolicitud.php?rut_estudiante=<?php echo $rut_estudiante;?>" title="Acreditar"><i class="glyphicon glyphicon-ok"></i></a>
                                                <?php
                                                }
                                                ?>
                                                <?php
                                                if($id_estado_solicitud>0){
                                                ?>    
                                                    <a class="btn btn-default" data-toggle="modal" data-target="#historial_informes" data-rut="<?php echo $rut_estudiante;?>" title="Informe en PDF"><i class="glyphicon glyphicon-print"></i></a>
                                                  
                                                <?php
                                                }
                                                ?>
                                                 <a class="btn btn-default" data-toggle="modal" data-target="#registro_observacion" data-rut="<?php echo $rut_estudiante;?>" title="Observacion"><i class="glyphicon glyphicon-apple"></i></a>
                                                 <a class="btn btn-default" data-toggle="modal" data-target="#modulo_extra" data-rut="<?php echo $rut_estudiante;?>" title="Modulo Extra"><i class="glyphicon glyphicon-bed"></i></a>    
                                                 <a class="btn btn-warning" href="Adminresultados.php?rut=<?php echo $rut_estudiante;?>"><i class="glyphicon glyphicon-align-justify"></i></a> 
                                                </td>
                                        <!--        
					<td class='text-right'>
						<a href="#" class='btn btn-default' title='Editar Asistente' data-id='<?php echo $id_asistente;?>'  data-nombre='<?php echo $nombre_asistente;?>'  data-apellido='<?php echo $apellido_asistente;?>'  data-mail='<?php echo $mail_asistente;?>' data-tipo='<?php echo $id_tipo_asistente;?>' data-toggle="modal" data-target="#editar_asistente"><i class="glyphicon glyphicon-edit"></i></a> 
                                                <a href="#" class='btn btn-default' title='Cambiar Clave' data-id='<?php echo $id_asistente;?>' data-toggle="modal" data-target="#editar_asistente_clave"><i class="glyphicon glyphicon-cog"></i></a>
                                                <a href="#" class='btn btn-default' title='Deshabilitar Asistente' onclick="deshabilitarAsistente('<?php echo $id_asistente; ?>')"><i class="glyphicon glyphicon-trash"></i></a>
					</td>
					-->	
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=4><span class="pull-right">
					<?php
				//	 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
                            
                            <script>
                                
$('#historial_informes').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
  
    var rut        =   button.data('rut')        


        $.ajax({
			type: "POST",
			url: "../ajax/buscar_informes.php?action=ajax",
			data: 'rut_estudiante='+rut,
			 beforeSend: function(objeto){
			  },
			success: function(datos){
                        modal.find('.modal-body #tabla_informes').html(datos);  
		//	$("#tabla_informes").html(datos);
                        console.log(datos)
		  }
	});
    
    var modal = $(this)
    
    modal.find('.modal-body #rut_informes')          .val(rut)

})



$('#registro_observacion').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal

                    var rut = button.data('rut')
console.log('Buscando Observacion')

                    $.ajax({
                        type: "POST",
                        url: "../ajax/buscar_observacion.php?action=ajax",
                        data: 'rut=' + rut,
                        beforeSend: function (objeto) {
                        },
                        success: function (datos) {
                            modal.find('.modal-body #resultados_ajax_tabla').html(datos);
                            //	$("#tabla_informes").html(datos);
                            console.log(datos)
                        }
                    });

                    var modal = $(this)

                    modal.find('.modal-body #rut_observacion').val(rut)

})


$('#modulo_extra').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal

                    var rut = button.data('rut')
console.log('Buscando Todo')

 var modal = $(this)

 modal.find('.modal-body #rut_observacion').val(rut)

                    $.ajax({
                        type: "POST",
                        url: "../ajax/buscar_extra.php?action=ajax",
                        data: 'rut=' + rut,
                        beforeSend: function (objeto) {
                          modal.find('.modal-body #resultados_ajax_tabla_extra').html('<img src="../img/ajax-loader.gif"> Cargando...');
                        },
                        success: function (datos) {
                            modal.find('.modal-body #resultados_ajax_tabla_extra').html(datos);
                            //	$("#tabla_informes").html(datos);
                            console.log(datos)
                        }
                    });

                   

})
     
     
                            </script>
                            
			</div>
			<?php
		}
	}
?>