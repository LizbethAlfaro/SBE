function recuperarHorarioDisp(){
  
    var rut_estudiante  = $("#rut_estudiante")      .val();
    var modulo_sel      = $("#modulo_sel")          .val();
    var fecha_sel       = $("#fecha_sel")           .val();
    var fecha_actual    = $("#fecha_actual")        .val();
    var modulo_reg      = $("#modulo_registrado")   .val();
    var fecha_reg       = $("#fecha_registrada")    .val();
    
    var parametros = {
        'action': 'ajax',
        'rut_estudiante'    : rut_estudiante,
        'modulo_sel'        : modulo_sel,
        'fecha_sel'         : fecha_sel,
        'fecha_actual'      : fecha_actual,
        'modulo_reg'        : modulo_reg,
        'fecha_reg'         : fecha_reg
    };
    
    console.log(parametros)
    
  $.ajax({
			type: "POST",
			url: "ajax/buscar_horario_disponible.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax_horario_disponible").html("Mensaje: Cargando...");
			  },
			success: function(datos){   
			$("#resultados_ajax_horario_disponible").html(datos);
			$('#guardar_datos').attr("disabled", false);
        
		  }
	});  
}



function seleccionarCita(rut_estudiante,modulo_sel,fecha_sel){
  
    var parametros = {
        'rut_estudiante': rut_estudiante,
        'modulo_sel'    : modulo_sel,
        'fecha_sel'     : fecha_sel,
    };
    
    console.log(parametros)
    
  $.ajax({
			type: "POST",
			url: "ajax/nueva_cita.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){     
			$("#resultados_ajax").html(datos);
                        recuperarHorarioDisp()
                        console.log(datos)

		  }
	}); 

}


$( "#guardar_horario" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
 
  
 var parametros = $(this).serialize();
 
 console.log(parametros)
	 $.ajax({
			type: "POST",
			url: "../ajax/nuevo_horario.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax_guardar_horario").html("Mensaje: Cargando...");
			  },
			success: function(datos){   
			$("#resultados_ajax_guardar_horario").html(datos);
			$('#guardar_datos').attr("disabled", false);
	
		  }
	});
  event.preventDefault();
})

$( "#modificar_horario" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);

 var parametros = $(this).serialize();
 
 console.log(parametros)
	 $.ajax({
			type: "POST",
			url: "../ajax/editar_horario.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax_mod_horario").html("Mensaje: Cargando...");
			  },
			success: function(datos){   
			$("#resultados_ajax_mod_horario").html(datos);
			$('#guardar_datos').attr("disabled", false);
		        location.reload();
		  }
	});
  event.preventDefault();
})


$( "#semana_fecha" ).submit(function( event ) {
  $('#calendario').attr("disabled", true);   

 var parametros = $(this).serialize();
 
 console.log(parametros)
	 $.ajax({
			type: "POST",
			url: "../horario.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){   
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})

function confirmation(rut_estudiante,modulo_sel,fecha_sel) {
    if(confirm("Realmente desea confirmar este horario?")){
     seleccionarCita(rut_estudiante,modulo_sel,fecha_sel)
    }else{
     return false;   
    }     
}

function estadoSeleccionar(id,rut_estudiante,modulo_sel,fecha_sel){
$('.seleccion').html("Disponible");       
      
$('#'+id).html("Seleccionado");     
console.log("seleccion :"+id+" rut_estudiante :"+rut_estudiante+" modulo_sel :"+modulo_sel+" fecha_sel :"+fecha_sel)
confirmation(rut_estudiante,modulo_sel,fecha_sel)
}


//RE AGENDAR
function recuperarHorarioDisp2(){
  
    var rut_estudiante  = $("#rut_estudiante")      .val();
    var modulo_sel      = $("#modulo_sel")          .val();
    var fecha_sel       = $("#fecha_sel")           .val();
    var fecha_actual    = $("#fecha_actual")        .val();
    var modulo_reg      = $("#modulo_registrado")   .val();
    var fecha_reg       = $("#fecha_registrada")    .val();
    
    var nombre_estudiante    = $("#nombre_estudiante")        .val();
    var mail_estudiante      = $("#mail_estudiante")   .val();
    var nombre_asistente     = $("#nombre_asistente")    .val();
    
    var parametros = {
        'action': 'ajax',
        'rut_estudiante'    : rut_estudiante,
        'modulo_sel'        : modulo_sel,
        'fecha_sel'         : fecha_sel,
        'fecha_actual'      : fecha_actual,
        'modulo_reg'        : modulo_reg,
        'fecha_reg'         : fecha_reg,
        
        'nombre_estudiante' : nombre_estudiante,
        'mail_estudiante'   : mail_estudiante,
        'nombre_asistente'  : nombre_asistente
    };
    
    console.log(parametros)
    
  $.ajax({
			type: "POST",
			url: "../ajax/reagendar_horario_disponible.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax_reagendar_cita").html("Mensaje: Cargando...");
			  },
			success: function(datos){   
			$("#resultados_ajax_reagendar_cita").html(datos);
			$('#guardar_datos').attr("disabled", false);
        
		  }
	});  
}

function reagendarConfirmation(rut_estudiante,modulo_sel,fecha_sel,nombre_estudiante,mail_estudiante,nombre_asistente) {
    if(confirm("Realmente desea confirmar este horario?")){
     reagendarSeleccionarCita(rut_estudiante,modulo_sel,fecha_sel,nombre_estudiante,mail_estudiante,nombre_asistente)
    }else{
     return false;   
    }     
}

function reagendarEstadoSeleccionar(id,rut_estudiante,modulo_sel,fecha_sel,nombre_estudiante,mail_estudiante,nombre_asistente){
$('.seleccion').html("Disponible");       
      
$('#'+id).html("Seleccionado");     
console.log("seleccion :"+id+" rut_estudiante :"+rut_estudiante+" nombre :"+nombre_estudiante+" mail :"+mail_estudiante+" modulo_sel :"+modulo_sel+" fecha_sel :"+fecha_sel+" asistente:"+nombre_asistente)
reagendarConfirmation(rut_estudiante,modulo_sel,fecha_sel,nombre_estudiante,mail_estudiante,nombre_asistente)
}


function reagendarSeleccionarCita(rut_estudiante,modulo_sel,fecha_sel,nombre_estudiante,mail_estudiante,nombre_asistente){
  
    var parametros = {
        'rut_estudiante': rut_estudiante,
        'modulo_sel'    : modulo_sel,
        'fecha_sel'     : fecha_sel,
        
         'nombre_estudiante'   : nombre_estudiante,
         'mail_estudiante'     : mail_estudiante,
         'nombre_asistente'    : nombre_asistente
    };
    
    console.log(parametros)
    
  $.ajax({
			type: "POST",
			url: "../ajax/reagendar_cita.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax").html("<img src='../img/ajax-loader.gif'> Enviando Correo...'");
			  },
			success: function(datos){     
			$("#resultados_ajax").html(datos);
                        recuperarHorarioDisp2()
                        console.log(datos)

		  }
	}); 

}

//$( "#reagendar_cita" ).submit(function( event ) {
//  $('#guardar_datos').attr("disabled", true);
//
// var parametros = $(this).serialize();
// 
// console.log(parametros)
//	 $.ajax({
//			type: "POST",
//			url: "../ajax/reagendar_cita.php",
//			data: parametros,
//			 beforeSend: function(objeto){
//			$("#resultados_ajax_reagendar_cita").html("Mensaje: Cargando...");
//			  },
//			success: function(datos){   
//			$("#resultados_ajax_reagendar_cita").html(datos);
//			$('#guardar_datos').attr("disabled", false);
//		        location.reload();
//		  }
//	});
//  event.preventDefault();
//})

/*
$( "#citacion" ).submit(function( event ) {
  $('#calendario').attr("disabled", true);   

 var parametros = $(this).serialize();
 
 console.log(parametros)
	 $.ajax({
			type: "POST",
			url: "seleccionarHorario.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){   
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
			load(1);
		  }
	});
  event.preventDefault();
})
*/
