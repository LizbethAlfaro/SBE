<?php

class Calificacion{

         function recuperarCalificacion($con){
     
          $sSelect = " SELECT id_calificacion,descripcion_calificacion,puntaje";
          $sTable  = " FROM tbl_calificacion ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
    
       function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_calificacion " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_calificacion = '".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
}
