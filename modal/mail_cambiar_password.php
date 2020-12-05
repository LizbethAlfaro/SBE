<!-- Modal -->
	<div class="modal fade" id="cambiar_clave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i>Restablecer contraseña</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_estudiante" name="guardar_estudiante">
			<div id="resultado_ajax"></div>
                         <div class="form-group">
				<label for="rut" class="col-sm-3 control-label">Rut</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="rut_recuperar" name="rut" placeholder="Rut" required maxlength="12" onkeyup="validar(this.id)">
                                    <span class="error-rut"></span>
				</div>
			  </div>
		
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button id="guardar_datos_estudiante" type="button" class="btn btn-primary guardar_datos" onclick="notificarCambiar_contraseña()" >Notificar por mail</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>