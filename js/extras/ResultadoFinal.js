
$(document).ready(function () {
 mostrarAcreditados()
});

function mostrarAcreditados(){
    
    var rut  = $("#rut").val();

    var parametros = {
        'action': 'resultado',
        'rut'    : rut
    };
    
    console.log(parametros)
    
  $.ajax({
			type: "POST",
			url: "../ajax/resultado_final.php",
			data: parametros,
			 beforeSend: function(objeto){
                        $("#resultados_ajax_calculo").html('<center style="padding:10px;"><label class="form-group" ><img src="../img/ajax-loader.gif"> Calculado Resultados...</label></center>');
			  },
			success: function(datos){   
			$("#resultados_ajax_calculo").html(datos);
                        console.log(datos)
		  }
	});  
}

function generarExcel(){
    

  $.ajax({
			type: "POST",
			url: "../ajax/generar_excel.php",
			 beforeSend: function(objeto){
                             $("#resultados_ajax_mensaje").html('<center style="padding:10px;"><label class="form-group" ><img src="../img/ajax-loader.gif"> Cargando...</label></center>');
			  },
			success: function(datos){   
			$("#resultados_ajax_mensaje").html(datos);
                        console.log(datos)
		  }
	});  
}
