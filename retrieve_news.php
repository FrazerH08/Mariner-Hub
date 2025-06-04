<?php
include 'connectdb.php';
include 'nav.php';
$news_id = $_GET['id'];

$sql = "SELECT title, description, content, picture FROM news WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $news_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
        if (!empty($row['picture'])) {
            // If it's a file path
            if (file_exists($row['picture'])) {
                echo "<img src='" . htmlspecialchars($row['picture']) . "' alt='Post Image'>";
            }
            // If it's base64 encoded
            else if (strpos($row['picture'], 'base64') !== false) {
                echo "<img src='" . $row['picture'] . "' alt='Post Image'>";
            }
            // If it's binary data
            else {
                echo "<img src='data:image/jpeg;base64," . base64_encode($row['picture']) . "' alt='Post Image'>";
            }
        }
        echo '<section class="postCard2">';
        echo "<h2>" . html_entity_decode($row['title']) . "</h2>";
        echo "<h3>" . html_entity_decode($row['description']) . "</h3>";
        echo "<p>" . html_entity_decode($row['content']) . "</p>";
        // Check if picture exists and is not null
        echo '</section>';
    }
} else {
    echo "Sorry, 0 Results Returned";
}


?>

<?php
if (isset($_SESSION['user_id'])){
    echo '
    <section class="comment-form">
        <form method="POST" action="post_comment.php">
            <textarea name="text" placeholder="What would you like to comment..." required></textarea><br>
            <input type="hidden" name="news_id" value="'. htmlspecialchars($news_id) . '">
            <button type="submit">Post Comment</button>
        </form>
    </section>';
} else{
    echo '<p>Please <a href="login.php" class="content-creatorbtn">Log In</a> to comment </p>';
}

$commentQuery = "SELECT c.text, c.date_created, u.username 
                 FROM comments c 
                 JOIN users u ON c.user_id = u.id 
                 WHERE c.news_id = ? 
                 ORDER BY c.date_created DESC";
$commentStmt = $conn->prepare($commentQuery);
$commentStmt->bind_param("i", $news_id);
$commentStmt->execute();
$commentResult = $commentStmt->get_result();

echo '<section class="comments">';
echo '<h3>Comments:</h3>';
while ($comment = $commentResult->fetch_assoc()) {
    echo "<div class='comment-box'>";
    echo "<strong>" . htmlspecialchars($comment['username']) . "</strong><br>";
    echo "<p>" . nl2br(htmlspecialchars($comment['text'])) . "</p>";
    echo "<small>" . $comment['date_created'] . "</small>";
    echo "</div><hr>";
}
echo '</section>';
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Article</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="retrieve_news.css">
    <link rel="stylesheet" href="feedback.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
</head>
<body>
</div>
</body>
</html>
<?php
