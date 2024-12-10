<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM students WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $message = "<p class='error'>Username already exists!</p>";
    } else {
        $query = "INSERT INTO students (username, password) VALUES ('$username', '$password')";
        if ($conn->query($query) === TRUE) {
            $message = "<p class='success'>Registration successful!</p>";
        } else {
            $message = "<p class='error'>Error: " . $conn->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #f2709c, #ff9472);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h1 {
            font-size: 24px;
            color: #ff5722;
        }
        .input-group {
            margin: 15px 0;
        }
        .input-group input {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .btn {
            background-color: #ff5722;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .btn:hover {
            background-color: #e64a19;
        }
        p {
            margin-top: 10px;
        }
        .login-link {
            color: #ff5722;
            text-decoration: none;
        }
        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <p>Create your account by filling the form below.</p>
        <?php if (isset($message)) echo $message; ?>
        <form method="POST" action="">
            <div class="input-group">
                <input type="text" name="username" placeholder="Create your username" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php" class="login-link">Login here</a></p>
    </div>
</body>
</html>