
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
    <link rel="stylesheet" href="login.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
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
</body>
</html>
