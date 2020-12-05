

function especialEstudianteBeca() {
console.log("especial estudiante")


    var rut                 = $("#rut_estudiante_beca") .val();
    var beca                = $("#beca")                .val();
    var renopost            = $("#reno_post")            .val();
    var genero              = $("#genero")              .val();
    var fechaNac            = $("#fechaNac")            .val();
    var carrera             = $("#carrera")             .val();
    var email               = $("#email")               .val();
    var direccion           = $("#direccion")           .val();
    var numero              = $("#numero")              .val();
    var departamento        = $("#departamento")        .val();
    var villa               = $("#villa")               .val();
    var comuna              = $("#comuna_beca")         .val();
    var region              = $("#region_beca")         .val();
    var fono                = $("#fono")                .val();
    var movil               = $("#movil")               .val();
    var direccion2          = $("#direccion2")           .val();
    var numero2             = $("#numero2")              .val();
    var departamento2       = $("#departamento2")        .val();
    var villa2              = $("#villa2")               .val();
    var comuna2             = $("#comuna2_beca")         .val();
    var region2             = $("#region2_beca")         .val();

    var parametros = {
        'rut'           : rut,
        'beca'          : beca,
        'renopost'      : renopost,
        'genero'        : genero,
        'fechaNac'      : fechaNac,
        'carrera'       : carrera,
        'email'         : email,
        'direccion'     : direccion,
        'numero'        : numero,
        'departamento'  : departamento,
        'villa'         : villa,
        'comuna'        : comuna,
        'region'        : region,
        'fono'          : fono,
        'movil'         : movil,
        'direccion2'    : direccion2,
        'numero2'       : numero2,
        'departamento2' : departamento2,
        'villa2'        : villa2,
        'comuna2'       : comuna2,
        'region2'       : region2,
    }

   console.log(parametros)
   
   
    $.ajax({
        type: "POST",
        url: "../ajax/nuevo_estudiante_becas_especial.php",
        data: parametros,
        datatype:"text",
        beforeSend: function (objeto) {
            $("#resultados_ajax_becas").html("<img src='../img/ajax-loader.gif'> Validando");
            $('.guardar_datos').attr("disabled", true);
        },
        success: function (datos) {
            $("#resultados_ajax_becas").html(datos);
            console.log("DATOS: "+datos)
            $('.guardar_datos').attr("disabled", false);

        }
    });

}


function especialEstudiante() {
console.log("Registrando estudiante")

    var rut                 = $("#rut_estudiante").val();
    var nombre              = $("#nombre_estudiante").val();
    var apellido            = $("#apellido_estudiante").val();
    var genero              = $("#genero").val();
    var fechaNac            = $("#fechaNac").val();
    var carrera             = $("#carrera").val();
    var email               = $("#email").val();
    var fechaIng            = $("#fechaIng").val();
    var password_nueva      = $("#password_nueva").val();
    var password_repetir    = $("#password_repetir").val();

    var parametros = {
        'rut': rut,
        'nombre': nombre,
        'apellido': apellido,
        'genero': genero,
        'fechaNac': fechaNac,
        'carrera': carrera,
        'fechaIng': fechaIng,
        'email': email,
        'password_nueva': password_nueva,
        'password_repetir': password_repetir,
    }

   
    $.ajax({
        type: "POST",
        url: "../ajax/nuevo_estudiante_especial.php",
        data: parametros,
        datatype:"text",
        beforeSend: function (objeto) {
            $("#resultados_ajax").html("<img src='../img/ajax-loader.gif'> Validando");
            $('.guardar_datos').prop('disabled' , true);
        },
        success: function (datos) {
            $("#resultados_ajax").html(datos);
        //    console.log("DATOS: "+datos)
           $('.guardar_datos').prop('disabled' , false);
  
        }
    });

}