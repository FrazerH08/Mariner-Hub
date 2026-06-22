<?php
session_start();
include 'connectdb.php';
include 'nav.php';

if (!isset($_GET['id'])) {
    die("Invalid or missing user ID.");
}

$id = intval($_GET['id']); 
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "No user found!";
    exit;
}

$row = $result->fetch_assoc();
$username = $row['username'];
$firstname = $row['firstname'];
$lastname = $row['lastname'];
$email = $row['email'];
$bio = $row['bio'];
$profile_pic = $row['profile_pic'];
$region = $row['region'];
$status = $row['status'];
$birthdate = $row['birthdate'];
$role = $row['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="accounts.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
    <script src="nav.js" defer></script>
</head>
<body>
    <h1 class="title"> <u>Edit Profile</u></h1>
<form action="edit_profile_validate.php" method='POST' enctype="multipart/form-data">
        <input type="hidden" class="box" name="id" value="<?php echo $id;?>">
        <label class="labels" for="firstname"><b>First name:</b></label>
        <input type="text" class="box" name="firstname" value="<?php echo $firstname;?> "required> <br>
        <br>
        <label class="labels" for="lastname"><b>Lastname:</b></label>
        <input type="text" class="box" name="lastname" value="<?php echo $lastname;?> "required> <br>
        <br>
        <label class="labels" for="dob"><b>Date of birth:</b></label>
        <input type="date" class="box" id="birthdate"name="birthdate" value="<?php echo $birthdate;?>"> <br> <br>
        <label class="labels" for ="bio"><b>Bio:</b></label>
        <input type="text" class="box" name="bio" value="<?php echo $bio;?>"> <br>
        <br>
        <label class="labels" for="region"><b>Region:</b></label> 
        <select id="region" class="box" name="region" value="<?php echo $region;?>"> 
        <option value="Australia">Australia</option>
        <option value="Canada">Canada</option>
        <option value="USA">USA</option>
        <option value="United Kingdom">United Kingdom</option>
        </select>
        <br>
        <br>
        <label class="labels" for="email"><b>Email:</b></label> <br>
        <input type="text" class="box"  name="email" value="<?php echo $email;?>" required> <br>
        <br> <label class="labels" for="username"><b>Username:</b></label> <br>
        <input type="text" class="box" name="username" value="<?php echo $username; ?>" required> <br>
        <br> <label for="pictureup" class="custom-file-upload">Choose Image </label>
        <input type="file" id="pictureup"name="fileToUpload">
        <br>
        <br> <div class="next">
            <button type="submit" class="box" name= "submit" value="submit" class="signupbtn" >Next</button>
        </div>
    </form>
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
            <p><a class="other-projects-link" href="https://ercstudentwebserver.co.uk/students/frazerh/">My other websites</a> (Ignore The Mariner Hub link on there as it is outdated)</p>
        </div>
    </footer>

</body>
</html>
