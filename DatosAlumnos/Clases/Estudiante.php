<?php

Class Estudiante{

    // metodos
    function recuperarEstudiante($rut, $con,$condicion,$offset,$per_page) {

        // sql server devuelve las fechas como date time 10-10-2018 AM 12:00:00 provocando error,se debe Convertir
        $sSelect= " SELECT rut_estudiante,nombre_estudiante,apellido_estudiante,CONVERT(VARCHAR, fechaNac_estudiante,20)as fechaNac_estudiante,genero_estudiante,fono_estudiante,movil_estudiante,mail_estudiante,fechaIng_estudiante, carrera_estudiante,jornada_estudiante,nombre_jornada" ;
        $sTable = " FROM tbl_estudiante, tbl_genero,tbl_jornada ";
        $sWhere = " WHERE tbl_estudiante.genero_estudiante = tbl_genero.id_genero "
                . " AND  tbl_estudiante.jornada_estudiante = tbl_jornada.id_jornada ";
        //        . " AND  tbl_estudiante.carrera_estudiante = tbl_carrera.id_carrera ";

      
       
        if ($rut!=""){ 
           $sWhere .= " AND tbl_estudiante.rut_estudiante = '$rut' " ;
        }
        
        if ($condicion!=""){
        $sSelect= " SELECT rut_estudiante " ;
        $sTable = " FROM tbl_estudiante ";
        $sWhere = " WHERE tbl_estudiante.rut_estudiante = '$rut' "; 
        }
        
        $sWhere.=" ORDER BY tbl_estudiante.rut_estudiante DESC ";
        
         if (($offset!="")&&($per_page!="")){
           $sWhere .= " LIMIT $offset,$per_page ";
        }

        $sql = " $sSelect $sTable $sWhere ";

        
        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   
   //     print_r($sql);
        return $result;
    }

      function registrarEstudiante($rut,$nombre,$apellido,$fechaNac,$genero,$fono,$movil,$email,$fechaIng,$carrera,$jornada,$clave_hash,$con){
      
      $fechaAgregado=date("Y-m-d H:i:s");
   //   $fechaIng=date("Y",strtotime($fechaIng));
      $fechaNac=date("Y-m-d H:i:s",strtotime($fechaNac));
      $sql = "INSERT INTO tbl_estudiante " 
           . " (rut_estudiante, nombre_estudiante, apellido_estudiante,fechaNac_estudiante,genero_estudiante,fono_estudiante,movil_estudiante,mail_estudiante,fechaIng_estudiante,carrera_estudiante,jornada_estudiante,clave_estudiante,fecha_agregado) "
           . " VALUES('".$rut."','".$nombre."','".$apellido."',"
              . "'" . $fechaNac . "',"
              . "'" . $genero . "','" . $fono . "','" . $movil . "','" . $email . "',"
              . "$fechaIng"
              . ",'" . $carrera . "','" . $jornada . "','" . $clave_hash . "','" . $fechaAgregado . "');";
        
        $result=sqlsrv_query($con,$sql);
    //    print_r($sql);
        return $result;
    }
    
 
     function editarEstudiante($rut,$nombre,$apellido,$fechaNac,$genero,$fono,$movil,$email,$fechaIng,$carrera,$jornada,$con){
 
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
   
     function editarClave($rut,$clave_hash,$con){
         
        $sql = "UPDATE tbl_estudiante SET clave_estudiante='".$clave_hash."' WHERE rut_estudiante='".$rut."'";
        $result=sqlsrv_query($con,$sql);
        
     //   print_r($sql);
        return $result;
    }
       /* 
    function eliminarUsuario($rut,$con){
        $sql="DELETE FROM usuario WHERE id_usuario='".$rut."'";
        $result=mysqli_query($con,$sql);
        return $result;
    }
 

    function verificarUsuarioPorEvaluar($id_asignacion,$id_departamento,$tipo,$con){
         $Excep = " SELECT usuario.id_usuario "
                . " FROM historial,usuarioencuesta,usuario "
                . " WHERE usuario.id_usuario=historial.id_evaluado "
                . " AND usuarioencuesta.id_asignacion=historial.id_asignacion "
                . " AND historial.id_asignacion = '$id_asignacion' ";
                                             
        
         $sql = " SELECT usuario.id_usuario,usuario.nombre_usuario,usuario.apellido_usuario "
                . " FROM usuario, departamento, tipo " 
                . " WHERE usuario.tipo_usuario=tipo.id_tipo "
                . " AND usuario.id_usuario not in($Excep) "
                . " AND usuario.departamento_usuario=departamento.id_departamento ";
                
         if($tipo===1){
         $sql .=" AND departamento.id_departamento='".$id_departamento."' ";
         }else{
         $sql .= " AND usuario.tipo_usuario > 1 ";
         }      
      
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
	*/	
}


