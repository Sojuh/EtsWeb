<?php
include 'config.php';
$id = $_GET['id'];
$conn->query("DELETE FROM users WHERE ID=$id");
header("Location: dashboard.php");
?>
