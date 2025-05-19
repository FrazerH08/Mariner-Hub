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
        echo '<section class="postCard">';
        echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
        echo "<h3>" . htmlspecialchars($row['description']) . "</h3>";
        echo "<p>" . htmlspecialchars($row['content']) . "</p>";
        // Check if picture exists and is not null
        echo '</section>';
    }
} else {
    echo "Sorry, 0 Results Returned";
}

$stmt->close();
$conn->close();
?>
</div>
</body>
</html>
<?php
