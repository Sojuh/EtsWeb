<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require 'config.php'; // your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $stmt = $conn->prepare("SELECT ID FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $token = bin2hex(random_bytes(32));
        $token_hash = hash('sha256', $token);
        $expires = date("Y-m-d H:i:s", time() + 3600); // 1 hour

        $stmt->close();

        $update = $conn->prepare("UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?");
        $update->bind_param("sss", $token_hash, $expires, $email);
        $update->execute();

        $reset_link = "http://localhost/forgot-password/reset_password.php?token=$token&email=" . urlencode($email);

        // Send email with PHPMailer
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'jmasangcay@gmail.com';            // Your Gmail address
            $mail->Password   = 'testxampp';              // Your app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('yourgmail@gmail.com', 'Your App Name');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = "Click the link to reset your password: <a href='$reset_link'>$reset_link</a>";

            $mail->send();
            echo "Reset email sent successfully!";
        } catch (Exception $e) {
            echo "Email failed: {$mail->ErrorInfo}";
        }

    } else {
        echo "Email not found.";
    }
}
?>
