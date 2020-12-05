
   function recuperarAsistente(){
       console.log("ddd")
    var page=1;    
    var q = $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: '../ajax/buscar_asistente.php?action=ajax&page=' + page + '&q=' + q,
        beforeSend: function (objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function (data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
            console.log(data)

        }
    })
    }
    
function registrarAsistente(){
    
    var rut             = $("#rut_asistente")       .val();
    var nombre          = $("#nombre_asistente")    .val();
    var apellido        = $("#apellido_asistente")  .val();
    var mail            = $("#mail_asistente")      .val();
    var tipo_asistente  = $("#tipo_asistente")      .val();
    var clave_nueva     = $("#clave_nueva")         .val();
    var clave_repetir   = $("#clave_repetir")       .val();

    var parametros = {
        'rut'           : rut,
        'nombre'        : nombre,
        'apellido'      : apellido,
        'mail'          : mail,
        'tipo_asistente': tipo_asistente,
        'clave_nueva'   : clave_nueva,
        'clave_repetir' : clave_repetir,
    }   
    
    $.ajax({
        type: "POST",
        url: "../ajax/nuevo_asistente.php",
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


//se llama el form de modal/editar_procesador
function editarAsistente(){
    
    var rut             = $("#mod_id")       .val();
    var nombre          = $("#mod_nombre")    .val();
    var apellido        = $("#mod_apellido")  .val();
    var mail            = $("#mod_mail")      .val();
    var tipo_asistente  = $("#mod_tipo_asistente")      .val();


    var parametros = {
        'rut'           : rut,
        'nombre'        : nombre,
        'apellido'      : apellido,
        'mail'          : mail,
        'tipo_asistente': tipo_asistente,
    }   
    console.log(parametros)
    
    $.ajax({
        type: "POST",
        url: "../ajax/editar_asistente.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax2").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax2").html(datos);
            $('#actualizar_datos').attr("disabled", false);
            load(1);
        }
    });
}

function deshabilitarAsistente(id)
{
    var q = $("#q").val();
    if (confirm("Realmente deseas deshabilitar este Asistente")) {
        $.ajax({
            type: "GET",
            url: "../ajax/buscar_asistente.php",
            data: "id=" + id, "q": q,
            beforeSend: function (objeto) {
                $("#resultados").html("Mensaje: Cargando...");
            },
            success: function (datos) {
                $("#resultados").html(datos);
                load(1);
            }
        });
    }
}

function editarClave() {

    var mod_id          = $("#mod_clave_id").val();
    var pass_nueva      = $("#pass-nueva").val();
    var pass_repetir    = $("#pass-repetir").val();

    var parametros = {
        'mod_id'        : mod_id,
        'pass-nueva'    : pass_nueva,
        'pass-repetir'  : pass_repetir,

    }
    $.ajax({
        type: "POST",
        url: "../ajax/editar_clave_asistente.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax3").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax3").html(datos);
            $('#actualizar_datos3').attr("disabled", false);
            load(1);
        }
    });
}


function resumenPorAsistente() {

    var fecha           = $("#fecha").val();

    var parametros = {
        'action'        : "ajax",
        'fecha'         : fecha
    }
    console.log(parametros);
    $.ajax({
        type: "POST",
        url: "../ajax/buscar_resumen_atencion.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax_atencion").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax_atencion").html(datos);
            $('#actualizar_datos_atencion').attr("disabled", false);
            console.log(datos)
     
        }
    });
}


function resumenCompleto() {

    var q           = $("#q").val();

    var parametros = {
        'action'        : "ajax",
        'q'         : q
    }
    console.log(parametros);
    $.ajax({
        type: "POST",
        url: "../ajax/buscar_atencion.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax_atencion").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax_atencion").html(datos);
            $('#actualizar_datos_atencion').attr("disabled", false);
            console.log(datos)
     
        }
    });
}