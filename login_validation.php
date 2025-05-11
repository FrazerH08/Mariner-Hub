<?php
include 'connectdb.php';
session_start();

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Use prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Add debugging
    echo "Debug - User found: ";
    var_dump($user);
    echo "<br>";

    // Check password using existing method from signup (hashed password)
    if($user && password_verify($password, $user['password'])){
        // Regenerate session ID for security
        session_regenerate_id(true);

        // Store username and role in session
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['logged_in']= true;

        // Add debugging
        echo "Debug - Session username set: " . $_SESSION['username'];

        header("Location: welcome.php");
        exit();
    } else {
        echo "<h1>Invalid username or password</h1>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
    }
}
?>