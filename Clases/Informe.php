<?php

Class Informe{

    // metodos
    function recuperarInforme($rut,$con) {

        // sql server devuelve las fechas como date time 10-10-2018 AM 12:00:00 provocando error,se debe Convertir
        $sSelect= " SELECT top 20 rut_estudiante,ruta,tipo,CAST(fecha as varchar) as fecha " ;
        $sTable = " FROM tbl_informe ";
        $sWhere = " WHERE rut_estudiante = '$rut' ";


        
        $sWhere.=" ORDER BY rut_estudiante DESC ";
        


        $sql = " $sSelect $sTable $sWhere ";

        
        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   
 //       print_r($sql);
        return $result;
    }

      function registrarInforme($rut,$ruta,$tipo,$con){
      
      date_default_timezone_set("Chile/Continental");    
      $fechaAgregado=date("Y-m-d H:i:s");

      $sql = "INSERT INTO tbl_informe " 
           . " (rut_estudiante, ruta, tipo, fecha) "
           . " VALUES('".$rut."','".$ruta."','".$tipo."','" . $fechaAgregado . "');";
        
        $result=sqlsrv_query($con,$sql);
    //    print_r($sql);
        return $result;
    }
    
    
     function recuperarInformeFinal($con) {

        // sql server devuelve las fechas como date time 10-10-2018 AM 12:00:00 provocando error,se debe Convertir
        $sSelect= " SELECT ruta,nombre,CAST(fecha as varchar) as fecha " ;
        $sTable = " FROM tbl_informe_final ";
        $sWhere = "";


        
        $sWhere.=" ORDER BY id_informe_final DESC ";
        


        $sql = " $sSelect $sTable $sWhere ";

        
        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   
 //       print_r($sql);
        return $result;
    }
    
    
      function registrarInformeFinal($ruta,$nombre,$con){
      
      date_default_timezone_set("Chile/Continental");    
      $fechaAgregado=date("Y-m-d H:i:s");

      $sql = "INSERT INTO tbl_informe_final " 
           . " (ruta, nombre, fecha) "
           . " VALUES('".$ruta."','".$nombre."','" . $fechaAgregado . "');";
        
        $result=sqlsrv_query($con,$sql);
    //    print_r($sql);
        return $result;
    }
 
}


