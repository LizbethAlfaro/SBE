<?php

class SD{
  
         function recuperarSD($con){
     
          $sSelect = " SELECT id_sd,descripcion_sd ";
          $sTable  = " FROM tbl_sd ";

            
           $sql=" $sSelect $sTable ";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
   //     print_r($sql);
        return $result;
    }
    

}
