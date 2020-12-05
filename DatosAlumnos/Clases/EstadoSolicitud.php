<?php

class EstadoSolicitud{
  
         function recuperarEstadoSolicitud($con){
     
          $sSelect = " SELECT id_estado_solicitud,nombre_estado_solicitud ";
          $sTable  = " FROM tbl_estado_solicitud ";

            
           $sql=" $sSelect $sTable ";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
   //     print_r($sql);
        return $result;
    }
    
    
       function recuperarEstadoBecaInterna($con){
     
          $sSelect = " SELECT id_estado,nombre_estado ";
          $sTable  = " FROM tbl_estado_estudiante_beca ";

            
           $sql=" $sSelect $sTable ";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
   //     print_r($sql);
        return $result;
    }

}
