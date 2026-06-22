<?php
session_start();
include 'connectdb.php';
include 'nav.php';
$logged_in = $_SESSION['logged_in'] ?? false;
$role = $_SESSION['role'] ?? '';

// Search functionality
$news = [];
if(isset($_POST['submit'])){
    $search = $_POST['search'];
    
    // Prepared statement for safer search
    $stmt = $conn->prepare("SELECT * FROM news WHERE title LIKE ? ORDER BY time_created DESC");
    $searchTerm = "%$search%"; // Use LIKE for partial matches
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $news[] = $row;
    }
}

// If no search performed, fetch all articles
if (empty($news)) {
    $stmt = $conn->prepare("SELECT * FROM news ORDER BY time_created DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $news[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List News</title>
    <link rel="stylesheet" href="list_news.css">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
    <script src="nav.js" defer></script>
</head>
<body>
<h1 class="title"><u>All Articles</u></h1>
<br>
<?php
if($role === 'admin'){
    echo '<a href="news_upload.php" class="btn">Create Article</a>'; 
}
?>
<br> <br>
<a class="rumoursbtn" href="latest_rumours.php">Latest GTFC Rumours</a> <br>
<br>
    <div class="refresh">
        <a> <a href="list_news.php"> Click here to refresh articles</a></a>
    </div>
    <div class="search-button">
        <form method='POST'>
            <input type="text" placeholder="Search for a article or author" name="search">
            <button name="submit">Search</button>
        </form>
    </div>

    <div class="posts-container">
        <?php
        // Display posts
        if (!empty($news)) {
            foreach ($news as $row) {
                echo '<section class="newsCard">';
                  if (!empty($row['picture'])) {
                    echo '<img src="' . htmlspecialchars($row['picture']) . '" alt="Article image" class="listnews-article-image">';
                }
                echo '<p><a class=article-title href="retrieve_news.php?id=' . htmlspecialchars($row['id']) . '">' .  '<b>' . htmlspecialchars($row['title']) . '</b>' . '</a></p>';

                if($role === 'admin'){
                    echo '<p>
                        <a class=edit-btn href="edit_news.php?id=' . htmlspecialchars($row['id']) . '">Edit</a> |
                        <a class=delete-btn onclick="return confirm(\'Do You Really Want To Delete This?\')" href="delete_news.php?id=' . htmlspecialchars($row['id']) . '">Delete</a>
                    </p>';
                }

                // echo '<p>Description: ' . htmlspecialchars($row['description']) . '</p>';
                if (htmlspecialchars($row['username']) == null) {
                    echo '<p>Created By: <a class="user-n-f"> 404: User Not Found</a></p>';
                } else {
                    echo '<p>Created By: ' . htmlspecialchars($row['username']) . '</p>';
                    }
                    echo "<p>". date("F j, Y, g:i a", strtotime($row['time_created'])) . "</p>";
                
                // echo '<p>Article written: ' . htmlspecialchars($row['time_created']) . '</p>';
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
            <p><a class="other-projects-link" href="https://ercstudentwebserver.co.uk/students/frazerh/">My other websites</a> (Ignore The Mariner Hub link on there as it is outdated)</p>
        </div>
    </footer>

</body>
</html>
