<?php

class Formula {

         function recuperarFormula($con){
     
          $sSelect = " SELECT id_formula,descripcion_formula,puntaje";
          $sTable  = " FROM tbl_formula ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
    
       function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_formula " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_formula = '".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
}
