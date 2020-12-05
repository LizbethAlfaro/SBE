<?php

Class Formulario{

    // metodos
    function recuperarFormulario($id_formulario,$rut_estudiante, $con,$condicion,$offset,$per_page) {

        // sql server devuelve las fechas como date time 10-10-2018 AM 12:00:00 provocando error,se debe Convertir
        $sSelect= " SELECT id_formulario,nombre,rut,carrera,jornada,fecha_ing,fecha_nac,"
                . "direccion,numero,departamento,villa,comuna,region,fono,movil,mail,"
                . "direccion_2,numero_2,departamento_2,villa_2,comuna_2,region_2,"
                . "tenencia_vivienda,tipo_vivienda,"
                . "declaracion,"
                . "fecha_cita,hora_cita,"
                . "CONVERT(varchar,fecha_formulario)as fecha_formulario " ;
        $sTable = " FROM tbl_formulario ";
        $sWhere = "";

        if ($rut_estudiante!=""){ 
           $sWhere .= " WHERE rut = '$rut_estudiante' " ;
        }
        
        if ($id_formulario!=""){ 
           $sWhere .= " WHERE id_formulario = '$id_formulario' " ;
        }
        
        if ($condicion!=""){
           $sWhere .= $condicion;
        }
        
        $sWhere.=" ORDER BY id_formulario DESC ";
        
         if (($offset!="")&&($per_page!="")){
           $sWhere .= " LIMIT $offset,$per_page ";
        }

        $sql = " $sSelect $sTable $sWhere ";

        
        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   
    //    print_r($sql);
        return $result;
    }

      function registrarFormulario($id_formulario,$nombre,$rut,$carrera,$jornada,$fecha_ing,$fecha_nac,$direccion,$numero,$departamento,$villa,$comuna,$region,$fono,$movil,$mail,$direccion_2,$numero_2,$departamento_2,$villa_2,$comuna_2,$region_2,$tenencia_vivienda,$tipo_vivienda,$declaracion,$fecha_cita,$hora_cita,$con){
      
      $fechaAgregado=date("Y-m-d H:i:s");
      
      $sql = "INSERT INTO tbl_formulario " 
           . " ("
              . "id_formulario,"
              . "nombre,"
              . "rut,"
              . "carrera,"
              . "jornada,"
              . "fecha_ing,"
              . "fecha_nac,"
              . "direccion,"
              . "numero,"
              . "departamento,"
              . "villa,"
              . "comuna,"
              . "region,"
              . "fono,"
              . "movil,"
              . "mail,"
              . "direccion_2,"
              . "numero_2,"
              . "departamento_2,"
              . "villa_2,"
              . "comuna_2,"
              . "region_2,"
              . "tenencia_vivienda,"
              . "tipo_vivienda,"
              . "declaracion,"
              . "fecha_cita,"
              . "hora_cita,"
              . "fecha_formulario"
              . ") "
           . " VALUES"
              . "("
              . "'".$id_formulario."'"
              . ",'".$nombre."',"
              . "'".$rut."',"
              . "'" . $carrera . "',"
              . "'" . $jornada . "',"
              . "'" . $fecha_ing . "',"
              . "'" . $fecha_nac . "',"
              . "'" . $direccion . "',"
              . "'" . $numero . "',"
              . "'" . $departamento . "',"
              . "'" . $villa . "',"
              . "'" . $comuna . "',"
              . "'" . $region . "',"
              . "'" . $fono . "',"
              . "'" . $movil . "',"
              . "'" . $mail . "',"
              . "'" . $direccion_2 . "',"
              . "'" . $numero_2 . "',"
              . "'" . $departamento_2 . "',"
              . "'" . $villa_2 . "',"
              . "'" . $comuna_2 . "',"
              . "'" . $region_2 . "',"
              . "'" . $tenencia_vivienda . "',"
              . "'" . $tipo_vivienda . "',"
              . "'" . $declaracion . "',"
              . "'" . $fecha_cita . "',"
              . "'" . $hora_cita . "',"
              . "'" . $fechaAgregado . "'"
              . ")";
  
        $result=sqlsrv_query($con,$sql);
        return $result;
    }
    
 
     function editarFormulario($rut,$nombre,$apellido,$fechaNac,$genero,$fono,$movil,$email,$fechaIng,$carrera,$jornada,$con){
 
              $sql = "UPDATE tbl_estudiante " 
                 . " SET nombre_estudiante      ='".$nombre."',"
                      . "apellido_estudiante    ='".$apellido."',"
                      . "fechaNac_estudiante    ='".$fechaNac."',"
                      . "genero_estudiante      ='".$genero."',"
                      . "fono_estudiante        ='".$fono."',"
                      . "movil_estudiante       ='".$movil."',"
                      . "mail_estudiante        ='".$email."',"
                      . "fechaIng_estudiante    ='".$fechaIng."',"
                      . "carrera_estudiante     ='".$carrera."',"
                      . "jornada_estudiante     ='".$jornada."'"
                      
                      ."WHERE rut_estudiante='".$rut."';";

        $result= sqlsrv_query($con,$sql);
    //    print_r($sql);
        return $result;
    }
    
     function editarObservacion($rut,$observacion,$con){
 
              $sql = "UPDATE tbl_solicitud " 
                 . " SET observacion      ='".$observacion."'"

                      ." WHERE rut_estudiante='".$rut."';";

        $result= sqlsrv_query($con,$sql);
    //    print_r($sql);
        return $result;
    }
    
    function recuperarObservacion($rut,$con){
 
        $sSelect = "Select observacion " ;
        $sTable = " FROM tbl_solicitud ";
        $sWhere = " WHERE rut_estudiante='".$rut."'";

        $sql = " $sSelect $sTable $sWhere ";
        
        $result= sqlsrv_query($con,$sql);
    //    print_r($sql);
        return $result;
    }
	
}


