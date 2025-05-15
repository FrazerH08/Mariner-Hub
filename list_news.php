<?php
session_start();
include 'connectdb.php';

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
    <h1 class="title"><b><u>All Articles</u></b></h1>
    <div class="refresh">
        <button> <a href="list_news.php"> Click here to refresh articles</a></button>
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
                echo '<section class="postCard">';
                echo '<p><a href="retrieve_news.php?id=' . htmlspecialchars($row['id']) . '">' . '<br>', htmlspecialchars($row['title']) . '</a></p>';
                
                if($role === 'admin'){
                    echo '<p>
                        <a href="edit_news.php?id=' . htmlspecialchars($row['id']) . '">Edit</a> | 
                        <a onclick="return confirm(\'Do You Really Want To Delete This?\')" href="delete_news.php?id=' . htmlspecialchars($row['id']) . '">Delete</a>
                    </p>';
                }

                echo '<p>Description: ' . htmlspecialchars($row['description']) . '</p>';
                echo '<p>Article written: ' . htmlspecialchars($row['time_created']) . '</p>';
                echo '</section>';
            }
        } else {
            echo "<p>No articles found.</p>";
        }
        ?>
    </div>
</body>
</html>
