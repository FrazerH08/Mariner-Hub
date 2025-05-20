<?php
include 'connectdb.php';
include 'nav.php';
$id = $_POST['id'];
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$birthdate = $_POST['birthdate'];
$region = $_POST['region'];
$bio = $_POST['bio'];
$profile_pic = basename($_FILES['fileToUpload']['name']);
// foreach ($_FILES as $key => $value){
//     echo($key . ' this is adams debug test');
//   }
$target_dir = "uploads/";
$target_file = $target_dir . basename ($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType =strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Below Checks if an  image file is a actual image or fake image.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile Validate</title>
    <link rel="stylesheet" href="main.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
</head>
<body>
<?php
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

$sql = "UPDATE users SET username='$username', email='$email', firstname='$firstname' , lastname='$lastname' , birthdate='$birthdate', region='$region', bio='$bio', profile_pic='$profile_pic' WHERE id = $id";
if (mysqli_query($conn, $sql)) {
    echo "Profile successfully updated. Redirecting in 5 seconds...";
    header("refresh:5;url=retrieve_profile.php?id=$id");
} else {
    echo "Error updating profile: " . mysqli_error($conn);
}

?>
</body>
</html>
