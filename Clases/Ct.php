<?php

class Ct{
  
         function recuperarCt($con){
     
          $sSelect = " SELECT id_ct,descripcion_ct ";
          $sTable  = " FROM tbl_ct ";

            
           $sql=" $sSelect $sTable ";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
   //     print_r($sql);
        return $result;
    }
    

}
