function recuperarAcreditar(){
    
    var page = 1

    var rut_estudiante = $("#rut_estudiante_acreditar").val();
    
    
    console.log("estudiante :"+rut_estudiante)
    $("#loader").fadeIn('slow');
    $.ajax({
        url: '../ajax/buscar_acreditar.php?action=ajax&page=' + page,
        data: "rut_estudiante=" + rut_estudiante,
        beforeSend: function (objeto) {
            $('#acreditar_integrante').html('<img src="../img/ajax-loader.gif"> Cargando...');
        },
        success: function (data) {
            console.log("data :"+data)
            $("#acreditar_integrante").html(data).fadeIn('slow');         
            $('#loader').html('');

        }
    })
}


//clon de js

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
			url: "../ajax/acreditar_vivienda.php",
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
function registrarIntegrante(){
    console.log("acreditar registrar integrante")
    
    var rut_estudiante  = $("#rut_estudiante_acreditar")       .val();
    var rut             = $("#ac_rut")                         .val();
    var nombre          = $("#ac_nombre_integrante")           .val();
    var apellido        = $("#ac_apellido_integrante")         .val();
    var genero          = $("#ac_genero_integrante")           .val();
    var fechaNac        = $("#ac_fechaNac_integrante")         .val();
    var relacion        = $("#ac_relacion_integrante")         .val();
    var estadoCivil     = $("#ac_estadoCivil_integrante")      .val();
    var nivelEduc       = $("#ac_nivelEducacional_integrante") .val();
    var actividad       = $("#ac_actividadIntegrante")         .val();
    var prevision       = $("#ac_prevision_integrante")        .val();
    var otraprevision   = $("#ac_otraPrevision_integrante")    .val();
    var condicion       = $("#ac_condicion_integrante")        .val();
    var enfermedad      = $("#ac_enfermedad_integrante")       .val();
   
    var parametros = {
        'rut_estudiante': rut_estudiante,
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
    console.log(parametros)
    
      $.ajax({
        type: "POST",
        url: "../ajax/acreditar_integrante.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax_acreditar_integrante").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax_acreditar_integrante").html(datos);
            $('#guardar_datos').attr("disabled", false);
          //  location.reload() 
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
            url: "../ajax/acreditar_eliminar_integrante.php",
            data: parametros,
            beforeSend: function (objeto) {
                $("#resultados").html("Mensaje: Cargando...");
            },
            success: function (datos) {
                console.log("dat: "+ datos)
                $("#resultados2").html(datos);
               location.reload()
            }
        });
    }
}





function editarIntegrante(){
 
 console.log("acreditar editar")
    var rut_estudiante  = $("#rut_estudiante_acreditar").val();
    var rut             = $("#ac_mod_rut")              .val();
    var nombre          = $("#ac_mod_nombre")           .val();
    var apellido        = $("#ac_mod_apellido")         .val();
    var genero          = $("#ac_mod_genero")           .val();
    var fechaNac        = $("#ac_mod_fechaNac")         .val();
    var relacion        = $("#ac_mod_relacion")         .val();
    var estadoCivil     = $("#ac_mod_estado")           .val();
    var nivelEduc       = $("#ac_mod_nivel") .val();
    var actividad       = $("#ac_mod_actividad")        .val();
    var prevision       = $("#ac_mod_prevision")        .val();
    var otraprevision   = $("#ac_mod_otraprevision")    .val();
    var condicion       = $("#ac_mod_condicion")        .val();
    var enfermedad      = $("#ac_mod_enfermedad")       .val();
   
    var parametros = {
        'rut_estudiante': rut_estudiante,
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
    
    console.log(parametros)
    
    $.ajax({
        type: "POST",
        url: "../ajax/acreditar_editar_integrante.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax_editar").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax_editar").html(datos);
            $('#actualizar_datos').attr("disabled", false);
          
            console.log("datos :"+datos)
            
        }
    });
    
    $("#acreditarEditarIntegrante").on('hidden.bs.modal', function () {
            location.reload()
 });
 
}

function editarIntegranteEstudiante(){
 
    var rut             = $("#ac_mod_rut_i_e")              .val();
    var estadoCivil     = $("#ac_mod_estado_i_e")           .val();
    var nivelEduc       = $("#ac_mod_nivel_i_e")            .val();
    var actividad       = $("#ac_mod_actividad_i_e")        .val();
    var prevision       = $("#ac_mod_prevision_i_e")        .val();
    var otraprevision   = $("#ac_mod_otraprevision_i_e")    .val();
    var condicion       = $("#ac_mod_condicion_i_e")        .val();
    var enfermedad      = $("#ac_mod_enfermedad_i_e")       .val();
   
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
        url: "../ajax/acreditar_editar_integrante_estudiante.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax_editar_i_e").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax_editar_i_e").html(datos);
            $('#actualizar_datos').attr("disabled", false);
            console.log("datos :"+datos)
           
          
        }
    }); 
    
    
    $("#acreditarEditarIntegranteEstudiante").on('hidden.bs.modal', function () {
             location.reload()
 });
 
 
}

