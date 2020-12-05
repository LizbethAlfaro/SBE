function registrarFechaProceso(){

 var id_proceso       = $("#id_proceso")       .val();
 var fecha_inicio     = $("#fecha_inicio")     .val();
 var fecha_termino    = $("#fecha_termino")    .val();
 
 var parametros = {
        'id_proceso'    : id_proceso,
        'fecha_inicio'  : fecha_inicio,
        'fecha_termino' : fecha_termino   
    }
 
 console.log(parametros)
	 $.ajax({
			type: "POST",
			url: "../ajax/proceso.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax_proceso").html("Mensaje: Cargando...");     
			  },
			success: function(datos){
			$("#resultados_ajax_proceso").html(datos);
                        console.log(datos)
		  }
	});
 

}









function aperturaCierreProceso(estado){
 
    var id_proceso      = $("#id_proceso")   .val();
    var pass            = $("#pass")         .val();
   
    var parametros = {
        'id_proceso': id_proceso,
        'estado': estado,
        'pass': pass 
    }
     if(confirm("Una vez confirmada esta accion no podra ser revertida ¿Desea continuar? ")){   
    $.ajax({
        type: "POST",
        url: "../ajax/proceso_apertura_cierre.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax_proceso").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax_proceso").html(datos);
            $('#actualizar_datos').attr("disabled", false);
            console.log("datos :"+datos)
        }
    }); 
    
     }
}

