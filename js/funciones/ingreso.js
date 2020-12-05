	
$('#guardar_ingresos').submit(function( event ) {
  $('#guardar_datos').attr("disabled", true);
 console.log("registrando ingresos")
  
 var parametros = $(this).serialize();
 
 console.log(parametros)
	 $.ajax({
			type: "POST",
			url: "./ajax/nuevo_ingreso.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax").html("Mensaje: Cargando...");
			  },
			success: function(datos){   
			$("#resultados_ajax").html(datos);
			$('#guardar_datos').attr("disabled", false);
	
		  }
	});
  event.preventDefault();
})



function eliminarIngreso(integrante)
{
    console.log('eliminar ingreso')

 var parametros = {
        'id': integrante,
    }

    if (confirm("Realmente deseas eliminar el ingreso ")) {
        $.ajax({
            type: "GET",
            url: "./ajax/buscar_ingreso.php",
            data: parametros,
            beforeSend: function (objeto) {
                $("#resultados2").html("Mensaje: Cargando...");
            },
            success: function (datos) {
                $("#resultados2").html(datos);
                console.log(datos)
                load(1);
            }
        });
    }
}



function recuperarIngreso(){
                        var page=1;
                        var integrante   = $("#integrante").val();
			var parametros={
                            'action':'ajax',
                            'page':page,
                            'rut_integrante':integrante,
      
                        };
			$("#loader").fadeIn('slow');
			$.ajax({
				data: parametros,
				url:'./ajax/buscar_ingreso.php',
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
}

function recuperarIngreso2(){
                        var page=1;
                        var rut_estudiante = $("#rut_estudiante").val();
			var parametros={
                            'action':'ajax_2',
                            'rut_estudiante':rut_estudiante,
                            'page':page,
                        };
			$("#loader").fadeIn('slow');
			$.ajax({
				data: parametros,
				url:'./ajax/buscar_ingreso.php',
				 beforeSend: function(objeto){
				 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(data){
					$(".outer_div").html(data).fadeIn('slow');
					$('#loader').html('');
					
				}
			})
}



