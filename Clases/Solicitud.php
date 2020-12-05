<?php

Class Solicitud{

    // metodos
    function recuperarSolicitud($rut_estudiante,$condicion,$con) {

        // sql server devuelve las fechas como date time 10-10-2018 AM 12:00:00 provocando error,se debe Convertir
        $sSelect= " SELECT sol.rut_estudiante,sol.estado,convert(varchar,sol.fecha) as fecha,nombre_estado_solicitud,sol.tipo, nombre_tipo_solicitud,sol.acredita,asist.nombre_asistente,asist.apellido_asistente,estud.nombre_estudiante,estud.apellido_estudiante,estud.carrera_estudiante,estud.mail_estudiante " ;
        $sTable = " FROM tbl_estado_solicitud,tbl_tipo_solicitud ,tbl_estudiante estud,  tbl_solicitud sol FULL OUTER JOIN tbl_asistente asist on asist.rut_asistente = sol.acredita ";
        $sWhere = " WHERE sol.estado = id_estado_solicitud "
                . " AND tbl_tipo_solicitud.id_tipo_solicitud = sol.tipo "
         //       . " AND asist.rut_asistente = sol.acredita "
                . " AND sol.rut_estudiante= estud.rut_estudiante " ;

        if ($rut_estudiante!=""){ 
           $sWhere .= " AND estud.rut_estudiante = '$rut_estudiante' " ;
        }
        
        if ($condicion!=""){
            $sWhere .= $condicion;
        }
        
        $sWhere.=" ORDER BY sol.estado,sol.fecha ASC ";

        $sql = " $sSelect $sTable $sWhere ";

        
        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   
   //     print_r($sql);
        return $result;
    }

      function registrarSolicitud($rut,$estado,$tipo,$con){
      //estado 1 pendiente de aprovacion
      //estado 2 revisado  
      //estado 3 aprobado    
      $fechaAgregado=date("Y-m-d H:i:s");
      
      $sql = "INSERT INTO tbl_solicitud " 
           . " (rut_estudiante, fecha,estado,tipo) "
           . " VALUES('$rut','$fechaAgregado','$estado','$tipo')";
        
        $result=sqlsrv_query($con,$sql);
 //       print_r($sql);
        return $result;
    }
    
 
     function editarSolicitud($rut,$estado,$tipo,$con){
 
         $fechaAgregado=date("Y-m-d H:i:s");
         
              $sql = "UPDATE tbl_solicitud " 
                 . " SET "
                      . "fecha   ='".$fechaAgregado."',"
                      . "estado  ='".$estado."',"
                      . "tipo    ='".$tipo."' "

                      ."WHERE rut_estudiante='".$rut."';";

        $result= sqlsrv_query($con,$sql);
    //    print_r($sql);
        return $result;
    }
   
     function acreditarSolicitud($rut_estudiante,$rut_asistente,$con){
 
         $fechaAgregado=date("Y-m-d H:i:s");
         
              $sql = "UPDATE tbl_solicitud " 
                 . " SET "
                      ." acredita   ='".$rut_asistente."'"
                      ." WHERE rut_estudiante='".$rut_estudiante."'";

        $result= sqlsrv_query($con,$sql);
    //    print_r($sql);
        return $result;
    }
   
}


