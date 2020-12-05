<?php

class IntegrantePensionado {

         function recuperarIntegrantePensionado($con){
     
          $sSelect = " SELECT id_integrante_pensionado,descripcion_integrante_pensionado,puntaje";
          $sTable  = " FROM tbl_integrante_pensionado ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
    
       function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_integrante_pensionado " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_integrante_pensionado = '".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
    
     function integrantesConPension($rut,$con){
     
          $sSelect = " SELECT rut_integrante ";
          $sTable  = " FROM tbl_ingresoFam ";
          $sWhere  = " WHERE (	pension_integrante >0 or retiro_integrante >0 
                                or pension_alim_integrante >0)
                                AND rut_estudiante='$rut'";
   
             $sql=" $sSelect $sTable $sWhere ";
         //    print_r('INTEGRANTES CON PENSION: '.$sql.'<br>');
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
}
