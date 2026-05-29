<?php
$servername = "localhost";
$username 	= "project";
$password 	= "";
$db = "project";

$conn = new mysqli($servername, $username, $password, $db);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);} 
//echo "Connected successfully";

?>
