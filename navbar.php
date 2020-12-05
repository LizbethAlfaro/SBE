<?php
if (isset($title)) {
require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

require_once ('./Clases/Solicitud.php');
$rut_estudiante = $_SESSION['rut_estudiante'];
$condicion = "";

$solicitud = Solicitud::recuperarSolicitud($rut_estudiante,$condicion,$con);
$solicitudArreglo;
while ($solicitudCursor = sqlsrv_fetch_array($solicitud)) {
    $solicitudArreglo = array(
        "estado"           => $solicitudCursor['estado'],

    );
}

$validar=$solicitudArreglo['estado'];

?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="#"><p> UFE - UGM </p></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li class="active"><a href="descarga.php?ruta=1"><p class="text-center"><?php if($validar!=4){    echo 'DESCARGA';}?></p><i class='glyphicon glyphicon-blackboard'></i>INSTRUCTIVO</a>
          <?php
          if($validar>0 && $validar!=4){      
          ?>
        <!--  <li class="<?php if (isset($active_informacion)) {echo $active_informacion;}?>"><a href="informacion.php"><p class="text-center">HISTORIAL</p><i  class='glyphicon glyphicon-copy'></i>SOLICITUDES</a></li>-->
          <li class="<?php if (isset($active_informacion)) {echo $active_informacion;}?>"><a href="resultados.php"><p class="text-center">RESULTADOS</p><i  class='glyphicon glyphicon-copy'></i>DE ACREDITACION</a></li>
          <li><a class="navbar-brand" ><i class=''></i><a class="btn btn-info" href="convertirPDF.php"><p class="text-center">Obtener Informe</p><i  class='glyphicon glyphicon-copy'></i></a></a></li>
          <li><a class="navbar-brand" ><i class=''></i><a class="btn btn-info" href="descarga.php"><p class="text-center">Descarga de archivos</p><i  class='glyphicon glyphicon-copy'></i></a></a></li>
          <?php
          }else{
          ?>
          ?>
          <li class="<?php if (isset($active_datos_personales)) {echo $active_datos_personales;}?>"><a href="datosPersonales.php"><p class="text-center"><?php if($validar!=4){    echo 'PASO 1';}?></p><i class='glyphicon glyphicon-user'></i>Datos Personales </a></li>
          <li class="<?php if (isset($grupo_familiar)) {echo $grupo_familiar;}?>"><a href="grupoFamiliar.php"><p class="text-center"><?php if($validar!=4){    echo 'PASO 2';}?></p><i class='glyphicon glyphicon-home'></i> Grupo Familiar </a></li>
          <li class="<?php if (isset($active_ingreso)) {echo $active_ingreso;}?>"><a href="ingresoFamiliar.php"><p class="text-center"><?php if($validar!=4){    echo 'PASO 3';}?></p><i class='glyphicon glyphicon-usd'></i> Ingreso por integrante </a></li>
          <?php if($validar==4){?><li class="<?php if (isset($active_informacion)) {echo $active_informacion;}?>"><a href="informacion.php"><p class="text-center"><?php if($validar!=4){    echo 'HISTORIAL';}?></p><i  class='glyphicon glyphicon-copy'></i>SOLICITUDES</a></li><?php }?>
   <?php
          if($validar!=4){      
   ?>         
          <li class="<?php if (isset($active_declaracion)) {echo $active_declaracion;}?>"><a href="declaracion.php"><p class="text-center">PASO 4</p><i class='glyphicon glyphicon-pencil'></i> Declaracion </a></li>
          <li class="<?php if (isset($active_horario)) {echo $active_horario;}?>"><a href="seleccionarHorario.php"><p class="text-center">PASO 5</p><i  class='glyphicon glyphicon-time'></i>Fecha Entrevista</a></li>
          <li class="<?php if (isset($active_resumen)) {echo $active_resumen;}?>"><a href="resumenSolicitud.php"><p class="text-center">PASO FINAL</p><i  class='glyphicon glyphicon-copy'></i>Resumen Solicitud</a></li>
          <?php
}}
          ?>
       </ul>
        <ul class="nav navbar-nav navbar-right">
                
                <li><a href="login.php?logout"><p></p><i class='glyphicon glyphicon-off'></i> Salir</a></li>
            </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php
}
     