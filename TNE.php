<?php

//redireccion

date_default_timezone_set('America/Argentina/Buenos_Aires');

$fecha_inicio='2020-11-19 08:00:00';
$fecha_fin='2020-11-26 23:59:00';



$fecha_actual = new DateTime(date('Y-m-d H:i:s'));
//$fecha_actual= new DateTime(date('2020-11-27 08:00:00'));
//var_dump($fecha_actual)  ;      
         
if(strtotime($fecha_inicio) >= strtotime($fecha_actual->date) || strtotime($fecha_fin) <= strtotime($fecha_actual->date)){
    header('Location: http://becasbeneficios.ugm.cl/login_mensaje.php');
    exit;                     
}



/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
        include './Clases/Integrante.php';
        
        
	$grupo_familiar="active";
	$title=" TNE | UGM";
        
        //clases para select
        include './Clases/UMAS.php';
        include './Clases/Proceso_realizar.php';
        include './Autenticacion/FormatoRut.php';
        include './Clases/Scape.php';

        if(isset($_GET['rut'])){
        $rut=$_GET['rut'];
        
        $rut_spsgsd=sinPuntosGuionRut( $rut );
       }else{
        $rut="";
        $rut_spsgsd=""; 
        $contador_estudiante = -1;   
       } 
  //      $rut="186633180";
       
       

    
        
$estudianteQuery = UMAS::TNE($rut_spsgsd,$con);
$estudianteArreglo;

if($estudianteQuery){
 $contador_estudiante = sqlsrv_num_rows($estudianteQuery); 
 
 while ($estudianteCursor = sqlsrv_fetch_array($estudianteQuery)) {
    $estudianteArreglo = array(
        "RUT"                   => $estudianteCursor['RUT'],
        "DV"                    => $estudianteCursor['DV'],
        "PATERNO"               => $estudianteCursor['PATERNO'],
        "MATERNO"               => $estudianteCursor['MATERNO'],
        "NOMBRE"                => $estudianteCursor['NOMBRE'],
        "FECHA"                 => $estudianteCursor['FECHA'],
        "ID_CARRERA"            => $estudianteCursor['ID_CARRERA'],
        "CARRERA"               => $estudianteCursor['CARRERA'],
        "JORNADA"               => $estudianteCursor['JORNADA'],
        "FECHA_MATRICULA"       => $estudianteCursor['FECHA_MATRICULA'],
        "ESTADO_ACADEMICO"      => $estudianteCursor['ESTADO_ACADEMICO'],
        "SITUACION_ACADEMICA"   => $estudianteCursor['SITUACION_ACADEMICA'],
        "MAIL_INSTITUCIONAL"    => $estudianteCursor['MAIL_INSTITUCIONAL'],
        "CELULAR"               => $estudianteCursor['CELULAR'],
    );
}
}
else{
  $contador_estudiante = -1 ;   
}




        
        
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("head.php"); ?>
    </head>
    
    <body>
     <?php 
     include("./modal/mensaje_tne_rut.php"); 
     ?>   
    
     
       <div class="container">
      
            
            <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4><i class='glyphicon glyphicon-search'></i> Validar Datos </h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-sm-4">
                            <input  class="form-control" id="rut" name="rut" value="<?php echo $rut; ?>" onkeyup="validar(this.id)" maxlength="12"> 
                        </div>
                        <label class="col-sm-1"></label>
                        <div class="form-group col-sm-4">
                            <button  class="form-control btn-success guardar_datos" onclick="recuperarTNE()">Buscar</button> 
                        </div>
                    </div>
            </div>
       
        </div>
 
<div id="resultados_ajax_tne"></div>
     
         <?php
     if ($contador_estudiante==0&& $rut!="") {
        ?>
    <script>    
$( document ).ready(function() {
    $('#mensaje_tne_rut').modal('toggle')
});
</script>    
        <?php
    }
  ?>
     
       
  
            </div>
                <div style="margin-bottom: 100px;"></div>
            <hr>
            <?php
            include("footer.php");
            ?>
            <!-- el select proviene de js -->
            <script type="text/javascript" src="js/extras/validarRut.js"></script>
     

    </body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script>
    
    $(document).ready(function($) {
//    $('#fono').mask("2-999-9999",{placeholder:"2-xxx-xxxx"});                               
    $('#fono').mask("569-999-999-99",{placeholder:"56x-xxx-xxxx-xx"});                               
    });
    
function registrarTNE(){

 var rut_estudiante       = $("#rut_estudiante")       .val();
 var proceso   = $('input:radio[name=proceso]:checked').val();
 var fono   = $("#fono")    .val();
  
 var parametros = {
        'rut_estudiante'    : rut_estudiante,
        'proceso' : proceso, 
        'fono' : fono 
    }
 
 console.log(parametros)
	 $.ajax({
			type: "POST",
			url: "./ajax/registrar_tne.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax").html("Mensaje: Cargando...");     
			  },
			success: function(datos){
			$("#resultados_ajax").html(datos);
                        console.log(datos)
                        alert('Datos enviados')
		  }
	});
 

}

function recuperarTNE(){

 var rut       = $("#rut")       .val();

  
 var parametros = {
        'rut'    : rut,
    }
 
 console.log(parametros)
	 $.ajax({
			type: "POST",
			url: "../ajax/buscar_tne.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax_tne").html("Mensaje: Cargando...");     
			  },
			success: function(datos){
			$("#resultados_ajax_tne").html(datos);
                        console.log(datos)
		  }
	});
 

}
</script>