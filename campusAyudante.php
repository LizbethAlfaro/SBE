<?php

require_once("./config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("./config/conexion.php"); //Contiene funcion que conecta a la base de datos
include './Clases/Umas.php';
include './Clases/Extra.php';
include './Clases/Scape.php';

$periodo = $_POST['periodo'];
$anhio = $_POST['anhio'];



$result = Umas::campusAyudante($anhio, $periodo, $con);

if ($result) {
  $numrows = sqlsrv_num_rows($result);

  //loop through fetched data
  if ($numrows > 0) {
    header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
    header("Content-Disposition: attachment; filename=carga-ayudantes-$anhio-$periodo.xls");

?>
    <div class="table-responsive">
      <table class="table">
        <tr class="success">
          <th>username</th>
          <th>password</th>
          <th>firstname</th>
          <th>lastname</th>
          <th>email</th>
          <th>course1</th>
        </tr>
        <?php


        while ($row = sqlsrv_fetch_array($result)) {
          $username     = $row['username'];
          $password     = $row['password'];
          $firstname    = $row['firstname'];
          $lastname     = $row['lastname'];
          $email        = $row['email'];
          $course1      = $row['course1'];

        ?>
          <tr>
            <td><?php echo $username;     ?></td>
            <td><?php echo $password;     ?></td>
            <td><?php echo $firstname;     ?></td>
            <td><?php echo $lastname;     ?></td>
            <td><?php echo $email;     ?></td>
            <td><?php echo $course1;     ?></td>

          </tr>
        <?php
        }
        ?>
      </table>

    </div>
  <?php
  }else {
    ?>
    <div>No existen datos</div>
  <?php
  }

} else {
  ?>
  <div>No existen datos</div>
<?php
}
?>