<?php
$fono = "+56 2 24144157";
$fono2 = "+56 2 24144534";

$fecha=date("Y");
$pathInPieces = explode('/',$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);  
//$ruta='http://'.$pathInPieces[0]."/BecasBeneficios/";
$ruta='http://'.$pathInPieces[0]."/";

$descarga = $ruta."descarga.php";

$mensaje="<!DOCTYPE html>
<html lang='es'>
<head>
	<meta charset='utf-8'>
	<title>Asignacion</title>
</head>
<body style='background-color: black '>

<table style='max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;'>


	<tr>
		<td style='padding: 0'>
			<img style='padding: 0; display: block' src='$imagen' width='100%'>
		</td>
	</tr>
	
	<tr>
		<td style='background-color: #ecf0f1'>
			<div style='color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif'>
				<h2 style='color: #e67e22; margin: 0 0 7px'>Hola $estudiante!</h2>
				<p style='margin: 2px; font-size: 15px'>
					Recuerde que usted tiene <Strong>Pendiente el envio</Strong> de su Formulario de Postulación y/o Renovación a Beca Socieconomica:</p>
                                <p style='margin: 2px; font-size: 15px'>
					</p>
                                <p style='margin: 2px; font-size: 15px'>
					Recuerda enviar los siguientes documentos el dia de la entrevista <a href='$descarga'>DESCARGA AQUI</a></p>        
                               <p style='margin: 2px; font-size: 15px; color: red;'>LAS ENTREVISTAS SERAN POR VIDEOLLAMADA</p>
                               <p>debe enviar la documentación de respaldo a su situación con 48 horas de anticipación a su entrevista, por favor leer las indicaciones en la parte inferior de su formulario.</p>
                                <p style='margin: 2px; font-size: 15px'>
					Para mayor informacion contactate a los telefonos </p> 
                                <p style='margin: 2px; font-size: 15px'>$fono</p>
                                    <p style='margin: 2px; font-size: 15px'>$fono2</p>
                                 <p style='margin: 2px; font-size: 15px'> Favor no responder este Mail, todas la consultas deben ser dirigidas a ufe@ugm.cl </p>        
				<div style='width: 100%;margin:20px 0; display: inline-block;text-align: center'>
					
				</div>
				<div style='width: 100%; text-align: center'>
					<a style='text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #3498db' href='$ruta'>Ir a la página</a>	
				</div>
				<p style='color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0'> UFE UGM $fecha </p>
			</div>
		</td>
	</tr>
</table>
</body>
</html>";