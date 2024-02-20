<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "theses_r";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("เชื่อมต่อฐานข้อมูลล้มเหลว: " . mysqli_connect_error());
}
?>
