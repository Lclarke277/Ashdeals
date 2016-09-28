<?php 
function sendMail() {// Taken From PHPMailer Template
require_once 'PHPMailer/PHPMailerAutoload.php';
   // require_once 'PHPMailer/class.smtp.php';
    $mail = new PHPMailer;
    $mail->isSMTP();

    $mail->SMTPDebug = 2;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'lucaspatrickclarke@gmail.com';
    $mail->Password = 'Randan27!';
    
    
    $mail->IsHTML(true);

    $mail->SetFrom('lucaspatrickclarke@gmail.com');
    $mail->AddReplyTo('replay@example.com', 'Ashdeals.us');
    $mail->AddAddress('lucaspatrickclarke@gmail.com', 'Ashdeals Admin');

    $mail->Subject = 'This is subject';
    $mail->msgHTML = 'This is the body of email';
    $mail->AltBody = 'This is the body of email';
    $mail->send();
}
?>