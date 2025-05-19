<?php

session_start();
require_once 'config.php';


if (isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = 'Email is already registered!';
        $_SESSION['active_form'] = 'register';
    } else {
        $verified = ($role === 'admin') ? 0 : 1;
        $conn->query("INSERT INTO users (first_name, last_name, email, password, role, verified) VALUES ('$first_name', '$last_name', '$email', '$password', '$role', '$verified')");
    }

    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {


            if ($user['role'] === 'admin' && $user['verified'] != 1) {
                $_SESSION['login_error'] = 'Admin account is pending approval.';
                $_SESSION['active_form'] = 'login';
                header("Location: index.php");
                exit();
            }

            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: dashboard.php");
            } else {
                header("Location: homepage.php");
            }
            exit();
        } else {
            $_SESSION['login_error'] = 'Incorrect password.';
        }
    } else {
        $_SESSION['login_error'] = 'No user found with that email.';
    }

    $_SESSION['active_form'] = 'login';
    header("Location: index.php");
    exit();
}





?>