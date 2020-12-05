	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="registro_observacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar Observacion</h4>
		  </div>
		  <div class="modal-body">
                      <!--editar esto a el modulo a agregar-->
			<form class="form-horizontal" method="post" id="guardar_asistente" name="guardar_observacion">
			<div id="resultados_ajax"></div>
                        <div id="resultados_ajax_tabla"></div>
		        </form>


		  </div>

		</div>
	  </div>
	</div>
	<?php
		}
	?>