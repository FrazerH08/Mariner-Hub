<?php
include 'connectdb.php';
include 'nav.php';
$firstname = $_POST['firstname'];
$lastname =$_POST['lastname'];
$username = $_POST['username'];
$email = $_POST['email'];
$country = $_POST['country'];
$subject = $_POST['subject'];

$sanitisedfirstname =htmlentities(string: $firstname);
$sanitisedlastname = htmlentities(string: $lastname);
$sanitisedusername = htmlentities(string: $username);
$sanitisedemail =    htmlentities(string: $email);
$sanitisedcountry = htmlentities(string: $country);
$sanitisedsubject = htmlentities(string: $subject);

$sql ="INSERT INTO feedback (firstname, lastname, username, email, region, subject) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if($stmt){
    $stmt->bind_param("ssssss", $sanitisedfirstname, $sanitisedlastname, $sanitisedusername, $sanitisedemail, $sanitisedcountry, $sanitisedsubject);
}
if($stmt->execute()) {
    echo "<h1 class='title'> Feedback Submitted! We will email you with the email you provided if we have any updates! </h1>";
    echo "<a href='index.php' class='btn'>  Back to Home</a>";
} else{
    echo  "Error: " . $sql ."<br>" . $conn->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Validate</title>
<link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="feedback.css">
  <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
  </style>
    <script src="nav.js" defer></script>
</head>
<body>
    
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