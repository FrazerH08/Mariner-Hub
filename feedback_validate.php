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
    echo "<a href='home.php' class='content-creatorbtn'>  Back to Home</a>";
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
</head>
<body>
    
</body>
</html>