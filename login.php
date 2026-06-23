
<?php
include 'nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
    <script src="nav.js" defer></script>
</head>
<body>
<h1 class="title"><u>Login</u></h1>
<form class="login-form" action="login_validation.php" method='POST'>
        <br> <label class="labels" for="username"><b>Username:</b></label>
        <input type="text" class="box"placeholder="Enter Username" name="username" required> <br>
        <br> <br> <label class="labels" for="password"><b>Password:</b></label>
        <input type="password" class="box" placeholder="Enter Password" name="password" required>
        <label class="labels">
      <br> <input type="checkbox" class="remember-me" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
        </label>
        <div class="next">
            <button type="submit" name= "submit" value="submit" class="loginbtn" >Login</button>
        </div>
        <p class="signup"> Need to sign up? <a href="signup.php"> Register now</a></p>
    </form>

    <p> Why should I login? <br> If you login to your account you will see many benefits  , <br> you can leave comments on news and make comments on forums , setup your account and make yourself known in the Mariner Hub community.</p>
    <?php
    if(isset($_POST['submit'])){
        $username =mysqli_real_escape_string($conn,$_POST['username']);
        $password =mysqli_real_escape_string($conn,$_POST['password']);

        $result = mysqli_query($conn,"SELECT * FROM users WHERE username='$username' AND password='$password'") or die("Error");
        $row = mysqli_fetch_assoc($result);

        if(is_array($row) && !empty($row)){
            $_SESSION['valid'] = $row['username'];
            $_SESSION['valid'] = $row['password'];
        }else{
            echo "<h1>username or password is incorrect  please go back</h1><br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
        }
        if(isset($_SESSION['valid'])){
            echo "You are logged in! Welcome back {$username}";
            header("Location: welcome.php");
        }
    }else{
    }
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
