<?php

class NivelEducacional{
     
      function recuperarNivelEducacional($con){
     
          $sSelect = " SELECT id_nivel, nombre_nivel,puntaje ";
          $sTable  = " FROM tbl_nivelEducacional ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
    
     function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_nivelEducacional " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_nivel='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
    
}
