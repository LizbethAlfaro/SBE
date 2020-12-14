	<?php

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
      <a class="navbar-brand" href="#">SBE</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <?php
      if($tipo==2){
      ?>
    
      <?php
      }
    //  if($tipo==1){
      ?>
     
      <?php
   //  }
      ?> 
          <li class="<?php if (isset($active_resumen_atencion)) {echo $active_resumen_atencion;}?>"><a href="inicio.php"><i  class='glyphicon glyphicon-copy'></i>Inicio</a></li>
          <li class="<?php if (isset($active_acreditar)) {echo $active_acreditar;}?>"><a href="../excelumas.php"><i  class='glyphicon glyphicon-copy'></i>Extraer Excel</a></li>
          <li class="<?php if (isset($active_acreditar)) {echo $active_acreditar;}?>"><a href="asistentes.php"><i  class='glyphicon glyphicon-copy'></i>Crear Usuarios</a></li>
        
         
       </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a class="navbar-brand" ><i class=''></i><?php echo 'Asistente :'.$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente']; ?></a></li>
                <li><a href="loginAdmin.php?logout"><i class='glyphicon glyphicon-off'></i> Salir</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
