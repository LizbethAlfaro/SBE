$(document).ready(function () {
    load(1);
});

function load(page) {   
recuperarIntegrante();
}

function otraPrev(valor){
    if(valor==5){
    $("#otraPrevision_integrante").css("visibility", "visible");
    $("#mod_otraprevision").css("visibility", "visible");
    }else{
    $("#otraPrevision_integrante").css("visibility", "hidden");
    $("#mod_otraprevision").css("visibility", "hidden");
    $("#otraPrevision_integrante").val("")
    $("#mod_otraprevision").val("")
    }
}  

function condicionEnfermedad(valor){
    if(valor==1 || valor==2){
    $("#enfermedad_integrante").css("visibility", "visible");
    $("#mod_enfermedad").css("visibility", "visible");
    }else{
    $("#enfermedad_integrante").css("visibility", "hidden");
    $("#mod_enfermedad").css("visibility", "hidden");
    $("#enfermedad_integrante").val("")
    $("#mod_enfermedad").val("")
    }
}  

function otraPrevEI(valor){
    if(valor==5){
    $("#otraPrevision_integrante_i_e").css("visibility", "visible");
    $("#mod_otraprevision_i_e").css("visibility", "visible");
    }else{
    $("#otraPrevision_integrante_i_e").css("visibility", "hidden");
    $("#mod_otraprevision_i_e").css("visibility", "hidden");
    $("#otraPrevision_integrante_i_e").val("")
    $("#mod_otraprevision_i_e").val("")
    }
}  

function condicionEnfermedadEI(valor){
    if(valor==1 || valor==2){
    $("#enfermedad_integrante_i_e").css("visibility", "visible");
    $("#mod_enfermedad_i_e").css("visibility", "visible");
    }else{
    $("#enfermedad_integrante_i_e").css("visibility", "hidden");
    $("#mod_enfermedad_i_e").css("visibility", "hidden");
    $("#enfermedad_integrante_i_e").val("")
    $("#mod_enfermedad_i_e").val("")
    }
}  





$('#editarIntegrante').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
  
    var rut         =   button.data('rut')      
    var nombre      =   button.data('nombre')   
    var apellido    =   button.data('apellido')   
    var genero      =   button.data('genero')   
    var fecha       =   button.data('fecha')   
    var relacion    =   button.data('relacion')   
    var estado      =   button.data('estado')   
    var nivel       =   button.data('nivel')   
    var actividad   =   button.data('actividad')   
    var prevision   =   button.data('prevision')   
    var otprevision =   button.data('otraprevision') 
    var condicion   =   button.data('condicion')   
    var enfermedad  =   button.data('enfermedad')
    
    var modal = $(this)
    
    modal.find('.modal-body #mod_rut')          .val(rut)
    modal.find('.modal-body #mod_nombre')       .val(nombre)
    modal.find('.modal-body #mod_apellido')     .val(apellido)
    modal.find('.modal-body #mod_genero')       .val(genero)
    modal.find('.modal-body #mod_fechaNac')     .val(fecha)
    modal.find('.modal-body #mod_relacion')     .val(relacion)
    modal.find('.modal-body #mod_estado')       .val(estado)
    modal.find('.modal-body #mod_nivel')        .val(nivel)
    modal.find('.modal-body #mod_actividad')    .val(actividad)
    modal.find('.modal-body #mod_prevision')    .val(prevision)
    modal.find('.modal-body #mod_otraprevision').val(otprevision)
    modal.find('.modal-body #mod_condicion')    .val(condicion)
    modal.find('.modal-body #mod_enfermedad')   .val(enfermedad)
    
    if(prevision==5){
    $("#mod_otraprevision").css("visibility", "visible");
    }else{
     $("#mod_otraprevision").css("visibility", "hidden");    
    }
    if(condicion==1 || condicion==2){
    $("#mod_enfermedad").css("visibility", "visible");
    }else{
    $("#mod_enfermedad").css("visibility", "hidden");    
    }
})

$('#editarIntegranteEstudiante').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
  
    var rut         =   button.data('rut')        
    var estado      =   button.data('estado')   
    var nivel       =   button.data('nivel')   
    var actividad   =   button.data('actividad')   
    var prevision   =   button.data('prevision')   
    var otprevision =   button.data('otraprevision') 
    var condicion   =   button.data('condicion')   
    var enfermedad  =   button.data('enfermedad')
    
    var modal = $(this)
    
    modal.find('.modal-body #mod_rut_i_e')          .val(rut)
    modal.find('.modal-body #mod_estado_i_e')       .val(estado)
    modal.find('.modal-body #mod_nivel_i_e')        .val(nivel)
    modal.find('.modal-body #mod_actividad_i_e')    .val(actividad)
    modal.find('.modal-body #mod_prevision_i_e')    .val(prevision)
    modal.find('.modal-body #mod_otraprevision_i_e').val(otprevision)
    modal.find('.modal-body #mod_condicion_i_e')    .val(condicion)
    modal.find('.modal-body #mod_enfermedad_i_e')   .val(enfermedad)
    
    console.log("prevision :"+prevision+" condicion :"+condicion)
    if(prevision==5){
    $("#mod_otraprevision_i_e").css("visibility", "visible");
    }else{
     $("#mod_otraprevision_i_e").css("visibility", "hidden");    
    }
    if(condicion==1 || condicion==2){
    $("#mod_enfermedad_i_e").css("visibility", "visible");
    }else{
      $("#mod_enfermedad_i_e").css("visibility", "hidden");    
    }
})
		

