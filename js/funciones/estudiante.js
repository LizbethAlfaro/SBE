
function recuperarEstudiantes(){ 

    var page=1;
    var q = $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: './ajax/buscar_usuarios.php?action=ajax&page=' + page + '&q=' + q,
        beforeSend: function (objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function (data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}




function registrarEstudiante() {
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
        url: "ajax/nuevo_estudiante.php",
        data: parametros,
        datatype:"text",
        beforeSend: function (objeto) {
            $("#resultados_ajax").html("<img src='img/ajax-loader.gif'> Validando");
            $('.guardar_datos').prop('disabled' , true);
        },
        success: function (datos) {
            $("#resultados_ajax").html(datos);
        //    console.log("DATOS: "+datos)
           $('.guardar_datos').prop('disabled' , false);
            load(1);
        }
    });

}

function editarEstudiante() {

    console.log("editar estudiante")
    
    var rut                 = $("#rut_estudiante")      .val();
    var nombre              = $("#nombre_estudiante")   .val();
    var apellido            = $("#apellido_estudiante") .val();   
    var fechaNac            = $("#fechaNac")            .val();
    var genero              = $("#genero")              .val();
    var fono                = $("#fono")                .val();
    var movil               = $("#movil")               .val();
    var email               = $("#email")               .val();
    
    var direccion           = $("#direccion")           .val();
    var numero              = $("#numero")              .val();
    var departamento        = $("#departamento")        .val();
    var villa               = $("#villa")               .val();
    var comuna              = $("#comuna")              .val();
    var region              = $("#region")              .val();
    
    var direccion2          = $("#direccion2")           .val();
    var numero2             = $("#numero2")              .val();
    var departamento2       = $("#departamento2")        .val();
    var villa2              = $("#villa2")               .val();
    var comuna2             = $("#comuna2")              .val();
    var region2             = $("#region2")              .val();
    
    var fechaIng            = $("#fechaIng")            .val();
    var carrera             = $("#carrera")             .val();
    var jornada             = $("#jornada")             .val();


    var parametros = {
        'rut'           : rut,
        'nombre'        : nombre,
        'apellido'      : apellido,
        'fechaNac'      : fechaNac,
        'genero'        : genero,
        'fono'          : fono,
        'movil'         : movil,
        'email'         : email,
        
        'direccion'     : direccion,
        'numero'        : numero,
        'departamento'  : departamento,
        'villa'         : villa,
        'comuna'        : comuna,
        'region'        : region,
        
        'direccion2'     : direccion2,
        'numero2'        : numero2,
        'departamento2'  : departamento2,
        'villa2'         : villa2,
        'comuna2'        : comuna2,
        'region2'        : region2,
        
        'fechaIng'      : fechaIng,
        'carrera'       : carrera,
        'jornada'       : jornada,
    }

    $.ajax({
        type: "POST",
        url: "ajax/editar_estudiante.php",
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

    var mod_id = $("#rut_estudiante").val();
    var pass_nueva = $("#pass-nueva").val();
    var pass_repetir = $("#pass-repetir").val();

    var parametros = {
        'mod_id': mod_id,
        'pass-nueva': pass_nueva,
        'pass-repetir': pass_repetir,

    }
    $.ajax({
        type: "POST",
        url: "ajax/editar_password.php",
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

function restablecerClave() {

    var rut = $("#rut").val();
    var pass_nueva = $("#pass-nueva").val();
    var pass_repetir = $("#pass-repetir").val();
    var token = $("#token").val();

    var parametros = {
        'rut': rut,
        'pass-nueva': pass_nueva,
        'pass-repetir': pass_repetir,
        'token': token,

    }
    
  
    
    $.ajax({
        type: "POST",
        url: "restablecer_contraseña.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax").html(datos);
            $('#actualizar_datos').attr("disabled", false);
        }
    });
}


function eliminarEstudiante(id)
{
    var q = $("#q").val();
    if (confirm("Realmente deseas eliminar el usuario")) {
        $.ajax({
            type: "GET",
            url: "./ajax/buscar_usuarios.php",
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
