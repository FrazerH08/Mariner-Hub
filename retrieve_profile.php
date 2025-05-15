<?php
include 'connectdb.php';

$news_id = $_GET['id'];

$sql = "SELECT *  FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $news_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
        
        echo '<section class="postCard">';
        echo "<h2>" . htmlspecialchars($row['username']) . "</h2>";
        echo "<h3>" . htmlspecialchars($row['firstname']) . "</h3>";
        echo "<h3>" . htmlspecialchars($row['lastname']) . "</h3>";
        echo "<h3>" . htmlspecialchars($row['region']) . "</h3>";
        echo "<h3>" . htmlspecialchars($row['role']) . "</h3>";
        echo "<p>" . htmlspecialchars($row['bio']) . "</p>";
        echo "<img>" . ($row['profile_pic'])  ;
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
