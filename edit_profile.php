<?php
session_start();
include 'connectdb.php';

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
<form action="edit_profile_validate.php" method='POST' enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <label for="firstname"><b>First name:</b></label>
        <input type="text" name="firstname" value="<?php echo $firstname;?> "required> <br>
        <br>
        <label for="lastname"><b>Lastname:</b></label>
        <input type="text" name="lastname" value="<?php echo $lastname;?> "required> <br>
        <br>
        <label for="dob"><b>Date of birth:</b></label>
        <input type="date" id="birthdate"name="birthdate" value="<?php echo $birthdate;?>"> <br> <br>
        <label for ="bio"><b>Bio:</b></label>
        <input type="text" name="bio" value="<?php echo $bio;?>"> <br>
        <br>
        <label for="region"><b>Region:</b></label> 
        <select id="region" name="region" value="<?php echo $region;?>"> 
        <option value="Australia">Australia</option>
        <option value="Canada">Canada</option>
        <option value="USA">USA</option>
        <option value="United Kingdom">United Kingdom</option>
        </select>
        <br>
        <br>
        <label for="email"><b>Email:</b></label> <br>
        <input type="text"  name="email" value="<?php echo $email;?>" required> <br>
        <br> <label for="username"><b>Username:</b></label> <br>
        <input type="text" name="username" value="<?php echo $username; ?>" required> <br>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <div class="next">
            <button type="submit" name= "submit" value="submit" class="signupbtn" >Next</button>
        </div>
    </form>



?>