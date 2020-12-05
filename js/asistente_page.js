$(document).ready(function () {
    load(1);
});

function load(page) {
    recuperarAsistente()
}

$('#editar_asistente').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id          = button.data('id')
    var nombre      = button.data('nombre')
    var apellido    = button.data('apellido')
    var mail        = button.data('mail')
    var tipo        = button.data('tipo')
    
    var modal = $(this)
    modal.find('.modal-body #mod_id')               .val(id)
    modal.find('.modal-body #mod_nombre')           .val(nombre)
    modal.find('.modal-body #mod_apellido')         .val(apellido)
    modal.find('.modal-body #mod_mail')             .val(mail)
    modal.find('.modal-body #mod_tipo_asistente')   .val(tipo)

})

$('#editar_asistente_clave').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id          = button.data('id')

    var modal = $(this)
    modal.find('.modal-body #mod_clave_id')       .val(id)

})
		

