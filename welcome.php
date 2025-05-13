<?php
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
    <h1>Hello <?php echo htmlspecialchars($username); ?>, Nice to see you! Welcome to the Black & White faithful</h1>
    <h2> Look at the header for places to go! </h2>
    <p> If you need any help with understanding the icons Click <a href="icons.html">Here</a></p>
    <?php
    if($role === 'admin'){
        echo " As You are an admin you can delete news, edit news and post articles , here is the links to do so " ?> <br> <a href="news_upload.php">Create News</a><br> <a href="list_news.php">List news</a><?php
    } ?>