<?php

class Cp{
  
         function recuperarCp($con){
     
          $sSelect = " SELECT id_cp,descripcion_cp ";
          $sTable  = " FROM tbl_cp ";

            
           $sql=" $sSelect $sTable ";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
     //   print_r($sql);
        return $result;
    }
    

}
