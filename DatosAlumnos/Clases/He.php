<?php

class He{
  
         function recuperarHe($con){
     
          $sSelect = " SELECT id_he,descripcion_he ";
          $sTable  = " FROM tbl_he ";

            
           $sql=" $sSelect $sTable ";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
   //     print_r($sql);
        return $result;
    }
    

}
