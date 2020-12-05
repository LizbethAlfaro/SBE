<?php

class ResultadoFinal{
  
         function recuperarResultado($condicion,$con){
     
          $sSelect = " SELECT est.rut_estudiante,est.nombre_estudiante,est.apellido_estudiante,tenv.puntaje as 'TENENCIA' ,tv.puntaje as 'TIPO VIVIENDA',gen.puntaje as 'GENERO',estciv.puntaje as 'EST.CIVIL',prevsal.puntaje as 'PREV.SALUD',neduc.puntaje as 'N.EDUC',act.puntaje as 'ACTIVIDAD' ";
          $sTable  = " FROM tbl_estudiante est,tbl_solicitud sol,tbl_vivienda v,tbl_tipoVivienda tv,tbl_tenencia tenv,tbl_genero gen,tbl_integrante integ,tbl_estadoCivil estciv,tbl_prevision prevsal,tbl_nivelEducacional neduc,tbl_actividad act ";
          $sWhere  = " WHERE est.rut_estudiante=sol.rut_estudiante
                        AND v.rut_estudiante=est.rut_estudiante
                        AND v.tenencia_vivienda=tenv.id_tenencia
                        AND v.tipo_vivienda=tv.id_tipoVivienda
                        AND est.genero_estudiante=gen.id_genero
                        AND integ.rut_integrante=integ.rut_estudiante
                        AND est.rut_estudiante=integ.rut_estudiante
                        AND integ.estadoCivil_integrante=estciv.id_estado
                        AND prevsal.id_prevision=integ.prevision_integrante
                        AND neduc.id_nivel=integ.nivelEduc_integrante
                        AND act.id_actividad=integ.actividad_integrante
                        AND sol.estado=3 ";
          
          if($condicion!=""){
              $sWhere.= $condicion;
          }
            
           $sql=" $sSelect $sTable $sWhere";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
   //     print_r($sql);
        return $result;
    }
    

    function resultadoBeca($rut,$con){
       $sSelect = " SELECT * ";
          $sTable  = " FROM tbl_resultado_beca";
          $sWhere  = "";  
             
          if($rut!=""){
              $sWhere.= " where RUT ='$rut' ";
          }
            
           $sql=" $sSelect $sTable $sWhere";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
   //     print_r($sql);
        return $result;
    }
}
