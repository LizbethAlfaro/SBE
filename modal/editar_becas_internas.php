	<?php
		if (isset($con))
		{
  
	?>
	<!-- Modal -->
	<div class="modal fade" id="editar_becas_internas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i>Editar Estudiante</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_estudiante_beca" name="guardar_estudiante_beca">
			<div id="resultados_ajax_becas"></div>
                         <div class="form-group">
				<label for="rut" class="col-sm-3 control-label">Rut</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="rut_estudiante_beca" name="rut" placeholder="Rut" required maxlength="12"  readonly="">
                                    <span class="error-rut"></span>
				</div>
			  </div>

                         <div class="form-group">
				<label for="fechaNac" class="col-sm-3 control-label">Fecha Nacimiento</label>
				<div class="col-sm-8">
                                    <input type="date" class="form-control" id="fechaNac" name="fechaNac" placeholder="fechaNac" required>		  
				</div>
			  </div>



                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label for="direccion" class="col-sm-3 control-label">Direccion</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" required >
                                </div>
                                <label></label>
                                <div class="col-sm-2">
                                    <input type="number" class="form-control" id="numero" name="numero" placeholder="N°" required >
                                </div>
                                <label></label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="departamento" name="departamento" placeholder="Dpto. o casa" required >
                                </div>
                                <label></label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="villa" name="villa" placeholder="Villa (opcional)" >
                                </div> 

                            </div>
                            <div class="form-group">
                                <label for="region" class="col-sm-3 control-label">Region</label>
                                <div class="col-sm-8">
                                    <select class='form-control' name='region' id='region_beca' onchange="recuperarComunaBecaAdmin()" required>
                                      <option value="">Selecciona region</option>  
                                        <?php
                                        $region = Region::recuperarRegion($con);


                                        while ($rw = sqlsrv_fetch_array($region)) {
                                            ?>
                                            <option value="<?php echo $rw['id_region']; ?>"><?php echo $rw['nombre_region']; ?></option>			
                                            <?php
                                        }
                                        ?>

                                    </select>                            
                                    
                            </div>
                            </div>
                            <div class="form-group">
                                <label for="comuna" class="col-sm-3 control-label">Comuna</label>
                                <div class="col-sm-8">
                                    <select class='form-control' name='comuna' id='comuna_beca' required>
                                        <option value="">Selecciona comuna</option>
                                        <?php
                                        $comuna = Comuna::recuperarComuna($con);
                                        while ($rw = sqlsrv_fetch_array($comuna)) {
                                            $rw['region'];
                                            ?>
                                            <option value="<?php echo $rw['id_comuna']; ?>"><?php echo $rw['nombre_comuna']; ?></option>			
                                            <?php
                                        }
                                        ?>
                                    </select>
                                 
                                </div>
                            </div>

                            <legend class="text-center">Telefonos</legend>
                            <div class="form-group">
                                <label for="fono" class="col-sm-3 control-label">Telefono (opcional)</label>
                                <div class="col-sm-8">
                                     <input type="tel" class="form-control" id="fono" name="fono"  required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="movil" class="col-sm-3 control-label">Movil (obligatorio)</label>
                                <div class="col-sm-8">
                                     <input type="tel" class="form-control" id="movil" name="movil"  required>
                                </div>
                            </div>
                            

		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary guardar_datos" onclick="editarEstudianteBeca()" >Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        <script>
            $('#region_beca     option[value=<?php echo 13;?> ]').prop("selected", "selected");
            $('#region2_beca    option[value=<?php echo 0;?> ]').prop("selected", "selected");
            $('#comuna_beca     option[value=<?php echo 70?> ]').prop("selected", "selected");
            $('#comuna2_beca    option[value=<?php echo 0;?> ]').prop("selected", "selected");
           
            
            $(document).ready(function($) {
            $('#fono').mask("2-999-9999",{placeholder:"2-xxx-xxxx"});
                                    
            $('#movil').mask("569-999-999-99",{placeholder:"56x-xxx-xxxx-xx"});
                                    
            });
        </script>
         
        <script type="text/javascript" src="../js/funciones/comuna_becas.js"></script>
        <script type="text/javascript" src="../js/funciones/estudiante_becas.js"></script>

	<?php
		}
	?>