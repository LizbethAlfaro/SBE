<?php


Class Jornada{

 // metodos
    function recuperarJornada($con) {

        $sTable = " tbl_jornada ";
        $sWhere = "";
   

        $sWhere.=" order by nombre_jornada";
        
        $sql = " SELECT * FROM  $sTable $sWhere ";

        $result = sqlsrv_query($con, $sql);

        return $result;
    }

    
    
} 