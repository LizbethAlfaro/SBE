<?php

class EstadoCivil {
   
      function recuperarEstadoCivil($con){
     
          $sSelect = " SELECT id_estado,nombre_estado,puntaje ";
          $sTable  = " FROM tbl_estadoCivil ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
    function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_estadoCivil " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_estado='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
    
}
