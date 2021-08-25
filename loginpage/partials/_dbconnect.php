<?php
$insert = false;
$servername = "localhost";
$username = "root";
$password = "Aman@2871";
$database = "user@648";

// make connection
$conn = mysqli_connect($servername, $username, $password, $database);

// die if not connected
if (!$conn) {
    die("sry we failed to connect" . mysqli_connect_error());
}
?>