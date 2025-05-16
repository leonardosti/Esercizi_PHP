<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';

function getMailer(): PHPMailer {
    $mail = new PHPMailer(true);
    // configurazione SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.tuodominio.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'username';
    $mail->Password   = 'password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->setFrom('no-reply@fastroute.it', 'FastRoute');
    return $mail;
}
