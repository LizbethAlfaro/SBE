<?php

class Region{
  
         function recuperarRegion($con){
     
          $sSelect = " SELECT id_region,nombre_region";
          $sTable  = " FROM tbl_region ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql);
        
        print_r($sql);
        
        return $result;
    }
    
}
