<?php
include 'connectdb.php';
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
    echo "<h1> Feedback Submitted! We will email you with the email you provided if we have any updates! </h1>";
    echo "<h1> <a href='index.php'> <br> Back to Home</a> </h1>";
} else{
    echo  "Error: " . $sql ."<br>" . $conn->error;
}
?>