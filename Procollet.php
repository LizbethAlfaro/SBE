<?php

require_once("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("config/conexion.php"); //Contiene funcion que conecta a la base de datos



$active_ingreso = "active";
$title = "Reportes | Campus";


?>
<!DOCTYPE html>
<html lang="en">

<body>

    <?php
    include("head.php");
    ?>
    <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection" />

    <div class="container-fluid" style="margin-top: 200px; width : 1000px">
        <div class="row">
            <div class="col-sm-4">

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4>Procollet</h4>
                    </div>
                    <div class="panel-body">
                        <form action="ProcolletCSV.php" method="POST">
                            <label id='mensaje' style="visibility: hidden;">Espere mientras se descarga el archivo...</label>
                            <table border="0" class="table">
                                <tbody>
                                <tfoot>
                                    <label>&nbsp</label>
                                    <input class="form-control default" type="submit" value="Extraer Excel" onclick="document.getElementById('mensaje').style.visibility='visible' ">
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div style="height: 100px;"></div>
    </div>






</body>

</html>