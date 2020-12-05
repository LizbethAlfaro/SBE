	<?php
		if (isset($con))
		{
  
	?>
	<!-- Modal -->
	<div class="modal fade" id="registro_becas_internas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i>Registrar Estudiante</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_estudiante_beca" name="guardar_estudiante_beca">
			<div id="resultados_ajax_becas"></div>
                         <div class="form-group">
				<label for="rut" class="col-sm-3 control-label">Rut</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="rut_estudiante_beca" name="rut" placeholder="Rut" required maxlength="12" onkeyup="validar(this.id)" onblur="verificarBecas()">
                                    <span class="error-rut"></span>
				</div>
			  </div>
                     
                           <div class="form-group">
                                <label class="col-sm-3 control-label">Beca</label>
                                <div class="col-sm-8">
                                    <select class='form-control' name='beca' id='beca'required>
                                      <option value="">Selecciona beca</option>  
                                        <?php
                                        $beca = Beca::recuperarBeca("",$con);

                                        while ($rw = sqlsrv_fetch_array($beca)) {
                                       
                                            ?>
                                      <option  <?php if($rw['id_beca']=='6' or $rw['id_beca']=='7' or $rw['id_beca']=='8' or $rw['id_beca']=='10' or $rw['id_beca']=='11'){echo "style='display: none'";} ?>  value="<?php echo $rw['id_beca']; ?>"><?php echo $rw['nombre_beca']; ?></option>			
                                            <?php
                                            
                                        }
                                        ?>

                                    </select>                            
                                    
                            </div>
                       </div>
                        
<!--			  <div class="form-group">
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
			  </div>-->
                        
                      
                   
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
                                    <select class='form-control' name='region' id='region_beca' onchange="recuperarComunaBeca()" required>
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
                            

<!--                            <legend class="text-center">Direccion Periodo Academico <p><small>(Solo si el estudiante se traslada de residencia a Santiago)</small></p></legend>-->

<!--                            <div class="form-group">
                                <label for="direccion2" class="col-sm-3 control-label">Direccion</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="direccion2_beca" name="direccion2" placeholder="Direccion">
                                </div>
                                <label></label>
                                <div class="col-sm-1">
                         
                                    <input type="number" class="form-control" id="numero2_beca" name="numero2" placeholder="N°" required>
                                </div>
                                <label></label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="departamento2_beca" name="departamento2" placeholder="Dpto. o casa">
                                </div>
                                <label></label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="villa2_beca" name="villa2" placeholder="Villa (opcional)" required>
                                </div> 

                            </div>

                             <div class="form-group">
                                <label for="region2" class="col-sm-3 control-label">Region</label>
                                <div class="col-sm-8">
                                    <select class='form-control' name='region2' id='region2_beca' onchange="recuperarComuna2Beca()" required>
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
                                <label for="comuna2" class="col-sm-3 control-label">Comuna</label>
                                <div class="col-sm-8">
                                    <select class='form-control' name='comuna2' id='comuna2_beca' required>
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
                            </div>-->
                        

<!--			  <div class="form-group">
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
			  </div>-->
			 
			  

			 
                   
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary guardar_datos" onclick="registrarEstudianteBeca()" >Guardar datos</button>
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
         
        <script type="text/javascript" src="js/funciones/comuna_becas.js"></script>
        <script type="text/javascript" src="js/funciones/estudiante_becas.js"></script>
	<?php
		}
	?>