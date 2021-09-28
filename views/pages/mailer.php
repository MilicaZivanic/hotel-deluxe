<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
function sendMail($name, $email, $subject, $message){
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                     // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'paradisehotel421@gmail.com';                     // SMTP username
    $mail->Password   = 'Paradise1234!';                               // SMTP password
    $mail->SMTPSecure = 'tls';       // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('paradisehotel421@gmail.com', 'Paradise - Contact Form');
    $mail->addAddress('milica.zivanic.26.17@ict.edu.rs');               // Name is optional
    $mail->addReplyTo( $email, $name);

   
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Subject'. $subject;
    $mail->Body    = '<h3>Name: '.$name.'<br>Email: '.$email.'<br>Message: '.$message.'</h3>';
    $mail->send();
    $_SESSION['sent'] = "Your message has been sent. We'll get back to you as soon as possible.";
    return true;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    return false;
}
}