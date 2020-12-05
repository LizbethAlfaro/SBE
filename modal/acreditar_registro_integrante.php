<?php
if (isset($con)) {
    ?>
    <!-- Modal -->
    <div class="modal fade" id="nuevoIntegrante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo integrante</h4>
                </div>
                <div class="modal-body">
                    <!--editar esto a el modulo a agregar-->
                    <form class="form-horizontal" method="post" id="guardar_integrante" name="guardar_integrante">
                        <div id="resultados_ajax_acreditar_integrante"></div>


                        <div class="form-group">
                            <label for="rut_integrante" class="col-sm-3 control-label">Rut</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ac_rut" name="rut" placeholder="Rut" maxlength="12" onkeyup="validar(this.id)">
                                <span class="error-rut"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nombre_integrante" class="col-sm-3 control-label">Nombres</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ac_nombre_integrante" name="nombre" placeholder="Nombres">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apellido_integrante" class="col-sm-3 control-label">Apellidos</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ac_apellido_integrante" name="apellido" placeholder="Apellidos">
                            </div>
                        </div>




                        <div class="form-group">
                            <label for="genero_integrante" class="col-sm-3 control-label">Genero</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='genero' id='ac_genero_integrante' >
                                    <option value="">Selecciona un Genero</option>
                                    <?php
                                    $genero = Genero::recuperarGenero($con);

                                    while ($rw = sqlsrv_fetch_array($genero)) {
                                        ?>
                                        <option value="<?php echo $rw['id_genero']; ?>"><?php echo $rw['nombre_genero']; ?></option>			
                                        <?php
                                    }
                                    ?>


                                </select>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="fechaNac_integrante" class="col-sm-3 control-label">Fecha Nacimiento</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="ac_fechaNac_integrante" name="fechaNac" placeholder="fechaNac">		  
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="relacion_integrante" class="col-sm-3 control-label">Relacion</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='relacion' id='ac_relacion_integrante'>
                                    <option value="">Selecciona relacion</option>
    <?php
    $relacion = Relacion::recuperarRelacion($con);


    while ($rw = sqlsrv_fetch_array($relacion)) {
        ?>
                                        <option value="<?php echo $rw['id_relacion']; ?>"><?php echo $rw['nombre_relacion']; ?></option>			
                                        <?php
                                    }
                                    ?>

                                </select>

                            </div>
                        </div>


                        <div class="form-group">
                            <label for="estadoCivil_integrante" class="col-sm-3 control-label">Estado Civil</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='estadoCivil' id='ac_estadoCivil_integrante'>
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
                            <label for="nivelEducacional_integrante" class="col-sm-3 control-label">Nivel Educacional</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='nivelEducacional' id='ac_nivelEducacional_integrante'>
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
                            <label for="actividadIntegrante" class="col-sm-3 control-label">Actividad</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='actividadIntegrante' id='ac_actividadIntegrante'>
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
                            <label for="prevision_integrante" class="col-sm-3 control-label">Prevision</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='prevision' id='ac_prevision_integrante' onchange="acreditarOtraPrev(this.value)">
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


                        <div class="form-group" id="ac_otra-prev" style="visibility: hidden">
                            <label for="otraPrevision_integrante" class="col-sm-3 control-label">Otra prevision</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ac_otraPrevision_integrante" name="otraPrevision" placeholder="Prevision">
                            </div>
                        </div>

   
                        <div class="form-group">
                            <label for="condicion_integrante" class="col-sm-3 control-label">Condicion</label>
                            <div class="col-sm-8">
                                <select class='form-control' name='condicion' id='ac_condicion_integrante' onchange="acreditarCondicionEnfermedad(this.value)">
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
                        <div class="form-group" id="ac_cond-enfermedad" style="visibility: hidden">
                            <label for="enfermedad_integrante" class="col-sm-3 control-label">Enfermedad</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="ac_enfermedad_integrante" name="enfermedad" placeholder="Enfermedad">
                            </div>
                        </div>	
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary guardar_datos" onclick="registrarIntegrante()">Guardar datos</button>
                </div>


            </div>

        </div>
    </div>
    </div>
    <?php
}
?>