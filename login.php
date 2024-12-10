<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM students WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($user['password'] === $password) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
        } else {
            $message = "<p class='error'>Incorrect password!</p>";
        }
    } else {
        $message = "<p class='error'>Username not found!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        /* Additional styles for the updated layout */

        .login-container {
            display: flex;
            flex-direction: row;
            max-width: 900px;
            width: 90%;
            height: 500px;
        }

        .login-box {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .login-header p {
            font-size: 1rem;
            color: #757575;
        }

        .login-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        .slider {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .slider img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            animation: slide 9s infinite;
        }

        .slider img:nth-child(1) {
            animation-delay: 0s;
        }

        .slider img:nth-child(2) {
            animation-delay: 3s;
        }

        .slider img:nth-child(3) {
            animation-delay: 6s;
        }

        @keyframes slide {
            0%, 100% { opacity: 0; }
            33.33%, 66.66% { opacity: 1; }
        }

        .form-group a {
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8rem;
            color: #757575;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Section: Login Form -->
        <div class="login-box">
            <div class="login-header">
                <h1 style="text-decoration:underline;">Login</h1>
                <p>Welcome back! Please login to your account.</p>
            </div>
            <?php if (isset($message)) echo $message; ?>
            <form method="POST">
                <div class="form-group">
                    <label for="username">User Name</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn-submit">Sign in</button>
                <p>&nbsp;</p>
                <p style="font-weight:200;">Don't have an account? </p><a href="register.php">Register now</a>
            </form>
        </div>

        <!-- Right Section: Image Slider -->
        <div class="login-image">
                <img src="images/placeholder1.jpg" alt="Changing Display" id="slideshow">
        </div>

    </div>

    
</body>
</html>

<script>
        const images = ['images/placeholder1.jpg', 'images/placeholder2.jpg', 'images/placeholder3.jpg'];
        let currentIndex = 0;
        const slideshow = document.getElementById('slideshow');

        setInterval(() => {
            currentIndex = (currentIndex + 1) % images.length;
            slideshow.src = images[currentIndex];
        }, 3000);
    </script>