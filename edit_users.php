<?php
include 'config.php';

// Check if 'id' is set in the URL
if (!isset($_GET['id'])) {
    echo "Error: No user ID provided.";
    exit;
}

$id = $_GET['id'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $verified = $_POST['verified'];

    $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?, email=?, password=?, role=?, verified=? WHERE ID = ?");
    $stmt->bind_param("ssssssi", $first_name, $last_name, $email, $password, $role, $verified, $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}

// Fetch user data
$result = $conn->query("SELECT * FROM users WHERE ID = '$id'");
if ($result->num_rows === 0) {
    echo "Error: User not found.";
    exit;
}
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escape The School</title>
    <link rel="stylesheet" href="edit_users.css">
</head>

<body>

    <div class="wrapper">
        <div class="sidebar">
            <h2>Admin's Dashboard</h2>
            <ul>
                <li><a href="dashboard.php">Users</a></li>
                <li><a href="questions.php">Dynamic Questions</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
    <form method="post">
        <h2>Edit User</h2>
        <input type="text" name="first_name" value="<?= htmlspecialchars($row['first_name']) ?>" required><br>
        <input type="text" name="last_name" value="<?= htmlspecialchars($row['last_name']) ?>" required><br>
        <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required><br>
        <input type="text" name="password" value="<?= htmlspecialchars($row['password']) ?>" required><br>
        <input type="text" name="role" value="<?= htmlspecialchars($row['role']) ?>" required><br>
        <input type="text" name="verified" value="<?= htmlspecialchars($row['verified']) ?>" required><br>
        <input type="submit" value="Update">
    </form>
</body>

</html>