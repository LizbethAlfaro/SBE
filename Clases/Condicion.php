<?php

class Condicion{
  
         function recuperarCondicion($con){
     
          $sSelect = " SELECT id_condicion,nombre_condicion";
          $sTable  = " FROM tbl_condicion ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql);
        return $result;
    }
    
}
