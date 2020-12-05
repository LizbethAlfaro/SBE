<?php

class Cae{
  
         function recuperarCae($con){
     
          $sSelect = " SELECT id_cae,descripcion_cae ";
          $sTable  = " FROM tbl_cae ";

            
           $sql=" $sSelect $sTable ";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
     //   print_r($sql);
        return $result;
    }
    

}
