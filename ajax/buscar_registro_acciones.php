<?php

include('is_logged_admin.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database */
require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
include '../Clases/Log.php';

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if ($action == 'ajax') {

    $q            = $_REQUEST['q'];
    $accion       = $_REQUEST['accion'];
    $fecha_inicio = $_REQUEST['fecha_inicio'];
    $fecha_termino= $_REQUEST['fecha_termino'];

    $aColumns = array('rut_asistente','asistente'); //Columnas de busqueda
    $sWhere = "";
    $sWhere .= "  WHERE  (";
    for ($i = 0; $i < count($aColumns); $i++) {
        $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
    }
    $sWhere = substr_replace($sWhere, "", -3);
    $sWhere .= ')';
    
    if ($accion!= "") {
        $sWhere .= " AND accion ". "LIKE '%" . $accion . "%'";
    }
    
    if (($fecha_inicio && $fecha_termino) != "") {
        $sWhere .= " AND fecha BETWEEN '$fecha_inicio' AND '$fecha_termino' ";
    }
    
    $result = Log::recuperarLog($sWhere,$con);
    

    if($result){
    $numrows = sqlsrv_num_rows($result);

    if ($numrows > 0) {

            ?>
<table border="0" class="table">
    <thead class="thead-dark">
                        <tr>
                            <th>RUT</th>
                            <th>ASISTENTE</th>
                            <th>ACCION</th>
                            <th>FECHA</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php
            while ($row = sqlsrv_fetch_array($result)) {
         
            $rut_asistente  = $row['rut_asistente'];   
            $asistente      = $row['asistente'];
            $accion         = $row['accion'];
            $fecha          = date('d-m-Y H:i:s', strtotime($row['fecha']));
            
            ?>
                  
                        <tr>
                            <td><?php echo $rut_asistente; ?></td>
                            <td><?php echo $asistente; ?></td>
                            <td><?php echo $accion; ?></td>
                            <td><?php echo $fecha; ?></td>
                        </tr>
            <?php
            }
            ?>            

                    </tbody>
                </table>
           
            <?php  
            
        
    }
}

        }
?>