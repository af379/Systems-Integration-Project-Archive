#!/usr/bin/php
<?php

include('dbConnection.php');
$conn = dbConnection();

$sql = "SELECT first_name, last_name, team, points, position FROM NBA";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
echo '<table align ="center">

echo <th>First Name</th><th>Last Name</th><th>team</th><th>points</th>';

while($row = $result->fetch_assoc()) {

echo '<tr><td>'.$row['first_name'].'</td><td>'.$row['last_name'].'</td><td>'.$row['team'].'</td><td>'.$row['points'].'</td><td>'.$row['position'].'</td></tr>';

}
}
else {
echo "0 results";
}


$conn->close();

?>
