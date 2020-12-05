$( "#guardar_formulario" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
 
 var parametros = $(this).serialize();
 
 console.log(parametros)
	 $.ajax({
			type: "POST",
			url: "./ajax/nuevo_formulario.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax_formulario").html('<center style="padding:10px;"><label class="form-group" ><img src="./img/ajax-loader.gif"> Cargando...</label></center>');
			  },
			success: function(datos){   
			$("#resultados_ajax_formulario").html(datos);
			$('#guardar_datos').attr("disabled", false);
	
		  }
	});
  event.preventDefault();
})

$( "#enviar_formulario" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
 
    console.log("enviando...")
    if(confirm("Una vez aceptado el envió de la solicitud, no se podrán realizar modificaciones, ¿Desea enviarlo de todas formas?")){

    var parametros = $(this).serialize();
 
 console.log(parametros)
	 $.ajax({
			type: "POST",
			url: "./ajax/nueva_solicitud.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax_formulario").html('<center style="padding:10px;"><label class="form-group" ><img src="./img/ajax-loader.gif"> Cargando...</label></center>');
			  },
			success: function(datos){   
			$("#resultados_ajax_formulario").html(datos);
			$('#guardar_datos').attr("disabled", false);
	
		  },
                  complete: function (jqXHR, textStatus) {
                      setTimeout('window.location.reload()',3000);
                ;
            }
	});
  event.preventDefault();

    }
  
})


function recuperarSolicitud() {

    console.log("recuperando solicitudes...")

    var q = $("#q").val();
    var tipo_sol    = $("#tipo_sol").val();
    var estado_sol  = $("#estado_sol").val();
    var fecha_ini   = $("#rut_estudiante").val();
    var fecha_fin   = $("#rut_estudiante").val();
    
    var parametros = {
        'action'        : 'ajax',
        'page'          : 1,
        'q'             : q,
        'tipo_sol'      : tipo_sol,
        'estado_sol'    : estado_sol,
        'fecha_ini'     : fecha_ini,
        'fecha_fin'     : fecha_fin,
    };
    
    console.log(parametros)
    
    $.ajax({
        type: "POST",
        url: '../ajax/buscar_solicitud.php',
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax_formulario").html('<center style="padding:10px;"><label class="form-group" ><img src="../img/ajax-loader.gif"> Cargando...</label></center>');
        },
        success: function (datos) {
            $(".outer_div").html(datos);
            $('#guardar_datos').attr("disabled", false);
            $("#resultados_ajax_formulario").html('');
           // console.log(datos)

        }
    });


}

$( "#acreditar_enviar_formulario" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
 
    console.log("enviando...")
    if(confirm("Una vez aceptada la acreditacion de la solicitud, no podra volver a ser corregida ¿Desea continuar?")){

    var parametros = $(this).serialize();
 
 console.log(parametros)
	 $.ajax({
			type: "POST",
			url: "../ajax/acreditar_solicitud.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax_formulario").html('<center style="padding:10px;"><label class="form-group" ><img src="../img/ajax-loader.gif"> Cargando...</label></center>');
			  },
			success: function(datos){   
			$("#resultados_ajax_formulario").html(datos);
			$('#guardar_datos').attr("disabled", false);
	
		  }
	});
  event.preventDefault();

    }
  
})



 
function informeBecaInterna(){
    if(confirm("Una vez aceptado el envió de la postulacion, no se podrán realizar modificaciones, ¿Desea enviarlo de todas formas?")){
 
    var id_beca = $("#id_beca").val();
    var beca    = $("#beca").val();
    var rut     = $("#rut").val();
    var nombre     = $("#nombre").val();
    var aprobacion = $("#aprobacion_calificacion").val();
    
    
    var post_calificacion     = $("#post_calificacion").val();
    var na     = $("#na").val();
    var aa     = $("#aa").val();
    var sf     = $("#sf").val();
    var e4     = $("#e4").val();
    var ar     = $("#ar").val();
    
    var cvd    = $("#cvd option:selected").text();
    var sd     = $("#sd option:selected").text();
    var cf     = $("#cf option:selected").text();
    
    var ct     = $("#ct option:selected").text();
    var cp     = $("#cp option:selected").text();
    var cert   = $("#certificado option:selected").text();
    var ne     = $("#ne option:selected").text();
    var he     = $("#he option:selected").text();
    var bm     = $("#bm option:selected").text();
    var cae    = $("#cae option:selected").text();
    var psu    = $("#psu").val();
    
    var calificacion = $("#calificacion").val();
    
    console.log(" beca :"+beca+" reno/post :"+post_calificacion+" na :"+na+" aa :"+aa+" sf :"+sf+" e4 :"+e4+" ar :"+ar+" cvd :"+cvd+" sd :"+sd+" cf :"+cf+" ct :"+ct+" cp :"+cp+" cert :"+cert+" ne :"+ne+" he :"+he+" bm :"+bm+" cae :"+cae+" psu :"+psu+" calificacion :"+calificacion)
    
    var parametros = {
        'id_beca'       : id_beca,
        'beca'          : beca,
        'rut'           : rut,
        'nombre'        : nombre,
        'aprobacion'    : aprobacion,
        'post_calificacion': post_calificacion,
        'na'               : na,     
        'aa'               : aa,    
        'sf'               : sf,     
        'e4'               : e4,     
        'ar'               : ar,     
        'cvd'              : cvd,      
        'sd'               : sd,     
        'cf'               : cf,      
        'ct'               : ct,     
        'cp'               : cp,      
        'certificado'      : cert,     
        'ne'               : ne,     
        'he'               : he,     
        'bm'               : bm,    
        'cae'              : cae,     
        'psu'              : psu,  
        'calificacion'     : calificacion    
        
    };
    console.log(parametros)
    
	 $.ajax({
			type: "POST",
			url: "../ajax/generar_informe_beca_interna.php?action=ajax",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax_beca_interna").html('<center style="padding:10px;"><label class="form-group" ><img src="../img/ajax-loader.gif"> Cargando...</label></center>');
                        $('.guardar_datos').attr("disabled", true);

			  },
			success: function(datos){
                         console.log(datos)
			$("#resultados_ajax_beca_interna").html(datos);
			$('.guardar_datos').attr("disabled", false);	
		  }
	});
    }
}



function registrarObservacion(){

 
    var rut = $("#rut_observacion").val();
    var observacion    = $("#observacion").val();
    
    var tramo           = $("#tramo").val();
    var otro_miembro    = $("#otro_miembro").val();
    var factor          = $("#factor").val();
    var duplicidad      = $("#duplicidad").val();
    var distancia       = $("#distancia").val();
   

    var parametros = {
        'rut'           : rut,
        'observacion'   : observacion,
        'tramo'         : tramo,
        'otro_miembro'  : otro_miembro,
        'factor'        : factor,
        'duplicidad'    : duplicidad,
        'distancia'     : distancia
    };
    console.log(parametros)
    
	 $.ajax({
			type: "POST",
			url: "../ajax/nueva_observacion.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax").html('<center style="padding:10px;"><label class="form-group" ><img src="../img/ajax-loader.gif"> Cargando...</label></center>');
                        $('.guardar_datos').attr("disabled", true);

			  },
			success: function(datos){
                         console.log(datos)
                         
			$("#resultados_ajax").html(datos);
			$('.guardar_datos').attr("disabled", false);	
		  }
	});
    
}


function recuperarObservacion(){

 
    var rut = $("#rut_estudiante").val();
  
   

    var parametros = {
        'rut'           : rut,
    };
    console.log(parametros)
    
	 $.ajax({
			type: "POST",
			url: "../ajax/historial_observacion.php?action=ajax",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultado_ajax").html('<center style="padding:10px;"><label class="form-group" ><img src="../img/ajax-loader.gif"> Cargando...</label></center>');
                        $('.guardar_datos').attr("disabled", true);

			  },
			success: function(datos){
                         console.log(datos)
                         
			$("#resultado_ajax").html(datos);
			$('.guardar_datos').attr("disabled", false);	
		  }
	});
    
}

function eliminarObservacion(id){

    var parametros = {
        'id'           : id,
    };
    console.log(parametros)
  if(confirm("Una vez confirmada, esta accion no podra ser revertida ¿Desea continuar? ")){      
	 $.ajax({
			type: "POST",
			url: "../ajax/historial_observacion.php?id="+id,
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultado_ajax_mensaje").html('<center style="padding:10px;"><label class="form-group" ><img src="../img/ajax-loader.gif"> Cargando...</label></center>');
                        $('.guardar_datos').attr("disabled", true);

			  },
			success: function(datos){
                         console.log(datos)
                         
			$("#resultado_ajax_mensaje").html(datos);
			$('.guardar_datos').attr("disabled", false);
                        load(1)
		  }
	});
    }  
}
function registrarExtra(){
 console.log('enviando extra...')
 var parametros = $('#guardar_extra').serialize();

 console.log('parametros :'+parametros)
	 $.ajax({
			type: "POST",
			url: "../ajax/nuevo_extra.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax_mensaje").html('<center style="padding:10px;"><label class="form-group" ><img src="../img/ajax-loader.gif"> Cargando...</label></center>');
			  },
			success: function(datos){
                        $("#resultados_ajax_mensaje").html('')    
			$("#resultados_ajax_extra").html(datos);
			$('#guardar_datos').attr("disabled", false);
	
		  }
	});

}