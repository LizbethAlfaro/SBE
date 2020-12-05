<?php


// se crea el objeto login para ingresar y salir de la session de manera simple





    // si no se logea direcciona envia mensaje de error
    ?>
	<!DOCTYPE html>
<html lang="es">

  
    
<head>
<!--    <link rel="shortcut icon" type="image/x-icon" href="/img/ugm.jpg" />-->
<link rel="icon" type="image/png" href="/img/ugm.png" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title> Login | UGM </title>
  
        <!-- Jquery 2.2.4 -->
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <!-- CSS  -->
        <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>

             

	
<body>
    <!--modal-->

    <!--modal-->
    

 <div class="">
     <div class="container-fluid">
         
         <div class="col-sm-6">
             <div class="card card-container">
          
            <img id="profile-img" class="profile-img-card" src="img/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>


            <form method="post" accept-charset="utf-8" action="Resultados_prueba2.php" name="loginform" autocomplete="off" role="form" class="form-signin">
                <span class="error-rut"></span>  
                <input class="form-control" placeholder="Usuario" name="rut" id="rut" type="text"  autofocus="" required maxlength="12" onkeyup="validar(this.id)">
             
                <button type="submit" class="btn btn-lg btn-success btn-block btn-signin" name="login" id="submit">Probar resultados</button>
            </form><!-- /form -->
       
   
        </div><!-- /card-container -->
        </div> 
       
         
         

   
        
     </div>     
    </div><!-- /container -->
    
  </body>
<?php
	include("footer.php");
?>
  

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  
  <script type="text/javascript" src="js/extras/validarRut.js"></script>
  <script type="text/javascript" src="js/funciones/estudiante.js"></script>
  <script type="text/javascript" src="js/funciones/comuna_becas.js"></script>
  <script type="text/javascript" src="js/estudiante_page.js"></script>
  
  <script>
 $(document).ready(function () {
    recuperarComunaBeca()
});


$("#registro_becas_internas").on('hidden.bs.modal', function () {
    
$("#rut_estudiante_beca").val("");    
$("#beca").val("");    
$("#fechaNac").val("");    
$("#email").val("");    
$("#direccion").val("");    
$("#numero").val("");    
$("#departamento").val("");    
$("#villa").val(""); 
//$("#region_beca").val(13); 
//$("#comuna_beca").val(70); 
$("#fono").val(""); 
$("#movil").val(""); 
$(".error-rut").html("");

$(".alert alert-success").html("");
$(".alert alert-error").html(""); 
$(".alert alert-info").html(""); 
});

$("#modalEstudiante").on('hidden.bs.modal', function () {
$("#rut_estudiante").val("");    
$("#password_nueva").val("");    
$("#password_repetir").val("");    
$(".error-rut").html("");

$(".alert alert-success").html("");
$(".alert alert-error").html(""); 
$(".alert alert-info").html(""); 
});


  </script>
</html>

	<?php



