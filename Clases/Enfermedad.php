<?php

class Enfermedad {

         function recuperarEnfermedad($con){
     
          $sSelect = " SELECT id_enfermedad,nombre_enfermedad,puntaje";
          $sTable  = " FROM tbl_enfermedad ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
     function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_enfermedad " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_enfermedad='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
    
}
