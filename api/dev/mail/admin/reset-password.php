<?php
$array = $callclass->_get_setup_backend_settings_detail_for_branch($conn, $clientId, $branchId);
$fetch = json_decode($array, true);
$smtpHost = $fetch[0]['smtpHost'];
$smtpUsername = $fetch[0]['smtpUsername'];
$smtpPassword = $fetch[0]['smtpPassword'];
$smtpPort = $fetch[0]['smtpPort'];
$senderName = $fetch[0]['senderName'];
$supportEmail = $fetch[0]['supportEmail'];
$currentDate = date("l, d F Y");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../mail/PHPMailer/src/PHPMailer.php';
require '../../mail/PHPMailer/src/SMTP.php';
require '../../mail/PHPMailer/src/Exception.php';

$mail = new PHPMailer(true);

try {

    $mail->SMTPDebug = SMTP::DEBUG_OFF;  // Disable verbose debug output
    $mail->isSMTP();  // Set mailer to use SMTP
    $mail->Host       = $smtpHost;  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;  // Enable SMTP authentication
    $mail->Username   = $smtpUsername;  // SMTP username
    $mail->Password   = $smtpPassword;  // SMTP password
    $mail->SMTPSecure = 'ssl';  // Enable SSL encryption
    $mail->Port       = $smtpPort;  // TCP port to connect to

    $mail->SMTPOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' =>true
        ]
    ];  
    $mail->isHTML(true);
    //// sender and replyTo
    $mail->setFrom($smtpUsername, $senderName);
    $mail->addReplyTo($supportEmail, $senderName); // Reply-to address
    

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sendTo=$email;
$recieverName=$fullName;
$subject="Reset Password -- $senderName";

   
$message='
<div style="width:90%; margin:auto; height:auto;">
  <div style="padding:15px; font-size:16px;">
    <p>Hi <strong>' . $fullName . '</strong>,</p>
    <p>
      Trust this mail meets you well.<br><br>
      Kindly use the link below to reset your password.
    </p>
    <p>'.$dbClientAddress.'/portal/admin/reset-password?ref='.$accessKey.'</p>

    <div style="min-height:30px; background:#333; text-align:left; color:#FFF; line-height:20px; padding:20px 10px 20px 50px;">
      &copy; All Right Reserved. <br>' . $senderName . '
    </div>
  </div>
</div>';



    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = strip_tags($message);  // Fallback for non-HTML clients
    
    /// copy this emails
    $mail->addAddress($email, $parentFullname);  // Recipient email and name
    $mail->addAddress($supportEmail, $senderName);  // Support email
    $mail->addAddress("afootechglobal@gmail.com", "AfooTECH Global");  // Additional recipient
    
    // Send the email
    if(!$mail->send()){
        echo 'Not Working';
    }

} catch (Exception $e) {
    // Handle PHPMailer exceptions
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>