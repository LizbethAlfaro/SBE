<?php
class GrupoFamiliar {

         function recuperarGrupo($con){
     
          $sSelect = " SELECT id_grupo,descripcion_grupo,puntaje";
          $sTable  = " FROM tbl_grupo_familiar";
          $sWhere  = "";
            
             $sql=" $sSelect $sTable $sWhere ";
     
        $result=sqlsrv_query($con,$sql,array(), array( "Scrollable" => 'static' ));
        return $result;
    }
    
    
       function editarPuntaje($id,$puntaje,$con){
 
              $sql = "UPDATE tbl_grupo_familiar " 
                 . " SET puntaje       ='".$puntaje."'"
    
                 . " WHERE id_grupo = '".$id."';";

        $result= sqlsrv_query($con,$sql);
  //      print_r($sql);
        return $result;
    }
}
