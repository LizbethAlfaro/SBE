<?php

class Prevision {

         function recuperarPrevision($con){
     
          $sSelect = " SELECT id_prevision,nombre_prevision,puntaje";
          $sTable  = " FROM tbl_prevision ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
     function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_prevision " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_prevision='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
}
