<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('dbConnection.php');
require_once('realAPI2.php');
function doLogin($username,$password)
{
    $connection = dbConnection();
    $query = "SELECT password1 FROM register where username='$username'";
    $result = $connection->query($query);
    $row = mysqli_fetch_assoc($result);
    $h_password = $row['password1'];
    echo "$h_password";
    $query = "SELECT * FROM register WHERE username='$username' AND password1='$h_password'";
    $result = $connection->query($query);
    
    if (password_verify($password, $h_password))
    {
    $query2 = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.team,NBA.points  FROM NBA JOIN register ON NBA.id = register.player1 WHERE register.username='$username'";
		$result2 = mysqli_query($connection, $query2);
		$name = mysqli_fetch_row($result2);
                $player1 = $name[1] . ' ' . $name[2];
    $query2 = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.team,NBA.points  FROM NBA JOIN register ON NBA.id = register.player2 WHERE register.username = '$username'";
		$result2 = mysqli_query($connection, $query2);
		$name = mysqli_fetch_row($result2);
                $player2 = $name[1] . ' ' . $name[2];
    $query2 = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.team,NBA.points  FROM NBA JOIN register ON NBA.id = register.player3 WHERE register.username='$username'";
		$result2 = mysqli_query($connection, $query2);
		$name = mysqli_fetch_row($result2);
                $player3 = $name[1] . ' ' . $name[2];
    $query2 = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.team,NBA.points  FROM NBA JOIN register ON NBA.id = register.player4 WHERE register.username = '$username'";
		$result2 = mysqli_query($connection, $query2);
		$name = mysqli_fetch_row($result2);
                $player4 = $name[1] . ' ' . $name[2];
    $query2 = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.team,NBA.points  FROM NBA JOIN register ON NBA.id = register.player5 WHERE register.username = '$username'";
		$result2 = mysqli_query($connection, $query2);
		$name = mysqli_fetch_row($result2);
                $player5 = $name[1] . ' ' . $name[2];

	$result = array(true, $player1, $player2, $player3, $player4, $player5);    
  echo "\n\n\t***Login successful***\n\n";
      return $result;
    }
    else { 
      echo "\n\t***Wrong username/password combination***\n\n";
	$result = array(false);
	return $result; 
   }
}

function doRegister($username, $email, $password1, $password2)
{
        $connection = dbConnection();
	
        $h_password = password_hash($password1, PASSWORD_DEFAULT);
	
	$query = "SELECT * FROM `register` WHERE username ='$username'";
	$result = $connection->query($query);
	if ($result->num_rows == 1){
		echo "User already exists";
		return false;
	}
	
        $newuser_query = "INSERT INTO register (username, email, password1, password2)  VALUES ('$username', '$email','$h_password', '$password2')";
        $result = $connection->query($newuser_query);

        return true;
}

function doOpponent($username){
	$connection = dbConnection();
	$query = "SELECT * FROM register WHERE username = '$username'";
	$result = $connection->query($query);
if($result->num_rows==1){
	$query = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.points FROM NBA JOIN register ON NBA.id = register.player1 WHERE register.username = '$username'";
	$result = mysqli_query($connection, $query);
        $name = mysqli_fetch_row($result);
	$player1 = $name[1] . ' ' . $name[2];


	$query = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.points FROM NBA JOIN register ON NBA.id = register.player2 WHERE register.username = '$username'";
        $result = mysqli_query($connection, $query);
        $name = mysqli_fetch_row($result);
        $player2 = $name[1] . ' ' . $name[2];

	
	$query = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.points FROM  NBA JOIN register ON NBA.id = register.player3 WHERE register.username = '$username'";
        $result = mysqli_query($connection, $query);
        $name = mysqli_fetch_row($result);
        $player3 = $name[1] . ' ' . $name[2];


	$query = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.points FROM NBA JOIN register ON NBA.id = register.player4 WHERE register.username = '$username'";
        $result = mysqli_query($connection, $query);
        $name = mysqli_fetch_row($result);
        $player4 = $name[1] . ' ' . $name[2];


	$query = "SELECT register.username,NBA.first_name,NBA.last_name,NBA.points FROM NBA JOIN register ON NBA.id = register.player5 WHERE register.username = '$username'";
        $result = mysqli_query($connection, $query);
        $name = mysqli_fetch_row($result);
        $player5 = $name[1] . ' ' . $name[2];

	$result = array(true, $player1, $player2, $player3, $player4, $player5);

	return $result;
}
else{
$result = array (false);
return $result;
}
}
function doPlay($username, $opponent){
	$connection = dbConnection();
//user totals
$query = "SELECT NBA.points FROM NBA JOIN register ON NBA.id = register.player1 WHERE register.username = '$username'";
        $result = mysqli_query($connection, $query);
        $name = mysqli_fetch_row($result);
	$points1 = $name[0];

$query = "SELECT NBA.points FROM NBA JOIN register ON NBA.id = register.player2 WHERE register.username = '$username'";
	 $result = mysqli_query($connection, $query);
        $name = mysqli_fetch_row($result);
	$points2 = $name[0];

$query = "SELECT NBA.points  FROM NBA JOIN register ON NBA.id = register.player3 WHERE register.username = '$username'";
	 $result = mysqli_query($connection, $query);
        $name = mysqli_fetch_row($result);
	$points3 = $name[0];

$query = "SELECT NBA.points FROM NBA JOIN register ON NBA.id = register.player4 WHERE register.username = '$username'";
	 $result = mysqli_query($connection, $query);
        $name = mysqli_fetch_row($result);
	$points4 = $name[0];


$query="SELECT NBA.points FROM NBA JOIN register ON NBA.id = register.player5 WHERE register.username = '$username'";
	 $result = mysqli_query($connection, $query);
        $name = mysqli_fetch_row($result);
	$points5 = $name[0];

//opponent totals
$query = "SELECT NBA.points FROM NBA JOIN register ON NBA.id = register.player1 WHERE register.username = '$opponent'";
        $result = mysqli_query($connection, $query);
        $name = mysqli_fetch_row($result);
	$o_points1 = $name[0];

$query = "SELECT NBA.points FROM NBA JOIN register ON NBA.id = register.player2 WHERE register.username = '$opponent'";
	 $result = mysqli_query($connection, $query);
        $name = mysqli_fetch_row($result);
	$o_points2 = $name[0];

$query = "SELECT NBA.points  FROM NBA JOIN register ON NBA.id = register.player3 WHERE register.username = '$opponent'";
	 $result = mysqli_query($connection, $query);
        $name = mysqli_fetch_row($result);
	$o_points3 = $name[0];

$query = "SELECT NBA.points FROM NBA JOIN register ON NBA.id = register.player4 WHERE register.username = '$opponent'";
	 $result = mysqli_query($connection, $query);
        $name = mysqli_fetch_row($result);
	$o_points4 = $name[0];


$query="SELECT NBA.points FROM NBA JOIN register ON NBA.id = register.player5 WHERE register.username = '$opponent'";
	 $result = mysqli_query($connection, $query);
        $name = mysqli_fetch_row($result);
	$o_points5 = $name[0];
	
	$pointstotal = $points1+$points2+$points3+$points4+$points5;
	$o_pointstotal=$o_points1+$o_points2+$o_points3+$o_points4+$o_points5;
	if ($pointstotal > $o_pointstotal){
		return true;
	}
	else{
		return false;
	}
}

?>

