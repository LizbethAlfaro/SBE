<?php

require_once ("config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php"); //Contiene funcion que conecta a la base de datos



$active_ingreso = "active";
$title = "Reportes | Campus";


?>
<!DOCTYPE html>
<html lang="en">
    <body>

    <?php
include("head.php");
?>
 <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    
        <div class="container-fluid" style="margin-top: 200px; width : 1000px" >
            <div class="row">
            <div class="col-sm-4">

                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4>Carga de Alumnos </h4>
                    </div>
                    <div class="panel-body">
                        <form action="campusAlumno.php" method="POST">
                        <table border="0" class="table">
                            <tbody>
                                <tr>
                                    <label>Periodo </label>
                                   <input class="form-control" type="number" name="periodo" required>
                                </tr>
                                <tr>
                                    <label>Año </label>
                                   <input class="form-control" type="number" name="anhio" required>
                                </tr>
                            </tbody>
                            
                            <tfoot>
                            <label>&nbsp</label>   
                                <input  class="form-control default" type="submit" value="Extraer Excel">
                            </tfoot>
                        </table>
                        </form>
                    </div>
            </div>
            </div>   
            
            <div class="col-sm-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4>Carga de Docentes </h4>
                    </div>
                    <div class="panel-body">
                        <form action="campusDocente.php" method="POST">
                        <table border="0" class="table">
                            <tbody>
                                <tr>
                                    <label>Periodo </label>
                                   <input class="form-control" type="number" name="periodo" required>
                                </tr>
                                <tr>
                                    <label>Año </label>
                                   <input class="form-control" type="number" name="anhio" required>
                                </tr>
                            </tbody>
                            
                            <tfoot>
                            <label>&nbsp</label>   
                                <input  class="form-control default" type="submit" value="Extraer Excel">
                            </tfoot>
                        </table>
                        </form>
                    </div>
            </div>
            </div> 

            <div class="col-sm-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h4>Carga de Ayudantes </h4>
                    </div>
                    <div class="panel-body">
                        <form action="campusAyudante.php" method="POST">
                        <table border="0" class="table">
                            <tbody>
                                <tr>
                                    <label>Periodo </label>
                                   <input class="form-control" type="number" name="periodo" required>
                                </tr>
                                <tr>
                                    <label>Año </label>
                                   <input class="form-control" type="number" name="anhio" required>
                                </tr>
                            </tbody>
                            
                            <tfoot>
                            <label>&nbsp</label>   
                                <input  class="form-control default" type="submit" value="Extraer Excel">
                            </tfoot>
                        </table>
                        </form>
                    </div>
            </div>
            </div> 
 
            </div> 
            <div style="height: 100px;"></div>
      </div> 
  
      
     
        


    </body>
</html>
