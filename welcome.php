<?php
include 'nav.php';
session_start();
$role = $_SESSION['role'] ?? '';

// Check if username is set in session
if (!isset($_SESSION['username'])) {
    echo "No username in session. Please log in.";
    header("Location: login.php");
    exit();
}

// Get username from session, with additional safety
$username = $_SESSION['username'] ?? 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome To Black&White Faithful </title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="welcome.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
</head>
<body>
<h2>Hello <?php echo htmlspecialchars($username); ?>, Nice to see you! Welcome to the Black & White Faithful</h2>
    <?php
    if($role === 'admin'){
        echo " As You are an admin you can delete news, edit news and post articles , here is the links to do so " ?> <br> <a href="news_upload.php">Create News</a><br> <a href="list_news.php">List news</a><?php
    }?>
</body>
</html>