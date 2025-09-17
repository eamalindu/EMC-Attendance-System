<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer-6.10.0/src/Exception.php';
require 'PHPMailer-6.10.0/src/PHPMailer.php';
require 'PHPMailer-6.10.0/src/SMTP.php';

function sendWelcomeMail($email,$name,$username)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'finalproject.eamalindu@gmail.com';
        $mail->Password   = 'ludfsvhjbybjhnth';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('finalproject.eamalindu@gmail.com', 'EMC-NIT Attendance System');
        $mail->addAddress($email);

        // 1. Load the HTML template
        $htmlBody = file_get_contents(__DIR__ . '/welcomeMail.html');

        $htmlBody = str_replace(
            ["Malindu Prabodhitha", "EMP"],   // what to look for
            [$name, $username],               // what to replace with
            $htmlBody
        );

        $mail->isHTML(true);
        $mail->Subject = 'Welcome To EMC-NIT Attendance System';
        $mail->Body    = $htmlBody;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'OK';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function sendPasswordResetMail($email,$link)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'finalproject.eamalindu@gmail.com';
        $mail->Password   = 'ludfsvhjbybjhnth';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('finalproject.eamalindu@gmail.com', 'EMC-NIT Attendance System');
        $mail->addAddress($email);

        // 1. Load the HTML template
        $htmlBody = file_get_contents(__DIR__ . '/passwordReset.html');
        $htmlBody = str_replace('{{reset_link}}', $link, $htmlBody);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body    = $htmlBody;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'OK';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

//example
//sendWelcomeMail("gayangask@gmail.com","Gayanga DISE","Gayanga");
?>
