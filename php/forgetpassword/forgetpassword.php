<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require './php/forgetpassword/PHPMailer/src/Exception.php';
require './php/forgetpassword/PHPMailer/src/PHPMailer.php';
require './php/forgetpassword/PHPMailer/src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
 //Server settings
 $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
 $mail->isSMTP();                                            // Send using SMTP
 $mail->Host       = 'localhost';                    // Set the SMTP server to send through
 $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
 $mail->SMTPSecure = 'ssl';
 $mail->Username   = 'abdalla20736@gfg.com';                     // SMTP username
 $mail->Password   = 'aA3199462';                               // SMTP password
 $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
 $mail->Port       = 25;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

 //Recipients
 $mail->setFrom('abdalla20736@gmail.com', 'Silkroad Online');
 $mail->addAddress('abdalla20736@gmail.com', 'Silkroad Online');     // Add a recipient
 $mail->addReplyTo('wehesh_egy@yahoo.com', 'Information');


 // Content
 $mail->isHTML(true);                                  // Set email format to HTML
 $mail->Subject = 'Here is the subject';
 $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
 $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
try {
   

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>