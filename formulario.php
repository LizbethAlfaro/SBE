<?php
session_start();
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}else if ($validar>0) {
    header("location: informacion.php");
    exit;
}

/* Connecta a BD */
require_once ("./config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("./config/conexion.php"); //Contiene funcion que conecta a la base de datos

$active_usuarios = "active";
$title = "Formulario Enviado";

$rut = $_SESSION['rut_estudiante'];
$condicion = ""; //where...

//formulario registrado
include './Clases/Formulario.php';
$id_formulario  = "";
$rut_estudiante = $_SESSION['rut_estudiante'];
$condicion = "";
$offset = "";
$per_page = "";
$formularioQuery = Formulario::recuperarFormulario($id_formulario,$rut_estudiante, $con,$condicion,$offset,$per_page);
$formularioArreglo;

while ($formularioCursor = sqlsrv_fetch_array($formularioQuery)) {
    $formularioArreglo = array(
        "formulario"        => $formularioCursor['id_formulario'],
        "nombre"            => $formularioCursor['nombre'],
        "rut"               => $formularioCursor['rut'],
        "carrera"           => $formularioCursor['carrera'],
        "jornada"           => $formularioCursor['jornada'],
        "fecha_ing"         => $formularioCursor['fecha_ing'],
        "fecha_nac"         => $formularioCursor['fecha_nac'],
        "direccion"         => $formularioCursor['direccion'],
        "numero"            => $formularioCursor['numero'],
        "departamento"      => $formularioCursor['departamento'],
        "villa"             => $formularioCursor['villa'],
        "comuna"            => $formularioCursor['comuna'],
        "region"            => $formularioCursor['region'],
        "fono"              => $formularioCursor['fono'],
        "movil"             => $formularioCursor['movil'],
        "mail"              => $formularioCursor['mail'],
        "direccion_2"       => $formularioCursor['direccion_2'],
        "numero_2"          => $formularioCursor['numero_2'],
        "departamento_2"    => $formularioCursor['departamento_2'],
        "villa_2"           => $formularioCursor['villa_2'],
        "comuna_2"          => $formularioCursor['comuna_2'],
        "region_2"          => $formularioCursor['region_2'],
        "tenencia_vivienda" => $formularioCursor['tenencia_vivienda'],
        "tipo_vivienda"     => $formularioCursor['tipo_vivienda'],
        "declaracion"       => $formularioCursor['declaracion'],
        "fecha_cita"        => $formularioCursor['fecha_cita'],
        "hora_cita"         => $formularioCursor['hora_cita'],
        "fecha_formulario"  => $formularioCursor['fecha_formulario']
    );
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        include("./head.php");
        ?>
        <style type="text/css">
            input {
                border: 0;
                width: 100%;
                display: inline-block;
                min-width: 100px;
            }
            textArea{
               width: 100%; 
            }            
            .firmas{
             height: 10rem;   
            }
            .declaracion{
             height: 20rem;   
            }
            .bloque{
             height: 28rem;   
            }
            .separar{
             height: 7rem;   
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
                <div class="panel panel-default">
                    <div class="panel-heading">
                            <table border="0" class="table" >
                                <thead>
                                    <tr>
                                        <th class="col-sm-8" style="visibility: hidden"></th>
                                        <th class="panel panel-default text-center">FOLIO : <?php echo $formularioArreglo['formulario'];?></th>   
                                        <th class="panel panel-default text-center">FECHA : <?php echo $formularioArreglo['fecha_formulario'];?></th>
                                    </tr>
                                </thead>
                            </table>
                        <div class="separar">
                            
                        </div>
                        <div class="text-center">
                            <h4>FORMULARIO UNICO POSTULACION Y RENOVACION</h4>
                            <h4>BECA SOCIOECONOMICA UGM  <?php echo date("Y"); ?></h4>
                        </div>
                    </div>
                    <div id="resultados_ajax_formulario"></div>
                    <form id="guardar_formulario">
                    <div class="panel-body">                        
        
               
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>IDENTIFICACION DEL ESTUDIANTE</h5>  
                            </div> 
                            <div class="panel-body table-responsive">

                                <table border="0" class="table">
                                    <tbody>
                                        <tr>
                                            <td><label>NOMBRE :              </label></td>
                                            <td colspan="3"><?php echo $formularioArreglo['nombre'];?></td>
                                            <td><label>RUT :              </label></td>
                                            <td colspan="3"><?php echo $formularioArreglo['rut']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>CARRERA :</label></td>
                                            <td colspan="3"><?php echo $formularioArreglo['carrera']; ?></td>
                                            <td><label>JORNADA:</label></td>
                                            <td colspan="3"><?php echo $formularioArreglo['jornada']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>AÑO INGRESO:</label></td>
                                            <td colspan="2"><?php echo $formularioArreglo['fecha_ing']; ?></td>
                                            <td><label>FECHA DE NACIMIENTO:</label></td>
                                            <td colspan="2"><?php echo $formularioArreglo['fecha_nac']; ?></td>
                                            <td><label>TIPO DE SOLICITUD:</label></td>
                                            <td><?php echo "0"; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>DIRECCION :</label></td>
                                            <td colspan="5"><?php echo $formularioArreglo['direccion']; ?></td>
                                            <td><label>N° :</label></td>
                                            <td><?php echo $formularioArreglo['numero']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>DPTO :</label></td>
                                            <td><?php echo $formularioArreglo['departamento']; ?></td>
                                            <td><label>VILLA :</label></td>
                                            <td><?php echo $formularioArreglo['villa']; ?></td>
                                            <td><label>COMUNA :</label></td>
                                            <td><?php echo $formularioArreglo['comuna']; ?></td>
                                            <td><label>REGION :</label></td>
                                            <td><?php echo $formularioArreglo['region']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>FONO (CASA):</label></td>
                                            <td><?php echo $formularioArreglo['fono']; ?></td>
                                            <td><label>CELULAR:</label></td>
                                            <td><?php echo $formularioArreglo['movil']; ?></td>
                                            <td><label>E-MAIL :</label></td>
                                            <td colspan="3"><?php echo $formularioArreglo['mail']; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="8"><h4>DIRECCION PERIODO ACADEMICO</h4></td>
                                        </tr>
                                        <tr>
                                            <td><label>DIRECCION :</label></td>
                                            <td colspan="5"><?php echo $formularioArreglo['direccion_2']; ?></td>
                                            <td><label>N° :</label></td>
                                            <td><?php echo $formularioArreglo['numero_2']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><label>DPTO :</label></td>
                                            <td><?php echo $formularioArreglo['departamento_2']; ?></td>
                                            <td><label>VILLA :</label></td>
                                            <td><?php echo $formularioArreglo['villa_2']; ?></td>
                                            <td><label>COMUNA :</label></td>
                                            <td><?php echo $formularioArreglo['comuna_2']; ?></td>
                                            <td><label>REGION :</label></td>
                                            <td><?php echo $formularioArreglo['region_2']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> 

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>IDENTIFICACION DEL GRUPO FAMILIAR
                                    <span style='display:inline; white-space:pre;'>             </span> 
                                    N° Total de Integrantes <?php echo ""; ?></h5>  
                            </div>
                            <div class="panel-body bloque table-responsive">
                                <table border="0" class="table">
                                    <thead>
                                        <tr>
                                            <th>RUT</th>
                                            <th>NOMBRE</th>
                                            <th>APELLIDO</th>
                                            <th>GENERO</th>
                                            <th>EDAD</th>
                                            <th>RELACION</th>
                                            <th>ESTADO&nbspCIVIL</th>
                                            <th>NIVEL&nbspEDICACIONAL</th>
                                            <th>ACTIVIDAD/PROFESION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php 
                                    while ($row = sqlsrv_fetch_array($result_integrante)){
                                    $rut_integrante=$row['rut_integrante'];
                                    $nombre_integrante=$row['nombre_integrante'];
                                    $apellido_integrante=$row['apellido_integrante'];
                                    $genero_integrante=$row['nombre_genero'];
                                    $fechaNac_integrante=$row['fechaNac_integrante'];
                                    $edad_integrante= date("Y") - date("Y", strtotime($row['fechaNac_integrante'])); 
                                    $relacion_integrante=$row['nombre_relacion'];
                                    $estadoCivil_integrante=$row['nombre_estado'];
                                    $nivelEduc_integrante=$row['nombre_nivel'];
                                    $actividad_integrante=$row['nombre_actividad'];         
                                     ?>     
                                        <tr>
                                            <td><input name="rut_integrante[]"          value="<?php echo $rut_integrante ?>">          </td>
                                            <td><input name="nombre_integrante[]"       value="<?php echo $nombre_integrante ?>">       </td>
                                            <td><input name="apellido_integrante[]"     value="<?php echo $apellido_integrante ?>">     </td>
                                            <td><input name="genero_integrante[]"       value="<?php echo $genero_integrante ?>">       </td>
                                            <td><input name="edad_integrante[]"         value="<?php echo $edad_integrante ?>">         </td>
                                            <td><input name="relacion_integrante[]"     value="<?php echo $relacion_integrante ?>">     </td>
                                            <td><input name="estadoCivil_integrante[]"  value="<?php echo $estadoCivil_integrante ?>">  </td>
                                            <td><input name="nivelEduc_integrante[]"    value="<?php echo $nivelEduc_integrante ?>">    </td>
                                            <td><input name="actividad_integrante[]"    value="<?php echo $actividad_integrante ?>">    </td>
                                        </tr>
                                     <?php   
                                     }
                                     ?>     
                                    </tbody>
                                </table>
    
                            </div>
                        </div>

                        <div class="panel panel-default">
                        <div class="panel-body table-responsive">
                          <table border="0" class="table">
                                    <thead>
                                        <tr>
                                            <th><label>TENENCIA&nbspDE&nbspLA&nbspVIVIENDA</label></th>
                                            <th><label><input name="tenencia_vivienda" value="<?php echo $viviendaArreglo['tenencia']; ?>"></label></th>
                                            <th><label>TIPO&nbspDE&nbspVIVIENDA</label></th>
                                            <th><label><input name="tipo_vivienda" value="<?php echo $viviendaArreglo['tipo']; ?>"></label></th>
                                        </tr>
                                    </thead>
                                </table>   
                        </div>
                        </div>
                        
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>IDENTIFICACION&nbspINGRESOS&nbspFAMILIARES</h5>  
                            </div>
                            <div class="panel-body bloque table-responsive">
                                <table border="0" class="table">
                                    <thead>
                                        <tr>
                                            <th>RUT</th>
                                            <th>NOMBRE</th>
                                            <th>APELLIDO</th>
                                            <th>INGRESO&nbspMENSUAL</th>
                                            <th>TIPO&nbspDE&nbspINGRESO</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    while ($row = sqlsrv_fetch_array($result_ingreso)) {
                                    $rut_integrante      = $row['rut_integrante'];
                                    $nombre_integrante   = $row['nombre_integrante'];
                                    $apellido_integrante = $row['apellido_integrante'];
                                    $ingresoMensual      = $row['ingresoMensual'];
                                    $tipo_ingreso        = $row['tipo_ingreso'];
                                    $nombre_tipoIngreso  = $row['nombre_tipoIngreso'];
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><input name="rut_ingreso[]"      value="<?php echo $rut_integrante; ?>">     </td>
                                            <td class="text-center"><input name="nombre_ingreso[]"   value="<?php echo $nombre_integrante; ?>">  </td>
                                            <td class="text-center"><input name="apellido_ingreso[]" value="<?php echo $apellido_integrante; ?>"></td>
                                            <td class="text-center"><input name="cantidad_ingreso[]" value="<?php echo $ingresoMensual; ?>">     </td>
                                            <td class="text-center"><input name="tipo_ingreso[]"     value="<?php echo $nombre_tipoIngreso; ?>"> </td>
                                        </tr>
                                    </tbody>
                                    <?php
                                    }
                                    ?>
                                </table>

                            </div>    
                        </div>

<div class="separar"></div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>ANTECEDENTES&nbspDE&nbspSALUD&nbspGRUPO&nbspFAMILIAR</h5>  
                            </div>
                            <div class="panel-body bloque table-responsive">
                                <table border="0" class="table">
                                    <thead>
                                        <tr>
                                            <th>RUT</th>
                                            <th>NOMBRE</th>
                                            <th>APELLIDO</th>
                                            <th>CONDICION</th>
                                            <th>ENFERMEDAD</th>
                                            <th>PREVISION</th>
                                            <th>OTRA&nbspPREVISION</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    //resetea cursor de sqlsrv
                                    for ( $row = sqlsrv_fetch_array($result_integrante, SQLSRV_FETCH_BOTH, SQLSRV_SCROLL_FIRST);$row ;$row = sqlsrv_fetch_array($result_integrante, SQLSRV_FETCH_BOTH, SQLSRV_SCROLL_NEXT) ){
                                    $rut_integrante           = $row['rut_integrante'];
                                    $nombre_integrante        = $row['nombre_integrante'];
                                    $apellido_integrante      = $row['apellido_integrante'];
                                    $condicion_integrante     = $row['nombre_condicion'];
                                    $enfermedad_integrante    = $row['enfermedad_integrante'];
                                    $prevision_integrante     = $row['nombre_prevision'];
                                    $otraPrevision_integrante = $row['otraPrevision_integrante'];
                                     ?>     
                                    <tbody>
                                        <tr>
                                            <td><input name="rut_antecedentes[]"        value="<?php echo $rut_integrante ?>">             </td>
                                            <td><input name="nombre_antecedentes[]"     value="<?php echo $nombre_integrante ?>">          </td>
                                            <td><input name="apellido_antecedentes[]"   value="<?php echo $apellido_integrante ?>">        </td>
                                            <td><input name="condicion_antecedentes[]"  value="<?php echo $condicion_integrante ?>">       </td>
                                            <td><input name="enfermedad_antecedentes[]" value="<?php echo $enfermedad_integrante ?>">      </td>
                                            <td><input name="prevision_antecedentes[]"  value="<?php echo $prevision_integrante ?>">       </td>
                                            <td><input name="otraprev_antecedentes[]"   value="<?php echo $otraPrevision_integrante ?>">   </td>          
                                        </tr>                                  
                                    </tbody>
                                    <?php 
                                    }   
                                    ?>     
                                </table>

                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5>DECLARACION&nbspDE&nbspSOLICITUD&nbspA&nbspBECA</h5>  
                            </div>
                            <div class="panel-body table-responsive">
                                <table border="0" class="table">
                                    <tbody>
                                        <tr>
                                            <td colspan="2"><textarea name="declaracion" class="declaracion text-center" readonly> <?php echo$formularioArreglo['declaracion'];?></textarea></td>         
                                        </tr>
                                        <tr>
                                            <td>
                            <div class="panel panel-default">
                            <div class="panel-body firmas">
                            </div>     
                            <div class="panel-heading text-center">
                            FIRMA&nbspY&nbspHUELLA&nbspDEL&nbspESTUDIANTE     
                            </div>
                            </div>         
                                            </td>
                                            <td>
                            <div class="panel panel-default">
                            <div class="panel-body firmas">
                                    
                            </div>    
                            <div class="panel-heading text-center">
                            FIRMA&nbspY&nbspTIMBRE&nbspÁREA&nbspBECAS  
                            </div>
                            </div>     
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <h5>DATOS&nbspDE&nbspENTREVISTA</h5>  
                            </div>
                            <div class="panel-body bloque table-responsive">
                                <table border="0" class="table ">
                                    <thead>
                                        <tr>
                                            <th>FECHA</th>
                                            <th>HORA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input name="fecha_cita" value="<?php echo $formularioArreglo['fecha_cita'];?>"></td>
                                            <td><input name="hora_cita" value="<?php echo $formularioArreglo['hora_cita'];?>"></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>


                    </div>
                </form>
                    
                </div>

        </div>  






        <?php
        include("./footer.php");
        ?>
        <script type="text/javascript" src="js/funciones/formulario.js"></script>
        <script type="text/javascript">
        $('input').attr('readonly', true)   
        </script>
    </body>
</html>
