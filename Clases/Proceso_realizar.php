<?php


Class ProcesoRealizar{
    
 // metodos
    function recuperarProcesoRealizar($con) {

        $sSelect = " SELECT id_proceso,nombre_proceso, descripcion_proceso ";
        $sTable  = " FROM  tbl_proceso_realizar ";
        $sWhere  = "";
   
       
        $sWhere.=" order by id_proceso ";
        

        $sql = " $sSelect $sTable $sWhere ";

        $result = sqlsrv_query($con, $sql,array(), array("Scrollable"=>"static"));  

   //     print_r($sql);
        return $result;
    }
    
   
} 