<?php

class Jefe {

         function recuperarJefe($con){
     
          $sSelect = " SELECT id_jefe,descripcion_jefe,puntaje";
          $sTable  = " FROM tbl_jefe ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
    
       function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_jefe " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_jefe = '".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
}
