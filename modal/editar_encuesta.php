	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar producto</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_producto" name="editar_producto">
			<div id="resultados_ajax2"></div>
                        
                         <legend> Equipo </legend>
			  <div class="form-group">
				<label for="mod_codigo" class="col-sm-3 control-label">Código</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_codigo" name="mod_codigo" placeholder="Código del producto" required>
					<input type="hidden" name="mod_id" id="mod_id">
				</div>
			  </div>

			  
			  <div class="form-group">
				<label for="mod_nombre" class="col-sm-3 control-label">Usuario</label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="mod_nombre" name="mod_nombre" placeholder="Usuario del producto" maxlength="255" >
				  
				</div>
			  </div>
			  
                        
                        <div class="form-group">
				<label for="mod_tipo" class="col-sm-3 control-label">Tipo</label>
				<div class="col-sm-8">
					<select class='form-control' name='mod_tipo' id='mod_tipo' required>
						<option value="">Selecciona tipo</option>
							<?php 
							$query_tipo=mysqli_query($con,"select * from tipos order by nombre_tipo");
							while($rw=mysqli_fetch_array($query_tipo))	{
								?>
							<option value="<?php echo $rw['id_tipo'];?>"><?php echo $rw['nombre_tipo'];?></option>			
								<?php
							}
							?>
					</select>			  
				</div>
			  </div>
                        
                        
                        <div class="form-group">
				<label for="mod_marca" class="col-sm-3 control-label">Marca</label>
				<div class="col-sm-8">
                                    <!--cambiar desde js embebdido en php el metodo cambiar -->
					<select class='form-control' name='mod_marca' id='mod_marca' required onchange="cambiarModelo(this.value,0)">
						<option value="">Selecciona una marca</option>
							<?php 
							$query_marca=mysqli_query($con,"select * from marcas order by nombre_marca");
							while($rw=mysqli_fetch_array($query_marca))	{
								?>
							<option value="<?php echo $rw['id_marca'];?>"><?php echo $rw['nombre_marca'];?></option>			
								<?php
							}
							?>
					</select>			  
				</div>
			  </div>
                        
                        
                         <div class="form-group">
				<label for="mod_modelo" class="col-sm-3 control-label">Modelo</label>
				<div class="col-sm-8">
					<select class='form-control' name='mod_modelo' id='mod_modelo' required>
					
                                            <!--recibe por ajax-->
                                            
					</select>			  
				</div>
			  </div>
                        
                        
                        <div class="form-group">
				<label for="mod_procesador" class="col-sm-3 control-label">Procesador</label>
				<div class="col-sm-8">
					<select class='form-control' name='mod_procesador' id='mod_procesador' required>
						<option value="">Selecciona un procesador</option>
                                                
							<?php 
							$query_procesador=mysqli_query($con,"select * from procesadores order by nombre_procesador");
							while($rw=mysqli_fetch_array($query_procesador))	{
								?>
							<option value="<?php echo $rw['id_procesador'];?>"><?php echo $rw['nombre_procesador'];?></option>			
								<?php
							}
							?>
                                                        
					</select>			  
				</div>
			  </div>
                        
                        <div class="form-group">
				<label for="mod_disco" class="col-sm-3 control-label">Disco Duro</label>
				<div class="col-sm-8">
					<select class='form-control' name='mod_disco' id='mod_disco' required>
						<option value="">Selecciona un disco</option>
                                                
							<?php 
							$query_procesador=mysqli_query($con,"select * from discos order by nombre_disco");
							while($rw=mysqli_fetch_array($query_procesador))	{
								?>
							<option value="<?php echo $rw['id_disco'];?>"><?php echo $rw['nombre_disco'];?></option>			
								<?php
							}
							?>
                                                        
					</select>			  
				</div>
			  </div>
                        
                        
                        
                        <div class="form-group">
				<label for="mod_memoria" class="col-sm-3 control-label">Memoria Ram</label>
				<div class="col-sm-8">
					<select class='form-control' name='mod_memoria' id='mod_memoria' required>
						<option value="">Selecciona memoria</option>
							<?php 
							$query_memoria=mysqli_query($con,"select * from memorias order by nombre_memoria");
							while($rw=mysqli_fetch_array($query_memoria))	{
								?>
							<option value="<?php echo $rw['id_memoria'];?>"><?php echo $rw['nombre_memoria'];?></option>			
								<?php
							}
							?>
					</select>			  
				</div>
			  </div>
                       
                         <div class="form-group">
				<label for="mod_sistema" class="col-sm-3 control-label">Sistema Operativo</label>
				<div class="col-sm-8">
					<select class='form-control' name='mod_sistema' id='mod_sistema' required>
						<option value="">Selecciona sistema</option>
							<?php 
							$query_sistema=mysqli_query($con,"select * from sistemas order by nombre_sistema");
							while($rw=mysqli_fetch_array($query_sistema))	{
								?>
							<option value="<?php echo $rw['id_sistema'];?>"><?php echo $rw['nombre_sistema'];?></option>			
								<?php
							}
							?>
					</select>			  
				</div>
			  </div>
                        
                        <legend>Pantalla</legend>
                         <div class="form-group">
				<label for="mod_marcap" class="col-sm-3 control-label">Marca</label>
				<div class="col-sm-8">
                                    <select class='form-control' name='mod_marcap' id='mod_marcap' required onchange="cambiarModelop(this.value,0)">
						<option value="">Selecciona una Marca</option>
							<?php 
							$query_marca=mysqli_query($con,"select * from marcasp order by nombre_marcap");
							while($rw=mysqli_fetch_array($query_marca))	{
								?>
							<option value="<?php echo $rw['id_marcap'];?>"><?php echo $rw['nombre_marcap'];?></option>			
								<?php
							}
							?>
					</select>			  
				</div>
			  </div>
			
  
                        <div class="form-group">
				<label for="mod_modelop" class="col-sm-3 control-label">Modelo</label>
				<div class="col-sm-8">
                                    <select class='form-control' name='mod_modelop' id='mod_modelop' required onchange="cambiarCodigo(this.value,0)">
					
                                            <!--recibe por ajax-->
                                                                               
					</select>			  
				</div>
			  </div>
                        
                        <div class="form-group">
				<label for="mod_pantalla" class="col-sm-3 control-label">Pantalla ID</label>
				<div class="col-sm-8">
					<select class='form-control' name='mod_pantalla' id='mod_pantalla' required>
					
					</select>			  
				</div>
			  </div>
                        
                       
                        
                        
                        <legend>Lugar</legend>
                        <div class="form-group">
				<label for="mod_categoria" class="col-sm-3 control-label">Area</label>
				<div class="col-sm-8">
                                    <select class='form-control' name='mod_categoria' id='mod_categoria' required onchange="cambiarSala(this.value,0)" >
						<option value="0">Selecciona un area</option>
							<?php 
							$query_categoria=mysqli_query($con,"select * from categorias order by nombre_categoria");
							while($rw=mysqli_fetch_array($query_categoria))	{
								?>
							<option value="<?php echo $rw['id_categoria'];?>"><?php echo $rw['nombre_categoria'];?></option>			
								<?php
							}
							?>
					</select>			  
				</div>
			  </div>

                        <div class="form-group">
				<label for="mod_sala" class="col-sm-3 control-label">Sala</label>
				<div class="col-sm-8">
                                    <select class='form-control' name='mod_sala' id='mod_sala' required>
						
					</select>			  
				</div>
			  </div>

			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>