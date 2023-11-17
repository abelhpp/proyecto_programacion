<?php
//config para errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once 'PHPMailer-master/src/PHPMailer.php';
require_once 'PHPMailer-master/src/SMTP.php';
require_once 'PHPMailer-master/src/Exception.php';


$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'nuevoencuentrolist@gmail.com';
$mail->Password = 'prlj rfjt edoi uedx';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->setFrom('nuevoencuentrolist@gmail.com');

$mail->addAddress('abelipes@gmail.com');

$mail->isHTML(true);

$mail->Subject = 'titulo';
$mail->Body = 'Mensaje';
$mail->send();
echo "enviado";
?>