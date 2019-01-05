<?php
include 'connection.php';
$con=mysqli_connect($server,$username,$password,$dbname);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to mysqli: " . mysqli_connect_error();
  }
?>
