<?php

class Pueblo {

         function recuperarPueblo($con){
     
          $sSelect = " SELECT id_pueblo,nombre_pueblo,puntaje";
          $sTable  = " FROM tbl_pueblo ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
      function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_pueblo " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_pueblo='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
    
}
