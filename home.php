<?php
include 'nav.php';
$stmt = $conn->prepare("SELECT * FROM news ORDER BY time_created DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $news[] = $row;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="main.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
</head>

<body>
    <h1 class="title"> <u>Black & White Faithful</u></h1>
    <p class="welcome-paragrapth"> “Black & White Faithful” is a modern website which has everything a Grimsby Fan needs, from articles stats , <br> fixtures and results and a forum to discuss all things about Grimsby! As a community of Grimsby Town fans <br> you will be able to interact
        like never before!</p>

    <div class="grid-container">
        <div class="main-content">
    <?php
    // Limit to first 3 articles in the db , the for loop starts at the first article with the index being at 0 the loop stops after getting 3 articles
    for ($i = 0; $i < min(3, count($news)); $i++) {
        $article = $news[$i];
        $title = htmlspecialchars($article['title']);
        $image = !empty($article['picture']) ? htmlspecialchars($article['picture']) : 'pictures/default.png'; // if its not empty it will display the picture from the database but if it is it will just use the default one
        $link = 'retrieve_news.php?id=' . htmlspecialchars($article['id']); // so users can click on the image and go to the article from there

        if ($i === 0) {
            // Latest article as the index is 0 
            echo '<div class="latest-article">';
            echo '<a href="' . $link . '"><img class="article-image" src="' . $image . '" alt=""></a>';
            echo '<h1 class="big-article-title"><a href="' . $link . '">' . $title . '</a></h1>';
            echo '</div>';
        } else {
            // Smaller articles
            echo '<div class="' . ($i === 1 ? 'second-article' : 'third-article') . '">';
            echo '<a href="' . $link . '"><img class="smaller-article-image" src="' . $image . '" alt=""></a>';
            echo '<h2 class="big-article-title"><a href="' . $link . '">' . $title . '</a></h2>';
            echo '</div>';
        }
    }
    ?>
</div>

    </div>
    <div class="content-creators">
        <a href="content_creators.php" class="content-creatorbtn"> Grimsby Content Creators</a>
    </div>
</body>

</html>