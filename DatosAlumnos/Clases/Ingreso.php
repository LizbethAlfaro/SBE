<?php

Class Ingreso{
         
     // metodos
    function recuperarIngreso($rut_integrante,$rut_estudiante,$con,$condicion,$offset,$per_page) {

        $sSelect= " SELECT tbl_ingresoFam.rut_estudiante,tbl_ingresoFam.nombre_integrante,tbl_ingresoFam.apellido_integrante,tbl_ingresoFam.rut_integrante,"
                . " IsNull(sueldo_integrante,0)as sueldo_integrante ,IsNull(pension_integrante,0) as pension_integrante,IsNull(honorario_integrante,0) as honorario_integrante,IsNull(retiro_integrante,0)as retiro_integrante ,"
                . " IsNull(dividendo_integrante,0) as dividendo_integrante,IsNull(interes_integrante,0) as interes_integrante,IsNull(ganancia_integrante,0) as ganancia_integrante,"
                . " IsNull(pension_alim_integrante,0) as pension_alim_integrante ,IsNull(actividad_integrante,0) as actividad_integrante,observacion  ";
        $sFrom  = " FROM tbl_ingresoFam ";
        $sWhere = " WHERE tbl_ingresoFam.rut_estudiante = '$rut_estudiante' ";
        

        if ($rut_integrante!=""){
           $sWhere.= " AND tbl_ingresoFam.rut_integrante = '$rut_integrante' ";
        }    
            
        if ($condicion!=""){
           $sWhere .= $condicion;
        }
       
        if (($offset!="")&&($per_page!="")){
         //     $sWhere .= " LIMIT $offset,$per_page ";
       $sWhere .= " AND RowNumber BETWEEN $offset AND $per_page ";
           
         
        }

       
        $sWhere.=" ORDER BY tbl_ingresoFam.rut_estudiante ";
        
    
        $sql = " $sSelect $sFrom $sWhere ";

   
     // print_r($sql);
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }

    
    function recuperarIngresoJefe($rut_integrante,$rut_estudiante,$con) {

        $sSelect= " SELECT top 1 tbl_ingresoFam.rut_estudiante,tbl_ingresoFam.nombre_integrante,tbl_ingresoFam.apellido_integrante,tbl_ingresoFam.rut_integrante,"
                . " (sueldo_integrante+pension_integrante+honorario_integrante+retiro_integrante+dividendo_integrante+interes_integrante+ganancia_integrante+pension_alim_integrante+actividad_integrante) as 'TOTAL' ";

        $sFrom  = " FROM tbl_ingresoFam ";
        $sWhere = " WHERE tbl_ingresoFam.rut_estudiante = '$rut_estudiante' ";
        

        if ($rut_integrante!=""){
           $sWhere.= " AND tbl_ingresoFam.rut_integrante = '$rut_integrante' ";
        }    

        $sWhere.=" ORDER BY TOTAL desc ";
        
    
        $sql = " $sSelect $sFrom $sWhere ";

   
   //   print_r($sql);
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
    
    function registrarIngreso($rut_estudiante,$rut_integrante,$nombre_integrante,$apellido_integrante,$sueldo_integrante,$pension_integrante,$honorario_integrante,$retiro_integrante,$dividendo_integrante,$interes_integrante,$ganancia_integrante,$pension_alim_integrante,$actividad_integrante,$con){

      $sql=" INSERT INTO tbl_ingresoFam (rut_estudiante,rut_integrante,nombre_integrante,apellido_integrante,sueldo_integrante,pension_integrante,honorario_integrante,retiro_integrante,dividendo_integrante,interes_integrante,ganancia_integrante,pension_alim_integrante,actividad_integrante)"
          ." VALUES ('$rut_estudiante','$rut_integrante','$nombre_integrante','$apellido_integrante','$sueldo_integrante','$pension_integrante','$honorario_integrante','$retiro_integrante','$dividendo_integrante','$interes_integrante','$ganancia_integrante','$pension_alim_integrante','$actividad_integrante')";
     
        $result=sqlsrv_query($con,$sql);
        return $result;
    }
    
    function editarIngreso($rut_estudiante,$rut_integrante,$sueldo_integrante,$pension_integrante,$honorario_integrante,$retiro_integrante,$dividendo_integrante,$interes_integrante,$ganancia_integrante,$pension_alim_integrante,$actividad_integrante,$con){

      $sql=" UPDATE tbl_ingresoFam SET "
              . " sueldo_integrante = '$sueldo_integrante',"
              . " pension_integrante = '$pension_integrante',"
              . " honorario_integrante = '$honorario_integrante',"
              . " retiro_integrante = '$retiro_integrante',"
              . " dividendo_integrante  = '$dividendo_integrante',"
              . " interes_integrante = '$interes_integrante',"
              . " ganancia_integrante = '$ganancia_integrante',"
              . " pension_alim_integrante = '$pension_alim_integrante',"
              . " actividad_integrante = '$actividad_integrante' "
              . " WHERE "
              . " rut_estudiante = '$rut_estudiante'"
              . " AND rut_integrante = '$rut_integrante'";
     
        $result=sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }

    
    function eliminarIngreso($rut_estudiante,$rut_integrante,$con){
        
        $sql=" DELETE FROM tbl_ingresoFam "
           . " WHERE rut_integrante='".$rut_integrante."' "
           . " AND rut_estudiante= '".$rut_estudiante."' ";
        $result=sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
    

    
 
}
