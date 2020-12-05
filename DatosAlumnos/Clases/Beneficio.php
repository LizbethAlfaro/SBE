<?php

class Beneficio{

         function recuperarBeneficio($con){
     
          $sSelect = " SELECT id_beneficio,descripcion_beneficio,puntaje";
          $sTable  = " FROM tbl_beneficio ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
    
       function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_beneficio " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_beneficio = '".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
}
