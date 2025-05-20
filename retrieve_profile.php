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
            <link rel="stylesheet" href="accounts.css">
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
</body>
</html>
