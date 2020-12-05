$(document).ready(function () {
    load(1);
});

function load(page) {
recuperarAcreditar()

}

 $("#acreditarEditarIntegranteEstudiante").on('hidden.bs.modal', function () {
            console.log("Esta accion se ejecuta al cerrar el modal")
             //location.reload()
 });
 
 $("#acreditarEditarIntegrante").on('hidden.bs.modal', function () {
            console.log("Esta accion se ejecuta al cerrar el modal")
 });

//$('#modalAcreditar').on('show.bs.modal', function (event) {
//	  var button = $(event.relatedTarget) // Button that triggered the modal
//          
//	  var rut = button.data('rut') 
//
//          
//          console.log("rut a modal :"+rut)
//          
//         
//          
//	  var modal = $(this)
//	  modal.find('.modal-body #rut_estudiante_acreditar').val(rut)
//
//	})      
//

function acreditarOtraPrev(valor){
    console.log(" prevision valor :"+valor)
    if(valor==5){
    $("#ac_otraPrevision_integrante").css("visibility", "visible");
    $("#ac_mod_otraprevision").css("visibility", "visible");
    }else{
    $("#ac_otraPrevision_integrante").css("visibility", "hidden");
    $("#ac_mod_otraprevision").css("visibility", "hidden");
    $("#ac_otraPrevision_integrante").val("")
    $("#ac_mod_otraprevision").val("")
    }
}  

function acreditarCondicionEnfermedad(valor){
    console.log(" condicion valor :"+valor)
    if(valor==1 || valor==2){
    $("#ac_enfermedad_integrante").css("visibility", "visible");
    $("#ac_mod_enfermedad").css("visibility", "visible");
    }else{
    $("#ac_enfermedad_integrante").css("visibility", "hidden");
    $("#ac_mod_enfermedad").css("visibility", "hidden");
    $("#ac_enfermedad_integrante").val("")
    $("#ac_mod_enfermedad").val("")
    }
}  

function acreditarOtraPrevEI(valor){
     console.log(" prevision2 valor :"+valor)
    if(valor==5){
    $("#ac_otraPrevision_integrante").css("visibility", "visible");
    $("#ac_mod_otraprevision").css("visibility", "visible");
    }else{
    $("#ac_otraPrevision_integrante").css("visibility", "hidden");
    $("#ac_mod_otraprevision").css("visibility", "hidden");
    $("#ac_otraPrevision_integrante").val("")
    $("#ac_mod_otraprevision").val("")
    }
}  

function acreditarCondicionEnfermedadEI(valor){
     console.log(" condicion2 valor :"+valor)
    if(valor==1 || valor==2){
    $("#ac_enfermedad_integrante").css("visibility", "visible");
    $("#ac_mod_enfermedad").css("visibility", "visible");
    }else{
    $("#ac_enfermedad_integrante").css("visibility", "hidden");
    $("#ac_mod_enfermedad").css("visibility", "hidden");
    $("#ac_enfermedad_integrante").val("")
    $("#ac_mod_enfermedad").val("")
    }
}  


///


function acreditarOtraPrevEI2(valor){
     console.log(" prevision3 valor :"+valor)
    if(valor==5){
    $("#ac_mod_otraprevision_i_e").css("visibility", "visible");
    }else{
    $("#ac_otraPrevision_integrante_i_e").css("visibility", "hidden");
    $("#ac_mod_otraprevision_i_e").css("visibility", "hidden");
    $("#ac_otraPrevision_integrante_i_e").val("")
    $("#ac_mod_otraprevision_i_e").val("")
    }
}  

function acreditarCondicionEnfermedadEI2(valor){
     console.log(" condicion3 valor :"+valor)
    if(valor==1 || valor==2){
    $("#ac_mod_enfermedad_i_e").css("visibility", "visible");
    }else{
    $("#ac_enfermedad_integrante_i_e").css("visibility", "hidden");
    $("#ac_mod_enfermedad_i_e").css("visibility", "hidden");
    $("#ac_enfermedad_integrante_i_e").val("")
    $("#ac_mod_enfermedad_i_e").val("")
    }
}  

