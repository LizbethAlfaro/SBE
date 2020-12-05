<?php

class Relacion {

      function recuperarRelacion($con){
     
          $sSelect = " SELECT id_relacion,nombre_relacion ";
          $sTable  = " FROM tbl_relacion ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql);
        return $result;
    }
    
}
