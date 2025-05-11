<?php
include 'connectdb.php';

$target_dir = "uploads/";
$target_file = $target_dir . basename ($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType =strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Below Checks if an  image file is a actual image or fake image.

if(isset($_POST['submit'])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false){
        echo "File is an image - " . $check["mime"]. ".";
        $uploadOk = 1;
    } else{
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Got up to here on W3 schools tutorial on file uploads.
$title = $_POST['title'];
$description =$_POST['description'];
$post_text = $_POST['content'];
$picture = $_POST['fileToUpload'];

$sanitisedTitle = htmlentities(string: $title);
$sanitisedDescription = htmlentities(string: $description);
$sanitisedPost = htmlentities(string: $post_text);

$sql ="INSERT INTO news (title, description, content , picture) VALUES ('$sanitisedTitle', '$sanitisedDescription', '$sanitisedPost', '$picture')";

if ($conn->query(query: $sql) === TRUE) {
    echo "New record created successfully";
    echo "<a href='list_posts.php'>Back to Posts</a>";
} else{
    echo "Error: " . $sql ."<br>" . $conn->error;
}