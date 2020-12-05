<?php

include('is_logged_admin.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database */
require_once ("../config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once ("../config/conexion.php"); //Contiene funcion que conecta a la base de datos

include '../Clases/Horario.php';
include '../Clases/Asistente.php';
include '../Clases/Estudiante.php';

$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if ($action == 'ajax') {

    //fechas
    $fecha_actual = $_POST['fecha'];
    
    $dia_1 = Horario::fechaDiaCastellano($fecha_actual);
    $dia_2 = Horario::fechaDiaCastellano(date("d-m-Y", strtotime($fecha_actual . "+ 1 days")));
    $dia_3 = Horario::fechaDiaCastellano(date("d-m-Y", strtotime($fecha_actual . "+ 2 days")));
    $dia_4 = Horario::fechaDiaCastellano(date("d-m-Y", strtotime($fecha_actual . "+ 3 days")));
    $dia_5 = Horario::fechaDiaCastellano(date("d-m-Y", strtotime($fecha_actual . "+ 4 days")));
    $dia_6 = Horario::fechaDiaCastellano(date("d-m-Y", strtotime($fecha_actual . "+ 5 days")));
    $dia_7 = Horario::fechaDiaCastellano(date("d-m-Y", strtotime($fecha_actual . "+ 6 days")));

    $dia_1_value = substr($fecha_actual, 0, 10);
    $dia_2_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 1 days")), 0, 10);
    ;
    $dia_3_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 2 days")), 0, 10);
    ;
    $dia_4_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 3 days")), 0, 10);
    ;
    $dia_5_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 4 days")), 0, 10);
    ;
    $dia_6_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 5 days")), 0, 10);
    ;
    $dia_7_value = substr(date("Y-m-d", strtotime($fecha_actual . "+ 6 days")), 0, 10);
    ;
            
  //asistentes
    $rut_asistente = ""; //todos los asistentes
    $condicion = ""; // sin condicion extra
    $habilitados = "1"; // que esten activos
    
    $result_asistente = Asistente::recuperarAsistente($rut_asistente,$condicion,$habilitados,$con);

   
   
    
     if($result_asistente){
     $numrows = sqlsrv_num_rows($result_asistente);
     
    
  
     ?>  
            <table border="0" class="table">
                    <thead  class="thead-dark">
                        <tr>
                            <th>Asistente</th>
                            <th class="text-center bg-info"><?php echo $dia_1; ?></th>
                            <th class="text-center"><?php echo $dia_2; ?></th>
                            <th class="text-center bg-info"><?php echo $dia_3; ?></th>
                            <th class="text-center"><?php echo $dia_4; ?></th>
                            <th class="text-center bg-info"><?php echo $dia_5; ?></th>
                            <th class="text-center"><?php echo $dia_6; ?></th>
                            <th class="text-center bg-info"><?php echo $dia_7; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
    if ($numrows > 0) {
        
         //modal
         include '../modal/acreditar_cita.php';

        while ($row = sqlsrv_fetch_array($result_asistente)) {
        if($row['rut_asistente']!='00.000.000-0'){    
           $rut_asistente       = $row['rut_asistente'];
           $nombre_asistente    = $row['nombre_asistente'];
           $apellido_asistente  = $row['apellido_asistente'];

          
            ?>
                      
             <tr>
                            <td><?php echo $nombre_asistente." ".$apellido_asistente;?></td>
                            <td class="bg-info">
                            <?php
                             $result_resumen_1 = Horario::resumenAtencion($rut_asistente, $dia_1_value, $con);
                             $contador_1= sqlsrv_num_rows($result_resumen_1);
                             //modal
                            $dia=$dia_1_value; 
                            if($contador_1>0){
                                echo "<h6 class='text-center'><a href='' data-rut='".$rut_asistente."' data-fecha='".$dia_1_value."' data-toggle='modal' data-target='#acreditar_cita'>Estudiantes Asignados:</a></h6><h3 class='text-center'>".$contador_1."</h3>";
                            }else{
                                echo "<h6 class='text-center'>Estudiantes Asignados:</h6><h3 class='text-center'>".$contador_1."</h3>"; 
                            }                
                            ?>
                            </td>
                             <td>
                            <?php
                             $result_resumen_2 = Horario::resumenAtencion($rut_asistente, $dia_2_value, $con);
                             $contador_2= sqlsrv_num_rows($result_resumen_2);
                             //modal
                            $dia=$dia_2_value; 
                            if($contador_2>0){
                                echo "<h6 class='text-center'><a href='' data-rut='".$rut_asistente."' data-fecha='".$dia_2_value."' data-toggle='modal' data-target='#acreditar_cita'>Estudiantes Asignados:</a></h6><h3 class='text-center'>".$contador_2."</h3>";
                            }else{
                                echo "<h6 class='text-center'>Estudiantes Asignados:</h6><h3 class='text-center'>".$contador_2."</h3>"; 
                            }                
                            ?>
                            </td>
                            <td class="bg-info">
                            <?php
                             $result_resumen_3 = Horario::resumenAtencion($rut_asistente, $dia_3_value, $con);
                             $contador_3= sqlsrv_num_rows($result_resumen_3);
                             //modal
                            $dia=$dia_3_value; 
                            if($contador_3>0){
                                echo "<h6 class='text-center'><a href='' data-rut='".$rut_asistente."' data-fecha='".$dia_3_value."' data-toggle='modal' data-target='#acreditar_cita'>Estudiantes Asignados:</a></h6><h3 class='text-center'>".$contador_3."</h3>";
                            }else{
                                echo "<h6 class='text-center'>Estudiantes Asignados:</h6><h3 class='text-center'>".$contador_3."</h3>"; 
                            }                
                            ?>
                            </td>
                             <td>
                            <?php
                             $result_resumen_4 = Horario::resumenAtencion($rut_asistente, $dia_4_value, $con);
                             $contador_4= sqlsrv_num_rows($result_resumen_4);
                             //modal
                            $dia=$dia_4_value; 
                            if($contador_4>0){
                                echo "<h6 class='text-center'><a href='' data-rut='".$rut_asistente."' data-fecha='".$dia_4_value."' data-toggle='modal' data-target='#acreditar_cita'>Estudiantes Asignados:</a></h6><h3 class='text-center'>".$contador_4."</h3>";
                            }else{
                                echo "<h6 class='text-center'>Estudiantes Asignados:</h6><h3 class='text-center'>".$contador_4."</h3>"; 
                            }                
                            ?>
                            </td>
                            <td class="bg-info">
                            <?php
                             $result_resumen_5 = Horario::resumenAtencion($rut_asistente, $dia_5_value, $con);
                             $contador_5= sqlsrv_num_rows($result_resumen_5);
                             //modal
                            $dia=$dia_5_value; 
                            if($contador_5>0){
                                echo "<h6 class='text-center'><a href='' data-rut='".$rut_asistente."' data-fecha='".$dia_5_value."' data-toggle='modal' data-target='#acreditar_cita'>Estudiantes Asignados:</a></h6><h3 class='text-center'>".$contador_5."</h3>";
                            }else{
                                echo "<h6 class='text-center'>Estudiantes Asignados:</h6><h3 class='text-center'>".$contador_5."</h3>"; 
                            }                
                            ?>
                            </td>
                             <td>
                            <?php
                             $result_resumen_6 = Horario::resumenAtencion($rut_asistente, $dia_6_value, $con);
                             $contador_6= sqlsrv_num_rows($result_resumen_6);
                             //modal
                            $dia=$dia_6_value; 
                            if($contador_6>0){
                                echo "<h6 class='text-center'><a href='' data-rut='".$rut_asistente."' data-fecha='".$dia_6_value."' data-toggle='modal' data-target='#acreditar_cita'>Estudiantes Asignados:</a></h6><h3 class='text-center'>".$contador_6."</h3>";
                            }else{
                                echo "<h6 class='text-center'>Estudiantes Asignados:</h6><h3 class='text-center'>".$contador_6."</h3>"; 
                            }                
                            ?>
                            </td>
                            <td class="bg-info">
                            <?php
                             $result_resumen_7 = Horario::resumenAtencion($rut_asistente, $dia_7_value, $con);
                             $contador_7= sqlsrv_num_rows($result_resumen_7);
                             //modal
                            $dia=$dia_7_value; 
                            if($contador_7>0){
                                echo "<h6 class='text-center'><a href='' data-rut='".$rut_asistente."' data-fecha='".$dia_7_value."' data-toggle='modal' data-target='#acreditar_cita'>Estudiantes Asignados:</a></h6><h3 class='text-center'>".$contador_7."</h3>";
                            }else{
                                echo "<h6 class='text-center'>Estudiantes Asignados:</h6><h3 class='text-center'>".$contador_7."</h3>"; 
                            }                
                            ?>
                            </td>
                            
             </tr>           
            <?php
        }
    }}
    ?>
                        
                    </tbody>
                </table>

<script>
    $('#acreditar_cita').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal

	  var rut   = button.data('rut') 
          var fecha = button.data('fecha') 

          estudianteAsignado(rut,fecha)

	  var modal = $(this)
	  modal.find('.modal-body #rut').val(rut)
          modal.find('.modal-body #fecha').val(fecha)

}) 

function estudianteAsignado(rut,fecha){ 

console.log(rut)
    $.ajax({
        url: '../ajax/buscar_resumen_atencion.php?action=ajax_2&rut='+rut+'&fecha='+fecha,
        beforeSend: function (objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function (data) {
            $("#resultado_acreditar_cita").html(data).fadeIn('slow');
            $('#loader').html('');
            console.log(data)

        }
    })
}


</script>

     <?php         

}}

if ($action == 'ajax_2') {
    
    $rut    = $_REQUEST['rut'];
    $fecha  = $_REQUEST['fecha'];

  //  echo $rut." ".$fecha;
    ?>

<table border="0" class="table">
                                    <thead>
                                        <tr>
                                            <th>Rut</th>
                                            <th>Estudiante</th>
                                            <th>Email</th>
                                            <th>Telefono</th>
                                            <th>Re-agendar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                             <?php      
                             $result_resumen = Horario::resumenAtencion($rut, $fecha, $con);
                             
                             if ($result_resumen) {
                             $contador_resumen= sqlsrv_num_rows($result_resumen);
                             }else{
                             $contador_resumen=0;    
                             }
                             
                             if($contador_resumen>0){
                             while($row = sqlsrv_fetch_array($result_resumen)){
                             $rut_estudiante    = $row['rut_estudiante'];   
                             $result_estudiante = Estudiante::recuperarEstudiante($rut_estudiante, $con,"","","");  
                             $row_estudiante = sqlsrv_fetch_array($result_estudiante);
                             
                                $rut        = $row_estudiante['rut_estudiante'];
                                $nombre     = $row_estudiante['nombre_estudiante'];
                                $apellido   = $row_estudiante['apellido_estudiante'];
                                $mail       = $row_estudiante['mail_estudiante'];    
                                $telefono   = $row_estudiante['movil_estudiante'];  
                                 
 
                            ?>
                                        
                                        <tr>
                                            <td><?php echo $rut;?></td>
                                            <td><?php echo $nombre." ".$apellido;?></td>
                                            <td><?php echo $mail;?></td>
                                            <td><?php echo $telefono;?></td>
                                            <td><a class="btn btn-success col-sm-12" href="../admin/reagendarCita.php?rut_estudiante=<?php echo $rut_estudiante;?>&estudiante=<?php echo $nombre." ".$apellido;?>&mail=<?php echo $mail;?>&asistente=<?php echo $_SESSION['nombre_asistente']." ".$_SESSION['apellido_asistente'];?>">Re-agendar</a></td>
                                        </tr>
                            <?php
                             }}
                            ?>
                                    </tbody>
                                        </table>


<?php
}
?>



