	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="editar_asistente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar Asistente </h4>
		  </div>
		  <div class="modal-body">
<!-- cambiar nombre de form para agregar  modulos-->
    <form class="form-horizontal" method="post" id="editar_asistente" name="editar_asistente">
			<div id="resultados_ajax2"></div>
                        <div class="form-group">
				<label for="mod_id" class="col-sm-3 control-label">Rut</label>
				<div class="col-sm-8">
                                    <input class="form-control" type="text" name="mod_id" id="mod_id" readonly>
				</div>
			  </div>
			  <div class="form-group">
				<label for="mod_nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_nombre" name="mod_nombre"  required>	
				</div>
			  </div>
			    
			  <div class="form-group">
				<label for="mod_apellido" class="col-sm-3 control-label">Apellido</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="mod_apellido" name="mod_apellido" >
				</div>
			  </div>
                        
                        <div class="form-group">
				<label for="mod_mail" class="col-sm-3 control-label">Mail</label>
				<div class="col-sm-8">
                                    <input type="email" class="form-control" id="mod_mail" name="mod_mail">
				</div>
			  </div>
     
                            <div class="form-group">
				<label for="tipo_usuario" class="col-sm-3 control-label">Tipo asistente</label>
				<div class="col-sm-8">
                                    <select class='form-control' name='mod_tipo_asistente' id='mod_tipo_asistente' required>
                                      <option value="">Selecciona tipo</option>  
                                        <?php
                                        $tipo_Asistente = TipoAsistente::recuperarTipoAsistente($con);


                                        while ($rw = sqlsrv_fetch_array($tipo_Asistente)) {
                                            ?>
                                            <option value="<?php echo $rw['id_tipo']; ?>"><?php echo $rw['nombre_tipo']; ?></option>			
                                            <?php
                                        }
                                        ?>
                                        ?>

                                    </select> 
				</div>
                            </div>
                    
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="actualizar_datos" onclick="editarAsistente()">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>