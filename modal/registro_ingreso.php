	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="nuevoIngreso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo Ingreso </h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_ingreso" name="guardar_ingreso">
			<div id="resultados_ajax_ingreso"></div>
                        		  
			  <div class="form-group">
				<label for="ingreso" class="col-sm-3 control-label">Ingreso Mensual</label>
				<div class="col-sm-8">
                                    <input type="number" class="form-control" id="ingreso" name="ingreso" placeholder="Ingreso Mensual (con descuentos legales)" maxlength="255">				  
				</div>
			  </div> 

                         <div class="form-group">
				<label for="tipo_ingreso" class="col-sm-3 control-label">Tipo de Ingreso</label>
				<div class="col-sm-8">
					<select class='form-control' name='tipo_ingreso' id='tipo_ingreso' required>
						<option value="">Selecciona un tipo</option>
					<?php
                                        $tipo = TipoIngreso::recuperarTipoIngreso($con);
                                        while ($rw = sqlsrv_fetch_array($tipo)) {
                                            ?>
                                            <option value="<?php echo $rw['id_tipoIngreso']; ?>"><?php echo $rw['nombre_tipoIngreso']; ?></option>			
                                            <?php
                                        }
                                        ?>
					</select>			  
				</div>
			  </div>
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="guardar_datos" onclick="registrarIngreso()">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
        

	<?php
		}
	?>