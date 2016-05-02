<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that

ini_set('display_errors', 1);
require '../../../../phpmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = 'amoxtli1234@gmail.com';
$mail->Password = 'amoxtli2013';
$mail->SetFrom('amoxtli1234@gmail.com');
$mail->Subject = 'Test';
$mail->Body = 'hello';
$mail->AddAddress('ur13l.infante@gmail.com');

 if(!$mail->Send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
 } else {
    echo 'Message has been sent';
 }

?>
