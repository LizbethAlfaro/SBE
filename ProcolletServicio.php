<?php

require_once("./config/db.php"); //Contiene las variables de configuracion para conectar a la base de datos
require_once("./config/conexion.php"); //Contiene funcion que conecta a la base de datos
include './Clases/Umas.php';
include './Clases/Extra.php';
include './Clases/Scape.php';

//$periodo = $_POST['periodo'];
//$anhio = $_POST['anhio'];



$result = Umas::Procollet($con);




if ($result) {
  $numrows = sqlsrv_num_rows($result);

  //loop through fetched data
  if ($numrows > 0) {
   //  header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
   //  header("Content-Disposition: attachment; filename=Reporte_Procollet.xls");

     header("Content-type: text/csv");
     header("Content-Disposition: attachment; filename=Reporte_Procollet");

?>
    <div class="table-responsive">
      <table class="table">
        <tr class="success">
          <th>RUT</th>
          <th>DV</th>
          <th>ALUMNO</th>
          <th>VIA INGRESO</th>
          <th>ESTADO ACADEMICO</th>
          <th>SITUACION ACADEMICA</th>
          <th>A&Ntilde;O ULTIMA MATRICULA</th>
          <th>COHORTE</th>
          <th>DIRECCION</th>
          <th>COMUNA</th>
          <th>FONO</th>
          <th>EMAIL</th>
          <th>TIPO CARRERA</th>
          <th>TIPO DOCUMENTO</th>
          <th>NUMERO DOCUMENTO</th>
          <th>CODIGO CARRERA</th>
          <th>NOMBRE CARRERA</th>
          <th>MONTO CAPITAL</th>
          <th>INTERESES</th>
          <th>GASTOS COBRANZA</th>
          <th>SALDO</th>
          <th>FECHA VENCIMIENTO COMPROMISO</th>
          <th>A&Ntilde;O GENERACION DEUDA </th>
          <th>PERIODO GENERACION DEUDA </th>
          <th>RUT GIRADOR CHEQUE</th>
          <th>NOMBRE GIRADOR CHEQUE</th>
          <th>RUT RESPONSABLE FINANCIERO</th>
          <th>NOMBRE RESPONSABLE FINANCIERO</th>
          <th>DIRECCION RESPONSABLE FINANCIERO</th>
          <th>COMUNA RESPONSABLE FINANCIERO</th>
          <th>FONO RESPONSABLE FINANCIERO</th>
          <th>EMAIL RESPONSABLE FINANCIERO</th>
          <th>JORNADA</th>
          <th>UBICACION DOCUMENTO</th>
          <th>BLOQUEO FINANCIERO</th>
          <th>FECHA EMISION COMPROMISO</th>
        </tr>
        <?php


        while ($row = sqlsrv_fetch_array($result)) {
          $RUT_ALUMNO                     = $row['RUT_ALUMNO'];
          $DIGITO_VERIFICADOR_ALUMNO      = $row['DIGITO_VERIFICADOR_ALUMNO'];
          $ALUMNO                         = $row['ALUMNO'];
          $VIA_INGRESO                    = $row['VIA_INGRESO'];
          $ESTADO_ACADEMICO_ALUMNO        = $row['ESTADO_ACADEMICO_ALUMNO'];
          $SITUACION_ACADEMICA_ALUMNO     = $row['SITUACION_ACADEMICA_ALUMNO'];
          $ANO_ULTIMA_MATRICULA           = $row['ANO_ULTIMA_MATRICULA'];
          $COHORTE                        = $row['COHORTE'];
          $DIRECCION_ALUMNO               = $row['DIRECCION_ALUMNO'];
          $COMUNA_ALUMNO                  = $row['COMUNA_ALUMNO'];
          $FONO_ALUMNO                    = $row['FONO_ALUMNO'];
          $EMAIL_ALUMNO                   = $row['EMAIL_ALUMNO'];
          $TIPO_CARRERA                   = $row['TIPO_CARRERA'];
          $TIPO_DOCUMENTO                 = $row['TIPO_DOCUMENTO'];
          $NUMERO_DOCUMENTO               = $row['NUMERO_DOCUMENTO'];
          $CODIGO_CARRERA                 = $row['CODIGO_CARRERA'];
          $NOMBRE_CARRERA                 = $row['NOMBRE_CARRERA'];
          $MONTO_CAPITAL                  = $row['MONTO_CAPITAL'];
          $INTERESES                      = $row['INTERESES'];
          $GASTOS_COBRANZAS               = $row['GASTOS_COBRANZAS'];
          $SALDO                          = $row['SALDO'];
          $FECHA_VENCIMIENTO_COMPROMISO   = $row['FECHA_VENCIMIENTO_COMPROMISO'];
          $ANO_GENERACION_DEUDA           = $row['ANO_GENERACION_DEUDA'];
          $PERIODO_GENERACION_DEUDA       = $row['PERIODO_GENERACION_DEUDA'];
          $RUT_GIRADOR_CHEQUE             = $row['RUT_GIRADOR_CHEQUE'];
          $NOMBRE_GIRADOR_CHEQUE          = $row['NOMBRE_GIRADOR_CHEQUE'];
          $RUT_RESPONSABLE_FINANCIERO     = $row['RUT_RESPONSABLE_FINANCIERO'];
          $NOMBRE_RESPONSABLE_FINANCIERO  = $row['NOMBRE_RESPONSABLE_FINANCIERO'];
          $DIRECCION_RESPONSABLE_FINANCIERO = $row['DIRECCION_RESPONSABLE_FINANCIERO'];
          $COMUNA_RESPONSABLE_FINANCIERO  = $row['COMUNA_RESPONSABLE_FINANCIERO'];
          $FONO_RESPONSABLE_FINANCIERO    = $row['FONO_RESPONSABLE_FINANCIERO'];
          $EMAIL_RESPONSABLE_FINANCIERO   = $row['EMAIL_RESPONSABLE_FINANCIERO'];
          $JORNADA                        = $row['JORNADA'];
          $UBICACION_DOCUMENTO            = $row['UBICACION_DOCUMENTO'];
          $BLOQUEO_FINANCIERO             = $row['BLOQUEO_FINANCIERO'];
          $FECHA_EMISION_COMPROMISO       = $row['FECHA_EMISION_COMPROMISO'];


        ?>
          <tr>
            <td><?php echo $RUT_ALUMNO;     ?></td>
            <td><?php echo $DIGITO_VERIFICADOR_ALUMNO;     ?></td>
            <td><?php echo $ALUMNO;     ?></td>
            <td><?php echo $VIA_INGRESO;     ?></td>
            <td><?php echo $ESTADO_ACADEMICO_ALUMNO;     ?></td>
            <td><?php echo $SITUACION_ACADEMICA_ALUMNO;     ?></td>
            <td><?php echo $ANO_ULTIMA_MATRICULA;     ?></td>
            <td><?php echo $COHORTE;     ?></td>
            <td><?php echo $DIRECCION_ALUMNO;     ?></td>
            <td><?php echo $COMUNA_ALUMNO;     ?></td>
            <td><?php echo $FONO_ALUMNO;     ?></td>
            <td><?php echo $EMAIL_ALUMNO;     ?></td>
            <td><?php echo $TIPO_CARRERA;     ?></td>
            <td><?php echo $TIPO_DOCUMENTO;     ?></td>
            <td><?php echo $NUMERO_DOCUMENTO;     ?></td>
            <td><?php echo $CODIGO_CARRERA;     ?></td>
            <td><?php echo $NOMBRE_CARRERA;     ?></td>
            <td><?php echo $MONTO_CAPITAL;     ?></td>
            <td><?php echo $INTERESES;     ?></td>
            <td><?php echo $GASTOS_COBRANZAS;     ?></td>
            <td><?php echo $SALDO;     ?></td>
            <td><?php echo $FECHA_VENCIMIENTO_COMPROMISO;     ?></td>
            <td><?php echo $ANO_GENERACION_DEUDA;     ?></td>
            <td><?php echo $PERIODO_GENERACION_DEUDA;     ?></td>
            <td><?php echo $RUT_GIRADOR_CHEQUE;     ?></td>
            <td><?php echo $NOMBRE_GIRADOR_CHEQUE;     ?></td>
            <td><?php echo $RUT_RESPONSABLE_FINANCIERO;     ?></td>
            <td><?php echo $NOMBRE_RESPONSABLE_FINANCIERO;     ?></td>
            <td><?php echo $DIRECCION_RESPONSABLE_FINANCIERO;     ?></td>
            <td><?php echo $COMUNA_RESPONSABLE_FINANCIERO;     ?></td>
            <td><?php echo $FONO_RESPONSABLE_FINANCIERO;     ?></td>
            <td><?php echo $EMAIL_RESPONSABLE_FINANCIERO;     ?></td>
            <td><?php echo $JORNADA;     ?></td>
            <td><?php echo $UBICACION_DOCUMENTO;     ?></td>
            <td><?php echo $BLOQUEO_FINANCIERO;     ?></td>
            <td><?php echo $FECHA_EMISION_COMPROMISO;     ?></td>
          </tr>
        <?php
        }
        ?>
      </table>

    </div>
  <?php
  } else {
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