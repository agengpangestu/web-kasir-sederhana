<?php
//koneksi ke database
$host = "localhost"; //nama server
$user = "root"; //user server
$pass = ""; //pass server
$db = "kasirdimdimmusic"; //nama database

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection fail: " . $conn->connect_error);
}
// echo "Connected successfully";
