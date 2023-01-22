#!/usr/bin/php
<?php

function dbConnection(){

$servername = "localhost";
$username = "mohammad";
$password = "Password123!";
$db = "IT490";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

if ($conn->connect_error) {
	die("Connection Failed: ". $conn->connect_error);
}
echo "Connected Successfully";
return $conn;
}
?>
