<?php

Class InformeBecaInterna{

    // metodos
    function recuperarInformeBecaInterna($rut,$con) {

        // sql server devuelve las fechas como date time 10-10-2018 AM 12:00:00 provocando error,se debe Convertir
        $sSelect= " SELECT rut_estudiante,ruta,tipo,CAST(fecha as varchar) as fecha " ;
        $sTable = " FROM tbl_informe_beca_interna ";
        $sWhere = " WHERE rut_estudiante = '$rut' ";


        
        $sWhere.=" ORDER BY rut_estudiante DESC ";
        


        $sql = " $sSelect $sTable $sWhere ";

        
        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   
 //       print_r($sql);
        return $result;
    }

      function registrarCalificacionBecaInterna($rut_calificacion_beca,$nombre_calificacion_beca,$tipo_calificacion_beca,$post_calificacion_beca,$na,$aa,$sf,$e4,$ar,$cvd,$sd,$cf,$ct,$cp,$cert_e_t,$ne,$he,$bm,$cae,$psu,$acredita,$calificacion,$con){
      
      date_default_timezone_set("Chile/Continental");    
      $fecha_calificacion=date("Y-m-d H:i:s");

      $sql = "INSERT INTO [dbo].[tbl_calificacion_beca]
           ([rut_calificacion_beca]
           ,[nombre_calificacion_beca]
           ,[tipo_calificacion_beca]
           ,[post_calificacion_beca]
           ,[na]
           ,[aa]
           ,[sf]
           ,[e4]
           ,[ar]
           ,[cvd]
           ,[sd]
           ,[cf]
           ,[ct]
           ,[cp]
           ,[cert_e_t]
           ,[ne]
           ,[he]
           ,[bm]
           ,[cae]
           ,[psu]
           ,[acredita]
           ,[calificacion]
           ,[fecha_calificacion])
           


           VALUES
           ('$rut_calificacion_beca'
           ,'$nombre_calificacion_beca'    
           ,'$tipo_calificacion_beca'
           ,'$post_calificacion_beca'
           ,'$na'
           ,'$aa'
           ,'$sf'
           ,'$e4' 
           ,'$ar' 
           ,'$cvd'
           ,'$sd' 
           ,'$cf' 
           ,'$ct' 
           ,'$cp' 
           ,'$cert_e_t'
           ,'$ne' 
           ,'$he' 
           ,'$bm' 
           ,'$cae' 
           ,'$psu' 
           ,'$acredita' 
           ,'$calificacion'     
           ,'$fecha_calificacion')"; 
          

        
        $result=sqlsrv_query($con,$sql);
   //     print_r($sql);
        return $result;
    }
    
     function registrarInformeBecaInterna($rut,$ruta,$tipo,$con){
      
      date_default_timezone_set("Chile/Continental");    
      $fechaAgregado=date("Y-m-d H:i:s");

      $sql = "INSERT INTO tbl_informe_beca_interna " 
           . " (rut_estudiante, ruta, tipo, fecha) "
           . " VALUES('".$rut."','".$ruta."','".$tipo."','" . $fechaAgregado . "');";
        
        $result=sqlsrv_query($con,$sql);
    //    print_r($sql);
        return $result;
    }
    
    
    function recuperarHistorialBecaInterna($rut,$condicion,$con) {

        // sql server devuelve las fechas como date time 10-10-2018 AM 12:00:00 provocando error,se debe Convertir
        $sSelect= 
      " SELECT [id_calificacion_beca]
      ,[rut_calificacion_beca]
      ,[nombre_calificacion_beca]
      ,[tipo_calificacion_beca]
      ,[post_calificacion_beca]
      ,[na]
      ,[aa]
      ,[sf]
      ,[e4]
      ,[ar]
      ,[cvd]
      ,[sd]
      ,[cf]
      ,[ct]
      ,[cp]
      ,[cert_e_t]
      ,[ne]
      ,[he]
      ,[bm]
      ,[cae]
      ,[psu]
      ,[acredita]
      ,[calificacion]
      ,Cast(fecha_calificacion as varchar)as fecha_calificacion" ;
        
      $sTable = " FROM [dbo].[tbl_calificacion_beca] ";
      $sWhere=" WHERE id_calificacion_beca>=0 ";
      
        if ($rut!=""){ 
           $sWhere .= " AND rut_calificacion_beca = '$rut' ";
        }
        
        if ($condicion!=""){
           $sWhere .= $condicion;
        }
        
        $sWhere.=" ORDER BY id_calificacion_beca DESC ";


        $sql = " $sSelect $sTable $sWhere ";

        
        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   
    //    print_r($sql);
        return $result;
    }
 
}


