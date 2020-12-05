<?php


Class Declaracion{
  
     // metodos
    function recuperarDeclaracion($rut_estudiante,$con) {

        $sSelect = " SELECT rut_estudiante,declaracion ";        
        $sTable  = " FROM   tbl_declaracion ";
        $sWhere  = " WHERE  rut_estudiante = '$rut_estudiante' ";
                
                
        $sql = " $sSelect $sTable $sWhere ";

      //  print_r($sql);
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   
        return $result;
    }

      function registrarDeclaracion($rut_estudiante,$declaracion,$con){

      $sql=" INSERT INTO tbl_declaracion "
          ." (rut_estudiante,declaracion) "
          ." VALUES ('$rut_estudiante','$declaracion') ";

        $result=sqlsrv_query($con,$sql);
     //   print_r($sql);
        return $result;
    }
    
    
     function editarDeclaracion($rut_estudiante,$declaracion,$con){
         
        $sql=" UPDATE tbl_declaracion "
            ." SET "
                . " declaracion             ='".$declaracion."'"
                . " WHERE rut_estudiante    ='".$rut_estudiante."' ";
            
     //   print_r($sql);
        $result=sqlsrv_query($con,$sql);
        return $result;
    }

    
}