#!/usr/bin/php
<?php

//Requried files
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('dbConnection.php');
//require_once('rabbitMQClient.php');
    
//Error logging
error_reporting(E_ALL);
ini_set('display_errors', 'Off');
ini_set('log_errors', 'On');

//Login Function
function doLogin($username,$password)
{   
    $connection = dbConnection(); 
    $ENCpassword = sha1($password);   
    $query = "SELECT * FROM `account` WHERE username='$username' AND password='$ENCpassword'";
    $result = $connection->query($query);
    if ($result->num_rows == 1) 
    {
      echo "\n\n\t***Login successful***\n\n";
      return show($username);
    }  
    else { 
      echo "\n\t***Wrong username/password combination***\n\n";
      return false; 
   }
}
//Register Function
function doRegister($username, $email, $password_1, $password_2)
{
    $connection = dbConnection();
    $ENCpassword_1 = sha1($password_1);

    $query = "SELECT * FROM `account` WHERE username='$username'";
    $result = $connection->query($query);
    if ($result->num_rows == 1) 
    {
      echo "\n\n\t***User already exists***\n\n";
      return false;
    }
   	
    $insert_query = "INSERT INTO `account` (username, email, password, plainPass) 
  			  VALUES('$username', '$email', '$ENCpassword_1', '$password_2')";

    if ($connection->query($insert_query) === TRUE) {
        echo "\n\n\t***New record created successfully***\n\n";
    } 
    else {
        echo "Error: " . $insert_query . "<br>" . $connection->error;
	return false; 
    }
    return true;
}
?>
