<?php

class IntegranteIngreso {

         function recuperarIntegranteIngreso($con){
     
          $sSelect = " SELECT id_integrante_ingreso,descripcion_integrante_ingreso,puntaje";
          $sTable  = " FROM tbl_integrante_ingreso ";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
    
       function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_integrante_ingreso " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_integrante_ingreso = '".$id."';";

        $result= sqlsrv_query($con,$sql);
    //    print_r('INTEGRANTE INGRESO:'.$sql.'<br>');
        return $result;
    }
    
    function integrantesConIngresos($rut,$con){
     
          $sSelect = " SELECT rut_integrante ";
          $sTable  = " FROM tbl_ingresoFam ";
          $sWhere  = " WHERE (	sueldo_integrante >0 or pension_integrante >0 
                                or honorario_integrante >0 or retiro_integrante >0 
                                or dividendo_integrante >0 or interes_integrante >0 
                                or ganancia_integrante >0 or pension_alim_integrante >0
                                or actividad_integrante >0)
                                AND rut_estudiante='$rut'";
   
             $sql=" $sSelect $sTable $sWhere ";
         //    print_r('INTEGRANTES CON INGRESOS: '.$sql.'<br>');
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
   
}
