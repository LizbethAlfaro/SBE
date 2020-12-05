<?php
if (isset($con)) {
    ?>
    <div class="modal fade" id="editarIntegranteEstudiante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel2"><i class='glyphicon glyphicon-edit'></i> Editar integrante</h4>
                </div>   

                <div class="modal-body">

                    <form class="form-horizontal" method="post" id="editar_integrante" name="editar_integrante">
                        <div id="resultados_ajax_editar_i_e"></div>

                        <div class="form-group">
                            <label for="mod_rut" class="col-sm-3 control-label">Rut</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mod_rut_i_e" name="rut" placeholder="Rut" required maxlength="12" onkeyup="validar(this.id)" readonly>
                                <span class="error-rut"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mod_estado" class="col-sm-3 control-label">Estado Civil</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='estadoCivil' id='mod_estado_i_e' required>
                                    <option value="">Selecciona estado civil</option>
                                    <?php
                                    $estado = EstadoCivil::recuperarEstadoCivil($con);


                                    while ($rw = sqlsrv_fetch_array($estado)) {
                                        ?>
                                        <option value="<?php echo $rw['id_estado']; ?>"><?php echo $rw['nombre_estado']; ?></option>			
                                        <?php
                                    }
                                    ?>

                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mod_nivel" class="col-sm-3 control-label">Nivel Educacional</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='nivelEducacional' id='mod_nivel_i_e' required>
                                    <option value="">Selecciona nivel educacional</option>
                                    <?php
                                    $nivel = NivelEducacional::recuperarNivelEducacional($con);

                                    while ($rw = sqlsrv_fetch_array($nivel)) {
                                        ?>
                                        <option value="<?php echo $rw['id_nivel']; ?>"><?php echo $rw['nombre_nivel']; ?></option>			
                                        <?php
                                    }
                                    ?>

                                </select>

                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="mod_actividad" class="col-sm-3 control-label">Actividad</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='actividadIntegrante' id='mod_actividad_i_e' required>
                                    <option value="">Selecciona actividad</option>
                                    <?php
                                    $actividad = ActividadIntegrante::recuperarActividad($con);


                                    while ($rw = sqlsrv_fetch_array($actividad)) {
                                        ?>
                                        <option value="<?php echo $rw['id_actividad']; ?>"><?php echo $rw['nombre_actividad']; ?></option>			
                                        <?php
                                    }
                                    ?>

                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mod_prevision" class="col-sm-3 control-label">Prevision</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='prevision' id='mod_prevision_i_e' required onchange="otraPrevEI(this.value)">
                                    <option value="">Selecciona prevision</option>
                                    <?php
                                    $prevision = Prevision::recuperarPrevision($con);


                                    while ($rw = sqlsrv_fetch_array($prevision)) {
                                        ?>
                                        <option value="<?php echo $rw['id_prevision']; ?>"><?php echo $rw['nombre_prevision']; ?></option>			
                                        <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>


                        <div class="form-group" id="otra-prev2" style="visibility: hidden">
                            <label for="mod_otraprevision_i_e" class="col-sm-3 control-label">Otra prevision</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mod_otraprevision_i_e" name="otraPrevision" placeholder="Prevision" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="mod_condicion" class="col-sm-3 control-label">Condicion</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='condicion' id='mod_condicion_i_e' required onchange="condicionEnfermedadEI(this.value)">
                                    <option value="">Selecciona condicion </option>
                                    <?php
                                    $condicion = Condicion::recuperarCondicion($con);


                                    while ($rw = sqlsrv_fetch_array($condicion)) {
                                        ?>
                                        <option value="<?php echo $rw['id_condicion']; ?>"><?php echo $rw['nombre_condicion']; ?></option>			
                                        <?php
                                    }
                                    ?>

                                </select>

                            </div>
                        </div>
                        <div class="form-group" id="cond-enfermedad2" style="visibility: hidden">
                            <label for="mod_enfermedad" class="col-sm-3 control-label">Enfermedad</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mod_enfermedad_i_e" name="enfermedad" placeholder="Enfermedad" required>
                            </div>
                        </div>

                    </form>

                </div>




                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary guardar_datos"  onclick="editarIntegranteEstudiante()">Guardar datos</button>
                </div>       

            </div>  

        </div>

    </div>

<?php } ?>
