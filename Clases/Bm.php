<?php

class Bm{
  
         function recuperarBm($con){
     
          $sSelect = " SELECT id_bm,descripcion_bm ";
          $sTable  = " FROM tbl_bm ";

            
           $sql=" $sSelect $sTable ";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
     //   print_r($sql);
        return $result;
    }
    

}
