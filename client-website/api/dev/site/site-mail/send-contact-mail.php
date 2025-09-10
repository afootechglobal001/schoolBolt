<?php
$array = $callclass->_get_setup_backend_settings_detail($conn, 'BK_ID001');
$fetch = json_decode($array, true);
$smtp_host = $fetch[0]['smtp_host'];
$smtp_username = $fetch[0]['smtp_username'];
$smtp_password = $fetch[0]['smtp_password'];
$smtp_port = $fetch[0]['smtp_port'];
$sender_name = $fetch[0]['sender_name'];
$support_email = $fetch[0]['support_email'];
$currentDate = date("l, d F Y");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../config/mail/admin/PHPMailer/src/PHPMailer.php';
require '../../config/mail/admin/PHPMailer/src/SMTP.php';
require '../../config/mail/admin/PHPMailer/src/Exception.php';

$mail = new PHPMailer(true);

try {

    $mail->SMTPDebug = SMTP::DEBUG_OFF;  // Disable verbose debug output
    $mail->isSMTP();  // Set mailer to use SMTP
    $mail->Host       = $smtp_host;  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;  // Enable SMTP authentication
    $mail->Username   = $smtp_username;  // SMTP username
    $mail->Password   = $smtp_password;  // SMTP password
    $mail->SMTPSecure = 'ssl';  // Enable SSL encryption
    $mail->Port       = $smtp_port;  // TCP port to connect to

    $mail->SMTPOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' =>true
        ]
    ];  
    $mail->isHTML(true);
    //// sender and replyTo
    $mail->setFrom($email, $fullName);
    $mail->addReplyTo($email, $fullName); // Reply-to address
    

   //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$subject=$subject;
$message='
    <div style="width:90%; margin:auto; height:auto;">
        <div style="padding:15px; font-size:14px; color:#444;">
            <p>From: <strong> '. $fullName . '</strong></p>
            <p>Email:<strong> ' . $email . '</strong></p>
            <p>'.$message.'</p>
        </div>
    </div>';

  
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = strip_tags($message);  // Fallback for non-HTML clients
    
    /// copy this emails
    $mail->addAddress($support_email, $sender_name);  // Support email
    $mail->addAddress('ketubasic@arrahmanmontessori.com', 'Ar-rahman Montessorri Ketu');
    $mail->addAddress('ketucollege@arrahmanmontessori.com', 'Ar-rahman College Ketu');
    $mail->addAddress('ojotabasic@arrahmanmontessori.com', 'Ar-rahman Montessorri Ojota');
    $mail->addAddress('ojotacollege@arrahmanmontessori.com', 'Ar-rahman College Ojota');
    $mail->addAddress('arrahmanmontessori@gmail.com', 'Ar-rahman Admin');
    $mail->addAddress('afootechglobal@gmail.com', 'AfooTECH Global');  // Additional recipient

    // Attach images
    // $mail->addEmbeddedImage('../../config/mail/admin/img/mail_header.png', 'mail_header');
    // $mail->addEmbeddedImage('../../config/mail/admin/img/logo.png', 'logo');

    // Send the email
    if(!$mail->send()){
        echo 'Not Working';
    }

} catch (Exception $e) {
    // Handle PHPMailer exceptions
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
