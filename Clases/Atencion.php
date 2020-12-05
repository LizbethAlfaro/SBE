<?php

Class Atencion{

    // metodos
    function recuperarAtencion($condicion,$con) {

        // sql server devuelve las fechas como date time 10-10-2018 AM 12:00:00 provocando error,se debe Convertir
        $sSelect= " SELECT estud.rut_estudiante,estud.nombre_estudiante,estud.apellido_estudiante,estud.mail_estudiante,asist.nombre_asistente,asist.apellido_asistente,modu.horario,CAST(asig.fecha as varchar) as fecha,es.nombre_estado_solicitud " ;
        $sTable = " FROM tbl_asignacion asig,tbl_modulo modu,tbl_asistente asist,tbl_estudiante estud,tbl_solicitud sol,tbl_estado_solicitud es ";
        $sWhere = " WHERE asig.id_modulo = modu.id_modulo
                    AND asist.rut_asistente=asig.rut_asistente
                    AND estud.rut_estudiante=asig.rut_estudiante
                    AND sol.rut_estudiante=estud.rut_estudiante
                    AND es.id_estado_solicitud=sol.estado ";
  
        
        if ($condicion!=""){
        $sWhere .= $condicion; 
        }
        
        $sWhere.=" ORDER BY asig.fecha,modu.id_modulo ";


        $sql = " $sSelect $sTable $sWhere ";

        
        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   
   //     print_r($sql);
        return $result;
    }

}


