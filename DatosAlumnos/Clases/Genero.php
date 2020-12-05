<?php


Class Genero{
    
 // metodos
    function recuperarGenero($con) {

        $sSelect = " SELECT id_genero,nombre_genero,puntaje";
        $sTable  = " FROM  tbl_genero ";
        $sWhere  = "";
   
       
        $sWhere.=" order by nombre_genero ";
        

        $sql = " $sSelect $sTable $sWhere ";

        $result = sqlsrv_query($con, $sql,array(), array("Scrollable"=>"static"));  

   //     print_r($sql);
        return $result;
    }
    
    
       function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_genero " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_genero='".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }

 
} 