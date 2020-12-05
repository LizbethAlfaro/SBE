<?php

class Beca{
  
         function recuperarBeca($id_beca,$con){
     
          $sSelect = " SELECT id_beca,nombre_beca,descripcion_beca,puntaje,aa,na ";
          $sTable  = " FROM tbl_beca ";
          $sWhere  = "";

          if($id_beca!= ""){
           $sWhere    = " WHERE id_beca = '$id_beca'";   
         }
            
          $sWhere .=" order by id_beca ";
          
           $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
    //    print_r($sql);
        return $result;
    }
    
    
    

}
