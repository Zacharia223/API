<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';


$conn = new mysqli("localhost", "root", "swae", "proo", "3306");
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"]; 
   
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("❌ Invalid email format");
    }

   
    $sql = "INSERT INTO users (username, email) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $email);

    if ($stmt->execute()) {
        // Send Welcome Email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'william.ochieng@strathmore.edu';   // replace with your Gmail
            $mail->Password   = 'myjd nkhy yrmp xydl';      // replace with Gmail App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom('william.ochieng@strathmore.edu', 'BBIT 2.2');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            $mail->Subject = 'Welcome to BBIT 2.2! Account Verification';
            $mail->Body    = "Hello " . htmlspecialchars($name) . ",<br><br>" .
                            "You requested an account on BBIT 2.2.<br>" .
                            "In order to use this account you need to <a href='#'>Click here</a> to complete registration process<br><br>" .
                            "Regards,<br>Systems Admin<br>BBIT 2.2";
            $mail->send();
            echo "<div style='font-family: Arial; margin:20px;'>
                    ✅ Signup successful. Welcome email sent! <br>
                    <a href='users.php'>View Users</a>
                  </div>";
        } catch (Exception $e) {
            echo "⚠ User saved, but email could not be sent. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "❌ Error: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>