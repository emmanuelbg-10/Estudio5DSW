<?php
// send_email.php

// Incluir el archivo de configuración
require 'config.php';

// Incluir la biblioteca PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Crear una nueva instancia de PHPMailer
$mail = new PHPMailer(true);

try {
  // Configuración del servidor SMTP
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = GMAIL_USERNAME;
  $mail->Password = GMAIL_PASSWORD;
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;

  // Configuración del correo electrónico
  $mail->setFrom(GMAIL_USERNAME, 'Emmanuel');
  $mail->addAddress($_POST['to']);
  $mail->Subject = $_POST['subject'];
  $mail->Body    = $_POST['message'];
  $mail->AltBody = strip_tags($_POST['message']);

  // Enviar el correo
  $mail->send();
  echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
  echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
}
