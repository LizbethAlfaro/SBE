<?php

class UMAS
{

    function TNEPRUEBA($con)
    {

        $sSelect = " SELECT c.CIUDADACT, a.CODSEDE, a.JORNADA, c.CODCLI, c.DIG, c.NOMBRE, c.PATERNO, c.MATERNO,  CONVERT(VARCHAR, c.FECNAC, 20) AS FECHA , car.NOMBRE_L, c.MAIL ";


        $sFrom =   " FROM [CIISA].[UmasnetPruebas].[dbo].mt_client c, [CIISA].[UmasnetPruebas].[dbo].MT_ALUMNO a,[CIISA].[UmasnetPruebas].[dbo].MT_CARRER car";

        $sWhere = " WHERE a.RUT=c.CODCLI
        and a.CODCARPR=car.CODCARR 
        and A.ANO_MAT=2019 ";
           

        $sql = " $sSelect $sFrom $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

    // print_r($sql);
        return $result;
    }

    function recuperarEstudiante($rut, $con)
    {

        $sSelect = " SELECT   [RUT],[DIG],MT_C.[CODCLI],CA_U.[us_consuser],CA_U.[us_password]
                               ,[NOMBRE],[MATERNO],[PATERNO],[NOMBRE_C],MT_A.[JORNADA],MT_A.[ANO],[ESTACAD],[SEXO],[FECNAC],[DIRACTUAL],MT_C.NACIONALIDAD ";
        $sTable  = " FROM [CIISA].[UmasnetPruebas].[dbo].[MT_ALUMNO] MT_A,[CIISA].[UmasnetPruebas].[dbo].[MT_CLIENT] MT_C,[CIISA].[UmasnetPruebas].[dbo].[ca_usuarios] CA_U ,[CIISA].[UmasnetPruebas].[dbo].[MT_CARRER] MT_CAR ";

        $sWhere = "  WHERE MT_A.[RUT] = MT_C.[CODCLI] AND ([ESTACAD] = 'VIGENTE' OR [ESTACAD] = 'ELIMINADO' OR [ESTACAD] = 'SUSPENDIDO') AND CA_U.[us_consuser] = ([RUT]+[DIG]) AND MT_CAR.[CODCARR] = MT_A.[CODCARPR]"
            //    $sWhere = "  WHERE MT_A.[RUT] = MT_C.[CODCLI] AND ([ESTACAD] = 'VIGENTE' OR [ESTACAD] = 'SUSPENDIDO') AND CA_U.[us_consuser] = ([RUT]+[DIG]) AND MT_CAR.[CODCARR] = MT_A.[CODCARPR]"
            . "  AND CA_U.[us_consuser] = '$rut'";

        $sql = " $sSelect $sTable $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

             print_r($sql);
        return $result;
    }


    function recuperarEstudiantePregrado($rut, $con)
    {

        $sSelect = " SELECT   [RUT],[DIG],MT_C.[CODCLI],CA_U.[us_consuser],CA_U.[us_password]
                               ,[NOMBRE],[MATERNO],[PATERNO],[NOMBRE_C],MT_A.[JORNADA],MT_A.[ANO],[ESTACAD],[SEXO],[FECNAC],[DIRACTUAL] ";
        $sTable  = " FROM [CIISA].[UmasnetPruebas].[dbo].[MT_ALUMNO] MT_A,[CIISA].[UmasnetPruebas].[dbo].[MT_CLIENT] MT_C,[CIISA].[UmasnetPruebas].[dbo].[ca_usuarios] CA_U ,[CIISA].[UmasnetPruebas].[dbo].[MT_CARRER] MT_CAR ";

        $sWhere = "  WHERE MT_A.[RUT] = MT_C.[CODCLI] AND ([ESTACAD] = 'VIGENTE' OR [ESTACAD] = 'SUSPENDIDO') AND CA_U.[us_consuser] = ([RUT]+[DIG]) AND MT_CAR.[CODCARR] = MT_A.[CODCARPR]"
            . "  AND CA_U.[us_consuser] = '$rut' "
            . "  AND MT_CAR.TIPOCARR = 3 "; //PREGRADO

        $sql = " $sSelect $sTable $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        //   print_r($sql);
        return $result;
    }



    function recuperarEstudianteBecaInterna($rut, $beca, $renoPost, $con)
    {
        //Renopost
        //1 POSTULANTE
        //2 RENOVANTE

        //MT_CARRER.TIPOCARR
        //1 POSTGRADO
        //3 PREGRADO

        $corteActual = "2020";
        //          $corteAnterior = "2019";
        $corteAnterior = "2020";

        $sSelect = " SELECT DESCRIPCION AS TIPO_CARRERA, RUT, ESTACAD, ANO AS PROMOCION     ";
        $sTable  = " FROM [CIISA].[UmasnetPruebas].[dbo].MT_ALUMNO, [CIISA].[UmasnetPruebas].[dbo].MT_TIPOCARR , [CIISA].[UmasnetPruebas].[dbo].MT_CARRER ";

        $sWhere = " WHERE MT_ALUMNO.ESTACAD IN ('VIGENTE','SUSPENDIDO')   
                        AND MT_CARRER.TIPOCARR = MT_TIPOCARR.TIPOCARR 
                        AND MT_ALUMNO.CODCARPR = MT_CARRER.CODCARR 
                        AND MT_ALUMNO.RUT ='$rut' ";

        if ($renoPost == 1) {
            switch ($beca) {
                case 1:
                    /*BECA UGM*/
                    $sWhere .= " AND ANO = '$corteActual' AND MT_CARRER.TIPOCARR = 3 ";
                    break;
                case 2:
                    /*BECA DEPORTIVA*/
                    $sWhere .= " AND ANO <= '$corteActual' AND MT_CARRER.TIPOCARR = 3 ";
                    break;
                case 3:
                    /*BECA ALUMNI HIJOS*/
                    $sWhere .= " AND ANO = '$corteActual' AND (MT_CARRER.TIPOCARR = 3 OR MT_CARRER.TIPOCARR = 1) ";
                    break;
                case 4:
                    /*BECA FUNCIONARIO E HIJOS */
                    $sWhere .= " AND ANO <= '$corteActual' ";
                    break;
                case 5:
                    /*BECA BECA FAMILIAR*/
                    $sWhere .= " AND ANO = '$corteActual' AND MT_CARRER.TIPOCARR = 3 ";
                    break;
                case 6:
                    /*BECA EXTRANJERO*/
                    $sWhere .= " AND ANO = '$corteActual' AND MT_CARRER.TIPOCARR = 3 ";
                    break;
                case 7:
                    /*BECA COPAGO 0*/
                    $sWhere .= " AND ANO = '$corteActual' AND MT_CARRER.TIPOCARR = 3 ";
                    break;
                default:
                    $sWhere .= " AND ANO = '$corteActual' ";
                    break;
            }
        } else if ($renoPost == 2) {
            $sSelect = " SELECT top 1 MT_POSBEN.ANO ";
            $sTable = " FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSBEN,[CIISA].[UmasnetPruebas].[dbo].MT_ALUMNO,[CIISA].[UmasnetPruebas].[dbo].MT_CARRER  ";
            $sWhere = " WHERE MT_ALUMNO.RUT=MT_POSBEN.CODCLI
                        AND MT_CARRER.CODCARR = MT_POSBEN.CODCARR
                        AND MT_ALUMNO.CODCARPR=MT_POSBEN.CODCARR
                        AND MT_CARRER.CODCARR = MT_POSBEN.CODCARR
                        AND MT_POSBEN.ANO <= '$corteAnterior' 
                        AND MT_ALUMNO.ESTACAD='VIGENTE' AND MT_ALUMNO.RUT ='$rut' "
                . " ORDER by MT_POSBEN.ANO desc ";
        }


        $sql = " $sSelect $sTable $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        //   print_r($sql);
        return $result;
    }

    function renovantePostulante($rut, $beca, $con)
    {


        //         print_r($beca);

        $sSelect = "";

        switch ($beca) {
            case 1:
                /*BECA UGM*/
                $sSelect = "SELECT ANO FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSBEN WHERE  CODCLI ='$rut'
                              AND CODBEN ='40' AND ESTADO ='4'";
                break;
            case 2:
                /*BECA DEPORTIVA*/
                $sSelect = "SELECT ANO FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSBEN WHERE  CODCLI ='$rut'
                              AND CODBEN ='42' AND ESTADO ='4'";
                break;
            case 3:
                /*BECA ALUMNI HIJOS 55/  HIJOS DE ALUMNI EXALUMNO 46 / DESCUENTO EXALUMNO*/
                $sSelect = "SELECT ANO FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSBEN WHERE  CODCLI ='$rut'
                              AND (CODBEN ='55' OR CODBEN ='46' OR CODBEN ='39') AND ESTADO ='4'";
                break;
            case 4:
                /*BECA FUNCIONARIO*/
                $sSelect = "SELECT ANO FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSBEN WHERE  CODCLI ='$rut'
                              AND CODBEN ='51' AND ESTADO ='4'";
                break;
            case 5:
                /*BECA BECA FAMILIAR*/
                $sSelect = "SELECT ANO FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSBEN WHERE  CODCLI ='$rut'
                              AND CODBEN ='45' AND ESTADO ='4'";
                break;
            case 6:
                /*BECA EXTRANJERO*/
                $sSelect = "SELECT ANO FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSBEN WHERE  CODCLI ='$rut'
                              AND CODBEN ='44' AND ESTADO ='4'";
                break;
            case 7:
                /*BECA COPAGO 0*/
                $sSelect = "SELECT ANO FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSBEN WHERE  CODCLI ='$rut'
                              AND CODBEN ='70' AND ESTADO ='4'";
                break;
            case '8':
                /*BECA MERITO NEM*/
                $sSelect = "SELECT ANO FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSBEN WHERE  CODCLI ='$rut'
                              AND CODBEN ='41' AND ESTADO ='4'";
                break;
            case 9:
                /*BECA SOCIOECONOMICA (EXCLUYENTE)*/
                $sSelect = "SELECT ANO FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSBEN WHERE  CODCLI ='$rut'
                              AND CODBEN ='47' AND ESTADO ='4'";
                break;
            case 10:
                /*HIJOS DE ALUMNI EXALUMNO*/
                $sSelect = "SELECT ANO FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSBEN WHERE  CODCLI ='$rut'
                              AND (CODBEN ='55' OR CODBEN ='46' OR CODBEN ='39') AND ESTADO ='4'";
                break;
            case 11:
                /*BECA ALUMNI UGM Y UCINF EXALUMNO)*/
                $sSelect = "SELECT ANO FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSBEN WHERE  CODCLI ='$rut'
                              AND (CODBEN ='55' OR CODBEN ='46' OR CODBEN ='39') AND ESTADO ='4'";
                break;
        }

        $sql = " $sSelect ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        //     print_r($sql);
        return $result;
    }


    function matriculadoPostulado($rut, $con)
    {

        $sSelect = "SELECT TOP 1 * FROM [CIISA].[UmasnetPruebas].[dbo].MT_ALUMNO WHERE RUT  ='$rut' "
            . " AND PERIODO ='1' "
            . " AND MATRICULADO ='S'"
            . " order by FECMOD desc ";

        $result_matri = sqlsrv_query($con, $sSelect, array(), array("Scrollable" => 'static'));

        $estado = "";

        if ($result_matri) {
            $contador_matri = sqlsrv_num_rows($result_matri);
            if ($contador_matri > 0) {
                $estado = "2";
            } else {
                $sSelect = "SELECT * FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSCAR WHERE CODPOSTUL  ='$rut' "
                    . " AND PERIODO ='1' AND ESTADO IN('A', 'M') "; //MATRICULADO POSTULADO
                $result_post = sqlsrv_query($con, $sSelect, array(), array("Scrollable" => 'static'));
                $contador_post = sqlsrv_num_rows($result_post);
                if ($contador_post > 0) {
                    $estado = "1";
                } else {
                    $estado = "0";
                }
            }
        }

        //  $sql=" $sSelect ";

        //  $result=sqlsrv_query($con, $sql,array(), array( "Scrollable" => 'static' ));

        //       print_r($sSelect);
        // return $result;
        return $estado;
    }


    function verificarBecas($rut, $con)
    {

        $sSelect = " SELECT top 1 CODBEN,ANO ";
        $sFrom = " FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSBEN ";
        $sWhere = " WHERE  (CODBEN ='40' or CODBEN ='41' or CODBEN ='42' or CODBEN ='46' or CODBEN ='47' or CODBEN ='55' or CODBEN ='51' or CODBEN ='45' or CODBEN ='44' or CODBEN ='70' OR CODBEN ='39') 
                    AND ESTADO ='4'
                    AND CODCLI ='$rut'
                    Order By ANO desc ";

        $sql = " $sSelect $sFrom $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        //    print_r($sql);
        return $result;
    }

    function SITUACION_FINANCIERA($rut, $con)
    {

        //Si tiene deuda es >0


        $sSelect = "SELECT CODCLI,'S' AS DEUDA FROM [CIISA].[UmasnetPruebas].[dbo].MT_CTADOC WITH(NOLOCK)

            WHERE CODCLI  ='$rut' AND SALDO > 0 AND FECVEN<= GETDATE()
            GROUP BY CODCLI
            HAVING COUNT(*) >=2";

        $sql = " $sSelect ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        //      print_r($sql);
        return $result;
    }




    //VALIDACIONES
    function NOTAS_ANUALES($rut, $con)
    {

        $sSelect = " SELECT  RA_NOTA.CODCLI,SUM(RA_NOTA.NF)/COUNT(*) AS PROMEDIO_AP ";
        $sFrom = " FROM [CIISA].[UmasnetPruebas].[dbo].RA_NOTA WITH(NOLOCK), [CIISA].[UmasnetPruebas].[dbo].MT_ALUMNO WITH(NOLOCK) ";
        $sWhere = " WHERE RA_NOTA.CODCLI = MT_ALUMNO.CODCLI  
            AND RA_NOTA.ANO IN (SELECT TOP 1 (VALOR-1) FROM [CIISA].[UmasnetPruebas].[dbo].MT_PARAME_DET WHERE IDPARAMETRO ='ANOADMISION' ORDER BY NUMLINEA  DESC)
            AND RA_NOTA.ESTADO NOT IN ('E','I') 
            AND MT_ALUMNO.RUT ='$rut' GROUP BY RA_NOTA.CODCLI  ";
        /*SE DEJAN FUERA CONVALIDADO / HOMOLOGADO*/

        $sql = " $sSelect $sFrom $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        //     print_r($sql);
        return $result;
    }


    function SITUACION($rut, $con)
    {

        $sSelect = " SELECT MT_CLIENT.CODCLI, MT_CLIENT.PATERNO, MT_CLIENT.MATERNO,MT_CLIENT.NOMBRE,MT_ALUMNO.ESTACAD AS ESTADO_ACADEMICO_ALUMNO,RA_TIPOSITU.DESCRIPCION AS SITUACION_ACADEMICA,MT_ALUMNO.ANO AS PROMOCION_ALUMNO, MT_ALUMNO.ANO_MAT AS ULTIMA_MATRICULA,
                     MT_POSBEN.ANO,MT_POSBEN.PERIODO,MT_POSBEN.CODCARR,MT_CARRER.NOMBRE_C,MT_POSBEN.CODBEN,MT_BENEFICIO.DESCRIPCION AS NOMBRE_BENEFICIO,MT_POSBEN.APROBADO, CONVERT(INT,MT_POSBEN.MONTO) AS MONTO_BENEFICIO,MT_POSBEN.ESTADO, MT_ESTBEN.DESCRIPCION AS ESTADO_BENEFICIO,
                     CONVERT(INT,MT_POSBEN.PORC_APR) AS PORCENTAJE_APROBADO ";

        $sFrom = " FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSBEN WITH(NOLOCK), [CIISA].[UmasnetPruebas].[dbo].MT_BENEFICIO WITH(NOLOCK), [CIISA].[UmasnetPruebas].[dbo].MT_CLIENT WITH(NOLOCK), [CIISA].[UmasnetPruebas].[dbo].MT_CARRER WITH(NOLOCK), [CIISA].[UmasnetPruebas].[dbo].MT_ESTBEN WITH(NOLOCK), [CIISA].[UmasnetPruebas].[dbo].MT_ALUMNO WITH(NOLOCK), [CIISA].[UmasnetPruebas].[dbo].RA_TIPOSITU WITH(NOLOCK) ";
        $sWHERE = " MT_BENEFICIO.CODBEN = MT_POSBEN.CODBEN AND MT_POSBEN.CODCLI = MT_CLIENT.CODCLI AND MT_POSBEN.ANO IN 
            (SELECT TOP 1 (VALOR-1) FROM [CIISA].[UmasnetPruebas].[dbo].MT_PARAME_DET WHERE IDPARAMETRO ='ANOADMISION' ORDER BY NUMLINEA  DESC) 
            AND MT_CARRER.CODCARR = MT_POSBEN.CODCARR 
            AND MT_ESTBEN.ESTADO = MT_POSBEN.ESTADO 
            AND MT_ALUMNO.RUT = MT_CLIENT.CODCLI 
            AND MT_ALUMNO.RUT = MT_POSBEN.CODCLI 
            AND MT_ALUMNO.CODCARPR = MT_POSBEN.CODCARR 
            AND MT_ALUMNO.RUT ='$rut' 
            AND RA_TIPOSITU.CODIGO = MT_ALUMNO.TIPOSITU
            ORDER BY MT_POSBEN.CODBEN,MT_CARRER.CODCARR,  MT_CLIENT.PATERNO";

        $sql = " $sSelect $sFrom $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        //    print_r($sql);
        return $result;
    }






    function ASIGNATURAS_INSCRITAS($rut, $con)
    {

        $sSelect = " SELECT  RA_NOTA.CODCLI,COUNT(*) AS ASIGNATURAS_INSCRITAS ";
        $sFrom = " FROM [CIISA].[UmasnetPruebas].[dbo].RA_NOTA WITH(NOLOCK), [CIISA].[UmasnetPruebas].[dbo].MT_ALUMNO WITH(NOLOCK) ";
        $sWhere = " WHERE RA_NOTA.CODCLI = MT_ALUMNO.CODCLI  AND RA_NOTA.ANO IN (SELECT TOP 1 (VALOR-1) FROM [CIISA].[UmasnetPruebas].[dbo].MT_PARAME_DET WHERE IDPARAMETRO ='ANOADMISION' ORDER BY NUMLINEA  DESC)
                    AND RA_NOTA.ESTADO NOT IN ('E','I')
                    AND MT_ALUMNO.RUT ='$rut'
                    AND MT_ALUMNO.ESTACAD ='VIGENTE'
                    AND MT_ALUMNO.ANO_MAT IN ('2019','2020') 
                    GROUP BY RA_NOTA.CODCLI  ";

        /*(SELECT TOP 1 (VALOR-1) FROM [CIISA].[UmasnetPruebas].[dbo].MT_PARAME_DET WHERE IDPARAMETRO ='ANOADMISION' ORDER BY NUMLINEA  DESC)*/


        $sql = " $sSelect $sFrom $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        //     print_r($sql);
        return $result;
    }



    function ASIGNATURAS_APROBADAS($rut, $con)
    {

        $sSelect = " SELECT  RA_NOTA.CODCLI,COUNT(*) AS ASIGNATURAS_APROBADAS ";

        $sFrom = " FROM [CIISA].[UmasnetPruebas].[dbo].RA_NOTA WITH(NOLOCK), [CIISA].[UmasnetPruebas].[dbo].MT_ALUMNO WITH(NOLOCK) ";

        $sWhere = " WHERE RA_NOTA.CODCLI = MT_ALUMNO.CODCLI  AND RA_NOTA.ANO IN 
            (SELECT TOP 1 (VALOR-1) FROM [CIISA].[UmasnetPruebas].[dbo].MT_PARAME_DET WHERE IDPARAMETRO ='ANOADMISION' ORDER BY NUMLINEA  DESC)
            AND RA_NOTA.ESTADO NOT IN ('E','I')
            AND MT_ALUMNO.RUT ='$rut'
            AND MT_ALUMNO.ESTACAD ='VIGENTE'
            AND MT_ALUMNO.ANO_MAT IN ('2019','2020')
            AND RA_NOTA.NF >= 4
            GROUP BY RA_NOTA.CODCLI ";

        /*(SELECT TOP 1 (VALOR-1) FROM [CIISA].[UmasnetPruebas].[dbo].MT_PARAME_DET WHERE IDPARAMETRO ='ANOADMISION' ORDER BY NUMLINEA  DESC)   en alumno.ano_mat in*/
        $sql = " $sSelect $sFrom $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        //      print_r($sql);
        return $result;
    }


    function ESTADO_ACADEMICO($rut, $con)
    {

        $sSelect = " SELECT   [RUT],[DIG],MT_C.[CODCLI],[ESTACAD],[ESTFINAN] ";
        $sTable  = " FROM [CIISA].[UmasnetPruebas].[dbo].[MT_ALUMNO] MT_A,[CIISA].[UmasnetPruebas].[dbo].[MT_CLIENT] MT_C ";

        $sWhere = "  WHERE MT_A.[RUT] = MT_C.[CODCLI] AND ([ESTACAD] = 'VIGENTE' OR [ESTACAD] = 'SUSPENDIDO') "
            . "  AND MT_A.RUT = '$rut'";

        $sql = " $sSelect $sTable $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        //      print_r($sql);
        return $result;
    }


    function PROMEDIO_ANUAL($rut, $con)
    {

        $sSelect = " SELECT  RA_NOTA.CODCLI,SUM(RA_NOTA.NF)/COUNT(*) AS PROMEDIO_AP ";
        $sFrom = " FROM [CIISA].[UmasnetPruebas].[dbo].RA_NOTA WITH(NOLOCK), [CIISA].[UmasnetPruebas].[dbo].MT_ALUMNO WITH(NOLOCK) ";
        $sWhere = " WHERE RA_NOTA.CODCLI = MT_ALUMNO.CODCLI  AND RA_NOTA.ANO IN 
            (SELECT TOP 1 (VALOR-1) FROM  [CIISA].[UmasnetPruebas].[dbo].MT_PARAME_DET WHERE IDPARAMETRO ='ANOADMISION' ORDER BY NUMLINEA  DESC)
            AND RA_NOTA.ESTADO NOT IN ('E','I') AND MT_ALUMNO.RUT ='$rut' 
            GROUP BY RA_NOTA.CODCLI ";

        $sql = " $sSelect $sFrom $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        //    print_r($sql);
        return $result;
    }

    function PORCENTAJE_APROBACION($rut, $con)
    {

        $sSelect = " SELECT  [PORC_APR] ";
        $sFrom = " FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSBEN  ";
        $sWhere = " WHERE CODCLI ='$rut'";

        $sql = " $sSelect $sFrom $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        //    print_r($sql);
        return $result;
    }

    function NEM($rut, $con)
    {

        $sSelect = " SELECT  [NOTAEM] ";
        $sFrom = " FROM [CIISA].[UmasnetPruebas].[dbo].MT_CLIENT  ";
        $sWhere = " WHERE CODCLI ='$rut'";

        $sql = " $sSelect $sFrom $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        //    print_r($sql);
        return $result;
    }
    //SERVICIO    

    function acceso($rut, $con)
    {

        $db = '[UGM]';

        $server = '[CERTIFIKATE]';

        $sSelect = " SELECT 
                     TG_PERSONAS.PE_NOMBRES,
                     PE_APPATERNO,
                     PE_APMATERNO,
                     CA_USUARIOS.ID_USUARIO, 
                     $db.[dbo].DECRYPT(US_PASSWORD) AS CLAVE ";

        $sFrom =   " FROM $db.[dbo].TG_PERSONAS WITH(NOLOCK), $db.[dbo].CA_USUARIOS WITH(NOLOCK) ";

        $sWhere = " WHERE " //RUT DE ALUMNO+DIGITO
            . " CA_USUARIOS.ID_PERSONA = TG_PERSONAS.ID_PERSONA "
            . " AND TG_PERSONAS.PE_RUT IN "
            . " (SELECT MT_CLIENT.CODCLI+MT_CLIENT.DIG FROM $db.[dbo].MT_CLIENT WITH(NOLOCK), $db.[dbo].MT_ALUMNO WITH(NOLOCK) "
            . " WHERE MT_ALUMNO.RUT = MT_CLIENT.CODCLI) "
            . " AND TG_PERSONAS.PE_RUT=''$rut''";

        $sql = "$sSelect $sFrom $sWhere ";

        $CSelect = "SELECT * FROM OPENQUERY($server,'$sql')";

        $result = sqlsrv_query($con, $CSelect, array(), array("Scrollable" => 'static'));

        //  print_r($CSelect);
        return $result;
    }





    function info($rut, $con)
    {

        $db = '[UGM]';

        $server = '[CERTIFIKATE]';

        $sSelect = " SELECT MT_CLIENT.CODCLI AS RUT,
                     MT_CLIENT.NOMBRE AS NOMBRE, 
                     MT_CLIENT.PATERNO AS APELLIDO_PATERNO, 
                     MT_CLIENT.MATERNO AS APELLIDO_MATERNO,
                     MT_CLIENT.MAIL_INST AS CORREO,
                     MT_CLIENT.SEXO AS GENERO,
                     $db.DBO.FN_TIENE_DOC_PENDIENTES_PA(MT_CLIENT.CODCLI)AS BLOQUEO_ACADEMICO,
                     CASE WHEN $db.DBO.FN_alumno_deuda (MT_CLIENT.CODCLI)  = ''1'' THEN ''SI'' ELSE ''NO'' END AS BLOQUEO_FINANCIERO ";

        $sFrom =   " FROM $db.[dbo].MT_CLIENT WITH(NOLOCK), $db.[dbo].MT_ALUMNO WITH(NOLOCK) ";

        $sWhere = " WHERE "
            . " MT_ALUMNO.RUT = MT_CLIENT.CODCLI "
            . " AND MT_CLIENT.CODCLI= ''$rut'' "; //RUT ALUMNO SIN DV";

        $sql = " $sSelect $sFrom $sWhere ";


        $CSelect = "SELECT * FROM OPENQUERY($server,'$sql')";

        $result = sqlsrv_query($con, $CSelect, array(), array("Scrollable" => 'static'));

        // print_r($CSelect);
        return $result;
    }

    function carrera($rut, $con)
    {

        $sSelect = " SELECT 
                     MT_ALUMNO.CODCARPR AS CODIGO_CARRERA,
                     MT_CARRER.NOMBRE_C AS NOMBRE_PROGRAMA,
                     MT_CARRER.SEDE AS CODIGO_SEDE,
                     RA_SEDE.DESCRIPCION AS NOMBRE_SEDE,
                     MT_TIPOCARR.DESCRIPCION AS TIPO_CARRERA,
                     SUBSTRING(MT_TIPOCARR.DESCRIPCION,1,4) AS CODIGO_TIPO_CARRERA,
                     MT_ALUMNO.ESTACAD AS ESTADO_ACADEMICO_ALUMNO,
                     RA_TIPOSITU.DESCRIPCION AS SITUACION_ACADEMICA,
                     MT_ALUMNO.ANO_MAT AS ANO_MATRICULA ";

        $sFrom =   " FROM [CIISA].[UmasnetPruebas].[dbo].MT_CLIENT WITH(NOLOCK),[CIISA].[UmasnetPruebas].[dbo].MT_ALUMNO WITH(NOLOCK),[CIISA].[UmasnetPruebas].[dbo].MT_CARRER WITH(NOLOCK),"
            . " [CIISA].[UmasnetPruebas].[dbo].RA_SEDE WITH(NOLOCK),[CIISA].[UmasnetPruebas].[dbo].MT_TIPOCARR WITH(NOLOCK),[CIISA].[UmasnetPruebas].[dbo].RA_TIPOSITU WITH(NOLOCK)";

        $sWhere = " WHERE "
            . "MT_CLIENT.CODCLI= '$rut' " //RUT ALUMNO SIN DV
            . " AND MT_CARRER.CODCARR = MT_ALUMNO.CODCARPR "
            . " AND RA_SEDE.CODSEDE = MT_CARRER.SEDE "
            . " AND MT_CARRER.TIPOCARR = MT_TIPOCARR.TIPOCARR "
            . " AND RA_TIPOSITU.CODIGO = MT_ALUMNO.TIPOSITU "
            . " AND MT_ALUMNO.RUT = MT_CLIENT.CODCLI ";

        $sql = " $sSelect $sFrom $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        // print_r($sql);
        return $result;
    }


    function TNE($rut, $con)
    {

        //    $db = '[UGM].[dbo]';
        //        
        //    $server = '[UMAS]';
        //    $server = '[CERTIFIKATE]';
        //    
        //    $sSelect = " SELECT
        //                    MT_CLIENT.CODCLI,
        //                    MT_CLIENT.DIG,
        //                    MT_CLIENT.PATERNO,
        //                    MT_CLIENT.MATERNO,
        //                    MT_CLIENT.NOMBRE,
        //                    MT_CLIENT.FECNAC,
        //                    MT_ALUMNO.CODCARPR,
        //                    MT_CARRER.NOMBRE_C,
        //                    MT_ALUMNO.JORNADA,
        //                    MT_ALUMNO.FEC_MAT AS FECHA_MATRICULA,
        //                    MT_ALUMNO.ESTACAD AS ESTADO_ACADEMICO,
        //                    RA_TIPOSITU.DESCRIPCION AS SITUACION_ACADEMICA,
        //                    MT_CLIENT.MAIL_INST AS MAIL_INSTITUCIONAL,
        //                    MT_CLIENT.CELULARACT AS CELULAR";
        //
        //        $sFrom =   " FROM "
        //                 . " $db.MT_CLIENT , $db.MT_ALUMNO , $db.MT_CARRER , $db.RA_TIPOSITU";
        //                      
        //        $sWhere = " WHERE 
        //                        MT_ALUMNO.RUT = MT_CLIENT.CODCLI AND
        //                        MT_ALUMNO.CODCARPR = MT_CARRER.CODCARR AND
        //                        RA_TIPOSITU.CODIGO = MT_ALUMNO.TIPOSITU AND
        //                        $db.MATRICULA.FN_ULTIMOCODCLI_NET(MT_CLIENT.CODCLI)= MT_ALUMNO.CODCLI AND
        //                        MT_ALUMNO.RUT =''$rut''
        //                        AND MT_ALUMNO.ESTACAD =''VIGENTE''
        //                        AND MT_ALUMNO.ANO_MAT ='2020'";

        $db = '[UGM]';

        $server = '[CERTIFIKATE]';

        $sSelect = " SELECT
                    MT_CLIENT.CODCLI AS RUT,
                    MT_CLIENT.DIG AS DV,
                    MT_CLIENT.PATERNO AS PATERNO,
                    MT_CLIENT.MATERNO AS MATERNO,
                    MT_CLIENT.NOMBRE AS NOMBRE,
                    CONVERT(VARCHAR, MT_CLIENT.FECNAC, 20) AS FECHA,
                    MT_ALUMNO.CODCARPR AS ID_CARRERA,
                    MT_CARRER.NOMBRE_C AS CARRERA,
                    MT_ALUMNO.JORNADA AS JORNADA,
                    CONVERT(VARCHAR, MT_ALUMNO.FEC_MAT, 20) AS FECHA_MATRICULA,
                    MT_ALUMNO.ESTACAD AS ESTADO_ACADEMICO,
                    RA_TIPOSITU.DESCRIPCION AS SITUACION_ACADEMICA,
                    MT_CLIENT.MAIL_INST AS MAIL_INSTITUCIONAL,
                    MT_CLIENT.CELULARACT AS CELULAR, "
            //        . " $db.DBO.MATRICULA.FN_ULTIMOCODCLI_NET(MT_CLIENT.CODCLI),"
            . " $db.DBO.FN_TIENE_DOC_PENDIENTES_PA(MT_CLIENT.CODCLI)AS BLOQUEO_ACADEMICO ";

        $sFrom =   " FROM "
            . " $db.[dbo].MT_CLIENT , $db.[dbo].MT_ALUMNO , $db.[dbo].MT_CARRER , $db.[dbo].RA_TIPOSITU";

        $sWhere = " WHERE "
            . " MT_ALUMNO.RUT = MT_CLIENT.CODCLI AND "
            . " MT_ALUMNO.CODCARPR = MT_CARRER.CODCARR AND "
            . " RA_TIPOSITU.CODIGO = MT_ALUMNO.TIPOSITU AND "
            //          ." $db.DBO.MATRICULA.FN_ULTIMOCODCLI_NET(MT_CLIENT.CODCLI)= MT_ALUMNO.CODCLI AND "
            . " MT_ALUMNO.ESTACAD =''VIGENTE'' AND "
            . " MT_ALUMNO.ANO_MAT =''2020'' AND "
            . " MT_ALUMNO.RUT =''$rut'' ";

        $sql = " $sSelect $sFrom $sWhere ";


        $CSelect = "SELECT * FROM OPENQUERY($server,'$sql')";

        $result = sqlsrv_query($con, $CSelect, array(), array("Scrollable" => 'static'));

        //  print_r($CSelect);
        return $result;
    }


    function TNE2($con)
    {

        $sSelect = " SELECT tbl_tne.rut_estudiante AS RUT ,CL.NOMBRE,CL.PATERNO,CL.MATERNO,tbl_tne.fono AS FONO, convert(varchar,tbl_tne.fecha) AS FECHA,tbl_proceso_realizar.nombre_proceso AS PROCESO ";


        $sFrom =   " FROM tbl_proceso_realizar, tbl_tne,[CIISA].[UmasnetPruebas].[dbo].MT_CLIENT CL ";

        $sWhere = " WHERE "
            . "tbl_tne.proceso = tbl_proceso_realizar.id_proceso AND CL.CODCLI = LEFT(rut_estudiante, LEN(rut_estudiante) - 2)";

        $sql = " $sSelect $sFrom $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        // print_r($sql);
        return $result;
    }



    function campusAlumno($anhio, $periodo, $con)
    {

        $sSelect = " SELECT MT_ALUMNO.RUT as username,
    
        'Virtual.20201'  as  password ,
        
        MT_CLIENT.NOMBRE  as firstname,
        
        MT_CLIENT.PATERNO + '  ' + MT_CLIENT.MATERNO AS lastname,
        
        MT_CLIENT.MAIL_INST as email,
        
        RA_NOTA.RAMOEQUIV+'-'+CONVERT(VARCHAR,RA_NOTA.CODSECC) AS course1 ";


        $sFrom =   " FROM [CIISA].[UmasnetPruebas].[dbo].MT_ALUMNO, [CIISA].[UmasnetPruebas].[dbo].MT_CLIENT, [CIISA].[UmasnetPruebas].[dbo].RA_NOTA ";

        $sWhere = " WHERE
    
        MT_ALUMNO.CODCLI = RA_NOTA.CODCLI AND  
        MT_ALUMNO.RUT =MT_CLIENT.CODCLI AND
        MT_ALUMNO.ANO_MAT ='$anhio' AND 
        RA_NOTA.ANO = '$anhio' and 
        RA_NOTA.PERIODO ='$periodo' AND
        MT_ALUMNO.ESTACAD IN ('VIGENTE', 'EGRESADO') AND
        isnull(RA_NOTA.ESTADO,'')<> 'E'";

        $sql = " $sSelect $sFrom $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        //print_r($sql);
        return $result;
    }

    function campusDocente($anhio, $periodo, $con)
    {

        $sSelect = " SELECT DISTINCT 
        RA_PROFES.CODPROF AS username,
        'Virtual.20201' AS password,
        RA_PROFES.NOMBRES AS firstname,
        RA_PROFES.AP_PATER + '  ' + RA_PROFES.AP_MATER AS lastname,
        RA_PROFES.MAIL_INST  AS email,
        RA_SECCIO.CODRAMO+'-'+CONVERT(VARCHAR,RA_SECCIO.CODSECC) AS course1, 
        '3' AS role1,
        'SANTIAGO' as city ";


        $sFrom =   " FROM [CIISA].[UmasnetPruebas].[dbo].RA_PROFES WITH(NOLOCK), [CIISA].[UmasnetPruebas].[dbo].RA_SECCIO WITH(NOLOCK) ";

        $sWhere = " WHERE
    
        RA_SECCIO.CODPROF = RA_PROFES.CODPROF AND
        RA_SECCIO.ANO ='$anhio' AND RA_SECCIO.PERIODO ='$periodo' ";

        $sql = " $sSelect $sFrom $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));

        //print_r($sql);
        return $result;
    }

    function campusAyudante($anhio, $periodo, $con)
    {

        $sSelect = " SELECT  DISTINCT

        RA_PROFES.CODPROF AS username,
        
        'Virtual.20201' AS password,
        
        RA_PROFES.NOMBRES AS firstname,
        
        RA_PROFES.AP_PATER + '  ' + RA_PROFES.AP_MATER AS lastname,
        
        RA_PROFES.MAIL_INST  AS email,
        
        RA_CTLPRF.CODRAMO+'-'+CONVERT(VARCHAR,RA_CTLPRF.CODSECC) AS course1,
        
        '3' AS role1,
        
        'SANTIAGO' as city ";


        $sFrom =   " FROM [CIISA].[UmasnetPruebas].[dbo].RA_PROFES WITH(NOLOCK), [CIISA].[UmasnetPruebas].[dbo].RA_CTLPRF WITH(NOLOCK)";

        $sWhere = " WHERE

        RA_PROFES.TIPOPROFE ='AYUDANTE' AND
        
        RA_CTLPRF.CODPROF = RA_PROFES.CODPROF AND
        
        RA_CTLPRF.ANO ='$anhio' AND RA_CTLPRF.PERIODO = $periodo ";

        $sql = " $sSelect $sFrom $sWhere ";

        $result = sqlsrv_query($con, $sql, array(), array("Scrollable" => 'static'));




        //   print_r($sql);
        return $result;
    }


    function Procollet($con)
    {

        $db = '[UGM].DBO';

        $server = '[CERTIFIKATE]';

        $sSelect = " SELECT MT_CLIENT.CODCLI AS RUT_ALUMNO , 

MT_CLIENT.DIG AS DIGITO_VERIFICADOR_ALUMNO, 

MT_CLIENT.NOMBRE + '' '' + MT_CLIENT.PATERNO + '' '' + MT_CLIENT.MATERNO AS ALUMNO, 

MT_VIADMISION.DESCRIPCION AS VIA_INGRESO, 

MT_ALUMNO.ESTACAD AS ESTADO_ACADEMICO_ALUMNO, 

RA_TIPOSITU.DESCRIPCION AS SITUACION_ACADEMICA_ALUMNO, 

MT_ALUMNO.ANO_MAT AS ANO_ULTIMA_MATRICULA, 

MT_ALUMNO.ANO AS COHORTE, 

MT_CLIENT.DIRACTUAL AS DIRECCION_ALUMNO, 

MT_CLIENT.comuna AS COMUNA_ALUMNO, 

MT_CLIENT.FONOACT AS FONO_ALUMNO, 

ISNULL(MT_CLIENT.mail, '' '') AS EMAIL_ALUMNO, 

MT_TIPOCARR.DESCRIPCION AS TIPO_CARRERA, 

MT_DOCUM.NOMBRE AS TIPO_DOCUMENTO, 

MT_CTADOC.ctadocnum AS NUMERO_DOCUMENTO, 

MT_ALUMNO.CODCARPR AS CODIGO_CARRERA, 

MT_CARRER.NOMBRE_C AS NOMBRE_CARRERA, 

CONVERT(INT, MT_CTADOC.monto) AS MONTO_CAPITAL, 

$db.InteresMora(MT_CTADOC.MONTO, MT_CTADOC.FECVEN, GETDATE(), -1) AS INTERESES, 

CONVERT(INT, $db.fn_Obtiene_gastos_cob(MT_CTADOC.ID_CUOTA)) AS GASTOS_COBRANZAS, 

CONVERT(INT, MT_CTADOC.saldo) AS SALDO, 

CONVERT(VARCHAR, MT_CTADOC.fecven, 103) AS FECHA_VENCIMIENTO_COMPROMISO, 

MT_CTADOC.ano AS ANO_GENERACION_DEUDA, 

MT_CTADOC.periodo AS PERIODO_GENERACION_DEUDA, 

ISNULL(MT_CTADOC.rut_gir, '' '') AS RUT_GIRADOR_CHEQUE, 

ISNULL(MT_CTADOC.nom_girador, '' '') AS NOMBRE_GIRADOR_CHEQUE, 

MT_APODER.CODAPOD + ''-'' + MT_APODER.DIG AS RUT_RESPONSABLE_FINANCIERO, 

MT_APODER.NOMBRE + '' '' + MT_APODER.PATERNO + '' '' + MT_APODER.MATERNO AS NOMBRE_RESPONSABLE_FINANCIERO, 

MT_APODER.DIR_PART AS DIRECCION_RESPONSABLE_FINANCIERO, 

MT_APODER.COMU_PART AS COMUNA_RESPONSABLE_FINANCIERO, 

MT_APODER.TEL_PART AS FONO_RESPONSABLE_FINANCIERO, 

ISNULL(MT_APODER.MAIL, '' '') AS EMAIL_RESPONSABLE_FINANCIERO, 

CASE MT_ALUMNO.JORNADA WHEN ''D'' THEN ''DIURNA'' WHEN ''V'' THEN ''VESPERTINA'' ELSE ''SIN JORNADA'' END AS JORNADA, 

mt_detubi.NOMBRE AS UBICACION_DOCUMENTO, 

CASE WHEN $db.FN_alumno_deuda(MT_CLIENT.CODCLI) = ''1'' THEN ''S'' ELSE ''N'' END AS BLOQUEO_FINANCIERO, 

CONVERT(VARCHAR, MT_CTADOC.fecreg, 103) AS FECHA_EMISION_COMPROMISO  ";

        $sFrom =   " FROM $db.MT_CLIENT , $db.MT_ALUMNO , $db.MT_DOCUM , $db.MT_CTADOC , $db.MT_CARRER , 

$db.MT_APODER , $db.MT_TIPOCARR , $db.RA_TIPOSITU , $db.mt_detubi , $db.MT_VIADMISION  ";

        $sWhere = " WHERE MT_CLIENT.CODCLI = MT_ALUMNO.RUT 

AND MT_CLIENT.CODCLI = MT_CTADOC.CODCLI 

AND MT_ALUMNO.CODCARPR = MT_CTADOC.CODCARR 

AND MT_ALUMNO.RUT = MT_CTADOC.CODCLI 

AND MT_ALUMNO.CODCARPR = MT_CTADOC.CODCARR 

AND MT_CTADOC.CTADOC  = MT_DOCUM.TIPODOC 

AND MT_CARRER.CODCARR = MT_CTADOC.CODCARR 

AND MT_CARRER.CODCARR = MT_ALUMNO.CODCARPR 

AND MT_APODER.CODAPOD = MT_CLIENT.CODAPOD 

AND MT_TIPOCARR.TIPOCARR = MT_CARRER.TIPOCARR 

AND RA_TIPOSITU.CODIGO = MT_ALUMNO.TIPOSITU 

AND mt_detubi.CodUbi = MT_CTADOC.UBICACION 

AND MT_VIADMISION.COD_VIA = MT_CLIENT.VIADMISION 

AND MT_CTADOC.SALDO > 0 

AND MT_CTADOC.ESTADO = 2 

AND $db.FN_ULTIMOCODCLI(MT_CLIENT.CODCLI) = MT_ALUMNO.CODCLI  ";


        $sql = " $sSelect $sFrom $sWhere ";


        $CSelect = "SELECT * FROM OPENQUERY($server,'$sql')";

        $result = sqlsrv_query($con, $CSelect, array(), array("Scrollable" => 'static'));


        //   print_r($CSelect);

        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }


        return $result;
    }
}



    




/*
SELECT * FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSCAR POSC,[CIISA].[UmasnetPruebas].[dbo].MT_ALUMNO AL,[CIISA].[UmasnetPruebas].[dbo].MT_POSBEN POSB 
WHERE POSC.ANO ='2020' 
AND POSC.PERIODO ='1' 
AND POSC.ESTADO ='A'
AND POSB.ESTADO ='4'
AND AL.MATRICULADO ='S' 
AND AL.RUT = POSB.CODCLI
AND POSC.CODPOSTUL = AL.RUT
AND AL.RUT='11'



SELECT * FROM [CIISA].[UmasnetPruebas].[dbo].MT_POSCAR 
WHERE 
--CODPOSTUL  ='RUT_ALUMNO'

--AND

ANO ='2020' AND PERIODO ='1' AND ESTADO ='A'

*/