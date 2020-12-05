<?php

class TipoSolicitud{
  
         function recuperarTipoSolicitud($con){
     
          $sSelect = " SELECT id_tipo_solicitud,nombre_tipo_solicitud ";
          $sTable  = " FROM tbl_tipo_solicitud ";

            
           $sql=" $sSelect $sTable ";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
        print_r($sql);
        return $result;
    }
    

}
