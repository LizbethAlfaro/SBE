
   function descargaPDF(ruta){
    console.log("descargando pdf")

    var parametros = {
        'ruta'              : ruta
    }
    
//    console.log(parametros);
//    
//    $("#loader").fadeIn('slow');
//    $.ajax({
//        url:'descarga.php',
//        data:parametros,
//        beforeSend: function (objeto) {
//            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
//        },
//        success: function (data) {
//            $(".outer_div").html(data).fadeIn('slow');
//            $('#loader').html('');
//            console.log(data)
//
//        }
//    })

$.ajax({
            cache: false,
            type: 'POST',
            url:'Informes\13.042.523-2\13.042.523-2_29-11-2019.pdf',
            contentType: false,
            processData: false,
            data: parametros,
             //xhrFields is what did the trick to read the blob to pdf
            xhrFields: {
                responseType: 'blob'
            },
            success: function (response, status, xhr) {

                var filename = "";                   
                var disposition = xhr.getResponseHeader('Content-Disposition');

                 if (disposition) {
                    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                    var matches = filenameRegex.exec(disposition);
                    if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                } 
                var linkelem = document.createElement('a');
                try {
                                           var blob = new Blob([response], { type: 'application/octet-stream' });                        

                    if (typeof window.navigator.msSaveBlob !== 'undefined') {
                        //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                        window.navigator.msSaveBlob(blob, filename);
                    } else {
                        var URL = window.URL || window.webkitURL;
                        var downloadUrl = URL.createObjectURL(blob);

                        if (filename) { 
                            // use HTML5 a[download] attribute to specify filename
                            var a = document.createElement("a");

                            // safari doesn't support this yet
                            if (typeof a.download === 'undefined') {
                                window.location = downloadUrl;
                            } else {
                                a.href = downloadUrl;
                                a.download = filename;
                                document.body.appendChild(a);
                                a.target = "_blank";
                                a.click();
                            }
                        } else {
                            window.location = downloadUrl;
                        }
                    }   

                } catch (ex) {
                    console.log(ex);
                } 
            }
        });
    }
 