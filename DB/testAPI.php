#!/usr/bin/php
<?php
//require_once('path.inc');
//require_once('get_host_info.inc');
//require_once('rabbitMQLib.inc');
require_once('dbConnection.php');

// Set up the API request URL
$url = "https://www.balldontlie.io/api/v1/players";

// Send the request and get the response
$data = file_get_contents($url);

// Decode the JSON-formatted response into a PHP object
$players = json_decode($data,true);

// Connect to the database
//$conn = new mysqli_connect("localhost", "mohammad", "Password123!", "IT490");
$conn = dbConnection();

// Iterate over the player data
foreach ($players as $player) {
	$data = $player["data"];
 	$first_name = $player["first_name"];
  	$last_name = $player["last_name"];
 	$position = $player["position"];


  // Construct the SQL query
  $query = "INSERT INTO testNBA (first, last, position)
	VALUES('$first_name','$last_name','$position')";

  // Execute the query
  mysqli_query($conn,$query);
}

// Close the database connection
//$mysqli->close();
?>
