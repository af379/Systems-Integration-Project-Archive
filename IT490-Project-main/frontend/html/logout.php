<?php
session_start();

$_SESSION = array();
session_destroy();

echo "You have been successfully logged out.<br><br>";

header("refresh: 4, url=login.php");
