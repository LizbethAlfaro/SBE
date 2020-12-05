$( "#guardar_declaracion" ).submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
 
 var parametros = $(this).serialize();
 
 console.log(parametros)
	 $.ajax({
			type: "POST",
			url: "./ajax/nueva_declaracion.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax_declaracion").html("Mensaje: Cargando...");
			  },
			success: function(datos){   
			$("#resultados_ajax_declaracion").html(datos);
			$('#guardar_datos').attr("disabled", false);
	
		  }
	});
  event.preventDefault();
})