function califica(beca,renopost){
    var calificacion = false;
    var puntaje = parseInt($('#puntaje').val());
    var puntaje_na = parseFloat($('#puntaje_na').val());
    var puntaje_aa = parseInt($('#puntaje_aa').val());
    var puntaje_sf = parseInt($('#puntaje_sf').val());
    var puntaje_ar = parseInt($('#puntaje_ar').val());
    
    var puntaje_cvd = parseInt($('#puntaje_cvd').val());
    var puntaje_sd = parseInt($('#puntaje_sd').val());
    var puntaje_cf = parseInt($('#puntaje_cf').val());

    
    var psu = parseInt($('#psu').val());
    var na  = $('#na').val();
    var aa  = $('#aa').val();
    var estado_finanza  = $('#sf').val();

    var sf=0;
    if(estado_finanza=='AL DIA'){
    sf=1;    
    }else{
    sf=0;    
    }
//    console.log("finanza :"+estado_finanza+" sf:"+sf)
    
    var estado_academico  = $('#ar').val();
    var ar=0;
    if(estado_academico=='VIGENTE'){
    ar=1;    
    }else{
    ar=0;    
    }
//    console.log("estado academico :"+estado_academico+" ar:"+ar)
    
 
    var estado_convenio  = $('#e4').val();
    var e4=0;
    if(estado_convenio=='VIGENTE'){
    e4=1;    
    }else{
    e4=0;    
    }
//    console.log("estado convenio :"+estado_convenio+" e4:"+e4)
    
    
    var cvd = $('#cvd').val();
    var sd  = $('#sd').val();
    var cf  = $('#cf').val();
    
    var ct = $('#ct').val();
    var cp = $('#cp').val();
    
    
    var cet = $('#certificado').val();
    
    var he = $('#he').val();
    var ne = $('#ne').val();
    
    var bm  = $('#bm').val();
    var cae = $('#cae').val();

       
    switch(beca){

        case 1: //ugm
             switch(renopost){
                 case 1:if(psu>=puntaje){calificacion=true}
                 break;
                 case 2:if(na>=puntaje_na && aa>=puntaje_aa && sf>puntaje_sf && ar>puntaje_ar){calificacion=true}
                 break;
            }
             
            break;
        case 2://deportiva
            switch(renopost){
                 case 1:if(cvd==1 && sd==1 && cf==1){calificacion=true}
                 break;
                 case 2:if(cvd==1 && sd==1 && aa>=puntaje_aa && na>=puntaje_na){calificacion=true}
                 break;
            }

            break;
        case 3:   //alumni  
             switch(renopost){
                 case 1:if(e4==1 && cet==1 && sf==1){calificacion=true}
                 break;
                 case 2:if(na>=puntaje_na && aa>=puntaje_aa){calificacion=true}
                 break;
            }
            break;
        case 4://funcionario
            switch(renopost){
                 case 1:if(sf==1 && ar==1 && ct==1 && cp==1){calificacion=true}
                 break;
                 case 2:if(ct==1 && cp==1 && na>=puntaje_na && aa>=puntaje_aa){calificacion=true}
                 break;
            }
            break;
        case 5:// familiar
            switch(renopost){
                 case 1:if(sf==1 && ar==1 && he==1){calificacion=true}
                 break;
                 case 2:if(he==1 && na>=puntaje_na && aa>=puntaje_aa){calificacion=true}
                 break;
            }
            break;
        case 6: //extranjeros
            switch(renopost){
                 case 1:if(ne==1 && ar==1 && e4==1){calificacion=true}
                 break;
                 case 2:if(sf==1 && na>=puntaje_na && aa>=puntaje_aa){calificacion=true}
                 break;
            }
            break;
        case 7://copago
            switch(renopost){
                 case 1:if(sf==1 && ar==1 && bm==1 && cae==1){calificacion=true}
                 break;
                 case 2:if(sf==1 && ar==1 && bm==1 && cae==1){calificacion=true}
                 break;
            }
            break;
        case 8://merito nem
            switch(renopost){
                 case 1:if(ar==1 && sf==1 && aa>=puntaje_aa && na>=puntaje_na){calificacion=true}
    
                 break;
                 case 2:if(ar==1 && sf==1 && aa>=puntaje_aa && na>=puntaje_na){calificacion=true}
                 break;
            }
            break;
        case 9:
            break;
        case 10:
            switch(renopost){
                 case 1:if(e4==1 && cet==1 && sf==1){calificacion=true}
                 break;
                 case 2:if(na>=puntaje_na && aa>=puntaje_aa){calificacion=true}
                 break;
            }
            break;
        case 11:
            switch(renopost){
                 case 1:if(e4==1 && cet==1 && sf==1){calificacion=true}
                 break;
                 case 2:if(na>=puntaje_na && aa>=puntaje_aa){calificacion=true}
                 break;
            }
            break;
    }
//    console.log("beca :"+beca+" tipo :"+renopost)
//    console.log("psu :"+psu+" puntaje :"+puntaje)
//    console.log("na :"+na+" puntaje_na :"+puntaje_na+" aa :"+aa+" puntaje_aa :"+puntaje_aa+" sf :"+sf+" puntaje_sf :"+puntaje_sf+" ar :"+ar+" puntaje_ar :"+puntaje_ar)
//    console.log("cvd :"+cvd+" sd :"+sd+" cf :"+cf)
//    console.log("cvd :"+cvd+" sd :"+sd+" aa :"+aa+" puntaje_aa :"+puntaje_aa+" na:"+na+" puntaje_na:"+puntaje_na)
//console.log("cvd :"+cvd+" sd :"+sd+" aa :"+aa+" puntaje_aa :"+puntaje_aa+" na:"+na+" puntaje_na:"+puntaje_na)
    console.log("sf :"+sf+" ar:"+ar+" aa :"+aa+" >= "+puntaje_aa+" na :"+na+" >= "+puntaje_na)
    console.log("calificacion :"+calificacion)
    
    if(calificacion){
    $('#calificacion').val('Califica');    
    }else{
    $('#calificacion').val('NO califica');        
    }
    
    
    
}
