<?php
session_start();

if (!isset($_SESSION['user_login_admin_status']) AND $_SESSION['user_login_admin_status'] != 1) {
    header("location: loginAdmin.php");
    exit;
}
/* Connect To Database */
require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
//clases para select
include '../Clases/Carrera.php';
include '../Clases/Genero.php';
include '../Clases/Comuna.php';
include '../Clases/Region.php';
include '../Clases/Estudiante.php';
include '../Clases/Direccion.php';
include '../Clases/FechaIng.php';
include '../Clases/Jornada.php';
include '../Clases/Scape.php';


$rut = $_GET['rut_estudiante'];
$condicion = ""; //where...

$estudianteQuery = Estudiante::recuperarEstudiante($rut, $con, $condicion, "", "");
$estudianteArreglo;
while ($estudianteCursor = sqlsrv_fetch_array($estudianteQuery)) {
    $estudianteArreglo = array(
        "rut"       => $estudianteCursor['rut_estudiante'],
        "nombre"    => $estudianteCursor['nombre_estudiante'],
        "apellido"  => $estudianteCursor['apellido_estudiante'],
        "fechaNac"  => $estudianteCursor['fechaNac_estudiante'],
        "genero"    => $estudianteCursor['genero_estudiante'],
        "fono"      => $estudianteCursor['fono_estudiante'],
        "movil"     => $estudianteCursor['movil_estudiante'],
        "mail"      => $estudianteCursor['mail_estudiante'],
        "fechaIng"  => $estudianteCursor['fechaIng_estudiante'],
        "carrera"   => $estudianteCursor['carrera_estudiante'],
        "jornada"   => $estudianteCursor['jornada_estudiante'],
    );
}
$tipo = 1;
$direccion1 = Direccion::recuperarDireccion($rut,$tipo,$con);
$direccion_1_Arreglo;
while ($direccionCursor = sqlsrv_fetch_array($direccion1)) {
    $direccion_1_Arreglo = array(
        "rut"           => $direccionCursor['rut_estudiante'],
        "tipo"          => $direccionCursor['tipo'],
        "direccion"     => $direccionCursor['direccion'],
        "numero"        => $direccionCursor['numero'],
        "departamento"  => $direccionCursor['departamento'],
        "villa"         => $direccionCursor['villa'],
        "comuna"        => $direccionCursor['comuna'],
        "region"        => $direccionCursor['region']
    );
}
$tipo2 = 2;
$direccion2 = Direccion::recuperarDireccion($rut,$tipo2,$con);
$direccion_2_Arreglo;
if($direccion2){
$contador = sqlsrv_num_rows($direccion2);
}else{
$contador=0;    
}
if($contador>0){
while ($direccionCursor = sqlsrv_fetch_array($direccion2)) {
    $direccion_2_Arreglo = array(
        "rut"           => $direccionCursor['rut_estudiante'],
        "tipo"          => $direccionCursor['tipo'],
        "direccion"     => $direccionCursor['direccion'],
        "numero"        => $direccionCursor['numero'],
        "departamento"  => $direccionCursor['departamento'],
        "villa"         => $direccionCursor['villa'],
        "comuna"        => $direccionCursor['comuna'],
        "region"        => $direccionCursor['region']
    );
}
}else{
   $direccion_2_Arreglo = array(
        "rut"           => "",
        "tipo"          => "",
        "direccion"     => "",
        "numero"        => "",
        "departamento"  => "",
        "villa"         => "",
        "comuna"        => "0",
        "region"        => "0"
    );  
}

$active_datos_personales = "active";
$title = " Datos Personales | UGM ";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("./headAdmin.php"); ?>
      
    </head>
    <body>
        <?php
        include("./navbarAdmin.php");
   
        include '../modal/acreditar_cambiar_password.php';
        ?>

        <div class="container">
            <div class="mx-auto">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="btn-group pull-right">

                        </div>
                        <h4><i class='glyphicon glyphicon-search'></i> Datos Personales </h4>
                    </div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" id="datos">

                            <div id="resultados_ajax"></div>

                            <legend class="text-center">Datos del Estudiante</legend>     
                            <div class="form-group">
                                <label for="rut" class="col-sm-3 control-label">Rut</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="ac_rut_estudiante" name="rut" placeholder="Rut" required maxlength="12" value="<?php echo $estudianteArreglo['rut'] ?>" readonly>
                                    <span class="error-rut"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nombre" class="col-sm-3 control-label">Nombres</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="ac_nombre_estudiante" name="nombre" placeholder="Nombres" required value="<?php echo Scape::ms_escape_string($estudianteArreglo['nombre']) ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="apellido" class="col-sm-3 control-label">Apellidos</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="ac_apellido_estudiante" name="apellido" placeholder="Apellidos" required value="<?php echo Scape::ms_escape_string($estudianteArreglo['apellido']) ?>" readonly>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="fechaNac" class="col-sm-3 control-label">Fecha Nacimiento</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" id="ac_fechaNac" name="fechaNac" placeholder="fechaNac" required  value="<?php echo $estudianteArreglo['fechaNac'] ?>" readonly>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="genero" class="col-sm-3 control-label">Genero</label>
                                <div class="col-sm-8">
                                    <select class='form-control' name='genero' id='ac_genero' required disabled>
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
                                <label for="email" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="ac_email" name="email" placeholder="Correo electrónico" required value="<?php echo $estudianteArreglo['mail'] ?>" readonly>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label for="direccion" class="col-sm-3 control-label">Direccion</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="ac_direccion" name="direccion" placeholder="Direccion" required value="<?php echo $direccion_1_Arreglo['direccion'] ?>" readonly>
                                </div>
                                <label></label>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="ac_numero" name="numero" placeholder="N°" required value="<?php echo $direccion_1_Arreglo['numero'] ?>" readonly>
                                </div>
                                <label></label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="ac_departamento" name="departamento" placeholder="Dpto. o casa" required value="<?php echo $direccion_1_Arreglo['departamento'] ?>" readonly>
                                </div>
                                <label></label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="ac_villa" name="villa" placeholder="Villa (opcional)" value="<?php echo $direccion_1_Arreglo['villa'] ?>" readonly>
                                </div> 

                            </div>
                            <div class="form-group">
                                <label for="region" class="col-sm-3 control-label">Region</label>
                                <div class="col-sm-8">
                                    <select class='form-control' name='region' id='ac_region' onclick="acreditarRecuperarComuna()" required disabled>
                                      <option value="">Selecciona region</option>  
                                        <?php
                                        $region = Region::recuperarRegion($con);


                                        while ($rw = sqlsrv_fetch_array($region)) {
                                            ?>
                                            <option value="<?php echo $rw['id_region']; ?>"><?php echo $rw['nombre_region']; ?></option>			
                                            <?php
                                        }
                                        ?>

                                    </select>                            
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="comuna" class="col-sm-3 control-label">Comuna</label>
                                <div class="col-sm-8">
                                    <select class='form-control' name='comuna' id='ac_comuna' required disabled>
                                        <option value="">Selecciona comuna</option>
                                        <?php
                                        $comuna = Comuna::recuperarComuna($con);
                                        while ($rw = sqlsrv_fetch_array($comuna)) {
                                            $rw['region'];
                                            ?>
                                            <option value="<?php echo $rw['id_comuna']; ?>"><?php echo $rw['nombre_comuna']; ?></option>			
                                            <?php
                                        }
                                        ?>
                                    </select>
                                 
                                </div>
                            </div>

                            <legend class="text-center">Telefonos</legend>
                            <div class="form-group">
                                <label for="fono" class="col-sm-3 control-label">Telefono (opcional)</label>
                                <div class="col-sm-8">
                                     <input type="tel" class="form-control" id="ac_fono" name="fono"  required value="<?php echo $estudianteArreglo['fono'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="movil" class="col-sm-3 control-label">Movil (obligatorio)</label>
                                <div class="col-sm-8">
                                     <input type="tel" class="form-control" id="ac_movil" name="movil"  required value="<?php echo $estudianteArreglo['movil'] ?>" readonly>
                                </div>
                            </div>
                            
                            <legend class="text-center">Antecedentes Academicos</legend> 

                            <div class="form-group">
                                <label for="fechaIng" class="col-sm-3 control-label">Fecha Ingreso</label>
                                <div class="col-sm-8">
                                    <select id="ac_fechaIng" name="fechaIng" class='form-control' required disabled>
                                        <option value="">Seleccione una fecha</option>
                                        <?php 
                                        $cont=date('Y');
                                        while ($cont >= 1950) { ?>
                                        <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                                        <?php $cont = ($cont - 1);
                                        }
                                        ?>
                                    </select>	  
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="carrera" class="col-sm-3 control-label">Carrera</label>
                                <div class="col-sm-8">
                                    <input class='form-control' name='carrera' id='ac_carrera' required disabled value="<?php echo $estudianteArreglo['carrera'] ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jornada" class="col-sm-3 control-label">Jornada</label>
                                <div class="col-sm-8">
                                    <select class='form-control' name='jornada' id='ac_jornada' required value="<?php echo $estudianteArreglo['jornada'] ?>" disabled>
                                        <option value="">Selecciona una Jornada</option>
                                        <?php
                                        $jornada = Jornada::recuperarJornada($con);


                                        while ($rw = sqlsrv_fetch_array($jornada)) {
                                            ?>
                                            <option value="<?php echo $rw['id_jornada']; ?>"><?php echo $rw['nombre_jornada']; ?></option>			
                                            <?php
                                        }
                                        ?>

                                    </select>

                                </div>
                            </div>

                            <legend class="text-center">Direccion Periodo Academico <p><small>(Solo si el estudiante se traslada de residencia a Santiago)</small></p></legend>

                            <div class="form-group">
                                <label for="direccion2" class="col-sm-3 control-label">Direccion</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" id="ac_direccion2" name="direccion2" placeholder="Direccion" required value="<?php echo $direccion_2_Arreglo['direccion'] ?>" readonly>
                                </div>
                                <label></label>
                                <div class="col-sm-1">
                         
                                    <input type="number" class="form-control" id="ac_numero2" name="numero2" placeholder="N°" required value="<?php echo $direccion_2_Arreglo['numero'] ?>" readonly>
                                </div>
                                <label></label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="ac_departamento2" name="departamento2" placeholder="Dpto. o casa" value="<?php echo $direccion_2_Arreglo['departamento'] ?>" readonly>
                                </div>
                                <label></label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="ac_villa2" name="villa2" placeholder="Villa (opcional)" required value="<?php echo $direccion_2_Arreglo['villa'] ?>" readonly>
                                </div> 

                            </div>

                             <div class="form-group">
                                <label for="region2" class="col-sm-3 control-label">Region</label>
                                <div class="col-sm-8">
                                    <select class='form-control' name='region2' id='ac_region2' onclick="acreditarRecuperarComuna2()" required disabled>
                                      <option value="">Selecciona region</option>  
                                        <?php
                                        $region = Region::recuperarRegion($con);


                                        while ($rw = sqlsrv_fetch_array($region)) {
                                            ?>
                                            <option value="<?php echo $rw['id_region']; ?>"><?php echo $rw['nombre_region']; ?></option>			
                                            <?php
                                        }
                                        ?>

                                    </select>      
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="comuna2" class="col-sm-3 control-label">Comuna</label>
                                <div class="col-sm-8">
                                    <select class='form-control' name='comuna2' id='ac_comuna2' required disabled>
                                        <option value="">Selecciona comuna</option>
                                        <?php
                                        $comuna = Comuna::recuperarComuna($con);
                                        while ($rw = sqlsrv_fetch_array($comuna)) {
                                            $rw['region'];
                                            ?>
                                            <option value="<?php echo $rw['id_comuna']; ?>"><?php echo $rw['nombre_comuna']; ?></option>			
                                            <?php
                                        }
                                        ?>
                                    </select>           
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-default" onclick="habilitarEdicion()">Habilitar Edicion</button>
                                <button type="button" class="btn btn-default"   data-toggle="modal" data-target="#ac_cambiar_clave">Cambiar contraseña</button>
                                <button type="button" class="btn btn-primary" id="ac_guardar_datos" onclick="editarEstudiante()" disabled>Guardar datos</button>
                            </div>	 

                        </form>
                    </div>

                </div>


            </div>      

        </div>

    <hr>
    <?php
    include("../footer.php");
    ?>
    <script type="text/javascript" src="../js/acreditarDatosPersonales_page.js"></script> 
    <script>
        
                                    //select cambian de valor segun recibe de arreglo    
                                    $('#ac_genero     option[value=<?php echo $estudianteArreglo['genero']; ?>]').prop("selected", "selected");
                                  //  $('#ac_carrera    option[value=<?php echo $estudianteArreglo['carrera']; ?>]').prop("selected", "selected");
                                    $('#ac_fechaIng   option[value=<?php echo $estudianteArreglo['fechaIng']; ?>]').prop("selected", "selected");
                                    $('#ac_jornada    option[value=<?php echo $estudianteArreglo['jornada']; ?>]').prop("selected", "selected");
                                    
                                    $('#ac_region     option[value=<?php echo $direccion_1_Arreglo['region'];?> ]').prop("selected", "selected");
                                    $('#ac_comuna     option[value=<?php echo $direccion_1_Arreglo['comuna'];?> ]').prop("selected", "selected");
                              
                                    
                                    $('#ac_region2    option[value=<?php echo $direccion_2_Arreglo['region'];?> ]').prop("selected", "selected");
                                    $('#ac_comuna2    option[value=<?php echo $direccion_2_Arreglo['comuna'];?> ]').prop("selected", "selected");
                                   
              

    </script>
    
   
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
</body>
</html>

