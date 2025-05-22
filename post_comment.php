<?php
include 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posting Comment</title>
    <title> Article</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="retrieve_news.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
</head>
<body>
    <?php
    $user_id = $_SESSION['user_id'];
    $news_id = $_POST['news_id'];
    $text = $_POST['text'];

    $sql = "INSERT INTO comments (user_id, news_id , text) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $user_id , $news_id, $text);
     if ($stmt->execute()) {
        header("Location: retrieve_news.php?id=" . $news_id); // redirect back to the article
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    ?>
</body>
</html>