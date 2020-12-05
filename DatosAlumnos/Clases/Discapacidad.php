<?php

class Discapacidad {

         function recuperarDiscapacidad($con){
     
          $sSelect = " SELECT id_discapacidad,nombre_discapacidad,puntaje";
          $sTable  = " FROM tbl_discapacidad ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
           function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_discapacidad " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_discapacidad='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
    
}
