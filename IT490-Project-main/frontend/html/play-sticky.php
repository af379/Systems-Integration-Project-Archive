<?php
include("MQClient.php");
session_start();
if(!isset($_SESSION['username'])){
	$_SESSION['msg'] = "Login first.";
	header('location: login.php');
}
echo "<br> User: " . $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>Play Teams</title>
  <link rel="stylesheet" type="text/css" href="style3.css">
</head>

<body>

<div class = "fade-in">
<div class = "panel1">
  <div class="header">
  	<h2>Home Team</h2>
  </div>
	 
  <form method="post" action="play-sticky.php">
  	
    <div class="input-group">
  		<label>Player 1:</label>
  		<input type="text" name="Player1" value="<?php echo $_SESSION['player1']; ?>" readonly>
        
  	</div> 
     <div class="input-group">
                <label>Player 2:</label>
                <input type="text" name="Player2" value="<?php echo $_SESSION['player2']; ?>" readonly>
        
        </div> 
<div class="input-group">
                <label>Player 3:</label>
                <input type="text" name="Player3" value="<?php echo $_SESSION['player3']; ?>" readonly>
        
        </div> 
<div class="input-group">
                <label>Player 4:</label>
                <input type="text" name="Player4" value="<?php echo $_SESSION['player4']; ?>" readonly>
        
        </div> 
<div class="input-group">
                <label>Player 5:</label>
                <input type="text" name="Player5" value="<?php echo $_SESSION['player5']; ?>" readonly>
        </div> 
<div class="input-group">
                <button type="submit" class="btn" name="play">Play</button>
  	<p>
 		Generate your team <a href="info.php">Here</a> or <a href="logout.php">Logout</a>
 </p>

  </form>

</div>
</div>
<div class = "panel2">
  <div class="header">
  	<h2>Opposing Team</h2>
  </div>
	 
  <form method="post" action="play-sticky.php">
  	
   	<div class="input-group">
  		<label>Player 1:</label>
  		<input type="text" name="ePlayer1" value="<?php echo $_SESSION['o_player1']; ?>" readonly>
        
  		</div> 
     	<div class="input-group">
                <label>Player 2:</label>
                <input type="text" name="ePlayer2" value="<?php echo $_SESSION['o_player2']; ?>" readonly>
        
        	</div> 
	<div class="input-group">
                <label>Player 3:</label>
                <input type="text" name="ePlayer3" value="<?php echo $_SESSION['o_player3']; ?>" readonly>
        
        	</div> 
	<div class="input-group">
                <label>Player 4:</label>
                <input type="text" name="ePlayer4" value="<?php echo $_SESSION['o_player4']; ?>" readonly>
        
        	</div> 
	<div class="input-group">
                <label>Player 5:</label>
                <input type="text" name="ePlayer5" value="<?php echo $_SESSION['o_player5']; ?>" readonly>
        	</div> 
	<div class="input-group">
                <label>Opponent Username:</label>
                <input type="text" name="opponent" value="<?php echo $_SESSION['opponent']; ?>">
                </div> 


	<div class="input-group">
                <button type="submit" class="btn" name="selectopponent">Select</button>
        <p>


  </form>
</div>
</div>
</body>
</html>
