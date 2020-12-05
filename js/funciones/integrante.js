function recuperarIntegrante(){
    
    var page = 1
    var q = $("#q").val();
    var rut_estudiante = $("#rut_estudiante").val();
    
    console.log("estudiante :"+rut_estudiante)
    $("#loader").fadeIn('slow');
    $.ajax({
        url: './ajax/buscar_integrante.php?action=ajax&page=' + page + '&q=' + q,
        data: "rut_estudiante=" + rut_estudiante,
        beforeSend: function (objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function (data) {
            console.log(data)
            $(".outer_div").html(data).fadeIn('slow');         
            $('#loader').html('');

        }
    })
}

function registrarVivienda(){

 var rut_estudiante       = $("#rut_estudiante")       .val();
 var tipo_vivienda        = $("#tipo_vivienda")        .val();
 var tenencia_vivienda    = $("#tenencia_vivienda")    .val();
 
 var parametros = {
        'rut_estudiante'    : rut_estudiante,
        'tipo_vivienda'     : tipo_vivienda,
        'tenencia_vivienda' : tenencia_vivienda   
    }
 
 console.log(parametros)
	 $.ajax({
			type: "POST",
			url: "./ajax/nueva_vivienda.php",
			data: parametros,
			 beforeSend: function(objeto){
			$("#resultados_ajax_vivienda").html("Mensaje: Cargando...");     
			  },
			success: function(datos){
			$("#resultados_ajax_vivienda").html(datos);
                        console.log(datos)
		  }
	});
 

}



function eliminarIntegrante(rut_est,rut_int)
{
    console.log("estudiante: "+rut_est+" integrante: "+rut_int)
    
    var parametros = {
        'rut_est': rut_est,
        'rut_int': rut_int,
    }
    
    if (confirm("Realmente deseas eliminar este integrante")) {
        $.ajax({
            type: "GET",
            url: "./ajax/buscar_integrante.php",
            data: parametros,
            beforeSend: function (objeto) {
                $("#resultados").html("Mensaje: Cargando...");
            },
            success: function (datos) {
                console.log("dat: "+ datos)
                $("#resultados2").html(datos);
                load(1);
            }
        });
    }
}

function registrarIntegrante(){
    console.log("registrar integrante")
    var rut             = $("#rut")                        .val();
    var nombre          = $("#nombre_integrante")           .val();
    var apellido        = $("#apellido_integrante")         .val();
    var genero          = $("#genero_integrante")           .val();
    var fechaNac        = $("#fechaNac_integrante")         .val();
    var relacion        = $("#relacion_integrante")         .val();
    var estadoCivil     = $("#estadoCivil_integrante")      .val();
    var nivelEduc       = $("#nivelEducacional_integrante") .val();
    var actividad       = $("#actividadIntegrante")         .val();
    var prevision       = $("#prevision_integrante")        .val();
    var otraprevision   = $("#otraPrevision_integrante")    .val();
    var condicion       = $("#condicion_integrante")        .val();
    var enfermedad      = $("#enfermedad_integrante")       .val();
   
    var parametros = {
        'rut': rut,
        'nombre': nombre,
        'apellido': apellido,
        'genero': genero,
        'fechaNac': fechaNac,
        'relacion': relacion,
        'estadoCivil': estadoCivil,
        'nivelEduc': nivelEduc,
        'actividad': actividad,
        'prevision': prevision,
        'otraprevision': otraprevision,
        'condicion': condicion,
        'enfermedad': enfermedad     
    }
    
      $.ajax({
        type: "POST",
        url: "./ajax/nuevo_integrante.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax").html(datos);
            $('#guardar_datos').attr("disabled", false);
            load(1);
        }
    });  
}




function editarIntegrante(){
 
    var rut             = $("#mod_rut")              .val();
    var nombre          = $("#mod_nombre")           .val();
    var apellido        = $("#mod_apellido")         .val();
    var genero          = $("#mod_genero")           .val();
    var fechaNac        = $("#mod_fechaNac")         .val();
    var relacion        = $("#mod_relacion")         .val();
    var estadoCivil     = $("#mod_estado")           .val();
    var nivelEduc       = $("#mod_nivel") .val();
    var actividad       = $("#mod_actividad")        .val();
    var prevision       = $("#mod_prevision")        .val();
    var otraprevision   = $("#mod_otraprevision")    .val();
    var condicion       = $("#mod_condicion")        .val();
    var enfermedad      = $("#mod_enfermedad")       .val();
   
    var parametros = {
        'rut': rut,
        'nombre': nombre,
        'apellido': apellido,
        'genero': genero,
        'fechaNac': fechaNac,
        'relacion': relacion,
        'estadoCivil': estadoCivil,
        'nivelEduc': nivelEduc,
        'actividad': actividad,
        'prevision': prevision,
        'otraprevision': otraprevision,
        'condicion': condicion,
        'enfermedad': enfermedad     
    }
    
    $.ajax({
        type: "POST",
        url: "./ajax/editar_integrante.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax_editar").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax_editar").html(datos);
            $('#actualizar_datos').attr("disabled", false);
            console.log("datos :"+datos)
            load(1);
        }
    });   
}

function editarIntegranteEstudiante(){
 
    var rut             = $("#mod_rut_i_e")              .val();
    var estadoCivil     = $("#mod_estado_i_e")           .val();
    var nivelEduc       = $("#mod_nivel_i_e")            .val();
    var actividad       = $("#mod_actividad_i_e")        .val();
    var prevision       = $("#mod_prevision_i_e")        .val();
    var otraprevision   = $("#mod_otraprevision_i_e")    .val();
    var condicion       = $("#mod_condicion_i_e")        .val();
    var enfermedad      = $("#mod_enfermedad_i_e")       .val();
   
    var parametros = {
        'rut': rut,
        'estadoCivil': estadoCivil,
        'nivelEduc': nivelEduc,
        'actividad': actividad,
        'prevision': prevision,
        'otraprevision': otraprevision,
        'condicion': condicion,
        'enfermedad': enfermedad     
    }
    
    console.log(parametros)
    
    $.ajax({
        type: "POST",
        url: "./ajax/editar_integrante_estudiante.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax_editar_i_e").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax_editar_i_e").html(datos);
            $('#actualizar_datos').attr("disabled", false);
            console.log("datos :"+datos)
            load(1);
        }
    });   
}
