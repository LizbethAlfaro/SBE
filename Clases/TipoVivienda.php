<?php


Class TipoVivienda{

 // metodos
    function recuperarTipoVivienda($con) {

        $sSelect = " SELECT id_tipoVivienda,nombre_tipoVivienda,puntaje ";
        $sTable  = " FROM tbl_tipoVivienda ";
        $sWhere  = "";

        $sql = " $sSelect  $sTable $sWhere ";

        $result = sqlsrv_query($con, $sql,array(), array("Scrollable"=>"static"));  
  //      print_r($sql);

        
//cursores diferentes, para numrows        
// $stmt = sqlsrv_query($conn, $tsql);  
// $stmt = sqlsrv_query($conn, $tsql, array(), array("Scrollable"=>"forward"));  
// $stmt = sqlsrv_query($conn, $tsql, array(), array("Scrollable"=>"static"));  
// $stmt = sqlsrv_query($conn, $tsql, array(), array("Scrollable"=>"keyset"));  
// $stmt = sqlsrv_query($conn, $tsql, array(), array("Scrollable"=>"dynamic"));  
        
        return $result;
    }

    
      function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_tipoVivienda " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_tipoVivienda='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
    
} 