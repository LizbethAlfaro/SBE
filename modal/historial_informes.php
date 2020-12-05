	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
        
	<div class="modal fade" id="historial_informes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
               <form class="form-horizontal" method="post" id="guardar_asignar2" name="guardar_asignar2">    
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel2"><i class='glyphicon glyphicon-edit'></i>Historial Informes</h4>
		  </div>
                    <div class="modal-body">
                    <div id="loader"></div>
                    <table border="0" class="table">
                        <thead>
                            <tr>
                                <th class="text-center">TIPO</th>
                                <th class="text-center">FECHA</th>
                            </tr>
                        </thead>
                        <tbody id="tabla_informes">

                        </tbody>   
                    </table>
                
			
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