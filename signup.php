<?php
include 'nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="signup.css">
  <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
  </style>
</head>
<body>
  <h1 class="title"><u>Sign Up</u></h1>
<form action="accountvalidation.php" method='POST'>
        <p> Please fill out this form to sign up </p>

        <label for="firstname"><b>First name:</b></label>
        <input type="text" class="box"placeholder="Enter First Name"name="firstname"required> <br>
        <br>

        <label for="lastname"><b>Lastname:</b></label>
        <input type="text" class="box" placeholder="Enter last Name"name="lastname"required> <br>
        <br>
        <label for="dob"><b>Date of birth:</b></label>
        <input type="date" class="box" id="birthdate"name="birthdate"> <br>
        <br>
        <label for="region"><b>Region:</b></label> 
        <select id="region" class="box" name="region">
        <option value="Australia">Australia</option>
        <option value="Canada">Canada</option>
        <option value="USA">USA</option>
        <option value="United Kingdom">United Kingdom</option>
        </select>
        <br>
        <br>
        <label for="email"><b>Email:</b></label> <br>
        <input type="text" class="box" placeholder="Enter Email" name="email" required> <br>
        <br> <label for="username"><b>Username:</b></label> <br>
        <input type="text" class="box" placeholder="Enter Username" name="username" required> <br>
        <br> <label for="password"><b>Password:</b></label> <br>
        <input type="password" class="box" placeholder="Enter Password" name="password" required>

        <label>
      <br> <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
        </label>

        <div class="next">
            <button type="submit" name= "submit" value="submit" class="loginbtn" >Next</button>
        </div>
        <p> Already have an account? <a href="login.php"> Sign in now</a></p>
    </form>
</body>
</html>
