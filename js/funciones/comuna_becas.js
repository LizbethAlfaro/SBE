


function recuperarComunaBeca(){
    var region  = $("#region_beca").val();

    var parametros = {
        'action': 'ajax',
        'region'    : region
    };
    
    console.log(parametros)
    
  $.ajax({
			type: "POST",
			url: "ajax/buscar_comuna.php",
			data: parametros,
			 beforeSend: function(objeto){
			  },
			success: function(datos){   
			$("#comuna_beca").html(datos);
                        $('#comuna_beca').prop("disabled", false)
                        console.log(datos)
		  }
	});  
}
function recuperarComuna2Beca(){
    var region  = $("#region2_beca").val();

    var parametros = {
        'action': 'ajax',
        'region'    : region
    };
    
    console.log(parametros)
    
  $.ajax({
			type: "POST",
			url: "ajax/buscar_comuna.php",
			data: parametros,
			 beforeSend: function(objeto){
			  },
			success: function(datos){   
			$("#comuna2_beca").html(datos);
                        $('#comuna2_beca').prop("disabled", false)
                        console.log(datos)
		  }
	});  
}


function recuperarComunaBecaAdmin(){
    var region  = $("#region_beca").val();

    var parametros = {
        'action': 'ajax',
        'region'    : region
    };
    
    console.log(parametros)
    
  $.ajax({
			type: "POST",
			url: "../ajax/buscar_comuna.php",
			data: parametros,
			 beforeSend: function(objeto){
			  },
			success: function(datos){   
			$("#comuna_beca").html(datos);
                        $('#comuna_beca').prop("disabled", false)
                        console.log(datos)
		  }
	});  
}