<?php
$dbname = "proceduraldb";
$dbusername = "root";
$dbhost = "localhost";
$dbpassword = "";

$conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
