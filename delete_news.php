<?php

include 'connectdb.php';
include 'nav.php';
session_start();

$logged_in = $_SESSION['logged_in'];
$role = $_SESSION['role'];

if($role != 'admin' || $logged_in == false) {
    header(header:"Location: list_news.php");
}

$SQL = "DELETE FROM news WHERE id =" . $_GET['id'];

$result = $conn->query(query:$SQL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete News </title>
    <link rel="stylesheet" href="main.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cambo&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
</head>
<body>
    <?php
    echo '<style>
    section{
    background-color:pink;
    display:block;
    }
    </style>';
    
    if ($result === TRUE) {
        echo "<h1 class='title'>Article Deleted Successfully</h1>";
        echo "<p style='display:block; text-align:center;'>" . mysqli_affected_rows($conn) ." Rows Affected </p>";
        echo "<p style='display:block; text-align:center;'><a href='list_news.php'>Back To News</a></p>";
    } else {
        echo "Sorry 0 Results Returned";
    }
    ?>
</body>
</html>