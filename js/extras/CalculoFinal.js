
$(document).ready(function () {
 mostrarGlosa()
});

function mostrarGlosa(){
    
    var rut  = $("#rut").val();

    var parametros = {
        'action': 'glosa',
        'rut'    : rut
    };
    
    console.log(parametros)
    
  $.ajax({
			type: "POST",
			url: "../ajax/calculo_final.php",
			data: parametros,
			 beforeSend: function(objeto){
			  },
			success: function(datos){   
			$("#resultados_ajax_calculo").html(datos);
                        console.log(datos)
		  }
	});  
}


function editarVariables(){
    
    var parametros  = $("#calculo_final").serialize();

 
    console.log(parametros)
    
  $.ajax({
			type: "POST",
			url: "../ajax/editar_variables_calculo_final.php",
			data: parametros,
			 beforeSend: function(objeto){
			  },
			success: function(datos){   
			$("#resultados_ajax_mensaje").html(datos);
                        console.log(datos)
		  }
	});  
}