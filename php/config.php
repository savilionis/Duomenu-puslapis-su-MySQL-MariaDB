<?php
$servername = "";
$username = "";
$db = "";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8")
//echo "Connected successfully";

?>
