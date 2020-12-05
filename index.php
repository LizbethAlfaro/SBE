<?php
header("Location: login.php");
//phpinfo();

//SELECT * FROM OPENQUERY([UMAS],'SET FMTONLY OFF exec [UGM].[dbo].SP_ALUMNO_DEUDA 19521857')
/*
 *https://uniwebsidad.com/libros/xhtml/capitulo-3/codificacion-de-caracteres
 
 * 
vaciar bd de usuarios 
 * 
truncate table tbl_direccion
truncate table tbl_integrante
truncate table tbl_ingresoFam
truncate table tbl_asignacion
truncate table tbl_declaracion
truncate table tbl_solicitud
truncate table tbl_vivienda
truncate table tbl_informe 
truncate table tbl_estudiante 
 * 
 * 
admin
 * 
truncate table tbl_horario
truncate table tbl_asignacion 
truncate table tbl_log 
 * 
beca interna
 * 
truncate table tbl_calificacion_beca
truncate table tbl_informe_beca_interna
truncate table tbl_estudiante_beca 
 * 
 * 
 * asistente
 * truncate  table tbl_horario

 * 
*/
/*
 * 
 Para duplicar una tabla, podemos hacer varias cosas, copiar sólo la estructura:

SELECT * Into DestinationTableName From SourceTableName Where 1 = 2

porque puede ser útil para casos X, o bien hacer un duplicado exacto de la misma:

SELECT * INTO MyNewTable FROM MyTable

con la salvedad de que, no se copiarán las constraints o índices.
 * 
 https://ascii.cl/es/codigos-html.htm
  
Sxxx1xxx
  
echo "# BecasBeneficios" >> README.md
git init
git add README.md
git commit -m "first commit"
git remote add origin git@github.com:SonyOyarzun/BecasBeneficios.git
git push -u origin master
 * 
guardar 
git commit -m "first commit"
git remote add origin https://github.com/SonyOyarzun/BecasBeneficios.git
git push -u origin master 
 * 
 * 
 * 
 <select id="fechaIng" name="fechaIng" class='form-control' required disabled>
                                        <option value="">Seleccione una fecha</option>
                                        <?php
                                        $fechaIng = FechaIng::recuperarFechaIng($con);

                                        while ($rw = sqlsrv_fetch_array($fechaIng)) {
                                            ?>
                                            <option value="<?php echo $rw['anhio_fechaIng']; ?>"><?php echo $rw['anhio_fechaIng']; ?></option>			
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    
                                    <select id="fechaIng" name="fechaIng" class='form-control' required="">
                                        <option value="">Seleccione una fecha</option>
                                        <?php while ($cont >= 1950) { ?>
                                            <option value="<?php echo($cont); ?>"><?php echo($cont); ?></option>
                                            <?php $cont = ($cont - 1);
                                        }
                                        ?>
                                    </select>

*/
?>
/*
para graficos Charts
https://code.tutsplus.com/es/tutorials/getting-started-with-chartjs-line-and-bar-charts--cms-28384

posible login con google

solo correos ugm?

https://www.youtube.com/watch?v=hazMyK_cnzk

scape string en base de datos para caracteres especiales


realizado
1.si se selecciona condicion con enfremedad se habilita input para especificarla
2.si se selecciona otra prevision habilita input para especificarla


pendiente
3.integrante no puede repetirse en el mismo estudiante
4.fecha ingreso debe actualizarse cada año 2019...

indice de regiones en hidden




DUPLICIDAD DE INTEGRANTES

USE [BecasBeneficios]
GO

--verificar duplicidad
SELECT rut_integrante,rut_estudiante FROM tbl_integrante 
     GROUP BY rut_integrante,rut_estudiante 
     HAVING COUNT(*)>1;

--buscar
SELECT * from tbl_integrante where rut_integrante = rut_estudiante and  rut_integrante='20.283.219-9'
--eliminar duplicidad
DELETE FROM [dbo].[tbl_integrante]
      WHERE rut_integrante = 'rut' and rut_estudiante = 'rut'
--insertar el mismo
 INSERT INTO tbl_integrante (rut_estudiante,rut_integrante,nombre_integrante,apellido_integrante,genero_integrante,fechaNac_integrante,relacion_integrante,estadoCivil_integrante,nivelEduc_integrante,actividad_integrante,prevision_integrante,otraPrevision_integrante,condicion_integrante,enfermedad_integrante) 
 VALUES ('rut','rut','nombre','apellido','genero','fechaNac','0','8','3','2','1','','3','') 
	

*/



