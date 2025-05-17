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
$sendTo=$parentEmail;
$recieverName=$parentFullname;
$subject="$studentFullname -- Payment Receipt for $session $termName";

    $totalAmount=0;

    $getFeesPaidQuery=mysqli_query($conn,"SELECT paymentId  FROM PAYMENTS_TAB WHERE clientId='$clientId' AND branchId='$branchId' AND session='$session' AND termId='$termId' AND  studentId='$studentId'")or die (mysqli_error($conn));
  
    while ($fetchQuery = mysqli_fetch_assoc($getFeesPaidQuery)) {
    $paymentId = $fetchQuery['paymentId'];
    $query=mysqli_query($conn,"SELECT feesName, amount  FROM PAYMENT_HISTORY_TAB WHERE paymentId='$paymentId'")or die (mysqli_error($conn));
        while ($fetch = mysqli_fetch_assoc($query)) {
        $feesName = $fetch['feesName'];
        $amount = $fetch['amount'];
        $totalAmount += $amount;
        $feesList .= '<tr><td style="height:20px; border-bottom:#CCC 1px solid;">' . htmlspecialchars($feesName) . '</td><td style="border-bottom:#CCC 1px solid;">&#8358;' . number_format($amount) . '</td></tr>';
        }
    }

$message='
<div style="width:90%; margin:auto; height:auto;">
  <div style="padding:15px; font-size:16px;">
    <p>
      Hi <strong>' . $parentFullname . '</strong>, <br/>
      ' . $parentAddress . '<br/>
      ' . $parentMobileNumber . ',
    </p>
    <p>Below is the payment receipt breakdown for <strong>' . $studentFullname . ' ' . $session . ' ' . $termName . '</strong>.</p>
    
    <div style="background:#DAEEFE; padding:10px; margin-bottom:20px;">
      <div style="padding:5px; height:25px; line-height:25px;"> 
        <strong>PAYMENT DETAILS</strong> 
      </div>
      <div style="padding:10px; line-height:25px; background:#FFF; margin-bottom:20px;">
        <table width="100%" border="0" style="font-size:12px;">
          <tr>
            <td style="height:30px;"><strong>FEES</strong></td>
            <td><strong>AMOUNT (&#8358;)</strong></td>
          </tr>
          ' . $feesList . '
        </table>
        <div style="padding:10px; line-height:25px; background:#FFF;">
          TOTAL AMOUNT: <div style="float:right; color:#06F;">&#8358;' . number_format($totalAmount) . '</div>
        </div>
      </div>
    </div>
    <div style="min-height:30px; background:#333; text-align:left; color:#FFF; line-height:20px; padding:20px 10px 20px 50px;">
      &copy; All Right Reserved. <br>' . $senderName . '
    </div>
  </div>
</div>';



    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = strip_tags($message);  // Fallback for non-HTML clients
    
    /// copy this emails
    $mail->addAddress($parentEmail, $parentFullname);  // Recipient email and name
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