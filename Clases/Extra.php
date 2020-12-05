<?php

Class Extra{

    // metodos
    function recuperarExtra($rut, $con) {

        // sql server devuelve las fechas como date time 10-10-2018 AM 12:00:00 provocando error,se debe Convertir
        $sSelect= " SELECT estud.rut_estudiante, nacionalidad, pueblo,formula_ministerial,egresos_totales,jefe_hogar,contrato_jefe,prev_social_jefe,ingreso_jefe,beneficio,sugerencia_asist,discapacidad,calificacion,avance,"
                . " isnull(sug.puntaje,0)as puntaje_sug,isnull(av.puntaje,0)as puntaje_av,isnull(cal.puntaje,0)as puntaje_cal,isnull(ben.puntaje,0)as puntaje_ben,isnull(pue.puntaje,0)as puntaje_pue,isnull(nac.puntaje,0)as puntaje_nac " ;
        $sTable = " FROM tbl_estudiante estud,tbl_sugerencia sug,tbl_avance av,tbl_beneficio ben,tbl_pueblo pue,tbl_nacionalidad nac,tbl_calificacion cal full outer join tbl_extra ex on ex.calificacion = cal.descripcion_calificacion ";
        $sWhere = " WHERE ex.rut_estudiante=estud.rut_estudiante "
                . " AND sug.id_sugerencia = ex.sugerencia_asist "
                . " AND ex.avance BETWEEN av.inferior AND av.superior "
             //   . " AND ex.calificacion = cal.descripcion_calificacion " //error en los q tienen bajo 40
                . " AND ben.id_beneficio = ex.beneficio "
                . " AND pue.id_pueblo = ex.pueblo "
                . " AND nac.id_nacionalidad = ex.nacionalidad ";



      
       
        if ($rut!=""){ 
           $sWhere .= " AND estud.rut_estudiante = '$rut' " ;
        }
        

        $sWhere.=" ORDER BY estud.rut_estudiante DESC ";
        
        $sql = " $sSelect $sTable $sWhere ";

        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   

  // print_r('extra: '.$sql.'<br>');
        return $result;
    }

      function registrarExtra($rut,$nacionalidad,$pueblo,$formula,$egreso,$jefe,$contrato,$prevision,$ingreso,$beneficio,$sugerencia,$discapacidad,$calificacion,$avance,$con){
      
    //  $fechaAgregado=date("Y-m-d H:i:s");
   //   $fechaIng=date("Y",strtotime($fechaIng));
      $sql = "INSERT INTO tbl_extra " 
           . " (rut_estudiante, nacionalidad, pueblo,formula_ministerial,egresos_totales,jefe_hogar,contrato_jefe,prev_social_jefe,ingreso_jefe,beneficio,sugerencia_asist,discapacidad,calificacion,avance) "
           . " VALUES('".$rut."','".$nacionalidad."','".$pueblo."','" . $formula . "','" . $egreso . "','" . $jefe . "','" . $contrato . "','" . $prevision . "','$ingreso','" . $beneficio . "','" . $sugerencia . "','" . $discapacidad . "','" . $calificacion . "','" . $avance . "');";
        
        $result=sqlsrv_query($con,$sql);
     //    print_r($sql);
        return $result;
    }
    
 
     function editarExtra($rut,$nacionalidad,$pueblo,$formula,$egreso,$jefe,$contrato,$prevision,$ingreso,$beneficio,$sugerencia,$discapacidad,$calificacion,$avance,$con){
 
              $sql = "UPDATE tbl_extra " 
                 . " SET nacionalidad           ='".$nacionalidad."',"
                      . " pueblo                 ='".$pueblo."',"
                      . " formula_ministerial    ='".$formula."',"
                      . " egresos_totales        ='".$egreso."',"
                      . " jefe_hogar             ='".$jefe."',"
                      . " contrato_jefe          ='".$contrato."',"
                      . " prev_social_jefe       ='".$prevision."',"
                      . " ingreso_jefe           ='".$ingreso."',"
                      . " beneficio              ='".$beneficio."',"
                      . " sugerencia_asist       ='".$sugerencia."',"
                      . " discapacidad           ='".$discapacidad."',"
                      . " calificacion           ='".$calificacion."',"
                      . " avance                 ='".$avance."' "
                      
                      ." WHERE rut_estudiante='".$rut."';";

        $result= sqlsrv_query($con,$sql);
     //   print_r($sql);
        return $result;
    }
   

 	
}


