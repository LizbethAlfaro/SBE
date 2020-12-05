<?php

Class Proceso{

    // metodos
    function recuperarProceso($id,$con) {

        // sql server devuelve las fechas como date time 10-10-2018 AM 12:00:00 provocando error,se debe Convertir
        $sSelect= " SELECT id_tipo_proceso,nombre_tipo_proceso,cast(inicio as varchar)as inicio ,cast(termino as varchar) as termino " ;
        $sTable = " FROM tbl_proceso ";
        $sWhere = "";
        
        if ($id!=""){ 
           $sWhere .= " WHERE id_tipo_proceso = '$id' " ;
        }
        
        $sWhere.=" ORDER BY id_tipo_proceso DESC ";
        
        $sql = " $sSelect $sTable $sWhere ";

        // se debe agregar el tipo de cursor, sqlsrv funciona internamente con cursores
        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
   
    //    print_r($sql);
        
        return $result;
    }



   
     function editarProceso($id,$inicio,$termino,$con){
         
        $sql = "UPDATE tbl_proceso SET inicio='$inicio',termino='$termino' WHERE id_tipo_proceso='".$id."'";
        $result=sqlsrv_query($con,$sql);
   //     print_r($sql);
        return $result;
    }
        
  
     function aperturaCierre($id,$estado,$con){
        
         switch ($id) {
            case 1:
                switch ($estado){
                case 1:$AC=0;
                    break;
                case 2:$AC=4;
                    break;
                }
                $sql = "UPDATE tbl_solicitud SET estado='$AC'";
                 break;
            case 2:
                switch ($estado){
                case 1:$AC=1;
                    break;
                case 2:$AC=2;
                    break;
                }
               // $sql =  "UPDATE tbl_estudiante_beca SET estado='$AC'";
                $sql =  " TRUNCATE table tbl_estudiante_beca ";
                 break;
             default:
                 break;
         }


        $result=sqlsrv_query($con,$sql);
   //     print_r($sql);
        return $result;
    }
    
}


//13.750.375-1