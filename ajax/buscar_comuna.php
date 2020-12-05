<?php

require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos
include '../Clases/Comuna.php';

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if ($action == 'ajax') {

    $region = $_POST['region'];
    $result = Comuna::recuperarComuna($con);

    if($result){
    $numrows = sqlsrv_num_rows($result);

    if ($numrows > 0) {

        while ($row = sqlsrv_fetch_array($result)) {
            if($region == $row['region']){
            $id_comuna = $row['id_comuna'];
            $nombre_comuna = $row['nombre_comuna'];
            ?>
              <option value="<?php echo $id_comuna; ?>"><?php echo $nombre_comuna; ?></option>	
            <?php  
            }
        }
    }
}

        }
?>