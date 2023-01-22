#!/usr/bin/php
<?php
use http\client\client;

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include('dbConnection.php');

// Create a new http\Client object
$client = new http\Client;

// Create a new http\Client\Request object
$request = new http\Client\Request;

// Set the request method to GET
$request->setRequestMethod('GET');

// Set the request URL
$request->setRequestUrl('https://www.balldontlie.io/api/v1/stats');
$request->setQuery(new http\QueryString([
        'page' => '0',
        'per_page' => '100'
        ]));


// Send the request
$client->enqueue($request)->send();

// Get the response
$response = $client->getResponse();

// Get the response body
$response_body = $response->getBody();
// Get the API response as a JSON string

// Convert the JSON string into a PHP object
$obj = json_decode($response_body);

$x = mt_rand(0,25);

        //echo $x;
       $first_name =  print_r($obj->data[$x]->player->first_name,true);
        echo "\n";
      $last_name =  print_r($obj->data[$x]->player->last_name,true);
        echo "\n";
       $position =  print_r($obj->data[$x]->player->position,true);
        echo "\n";
       $points =  print_r($obj->data[$x]->pts,true);
        echo "\n";
       $team =  print_r($obj->data[$x]->team->full_name,true);
	$id = print_r($obj->data[$x]->player->id,true);


if (mysqli_num_rows($obj) > 0) {
    $duplicate = true;
}

// Insert the data if it's not a duplicate
if (!$duplicate) {
    $query = "INSERT INTO NBA (first_name, last_name, position, points,team,id)  VALUES('$first_name','$last_name','$position','$points','$team','$id')";


    if (mysqli_query($conn, $query)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }










  // Construct the SQL query
  $query = "INSERT INTO NBA (first, last, position, points,team,id)
     VALUES('$first_name','$last_name','$position','$points','$team','$id')";

  // Execute the query
 // mysqli_query($conn,$query);



?>

