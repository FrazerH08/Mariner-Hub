<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'connectdb.php';

// $logged_in = $_SESSION['logged_in'] ?? false;
// $role = $_SESSION['role'] ?? '';
$user_id = $_SESSION['user_id'] ?? null;
// ?>

<header class="header">
        <div class="header_content">
            <a href="index.php" class="logo"><b>Mariner Hub</b></a>
            <nav class="nav">
                <ul class="nav_list">
                    <li class="nav_item"> <a href="list_news.php" class="nav_link">News</a></li>
                    <li class="nav_item"> <a href="forum.php" class="nav_link">Forum</a></li>
                    <li class="nav_item"> <a href="stats.php" class="nav_link">Stats</a></li>
                    <li class="nav_item"> <a href="about_club.php" class="nav_link">About Club</a></li>
                    <li class="nav_item"> <a href="fixtures&results.php" class="nav_link">Fixtures & Results</a></li>
                    <li class="nav_item" id="login"> <a href="login.php" class="nav_link">Login</a></li>
                    <li class="nav_item"> <a href="signup.php" class="nav_link">Sign up</a></li>
                    <li class="nav_item"> <a href="retrieve_profile.php" class="nav_link">View Account</a></li>
                    <li class="nav_item"> <a href="feedback.php" class="nav_link">Feedback</a></li>
                </ul>
            </nav>
            <div class="hamburger">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </div>
        <script src="nav.js" defer></script>
</header>

