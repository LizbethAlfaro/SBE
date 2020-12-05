<?php

include('is_logged_admin.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database */
require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
include '../Clases/Informe.php';
include '../Clases/Horario.php';

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if ($action == 'ajax') {

    $rut = $_REQUEST['rut_estudiante'];

    $result = Informe::recuperarInforme($rut,$con);

    if($result){
    $numrows = sqlsrv_num_rows($result);

    if ($numrows > 0) {

                        while ($row = sqlsrv_fetch_array($result)){
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $row['tipo']; ?></td>
                                <td class="text-center"><?php echo Horario::fechaCastellano((date("Y-m-d H:i:s", strtotime($row['fecha'])))); ?></td>
     
<!--                                <td><a href="/BecasBeneficios/descarga.php?ruta=<?php echo $row['ruta'];?>">Descargar</a></td>-->
                                 <td><a href="/descarga.php?ruta=<?php echo $row['ruta'];?>">Descargar</a></td>
                            </tr>
                        <?php
                        }
 
            }
        
    }
}

        
?>