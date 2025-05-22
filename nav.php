<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'connectdb.php';

$logged_in = $_SESSION['logged_in'] ?? false;
$role = $_SESSION['role'] ?? '';
$user_id = $_SESSION['user_id'] ?? null;
?>

<nav class="nav-bar">
    <ul>
        <li><a href="home.php" class="nav-bar-links">Home</a></li>
        <li><a href="forum.php" class="nav-bar-links">Forum</a></li>
        <li><a href="list_news.php" class="nav-bar-links">News</a></li>
        <li><a href="stats.php" class="nav-bar-links">Stats</a></li>
        <li><a href="about_club.php" class="nav-bar-links">About Club</a></li>
        <li><a href="fixtures&results.php" class="nav-bar-links">Fixtures & Results</a></li>
        <li><a href="signup.php" class="nav-bar-links">Sign Up</a></li>
        <li><a href="login.php" class="nav-bar-links">Log In</a></li>
        <?php if ($user_id): ?>
            <li><a href="retrieve_profile.php?id=<?= htmlspecialchars($user_id); ?>" class="nav-bar-links">View Account</a></li>
        <?php endif; ?>
        <li><a href="admin_management.php" class="nav-bar-links">Admin Management</a></li>
        <li><a href="feedback.php" class="nav-bar-links">Feedback</a></li>
        <li><a href="logout.php" class="nav-bar-links">Log Out</a></li>
    </ul>
</nav>
