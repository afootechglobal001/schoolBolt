
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

require '../site-mail/PHPMailer/src/PHPMailer.php';
require '../site-mail/PHPMailer/src/SMTP.php';
require '../site-mail/PHPMailer/src/Exception.php';

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
    $mail->setFrom($smtp_username, $sender_name);
    $mail->addReplyTo($support_email, $sender_name); // Reply-to address
    
    $mail->MessageID = "<" . md5(uniqid(rand(), true)) . "@" . $_SERVER['SERVER_NAME'] . ">";

    $random_id = uniqid(); 

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $send_to=$smtp_username;
    $reciever_name=$fullname;	
    $subject="$reciever_name Testimony - $random_id";
    $message='
    
    <div style="width:90%; margin:auto; height:auto;">
    <img src="cid:mail_header" width="100%">
    <div style="padding:15px; font-family:16px;">
    <p>
    Hi <strong >'.$sender_name.'</strong></p>
     <p>
        A testimony was submitted for review. The details are as follows:<br><br>
        <strong>Full Name:</strong> '.$fullname.' <br><br>
        <strong>Email Address:</strong> '.$email.'<br><br> 
        <strong>Phone Number:</strong> '.$phone.'<br><br>
        <strong>Testimony:</strong> '.$testimony.'<br><br>
    </p>
    <p><strong>Ar-Rahman Montessori Schools</strong>, we deliver high-quality education and training, equipping students with knowledge, skills, and strong moral values to excel and thrive in their academic journey and beyond. <br/> 
        <strong>Be Inspired,</strong><br/> 
            <img src="cid:logo" width="150px" style="padding:5px; background:#fff; border-radius:4px; margin-top:10px;"></p>
        </div>
        <div style="min-height:30px;background:#333;text-align:left;color:#FFF;line-height:20px;padding:20px 10px 20px 50px;">
            &copy; All Right Reserve.<br>' . $thename . '
        </div>
    </div>';


    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = strip_tags($message);  // Fallback for non-HTML clients
    
    /// copy this emails
    $mail->addAddress($smtp_username, $fullname);  // Recipient email and name
    $mail->addAddress($support_email, $sender_name);  // Support email
    $mail->addAddress("afootechglobal@gmail.com", "AfooTECH Global");  // Additional recipient

    // Attach images
    $mail->Subject = $subject;
    $mail->addEmbeddedImage('../site-mail/img/mail_header.jpg', 'mail_header');
    $mail->addEmbeddedImage('../site-mail/img/logo.png', 'logo');

    $mail->addCustomHeader('X-Unique-ID', md5(uniqid(rand(), true)));
    
    // Send the email
    if(!$mail->send()){
        echo 'Not Working';
    }

} catch (Exception $e) {
    // Handle PHPMailer exceptions
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>