<?php

class Nacionalidad {

         function recuperarNacionalidad($con){
     
          $sSelect = " SELECT id_nacionalidad,nombre_nacionalidad,puntaje";
          $sTable  = " FROM tbl_nacionalidad ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
    
       function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_nacionalidad " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_nacionalidad='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
}
