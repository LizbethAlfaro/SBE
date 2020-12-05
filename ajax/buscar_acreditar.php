<?php
	include('is_logged_admin.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	include '../Clases/Integrante.php';
        include '../Clases/Ingreso.php';
        include '../Clases/Scape.php';
        
        
         //clases para select
        include '../Clases/Carrera.php';
        include '../Clases/Genero.php';
        include '../Clases/Estudiante.php';
        include '../Clases/FechaIng.php';
        include '../Clases/Relacion.php';
        include '../Clases/EstadoCivil.php';
	include '../Clases/NivelEducacional.php';
        include '../Clases/ActividadIntegrante.php';
        include '../Clases/Prevision.php';
        include '../Clases/Condicion.php';
        include '../Clases/TipoVivienda.php';
        include '../Clases/Tenencia.php';
        include '../Clases/Vivienda.php';
        include '../Clases/Solicitud.php';
        include '../Clases/Log.php';
        
       

        
        
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
        if(isset($_REQUEST['rut_estudiante'])){
        
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
              
            $_SESSION['estudiante_temporal']=$_REQUEST['rut_estudiante'];
            $rut_estudiante=$_SESSION['estudiante_temporal'];   
            

           
                
                
 //tipo
$condicion = "";
$tipoQuery = Solicitud::recuperarSolicitud($rut_estudiante,$condicion,$con);

$tipoArreglo;

if($tipoQuery){
  $contador_tipo = sqlsrv_num_rows($tipoQuery);
}else{
  $contador_tipo = 0;  
}
if($contador_tipo>0){
 while ($tipoCursor = sqlsrv_fetch_array($tipoQuery)) {
$tipoArreglo = array(
        "tipo"      => $tipoCursor['tipo'],
    );
}   
}else{
$tipoArreglo = array(
        "tipo"      => "",
    );    
}

 $estado = "2";
 Solicitud::editarSolicitud($rut_estudiante,$estado,$tipoArreglo['tipo'],$con);
 $accion = "Comenzo revision de solicitud del estudiante $rut_estudiante";
 Log::registrarLog($_SESSION['rut_asistente'],$_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'],$accion,$con);

               
                ?>
                   <script type="text/javascript">
//  $('#acreditar_guardar_ingresos').submit(function( event ) {
//  $('#acreditar_guardar_ingresos_datos').attr("disabled", true);
function acreditarIngreso(){
 console.log("registrando ingresos")
  
 var parametros = $('#acreditar_guardar_ingresos').serialize();
 
 console.log(parametros)
	 $.ajax({
			type: "POST",
			url: "../ajax/acreditar_ingreso.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax_acreditar_ingreso").html("Mensaje: Cargando...");
			  },
			success: function(datos){   
			$("#resultados_ajax_acreditar_ingreso").html(datos);
			$('#acreditar_guardar_ingresos_datos').attr("disabled", false);
	
		  }
	});
 // event.preventDefault();
//})
}
</script>

<script type="text/javascript" src="../js/extras/Suma.js"></script>   

  <form id="guardar_tipo_sol">
                <div class="panel panel-success">
              
                        <div class="panel-heading">
                            <div class="btn-group pull-right">
                                <input type="hidden" name="rut_estudiante" value="<?php echo$rut_estudiante; ?>">
                                <button type="submit" class="btn btn-success" id="guardar_datos_tipo_sol">Guardar datos</button>
                     
                            </div>
                            
                            <h4><i class='glyphicon glyphicon-home'></i> Tipo de solicitud </h4>
                        </div>
               
                <div class="panel-body text-center">
             <div id="resultados_ajax_tipo_sol"></div>
                  
                    
                    <label>Renovante <input class="form-control" id="r1" type="radio" value="1" name="tipo_sol"></label>
                    <label></label>
                    <label>Postulante<input class="form-control" id="r2" type="radio" value="2" name="tipo_sol"></label>
               
                </div>
                </div>    
        </form>
  
        <script>

             switch('<?php echo $tipoArreglo['tipo']; ?>'){
                 case '1': $("#r1").prop("checked", true);   
                 break;
                 case '2': $("#r2").prop("checked", true);   
                 break;
                 default :
             }
   
           $( "#guardar_tipo_sol" ).submit(function( event ) {
          $('#guardar_datos_tipo_sol').attr("disabled", true);
         console.log("acreditar tipo sol")
          
         var parametros = $(this).serialize();
         
         console.log(parametros)
        	 $.ajax({
        			type: "POST",
        			url: "../ajax/acreditar_tipo_solicitud.php",
        			data: parametros,
        			 beforeSend: function(objeto){
        			$("#resultados_ajax_tipo_sol").html("Mensaje: Cargando...");
        			  },
        			success: function(datos){   
        			$("#resultados_ajax_tipo_sol").html(datos);
        			$('.guardar_datos_tipo_sol').attr("disabled", false);
        	
        		  }
        	});
          event.preventDefault();
        })
        </script>
                <?php
                
                
                $vivienda = Vivienda::recuperarVivienda($rut_estudiante, $con);

                $viviendaArreglo;
                if($vivienda){
                    
                while ($viviendaCursor = sqlsrv_fetch_array($vivienda)) {
                $viviendaArreglo = array(
                "rut" => $viviendaCursor['rut_estudiante'],
                "tenencia" => $viviendaCursor['tenencia_vivienda'],
                "tipo" => $viviendaCursor['tipo_vivienda']
                );
                }
                
                }
                ?>
                 <div class="panel panel-success">
  
                        <div class="panel-heading">
                            <div class="btn-group pull-right">
                                 <input class="btn btn-success" id="guardar_datos" type="button" value="Agregar datos de vivienda" onclick="registrarVivienda()">
                            </div>
                            <h4><i class='glyphicon glyphicon-home'></i> Vivienda </h4>
                        </div>   
                        <div class="panel-body">   
                        <form class="form-horizontal" >
                            <div id="resultados_ajax_vivienda"></div>      
                            <input type="hidden" id="rut_estudiante" value="<?php echo $rut_estudiante; ?>">    

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label>Tipo de vivienda</label>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                               
                                            <select class='form-control' name='tipo_vivienda' id='tipo_vivienda' required>
                                
                                                <option value="">Tipo de vivienda</option>
                                                <?php
                                                $tipo_vivienda = TipoVivienda::recuperarTipoVivienda($con);

                                                while ($rw = sqlsrv_fetch_array($tipo_vivienda)) {
                                                    ?>
                                                    <option value="<?php echo $rw['id_tipoVivienda']; ?>"><?php echo $rw['nombre_tipoVivienda']; ?></option>			
                                                    <?php
                                                }
                                                ?>
                                            </select>  

                                        </div>
                                    </div>
                                </div>
                                <label></label>
                                <div class="col-md-4">
                                    <label>Tenencia de vivienda</label>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <select class='form-control' name='tenencia_vivienda' id='tenencia_vivienda' required>
                                                <option value="">Tenencia de vivienda</option>
                                                <?php
                                                $tenencia_vivienda = Tenencia::recuperarTenencia($con);

                                                while ($rw = sqlsrv_fetch_array($tenencia_vivienda)) {
                                                    ?>
                                                    <option value="<?php echo $rw['id_tenencia']; ?>"><?php echo $rw['nombre_tenencia']; ?></option>			
                                                    <?php
                                                }
                                                ?>
                                            </select> 	  
                                        </div>
                                    </div>
                                </div>
                            </div>
 
                        </form>
                    </div>
                </div>

         
     <!-- el select proviene de js -->
            <script type="text/javascript" src="../js/extras/validarRut.js"></script> 
          <script type="text/javascript">
   $("#nuevoIntegrante").on('hidden.bs.modal', function () {
           location.reload() 
    });
$('#acreditarEditarIntegranteEstudiante').on('show.bs.modal', function (event) {
    console.log("modal estudiante integrante")
    var button = $(event.relatedTarget) // Button that triggered the modal
  
    var rut         =   button.data('rut')        
    var estado      =   button.data('estado')   
    var nivel       =   button.data('nivel')   
    var actividad   =   button.data('actividad')   
    var prevision   =   button.data('prevision')   
    var otprevision =   button.data('otraprevision') 
    var condicion   =   button.data('condicion')   
    var enfermedad  =   button.data('enfermedad')
    
    console.log("estudiante integrante :"+rut);
    var modal = $(this)
    
    modal.find('.modal-body #ac_mod_rut_i_e')          .val(rut)
    modal.find('.modal-body #ac_mod_estado_i_e')       .val(estado)
    modal.find('.modal-body #ac_mod_nivel_i_e')        .val(nivel)
    modal.find('.modal-body #ac_mod_actividad_i_e')    .val(actividad)
    modal.find('.modal-body #ac_mod_prevision_i_e')    .val(prevision)
    modal.find('.modal-body #ac_mod_otraprevision_i_e').val(otprevision)
    modal.find('.modal-body #ac_mod_condicion_i_e')    .val(condicion)
    modal.find('.modal-body #ac_mod_enfermedad_i_e')   .val(enfermedad)
    
    console.log("prevision :"+prevision+" condicion :"+condicion)
    if(prevision==5){
    $("#ac_mod_otraprevision_i_e").css("visibility", "visible");
    }else{
     $("#ac_mod_otraprevision_i_e").css("visibility", "hidden");    
    }
    if(condicion==1 || condicion==2){
    $("#ac_mod_enfermedad_i_e").css("visibility", "visible");
    }else{
      $("#ac_mod_enfermedad_i_e").css("visibility", "hidden");    
    }
})               
            
$('#acreditarEditarIntegrante').on('show.bs.modal', function (event) {
    console.log("modal acreditar editar integrante")
    var button = $(event.relatedTarget) // Button that triggered the modal
  
    var rut         =   button.data('rut')      
    var nombre      =   button.data('nombre')   
    var apellido    =   button.data('apellido')   
    var genero      =   button.data('genero')   
    var fecha       =   button.data('fecha')   
    var relacion    =   button.data('relacion')   
    var estado      =   button.data('estado')   
    var nivel       =   button.data('nivel')   
    var actividad   =   button.data('actividad')   
    var prevision   =   button.data('prevision')   
    var otprevision =   button.data('otraprevision') 
    var condicion   =   button.data('condicion')   
    var enfermedad  =   button.data('enfermedad')
    
    var modal = $(this)
    
    modal.find('.modal-body #ac_mod_rut')          .val(rut)
    modal.find('.modal-body #ac_mod_nombre')       .val(nombre)
    modal.find('.modal-body #ac_mod_apellido')     .val(apellido)
    modal.find('.modal-body #ac_mod_genero')       .val(genero)
    modal.find('.modal-body #ac_mod_fechaNac')     .val(fecha)
    modal.find('.modal-body #ac_mod_relacion')     .val(relacion)
    modal.find('.modal-body #ac_mod_estado')       .val(estado)
    modal.find('.modal-body #ac_mod_nivel')        .val(nivel)
    modal.find('.modal-body #ac_mod_actividad')    .val(actividad)
    modal.find('.modal-body #ac_mod_prevision')    .val(prevision)
    modal.find('.modal-body #ac_mod_otraprevision').val(otprevision)
    modal.find('.modal-body #ac_mod_condicion')    .val(condicion)
    modal.find('.modal-body #ac_mod_enfermedad')   .val(enfermedad)
    
    if(prevision==5){
    $("#ac_mod_otraprevision").css("visibility", "visible");
    }else{
     $("#ac_mod_otraprevision").css("visibility", "hidden");    
    }
    if(condicion==1 || condicion==2){
    $("#ac_mod_enfermedad").css("visibility", "visible");
    }else{
    $("#ac_mod_enfermedad").css("visibility", "hidden");    
    }
})

          </script>
           
 
            
            <script type="text/javascript">
            $('#tipo_vivienda        option[value= <?php echo $viviendaArreglo['tipo']; ?>]').prop("selected", "selected");
            $('#tenencia_vivienda    option[value= <?php echo $viviendaArreglo['tenencia']; ?>]').prop("selected", "selected");
            $('#tenencia_vivienda    option[value= <?php echo $viviendaArreglo['tenencia']; ?>]').prop("selected", "selected");
            </script>
            
            
            
            <?php
             include '../modal/acreditar_editar_integrante.php';
             include '../modal/acreditar_editar_integrante_estudiante.php';
             include '../modal/acreditar_registro_integrante.php';
            ?>
             <div class="panel panel-success">
  
                        <div class="panel-heading">
                            <div class="btn-group pull-right">
                                <button type='button' class="btn btn-success" data-toggle="modal" data-target="#nuevoIntegrante"><span class="glyphicon glyphicon-plus" ></span> Agregar Integrante </button>
                            </div>
                            <h4><i class='glyphicon glyphicon-search'></i> Integrantes Familiares </h4>
                        </div>   
                        <div class="panel-body">   
   
                      
                        </form>

                        <!-- el select de la bd se carga en los div -->
<?php                        
               $sWhere = "";
                
                $result = Integrante::recuperarIntegrante($rut_estudiante,"",$con,"","","");
           
		$numrows= sqlsrv_num_rows($result);                        
if ($numrows>0){
			
         
			?>
<div class="table-responsive">                           
<table id="tabla_acreditar" class="table">
                                
                                
				<tr  class="success">          
                                    <th class="col-sm-2">Rut</th>
					<th class="col-sm-2">Nombre</th>
					<th class="col-sm-2">Apellido</th>
                                        <th>Genero</th>
                                        <th>Edad</th>
                                        <th>Parentesco</th>
                                        <th>Estado civil</th>
                                        <th>Educacion</th>
                                        <th>Actividad</th>
                                        <th>Prevision</th>
                                        <th>Condicion</th>              
                                        <th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				 while ($row = sqlsrv_fetch_array($result)){
                                     
                                    $cumpleanos = new DateTime($row['fechaNac_integrante']);
                                    $hoy = new DateTime();
                                    $annos = $hoy->diff($cumpleanos);
                                     
                                     
                                    $rut_integrante=$row['rut_integrante'];
                                    $nombre_integrante=$row['nombre_integrante'];
                                    $apellido_integrante=$row['apellido_integrante'];
                                    $id_genero_integrante=$row['genero_integrante'];
                                    $genero_integrante=$row['nombre_genero'];
                                    $fechaNac_integrante=$row['fechaNac_integrante'];
                                    $edad_integrante= $annos->y; 
                                    $id_relacion_integrante=$row['relacion_integrante'];
                                    $relacion_integrante=$row['nombre_relacion'];
                                    $id_estadoCivil_integrante=$row['estadoCivil_integrante'];
                                    $estadoCivil_integrante=$row['nombre_estado'];
                                    $id_nivelEduc_integrante=$row['nivelEduc_integrante'];
                                    $nivelEduc_integrante=$row['nombre_nivel'];
                                    $id_actividad_integrante=$row['actividad_integrante'];
                                    $actividad_integrante=$row['nombre_actividad'];
                                    $id_prevision_integrante=$row['prevision_integrante'];
                                    $prevision_integrante=$row['nombre_prevision'];
                                    $otraprevision_integrante=$row['otraPrevision_integrante'];
                                    $id_condicion_integrante=$row['condicion_integrante'];
                                    $condicion_integrante=$row['nombre_condicion'];
                                    $enfermedad_integrante=$row['enfermedad_integrante'];
                   
					?>
					<tr>	
                                                        <td><?php echo $rut_integrante; ?></td>
                                                        <td><?php echo $nombre_integrante; ?></td>
                                                        <td><?php echo $apellido_integrante; ?></td>
                                                        <td><?php echo $genero_integrante; ?></td>
                                                        <td><?php echo $edad_integrante; ?></td>
                                                        <td><?php echo $relacion_integrante; ?></td>
                                                        <td><?php echo $estadoCivil_integrante; ?></td>
                                                        <td><?php echo $nivelEduc_integrante; ?></td>
                                                        <td><?php echo $actividad_integrante; ?></td>
                                                        <td><?php echo $prevision_integrante; ?></td>
                                                        <td><?php echo $condicion_integrante; ?></td>
                                       
                                                    

						
					<td class='text-right'>
						
                                                <?php
                                                if($rut_integrante!=$rut_estudiante){
                                                ?>
                                            <a href="#" class='btn btn-default' title='Editar Integrante' 
                                                   data-rut=            '<?php echo $rut_integrante;?>' 
                                                   data-nombre=         '<?php echo $nombre_integrante;?>' 
                                                   data-apellido=       '<?php echo $apellido_integrante;?>' 
                                                   data-genero=         '<?php echo $id_genero_integrante;?>'
                                                   data-fecha=          '<?php echo $fechaNac_integrante;?>'
                                                   data-relacion=       '<?php echo $id_relacion_integrante;?>'
                                                   data-estado=         '<?php echo $id_estadoCivil_integrante;?>'
                                                   data-nivel=          '<?php echo $id_nivelEduc_integrante;?>'
                                                   data-actividad=      '<?php echo $id_actividad_integrante;?>'
                                                   data-prevision=      '<?php echo $id_prevision_integrante;?>'
                                                   data-otraprevision=  '<?php echo $otraprevision_integrante;?>'
                                                   data-condicion=      '<?php echo $id_condicion_integrante;?>'
                                                   data-enfermedad=     '<?php echo $enfermedad_integrante;?>'
                                                   data-toggle="modal" data-target="#acreditarEditarIntegrante"><i class="glyphicon glyphicon-edit"></i></a>
                                                   
						<a href="#" class='btn btn-default' title='Borrar Integrante' onclick="eliminarIntegrante('<?php echo $rut_estudiante; ?>','<?php echo $rut_integrante; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
                                                <?php
                                                }else{
                                                ?>
                                                <a href="#" class='btn btn-default' title='Editar Integrante' 
                                                   data-rut=            '<?php echo $rut_integrante;?>' 
                                                   data-estado=         '<?php echo $id_estadoCivil_integrante;?>'
                                                   data-nivel=          '<?php echo $id_nivelEduc_integrante;?>'
                                                   data-actividad=      '<?php echo $id_actividad_integrante;?>'
                                                   data-prevision=      '<?php echo $id_prevision_integrante;?>'
                                                   data-otraprevision=  '<?php echo $otraprevision_integrante;?>'
                                                   data-condicion=      '<?php echo $id_condicion_integrante;?>'
                                                   data-enfermedad=     '<?php echo $enfermedad_integrante;?>'
                                                   data-toggle="modal" data-target="#acreditarEditarIntegranteEstudiante"><i class="glyphicon glyphicon-edit"></i></a>
                                                <?php
                                                }
                                                ?>
                                                
					</td>
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=4><span class="pull-right">
					<?php
			//		 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
                                
                                
</table>
</div>
                        </div>
                 </div>
            
     
            
 

			<?php
		}
?>

            
     
            
            
                      
                                <form class="form-horizontal" id="acreditar_guardar_ingresos">     
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <div class="btn-group pull-right">
                              
                                                <button type="button" class="btn btn-success" id="acreditar_guardar_ingresos_datos" onclick="acreditarIngreso()">Guardar datos</button>
                                            </div>
                                            <h4><i class='glyphicon glyphicon-search'></i> Ingreso por integrante </h4>
                                        </div>
                                        <div class="panel-body">
                                            <div id="resultados_ajax_acreditar_ingreso"></div>
                                            <input type="hidden" id="rut_estudiante" name="rut_estudiante" value="<?php echo $rut_estudiante; ?>"> 

<?php
$result = Integrante::recuperarIntegrante($rut_estudiante,"",$con,"","","");
$numrows = sqlsrv_num_rows($result);
if ($numrows > 0) {
        ?>
        <div class="table-responsive">
            <table class="table">
                <tr  class="success">          
                    <th class="col-sm-2">Rut</th>
                     
                    <th>Sueldos</th>
                    <th>Pensiones</th>
                    <th>Honorarios</th>
                    <th>Retiros</th>
                    <th>Dividendo por acciones</th>
                    <th>Intereses de capitales moviliarios</th>
                    <th>Ganancias de capitales moviliarios</th>
                    <th>Pension Alimenticia y otros aportes de parientes</th>
                    <th>Actividades independientes</th>
                    <th>Total</th>
                </tr>
        <?php
        $id_dinamico=0;
        while ($row = sqlsrv_fetch_array($result)) {
            $rut_integrante = $row['rut_integrante'];
            $nombre_integrante = $row['nombre_integrante'];
            $apellido_integrante = $row['apellido_integrante']; 
            $result_ingreso = Ingreso::recuperarIngreso($rut_integrante,$rut_estudiante, $con, "", "","");
            $row = sqlsrv_fetch_array($result_ingreso);
            
            if($row!=null){
            $sueldo         = $row['sueldo_integrante'];
            $pension        = $row['pension_integrante'];
            $honorario      = $row['honorario_integrante'];
            $retiro         = $row['retiro_integrante'];
            $dividendo      = $row['dividendo_integrante'];
            $interes        = $row['interes_integrante'];
            $ganancia       = $row['ganancia_integrante'];
            $pension_alim   = $row['pension_alim_integrante'];
            $actividad      = $row['actividad_integrante'];         
            }else{
            $sueldo         = 0;
            $pension        = 0;
            $honorario      = 0;
            $retiro         = 0;
            $dividendo      = 0;
            $interes        = 0;
            $ganancia       = 0;
            $pension_alim   = 0;
            $actividad      = 0;
            }
            $total      = $sueldo+$pension+$honorario+$retiro+$dividendo+$interes+$ganancia+$pension_alim+$actividad;
            ?>
                
                    <tr>          
                        <td class="col-sm-2"><?php echo $rut_integrante; ?><input type="hidden" class="form-control" name="rut_integrantes[]" value="<?php echo $rut_integrante; ?>" readonly required></td>
                        <input type="hidden" class="form-control" name="nombre_integrantes[]" value="<?php echo $nombre_integrante; ?>" readonly required>
                        <input type="hidden" class="form-control" name="apellido_integrantes[]" value="<?php echo $apellido_integrante; ?>" readonly required>  
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_sueldo"     name="sueldo_integrante[]"        type="number" required value="<?php echo $sueldo; ?>"       ></td>
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_pensionl"   name="pension_integrante[]"       type="number" required value="<?php echo $pension; ?>"      ></td>
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_honorario"  name="honorario_integrante[]"     type="number" required value="<?php echo $honorario; ?>"    ></td>
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_retiro"     name="retiro_integrante[]"        type="number" required value="<?php echo $retiro; ?>"       ></td>
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_dividendol" name="dividendo_integrante[]"     type="number" required value="<?php echo $dividendo; ?>"    ></td>
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_interes"    name="interes_integrante[]"       type="number" required value="<?php echo $interes; ?>"      ></td>
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_ganancia"   name="ganancia_integrante[]"      type="number" required value="<?php echo $ganancia; ?>"     ></td>
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_pension"    name="pension_alim_integrante[]"  type="number" required value="<?php echo $pension_alim; ?>" ></td>
                        <td><input class="form-control ingreso<?php echo $id_dinamico; ?>" onchange="totalFila(<?php echo $id_dinamico; ?>)" id="ingreso_actividad"  name="actividad_integrante[]"     type="number" required value="<?php echo $actividad; ?>"    ></td>
                        <td><input class="form-control total" id="ingreso_total<?php echo $id_dinamico; ?>" name="ingreso_total[]" required  readonly  value="<?php echo $total; ?>"></td>
                    </tr>       
  
  
              
            <?php
            $id_dinamico++;
        }
        ?>
            </table>
        </div>
              </div>
        </div>

                                  
                                    
            <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4><i class='glyphicon glyphicon-bitcoin'></i> Ingreso total mensual por año </h4>
                    </div>
                    <div class="panel-body">
                        <table border="0" class="table text-center">
                            <tbody>
                                <tr>
                                    <td>AÑO</td>
                                    <td>TOTAL MENSUAL</td>
                                </tr>
                                <tr>
                                    <td><?php echo date('Y'); ?></td>
                                    <td id="total"></td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>
            </div>
            </div>    
            <div class="col-sm-6">
            <div class="panel panel-success">
                    <div class="panel-heading">
                        <h4><i class='glyphicon glyphicon-bitcoin'></i> Ingreso percap </h4>
                    </div>
                    <div class="panel-body">
                        <table border="0" class="table text-center">
                            <tbody>

                                <tr>
                                    <td>PERCAP</td>
                                    <td id="percap"></td>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>
            </div>
            </div>
            </div>    
      

           
        <?php
    }
    ?>
                                        </div>
                                    </div>
                                </form>
            
 

                            
                        
<?php		
	}
        }
?>