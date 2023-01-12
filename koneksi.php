<?php
//koneksi ke database
$host = "localhost"; //nama server
$user = "root"; //user server
$pass = ""; //pass server
$db = "kasirdimdimmusic"; //nama database

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Connection fail: " . mysqli_connect_errno() . " - " . mysqli_connect_error());
}
// echo "Connected successfully";
