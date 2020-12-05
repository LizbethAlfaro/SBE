<?php


Class Tenencia{

 // metodos
    function recuperarTenencia($con) {

        $sTable = " tbl_tenencia ";
        $sWhere = "";
   
      

        $sql = " SELECT * FROM  $sTable $sWhere ";

        $result = sqlsrv_query($con, $sql,array(), array("Scrollable"=>"static"));  

        return $result;
    }

    
        
      function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_tenencia " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_tenencia='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
    
} 