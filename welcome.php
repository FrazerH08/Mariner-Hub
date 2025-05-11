<?php
session_start();

// Check if username is set in session
if (!isset($_SESSION['username'])) {
    echo "No username in session. Please log in.";
    header("Location: login.php");
    exit();
}

// Get username from session, with additional safety
$username = $_SESSION['username'] ?? 'Guest';
?>
    <h1>Hello <?php echo htmlspecialchars($username); ?>, Nice to see you! Welcome back to the blogsite!</h1>
    <h2> Look at the header for places to go! </h2>
    <p> If you need any help with understanding the icons Click <a href="icons.html">Here</a></p>