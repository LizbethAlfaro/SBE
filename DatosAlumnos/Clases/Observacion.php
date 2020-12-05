<?php

class Observacion{
  
         function recuperarTramo($con){
     
          $sSelect = " SELECT [id_tramo],[descripcion_tramo],[puntaje] ";
          $sTable  = " FROM [dbo].[tbl_tramo] ";
          $sWhere  = " Order By id_tramo ";

           $sql=" $sSelect $sTable $sWhere";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
   //     print_r($sql);
        return $result;
    }
    
        function editarPuntajeTramo($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_tramo " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_tramo='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
    
    
       function recuperarFactor($con){
     
          $sSelect = " SELECT [id_factor],[descripcion_factor],[puntaje] ";
          $sTable  = " FROM [dbo].[tbl_factor] ";
          $sWhere  = " Order By id_factor ";

           $sql=" $sSelect $sTable $sWhere";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
   //     print_r($sql);
        return $result;
    }
    
        function editarPuntajeFactor($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_factor " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_factor='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
    
     function recuperarOtro($con){
     
          $sSelect = " SELECT [id_otro_miembro],[descripcion_otro_miembro],[puntaje] ";
          $sTable  = " FROM [dbo].[tbl_otro_miembro] ";
          $sWhere  = " Order By id_otro_miembro ";

           $sql=" $sSelect $sTable $sWhere";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
   //     print_r($sql);
        return $result;
    }
    
          function editarPuntajeOtro($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_otro_miembro " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_otro_miembro='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
    
    
   
    
    function recuperarDistancia($con){
     
          $sSelect = " SELECT [id_distancia],[descripcion_distancia],[puntaje] ";
          $sTable  = " FROM [dbo].[tbl_distancia] ";
          $sWhere  = " Order By id_distancia ";

           $sql=" $sSelect $sTable $sWhere";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
   //     print_r($sql);
        return $result;
    }
    
    
               function editarPuntajeDistancia($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_distancia " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_distancia='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
    
      function recuperarDuplicidad($con){
     
          $sSelect = " SELECT [id_duplicidad],[descripcion_duplicidad],[puntaje] ";
          $sTable  = " FROM [dbo].[tbl_duplicidad] ";
          $sWhere  = " Order By id_duplicidad ";

           $sql=" $sSelect $sTable $sWhere";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
   //     print_r($sql);
        return $result;
    }
    
           function editarPuntajeDuplicidad($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_duplicidad " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_duplicidad='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
    
    
    
     function registrarObservacion($rut_estudiante,$rut_asistente,$observacion,$duplicidad,$otro_miembro,$factor,$tramo,$distancia,$con){
     
         
          $fecha_agregado=date("Y-m-d H:i:s");
         
         
          $sInsert = " INSERT INTO [dbo].[tbl_observacion]
           ([rut_estudiante]
           ,[rut_asistente]
           ,[observacion]
           ,[duplicidad]
           ,[otro_miembro]
           ,[factor]
           ,[tramo]
           ,[distancia]
           ,[fecha_agregado])";
          $sValues  = " VALUES
           ('$rut_estudiante'
           ,'$rut_asistente'
           ,'$observacion'
           ,'$duplicidad'
           ,'$otro_miembro'
           ,'$factor'
           ,'$tramo'
           ,'$distancia'    
           ,'$fecha_agregado') ";
      

           $sql=" $sInsert $sValues ";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
     //   print_r($sql);
        return $result;
    }
    
    function recuperarObservacion($rut_estudiante,$condicion,$con){
             
          $sSelect = " Select id_observacion,o.rut_estudiante,o.rut_asistente,observacion,duplicidad,otro_miembro,factor,tramo,Cast(o.fecha_agregado as varchar) as fecha_agregado,id_duplicidad,descripcion_duplicidad,d.puntaje as 'duplicidad puntaje',id_otro_miembro,descripcion_otro_miembro,ot.puntaje as 'otro puntaje',id_factor,descripcion_factor,f.puntaje as 'factor puntaje',id_tramo,descripcion_tramo,t.puntaje as 'tramo puntaje',distancia,id_distancia,descripcion_distancia,dist.puntaje as 'distancia puntaje',estud.nombre_estudiante,estud.apellido_estudiante,asist.nombre_asistente,asist.apellido_asistente  ";
          $sTable  = " FROM tbl_observacion o,tbl_duplicidad d,tbl_otro_miembro ot,tbl_factor f,tbl_tramo t,tbl_distancia dist,tbl_asistente asist,tbl_estudiante estud ";
          $sWhere  = " WHERE o.duplicidad=d.id_duplicidad
                        AND o.otro_miembro=ot.id_otro_miembro
                        AND o.factor = f.id_factor
                        AND o.tramo = t.id_tramo 
                        AND o.distancia = dist.id_distancia 
                        AND o.rut_estudiante= estud.rut_estudiante 
                        AND o.rut_asistente = asist.rut_asistente ";
          
          if($condicion!=""){
             $sWhere.= $condicion; 
          }
          
          if($rut_estudiante!=""){
             $sWhere.= " AND o.rut_estudiante='$rut_estudiante' "; 
          }

           $sWhere.= " order by id_observacion asc "; 
          
           $sql=" $sSelect $sTable $sWhere";
     
        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
    //    print_r($sql);
        return $result;
    }
    
     function eliminarObservacion($id,$con){
             
         $sql=" DELETE FROM tbl_observacion "
             ." WHERE id_observacion='".$id."' ";


        $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        
    //    print_r($sql);
        return $result;
    }
    
}
