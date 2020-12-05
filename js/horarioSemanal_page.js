$(document).ready(function () {
    load(1);
});

function load(page) {

  

}

function seleccionarTodo(){

  if($("#todo").prop("checked") == true){
       $('.modulos').bootstrapToggle('on');
       $('.modulos').prop('checked', true).change()
        console.log("true")
    }else{
        $('.modulos').bootstrapToggle('off');
        $('.modulos').prop('checked', false).change()
         console.log("false")
    }

}