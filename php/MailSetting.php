<?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
require './php/forgetpassword/PHPMailer/src/Exception.php';
require './php/forgetpassword/PHPMailer/src/PHPMailer.php';
require './php/forgetpassword/PHPMailer/src/SMTP.php';
$mail = new PHPMailer(true);
  //Server settings
  $mail->SMTPDebug = false; //SMTP::DEBUG_SERVER;                      // Enable verbose debug output
  $mail->isSMTP();                                            // Send using SMTP
  $mail->Host       = 'smtp.office365.com';                    // Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
  $mail->Username   = '';                     // SMTP username
  $mail->Password   = '';                               // SMTP password
  $mail->SMTPSecure = 'STARTTLS';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
  //Recipients
  $mail->setFrom('', 'Silkroad Online');
  $mail->addReplyTo('', 'Silkroad Online');
  $mail->isHTML(true);  
?>