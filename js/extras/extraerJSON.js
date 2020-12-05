
//extraer JSON

function comunasJSON(valor, tipo) {

    const indice = valor - 1;
    console.log("valor " + valor)
    var elemento = ""

    if (tipo == 2) {
        elemento = 2;
    }

    var opcion = '<option value>Seleccione comuna</option>';

    if (valor > 0) {

        $.ajax({
            url: "./Clases/comunas.json", //url de donde obtener los datos
            dataType: 'json', //tipo de datos retornados
            type: 'post' //enviar variables como post
        }).done(function (data, textStatus, jqXHR) {

            var json_string = JSON.stringify(data);

            var obj = $.parseJSON(json_string);



            $('#region-nombre' + elemento).val(obj[indice].region);

            for (var i in obj[indice].comunas) {
                // creamos un string que escribe los opcion del select
                opcion += '<option value="' + obj[indice].comunas[i] + '">' + obj[indice].comunas[i] + '</option>';

            }
            console.log(opcion)

            $('#comuna' + elemento).html(opcion);
        })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    console.log("La solicitud a fallado:", textStatus);
                });

    } else {
        $('#comuna' + elemento).html("<option value>Selecciona comuna</option>");
    }




}



