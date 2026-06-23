<?php
include 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Thread Validate</title>
    <link rel="stylesheet" href="main.css">
   <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="nav.js" defer></script>
    <style>
        .add-thread-validation {
            display: flex;
            padding: 20px;
            background-color: transparent;
            border: 1px solid #b2b2b2;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            max-height:30% ;
            max-width: 50%;
            margin: 50px auto;
        }
        .add-thread-validation .title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        @media (max-width: 650px) {
            .add-thread-validation {
                max-width: 90%;
            }
            .add-thread-validation .title {
                font-size: 18px;
            }
            .add-thread-validation a.btn {
                max-width: 100%;
            }
        }
 </style>
</head>
<body>
<?php
include 'connectdb.php';
$title = $_POST['title'];
$description =$_POST['description'];
$content = $_POST['content'];
$username = $_SESSION['username'];

$sanitisedTitle = htmlentities(string: $title);
$sanitisedDescription = htmlentities(string: $description);
$sanitisedPost = htmlentities(string: $content);
echo '<div class="add-thread-validation">';
$sql ="INSERT INTO threads (title, description, content, username) VALUES ('$sanitisedTitle', '$sanitisedDescription', '$sanitisedPost', '$username')";
?>

    <?php
    if ($conn->query(query: $sql) === TRUE) {
        echo "<h1 class='title' >Thread created</h1>";
        echo "<a href='forum.php' text-align:center; class='btn'>Back to  threads </a>";
    } else{
        echo "Error: " . $sql ."<br>" . $conn->error;
    }
    echo '</div>';
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
            <p><a class="other-projects-link" href="other-projects\index.html">My other websites</a> (Ignore The Mariner Hub link on there as it is outdated)</p>
        </div>
    </footer>
</body>
</html>
