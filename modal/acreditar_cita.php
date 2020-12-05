	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="acreditar_cita" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Estudiantes Asignados </h4>
		  </div>
		  <div class="modal-body">
<!-- cambiar nombre de form para agregar  modulos-->
    <form class="form-horizontal" method="post" >
			
                        <div class="container-fluid">
                            <input type="hidden" id="rut" > 
                            <input type="hidden" id="fecha" > 

                            <div id="resultado_acreditar_cita"></div>    
			  
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                     
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>