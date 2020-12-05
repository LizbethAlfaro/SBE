<?php

class CVD{
  
         function recuperarCvd($con){
     
          $sSelect = " SELECT id_cvd,descripcion_cvd ";
          $sTable  = " FROM tbl_cvd ";

            
           $sql=" $sSelect $sTable ";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
   //     print_r($sql);
        return $result;
    }
    

}
