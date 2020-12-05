<?php

class ActividadIntegrante{

      function recuperarActividad($con){
     
          $sSelect = " SELECT id_actividad, nombre_actividad,puntaje ";
          $sTable  = " FROM tbl_actividad ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
    function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_actividad " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_actividad='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
    
}
