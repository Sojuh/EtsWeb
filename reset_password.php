<?php
$token = $_GET['token'] ?? '';
$email = $_GET['email'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
<h2>Reset Your Password</h2>
<form action="update_password.php" method="POST">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <label>New Password:</label>
    <input type="password" name="new_password" required>
    <button type="submit">Update Password</button>
</form>
</body>
</html>
