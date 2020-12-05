$(document).ready(function () {
   // load(1);
});

function load(page) {
  //  recuperarUsuarios()
}


	              
$('#myModal2').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
          
	  var nombre = button.data('nombre') 

          
          console.log(id)
          
	  var modal = $(this)
	  modal.find('.modal-body #mod_nombre').val(nombre)

	})      

$('#myModal3').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal

          var id = button.data('id') 
          
          console.log(id)
          
	  var modal = $(this)
          
	  modal.find('.modal-body #mod_id').val(id)
	}) 

		
		

