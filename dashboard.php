<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body
        {
            background: linear-gradient(to right, #f2709c, #ff9472);
        }
        .container li{
            list-style-type: none;
            font-size:1.2rem;
        }
        .font12{
            font-size:1.5rem;
            color:red;

        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
        <p>Select a test:</p>
        <ul>
            <li><a href="test.php?subject=physics">Physics</a></li>
            <li><a href="test.php?subject=chemistry">Chemistry</a></li>
            <li><a href="test.php?subject=maths">Maths</a></li>
        </ul>
        <a href="logout.php" class="font12">Logout</a>
    </div>
</body>
</html>
