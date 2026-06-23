<?php
include 'nav.php';   
include 'connectdb.php';
$logged_in = $_SESSION['logged_in'] ?? false;
$role = $_SESSION['role'] ?? '';
     
// Search functionality
$threads = [];
if(isset($_POST['submit'])){
    $search = $_POST['search'];
    
    // Prepared statement for safer search
    $stmt = $conn->prepare("SELECT * FROM threads WHERE title LIKE ? ORDER BY time_created DESC");
    $searchTerm = "%$search%"; 
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $threads[] = $row;
    }
}

// If no search was successfully performed, fetch all articles
if (empty($threads)) {
    $stmt = $conn->prepare("SELECT * FROM threads ORDER BY time_created DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $threads[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="list_news.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    .move-right p{
        font-size: 20px;
    }
    </style>
    <script src="nav.js" defer></script>
</head>
<body>
    <h1 class="title"><u>Forum</u></h1>
    <div class="move-right" style="margin-left: 10px;">
        <a class="btn" href="latest_rumours.php">Latest GTFC Rumours</a> <br>
        <p>To view latest rumours click the button!</p>
    </div>

    <?php
if ($logged_in) {
    echo '<a href="thread_upload.php" class="btn" style="margin-left: 10px">Create Thread</a>';
}
?>
<br> <br>
<br>
    <div class="search-button">
        <form method='POST'>
            <input type="text" class="search-btn"  placeholder="Search for a thread or author" name="search">
            <button name="submit">Search</button>
        </form>
    </div>

    <div class="posts-container">
        <?php
        // Display posts
        if (!empty($threads)) {
            foreach ($threads as $row) {
                echo '<section class="newsCard">';
                echo '<p><a class=article-title href="retrieve_thread.php?id=' . htmlspecialchars($row['id']) . '">' .  '<b>', htmlspecialchars($row['title']) . '</b>' , '</a></p>';

                if($role == 'admin'){
                    echo '<p class="edit-delete">
                        <a class =edit-btn href="edit_thread.php?id=' . htmlspecialchars($row['id']) . '">Edit</a> |
                        <a class=delete-btn onclick="return confirm(\'Do You Really Want To Delete This?\')" href="delete_thread.php?id=' . htmlspecialchars($row['id']) . '">Delete</a>
                    </p>';
                }

                echo '<p>Description: ' . htmlspecialchars($row['description']) . '</p>';
                echo '<p>Created By: ' . htmlspecialchars($row['username']) . '</p>';
                echo '<p>Date: ' . date("F j, Y, g:i a", strtotime($row['time_created'])) . '</p>';
                echo '</section>';
            }
        } else {
            echo "<p>No articles found.</p>";
        }
        ?>
    </div>
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