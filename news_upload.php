<?php
include 'connectdb.php';
session_start();

$logged_in = $_SESSION['logged_in'];
$role = $_SESSION['role'];

if($role != 'admin' || $logged_in == false) {
    header(header:"Location: list_news.php");
}

?>
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
        <input type="file" id="pictureup" name="fileToUpload">
    </form>
    </div>
