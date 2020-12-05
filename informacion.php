<?php
session_start();
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}


$active_informacion = "active";
$title = " Informacion | UGM";
//include $_SERVER['DOCUMENT_ROOT']."/BecasBeneficios/config/db.php";
//include $_SERVER['DOCUMENT_ROOT']."/BecasBeneficios/config/conexion.php";
//include $_SERVER['DOCUMENT_ROOT']."/BecasBeneficios/Clases/Informe.php";
//include $_SERVER['DOCUMENT_ROOT']."/BecasBeneficios/Clases/Horario.php";

include $_SERVER['DOCUMENT_ROOT']."/config/db.php";
include $_SERVER['DOCUMENT_ROOT']."/config/conexion.php";
include $_SERVER['DOCUMENT_ROOT']."/Clases/Informe.php";
include $_SERVER['DOCUMENT_ROOT']."/Clases/Horario.php";

setlocale(LC_ALL,"es_ES");

$rut = $_SESSION['rut_estudiante'];

$result = Informe::recuperarInforme($rut,$con);

$contador = sqlsrv_num_rows($result);


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("head.php"); ?>

    </head>
    <body>
        <?php
        include("navbar.php");
//        if ($validar==0) {
//    header("location: datosPersonales.php");
//    exit;
//}
        ?>

        <div class="container text-center" >
            <div class="panel panel-success">
                <div class="panel-body">
                    <h1>HISTORIAL DE SOLICITUDES</h1>  
                </div>


                <div class="panel-heading">
                    <div>IMPORTANTE!!!</div>
                    <p>El dia de la entrevista recuerda traer todos los documentos necesarios que aparecen en el siguiente enlace:</p>
                    <p>&nbsp</p>
                    <p><a class="alert alert-warning" role="alert" href="descarga.php">DOCUMENTOS&nbspNECESARIOS</a></p>
                </div>

                <div class="panel-body">
                    <div id="loader"></div>
                    <table border="0" class="table">
                        <thead>
                            <tr>
                                <th class="text-center">TIPO</th>
                                <th class="text-center">FECHA</th>
                                <th class="text-center">ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = sqlsrv_fetch_array($result)){
                        ?>
                            <tr>
                                <td><?php echo $row['tipo']; ?></td>
                                <td><?php echo Horario::fechaCastellano((date("Y-m-d H:i:s", strtotime($row['fecha'])))); ?></td>
      
<!--                              <td><a href="/BecasBeneficios/descarga.php?ruta=<?php echo $row['ruta'];?>">Descargar</a></td>-->
                              <td><a href="/descarga.php?ruta=<?php echo $row['ruta'];?>">Descargar</a></td>
                            </tr>
                        <?php
                        }
                        ?>    
                        </tbody>   
                    </table>

 <?php
 
 ?>
                </div>
       
            </div>

        </div>
        <footer style="margin-bottom: 100px;"></footer>
        <hr>
        <?php
        include("footer.php");
        ?>
    
    </body>
</html>
