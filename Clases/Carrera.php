<?php


Class Carrera{
 
 // metodos
    function recuperarCarrera($id_carrera,$con,$condicion,$offset,$per_page) {

        $sTable = " tbl_carrera ";
        $sWhere = "";
   
        if ($condicion!=""){
           $sWhere .= $condicion;
        }
       
        if ($id_carrera!=""){ 
           $sWhere .= " WHERE id_departamento='".$id_carrera."' " ;
        }
        $sWhere.=" order by nombre_carrera";
        
         if (($offset!="")&&($per_page!="")){
           $sWhere .= " LIMIT $offset,$per_page ";
        }

        $sql = " SELECT * FROM  $sTable $sWhere ";

        $result = sqlsrv_query($con, $sql);

        return $result;
    }

      function registrarCarrera($nombre,$descripcion,$con){
          
      $fecha_agregado=date("Y-m-d H:i:s");
     
      $sql=" INSERT INTO departamento "
          ." (nombre_departamento, descripcion_departamento,fecha_agregado) "
          ." VALUES ('$nombre','$descripcion','$fecha_agregado') "; 
     
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
    /*
     function editarCarrera($id_departamento,$nombre,$descripcion,$con){
         
        $sql=" UPDATE departamento "
            ." SET nombre_departamento='".$nombre."', descripcion_departamento='".$descripcion."' "
            ." WHERE id_departamento='".$id_departamento."' ";
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
    function eliminarCarrera($id_departamento,$con){
        
        $sql="DELETE FROM departamento WHERE id_departamento='".$id_departamento."'";
        $result=mysqli_query($con,$sql);
        return $result;
    }
    
    
    */
    
} 