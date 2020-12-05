<?php

Class Asistente{

    // metodos
    function recuperarAsistente($rut_asistente,$condicion,$habilitados,$con) {

        // sql server devuelve las fechas como date time 10-10-2018 AM 12:00:00 provocando error,se debe Convertir
        $sSelect= " SELECT rut_asistente,nombre_asistente,apellido_asistente,mail_asistente, CONVERT(varchar,fecha_agregado) as fecha_agregado,tipo, tbl_tipoAsistente.nombre_tipo " ;
        $sTable = " FROM tbl_asistente, tbl_tipoAsistente ";
        $sWhere = " WHERE tbl_asistente.tipo = tbl_tipoAsistente.id_tipo ";

        if ($habilitados=="1"){
           $sWhere .= " AND estado = 1 ";
        }else if($habilitados=="0"){
           $sWhere .= " AND estado = 0 ";  
        }
        
        if ($condicion!=""){
           $sWhere .= $condicion;
        }
        
        if ($rut_asistente!=""){ 
           $sWhere .= " AND tbl_asistente.rut_asistente = '$rut_asistente' " ;
        }
        
        $sWhere.=" ORDER BY rut_asistente DESC ";
        
        $sql = " $sSelect $sTable $sWhere ";

        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   
    //    print_r($sql);
        
        return $result;
    }

      function registrarAsistente($rut,$nombre,$apellido,$mail,$tipo,$clave_hash,$con){
      
      $fecha_agregado=date("Y-m-d H:i:s");
      
      $sql = "INSERT INTO tbl_asistente " 
           . " (rut_asistente, nombre_asistente, apellido_asistente,mail_asistente,tipo,clave_asistente,estado,fecha_agregado) "
           . " VALUES('".$rut."','".$nombre."','".$apellido."','" . $mail . "','" . $tipo . "','" . $clave_hash . "','1','" . $fecha_agregado . "')";    
   
   //     print_r($sql);
        $result=sqlsrv_query($con,$sql);
        return $result;
    }
    
     function editarAsistente($rut,$nombre,$apellido,$mail,$tipo,$con){
 
              $sql = "UPDATE tbl_asistente " 
                 . " SET nombre_asistente       ='".$nombre."',"
                      . "apellido_asistente     ='".$apellido."',"
                      . "mail_asistente         ='".$mail."',"
                      . "tipo                   ='".$tipo."' "
                      . "WHERE rut_asistente='".$rut."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
   
     function editarClave($rut,$clave_hash,$con){
         
        $sql = "UPDATE tbl_asistente SET clave_asistente='".$clave_hash."' WHERE rut_asistente='".$rut."'";
        $result=sqlsrv_query($con,$sql);
        return $result;
    }
        
    function des_habilitarAsistente($rut,$estado,$con){
        $sql = "UPDATE tbl_asistente SET estado='$estado' WHERE rut_asistente='".$rut."'";
        $result=sqlsrv_query($con,$sql);
   //     print_r($sql);
        return $result;
    }

  
}


//13.750.375-1