<?php
include './head.php';
$token = $_GET['token'];
$rut = $_GET['rut'];
$hash = hash('sha256', $rut);
$title="Restablecer contraseña";


if (hash_equals($token, $hash)) {
 
?>

        <div class="container">

	  <div class="modal-dialog" role="document">
		<div class="modal-content">

		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_password" name="editar_password">
			<div id="resultados_ajax3"></div>
			 
			 
			 
			 
			  <div class="form-group">
				<label for="pass-nueva" class="col-sm-4 control-label">Nueva contraseña</label>
				<div class="col-sm-8">
				  <input type="password" class="form-control" id="pass-nueva" name="pass-nueva" placeholder="Nueva contraseña" pattern=".{6,}" title="Contraseña ( min . 6 caracteres)" required>
                                  <input type="hidden" id="rut" name="rut" value="<?php echo $rut;?>">
                                  <input type="hidden" id="token" name="token" value="<?php echo $token;?>">
				</div>
			  </div>
			  <div class="form-group">
				<label for="pass-repetir" class="col-sm-4 control-label">Repite contraseña</label>
				<div class="col-sm-8">
				  <input type="password" class="form-control" id="pass-repetir" name="pass-repetir" placeholder="Repite contraseña" pattern=".{6,}" required>
				</div>
			  </div>
	
		  </div>

		  </form>
		</div>
              
                            <div class="modal-footer">

                        <button type="button" class="btn btn-primary" id="actualizar_datos3" onclick="restablecerClave()">Cambiar contraseña</button>
		  </div>
              
              <div id="resultados_ajax"></div>
	  </div>


            
            </div>
                <div style="margin-bottom: 100px;"></div>
            <hr>
            <?php
            include("footer.php");
            ?>

    </body>
</html>
  <script type="text/javascript" src="js/funciones/estudiante.js"></script>
  <?php
  }else{
      echo 'No';
  }
?>