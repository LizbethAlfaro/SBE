<?php

Class TNE{

    // metodos
    function recuperarTNE($rut,$con) {

        $sql = " Select * " 
           . "  From tbl_TNE "
           . "  Where rut_estudiante ='$rut' ";  



        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   
     //   print_r($sql);
        
        return $result;
    }

      function registrarTNE($rut,$proceso,$fono,$con){
      
      $fecha_agregado=date("Y-m-d H:i:s");
      
      $sql = "INSERT INTO tbl_TNE " 
           . " (rut_estudiante, proceso,fono,fecha) "
           . " VALUES('".$rut."','".$proceso."','".$fono."','".$fecha_agregado."')";    
   
   //     print_r($sql);
        $result=sqlsrv_query($con,$sql);
        return $result;
    }
    
  
}


//13.750.375-1