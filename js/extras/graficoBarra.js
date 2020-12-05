
function grafico(opcion){
   
   var modal;
   var grafico="";
   var imagen;
  switch(opcion){
      case 1:modal='modalEvaluado',grafico='densityChart'
     break;
      case 2:modal='modalFecha',grafico='densityChart2'
     break;
  }
    
$('#'+modal).on('show.bs.modal', function (event) {
    
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var id = button.data('id') 
	  var encuesta = button.data('encuesta')
          var nombre_evaluado = button.data('nombre') 
          var apellido_evaluado = button.data('apellido') 
          var evaluador = button.data('id_evaluador') 
          var nomb_evaluador = button.data('nomb_evaluador') 
          var fecha = button.data('fecha') 
          
     var modal = $(this)

     

   
          

var arreglo={
    'id_evaluado': id,
    'id_enc':encuesta,
    'id_evaluador': evaluador,
    'fecha':fecha
};

 
$.ajax({
type: "GET",
url:'./ajax/buscar_calificacion.php?action=ajax',
data: arreglo,
beforeSend: function(objeto){
console.log('enviando')              
},
success: function(datos){

console.log("data "+datos);
var obj = JSON.parse(datos)

console.log(obj);

if(opcion==2){
var preg_coment = "";
for (var indice in obj[0].preguntas){
preg_coment = preg_coment+"<tr><td><strong>"+obj[0].preguntas[indice]+"</strong><br>"+obj[0].preg_desc[indice]+"</td><td>"+obj[0].preg_coment[indice]+"</td></tr>";    
console.log("comen_preg: "+preg_coment)
}


$("#preg_coment").html(preg_coment);


//comentario a detalle encuesta por fecha
var comentario_general= "<textarea style='width: 100%; text-align: center;' readonly >"+obj[0].comentarios+"</textarea>"; 

$("#comentario").html(comentario_general);
console.log(comentario)

}

//capturar grafico

var densityCanvas = document.getElementById(grafico);
   
 



Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 10;

console.log(obj[0].notas)

var densityData = {
  label: 'Calificaciones',
  data: obj[0].notas,
  backgroundColor: [
    'rgba(0, 99, 132, 0.6)',
    'rgba(30, 99, 132, 0.6)',
    'rgba(60, 99, 132, 0.6)',
    'rgba(90, 99, 132, 0.6)',
    'rgba(120, 99, 132, 0.6)',
    'rgba(150, 99, 132, 0.6)',
    'rgba(180, 99, 132, 0.6)',
    'rgba(210, 99, 132, 0.6)',
    'rgba(240, 99, 132, 0.6)'
  ],
  borderColor: [
    'rgba(0, 99, 132, 1)',
    'rgba(30, 99, 132, 1)',
    'rgba(60, 99, 132, 1)',
    'rgba(90, 99, 132, 1)',
    'rgba(120, 99, 132, 1)',
    'rgba(150, 99, 132, 1)',
    'rgba(180, 99, 132, 1)',
    'rgba(210, 99, 132, 1)',
    'rgba(240, 99, 132, 1)'
  ],
  borderWidth: 1,
  hoverBorderWidth: 2
};

var chartOptions = {
  scales: {
    yAxes: [{
      barPercentage: 1,
   
    }]
  },
  elements: {
    rectangle: {
      borderSkipped: 'right',
    }
  }
};


console.log(obj[0].preguntas)

var barChart = new Chart(densityCanvas, {
  type: 'horizontalBar',
  data: {
    labels: obj[0].preguntas,
    datasets: [densityData],
  },
  options: chartOptions
});


// imagen = densityCanvas.toDataURL();   
// console.log("imagen :"+imagen);


switch(opcion){
      case 1:
          modal.find('.modal-body #id_evaluado1').val(id)
	  modal.find('.modal-body #nombre1').val(nombre_evaluado) 
	  modal.find('.modal-body #apellido1').val(apellido_evaluado)
  //        modal.find('.modal-body #imagen').val(imagen)
     break;
     case 2:
          modal.find('.modal-body #id_evaluado2').val(id)
	  modal.find('.modal-body #nombre2').val(nombre_evaluado) 
	  modal.find('.modal-body #apellido2').val(apellido_evaluado)
          modal.find('.modal-body #evaluador2').val(nomb_evaluador)
	  modal.find('.modal-header #etiqueta').html("Detalle Evaluacion "+fecha)
  //        modal.find('.modal-body #imagen2').val(imagen)
     break;
  }

}});




})

}