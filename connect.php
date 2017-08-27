<?php
  // Connect to MySQL Database
  $servername = "127.0.0.1";
  $username = "root";
  $password = "root";
  $dbname = "culinarycart";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
 ?>
