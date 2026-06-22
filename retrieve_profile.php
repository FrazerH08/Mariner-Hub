<?php
include 'connectdb.php';
include 'nav.php';

$user_id = $_GET['id'];

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>View Profile</title>
            <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
            <link rel="stylesheet" href="accounts.css">
            <script src="nav.js" defer></script>
</head>
        <body>
            <h1 class="title"><u>View Profile</u></h1>
            <?php
        echo '<section class="postCard">';
        echo '<img src="uploads/' . htmlspecialchars($row['profile_pic']) . '" alt="Profile Picture" style="width:150px;height:auto;">';
        echo "<h2> Username:" . htmlspecialchars($row['username']) . "</h2>";
        echo "<h3> Firstname:" . htmlspecialchars($row['firstname']) . "</h3>";
        echo "<h3> Lastname:" . htmlspecialchars($row['lastname']) . "</h3>";
        echo "<h3> Region:" . htmlspecialchars($row['region']) . "</h3>";
        echo "<h3> Role:" . htmlspecialchars($row['role']) . "</h3>";
        echo "<p> Bio:" . htmlspecialchars($row['bio']) . "</p>";
        echo '<br>';
        echo '<br>';
        echo '<a href="edit_profile.php?id=' . htmlspecialchars($row['id']) . '">Edit</a>';
        echo '</section>';
    }
} else {
    echo "Sorry, 0 Results Returned";
}

$stmt->close();
$conn->close();
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
            <p><a class="other-projects-link" href="https://ercstudentwebserver.co.uk/students/frazerh/">My other websites</a> (Ignore The Mariner Hub link on there as it is outdated)</p>
        </div>
    </footer>

</body>
</html>
