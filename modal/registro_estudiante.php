	<?php
		if (isset($con))
		{  
	?>
	<!-- Modal -->
	<div class="modal fade" id="modalEstudiante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i>Registrar Estudiante</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_estudiante" name="guardar_estudiante">
			<div id="resultados_ajax"></div>
                         <div class="form-group">
				<label for="rut" class="col-sm-3 control-label">Rut</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="rut_estudiante" name="rut" placeholder="Rut" required maxlength="12" onkeyup="validar(this.id)">
                                    <span class="error-rut"></span>
				</div>
			  </div>
                     
<!--                        
                        
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombres</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre_estudiante" name="nombre" placeholder="Nombres" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="apellido" class="col-sm-3 control-label">Apellidos</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="apellido_estudiante" name="apellido" placeholder="Apellidos" required>
				</div>
			  </div>
                        
                      
                        
                        
                          <div class="form-group">
				<label for="genero" class="col-sm-3 control-label">Genero</label>
				<div class="col-sm-8">
					<select class='form-control' name='genero' id='genero' required>
						<option value="">Selecciona un Genero</option>
                                       <?php
                                        
                                        $genero = Genero::recuperarGenero($con);
                                  
                                        while ($rw = sqlsrv_fetch_array($genero)) {
                                            ?>
                                            <option value="<?php echo $rw['id_genero']; ?>"><?php echo $rw['nombre_genero']; ?></option>			
                                            <?php
                                        }

                                        ?>
                                         
		
					</select>
         
				</div>
			  </div>
                        
                         <div class="form-group">
				<label for="fechaNac" class="col-sm-3 control-label">Fecha Nacimiento</label>
				<div class="col-sm-8">
                                    <input type="date" class="form-control" id="fechaNac" name="fechaNac" placeholder="fechaNac" required>		  
				</div>
			  </div>
                        
                         <div class="form-group">
				<label for="carrera" class="col-sm-3 control-label">Carrera</label>
				<div class="col-sm-8">
					<select class='form-control' name='carrera' id='carrera' required>
						<option value="">Selecciona una carrera</option>
				        <?php
                                        
                                        $carrera = Carrera::recuperarCarrera("",$con,"","","");

                                                                         
                                        while ($rw = sqlsrv_fetch_array($carrera)) {
                                            ?>
                                            <option value="<?php echo $rw['id_carrera']; ?>"><?php echo $rw['nombre_carrera']; ?></option>			
                                            <?php
                                        }

                                        ?>
                                         
					</select>
                                 
				</div>
			  </div>
                         
                          <div class="form-group">
				<label for="fechaIng" class="col-sm-3 control-label">Fecha Ingreso</label>
				<div class="col-sm-8">
                                   <?php
                                            $cont = date('Y');
                                        ?>
                                    <select id="fechaIng" name="fechaIng" class='form-control' required="">
                                        <option value="">Seleccione una fecha</option>
                                            <?php while ($cont >= 1950) { ?>
                                                <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                                                <?php $cont = ($cont - 1);
                                            } ?>
                                        </select>	  
				</div>
			  </div>
                        
			  <div class="form-group">
				<label for="email" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
				  <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
				</div>
			  </div>

-->
			  <div class="form-group">
				<label for="password_nueva" class="col-sm-3 control-label">Contraseña</label>
				<div class="col-sm-8">
				  <input type="password" class="form-control" id="password_nueva" name="password_nueva" placeholder="Contraseña" pattern=".{6,}" title="Contraseña ( min . 6 caracteres)" required>
				</div>
			  </div>
			  <div class="form-group">
				<label for="password_repetir" class="col-sm-3 control-label">Repite contraseña</label>
				<div class="col-sm-8">
				  <input type="password" class="form-control" id="password_repetir" name="password_repetir" placeholder="Repite contraseña" pattern=".{6,}" required>
				</div>
			  </div>
			 
			  

			 
                   
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button id="guardar_datos_estudiante" type="button" class="btn btn-primary guardar_datos" onclick="registrarEstudiante()" >Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>