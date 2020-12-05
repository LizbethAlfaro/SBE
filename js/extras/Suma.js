
function totalFila(fila){
    var total = 0;
    $('.ingreso'+fila).each(function(){
        if(this.value!=""){
        valor=parseInt(this.value=this.value.replace(/\./g,""))   
        }else{
        valor=0  
        }
        total += valor
     
    });
  //  total=formatoNumerico(total)
    console.log("total de la fila :"+total)

    console.log("fila "+fila) 
   
  
     $('#ingreso_total'+fila).val(total);
       totalMensual()
          percap()  
}

function percap(){
    var total = 0;
    var count = 0
    $('.total').each(function(){
        total += parseFloat(this.value=this.value.replace(/\./g,""))
        count++
    });
    var percap = parseInt(total/count)
    
    //percap=formatoNumerico(percap)
    
    $('#percap').html(percap);
}

function totalMensual(){
    var total = 0;
    $('.total').each(function(){
        total += parseInt(this.value=this.value.replace(/\./g,"")) //
    });
    //total=formatoNumerico(total)
    console.log("total mensual: "+total)
    $('#total').html(total);
}

$( document ).ready(function() {
    console.log( "ready!" );
     totalMensual()
     percap()
//     separadorMiles()

});

function separadorMiles(elemento){

elemento.maxLength=9;
elemento.value = elemento.value.replace(/[^0-9]/g,'');

    
//elemento.value = formatoNumerico(elemento.value);

}

function formatoNumerico(numero){
    
//    var formato = numero.toString().replace(/(\.\d+)|\B(?=(\d{3})+(?!\d))/g, function(m,g1){
//        return g1 || "."
//    });
//    console.log("formatoNumerico(): "+formato)
//    return formato;
}

