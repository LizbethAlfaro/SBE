<?php
if(isset($_GET['acceso_id'])){
$id      =$_GET['acceso_id'];
$var = "acceso_id";
}
elseif(isset($_GET['informacion_id'])){
$id=$_GET['informacion_id'];
$var = "informacion_id";
}
elseif(isset($_GET['carrera_id'])){
$id      =$_GET['carrera_id'];
$var = "carrera_id";
}


if(isset($var)){

$consulta = $var ."=". $id     
?>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script>

    $.ajax({
        url: 'https://190.215.75.115/DatosAlumnos/service.php? <?php echo $consulta ?>',
        beforeSend: function (objeto) {
            console.log('Obteniendo resultados...')
        },
        success: function (data) {
            console.log(data)
        }
    })

</script>
<?php
}
?>