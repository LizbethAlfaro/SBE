<?php

class Log{
  
         function recuperarLog($condicion,$con){
     
          $sSelect = " SELECT TOP 100 rut_asistente,asistente,accion,CONVERT(varchar,fecha,20)as fecha ";
          $sTable  = " FROM tbl_log ";
          $sWhere  = ""; 

          if ($condicion != "") {
            $sWhere .= $condicion;
         }
          
          $sWhere .= "Order By id_log DESC"; 
            
           $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
   //     print_r($sql);
        return $result;
    }
    
  function registrarLog($rut_asistente,$asistente,$accion,$con){
     
      date_default_timezone_set("Chile/Continental");
      $fecha = date('Y-m-d H:i:s');

        $sql=" INSERT INTO tbl_log "
          ." (rut_asistente,asistente,accion,fecha) "
          ." VALUES ('$rut_asistente','$asistente','$accion','$fecha') ";

  //print_r($sql);
        $result=sqlsrv_query($con,$sql);
        return $result;
    }
    
}
