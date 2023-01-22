<?php
include("MQClient.php");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class = "fade-in">
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	
    <div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username">
  	</div> 
    <div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
      
    <div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Don't have an account? <a href="register.php">Register</a>
  	</p>
  </form>
</div>
</body>
</html>
