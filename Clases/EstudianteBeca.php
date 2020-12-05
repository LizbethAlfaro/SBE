<?php

Class EstudianteBeca{

    // metodos
    function recuperarEstudianteBeca($rut, $con,$condicion,$offset,$per_page) {

        // sql server devuelve las fechas como date time 10-10-2018 AM 12:00:00 provocando error,se debe Convertir
        $sSelect= "
      SELECT 
       [rut_estudiante]
      ,[acredita]
      ,[beca]
      ,[reno_post]
      ,[descripcion_reno_post]
      ,[nombre_estudiante]
      ,[apellido_estudiante]
      ,[genero_estudiante]
      ,[fono_estudiante]
      ,[movil_estudiante]
      ,[jornada_estudiante]
      ,[carrera_estudiante]
      ,CONVERT(VARCHAR,fechaNac_estudiante)as fechaNac_estudiante
      ,[fechaIng_estudiante]
      ,[mail_estudiante]
      ,CONVERT(VARCHAR,[fecha_agregado]) as fecha_agregado
      ,[clave_estudiante]
      ,[direccion_1]
      ,[numero_1]
      ,[departamento_1]
      ,[villa_1]
      ,[comuna_1]
      ,[region_1]
      ,[direccion_2]
      ,[numero_2]
      ,[departamento_2]
      ,[villa_2]
      ,[comuna_2]
      ,[region_2]
      ,[nombre_jornada]
      ,[nombre_beca]
      ,[nombre_comuna]
      ,[nombre_region]
      ,[estado]
      ,[nombre_estado]";  
        $sTable = " FROM tbl_estudiante_beca,tbl_genero,tbl_jornada,tbl_beca,tbl_comuna,tbl_region, tbl_estado_estudiante_beca,tbl_reno_post";
        $sWhere = " WHERE genero_estudiante = tbl_genero.id_genero "
                . " AND  jornada_estudiante = tbl_jornada.id_jornada "
                . " AND id_region = region_1 AND id_comuna = comuna_1 "
                . " AND estado = id_estado "
                . " AND beca = id_beca "
                . " AND id_reno_post = reno_post";
        //        . " AND  tbl_estudiante.carrera_estudiante = tbl_carrera.id_carrera ";

      
       
        if ($rut!=""){ 
           $sWhere .= " AND rut_estudiante = '$rut' " ;
        }
        
        if ($condicion!=""){
        $sWhere .= $condicion; 
        }
        
        $sWhere.=" ORDER BY estado,fecha_agregado ASC ";
        
         if (($offset!="")&&($per_page!="")){
           $sWhere .= " LIMIT $offset,$per_page ";
        }

        $sql = " $sSelect $sTable $sWhere ";

        
        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   
  //      print_r($sql);
        return $result;
    }

      function registrarEstudianteBeca($rut,$beca,$renoPost,$nombre,$apellido,$fechaNac,$genero,$fono,$movil,$email,$fechaIng,$carrera,$jornada,$direccion,$numero,$departamento,$villa,$comuna,$region,$direccion2,$numero2,$departamento2,$villa2,$comuna2,$region2,$estado,$con){
      
      $fechaAgregado=date("Y-m-d H:i:s");
   //   $fechaIng=date("Y",strtotime($fechaIng));
      $fechaNac=date("Y-m-d H:i:s",strtotime($fechaNac));
      $sql = "INSERT INTO tbl_estudiante_beca " 
           . " (rut_estudiante,beca,reno_post, nombre_estudiante, apellido_estudiante,fechaNac_estudiante,genero_estudiante,fono_estudiante,movil_estudiante,mail_estudiante,fechaIng_estudiante,carrera_estudiante,jornada_estudiante,fecha_agregado, direccion_1,numero_1, departamento_1, villa_1, comuna_1,region_1,direccion_2,numero_2, departamento_2, villa_2, comuna_2,region_2,estado ) "
           . " VALUES('".$rut."','".$beca."','".$renoPost."','".$nombre."','".$apellido."',". "'" . $fechaNac . "',". "'" . $genero . "','" . $fono . "','" . $movil . "','" . $email . "',". "$fechaIng". ",'" . $carrera . "','" . $jornada . "','" . $fechaAgregado . "'"
              . ",'" . $direccion . "','" . $numero . "','" . $departamento . "','" . $villa . "','" . $comuna . "','" . $region . "'"
              . ",'" . $direccion2 . "','" . $numero2 . "','" . $departamento2 . "','" . $villa2 . "','" . $comuna2 . "','" . $region2 . "','" . $estado . "'"
              . ");";
        
        $result=sqlsrv_query($con,$sql);
     //   print_r($sql);
        return $result;
    }
    
 
     function estadoEstudianteBeca($rut,$acredita,$estado,$con){
 
              $sql = "UPDATE tbl_estudiante_beca " 
                 . " SET "
                      . " estado      ='".$estado."',"
                      . " acredita      ='".$acredita."'"

                 ." WHERE rut_estudiante='".$rut."';";

        $result= sqlsrv_query($con,$sql);
   //     print_r($sql);
        return $result;
    }
   
   
       function editarEstudianteBeca($rut,$fechaNac,$fono,$movil,$email,$direccion,$numero,$departamento,$villa,$comuna,$region,$con){
      

      $fechaNac=date("Y-m-d H:i:s",strtotime($fechaNac));
      
      $sql = " UPDATE tbl_estudiante_beca SET" 
           . " fechaNac_estudiante='$fechaNac',fono_estudiante='$fono',movil_estudiante='$movil',mail_estudiante='$email', direccion_1='$direccion',numero_1='$numero', departamento_1='$departamento', villa_1='$villa', comuna_1='$comuna',region_1='$region' " 
           . " WHERE rut_estudiante='".$rut."';";
        
        $result=sqlsrv_query($con,$sql);
     //   print_r($sql);
        return $result;
    }
    
}


