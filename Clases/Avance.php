<?php

class Avance {

         function recuperarAvance($con){
     
          $sSelect = " SELECT id_avance,descripcion_avance,inferior,superior,puntaje";
          $sTable  = " FROM tbl_avance ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
    
         function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_avance " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_avance = '".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
}
