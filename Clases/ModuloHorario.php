<?php


Class ModuloHorario{
  
 // metodos
    function recuperarModulo($con) {

        $sTable = " tbl_modulo ";
        $sWhere = "";
   
      
        $sWhere.=" order by id_modulo " ;
 
        $sql = " SELECT * FROM  $sTable $sWhere ";

        $result = sqlsrv_query($con, $sql);

        return $result;
    }

  
} 