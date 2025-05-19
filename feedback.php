<?php
include 'nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback</title>
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="feedback.css">
  <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
  </style>
</head>
<body>
<h1 class="title"><u>Feedback Form</u></h1>
<div class="container">
  <form action="feedback_validate.php" method="post">
    <label class="labels" for="fname">First Name:</label>
    <input type="text" id="fname" name="firstname" placeholder="Your name..">

    <label class="labels" for="lname">Last Name:</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name..">

    <label class="labels" for="username">Username:</label>
    <input type="text" id="usrname" name="username" placeholder="Your username..">

    <label class="labels" for="email">Email:</label>
    <input type="text" id="email" name="email" placeholder="Your email..">

    <label class="labels" for="country">Country:</label>
    <select id="country" name="country">
      <option value="Australia">Australia</option>
      <option value="Canada">Canada</option>
      <option value="USA">USA</option>
      <option value="United Kingdom">United Kingdom</option>
    </select>

    <label class="labels" for="subject">Subject:</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

    <input type="submit" value="Submit">
  </form>
</div>
  
</body>
</html>