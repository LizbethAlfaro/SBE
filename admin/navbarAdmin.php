	<?php
		if (isset($title))
		{
        $tipo = $_SESSION['tipo_asistente'];           
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
      <a class="navbar-brand" href="#">UFE - ADMINISTRADOR</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <?php
      if($tipo==2){
      ?>
      <li class="<?php if (isset($active_asignar_horario)) {echo $active_asignar_horario;}?>"><a href="asignarHorarioSemanal.php"><i  class='glyphicon glyphicon-copy'></i>Horario Semanal</a></li>
      <li class="<?php if (isset($active_modificar_horario)) {echo $active_modificar_horario;}?>"><a href="modificarHorario.php"><i  class='glyphicon glyphicon-copy'></i>Edicion Horario</a></li> 
      <li class="<?php if (isset($active_asistentes)) {echo $active_asistentes;}?>"><a href="asistentes.php"><i  class='glyphicon glyphicon-copy'></i>Asistentes</a></li>
      <li class="<?php if (isset($active_registro_acciones)) {echo $active_registro_acciones;}?>"><a href="registroAcciones.php"><i  class='glyphicon glyphicon-copy'></i>LOG</a></li>
      <li class="<?php if (isset($active_procesos)) {echo $active_procesos;}?>"><a href="procesos.php"><i  class='glyphicon glyphicon-copy'></i>Procesos</a></li>
      <?php
      }
    //  if($tipo==1){
      ?>
      <li class="<?php if (isset($active_horario_personal)) {echo $active_horario_personal;}?>"><a href="horarioPersonal.php"><i  class='glyphicon glyphicon-copy'></i>Horario Personal</a></li>
      <?php
   //  }
      ?> 
          <li class="<?php if (isset($active_resumen_atencion)) {echo $active_resumen_atencion;}?>"><a href="resumenAtencion.php"><i  class='glyphicon glyphicon-copy'></i>Resumen Atencion</a></li>
          <li class="<?php if (isset($active_acreditar)) {echo $active_acreditar;}?>"><a href="acreditar.php"><i  class='glyphicon glyphicon-copy'></i>Beca Socieconomica</a></li>
          <li class="<?php if (isset($active_beca)) {echo $active_beca;}?>"><a href="becaInterna.php"><i  class='glyphicon glyphicon-copy'></i>Beca Interna</a></li>
          <li class="<?php if (isset($active_caso_especial)) {echo $active_caso_especial;}?>"><a href="casoEspecial.php"><i  class='glyphicon glyphicon-copy'></i>Ingreso de Casos Especiales</a></li>
         
       </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a class="navbar-brand" ><i class=''></i><?php echo 'Asistente :'.$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente']; ?></a></li>
                <li><a href="loginAdmin.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	<?php
		}
	?>