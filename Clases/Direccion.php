<?php


Class Direccion{
  
     // metodos
    function recuperarDireccion($rut_estudiante,$tipo,$con) {

        $sSelect = " SELECT rut_estudiante,tipo,direccion,numero,departamento,numero,villa,tbl_comuna.nombre_comuna,tbl_direccion.comuna,tbl_region.nombre_region,tbl_direccion.region";
            
        $sTable  = " FROM   tbl_direccion,tbl_comuna,tbl_region ";
        $sWhere  = " WHERE  tbl_direccion.comuna = id_comuna "
                 . " AND    tbl_direccion.region = id_region "
                 . " AND    rut_estudiante = '$rut_estudiante' "
                 . " AND    tipo='$tipo'";
                

        $sql = " $sSelect $sTable $sWhere ";

  //      print_r($sql);
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   
        return $result;
    }

      function registrarDireccion($rut_estudiante,$tipo,$direccion,$numero,$departamento,$villa,$comuna,$region,$con){

      $sql=" INSERT INTO tbl_direccion "
          ." (rut_estudiante,tipo,direccion,numero,departamento,villa,comuna,region) "
          ." VALUES ('$rut_estudiante','$tipo','$direccion','$numero','$departamento','$villa','$comuna','$region') ";

        $result=sqlsrv_query($con,$sql);
   //     print_r($sql);
        return $result;
    }
    
    
     function editarDireccion($rut_estudiante,$tipo,$direccion,$numero,$departamento,$villa,$comuna,$region,$con){
         
        $sql=" UPDATE tbl_direccion "
            ." SET "
                . " direccion            ='".$direccion."',"
                . " numero               ='".$numero."',"
                . " departamento         ='".$departamento."',"
                . " villa                ='".$villa."',"
                . " comuna               ='".$comuna."',"
                . " region               ='".$region."'"   
                . " WHERE rut_estudiante ='".$rut_estudiante."' "
                . " AND tipo = $tipo ";
            
  //      print_r($sql);
        $result=sqlsrv_query($con,$sql);
        return $result;
    }

    
}