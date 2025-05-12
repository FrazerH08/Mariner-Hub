<?php
include 'connectdb.php';

//put a foreach loop to find out the keys in $_POST / $_FILES
foreach ($_FILES as $key => $value){
    echo($key . ' this is adams debug test');
  }
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
// check if file already exists
if (file_exists($target_file)){
    echo "Sorry this file already exists.";
    $uploadOk = 0;
}

// file size check
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo " Sorry this file is too large";
    $uploadOk = 0;
}
// file type check
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType !="jpeg" && $imageFileType != "gif"){
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
}

// upload ok check
if ($uploadOk == 0 ){
    echo "Sorry your file was not uploaded.";
} else{
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
        echo "The file". htmlspecialchars ( basename($_FILES["fileToUpload"]["name"])). "has been updated.";
    } else{
        echo "Sorry they was an error uploading your file.";
    }
}
$title = $_POST['title'];
$description =$_POST['description'];
$content = $_POST['content'];
$picture = basename($_FILES['fileToUpload']['name']);


$sanitisedTitle = htmlentities(string: $title);
$sanitisedDescription = htmlentities(string: $description);
$sanitisedPost = htmlentities(string: $content);

$sql ="INSERT INTO news (title, description, content , picture) VALUES ('$sanitisedTitle', '$sanitisedDescription', '$sanitisedPost', '$picture')";

if ($conn->query(query: $sql) === TRUE) {
    echo "New record created successfully";
    echo "<a href='list_posts.php'>Back to Posts</a>";
} else{
    echo "Error: " . $sql ."<br>" . $conn->error;
}