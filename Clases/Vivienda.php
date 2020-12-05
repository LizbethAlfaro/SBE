<?php

Class Vivienda{

    // metodos
    function recuperarVivienda($rut_estudiante, $con) {

        // sql server devuelve las fechas como date time 10-10-2018 AM 12:00:00 provocando error,se debe Convertir
        $sSelect= " SELECT rut_estudiante,tenencia_vivienda,nombre_tenencia,tipo_vivienda,nombre_tipoVivienda " ;
        $sTable = " FROM tbl_vivienda,tbl_tenencia,tbl_tipoVivienda ";
        $sWhere = " WHERE rut_estudiante = '$rut_estudiante' "
                . " AND tenencia_vivienda = id_tenencia "
                . " AND tipo_vivienda = id_tipoVivienda";

        if ($rut_estudiante!=""){ 
           $sWhere .= " AND rut_estudiante = '$rut_estudiante' " ;
        }

        $sWhere.=" ORDER BY rut_estudiante DESC ";

        $sql = " $sSelect $sTable $sWhere ";

        
        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   
 //      print_r($sql);
        return $result;
    }

   
    function registrarVivienda($tenencia,$tipo,$rut_estudiante,$con) {

        $sql = " INSERT INTO tbl_vivienda "
             . " (tenencia_vivienda, tipo_vivienda, rut_estudiante)"
             . " VALUES('$tenencia','$tipo','$rut_estudiante') ";

        $result = sqlsrv_query($con, $sql);
    //    print_r($sql);
        return $result;
    }
    
 
     function editarVivienda($rut,$tenencia,$tipo,$con){
 
              $sql = "UPDATE tbl_vivienda " 
                 . " SET tenencia_vivienda ='".$tenencia."',"
                      . " tipo_vivienda     ='".$tipo."'"
       
                      ." WHERE rut_estudiante='".$rut."' ";

        $result= sqlsrv_query($con,$sql);
    //   print_r($sql);
        return $result;
    }
	
}


