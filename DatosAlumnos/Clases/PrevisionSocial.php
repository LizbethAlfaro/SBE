<?php

class PrevisionSocial {

         function recuperarPrevisionSocial($con){
     
          $sSelect = " SELECT id_prevision_social,nombre_prevision_social,puntaje";
          $sTable  = " FROM tbl_prevision_social ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
    function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_prevision_social " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_prevision_social='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
}
