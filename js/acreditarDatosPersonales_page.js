$(document).ready(function () {
  //  acreditarRecuperarComuna()
  //  acreditarRecuperarComuna2()
});

function acreditarRecuperarComuna() {
    var region = $("#ac_region").val();

    var parametros = {
        'action': 'ajax',
        'region': region
    };

    console.log(parametros)

    $.ajax({
        type: "POST",
        url: "../ajax/acreditar_buscar_comuna.php",
        data: parametros,
        beforeSend: function (objeto) {
        },
        success: function (datos) {
            $("#ac_comuna").html(datos);
            $('#ac_comuna').prop("disabled", false)
            console.log(datos)
        }
    });
}
function acreditarRecuperarComuna2() {
    var region = $("#ac_region2").val();

    var parametros = {
        'action': 'ajax',
        'region': region
    };

    console.log(parametros)

    $.ajax({
        type: "POST",
        url: "../ajax/acreditar_buscar_comuna.php",
        data: parametros,
        beforeSend: function (objeto) {
        },
        success: function (datos) {
            $("#ac_comuna2").html(datos);
            $('#ac_comuna2').prop("disabled", false)
            console.log(datos)
        }
    });
}
    
function habilitarEdicion() {
    console.log("habilitado a editar");

    //sin U+
    $('#ac_nombre_estudiante').prop("readonly", false)
    $('#ac_apellido_estudiante').prop("readonly", false)
    $('#ac_fechaNac').prop("readonly", false)
    $('#ac_genero').prop("disabled", false)
    $('#ac_email').prop("readonly", false)
    $('#ac_fechaIng').prop("disabled", false)
    $('#ac_carrera').prop("disabled", false)
    $('#ac_jornada').prop("disabled", false)

    //con U+
    $('#ac_fono').prop("readonly", false)
    $('#ac_movil').prop("readonly", false)

    $('#ac_direccion').prop("readonly", false)
    $('#ac_numero').prop("readonly", false)
    $('#ac_departamento').prop("readonly", false)
    $('#ac_villa').prop("readonly", false)
  //  $('#ac_comuna').prop("disabled", false)
    $('#ac_region').prop("disabled", false)
    $('#ac_direccion2').prop("readonly", false)
    $('#ac_numero2').prop("readonly", false)
    $('#ac_departamento2').prop("readonly", false)
    $('#ac_villa2').prop("readonly", false)
  //  $('#ac_comuna2').prop("disabled", false)
    $('#ac_region2').prop("disabled", false)


    $('#ac_password_nueva').prop("readonly", false)
    $('#ac_password_repetir').prop("readonly", false)
    $('#ac_guardar_datos').prop("disabled", false)
}

$(document).ready(function ($) {
    $('#ac_fono').mask("2-999-9999", {placeholder: "2-xxx-xxxx"});

    $('#ac_movil').mask("569-999-999-99", {placeholder: "56x-xxx-xxxx-xx"});

});


function editarEstudiante() {

    console.log("editar estudiante")

    var rut = $("#ac_rut_estudiante").val();
    var nombre = $("#ac_nombre_estudiante").val();
    var apellido = $("#ac_apellido_estudiante").val();
    var fechaNac = $("#ac_fechaNac").val();
    var genero = $("#ac_genero").val();
    var fono = $("#ac_fono").val();
    var movil = $("#ac_movil").val();
    var email = $("#ac_email").val();

    var direccion = $("#ac_direccion").val();
    var numero = $("#ac_numero").val();
    var departamento = $("#ac_departamento").val();
    var villa = $("#ac_villa").val();
    var comuna = $("#ac_comuna").val();
    var region = $("#ac_region").val();

    var direccion2 = $("#ac_direccion2").val();
    var numero2 = $("#ac_numero2").val();
    var departamento2 = $("#ac_departamento2").val();
    var villa2 = $("#ac_villa2").val();
    var comuna2 = $("#ac_comuna2").val();
    var region2 = $("#ac_region2").val();

    var fechaIng = $("#ac_fechaIng").val();
    var carrera = $("#ac_carrera").val();
    var jornada = $("#ac_jornada").val();


    var parametros = {
        'rut': rut,
        'nombre': nombre,
        'apellido': apellido,
        'fechaNac': fechaNac,
        'genero': genero,
        'fono': fono,
        'movil': movil,
        'email': email,

        'direccion': direccion,
        'numero': numero,
        'departamento': departamento,
        'villa': villa,
        'comuna': comuna,
        'region': region,

        'direccion2': direccion2,
        'numero2': numero2,
        'departamento2': departamento2,
        'villa2': villa2,
        'comuna2': comuna2,
        'region2': region2,

        'fechaIng': fechaIng,
        'carrera': carrera,
        'jornada': jornada,
    }

    $.ajax({
        type: "POST",
        url: "../ajax/acreditar_editar_estudiante.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax").html(datos);
            $('#actualizar_datos').attr("disabled", false);
            load(1);
        }
    });

}

function editarClave() {

    var mod_id = $("#ac_pass_rut_estudiante").val();
    var pass_nueva = $("#ac_pass-nueva").val();
    var pass_repetir = $("#ac_pass-repetir").val();

    var parametros = {
        'mod_id': mod_id,
        'pass-nueva': pass_nueva,
        'pass-repetir': pass_repetir,

    }
    $.ajax({
        type: "POST",
        url: "../ajax/acreditar_editar_password.php",
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




