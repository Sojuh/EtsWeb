<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];

    $stmt = $conn->prepare("SELECT reset_token_hash, reset_token_expires_at FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($token_hash_db, $expires_at);
    $stmt->fetch();
    $stmt->close();

    if (!$token_hash_db || strtotime($expires_at) < time()) {
        die("Invalid or expired token.");
    }

    if (hash_equals($token_hash_db, hash('sha256', $token))) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $update = $conn->prepare("UPDATE users SET password = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE email = ?");
        $update->bind_param("ss", $hashed_password, $email);
        $update->execute();

        echo "Password has been successfully updated.";
    } else {
        echo "Invalid token.";
    }
}
?>
