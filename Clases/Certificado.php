<?php

class Certificado{
  
         function recuperarCertificado($con){
     
          $sSelect = " SELECT id_certificado,descripcion_certificado ";
          $sTable  = " FROM tbl_certificado ";

            
           $sql=" $sSelect $sTable ";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
   //     print_r($sql);
        return $result;
    }
    

}
