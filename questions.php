<?php
include 'config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $difficulty = $_POST['difficulty'];

    $stmt = $conn->prepare("INSERT INTO questions (question, answer, difficulty) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $question, $answer, $difficulty);
    $stmt->execute();
}


if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM questions WHERE id = $id");
    header("Location: questions.php");
    exit;
}

// Fetch all questions
$result = $conn->query("SELECT * FROM questions ORDER BY ID DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dynamic Questions</title>
    <link rel="stylesheet" href="questions.css">
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

    <div class="container">
        <h2>Manage Questions</h2>


        <form method="POST" class="form-box">
            <label>Question</label>
            <textarea name="question" required></textarea>

            <label>Answer</label>
            <textarea name="answer" required></textarea>

            <label>Difficulty</label>
            <textarea name="difficulty" required></textarea>

            <input type="submit" name="add" value="Add Question">
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Difficulty</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['question']) ?></td>
                        <td><?= htmlspecialchars($row['answer']) ?></td>
                        <td><?= htmlspecialchars($row['difficulty']) ?></td>
                        <td>
                            <a href="edit_questions.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                            <a href="questions.php?delete=<?= $row['id'] ?>"
                                onclick="return confirm('Delete this question?')" class="btn-delete">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>

</html>