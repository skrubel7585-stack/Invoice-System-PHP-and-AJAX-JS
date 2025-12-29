<?php


$servername = "localhost";
$username = "u951360235_crmramwerde_Qu";
$password = "O:X2lf/x8u";
$db = "u951360235_crmramwerde_Qu";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>