<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$subject = $_GET['subject'];
$query = "SELECT {$subject}_marks FROM students WHERE id=" . $_SESSION['user_id'];
$result = $conn->query($query);
$marks = $result->fetch_assoc()["{$subject}_marks"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1><?php echo ucfirst($subject); ?> Result</h1>
        <p>Your Score: <strong><?php echo $marks; ?></strong></p>
        <a href="dashboard.php">Return to Dashboard</a>
    </div>
</body>
</html>
