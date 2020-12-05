<?php
$fono = "+56 2 24144157";
$fono2 = "+56 2 24144534";
$rut=$asistente;
$mensaje="Si usted no solicito el restablecimiento de su contraseña, favor ignorar este mensaje.";
$token = hash('sha256', $rut);

$fecha=date("Y");
$pathInPieces = explode('/',$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);  
//$ruta='http://'.$pathInPieces[0]."/BecasBeneficios/";
$ruta='http://'.$pathInPieces[0]."/restablecer.php?rut=$rut&token=$token";

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
					Debe ingresar al siguiente enlace para generar una nueva contraseña</p>
                                                       
                        </div>
                        
                        <div style='color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif'>
				
				<p style='font-size: 15px; color:red;'>
					$mensaje</p>
                                                       
                        </div>
         
				<div style='width: 100%; text-align: center'>
					<a style='text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #3498db' href='$ruta'>Restablecer contraseña</a>	
				</div>
                            
 
    
				<p style='color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0'> UFE UGM $fecha </p>
			

			</div>
		</td>
	</tr>
      
</table>
</body>
</html>";