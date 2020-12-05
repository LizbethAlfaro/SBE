<?php

class Sugerencia{

         function recuperarSugerencia($con){
     
          $sSelect = " SELECT id_sugerencia,nombre_sugerencia,puntaje";
          $sTable  = " FROM tbl_sugerencia ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
    
       function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_sugerencia " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_sugerencia = '".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
}
