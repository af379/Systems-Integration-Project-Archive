#!/usr/bin/php
<?php

//require_once('dbConnection.php');


$data = file_get_contents("https://www.balldontlie.io/api/v1/players");

$players = json_decode($data);

//$conn = dbConnection();

foreach($players as $player){
	echo $player->data. "\n";
	//$data= $player['data'];
	//var_dump($players);

//$query = "INSERT INTO testNBA(first) VALUES('$data')";

}

//mysqli_query($conn,$query);



?>

