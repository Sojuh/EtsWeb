<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgot_pass.css">
</head>
<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <form action="send_reset.php" method="POST">
            <label>Email:</label>
            <input type="email" name="email" required>
            <button type="submit">Send Reset Link</button>
        </form>
    </div>
</body>
</html>
