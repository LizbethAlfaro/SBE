<?php

Class Horario {

    // metodos
    function comprobarHorario($rut_asistente,$modulo,$fecha,$con) {

        $sSelect = " SELECT rut_asistente,modulo,fecha,estado";
        $sTable  = " FROM tbl_horario ";
        $sWhere  = " WHERE rut_asistente = '$rut_asistente' "
                 . " AND modulo = '$modulo' "
                 . " AND fecha  = '$fecha' ";

        $sql = " $sSelect $sTable $sWhere ";

        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

    //    print_r($sql);
        return $result;
    }
    
    
    function recuperarHorario($rut_asistente,$fecha,$con) {

        $sSelect = " SELECT rut_asistente,modulo,fecha,estado";
        $sTable  = " FROM tbl_horario ";
        $sWhere  = " WHERE rut_asistente = '$rut_asistente' "
                 . " AND fecha = '$fecha' ";

        $sWhere .= " ORDER BY modulo Asc ";


        $sql = " $sSelect $sTable $sWhere ";

        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

    //    print_r($sql);
        return $result;
    }

    // ver cuando dos asistentes tienen el modulo asignado (agregar a la excepcion el rut asistente)
    function recuperarModuloDisponible($modulo,$fecha,$con) {

        $excSelect = " SELECT id_modulo ";
        $excTable  = " FROM tbl_asignacion ";
        $excWhere  = " WHERE fecha = '$fecha' ";

        $excSql = " $excSelect $excTable $excWhere ";
        
        $exc_2_Select = " SELECT rut_asistente ";
        $exc_2_Table  = " FROM tbl_asignacion ";
        $exc_2_Where  = " WHERE fecha = '$fecha' "
                      . " AND id_modulo = '$modulo' ";
        
        $exc_2_Sql = " $exc_2_Select $exc_2_Table $exc_2_Where ";
        
        $sSelect = " SELECT rut_asistente,modulo,fecha,estado";
        $sTable  = " FROM tbl_horario ";
        $sWhere  = " WHERE fecha = '$fecha' "
                 . " AND estado = 1 "
                 . " AND modulo = '$modulo' "  //AND (modulo not in ($excSql) 
                 . " AND rut_asistente not in ($exc_2_Sql)"
                 . " GROUP BY rut_asistente,modulo,fecha,estado ";

        $sWhere .= " ORDER BY modulo Asc ";

        $sql = " $sSelect $sTable $sWhere ";

        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

    //    print_r($sql);
        return $result;
    }
    
    function verificarEstudianteCita($rut_estudiante,$con) {

        $sSelect = " SELECT rut_asistente,rut_estudiante,tbl_modulo.id_modulo,convert(varchar,fecha)as fecha, horario ";
        $sTable  = " FROM   tbl_asignacion , tbl_modulo ";
        $sWhere  = " WHERE  rut_estudiante = '$rut_estudiante' "
                 . " AND    tbl_asignacion.id_modulo = tbl_modulo.id_modulo ";

        $sql = " $sSelect $sTable $sWhere ";

        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

     //   print_r($sql);
        return $result;
    }
    
    //recupera al asistente con menor asignacion en el momento
    function recuperarAsistenteCitaMin($rut_estudiante,$fecha,$modulo,$con) {

        $incSelect = " SELECT count(rut_asistente)";
        $incTable  = " FROM tbl_asignacion ";
        $incWhere  = " WHERE fecha = '$fecha' ";
 
        $incSql = " $incSelect $incTable $incWhere ";
        
        $excSelect = " SELECT rut_asistente ";
        $excTable  = " FROM tbl_asignacion ";
        $excWhere  = " WHERE fecha = '$fecha' "
                   . " AND id_modulo = '$modulo' ";
        
        $excSql = " $excSelect $excTable $excWhere ";
        
        //($incSql) as asignacion
        $sSelect = " SELECT top 1 rut_asistente,modulo,fecha,estado ";
        $sTable  = " FROM tbl_horario ";
        $sWhere  = " WHERE fecha = '$fecha' "
                 . " AND estado = 1 "
                 . " AND modulo = '$modulo' "
                 . " AND rut_asistente not in($excSql)"
                 . " GROUP BY rut_asistente,modulo,fecha,estado ";
    //             . " ORDER BY asignacion desc";

        $sql = " $sSelect $sTable $sWhere ";

        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

   //    print_r($sql);
        return $result;
    }
    
    function registrarHorario($rut_asistente,$modulo,$fecha,$estado, $con) {

        $fechaAgregado = date("Y-m-d H:i:s");

        $sql = "INSERT INTO tbl_horario "
                . " (rut_asistente,modulo,fecha,estado) "
                . " VALUES('" . $rut_asistente . "','" . $modulo . "','" . $fecha . "','" . $estado . "');";

        $result = sqlsrv_query($con, $sql);
        //print_r($sql);
        return $result;
    }

     function seleccionarCita($rut_asistente,$rut_estudiante,$id_modulo,$fecha,$con) {

        $sql = "INSERT INTO tbl_asignacion "
                . " (rut_asistente,rut_estudiante,id_modulo,fecha) "
                . " VALUES('$rut_asistente','" . $rut_estudiante . "','" . $id_modulo . "','" . $fecha . "')";

        $result = sqlsrv_query($con, $sql);
        //print_r($sql);
        return $result;
    }
   
     function recuperarCita($rut_estudiante,$id_modulo,$fecha,$con) {

        $sSelect = " SELECT rut_asistente,rut_estudiante,id_modulo,fecha ";
        $sTable  = " FROM tbl_asignacion ";
        $sWhere  = " WHERE rut_estudiante = '$rut_estudiante' "
                 . " AND id_modulo = '$id_modulo' "
                 . " AND fecha = '$fecha' ";

        $sql = " $sSelect $sTable $sWhere ";
        
       $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));
   //     print_r($sql);
        return $result;
    }
    
     function validarHorarioAsistente($rut_asistente,$id_modulo,$fecha,$con) {

        $sSelect = " SELECT rut_asistente,rut_estudiante,id_modulo,fecha ";
        $sTable  = " FROM tbl_asignacion ";
        $sWhere  = " WHERE rut_asistente = '$rut_asistente' "
                 . " AND id_modulo = '$id_modulo' "
                 . " AND fecha = '$fecha' ";

        $sql = " $sSelect $sTable $sWhere ";
        
       $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));
      //     print_r($sql);
       
       if($result){
        $validar = sqlsrv_num_rows($result);
        if($validar>0){
           return true; 
        }else{
           return false;
        }
       }else{
          return false; 
       }

    }
    
    function validarExistenciaCita($rut_estudiante,$con) {

        $sSelect = " SELECT rut_asistente,rut_estudiante,id_modulo,fecha ";
        $sTable  = " FROM tbl_asignacion ";
        $sWhere  = " WHERE rut_estudiante = '$rut_estudiante' ";

        $sql = " $sSelect $sTable $sWhere ";
        
        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));
    //    print_r($sql);
        return $result;
    }
    
    function editarCita($rut_asistente,$rut_estudiante,$id_modulo,$fecha,$con) {

        $sql = "UPDATE tbl_asignacion "
                . " SET "
                . " rut_asistente = '$rut_asistente',"
                . " id_modulo = '$id_modulo',"
                . " fecha = '$fecha' "
                . " WHERE rut_estudiante = '$rut_estudiante' ";

        $result = sqlsrv_query($con, $sql);
        //print_r($sql);
        return $result;
    }
   
    
    function editarHorario($rut_asistente,$modulo,$fecha,$estado, $con) {

        $sql = "UPDATE tbl_horario "
                . " SET "
                . " estado        ='" . $estado . "' "

                . " WHERE "
                . " rut_asistente ='" . $rut_asistente . "' "
                . " AND modulo    ='" . $modulo . "' "
                . " AND fecha     ='" . $fecha . "' ";

        $result = sqlsrv_query($con, $sql);
      //  print_r($sql);
        return $result;
    }

    
    
    function resumenAtencion($rut_asistente,$fecha,$con) {

        $fecha = date('Y-m-d', strtotime($fecha));
        
        $sSelect = " SELECT rut_asistente,rut_estudiante,id_modulo,fecha ";
        $sTable  = " FROM tbl_asignacion ";
        $sWhere  = " WHERE rut_asistente = '$rut_asistente' "
                 . " AND fecha = '$fecha'";
            

        $sql = " $sSelect $sTable $sWhere ";
        
        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));
  //      print_r($sql);
        return $result;
    }        
    
     function obtenerHoraModulo($modulo,$con) {

        $sSelect = " SELECT horario ";
        $sTable  = " FROM tbl_modulo ";
        $sWhere  = " WHERE id_modulo = '$modulo' ";
                
           
        $sql = " $sSelect $sTable $sWhere ";
        
        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));
  //      print_r($sql);
        return $result;
    } 
    
    function fechaCastellano($fecha) {
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $nombredia . " " . $numeroDia . " de " . $nombreMes . " de " . $anio;
    }

    function fechaAnhioMesCastellano($fecha) {
        $fecha = substr($fecha, 0, 10);
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $nombreMes . " de " . $anio;
    }
    
    function fechaDiaCastellano($fecha) {
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        return $nombredia . " " . $numeroDia;
    }

}
