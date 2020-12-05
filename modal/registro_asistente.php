	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="nuevo_asistente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo Asistente</h4>
		  </div>
		  <div class="modal-body">
                      <!--editar esto a el modulo a agregar-->
			<form class="form-horizontal" method="post" id="guardar_asistente" name="guardar_asistente">
			<div id="resultados_ajax"></div>
                        
                          <div class="form-group">
				<label for="rut" class="col-sm-3 control-label">Rut</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="rut_asistente" name="rut_asistente" placeholder="Rut asistente" required onkeyup="validar(this.id)" maxlength="12">
                                    <span class="error-rut"></span>
				</div>
			  </div>
                        
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="nombre_asistente" name="nombre_asistente" placeholder="Nombre asistente" required>
				</div>
			  </div>
			 
				  
			  <div class="form-group">
				<label for="apellido_asistente" class="col-sm-3 control-label">Apellido</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="apellido_asistente" name="apellido_asistente" placeholder="Apellido asistente">
				</div>
			  </div>
			  <div class="form-group">
				<label for="mail_asistente" class="col-sm-3 control-label">Mail</label>
				<div class="col-sm-8">
                                    <input type="email" class="form-control" id="mail_asistente" name="mail_asistente" placeholder="Mail asistente">
				</div>
			  </div>
                            <div class="form-group">
				<label for="tipo_usuario" class="col-sm-3 control-label">Tipo asistente</label>
				<div class="col-sm-8">
                                    <select class='form-control' name='tipo_asistente' id='tipo_asistente' required>
                                      <option value="">Selecciona tipo</option>  
                                        <?php
                                        $tipo_Asistente = TipoAsistente::recuperarTipoAsistente($con);


                                        while ($rw = sqlsrv_fetch_array($tipo_Asistente)) {
                                            ?>
                                            <option value="<?php echo $rw['id_tipo']; ?>"><?php echo $rw['nombre_tipo']; ?></option>			
                                            <?php
                                        }
                                        ?>

                                    </select> 
				</div>
                            </div>
                        <div class="form-group">
				<label for="password_nueva" class="col-sm-3 control-label">Contraseña</label>
				<div class="col-sm-8">
				  <input type="password" class="form-control" id="clave_nueva" name="clave_nueva" placeholder="Contraseña" pattern=".{6,}" title="Contraseña ( min . 6 caracteres)" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="password_repetir" class="col-sm-3 control-label">Repite contraseña</label>
				<div class="col-sm-8">
				  <input type="password" class="form-control" id="clave_repetir" name="clave_repetir" placeholder="Repite contraseña" pattern=".{6,}" required>
				</div>
			  </div>

		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary guardar_datos" onclick="registrarAsistente()">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>