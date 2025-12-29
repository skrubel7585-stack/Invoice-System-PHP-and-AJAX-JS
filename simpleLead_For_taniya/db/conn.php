<?php
$servername = "localhost";
$username = "ramwerde_leadtaniya";
$password = "h!D#VyU^Xt@6";
$db = "ramwerde_leadtaniya";

// $servername = "localhost";
// $username = "ramwerde_softsr";
// $password = "%3yM5SyAj)oL";
// $db = "ramwerde_softsr";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>