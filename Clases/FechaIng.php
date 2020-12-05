<?php


Class FechaIng{
 // metodos
    function recuperarFechaIng($con) {

        $sSelect = " SELECT anhio_fechaIng";
        $sTable  = " FROM  tbl_fechaIng ";
        $sWhere  = "";
 
       
        $sWhere.=" order by anhio_fechaIng desc";
        

        $sql = " $sSelect $sTable $sWhere ";

        $result = sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }

 
} 