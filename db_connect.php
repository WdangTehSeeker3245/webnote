<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "webnoteapp_db";

// $servername = "localhost";
// $username = "admin";
// $password = "adminizaus74";
// $database = "webnoteapp_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
