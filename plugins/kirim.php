<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "src/PHPMailer.php";
require_once "src/Exception.php";
require_once "src/OAuthTokenProvider.php";
require_once "src/OAuth.php";
require_once "src/POP3.php";
require_once "src/SMTP.php";

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 3;
    $mail->isSMTP();
    $mail->Host       = 'tls://smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'syifaskripsi1@gmail.com';
    $mail->Password   = 'jofhnelvuazvtvor';
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('syifaskripsi1@gmail.com', 'Admin BKPSDM');
    // UBAH EMAIL ADMIN
    $mail->addAddress($to_email, $to_nama);

    //Content
    $mail->isHTML(true);
    $mail->Subject = $to_subject;
    $mail->Body    = $to_body;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>