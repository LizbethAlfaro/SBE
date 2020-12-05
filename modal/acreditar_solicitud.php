	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="modalAcreditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"> 
            <div class="modal-dialog" role="document" style="width: 100%;">
		<div class="modal-content">
                    
		  <div class="modal-body">
                      <input type="hidden" id="rut_estudiante_acreditar">    
	          <div id="acreditar_integrante"></div>

		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="citar" onclick="enviarMail(1)">Citar a Trabajador</button>
		  </div>
                
		</div>
	  </div>
	</div>
	<?php
		}
	?>