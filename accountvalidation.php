<?php
include 'connectdb.php';
include 'nav.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Validation</title>
    <link rel="stylesheet" href="main.css">
  <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
  </style>
</head>
<body>
    <?php
// if form is submitted
if(!isset($_POST['submit'])){
    header("Location: signup.php");
    exit();
}

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$birthdate = $_POST['birthdate'];
$region = $_POST['region'];

// email check
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

// Validate username
if (strlen($username) < 3 || strlen($username) > 20) {
    die("Username must be between 3 and 20 characters");
}

// Additional username validation (only alphanumeric)
if (!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
    die("Username can only contain letters, numbers, and underscores");
}

// Password check 
if (strlen($password) < 8) {
    die("Password must be at least 8 characters long");
}

        // Check if email already exists
        $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            echo "<h1 class='title'>Email is already taken, please change email</h1><br>";
            echo "<a href='javascript:self.history.back()' class='content-creatorbtn'> Go Back</a>";
        } else {
            // Hash the password , incase it gets hacked, based on testscript file
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into db
            $insert_stmt = $conn->prepare("INSERT INTO users (username, email, password, firstname, lastname, birthdate, region ) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $insert_stmt->bind_param("sssssss", $username, $email, $hashed_password, $firstname, $lastname, $birthdate, $region );

            if($insert_stmt->execute()){
                echo "<h1 class='title'>Registration was successful</h1><br>";
                echo "<a href='login.php' class='content-creatorbtn'>Login</a>";
            } else {
                echo "<h1 class='title'>Registration failed</h1><br>";
                echo "Error: " . $insert_stmt->error;
            }
        }
        ?>

</body>
</html>
