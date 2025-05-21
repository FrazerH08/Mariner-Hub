<?php
include 'connectdb.php';
include 'nav.php';
$logged_in = $_SESSION['logged_in'];
$role = $_SESSION['role'];

if($role != 'admin' || $logged_in == false) {
    header(header:"Location: list_news.php");
}
$username = $_SESSION['username'] ?? 'Guest';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management</title>
    <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="admin_management.css">
  <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
  </style>
</head>
<body>
    <h2>Hello <?php echo htmlspecialchars($username); ?>, Nice to see you! Welcome to the Black & White Faithful</h2>
    <a class="content-creatorbtn" href="news_upload.php"> Create News</a>
</body>
</html>