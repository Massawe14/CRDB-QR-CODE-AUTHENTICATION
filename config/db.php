<?php 

  $host = "localhost"; 
  $username = "root"; 
  $password = ""; 
  $db = "wima_event"; 

  // Connection
  $conn = mysqli_connect("$host","$username","$password","$db");

  // Check connection
  if (!$conn) {
  	die(mysqli_connect_error($conn));
  }

?>