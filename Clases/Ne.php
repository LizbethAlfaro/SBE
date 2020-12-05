<?php

class Ne{
  
         function recuperarNe($con){
     
          $sSelect = " SELECT id_ne,descripcion_ne ";
          $sTable  = " FROM tbl_ne ";

            
           $sql=" $sSelect $sTable ";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
     //   print_r($sql);
        return $result;
    }
    

}
