<?php
if (isset($con)) {
    ?>
    <!-- Modal -->
    <div class="modal fade" id="editar_asistente_clave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Cambiar contraseña</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" id="editar_clave" name="editar_clave">
                        <div id="resultados_ajax3"></div>

                        <div class="form-group">
                            <label for="mod_clave_id" class="col-sm-4 control-label">Rut</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" id="mod_clave_id" name="mod_clave_id" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pass-nueva" class="col-sm-4 control-label">Nueva contraseña</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="pass-nueva" name="pass-nueva" placeholder="Nueva contraseña" pattern=".{6,}" title="Contraseña ( min . 6 caracteres)" required>  
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pass-repetir" class="col-sm-4 control-label">Repite contraseña</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="pass-repetir" name="pass-repetir" placeholder="Repite contraseña" pattern=".{6,}" required>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="actualizar_datos3" onclick="editarClave()">Cambiar contraseña</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}
?>	