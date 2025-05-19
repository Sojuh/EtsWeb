<?php

session_start();

$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];

$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error)
{
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm)
{
    return $formName === $activeForm ? 'active' : '';
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escape The School</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>


    <section class="ETS">
        <div class="main-width">
            <header>
                <div class="logo">
                    <video class="video-bg" autoplay muted loop>
                        <source src="img/bg-live.mp4" type="video/mp4">
                    </video>
                    <h2><a href="index.php">Escape The School</a></h2>
                </div>

            </header>

            <div class="container">
                <div class="form-box <?= isActiveForm('login', $activeForm); ?>" id="login-form">
                    <form action="login_register.php" method="post">
                        <h2>Login</h2>
                        <?= showError($errors['login']); ?>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <button type="submit" name="login">Login</button>
                        <a href="forgot_password.php" class="forgot-password-link">Forgot Password?</a>
                        <p>Don't have an account yet? <a href="#" onclick="showForm('register-form')">Register</a></p>
                    </form>
                </div>


                <div class="form-box <?= isActiveForm('register', $activeForm); ?>" id="register-form">
                    <form action="login_register.php" method="post">
                        <h2>Register</h2>
                        <?= showError($errors['register']); ?>
                        <input type="first_name" name="first_name" placeholder="First name" required>
                        <input type="last_name" name="last_name" placeholder="Last name" required>
                        <input type="email" name="email" placeholder="Email" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <select name="role" required>
                            <option value="">--Select Role--</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                        <p class="info-message">Note: Admin accounts require approval before access.</p>
                        <button type="submit" name="register">Register</button>
                        <p>Already have an account? <a href="#" onclick="showForm('login-form')">Login</a></p>
                    </form>
                </div>
            </div>


        </div>
    </section>


    <script src="script.js"></script>
</body>

</html>