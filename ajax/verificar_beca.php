<?php
 include '../Clases/UMAS.php';
 require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
 require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
 include '../Autenticacion/FormatoRut.php';
 
if (!empty($_REQUEST['rut'])) {
    
    $rut = sinPuntosGuionRut($_REQUEST['rut']);
    $result = UMAS::verificarBecas($rut,$con);
    if ($result) {
        $contador = sqlsrv_num_rows($result);
        
        if ($contador > 0) {
            while ($resultCursor = sqlsrv_fetch_array($result)) {
                $resultArreglo = array(
                 "beca" => $resultCursor['CODBEN']
                );
            }
        } else {
                $resultArreglo = array(
                 "beca" => ""
                );
        }
    }
    
    $beca="0";

    switch ($resultArreglo['beca']){
              case '40':
                  /*BECA UGM*/
                    $beca="1";
                  break;
              case '42':
                  /*BECA DEPORTIVA*/
                    $beca="2";
                  break;
//              case '55': 
//                  /*BECA ALUMNI HIJOS*/
//                    $beca="3";
//                  break;
              case '51': 
                  /*BECA FUNCIONARIO*/
                    $beca="4";
                  break;
              case '45':
                  /*BECA BECA FAMILIAR*/
                    $beca="5";
                  break;
              case '44':
                  /*BECA EXTRANJERO*/
                    $beca="6";
                  break;
              case '70':  
                  /*BECA COPAGO 0*/
                    $beca="7";
                  break;
              case '41':  
                  /*BECA AL MERITO NEM*/
                    $beca="8";
                  break;
              case '47':  
                  /*BECA SOCIOECONOMICA (EXCLUYENTE)*/
                    $beca="9";
                  break;
               case '46':
                  /*BECA HIJOS DE ALUMNI EXALUMNO*/
                    $beca="10";
                  break;
               case '55':
                  /*BECA BECA ALUMNI UGM Y UCINF EXALUMNO*/
                    $beca="11";
                  break;
              default :
                  $beca="0";
                  break;
          }

          echo $beca;
          
}else{
    echo 'rut vacio';
}
    ?>



