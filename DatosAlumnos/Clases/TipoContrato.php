<?php

class TipoContrato {

         function recuperarTipoContrato($con){
     
          $sSelect = " SELECT id_tipo_contrato,nombre_tipo_contrato,puntaje";
          $sTable  = " FROM tbl_tipo_contrato ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
       function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_tipo_contrato " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_tipo_contrato='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
}
