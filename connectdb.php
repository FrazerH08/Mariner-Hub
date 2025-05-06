<?php
$servername ="localhost";
$username = "root";
$password = "";
$dbname = "black&white_faithful";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error){
    die("Connection failed:" . $conn->connect_error);
}else{
    echo '<p style="display:none;">Connected successfully</p>';
}
echo '<p style="display:none;">Connected successfully</p>';
