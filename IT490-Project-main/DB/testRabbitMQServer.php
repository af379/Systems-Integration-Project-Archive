#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('dbConnection.php');
require_once('dbFunctions.php');
require_once('realAPI2.php');

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
      return doLogin($request['username'],$request['password']);

    case "register":
      return doRegister($request['username'],$request['email'],$request['password1'],$request['password2']);

    case "validate_session":
      return doValidate($request['sessionId']);

    case "generate":
	return doGenerate($request['username'],$request['space']);
    case "opponent":
	return doOpponent($request['username']);
    case "total":  
	return doPlay($request['username'],$request['opponent']);
}
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>

