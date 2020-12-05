<?php

require $_SERVER['DOCUMENT_ROOT']."/PHPMailer/src/Exception.php";
require $_SERVER['DOCUMENT_ROOT']."/PHPMailer/src/PHPMailer.php";
require $_SERVER['DOCUMENT_ROOT']."/PHPMailer/src/SMTP.php";
//require "../PHPMailer/src/Exception.php";
//require "../PHPMailer/src/PHPMailer.php";
//require "../PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Mail{
    
function enviarMail($estudiante,$asistente,$tipo,$destino,$imagen,$fecha_sel){

 
    $mensaje;
        switch ($tipo) {
            case 1:
                include '../Mail/plantilla_mail_asignacion.php';
                break;
            case 2:
                include '../Mail/plantilla_mail_citacion.php';
                break;
            case 3:
                include '../Mail/plantilla_mail_agendar.php';    
                break;
            case 4:
                include '../Mail/plantilla_mail_notificar.php';  
            case 5:
                include $_SERVER['DOCUMENT_ROOT'].'/Mail/plantilla_mail_contraseña.php';     
                break;
            case 6:
                include '../Mail/plantilla_mail_TNE.php';    
                break;
        }


$oMail= new PHPMailer();
$oMail->isSMTP();
$oMail->Host="smtp.gmail.com";
$oMail->Port=587;
$oMail->SMTPSecure="tls";
$oMail->SMTPAuth=true;

//tiempo limite de respuesta
$oMail->Timeout=9999;



$oMail->Username="becas.beneficios@ugm.cl";
$oMail->Password="ugm2019.19";
$oMail->setFrom("becas.beneficios@ugm.cl","UFE");


/*
$oMail->Username = "owl.evaluacion@gmail.com";
$oMail->Password = "evaluacion123.";
$oMail->setFrom("owl.evaluacion@gmail.com", "UFE");
*/

$oMail->addAddress($destino,"Direccion a quien envia");
$oMail->Subject="Unidad de Financiamiento Estudiantil";
$oMail->msgHTML($mensaje);

if(!$oMail->send()){
  echo $oMail->ErrorInfo;  
}
//para error smpt 
//https://myaccount.google.com/lesssecureapps?utm_source=google-account&utm_medium=web&pli=1

} 
   

}   