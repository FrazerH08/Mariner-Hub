<?php
include 'nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Validate</title>
    <link rel="stylesheet" href="list_news.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
    <script src="nav.js" defer></script>
</head>
<body>
    <?php
    if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Use prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Add debugging
    // echo "Debug - User found: ";
    // var_dump($user);
    // echo "<br>";

    // Check password using existing method from signup (hashed password)
    if($user && password_verify($password, $user['password'])){
        // Regenerate session ID for security
        session_regenerate_id(true);

        // Store username , id and role in session
        $_SESSION['user_id'] =$user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['logged_in']= true;

        // Add debugging
        // echo "Debug - Session username set: " . $_SESSION['username'];

        header("Location: welcome.php");
        exit();
    } else {
        echo "<h1 class='title'>Invalid username or password</h1>";
        echo "<a class='btn' href='javascript:self.history.back()'> Go Back</a>";
    }
}
        ?>
<footer>
        <div class="f-container">
            <div class="footer-content">
                <h3>Contact Us</h3>
                <p>Email: citizensroadtosurvival@gmail.com</p>
            </div>
            <div class="footer-content">
                <h3> Quick links</h3>
                <ul class="f-list">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="list_news.php">News</a></li>
                    <li><a href="forum.php">Forum</a></li>
                    <li><a href="about_club.php">About Club</a></li>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="feedback.php">Feedback</a></li>
                </ul>
            </div>
            <div class="footer-content">
                <h3>Follow Us</h3>
                <ul class="social-icons">
                    <li><a href="https://x.com/Citizens_RoadTS"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://www.instagram.com/citizensroadtosurvival/"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="bottom-bar">
            <p>This is a student website , with some further additions after the course as I am extremely passionate about the club!</p>
            <p><a class="other-projects-link" href="other-projects\index.html">My other websites</a> (Ignore The Mariner Hub link on there as it is outdated)</p>
        </div>
    </footer>

</body>
</html>

