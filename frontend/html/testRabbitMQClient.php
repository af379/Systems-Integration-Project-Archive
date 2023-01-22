#!/usr/bin/php
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
	$request['type'] = "Login";
	$request['username'] = $_POST["username"];
	$request['password'] = $_POST["password"];
	$request['message'] = $msg;
	
	$response = $client->send_request($request);
	//$response = $client->publish($request);
	//dunno what this is for yet ^ ?_?
	echo "Received Response".PHP_EOL;
	print_r($response);
	
	if ($response==0){
		print_r("Wrong Username/Password Combination");
		}
	if ($response != null){
		$_SESSION['username'] = $request['username'];
		$_SESSION['auth'] = true;
		header('location: info.php');
		}
}

//Register Request
if (isset($_POST['reg_user'])) {
	$request = array();
	$request['type'] = "Register";
	$request['username'] = $_POST["username"];
	$request['email'] = $_POST["email"];
	$request['password1'] = $_POST['password1'];
	$request['password2'] = $_POST['password2'];
	if ($request['password1'] != $request['password2']) {
		print_r("Passwords do not match.");
	}
	else {
		$response = $client->send-request($request);
	}
	echo "Received Response".PHP_EOL;
	print_r($response);

	if ($response==1){
		echo  "Registered User Successfully";
		$_SESSION['username'] = $request['username'];
		$_SESSION['auth'] =  true;
		header('location: info.php');
		}
	else{
	print_r("User exists already.");
	}
