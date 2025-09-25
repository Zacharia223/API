<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'zacharia.ogega@strathmore.edu';   
    $mail->Password   = 'qsdc gcla jjip dmie';     
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('zacharia.ogega@strathmore.edu', 'BBIT 2.2');
    $mail->addAddress('zackogega@gmail.com', 'Zack');

    $mail->isHTML(true);
    $mail->Subject = 'Welcome to BBIT 2.2! Account Verification';
    $mail->Body    = "Hello " . htmlspecialchars($name) . ",<br><br>" .
                    "You requested an account on BBIT 2.2.<br>" .
                    "In order to use this account you need to <a href='#'>Click here</a> to complete registration process<br><br>" .
                    "Regards,<br>Systems Admin<br>BBIT 2.2";
   
    $mail->send();
    echo "✅ Test email sent successfully";
} catch (Exception $e) {
    echo "❌ Email could not be sent. Error: {$mail->ErrorInfo}";
}
?>
