
function recuperarEstudiantesBeca(){ 

    var page=1;
    var q = $("#q").val();
    var beca = $("#beca").val();
    var estado = $("#estado_beca").val();
    $("#loader").fadeIn('slow');
    
    console.log("q :"+q+" beca :"+beca+" estado :"+estado);
    
    $.ajax({
        url: '../ajax/buscar_estudiante_beca_interna.php?action=ajax&page=' + page + '&q=' + q +'&beca=' + beca+'&estado=' + estado,
        beforeSend: function (objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function (data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}

function recuperarHistorialEstudiantesBeca(){ 

    var page=1;
    var q = $("#q").val();
    var beca = $("#beca").val();
    var estado = $("#estado_beca").val();
    $("#loader").fadeIn('slow');
    
    console.log("q :"+q+" beca :"+beca+" estado :"+estado);
    
    $.ajax({
        url: '../ajax/buscar_historial_beca_interna.php?action=ajax&page=' + page + '&q=' + q +'&beca=' + beca+'&estado=' + estado,
        beforeSend: function (objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function (data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}

function verificarBecas(){ 

    var page=1;
    var rut = $("#rut_estudiante_beca").val();


    $("#loader").fadeIn('slow');
    $.ajax({
        url: '../ajax/verificar_beca.php?rut='+rut,
        beforeSend: function (objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function (data) {
          //  $(".outer_div").html(data).fadeIn('slow');
         
            console.log("beca numero "+data+" rut:"+rut);
            
            $('#beca     option[value='+data+']').prop("selected", "selected");
            
            if(data==9){
            $("#resultados_ajax_becas").html("<div class='alert alert-info' role='alert'>Ya cuenta con la beca socieconomica, esta solo es compatible con la beca deportiva </div>").fadeIn('slow');
            $('#beca     option[value=2]').prop("selected", "selected");
            $('#beca').prop("disabled", true)  
          //  $(".guardar_datos").prop("disabled",true);
            }else{
             $("#resultados_ajax_becas").html("").fadeIn('slow');
             $('#beca').prop("disabled", false)
            if(data!=0){
            $('#beca').prop("disabled", true)   
            }else{
            $('#beca').prop("disabled", false)
            }
            
            }
            
            $('#loader').html('');

        }
    })
}



function registrarEstudianteBeca() {
console.log("Registrando estudiante")


    var rut                 = $("#rut_estudiante_beca") .val();
    var beca                = $("#beca")                .val();
    
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
        url: "ajax/nuevo_estudiante_becas.php",
        data: parametros,
        datatype:"text",
        beforeSend: function (objeto) {
            $("#resultados_ajax_becas").html("Mensaje: Cargando...");
            $('.guardar_datos').attr("disabled", true);
        },
        success: function (datos) {
            $("#resultados_ajax_becas").html(datos);
            console.log("DATOS: "+datos)
            $('.guardar_datos').attr("disabled", false);
            load(1);
        }
    });

}

function editarEstudianteBeca() {

    console.log("editar estudiante beca")
    
    var rut                 = $("#rut_estudiante_beca") .val();  
    var fechaNac            = $("#fechaNac")            .val();
    var fono                = $("#fono")                .val();
    var movil               = $("#movil")               .val();
    var email               = $("#email")               .val();
    
    var direccion           = $("#direccion")           .val();
    var numero              = $("#numero")              .val();
    var departamento        = $("#departamento")        .val();
    var villa               = $("#villa")               .val();
    var comuna              = $("#comuna_beca")         .val();
    var region              = $("#region_beca")         .val();
    


    var parametros = {
        'rut'           : rut,
        'fechaNac'      : fechaNac,
        'fono'          : fono,
        'movil'         : movil,
        'email'         : email,    
        'direccion'     : direccion,
        'numero'        : numero,
        'departamento'  : departamento,
        'villa'         : villa,
        'comuna'        : comuna,
        'region'        : region
        
    }

console.log(parametros)
    $.ajax({
        type: "POST",
        url: "../ajax/editar_estudiante_beca.php",
        data: parametros,
        beforeSend: function (objeto) {
            $("#resultados_ajax_becas").html("Mensaje: Cargando...");
        },
        success: function (datos) {
            $("#resultados_ajax_becas").html(datos);
            $('#actualizar_datos').attr("disabled", false);
 console.log(datos)
        }
    });

}



