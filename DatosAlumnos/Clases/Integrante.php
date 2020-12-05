<?php


Class Integrante{

     // metodos
    function recuperarIntegrante($rut_estudiante,$rut_integrante,$con,$condicion,$offset,$per_page) {

        
        $sSelect = "SELECT rut_estudiante,rut_integrante,nombre_integrante,apellido_integrante,genero_integrante,nombre_genero,clasificacion_enfermedad,clasificacion_enfermedad, nombre_enfermedad,isnull(tbl_enfermedad.puntaje,0)as puntaje,isnull(tbl_prevision.puntaje,0)as puntaje_prev,isnull(tbl_nivelEducacional.puntaje,0)as puntaje_nivel, "
                . " CONVERT(VARCHAR, fechaNac_integrante,20)as fechaNac_integrante,relacion_integrante,nombre_relacion,"
                . " estadoCivil_integrante,nombre_estado,nivelEduc_integrante,nombre_nivel,actividad_integrante,nombre_actividad,"
                . " prevision_integrante,nombre_prevision,otraPrevision_integrante,condicion_integrante,nombre_condicion,enfermedad_integrante ";
        $sTable = " FROM   tbl_genero,tbl_relacion, tbl_estadoCivil,tbl_nivelEducacional,tbl_actividad, tbl_prevision,tbl_condicion,"
                . " tbl_integrante full outer join tbl_enfermedad on id_enfermedad = tbl_integrante.clasificacion_enfermedad";
        $sWhere = " WHERE  tbl_integrante.genero_integrante = tbl_genero.id_genero "
                . " AND    tbl_integrante.relacion_integrante = tbl_relacion.id_relacion "
                . " AND    tbl_integrante.estadoCivil_integrante = tbl_estadoCivil.id_estado "
                . " AND    tbl_integrante.nivelEduc_integrante = tbl_nivelEducacional.id_nivel "
                . " AND    tbl_integrante.actividad_integrante = tbl_actividad.id_actividad "
                . " AND    tbl_integrante.prevision_integrante = tbl_prevision.id_prevision "
                . " AND    tbl_integrante.condicion_integrante = tbl_condicion.id_condicion ";
  

        if ($rut_estudiante!=""){ 
           $sWhere .= " AND rut_estudiante='".$rut_estudiante."' " ;
        }
        
         if ($rut_integrante!=""){ 
           $sWhere .= " AND rut_integrante='".$rut_integrante."' " ;
        }
        
        if ($condicion!=""){
           $sWhere .= $condicion;
        }
       
        
        $sWhere.=" ORDER BY rut_integrante";
        
         if (($offset!="")&&($per_page!="")){
           $sWhere .= " LIMIT $offset,$per_page ";
        }

        $sql = " $sSelect $sTable $sWhere ";

    //     print_r('integrante: '.$sql.'<br>');
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   
        return $result;
    }

   
    
    
    function registrarIntegrante($rut_estudiante,$rut,$nombre,$apellido,$genero,$fechaNac,$relacion,$estadoCivil,$nivelEduc,$actividad,$prevision,$otraPrevision,$condicion,$enfermedad,$con){

      $sql=" INSERT INTO tbl_integrante "
          ." (rut_estudiante,rut_integrante,nombre_integrante,apellido_integrante,genero_integrante,fechaNac_integrante,relacion_integrante,estadoCivil_integrante,nivelEduc_integrante,actividad_integrante,prevision_integrante,otraPrevision_integrante,condicion_integrante,enfermedad_integrante) "
          ." VALUES ('$rut_estudiante','$rut','$nombre','$apellido','$genero','$fechaNac','$relacion','$estadoCivil','$nivelEduc','$actividad','$prevision','$otraPrevision','$condicion','$enfermedad') ";

        $result=sqlsrv_query($con,$sql);
        return $result;
    }
    
    //desde datos personales
     function editarEstudianteIntegrante($rut_estudiante,$nombre,$apellido,$genero,$fechaNac,$con){

      $sql=" UPDATE tbl_integrante "
          ." SET nombre_integrante = '$nombre' , apellido_integrante = '$apellido' ,genero_integrante='$genero',fechaNac_integrante='$fechaNac' "
          ." WHERE rut_estudiante ='$rut_estudiante' AND rut_integrante = '$rut_estudiante'" ;
     

        $result=sqlsrv_query($con,$sql);
   //     print_r($sql);  
        return $result;
    }
    
     function editarEnfermedadIntegrante($rut_estudiante,$rut_integrante,$enfermedad,$con){

      $sql=" UPDATE tbl_integrante "
          ." SET clasificacion_enfermedad='$enfermedad' "
          ." WHERE rut_estudiante ='$rut_estudiante' AND rut_integrante = '$rut_integrante'" ;
     

        $result=sqlsrv_query($con,$sql);
    //    print_r($sql);  
        return $result;
    }
    
    //desde integrantes familiares
    function editarEstudianteIntegrante2($rut_estudiante,$estadoCivil,$nivelEduc,$actividad,$prevision,$otraPrevision,$condicion,$enfermedad,$con){

     $sql=" UPDATE tbl_integrante "
            ." SET "
                . " estadoCivil_integrante='".$estadoCivil."',"
                . " nivelEduc_integrante='".$nivelEduc."',"
                . " actividad_integrante='".$actividad."',"
                . " prevision_integrante='".$prevision."',"
                . " otraPrevision_integrante='".$otraPrevision."',"
                . " condicion_integrante='".$condicion."',"
                . " enfermedad_integrante='".$enfermedad."' "
                . " WHERE rut_estudiante='".$rut_estudiante."' "
                . " AND rut_integrante='".$rut_estudiante."'"; 
      
        $result=sqlsrv_query($con,$sql);
     //   print_r($sql);
        return $result;
    }
     function editarIntegrante($rut_estudiante,$rut,$nombre,$apellido,$genero,$fechaNac,$relacion,$estadoCivil,$nivelEduc,$actividad,$prevision,$otraPrevision,$condicion,$enfermedad,$con){
         
        $sql=" UPDATE tbl_integrante "
            ." SET "
                . " nombre_integrante='".$nombre."',"
                . " apellido_integrante='".$apellido."',"
                . " genero_integrante='".$genero."',"
                . " fechaNac_integrante='".$fechaNac."',"
                . " relacion_integrante='".$relacion."',"
                . " estadoCivil_integrante='".$estadoCivil."',"
                . " nivelEduc_integrante='".$nivelEduc."',"
                . " actividad_integrante='".$actividad."',"
                . " prevision_integrante='".$prevision."',"
                . " otraPrevision_integrante='".$otraPrevision."',"
                . " condicion_integrante='".$condicion."',"
                . " enfermedad_integrante='".$enfermedad."' "
                . " WHERE rut_estudiante='".$rut_estudiante."' "
                . " AND rut_integrante='".$rut."'"; 
                
                
        $result=sqlsrv_query($con,$sql);
        return $result;
    }

    
    function eliminarIntegrante($rut_estudiante,$rut_integrante,$con){
        
        $sql=" DELETE FROM tbl_integrante "
            ." WHERE rut_integrante='".$rut_integrante."' "
            ." AND rut_estudiante='".$rut_estudiante."' ";
        $result=sqlsrv_query($con,$sql);
    //   print_r($sql);
        return $result;
    }
    
}