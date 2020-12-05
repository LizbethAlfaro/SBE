<?php

class Comuna{
  
         function recuperarComuna($con){
     
          $sSelect = " SELECT id_comuna,nombre_comuna,region ";
          $sTable  = " FROM tbl_comuna ";
          $sWhere  = " Order By nombre_comuna ";
            
           $sql=" $sSelect $sTable $sWhere";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
   //     print_r($sql);
        return $result;
    }
    

}
