<?php
if (isset($con)) {
    ?>
    <div class="modal fade" id="mensaje_tne_rut" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2"><i class='glyphicon glyphicon-edit'></i>Mensaje</h4>
                </div>   

<!--                 <div class="modal-body">

                     <p style="color: black"><strong>Proceso: Postulación/Renovación</strong> CERRADO</p>
                    <p style="color: black"><strong>2do Proceso Rezagados:</strong> A partir del 05 de Febrero a las 16:00. hrs</p>
                </div>-->

<div class="modal-body">

                     <p style="color: black">Ud no cuenta con matricula Vigente. debe contactar a :<strong>ufe@ugm.cl</strong> </p>
<!--                    <p style="color: black"><strong>CERRADO</strong></p>-->
                </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button> 
                </div>       

            </div>  

        </div>

    </div>

<?php } ?>
