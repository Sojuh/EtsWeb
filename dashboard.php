<?php

include 'config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
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


    <table>
        <div class="table-wrapper">
        <div class="top-bar">
            <input type="text" id="searchInput" placeholder="Search users..." onkeyup="searchTable()">
            <a href="create_users.php" class="btn-create">Create New User</a>
        </div>
        </div>



        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role</th>
                <th>Verified</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT ID, first_name, last_name, email, password, role, verified FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['ID']}</td>
                        <td>{$row['first_name']}</td>
                        <td>{$row['last_name']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['password']}</td>
                        <td>{$row['role']}</td>
                        <td>{$row['verified']}</td>
                        <td>
                            <a href='edit_users.php?id={$row['ID']}' class='btn-edit'>Edit</a>
                            <a href='delete_users.php?id={$row['ID']}' class='btn-delete' onclick=\"return confirm('Are you sure you want to delete this user?');\">Delete</a>
                        </td>
                      </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No users found.</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
    <script src="search.js"></script>

</body>

</html>