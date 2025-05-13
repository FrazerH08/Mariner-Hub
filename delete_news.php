<?php

include 'connectdb.php';
session_start();

$logged_in = $_SESSION['logged_in'];
$role = $_SESSION['role'];

if($role != 'admin' || $logged_in == false) {
    header(header:"Location: list_news.php");
}

$SQL = "DELETE FROM news WHERE id =" . $_GET['id'];

$result = $conn->query(query:$SQL);

echo '<style>
section{
background-color:pink;
display:block;
}
</style>';

if ($result === TRUE) {
    echo "<h1>Article Deleted Successfully</h1>";
    echo "<p>" . mysqli_affected_rows($conn) ." Rows Affected </p>";
    echo "<p><a href='list_news.php'>Back To News</a></p>";
} else {
    echo "Sorry 0 Results Returned";
}
?>