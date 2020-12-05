<?php

class Percap {

         function recuperarPercap($con){
     
          $sSelect = " SELECT id_percap,descripcion_percap,inferior,superior,puntaje";
          $sTable  = " FROM tbl_percap ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
    
       function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_percap " 
                 . " SET puntaje       ='".$puntaje."'"

                 . " WHERE id_percap = '".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
}
