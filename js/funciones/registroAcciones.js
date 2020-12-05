function recuperarRegistroAccion(){
    
 var q              = $("#q")             .val();
 var accion         = $("#accion")        .val();
 var fecha_inicio   = $("#fecha_inicio")  .val();
 var fecha_termino  = $("#fecha_termino") .val();
 
 var parametros = {
        'q'             : q,
        'accion'        : accion,
        'fecha_inicio'  : fecha_inicio,
        'fecha_termino' : fecha_termino   
    }
    
    $("#loader").fadeIn('slow');
    console.log(parametros);
    $.ajax({
        url: '../ajax/buscar_registro_acciones.php?action=ajax',
        data: parametros,
        beforeSend: function (objeto) {
            $('#resultados_ajax_log').html('<img src="../img/ajax-loader.gif"> Cargando...');
        },
        success: function (data) {
          //  console.log(data)
            $("#resultados_ajax_log").html(data).fadeIn('slow');         
            $('#loader').html('');
    

        }
    })
}

