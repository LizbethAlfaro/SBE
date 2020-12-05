
function json() {

    var q = $("#q").val();

    $.ajax({
        url: 'service.php?id=' + q,
        beforeSend: function (objeto) {
            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
        },
        success: function (data) {
            //    $("#resultado").html(data);

//            $.each(data[0], function (key, value) {
//                $("#tableDinamic").append("<tr><td>" + value['RUT'] + "</td><td>" + value['DIG'] + "</td><td>" + value['CLIENTE'] + "</td><td>" + value['USER'] + "</td></tr>");
//
//            })
            $('#loader').html('');
            console.log(data)
        }
    })
}

