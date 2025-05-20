<?php
include 'connectdb.php';
include 'nav.php';
session_start();

$logged_in = $_SESSION['logged_in'];
$role = $_SESSION['role'];

if($role != 'admin' || $logged_in == false) {
    header(header:"Location: list_news.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create News </title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="feedback.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
</head>
<body>
<h1><u>Create News</u></h1>
    <div class="formcss">
    <form action="add_news_validate.php" method="post" enctype="multipart/form-data">
    <label for="title">Title: </label><br>
        <input type="text" name="title" id="title" placeholder="New Post Title" size="50" required>
        <br>
        <label for="description_txt">Description: </label><br>
        <textarea name="description" id="description_txt" cols="100" rows="10" placeholder="New News Description" required></textarea><br>
        <label for="content">Content: </label><br>
        <textarea name="content" id="content" cols="180" rows="26" placeholder="Enter News Content" required></textarea>
        <br>
        <button type="submit" class="btn" onclick="alert('Thanks for submitting!')">Submit</button>
        <label for="pictureup" class="custom-file-upload">Choose Image </label>
        <input type="file" id="pictureup"name="fileToUpload">
    </form>
    </div>
</body>
</html>

