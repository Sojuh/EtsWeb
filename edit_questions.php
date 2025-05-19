<?php
include 'config.php';


include 'config.php';

// Check if 'id' is provided in the UR

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM questions WHERE id = $id");

if (!$result || $result->num_rows === 0) {
    echo "Error: Question not found.";
    exit;
}

$row = $result->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $difficulty = $_POST['difficulty'];

    $stmt = $conn->prepare("UPDATE questions SET question=?, answer=?, difficulty =? WHERE id =?");
    $stmt->bind_param("sssi", $question, $answer,$difficulty, $id);
    $stmt->execute();

    header("Location: questions.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Question</title>
    <link rel="stylesheet" href="edit_questions.css">
</head>
<body>

<div class="container">
    <h2>Edit Question</h2>
    <form method="POST" class="form-box">
        <label>Question</label>
        <textarea name="question" required><?= htmlspecialchars($row['question']) ?></textarea>

        <label>Answer</label>
        <textarea name="answer" required><?= htmlspecialchars($row['answer']) ?></textarea>

        <label>Difficulty</label>
        <textarea name="difficulty" required><?= htmlspecialchars($row['difficulty']) ?></textarea>

        <input type="submit" value="Update Question">
    </form>
</div>

</body>
</html>
