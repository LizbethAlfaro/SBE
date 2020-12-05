<?php

class Cf{
  
         function recuperarCf($con){
     
          $sSelect = " SELECT id_cf,descripcion_cf ";
          $sTable  = " FROM tbl_cf ";

            
           $sql=" $sSelect $sTable ";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
     //   print_r($sql);
        return $result;
    }
    

}
