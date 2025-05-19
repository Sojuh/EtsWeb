<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $verified = $_POST['verified'];

    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, role, verified) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $first_name, $last_name, $email, $password, $role, $verified);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create New User</title>
    <link rel="stylesheet" href="create.css">
</head>

<body>

    <div class="form-container">
        <h2>Create New User</h2>
        <form method="post" action="create_users.php">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" placeholder="First Name" required>

            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" placeholder="Last Name" required>

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" required>

            <label for="password">Password</label>
            <input type="text" name="password" placeholder="Password" required>

            <label for="role">Role</label>
            <input type="text" name="role" placeholder="Role (e.g. admin)" required>

            <label for="verified">Verified</label>
            <input type="text" name="verified" placeholder="Verified (0 or 1)" required>

            <input type="submit" value="Create User">
        </form>

        <a href="dashboard.php" class="back-link">Back to Dashboard</a>
    </div>

</body>

</html>