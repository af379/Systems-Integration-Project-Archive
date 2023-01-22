#!/usr/bin/php
<?php
use http\client\client;

$request = array();
$request['type'] = "generate";

function doGenerate($username, $space){

require_once('dbConnection.php');

$conn = dbConnection();

set_include_path(".:usr/shar/php");

//use http\client\client;

$client = new http\Client;
$request = new http\Client\Request;

$request->setRequestUrl('https://www.balldontlie.io/api/v1/stats');
$request->setRequestMethod('GET');


$r = rand(1,2040); 

$request->setQuery(new http\QueryString([
    'page' => '$r',
    'per_page' => '25'
]));

$client->enqueue($request)->send();
$response = $client->getResponse();
$response_body = $response->getBody();

$obj = json_decode($response_body);

 $x = mt_rand(0,25);

	$first_name = print_r($obj->data[$x]->player->first_name,true);
	if ($first_name == null){
		$first_name = "Joe";
		}
	$first_name = filter_var($first_name, FILTER_SANITIZE_STRING);
	$last_name = print_r($obj->data[$x]->player->last_name,true);
	if ($last_name == null){
                $last_name = "Smith";
                }
	$last_name = filter_var($last_name, FILTER_SANITIZE_STRING);
	$position = print_r($obj->data[$x]->player->position,true);
	if ($position == null){
                $position = "G";
                }
	$position = filter_var($position, FILTER_SANITIZE_STRING);
	$points = intval(print_r($obj->data[$x]->pts,true));
	if ($points == null){
		$points = 5;
		}
	$team = print_r($obj->data[$x]->team->full_name,true);
	if ($team == null){
		$team = "Phoenix Suns";
		}
	$team = filter_var($team, FILTER_SANITIZE_STRING);

	  $id = print_r($obj->data[$x]->player->id,true);
	if ($id == null){
		$id = 0;
		}
	
  $query = "INSERT INTO NBA (first_name, last_name, position, points,team,id)  VALUES('$first_name','$last_name','$position','$points','$team','$id')";

  // Execute the query
  mysqli_query($conn,$query);
  switch ($space){
	case  "player1":
  		$query = "UPDATE register SET player1 = '$id' WHERE username = '$username'";
		mysqli_query($conn,$query);
		$query2 = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.team,NBA.points  FROM NBA JOIN register ON NBA.id = register.player1 WHERE register.username='$username'";
		$result2 = mysqli_query($conn, $query2);
		$name = mysqli_fetch_row($result2);
		$playername = $name[1] . ' ' . $name[2];
		
		//$playerID = $result2['player1'];
		//$query3 = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.team,NBA.points  FROM NBA JOIN register ON NBA.id = register.player2";
		//$result3 = mysqli_query($conn, $query3);
		//$playername = $result3['first_name'] . ' ' . $result3['last_name']; 
		break;
	case  "player2":
                $query = "UPDATE register SET player2 = '$id' WHERE username = '$username'";
		mysqli_query($conn,$query);
                $query2 = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.team,NBA.points  FROM NBA JOIN register ON NBA.id = register.player2 WHERE register.username='$username'";
                $result2 = mysqli_query($conn, $query2);
		$name = mysqli_fetch_row($result2);
                $playername = $name[1] . ' ' . $name[2];

                //$playerID = $result2['player2'];
                //$query3 = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.team,NBA.points  FROM NBA JOIN register ON NBA.id = register.player2;";
                //$result3 = mysqli_query($conn, $query3);
               // $playername = $result3['first_name'] . ' ' . $result3['last_name']; 
		break;
	case  "player3":
               $query = "UPDATE register SET player3 = '$id' WHERE username = '$username'";
		mysqli_query($conn,$query);
                $query2 = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.team,NBA.points  FROM NBA JOIN register ON NBA.id = register.player3 WHERE register.username='$username'";
                $result2 = mysqli_query($conn, $query2);
		$name = mysqli_fetch_row($result2);
                $playername = $name[1] . ' ' . $name[2];


               // $playerID = $result2['player3'];
                //$query3 = "SELECT first_name, last_name FROM NBA WHERE id = '$playerID'";
               // $result3 = mysqli_query($conn, $query3);
               // $playername = $result3['first_name'] . ' ' . $result3['last_name']; 
		break;
	case  "player4":
                $query = "UPDATE register SET player4 = '$id' WHERE username = '$username'";
		mysqli_query($conn,$query);
                $query2 = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.team,NBA.points  FROM NBA JOIN register ON NBA.id = register.player4 WHERE register.username='$username'";
                $result2 = mysqli_query($conn, $query2);
		$name = mysqli_fetch_row($result2);
                $playername = $name[1] . ' ' . $name[2];

                //$playerID = $result2['player4'];
                //$query3 = "SELECT first_name, last_name FROM NBA WHERE id = '$playerID'";
                //$result3 = mysqli_query($conn, $query3);
                //$playername = $result3['first_name'] . ' ' . $result3['last_name']; 
		break;
	case  "player5":
                $query = "UPDATE register SET player5 = '$id' WHERE username = '$username'";
		mysqli_query($conn,$query);
                $query2 = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.team,NBA.points  FROM NBA JOIN register ON NBA.id = register.player5 WHERE register.username='$username'";
		$result2 = mysqli_query($conn, $query2);
		$name = mysqli_fetch_row($result2);
                $playername = $name[1] . ' ' . $name[2];

               // $result2 = mysqli_query($conn, $query2);
                //$playerID = $result2['player5'];
               // $query3 = "SELECT first_name, last_name FROM NBA WHERE id = '$playerID'";
               // $result3 = mysqli_query($conn, $query3);
               // $playername = $result3['first_name'] . ' ' . $result3['last_name']; 
		break;
}

return $playername;

}

?>

