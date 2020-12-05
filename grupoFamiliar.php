<?php

	session_start();

if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}

/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
        include './Clases/Integrante.php';
        
        
	$grupo_familiar="active";
	$title=" Grupo familiar | UGM";
        
        //clases para select
        include './Clases/Carrera.php';
        include './Clases/Genero.php';
        include './Clases/Estudiante.php';
        include './Clases/FechaIng.php';
        include './Clases/Relacion.php';
        include './Clases/EstadoCivil.php';
	include './Clases/NivelEducacional.php';
        include './Clases/ActividadIntegrante.php';
        include './Clases/Prevision.php';
        include './Clases/Condicion.php';
        include './Clases/TipoVivienda.php';
        include './Clases/Tenencia.php';
        include './Clases/Vivienda.php';
        include './Clases/Solicitud.php';
        
        $rut = $_SESSION['rut_estudiante'];
        
        $vivienda = Vivienda::recuperarVivienda($rut, $con);
        
        $viviendaArreglo;
        
        if($vivienda){
         $validar = sqlsrv_num_rows($vivienda);   
        }else{
         $validar=0; 
        }
if($validar>0){        
while ($viviendaCursor = sqlsrv_fetch_array($vivienda)) {
    $viviendaArreglo = array(
        "rut"        => $viviendaCursor['rut_estudiante'],
        "tenencia"   => $viviendaCursor['tenencia_vivienda'],
        "tipo"       => $viviendaCursor['tipo_vivienda']
    );
}
}else{
   $viviendaArreglo = array(
        "rut"        => $rut,
        "tenencia"   => "o",
        "tipo"       => "0"
    ); 
}
        
$condicion="";
$solicitud = Solicitud::recuperarSolicitud($rut,$condicion,$con);
$solicitudArreglo;
while ($solicitudCursor = sqlsrv_fetch_array($solicitud)) {
    $solicitudArreglo = array(
        "estado"           => $solicitudCursor['estado'],

    );
}

$validar=$solicitudArreglo['estado'];


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("head.php"); ?>
    </head>
    <body>
        <?php
        include("navbar.php");

        if ($validar>0 && $validar!=4) {
    header("location: informacion.php");
    exit;
}
        include("modal/editar_integrante.php");
        include("modal/editar_integrante_estudiante.php");
        include("modal/registro_integrante.php");
        ?>
        <div class="container">
            
             <div class="panel panel-success">
  
                        <div class="panel-heading">
                            <div class="btn-group pull-right">
                                <button class="btn btn-success <?php if($validar>0){echo 'hidden';}?>" id="guardar_datos" type="button" value="Guardar datos de vivienda" onclick="registrarVivienda()"><span class="glyphicon glyphicon-exclamation-sign"></span> Guardar datos de vivienda</span></button>
                            </div>
                            <h4><i class='glyphicon glyphicon-home'></i> Vivienda </h4>
                        </div>   
                        <div class="panel-body">   
                        <form class="form-horizontal" >
                            <div id="resultados_ajax_vivienda"></div>      
                            <input type="hidden" id="rut_estudiante" value="<?php echo $rut; ?>">    

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Tipo de vivienda</label>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                               
                                            <select class='form-control' name='tipo_vivienda' id='tipo_vivienda' required <?php if($validar>0){echo 'disabled';}?>>
                                
                                                <option value="">Tipo de vivienda</option>
                                                <?php
                                                $tipo_vivienda = TipoVivienda::recuperarTipoVivienda($con);

                                                while ($rw = sqlsrv_fetch_array($tipo_vivienda)) {
                                                    ?>
                                                    <option value="<?php echo $rw['id_tipoVivienda']; ?>"><?php echo $rw['nombre_tipoVivienda']; ?></option>			
                                                    <?php
                                                }
                                                ?>
                                            </select>  

                                        </div>
                                    </div>
                                </div>
                                <label></label>
                                <div class="col-md-4">
                                    <label>Tenencia de vivienda</label>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <select class='form-control' name='tenencia_vivienda' id='tenencia_vivienda' required <?php if($validar>0){echo 'disabled';}?>>
                                                <option value="">Tenencia de vivienda</option>
                                                <?php
                                                $tenencia_vivienda = Tenencia::recuperarTenencia($con);

                                                while ($rw = sqlsrv_fetch_array($tenencia_vivienda)) {
                                                    ?>
                                                    <option value="<?php echo $rw['id_tenencia']; ?>"><?php echo $rw['nombre_tenencia']; ?></option>			
                                                    <?php
                                                }
                                                ?>
                                            </select> 	  
                                        </div>
                                    </div>
                                </div>
                            </div>
 
                        </form>
                    </div>
                </div>
            
            <div class="panel panel-success">
  
                        <div class="panel-heading">
                            <div class="btn-group pull-right">
                                <button type='button' class="btn btn-success <?php if($validar>0){echo 'hidden';}?>" data-toggle="modal" data-target="#nuevoIntegrante"><span class="glyphicon glyphicon-plus" ></span> Agregar Integrante </button>
                            </div>
                            <h4><i class='glyphicon glyphicon-search'></i> Integrantes Familiares </h4>
                        </div>   
                        <div class="panel-body">   
   
                            <div class="form-group row">
                                <label for="q" class="col-md-1 control-label">Nombre</label>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" id="q" placeholder="Nombre Integrante" onkeyup='load(1);'>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- el select de la bd se carga en los div -->

                        <div id="resultados2"></div><!-- Carga los datos ajax -->
                        <div class='outer_div'></div><!-- Carga los datos ajax -->

                    </div>
                </div>

            </div>
                <div style="margin-bottom: 100px;"></div>
            <hr>
            <?php
            include("footer.php");
            ?>
            <!-- el select proviene de js -->
            <script type="text/javascript" src="js/extras/validarRut.js"></script>
            <script type="text/javascript" src="js/funciones/integrante.js"></script> 
            <script type="text/javascript" src="js/grupoFamiliar_page.js"></script> 

            <script type="text/javascript">
            $('#tipo_vivienda        option[value= <?php echo $viviendaArreglo['tipo']; ?>]').prop("selected", "selected");
            $('#tenencia_vivienda    option[value= <?php echo $viviendaArreglo['tenencia']; ?>]').prop("selected", "selected");
            $('#tenencia_vivienda    option[value= <?php echo $viviendaArreglo['tenencia']; ?>]').prop("selected", "selected");
            </script>
    </body>
</html>
