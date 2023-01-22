<?php
include("MQClient.php");
session_start();
if(!isset($_SESSION['username'])){
	$_SESSION['msg'] = "Login first.";
	header('location: login.php');
}
echo "<br>User: " . $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Generate Team</title>
  <link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>

<div class = "fade-in">
  <div class="header">
  	<h2>Generate Team</h2>
  </div>
	 
  <form method="post" action="info-sticky.php">
  	
    <div class="input-group">
  		<label>Player 1:</label>
  		<input type="text" name="Player1" value="<?php echo $_SESSION['player1']; ?>" readonly>
                <button type="submit" class="btn" name="generate1">Generate</button>
        
  	</div> 
     <div class="input-group">
                <label>Player 2:</label>
                <input type="text" name="Player2" value="<?php echo $_SESSION['player2']; ?>" readonly>
                <button type="submit" class="btn" name="generate2">Generate</button>
        
        </div> 
<div class="input-group">
                <label>Player 3:</label>
                <input type="text" name="Player3" value="<?php echo $_SESSION['player3']; ?>" readonly>
                <button type="submit" class="btn" name="generate3">Generate</button>
        
        </div> 
<div class="input-group">
                <label>Player 4:</label>
                <input type="text" name="Player4" value="<?php echo $_SESSION['player4']; ?>" readonly>
                <button type="submit" class="btn" name="generate4">Generate</button>
        
        </div> 
<div class="input-group">
                <label>Player 5:</label>
                <input type="text" name="Player5" value="<?php echo $_SESSION['player5']; ?>" readonly>
                <button type="submit" class="btn" name="generate5">Generate</button>
        </div> 

  	<p>
 		Play your team <a href="play.php">Here</a> or <a href="logout.php">Logout</a>
 </p>

  </form>
</div>
</body>
</html>
