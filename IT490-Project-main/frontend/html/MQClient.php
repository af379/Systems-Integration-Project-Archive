<?php
session_start();
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$username = "";

$client = new rabbitMQClient("frontend.ini","testServer");
echo "Client Service Begins.".PHP_EOL;

if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}


//Login Request
if (isset($_POST['login_user'])) {
	$request= array();
	$request['type'] = "login";
	$request['username'] = $_POST["username"];
	$request['password'] = $_POST["password"];
	$request['message'] = $msg;
	
	$response = $client->send_request($request);
	//$response = $client->publish($request);
	//dunno what this is for yet ^ ?_?
	echo "Received Response".PHP_EOL;
	print_r($response);
	
	if ($response[0]==false){
		print_r("Wrong Username/Password Combination");
		}
	if ($response[0] == true){
		$_SESSION['username'] = $request['username'];
		$_SESSION['auth'] = true;
		$_SESSION['player1'] = $response[1];
		$_SESSION['player2'] = $response[2];
		$_SESSION['player3'] = $response[3];
		$_SESSION['player4'] = $response[4];
		$_SESSION['player5'] = $response[5];
		header('location: info.php');
		}
}

//Register Request
if (isset($_POST['register_user'])) {
$request = array();
	$request['type'] = "register";
	$request['username'] = $_POST["username"];
	$request['email'] = $_POST["email"];
	$request['password1'] = $_POST['password1'];
	$request['password2'] = $_POST['password2'];
	if ($request['password1'] != $request['password2']) {
		print_r("Passwords do not match.");
	}
	else {
		$response = $client->send_request($request);
	}
	echo $response;
	echo "Received Response".PHP_EOL;
	print_r($response);

	if ($response==true){
		echo  "Registered User Successfully";
		$_SESSION['username'] = $request['username'];
		$_SESSION['auth'] =  true;
		header('location: info.php');
		}
	else{
	print_r("User exists already.");
	}
}
//generate player 1 request
if (isset($_POST['generate1'])) {
$request = array();
	$request['type'] = "generate";
	$request['username'] = $_SESSION['username'];
	$request['space'] = "player1";

	$response = $client->send_request($request);
	echo $response;
	echo "Received Response".PHP_EOL;
	$_SESSION['player1'] = $response;

	
}
//generate player 2 request
if (isset($_POST['generate2'])) {
$request = array();
        $request['type'] = "generate";
        $request['username'] = $_SESSION['username'];
	$request['space'] = "player2";

        $response = $client->send_request($request);
        echo $response;
        echo "Received Response".PHP_EOL;
        $_SESSION['player2'] = print_r($response, true);

        
}
//generate player 3 request
if (isset($_POST['generate3'])) {
$request = array();
        $request['type'] = "generate";
        $request['username'] = $_SESSION['username'];
	$request['space'] = "player3";

        $response = $client->send_request($request);
        echo $response;
        echo "Received Response".PHP_EOL;
        $_SESSION['player3'] = print_r($response, true);

        
}
//generate player 4 request
if (isset($_POST['generate4'])) {
$request = array();
        $request['type'] = "generate";
        $request['username'] = $_SESSION['username'];
	$request['space'] = "player4";

        $response = $client->send_request($request);
        echo $response;
        echo "Received Response".PHP_EOL;
        $_SESSION['player4'] = print_r($response, true);

        
}

//generate player 5 request
if (isset($_POST['generate5'])) {
$request = array();
        $request['type'] = "generate";
        $request['username'] = $_SESSION['username'];
        $request['space'] = "player5";
        $response = $client->send_request($request);
        echo $response;
        echo "Received Response".PHP_EOL;
        $_SESSION['player5'] = print_r($response, true);

        
}
if (isset($_POST['selectopponent'])){
$request = array();
	$request['type'] = "opponent";
	$request['username'] = $_POST["opponent"];
	$response = $client->send_request($request);
	echo $response;
	echo "Received Response".PHP_EOL;
	if($response[0] == true){
	$_SESSION['opponent'] = $_POST["opponent"];
	$_SESSION['o_player1'] = $response[1];
	$_SESSION['o_player2'] = $response[2];
	$_SESSION['o_player3'] = $response[3];
	$_SESSION['o_player4'] = $response[4];
	$_SESSION['o_player5'] = $response[5];
}
	else{
	echo "User doesn't exist";
}
}
if (isset($_POST['play'])){
$request = array();
	$request['type'] = "total";
	$request['username']= $_SESSION['username'];
	$request['opponent']= $_SESSION['opponent'];
	$response = $client->send_request($request);
	echo $response;
	echo "Received Response".PHP_EOL;
	if ($response==true){
		echo "Your team wins against this team";
		$_SESSION['win']=true;
	}
	else{
		echo "Your team loses against this team";
		$_SESSION['win']=false;
}
}
