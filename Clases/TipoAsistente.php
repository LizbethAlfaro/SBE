<?php


Class TipoAsistente{

 // metodos
    function recuperarTipoAsistente($con) {

        $sTable = " tbl_tipoAsistente ";
        $sWhere = "";

        $sql = " SELECT * FROM  $sTable $sWhere ";

        $result = sqlsrv_query($con, $sql);

        return $result;
    }

    
} 